<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  <link rel="stylesheet" href="/CSE482/CSS/add.css" />
  <link rel="stylesheet" href="/CSE482/CSS/home.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body>
  <div class="top-panel">
    <a href="/CSE482/index.php" data-value="FLIXDB" id="logo">FLIXDB</a>
    <ion-icon name="menu-outline" id="hb"></ion-icon>
    <form action="">
      <div class="search-bar">
      <input type="text" name="search" id="lsearch" autocomplete="off" placeholder="search">
          <ion-icon name="search-outline"></ion-icon>
      </div>
      <div id="searchresult"> </div>
    </form>
    <div class="user-icons">
      <a href="/CSE482/pages/profile_landing.html"><ion-icon name="person-outline"></ion-icon></a>

      <a href="/pages/signin.html"><ion-icon name="log-in-outline"></ion-icon></a>
    </div>
  </div>
  <div class="add">

    <h1>Add Movies/Shows</h1><br>
    <form action="add.php" id="add" method="post">
      <label for="category">Category</label>
      <select name="category" id="category">
        <option value="" disabled selected>Choose category</option>
        <option value="movie">Movie</option>
        <option value="show">Shows</option>
      </select>
      <label for="title">Title</label>
      <input type="text" name="title" id="title" placeholder="Title" />
      <label for="genre">Genre</label>
      <select name="genre" id="genre">
        <option value="" disabled selected>Choose genre</option>
        <option value="action">Action</option>
        <option value="comedy">Comedy</option>
        <option value="drama">Drama</option>
        <option value="horror">Horror</option>
        <option value="romance">Romance</option>
        <option value="thriller">Thriller</option>
      </select>
      <label for="year">Year</label>
      <input type="text" name="year" id="year" placeholder="Year" />
      <label for="cast">Cast</label>
      <input type="text" name="cast" id="cast" placeholder="Cast info" />
      <label for="director">Director</label>
      <input type="text" name="director" id="director" placeholder="director" />
      <label for="releasedate">Release Date</label>
      <input type="date" name="rdate" id="release_date" placeholder="release date" />
      <label for="rating">Rating</label>
      <input type="text" name="rating" id="rating" placeholder="Rating" />
      <label for="description">Description</label>
      <textarea name="description" id="description" cols="30" rows="10" placeholder="Description"></textarea>
      <label for="trailer_url">Trailer URL</label>
      <input type="text" name="trailer" id="year" placeholder="trailer url" />

      <label for="poster">Poster</label>
      <input type="text" name="poster" id="poster" placeholder="Poster link" oninput="showPosterPreview()">

      <label for="image">Image</label>
      <input type="text" name="image" id="image" placeholder="Add another image" oninput="showImagePreview()">
      <div class="image-view">
        <label for="image-preview">Poster Preview:</label><br>
        <div id="image-preview">
          <img src="" alt="Poster">
        </div>
        <label for="image-preview2">Image Preview:</label>
        <div id="image-preview2">
          <img src="" alt="Image">
        </div>
      </div>
      <input type="submit" value="Add" name="submit">

    </form>
  </div>

  </div>


  <?php

  if (isset($_POST["submit"])) {
    $category = $_POST["category"];
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $year = $_POST["year"];
    $cast = $_POST["cast"];
    $director = $_POST["director"];
    $release_date = $_POST["rdate"];
    $rating = $_POST["rating"];
    $description = $_POST["description"];
    $poster = $_POST["poster"];
    $image = $_POST["image"];
    $trailer = $_POST["trailer"];


    if (empty($category) or empty($title) or empty($genre) or empty($year) or empty($cast) or empty($director) or empty($release_date) or empty($rating) or empty($trailer) or empty($description) or empty($image) or empty($poster)) {
      echo "<script>
          Swal.fire({
            icon: 'warning',
            title: 'All fields are required',
            showConfirmButton: true,
            confirmButtonText: 'okay',
            confirmButtonColor: 'orange',
            
            
          });
          </script>";
    } else {

      require_once "database.php";
      $table = ($category === "movie") ? "addmovie" : "shows";
      $query = mysqli_query($con, "SELECT * FROM $table WHERE title='$title'");
      $numrows = mysqli_num_rows($query);

      if ($numrows == 0) {

        $sql = "INSERT INTO $table (category,title, genre, year, rating, description, trailer_url,  poster, image1, cast, director, release_date) VALUES ('$category','$title','$genre', '$year', '$rating','$description','$trailer','$poster', '$image','$cast','$director','$release_date')";

        $result = mysqli_query($con, $sql);


        if ($result) {
          echo "<script>
          Swal.fire({
            icon: 'success',
            title: '$title ($genre) was added to $category successfully! ',
            showConfirmButton: true,
            confirmButtonText: 'okay',
            confirmButtonColor: 'green',
            
            
          });
          </script>";
        } else {
          echo "<script>
          Swal.fire({
            icon: 'error',
            title: 'Error adding $title to $category' . mysqli_error($con) ,
            showConfirmButton: true,
            confirmButtonText: 'okay',
            confirmButtonColor: 'red',
            
            
          });
          </script>";
        }
      } else {
        echo
        "<script>
          Swal.fire({
            icon: 'error',
            title: 'SQL statement preparation failed',
            showConfirmButton: true,
            confirmButtonText: 'okay',
            confirmButtonColor: 'red',
            
            
          });
          </script>";
      }

      mysqli_close($con);
    }
  }

  ?>


  <script src="/CSE482/JS/logo.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="/CSE482/JS/image_preview.js"></script>

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