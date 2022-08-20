<?php
include 'header.php';
$arama = $_POST['arama'];
$videosor = $db->prepare("SELECT * FROM video_tbl WHERE video_baslik LIKE '%$arama%' ORDER BY video_tarih DESC limit 20");
$videosor->execute();
$say = $videosor->rowCount();
$videocek = $videosor->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="page-nav p-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="search-wrapper">
                    <h2 class="mb-3">"<?= $arama ?>"'ya ilişkin <?= $say ?> adet sonuç bulundu.</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- slider wrapper -->
<div class="slide-wrapper search-wrap-slide">
    <div class="container">

        <div class="row">
            <div class="col-sm-12 mt-4">
                <div class="slide-slider owl-carousel owl-theme">
                    <?php foreach ($videocek as $rows) { ?>
                        <div class="owl-items">
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
    </div>
</div>
<?php include 'footer.php' ?>