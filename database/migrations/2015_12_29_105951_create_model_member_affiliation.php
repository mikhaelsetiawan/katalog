<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelMemberAffiliation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_affiliation', function (Blueprint $table) {
            $table->increments('maff_id');
						$table->unsignedInteger('member_id');
						$table->unsignedInteger('business_id');
						$table->string('maff_role',25);
						$table->date('maff_start_date');
						$table->date('maff_end_date');
						$table->tinyInteger('maff_status')->default(1);
            $table->timestamps();
        });

			Schema::table('member_affiliation', function(Blueprint $table)
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
        Schema::drop('member_affiliation');
    }
}
