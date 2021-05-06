<?php
require 'includes/header.php';
?>

<main>
    <link rel="stylesheet" href="css/follow.css">
    <div class="bg-cover">
    <div class="about">
        <h1>Search for friends!</h1>
        <p2>Type your friends first name, last name, or username.</p2>
    </div>
    
        <div class="center-me">



                <form name="form1" method="get" action="follow.php">
                    <input type="text" placeholder="Friends Name" name="search" aria-label="Search" size="75">
                    <input type="submit" value="Search" name="submit">
                </form>

        </div>


    </div>
</main>
