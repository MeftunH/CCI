<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaseStudyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_study_translations', function (Blueprint $table) {
            $table->id();
            $table->string('title',255)->nullable();
            $table->text('description')->nullable();
            $table->string('footer',255)->nullable();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('cs_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cs_id')->references('id')->on('case_studies')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('case_study_translations');
    }
}
