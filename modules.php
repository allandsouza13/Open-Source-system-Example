<?php

// Include necessary files
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Include header and navigation templates
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Build SQL statement that selects a student's modules using prepared statements
    $sql = "SELECT * FROM studentmodules sm JOIN module m ON m.modulecode = sm.modulecode WHERE sm.studentid = ?";

    // Prepare the SQL statement
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind the session id parameter
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['id']);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        // Get the result of the executed statement
        $result = mysqli_stmt_get_result($stmt);

        // Check if any rows are returned
        if (mysqli_num_rows($result) > 0) {
            // Prepare page content
            $data['content'] .= "<div class='container'>";
            $data['content'] .= "<h2 class='mt-3'>Modules Info</h2>";
            $data['content'] .= "<table class='table table-bordered'>";
            $data['content'] .= "<thead class='thead-dark'><tr><th colspan='3' align='center'>Modules</th></tr>";
            $data['content'] .= "<tr><th>Code</th><th>Type</th><th>Level</th></tr></thead>";
            // Display the modules within the HTML table
            while ($row = mysqli_fetch_assoc($result)) {
                $data['content'] .= "<tr><td>".$row['modulecode']."</td><td>".$row['name']."</td>";
                $data['content'] .= "<td>".$row['level']."</td></tr>";
            }
            $data['content'] .= "</table>";
            $data['content'] .= "</div>";
        } else {
            $data['content'] .= "<p>No modules found.</p>";
        }
    } else {
        // Error handling if preparing the statement fails
        echo "Error: " . mysqli_error($conn);
    }

    // Render the template
    echo template("templates/default.php", $data);

} else {
    // Redirect to index.php if the user is not logged in
    header("Location: index.php");
}

// Include footer template
echo template("templates/partials/footer.php");

?>
