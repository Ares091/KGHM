<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTClient67Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_client_67', function (Blueprint $table) {
            $table->id('cli_id');
            $table->string('cli_name_f')->nullable();
            $table->string('cli_name_i')->nullable();
            $table->string('cli_name_o')->nullable();

            $table->string('cli_name_view')->nullable(); // Активная директория название пк
            $table->string('cli_prof')->nullable();  // Активная директория название юзера

            $table->integer('cli_div_id')->nullable();
            $table->string('cli_email')->default(false)->nullable();
            $table->string('cli_tel_work')->default(false)->nullable();
            $table->string('cli_tel_work2')->default(true)->nullable();
            
            $table->string('cli_tel_mobile')->nullable();
            $table->datetime('cli_date_born')->nullable();
            $table->string('cli_comment')->nullable();
            $table->boolean('cli_disable')->nullable()->default(0);
            $table->datetime('cli_date_create')->nullable();
            $table->datetime('cli_date_change')->nullable();
            $table->boolean('cli_sex')->nullable();
            $table->boolean('cli_pregnant')->nullable()->default(0);
            $table->boolean('cli_sync_1c')->nullable()->default(0);
            $table->string('cli_sync_1c_code')->nullable();
            $table->string('cli_sync_1c_division_code')->nullable();
            $table->boolean('cli_sync_1c_apply')->nullable()->default(0);
            $table->boolean('cli_sync_1c_is_division_head')->nullable()->default(0);
            $table->string('cli_sync_1c_category')->nullable();
            $table->string('cli_sync_1c_status')->nullable();
            $table->string('cli_sync_1c_employment_type')->nullable();
            $table->datetime('cli_sync_1c_hire_date')->nullable();
            $table->string('cli_sync_AD')->nullable();
            $table->string('cli_sync_1c_id')->nullable();
      

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_client_67');
    }
}
