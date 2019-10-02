<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryCityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_city_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale');
            $table->string('name');
            $table->unsignedInteger('country_city_id');
            $table->foreign('country_city_id')->references('id')->on('country_cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_city_translations');
    }
}
