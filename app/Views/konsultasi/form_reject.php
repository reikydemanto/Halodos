<form id="form-reject">
    <input type="hidden" name="konsulid" id="konsulid" value="<?= $konsul['konsulid'] ?>">
    <div class="form-group">
        <label>Topik</label>
        <input type="text" class="form-control" value="<?= $konsul['subtopicname'] ?>" disabled>
    </div>
    <div class="form-group">
        <label>Mata Kuliah</label>
        <input type="text" class="form-control" value="<?= $konsul['subtopicname'] ?>" disabled>
    </div>
    <div class="form-group">
        <label>Mahasiswa</label>
        <input type="text" class="form-control" value="<?= $konsul['fullname'] ?>" disabled>
    </div>
    <div class="form-group">
        <label>Jadwal</label>
        <input type="text" class="form-control" value="<?= date('d F Y H:i', strtotime($konsul['tanggal'] . ' ' . $konsul['jamfrom'])) . ' - ' . date('d F Y H:i', strtotime($konsul['tanggal'] . ' ' . $konsul['jamto'])) ?> WIB" disabled>
    </div>
    <div class="form-group">
        <label>Alasan Batal</label>
        <textarea name="reason" id="reason" class="form-control" required="required"></textarea>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" id="btn-close" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" id="btn-submit">Save</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-reject").on('submit', function(e) {
            e.preventDefault();
            $("#btn-close").attr('disabled', 'disabled')
            $("#btn-submit").attr('disabled', 'disabled')
            let data = $(this).serialize();
            $.ajax({
                url: '<?= base_url("konsultasi/reject-jadwal") ?>',
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(res) {
                    $("#btn-close").removeAttr('disabled')
                    $("#btn-submit").removeAttr('disabled')
                    if (res.sukses == 1) {
                        $.notify('Data berhasil diproses', 'success');
                        $('#modalglobal').modal('hide');
                        $("#jadwal-sesi-<?= $konsul['konsulid'] ?>").addClass('hide-element')
                        $("#do-sesi-<?= $konsul['konsulid'] ?>").addClass('hide-element')
                        $("#batal-sesi-<?= $konsul['konsulid'] ?>").addClass('hide-element')
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
        });
    })
</script>