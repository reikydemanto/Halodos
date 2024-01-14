<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Halodos - <?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('public/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('public/css/sb-admin-2.min.css') ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container-fluid" style="padding-left: 0;margin-left: 0;">
        <!-- Outer Row -->
        <div class="row" style="padding-left: 0;margin-left: 0;">
            <div class="col-xl-6 col-lg-6" style="padding-left: 0;margin-left: 0;">
                <img src="<?= base_url('public/img/login-' . $role . '.png') ?>" alt="" width="92%">
            </div>
            <div class="col-xl-1 col-lg-1">
            </div>
            <div class="col-xl-4 col-lg-4">
                <div class="text-center my-3">
                    <img src="<?= base_url('public/img/halodos-logo.png') ?>" alt="" width="300px">
                </div>
                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="p-5">
                            <div class="text-center">
                                <h3 class="h4 text-gray-900 mb-4">Register Page</h3>
                            </div>
                            <form class="login-user" id="login-user">
                                <div class="alert hide-element" id="alert-login">

                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label><b><?= (($role == 'dospem') ? 'NIP' : 'NIM') ?></b></label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-user-tag"></i>
                                                </div>
                                            </div>
                                            <input type="number" class="form-control form-control-lg" id="code" name="code" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><b>Email</b></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-at"></i>
                                            </div>
                                        </div>
                                        <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><b>Password</b></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend" style="cursor: pointer" onclick="show_password('1')">
                                            <div class="input-group-text">
                                                <i id="icon-pass-1" class="fas fa-eye"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control form-control-lg" id="password-1" name="password" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><b>Konfirmasi Password</b></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend" style="cursor: pointer" onclick="show_password('2')">
                                            <div class="input-group-text">
                                                <i id="icon-pass-2" class="fas fa-eye"></i>
                                            </div>
                                        </div>
                                        <input type="password" class="form-control form-control-lg" id="password-2" name="password_confirmation" required>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                <div class="text-center">
                                    <input type="hidden" name="tipe" value="<?= $role ?>">
                                    <button type="submit" class="btn btn-primary btn-block" style="background-color: #1f2164;border-color: #1f2164;">
                                        Continue
                                    </button>
                                </div>
                            </form>
                            <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-1 col-lg-1">

            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('public/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('public/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('public/js/sb-admin-2.min.js') ?>"></script>

</body>
<script>
    $(document).ready(function() {
        $("#login-user").on('submit', function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                url: '<?= base_url("registerprocess") ?>',
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(res) {
                    let pesan = "Username atau password salah";
                    $("#alert-login").removeClass('alert-danger');
                    $("#alert-login").removeClass('alert-success');
                    if (res.sukses == 1) {
                        pesan = "Register berhasil"
                        $("#alert-login").addClass('alert-success');
                        $("#alert-login").text(pesan);
                        $("#alert-login").removeClass('hide-element');
                        let tipe = "<?= $role ?>";
                        let links = "";
                        if (tipe == 'dospem') {
                            links = "<?= base_url('login/dospem') ?>"
                        } else {
                            links = "<?= base_url('login') ?>"
                        }
                        window.location.href = links
                    } else {
                        if (res.msg != undefined) {
                            pesan = res.msg;
                        }
                        $("#alert-login").addClass('alert-danger');
                        $("#alert-login").text(pesan);
                        $("#alert-login").removeClass('hide-element');
                    }
                }
            })
            return false;
        })
    });

    function show_password(id) {

        let pass = $("#password-" + id).attr('type');
        $("#icon-pass-" + id).removeClass('fa-eye');
        $("#icon-pass-" + id).removeClass('fa-eye-slash');
        if (pass == 'password') {
            $("#password-" + id).attr('type', 'text');
            $("#icon-pass-" + id).addClass('fa-eye-slash');
        } else {
            $("#password-" + id).attr('type', 'password');
            $("#icon-pass-" + id).addClass('fa-eye');
        }
    }
</script>

</html>