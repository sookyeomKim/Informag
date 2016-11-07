<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingUrlFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_url_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hits')->unsigned()->default(0);;
            $table->string('lan_url')->unique();
            $table->string('lan_ref');
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
        Schema::dropIfExists('landing_url_fields');
    }
}
