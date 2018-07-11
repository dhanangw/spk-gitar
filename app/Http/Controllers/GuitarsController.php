<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Excel;
use App\Guitars;
use App\FuzzyElectre;

class GuitarsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home() { 
        return view('welcome');
    }


    public function ranking(Request $request) { 
        //get guitars in the criteria range and set as array
        $guitars = Guitars::select('perf_rating_harga', 'perf_rating_kayu_body')->get()->toArray();
        
        //get linguistic variables from form
        $linguistics = [
            $request->input('harga'),
            $request->input('kualitas-kayu-bagian-body')
        ];
        
        //send to Fuzzy Electre Class
        $fuzzyElectre = new FuzzyElectre($guitars, $linguistics);

        //get result from fuzzy electre class
        $rank = $fuzzyElectre->ranking;
        $guitars = array();
        
        //if ranking != not empty then get guitars from guitars table by rank index
        if (!in_array(0, $rank)) {
            foreach (array_keys($rank) as $key => $value) {
                $guitars[$key] = Guitars::where('id', $value)->first();
            }   
        }
        
        //parse data to view
        $data = [
            'guitars' => $guitars
        ];
        
        return view('ranking', $data);
    }

    public function index() { 
        $guitar = Guitars::all();
        $data = [
            'guitars' => $guitar,
        ];


        return view('roster', $data);
    }

    public function view($id) { 
        $gitar = Guitars::where('id', $id)->first();
        $photo = explode(" | ", $gitar->images);

        $data = [
            'gitar' => $gitar,
            'photos' => $photo
        ];

        return view('viewDetails', $data);
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
                    'perf_rating_harga'         => $value->perfratinghargayangterjangkau,  
                    'perf_rating_kayu_body'     => $value->perfratingkualitaskayubody,    
                ]);

                if (empty($data)) {
                    break;
                }   
            }
        }    
    }
}
