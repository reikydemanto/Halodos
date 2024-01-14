<form id="form-user">
    <input type="hidden" name="id" value="<?= (($form_type == 'edit') ? $row['userid'] : '') ?>">
    <div class="form-group">
        <label class="label-required" for="fullname">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" value="<?= (($form_type == 'edit') ? $row['fullname'] : '') ?>" required>
    </div>
    <div class="form-group">
        <label class="label-required" for="code">Nomor Induk Mahasiswa / Pembimbing</label>
        <input type="text" class="form-control" id="code" name="code" value="<?= (($form_type == 'edit') ? $row['usercode'] : '') ?>" required>
    </div>
    <div class="form-group">
        <label class="label-required" for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= (($form_type == 'edit') ? $row['email'] : '') ?>" required>
        <input type="hidden" name="old-email" value="<?= (($form_type == 'edit') ? $row['email'] : '') ?>">
    </div>
    <div class="form-group">
        <label class="label-required" for="phonenumber">Phone Number</label>
        <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?= (($form_type == 'edit') ? $row['phonenumber'] : '') ?>" required>
    </div>
    <div class="form-group">
        <label>Jenis Kelamin</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jeniskelamin" id="inlineRadio1" value="lakilaki" <?= (($form_type == 'edit' && $row['jeniskelamin'] == 'lakilaki') ? 'checked' : '') ?> required>
            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jeniskelamin" id="inlineRadio2" value="perempuan" <?= (($form_type == 'edit' && $row['jeniskelamin'] == 'perempuan') ? 'checked' : '') ?>>
            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
        </div>
    </div>
    <div class="form-group">
        <label class="label-required" for="namakampus">Kampus</label>
        <select name="namakampus" id="namakampus" class="form-control select2" style="width: 100%;" required>
            <?php if ($form_type == 'edit') { ?>
                <option value="<?= $row['kampusid'] ?>" selected><?= $row['kampusname'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label class="label-required" for="prodiname">Prodi</label>
        <select name="prodiname" id="prodiname" class="form-control select2" style="width: 100%;" <?= (($form_type == 'edit') ? 'required' : 'disabled') ?>>
            <?php if ($form_type == 'edit') { ?>
                <option value="<?= $row['prodiid'] ?>" selected><?= $row['prodicode'] ?> - <?= $row['prodiname'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label class="label-required" for="password">Password <button type="button" class="btn btn-sm btn-info ml-2" onclick="show_password('1')"><i id="icon-pass-1" class="fas fa-eye"></i></button></label>
        <input type="password" class="form-control" id="password-1" name="password" <?= (($form_type != 'edit') ? 'required' : '') ?>>
        <input type="hidden" name="old-password" value="<?= (($form_type == 'edit') ? $row['password'] : '') ?>">
    </div>
    <div class="form-group">
        <label class="label-required" for="role">Role</label>
        <select name="role" id="role" class="form-control select2" style="width: 100%;" required>
            <option value="admin" <?= (($form_type == 'edit' && $row['role'] == 'admin') ? 'selected' : '') ?>>Administrator</option>
            <option value="dospem" <?= (($form_type == 'edit' && $row['role'] == 'dospem') ? 'selected' : '') ?>>Dosen Pembimbing</option>
            <option value="user" <?= (($form_type == 'edit' && $row['role'] == 'user') ? 'selected' : '') ?>>User</option>
        </select>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-user").on('submit', function(e) {
            e.preventDefault();
            let form_type = "<?= $form_type ?>"
            let link = "<?= base_url('user/create') ?>"
            if (form_type == 'edit') {
                link = "<?= base_url('user/update') ?>"
            }
            let data = $(this).serialize();
            $.ajax({
                url: link,
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(res) {
                    if (res.sukses == 1) {
                        $.notify('Data berhasil diproses', 'success');
                        data_table.ajax.reload();
                        $('#modalglobal').modal('hide');
                    } else {
                        let pesan = 'Data gagal diproses'
                        if (res.msg != undefined) {
                            pesan = res.msg;
                        }
                        $.notify(pesan, 'error');
                    }
                }
            })
            return false;
        })
        $("#namakampus").select2({
            dropdownParent: $("#modalglobal"),
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
                dropdownParent: $("#modalglobal"),
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
        <?php if ($form_type == 'edit') { ?>
            $("#prodiname").select2({
                dropdownParent: $("#modalglobal"),
                placeholder: 'Pilih Prodi',
                ajax: {
                    url: '<?= base_url('prodi/getprodi') ?>',
                    type: "post",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            searchTerm: params.term,
                            kampusid: <?= $row['kampusid'] ?>
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
        <?php } else { ?>
            $("#prodiname").select2({
                dropdownParent: $("#modalglobal"),
                placeholder: 'Pilih Prodi',
            });
        <?php } ?>
        $("#role").select2({
            dropdownParent: $("#modalglobal"),
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