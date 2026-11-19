<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTBugReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_bug_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('t_br_client_id')->nullable();
            $table->foreign('t_br_client_id')->references('cli_id')->on('t_client')->onDelete('cascade')->onUpdate('cascade');
            
            // $table->bigInteger('t_br_master_id')->nullable();
            // $table->foreign('t_br_master_id')->references('u_id')->on('t_a_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('t_br_master_id')->references('u_id')->on('t_a_users')->onDelete('cascade');


            $table->integer('t_br_priority')->default(2)->nullable();
            
            $table->string('t_br_client_mail');
            $table->string('t_br_client_message')->nullable();

            $table->datetime('t_br_message_send_date')->nullable();
            
            $table->enum('t_br_message_type', ['Неисправность оборудования', 'Периферия и оргтехника', 'Сеть и интернет', 'Программное обеспечение'])->default('Неисправность оборудования');
            $table->enum('t_br_message_status', ['В работе', 'Временно отложено', 'Сделано'])->default('В работе');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_bug_reports', function (Blueprint $table) {
            //
        });
    }
}
