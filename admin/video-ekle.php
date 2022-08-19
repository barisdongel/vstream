<?php include 'header.php' ?>
<?php include 'sidebar.php' ?>
<!-- Main Content -->
<div class="main-content">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4>Video Ekle</h4>
      </div>
      <form action="../islem.php" method="POST" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <label><i class="fa fa-image"></i> Video Kapak Fotoğrafı</label>
            <input type="file" class="dropify" name="video_kapak" />
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label><i class="fa fa-video"></i> Video Türü</label>
              <select class="form-select" aria-label="Default select example" id="video-tur">
                <option value="1">URL</option>
                <option value="2">Upload</option>
              </select>
            </div>
            <div class="form-group d-none col-md-6" id="upload">
              <label><i class="fas fa-video"></i> Video Upload</label>
              <input style="height: 50px;" type="file" name="video_file" class="form-control">
            </div>
            <div class="form-group d-none col-md-6" id="url">
              <label><i class="fa fa-heading"></i> Video URL</label>
              <input type="text" name="video_url" class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label><i class="fa fa-heading"></i> Video Başlık</label>
              <input type="text" name="video_baslik" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label><i class="fa fa-list-alt"></i> Video Kategorisi</label>
              <select class="form-control" name="video_kategori">
                <?php
                $kategorisor = $db->prepare("SELECT * FROM kategori_tbl ORDER BY kategori_ad ASC");
                $kategorisor->execute();
                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>
                  <option value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label><i class="fa fa-list"></i> Video Açıklama</label>
            <textarea name="video_aciklama" type="submit" id="ckeditor1"></textarea>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label><i class="fa fa-video"></i> Video Slider'da Görünsün Mü ?</label>
              <select class="form-select" aria-label="Default select example" name="video_slider">
                <option value="1">Evet</option>
                <option value="0">Hayır</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label><i class="fa fa-video"></i> Video Durumu Aktif/Pasif</label>
              <select class="form-select" aria-label="Default select example" name="isActive">
                <option value="1">Aktif</option>
                <option value="0">Pasif</option>
              </select>
            </div>
          </div>
        </div>
    </div>
    <div class="col-md-12 text-right">
      <a class="btn btn-warning" href="video.php"><i class="fa fa-long-arrow-alt-left"></i> Geri Dön</a>
      <button class="btn btn-info" type="submit" name="videoekle">Ekle</button>
    </div>
    </form>
  </div>
</div>
</div>
</div>
<?php include 'footer.php' ?>