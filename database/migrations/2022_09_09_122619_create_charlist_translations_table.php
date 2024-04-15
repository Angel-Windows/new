<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharlistTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charlist_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('charlist_id');
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['charlist_id', 'locale']);
            $table->foreign('charlist_id')->references('id')->on('dv_charlist')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('charlist_translations');
    }
}
