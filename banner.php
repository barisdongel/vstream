<!-- banner wrapper -->
<?php
$videosor = $db->prepare("SELECT * FROM video_tbl WHERE video_slider = 1 AND isActive = 1");
$videosor->execute(array(0));
$videocek = $videosor->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="banner-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="banner-slider owl-carousel owl-theme">
                    <?php foreach ($videocek as $row) { ?>
                        <div class="owl-items">
                            <div class="banner-wrap justify-content-between align-items-center">
                                <div class="left-wrap">
                                    <h2><?= $row['video_baslik'] ?></h2>
                                    <span class="tag"><?= $row['video_tarih'] ?></span>
                                    <p><?= kisalt($row['video_aciklama'], 200) ?></p>
                                    <a href="#" class="btn btn-lg"><img src="images/play.png" alt="icn">Oynat</a>
                                </div>
                                <div class="right-wrap" style="background-image: url(<?= $row['video_kapak'] ?>);"></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banenr wrapper -->