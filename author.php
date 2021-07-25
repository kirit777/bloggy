<?php 
error_reporting(0);
session_start();
include 'conn.php';

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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="sass/autoher.css" />
  <title>Hello, world!</title>
</head>

<body>
  <nav>
    <div class="nav_title">
      <h3>Bloggy</h3>
    </div>
    <div class="nav_menu">
      <a href="index.php" class="menu_item">Home</a>
      <a href="favorite.php" class="menu_item">Favorite</a>
      <a href="author.php" class="menu_item active">Author</a>
      <div class="ac"><a href="#"  class="menu_item">Account </a>
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

  <div class="hero" >

    <!--First Row-->
    <div class="first_row row w-100 container-fluid mt-5 justify-content-md-center ">
     <!--First Colomn-->
     <?php
        $q = "select * from `bloggy_user`";
        $r = mysqli_query($con,$q);
        while($row = $r->fetch_assoc()){
          $user_id = $row["user_id"];
            $user_name = $row["user_name"];
            $email = $row["user_email"];
            $user_profile = $row["user_profile"];
            $user_desc = $row["user_desc"];
            $facebook = $row["facebook"];
            $instagram = $row["instagram"];
            $twitter = $row["twitter"];
            $linkedin = $row["linkedin"];
          
     ?>
      <div class="colm col-lg-3 col-md-5 col-sm-10 ">
        <h2>
            <?php echo($user_name); ?>
        </h2>
        <p class="dated"> <i class="fa fa-calendar-alt"></i>Join date: <span>10/07/2021</span></p>
        <div class="img_con">
          <img src="<?php echo($user_profile); ?>"/>
        </div>
        <p class="main_text"><?php echo($user_desc); ?></p>
        <a class="read_btn">View Post</a>
        <a href="lib/follow.php?id=<?php echo($blog_id); ?>&&email=<?php echo($email); ?>" class="read_btn">Follow</a>
        <div class="container d-flex mt-4 social">
            <a href="<?php echo($facebook); ?>"><i class="fab fa-facebook"></i></a>
            <a href="<?php echo($instagram); ?>"><i class="fab fa-instagram"></i></a>
            <a href="<?php echo($twitter); ?>"><i class="fab fa-twitter"></i></a>
            <a href="<?php echo($linkedin); ?>"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <!--secound Colomn-->
      <?php 
      
    }
      ?>
    </div>
  </div>
  
  <footer class="container-fluid footer_div">
      <p>
        Copyright © 2021 <a>Bloggy</a>
      </p>
  </footer>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>