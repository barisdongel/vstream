<?php include 'header.php' ?>
<?php include 'sidebar.php';

$url = $_SERVER['QUERY_STRING'];
if ($url == '' || $url == NULL || $url == 'durum=ok' || $url == 'durum=no') {
	$kategorisor = $db->prepare("SELECT * FROM video_tbl inner join kategori_tbl on kategori_tbl.kategori_id=video_tbl.video_kategori");
	$kategorisor->execute();

	$videosor = $db->prepare("SELECT * FROM video_tbl ORDER BY id ASC limit 20");
	$videosor->execute();
	$say = $videosor->rowCount();
} else {
	$kategorisor = $db->prepare("SELECT * FROM video_tbl inner join kategori_tbl on kategori_tbl.kategori_id=video_tbl.video_kategori where video_kategori=:video_kategori");
	$kategorisor->execute(array('video_kategori' => $_GET['video_kategori']));

	$videosor = $db->prepare("SELECT * FROM video_tbl where video_kategori=:video_kategori");
	$videosor->execute(array('video_kategori' => $_GET['video_kategori']));
}
if (isset($_POST['arama'])) {
	$aranan = $_POST['aranan'];
	$videosor = $db->prepare("SELECT * FROM video_tbl WHERE video_baslik LIKE '%$aranan%' ORDER BY id ASC limit 20");
	$videosor->execute();
	$say = $videosor->rowCount();
}
$kategoriso1 = $db->prepare("SELECT * FROM kategori_tbl");
$kategoriso1->execute();
?>
<!-- Main Content -->
<div class="main-content">
	<div class="col-12 col-md-12 col-lg-12">
		<div class="card">
			<h4 class="text-center p-3">Videolar</h4>
			<h6 class="text-center p-3">Video Kategorileri:</h6>
			<div class="card-header bg-primary justify-content-center">
				<td><a href="video.php" class="ktgry btn p-3 text-center text-white">TÜM MODELLER</a></td>
				<?php while ($kategorice1 = $kategoriso1->fetch(PDO::FETCH_ASSOC)) { ?>
					<style media="screen">
						.ktgry {
							transition: .4s;
							border-radius: 0px !important;
						}

						.ktgry:hover {
							color: #e91e63 !important;
						}
					</style>
					<td><a style="color:#fff;" href="video.php?video_kategori=<?= $kategorice1['kategori_id'] ?>" class="ktgry btn p-3 text-center"><?= $kategorice1['kategori_ad']; ?></a></td>
				<?php } ?>
			</div>
			<form action="" method="POST">
				<div class="input-group col-md-6 m-2">
					<i style="border: 0.1px solid #e91e63; background-color: #e91e63; color: #fff;" class="fa fa-search p-2"></i>
					<input style="border: 1px solid #e91e63;" type="text" name="aranan" class="form-control" placeholder="Aramak istediğiniz video adı...">
					<button style="border-radius: 0px;" type="submit" name="arama" class="btn btn-primary">Ara!</button>
				</div>
			</form>
		</div>
	</div>

	<a href="video-ekle.php" class="btn btn-success my-3 mx-3" style="float: right;"><i class="fa fa-plus"></i> Yeni Ekle</a>
	<form action="../islem.php" method="POST">
		<table class="table table-striped table-md text-center" id="example">
			<thead>
				<tr>
					<th class="text-center">Video Kapak Resim</th>
					<th class="text-center">Video Başlık</th>
					<th class="text-center">Video Kategori</th>
					<th class="text-center">Slider</th>
					<th class="text-center">Aktif</th>
					<th class="text-center">
						İşlemler
					</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($videocek = $videosor->fetch(PDO::FETCH_ASSOC)) {
					$id = $videocek['id'];
				?>
					<tr>
						<td><img src="../<?= $videocek['video_kapak'] ?>" alt="banner" width="200"></td>
						<td class="text-center"><?= $videocek['video_baslik'] ?></td>
						<?php $kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC); ?>
						<td><?= $kategoricek['kategori_ad']; ?></td>
						<td class="text-center">
							<?php echo ($videocek['video_slider'] == 1 ? '<p class="alert alert-success rounded-pill">Slider</p>' : '<p class="alert alert-danger rounded-pill">Slider Değil</p>') ?>
						</td>
						<td class="text-center">
							<?php echo ($videocek['isActive'] == 1 ? '<p class="alert alert-success rounded-pill">Aktif</p>' : '<p class="alert alert-danger rounded-pill">Pasif</p>') ?>
						</td>
						<td>
							<a href="video-duzenle.php?id=<?= $videocek['id'] ?>" class="btn btn-outline-info rounded-pill mx-2 px-2"><i class="fa fa-pencil-alt"></i> Düzenle</a>
							<a href="../islem.php?videosil=ok&id=<?= $videocek['id'] ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-outline-primary rounded-pill mx-2 px-2"><i class="fa fa-trash"></i> Sil</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<div class="col-md-12 text-right">
			<a class="btn btn-warning" href="index.php"><i class="fa fa-long-arrow-alt-left"></i> Geri Dön</a>
		</div>
	</form>
</div>
<?php include 'footer.php' ?>