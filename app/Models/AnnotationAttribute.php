<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnotationAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sort'];

    public $timestamps = false;

    public function annotationType()
    {
        return $this->belongsTo(AnnotationType::class);
    }

    public function viewType()
    {
        return $this->belongsTo(ViewType::class);
    }

    public function annotationAttributeValues()
    {
        return $this->hasMany(AnnotationAttributeValue::class);
    }
}
