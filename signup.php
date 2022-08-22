<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kayıt Ol</title>

    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="preloader"></div>

    <div class="main-wrapper">
        <!-- header wrapper -->
        <div class="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <a href="index.html" class="logo float-none mt-4"><img src="images/logo.png" alt="logo"></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- header wrapper -->

        <section class="form-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-5">
                        <div class="form-div text-center">
                            <h2>Kayıt Ol</h2>
                            <form action="islem.php" method="POST">
                                <div class="form-group mt-5">
                                    <input type="hidden" name="kullanici_token" value="<?= md5(rand(0, 9999)) ?>">
                                    <input class="form-control" type="email" placeholder="Email" name="kullanici_mail">
                                    <input class="form-control" type="text" placeholder="Adınız" name="kullanici_ad">
                                    <input class="form-control" type="text" minlength="10" maxlength="11" placeholder="Telefon Numaranız" name="kullanici_tel">
                                    <input class="form-control" type="password" minlength="6" placeholder="Şifre" name="kullanici_sifre">
                                    <input class="form-control" type="password" minlength="6" placeholder="Şifre Tekrar" name="kullanici_sifre2">
                                </div>
                                <div class="form-group button-block text-center">
                                    <button class="form-btn" name="kayitol">Kayıt Talebi Oluştur</button>
                                    <p class="sign-up-text">Zaten Hesabın Var Mı ?<a href="signin.php"> Giriş Yap</a></p>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="js/plugin.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>