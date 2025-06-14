<?php
// Database connection details
$servername = "localhost";
$username = "root"; 
$password = "";   

// Connect to the database
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Exit if connection fails
}

// Select the database
$conn->select_db("food_4u");

// Create the sessions table if it doesn't exist
$table_create_query = "CREATE TABLE IF NOT EXISTS feedback(
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL
)";

if ($conn->query($table_create_query) === TRUE) {
    echo "Table feedback created successfully <br>"; // Message if table creation succeeds
} else {
    echo "Error creating table: " . $conn->error; // Message if table creation fails
}

// Handle form submission using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['customer_name'];
        $email = $_POST['customer_email'];
        $message = $_POST['message'];
    
        // SQL query to insert the data
        $insertSql = "INSERT INTO feedback (customer_name, customer_email, message)
                      VALUES ('$name', '$email', '$message')";
    
        if ($conn->query($insertSql) === TRUE) {
            echo "New record created successfully.";
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
    
    // Close the database connection
    $conn->close();
}
?>
