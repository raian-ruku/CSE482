<style>
    <?php include "/CSE482/CSS/trending.css" ?>
</style>

<?php
// session_start();
// if (!isset($_SESSION["user"])) {
//   header("location: signin.php");
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/CSE482/CSS/trending.css" />

</head>

<body>
    <div class="top-panel">
        <a href="/CSE482/index.php" data-value="FLIXDB" id="logo">FLIXDB</a>
        <ion-icon name="menu-outline" id="hb" onclick="toggleMenu()"></ion-icon>
        <div class="fullscreen-menu" id="menu">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="pages/main.php">Movies</a></li>
                <li><a href="#">TV Shows</a></li>
                <li><a href="#">Genres</a></li>
                <li><a href="#">Top Rated</a></li>
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
            <a href="/CSE482/profile_landing.html"><ion-icon name="person-outline"></ion-icon></a>
            <ion-icon name="bookmark-outline"></ion-icon>
            <!-- <a href="/CSE482/signin.php"><ion-icon name="log-in-outline"></ion-icon></a> -->
            <a href="pages/logout.php"><ion-icon name="log-out-outline"></ion-icon></a>
        </div>
    </div>


    <h1>TRENDING MOVIES</h1>

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

            echo '
             <table class="movie-table">
    <tr>
      <td class="movie-image"><img src="' . $imageSrc . '" alt="' . $movieName . '" /></td>
      <td class="movie-details">
        <a href=\'/CSE482/movie_details.php?movie_id=' . $row['id'] . '\'>' . $movieName . '</a>
        <table>
          <tr>
            <td class="label">Actors:</td>
            <td>' . $actors . '</td>
          </tr>
          <tr>
            <td class="label">Director:</td>
            <td>' . $director . '</td>
          </tr>
          <tr>
            <td class="label">Category:</td>
            <td>' . $category . '</td>
          </tr>
          <tr>
            <td class="label">Release Date:</td>
            <td>' . $releaseDate . '</td>
          </tr>
          <tr>
            <td class="label">Rating:</td>
            <td>' . $rating . '</td>
          </tr>
        </table>
        <button class="like-button" onclick="likeMovie(' . $row['id'] . ')">Like</button>
        <span id="like-count-' . $row['id'] . '">0</span>
        <button class="dislike-button" onclick="dislikeMovie(' . $row['id'] . ')">Dislike</button>
        <span id="dislike-count-' . $row['id'] . '">0</span>
      </td>
    </tr>
  </table>';
        }
    } else {
        echo 'No movies found.';
    }

    ?>





    <!-- <a href="logout.php" class="btn btn-warning">logout </a> -->
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
                // alert(input);
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