<!-- Search Profile Page: Displays profile pic, bio, and recent reviews -->
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
        <!-- Left Side Elements -->
        <div class="row">
            <div class="column" style="max-height:800px;">
                <div class="h-50 center-me text-center">
                    <div class="my-auto">
                        <form action="includes/upload-helper.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">

                                <img src="<?php echo $photo; ?>" alt="profile pic" id="prof-display">

                                <label for="prof-image" id="uname-style">
                                    <?php echo $prof_user; ?>
                                </label>

                                <input type="file" name="prof-image" id="prof-image" onchange="preview(this)" class="form-control" style="display: none;">
                            </div>

                            <div class="form-group">
                                <h5><?php echo $bio ?></h5>
                            </div>

                        </form>
                        <form action="includes/follow-helper.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="profile-to-follow" value="<?php echo $user_id ?>">
                                <input type="hidden" name="user-profile" value="<?php echo $_SESSION['uid'] ?>">
                                <?php
                                if ($isFollowing == false)
                                {
                                ?>
                                <button type="submit" name="follow" class="btn btn-success btn-lg btn-block center" style="width:50%;">
                                    Follow
                                </button>
                                <?php }
                                else { ?>
                                <button type="submit" name="unfollow" class="btn btn-success btn-lg btn-block center" style="width:50%;">
                                    Unfollow
                                </button>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side Elements -->
            <div class="column" style="margin-top:50px;">
            <?php
            echo
            '<div class="center-me"><h2>Latest Review</h2></div>';

            //Get reviews
            $un = $conn->query("SELECT * FROM profiles WHERE uid='$user_id';");
            $rows = $un->fetch();
            $other_user = $rows['uname'];

            $res = $conn->query("SELECT * FROM reviews WHERE uname='$other_user' ORDER BY revid DESC;");
            $found = $res->rowCount();

            // See if any results are found
            if ($found == 0) {
                echo '<div class="center-me"><p> No recent reviews.</p></div>';
            } else {
                $row = $res->fetch();

                //Get game id, title, game pic
                $gameId = $row['itemid'];

                $getTitle = $conn->query("SELECT * FROM gallery WHERE pid=$gameId;");
                $title = $getTitle->fetch();

                $gameTitle = $title['title'];
                $gamePic = $title['picpath'];

                //Display latest review
                echo '<div class="card center" style="background-color: mistyrose; width:90%; padding:5px; margin-top:5px;">
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


            //View my reviews button
            echo'
            <a href="otherreviews.php?id='.$user_id.'" class="btn btn-danger btn-lg active center" style="margin-top:5px;width:25%;" role="button" aria-pressed="true">
                View Reviews
            </a>';
            ?>
            </div>
        </div>
</main>
