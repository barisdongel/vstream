<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<!-- Main Content -->
<div class="main-content">
	<div class="col-12 col-md-12 col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Kayıt Talepleri</h4>
			</div>
			<table class="table table-striped table-md">
				<tr>
					<th>Kullanıcı Adı</th>
					<th>Kullanıcı Maili</th>
					<th>Kullanıcı Telefonu</th>
					<th>Kullanıcı Kayıt Talebi Tarihi</th>
					<th></th>
				</tr>
				<?php
				$kayitsor = $db->prepare("SELECT * FROM kkayit_tbl");
				$kayitsor->execute();
				$kayitcek = $kayitsor->fetchAll(PDO::FETCH_ASSOC);
				foreach ($kayitcek as $kayit) {
					$kullanici_token = $kayit['kullanici_token'];
					$kullanicisor = $db->prepare("SELECT * FROM kullanici_tbl WHERE kullanici_token=:token");
					$kullanicisor->execute(array(
						'token' => $kullanici_token
					));
					$kullanicicek = $kullanicisor->fetchAll(PDO::FETCH_ASSOC);

					foreach ($kullanicicek as $row) {
				?>
						<tr>
							<td><?= $row['kullanici_ad']; ?></td>
							<td><?= $row['kullanici_mail']; ?></td>
							<td><?= $row['kullanici_tel']; ?></td>
							<td><?= $kayit['tarih']; ?></td>
							<td>
								<?php
								if ($kayit['onay'] == 0) {
								?>
									<form action="../islem.php" method="POST">
										<input type="hidden" name="kullanici_token" value="<?= $kullanici_token ?>">
										<button type="submit" class="btn btn-success" name="kayitonayla">Onayla</button>
									</form>
								<?php } else { ?>
									<button disabled class="btn btn-secondary">Onaylandı</button>
								<?php } ?>
							</td>
						</tr>
				<?php }
				} ?>
			</table>
		</div>
		<div class="col-md-12 text-right">
			<a class="btn btn-warning" href="index.php"><i class="fa fa-long-arrow-alt-left"></i> Geri Dön</a>
		</div>
	</div>
</div>
</div>
</div>
<?php include 'footer.php' ?>