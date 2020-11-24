<?php


namespace App\Http\Controllers;


use App\Models\Item;
use App\Models\Project;

class ItemController
{

    /**
     * Show random Item
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\Response
     */
    public function random(Project $project)
    {
        $item = $project->items()->inRandomOrder()->first();
        return response()->json($item);
    }

}
