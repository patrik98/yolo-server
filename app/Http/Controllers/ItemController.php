<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Project;

class ItemController extends Controller
{
    /**
     * Show random Item
     *
     * @param  \App\Models\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function random(Project $project)
    {
        $item = $project->items()->inRandomOrder()->first();
        return response()->json($item);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Project $project, Item $item)
    {
        $itemResult = $project->items()->where("item_id", "=", $item->id)->first();

        return response()->json($itemResult);
    }

}
