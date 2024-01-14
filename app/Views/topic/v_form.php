<form id="form-master-topic">
    <div class="form-group">
        <label class="label-required" for="namatopik">Nama Topik</label>
        <input type="hidden" name="id" value="<?= (($form_type == 'edit') ? $row['topicid'] : '') ?>">
        <input type="hidden" name="tipe" value="<?= $tipe ?>">
        <input type="text" class="form-control" id="namatopik" name="topicname" value="<?= (($form_type == 'edit') ? $row['topicname'] : '') ?>" required>
    </div>
    <?php if (session()->get('role') == 'admin') { ?>
        <div class="form-group">
            <label class="label-required" for="prodiname">Prodi</label>
            <select name="prodiname" id="prodiname" class="form-control select2" style="width: 100%;" required>
                <?php if ($form_type == 'edit') { ?>
                    <option value="<?= $row['prodiid'] ?>" selected><?= $row['prodicode'] ?> - <?= $row['prodiname'] ?></option>
                <?php } ?>
            </select>
        </div>
    <?php } else { ?>
        <input type="hidden" name="prodiname" value="<?= session()->get('prodiid') ?>">
    <?php } ?>
    <div class="form-group">
        <label class="label-required" for="images">Images</label>
        <input type="hidden" name="old_images" value="<?= (($form_type == 'edit') ? $row['images'] : '') ?>">
        <input type="file" name="images" id="images" accept=".jpg, .png, .jpeg, .svg" class="form-control" onchange="preview_images()" required>
        <br>
        <img src="<?= base_url('public/img/' . (($form_type == 'edit') ? 'topic/' . $row['images'] : 'blank-bg.jpg')) ?>" width="150px" height="150px" class="img-preview">
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-master-topic").on('submit', function(e) {
            e.preventDefault();
            let form_type = "<?= $form_type ?>"
            let link = "<?= base_url('topic/create') ?>"
            if (form_type == 'edit') {
                link = "<?= base_url('topic/update') ?>"
            }
            let form = $(this)[0];
            let data = new FormData(form);
            $.ajax({
                url: link,
                type: 'post',
                dataType: 'json',
                data: data,
                enctype: "multipart/form-data",
                processData: false,
                contentType: false,
                cache: false,
                success: function(res) {
                    if (res.sukses == 1) {
                        $.notify('Data berhasil diproses', 'success');
                        data_table.ajax.reload();
                        $('#modalglobal').modal('hide');
                    } else {
                        $.notify('Data gagal diproses', 'error');
                    }
                }
            })
            return false;
        })
        $("#prodiname").select2({
            dropdownParent: $("#modalglobal"),
            placeholder: 'Pilih Prodi',
            ajax: {
                url: '<?= base_url('prodi/getallprodi') ?>',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
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

    function preview_images() {
        const sampulA = document.querySelector('#images');
        const gambarA = document.querySelector('.img-preview');

        const fileGambarA = new FileReader();
        fileGambarA.readAsDataURL(sampulA.files[0]);

        fileGambarA.onload = function(e) {
            gambarA.src = e.target.result;
        }
    }
</script>