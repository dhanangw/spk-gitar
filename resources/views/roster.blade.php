<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/roster.css') }}">
    <title>Roster</title>
</head>
<body>
    <a href="{{ url('/') }}"><h1>SPK Gitar</h1></a>
    <h2>Pilihan Gitar Akustik <span> Steel-String </span></h2>
    <div class="wrapper">
        <div class="card-columns">
            @foreach ($guitars as $guitar)
            <a href="{{url('/'.$guitar->id.'/view')}}">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{ URL::asset('img/guitars/'.$guitar->highlight_image.'') }}" alt="Card image cap">
                    <div class="card-block">
                        <h4 class="card-title">{{$guitar -> merk.' '.$guitar->tipe}}</h4>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</body>
</html>