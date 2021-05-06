<!-- Sql statements -->

<?php
include "header.php";

if (isset($_POST['sql-submit'])) {
    include "dbhandler.php";

    $sql = $_POST['sql'];

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $data = array();

    if ($stmt) {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($data, $result);
        }
    }

    echo json_encode($data);
}
?>