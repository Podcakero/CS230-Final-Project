<!-- Inserts the signin credentials into the database -->

<?php

if (isset($_POST['signup-submit'])) {
	require 'dbhandler.php';

	$username = $_POST['uname'];
	$email = $_POST['email'];
	$password = $_POST['pwd'];
	$confirm_password = $_POST['con_pwd'];
	$first_name = $_POST['fname'];
	$last_name = $_POST['lname'];

	if ($password !== $confirm_password) {
		header("Location: ../signup.php?error=diffPasswords");
		exit();
	} else {
		$stmt = null;
		$stmt = $conn->prepare("SELECT uname FROM users WHERE uname=?");

		if ($stmt->execute(array($username))) {
			$count = $stmt->rowCount();

			if ($count > 0) {
				header('Location: ../signup.php?usernameTaken');
				exit();
			} else {
				$stmt = null;

				$stmt = $conn->prepare("INSERT INTO users (fname, lname, uname, password, email) VALUES (?, ?, ?, ?, ?)");
				$hashed = password_hash($password, PASSWORD_BCRYPT);

				if ($stmt->execute(array($first_name, $last_name, $username, $hashed, $email))) {
					$conn->query("INSERT INTO profiles (fname, uname) VALUES ('$first_name', '$username')");
					header('Location: ../login.php?signup=success');
					exit();
				} else {
					header("Location: ../signup.php?error=SQLInjection");
					exit();
				}
			}
		} else {
			header("Location: ../signup.php?error=SQLInjection");
			exit();
		}
	}
} else {
	header("Location: ../signup.php");
	exit();
}
