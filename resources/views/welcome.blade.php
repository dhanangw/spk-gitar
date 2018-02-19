<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/styles.css') }}">
    <title>SPK Gitar</title>
</head>

<body>
    <!-- Header !-->
    <header id="showcase" class="grid">
        <div class="bg-image"></div>
        <div class="content-wrap">
            <h1>Welcome To SPK Gitar</h1>
            <p>Temukan Gitar Akustik Steel-String Anda Disini.</p>
            <a href="{{url('/choose')}}" class="btn">Pilih Sekarang</a>
        </div>
    </header>



    <!-- main area !-->
    <main id="main">
        <!-- section a -->
        <section id="section-a" class="grid">
            <div class="content-wrap">
                <h2 class="content-title">Sistem Pendukung Keputusan Pemilihan Steel-String Acoustic Guitar</h2>
                <div class="content-text">
                    <p>Website ini dibangun untuk membantu menyelesaikan masalah pemilihan gitar akustik steel-string, yang dimana semakin lama semakin sulit karena harga gitar yang terus naik dan Produsen yang terus membuat lini produk baru.
                    Website ini dibangun dengan memperhatikan pertimbangan Luthier dan Gitaris-gitaris serta mengaplikasikan metode perankingan mutakhir dalam proses pemilihannya</p>
                </div>
            </div>
        </section>

        

        <!-- section c -->
        <section id="section-c" class="grid">
            <div class="content-wrap">
                <h2 class="content-title">Metodologi Pengerjaan</h2>
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Pengumpulan Data
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                Meliputi studi literatur kriteria pemilihan gitar akustik steel string, wawancara dengan luthier, kuesioner ke gitaris-gitaris serta pengumpulan data spesifikasi gitar.  <a href="{{url('/roster')}}">Click disini</a> untuk melihat data gitar yang digunakan sebagai alternatif pemilihan.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Pengolahan Data
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                Data dan Informasi yang didapat pada langkah sebelumnya diolah untuk menentukan kriteria pemilihan steel-string acoustic guitar mana yang benar-benar digunakan pembeli pada dunia nyata.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Analisis Fuzzy Electre I
                                </button>
                            </h5>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                Fuzzy Electre I adalah metode perankingan mutakhir yang dapat mepertimbangkan bobot kriteria yang tidak sama dan penilaian manusia yang tidak eksak. Analisis Fuzzy Electre I bertujuan untuk mengadaptasi metode ini untuk penyelesaian masalah pemilihan steel-string acoustic guitar.
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                            <h5 class="mb-0">
                                <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                                Perancangan & Implementasi Sistem
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                Merancang input dan output sistem. Sistem diimplementasikan menggunakan framework Laravel.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- section d -->
        <section id="section-d" class="grid">
            <div class="box">
                <h2 class="content-title">Terima Kasih kepada:</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia saepe aliquam autem quia explicabo delectus
                    error doloribus odit, quae corporis.</p>
            </div>
            <div class="box">
                <p>Website ini dibangun sebagai bagian dari tugas skripsi. 
                </p>
            </div>
        </section>
    </main>

    <!-- footer -->
    <footer id="main-footer">
        <div>a project by
            <a href="#dhanangw.com" target="_blank">dhanangw</a>
        </div>
    </footer>

    <!-- scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>


</html>