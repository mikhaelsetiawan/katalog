<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelEschedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eschedule', function (Blueprint $table) {
            $table->increments('eschedule_id');
						$table->unsignedInteger('event_id');
						$table->text('eschedule_address');
						$table->string('eschedule_lat',25);
						$table->string('eschedule_lng',25);
						$table->dateTime('eschedule_start_date');
						$table->dateTime('eschedule_end_date');
						$table->tinyInteger('eschedule_status')->default(1);
            $table->timestamps();
        });

			Schema::table('eschedule', function(Blueprint $table) {
					$table->foreign('event_id')
						->references('event_id')
						->on('event')
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
        Schema::drop('eschedule');
    }
}
