<?php
ob_start();
session_start();
include 'baglan.php';

/*
GÜNCELLEME İŞLEMLERİ
*/

//Profil Güncelleme işlemi
if (isset($_POST['profilguncelle'])) {
	$kullanicisor = $db->prepare("SELECT * FROM kullanici_tbl");
	$kullanicisor->execute(array(0));
	$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

	if ($_FILES['kullanici_foto']['size'] != 0) {
		$uploads_dir = 'images/users/';
		@$tmp_name = $_FILES['kullanici_foto']["tmp_name"];
		@$name = $_FILES['kullanici_foto']["name"];
		$random = rand(1000, 9999);
		$refimgyol = $uploads_dir . $random . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$random$name");
	} else {
		$refimgyol = $kullanicicek['kullanici_foto'];
	}

	$kullanicikaydet = $db->prepare("UPDATE kullanici_tbl SET
		kullanici_foto=:foto,
		kullanici_mail=:mail,
		kullanici_ad=:ad,
		kullanici_hakkinda=:hakkinda,
		kullanici_tel=:tel,
		kullanici_adsoyad=:adsoyad
		WHERE kullanici_id=:id
		");
	$update = $kullanicikaydet->execute(array(
		'id' => $_POST['kullanici_id'],
		'mail' => $_POST['kullanici_mail'],
		'ad' => $_POST['kullanici_ad'],
		'hakkinda' => $_POST['kullanici_hakkinda'],
		'tel' => $_POST['kullanici_tel'],
		'adsoyad' => $_POST['kullanici_adsoyad'],
		'foto' => $refimgyol
	));

	if ($update) {
		echo "<script>
			alert('Profiliniz güncellendi.');
			window.location.href='profile.php';
			</script>";
	} else {
		echo "<script>
			alert('Bir sorun oluştu.');
			window.location.href='profile.php';
			</script>";
	}
}

//Şifre Güncelleme işlemi
if (isset($_POST['sifreguncelle'])) {
	if (md5($_POST['kullanici_sifre']) != md5($_POST['kullanici_sifre2'])) {
		echo "<script>
			alert('Şifreler uyuşmuyor.');
			window.location.href='profile.php';
			</script>";
	} else {
		$kullanicikaydet = $db->prepare("UPDATE kullanici_tbl SET
		kullanici_sifre=:sifre
		WHERE kullanici_id=:id
		");
		$update = $kullanicikaydet->execute(array(
			'id' => $_POST['kullanici_id'],
			'sifre' => md5($_POST['kullanici_sifre'])
		));

		if ($update) {
			echo "<script>
			alert('Şifreniz değiştirildi.');
			window.location.href='profile.php';
			</script>";
		} else {
			echo "<script>
			alert('Bir sorun oluştu.');
			window.location.href='profile.php';
			</script>";
		}
	}
}

//Genel Ayarlar Güncelleme şlemi
if (isset($_POST['ayarguncelle'])) {

	$ayarsor = $db->prepare("SELECT * FROM ayar_tbl");
	$ayarsor->execute(array(0));
	$ayarcek = $ayarsor->fetch(PDO::FETCH_ASSOC);

	if ($_FILES['ayar_logo']['size'] != 0) {
		$uploads_dir = 'images/';
		@$tmp_name = $_FILES['icon']["tmp_name"];
		@$name = $_FILES['icon']["name"];
		$random = rand(1000, 9999);
		$refimgyol = $uploads_dir . $random . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$random$name");
	} else {
		$refimgyol = $ayarcek['ayar_logo'];
	}

	$ayarkaydet = $db->prepare("UPDATE ayar_tbl SET
		ayar_siteurl=:siteurl,
		ayar_title=:title,
		ayar_desc=:description,
		ayar_author=:author,
		ayar_key=:key,
		ayar_baslik=:baslik,
		ayar_footer=:footer,
		ayar_logo=:logo,
		ayar_googlemap=:map,
		ayar_calismasaatleri=:saat
		WHERE ayar_id=0
		");
	$update = $ayarkaydet->execute(array(
		'siteurl' => $_POST['ayar_siteurl'],
		'title' => $_POST['ayar_title'],
		'description' => $_POST['ayar_desc'],
		'author' => $_POST['ayar_author'],
		'key' => $_POST['ayar_key'],
		'baslik' => $_POST['ayar_baslik'],
		'footer' => $_POST['ayar_footer'],
		'map' => $_POST['ayar_googlemap'],
		'saat' => $_POST['ayar_calismasaatleri'],
		'logo' => $refimgyol
	));

	if ($update) {
		Header("Location:admin/ayarlar.php?durum=ok");
	} else {
		Header("Location:admin/ayarlar.php?durum=no");
	}
}
//İletişim Ayarları Güncelleme İşlemi
if (isset($_POST['iletisimguncelle'])) {

	$iletisimkaydet = $db->prepare("UPDATE ayar_tbl SET
		ayar_adres=:adres,
		ayar_il=:il,
		ayar_ilce=:ilce,
		ayar_tel=:tel,
		ayar_mail=:mail,
		ayar_facebook=:facebook,
		ayar_twitter=:twitter,
		ayar_instagram=:instagram,
		ayar_linkedin=:linkedin
		WHERE ayar_id=0
		");
	$update = $iletisimkaydet->execute(array(
		'adres' => $_POST['ayar_adres'],
		'il' => $_POST['ayar_il'],
		'ilce' => $_POST['ayar_ilce'],
		'tel' => $_POST['ayar_tel'],
		'mail' => $_POST['ayar_mail'],
		'facebook' => $_POST['ayar_facebook'],
		'twitter' => $_POST['ayar_twitter'],
		'instagram' => $_POST['ayar_instagram'],
		'linkedin' => $_POST['ayar_linkedin']
	));

	if ($update) {
		Header("Location:admin/iletisim.php?durum=ok");
	} else {
		Header("Location:admin/iletisim.php?durum=no");
	}
}


/*VİDEO İŞLEMLERİ*/

//video Ekleme
if (isset($_POST['videoekle'])) {

	if (isset($_FILES['video_kapak'])) {
		$uploads_dir = 'images/video-thumbnail/';
		@$tmp_name = $_FILES['video_kapak']["tmp_name"];
		@$name = $_FILES['video_kapak']["name"];
		$sayi1 = rand(10000, 99999);
		$refimgyol = $uploads_dir . $sayi1 . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$sayi1$name");
	} else {
		$refimgyol = '';
	}

	if (isset($_FILES['video_documents'])) {
		$uploads_dir = 'video/docs/';
		@$tmp_name = $_FILES['video_documents']["tmp_name"];
		@$name = $_FILES['video_documents']["name"];
		$sayi1 = rand(10000, 99999);
		$docyol = $uploads_dir . $sayi1 . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$sayi1$name");
	} else {
		$docyol = '';
	}

	if ($_FILES['video_file']['size'] > 0) {
		$icon_dir = 'video/';
		@$tmp_icon = $_FILES['video_file']["tmp_name"];
		@$icon = $_FILES['video_file']["name"];
		$sayi1 = rand(10000, 99999);
		$fileyol = $icon_dir . $sayi1 . $icon;
		@move_uploaded_file($tmp_icon, "$icon_dir/$sayi1$icon");
		$videourl = '';
	} else {
		$fileyol = '';
	}

	$videokaydet = $db->prepare("INSERT INTO video_tbl SET
		video_baslik=:baslik,
		video_aciklama=:aciklama,
		video_kategori=:kategori,
		video_alt_kategori=:altkategori,
		video_kapak=:foto,
		video_url=:vurl,
		video_file=:vfile,
		video_documents=:docs,
		video_tarih=:tarih,
		video_slider=:slider,
		isActive=:active
		");
	$insert = $videokaydet->execute(array(
		'baslik' => $_POST['video_baslik'],
		'aciklama' => $_POST['video_aciklama'],
		'kategori' => $_POST['video_kategori'],
		'altkategori' => $_POST['video_alt_kategori'],
		'foto' => $refimgyol,
		'vurl' => $_POST['video_url'],
		'vfile' => $fileyol,
		'docs' => $docyol,
		'tarih' => date("Y-m-d H:i:s"),
		'slider' => $_POST['video_slider'],
		'active' => $_POST['isActive']
	));

	if ($insert) {
		Header("Location:admin/video.php?durum=ok");
	} else {
		Header("Location:admin/video.php?durum=no");
	}
}

//video düzenleme
if (isset($_POST['videoduzenle'])) {

	$videosor = $db->prepare("SELECT * FROM video_tbl where id=:id");
	$videosor->execute(array("id" => $_POST['id']));
	$videocek = $videosor->fetch(PDO::FETCH_ASSOC);

	if ($_FILES['video_kapak']['size'] > 0) {
		$uploads_dir = 'images/video-thumbnail/';
		@$tmp_name = $_FILES['video_kapak']["tmp_name"];
		@$name = $_FILES['video_kapak']["name"];
		$sayi1 = rand(10000, 99999);
		$refimgyol = $uploads_dir . $sayi1 . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$sayi1$name");
	} else {
		$refimgyol = $videocek['video_kapak'];
	}

	if ($_FILES['video_documents']['size'] > 0) {
		$uploads_dir = 'video/docs/';
		@$tmp_name = $_FILES['video_documents']["tmp_name"];
		@$name = $_FILES['video_documents']["name"];
		$sayi1 = rand(10000, 99999);
		$docyol = $uploads_dir . $sayi1 . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$sayi1$name");
	} else {
		$docyol = $videocek['video_documents'];
	}

	if ($_FILES['video_file']['size'] > 0) {
		$icon_dir = 'video/';
		@$tmp_icon = $_FILES['video_file']["tmp_name"];
		@$icon = $_FILES['video_file']["name"];
		$sayi1 = rand(10000, 99999);
		$fileyol = $icon_dir . $sayi1 . $icon;
		@move_uploaded_file($tmp_icon, "$icon_dir/$sayi1$icon");
		$videourl = '';
	} else {
		$fileyol = $videocek['video_file'];
	}

	$videoduzenle = $db->prepare("UPDATE video_tbl SET
		video_baslik=:baslik,
		video_aciklama=:aciklama,
		video_kategori=:kategori,
		video_alt_kategori=:altkategori,
		video_kapak=:foto,
		video_url=:vurl,
		video_file=:vfile,
		video_documents=:docs,
		video_slider=:slider,
		isActive=:active
		WHERE id={$_POST['id']}
		");
	$update = $videoduzenle->execute(array(
		'baslik' => $_POST['video_baslik'],
		'aciklama' => $_POST['video_aciklama'],
		'kategori' => $_POST['video_kategori'],
		'altkategori' => $_POST['video_alt_kategori'],
		'foto' => $refimgyol,
		'vurl' => $_POST['video_url'],
		'vfile' => $fileyol,
		'docs' => $docyol,
		'slider' => $_POST['video_slider'],
		'active' => $_POST['isActive']
	));

	if ($update) {
		Header("Location:admin/video.php?durum=ok");
	} else {
		Header("Location:admin/video.php?durum=no");
	}
}

//video silme
if (!empty($_GET['videosil']) == "ok") {

	$select = $db->prepare("SELECT * FROM video_tbl where id=:id");
	$select->execute(array('id' => $_GET['id']));
	$bul = $select->fetch(PDO::FETCH_ASSOC);

	unlink($bul['video_kapak']);

	$sil = $db->prepare("DELETE FROM video_tbl WHERE id=:id");
	$kontrol = $sil->execute(array('id' => $_GET['id']));

	if ($kontrol) {
		header("Location:admin/video.php?durum=ok");
	} else {
		header("Location:admin/video.php?durum=no");
	}
}
//video dosyasını silme
if (!empty($_GET['videoFilesil']) == "ok") {

	$select = $db->prepare("SELECT * FROM video_tbl where id=:id");
	$select->execute(array('id' => $_GET['id']));
	$bul = $select->fetch(PDO::FETCH_ASSOC);

	$videofilesil = $db->prepare("UPDATE video_tbl SET
		video_file=:vfile
		WHERE id={$_GET['id']}
		");
	$delete = $videofilesil->execute(array(
		'vfile' => ''
	));

	unlink($bul['video_file']);

	if ($delete) {
		header("Location:admin/video-duzenle.php?id=" . $_GET['id']);
	} else {
		header("Location:admin/video-duzenle.php?id=" . $_GET['id']);
	}
}

/*Ürün Kategori İşlemleri*/

//ketegori Ekleme
if (isset($_POST['kategoriekle'])) {

	$kategorikaydet = $db->prepare("INSERT INTO kategori_tbl SET kategori_ad=:ad");
	$insert = $kategorikaydet->execute(array('ad' => $_POST['kategori_ad']));
	if ($insert) {
		Header("Location:admin/kategoriler.php?durum=ok");
	} else {
		Header("Location:admin/kategoriler.php?durum=no");
	}
}

//ketegori guncelleme
if (isset($_POST['kategoriduzenle'])) {

	$kategoriduzenle = $db->prepare("UPDATE kategori_tbl SET
		kategori_ad=:ad
		WHERE kategori_id={$_POST['kategori_id']}
		");
	$update = $kategoriduzenle->execute(array(
		'ad' => $_POST['kategori_ad']
	));

	$kategori_id = $_POST['kategori_id'];

	if ($update) {
		Header("Location:admin/kategoriler.php?kategori_id=$kategori_id&durum=ok");
	} else {
		Header("Location:admin/kategoriler.php?durum=no");
	}
}

//ketegori silme
if (!empty($_GET['kategorisil']) == 'ok') {

	$sil = $db->prepare("DELETE FROM kategori_tbl where kategori_id=:kategori_id");
	$kontrol = $sil->execute(array(
		"kategori_id" => $_GET['kategori_id']
	));

	if ($kontrol) {
		Header("Location:admin/kategoriler.php?durum=ok");
	} else {
		Header("Location:admin/kategoriler.php?durum=no");
	}
}

/*Admin Girişi*/
if (isset($_POST['adminlogin'])) {

	$admin_ad = $_POST['admin_ad'];
	$admin_sifre = md5($_POST['admin_sifre']);

	if ($admin_ad && $admin_sifre) {

		$adminsor = $db->prepare("SELECT * FROM admin_tbl where admin_ad=:ad and admin_sifre=:sifre");
		$adminsor->execute(array(
			'ad' => $admin_ad,
			'sifre' => $admin_sifre
		));
		echo $say = $adminsor->rowCount();
		$admincek = $adminsor->fetch(PDO::FETCH_ASSOC);

		if ($say > 0) {
			$_SESSION['admin_ad'] = $admin_ad;
			$_SESSION['admin_id'] = $admincek['admin_id'];
			header('Location:admin/index.php');
		} else {
			echo "<script>
			alert('Giriş başarısız.');
			window.location.href='admin/login.php';
			</script>";
		}
	}
}

/*Kullanici Girişi*/
if (isset($_POST['login'])) {

	$kullanici_mail = $_POST['kullanici_mail'];
	$kullanici_sifre = md5($_POST['kullanici_sifre']);

	if (!filter_var($kullanici_mail, FILTER_VALIDATE_EMAIL)) {
		echo "<script>
		alert('Geçerli bir e-posta adresi girin.');
		window.location.href='signin.php';
		</script>";
	} else {
		if ($kullanici_mail && $kullanici_sifre) {

			$kullanicisor = $db->prepare("SELECT * FROM kullanici_tbl where kullanici_mail=:mail and kullanici_sifre=:sifre");
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail,
				'sifre' => $kullanici_sifre
			));
			echo $say = $kullanicisor->rowCount();
			$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

			if ($say > 0) {
				$_SESSION['kullanici_mail'] = $kullanici_mail;
				$_SESSION['kullanici_id'] = $kullanicicek['kullanici_id'];
				header('Location:index.php');
			} else {
				echo "<script>
			alert('Giriş başarısız.');
			window.location.href='signin.php';
			</script>";
			}
		}
	}
}

/*Kullanici Kayıt Olma Talebi*/
if (isset($_POST['kayitol'])) {

	$kullanici_token = $_POST['kullanici_token'];
	$kullanici_ad = $_POST['kullanici_ad'];
	$kullanici_mail = $_POST['kullanici_mail'];
	$kullanici_telefon = $_POST['kullanici_tel'];
	$kullanici_sifre = md5($_POST['kullanici_sifre']);
	$kullanici_sifre2 = md5($_POST['kullanici_sifre2']);

	if (filter_var($kullanici_mail, FILTER_VALIDATE_EMAIL) && $kullanici_ad) {
		if ($kullanici_sifre == $kullanici_sifre2) {
			$kullanicikayittalebi = $db->prepare("INSERT INTO kullanici_tbl SET
				kullanici_ad=:ad,
				kullanici_token=:token,
				kullanici_mail=:mail,
				kullanici_tel=:telefon,
				kullanici_sifre=:sifre,
				kullanici_yetki=:yetki,
				kullanici_zaman=:zaman
			");
			$insert = $kullanicikayittalebi->execute(array(
				'ad' => $kullanici_ad,
				'token' => $kullanici_token,
				'mail' => $kullanici_mail,
				'telefon' => $kullanici_telefon,
				'sifre' => $kullanici_sifre,
				'yetki' => 3,
				'zaman' => date('Y-m-d H:i:s')
			));
			if ($insert) {
				$kayitac = $db->prepare("INSERT INTO kkayit_tbl SET
					kullanici_token=:token,
					tarih=:zaman,
					onay=:o
				");
				$insertkayit = $kayitac->execute(array(
					'token' => $_POST['kullanici_token'],
					'zaman' => date('Y-m-d H:i:s'),
					'o' => 0
				));

				if (!$insertkayit) {
					echo "<script>
					alert('Kayıt ekleme işlemi başarısız.');
					window.location.href='signup.php';
					</script>";
				}
				echo "<script>
					alert('Talebiniz alındı yakın zamanda size geri dönüş sağlanacak. Şimdilik geçerli kullanıcı adı ve şifreniz ile siteye giriş yapıp ücretsiz içeriklerden faydalanabilirsiniz.');
					window.location.href='signin.php';
				</script>";
			} else {
				echo "<script>
					alert('Kayıt işlemi başarısız.');
					window.location.href='signup.php';
				</script>";
			}
		} else {
			echo "<script>
				alert('Şifreler Uyuşmuyor !');
				window.location.href='signin.php';
			</script>";
		}
	} else {
		echo "<script>
			alert('Geçersiz giriş!');
			window.location.href='signin.php';
		</script>";
	}
}

/*Kullanici Kayıt Onayla*/
if (isset($_POST['kayitonayla'])) {
	//kullanıcı yetkisini değiştir
	$token = (int) $_POST['kullanici_token'];
	$yetkidegistir = $db->prepare("UPDATE kullanici_tbl SET
		kullanici_yetki=:y
		WHERE kullanici_token=$token
		");
	$updateyetki = $yetkidegistir->execute(array(
		'y' => 2
	));

	if ($updateyetki) {
		$kayitonayla = $db->prepare("UPDATE kkayit_tbl SET
		onay=:o,
		tarih=:tarih
		WHERE kullanici_token=$token
		");
		$update = $kayitonayla->execute(array(
			'o' => 1,
			'tarih' => date('Y-m-d H:i:s')
		));

		if ($update) {
			echo "<script>
		alert('Kayıt onaylandı olarak işaretlendi.');
		window.location.href='admin/kayit-talepleri.php';
		</script>";
		} else {
			echo "<script>
		alert('İşlem başarısız.');
		window.location.href='admin/kayit-talepleri.php';
		</script>";
		}
	}
}

//Kullanici Ekleme
if (isset($_POST['kullaniciekle'])) {

	$uploads_dir = 'admin/images/users/';

	@$tmp_name = $_FILES['kullanici_foto']["tmp_name"];
	@$name = $_FILES['kullanici_foto']["name"];

	$refimgyol = 'images/users/' . $name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$name");

	$urunkaydet = $db->prepare("INSERT INTO kullanici_tbl SET
		kullanici_ad=:ad,
		kullanici_mail=:mail,
		kullanici_sifre=:sifre,
		kullanici_zaman=:zaman,
		kullanici_hakkinda=:hakkinda,
		kullanici_dogumyeri=:dogumyeri,
		kullanici_yetki=:yetki,
		kullanici_facebook=:facebook,
		kullanici_twitter=:twitter,
		kullanici_github=:github,
		kullanici_instagram=:instagram,
		kullanici_tel=:tel,
		kullanici_foto=:foto
		");
	$insert = $urunkaydet->execute(array(
		'ad' => $_POST['kullanici_ad'],
		'mail' => $_POST['kullanici_mail'],
		'sifre' => md5($_POST['kullanici_sifre']),
		'zaman' => $_POST['kullanici_zaman'],
		'hakkinda' => $_POST['kullanici_hakkinda'],
		'dogumyeri' => $_POST['kullanici_dogumyeri'],
		'yetki' => $_POST['kullanici_yetki'],
		'facebook' => $_POST['kullanici_facebook'],
		'twitter' => $_POST['kullanici_twitter'],
		'github' => $_POST['kullanici_github'],
		'instagram' => $_POST['kullanici_instagram'],
		'tel' => $_POST['kullanici_tel'],
		'foto' => $refimgyol
	));

	if ($insert) {
		Header("Location:admin/kullanicilar.php?durum=ok");
	} else {
		Header("Location:admin/kullanicilar.php?durum=no");
	}
}

//Kullanici düzenleme
if (isset($_POST['kullaniciduzenle'])) {

	$kullanicisor = $db->prepare("SELECT * FROM kullanici_tbl where kullanici_id=:kullanici_id");
	$kullanicisor->execute(array("kullanici_id" => $_POST['kullanici_id']));
	$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);

	if ($_FILES['kullanici_foto']['size'] != 0) {
		$uploads_dir = 'admin/images/users/';
		@$tmp_name = $_FILES['kullanici_foto']["tmp_name"];
		@$name = $_FILES['kullanici_foto']["name"];
		$refimgyol = 'images/users/' . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$name");
	} else {
		$refimgyol = $kullanicicek['kullanici_foto'];
	}

	$kullaniciduzenle = $db->prepare("UPDATE kullanici_tbl SET
		kullanici_ad=:ad,
		kullanici_sifre=:sifre,
		kullanici_zaman=:zaman,
		kullanici_hakkinda=:hakkinda,
		kullanici_dogumyeri=:dogumyeri,
		kullanici_adsoyad=:adsoyad,
		kullanici_yetki=:yetki,
		kullanici_facebook=:facebook,
		kullanici_twitter=:twitter,
		kullanici_github=:github,
		kullanici_instagram=:instagram,
		kullanici_tel=:tel,
		kullanici_foto=:resim
		WHERE kullanici_id={$_POST['kullanici_id']}
		");
	$update = $kullaniciduzenle->execute(array(
		'ad' => $_POST['kullanici_ad'],
		'sifre' => $_POST['kullanici_sifre'],
		'zaman' => $_POST['kullanici_zaman'],
		'hakkinda' => $_POST['kullanici_hakkinda'],
		'dogumyeri' => $_POST['kullanici_dogumyeri'],
		'adsoyad' => $_POST['kullanici_adsoyad'],
		'yetki' => $_POST['kullanici_yetki'],
		'facebook' => $_POST['kullanici_facebook'],
		'twitter' => $_POST['kullanici_twitter'],
		'github' => $_POST['kullanici_github'],
		'instagram' => $_POST['kullanici_instagram'],
		'tel' => $_POST['kullanici_tel'],
		'resim' => $refimgyol
	));

	$kullanici_id = $_POST['kullanici_id'];

	if ($update) {
		Header("Location:admin/kullanicilar.php?kullanici_id=$kullanici_id&durum=ok");
	} else {
		Header("Location:admin/kullanicilar.php?durum=no");
	}
}

//Kullanici silme
if (!empty($_GET['kullanicisil']) == "ok") {

	$select = $db->prepare("SELECT * FROM kullanici_tbl where kullanici_id=:kullanici_id");
	$select->execute(array('kullanici_id' => $_GET['kullanici_id']));
	$bul = $select->fetch(PDO::FETCH_ASSOC);

	unlink($bul['kullanici_foto']);


	$sil = $db->prepare("DELETE FROM kullanici_tbl WHERE kullanici_id=:kullanici_id");
	$kontrol = $sil->execute(array(
		'kullanici_id' => $_GET['kullanici_id']
	));

	if ($kontrol) {
		header("Location:admin/kullanicilar.php?durum=ok");
	} else {
		header("Location:admin/video.php?durum=no");
	}
}

//Daha sonra izle listesi
if (isset($_POST['dahasonraizle'])) {

	$listesor = $db->prepare("SELECT * FROM list_tbl where uye_id=:uye and video_id=:video");
	$listesor->execute(array(
		'uye' => $_POST['uye_id'],
		'video' => $_POST['video_id']
	));

	echo $say = $listesor->rowCount();

	if ($say > 0) {
		$sil = $db->prepare("DELETE FROM list_tbl WHERE uye_id=:uye AND video_id=:video");
		$kontrol = $sil->execute(array(
			'uye' => $_POST['uye_id'],
			'video' => $_POST['video_id']
		));

		echo "<script>
        alert('İşlem başarılı.');
        javascript:history.go(-1)
        </script>";
	} else {

		$listekaydet = $db->prepare("INSERT INTO list_tbl SET
		video_id=:video,
		uye_id=:uye,
		tarih=:tarih
		");
		$insert = $listekaydet->execute(array(
			'video' => $_POST['video_id'],
			'uye' => $_POST['uye_id'],
			'tarih' => date('Y-m-d H:i:s')
		));

		if ($insert) {
			echo "<script>
        alert('İşlem başarılı.');
		javascript:history.go(-1)
        </script>";
		} else {
			echo "<script>
        alert('İşlem başarısız.');
        javascript:history.go(-1)
        </script>";
		}
	}
}

/*Alt Kategori İşlemleri*/

//ketegori Ekleme
if (isset($_POST['altkategoriekle'])) {
	if ($_FILES['alt_foto']['size'] != 0) {
		$uploads_dir = 'images/kategoriler/';
		@$tmp_name = $_FILES['alt_foto']["tmp_name"];
		@$name = $_FILES['alt_foto']["name"];
		$random = rand(1000, 9999);
		$refimgyol = $uploads_dir . $random . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$random$name");
	} else {
		$refimgyol = '';
	}
	$kategorikaydet = $db->prepare("INSERT INTO alt_kategori SET
		alt_ad=:ad,
		alt_aciklama=:aciklama,
		alt_foto=:foto,
		alt_ustid=:ustid
		");
	$insert = $kategorikaydet->execute(array(
		'ad' => $_POST['alt_ad'],
		'aciklama' => $_POST['alt_aciklama'],
		'foto' => $refimgyol,
		'ustid' => $_POST['alt_ustid']
	));
	if ($insert) {
		Header("Location:admin/alt-kategori.php?durum=ok");
	} else {
		Header("Location:admin/alt-kategori.php?durum=no");
	}
}

//ketegori guncelleme
if (isset($_POST['altkategoriduzenle'])) {

	$altsor = $db->prepare("SELECT * FROM alt_kategori where alt_id=:alt_id");
	$altsor->execute(array("alt_id" => $_POST['alt_id']));
	$altcek = $altsor->fetch(PDO::FETCH_ASSOC);

	if ($_FILES['alt_foto']['size'] != 0) {
		$uploads_dir = 'images/kategoriler/';
		@$tmp_name = $_FILES['alt_foto']["tmp_name"];
		@$name = $_FILES['alt_foto']["name"];
		$random = rand(1000, 9999);
		$refimgyol = $uploads_dir . $random . $name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$random$name");
	} else {
		$refimgyol = $altcek['alt_foto'];
	}

	$kategoriduzenle = $db->prepare("UPDATE alt_kategori SET
		alt_ad=:ad,
		alt_aciklama=:aciklama,
		alt_foto=:foto,
		alt_ustid=:ustid
		WHERE alt_id={$_POST['alt_id']}
		");
	$update = $kategoriduzenle->execute(array(
		'ad' => $_POST['alt_ad'],
		'aciklama' => $_POST['alt_aciklama'],
		'foto' => $refimgyol,
		'ustid' => $_POST['alt_ustid']
	));

	$kategori_id = $_POST['alt_id'];

	if ($update) {
		Header("Location:admin/alt-kategori.php?alt_id=$kategori_id&durum=ok");
	} else {
		Header("Location:admin/alt-kategori.php?durum=no");
	}
}

//ketegori silme
if ($_GET['altkategorisil'] == 'ok') {

	$select = $db->prepare("SELECT * FROM alt_kategori where alt_id=:id");
	$select->execute(array('id' => $_GET['alt_id']));
	$bul = $select->fetch(PDO::FETCH_ASSOC);

	unlink($bul['alt_foto']);

	$sil = $db->prepare("DELETE FROM alt_kategori where alt_id=:alt_id");
	$kontrol = $sil->execute(array(
		"alt_id" => $_GET['alt_id']
	));

	if ($kontrol) {
		Header("Location:admin/alt-kategori.php?durum=ok");
	} else {
		Header("Location:admin/alt-kategori.php?durum=no");
	}
}
