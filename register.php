<?php 
error_reporting(0);
session_start();
include 'conn.php';
if(isset($_POST["register"])){

    $user_name = $_POST["user_name"];
    $user_email = $_POST["user_email"];
    $user_pass = $_POST["user_pass"];
    $user_cpass = $_POST["user_cpass"];

    $q = "select * from `bloggy_user` where `user_email` = '$user_email'";
    $s = mysqli_query($con,$q);
    if(mysqli_num_rows($s) > 0){
        echo "<script>window.alert('User Already Exist')</script>";
    }
    else{
        if($user_pass == $user_cpass){
            $ins  = "insert into  `bloggy_user` (`user_name`,`user_email`,`user_pass`) values('$user_name','$user_email','$user_pass')";
            $r = mysqli_query($con,$ins);
            if($r){
                $_SESSION["user_email"] = $user_email;
                echo "<script>window.alert('Register successful')</script>";
                header("location:account.php");
            }
            else{
               echo($r);
                 echo "<script>window.alert('Unable to register')</script>";
            }
        }
        else{
            echo "<script>window.alert('password are not matching')</script>";
        }
    }

}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <!-- Author : kirit -->
    <!-- website : garejakirit.ga -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="sass/account.css" />
    <title>Bloggy | Register</title>
</head>

<body>
    <nav>
        <div class="nav_title">
            <h3>Bloggy</h3>
        </div>
        <div class="nav_menu">
            <a href="#" class="menu_item">Home</a>
            <a href="#" class="menu_item">Favorite</a>
            <a href="author.php" class="menu_item">Author</a>
            <div class="ac"><a href="#" class="menu_item active">Account </a>
                <div class="hid_div">
                <?php 
          if($_SESSION["user_email"] == null){
            ?>
            <a  href="login.php"  class="menu_item">Login</a>
          <a href="register.php" class="menu_item">Register</a>
                      
            <?php
          }
          else{
            ?>
            <a  href="add_blog.php"  class="menu_item">Add Blog</a>
          <a class="menu_item">My Blog</a>
          <a href="account.php" class="menu_item">My Account</a>
          <a href="logout.php" class="menu_item">Log Out</a>
            <?php
          }
        ?>  
                </div>

            </div>
            <a href="contact.php" class="menu_item">Contact Us</a>
        </div>
    </nav>

    <div class="hero">

        <!--First Row-->
        <div class="first_row row w-100 container-fluid mt-5 justify-content-md-center ">
            <!--First Colomn-->
            <div class="colm  col-lg-12 col-md-12 col-sm-10 ">

                <h2>
                    Register
                </h2>
                <p class="dated">Join the world of imagination.</p>
            </div>
            <div class="colm  col-lg-12 col-md-12 col-sm-10 ">
                <div class="first_row row w-100 container-fluid mt-5 justify-content-md-center ">
                    <div class="colm col-lg-7 col-md-12 col-sm-10">
                        <div class="img_con">
                            <form action="#" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user_name" placeholder="Your Name">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" name="user_email" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="user_pass" placeholder="Enter Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="user_cpass" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Register" class="form-control read_btn" name="register" />
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- sseconf -->
                    <div class="colm col-lg-5 col-md-12 col-sm-10">
                        <img class="left_img" src="images/blog.jpg" />
                    </div>
                </div>
            </div>
        </div>

        <footer class="container-fluid footer_div">
            <p>
                Copyright © 2021 <a>Bloggy</a>
            </p>
        </footer>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>