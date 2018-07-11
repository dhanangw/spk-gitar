<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form SPK Gitar</title>
    <link rel="stylesheet" href="{{ URL::asset('/css/form.css') }}">
</head>
<body>
    <div class="container">
        <a href="{{ url('/') }}"><h1 class="brand"> SPK Gitar </h1></a>
        <div class="wrapper">
            <div class="company-info">
                <h3>Cara Penggunaan:</h3>
                <ul>
                    <li>Masukkan tingkat kepentingan kriteria anda.</li>
                    <li>Semakin tinggi tingkat kepentingan suatu kriteria, maka kriteria tersebut semakin anda pertimbangkan dalam pemilihan steel string acoustic guitar </li>
                </ul>
            </div>
            <div class="contact">
                <h3>Masukkan tingkat kepentingan kriteria anda disini:</h3>
                <form action="{{ url('/ranking') }}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">                    

                    <p class="full">
                        <label>Harga yang Murah</label>
                        <select class="form-control" id="sel1" name="harga" required>
                            <option value="very high">Sangat Penting</option>
                            <option value="high">Penting</option>
                            <option value="medium">Biasa Saja</option>
                            <option value="low">Tidak Penting</option>
                            <option value="very low">Sangat Tidak Penting</option>
                        </select>
                    </p>

                    <p class="full">
                        <label>Kualitas Kayu Bagian Body</label>
                        <select class="form-control" id="sel1" name="kualitas-kayu-bagian-body" required>
                            <option value="very high">Sangat Penting</option>
                            <option value="high">Penting</option>
                            <option value="medium">Biasa Saja</option>
                            <option value="low">Tidak Penting</option>
                            <option value="very low">Sangat Tidak Penting</option>
                        </select>
                    </p>
                    
                    <p class="full"><input type="submit" value="Submit"></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>