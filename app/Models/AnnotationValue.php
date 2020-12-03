<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnotationValue extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function createInstance(string $value, int $attributeId, int $annotationAttributeValueId = -1, int $annotationId = -1)
    {
        $annotationValue = new AnnotationValue();

        $annotationValue->value = $value;
        $annotationValue->annotation_attribute_id = $attributeId;
        $annotationValue->annotation_attribute_value_id = $annotationAttributeValueId; //TODO: resolve problem with attribute values being referenced by annotation values
        $annotationValue->annotation_id = $annotationId;

        return $annotationValue;
    }

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
