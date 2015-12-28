<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelExtProvince extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ext_province', function (Blueprint $table) {
						$table->string('province_code',25);
						$table->string('country_code',25);
						$table->string('province_name',255);
						$table->primary('province_code');
            $table->timestamps();
        });

			Schema::table('ext_province', function(Blueprint $table)
				{
					$table->foreign('country_code')
						->references('country_code')
						->on('ext_country')
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
        Schema::drop('ext_province');
    }
}
