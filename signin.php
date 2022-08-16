<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giriş Yap</title>

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
                            <h2>Giriş Yap</h2>
                            <form action="islem.php" method="POST">
                                <div class="form-group mt-5">
                                  <input class="form-control" type="email" placeholder="Email" name="kullanici_ad">
                                  <input class="form-control" type="password" placeholder="Şifre" name="kullanici_sifre">
                                </div>
                                <div class="form-group button-block text-center">
                                  <button class="form-btn" name="login">Giriş Yap</button>
                                  <p class="sign-up-text">Hesabın Yok Mu? <a href="signup.php">Kayıt Ol</a></p>
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