<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeatureTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('features_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('features_id');
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['features_id', 'locale']);
            $table->foreign('features_id')->references('id')->on('dv_features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('features_translations');
    }
}
