<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndustryExperienceTranslationsTable extends Migration
{

    public function up()
    {
        Schema::create('industry_experience_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('experience_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('experience_id')->references('id')->on('industry_experiences')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('industry_experience_translations');
    }
}
