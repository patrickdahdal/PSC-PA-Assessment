<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAssessmentsResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments_results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('assessment_id');
            $table->text('content');

            $table->foreign('assessment_id')->references('id')->on('assessments');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessments_results');
    }
}
