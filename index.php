<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

echo template("templates/partials/header.php");

$msg = ""; // Initialize the message variable

// Check if login failed message is set in the URL
if (isset($_GET['return']) && $_GET['return'] == "fail") {
    $msg = "Login Failed. Please try again.";
}

// Display the login form if the user is not logged in
if (!isset($_SESSION['id'])) {
    $data['message'] = "<p>$msg</p>";
    echo template("templates/login.php", $data);
} else {
    // User is logged in, display dashboard
    $data['content'] = "<H1>Welcome to your Dashboard.</H1>";
    echo template("templates/partials/nav.php");
    echo template("templates/default.php", $data);
}

echo template("templates/partials/footer.php");
?>
