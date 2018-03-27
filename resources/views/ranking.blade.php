<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/ranking.css') }}">
    <title>Hasil Perhitungan SPK</title>
</head>
<body>
    @if (empty($guitars))
    <h1>kami tidak dapat menemukan gitar akustik <span> steel-string </span> yang sesuai dengan masukan anda</h1>
    @else
    <h1>5 Pilihan gitar akustik <span> steel-string </span> yang sesuai dengan pilihan anda</h1>
    <div class="wrapper">
        <div class="card-columns">
            @foreach ($guitars as $guitar)
            <a href="{{url('/'.$guitar->id.'/view')}}">
                <div class="card">
                    <img class="card-img-top img-fluid" src="{{ URL::asset('img/guitars/'.$guitar->highlight_image.'') }}" alt="Card image cap">
                    <div class="card-block">
                        <h4 class="card-title">{{$loop->iteration.'. '.$guitar -> merk.' '.$guitar->tipe}}</h4>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</body>
</html>