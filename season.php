<?php
include 'header.php';
$video_id = $_GET['id'];
//kategori çek
$videosor = $db->prepare("SELECT * FROM video_tbl WHERE id=:video_id");
$videosor->execute(array('video_id' => $video_id));
$videocek = $videosor->fetch(PDO::FETCH_ASSOC);

$kategori = $videocek['video_kategori'];
$kategorisor = $db->prepare("SELECT * FROM kategori_tbl WHERE kategori_id=:video_kategori");
$kategorisor->execute(array(
    'video_kategori' => $kategori
));
$kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);

$sonvideolar = $db->prepare("SELECT * FROM video_tbl ORDER BY video_tarih DESC");
$sonvideolar->execute(array());
$videolar = $sonvideolar->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- banenr wrapper -->
<div class="banner-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="banner-wrap justify-content-between align-items-center">
                    <div class="left-wrap">
                        <h2><?= $videocek['video_baslik'] ?></h2>
                        <span class="tag"><?= $kategoricek['kategori_ad'] ?></span>
                        <p><?= $videocek['video_aciklama'] ?></p>
                        <?php if ($kullanicicek['kullanici_yetki'] <= 2) { ?>
                            <a href="video.php?id=<?= $videocek['id'] ?>" class="btn btn-lg"><img src="images/play.png" alt="icn">Şimdi İzle</a>
                            <a href="<?= $videocek['video_documents'] ?>" download class="btn btn-lg bg-warning <?= (empty($videocek['video_documents']) ? 'd-none' : '') ?>"><i class="fa fa-download"></i> Video Dökümanlarını İndir</a>
                        <?php } else { ?>
                            <button class="btn btn-lg bg-danger"><img src="images/play.png" alt="icn">Üyelik Satın Almanız Gerekmektedir.</button>
                        <?php } ?>
                        <a href="#" class="icon-bttn"><i class="ti-plus text-white"></i></a>
                    </div>
                    <div class="right-wrap">
                        <video autoplay muted loop id="myVideo">
                            <source src="<?php echo (!empty($videocek['video_url']) ? $videocek['video_url'] : $videocek['video_file']) ?>" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banenr wrapper -->

<!-- slider wrapper -->
<div class="slide-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-left mb-4 mt-4">
                <h2>Son Eklenen Videolar</h2>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="slide-slider-full owl-carousel owl-theme">
                    <?php foreach ($videolar as $rows) { ?>
                        <div class="owl-items">
                            <a class="slide-one" href="season.php?id=<?= $rows['id'] ?>">
                                <div class="slide-image"><img src="<?= $rows['video_kapak'] ?>" alt="image" height="300"></div>
                                <div class="slide-content">
                                    <h2>
                                        <?= $rows['video_baslik'] ?>
                                        <img src="images/plus.png" alt="icon">
                                    </h2>
                                    <p><?= kisalt($rows['video_aciklama'], 200) ?></p>
                                    <span class="tag"><?= $rows['video_tarih'] ?></span>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider wrapper -->

<?php include 'footer.php' ?>