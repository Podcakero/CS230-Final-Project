<!-- Header -->

<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$_logged_in = isset($_SESSION['uid']);

if ($_logged_in) {

    $servername = '54.158.119.193';
    $username = 'dbmasteruser';
    $password = 's)LWM1F;e$7z|+#7w?ExQ!|12,,5COVZ';
    $dbName = 'main';

    try {
        $conn = new PDO('mysql:host=' . $servername . ';dbname=' . $dbName . '', $username, $password);
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }

    $uid = $_SESSION['uid'];

    //Get user info
    $sql = "SELECT admin, sqlAdmin, uname FROM users WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($uid));

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $_admin = $row['admin'];
    $_sqlAdmin = $row['sqlAdmin'];
    $username = $row['uname'];

    //Get profile Pic
    $sql = $conn->query("SELECT * FROM profiles WHERE uid=$uid");
    $row = $sql->fetch();

    $photo = $row['profpic'];
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/0809ee8fa6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css\header.css">
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">

        <a class="navbar-brand" href="../index.php" style="color:mistyrose;">Gamer Hotline</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Most Items -->
            <ul class="navbar-nav mr-auto">

                <?php
                echo
                ' 
                    <li class="nav-item">
                        <a class="nav-link" href="index.php" style="color:mistyrose;font-size: large;">About Us</a>
                    </li>
                    ';
                //Check if logged in
                if (isset($_SESSION['uid'])) {
                    echo
                    '
                            <li class="nav-item">
                                <a class="nav-link" href="quiz.php" style="color:mistyrose;font-size: large;">Quizzes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Gallery.php" style="color:mistyrose;font-size: large;">Games</a>
                            </li>
                            ';
                    //Check if admin
                    if ($_admin == 1) { //Is admin
                        echo
                        '
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Admin Tools
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                   
                                    <a class="dropdown-item" href="../Addq.php">Edit Quiz<i class="fas fa-edit"  style="margin-left:4px;"></i></a>
                                    <a class="dropdown-item" href="../admin.php">Edit Gallery<i class="fas fa-edit"  style="margin-left:4px;"></i></a>
                                    <div class="dropdown-divider">
                                    
                            </li>
                            ';
                    }
                    //Check if SQL admin
                    if ($_sqlAdmin == 1) { //Is SQL Admin
                        echo
                        '
                            <li class="nav-item">
                                <a class="nav-link" href="../sql.php">Edit the database</a>
                            </li>
                            ';
                    }
                } ?>
            </ul>

            <!-- Search Bar -->
            <ul class="navbar-nav mr-auto" style="margin-left:-15%;">
                <div class="input-group rounded">
                    <form name="form1" method="get" action="../search.php">
                        <input type="text" placeholder="Search for games..." name="search" aria-label="Search" required>
                        <input type="submit" value="Search" name="submit">
                    </form>
                </div>
            </ul>

            <!-- Right Most Items -->
            <div>
                <ul class="navbar-nav navbar-right">
                    <?php
                    //Check if logged in
                    if (isset($_SESSION['uid'])) {
                        //Check if admin
                        if ($_admin) { //Is admin
                            echo
                            '
                        <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user-shield" style="transform: scale(2.5); margin-right:4px;"></i>
                                </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-top:15px;">
                                <div class="media">
                                    <img class="mr-3" src="../' . $photo . '" alt="../images/defaultprof.jpg" style="margin-left:15px;transform: scale(.65);border-radius: 50%;max-height:200px;">
                                        <div class="media-body">
                                        </div>
                                </div>
                                
                                <a class="dropdown-item" href="../profile.php" style="height:30px;text-align:center;">@' . $username . '</a>
                                
                                <div class="dropdown-divider">
                                </div>
                                
                                <a class="dropdown-item" href="../profile.php">View my Profile<i class="fas fa-user" style="margin-left:4px;"></i></a>
                                <a class="dropdown-item" href="../quiz.php">Take a Quiz!<i class="fas fa-edit"  style="margin-left:4px;"></i></a>
                                <a class="dropdown-item" href="../myreviews.php">My Reviews<i class="fas fa-gamepad"  style="margin-left:4px;"></i></a>
                                <a class="dropdown-item" href="../followsearch.php">Search Users<i class="fas fa-search"  style="margin-left:4px;"></i></a>
                                
                                <div class="dropdown-divider">
                                </div>

                                <a class="dropdown-item" href="../includes/logout.php">Logout</a>
                            </div>
                        </li>
                        ';
                        } else { //Not Admin
                            echo
                            '
                        <li class="nav-item dropdown" >
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-user-circle" style="transform: scale(2.5);margin-right:4px;"></i>
                            </a>
                            
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-top:15px;">
                                <div class="media">
                                    <img class="mr-3" src="../' . $photo . '" alt="../images/defaultprof.jpg" style="margin-left:15px;transform: scale(.65);border-radius: 50%;max-height:200px;">
                                    
                                    <div class="media-body">
                                    </div>
                                </div>
                                
                                <a class="dropdown-item" href="../profile.php" style="height:30px;text-align:center;">@' . $username . '</a>
                                
                                <div class="dropdown-divider">
                                </div>
                                
                                <a class="dropdown-item" href="../profile.php">View my Profile<i class="fas fa-user" style="margin-left:4px;"></i></a>
                                <a class="dropdown-item" href="../quiz.php">Take a Quiz!<i class="fas fa-edit"  style="margin-left:4px;"></i></a>
                                <a class="dropdown-item" href="../myreviews.php">My Reviews<i class="fas fa-gamepad"  style="margin-left:4px;"></i></a>
                                <a class="dropdown-item" href="../followsearch.php">Search Users<i class="fas fa-search"  style="margin-left:4px;"></i></a>
                               
                                <div class="dropdown-divider">
                                </div>

                                <a class="dropdown-item" href="../includes/logout.php">Logout</a>
                            </div>
                        </li>
                        ';
                        }
                    } else { //Not logged in
                        echo
                        '
                        <li class="button">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        ';
                    } ?>
            </div>
        </div>
    </nav>
</header>