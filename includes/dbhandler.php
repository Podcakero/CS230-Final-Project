<!-- Allows connection to the database -->

<?php
$conn = null;

$servername = 'localhost';
$username = 'cs230';
$password = 'hYy!2YG.*ksoaK3[';
$dbName = 'main';

try {
    $conn = new PDO('mysql:host=' . $servername . ';dbname=' . $dbName . '', $username, $password);
    return $conn;
} catch (PDOException $e) {

    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>