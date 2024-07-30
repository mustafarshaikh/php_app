<!DOCTYPE html>
<html>
<head>
    <title>PHP MySQL Sample Application</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>PHP MySQL Sample Application</h1>
    <p>This is a simple PHP application that connects to a MySQL database.</p>

    <?php
    $servername = "mysql";
    $username = "my_user";
    $password = "my_password";
    $dbname = "my_database";
    // echo "<p>Connected successfully</p>";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "<p>Connected successfully</p>";

    // Select data from database
    $sql = "SELECT id, name, email FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th><th>Email</th></tr>";
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No results found</p>";
    }

    $conn->close();
    ?>

</body>
</html>
