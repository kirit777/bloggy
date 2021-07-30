<?php
session_start();
include '../conn.php';
if(isset($_POST["add"])){

    $blog_title = $_POST["blog_title"];
    $blog_body = $_POST["blog_body"];
    $blog_image = $_FILES["blog_image"];
    $user_email = $_SESSION["user_email"];
    $target_file = "images/";
    $blog_date = date("d/m/Y") . " Day: " . date("l");
    $bimage = $target_file.rand()."_".time().".jpeg";

    $q = "INSERT INTO `bloggy_blog`(`blog_title`,`blog_body`,`blog_image`,`user_email`,`blog_date`) VALUES('$blog_title','$blog_body','$bimage','$user_email','$blog_date') ";
    $r = mysqli_query($con,$q);

        
        
    move_uploaded_file($_FILES["blog_image"]["tmp_name"], "../".$bimage);

    if(mysqli_num_rows($r) > 0){
        echo "<script>window.alert('Blog Uploaded')</script>";
        header("location:../add_blog.php");
    }
    else{
        echo "<script>window.alert('Unable to Upload Blog')</script>";
        header("location:../add_blog.php");
    }
}

?>