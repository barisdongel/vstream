<?php
include 'header.php';
$kategori_id = $_GET['kategori_id'];
//kategori çek
$kategorisor = $db->prepare("SELECT * FROM kategori_tbl WHERE kategori_id=:kategori_id");
$kategorisor->execute(array('kategori_id' => $kategori_id));
$kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC);
//kategorilere göre videoları listeleme
$videosor = $db->prepare("SELECT * FROM video_tbl WHERE video_kategori=:kategori_id");
$videosor->execute(array('kategori_id' => $kategori_id));
$videocek = $videosor->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-nav p-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="search-wrapper">
                    <h2 class="mb-3"><?= $kategoricek['kategori_ad'] ?></h2>
                    <p class="mb-0">Kategoriye ait videolar aşağıda listelenmiştir.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- slider wrapper -->
<div class="slide-wrapper search-wrap-slide mt-4">
    <div class="container">

        <div class="row">
            <?php foreach ($videocek as $rows) { ?>
                <div class="col-md-4 col-lg-3 mb-3">
                    <a class="slide-one" href="">
                        <div class="slide-image"><img src="<?= $rows['video_kapak'] ?>" alt="image"></div>
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
<!-- slider wrapper -->

<?php include 'footer.php' ?>