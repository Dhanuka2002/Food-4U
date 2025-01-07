<?php
// Database connection details
$servername = "localhost";
$username = "root"; 
$password = "";   

// Connect to the database
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$db_create_query = "CREATE DATABASE IF NOT EXISTS food_4u";
if ($conn->query($db_create_query) === TRUE) {
    echo "Database created successfully <br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the database
$conn->select_db("food_4u");

// Create the registration table if it doesn't exist
$table_create_query = "CREATE TABLE IF NOT EXISTS registration (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    adress VACHAR(30)NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($table_create_query) === TRUE) {
    echo "Table registration created successfully <br>";
} else {
    echo "Error creating table: " . $conn->error; 
}

// Check the request method to handle registration or login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        // Registration logic
        $name = $conn->real_escape_string($_POST['name']);
        $adress = $conn->real_escape_string($_POST['adress']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm-password'];

        // Check if passwords match
        if ($password !== $confirm_password) {
            echo "Passwords do not match!";
            exit;
        }

        // Insert user data into the database  
        $insert_query = "INSERT INTO registration (name,adress, email, password) VALUES ('$name',$adress','$email' , '$password')";

        if ($conn->query($insert_query) === TRUE) {
            echo "Registration successful!";
            header("Location: signin.html");
            exit;
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'login') {
        // Login logic
        $email = $conn->real_escape_string($_POST['email']);
        $password = $_POST['password'];

        // Fetch user data from the database
        $select_query = "SELECT * FROM registration WHERE email = '$email'";
        $result = $conn->query($select_query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            // Verify the password
            if ($password==$user['password']) {
                echo "Login successful!";
                header("Location: menu.html"); // Redirect to a dashboard or home page
                exit;
            }
            else {
                echo "Invalid password!";
            }
        } else {
            echo "No user found with this email!";
        }
    } else {
        echo "Invalid action!";
    }
    
}

$conn->close();
?>