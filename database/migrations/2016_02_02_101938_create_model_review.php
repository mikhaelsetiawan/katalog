<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->increments('review_id');
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('business_id');
            $table->text('review_content');
						$table->tinyInteger('review_status')->default(1);
            $table->timestamps();
        });

				Schema::table('review', function(Blueprint $table) {
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
        Schema::drop('review');
    }
}
