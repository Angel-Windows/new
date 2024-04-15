<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsTable extends Migration
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
            $table->integer('rating_sum');
            $table->integer('votes');
            $table->string('slug');
            $table->string('name');
            $table->string('code');
            $table->string('description');
            $table->text('body');
            $table->text('specification')->nullable();
            $table->float('price')->default(0);
            $table->float('oldPrice')->nullable();
            $table->tinyInteger('in_stock')->default(1);
            $table->tinyInteger('main_img');
            $table->text('imgs');
            $table->text('alike')->nullable();
            $table->tinyInteger('sale');
            $table->tinyInteger('discount')->nullable();
            $table->tinyInteger('new')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
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
        //
    }
}
