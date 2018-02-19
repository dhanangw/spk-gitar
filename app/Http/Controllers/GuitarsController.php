<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Excel;
use App\Guitars;

class GuitarsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() { 
        $data = [
            'guitars' => Guitars::all(),
        ];

        return view('roster', $data);
    }

    public function choose() { 
        return view('form');
    }

    public function addHighlightImage (){
        $images = Guitars::pluck('images')->toArray();
        $image = array();

        foreach ($images as $key => $value) {
            $pieces = explode(" | ", $value);
            $image[$key] = $pieces[0];
        }

        for ($i=0; $i < count($image); $i++) {
            $key = $i + 1;
            Guitars::where('id', $key)->update([
                'highlight_image' => $image[$i]
            ]);
        }
    }

    public function populateDatabase () {
        $data = Excel::load("\Book1.xlsx", function($reader) {})->get();
        if(!empty($data) && $data->count()){
            foreach ($data as $key => $value) {
                $insertdata = Guitars::create ([
                    'tanggal_ambil_data'        => $value->tanggalambildata,
                    'merk'                      => $value->merk,
                    'tipe'                      => $value->tipe, 
                    'harga'                     => $value->harga,
                    'top_material'              => $value->topmaterial, 
                    'back_and_sides_material'   => $value->backandsidematerial, 
                    'bridge_material'           => $value->bridgematerial,
                    'body_type'                 => $value->bodytype,
                    'bracing_pattern'           => $value->bracingpattern,
                    'body_length'               => $value->bodylength,
                    'body_width'                => $value->bodywidth,
                    'body_depth'                => $value->bodydepth,
                    'total_length'              => $value->totallength,
                    'body_finish'               => $value->bodyfinish,
                    'body_binding'              => $value->bodybinding,
                    'pickguard'                 => $value->pickguard,
                    'saddle_material'           => $value->saddlematerial,
                    'nut_material'              => $value->nutmaterial,
                    'neck'                      => $value->neck,
                    'fingerboard'               => $value->fingerboard,
                    'fingerboard_radius'        => $value->fingerboardradius,
                    'nut_width'                 => $value->nutwidth,
                    'scale_length'              => $value->scalelength,
                    'tuning_machine'            => $value->tuningmachine,
                    'color'                     => $value->color, 
                    'rosette'                   => $value->rosette,
                    'cutaway'                   => $value->cutaway,
                    'cutaway_type'              => $value->cutawaytype,
                    'orientation'               => $value->orientation,
                    'neck_shape'                => $value->neckshape,
                    'num_of_fret'               => $value->numoffret,
                    'neck_finish'               => $value->neckfinish,
                    'pickups'                   => $value->pickups,
                    'preamp'                    => $value->preamp, 
                    'tuner'                     => $value->tuner,
                    'control'                   => $value->control, 
                    'connection'                => $value->connection, 
                    'fingerboard_inlay'         => $value->fingerboardinlay, 
                    'headstock_overlay'         => $value->headstockoverlay,
                    'fingerboard_binding'       => $value->fingerboardbinding,
                    'neck_join_type'            => $value->neckjointtype,
                    'string_spacing_at_bridge'  => $value->stringspacingatbridge,
                    'heel_length'               => $value->heellength,
                    'heel_cap_binding'          => $value->heelcapbinding,
                    'bridge_pin'                => $value->bridgepin, 
                    'buttons'                   => $value->buttons,
                    'truss_rod_cover'           => $value->trussrodcover, 
                    'sumber'                    => $value->sumber,
                    'keterangan'                => $value->keterangan,
                    'tone'                      => $value->tone, 
                    'images'                    => $value->images,  
                ]);

                if (empty($data)) {
                    break;
                }   
            }
        }    
    }
}