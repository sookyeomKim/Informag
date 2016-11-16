<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('lan_c_name');
            $table->string('lan_m_name');
            $table->date('lan_start_date');
            $table->date('lan_end_date');
            $table->string('lan_title');
            $table->string('lan_kakao_id')->nullable();
            $table->string('lan_phone')->nullable();
            $table->text('lan_page_script')->nullable();
            $table->text('lan_db_script')->nullable();
            $table->boolean('lan_mobile_confirm')->default(true);

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
        Schema::dropIfExists('landings');
    }
}
