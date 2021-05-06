<?php
require 'includes/header.php';
?>

<main>
    <link rel="stylesheet" href="css/search.css">
    <div class="bg">

        <?php
        if (isset($_SESSION['uid'])) {
            $ids = $_SESSION['uid'];

            // Query Database
            $sql = $conn->query("SELECT * FROM profiles WHERE uid=$ids");
            $found = $sql->fetch();
            $following = $found['following'];
            if ($following == 0) {
                echo "<h1> Sorry! You are not following anyone</h1>";
                echo '<form action="profile.php">
                  <button class="btn btn-dark" name="To Home" type="submit">Go to Profile</button>
                  </form>';
            } else {
                $following_array = explode(',', $following);
                foreach ($following_array as $value) {
                    $sql1 = $conn->query("SELECT * FROM profiles WHERE uid=$value");
                    $found1 = $sql1->fetch();
                    $fname = $found1["fname"];
                    $uname = $found1["uname"];
                    echo '<div class="column">
                    <div class="gallery-container">
                        <div class="card">
                            <a href="searchprofile.php?id=' . $value . '">
                            <p1>Name: </p1>
                            <h4>' . $fname . '</h4>
                            <p1>Username: </p1>
                            <h5>' . $uname . '</h5>
                            <p class="btn btn-primary center-me">Go to Profile</p>
                            </a>
                        </div>
                    </div>
                </div>';
                }
            }
        }


        ?>
    </div>
</main>