<!-- Gallery: Gets and displays games within different categories. -->

<?php
require 'includes/header.php';
require 'includes/dbhandler.php';
?>
<main>
    <link rel="stylesheet" href="css/gallery.css">
    <div class="bg">
        <link rel="stylesheet" href="style.css">
        <section class="main text-center">
            <div class="container">
                <h1>Video Games:</h1>
                <ul class="list-unstyled row">
                    <li class="col-md active" data-class="all">All Games</li>
                    <li class="col-md" data-class="action">Action</li>
                    <li class="col-md" data-class="adventure">Adventure</li>
                    <li class="col-md" data-class="story">Story</li>
                    <li class="col-md" data-class="online">Online</li>
                    <li class="col-md" data-class="other">Other</li>
                </ul>
            </div>
            <div class="container-fluid ">

                <?php
                $sql = $conn->query("SELECT * FROM gallery Where category = 'action'");
                //Only games in the action category show up
                while ($row = $sql->fetch()) {
                    echo '
                    <div class="col-md-3 images" data-class="action">
                        <div class="column">
                            <div class="gallery-container">
                                <div class="card">
                                    <a href="review.php?id=' . $row['pid'] . '">
                                    <img src="gallery/' . $row["picpath"] . '" alt="Card image cap"">
                                    <h4>' . $row["title"] . '</h4>
                                    <p class="btn btn-primary center-me">Review</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                $sql = $conn->query("SELECT * FROM gallery where category ='adventure'");
                //Only games in the adventure category show up
                while ($row = $sql->fetch()) {
                    echo '
                    <div class="col-md-3 images" data-class="adventure">
                        <div class="column">
                            <div class="gallery-container">
                                <div class="card">
                                    <a href="review.php?id=' . $row['pid'] . '">
                                    <img src="gallery/' . $row["picpath"] . '" alt="Card image cap"">
                                    <h4>' . $row["title"] . '</h4>
                                    <p class="btn btn-primary center-me">Review</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                $sql = $conn->query("SELECT * FROM gallery WHERE category ='story'");
                // Only games in the story category show up
                while ($row = $sql->fetch()) {
                    echo '
                    <div class="col-md-3 images" data-class="story">
                        <div class="column">
                            <div class="gallery-container">
                                <div class="card">
                                    <a href="review.php?id=' . $row['pid'] . '">
                                    <img src="gallery/' . $row["picpath"] . '" alt="Card image cap"">
                                    <h4>' . $row["title"] . '</h4>
                                    <p class="btn btn-primary center-me">Review</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                $sql = $conn->query("SELECT * FROM gallery WHERE category = 'online'");
                //Only games in the online category show up
                while ($row = $sql->fetch()) {
                    echo '
                    <div class="col-md-3 images" data-class="online">
                        <div class="column">
                            <div class="gallery-container">
                                <div class="card">
                                    <a href="review.php?id=' . $row['pid'] . '">
                                    <img src="gallery/' . $row["picpath"] . '" alt="Card image cap"">
                                    <h4>' . $row["title"] . '</h4>
                                    <p class="btn btn-primary center-me">Review</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                $sql = $conn->query("SELECT * FROM gallery WHERE category = 'other'");
                // Only games in the other cateogry will show up
                while ($row = $sql->fetch()) {
                    echo '
                    <div class="col-md-3 images" data-class="other">
                        <div class="column">
                            <div class="gallery-container">
                                <div class="card">
                                    <a href="review.php?id=' . $row['pid'] . '">
                                    <img src="gallery/' . $row["picpath"] . '" alt="Card image cap"">
                                    <h4>' . $row["title"] . '</h4>
                                    <p class="btn btn-primary center-me">Review</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                ?>
            </div>
        </section>
        <script src="gallery.js"></script>