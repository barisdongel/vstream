<?php include 'header.php' ?>
<?php include 'sidebar.php';
$kullanicisor = $db->prepare("SELECT * FROM kullanici_tbl");
$kullanicisor->execute();
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
?>
<!-- Main Content -->
<div class="main-content">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4>Kullanıcılar</h4>
      </div>
      <form action="../islem.php" method="POST">
        <table class="table table-striped table-md">
          <tr>
            <th>Kullanıcı Fotoğrafı</th>
            <th>Kullanıcı Adı</th>
            <th>Kullanıcı Ad Soyad</th>
            <th>Kullanıcı Kayıt Tarihi</th>
            <th>Kullanıcı Yetkisi</th>
            <th></th>
            <th>
              <a href="kullanici-ekle.php" class="btn btn-success"><i class="fa fa-plus"></i> Yeni Ekle</a>
            </th>
          </tr>
          <?php while ($kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC)) {
            $kullanici_id = $kullanicicek['kullanici_id'];
          ?>
            <tr>
              <td><img src="../<?= $kullanicicek['kullanici_foto']; ?>" width="200"></td>
              <td><?= $kullanicicek['kullanici_ad']; ?></td>
              <td><?= $kullanicicek['kullanici_adsoyad']; ?></td>
              <td><?= $kullanicicek['kullanici_zaman']; ?></td>
              <td><?php if ($kullanicicek['kullanici_yetki'] == 1) {
                    echo "<span class='alert alert-success'>Yönetici</span>";
                  } elseif ($kullanicicek['kullanici_yetki'] == 2) {
                    echo "<span class='alert alert-info'>Üye</span>";
                  } elseif ($kullanicicek['kullanici_yetki'] == 3) {
                    echo "<span class='alert alert-warning'>Ziyaretçi</span>";
                  }

                  ?></td>
              <td style="text-align: center;"><a href="kullanici-duzenle.php?kullanici_id=<?= $kullanicicek['kullanici_id'] ?>" class="btn btn-outline-info"><i class="fa fa-pencil-alt"></i> Düzenle</a></td>
              <td style="text-align: center;"><a href="../islem.php?kullanicisil=ok&kullanici_id=<?= $kullanicicek['kullanici_id'] ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-outline-primary"><i class="fa fa-trash"></i> Sil</a></td>
            </tr>
          <?php } ?>
        </table>
    </div>
    <div class="col-md-12 text-right">
      <a class="btn btn-warning" href="index.php"><i class="fa fa-long-arrow-alt-left"></i> Geri Dön</a>
    </div>
    </form>
  </div>
</div>
</div>
</div>
<?php include 'footer.php' ?>