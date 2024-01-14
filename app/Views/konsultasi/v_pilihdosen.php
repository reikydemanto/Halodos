<?= $this->include('include/header') ?>
<?= $this->include('include/sidebar') ?>
<?= $this->include('include/navbar') ?>

<div class="text-center" style="background: rgb(92,222,229);
background: linear-gradient(90deg, rgba(92,222,229,1) 34%, rgba(3,79,174,1) 96%);padding-top: 15px;padding-bottom: 15px;margin-top: -22px">
    <h1 style="color: #fff;"><strong><?= ucwords($topic['topicname']) ?></strong></h1>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3><strong>Dosen Ahli</strong></h3>
                </div>
                <div class="card-body row">
                    <?php foreach ($dosen as $d) { ?>
                        <div class="col-md-4 text-center" style="cursor: pointer;" onclick="chose_dosen('<?= $d['userid'] ?>')">
                            <img src="<?= base_url('public/img/dospem-' . $d['jeniskelamin'] . '.png') ?>" style="width: 40%;">
                            <h4><strong><?= ucwords($d['fullname']) ?></strong></h4>
                            <h6><?= $d['prodiname'] ?></h6>
                            <h6><?= $d['kampusname'] ?></h6>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('include/footer') ?>
<script>
    function chose_dosen(userid) {
        let url = window.location.href;
        let form_url = "<?= base_url('konsultasi/form?topicid=' . $topicid . '&subtopicid=' . $subtopicid . '') ?>&dosenid=" + userid
        window.location.href = form_url;
    }
</script>