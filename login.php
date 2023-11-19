<?php
// Database connection parameters
$host = 'Local instance MySQL80';
$username = 'root';
$password = 'birthday82004';
$database = 'user_accounts';

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Example: Check user credentials during login
    $hashedPassword = hash('sha256', $password); // Replace with your actual hashing algorithm

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User credentials are correct
        // Redirect to a welcome page or perform other actions
        header("Location: welcome.html");
        exit();
    } else {
        // User credentials are incorrect
        $loginError = "Invalid username or password";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    
    <!-- Display login error if any -->
    <?php if(isset($loginError)) { echo "<p style='color:red;'>$loginError</p>"; } ?>

    <!-- Login Form -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Log In</button>
    </form>
</body>
</html>
