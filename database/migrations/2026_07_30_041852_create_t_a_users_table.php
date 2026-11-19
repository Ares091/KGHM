<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTAUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_a_users', function (Blueprint $table) {
            $table->id('u_id');

            $table->integer('u_t_client_id')->nullable();
            $table->foreign('u_t_client_id')->references('cli_id')->on('t_client')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreignId('u_t_client_id')->constrained('t_client', 'cli_id')->onDelete('cascade');
            
            $table->string('u_login')->unique();
            $table->string('u_password');
            $table->string('u_email')->nullable();

            $table->string('u_ad_pc_name')->nullable(); // Активная директория название пк
            $table->string('u_ad_user_name')->nullable();  // Активная директория название юзера

            $table->enum('u_role', ['user', 'admin', 'director'])->default('user');

            $table->boolean('u_authorized')->default(false);
            $table->boolean('u_sync_AD')->default(false);
            $table->boolean('u_disabled')->default(false);
            $table->boolean('u_sync_1c')->default(true);
            
            $table->dateTime('u_updated_at')->nullable();
            $table->dateTime('u_created_at')->nullable();

            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_a_users');
    }
}
