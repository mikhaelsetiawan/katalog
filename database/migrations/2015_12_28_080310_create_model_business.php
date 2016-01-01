<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelBusiness extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->increments('business_id');
						$table->unsignedInteger('building_id');
						$table->unsignedInteger('bfield_id');
						$table->string('business_name',255);
						$table->string('business_email',254)->unique();
						$table->text('business_url');
						$table->integer('business_parent');
						$table->tinyInteger('business_status')->default(1);
						$table->timestamps();
        });

			Schema::table('business', function(Blueprint $table)
				{
					$table->foreign('building_id')
						->references('building_id')
						->on('building')
						->onDelete('cascade');
					$table->foreign('bfield_id')
						->references('bfield_id')
						->on('business_field')
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
        Schema::drop('business');
    }
}
