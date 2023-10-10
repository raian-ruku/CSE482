<?php // Include  database connection code

if (isset($_POST["submit"])) {
    $category = $_POST["category"];
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $year = $_POST["year"];
    $rating = $_POST["rating"];
    $description = $_POST["description"];
    $image=$_POST["image"];
    $trailer=$_POST["trailer"];

    // Check if the category is "movie" or "show" and choose the table accordingly
    if (empty($category) or empty($title) or empty($genre) or empty($year) or empty($rating) or empty($trailer) or empty($description)) {
        echo "All fileds are required";
      }
      else{

    require_once "database.php";
    $table = ($category === "movie") ? "addmovie" : "shows";
    $query = mysqli_query($con, "SELECT * FROM addmovie WHERE title='$title'");
    $numrows = mysqli_num_rows($query);

    if ($numrows == 0){
    // Prepare and execute the SQL query to insert the data into the chosen table
    $sql = "INSERT INTO $table (category,title, genre, year, rating, description,image,trailer_url) VALUES ('$category','$title','$genre', '$year', '$rating','$description','$image','$trailer')";
    // $stmt = mysqli_prepare($con, $sql);
    $result = mysqli_query($con, $sql);


    if ($result) {
        // mysqli_stmt_bind_param($stmt, "ssiss", $title, $genre, $year, $rating, $description);
        // $success = mysqli_stmt_execute($stmt);
        // mysqli_stmt_close($stmt);

        // if ($success) {
            echo "Movie/Show added successfully!";
        } else {
            echo "Error adding Movie/Show: " . mysqli_error($con);
        }
    }
  else {
        echo "SQL statement preparation failed.";
    }

    mysqli_close($con);
  }
}
 

