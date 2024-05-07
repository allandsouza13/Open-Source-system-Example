<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // If a module has been selected
    if (isset($_POST['selmodule'])) {
        // Prepare SQL statement for inserting into studentmodules
        $sql = "INSERT INTO studentmodules (studentid, modulecode) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $_SESSION['id'], $_POST['selmodule']);
        
        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<p class='alert alert-success'>The module " . htmlspecialchars($_POST['selmodule']) . " has been assigned to you</p>";
        } else {
            echo "<p class='alert alert-danger'>Error assigning module: " . mysqli_error($conn) . "</p>";
        }
    } else { // If a module has not been selected

        // Prepare SQL statement for selecting all modules
        $sql = "SELECT * FROM module";
        $result = mysqli_query($conn, $sql);

        echo "<div class='container'>";
        echo "<h2 class='mt-3'>Assign Module</h2>";
        echo "<p class='lead'>Select a module to assign:</p>";
        echo "<form name='frmassignmodule' action='' method='post'>";
        echo "<table class='table'>";
        echo "<thead class='table-dark'>";
        echo "<tr>";
        echo "<th>Module Code</th>";
        echo "<th>Module Name</th>";
        echo "<th>Action</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        // Display the module names in a table with rows
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['modulecode']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td><button type='submit' name='selmodule' value='" . htmlspecialchars($row['modulecode']) . "' class='btn btn-primary'>Assign</button></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo "</form>";
        echo "</div>"; // Close container
    }

    // Render the template
    echo template("templates/default.php", $data);

} else {
    // Redirect to index.php if the user is not logged in
    header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
