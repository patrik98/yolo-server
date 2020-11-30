<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $appends = ['uri'];
    protected $fillable = ['filename'];

    public $timestamps = false;

    public function getUriAttribute()
    {
        return env('APP_URL') . "/images/" . "/" . $this->filename;
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function annotations() {
        return $this->hasMany(Annotation::class);
    }
}
