<?php 
session_start();
unset($_SESSION['kullanici_id']);

header('Location:signin.php?durum=1');
 ?>