<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $location = $_POST['location'];
    $guests = $_POST['guests'];
    $arrival = $_POST['arrival'];
    $leaving = $_POST['leaving'];

    // Add your database connection and data insertion code here
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "bangtan";

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()) {
        die('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
    } else {
        $SELECT = "SELECT email FROM people_db WHERE email = ? LIMIT 1";
        $INSERT = "INSERT INTO people_db (name, email, phone, address, location, guests, arrival, leaving) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        $rnum = $stmt->num_rows;

        if ($rnum == 0) {
            $stmt->close();

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssssss", $name, $email, $phone, $address, $location, $guests, $arrival, $leaving);
            $stmt->execute();
            echo "New record inserted successfully";
        } else {
            echo "Someone already registered using this email";
        }
    }

    $stmt->close();
    $conn->close();
}
