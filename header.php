<?php
ob_start();
session_start();
include 'baglan.php';
include 'function.php';

//ayarlar
$ayarsor = $db->prepare("SELECT * FROM ayar_tbl WHERE ayar_id=?");
$ayarsor->execute(array(0));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);
//ayarlar son

//kategoriler
$kategorisor = $db->prepare("SELECT * FROM kategori_tbl LIMIT 6");
$kategorisor->execute();
$kategoricek = $kategorisor->fetchAll(PDO::FETCH_ASSOC);

//videolar
$videosor = $db->prepare("SELECT * FROM video_tbl");
$videosor->execute();
$videocek = $videosor->fetchAll(PDO::FETCH_ASSOC);

$kullanici_mail = $_SESSION['kullanici_mail'];
$kullanicisor = $db->prepare("SELECT * FROM kullanici_tbl where kullanici_mail=:mail AND kullanici_id=:id");
$kullanicisor->execute(array(
    'mail' => $kullanici_mail,
    'id' => $_SESSION['kullanici_id']
));
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['kullanici_mail'])) {
    header('location:signin.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $ayarcek['ayar_title'] ?></title>

    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!--Owl Carousel-->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <!--dropify css-->
    <link rel="stylesheet" href="admin/assets/css/dropify.min.css">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="full-wrap">

    <div class="preloader"></div>

    <div class="main-wrapper">
        <!-- header wrapper -->
        <div class="header-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 navbar p-0">
                        <nav class="navbar navbar-expand-lg bg-light Montserrat">
                            <a href="<?= $ayarcek['ayar_siteurl'] ?>" class="logo"><img src="<?= $ayarcek['ayar_logo'] ?>" alt="logo"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                <ul class="navbar-nav fw-bold">
                                    <?php foreach ($kategoricek as $row) { ?>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-dark" href="categories.php?kategori_id=<?=$row['kategori_id']?>" data-bs-toggle="dropdown">
                                                <?= $row['kategori_ad'] ?>
                                            </a>
                                            <ul class="dropdown-menu p-0">
                                                <?php
                                                //alt kategoriler
                                                $altkategori = $db->prepare("SELECT * FROM alt_kategori WHERE alt_ustid=:id");
                                                $altkategori->execute(array('id' => $row['kategori_id']));
                                                $altcek = $altkategori->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($altcek as $alt) { ?>
                                                    <li class="p-2 border-bottom">
                                                        <a class="text-decoration-none" href="alt-kategori.php?alt_ustid=<?= $alt['alt_id'] ?>" style="text-transform:uppercase;">
                                                            <?= $alt['alt_ad'] ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-lg-4">

                        <div class="user-avater">
                            <img src="<?= $kullanicicek['kullanici_foto'] ?>" alt="user">
                            <div class="user-menu">
                                <ul>
                                    <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profilim</a></li>
                                    <li><a href="favorites.php"><i class="fa-solid fa-clock"></i> Daha Sonra İzle</a></li>
                                    <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Çıkış Yap</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="search-div">
                            <form action="search.php" method="POST">
                                <input type="text" placeholder="Ara..." name="arama">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header wrapper -->