<?= $this->include('include/header') ?>
<?= $this->include('include/sidebar') ?>
<?= $this->include('include/navbar') ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card" style="font-size: 20px ; color:black">
					<div class="card-body" style="background: rgb(2,0,36);
								background: linear-gradient(90deg, rgba(2,0,36,1) 0%,
								rgba(42,157,180,1) 0%, rgba(90,90,221,1) 94%); padding: 30px;">

						<div class="row" style="background-color: white; border-radius:20px;">
							<div class="col-md-2">
								<div class="card-body">
									<img class="img-profile rounded-circle" src="<?= base_url('public/img/org1.png') ?>">
								</div>
							</div>
							<div class="col-md-2">
								<div class="card-body" style="margin-top: 15px;">
									<a>Topik</a>
									<br>
									<a>Dosen Ahli</a>
									<br>
									<a>Waktu</a>
								</div>
							</div>
							<div class="col-md-6">
							<div class="card-body" style="margin-top: 15px;">
									<a>: Pemrograman Dasar</a>
									<br>
									<a>: Dr. Haryono, M. Kom - Universitas Indonesia</a>
									<br>
									<a>: 12 Maret 2023 | 14.00-15.00 WIB</a>
								</div>
							</div>
							<div class="col-md-2">
								<button type="button" class="btn btn-success" style="margin-top:60px;">Ikuti Sesi</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
    
<?= $this->include('include/footer') ?>