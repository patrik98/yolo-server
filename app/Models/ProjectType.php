<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public $timestamps = false;

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function annotationTypes()
    {
        return $this->hasMany(AnnotationType::class);
    }
}
