<?php
require 'dbhandler.php';

if (isset($_POST['follow'])) {
    $uid_follow = $_POST['profile-to-follow'];
    $uid_user = $_POST['user-profile'];


    echo $uid_follow;
    echo $uid_user;

    $sql_followers = $conn->query("SELECT * FROM profiles WHERE uid=$uid_follow");
    $row1 = $sql_followers->fetch();
    if ($row1['followers'] != null) {
        $current_followers = $row1['followers'];
        $followers = $current_followers.",".$uid_user;
    } else
        $followers = $uid_user;

    $sql_following = $conn->query("SELECT * FROM profiles WHERE uid=$uid_user");
    $row2 = $sql_following->fetch();
    if ($row2['following'] != null) {
        $current_following = $row2['following'];
        $following = $current_following.",".$uid_follow;
    } else
        $following = $uid_follow;

    $conn->prepare("UPDATE profiles SET followers='$followers' WHERE uid=$uid_follow")->execute();
    $conn->prepare("UPDATE profiles SET following='$following' WHERE uid=$uid_user")->execute();

    header("Location: ../searchprofile.php?id=$uid_follow");
    exit();
}
else if (isset($_POST['unfollow']))
{
    $uid_follow = $_POST['profile-to-follow'];
    $uid_user = $_POST['user-profile'];

    echo $uid_follow;
    echo $uid_user;

    $sql_followers = $conn->query("SELECT * FROM profiles WHERE uid=$uid_follow");
    $row1 = $sql_followers->fetch();
    if ($row1['followers'] != null) {
        $current_followers = $row1['followers'];
        $arr = explode(",", $current_followers);
        foreach ($arr as $user)
            if ($user != $uid_user)
                $followers = $followers.",".$user;
    }

    $sql_following = $conn->query("SELECT * FROM profiles WHERE uid=$uid_user");
    $row2 = $sql_following->fetch();
    if ($row2['following'] != null) {
        $current_following = $row2['following'];
        $arr = explode(",", $current_following);

        foreach ($arr as $user)
            if ($user != $uid_follow)
                $following = $following.",".$user;
    }

    $conn->prepare("UPDATE profiles SET followers='$followers' WHERE uid=$uid_follow")->execute();
    $conn->prepare("UPDATE profiles SET following='$following' WHERE uid=$uid_user")->execute();

    header("Location: ../searchprofile.php?id=$uid_follow");
    exit();
}
