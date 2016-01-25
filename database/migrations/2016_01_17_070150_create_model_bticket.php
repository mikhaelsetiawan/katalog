<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelBticket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bticket', function (Blueprint $table) {
            $table->increments('bticket_id');
						$table->unsignedInteger('ticket_id');
						$table->unsignedInteger('business_id');
						$table->integer('bticket_amount');
						$table->tinyInteger('bticket_status')->default(1);
            $table->timestamps();
        });

			Schema::table('bticket', function(Blueprint $table)
				{
					$table->foreign('ticket_id')
						->references('ticket_id')
						->on('ticket')
						->onDelete('cascade');
					$table->foreign('business_id')
						->references('business_id')
						->on('business')
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
        Schema::drop('bticket');
    }
}
