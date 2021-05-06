<!-- Upload profile picture and bio into the database -->

<?php
require 'dbhandler.php';
session_start();

define('KB', 1024);
define('MB', 1048576);

if (isset($_POST['prof-submit'])) {
    $uname = $_SESSION['uname'];
    $file = $_FILES['prof-image'];
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];
    $bioText = $_POST['bio'];

    //Update bio
    $conn->query("UPDATE profiles SET bio = '$bioText' WHERE uname = '$uname'");

    //Update Prof Pic
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed = array('jpg', 'jpeg', 'png', 'svg', 'gif');

    if ($file_error !== 0) {
        header("Location: ../profile.php?error=uploadError");
        exit();
    }

    if (!in_array($ext, $allowed)) {
        header("Location: ../profile.php?error=invalidType");
        exit();
    }

    if ($file_size > 4 * MB) {
        header("Location: ../profile.php?error=fileSizeExceeded");
        exit();
    } else {
        $new_name = uniqid('', true) . "." . $ext;
        $destination = 'profiles/' . $new_name;

        $conn->query("UPDATE profiles SET profpic = '$destination' WHERE uname = '$uname'");
        move_uploaded_file($file_tmp_name, '../' . ($destination));
        header("Location: ../profile.php?success=uploadSuccessful");
        exit();
    }
} else {
    header("Location: ../profile.php");
    exit();
}
?>