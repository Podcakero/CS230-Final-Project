<!-- Allows connection to the database -->

<?php
$conn = null;

$servername = '54.158.119.193';
$username = 'dbmasteruser';
$password = 's)LWM1F;e$7z|+#7w?ExQ!|12,,5COVZ';
$dbName = 'main';

try {
    $conn = new PDO('mysql:host=' . $servername . ';dbname=' . $dbName . '', $username, $password);
    return $conn;
} catch (PDOException $e) {

    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>