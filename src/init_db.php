<?php
    $servername = "mysql";
    $username = "root";
    $password = "root_password";
    $dbname = "my_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50)
)";

if ($conn->query($sql) === true) {
    echo "Table users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Insert sample data
$sql = "INSERT INTO users (name, email) VALUES ('Mustafa', 'mustafarshaikh@gmail.com'), ('Raza', 'rshaikhm@gmail.com')";

if ($conn->query($sql) === true) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>