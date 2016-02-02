<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelReviewRating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_rating', function (Blueprint $table) {
            $table->increments('rrating_id');
            $table->unsignedInteger('review_id');
            $table->unsignedInteger('rating_id');
            $table->unsignedInteger('rrating_score');
            $table->timestamps();
        });
		
		Schema::table('review_rating', function(Blueprint $table) {
						$table->foreign('review_id')
							->references('review_id')
							->on('review')
							->onDelete('cascade');
						$table->foreign('rating_id')
							->references('rating_id')
							->on('rating')
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
        Schema::drop('review_rating');
    }
}
