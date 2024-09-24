<?php
require 'baglan.php';

session_start();

if (isset($_POST['kayit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_again = @$_POST['password_again'];

    // Kullanıcı adının daha önce alınıp alınmadığını kontrol
    $kullanici_kontrol = $db->prepare('SELECT * FROM users WHERE user_name = ?');
    $kullanici_kontrol->execute([$username]); 
    $say = $kullanici_kontrol->rowCount();

    if ($say > 0) {
        // Kullanıcı adı zaten mevcut
        include 'login.php';
        echo "<script>alert('Kullanıcı adı zaten alınmış');</script>";
    } else {
        //Şifreler aynı ise
        if ($password == $password_again) {
            $sorgu = $db->prepare('INSERT INTO users SET  user_name = ? , user_password = ?');
            $ekle = $sorgu->execute([$username, $password]);
            if ($ekle) {
                echo "<script>alert('Kayıt işlemi başarılı!');</script>";
                header('Refresh:0; login.php');
            }

        }else{
            //Şifreler aynı değilse
            include 'login.php';
            echo "<script>alert('Şifreler aynı değil!');</script>";
        }
    }
}


if (isset($_POST['giris'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!$username || !$password) {
        // Kullanıcı adı veya şifre eksik
        echo "<script>alert('Lütfen kullanıcı adı ve şifrenizi girin.');</script>";
    } else {
        $kullanici_sor = $db->prepare('SELECT user_id FROM users WHERE user_name = ? AND user_password = ?');
        $kullanici_sor->execute([$username, $password]);
        $kullanici = $kullanici_sor->fetch(PDO::FETCH_ASSOC);

        if ($kullanici) {
            // Kullanıcı bulundu, oturum başlat
            $_SESSION['user_id'] = $kullanici['user_id'];
            $_SESSION['username'] = $username;
            echo "<script>alert('Giriş işlemi başarılı!');</script>";
            echo "Kullanıcı ID: " . $_SESSION['user_id'];
            header('Refresh:0; index.php');
        } else {
            // Kullanıcı bulunamadı
            echo "<script>alert('Kullanıcı adı veya şifre yanlış.');</script>";
        }
    }
}

?>