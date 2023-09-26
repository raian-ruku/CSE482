<?php
require_once "database.php"; // Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["category"];
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $year = $_POST["year"];
    $rating = $_POST["rating"];
    $description = $_POST["description"];

    // Check if the category is "movie" or "show" and choose the table accordingly
    $table = ($category === "movie") ? "movies" : "shows";

    // Prepare and execute the SQL query to insert the data into the chosen table
    $sql = "INSERT INTO $table (title, genre, year, rating, description) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssiss", $title, $genre, $year, $rating, $description);
        $success = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($success) {
            echo "Movie/Show added successfully!";
        } else {
            echo "Error adding Movie/Show: " . mysqli_error($con);
        }
    } else {
        echo "SQL statement preparation failed.";
    }

    mysqli_close($con);
}
