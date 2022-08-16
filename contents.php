<!-- slider wrapper -->
<div class="slide-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-left mb-4 mt-4">
                <h2>Son Eklenen Dersler</h2>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="slide-slider-full owl-carousel owl-theme">
                    <?php
                    $videosor = $db->prepare("SELECT * FROM video_tbl WHERE isActive = 1 ORDER BY video_tarih DESC");
                    $videosor->execute(array(0));
                    $videocek = $videosor->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($videocek as $rows) { ?>
                        <div class="owl-items">
                            <form action="islem.php" method="POST">
                                <input type="hidden" name="video_id" value="<?= $rows['id'] ?>">
                                <input type="hidden" name="uye_id" value="<?= $kullanicicek['kullanici_id'] ?>">
                                <?php
                                $listecek = $db->prepare("SELECT * FROM list_tbl WHERE uye_id=:uye AND video_id=:video");
                                $listecek->execute(array(
                                    'uye' => $kullanicicek['kullanici_id'],
                                    'video' => $rows['id']
                                ));
                                $listesor = $listecek->fetch(PDO::FETCH_ASSOC);
                                if (isset($listesor['video_id']) == $rows['id']) { ?>
                                    <button class="btn btn-outline-danger rounded-0 my-2" name="dahasonraizle"> <i class="fa fa-clock"></i> Listeden Kaldır</button>
                                <?php } else { ?>
                                    <button class="btn btn-outline-dark rounded-0 my-2" name="dahasonraizle"> <i class="fa fa-clock"></i> Daha Sonra İzle</button>
                                <?php } ?>
                            </form>
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
<!-- slider wrapper -->
<!-- slider wrapper -->
<div class="slide-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-left mb-4 mt-4">
                <h2>Daha Sonra İzlemek İstediklerim</h2>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="slide-slider-full owl-carousel owl-theme">
                    <?php
                    $listecek = $db->prepare("SELECT * FROM list_tbl WHERE uye_id=:uye");
                    $listecek->execute(array(
                        'uye' => $kullanicicek['kullanici_id']
                    ));
                    $listesor = $listecek->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listesor as $row) {
                        $videosor = $db->prepare("SELECT * FROM video_tbl WHERE id=:list_id AND isActive = 1");
                        $videosor->execute(array(
                            'list_id' => $row['video_id']
                        ));
                        $videocek = $videosor->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($videocek as $rows) { ?>
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
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider wrapper -->

<!-- slider wrapper -->
<div class="category-wrapper slide-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-left mb-4 mt-4">
                <h2>Kategoriler</h2>
            </div>

        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="category-slider owl-carousel owl-theme">
                    <?php
                    $kategorisor = $db->prepare("SELECT * FROM kategori_tbl");
                    $kategorisor->execute();
                    $kategoricek = $kategorisor->fetchAll(PDO::FETCH_ASSOC);
                    $i = 1;
                    foreach ($kategoricek as $row) {
                    ?>
                        <div class="owl-items">
                            <a href="#" class="category-wrap" style="background-image: url(images/gb<?= $i ?>.png);"><span><?= $row['kategori_ad'] ?></span></a>
                        </div>
                    <?php
                        if ($i >= 4) {
                            $i = 0;
                        }
                        $i++;
                    } ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider wrapper -->