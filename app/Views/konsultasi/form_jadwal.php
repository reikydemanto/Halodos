<form id="form-jadwal">
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
        <label>Link Google Meet <a href="https://meet.google.com" target="_blank">(Buat room google meet ?)</a></label>
        <input type="text" class="form-control" id="links" name="links" required>
    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" id="cancel-btn" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit" id="submit-btn">Save</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $("#form-jadwal").on('submit', function(e) {
            e.preventDefault();
            $("#cancel-btn").attr('disabled', 'disabled')
            $("#submit-btn").attr('disabled', 'disabled')
            let data = $(this).serialize();
            $.ajax({
                url: '<?= base_url("konsultasi/add-jadwal") ?>',
                type: 'post',
                dataType: 'json',
                data: data,
                success: function(res) {
                    $("#cancel-btn").removeAttr('disabled')
                    $("#submit-btn").removeAttr('disabled')
                    if (res.sukses == 1) {
                        $.notify('Data berhasil diproses', 'success');
                        $('#modalglobal').modal('hide');
                        $("#do-sesi-<?= $konsul['konsulid'] ?>").attr('href', $("#links").val());
                        $("#do-sesi-<?= $konsul['konsulid'] ?>").removeClass('hide-element');
                        $("#jadwal-sesi-<?= $konsul['konsulid'] ?>").addClass('hide-element');
                        $("#batal-sesi-<?= $konsul['konsulid'] ?>").addClass('hide-element');
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
    })
</script>