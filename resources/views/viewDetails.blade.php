<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('/css/viewDetails.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/slick/slick-theme.css') }}"/>
    <title>SPK Gitar</title>
</head>

<body>
    <!-- Header !-->
    <header id="showcase" class="grid">
            <div class="photos">
                @foreach ($photos as $photo)
                <div><img src="{{ URL::asset('img/guitars/'.$photo.'/') }}" alt="{{$photo}}"></div>
                @endforeach
            </div>
    </header>



    <!-- main area !-->
    <main id="main">
        <!-- section a -->
        <section id="section-a" class="grid">
            <div class="content-wrap">
                <h2 class="content-title">{{$gitar -> merk.' '.$gitar->tipe}}</h2>
                <div class="content-text">
                    <table class="table table-bordered table-dark table-responsive">
                        <tr>
                            <td>Tone:</td>
                            <td >{{$gitar -> tone }}</td>
                        </tr>
                        <tr>
                            <td>Top Material:</td>
                            <td >{{$gitar -> top_material }}</td>
                        </tr>
                        <tr>
                            <td>Harga:</td>
                            <td >Rp. {{number_format($gitar -> harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Back and Sides Material:</td>
                            <td >{{$gitar -> back_and_sides_material }} </td>
                        </tr>
                        <tr>
                            <td>Body Type:</td>
                            <td >{{$gitar -> body_type }} </td>
                        </tr>
                        <tr>
                            <td>Body Length: </td>
                            <td >{{$gitar -> body_length }} </td>
                        </tr>
                        <tr>
                            <td>Body Width: </td>
                            <td >{{$gitar -> body_width }}</td>
                        </tr>
                        <tr>
                            <td>Body Depth:  </td>
                            <td >{{$gitar -> body_depth }}</td>
                        </tr>
                        <tr>
                            <td>Bracing Pattern: </td>
                            <td >{{$gitar -> bracing_pattern }}</td>
                        </tr>
                        <tr>
                            <td>Bridge Material: </td>
                            <td >{{$gitar -> bridge_material }} </td>
                        </tr>
                        <tr>
                            <td>Saddle Material: </td>
                            <td >{{$gitar -> saddle_material }} </td>
                        </tr>
                        <tr>
                            <td>Body Finish: </td>
                            <td >{{$gitar -> body_finish }} </td>
                        </tr>
                        <tr>
                            <td>Pickguard: </td>
                            <td >{{$gitar -> pickguard }} </td>
                        </tr>
                        <tr>
                            <td>Rosette: </td>
                            <td >{{$gitar -> rosette }} </td>
                        </tr>
                        <tr>
                            <td>Cutaway: </td>
                            <td >{{$gitar -> cutaway}} </td>
                        </tr>
                        <tr>
                            <td>Cutaway Type: </td>
                            <td >{{$gitar -> cutaway_type}} </td>
                        </tr>
                        <tr>
                            <td>Body Binding: </td>
                            <td >{{$gitar -> body_binding }} </td>
                        </tr>
                        <tr>
                            <td>Button Material: </td>
                            <td >{{$gitar -> buttons }}</td>
                        </tr>
                        <tr>
                            <td>String Spacing Distance at Bridge: </td>
                            <td >{{$gitar -> string_spacing_at_bridge }}</td>
                        </tr>
                        <tr>
                            <td>Bridge Pin Material: </td>
                            <td >{{$gitar -> bridge_pin }}</td>
                        </tr>
                        <tr>
                            <td>Neck Material: </td>
                            <td >{{$gitar -> neck }}</td>
                        </tr>
                        <tr>
                            <td>Neck Shape: </td>
                            <td >{{$gitar -> neck_shape }}</td>
                        </tr>
                        <tr>
                            <td>Fingerboard:</td>
                            <td >{{$gitar -> fingerboard }}</td>
                        </tr>
                        <tr>
                            <td>Fingerboard:</td>
                            <td >{{$gitar -> fingerboard }}</td>
                        </tr>
                        <tr>
                            <td>Fingerboard Radius:</td>
                            <td >{{$gitar -> fingerboard_radius }}</td>
                        </tr>
                        <tr>
                            <td>Nut Material:</td>
                            <td >{{$gitar -> nut_material }}</td>
                        </tr>
                        <tr>
                            <td>Nut Width:</td>
                            <td >{{$gitar -> nut_width }}</td>
                        </tr>
                        <tr>
                            <td>Scale Length:</td>
                            <td >{{$gitar -> scale_length }}</td>
                        </tr>
                        <tr>
                            <td>Tuning Machine: </td>
                            <td >{{$gitar -> tuning_machine }}</td>
                        </tr>
                        <tr>
                            <td>Truss Rod Cover: </td>
                            <td >{{$gitar -> truss_rod_cover }}</td>
                        </tr>
                        <tr>
                            <td>Number of Frets: </td>
                            <td >{{$gitar -> num_of_fret }} </td>
                        </tr>
                        <tr>
                            <td>Neck Finish: </td>
                            <td >{{$gitar -> neck_finish }} </td>
                        </tr>
                        <tr>
                            <td>Fingerboard Inlay: </td>
                            <td >{{$gitar -> fingerboard_inlay }} </td>
                        </tr>
                        <tr>
                            <td>Headstock overlay: </td>
                            <td >{{$gitar -> headstock_overlay }} </td>
                        </tr>
                        <tr>
                            <td>Fingerboard Binding: </td>
                            <td >{{$gitar -> fingerboard_binding }} </td>
                        </tr>
                        <tr>
                            <td>Neck Joint Type:</td>
                            <td >{{$gitar -> neck_join_type }} </td>
                        </tr>
                        <tr>
                            <td>Heel Length:</td>
                            <td >{{$gitar -> heel_length }} </td>
                        </tr>
                        <tr>
                            <td>Heel Length:</td>
                            <td >{{$gitar -> heel_length }} </td>
                        </tr>
                        <tr>
                            <td>Heel Cap Binding:</td>
                            <td >{{$gitar -> heel_cap_binding }} </td>
                        </tr>
                        <tr>
                            <td>Pickups:</td>
                            <td >{{$gitar -> pickups }} </td>
                        </tr>
                        <tr>
                            <td>Preamp:</td>
                            <td >{{$gitar -> preamp }} </td>
                        </tr>
                        <tr>
                            <td>Tuner:</td>
                            <td >{{$gitar -> tuner }} </td>
                        </tr>
                        <tr>
                            <td>Control:</td>
                            <td >{{$gitar -> control }} </td>
                        </tr>
                        <tr>
                            <td>Connection:</td>
                            <td >{{$gitar -> connection }} </td>
                        </tr>
                        <tr>
                            <td>Color:</td>
                            <td >{{$gitar -> color }} </td>
                        </tr>
                        <tr>
                            <td>Orientation:</td>
                            <td >{{$gitar -> orientation }} </td>
                        </tr>
                        <tr>
                            <td>Total Length:</td>
                            <td >{{$gitar -> total_length }} </td>
                        </tr>
                        <tr>
                            <td>sumber:</td>
                            <td >{{$gitar -> sumber }} </td>
                        </tr>
                        <tr>
                            <td>keterangan:</td>
                            <td >{{$gitar -> keterangan }} </td>
                        </tr>
                    </table>
                    <p>*not available: data tidak ditemukan</p>
                </div>
            </div>
        </section>
    </main>

    <!-- footer -->
    <footer id="main-footer">
        
    </footer>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('/slick/slick.min.js') }}  "></script>

    <script type="text/javascript">
    $(document).ready(function(){
      $('.photos').slick({
        
      });
    });
    </script>

</body>


</html>