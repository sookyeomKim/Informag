<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbRelFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_rel_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lan_id')->unsigned();
            $table->foreign('lan_id')
                ->references('id')->on('landings')
                ->onDelete('cascade');
            $table->integer('db_id')->unsigned();
            $table->foreign('db_id')
                ->references('id')->on('landing_db_fields')
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
        Schema::dropIfExists('db_rel_fields');
    }
}
