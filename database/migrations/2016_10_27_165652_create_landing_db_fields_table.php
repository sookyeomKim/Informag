<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingDbFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_db_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lan_db_title');
            $table->enum('lan_db_types',['form','phone'])->default('form');
            $table->integer('lan_id')->unsigned();
            $table->foreign('lan_id')
                ->references('id')->on('landings')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('landing_db_fields');
    }
}
