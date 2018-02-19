<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guitars extends Model
{
    protected $fillable = [
        'tanggal_ambil_data',
        'merk',
        'tipe', 
        'harga',
        'top_material', 
        'back_and_sides_material', 
        'bridge_material',
        'body_type',
        'bracing_pattern',
        'body_length',
        'body_width',
        'body_depth',
        'total_length',
        'body_finish',
        'body_binding',
        'pickguard',
        'saddle_material',
        'nut_material',
        'neck',
        'fingerboard',
        'fingerboard_radius',
        'nut_width',
        'scale_length',
        'tuning_machine',
        'color', 
        'rosette',
        'cutaway',
        'cutaway_type',
        'orientation',
        'neck_shape',
        'num_of_fret',
        'neck_finish',
        'pickups',
        'preamp', 
        'tuner',
        'control', 
        'connection', 
        'fingerboard_inlay', 
        'headstock_overlay',
        'fingerboard_binding',
        'neck_join_type',
        'string_spacing_at_bridge',
        'heel_length',
        'heel_cap_binding',
        'bridge_pin', 
        'buttons',
        'truss_rod_cover', 
        'sumber', 
        'keterangan',
        'tone',
        'images',
        'highlight_image'
     ];
}