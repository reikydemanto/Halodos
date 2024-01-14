<?= $this->include('include/header') ?>
<?= $this->include('include/sidebar') ?>
<?= $this->include('include/navbar') ?>
<style>
    .hr-border {
        border-top: 1px solid #CCC;
    }
</style>
<div style="background: rgb(92,222,229);background: linear-gradient(90deg, rgba(92,222,229,1) 34%, rgba(3,79,174,1) 96%);padding-top: 15px;padding-bottom: 15px;margin-top: -22px">
    <div class="container">
        <div class="row">
            <div class="col-md-2 text-right">
                <img src="<?= base_url('public/img/dospem-' . $dosen['jeniskelamin'] . '.png') ?>" class="rounded-circle" width="70%" alt="">
            </div>
            <div class="col-md-8" style="color: #fff;">
                <h2 style="padding: 0;margin:0;"><strong><?= $dosen['fullname'] ?></strong></h2>
                <h4 style="padding: 0;margin:0;"><strong><?= $dosen['kampusname'] ?></strong></h4>
                <h6 style="padding: 0;margin:0;"><strong><?= $dosen['prodiname'] ?></strong></h6>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt-4">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-2">
            <a href="#" class="btn btn-primary btn-circle btn-sm" id="btn-satu">1</a><span id="text-satu"><strong> Waktu konsultasi</strong></span>
        </div>
        <div class="col-md-3">
            <hr class="hr-border" id="hr-satu">
        </div>
        <div class="col-md-2">
            <a href="#" class="btn btn-secondary btn-circle btn-sm" id="btn-dua">2</a><span id="text-dua"> Topik Diskusi</span>
        </div>
        <div class="col-md-3">
            <hr class="hr-border" id="hr-dua">
        </div>
        <div class="col-md-2">
            <a href="#" class="btn btn-secondary btn-circle btn-sm" id="btn-tiga">3</a><span id="text-tiga"> Konfirmasi</span>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div id="tab-satu">
                <form id="form-satu">
                    <div class="form-group">
                        <label class="label-required">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="label-required">Dari</label>
                        <input type="time" name="dari" id="dari" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="label-required">Sampai</label>
                        <input type="time" name="sampai" id="sampai" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Lanjut</button>
                </form>
            </div>
            <div id="tab-dua" class="hide-element">
                <form id="form-dua">
                    <div class="form-group">
                        <label class="label-required">Mata Kuliah</label><br>
                        <select name="topicid" id="topicid" class="form-control" style="width: 20%;" required>
                            <?php if ($topic) { ?>
                                <option value="<?= $topic['topicid'] ?>" selected><?= $topic['topicname'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="label-required">Topik Diskusi</label><br>
                        <select name="subtopicid" id="subtopicid" class="form-control" style="width: 20%;" required>
                            <?php if ($subtopic) { ?>
                                <option value="<?= $subtopic['topicid'] ?>" selected><?= $subtopic['topicname'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" id="kembali-satu" class="btn btn-secondary">Kembali</button>
                        <button type="submit" class="btn btn-primary">Lanjut</button>
                    </div>
                </form>
            </div>
            <div id="tab-tiga" class="hide-element">
                <form id="form-tiga">
                    <input type="hidden" name="tanggal" id="hidden-tanggal">
                    <input type="hidden" name="fromwaktu" id="hidden-fromwaktu">
                    <input type="hidden" name="towaktu" id="hidden-towaktu">
                    <input type="hidden" name="topicid" id="hidden-topicid">
                    <input type="hidden" name="subtopicid" id="hidden-subtopicid">
                    <input type="hidden" name="dosenid" id="hidden-dosenid" value="<?= $dosen['userid'] ?>">
                    <div class="row">
                        <div class="col-md-2">
                            Tanggal
                        </div>
                        <div class="col-md-10 mb-3" id="label-tanggal">

                        </div>
                        <div class="col-md-2">
                            Waktu
                        </div>
                        <div class="col-md-10 mb-3" id="label-waktu">

                        </div>
                        <div class="col-md-2">
                            Mata Kuliah
                        </div>
                        <div class="col-md-10 mb-3" id="label-matkul">

                        </div>
                        <div class="col-md-2">
                            Topik Diskusi
                        </div>
                        <div class="col-md-10 mb-3" id="label-topik">

                        </div>
                        <div class="col-md-12">
                            <b>Apakah data yang dimasukan sudah benar ?</b>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-secondary" id="kembali-dua">Kembali</button>
                            <button type="submit" class="btn btn-primary" id="konfirmasi">Konfirmasi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('include/footer') ?>
<script>
    $(document).ready(function() {
        $("#form-satu").on('submit', function(e) {
            e.preventDefault();
            let tanggal = $("#tanggal").val();
            let dari = $("#dari").val();
            let sampai = $("#sampai").val();
            $("#tab-satu").fadeOut()
            $("#tab-satu").addClass('hide-element')
            $("#tab-dua").fadeIn()
            $("#tab-dua").removeClass('hide-element')
            $("#btn-satu").removeClass('btn-primary')
            $("#btn-satu").addClass('btn-secondary')
            $("#text-satu").html(' Waktu Konsultasi')

            $("#btn-dua").addClass('btn-primary')
            $("#btn-dua").removeClass('btn-secondary')
            $("#text-dua").html("<strong> Topik Diskusi</strong>")

            $("#hidden-tanggal").val(tanggal);
            $("#hidden-fromwaktu").val(dari);
            $("#hidden-towaktu").val(sampai);
            let exp_tanggal = tanggal.split('-');
            let labels = exp_tanggal[2] + exp_tanggal[1] + exp_tanggal[0];
            $("#label-tanggal").text(': ' + labels);
            $("#label-waktu").text(': ' + dari + '-' + sampai);
            return false;
        })
        $("#form-dua").on('submit', function(e) {
            e.preventDefault();
            let topic = $("#topicid").select2('data')[0];
            let subtopic = $("#subtopicid").select2('data')[0];
            let topicid = topic.id;
            let subtopicid = subtopic.id;
            let topictext = topic.text;
            let subtopictext = subtopic.text;

            $("#label-matkul").text(': ' + topictext);
            $("#label-topik").text(': ' + subtopictext);
            $("#hidden-topicid").val(topicid)
            $("#hidden-subtopicid").val(subtopicid)

            $("#tab-dua").fadeOut()
            $("#tab-dua").addClass('hide-element')
            $("#tab-tiga").fadeIn()
            $("#tab-tiga").removeClass('hide-element')

            $("#btn-dua").removeClass('btn-primary')
            $("#btn-dua").addClass('btn-secondary')
            $("#text-dua").html(' Topik Diskusi')

            $("#btn-tiga").addClass('btn-primary')
            $("#btn-tiga").removeClass('btn-secondary')
            $("#text-tiga").html("<strong> Konfirmasi</strong>")

            return false;
        })
        $("#form-tiga").on('submit', function(e) {
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                url: '<?= base_url("konsultasi/add") ?>',
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(res) {
                    if (res.sukses == 1) {
                        $.notify('Berhasil tambah jadwal konsultasi !', 'success');
                        window.location.href = "<?= base_url('konsultasi') ?>"
                    } else {
                        let pesan = 'Gagal tambah jadwal konsultasi !';
                        if (res.msg != undefined) {
                            pesan = res.msg;
                        }
                        $.notify(pesan, 'error');
                    }
                }
            })
            return false;
        })

        $("#kembali-satu").on('click', function() {
            $("#tab-dua").fadeOut()
            $("#tab-dua").addClass('hide-element')
            $("#tab-satu").fadeIn()
            $("#tab-satu").removeClass('hide-element')
            $("#btn-dua").removeClass('btn-primary')
            $("#btn-dua").addClass('btn-secondary')
            $("#text-dua").html(' Topik Diskusi')

            $("#btn-satu").addClass('btn-primary')
            $("#btn-satu").removeClass('btn-secondary')
            $("#text-satu").html("<strong> Waktu Konsultasi</strong>")
        })

        $("#kembali-dua").on('click', function() {
            $("#tab-tiga").fadeOut()
            $("#tab-tiga").addClass('hide-element')
            $("#tab-dua").fadeIn()
            $("#tab-dua").removeClass('hide-element')

            $("#btn-tiga").removeClass('btn-primary')
            $("#btn-tiga").addClass('btn-secondary')
            $("#text-tiga").html(' Konfirmasi')

            $("#btn-dua").addClass('btn-primary')
            $("#btn-dua").removeClass('btn-secondary')
            $("#text-dua").html("<strong> Topik Diskusi</strong>")
        })

        $("#topicid").select2({
            placeholder: 'Pilih Matkul',
            ajax: {
                url: '<?= base_url('topic/getmaster') ?>',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
        $("#topicid").on('change', function() {
            $("#subtopicid").val(null).trigger('change')
            $("#subtopicid").select2({
                placeholder: 'Pilih Topik Diskusi',
                ajax: {
                    url: '<?= base_url('topic/getsub') ?>',
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            masterid: $("#topicid").val(),
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        })
        $("#subtopicid").select2({
            placeholder: 'Pilih Topik Diskusi',
            ajax: {
                url: '<?= base_url('topic/getsub') ?>',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        masterid: $("#topicid").val(),
                        searchTerm: params.term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    })
</script>