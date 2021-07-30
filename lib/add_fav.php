<?php
include '../conn.php';
session_start();
$id = $_GET["id"];
$user_email = $_SESSION["user_email"];


$s = "select * from `bloggy_favorite` WHERE `user_email` = '$user_email' AND `blog_id` = '$id' ";
$se = mysqli_query($con,$s);
if(mysqli_num_rows($se) > 0)
{
    header("location:../blog.php?id=".$id);
}
else{
    $q = "INSERT INTO `bloggy_favorite`(`user_email`,`blog_id`) VALUES('$user_email','$id')";
    $r = mysqli_query($con,$q);
    if($r){
        header("location:../blog.php?id=".$id);
    }
    else{
        header("location:../blog.php?id=".$id);
    }
}

?>