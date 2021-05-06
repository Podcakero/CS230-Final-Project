<!-- My Reviwes: Gets and displays current users reviews -->

<?php
require 'includes/header.php';
require 'includes/dbhandler.php'
?>

<main style="font-family: Georgia, serif;">
    <link rel="stylesheet" href="css/profile.css">

    <?php
    if (isset($_SESSION['uid'])) {
        //Get usrename, profile pic, and bio
        $prof_user = $_SESSION['uname'];
        $res = $conn->query("SELECT * FROM profiles WHERE uname='$prof_user';");
        $row = $res->fetch();
        $photo = $row['profpic']; // Path to profile pic
        $bio = $row['bio']; // Bio

    ?>

        <div style="margin-top:50px; ">
        <?php

        //Get reviews
        $res = $conn->query("SELECT * FROM reviews WHERE uname='$prof_user' ORDER BY revid DESC;");

        echo
        '
                <div class="center-me"><h2>My Reviews</h2></div>';

        //Loop through reviews
        while ($row = $res->fetch()) {

            //Get game id, title, game pic
            $gameId = $row['itemid'];

            $getTitle = $conn->query("SELECT * FROM gallery WHERE pid=$gameId;");
            $title = $getTitle->fetch();

            $gameTitle = $title['title'];
            $gamePic = $title['picpath'];

            echo '
                            <div class="card center" style="background-color: mistyrose; width:50%; padding:5px; margin-top:5px;">
                                <div class="" style="padding:5px;">
                                    <div class="column" style="float:left;">
                                    
                                        <div class="center-me "><h3><b>' . $gameTitle . '</h3></b></div>
                                        <img src="' . $gamePic . '" alt="" class="center2" style="height:70%;"> 
                            
                                    </div> 

                                    <div class="column" style="float:left;width:50%;height:100%;">
                                        
                                        <div style="text-align:center;"><h3><b>' . $row['title'] . '</h3></b></div>
                                        
                                        <div style="background-color: pink; height:200px;border: black;  border-style: solid; padding:5px;"><p>' . $row['reviewtext'] . '</p></div>
                                        <div class="center-me"><i>' . $row['ratingnum'] . ' stars</i></div>

                                    </div>
                                </div> 
                            </div>
   
                    ';
        }
    }

        ?>
        </div>
        </div>
</main>