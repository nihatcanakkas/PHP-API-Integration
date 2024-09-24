<?php
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Giriş</title>
  <link rel="icon" href="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<!-- Giriş Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Giriş yap</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="islem.php" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Kullanıcı Adı</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Kullanıcı Adı" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Şifre</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Şifre" required>
          </div>
          <button type="submit" name="giris" class="btn btn-color px-5 mb-5 w-100">Giriş yap</button>
        </form>
        <div id="error_message2" class="alert alert-danger mb-3 text-danger text-center" style="display:none"></div>
      </div>
      <div class="modal-footer">
        <p class="text-center mb-0">Hesabın yok mu? <a href="#" id="openSignupModal" class="text-primary" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Kayıt ol</a></p>
      </div>
    </div>
  </div>
</div>

<!-- Kayıt Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Kayıt Ol</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="islem.php" method="post">
          <div class="mb-3">
            <label for="username" class="form-label">Kullanıcı Adı</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Kullanıcı Adı" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Şifre</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Şifre" required>
          </div>
          <div class="mb-3">
            <label for="password_again" class="form-label">Tekrar Şifre</label>
            <input type="password" name="password_again" class="form-control" id="password_again" placeholder="Tekrar Şifre" required>
          </div>
          <button type="submit" name="kayit" class="btn btn-color px-5 mb-5 w-100">Kaydol</button>
        </form>
        <div id="error_message" class="alert alert-danger mb-3 text-danger text-center" style=" display:none"></div>
      </div>
      <div class="modal-footer">
        <p class="text-center mb-0">Hesabın var mı? <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Giriş yap</a></p>
      </div>
    </div>
  </div>
</div>
<div id="error_message2" class="alert alert-danger mb-3 text-danger text-center" style=" display:none"></div>
<!-- Giriş yap düğmesi -->
<div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center text-dark mt-5">Hoş Geldiniz</h2>
      <div class="text-center">
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">Giriş yap</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
