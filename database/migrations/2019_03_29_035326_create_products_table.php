<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('published')->default(0);
            $table->float('rating_cache')->unsigned()->default(3.0);
            $table->integer('rating_count')->unsigned()->default(0);
            $table->string('name');
            $table->string('slug');
            $table->float('pricing')->unsigned()->default(0.00);
            $table->string('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('icon')->nullable();
            $table->string('banner')->nullable();
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
        Schema::dropIfExists('products');
    }
}
