<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelExtCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_city', function (Blueprint $table) {
            $table->string('city_code',25);
						$table->string('province_code',25);
						$table->string('city_name',255);
						$table->timestamps();
						$table->primary('city_code');
        });

			Schema::table('ext_city', function(Blueprint $table)
				{
					$table->foreign('province_code')
						->references('province_code')
						->on('ext_province')
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
        Schema::drop('ext_city');
    }
}
