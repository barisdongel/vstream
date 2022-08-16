<?php include 'header.php' ?>
<?php include 'sidebar.php';
$kullanicisor = $db->prepare("SELECT * FROM kkayit_tbl");
$kullanicisor->execute();
$kullanicicek = $kullanicisor->fetchAll(PDO::FETCH_ASSOC);
?>
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
				<?php foreach ($kullanicicek as $row) { ?>
					<tr>
						<td><?= $row['kullanici_ad']; ?></td>
						<td><?= $row['kullanici_mail']; ?></td>
						<td><?= $row['kullanici_telefon']; ?></td>
						<td><?= $row['tarih']; ?></td>
						<td>
							<?php
							if ($row['onay'] == 0) {
							?>
								<a href="../islem.php?kayitonayla=ok&id=<?= $row['id'] ?>" class="btn btn-success">Onayla</a>
							<?php } else { ?>
								<button disabled class="btn btn-secondary">Onaylandı</button>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
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