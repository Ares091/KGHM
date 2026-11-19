<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('position_name');
            $table->string('status');
            $table->string('code');
            $table->integer('gender_id');
            $table->foreignId('division_id')->constrained('departments')->onDelete('cascade');
            $table->string('job');
            $table->string('phone_number_city')-> nullable();
            $table->string('phone_number_mobile')->nullable();
            $table->string('phone_number_job')->nullable();;
            $table->string('email_job')->unique();
            $table->string('email_home');
            $table->string('home_address');
            $table->integer('phone_number_relatives');
            $table->date('date_of_birth');
            $table->date('hire_date');
            $table->date('dismissal_date');

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
        Schema::dropIfExists('employees');
    }
}
