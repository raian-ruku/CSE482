<style>
  <?php include "/CSE482/CSS/index.css" ?>
</style>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="/CSE482/CSS/index.css" />
  <link rel="stylesheet" href="/CSE482/CSS/home.css" />
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
    <form action="index.php">
      <div class="search-bar">
        <input type="text" name="search" id="lsearch" autocomplete="off" placeholder="search">
        <ion-icon name="search-outline"></ion-icon>
      </div>
      <div id="searchresult" class="search-results"> </div>
    </form>
    <div class="user-icons">
      <a href="/CSE482/home.php"><ion-icon name="person-outline"></ion-icon></a>
      <ion-icon name="bookmark-outline"></ion-icon>
      <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon></a>
    </div>
  </div>
  <div class="trending">
    <div class="tn">
      <h2 class="horizontal-lines">Trending Movies</h2>
      <button onclick="window.location.href='/CSE482/trending_movies.php'">View All</button>
    </div>
    <br />
    <div class="trendingcards">
      <?php
      require_once "database.php";
      $sql = "SELECT * FROM addmovie WHERE trending = 1";
      $result = mysqli_query($con, $sql);
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $movieName = $row['title'];
          $actors = $row['cast'];
          $director = $row['director'];
          $category = $row['category'];
          $releaseDate = $row['release_date'];
          $rating = $row['rating'];
          $imageSrc = $row['poster'];
          echo '<div class="trending-card">';
          echo  '<img src="' . $imageSrc . '" alt="' . $movieName . '" />';
          echo '<div class="trending-card-info">';
          echo '<a href=\'/CSE482/movie_details.php?movie_id=' . $row['id'] . '\'">' . $movieName . '</a>';
          echo '<p> Cast: ' . $actors . '</p>';
          echo '<p> Director: ' . $director . '</p>';

          echo '<p> Release Date: ' . $releaseDate . '</p>';
          echo '<p> Rating: ' . $rating . '</p>';
          echo '<button class="like-button" onclick="likeMovie(' . $row['id'] . ')">Like</button>';
          echo '<span id="like-count-' . $row['id'] . '">0</span>';
          echo '<button class="dislike-button" onclick="dislikeMovie(' . $row['id'] . ')">Dislike</button>';
          echo '<span id="dislike-count-' . $row['id'] . '">0</span>';
          echo '</div>';
          echo '</div>';
        }
      } else {
        echo 'No movies found.';
      }
      ?>
    </div>
  </div>
  <br>
  <div class="trending2">
    <div class="tn2">
      <h2 class="horizontal-lines">Trending Shows</h2>
      <button onclick="window.location.href='/CSE482/trending_shows.php'">View All</button>
    </div>
    <br />
    <div class=" trendingcards">
      <?php
      require_once "database.php";
      $sql = "SELECT * FROM shows WHERE trending = 1";
      $result = mysqli_query($con, $sql);
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $movieName = $row['title'];
          $actors = $row['cast'];
          $director = $row['director'];
          $category = $row['category'];
          $releaseDate = $row['release_date'];
          $rating = $row['rating'];
          $imageSrc = $row['poster'];
          echo '<div class="trending-card">';
          echo '<img src="' . $imageSrc . '" alt="' . $movieName . '" />';
          echo '<div class="trending-card-info">';
          echo '<a alt="' . $movieName . '" href=\'/CSE482/show_details.php?show_id=' . $row['id'] . '\'">' . $movieName . '</a>';
          echo '<p> Cast: ' . $actors . '</p>';
          echo '<p> Director: ' . $director . '</p>';

          echo '<p> Release Date: ' . $releaseDate . '</p>';
          echo '<p> Rating ' . $rating . '</p>';
          echo '<button class="like-button" onclick="likeMovie(' . $row['id'] . ')">Like</button>';
          echo '<span id="like-count-' . $row['id'] . '">0</span>';
          echo '<button class="dislike-button" onclick="dislikeMovie(' . $row['id'] . ')">Dislike</button>';
          echo '<span id="dislike-count-' . $row['id'] . '">0</span>';
          echo '</div>';
          echo '</div>';
        }
      } else {
        echo 'No movies found.';
      }
      ?>
    </div>
  </div>
  <script src="/CSE482/JS/logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="/CSE482/JS/dropdown.js"></script>
  <script src='/CSE482/JS/like_dislike.js'></script>
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