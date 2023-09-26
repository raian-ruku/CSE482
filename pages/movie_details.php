<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/CSE482/CSS/movie_details.css" />
</head>

<body>
  <div class="top-panel">
    <a href="/pages/index.html" data-value="FLIXDB" id="logo">FLIXDB</a>
    <ion-icon name="menu-outline" id="hb"></ion-icon>
    <form action="">
      <div class="search-bar">
        <input type="text" name="search" id="search" placeholder="search" />
        <button type="submit">
          <ion-icon name="search-outline"></ion-icon>
        </button>
      </div>
    </form>
    <div class="user-icons">
      <a href="/CSE482/pages/profile_landing.html"><ion-icon name="person-outline"></ion-icon></a>
      <ion-icon name="bookmark-outline"></ion-icon>
      <a href="/pages/signin.html"><ion-icon name="log-in-outline"></ion-icon></a>
    </div>
  </div>

  <div class="movie">
    <?php

    if (isset($_GET['movie_id'])) {
      $movieId = $_GET['movie_id'];
      require_once "database.php";


      $sql = "SELECT * FROM movies WHERE id = ?";
      $stmt = mysqli_prepare($con, $sql);

      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $movieId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $movieName = $row['movie_name'];
          $rating = $row['rating'];
          $popularity = $row['popularity'];
          $releaseDate = $row['release_date'];
          $category = $row['category'];
          $stars = $row['cast'];
          $director = $row['director'];
          $details = $row['details'];

          echo '<div class="sd">
                            <p>' . $movieName . '</p>
                            <div class="rp">
                                <p>Rating: ' . $rating . '</p>
                                <p>Popularity: ' . $popularity . '</p>
                            </div>
                        </div>
                        <p>Release Date: ' . $releaseDate . '</p>
                        <img src="/CSS/IMG_20230427_183213.png" alt="images here with carousel" />
                        <p>Category: ' . $category . '</p>
                        <p>Stars: ' . $stars . '</p>
                        <p>Director: ' . $director . '</p>
                        <p>Details: ' . $details . '</p>';
        } else {
          echo 'Movie not found.';
        }

        mysqli_stmt_close($stmt);
      } else {
        echo 'SQL statement preparation failed.';
      }

      mysqli_close($con);
    } else {
      echo 'Movie ID not provided.';
    }
    ?>
  </div>

  <div class="reviews">
    <p>User Reviews</p>
    <div class="review">
      <div class="review-items">
        <img src="/CSS/IMG_20230427_183213.png" alt="user_image" />
      </div>
      <div class="review-items">
        <p>Name</p>
      </div>

      <div class="review-items">
        <p>Reputation</p>
      </div>
    </div>
  </div>

  <script src="/JS/logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>