<?php include 'header.php' ?>
<?php include 'sidebar.php';

$kategorisor = $db->prepare("SELECT * FROM alt_kategori");
$kategorisor->execute();

$ustkategori = $db->prepare("SELECT * FROM alt_kategori inner join kategori_tbl on kategori_tbl.kategori_id=alt_kategori.alt_ustid");
$ustkategori->execute();
?>
<!-- Main Content -->
<div class="main-content">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4>Alt Kategoriler</h4>
      </div>
      <form action="../islem.php" method="POST">
        <table class="table table-striped table-md">
          <tr>
            <th>Alt Kategori Adı</th>
            <th>Üst Kategorisinin Adı</th>
            <th></th>
            <th>
              <a href="alt-ekle.php" class="btn btn-success"><i class="fa fa-plus"></i> Yeni Ekle</a>
            </th>
          </tr>
          <?php while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
              <td><?php echo $kategoricek['alt_ad']; ?></td>
              <?php $ustcek = $ustkategori->fetch(PDO::FETCH_ASSOC); ?>
              <td style="width:16%;"><?= $ustcek['kategori_ad']; ?></td>
              <td style="text-align: center;"><a href="alt-duzenle.php?alt_id=<?php echo $kategoricek['alt_id'] ?>" class="btn btn-outline-info"><i class="fa fa-pencil-alt"></i> Düzenle</a></td>
              <td><a href="../islem.php?altkategorisil=ok&alt_id=<?php echo $kategoricek['alt_id'] ?>" onclick="return confirm('Silmek istediğinize emin misiniz?')" class="btn btn-outline-primary"><i class="fa fa-trash"></i> Sil</a></td>
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