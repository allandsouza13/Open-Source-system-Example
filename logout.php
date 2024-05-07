<?php

/*
   Logout user and redirect to login page
*/

session_start();

// Check if the logout confirmation is submitted
if (isset($_POST['confirm'])) {
   // Unset the session and redirect to login page
   unset($_SESSION['id']);
   header("Location: index.php");
   exit; // Terminate script after redirection
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 400px;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-confirm {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Logout Confirmation</h2>
    <p>Are you sure you want to logout?</p>
    <form method="post">
        <button type="submit" name="confirm" class="btn btn-danger btn-confirm">Confirm</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
