<!-- banner wrapper -->
<?php
$altsor = $db->prepare("SELECT * FROM alt_kategori ORDER BY alt_id DESC LIMIT 5");
$altsor->execute(array(0));
$altcek = $altsor->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="banner-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="banner-slider owl-carousel owl-theme">
                    <?php foreach ($altcek as $row) { ?>
                        <div class="owl-items">
                            <div class="banner-wrap justify-content-between align-items-center">
                                <div class="left-wrap">
                                    <h2><?= $row['alt_ad'] ?></h2>
                                    <p><?= kisalt($row['alt_aciklama'], 200) ?></p>
                                    <a href="alt-kategori.php?alt_ustid=<?= $row['alt_id'] ?>" class="btn btn-lg"><img src="images/play.png" alt="icn">Kursa Git</a>
                                </div>
                                <div class="right-wrap" style="background-image: url(<?= $row['alt_foto'] ?>);"></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banenr wrapper -->