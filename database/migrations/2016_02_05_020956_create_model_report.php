<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->increments('report_id');
						$table->unsignedInteger('member_id');
						$table->unsignedInteger('reportcat_id');
						$table->tinyInteger("report_target_type");
						$table->unsignedInteger("report_target_id");
						$table->text("report_content");
						$table->tinyInteger('report_status')->default(1);
            $table->timestamps();
        });

			Schema::table('report', function(Blueprint $table) {
					$table->foreign('member_id')
						->references('member_id')
						->on('member')
						->onDelete('cascade');
					$table->foreign('reportcat_id')
						->references('reportcat_id')
						->on('report_category')
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
        Schema::drop('report');
    }
}
