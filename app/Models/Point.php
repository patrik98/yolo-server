<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    public $timestamps = false;

//    public function annotationAttributes()
//    {
//        return $this->hasMany(AnnotationAttribute::class);
//    }

    public function annotation()
    {
        return $this->belongsTo(Annotation::class);
    }
}
