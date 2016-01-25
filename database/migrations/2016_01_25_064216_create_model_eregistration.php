<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelEregistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eregistration', function (Blueprint $table) {
            $table->increments('eregistration_id');
						$table->unsignedInteger('eschedule_id');
						$table->unsignedInteger('member_id');
						$table->tinyInteger('eregistration_status')->default(1);
            $table->timestamps();
        });

			Schema::table('eregistration', function(Blueprint $table) {
					$table->foreign('eschedule_id')
						->references('eschedule_id')
						->on('eschedule')
						->onDelete('cascade');
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
        Schema::drop('eregistration');
    }
}
