<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrivateInfoClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('t_client', function (Blueprint $table) {
            $table->string('cli_mobile_phone')->nullable()->after('cli_sync_1c_id');
            $table->string('cli_address')->nullable()->after('cli_sync_1c_id');
            $table->string('cli_adress_actual')->nullable()->after('cli_sync_1c_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_client', function (Blueprint $table) {
            //
        });
    }
}
