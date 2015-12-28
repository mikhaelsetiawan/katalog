<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelBuilding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building', function (Blueprint $table) {
            $table->increments('building_id');
						$table->unsignedInteger('business_id');
						$table->string('city_code',25);
						$table->string('building_name',255);
						$table->text('building_address');
						$table->string('building_lat',25);
						$table->string('building_lng',25);
						$table->tinyInteger('building_status')->default(1);
            $table->timestamps();
        });

			Schema::table('building', function(Blueprint $table)
				{
					$table->foreign('business_id')
						->references('business_id')
						->on('business')
						->onDelete('cascade');
					$table->foreign('city_code')
						->references('city_code')
						->on('ext_city')
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
        Schema::drop('building');
    }
}
