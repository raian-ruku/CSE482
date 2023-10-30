<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("location: signin.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment']) && isset($_POST['show_id'])) {
    require_once 'database.php';

    $comment = mysqli_real_escape_string($con, $_POST['comment']);
   // $comment= $_POST['comment'];
    $user = $_SESSION["user"];
    $show_id = $_POST['show_id'];

    $insertQuery = "INSERT INTO swcomments (user_id, show_id, comment_text) VALUES ((SELECT id FROM users WHERE u_name = '$user'), $show_id, '$comment')";

    if (mysqli_query($con, $insertQuery)) {
        echo '<script type="text/javascript">
                swal("Success", "Your comment has been posted!", "success").then(function() {
                    window.location.href = "index.php"; 
              </script>';
         header("location: index.php");
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    header("location: index.php");
}
?>