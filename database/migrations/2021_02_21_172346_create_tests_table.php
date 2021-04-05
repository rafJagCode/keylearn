<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tests', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('time');
      $table->integer('test_length');
      $table->integer('wpm');
      $table->integer('uncorrected_errors');
      $table->integer('all_errors');
      $table->integer('accuracy');
      $table->integer('score');
      $table
        ->foreignId('profile_id')
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
    Schema::dropIfExists('tests');
  }
}
