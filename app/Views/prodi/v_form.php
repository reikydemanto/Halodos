<form id="form-prodi">
    <input type="hidden" name="id" value="<?= (($form_type == 'edit') ? $row['prodiid'] : '') ?>">
    <div class="form-group">
        <label class="label-required" for="namaprodi">Nama Prodi</label>
        <input type="text" class="form-control" id="namaprodi" name="namaprodi" value="<?= (($form_type == 'edit') ? $row['prodiname'] : '') ?>" required>
    </div>
    <div class="form-group">
        <label class="label-required" for="prodicode">Kode Prodi</label>
        <input type="text" class="form-control" id="prodicode" name="prodicode" value="<?= (($form_type == 'edit') ? $row['prodicode'] : '') ?>" required>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-prodi").on('submit', function(e) {
            e.preventDefault();
            let form_type = "<?= $form_type ?>"
            let link = "<?= base_url('prodi/create') ?>"
            if (form_type == 'edit') {
                link = "<?= base_url('prodi/update') ?>"
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
                        $.notify('Data gagal diproses', 'error');
                    }
                }
            })
            return false;
        })
    });
</script>