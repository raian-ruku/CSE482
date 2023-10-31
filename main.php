<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location: signin.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="/CSE482/JS/logo.js" />
    <title>Home Page</title>
    <link rel="stylesheet" href="/CSE482/CSS/main1.css" />
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
        <form action="main.php" method="POST">
            <div class="search-bar">
                <input type="text" name="search" id="lsearch" autocomplete="off" placeholder="search">
                <ion-icon name="search-outline"></ion-icon>
            </div>
            <div id="searchresult"> </div>
        </form>
        <div class="user-icons">
            <ion-icon name="person-outline"></ion-icon>
            <ion-icon name="bookmark-outline"></ion-icon>
            <a href="logout.php"><ion-icon name="log-out-outline"></ion-icon></a>
        </div>
    </div>
    <h2 style="color: tomato;"> Movies </h2>
    <hr class="horizontal-lines">
    <div class="movie-card-container">
        <?php
        require_once 'database.php';
        $query = "SELECT * FROM addmovie";
        $result = mysqli_query($con, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['title'];
                $category = $row['category'];
                $description = $row['description'];
                $genre = $row['genre'];
                $image = $row['poster'];
                $trailer = $row['trailer_url'];
                $imageType = 'image/jpeg';
                $imageExtension = strtolower(pathinfo($title, PATHINFO_EXTENSION));
                if ($imageExtension == 'png') {
                    $imageType = 'image/png';
                }
                $imageBase = base64_encode($image);
                echo '<div class="movie-card">';
                echo '<img src="' . $image . '" alt="' . $title . '">';
                echo '<h2>' . $title . '</h2>';
                echo '<p>' . $description . '</p>';
                echo '<p>Genre: ' . $genre . '</p>';
                echo '<button class="watch-trailer-button" onclick="showTrailer(\'' . $trailer . '\')">Watch Trailer</button>';
                echo '<div class="like-dislike">';
                echo '<button class="like-button" onclick="likeMovie(\'' . $title . '\')">Like</button>';
                echo '<span id="like-count-' . $title . '">0</span>';
                echo '<button class="dislike-button" onclick="dislikeMovie(\'' . $title . '\')">Dislike</button>';
                echo '<span id="dislike-count-' . $title . '">0</span>';
                $title = $row['title'];
                if (isset($_SESSION["user"])) {
                    echo '<form action="comment.php" method="POST">';
                    echo '<input type="hidden" name="movie_id" value="' . $row['id'] . '">';
                    echo '<textarea name="comment" placeholder="Add your comment"></textarea>';
                    echo '<button type="submit">Post Comment</button>';
                    echo '</form>';
                } else {
                    echo '<p><a href="signin.php">Log in</a> to post comments.</p>';
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo 'No movies found.';
        }
        ?>
    </div>
    <h2 style="color: tomato;"> Shows </h2>
    <hr class="horizontal-lines">
    <div class="movie-card-container">
        <?php
        require_once 'database.php';
        $query = "SELECT * FROM shows";
        $result = mysqli_query($con, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['title'];
                $category = $row['category'];
                $description = $row['description'];
                $genre = $row['genre'];
                $image = $row['poster'];
                $trailer = $row['trailer_url'];
                $imageType = 'image/jpeg';
                $imageExtension = strtolower(pathinfo($title, PATHINFO_EXTENSION));
                if ($imageExtension == 'png') {
                    $imageType = 'image/png';
                }
                $imageBase = base64_encode($image);
                echo '<div class="movie-card">';
                echo '<h2>' . $title . '</h2>';
                echo '<p>' . $description . '</p>';
                echo '<p>Genre: ' . $genre . '</p>';
                echo '<button class="watch-trailer-button" onclick="showTrailer(\'' . $trailer . '\')">Watch Trailer</button>';
                echo '<div class="like-dislike">';
                echo '<button class="like-button" onclick="likeMovie(\'' . $title . '\')">Like</button>';
                echo '<span id="like-count-' . $title . '">0</span>';
                echo '<button class="dislike-button" onclick="dislikeMovie(\'' . $title . '\')">Dislike</button>';
                echo '<span id="dislike-count-' . $title . '">0</span>';
                $title = $row['title'];
                if (isset($_SESSION["user"])) {
                    echo '<form action="showcomment.php" method="POST">';
                    echo '<input type="hidden" name="movie_id" value="' . $row['id'] . '">';
                    echo '<textarea name="comment" placeholder="Add your comment"></textarea>';
                    echo '<button type="submit">Post Comment</button>';
                    echo '</form>';
                } else {
                    echo '<p><a href="signin.php">Log in</a> to post comments.</p>';
                }
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo 'No movies found.';
        }
        mysqli_close($con);
        ?>
    </div>
    <a href="logout.php" class="btn btn-warning">logout </a>
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