<?php
error_reporting(0); 
session_start();
include 'conn.php';
if($_GET["id"] != null){
    $blog_id = $_GET["id"]; 
    $q = "SELECT * FROM `bloggy_blog` WHERE `blog_id` = '$blog_id' ";
    $r = mysqli_query($con,$q);
    while($row = $r->fetch_assoc()){
        $blog_title = $row["blog_title"];
        $blog_body = $row["blog_body"];
        $email = $row["user_email"];
        $blog_date = $row["blog_date"];
        $blog_image = $row["blog_image"];

        $u = "select * from `bloggy_user` where `user_email` = '$email' ";
            $ur = mysqli_query($con,$u);
            while($row2 = $ur->fetch_assoc()){
              $user_name = $row2["user_name"];
              $user_profile = $row2["user_profile"];
              $facebook = $row2["facebook"];
              $instagram = $row2["instagram"];
              $twitter = $row2["twitter"];
              $linkedin = $row2["linkedin"];
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="sass/blog.css" />
    <title>Bloggy | <?php echo($blog_title); ?></title>
</head>

<body>
    <nav>
        <div class="nav_title">
            <h3>Bloggy</h3>
        </div>
        <div class="nav_menu">
            <a href="index.php" class="menu_item">Home</a>
            <a href="favorite.php" class="menu_item">Favorite</a>
            <a href="author.php" class="menu_item">Author</a>
            <div class="ac"><a href="#" class="menu_item">Account </a>
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
                <?php echo($blog_title); ?>
                </h2>
                <p class="dated"> <i class="fa fa-calendar-alt"></i>date: <span><?php echo($blog_date); ?></span></p>

                <div class="img_con">
                    <img src="<?php echo($user_profile); ?>" />
                </div>
                <p class="author"><?php echo($user_name); ?></p>
                <a href="lib/follow.php?id=<?php echo($blog_id); ?>&&email=<?php echo($email); ?>" class="read_btn">Follow</a>
                <a href="lib/add_fav.php?id=<?php echo($blog_id); ?>" class="read_btn">Add To Favorite</a>
                <div class="container d-flex mt-4 social">
                <a href="<?php echo($facebook); ?>"><i class="fab fa-facebook"></i></a>
                <a href="<?php echo($instagram); ?>"><i class="fab fa-instagram"></i></a>
                <a href="<?php echo($twitter); ?>"><i class="fab fa-twitter"></i></a>
                <a href="<?php echo($linkedin); ?>"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="colm  col-lg-12 col-md-12 col-sm-10 ">
                <!-- here -->
                <img src="<?php echo($blog_image); ?>" class="main_img" />
                
                <div class="container">
                <?php echo($blog_body); ?>   
                </div>
                <!-- end -->
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