<?php
session_start();
if (isset($_SESSION["admin"])) {
  header("location: /CSE482/admin_panel.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="/CSE482/CSS/siginin.css" />
</head>

<body>
  <div class="top-panel">
    <a href="/CSE482/CSE482/index.php" data-value="FLIXDB" id="logo">FLIXDB</a>
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
        <input type="text" name="search" id="search" placeholder="search" />
        <ion-icon name="search-outline"></ion-icon>
      </div>
    </form>
    <div class="user-icons">
      <a href=""><ion-icon name="person-outline"></ion-icon></a>
      <ion-icon name="bookmark-outline"></ion-icon>
      <ion-icon name="log-in-outline"></ion-icon>
    </div>
  </div>
  <div class="signin-form">
    <?php
    if (isset($_POST["login"])) {
      $username = $_POST["username"];
      $pass = $_POST["password"];
      if ($username == "admin") {
        if (password_verify($pass, password_hash("Admin1199", PASSWORD_DEFAULT))) {
          setcookie("remember_username", $username, time() + 3600 * 24 * 30, "/");
          session_start();
          $_SESSION["admin"] = $username;
          header("location: /CSE482/admin_panel.php");
          die();
        } else {
          echo "<div class='alert alert-success'>password doesn't match.</div>";
        }
      } else {
        echo "<div class='alert alert-success'>incorrect username </div>";
      }
    }
    ?>
    <form action="adminsignin.php" method="POST" id="form">
      <p data-value="WELCOME TO FLIXDB" id="welcome">WELCOME TO FLIXDB</p>
      <p data-value="Admin Sign in" id="welcome">Admin Sign in</p>
      <label for="name">Username</label><br>
      <input type="text" name="username" id="" placeholder="enter username" /><br>
      <label for="password">Password</label><br>
      <input type="password" name="password" id="" placeholder="enter password" />
      <br>
      <input type="checkbox" name="remember_me" class="remember_me" id="remember_me" value="1">
      <label for="remember_me">Remember Me</label>
      <br>
      <input type="submit" name="login" value="Login">
      <a href="">Forgot Password?</a>
      <p> Don't have an account?<a href="signup.php">Sign Up</a></p>
    </form>
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