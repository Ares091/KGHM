<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTCompanyDivision42Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_company_division_42', function (Blueprint $table) {
            $table->id('div_id');
            $table->integer('div_parent_id')->nullable();

            $table->string('div_name_full')->nullable();
            $table->string('div_name_short')->nullable();
            $table->string('div_comment')->nullable();

            $table->boolean('div_disable')->nullable(); // Активная директория название пк
            $table->dateTime('div_date_create')->nullable();  // Активная директория название юзера

            //$table->enum('u_role', ['user', 'admin', 'director'])->default('user');

            $table->dateTime('div_date_change')->nullable();
            $table->boolean('div_sync_1c')->default(false)->nullable();
            $table->string('div_sync_1c_code')->default(false)->nullable();
            $table->string('div_sync_1c_parent_code')->default(true)->nullable();
            
            $table->boolean('div_sync_1c_apply')->nullable();
            $table->boolean('div_check_subdivision')->nullable();
            $table->boolean('div_send_mail_apply')->nullable();
            $table->boolean('div_lock')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_company_division_42');
    }
}
