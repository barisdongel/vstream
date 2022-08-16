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
                                <input type="hidden" name="video_id" value="<?=$rows['id']?>">
                                <input type="hidden" name="uye_id" value="<?=$kullanicicek['id']?>">
                                <button class="btn btn-outline-dark rounded-0 my-2" name="dahasonraizle"> <i class="fa fa-clock"></i> Daha Sonra İzle</button>
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
                    <div class="owl-items">
                        <a class="slide-one" href="season.html">
                            <div class="slide-image"><img src="images/s9.jpg" alt="image"></div>
                            <div class="slide-content">
                                <h2>Second Man of Earth <img src="images/plus.png" alt="icon"></h2>
                                <p>Radhe is a singing prodigy determined to follow in the classical footsteps of his grandfather.</p>
                                <span class="tag">2 h 20 min</span>
                                <span class="tag">2020</span>
                                <span class="tag"><b>HD</b></span>
                                <span class="tag"><b>16+</b></span>
                            </div>
                        </a>
                    </div>
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
                    <div class="owl-items">
                        <a href="search.html" class="category-wrap" style="background-image: url(images/gb1.png);"><span>Spanish</span></a>
                    </div>

                    <div class="owl-items">
                        <a href="search.html" class="category-wrap" style="background-image: url(images/gb2.png);"><span>Romania</span></a>
                    </div>
                    <div class="owl-items">
                        <a href="search.html" class="category-wrap" style="background-image: url(images/gb3.png);"><span>English</span></a>
                    </div>
                    <div class="owl-items">
                        <a href="search.html" class="category-wrap" style="background-image: url(images/gb4.png);"><span>Swiss</span></a>
                    </div>

                    <div class="owl-items">
                        <a href="search.html" class="category-wrap" style="background-image: url(images/gb2.png);"><span>Italina</span></a>
                    </div>

                    <div class="owl-items">
                        <a href="search.html" class="category-wrap" style="background-image: url(images/gb3.png);"><span>Urdu</span></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- slider wrapper -->