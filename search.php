<!-- Search: earch for games -->

<?php
// Include header and database
require 'includes/header.php';
require 'includes/dbhandler.php';
?>

<main>
    <link rel="stylesheet" href="css/search.css">
    <div class="bg">

        <?php
        // Get item entered into the search bar
        $search = $_GET['search'];

        // Function to get the game elements and echo them if logged in.
        function sessg($row)
        {
            $review = $row["pid"];
            $picpath = $row["picpath"];
            $title = $row["title"];
            $descript = $row["descript"];
            $tags = $row["Tags"];

            echo    '<div class="column">
                        <div class="gallery-container">
                            <div class="card">
                                <a href="review.php?id=' . $review . '">
                                <img src="gallery/' . $picpath . '" alt="Card image cap"">
                                <h4>' . $title . '</h4>
                                <p1>Description: </p1>
                                <h5>' . $descript . '</h5>
                                <p1>Tags: </p1>
                                <h5>' . $tags . '</h5>
                                <p class="btn btn-dark center-me">Review</p>
                                </a>
                            </div>
                        </div>
                    </div>';
        }

        // Function to get the game elements and echo them if not logged in.
        function sessb($row)
        {
            $picpath = $row["picpath"];
            $title = $row["title"];
            $descript = $row["descript"];
            $tags = $row["Tags"];
            echo    '<div class="column">
                        <div class="gallery-container">
                            <div class="card">
                                <a href="login.php">
                                <img src="gallery/' . $picpath . '" alt="Card image cap"">
                                <h4>' . $title . '</h4>
                                <p1>Description: </p1>
                                <h5>' . $descript . '</h5>
                                <p1>Tags: </p1>
                                <h5>' . $tags . '</h5>
                                <p class="btn btn-dark center-me">Login to Review</p>
                                </a>
                            </div>
                        </div>
                   </div>';
        }


        // Query Database
        $sql = $conn->query("SELECT * FROM gallery WHERE title LIKE ('%" . $search . "%')");
        $sql1 = $conn->query("SELECT * FROM gallery WHERE Tags LIKE ('%" . $search . "%')");
        $sql2 = $conn->query("SELECT * FROM gallery WHERE descript LIKE ('%" . $search . "%')");

        // See if any results are found
        $found = $sql->rowCount();
        $found1 = $sql1->rowCount();
        $found2 = $sql2->rowCount();



        // If no results found
        if ($found == 0 && $found1 == 0 && $found2 == 0) {
            echo "<h1> Sorry! We were unable to find the product with a search term of '<b>$search</b>'.</h1>";
            echo '<form action="Gallery.php">
                    <button class="btn btn-dark" name="To Home" type="submit">Go to Games</button>
                  </form>';
        }
        // If there are results found
        else {

            echo "<h1>Results found for \"" . $search . "\" :</h1>";

            // If logged in
            if (isset($_SESSION["uid"])) {
                // If there are results matching title
                if ($found > 0) {
                    while ($row = $sql->fetch(PDO::FETCH_BOTH)) {
                        sessg($row);
                    }
                }

                // If there are results matching tags
                if ($found1 > 0) {
                    while ($row = $sql1->fetch(PDO::FETCH_BOTH)) {
                        sessg($row);
                    }
                }

                // If there are results matching description
                if ($found2 > 0) {
                    while ($row = $sql2->fetch(PDO::FETCH_BOTH)) {
                        sessg($row);
                    }
                }
            }

            // If not loggged in
            else {
                if ($found > 0) {
                    while ($row = $sql->fetch(PDO::FETCH_BOTH)) {
                        sessb($row);
                    }
                }

                // If there are results matching tags
                if ($found1 > 0) {
                    while ($row = $sql1->fetch(PDO::FETCH_BOTH)) {
                        sessb($row);
                    }
                }

                // If there are results matching description
                if ($found2 > 0) {
                    while ($row = $sql2->fetch(PDO::FETCH_BOTH)) {
                        sessb($row);
                    }
                }
            }
        }
        ?>
    </div>
</main>