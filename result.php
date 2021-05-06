<?php
require 'includes/header.php';
?>

<meta charset=UTF-8 />
<!--<link rel="stylesheet"  href="css/quiz.css">-->
<?php
if (isset($_POST['quiz-submit'])) {
        require 'includes/dbhandler.php';
?>

</head>

<body>

    <link rel="stylesheet" href="css/result.css">

    <h1>Top Games For You</h1>
   
        <?php
                        //Array from quiz answers
                        $arr = json_encode($_POST['results']);
                        //Get rid of quotation marks
                        $arr2 =  str_replace('"', "", $arr);
                        //Get rid of commas
                        $str_arr = explode(",", $arr2);

                        $max = 0;

						//Find tag value with most clicks
                        $count = array_count_values($str_arr);
                        arsort($count);
                        $tag = array_slice(array_keys($count), 0, 3, true);


                       


                        ?>
        <?php




						//Display games with top 3 tags
                        $stmt = $conn->query("SELECT * FROM gallery WHERE Tags='$tag[0]' OR Tags='$tag[1]'");
						?>
							<h3>Your top 2 traits are: <?php echo ''.$tag[0].' and '.$tag[1].''?></h3>;
							 <div class="bg">
								 <?php
                        while ($row = $stmt->fetch()) {
                                echo '
            <div data-class="action">
		
            <div class="column">
                            <div class="gallery-container">
                                <div class="card">
                                        <a href="review.php?id=' . $row['pid'] . '">
                                        <img src="gallery/' . $row["picpath"] . '" alt="Card image cap"">
                                        <h4>' . $row["title"] . '</h4>
										<h5 class=descript>' . $row["descript"] . '</h5>
                                        <p class="btn btn-primary center-me">Review</p>
                                        </a>
                                        </div>
                                </div>
                            </div>
                        </div>';
                        }
                        ?>




</body>
</div>
</link>
<?php
}
?>