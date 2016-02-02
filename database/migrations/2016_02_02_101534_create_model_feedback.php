<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('feedback_id');
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('fcat_id');
            $table->text('feedback_content');
						$table->tinyInteger('feedback_status')->default(1);
            $table->timestamps();
        });

			Schema::table('feedback', function(Blueprint $table) {
					$table->foreign('member_id')
						->references('member_id')
						->on('member')
						->onDelete('cascade');
					$table->foreign('fcat_id')
						->references('fcat_id')
						->on('feedback_category')
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
        Schema::drop('feedback');
    }
}
