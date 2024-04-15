<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('products_id');
            $table->string('locale')->index();

            $table->string('name');
            $table->string('description');
            $table->string('body');

            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();

            $table->unique(['products_id', 'locale']);
            $table->foreign('products_id')->references('id')->on('dv_products')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('products_translations');
    }
}
