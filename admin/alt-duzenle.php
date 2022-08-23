<?php include 'header.php' ?>
<?php include 'sidebar.php';
$kategorisor = $db->prepare("SELECT * FROM alt_kategori where alt_id=:alt_id");
$kategorisor->execute(array("alt_id" => $_GET['alt_id']));
$kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);
?>
<!-- Main Content -->
<div class="main-content">
	<div class="col-12 col-md-12 col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Alt Kategori Düzenle</h4>
			</div>
			<form action="../islem.php" method="POST" enctype="multipart/form-data">

				<input type="hidden" name="alt_id" value="<?php echo $kategoricek['alt_id']; ?>">
				<div class="form-group">
					<img src="../<?php echo $kategoricek['alt_foto'] ?>" alt="foto" width="300"><br>
					<label><i class="fa fa-image"></i> Kategori Fotoğrafı</label>
					<input style="height: 50px;" type="file" name="alt_foto" class="form-control">
				</div>
				<div class="card-body">
					<div class="form-group">
						<label><i class="fa fa-heading"></i> Kategori Ad</label>
						<input type="text" name="alt_ad" value="<?php echo $kategoricek['alt_ad'] ?>" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label><i class="fas fa-list-ol"></i> Kategori Açıklaması</label>
					<textarea rows="8" name="alt_aciklama" class="form-control" id="ckeditor1"><?php echo $kategoricek['alt_aciklama'] ?></textarea>
				</div>
				<div class="card-body">
					<div class="form-group">
						<label><i class="fa fa-list-alt"></i> Üst Kategorisi</label>
						<select class="form-control" name="alt_ustid">
							<?php
							$kategoriso2 = $db->prepare("SELECT * FROM kategori_tbl");
							$kategoriso2->execute() ?>
							<?php while ($kategorice1 = $kategoriso2->fetch(PDO::FETCH_ASSOC)) { ?>
								<option value="<?= $kategorice1['kategori_id'] ?>"><?= $kategorice1['kategori_ad'] ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
		</div>
		<div class="col-md-12 text-right">
			<a class="btn btn-warning" href="alt-kategori.php"><i class="fa fa-long-arrow-alt-left"></i> Geri Dön</a>
			<button class="btn btn-info" type="submit" name="altkategoriduzenle">Ekle</button>
		</div>
		</form>
	</div>
</div>
</div>
</div>
<?php include 'footer.php' ?>