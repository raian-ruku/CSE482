<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/CSE482/CSS/movie_details.css" />
  <link rel="stylesheet" href="/CSE482/CSS/home.css" />
</head>

<body>
  <div class="top-panel">
    <a href="/CSE482/index.php" data-value="FLIXDB" id="logo">FLIXDB</a>
    <ion-icon name="menu-outline" id="hb"></ion-icon>
    <form action="">
      <div class="search-bar">
        <input type="text" name="search" id="lsearch" autocomplete="off" placeholder="search" />
        <ion-icon name="search-outline"></ion-icon>
      </div>
      <div id="searchresult"></div>
    </form>
    <div class="user-icons">
      <a href="/CSE482/profile_landing.html"><ion-icon name="person-outline"></ion-icon></a>
      <ion-icon name="bookmark-outline"></ion-icon>
      <!-- <a href="/signin.html"><ion-icon name="log-in-outline"></ion-icon></a> -->
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

        if (
          $result && mysqli_num_rows($result) >
          0
        ) {
          $row = mysqli_fetch_assoc($result);
          $movieName = $row['title'];
          $rating = $row['rating'];
          $popularity = $row['popularity'];
          $releaseDate =
            $row['release_date'];
          $category = $row['category'];
          $stars = $row['cast'];
          $director = $row['director'];
          $description = $row['description'];
          $poster
            = $row['poster'];
          $image = $row['image1'];
          $trailer = $row['trailer_url'];
          echo '
      <div class="sd">
        <p>' . $movieName . '</p>
        <div class="rp">
          <p>Rating: ' . $rating . '</p>
          <p>Popularity: ' . $popularity . '</p>
        </div>
      </div>
      <p>Release Date: ' . $releaseDate . '</p>
      <div class="image-carousel">
        <button class="carousel-btn prev-btn" onclick="prevImage()">
          &lt;
        </button>
        <img class="carousel-image" src="' . $poster . '" alt="' . $movieName . '" />
        <iframe
          class="carousel-iframe"
          src="' . $trailer . '"
          frameborder="0"
          allowfullscreen
        ></iframe>
        <img class="carousel-image" src="' . $image . '" alt="' . $movieName . '" />
        <button class="carousel-btn next-btn" onclick="nextImage()">
          &gt;
        </button>
      </div>

      <p>Category: ' . $category . '</p>
      <p>Stars: ' . $stars . '</p>
      <p>Director: ' . $director . '</p>
      <p>Description: ' . $description . '</p>
      ';
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
    } ?>
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

  <script src="/CSE482/JS/logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="/CSE482/JS/carousel.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $("#lsearch").keyup(function() {
        var input = $(this).val();
        // alert(input);
        if (input != "") {
          $.ajax({
            url: "livesearch.php",
            method: "POST",
            data: {
              input: input,
            },

            success: function(data) {
              $("#searchresult").html(data);
            },
          });
        } else {
          $("searchresult").css("display", "none");
        }
      });
    });
  </script>
</body>

</html>