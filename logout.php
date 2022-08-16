<?php 
session_start();
unset($_SESSION['kullanici_ad']);

header('Location:signin.php?durum=1');
 ?>