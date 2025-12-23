<?php
$conn = new mysqli("localhost", "root", "", "security_db");

if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_POST['search'])) {
    $username = $_POST['username'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "User Found: " . $row['username'] . "<br>";
        }
    } else {
        echo "No user found";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>Search User</title>
</head>
<body>

<form method="POST">
    <label>Enter Username:</label><br><br>
    <input type="text" name="username" required>
    <br><br>
    <button type="submit" name="search">Search</button>
</form>

</body>
</html>
