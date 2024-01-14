<?= $this->include('include/header') ?>
<?= $this->include('include/sidebar') ?>
<?= $this->include('include/navbar') ?>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-primary btn-icon-split" onclick="return modalForm('Tambah Data Kampus', '<?= base_url('kampus/form') ?>')">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kampus</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('include/footer') ?>
<script>
    function loadProdi(kampusid) {
        console.log(kampusid)
        $.ajax({
            url: '<?= base_url("kampus/loadprodi") ?>',
            type: 'post',
            dataType: 'json',
            data: {
                kampusid: kampusid
            },
            success: function(res) {
                $("#load-prodi").html("");
                let result = res.result;
                console.log(result);
                for (let x = 0; x < result.length; x++) {
                    let row = result[x];
                    $("#load-prodi").append(`
                    <div class="form-check">
  <input class="form-check-input" type="checkbox" value="t" id="defaultCheck${x}" onclick="edit_prodi(this)" data-prodi="${row['prodiid']}" ${((row['checked'] == 't')?'checked':'')}>
  <label class="form-check-label" for="defaultCheck${x}">
  ${row['prodicode']} - ${row['prodiname']}
  </label>
</div>
                    `);
                }
            }
        })
    }

    function edit_prodi(elem) {
        let prodiid = $(elem).data('prodi')
        let kampusid = $("#kampusid").val();
        let checked = 'f';
        if ($(elem).is(':checked')) {
            checked = 't';
        }
        $.ajax({
            url: '<?= base_url("kampus/accessing") ?>',
            type: 'post',
            dataType: 'json',
            data: {
                kampusid: kampusid,
                prodiid: prodiid,
                checked: checked
            },
            success: function(res) {
                $.notify('Data berhasil diproses', 'success');
            }
        })
    }
</script>