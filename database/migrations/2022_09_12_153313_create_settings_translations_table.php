<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('settings_id');
            $table->string('locale')->index();

            $table->string('footText');
            $table->string('copir');
            $table->string('address');

            $table->unique(['settings_id', 'locale']);
            $table->foreign('settings_id')->references('id')->on('dv_settings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('settings_translations');
    }
}
