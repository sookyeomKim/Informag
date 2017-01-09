<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyLanDbTypesToLandingDbFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE landing_db_fields CHANGE COLUMN lan_db_types lan_db_types ENUM('form', 'phone', 'url')");

        //Unknown database type enum requested라는 에러 발생
        /*Schema::table('landing_db_fields', function (Blueprint $table) {
            $table->enum('lan_db_types', ['form', 'phone', 'url'])->default('form')->change();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
