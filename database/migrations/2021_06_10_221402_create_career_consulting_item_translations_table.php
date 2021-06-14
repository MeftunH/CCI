<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerConsultingItemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_consulting_item_translations', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('item_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('item_id')->references('id')->on('career_consulting_items')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('career_consulting_item_translations');
    }
}
