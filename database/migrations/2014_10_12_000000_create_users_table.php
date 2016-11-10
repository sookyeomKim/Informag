<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('c_name')->unique();
            $table->string('m_name');
            $table->string('m_email');
            $table->string('c_id')->unique();
            $table->string('phone')->unique();
            $table->boolean('status')->default(true);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('role_id')->unsigned()->default(5);;
            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onDelete('cascade');
            /*$table->enum('role',['admin','client'])->default('client');*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
