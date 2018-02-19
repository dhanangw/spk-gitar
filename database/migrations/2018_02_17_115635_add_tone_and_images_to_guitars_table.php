<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToneAndImagesToGuitarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guitars', function (Blueprint $table) {
            //add tone and images columns to guitars table
            $table->string('tone', 500)->after('keterangan');
            $table->string('images', 500)->after('tone');
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
            //drop tone and images columns from guitars table
            $table->dropColumn(['tone','images']);
        });
    }
}
