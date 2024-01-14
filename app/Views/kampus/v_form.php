<form id="form-kampus">
    <input type="hidden" name="id" value="<?= (($form_type == 'edit') ? $row['kampusid'] : '') ?>">
    <div class="form-group">
        <label class="label-required" for="namakampus">Nama Kampus</label>
        <input type="text" class="form-control" id="namakampus" name="namakampus" value="<?= (($form_type == 'edit') ? $row['kampusname'] : '') ?>" required>
    </div>
    <div class="form-group">
        <label class="label-required" for="alamatkampus">Alamat Kampus</label>
        <textarea name="alamatkampus" id="alamatkampus" class="form-control" required="true"><?= (($form_type == 'edit') ? $row['kampusaddress'] : '') ?></textarea>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-kampus").on('submit', function(e) {
            e.preventDefault();
            let form_type = "<?= $form_type ?>"
            let link = "<?= base_url('kampus/create') ?>"
            if (form_type == 'edit') {
                link = "<?= base_url('kampus/update') ?>"
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
    })
</script>