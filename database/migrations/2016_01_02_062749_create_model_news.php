<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelNews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('news_id');
						$table->unsignedInteger('member_id');
						$table->unsignedInteger('business_id');
            $table->string('news_title');
            $table->text('news_content');
						$table->tinyInteger('news_status')->default(1);
            $table->timestamps();
        });

			Schema::table('news', function(Blueprint $table)
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
        Schema::drop('news');
    }
}
