<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <ul class="sidebar-menu">
      <li class="dropdown active" style="display: block;">
        <div class="sidebar-profile">
          <div class="siderbar-profile-pic">
            <img src="../<?= $kullanicicek['admin_foto'] ?>" class="profile-img-circle box-center" alt="User Image">
          </div>
          <div class="siderbar-profile-details">
            <div class="siderbar-profile-name">HOŞGELDİN</div>
            <div class="siderbar-profile-name text-warning"><?php echo $_SESSION['admin_ad'] ?> </div>
            <div class="sidebar-profile-position">Yetki:Admin</div>
          </div>
        </div>
      </li>
      <li class="menu-header">Admin Menü</li>
      <li><a class="nav-link" href="index.php"><i class="fas fa-home"></i><span>Admin Paneli Anasayfa</span></a></li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-video"></i><span>Eğitimler</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="video.php">Videolar</a></li>
          <li><a class="nav-link" href="kategoriler.php">Üst Kategoriler</a></li>
          <li><a class="nav-link" href="alt-kategori.php">Alt Kategoriler</a></li>
        </ul>
      </li>
      <li><a class="nav-link" href="kullanicilar.php"><i class="fas fa-user"></i><span>Kullanıcı Ayarları</span></a></li>
      <li><a class="nav-link" href="kayit-talepleri.php"><i class="fas fa-plus"></i><span>Kayıt Talepleri</span></a></li>
      <li><a class="nav-link" href="ayarlar.php"><i class="fas fa-cog"></i><span>Genel Ayarlar</span></a></li>
      <li><a class="nav-link" href="iletisim.php"><i class="fas fa-phone"></i><span>İletişim Ayarları</span></a></li>
      <li><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Çıkış Yap</span></a></li>
    </ul>
  </aside>
</div>