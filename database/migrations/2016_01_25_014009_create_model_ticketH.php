<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelTicketH extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketH', function (Blueprint $table) {
            $table->increments('ticketH_id');
						$table->unsignedInteger('member_id');
						$table->integer('ticketH_total')->default(0);
            $table->timestamps();
        });

			Schema::table('ticketH', function(Blueprint $table) {
					$table->foreign('member_id')
						->references('member_id')
						->on('member')
						->onDelete('cascade');
				});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ticketH');
    }
}
