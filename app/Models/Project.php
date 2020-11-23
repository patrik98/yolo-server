<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $appends = ['image_path'];
    protected $fillable = ['name', 'description', 'image', 'path'];

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

    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

    public function prepareAsArray()
    {
        $data = $this->toArray();

        $projectType = $this->projectType;
        $annotationTypes = $projectType->annotationTypes;

        $data['annotationTypes'] = [];
        foreach ($annotationTypes as $atIndex => $annotationType) {
            $data['annotationTypes'][] = [
                'id' => $annotationType->id,
                'name' => $annotationType->name,
                'annotationAttributes' => []
            ];

            $annotationAttributes = $annotationType->annotationAttributes;
            foreach ($annotationAttributes as $aaIndex => $annotationAttribute) {
                $data['annotationTypes'][$atIndex]['annotationAttributes'][] = [
                    'id' => $annotationAttribute->id,
                    'name' => $annotationAttribute->name,
                    'viewType' => $annotationAttribute->viewType->name
                ];

                $annotationAttributeValues = $annotationAttribute->annotationAttributeValues;
                foreach ($annotationAttributeValues as $annotationAttributeValue) {
                    $data['annotationTypes'][$atIndex]['annotationAttributes'][$aaIndex]['annotationAttributeValues'][] = [
                        'id' => $annotationAttributeValue->id,
                        'value' => $annotationAttributeValue->value
                    ];
                }
            }
        }

        return $data;
    }

}
