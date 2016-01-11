<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelTablePhotosNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos_news', function (Blueprint $table) {
            $table->increments('pnews_id');
						$table->unsignedInteger('news_id');
						$table->unsignedInteger('pnews_uploader');
						$table->text('pnews_caption');
						$table->tinyInteger('pnews_status')->default(1);
            $table->timestamps();
        });

			Schema::table('photos_news', function(Blueprint $table)
				{
					$table->foreign('pnews_uploader')
						->references('member_id')
						->on('member')
						->onDelete('cascade');
					$table->foreign('news_id')
						->references('news_id')
						->on('news')
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
        Schema::drop('photos_news');
    }
}
