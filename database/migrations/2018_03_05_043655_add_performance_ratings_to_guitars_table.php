<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPerformanceRatingsToGuitarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guitars', function (Blueprint $table) {
            //add perf_rating_harga and perf_rating_kayu_body column to guitars table
            $table->string('perf_rating_harga', 10)->after('highlight_image')->nullable();
            $table->string('perf_rating_kayu_body', 10)->after('perf_rating_harga')->nullable();
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
            //drop perf_rating_harga and perf_rating_kayu_body column from guitars table
            $table->dropColumn(['perf_rating_harga','perf_rating_kayu_body']);
        });
    }
}
