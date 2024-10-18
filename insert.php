<!DOCTYPE html>
<html>

<head>
	<title></title>
</head>

<body>
<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "products";

    // Create a connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Die if connection was not successful
    if (!$conn){
        die("Sorry we failed to connect: ". mysqli_connect_error());
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Taking all 5 values from the form data(input)
		$username = $_POST['username'];
		$password = $_POST['password'];
		echo $password;
		
		$sql = "INSERT INTO `userlogin` (`username`, `password`)VALUES ('$username', '$password')";
        $result = mysqli_query($conn, $sql);
        if($result){ 
            $insert = true;
        }
        else{
            echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
        } 
        header("Location: dashboard.html");

		
		// Close connection
		mysqli_close($conn);
    }
		
		
	?>

<script>
        function myFunction() {
            window.location.href = 'dashboard.html';
        }
        </script>
		

</body>

</html>
