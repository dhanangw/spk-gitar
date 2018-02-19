<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHighlightImageToGuitarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guitars', function (Blueprint $table) {
            //add highlight_image column to guitars table
            $table->string('highlight_image', 100)->after('images')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guitars', function (Blueprint $table) {
            //drop highlight_image column to guitars table
            $table->dropColumn(['highlight_image']);
        });
    }
}
