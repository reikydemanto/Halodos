<form id="form-prodi">
    <input type="hidden" id="kampusid" value="<?= $row['kampusid'] ?>">
    <div id="load-prodi">

    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
    </div>
</form>
<script>
    $(document).ready(function() {
        loadProdi("<?= $row['kampusid'] ?>")
    })
</script>