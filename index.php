<style>
  <?php include "/CSE482/CSS/index.css" ?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/CSE482/CSS/index.css" />
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
      <a href="/CSE482/pages/signin.php"><ion-icon name="log-in-outline"></ion-icon></a>
    </div>
  </div>
  <div class="trending">
    <div class="tn">
      <h2 class="horizontal-lines">Trending Now</h2>
      <button>View All</button>
    </div>
    <br />
    <div class="trendingcards">
      <?php
      require_once "database.php";
      $sql = "SELECT * FROM movies";
      $result = mysqli_query($con, $sql);

      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $movieName = $row['movie_name'];
          $actors = $row['cast'];
          $director = $row['director'];
          $category = $row['category'];
          $releaseDate = $row['release_date'];
          $rating = $row['rating'];

          // Create a link for each movie card
          echo '<a href="/CSE482/pages/movie_details.php?movie_id=' . $row['id'] . '">';
          echo '<div class="trending-card">
                  <img src="/CSS/IMG_20230427_183213.png" alt="trending movie" />
                  <div class="trending-card-info">
                    <h3>' . $movieName . '</h3>
                    <p>' . $actors . '</p>
                    <p>' . $director . '</p>
                    <p>' . $category . '</p>
                    <p>' . $releaseDate . '</p>
                    <p>' . $rating . '</p>
                  </div>
                </div>';
          echo '</a>';
        }
      } else {
        echo 'No movies found.';
      }
      ?>
    </div>
  </div>
  <div class="vertical-line"></div>
  <script src="/CSE482/JS/logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>