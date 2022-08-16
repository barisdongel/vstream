<?php include 'header.php' ?>
<?php include 'sidebar.php';
$videosor = $db->prepare("SELECT * FROM video_tbl where id=:id");
$videosor->execute(array("id" => $_GET['id']));
$videocek = $videosor->fetch(PDO::FETCH_ASSOC);
?>
<!-- Main Content -->
<div class="main-content">
	<div class="col-12 col-md-12 col-lg-12">
		<div class="card">
			<div class="card-header">
				<h4>Video Düzenle</h4>
			</div>
			<form action="../islem.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?=$videocek['id']?>">
				<div class="card-body">
					<div class="form-group">
						<img src="../<?= $videocek['video_kapak'] ?>" alt="kapak" width="300"><br>
						<label><i class="fa fa-image"></i> Video Kapak Fotoğrafı</label>
						<input style="height: 50px;" type="file" name="video_kapak" class="form-control">
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label><i class="fa fa-video"></i> Video Türü</label>
							<select class="form-select" aria-label="Default select example" id="video-tur">
								<option value="1">URL</option>
								<option value="2">Upload</option>
							</select>
						</div>
						<div class="form-group d-none col-md-6" id="upload">
							<?php if (!empty($videocek['video_file'])) { ?>
								<video width="100%" height="400" controls>
									<source src="../<?= $videocek['video_file'] ?>" type="video/mp4">
									Your browser does not support the video tag.
								</video> <br>
								<a href="../islem.php?videoFilesil=ok&id=<?= $videocek['id'] ?>" onclick="return confirm('Videoyu silmek istediğinizden emin misiniz ?')" class="btn btn-primary my-2">Videoyu Sil</a><br>
							<?php } ?>
							<label><i class="fas fa-video"></i> Video Upload</label>
							<input style="height: 50px;" type="file" name="video_file" class="form-control">
						</div>
						<div class="form-group d-none col-md-6" id="url">
							<label><i class="fa fa-heading"></i> Video URL</label>
							<input type="text" name="video_url" class="form-control" value="<?= $videocek['video_url'] ?>">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label><i class="fa fa-heading"></i> Video Başlık</label>
							<input type="text" name="video_baslik" class="form-control" value="<?= $videocek['video_baslik'] ?>">
						</div>
						<div class="form-group col-md-6">
							<label><i class="fa fa-list-alt"></i> Video Kategorisi</label>
							<select class="form-control" name="video_kategori">
								<?php
								$kategorisor = $db->prepare("SELECT * FROM kategori_tbl ORDER BY kategori_ad ASC");
								$kategorisor->execute();
								while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
									<option value="<?= $kategoricek['kategori_id'] ?>" <?php echo ($kategoricek['kategori_id'] == $videocek['video_kategori'] ? 'selected' : '') ?>><?= $kategoricek['kategori_ad'] ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label><i class="fa fa-list"></i> Video Açıklama</label>
						<textarea name="video_aciklama" type="submit" id="ckeditor1"><?= $videocek['video_aciklama'] ?></textarea>
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label><i class="fa fa-video"></i> Video Slider'da Görünsün Mü ?</label>
							<select class="form-select" aria-label="Default select example" name="video_slider">
								<option value="1" <?= ($videocek['video_slider'] == 1 ? 'selected' : '') ?>>Evet</option>
								<option value="0" <?= ($videocek['video_slider'] == 0 ? 'selected' : '') ?>>Hayır</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label><i class="fa fa-video"></i> Video Durumu Aktif/Pasif</label>
							<select class="form-select" aria-label="Default select example" name="isActive">
								<option value="1" <?= ($videocek['isActive'] == 1 ? 'selected' : '') ?>>Aktif</option>
								<option value="0" <?= ($videocek['isActive'] == 0 ? 'selected' : '') ?>>Pasif</option>
							</select>
						</div>
					</div>
				</div>
		</div>
		<div class="col-md-12 text-right">
			<a class="btn btn-warning" href="video.php"><i class="fa fa-long-arrow-alt-left"></i> Geri Dön</a>
			<button class="btn btn-info" type="submit" name="videoduzenle">Ekle</button>
		</div>
		</form>
	</div>
</div>
</div>
</div>
<?php include 'footer.php' ?>