<?php

namespace App\Http\Controllers;

use App\Helpers\JsonValidator;
use App\Models\Annotation;
use App\Models\AnnotationValue;
use App\Models\Item;
use App\Models\Point;
use App\Models\Project;
use Illuminate\Http\Request;
use Throwable;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Project $project, Item $item)
    {
        $item = $project->items()->where("item_id", "=", $item->id)->get();

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
    public function store(Project $project, Item $item, Request $request)
    {
        $statusCode = 400;

        try {

            if ($this->validateAnnotations($request))
            {
                $annotations = $request->json()->all();

                foreach($annotations as $annotationContents)
                {
                    $this->storeWithTransaction($project->id, $item->id, $annotationContents);
                }

                $statusCode = 200;
            }
        }

        catch (Throwable $e)
        {
            report($e);
        }

        return response()->noContent($statusCode);
    }

    public function storeWithTransaction(int $projectId, int $itemId, array $annotationContents)
    {
        $annotation = Annotation::createInstance($projectId, $itemId, $annotationContents["shapeId"], $annotationContents["annotationTypeId"]);

        $annotationValues = [];
        foreach ($annotationContents["annotationValues"] as $key)
        {
            $annotationValue = AnnotationValue::createInstance($key["value"], $key["attributeId"]);
            array_push($annotationValues, $annotationValue);
        }

        $points = [];
        foreach ($annotationContents["points"] as $key)
        {
            $point = Point::createInstance($key["x"], $key["y"]);
            array_push($points, $point);
        }

        $annotation->saveWithTransaction($annotationValues, $points);
    }

    private function validateAnnotations(Request $request)
    {
        $rules = [
                "*.annotationTypeId" => ["required", "integer", "min:1"],
                "*.shapeId" => ["required", "integer", "min:1"],
                "*.annotationValues" => ["required", "array"],
                "*.annotationValues.*.attributeId" => ["required", "integer", "min:1"],
                "*.annotationValues.*.value" => ["required"],
                "*.points" => ["required", "array"],
                "*.points.*.x" => ["required", "min:0"],
                "*.points.*.y" => ["required", "min:0"],
            ];

        try
        {
            JsonValidator::validate($request->getContent(), $rules);

            return true;
        } catch (Throwable $e)
        {
            report($e);
        }

        return false;
    }

}
