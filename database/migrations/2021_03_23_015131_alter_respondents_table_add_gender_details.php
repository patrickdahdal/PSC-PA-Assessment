<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRespondentsTableAddGenderDetails extends Migration
{

    public $set_schema_table = 'respondents';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("ALTER TABLE ".$this->set_schema_table." MODIFY COLUMN gender ENUM('M', 'F', 'T', 'N', 'P') NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::statement("ALTER TABLE ".$this->set_schema_table." MODIFY COLUMN gender ENUM('M', 'F') NOT NULL DEFAULT 'M'");
    }
}
