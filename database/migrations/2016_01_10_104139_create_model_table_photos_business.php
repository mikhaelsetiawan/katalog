<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelTablePhotosBusiness extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos_business', function (Blueprint $table) {
            $table->increments('pbusiness_id');
						$table->unsignedInteger('business_id');
						$table->unsignedInteger('pbusiness_uploader');
						$table->unsignedInteger('pcat_id');
            $table->text('pbusiness_caption');
            $table->text('pbusiness_path');
						$table->tinyInteger('pbusiness_status')->default(1);
            $table->timestamps();
        });

			Schema::table('photos_business', function(Blueprint $table)
				{
					$table->foreign('pbusiness_uploader')
						->references('member_id')
						->on('member')
						->onDelete('cascade');
					$table->foreign('business_id')
						->references('business_id')
						->on('business')
						->onDelete('cascade');
					$table->foreign('pcat_id')
						->references('pcat_id')
						->on('photos_category')
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
        Schema::drop('photos_business');
    }
}
