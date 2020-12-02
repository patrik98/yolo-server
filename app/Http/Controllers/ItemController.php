<?php


namespace App\Http\Controllers;


use App\Models\Annotation;
use App\Models\AnnotationValue;
use App\Models\Item;
use App\Models\Point;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Validator;

class ItemController
{

    /**
     * Show random Item
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function random(Project $project)
    {
        $item = $project->items()->inRandomOrder()->first();
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Item $item) {
        $index = $item->id - 1;

        $item = $project->items()->getResults()[$index];

        return response()->json($item);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Item  $item
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project, Item $item, Request $request) {
        $statusCode = 500;

        try {
            $annotations = $request->json()->all();

            if ($this->validateAnnotations($annotations)) {
                foreach($annotations as $annotation) {
                    $this->storeWithTransaction($project->id, $item->id, $annotation);
                }

                $statusCode = 200;
            }
        }

        catch (Throwable $e) {
            report($e);
        }

        return response()->noContent($statusCode);
    }

    private function validateAnnotations(Array $annotations) {
        $rules = [
            "annotationTypeId" => ["required", "integer", "min:1"],
            "shapeId" => ["required", "integer", "min:1"],
            "annotationValues" => ["required", "array"],
            "annotationValues.*.attributeId" => ["required", "integer", "min:1"],
            "annotationValues.*.value" => ["required"],
            "points" => ["required", "array"],
            "points.*.x" => ["required", "min:0"],
            "points.*.y" => ["required", "min:0"],
        ];

        foreach ($annotations as $annotation) {
            try {
                $this->validateJson($annotation, $rules);

                return true;
            } catch (Throwable $e) {
                report($e);
            }
        }

        return false;
    }

    private function validateJson(Array $data, array $rules) {

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $key => $value) {
                echo $value;
            }

            throw new Exception("Validation failed!");
        }
    }

    private function buildAnnotationObject(int $itemId, int $shapeId, int $annotationTypeId, int $projectId) {
        $annotation = new Annotation();
        $annotation->setAttribute("item_id", $itemId);
        $annotation->setAttribute("shape_id", $shapeId);
        $annotation->setAttribute("annotation_type_id", $annotationTypeId);
        $annotation->setAttribute("project_id", $projectId);

        return $annotation;
    }

    private function buildAnnotationValueObjects(array $annotationValues, int $annotationId) {
        $annotationValuesArray = [];

        for ($i = 0; $i < sizeof($annotationValues); $i++) {
            $annotationValue = new AnnotationValue();
            $annotationValue->setAttribute("value", $annotationValues[$i]["value"]);
            $annotationValue->setAttribute("annotation_id", $annotationId);
            $annotationValue->setAttribute("annotation_attribute_id", $annotationValues[$i]["attributeId"]);
            $annotationValue->setAttribute("annotation_attribute_value_id", -1); //TODO: resolve problem with attribute values being referenced by annotation values
            $annotationValuesArray[$i] = $annotationValue;
        }

        return $annotationValuesArray;
    }

    private function buildPointsObjects(array $points, int $annotationId) {
        $pointsArray = [];

        for ($i = 0; $i < sizeof($points); $i++) {
            $point = new Point();
            $point->setAttribute("x", $points[$i]["x"]);
            $point->setAttribute("y", $points[$i]["y"]);
            $point->setAttribute("annotation_id", $annotationId);
            $pointsArray[$i] = $point;
        }

        return $pointsArray;
    }

    private function storeWithTransaction(int $projectId, int $itemId, array $annotationContents) {

        try {
            DB::beginTransaction();

            $annotation = $this->buildAnnotationObject($itemId, $annotationContents["shapeId"], $annotationContents["annotationTypeId"], $projectId);
            $annotation->save();

            $annotationValues = $this->buildAnnotationValueObjects($annotationContents["annotationValues"], $annotation->getKey());
            foreach($annotationValues as $annotationValue) {
                $annotationValue->save();
            }

            $points = $this->buildPointsObjects($annotationContents["points"], $annotation->getKey());
            foreach($points as $point) {
                $point->save();
            }

            DB::commit();
        } catch(Throwable $e) {
            DB::rollBack();
            report($e);
        }
    }

}
