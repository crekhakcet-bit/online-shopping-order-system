<?php

$conn = new mysqli("localhost", "root", "Test@123", "shopdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $password = $_POST['password'];
    $card = $_POST['card'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO orders
            (name, password, card, email, phone)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt) {

        $stmt->bind_param(
            "sssss",
            $name,
            $hashedPassword,
            $card,
            $email,
            $phone
        );

        if ($stmt->execute()) {
            echo "<h3>Order stored successfully!</h3>";
            echo "<a href='view.php'>View All Orders</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();

    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();

?>