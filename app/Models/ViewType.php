<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function annotationAttributes()
    {
        return $this->hasMany(AnnotationAttribute::class);
    }

    public function annotationAttributeValues()
    {
        return $this->hasMany(AnnotationAttributeValue::class);
    }
}
