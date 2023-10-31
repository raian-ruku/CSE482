<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("location: /CSE482/signin.php");
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
    <form action="home.php" method="POST">
      <div class="search-bar">
        <input type="text" name="search" id="lsearch" autocomplete="off" placeholder="search">
        <ion-icon name="search-outline"></ion-icon>
      </div>
      <div id="searchresult"> </div>
    </form>
    <!-- <div id="searchresult"> </div> -->
    <div class="user-icons">
      <ion-icon name="person-outline"></ion-icon>
      <ion-icon name="bookmark-outline"></ion-icon>
      <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon></a>
    </div>
  </div>
  <div class="details">
    <p><?php echo $_SESSION['user']; ?></p>
  </div>
  <div class="profile">
    <div class="rv">Your Reviews
      <?php
      $loggedInUser = $_SESSION["user"];
      require_once "database.php";
      $sql = "SELECT id FROM users WHERE u_name = ?";
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, "s", $loggedInUser);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($result->num_rows > 0) {
        $userRow = $result->fetch_assoc();
        $userId = $userRow['id'];
      } else {
        echo "User not found.";
        exit();
      }
      $sql = "SELECT c.comment_text, m.id AS movie_id, m.title AS title
    FROM comments AS c
    INNER JOIN addmovie AS m ON c.movie_id = m.id
    WHERE c.user_id = ?";
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, "i", $userId);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($result->num_rows > 0) {
        echo "<h2>Movie Reviews:</h2>";
        while ($row = $result->fetch_assoc()) {
          $movieTitle = $row['title'];
          $commentText = $row['comment_text'];
          $movieId = $row['movie_id'];
          echo "Title: $movieTitle<br>";
          echo "Review: $commentText<br>";
          echo "<a href='movie_details.php?movie_id=$movieId' id='goto' >Go to review</a><br>";
          echo "<br>";
        }
      } else {
        echo "No movie reviews found for this user.";
      }
      $sql = "SELECT c.comment_text, s.id AS show_id,  s.title AS title
    FROM swcomments AS c
    INNER JOIN shows AS s ON c.show_id = s.id
    WHERE c.user_id = ?";
      $stmt = mysqli_prepare($con, $sql);
      mysqli_stmt_bind_param($stmt, "i", $userId);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($result->num_rows > 0) {
        echo "<h2>Show Reviews:</h2>";
        while ($row = $result->fetch_assoc()) {
          $showTitle = $row['title'];
          $commentText = $row['comment_text'];
          $showId = $row['show_id'];
          echo "Title: $showTitle<br>";
          echo "Review: $commentText<br>";
          echo "<a href='show_details.php?show_id=$showId' id='goto'>Go to review</a><br>";
          echo "<br>";
        }
      } else {
        echo "No show reviews found for this user.";
      }
      mysqli_close($con);
      ?>
    </div>
  </div>
  <a href="logout.php" class="btn btn-warning">logout </a>
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