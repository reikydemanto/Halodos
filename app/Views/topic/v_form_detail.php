<form id="form-detail-topic">
    <input type="hidden" name="id" value="<?= (($form_type == 'edit') ? $row['topicid'] : '') ?>">
    <div class="form-group">
        <label class="label-required" for="mastertopic">Master Topik</label>
        <select name="mastertopic" id="mastertopic" class="form-control select2" style="width: 100%;" required>
            <?php if ($form_type == 'edit') { ?>
                <option value="<?= $row['masterid'] ?>" selected><?= $row['mastername'] ?> <?= ((session()->get('role') == 'admin') ? " ($row[kampusname] - $row[prodiname])" : "") ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label class="label-required" for="topicname">Nama Topik</label>
        <input type="text" class="form-control" id="topicname" name="topicname" value="<?= (($form_type == 'edit') ? $row['topicname'] : '') ?>" required>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Save</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-detail-topic").on('submit', function(e) {
            e.preventDefault();
            let form_type = "<?= $form_type ?>"
            let link = "<?= base_url('topic/create') ?>"
            if (form_type == 'edit') {
                link = "<?= base_url('topic/update') ?>"
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
        $("#mastertopic").select2({
            dropdownParent: $("#modalglobal"),
            allowClear: true,
            placeholder: 'Pilih Master Topik',
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
    })
</script>