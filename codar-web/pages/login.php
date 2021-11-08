<?php
  // session_start();

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard.php");
    exit;
  }

  require_once "conn.php";

  if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Check if username is empty
      if(empty(trim($_POST["username"]))){
          $username_err = "Please enter username.";
      } else{
          $username = trim($_POST["username"]);
      }

      // Check if password is empty
      if(empty(trim($_POST["password"]))){
          $password_err = "Please enter your password.";
      } else{
          $password = trim($_POST["password"]);
      }

      echo "HHH", $username, $password;

      // Validate credentials
      if(empty($username_err) && empty($password_err)){

    		// Select Query for counting the row that has the same value of the given username and password. This query is for checking if the access is valid or not.
        $stmt = $mysqli->prepare("SELECT * as count FROM `users` WHERE `username` = :username AND `password` = :password");

    		$stmt = $conn->prepare($query);

    		$stmt->bind_param(':username', $username);
    		$stmt->bind_param(':password', $password);

    		$stmt->execute();

    		$row = $stmt->fetch();
      }

  		$count = $row['count'];

  		if ($count > 0) {
        echo "valid";
  			header('Location: dashboard.php');
  		} else {
  			$_SESSION['error'] = "Invalid username or password";
        echo "invalid";
  			header('Location: sign-in.php');
  		}

  	}

 ?>
