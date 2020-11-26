<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnotationValue extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function annotation()
    {
        return $this->belongsTo(Annotation::class);
    }

    public function annotationAttribute()
    {
        return $this->belongsTo(AnnotationAttribute::class);
    }

    public function annotationAttributeValue()
    {
        return $this->belongsTo(AnnotationAttributeValue::class);
    }

}
