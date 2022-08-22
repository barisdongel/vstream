<?php
include 'header.php';
$alt_ustid = $_GET['alt_ustid'];

//alt kategori çek
$altsor = $db->prepare("SELECT * FROM alt_kategori WHERE alt_id=:alt_ustid");
$altsor->execute(array('alt_ustid' => $alt_ustid));
$altcek = $altsor->fetch(PDO::FETCH_ASSOC);

//kategorilere göre videoları listeleme
$videosor = $db->prepare("SELECT * FROM video_tbl WHERE video_alt_kategori=:alt_ustid");
$videosor->execute(array('alt_ustid' => $alt_ustid));
$videocek = $videosor->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-nav p-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="search-wrapper">
                    <h2 class="mb-3"><?= $altcek['alt_ad'] ?></h2>
                    <p class="mb-0 pt-5"><?php if ($videocek) echo 'Kategoriye ait videolar aşağıda listelenmiştir.' ?></p>
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
<!-- slider wrapper -->

<?php include 'footer.php' ?>