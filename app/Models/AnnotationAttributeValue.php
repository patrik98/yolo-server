<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnotationAttributeValue extends Model
{
    use HasFactory;

    protected $fillable = ['value', 'sort'];

    public $timestamps = false;

    public function annotationAttribute()
    {
        return $this->belongsTo(AnnotationAttribute::class);
    }

    public function viewType()
    {
        return $this->belongsTo(ViewType::class);
    }

}
