<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelTablePhotosEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos_event', function (Blueprint $table) {
						$table->increments('pevent_id');
						$table->unsignedInteger('event_id');
						$table->unsignedInteger('pevent_uploader');
						$table->text('pevent_caption');
						$table->tinyInteger('pevent_status')->default(1);
						$table->timestamps();
        });

			Schema::table('photos_event', function(Blueprint $table)
				{
					$table->foreign('pevent_uploader')
						->references('member_id')
						->on('member')
						->onDelete('cascade');
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
        Schema::drop('photos_event');
    }
}
