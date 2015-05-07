<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbApplyFor extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */	 
	public function up()
	{
		Schema::create('tb_apply_for', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
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
		Schema::drop('tb_apply_for');
	}

}
