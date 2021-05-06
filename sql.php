<!-- SQL: Allows admin to enter a sql statement -->
<?php
include "includes/header.php";
include "includes/dbhandler.php";

if ($_sqlAdmin != true) {
    die();
}

?>

<main>
    <div class="container">
        <form action="includes/sql-helper.php" method="post">
            <label for="sql">
                Enter SQL Statement
            </label>
            <input type="text" name="sql" id="sql">

            <button type="submit" class="btn btn-lg btn-outline-dark btn-block medium-font" name="sql-submit">
                Submit SQL statement
            </button>
        </form>
    </div>
</main>