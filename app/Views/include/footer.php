</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; HaloDos <?= date('Y') ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('logout') ?>">Logout</a>
                <!-- tes github -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaldelete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaldelete-title"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin untuk menghapus data ini ?
                <input type="hidden" id="modaldelete-ids">
                <input type="hidden" id="modaldelete-link">
                <input type="hidden" id="modaldelete-type">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="button" id="modaldelete-button">Confirm</button>
                <!-- tes github -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalglobal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalglobal-title"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modalglobal-view"></div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('public/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('public/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('public/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<script src="<?= base_url('public/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('public/vendor/select2/select2.min.js') ?>"></script>
<script src="<?= base_url('public/vendor/notify/notify.js') ?>"></script>
<!-- Custom scripts for all pages-->
<script src="<?= base_url('public/js/sb-admin-2.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        $('#modalglobal').on('hidden.bs.modal', function(event) {
            $("#modalglobal-title").text("");
            $("#modalglobal-view").html("");
        })

        $("#modaldelete-button").on('click', function() {
            $.ajax({
                url: $("#modaldelete-link").val(),
                type: 'post',
                data: {
                    id: $("#modaldelete-ids").val()
                },
                dataType: 'json',
                success: function(res) {
                    let tipe = $("#modaldelete-type").val();
                    if (res.sukses == 1) {
                        $.notify('Data berhasil dihapus', 'success');
                        if (tipe == 'data_table') {
                            data_table.ajax.reload();
                        }
                        $("#modaldelete-title").text("");
                        $("#modaldelete-ids").val("");
                        $("#modaldelete-link").val("");
                        $("#modaldelete-type").val("");
                        $("#modaldelete").modal('hide');

                    } else {
                        $.notify('Data gagal dihapus', 'error');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    showError(thrownError);
                }
            })
        })
    })

    function modalForm(title, url, data = {}) {
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(res) {
                $("#modalglobal-title").text(title);
                $("#modalglobal-view").html(res.view);
                $('#modalglobal').modal('show')
            },
            error: function(xhr, ajaxOptions, thrownError) {
                showError(thrownError);
            }
        })
    }

    function modalHapus(title, id, link, tipe) {
        $("#modaldelete-title").text(title);
        $('#modaldelete').modal('show');
        $("#modaldelete-ids").val(id);
        $("#modaldelete-link").val(link);
        $("#modaldelete-type").val(tipe);
    }

    var data_table = $('#data-table').DataTable({
        serverSide: true,
        destroy: true,
        autoWidth: false,
        ajax: {
            url: '<?= current_url(true) ?>/table',
            type: 'post',
            dataType: 'json',
            data: function(param) {
                param["param"] = "value";
                return param;
            }
        }
    })
</script>
</body>

</html>