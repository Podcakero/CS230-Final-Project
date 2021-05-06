<!-- Display reviews:  Displays all reviews for a certain game -->

<?php
//server info
$servername = '54.158.119.193';
$username = 'dbmasteruser';
$password = 's)LWM1F;e$7z|+#7w?ExQ!|12,,5COVZ';
$dbName = 'main';

$conn = mysqli_connect($servername, $username, $password, $dbName);

//Checks for connections
if (!$conn) {

    die("Connection failed..." . mysqli_connect_error());
}

//gets id for specific gamesd
$item = $_GET['id'];
$sql = "SELECT * FROM reviews WHERE itemid='$item' ORDER BY revdate DESC";

$result = mysqli_query($conn, $sql);
$i = 0;

//While there are games it will fetch the info for the specific game.
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $i = $i + 1;
        if ($i == 5) {
            break;
        }
        $uname = $row['uname'];

        $propic = "SELECT profpic FROM profiles WHERE uname='$uname';";

        $res = mysqli_query($conn, $propic);

        $picpath = mysqli_fetch_assoc($res);

        //formats the reviews display.
        echo '

        <div class="card mx-auto" style="width: 90%; padding: 15px; margin-bottom: 10px;background-color: MistyRose; border-radius: 3%;">

        <div class="media" style="background-color: MistyRose;">

            <img class="mr-3" src="' . $picpath['profpic'] . '" style="max-width:75px; max-height: 75px; border-radius: 50%;">

            <div class="media-body" >

              <h4 class="mt-0" style = "font-family: Georgia, serif;"><a href=profile.php?name=' . $row['uname'] . '>' . $row['uname'] . '</a></h4>
              
              <h7 style= "font-family: Georgia, serif;"><i>' . $row['ratingnum'] . ' STARS</i></h7>

              <h4 class="mt-0" style = "font-family: Georgia, serif;"><b>' . $row['title'] . '</b></h4>
              
              <p style= "font-size:18px; text-align: justify; text-justify: inter-word;font-family: Georgia, serif; background-color:Pink; border-style:solid; padding: 5px;" >' . $row['reviewtext'] . '</p>

            </div>
            <div><p style = "font-size:10px;font-family: Georgia, serif;">' . $row['revdate'] . '</p></div>
          </div>
    </div>';
    }
} else {
    echo '<h5 style="text-align: center;">No reviews, yet! Be the first!</h5>';
}
