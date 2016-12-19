<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteLanIdLandingDbFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('landing_db_fields', function (Blueprint $table) {
            $table->dropForeign('landing_db_fields_lan_id_foreign');
            $table->dropColumn('lan_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('landing_db_fields', function (Blueprint $table) {
            //
        });
    }
}
