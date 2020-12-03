<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function createInstance(int $x, int $y, int $annotationId = -1)
    {
        $point = new Point();

        $point->x = $x;
        $point->y = $y;
        $point->annotation_id = $annotationId;

        return $point;
    }

    public function annotation()
    {
        return $this->belongsTo(Annotation::class);
    }

}
