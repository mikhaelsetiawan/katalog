<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelBusinessClaim extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_claim', function (Blueprint $table) {
            $table->increments('bclaim_id');
						$table->unsignedInteger('member_id');
						$table->unsignedInteger('business_id');
						$table->string('bclaim_role',25);
						$table->date('bclaim_start_date');
						$table->date('bclaim_end_date');
						$table->tinyInteger('bclaim_status')->default(1);
            $table->timestamps();
        });

			Schema::table('business_claim', function(Blueprint $table)
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
        Schema::drop('business_claim');
    }
}
