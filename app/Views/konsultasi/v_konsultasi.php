<?= $this->include('include/header') ?>
<?= $this->include('include/sidebar') ?>
<?= $this->include('include/navbar') ?>
<style>
    .dropup {
        position: relative;
        display: inline-block;
    }

    .dropup-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        bottom: 50px;
        z-index: 1;
    }

    .dropup-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .show-dropup {
        display: block;
    }
</style>

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
                                <div style="margin-bottom: 30px;"></div>
                                <?php if (session()->get('role') == 'dospem') { ?>
                                    <a href="#" onclick="modalForm('Jadwalkan Sesi', '<?= base_url('konsultasi/form-schedule/' . $ks['konsulid']) ?>')" class="btn btn-warning mb-2 <?= (($ks['status'] == 'reject' || $ks['status'] == 'insert') ? "hide-element" : "") ?>" style="width: 100%;" id="jadwal-sesi-<?= $ks['konsulid'] ?>">Jadwalkan Sesi</a><br>
                                <?php } ?>
                                <a href="<?= $ks['link'] ?>" class="btn btn-success mb-2 <?= (($ks['status'] == 'reject') ? "hide-element" : "") ?>" style="width: 100%;" id="do-sesi-<?= $ks['konsulid'] ?>">Lakukan Sesi</a><br>
                                <?php if (session()->get('role') == 'dospem') { ?>
                                    <a href="#" onclick="modalForm('Batalkan Sesi', '<?= base_url('konsultasi/form-reject/' . $ks['konsulid']) ?>')" class="btn btn-danger mb-2 <?= (($ks['status'] == 'reject' || $ks['status'] == 'insert') ? "hide-element" : "") ?>" style="width: 100%;" id="batal-sesi-<?= $ks['konsulid'] ?>">Batalkan Sesi</a><br>
                                <?php } ?>
                                <a href="https://wa.me/<?= ((session()->get('role') == 'dospem') ? $ks['user_phone'] : $ks['dosen_phone']) ?>" target="_blank" style="width: 100%;" class="btn btn-secondary mb-2"><i class="far fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
<div class="container mt-3">
    <div class="row" id="load_topic">
    </div>
</div>

<?= $this->include('include/footer') ?>
<script>
    $(document).ready(function() {
        <?php if (session()->get('role') == 'user') { ?>
            load_topic();
        <?php } ?>
    })

    function load_topic() {
        $.ajax({
            url: '<?= base_url("topic/getmaster/alldata") ?>',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                let result = res.result;
                $("#load_topic").html(`
                <div class="col-md-12">
                    <h3><strong>Pilih topik yang ingin dipelajari</strong></h3>
                </div>
                `);
                for (let n = 0; n < result.length; n++) {
                    let row = result[n];
                    let appends = `
                    <div class="col-md-3 mb-2">
            <div class="card" style="border: 3px solid #2a84f4;">
                <div class="card-body text-center">
                    <img src="<?= base_url('public/img/topic') ?>/${row['images']}" style="width: 70%;height:auto;">
                    <div class="dropup">
                    <h5 style='cursor: pointer;' class='text-primary' onclick="click_dropup('#dropup-${n}')"><strong>${row['topicname']}</strong></h5>
    <div class="dropup-content text-left" id="dropup-${n}">`
                    let list_subs = row['list_subs'];
                    if (list_subs != '') {
                        appends += `<a href="#" style='border-bottom: 1px solid #fff'><strong>Topik Materi</strong></a>`
                        let exp_satu = list_subs.split('[_]');
                        for (let s = 0; s < exp_satu.length; s++) {
                            let rsatu = exp_satu[s];
                            let rowsub = rsatu.split('|||');
                            console.log(rowsub);
                            if (rowsub.length == 2) {
                                appends += `<a href="<?= base_url('konsultasi/dospem') ?>?topicid=${row['topicid']}&subtopicid=${rowsub[0]}">${rowsub[1]}</a>`;
                            }
                        }
                    }
                    appends += `</div>
  </div>
                    
                </div>
            </div>
        </div>          
                    `;
                    $("#load_topic").append(appends);
                }
            }
        })
    }

    function click_dropup(elem) {
        if ($(elem).hasClass('show-dropup')) {
            console.log("hah")
            $(elem).removeClass('show-dropup');
        } else {
            console.log("ok")
            $(elem).addClass('show-dropup');
        }
    }
</script>