<?php
session_start();
if (isset($_SESSION["user"])) {
  header("location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="/CSE482/CSS/signin.css" />
</head>

<body>
  <div class="top-panel">
    <a href="/pages/index.html" data-value="FLIXDB" id="logo">FLIXDB</a>
    <ion-icon name="menu-outline" id="hb"></ion-icon>
    <form action="">
      <div class="search-bar">
        <input type="text" name="search" id="search" placeholder="search" />
        <ion-icon name="search-outline"></ion-icon>
      </div>
    </form>
    <div class="user-icons">
      <a href="/CSE482/pages/profile_landing.html"><ion-icon name="person-outline"></ion-icon></a>
      <ion-icon name="bookmark-outline"></ion-icon>
      <ion-icon name="log-in-outline"></ion-icon>
    </div>
  </div>

  <div class="signin-form">
    <?php
    if (isset($_POST["submit"])) {
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $repeatpassword = $_POST["repeat_password"];
      $errors = array();
      $passwordhash = password_hash($password, PASSWORD_DEFAULT);

      if (empty($username) or empty($email) or empty($password) or empty($repeatpassword)) {
        array_push($errors, "All fileds are required");
      }
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email is not valid");
      }
      if (strlen($password) < 8) {
        array_push($errors, "Password must be 8 charecters long");
      }
      if ($password !== $repeatpassword) {
        array_push($errors, "Password doesn't match");
      }
      if (count($errors) > 0) {
        foreach ($errors as $error) {
          echo "<div class='alert alert-danger'> $error </div> ";
        }
      } else {
        require_once "database.php";

        $query = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
        $numrows = mysqli_num_rows($query);

        if ($numrows == 0) {
          $sql = "INSERT INTO users(u_name,email,password) 
                      VALUES('$username','$email','$passwordhash')";
          $result = mysqli_query($con, $sql);

          if ($result) {
            echo "<div class='alert alert-success'> you are registered successfully</div>";
          } else {
            die("something went wrong");
          }
        } else {
          echo "<div class='alert alert-success'>That email already exists!</div>";
        }
      }
    }

    ?>
    <form action="signup.php" method="post" id="form">
      <p data-value="WELCOME TO FLIXDB" id="welcome">WELCOME TO FLIXDB</p>
      <h2>Registration Form</h2>
      <label for="name">Username</label><br>
      <input type="text" name="username" id="" placeholder="enter your username" /><br>
      <label for="email">Email</label><br>
      <input type="email" name="email" id="" placeholder="enter your email" /><br>
      <form action="">
        <label for="password">Password</label><br>
        <input type="password" name="password" id="" placeholder="password must be 8 characters" />
        <br>
        <label for="password">Re-type Password</label><br>
        <input type="password" name="repeat_password" id="" placeholder="Re-type password" />
        <br>
        <input type="submit" value="Register" name="submit">

        <p>already have an account? <a href="signin.php">Sign In</a></p>
      </form>
  </div>

  <script src="/JS/logo.js"></script>
  <script src="/JS/welcome.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>