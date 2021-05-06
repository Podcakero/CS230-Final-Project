<!-- Add Question:  Allows an admin to add a question to a quiz -->

<?php
require 'includes/header.php';
?>

<main>

    <link rel="stylesheet" href="css/profile.css">

    <div class="container center-me" style="max-width: 800px;">
        <div class="col-md-10 col-lg-10">
            <div class="border">
                <form id="quiz-form" action="includes/quiz-helper.php" method="post">
                    <div class="question bg-white p-3 border-bottom">
                        <h4>Add Quiz Question</h4>
                    </div>
                    <div class="question bg-white p-3 border-bottom">
                        <div class="d-flex flex-row align-items-center question-title">
                            <input type="text" , name="question" , id="question" placeholder="Enter a Question">
                        </div>
                        <div class="ans ml-2">
                            <input type="text" name="a1" id="a1" placeholder="Answer 1">
                            <input class="right" type="text" name="t1" id="t1" placeholder="Tag 1">
                        </div>
                        <div class="ans ml-2">
                            <input type="text" name="a2" id="a2" placeholder="Answer 2">
                            <input class="right" type="text" name="t2" id="t2" placeholder="Tag 2">
                        </div>
                        <div class="ans ml-2">
                            <input type="text" name="a3" id="a3" placeholder="Answer 3">
                            <input class="right" type="text" name="t3" id="t3" placeholder="Tag 3">
                        </div>
                        <div class="ans ml-2">
                            <input type="text" name="a4" id="a4" placeholder="Answer 4">
                            <input class="right" type="text" name="t4" id="t4" placeholder="Tag 4">
                        </div>

                    </div>
                    <div class="form-group">
                        <button class="btn btn-outline-danger" type="submit" name="ques-submit" id="ques-submit" style="width: 30%">Submit Question</button>


                    </div>
                </form>
            </div>
        </div>

    </div>
</main>