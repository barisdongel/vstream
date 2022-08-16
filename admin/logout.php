<?php 
session_start();
unset($_SESSION['kullanici_ad']);

header('Location:login.php?durum=1');
 ?>