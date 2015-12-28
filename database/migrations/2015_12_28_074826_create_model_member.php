<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
						$table->increments('member_id');
						$table->string('member_name',255);
						$table->string('member_email',254)->unique();
						$table->string('member_username',100);
						$table->string('member_password',32);
						$table->date('member_birth_date');
						$table->char('member_gender', 1);
						$table->string('member_fb',100);
						$table->integer('member_coin');
						$table->timestamp('member_registered');
						$table->tinyInteger('member_status')->default(1);
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
        Schema::drop('member');
    }
}
