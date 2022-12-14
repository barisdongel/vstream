<?php
ob_start();
session_start();
include '../baglan.php';
include 'function.php';

$ayarsor = $db->prepare("SELECT * FROM ayar_tbl WHERE ayar_id=?");
$ayarsor->execute(array(0));
$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);

$admin_ad = $_SESSION['admin_ad'];
$adminsor = $db->prepare("SELECT * FROM admin_tbl where admin_ad=:ad AND admin_id=:id");
$adminsor->execute(array(
  'ad' => $admin_ad,
  'id' => $_SESSION['admin_id']
));
$kullanicicek = $adminsor->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['admin_ad'])) {

  header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $ayarcek['ayar_title'] ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="assets/bundles/flag-icon-css/css/flag-icon.min.css">
  <!-- dropzone css -->
  <link rel="stylesheet" href="assets/dropzone/dist/dropzone.css">
  <link rel="stylesheet" href="assets/dropzone/dist/basic.css">
  <!--Bootstrap-->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <!-- Custom style CSS -->
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <!--dropify-->
  <link rel="stylesheet" href="assets/css/dropify.min.css">
  <!--datatables-->
  <link rel="stylesheet" href="assets/css/datatables.min.css">
 
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                <i class="fas fa-expand"></i>
              </a>
            </li>
            <li><a class="nav-link nav-link-lg" href="<?= $ayarcek['ayar_siteurl'] ?>" target="_blank"><i class="fas fa-external-link-alt"></i> Siteye Git</a> </li>
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="../<?= $kullanicicek['admin_foto'] ?>" class="user-img-radious-style">
              <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Ho??geldin <?= $_SESSION['admin_ad'] ?></div>
              <a href="javascript:void(0)" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profil
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> ????k???? Yap
              </a>
            </div>
          </li>
        </ul>
      </nav>