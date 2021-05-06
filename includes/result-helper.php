<?php
if (isset($_POST['quiz-submit'])){
  require 'dbhandler.php';
  $question_number = $_POST['number'];

  $sql="SELECT * FROM AddQuestion WHERE id='$question_number' LIMIT 1";
  $result=$conn->query($sql);
}
