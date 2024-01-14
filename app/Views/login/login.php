<body class="bg-gradient-danger">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <!-- <div class="col-xl-10 col-lg-12 col-md-9"> -->

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block">
                                <img src="<?= base_url('public/img/login_image.png') ?>" alt="logo" width="500" height="600">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-balck-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <p>
                                        <?php if (!empty(session()->getFlashdata('gagal'))) { ?>
                                    <div class="alert alert-warning">
                                        <?php echo session()->getFlashdata('gagal') ?>
                                    </div>
                                <?php } ?>
                                </p>
                                <form method="POST" action="login/login_action" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username...">
                                    </div>
                                    <div class="form-group">
                                        <label style="display: inline;">Password <span style="float: right;">Lupa Password?</span></label>
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label text-black" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                                <hr>
                                <div class="container my-auto">
                                    <div class="copyright text-center my-auto">
                                        <span>Copyright &copy; SHOWROOM Sicepat Production 2022</span>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- </div> -->

        </div>

    </div>