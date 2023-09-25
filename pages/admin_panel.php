<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    <?php include "/CSE482/CSS/admin_panel.css" ?>
  </style>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/CSE482/CSS/admin_panel.css" />
</head>

<body>
  <div class="top-panel">
    <a href="/CSE482/index.php" data-value="FLIXDB" id="logo">FLIXDB</a>
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

      <a href="/pages/signin.html"><ion-icon name="log-in-outline"></ion-icon></a>
    </div>
  </div>
  <div class="profile">
    <img src="/CSS/IMG_20230427_183213.png" alt="admin_image" />
    <p>name</p>
    <div class="links">
      <a href="/CSE482/pages/user_info.php">User Information</a>
      <a href="/CSE482/pages/add.php">Add Movies/Shows</a>
      <a href="#">Delete</a>
      <a href="#">Comments/Reviews</a>
    </div>
  </div>
  <script src="/CSE482/JS/logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>