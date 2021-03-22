<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespondentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respondents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('membercode_id');
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->enum('gender', ['M', 'F']);
            $table->enum('adult', ['Y', 'N']);
            $table->string('email', 64);
            $table->string('phone', 32)->nullable();
            $table->string('best_reached', 64)->nullable();
            $table->string('remark', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('membercode_id')->references('id')->on('membercodes');

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
        Schema::dropIfExists('respondents');
    }
}
