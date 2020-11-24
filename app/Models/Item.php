<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $appends = ['uri'];
    protected $fillable = ['path', 'filename'];

    public $timestamps = false;

    public function getUriAttribute()
    {
        return env('APP_URL') . "/images/" . $this->path . "/" . $this->filename;
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
