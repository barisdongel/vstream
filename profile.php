<?php
include 'header.php';?>

<div class="page-nav">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
        <h2 class="mb-1">Profilim</h2>
      </div>
    </div>
  </div>
</div>

<div class="faq-page">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-8">
        <div id="accordion" class="accordion">
          <div class="card mb-3">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link small-text collapsed pl-5 text-left" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                  <i class="ti-user"></i>Hesap Ayarları
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body form-div">
                <form action="islem.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="kullanici_id" value="<?= $kullanicicek['kullanici_id'] ?>">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group mt-4">
                        <img src="<?= $kullanicicek['kullanici_foto'] ?>" alt="<?= $kullanicicek['kullanici_adsoyad'] ?>" width="400">
                        <label for="kullanici_foto">Fotoğraf</label>
                        <input class="form-control" type="file" name="kullanici_foto">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group mt-4">
                        <textarea class="form-control text-dark" name="kullanici_hakkinda" placeholder="Hakkında özet bilgi" style="height: 100px"><?= $kullanicicek['kullanici_hakkinda'] ?></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group mt-4">
                        <input class="form-control text-dark" type="text" name="kullanici_adsoyad" placeholder="İsim Soyisim" value="<?= $kullanicicek['kullanici_adsoyad'] ?>">
                        <input class="form-control text-dark" type="number" name="kullanici_tel" placeholder="Telefon" value="<?= $kullanicicek['kullanici_tel'] ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group mt-4">
                        <input class="form-control text-dark" type="text" name="kullanici_ad" placeholder="Kullanıcı Adı" value="<?= $kullanicicek['kullanici_ad'] ?>">
                        <input class="form-control text-dark" type="email" name="kullanici_mail" placeholder="Email" value="<?= $kullanicicek['kullanici_mail'] ?>">
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="profilguncelle" class="form-btn text-white d-block">Kaydet</button>
                </form>
              </div>
            </div>
          </div>

          <!--şifre ayarları-->
          <div class="card mb-3">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link small-text collapsed pl-5 text-left" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  <i class="ti-user"></i>Şifre
                </button>
              </h5>
            </div>

            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body form-div">
                <form action="islem.php" method="POST">
                  <input type="hidden" name="kullanici_id" value="<?= $kullanicicek['kullanici_id'] ?>">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group mt-4">
                        <input class="form-control text-dark" type="password" name="kullanici_sifre" placeholder="Şifre">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group mt-4">
                        <input class="form-control text-dark" type="password" name="kullanici_sifre2" placeholder="Şifre Tekrar">
                      </div>
                    </div>
                  </div>
                  <button type="submit" name="sifreguncelle" class="form-btn text-white d-block">Şifre Güncelle</button>
                </form>
              </div>
            </div>
          </div>

          <div class="card mb-3">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link small-text collapsed pl-5 text-left" data-toggle="collapse" data-target="#collapseTHree" aria-expanded="false" aria-controls="collapseTHree">
                  <a href="logout.php"><i class="ti-power-off"></i> Çıkış Yap</a>
                </button>
              </h5>
            </div>
          </div>
        </div>



      </div>
    </div>
  </div>
</div>
</div>

<?php include 'footer.php' ?>