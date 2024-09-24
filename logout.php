<?php
session_start();

// Oturum değişkenlerini temizle
$_SESSION = [];

// Oturum çerezini yok et (eğer varsa)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Oturumu tamamen yok et
session_destroy();

// Kullanıcıyı giriş sayfasına yönlendir
header("Location: login.php");
exit;
?>
