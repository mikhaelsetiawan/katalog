<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelLogTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_ticket', function (Blueprint $table) {
            $table->increments('logticket_id');
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('logticket_price');
						$table->tinyInteger('logticket_status')->default(1);
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
        Schema::drop('log_ticket');
    }
}
