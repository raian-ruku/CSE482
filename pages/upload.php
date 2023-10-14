 <?php

  if (isset($_POST["submit"])) {
    $category = $_POST["category"];
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $year = $_POST["year"];
    $rating = $_POST["rating"];
    $description = $_POST["description"];
    $image = $_POST["image"];
    $trailer = $_POST["trailer"];


    if (empty($category) or empty($title) or empty($genre) or empty($year) or empty($rating) or empty($trailer) or empty($description)) {
      echo "All fileds are required";
    } else {

      require_once "database.php";
      $table = ($category === "movie") ? "addmovie" : "shows";
      $query = mysqli_query($con, "SELECT * FROM $table WHERE title='$title'");
      $numrows = mysqli_num_rows($query);

      if ($numrows == 0) {

        $sql = "INSERT INTO $table (category,title, genre, year, rating, description,image,trailer_url) VALUES ('$category','$title','$genre', '$year', '$rating','$description','$image','$trailer')";

        $result = mysqli_query($con, $sql);


        if ($result) {
          echo "$category added successfully!";
        } else {
          echo "Error adding $category: " . mysqli_error($con);
        }
      } else {
        echo "SQL statement preparation failed.";
      }

      mysqli_close($con);
    }
  }

  ?>