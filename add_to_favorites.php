<?php
require 'baglan.php'; // Veritabanı bağlantısı
session_start();



// Kullanıcının oturum açıp açmadığını kontrol et
if (!isset($_SESSION['user_id'])) {
    // Oturum açılmamışsa, hata mesajı ver ve işlemi durdur
    echo "Hatalı istek: Lütfen oturum açın.";
    exit;
}

// POST isteğiyle gönderilen verileri al
$user_id = $_SESSION['user_id']; // Kullanıcı kimliğini oturumdan al
$movie_id = $_POST['movie_id'] ; // movie_id POST ile geliyor

if (!$movie_id) {
    // Gerekli veriler sağlanmadıysa, hata mesajı ver ve işlemi durdur
    echo "<script>alert('Hatalı istek: Lütfen gerekli verileri sağlayın.');</script>";
    exit;
}

// Favorilere eklenen filmi veritabanına ekle
$sql_check = "SELECT * FROM favorites WHERE user_id = :user_id AND movie_id = :movie_id";
$stmt_check = $db->prepare($sql_check);
$stmt_check->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_check->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
$stmt_check->execute();
$row_count = $stmt_check->rowCount();

if ($row_count > 0) {
    // Kullanıcı zaten bu filmi favorilere eklemiş
    echo "<script>alert('Bu film zaten favorilere eklenmiş.');</script>";
} else {
    // Favorilere eklenen filmi veritabanına ekle
    $sql = "INSERT INTO favorites (user_id, movie_id) VALUES (:user_id, :movie_id)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Başarılı bir şekilde eklendiyse, mesaj ver
        echo "<script>alert('Film favorilere başarıyla eklendi.');</script>";
        header('Refresh:0; profile.php');

    } else {
        // Hata durumunda, hata mesajını göster
        echo "Hata: " . $stmt->errorInfo()[2];
    }
}

?>
