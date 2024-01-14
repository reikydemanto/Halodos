<?= $this->include('include/header') ?>
<?= $this->include('include/sidebar') ?>
<?= $this->include('include/navbar') ?>

    <div class="container-fluid" style>
        <div class="row">
            <div class="col-md-12">
                <center><h1 style="color:black; font: weight 700px;">AYO LENGKAPI DATAMU!</h1></center>
            </div>    
        </div>
    

    <br><br>

    <div class="row"  style="font-size:25px;">
        <div class="col-md-4">
                <center><p style="font-weight:bold; color:black;">1 Data Diri</p></center>
                </div>
                <div class="col-md-4">
                <center><p>2 Pembayaran</p></center>
                </div>
                <div class="col-md-4">
                <center><p>3 Finalisasi Data</p></center>
                </div>
        </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="border-radius:20px; color: black; font-weight:bold; font-size: 20px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-label">Nama Lengkap</div>
                            <input type="text" class="form-control" style="margin-bottom: 25px;">
                           
                            <div class="form-label">Jenis Kelamin</div>
                            <input type="radio" id="html" name="fav_language" value="HTML">
                            <label for="html">Laki Laki</label>
                            <input type="radio" id="css" name="fav_language" value="CSS" style="margin-left: 60px;">
                            <label for="css">Perempuan</label><br>

                            <div class="form-label">Email</div>
                            <input type="text" class="form-control" style="margin-bottom: 25px;">

                            <div class="form-label">No.WhatsApp</div>
                            <input type="text" class="form-control" style="margin-bottom: 25px;">
                        
                        </div>
                        <div class="col-md-6">
                         
                                <div class="form-label">Perguruan Tinggi</div>
                                <input type="text" class="form-control" style="margin-bottom: 25px;">
                            
                           
                                <div class="form-label">Program Studi</div>
                                <input type="text" class="form-control" style="margin-bottom: 25px;">
                                <br><br><br>
                                <a class="btn btn-primary" href="akun2" role="button" style="width: 270px">SELANJUTNYA</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>
<?= $this->include('include/footer') ?>