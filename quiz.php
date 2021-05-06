<?php
require 'includes/header.php';
?>


<form method="POST" enctype="multipart/form-data" action="result.php">
    <link rel="stylesheet" href="css/quiz.css">
    <?php
    require 'includes/dbhandler.php';

    $sql = "SELECT * FROM AddQuestion ORDER BY id";
    $stmt = $conn->query($sql);
    $i = 1;
    $question_rowcount = $stmt->rowCount();
    foreach ($stmt as $row) {
        $question_id = $row['id'];
        $questions = $row['Qtitle'];
        $optionA = $row['A1'];
        $optionATag = $row['T1'];
        $optionB = $row['A2'];
        $optionBTag = $row['T2'];
        $optionC = $row['A3'];
        $optionCTag = $row['T3'];
        $optionD = $row['A4'];
        $optionDTag = $row['T4'];

    ?>

        <!--<label class="btn btn-1">-->

        <div id='question<?php echo $i; ?>' class='cont center-me'>
            <div class="form-group">
                <div class="frame">
                    <label style="font-weight: normal; text-align: justify;" class="questions mt-1 mt-2"><br><?php echo "Question " . " " . $i . ": "; ?></b><?php echo $questions; ?></label><br>
                    <div id="quiz-options">
                        <div class="frame2">
                            <label style="font-weight: normal; cursor: pointer;"></label>
                            <input class="radio" type="radio" name="statusSelect" value=<?php echo '' . $optionATag . '' ?>>
                            <?php echo $optionA; ?>
                            <br>
                        </div>
                        <div class="frame2">
                            <label style="font-weight: normal; cursor: pointer;"></label>
                            <input class="radio" type="radio" name="statusSelect" value=<?php echo '' . $optionBTag . '' ?>>
                            <?php echo $optionB; ?>
                            <br>
                        </div>
                        <div class="frame2">
                            <label style="font-weight: normal; cursor: pointer;"></label>
                            <input class="radio" type="radio" name="statusSelect" value=<?php echo '' . $optionCTag . '' ?>>
                            <?php echo $optionC; ?>
                            <br>
                        </div>
                        <div class="frame2">
                            <label style="font-weight: normal; cursor: pointer;"></label>
                            <input class="radio" type="radio" name="statusSelect" value=<?php echo '' . $optionDTag . '' ?>>
                            <?php echo $optionD; ?>
                            <br>
                        </div>


                        <?php
                        ?>
                    </div>
                </div>
                <?php
                if ($i < $question_rowcount) {
                ?>
                    <button id='next  <?php echo $i; ?>' class='next btn btn-default button-center' type='button'>Next</button>

                <?php
                } else if ($i == $question_rowcount) { ?>

                    <div class="form-group">
                        <button class='submit btn btn-default button-center' name="quiz-submit" type="submit">Submit
                            Quiz</button>
                        <!--<input type="submit" value="submit">-->
                    </div>

                <?php } ?>
            </div>
        </div>
    <?php

        $i++;
    } ?>
    <div class="form-group">
        <input type="hidden" name="results" id="results">
    </div>

    </link>
</form>

<script>
    //Hide and display questions based on id
    var arr = [];
    var total = <?php echo $question_rowcount; ?>;

    $('.cont').addClass('hide');
    $('#question' + 1).removeClass('hide');

    // To access tag attribute: $('#A' + nex).attr('tag')

    //User clicks 'next'
    $(document).on('click', '.next', function() {

        //Go through the different labels (a, b, c, d) and determine which button the user pressed.
        //if ($('#A' + nex).value)

        let checked = $("input:checked");

        for (let i = 0; i < checked.length; i++)
            arr.push(checked[i].value);

        console.log(arr);

        document.getElementById('results').value = arr;
        console.log(document.getElementById('results').value);

        element = $(this).attr('id');
        $("input[type='submit']").hide();
        last = parseInt(element.substr(5), 10);
        if (total == last) {
            $("input[type='submit']").show();
        }

        nex = last + 1;

        //Hide last question and display current one
        $('#question' + last).addClass('hide');

        $('#question' + nex).removeClass('hide');
    });


    //This function makes it so only one button can be selected at a time
    function responderChangeStatus(elem) {
        var btnEl = document.querySelectorAll('.statusSelect');
        for (var i = 0; i < btnEl.length; i++) {
            btnEl[i].classList.remove('Selected');
        }
        elem.classList.add('Selected');

        return;
    }
</script>