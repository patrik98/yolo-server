<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnotationType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

    public function annotations()
    {
        return $this->hasMany(Annotation::class);
    }

    public function annotationAttributes()
    {
        return $this->hasMany(AnnotationAttribute::class);
    }


}
