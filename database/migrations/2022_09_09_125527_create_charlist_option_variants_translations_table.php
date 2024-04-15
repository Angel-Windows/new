<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharlistOptionVariantsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charlist_option_variants_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('charlist_option_variants_id');
            $table->string('locale')->index();
            $table->string('name');

            $table->unique(['charlist_option_variants_id', 'locale'],'char_opt_var_id');
            $table->foreign('charlist_option_variants_id', 'opt_var_id')->references('id')->on('dv_charlist_option_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('charlist_option_variants_translations');
    }
}
