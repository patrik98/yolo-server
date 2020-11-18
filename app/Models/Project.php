<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {
        return env('APP_URL') . "/" . $this->path . "/" . $this->image;
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
