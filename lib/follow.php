<?php
include '../conn.php';
session_start();
$id = $_GET["id"];
$user_email = $_SESSION["user_email"];
$follow_email = $_GET["email"];

if($user_email == $follow_email){
    if($id == null){
        header("location:../author.php");
    }
    else{
        header("location:../blog.php?id=".$id);
    }
}
else{
    $s = "select * from `bloggy_follow` WHERE `user_email` = '$user_email' AND `follow_email` = '$follow_email' ";
$se = mysqli_query($con,$s);
if(mysqli_num_rows($se) > 0)
{
    if($id == null){
        header("location:../author.php");
    }
    else{
        header("location:../blog.php?id=".$id);
    }
}
else{
    $q = "INSERT INTO `bloggy_follow`(`user_email`,`follow_email`) VALUES('$user_email','$follow_email')";
    $r = mysqli_query($con,$q);
    if($r){
        if($id == null){
            header("location:../author.php");
        }
        else{
            header("location:../blog.php?id=".$id);
        }
    }
    else{
        if($id == null){
            header("location:../author.php");
        }
        else{
            header("location:../blog.php?id=".$id);
        }
    }
}
}

?>