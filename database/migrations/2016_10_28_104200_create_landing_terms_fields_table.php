<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingTermsFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_terms_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lan_terms_name');
            $table->text('lan_terms_content');
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
        Schema::dropIfExists('landing_terms_fields');
    }
}
