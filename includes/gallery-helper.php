<!-- Assists in adding thing to the gallery database -->

<?php

require 'dbhandler.php';
session_start();

define('KB', 1024);
define('MB', 1048576);

if (isset($_POST['gallery-submit'])) {
    require 'dbhandler.php';


    $file = $_FILES['gallery-image'];
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    $title = $_POST['title'];
    $descript = $_POST['descript'];
    $Tags = $_POST['Tags'];
    $category = $_POST['category'];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed = array('jpg', 'jpeg', 'png', 'svg', 'svg');

    // If the file has an upload error
    if ($file_error !== 0) {
        header("Location: ../admin.php?error=UploadError");
        exit();
    }
    // If the file is not the current type
    if (!in_array($ext, $allowed)) {
        header("Location: ../admin.php?error=InvalidType");
        exit();
    }
    // If the file size is too large
    if ($file_size > 4 * MB) {
        header("Location: ../admin.php?error=FileSizeExceeded");
    } else {
        $new_name = uniqid('', true) . "." . $ext;

        $destination = '../gallery/' . $new_name;

        // Insert into gallery database
        $sql = "INSERT INTO gallery (title, descript, picpath, Tags, category) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);


        $stmt->execute([$title, $descript, $destination, $Tags, $category]);

        $stmt = null;
        $conn = null;

        move_uploaded_file($file_tmp_name, $destination);
        header("Location: ../admin.php?success=GalleryUpload");
        exit();
    }
} else {
    header("Location: ../admin.php");
    exit();
}
