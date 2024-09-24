<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Movie Search</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <header>
        <h1>Movie Search</h1>
        <form method="GET" action="index.php">
            <input type="text" name="searchInput" id="searchInput" placeholder="Search for a movie..." />
            <button type="submit" name="searchButton">Search</button><br> <br>
            <a href="profile.php">Profil</a>
            <script>
        function notifyUser(message) {
            alert(message); // Burada alert yerine başka bir bildirim mekanizması kullanabilirsiniz
        }
    </script>
        </form>
    </header>
    <main id="results" class="container">
        <?php
        if (isset($_GET['searchButton']) && !empty($_GET['searchInput'])) {
            $query = $_GET['searchInput'];
            $searchResults = searchMovies($query);
            displayMovies($searchResults);
        } else {
            $popularMovies = fetchPopularMovies();
            displayMovies($popularMovies);
        }

        function fetchPopularMovies() {
            $url = "https://api.themoviedb.org/3/movie/popular?api_key=cd6fc50ac1187b2e739f2c5faaf4ddc7";
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            return $data['results'];
        }

        function searchMovies($query) {
            $url = "https://api.themoviedb.org/3/search/movie?api_key=cd6fc50ac1187b2e739f2c5faaf4ddc7&query=" . urlencode($query);
            $response = file_get_contents($url);
            $data = json_decode($response, true);
            return $data['results'];
        }

        function displayMovies($movies) {
            foreach ($movies as $movie) {
                echo '<div class="result-item">';
                echo '<h2>' . $movie['title'] . '</h2>';
                echo '<img src="https://image.tmdb.org/t/p/w500' . $movie['poster_path'] . '" alt="' . $movie['title'] . ' Poster">';
                echo '<form method="POST" action="add_to_favorites.php">';
                echo '<input type="hidden" name="movie_id" value="' . $movie['id'] . '">';
                echo '<button type="submit" name="add_to_favorites">Add to Favorites</button>';
                echo '</form>';
                echo '</div>';
            }
        }
        ?>
    </main>
</body>
</html>
