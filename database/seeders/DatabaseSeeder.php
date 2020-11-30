<?php

namespace Database\Seeders;

use App\Models\AnnotationAttribute;
use App\Models\AnnotationAttributeValue;
use App\Models\AnnotationType;
use App\Models\Item;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\Shape;
use App\Models\User;
use App\Models\ViewType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $projectType = ProjectType::create(['name' => 'Signposts']);
        $projectType->save();

        $shapes = [];
        foreach (['Rectangle', 'Circle', 'Ellipse', 'Polygon'] as $shape) {
            $shape = Shape::create(['name' => $shape]);
            $shape->save();
            $shapes[] = $shape;
        }



        $viewTypes = [];
        foreach (['textfield', 'radiobutton', 'checkbox', 'select'] as $name) {
            $viewType = ViewType::create(['name' => $name]);
            $viewType->save();
            $viewTypes[] = $viewType;
        }



        $annotationTypes = [];

        $annotationTypes[] = AnnotationType::create([
            'name' => 'Yellow hiking sign',
            'project_type_id' => $projectType->id
        ]);
        $annotationTypes[0]->save();

        $annotationTypes[] = AnnotationType::create([
            'name' => 'Old wooden sign',
            'project_type_id' => $projectType->id
        ]);
        $annotationTypes[1]->save();



        $annotationAttributes = [];

        $annotationAttributes[] = AnnotationAttribute::create([
            'name' => 'Number of lines',
            'sort' => 1,
            'annotation_type_id' => $annotationTypes[0]->id,
            'view_type_id' => $viewTypes[3]->id
        ]);
        $annotationAttributes[0]->save();

        $annotationAttributes[] = AnnotationAttribute::create([
            'name' => 'Organisation line',
            'sort' => 2,
            'annotation_type_id' => $annotationTypes[0]->id,
            'view_type_id' => $viewTypes[2]->id
        ]);
        $annotationAttributes[1]->save();



        $annotationAttributeValues = [];

        for ($i = 0; $i < 5; $i++) {
            $annotationAttributeValues[] = AnnotationAttributeValue::create([
                'value' => '' . ($i + 1),
                'sort' => $i + 1,
                'annotation_attribute_id' =>  $annotationAttributes[0]->id,
                'view_type_id' => $viewTypes[3]->id
            ]);
            $annotationAttributeValues[$i]->save();
        }


        $project = Project::create([
            'name' => 'Digital Signposts',
            'description' => 'Signposts in the wild',
            'image' => 'images/demo/preview_1.png',
            'project_type_id' => $projectType->id
        ]);
        $project->save();



        $items = [];

        foreach (['001.jpg', '002.jpg', '003.jpg'] as $idx => $item) {
            $items[] = Item::create([
                'filename' => 'demo1/'.$item,
            ]);
            $items[$idx]->save();
            $items[$idx]->projects()->attach($project->id);
        }

        // VOYAGER
        $this->call(VoyagerDatabaseSeeder::class);
    }

}
