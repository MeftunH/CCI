<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('admin_panel_logo');
            $table->string('admin_panel_icon');
            $table->string('frontend_icon');
            $table->string('index_footer_logo');
            $table->string('non_index_footer_logo');
            $table->string('index_navbar_logo');
            $table->string('non_index_navbar_logo');
            $table->string('mail');
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
        Schema::dropIfExists('settings');
    }
}
