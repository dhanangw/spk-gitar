<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuitarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guitars', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal_ambil_data');
            $table->string('merk', 50);
            $table->string('tipe', 50);
            $table->integer('harga');
            $table->string('top_material', 50);
            $table->string('back_and_sides_material', 50);
            $table->string('bridge_material', 50);
            $table->string('body_type', 50);
            $table->string('bracing_pattern', 50);
            $table->string('body_length', 50);
            $table->string('body_width', 50);
            $table->string('body_depth', 50);
            $table->string('total_length', 50);
            $table->string('body_finish', 50);
            $table->string('body_binding', 50);
            $table->string('pickguard', 100);
            $table->string('saddle_material', 50);
            $table->string('nut_material', 50);
            $table->string('neck', 50);
            $table->string('fingerboard', 50);
            $table->string('fingerboard_radius', 50);
            $table->string('nut_width', 50);
            $table->string('scale_length', 50);
            $table->string('tuning_machine', 50);
            $table->string('color', 150);
            $table->string('rosette', 50);
            $table->string('cutaway', 50);
            $table->string('cutaway_type', 50);
            $table->string('orientation', 50);
            $table->string('neck_shape', 50);
            $table->string('num_of_fret', 2);
            $table->string('neck_finish', 50);
            $table->string('pickups', 50);
            $table->string('preamp', 50);
            $table->string('tuner', 50);
            $table->string('control', 150);
            $table->string('connection', 50);
            $table->string('fingerboard_inlay', 50);
            $table->string('headstock_overlay', 50);
            $table->string('fingerboard_binding', 50);
            $table->string('neck_join_type', 50);
            $table->string('string_spacing_at_bridge', 50);
            $table->string('heel_length', 50);
            $table->string('heel_cap_binding', 50);
            $table->string('bridge_pin', 50);
            $table->string('buttons', 50);
            $table->string('truss_rod_cover', 50);
            $table->string('sumber', 300);
            $table->string('keterangan', 100);
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
        Schema::dropIfExists('guitars');
    }
}
