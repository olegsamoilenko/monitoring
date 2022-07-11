<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailySummaryCarsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('daily_summary_cars', function (Blueprint $table) {
      $table->id();
      $table->string('number')->unique();
      $table->string('type');
      $table->string('brand');
      $table->string('model')->nullable();
      $table->string('color');
      $table->text('comment')->nullable();
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
    Schema::dropIfExists('daily_summary_cars');
  }
}
