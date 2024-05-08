<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

if (isset($_SESSION['id'])) {
    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    if (isset($_POST['submit'])) {
        $errors = array();

        // Validate form data
        $required_fields = array('txtstudentid', 'txtdob', 'txtpassword', 'txtfirstname', 'txtlastname', 'txthouse', 'txttown', 'txtcounty', 'txtcountry', 'txtpostcode');
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                $errors[] = "Please fill in all fields.";
                break; // Stop loop after finding the first empty field
            }
        }

        // File upload handling
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // If file uploaded successfully, proceed with database insertion

            $studentid = mysqli_real_escape_string($conn, $_POST['txtstudentid']);
            $dob = mysqli_real_escape_string($conn, $_POST['txtdob']);
            $password = password_hash($_POST['txtpassword'], PASSWORD_DEFAULT);
            $firstname = mysqli_real_escape_string($conn, $_POST['txtfirstname']);
            $lastname = mysqli_real_escape_string($conn, $_POST['txtlastname']);
            $house = mysqli_real_escape_string($conn, $_POST['txthouse']);
            $town = mysqli_real_escape_string($conn, $_POST['txttown']);
            $county = mysqli_real_escape_string($conn, $_POST['txtcounty']);
            $country = mysqli_real_escape_string($conn, $_POST['txtcountry']);
            $postcode = mysqli_real_escape_string($conn, $_POST['txtpostcode']);
            $image_path = $target_file;

            $sql = "INSERT INTO student (studentid, dob, password, firstname, lastname, house, town, county, country, postcode, image_path) ";
            $sql .= "VALUES ('$studentid', '$dob', '$password', '$firstname', '$lastname', '$house', '$town', '$county', '$country', '$postcode', '$image_path')";

            if (mysqli_query($conn, $sql)) {
                $data['content'] = "<p class='alert alert-success'>New student added successfully.</p>";
            } else {
                $errors[] = "Error: " . mysqli_error($conn);
                $error_message = implode("<br>", $errors);
                echo "<script>alert('$error_message'); window.location.href = 'addstudents.php';</script>";
            }
        } else {
            // If file upload failed, display error message
            $errors[] = "Sorry, there was an error uploading your file.";
            $error_message = implode("<br>", $errors);
            echo "<script>alert('$error_message'); window.location.href = 'addstudents.php';</script>";
        }
    } else {
        // Display form
        $data['content'] = <<<EOD
            <div class="container mt-4">
                <h2>Add New Student</h2>
                <form name="frmaddstudent" action="addstudents.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="txtstudentid" class="form-label">Student ID</label>
                        <input name="txtstudentid" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtdob" class="form-label">Date of Birth</label>
                        <input name="txtdob" type="date" class="form-control" required>
                    </div>
                    <div class="row g-3">
                        <div class="col">
                            <label for="txtfirstname" class="form-label">First Name</label>
                            <input name="txtfirstname" type="text" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="txtlastname" class="form-label">Surname</label>
                            <input name="txtlastname" type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="txthouse" class="form-label">Number and Street</label>
                        <input name="txthouse" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="txttown" class="form-label">Town</label>
                        <input name="txttown" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtcounty" class="form-label">County</label>
                        <input name="txtcounty" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtcountry" class="form-label">Country</label>
                        <input name="txtcountry" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtpostcode" class="form-label">Postcode</label>
                        <input name="txtpostcode" type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtpassword" class="form-label">Password</label>
                        <input name="txtpassword" type="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fileToUpload" class="form-label">Upload Image</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Add Student</button>
                </form>
            </div>
        EOD;
    }

    echo template("templates/default.php", $data);
} else {
    header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
