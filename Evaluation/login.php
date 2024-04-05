<?php
include_once 'database.php';
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: index.php");
	exit;
}
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate credentials
	if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
		$sql = "SELECT ID, Name, Position,Password,Email FROM tbl_staffs_a184539_pt2 WHERE (ID = :username OR Email = :username) LIMIT 1";

		if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
			$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
			$param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
			if($stmt->execute()){
                // Check if username exists, if yes then verify password
				if($stmt->rowCount() == 1){
					if($row = $stmt->fetch()){
						$username = $row["Name"];
						$hashed_password = $row["Password"];

						$input_password = sha1($_POST["password"]);

						if ($hashed_password == $input_password) {
                            // Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["username"] = $username; 
							$_SESSION["userposition"] = $row["Position"];
							//echo "<script>alert('okay!')</script>";


                            // Redirect user to welcome page
							header("location: index.php");
						} else{
                            // Password is not valid, display a generic error message
							echo "<script>alert('Invalid username or password!')</script>";
						}
					}
				} else{
                    // Username doesn't exist, display a generic error message
					echo "<script>alert('Invalid username or password!')</script>";
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}

            // Close statement
			unset($stmt);
		}
	}
    // Close connection
	unset($pdo);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login page</title>
   	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style type="text/css">
		body{
			font-family: Roboto;
			background-color: #e76f51;
			display: flex;
			align-items:center;
			justify-content: center;
		}
		.login{
			background-color: #0b132b;
			border-radius: 22px;
			width: 400px;
			color: #f8f9fa;
			padding:40px;
			box-shadow:10px 10px 25px  #000000;
		}
		.login input{
			display: block;
			margin:20px auto;
			text-align: :center;
			background: none;
			padding: 12px;
			font-size:15px;
			border-radius: 22px;
			outline:none;
			color:#f8f9fa;
		}
		.login input[type="text"], .login input[type="password"]{
			border:2px solid #3498db;
			width: 220px;
		}
		.login input[type="submit"]{
			width:150px;
			border:2px solid #2ecc71;
			cursor:pointer;
		}
		.login input[type="text"]:focus, .login input[type="password"]:focus{
			border-color: #2ecc71;
			width: 280px;
			transition:0.5s;	
		}
		.login input[type="submit"]:hover{
			background-color:#2eec71;
			transition: :0.5s;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-sm-offset-4 col-md-12 col-md-offset-0">
          <div class="page-header">
             <center><h1>WELCOME TO THE BOOK ORDERING SYSTEM</h1></center>
          </div>
      	</div>
    </div>
    <br>
	<div class="container-fluid">
		<div class="row">
        	<div class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-8 col-md-offset-3">
			<form class="login" action="login.php" method="post">
				<center><h2> LOG IN </h2></center>
				<br>
				<input type="text" name="username" id="username" placeholder="username" required>
				<input type="password" name="password" placeholder="password" required>
				<input type="submit" value="login" href="customers.php?edit=<?php echo $readrow['ID']; ?>" >
			</form>
			</div>
		</div>
	</div>

	<script>
		var usernames = document.getElementById('username');
		var password = document.getElementById('password');
		names.value = '';
	</script>
</body>