<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Use your MySQL username
$password = "";     // Use your MySQL password
$dbname = "food_4u";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data if submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_title = "Food Title"; // You can replace this with a dynamic value if necessary
    $quantity = $_POST['qty'];
    $full_name = $_POST['full-name'];
    $phone_number = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $price = 2.3; // Replace with a dynamic price if necessary

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO `order` (food_title, quantity, full_name, phone_number, email, address, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sissssd", $food_title, $quantity, $full_name, $phone_number, $email, $address, $price);

    // Execute the query
    if ($stmt->execute()) {
        echo "<script>alert('Order placed successfully!'); window.location.href='success.html';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
