<!-- Other Reviwes: Gets and displays searhced users reviews -->

<?php
require 'includes/header.php';
require 'includes/dbhandler.php'
?>

<main style="font-family: Georgia, serif;">
    <link rel="stylesheet" href="css/profile.css">

    <?php
    if (isset($_GET['id'])) {
        $uid = $_GET['id'];
        $sql = $conn->query("SELECT * FROM profiles WHERE uid='$uid';");
        if ($sql->rowCount() > 0)
        {
            $row = $sql->fetch();
            $photo = $row['profpic'];
            $bio = $row['bio'];
            $prof_user = $row['uname'];
            $user_id = $row['uid'];
        }
    }
    else if (isset($_GET['name']))
    {
        $prof_user = $_GET['name'];
        $sql = $conn->query("SELECT * FROM profiles WHERE uname='$prof_user';");
        if ($sql->rowCount() > 0)
        {
            $row = $sql->fetch();
            $photo = $row['profpic']; // Path to profile pic
            $bio = $row['bio']; // Bio
            $user_id = $row['uid'];
        }
    }
    else if (isset($_SESSION['uid']))
    {
        //Get usrename, profile pic, and bio
        $prof_user = $_SESSION['uname'];
        $res = $conn->query("SELECT * FROM profiles WHERE uname='$prof_user';");
        $row = $res->fetch();
        $photo = $row['profpic']; // Path to profile pic
        $bio = $row['bio']; // Bio
        $user_id = $row['uid'];
    }

    if (isset($_SESSION['uid']))
    {
        $uid = $_SESSION['uid'];
        $sql = $conn->query("SELECT * FROM profiles WHERE uid=$uid;");
        $row = $sql->fetch();

        $temp = $row['following'];
        $following = explode(",", $temp);

        $isFollowing = false;

        foreach ($following as $user)
            if ($user == $user_id)
                $isFollowing = true;
    }

    if (isset($prof_user))
    {
    ?>

            <div style="margin-top:50px; ">
                <?php

                //Get reviews
                $un = $conn->query("SELECT * FROM profiles WHERE uid='$user_id';");
                $rows = $un->fetch();
                $other_user = $rows['uname'];
                $res = $conn->query("SELECT * FROM reviews WHERE uname='$other_user' ORDER BY revid DESC;");

                echo
                '
                    <div class="center-me"><h2>Reviews</h2></div>';

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

                                            <div class="center-me "><h3><b>'.$gameTitle.'</h3></b></div>
                                            <img src="'.$gamePic.'" alt="" class="center2" style="height:70%;">

                                        </div>

                                        <div class="column" style="float:left;width:50%;height:100%;">

                                            <div style="text-align:center;"><h3><b>'.$row['title'].'</h3></b></div>

                                            <div style="background-color: pink; height:200px;border: black;  border-style: solid; padding:5px;"><p>'.$row['reviewtext'].'</p></div>
                                            <div class="center-me"><i>'.$row['ratingnum'].' stars</i></div>

                                        </div>
                                    </div>
                                </div>

                        ';

                        }
                        ?>
                </div>
                <?php
                }
                ?>
