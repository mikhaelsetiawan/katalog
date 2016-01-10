<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelTablePhotosCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos_category', function (Blueprint $table) {
            $table->increments('pcat_id');
						$table->unsignedInteger('business_id');
            $table->string('pcat_name',255);
						$table->tinyInteger('pcat_status')->default(1);
            $table->timestamps();
        });

			Schema::table('photos_category', function(Blueprint $table)
				{
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
        Schema::drop('photos_category');
    }
}
