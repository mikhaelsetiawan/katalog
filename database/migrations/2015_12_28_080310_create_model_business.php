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
            $table->unsignedInteger('member_id');
						$table->string('business_name',255);
						$table->string('business_email',254)->unique();
						$table->tinyInteger('business_status')->default(1);
            $table->timestamps();
        });

			Schema::table('business', function(Blueprint $table)
				{
					$table->foreign('member_id')
						->references('member_id')
						->on('member')
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
