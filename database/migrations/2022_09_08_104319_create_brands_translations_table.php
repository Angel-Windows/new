<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('brands_id');
            $table->string('locale')->index();
            $table->string('name');
            $table->longText('body');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();

            $table->unique(['brands_id', 'locale']);
            $table->foreign('brands_id')->references('id')->on('dv_brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('brands_translations');
    }
}
