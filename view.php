<?php

$conn = new mysqli("localhost", "root", "Test@123", "shopdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

echo "<h2>All Received Orders</h2>";

echo "<table border='1' cellpadding='8' cellspacing='0'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Name</th>";
echo "<th>Email</th>";
echo "<th>Phone</th>";
echo "</tr>";

if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
        echo "</tr>";
    }

} else {

    echo "<tr>";
    echo "<td colspan='4'>No records found</td>";
    echo "</tr>";
}

echo "</table>";

echo "<br><br>";
echo "<a href='register.html'>Back to Order Form</a>";

$conn->close();

?>