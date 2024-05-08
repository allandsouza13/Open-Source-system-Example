<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Custom styling for navbar links */
        .navbar-nav .nav-link {
            font-size: 18px; /* Adjust font size as needed */
            padding: 6px 12px; /* Add padding for better spacing */
            transition: all 0.3s ease; /* Add smooth transition effect */
        }

        /* Hover effect for navbar links */
        .navbar-nav .nav-link:hover {
            color: #fff; /* Change text color on hover */
            background-color: #007bff; /* Change background color on hover */
            border-radius: 5px; /* Add border-radius for rounded corners */
        }

        /* Active link styling */
        .navbar-nav .nav-item.active .nav-link {
            font-weight: bold; /* Make active link bold */
        }

        /* Background color for navbar item */
        .navbar-nav .nav-item {
            background-color: #f8f9fa; /* Grey background color */
            border-radius: 5px; /* Add border-radius for rounded corners */
            margin: 5px 0; /* Add margin for spacing */
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <button class="nav-link btn btn-link btn-sm" onclick="window.location.href='modules.php'">My Modules</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-link btn-sm" onclick="window.location.href='Students.php'">Students</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-link btn-sm" onclick="window.location.href='assignmodule.php'">Assign Module</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-link btn-sm" onclick="window.location.href='addstudents.php'">Add Student</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-link btn-sm" onclick="window.location.href='details.php'">My Details</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link btn btn-link btn-sm" onclick="window.location.href='logout.php'">Logout</button>
                </li>
                <li class="nav-item">
                    <form class="form-inline" action="Search.php" method="post">
                        <input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search_term">
                        <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit" name="search">Search</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap Bundle with Popper and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
