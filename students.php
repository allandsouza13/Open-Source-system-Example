<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {

    // Check if the delete button is clicked
    if(isset($_POST['delete'])) {
        // Check if any checkboxes are selected
        if(isset($_POST['checkbox'])) {
            // Loop through the selected checkboxes and delete the corresponding student records
            foreach ($_POST['checkbox'] as $id) {
                // Protecting against SQL injection using mysqli_real_escape_string()
                $id = mysqli_real_escape_string($conn, $id);
                $sql = "DELETE FROM student WHERE studentid = '$id'";
                mysqli_query($conn, $sql);
            }
            // Redirect to the current page to refresh the table after deletion
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Build SQL statement to select student information
    $sql = "SELECT * FROM student";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Prepare page content
    $content = "<form action='' method='post' onsubmit='return confirmDelete()'>"; // Form starts here with onsubmit attribute
    $content .= "<div class='container-fluid'>";
    $content .= "<h2 class='mt-3'>Student Information</h2>";
    $content .= "<table class='table table-bordered'>";
    $content .= "<thead class='thead-dark'><tr><th>Check</th><th>Student ID</th><th>DOB</th><th>First Name</th><th>Last Name</th><th>Address</th><th>Town</th><th>County</th><th>Country</th><th>Postcode</th><th>Student Photo</th></tr></thead>";
    
    // Display student information within the HTML table
    while ($row = mysqli_fetch_array($result)) {
        $content .= "<tr><td><input type='checkbox' name='checkbox[]' value='".$row['studentid']."'></td><td>".$row['studentid']."</td><td>".$row['dob']."</td><td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['house']."</td><td>".$row['town']."</td><td>".$row['county']."</td><td>".$row['country']."</td><td>".$row['postcode']."</td>";
        // Display the student photo if image path is available
        if (!empty($row['image_path'])) {
            $content .= "<td><img src='".$row['image_path']."' style='max-width: 100px; max-height: 100px;'></td>";
        } else {
            $content .= "<td>No Photo Available</td>";
        }
    }
    $content .= "</table>";
    $content .= "<br><input type='submit' value='Delete' name='delete' class='btn btn-danger'/>";
    $content .= "</div>"; // Container ends here
    $content .= "</form>"; // Form ends here

    // JavaScript function to confirm delete action
    $content .= "<script>
                    function confirmDelete() {
                        return confirm('Do you really want to delete this record?');
                    }
                 </script>";

    // Render the template
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");
    echo template("templates/default.php", ['content' => $content]);
    echo template("templates/partials/footer.php");

} else {
    // Redirect to index.php if the user is not logged in
    header("Location: index.php");
    exit();
}

?>
