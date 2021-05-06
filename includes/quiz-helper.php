<!-- Adds questions into the AddQuestion database for the quiz -->
<?php
if (isset($_POST['ques-submit'])) {

	require 'dbhandler.php';
	//All database entries
	$ques = $_POST['question'];
	$ans1 = $_POST['a1'];
	$tag1 = $_POST['t1'];
	$ans2 = $_POST['a2'];
	$tag2 = $_POST['t2'];
	$ans3 = $_POST['a3'];
	$tag3 = $_POST['t3'];
	$ans4 = $_POST['a4'];
	$tag4 = $_POST['t4'];

	$stmt = null;
	// adds qustion into database		
	$conn->query("INSERT INTO  AddQuestion (Qtitle, A1, T1, A2, T2, A3, T3, A4, T4) VALUES ('$ques', '$ans1', '$tag1', '$ans2', '$tag2', '$ans3', '$tag3', '$ans4', '$tag4');
	INSERT INTO Questions (question) VALUES ('$ques');");


	header("Location: ../Addq.php?AddQuestion=success");
	exit();
} else {
	header("Location: ../quiz.php?AddQFailure");
	exit();
}
