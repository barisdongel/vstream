<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<!-- Main Content -->
<div class="main-content">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4>Alt Kategori Ekle</h4>
      </div>
      <form action="../islem.php" method="POST">
        <div class="card-body">
          <div class="form-group">
            <div class="form-group">
              <label><i class="fa fa-list-alt"></i>Alt Kategori Adı</label>
              <input type="text" name="alt_ad" class="form-control">
            </div>
            <div class="form-group">
              <label><i class="fa fa-list-alt"></i> Üst Kategorisi</label>
              <select class="form-control" name="alt_ustid">
                <?php
                $kategorisor = $db->prepare("SELECT * FROM kategori_tbl ORDER BY kategori_ad ASC");
                $kategorisor->execute();
                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="col-md-12 text-right">
          <a class="btn btn-warning" href="alt-kategori.php"><i class="fa fa-long-arrow-alt-left"></i> Geri Dön</a>
          <button class="btn btn-info" type="submit" name="altkategoriekle">Ekle</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php' ?>