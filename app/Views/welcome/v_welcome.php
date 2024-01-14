<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>
    <style>
        .text-segoe {
            font-family: 'Segoe UI', Tahoma, 'Geneva', Verdana, sans-serif;
        }
    </style>
    <link href="<?= base_url('public/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/css/blog.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('public/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/css/aos.css') ?>" rel="stylesheet">
</head>

<body>
    <div class="container-fluid" style="margin-left: 0;margin-top: 0;padding-left: 0;padding-right: 0;width: 99% !important;">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 text-center">
                    <img src="<?= base_url('public/img/logo.png') ?>" style="width: 30%;" alt="">
                </div>
                <div class="col-4 text-center">

                </div>
                <div class="col-4 d-flex justify-content-end align-items-center pt-2 text-center text-segoe">
                    <a class="btn btn-outline-info" href="<?= base_url('login/dospem') ?>" style="border-radius: 20px;">Login Dosen</a>
                    <a class="btn btn-info ml-2 mr-4" href="<?= base_url('login') ?>" style="border-radius: 20px;">Login Mahasiswa</a>
                </div>
            </div>
        </header>

        <div class="jumbotron text-segoe text-white row" style="background: rgb(2,0,36);
								background: linear-gradient(90deg, rgba(2,0,36,1) 0%,
								rgba(42,157,180,1) 0%, rgba(90,90,221,1) 94%); padding: 30px;width: 101.5% !important;height:95vh">
            <div class="col-md-2">

            </div>
            <div class="col-md-4">
                <h1 style="margin-top: 100px;font-size: 50px" data-aos="fade-up">
                    Menyatukan Mahasiswa<br>
                    Dan Pengajar Dalam <br>
                    Proses Pembelajaran <br>
                    Yang Tak Terbatas
                </h1>
            </div>
            <div class="col-md-5">
                <img src="<?= base_url('public/img/landing-page-2.png') ?>" style="width: 100vh;margin-top: 25px" data-aos="fade-left">
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 80px;">
        <div class="row">
            <div class="col-md=6" style="width: 25%;">

            </div>
            <div class="col-md-6">
                <h2 class="text-primary" data-aos="fade-left"><strong>Apa itu Halodos ?</strong></h2>
                <p style="font-size: 20px" data-aos="fade-right">
                    HaloDos merupakan sebuah situs web pembelajaran yang berfungsi sebagai sarana komunikasi antara mahasiswa dengan dosen/ tenaga pengajar ahli
                    untuk berkonsultasi terkait materi perkuliahan. Situs ini memiliki beragam fitur
                    guna memudahkan mahasiswa untuk mencari dan bertemu oleh tenaga pengajar
                    ahli dibidangnya. Melalui situs ini diharapkan mahasiswa dapat berkonsultasi dengan tenaga pengajar ahli yang pada akhirnya dapat meningkatkan pemahaman
                    mahasiswa terkait bidang yang ia pelajari.
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-left: 0;margin-top: 0;padding-left: 0;padding-right: 0;background: rgb(2,0,36);
								background: linear-gradient(90deg, rgba(2,0,36,1) 0%,
								rgba(42,157,180,1) 0%, rgba(90,90,221,1) 94%); padding: 30px;margin-top: 60px;width: 100% !important;">
        <div class="row">
            <div class="col-md-12 text-center text-white">
                <h2 style="margin-top: 70px;margin-bottom: 70px;" data-aos="zoom-in-up">Self-Directed Learning (SDL) merupakan sebuah<br>ketrampilan belajar secara mandiri oleh peserta<br>didik. Individu
                    yang memiliki Self-Directed<br>Learning (SDL) tinggi terlihat sangat proaktif,<br>memiliki inisiatif tinggi, banyak ide dan<br>bertanggung jawab untuk selalu belajar.</h2>
            </div>
        </div>
    </div>

    <div class="container-fluid" style="margin-top: 65px;">
        <div class="row">
            <div class="col-md-12 text-center" style="color: #000;">
                <h1 data-aos="zoom-in-down"><strong>Tim Kami</strong></h1>
            </div>
            <div class="col-md-4 text-center" style="margin-top: 50px;" data-aos="fade-down">
                <img src="<?= base_url('public/icon/dev-1.png') ?>" alt="" style="width: 70%;">
            </div>
            <div class="col-md-4 text-center" style="margin-top: 50px;" data-aos="fade-down">
                <img src="<?= base_url('public/icon/dev-2.png') ?>" alt="" style="width: 70%;">
            </div>
            <div class="col-md-4 text-center" style="margin-top: 50px;" data-aos="fade-down">
                <img src="<?= base_url('public/icon/dev-3.png') ?>" alt="" style="width: 70%;">
            </div>

            <div class="col-md-2 text-center" style="margin-top: 120px;">
                <img src="<?= base_url('public/icon/logo-1.png') ?>" alt="" style="width: 75%;">
            </div>
            <div class="col-md-2 text-center" style="margin-top: 170px;">
                <img src="<?= base_url('public/icon/logo-2.png') ?>" alt="" style="width: 100%;">
            </div>
            <div class="col-md-2 text-center" style="margin-top: 150px;">
                <img src="<?= base_url('public/icon/logo-3.png') ?>" alt="" style="width: 100%;">
            </div>
            <div class="col-md-2 text-center" style="margin-top: 160px;">
                <img src="<?= base_url('public/icon/logo-4.png') ?>" alt="" style="width: 90%;">
            </div>
            <div class="col-md-2 text-center" style="margin-top: 165px;">
                <img src="<?= base_url('public/icon/logo-5.png') ?>" alt="" style="width: 90%;">
            </div>
            <div class="col-md-2 text-center" style="margin-top: 120px;">
                <img src="<?= base_url('public/icon/logo-6.png') ?>" alt="" style="width: 70%;">
            </div>
        </div>
    </div>



    <footer class="text-white" style="margin-left: 0;margin-top: 0;padding-left: 0;padding-right: 0;background: rgb(2,0,36);
								background: linear-gradient(90deg, rgba(2,0,36,1) 0%,
								rgba(42,157,180,1) 0%, rgba(90,90,221,1) 94%); padding: 30px;margin-top: 60px;width: 100% !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <h2 data-aos="zoom-in-right">
                        <strong>
                            Program Hibah<br>
                            PKM Karsa Cipta<br>
                            Tahun 2023
                        </strong>
                    </h2>
                </div>
                <div class="col-md-4" data-aos="fade-up">
                    <h5 class="text-center mt-3"><strong>INFORMASI</strong></h5>
                    <div class="row">
                        <div class="col-md-2 text-right">
                            <a href="https://maps.app.goo.gl/nTjJfiAapvhBitvP8" style="text-decoration: none;color: #fff;" target="_blank"><i class="fas fa-home fa-lg" style="color: #000"></i></a>
                        </div>
                        <div class="col-md-10">
                            <a href="https://maps.app.goo.gl/nTjJfiAapvhBitvP8" style="text-decoration: none;color: #fff;" target="_blank"><strong>STIKI Malang</strong></a><br>
                        </div>
                        <div class="col-md-2 text-center mt-1">
                            <a href="https://www.instagram.com/halodos.id" style="text-decoration: none;color: #fff;" target="_blank"><i class="fab fa-instagram fa-lg ml-2" style="color: #000"></i></a><br>
                        </div>
                        <div class="col-md-10 mt-1">
                            <a href="https://www.instagram.com/halodos.id" style="text-decoration: none;color: #fff;" target="_blank">@halodos.id</a><br>
                        </div>
                        <div class="col-md-2 text-right mt-1">
                            <a href="https://www.youtube.com/@HaloDos" style="text-decoration: none;color: #fff;" target="_blank"><i class="fab fa-youtube fa-lg" style="color: #000"></i></a>
                        </div>
                        <div class="col-md-10 mt-1">
                            <a href="https://www.youtube.com/@HaloDos" style="text-decoration: none;color: #fff;" target="_blank">HaloDos</a><br>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" data-aos="zoom-in-left">
                    <h5 class="mt-3"><strong>TENTANG</strong></h5>
                    <p>
                        Program hibah PKM Tahun 2023
                        yang membantu komunikasi antara
                        mahasiswa dengan dosen/ tenaga
                        pengajar ahli
                        untuk berkonsultasi
                        terkait materi perkuliahan
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?= base_url('public/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('public/js/holder.min.js') ?>"></script>
    <script src="<?= base_url('public/js/sb-admin-2.min.js') ?>"></script>
    <script src="<?= base_url('public/js/aos.js') ?>"></script>
</body>
<script>
    AOS.init();
</script>

</html>