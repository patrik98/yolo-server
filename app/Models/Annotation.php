<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

class Annotation extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function createInstance(int $projectId, int $itemId, int $shapeId, int $annotationTypeId)
    {
        $annotation = new Annotation();

        $annotation->project_id = $projectId;
        $annotation->item_id = $itemId;
        $annotation->shape_id = $shapeId;
        $annotation->annotation_type_id = $annotationTypeId;

        return $annotation;
    }

    public function saveWithTransaction(array $annotationValues, array $points)
    {
        try
        {
            DB::beginTransaction();

            $this->save();

            foreach($annotationValues as $annotationValue)
            {
                $annotationValue->annotation_id = $this->getKey();
                $annotationValue->save();
            }

            foreach($points as $point)
            {
                $point->annotation_id = $this->getKey();
                $point->save();
            }

            DB::commit();
        } catch(Throwable $e)
        {
            DB::rollBack();
            report($e);
        }
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function annotationType()
    {
        return $this->belongsTo(AnnotationType::class);
    }

    public function shape()
    {
        return $this->belongsTo(Shape::class);
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function annotationValues()
    {
        return $this->hasMany(AnnotationValue::class);
    }
}
