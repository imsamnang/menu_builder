<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreePostsTable extends Migration
{

public function up()
{
  Schema::create('free_posts', function (Blueprint $table) {
    $table->increments('id');
    $table->string('title');
    $table->string('bedroom');
    $table->string('bathroom');
    $table->string('facing');
    $table->string('size');
    $table->float('price');
    $table->integer('gallery_id')->unsigned();
    $table->string('name');
    $table->string('phone');
    $table->string('email');
    $table->string('city');
    $table->string('district');
    $table->string('commune');
    $table->string('location');
    $table->timestamps();
  });
}

public function down()
{
    Schema::dropIfExists('free_posts');
}
}
