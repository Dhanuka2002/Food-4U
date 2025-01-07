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
$table_create_query = "CREATE TABLE IF NOT EXISTS reg_resturant(
    id INT AUTO_INCREMENT PRIMARY KEY,
    restaurant_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    mobile_number VARCHAR(15) NOT NULL,
    opening_hours_from TIME NOT NULL,
    opening_hours_to TIME NOT NULL,
    business_registration_details VARCHAR(255) NOT NULL,
    food_items TEXT NOT NULL
)";

if ($conn->query($table_create_query) === TRUE) {
    echo "Table order created successfully <br>"; // Message if table creation succeeds
} else {
    echo "Error creating table: " . $conn->error; // Message if table creation fails
}

// Handle form submission using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $restaurant_name = $_POST['resurant_name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];
        $opening_hours_from = $_POST['opening_hours_from'];
        $opening_hours_to = $_POST['opening_hours_to'];
        $business_registration_details = $_FILES['business_registration']['name']; // File name
        $food_items = isset($_POST['food_items']) ? implode(', ', $_POST['food_items']) : '';
    
        // Handle file upload
        $upload_dir = "uploads/resturants/";
        $upload_file = $upload_dir . basename($_FILES['business_registration']['name']);
    
        if (move_uploaded_file($_FILES['business_registration']['tmp_name'], $upload_file)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error uploading file.";
        }
    
        // SQL query to insert the data
        $insertSql = "INSERT INTO reg_resturant (restaurant_name, email, address, mobile_number, opening_hours_from, opening_hours_to, business_registration_details, food_items)
                      VALUES ('$restaurant_name', '$email', '$address', '$mobile', '$opening_hours_from', '$opening_hours_to', '$business_registration_details', '$food_items')";
    
        if ($conn->query($insertSql) === TRUE) {
            echo "New record created successfully.";
            echo "<a href='main.html'> Click here to go to main  page</a>";
        } else {
            echo "Error: " . $insertSql . "<br>" . $conn->error;
        }
    }
    
    // Close the database connection
    $conn->close();
}
?>
