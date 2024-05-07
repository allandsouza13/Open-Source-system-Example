<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Check if the delete button contains a value
    if (isset($_POST['btndel'])) {
        // Delete student records parsed from the student entity
        foreach ($_POST['stuID'] as $id){
            // Prepare the SQL statement with a placeholder for student ID
            $sql = "DELETE FROM student WHERE studentid = ?";
            
            // Prepare the statement
            $stmt = mysqli_prepare($conn, $sql);
            
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "s", $id);
            
            // Execute the statement
            $result = mysqli_stmt_execute($stmt);
            
            if (!$result) {
                // Handle any errors that occur during deletion
                echo "Error deleting student with ID $id: " . mysqli_error($conn);
            }
        }
        // Prepare success message
        $data['content'] .= "<p>Selected items deleted</p>";
    }

    // Display delete form with confirmation dialog
    $data['content'] .= '<form id="deleteForm" action="" method="post" onsubmit="return confirm(\'Do you really want to delete this record?\');">';
    // Include student IDs input fields here
    $data['content'] .= '<input type="submit" name="btndel" value="Delete Selected">';
    $data['content'] .= '</form>';

    // Link back to students.php
    $data['content'] .= '<form action="students.php" method="post">';
    $data['content'] .= '<input type="submit" name="btnback" value="Back">';
    $data['content'] .= '</form>';

    // Render the template
    echo template("templates/default.php", $data);

} else {
    // Redirect to index.php if the user is not logged in
    header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
