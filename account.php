<?php
error_reporting(0);
session_start();
if ($_SESSION["user_email"] == null) {
    header("location:login.php");
}
include 'conn.php';
if (isset($_POST["update"])) {

    $user_name = $_POST["user_name"];
    $user_pass = $_POST["user_pass"];
    $user_email = $_SESSION["user_email"];
    $facebook = $_POST["facebook"];
    $instagram = $_POST["instagram"];
    $twitter = $_POST["twitter"];
    $linkedin = $_POST["linkedin"];
    $user_desc = $_POST["user_desc"];

    $target_file = "images/";
    $bimage = $target_file . rand() . "_" . time() . ".jpeg";


    if (empty($_FILES["user_profile"])) {
        $upd = "update `bloggy_user` set `user_name` = '$user_name', `user_pass` = '$user_pass',`facebook` = '$facebook',`instagram` = '$instagram',`twitter` = '$twitter', `linkedin` = '$linkedin', `user_desc` = '$user_desc' WHERE `user_email` = '$user_email' ";
        $u = mysqli_query($con, $upd);
        if ($u) {
            echo "<script>window.alert('Profile Updated')</script>";
        } else {
            echo "<script>window.alert('Unable to Update')</script>";
        }
    } else {

        $upd = "update `bloggy_user` set `user_name` = '$user_name', `user_pass` = '$user_pass',`facebook` = '$facebook',`instagram` = '$instagram',`twitter` = '$twitter', `linkedin` = '$linkedin',`user_profile` = '$bimage', `user_desc` = '$user_desc' WHERE `user_email` = '$user_email' ";
        $u = mysqli_query($con, $upd);
        if ($u) {
            move_uploaded_file($_FILES["user_profile"]["tmp_name"], $bimage);
            echo "<script>window.alert('Profile Updated')</script>";
        } else {
            echo "<script>window.alert('Unable to Update')</script>";
        }
    }
}

$email = $_SESSION["user_email"];
$q = "select * from `bloggy_user` WHERE `user_email` = '$email'  ";
$res = mysqli_query($con, $q);

while ($row = $res->fetch_assoc()) {
    $user_name = $row["user_name"];
    $user_email = $row["user_email"];
    $user_pass = $row["user_pass"];
    $user_desc = $row["user_desc"];
    $user_profile = $row["user_profile"];
    $facebook = $row["facebook"];
    $instagram = $row["instagram"];
    $twitter = $row["twitter"];
    $linkedin = $row["linkedin"];
}

$fv = "select * from `bloggy_follow` where `folllow_email` = '$email' ";
$fi = "select * from `bloggy_follow` where `user_email` = '$email' ";

$res = mysqli_query($con, $fv);
$resi = mysqli_query($con, $fi);

$followers = mysqli_num_rows($res);
$follwing = mysqli_num_rows($resi);

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
    <link rel="stylesheet" href="sass/account.css" />
    <title>Hello, <?php echo ($user_name); ?></title>
</head>

<body>
    <nav>
        <div class="nav_title">
            <h3>Bloggy</h3>
        </div>
        <div class="nav_menu">
            <a href="#" class="menu_item">Home</a>
            <a href="favorite.php" class="menu_item">Favorite</a>
            <a href="author.php" class="menu_item">Author</a>
            <div class="ac"><a href="#" class="menu_item active">Account </a>
                <div class="hid_div">
                    <a href="add_blog.php" class="menu_item">Add Blog</a>
                    <a class="menu_item">My Blog</a>
                    <a class="menu_item">My Account</a>
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
                    Account
                </h2>
                <p class="dated">Edit Account Info</p>
                <div class="img_con">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <img src="<?php echo ($user_profile); ?>" class="user_img" tooltip="add Image" /><br>
                        <button class="read_btn" onClick="openDiallog()"> Update Profile</button>
                        <div class="fdiv d-flex">
                            <p class="read_btn"> Followers <?php echo ($followers); ?></p>
                            <p class="read_btn ml-2"> Following <?php echo ($follwing); ?></p>
                        </div> 
                        <div class="form-group">
                            <input type="text" class="form-control" value="<?php echo ($user_name); ?>" name="user_name" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" value="<?php echo ($user_email); ?>" name="user_email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" value="<?php echo ($user_pass); ?>" name="user_pass" placeholder="Your Password">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="user_desc"><?php echo ($user_desc); ?></textarea>
                        </div>
                        <input type="file" id="image" class="form-control" value="<?php echo ($user_profile); ?>" name="user_profile" hidden />

                        <div class="social">
                            <div class="form-group single">
                                <i class="fab fa-facebook"></i>
                                <input type="text" class="form-control" value="<?php echo ($facebook); ?>" name="facebook" placeholder="Facebook Account Link">
                            </div>
                            <div class="form-group single">
                                <i class="fab fa-instagram"></i>
                                <input type="text" class="form-control" value="<?php echo ($instagram); ?>" name="instagram" placeholder="Instagram Account Link">
                            </div>
                            <div class="form-group single">
                                <i class="fab fa-twitter"></i>
                                <input type="text" class="form-control" value="<?php echo ($twitter); ?>" name="twitter" placeholder="Twitter Account Link">
                            </div>
                            <div class="form-group single">
                                <i class="fab fa-linkedin"></i>
                                <input type="text" class="form-control" value="<?php echo ($linkedin); ?>" name="linkedin" placeholder="Kinkedin Account Link">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Update" class="form-control read_btn" name="update" />
                        </div>
                        <script>
                            function openDiallog() {
                                console.log("helloo");
                                let i = document.getElementById("image");
                                i.click()
                                return false;
                            }
                        </script>

                    </form>
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