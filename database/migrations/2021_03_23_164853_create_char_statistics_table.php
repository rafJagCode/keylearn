<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharStatisticsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('char_statistics', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->char('char');
			$table->double('time');
			$table->boolean('correct');
			$table
				->foreignId('test_id')
				->constrained()
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
		Schema::dropIfExists('char_statistics');
	}
}
