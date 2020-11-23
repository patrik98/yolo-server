<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnotationValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annotation_values', function (Blueprint $table) {
            $table->id();
            $table->string("value", 250);
            $table->foreignId("annotation_id")->constrained("annotations");
            $table->foreignId("annotation_attribute_id")->constrained("annotation_attributes");
            $table->foreignId("annotation_attribute_value_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annotation_values');
    }
}
