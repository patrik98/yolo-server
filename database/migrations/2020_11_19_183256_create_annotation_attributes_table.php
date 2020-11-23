<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnotationAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annotation_attributes', function (Blueprint $table) {
            $table->id();
            $table->string("name", "150");
            $table->integer("sort");
            $table->foreignId("annotation_type_id")->constrained("annotation_types");
            $table->foreignId("view_type_id")->constrained("view_types");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}
