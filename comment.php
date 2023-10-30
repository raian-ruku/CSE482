<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location: signin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment']) && isset($_POST['movie_id'])) {
    require_once 'database.php';

    $comment = mysqli_real_escape_string($con, $_POST['comment']);
   // $comment= $_POST['comment'];
    $user = $_SESSION["user"];
    $movie_id = $_POST['movie_id'];

    $insertQuery = "INSERT INTO comments (user_id, movie_id, comment_text) VALUES ((SELECT id FROM users WHERE u_name = '$user'), $movie_id, '$comment')";

    if (mysqli_query($con, $insertQuery)) {
        echo '<script type="text/javascript">
                swal("Success", "Your comment has been posted!", "success").then(function() {
                    window.location.href = "movies.php"; 
              </script>';
         header("location: movies.php");
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    header("location: movies.php");
}
?>
