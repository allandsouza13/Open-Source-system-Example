<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Account login check
if (isset($_SESSION['id'])) {
    // Create student entries
    $array_students = array(
        array(
            "studentid" => "20000001",
            "password" => "password1",
            "dob" => "1980-08-25",
            "firstname" => "Terry",
            "lastname" => "Walker",
            "house" => "25 Maine Way",
            "town" => "High Wycombe",
            "county" => "Bucks",
            "country" => "UK",
            "postcode" => "HP12 1ZZ"
        ),
        array(
            "studentid" => "20000002",
            "password" => "password2",
            "dob" => "1970-05-23",
            "firstname" => "Elizabeth",
            "lastname" => "Wayne",
            "house" => "7 Dry Avenue",
            "town" => "Henley-on-Thames",
            "county" => "Oxfordshire",
            "country" => "UK",
            "postcode" => "RG11 2FE"
        ),
        array(
            "studentid" => "20000003",
            "password" => "password3",
            "dob" => "1982-03-15",
            "firstname" => "Max",
            "lastname" => "Turner",
            "house" => "12 River Drive",
            "town" => "Henley-on-Thames",
            "county" => "Oxfordshire",
            "country" => "UK",
            "postcode" => "RG15 5ES"
        ),
        array(
            "studentid" => "20000004",
            "password" => "password4",
            "dob" => "1980-08-25",
            "firstname" => "Sarah",
            "lastname" => "Reed",
            "house" => "9 Hill Road",
            "town" => "High Wycombe",
            "county" => "Bucks",
            "country" => "UK",
            "postcode" => "HP17 3HE"
        ),
        array(
            "studentid" => "20000005",
            "password" => "password5",
            "dob" => "1986-02-12",
            "firstname" => "Chloe",
            "lastname" => "Hart",
            "house" => "15 Rain Street",
            "town" => "Henley-on-Thames",
            "county" => "Oxfordshire",
            "country" => "UK",
            "postcode" => "RG22 7WQ"
        ),
    );

    // Build prepared statements to insert 5 student records into the database
    foreach ($array_students as $student) {
        // Hash the password before inserting
        $hashed_password = password_hash($student['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", $student['studentid'], $hashed_password, $student['dob'], $student['firstname'], $student['lastname'], $student['house'], $student['town'], $student['county'], $student['country'], $student['postcode']);
        $stmt->execute();
    }

    echo "Records inserted successfully.<br>";
}

// Close the database connection
$conn->close();

?>
