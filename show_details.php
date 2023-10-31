<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("location: signin.php");
}
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/CSE482/CSS/movie_details.css" />
</head>

<body>
  <div class="top-panel">
    <a href="/CSE482/index.php" data-value="FLIXDB" id="logo">FLIXDB</a>
    <ion-icon name="menu-outline" id="hb" onclick="toggleMenu()"></ion-icon>
    <div class="fullscreen-menu" id="menu">
      <ul>
        <li><a href="/CSE482/index.php">Home</a></li>
        <li><a href="/CSE482/movies.php">Movies</a></li>
        <li><a href="/CSE482/shows.php">TV Shows</a></li>
      </ul>
    </div>
    <form action="">
      <div class="search-bar">
        <input type="text" name="search" id="lsearch" autocomplete="off" placeholder="search">
        <ion-icon name="search-outline"></ion-icon>
      </div>
      <div id="searchresult"> </div>
    </form>
    <div class="user-icons">
      <a href="/CSE482/home.php"><ion-icon name="person-outline"></ion-icon></a>
      <ion-icon name="bookmark-outline"></ion-icon>
      <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon></a>
    </div>
  </div>
  <div class="movie">
    <?php
    if (isset($_GET['show_id'])) {
      $movieId = $_GET['show_id'];
      require_once "database.php";
      $sql = "SELECT * FROM shows WHERE id = ?";
      $stmt = mysqli_prepare($con, $sql);
      if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $movieId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $movieName = $row['title'];
          $rating = $row['rating'];
          $releaseDate = $row['release_date'];
          $category = $row['category'];
          $stars = $row['cast'];
          $director = $row['director'];
          $description = $row['description'];
          $poster = $row['poster'];
          $image = $row['image1'];
          $trailer = $row['trailer_url'];
          echo '<div class="sd">
                            <p>' . $movieName . '</p>
                            <div class="rp">
                                <p>Rating: ' . $rating . '</p>
                            </div>
                        </div>
                        <p id="rd">Release Date: ' . $releaseDate . '</p>
                        <div class="image-carousel">
                            <button class="carousel-btn prev-btn" onclick="prevImage()">&lt;</button>
                            <img class="carousel-image" src="' . $poster . '" alt="' . $movieName . '">
                            <iframe class="carousel-iframe" src="' . $trailer . '" frameborder="0" allowfullscreen></iframe>
                            <img class="carousel-image" src="' . $image . '" alt="' . $movieName . '">
                            <button class="carousel-btn next-btn" onclick="nextImage()">&gt;</button>
                        </div>
                        <p id="rd">Category: ' . $category . '</p>
                        <p id="rd">Stars: ' . $stars . '</p>
                        <p id="rd">Director: ' . $director . '</p>
                        <p id="rd">Description: ' . $description . '</p>';
        } else {
          echo 'Movie not found.';
        }
        mysqli_stmt_close($stmt);
      } else {
        echo 'SQL statement preparation failed.';
      }
    } else {
      echo 'Movie ID not provided.';
    }
    ?>
  </div>
  <div class="reviews">
    <p id="p1">User Reviews</p>
    <?php
    if (isset($_GET['show_id'])) {
      $movieId = $_GET['show_id'];
      require_once "database.php";
      if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
      }
      $sql = "SELECT c.user_id, c.comment_text, u.u_name FROM swcomments AS c INNER JOIN users AS u ON c.user_id = u.id WHERE c.show_id = $movieId";
      $result = $con->query($sql);
      if ($result->num_rows > 0) {
        echo '<div class="review-section">';
        while ($commentRow = $result->fetch_assoc()) {
          $name = $commentRow['u_name'];
          $commentText = $commentRow['comment_text'];
          echo '<div class="review">
                    <div class="review-items">
                        <p> ' . $name . ' wrote </p>
                        <p>' . '"' . $commentText . '"' . '</p>
                    </div>';
        }
        echo '</div>';
      } else {
        echo "No comments found for this movie.";
      }
      $con->close();
    } else {
      echo "Movie ID not provided.";
    }
    ?>
    <?php
    if (isset($_SESSION["user"])) {
      echo '<div class="post">';
      echo '<form action="showcomment.php" method="POST">';
      echo '<input type="hidden" name="show_id" value="' . $movieId . '">';
      echo '<textarea name="comment" placeholder="Add your comment"></textarea> <br>';
      echo '<button type="submit">Post Comment</button>';
      echo '</form>';
      echo '</div>';
    } else {
      echo '<p><a href="signin.php">Log in</a> to post comments.</p>';
    }
    ?>
  </div>
  </div>
  <script src="/CSE482/JS/logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="/CSE482/JS/dropdown.js"></script>
  <script src='/CSE482/JS/like_dislike.js'></script>
  <script src='/CSE482/JS/carousel.js'></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#lsearch").keyup(function() {
        var input = $(this).val();
        if (input != "") {
          $.ajax({
            url: "livesearch.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              $("#searchresult").html(data);
            }
          });
        } else {
          $("searchresult").css("display", "none");
        }
      });
    });
  </script>
</body>

</html>