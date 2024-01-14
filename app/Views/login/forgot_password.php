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

    <div class="container-fluid">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-8 text-center">
                <img src="<?= base_url('public/img/login-admin.png') ?>" alt="" width="90%">
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
                                <h3 class="h4 text-gray-900 mb-4">Forgot Password</h3>
                            </div>
                            <form class="login-user" id="login-user">
                                <div class="alert hide-element" id="alert-login">

                                </div>
                                <div class="form-group">
                                    <label><b>Email</b></label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fas fa-at"></i></div>
                                        </div>
                                        <input type="email" class="form-control form-control-lg" id="email" name="email" required>
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
                                    <button type="submit" class="btn btn-primary btn-block" id="btn-submit" style="background-color: #1f2164;border-color: #1f2164;">
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
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('public/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('public/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('public/js/sb-admin-2.min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $("#login-user").on('submit', function(e) {
                $("#btn-submit").attr('disabled', 'disabled');
                e.preventDefault();
                let data = $(this).serialize();
                $.ajax({
                    url: '<?= base_url('sendforgot') ?>',
                    type: 'post',
                    dataType: 'json',
                    data: data,
                    success: function(res) {
                        $("#btn-submit").removeAttr('disabled');
                        $("#alert-login").removeClass('alert-danger');
                        $("#alert-login").removeClass('alert-success');
                        $("#alert-login").removeClass('hide-element');
                        $("#alert-login").text(res.msg);
                        if (res.sukses == "1") {
                            $("#alert-login").addClass('alert-success');
                        } else {
                            $("#alert-login").addClass('alert-danger');
                        }
                    }
                })
                return false
            })
        })
    </script>
</body>

</html>