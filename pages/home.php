<?php
session_start();
if (!isset($_SESSION["user"])) {
  header("location: signin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="/CSE482/CSS/home.css" />
</head>

<body>
  <div class="top-panel">
    <a href="/pages/index.html" data-value="FLIXDB" id="logo">FLIXDB</a>
    <ion-icon name="menu-outline" id="hb"></ion-icon>
    <form action="home.php" method="POST">
      <div class="search-bar">
        <input type="text" name="search" id="search" placeholder="search" />
        <ion-icon name="search-outline"></ion-icon>
      </div>
    </form>
    <table>
      <?php
      if (isset($_POST['search'])) {
        $search = $_POST['search'];


        require_once "/CSE482/pages/database.php";
        $sql = "SELECT * FROM movies WHERE movie_name LIKE '%$search%' UNION SELECT * FROM movies WHERE movie_name LIKE '%$search%'";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
      ?>
            <tr?>
              <th>Name</th>
              <th>Release Date</th>


              <th>Director</th>
              <th>Cast</th>
              </tr>
              <tr>
                <td><?php echo  $row["movie_name"]; ?></td>
                <td><?php echo  $row["release_date"]; ?></td>
                <td><?php echo  $row["director"]; ?></td>
                <td><?php echo  $row["cast"]; ?></td>


              </tr>
        <?php

          }
        } else echo "<p id='error'>Nothing related to your search criteria was found. Do you want to submit a request to add your favorite show/movie?</p> <span><button id='errb' onclick=location.href='request.php'>Submit a request</button></span>";
      }
        ?>
    </table>

    <div class="user-icons">
      <ion-icon name="person-outline"></ion-icon>
      <ion-icon name="bookmark-outline"></ion-icon>
      <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon></a>
    </div>
  </div>
  <div class="details">
    <img src="/CSE482/CSS/IMG_20230427_183213.png" alt="profile_image" />
    <p>name</p>
    <a href="/pages/edit_profile.html" id="edit">Edit profile</a>
  </div>
  <div class="profile">
    <div class="wl">Your Watchlist</div>
    <div class="rv">Your Reviews</div>
  </div>
  <a href="logout.php" class="btn btn-warning">logout </a>
  <script src="logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>