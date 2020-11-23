<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnotationAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annotation_attribute_values', function (Blueprint $table) {
            $table->id();
            $table->string("value", 150);
            $table->integer("sort");
            $table->foreignId("view_type_id")->constrained("view_types");
            $table->foreignId("annotation_attribute_id")->constrained("annotation_attributes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('values');
    }
}
