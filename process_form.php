<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "PHW#84#jeor";
$database = "user_registration";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user inputs
function sanitizeInput($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = sanitizeInput($_POST["name"]);
    $dob = sanitizeInput($_POST["dob"]);
    $hobbies = implode(', ', $_POST["hobbies"]); // Combine selected hobbies into a comma-separated string
    $gender = sanitizeInput($_POST["gender"]);
    $dropdown_option = sanitizeInput($_POST["dropdown"]);
    $state = sanitizeInput($_POST["state"]);
    $address = sanitizeInput($_POST["address"]);

    // Validate that at least two hobbies are selected
    if (count($_POST["hobbies"]) < 2) {
        die("Please select at least two hobbies.");
    }

    // File upload handling
    $resumeFileName = $_FILES["resume"]["name"];
    $resumeFilePath = "uploads/" . $resumeFileName; // Assuming "uploads" folder exists
    move_uploaded_file($_FILES["resume"]["tmp_name"], $resumeFilePath);

    // Insert data into the database
    $sql = "INSERT INTO registrations (name, dob, hobbies, gender, dropdown_option, state, address, resume_file) 
            VALUES ('$name', '$dob', '$hobbies', '$gender', '$dropdown_option', '$state', '$address', '$resumeFilePath')";

    if ($conn->query($sql) === true) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
