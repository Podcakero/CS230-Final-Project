<?php
require 'includes/header.php';
?>

<main>
    <link rel="stylesheet" href="css/search.css">
    <div class="bg">

      <?php
      if(isset($_SESSION['uid'])) {
        // Get item from search
        $search = $_GET['search'];

        // Query Database
        $sql = $conn->query("SELECT * FROM profiles WHERE fname LIKE ('%" .$search. "%')");
        $sql1 = $conn->query("SELECT * FROM users WHERE lname LIKE ('%" .$search. "%')");
        $sql2 = $conn->query("SELECT * FROM profiles WHERE uname LIKE ('%" .$search. "%')");

        // See if any results are found
        $found = $sql->rowCount();
        $found1 = $sql1->rowCount();
        $found2 = $sql2->rowCount();


        // If no results found
        if($found == 0 && $found1 == 0 && $found2 == 0){
            echo "<h1> Sorry! We were unable to find the someone with the name of of '<b>$search</b>'.</h1>";
            echo '<form action="otherprofile.php?id='.$id.'">
                  <button class="btn btn-dark" name="To Home" type="submit">Go to Profile</button>
                  </form>';
            }
            // If there are results found
            else{

                echo "<h1>Results found for \"" .$search. "\" :</h1>";

                // If there are results matching title
                    if($found > 0){
                        while($row = $sql->fetch(PDO::FETCH_BOTH)){
                            $myid = $_SESSION['uid'];
                            $idp = $row["uid"];
                            $fname = $row["fname"];
                            $profpic = $row["profpic"];
                            $uname = $row["uname"];
                            $_SESSION['profile-to-follow'] = $idp;

                                echo    '<div class="column">
                                            <div class="gallery-container">
                                                <div class="card">
                                                    <a href="searchprofile.php?id='.$idp.'">
                                                    <img src="'.$profpic.'" alt="Profile Image"">
                                                    <h4>'.$fname.'</h4>
                                                    <p1>Username: </p1>
                                                    <h5>'.$uname.'</h5>
                                                    <p class="btn btn-primary center-me">Go to Profile</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>';
                            }
                        }

                    // If there are results matching tags
                    if($found1 > 0){
                        while($row = $sql1->fetch(PDO::FETCH_BOTH)){
                            $rows = $sql1->fetch();
                            $idp = $rows['uid'];
                            $sqlu = $conn->query("SELECT * FROM profiles WHERE uid LIKE ('%" .$idp. "%')");
                            while($row = $sqlu->fetch(PDO::FETCH_BOTH)){
                                $myid = $_SESSION['uid'];
                                $idp = $row["uid"];
                                $fname = $row["fname"];
                                $profpic = $row["profpic"];
                                $uname = $row["uname"];
                                $_SESSION['profile-to-follow'] = $idp;

                                    echo    '<div class="column">
                                                <div class="gallery-container">
                                                    <div class="card">
                                                        <a href="searchprofile.php?id='.$idp.'">
                                                        <img src="profiles/'.$profpic.'" alt="Profile Image"">
                                                        <h4>'.$fname.'</h4>
                                                        <p1>Username: </p1>
                                                        <h5>'.$uname.'</h5>
                                                        <p class="btn btn-primary center-me">Go to Profile</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>';
                                }
                            }
                        }
                    }

                    // If there are results matching description
                    if($found2 > 0){
                        while($row = $sql2->fetch(PDO::FETCH_BOTH)){
                            $myid = $_SESSION['uid'];
                            $idp = $row["uid"];
                            $fname = $row["fname"];
                            $profpic = $row["profpic"];
                            $uname = $row["uname"];
                            $_SESSION['profile-to-follow'] = $idp;

                            echo '<div class="column">
                                            <div class="gallery-container">
                                                <div class="card">
                                                    <a href="searchprofile.php?id='.$idp.'">
                                                    <img src="profiles/'.$profpic.'" alt="Profile Image"">
                                                    <h4>'.$fname.'</h4>
                                                    <p1>Username: </p1>
                                                    <h5>'.$uname.'</h5>
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
