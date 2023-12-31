<?php

require __DIR__ . '/connections/connections.php';
require __DIR__ . '/functions/has-login.php';

if (isset($_GET['destination'])) {
    $_SESSION['destination'] = $_GET['destination'];
}

?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $hostToRoot ?>wp-content/template/images/favicon.png">
    <link rel="stylesheet" href="<?= $hostToRoot ?>wp-content/template/vendor/toastr/css/toastr.min.css">
    <link href="<?= $hostToRoot ?>wp-content/template/css/style.css?v=<?= time() ?>" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Masuk ke akun anda.</h4>
                                    <form method="POST" action="<?= $hostToRoot ?>functions/login">
                                        <div class="form-group">
                                            <label><strong>Nama Pengguna</strong></label>
                                            <input type="text" class="form-control" name="username" placeholder="Masukkan nama pengguna anda.">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Kata Sandi</strong></label>
                                            <input type="password" class="form-control" name="password" placeholder="Masukkan kata sandi anda.">
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <!-- <div class="form-group">
                                                <div class="form-check ml-2">
                                                    <input class="form-check-input" type="checkbox" id="basic_checkbox_1">
                                                    <label class="form-check-label" for="basic_checkbox_1">Remember me</label>
                                                </div>
                                            </div> -->
                                            <!-- <div class="form-group ml-1">
                                                <a href="page-forgot-password.html">Lupa Password?</a>
                                            </div> -->
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                        </div>
                                    </form>
                                    <!-- <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="./page-register.html">Sign up</a></p>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?= $hostToRoot ?>wp-content/template/vendor/global/global.min.js"></script>
    <script src="<?= $hostToRoot ?>wp-content/template/js/quixnav-init.js"></script>
    <script src="<?= $hostToRoot ?>wp-content/template/js/custom.min.js"></script>
    <script src="<?= $hostToRoot ?>wp-content/template/vendor/toastr/js/toastr.min.js"></script>
    <script src="<?= $hostToRoot ?>wp-content/template/js/plugins-init/toastr-init.js"></script>
    <?php if (isset($_SESSION['toastr'])) : ?>
        <script>
            toastr.error('<?= $_SESSION['toastr']['message'] ?>');
        </script>
        <?php unset($_SESSION['toastr']); ?>
    <?php endif; ?>

</body>

</html>