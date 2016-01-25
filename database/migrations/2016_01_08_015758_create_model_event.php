<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event', function (Blueprint $table) {
            $table->increments('event_id');
						$table->unsignedInteger('member_id');
						$table->unsignedInteger('business_id');
						$table->string('event_title');
						$table->text('event_content');
						$table->tinyInteger('event_status')->default(1);
            $table->timestamps();
        });

				Schema::table('event', function(Blueprint $table)
					{
						$table->foreign('member_id')
							->references('member_id')
							->on('member')
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
        Schema::drop('event');
    }
}
