<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db("food_4u");

// Create table if it doesn't exist
$table_create_query = "CREATE TABLE IF NOT EXISTS delivery_registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    mobile_number VARCHAR(15) NOT NULL,
    vehicle_type VARCHAR(50) NOT NULL,
    cv_file VARCHAR(255) NOT NULL,
    delivery_days TEXT NOT NULL
)";

if ($conn->query($table_create_query) === TRUE) {
    echo "Table 'delivery_registration' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $vehicle_type = $_POST['vehicle_type'];
    $delivery_days = isset($_POST['delivery_days']) ? implode(', ', $_POST['delivery_days']) : '';
    $cv_file = $_FILES['cv']['name'];

    // Handle file upload
    $upload_dir = "uploads/delivery/";
    $upload_file = $upload_dir . basename($_FILES['cv']['name']);

    if (move_uploaded_file($_FILES['cv']['tmp_name'], $upload_file)) {
        echo "File uploaded successfully.<br>";
    } else {
        echo "Error uploading file.<br>";
    }

    // Insert data into the table
    $insert_query = "INSERT INTO delivery_registration 
        (first_name, last_name, email, address, mobile_number, vehicle_type, cv_file, delivery_days)
        VALUES ('$first_name', '$last_name', '$email', '$address', '$mobile', '$vehicle_type', '$cv_file', '$delivery_days')";

    if ($conn->query($insert_query) === TRUE) {
        echo "New delivery registration created successfully.";
        echo "<a href='main.html'> Click here to go to main  page</a>";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
