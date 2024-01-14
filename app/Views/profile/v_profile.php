<?= $this->include('include/header') ?>
<?= $this->include('include/sidebar') ?>
<?= $this->include('include/navbar') ?>
<style>
    .hr-border {
        border-top: 1px solid #000;
    }
</style>
<div class="container-fluid">
    <div class="row" style="margin-bottom: 10px;">
        <div class="col-md-2">
            <a href="#" class="btn btn-primary btn-circle btn-sm" id="btn-satu">1</a><span id="text-satu"><strong> Data Diri</strong></span>
        </div>
        <div class="col-md-4">
            <hr class="hr-border" id="hr-satu">
        </div>
        <div class="col-md-4">
            <hr id="hr-dua">
        </div>
        <div class="col-md-2">
            <a href="#" class="btn btn-secondary btn-circle btn-sm" id="btn-dua">2</a><span id="text-dua"> Finalisasi Data</span>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div id="tab-satu">
                <form id="form-profile">
                    <div class="row" id="form-satu">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-required"><?= ((session()->get('role') == 'dospem') ? 'NIM' : 'NIP') ?></label>
                                <input type="text" class="form-control" id="code" name="code" value="<?= $row['usercode'] ?>" style="width: 90%;" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-required">Nama Lengkap</label>
                                <input type="hidden" name="id" value="<?= $row['userid'] ?>">
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $row['fullname'] ?>" style="width: 90%;" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-required">Perguruan Tinggi</label>
                                <select name="namakampus" id="namakampus" class="form-control select2" style="width: 90%;" <?= (($row['fullname'] != '') ? 'disabled' : 'required') ?>>
                                    <?php if ($row['kampusname'] != null && $row['kampusname'] != '') { ?>
                                        <option value="<?= $row['kampusid'] ?>" selected><?= $row['kampusname'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-required">Jenis Kelamin</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jeniskelamin" id="inlineRadio1" value="lakilaki" <?= (($row['jeniskelamin'] == 'lakilaki') ? 'checked' : '') ?> required>
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
                                <label class="label-required">Program Studi</label><br>
                                <select name="prodiname" id="prodiname" class="form-control select2" style="width: 90%;" <?= (($row['fullname'] != '') ? 'disabled' : 'required') ?>>
                                    <?php if ($row['fullname'] != '') { ?>
                                        <option value="<?= $row['prodiid'] ?>" selected><?= $row['prodiname'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-required">Email</label>
                                <input type="email" class="form-control" id="email" name="email" style="width: 90%;" value="<?= $row['email'] ?>" required>
                                <input type="hidden" name="email_lama" value="<?= $row['email'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if ($row['fullname'] != '') { ?>
                                <div class="form-group">
                                    <label>Password <button type="button" class="btn btn-sm btn-info ml-2" onclick="show_password('1')"><i id="icon-pass-1" class="fas fa-eye"></i></button></label>
                                    <input type="password" class="form-control" id="password-1" name="password" style="width: 90%;">
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="label-required">No Whatsapp</label>
                                <input type="text" class="form-control" id="phone" name="phone" style="width: 90%;" value="<?= (($row['phonenumber'] == '') ? "62" : $row['phonenumber']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <?php if ($row['fullname'] != '') { ?>
                                <div class="form-group">
                                    <label>Konfirmasi Password <button type="button" class="btn btn-sm btn-info ml-2" onclick="show_password('2')"><i id="icon-pass-2" class="fas fa-eye"></i></button></label></label>
                                    <input type="password" class="form-control" id="password-2" name="konfir_password" style="width: 90%;">
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Lanjut</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="tab-dua" class="hide-element">
                <div class="row">
                    <div class="col-md-2">
                        Nama Lengkap
                    </div>
                    <div class="col-md-10 mb-3" id="label-fullname">

                    </div>
                    <div class="col-md-2">
                        Jenis Kelamin
                    </div>
                    <div class="col-md-10 mb-3" id="label-jenkel">

                    </div>
                    <div class="col-md-2">
                        Email
                    </div>
                    <div class="col-md-10 mb-3" id="label-email">

                    </div>
                    <div class="col-md-2">
                        No. Whatsapp
                    </div>
                    <div class="col-md-10 mb-3" id="label-phone">

                    </div>
                    <div class="col-md-2">
                        Perguruan Tinggi
                    </div>
                    <div class="col-md-10 mb-3" id="label-kampus">

                    </div>
                    <div class="col-md-2">
                        Program Studi
                    </div>
                    <div class="col-md-10 mb-3" id="label-prodi">

                    </div>
                    <div class="col-md-12">
                        <b>Apakah data yang dimasukan sudah benar ?</b>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary" id="batal">Batal</button>
                        <button type="button" class="btn btn-primary" id="konfirmasi">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('include/footer') ?>
<script>
    $(document).ready(function() {
        $("#form-profile").on('submit', function(e) {
            e.preventDefault();
            let fullname = $("#fullname").val();
            let kampusid = $("#namakampus").val();
            let datakampus = $("#namakampus").select2('data')[0];
            let dataprodi = $("#prodiname").select2('data')[0];
            let kampusname = datakampus.text;
            console.log(datakampus);
            console.log(kampusname);
            let jeniskelamin = $('input[name="jeniskelamin"]:checked').val();
            let prodiid = $("#prodiname").val();
            let prodiname = dataprodi.text;
            console.log(prodiname);
            let email = $("#email").val();
            let phone = $("#phone").val();
            let jenkel = "";
            if (jeniskelamin == 'lakilaki') {
                jenkel = "Laki-laki"
            } else {
                jenkel = "Perempuan";
            }
            $("#label-fullname").text(': ' + fullname);
            $("#label-jenkel").text(': ' + jenkel);
            $("#label-email").text(': ' + email);
            $("#label-phone").text(': ' + phone);
            $("#label-kampus").text(': ' + kampusname);
            $("#label-prodi").text(': ' + prodiname);
            $("#tab-satu").fadeOut()
            $("#tab-satu").addClass('hide-element')
            $("#tab-dua").fadeIn()
            $("#tab-dua").removeClass('hide-element')

            $("#btn-satu").removeClass('btn-primary')
            $("#btn-satu").addClass('btn-secondary')
            $("#hr-satu").removeClass('hr-border')
            $("#text-satu").html(" Data Diri")

            $("#btn-dua").addClass('btn-primary')
            $("#btn-dua").removeClass('btn-secondary')
            $("#hr-dua").addClass('hr-border')
            $("#text-dua").html("<strong> Finalisasi Data</strong>")
            return false;
        })
        $("#konfirmasi").on('click', function() {
            let data = $("#form-profile").serialize();
            $.ajax({
                url: '<?= base_url("editprofile") ?>',
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(res) {
                    if (res.sukses == 1) {
                        $.notify('Update profile berhasil', 'success');
                        window.location.href = "<?= base_url('profile') ?>"
                    } else {
                        let pesan = 'Update profile gagal !';
                        if (res.msg != undefined) {
                            pesan = res.msg
                        }
                        $.notify(pesan, 'error');
                    }
                }
            })
        })
        $("#batal").on('click', function() {
            $("#tab-dua").fadeOut()
            $("#tab-dua").addClass('hide-element')
            $("#tab-satu").fadeIn()
            $("#tab-satu").removeClass('hide-element')

            $("#btn-dua").removeClass('btn-primary')
            $("#btn-dua").addClass('btn-secondary')
            $("#hr-dua").removeClass('hr-border')
            $("#text-dua").html(" Data Diri")

            $("#btn-satu").addClass('btn-primary')
            $("#btn-satu").removeClass('btn-secondary')
            $("#hr-satu").addClass('hr-border')
            $("#text-satu").html("<strong> Finalisasi Data</strong>")
        })
        $("#namakampus").select2({
            placeholder: 'Pilih Kampus',
            ajax: {
                url: '<?= base_url('kampus/getkampus') ?>',
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
        $("#namakampus").on('change', function() {
            let val = $(this).val();
            $("#prodiname").removeAttr('disabled');
            $("#prodiname").removeAttr('required');
            $("#prodiname").attr('required', 'required');
            $("#prodiname").val(null).trigger('change');
            $("#prodiname").select2({
                placeholder: 'Pilih Prodi',
                ajax: {
                    url: '<?= base_url('prodi/getprodi') ?>',
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            searchTerm: params.term,
                            kampusid: val
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
        $("#prodiname").select2({
            placeholder: 'Pilih Prodi',
        });
    })

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