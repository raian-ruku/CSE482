<?php
require_once "database.php";
if (isset($_POST['delete_user'])) {
    $userName = trim($_POST['user_name']);
    $sql = "DELETE FROM users WHERE u_name = ?";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $userName);
        if (mysqli_stmt_execute($stmt)) {
            echo "User deleted successfully.";
        } else {
            echo "Failed to delete user. Error: " . mysqli_error($con);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the delete statement.";
    }
    mysqli_close($con);
}
