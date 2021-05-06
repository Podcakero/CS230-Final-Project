<!-- Review Page: Enter a rating out of 5 stars, add a title, and write a review -->
<?php

require 'includes/dbhandler.php';
require 'includes/header.php';
require 'includes/review-helper.php';

//Gets id for the specific game
$id = $_GET['id'];

$sql = $conn->query("SELECT * FROM gallery WHERE pid=$id;");
$row = $sql->fetch();
$photo = $row['picpath'];
$title = $row['title'];


?>

<link rel="stylesheet" href="css\review.css">

<!-- sets background -->
<main style="background-color: lightgray; height:1500px;">

    <!-- displays title, game image, and 5 star rating system -->
    <div class="row" style="padding:30px;justify-content: left; height: 85%; ">
        <div class="column width:100%;">
            <h2 style="font-family: Georgia, serif;"><?php echo $title ?></h2>


            <img class="imgR" src="<?php echo $photo; ?>" alt="Game" style="height:500px">

            <div class="row" style="padding:10px;"></div>

            <em class="fa fa-star fa-2x star-rev" data-index="1"></em>

            <em class="fa fa-star fa-2x star-rev" data-index="2"></em>

            <em class="fa fa-star fa-2x star-rev" data-index="3"></em>

            <em class="fa fa-star fa-2x star-rev" data-index="4"></em>

            <em class="fa fa-star fa-2x star-rev" data-index="5"></em>


        </div>

        <div class="columnM">
            <form action="includes/review-helper.php" method="post">
                <div class="row form-group">

                    <!-- Review Title -->
                    <div style="width:100%;">
                        <input type="text" name="title" id="review-title" style="width: 75%;" placeholder="Title">
                    </div>

                </div>
                <div class="row" style="padding-bottom:40px;"></div>
                <div class="form-group row">
                    <!-- Review Text Area.-->
                    <textarea name="review" id="review-text" cols="80" rows="15" placeholder="  Type your review here!" style="border-radius:10px; width:80%; margin-left:60px;"></textarea>
                    <!-- Rating -->
                    <input type="hidden" name="rating" id="rating">
                    <input type="hidden" name="item_id" value="<?php echo $_GET['id'] ?>">

                </div>

                <!-- Submit Review Button -->
                <div class="form-group" style="width:100%; padding-top:40px;">
                    <button class="btn btn-success" type="submit" name="review-submit" id="review-submit" style="width:25%;">
                        Submit Review
                    </button>

                </div>
            </form>
        </div>
        <!-- Lists all reviews for the game -->
        <div class="column">
            <h2 style="font-family: Georgia, serif;">Recent Reviews</h2>
            <span id="review_list"></span>
        </div>
    </div>



</main>

<!-- Star System -->
<script type="text/javascript">
    var rateIndex = -1;

    var id = <?php echo $_GET['id']; ?>;

    $(document).ready(function() {

        reset_star();

        // get reviews
        xhr_getter('display-reviews.php?id=', "review_list");

        //avg();
        xhr_getter('includes/get-ratings.php?id=', "testAvg");

        if (localStorage.getItem('rating') != null) {
            setStars(parseInt(localStorage.getItem('rating')));
        }

        $('.star-rev').on('click', function() {
            rateIndex = parseInt($(this).data('index'));
            localStorage.setItem('rating', rateIndex);
        });

        $('.star-rev').mouseover(function() {

            reset_star();
            var currIndex = parseInt($(this).data('index'));
            setStars(currIndex);
        });

        $('.star-rev').mouseleave(function() {

            reset_star();

            if (rateIndex != -1) {
                setStars(rateIndex);
            }

        });

        function setStars(max) {
            for (var i = 0; i < max; i++) {
                $('.star-rev:eq(' + i + ')').css('color', 'goldenrod');
            }

            document.getElementById('rating').value = parseInt(localStorage.getItem('rating'));
            console.log(id);

        }

        function reset_star() {

            $('.star-rev').css('color', 'grey');

        }
        //Used to interchangeably send GET requests for review display data. 

        function xhr_getter(prefix, element) {

            var xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {

                // If the GET request was successful, fill in the span element with the review_list id with reviews
                if (this.readyState == 4 && this.status == 200) {

                    document.getElementById(element).innerHTML = this.responseText;
                }

            };

            url = prefix + id;

            xhttp.open("GET", url, true);

            xhttp.send();

        }

    });
</script>