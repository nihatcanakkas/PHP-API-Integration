
<?php
session_start(); // Oturumu başlat

// Kullanıcının oturum açıp açmadığını kontrol edin
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Kullanıcı giriş yapmamışsa giriş sayfasına yönlendir
    exit;
}

// Kullanıcı bilgilerini oturumdan alın
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Favori Filmleriniz</h1>
    <div id="profileMenu">
      <!-- Kullanıcı adı gösteriliyor -->
      <p>Hoşgeldiniz, <?php echo htmlspecialchars($username); ?>!</p>
      <a href="logout.php">Çıkış Yap</a>
    </div>
  </header>
  <main id="results" class="container">
    <!-- Kullanıcının favori filmleri burada gösterilecek -->
    <h2></h2>
    <?php
    require 'baglan.php';

    // Kullanıcının favori filmlerini veritabanından alın
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT movie_id FROM favorites WHERE user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($favorites) {
        foreach ($favorites as $favorite) {
            // Her favori film için film bilgilerini API'den alın
            $movie_id = $favorite['movie_id'];
            $url = "https://api.themoviedb.org/3/movie/$movie_id?api_key=cd6fc50ac1187b2e739f2c5faaf4ddc7";
            $response = file_get_contents($url);
            $movie = json_decode($response, true);

            echo '<div class="result-item">';
            echo '<h2>' . htmlspecialchars($movie['title']) . '</h2>';
            echo '<img src="https://image.tmdb.org/t/p/w500' . htmlspecialchars($movie['poster_path']) . '" alt="' . htmlspecialchars($movie['title']) . ' Poster">';
            echo '</div>';
        }
    } else {
        echo '<p>Henüz favori filminiz yok.</p>';
    }
    ?>
  </main>
</body>
</html>
