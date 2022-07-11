<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChevronOrdersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('chevron_orders', function (Blueprint $table) {
      $table->id();
      $table->integer('chevron_id')->unsigned();
      $table->integer('amount')->unsigned();
      $table->string('surname');
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
    Schema::dropIfExists('chevron_orders');
  }
}
