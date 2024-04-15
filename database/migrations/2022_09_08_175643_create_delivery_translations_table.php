<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('delivery_id');
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['delivery_id', 'locale']);
            $table->foreign('delivery_id')->references('id')->on('dv_delivery')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('delivery_translations');
    }
}
