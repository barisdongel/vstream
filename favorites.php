<?php
include 'header.php';

//kategorilere göre videoları listeleme
$listesor = $db->prepare("SELECT * FROM list_tbl WHERE uye_id=:uye");
$listesor->execute(array('uye' => $_SESSION['kullanici_id']));
$listecek = $listesor->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="page-nav p-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <div class="search-wrapper">
                    <h2 class="mb-3">Daha Sonra İzleme Listem</h2>
                    <p class="mb-0">Listenizi bu sayfadan düzenleyebilirsiniz.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- slider wrapper -->
<div class="slide-wrapper search-wrap-slide mt-4">
    <div class="container">

        <div class="row">
            <?php foreach ($listecek as $row) {
                $videosor = $db->prepare("SELECT * FROM video_tbl WHERE id=:list_id AND isActive = 1");
                $videosor->execute(array(
                    'list_id' => $row['video_id']
                ));
                $videocek = $videosor->fetchAll(PDO::FETCH_ASSOC);

                foreach ($videocek as $rows) { ?>
                    <div class="col-md-4 col-lg-3 mb-3">
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
            <?php }
            } ?>
        </div>
    </div>
</div>
<!-- slider wrapper -->

<?php include 'footer.php' ?>