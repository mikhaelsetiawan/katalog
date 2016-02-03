<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelBusinessField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_field', function (Blueprint $table) {
            $table->increments('bfield_id');
						$table->string('bfield_name',255);
						$table->integer('bfield_parent');
						$table->string('bfield_rating',255);
						$table->tinyInteger('bfield_status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('business_field');
    }
}
