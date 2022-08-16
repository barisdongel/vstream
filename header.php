<?php
ob_start();
session_start();
include 'baglan.php';
include 'function.php';

$kullanicisor = $db->prepare("SELECT * FROM kullanici_tbl WHERE kullanici_ad=:ad");
$kullanicisor->execute(array(
    'ad' => $_SESSION['kullanici_ad']
));
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['kullanici_ad'])) {
    header('location:signin.php');
}

//ayarlar
$ayarsor = $db->prepare("SELECT * FROM ayar_tbl WHERE ayar_id=?");
$ayarsor->execute(array(0));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);
//ayarlar son

$kategorisor = $db->prepare("SELECT * FROM kategori_tbl");
$kategorisor->execute();
$kategoricek = $kategorisor->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['aranan'])) {
    $aranan = $_POST['aranan'];
    $videosor = $db->prepare("SELECT * FROM video_tbl WHERE video_baslik LIKE '%$aranan%' ORDER BY id ASC limit 20");
    $videosor->execute();
    $videocek = $videosor->fetchAll(PDO::FETCH_ASSOC);
} else {
    $videosor = $db->prepare("SELECT * FROM video_tbl");
    $videosor->execute();
    $videocek = $videosor->fetchAll(PDO::FETCH_ASSOC);
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
    <!--video player css-->
    <link rel="stylesheet" href="css/video-player.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
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
                        <a href="<?= $ayarcek['ayar_siteurl'] ?>" class="logo"><img src="<?= $ayarcek['ayar_logo'] ?>" alt="logo"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav nav-menu float-none text-center">
                                <?php foreach ($kategoricek as $row) { ?>
                                    <li class="nav-item"><a class="nav-link" href="#"><?= $row['kategori_ad'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="user-avater">
                            <img src="images/user-8.png" alt="user">
                            <div class="user-menu">
                                <ul>
                                    <li><a href="profile.php"><i class="fa-solid fa-user"></i> Profilim</a></li>
                                    <li><a href="favorites.php"><i class="fa-solid fa-clock"></i> Daha Sonra İzle</a></li>
                                    <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Çıkış Yap</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="search-div">
                            <form action="" method="POST">
                                <input type="text" placeholder="Ara..." name="aranan">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header wrapper -->