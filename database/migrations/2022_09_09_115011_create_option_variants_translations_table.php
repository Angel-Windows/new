<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionVariantsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_variants_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('option_variants_id');
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['option_variants_id', 'locale']);
            $table->foreign('option_variants_id')->references('id')->on('dv_option_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('option_variants_translations');
    }
}
