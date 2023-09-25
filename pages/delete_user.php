<?php
require_once "/CSE482/pages/database.php";

if (isset($_POST['delete_user'])) {
    // Retrieve the user's name from the form
    $userName = trim($_POST['user_name']);

    // Prepare the DELETE query
    $sql = "DELETE FROM users WHERE u_name = ?";

    // Create a prepared statement
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        // Bind the user's name as a parameter
        mysqli_stmt_bind_param($stmt, "s", $userName);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Deletion was successful
            echo "User deleted successfully.";
        } else {
            // Deletion failed, display MySQL error
            echo "Failed to delete user. Error: " . mysqli_error($con);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Failed to prepare the statement
        echo "Failed to prepare the delete statement.";
    }

    // Close the database connection
    mysqli_close($con);
}
