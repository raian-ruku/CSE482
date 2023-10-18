<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/CSE482/CSS/user_info.css" />
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
      <a href="/CSE482/profile_landing.html"><ion-icon name="person-outline"></ion-icon></a>

      <a href="/signin.html"><ion-icon name="log-in-outline"></ion-icon></a>
    </div>
  </div>
  <div class="user_list">
    <h1>Users List</h1>
    <table>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
      <?php

      require_once "database.php";
      $sql = "SELECT * FROM users";
      $result = mysqli_query($con, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($user = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $user["u_name"] . "</td>";
          echo "<td>" . $user["email"] . "</td>";
          echo '<td>
              <form method="post" action="/CSE482/delete_user.php">
                <input type="hidden" name="user_name" value="' . $user['u_name'] . '">
                <button type="submit" name="delete_user">Delete User</button>
              </form>
            </td>';
          echo "</tr>";
        }
      }

      ?>
    </table>
  </div>

  <script src="/CSE482/JS/logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>