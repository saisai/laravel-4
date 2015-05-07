<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TbApply extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_apply', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 500);
			$table->string('link', 500);
			$table->string('from_which_webstie', 500);
			$table->integer('apply');
			$table->integer('detail');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_apply');
	}

}
