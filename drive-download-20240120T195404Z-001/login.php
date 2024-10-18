
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Page</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Login</h1>
            <input type="text" id="username" placeholder="Username">
            <input type="password" id="password" placeholder="Password">
            <button id="loginButton">Submit</button>
        </div>
        <p>Not yet Registered?</p>
    </div>

    <?php
// Establish database connection (replace 'your_host', 'your_username', 'your_password', 'your_database' with your actual database details)

$servername = "localhost";
$username = "root";
$password = "";
$database = "products";

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to check if the user is already registered
function isUserRegistered($conn, $username) {
    $username = mysqli_real_escape_string($conn, $username);

    $query = "SELECT * FROM userlogin WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    return mysqli_num_rows($result) > 0;
}

// Function to add a new user
function registerUser($conn, $username, $password) {
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // You should hash the password in a real-world scenario
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO userlogin (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($conn, $query);

    return $result;
}

// Handle registration and login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the user is already registered
    if (isUserRegistered($conn, $username)) {
        // User is registered, perform login
        // You should verify the password using password_verify in a real-world scenario
        $query = "SELECT * FROM userlogin WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "Login successful!";
            // You can redirect the user to another page after successful login
        } else {
            echo "Invalid password";
        }
    } else {
        // User is not registered, perform registration
        if (registerUser($conn, $username, $password)) {
            echo "Registration successful! You are now logged in.";
            // You can redirect the user to another page after successful registration
        } else {
            echo "Registration failed";
        }
    }
}

// Close database connection
mysqli_close($conn);
?>

</body>

</html>
