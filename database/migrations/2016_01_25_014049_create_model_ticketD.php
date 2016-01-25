<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelTicketD extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketD', function (Blueprint $table) {
            $table->increments('ticketD_id');
						$table->unsignedInteger('ticketH_id');
						$table->unsignedInteger('business_id');
						$table->unsignedInteger('ticket_id');
						$table->integer('ticketD_amount')->default(0);
						$table->integer('ticketD_price')->default(0);
						$table->integer('ticketD_subtotal')->default(0);
            $table->timestamps();
        });

			Schema::table('ticketD', function(Blueprint $table)
				{
					$table->foreign('business_id')
						->references('business_id')
						->on('business')
						->onDelete('cascade');
					$table->foreign('ticketH_id')
						->references('ticketH_id')
						->on('ticketH')
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
        Schema::drop('ticketD');
    }
}
