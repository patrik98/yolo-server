<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annotation extends Model
{
    use HasFactory;

    public $timestamps = false;

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
