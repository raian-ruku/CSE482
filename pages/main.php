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
  <!-- <link rel="stylesheet" href="/CSE482/CSS/home.css" /> -->
  <link rel="stylesheet" href="/CSE482/JS/logo.js" />
    <title>Home Page</title>
    <link rel="stylesheet" href="/CSE482/CSS/main.css" />
    <link rel="stylesheet" href="/CSE482/CSS/main1.css" />
</head>
<body>
   
<div class="top-panel">
    <a href="/pages/index.html" data-value="FLIXDB" id="logo">FLIXDB</a>
    <ion-icon name="menu-outline" id="hb"></ion-icon>
    <form action="main.php" method="POST">
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
        $image = $row['image'];

         $trailer = $row['trailer_url'];

         $imageType = 'image/jpeg'; 
        $imageExtension = strtolower(pathinfo($title, PATHINFO_EXTENSION));
        if ($imageExtension == 'png') {
            $imageType= 'image/png';
        }

         $imageBase = base64_encode($image);
       

        // Display movie poster, title, description, genre, and a "View Details" link
        echo '<div class="movie-card">';
        echo '<img src="data:' . $imageType . ';base64,' . $imageBase . '" alt="' . $title . '">';
        //echo '<img src="data:image/JPG;base64,' . $imageBase . '" alt="' . $title . '">';
       // echo '<img src="' . $image . '" alt="' . $title . '">';
        echo '<h2>' . $title . '</h2>';
        echo '<p>' . $description . '</p>';
        echo '<p>Genre: ' . $genre . '</p>';
        echo '<button class="watch-trailer-button" onclick="showTrailer(\'' . $trailer . '\')">Watch Trailer</button>';
        echo '<div class="like-dislike">';
        echo '<button class="like-button" onclick="likeMovie(\'' . $title . '\')">Like</button>';
        echo '<span id="like-count-' . $title . '">0</span>';
        echo '<button class="dislike-button" onclick="dislikeMovie(\'' . $title . '\')">Dislike</button>';
        echo '<span id="dislike-count-' . $title . '">0</span>';
        
        echo '</div>';
        // echo '<a href="' . $trailer . '" target="_blank">Watch Trailer</a>';
        //echo '<a href=" " target="_blank">View Details</a>'; // Open trailer in a new tab
        echo '</div>';
    } 
} else {
    echo 'No movies found.';
}

mysqli_close($con);
?>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <iframe id="videoFrame" width="560" height="315" src="" frameborder="0" allowfullscreen></iframe>
    </div>
</div>

<script>
function showTrailer(trailer_url) {

    var modal = document.getElementById("myModal");
    var videoFrame = document.getElementById("videoFrame");
    videoFrame.src = trailer_url;
    modal.style.display = "block";
}

function closeModal() {
    
    var modal = document.getElementById("myModal");
    var videoFrame = document.getElementById("videoFrame");
    videoFrame.src = "";
    modal.style.display = "none";
}

var likes = {}; 
var dislikes = {}; 
//var ratings = {}; 

function likeMovie(title) {
    if (!likes[title]) {
        likes[title] = 0;
    }
    likes[title]++;
    document.getElementById("like-count-" + title).textContent = likes[title];
}

function dislikeMovie(title) {
    if (!dislikes[title]) {
        dislikes[title] = 0;
    }
    dislikes[title]++;
    document.getElementById("dislike-count-" + title).textContent = dislikes[title];
}


</script>
<a href="logout.php" class="btn btn-warning">logout </a>

</body>
</html>
