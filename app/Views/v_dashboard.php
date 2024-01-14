<?= $this->include('include/header') ?>
<?= $this->include('include/sidebar') ?>
<?= $this->include('include/navbar') ?>


<div class="<?= ((count($konsul) == 0) ? 'text-center' : '') ?>" style="background: rgb(92,222,229);
background: linear-gradient(90deg, rgba(92,222,229,1) 34%, rgba(3,79,174,1) 96%);padding-top: 15px;padding-bottom: 15px;margin-top: -22px">
    <?php if (count($konsul) == 0) { ?>
        <h1 style="color: #fff;"><strong>Selamat Datang <?= ucwords(session()->get('fullname')) ?> !</strong></h1>
    <?php } else { ?>
        <h3 style="color: #fff;margin-left: 30px"><strong>Kelas yang akan datang!</strong></h3>
        <div class="container">
            <div class="row">
                <?php foreach ($konsul as $ks) { ?>
                    <div class="col-md-12 mb-3">
                        <div class="row" style="background-color: white; border-radius:20px;">
                            <div class="col-md-2">
                                <div class="card-body text-center">
                                    <img class="img-profile rounded-circle" src="<?= base_url('public/img/' . ((session()->get('role') == 'dospem') ? 'user-' : 'dospem-') . $ks['dosen_jenkel'] . '.png') ?>" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card-body" style="margin-top: 15px;">
                                    <a>Topik</a>
                                    <br>
                                    <a>Mata Kuliah</a>
                                    <br>
                                    <a><?= ((session()->get('role') == 'dospem') ? 'Mahasiswa' : 'Dosen Ahli') ?></a>
                                    <br>
                                    <a>Waktu</a>
                                    <br>
                                    <a>Kampus</a>
                                    <br>
                                    <a>Program Studi</a>
                                    <?php if ($ks['status'] == 'reject') { ?>
                                        <br>
                                        <a>Alasan Batal</a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body" style="margin-top: 15px;">
                                    <a>: <?= $ks['subtopicname'] ?></a>
                                    <br>
                                    <a>: <?= $ks['topicname'] ?></a>
                                    <br>
                                    <a>: <?= ((session()->get('role') == 'dospem') ? $ks['fullname'] : $ks['dosenname']) ?></a>
                                    <br>
                                    <a>: <?= date('d F Y', strtotime($ks['tanggal'])) ?> | <?= date("H:i", strtotime($ks['jamfrom'])) ?>-<?= date("H:i", strtotime($ks['jamto'])) ?> WIB</a>
                                    <br>
                                    <a>: <?= $ks[((session()->get('role') == 'dospem') ? 'kampusname' : 'dosenkampusname')] ?></a>
                                    <br>
                                    <a>: <?= $ks[((session()->get('role') == 'dospem') ? 'prodiname' : 'dosenprodiname')] ?></a>
                                    <?php if ($ks['status'] == 'reject') { ?>
                                        <br>
                                        <a>: <?= $ks['reason'] ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-md-2" style="align-items: center;">

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
<div class="container-fluid mt-4">
    <form id="form-profile">
        <div class="row" id="form-satu">
            <div class="col-md-12">
                <h1>PROFILE</h1>
                <hr>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label><?= ((session()->get('role') == 'dospem') ? 'NIM' : 'NIP') ?></label>
                    <input type="text" class="form-control" id="code" name="code" value="<?= $row['usercode'] ?>" style="width: 90%;" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="hidden" name="id" value="<?= $row['userid'] ?>">
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $row['fullname'] ?>" style="width: 90%;" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Perguruan Tinggi</label>
                    <select name="namakampus" id="namakampus" class="form-control select2" style="width: 90%;" disabled>
                        <?php if ($row['kampusname'] != null && $row['kampusname'] != '') { ?>
                            <option value="<?= $row['kampusid'] ?>" selected><?= $row['kampusname'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Jenis Kelamin</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jeniskelamin" id="inlineRadio1" value="lakilaki" <?= (($row['jeniskelamin'] == 'lakilaki') ? 'checked' : '') ?> disabled>
                        <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jeniskelamin" id="inlineRadio2" value="perempuan" <?= (($row['jeniskelamin'] == 'perempuan') ? 'checked' : '') ?>>
                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Program Studi</label><br>
                    <select name="prodiname" id="prodiname" class="form-control select2" style="width: 90%;" <?= (($row['fullname'] != '') ? 'disabled' : 'disabled') ?>>
                        <?php if ($row['fullname'] != '') { ?>
                            <option value="<?= $row['prodiid'] ?>" selected><?= $row['prodiname'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email" name="email" style="width: 90%;" value="<?= $row['email'] ?>" disabled>
                    <input type="hidden" name="email_lama" value="<?= $row['email'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>No Whatsapp</label>
                    <input type="text" class="form-control" id="phone" name="phone" style="width: 90%;" value="<?= (($row['phonenumber'] == '') ? "62" : $row['phonenumber']) ?>" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <a href="<?= base_url('profile') ?>" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </form>
</div>

<?= $this->include('include/footer') ?>