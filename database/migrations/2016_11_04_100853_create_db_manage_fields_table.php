<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDbManageFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('db_manage_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lan_id')->unsigned();
            $table->foreign('lan_id')
                ->references('id')->on('landings')
                ->onDelete('cascade');
            $table->text('db_content');
            $table->string('db_inflow');
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
        Schema::dropIfExists('db_manage_fields');
    }
}
