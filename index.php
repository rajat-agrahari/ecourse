<?php 
    include_once 'partials/_dbconnect.php';
    if(!isset($_SESSION)){
        session_start();
    }
    // session_unset();+
    
    // session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon link -->
    <link rel="shortcut icon" type="images/png" href="images/favicon.png">
    
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome css -->
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Custom Css -->
    <link rel='stylesheet' href='css/style.css'>

    <title>eCourse</title>
</head>

<body>
    <!-- Start navigation -->
    <?php include 'partials/_header.php'; ?>

    <!-- End navigation -->

    <!-- video start here -->
    <div class="container-fluid mx-0 my-0 px-0 py-0">
        <div class="vid-parent">
            <video src="video/video_home.mp4" playsinline autoplay muted loop></video>
            <div class="vid-overlay"></div>
        </div>
        <div class="video-content">
            <h1>Welcome to eCourse</h1>
            <small>a Perfect Learn</small><br>
            <?php
                if(isset($_SESSION['is_login']) && $_SESSION['is_login'] == true){
                   echo '<a href="Student/studentProfile.php" class="btn btn-primary"><i class="fas fa-home"></i> My Profile</a>';
                }else{
                   echo '<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#signupModal" ><i class="fas fa-book-reader"></i> Start a Course</a>';
                }

            ?>
        </div>
    </div>
    <!-- End Video -->

    <!-- Start Banner  -->
    <div class="container-fluid banner-container">
        <div class="row">
            <div class="col-sm banner-content">
                <h5><i class="fas fa-book-open mr-3"></i>100+ Online Courses</h5>
            </div>
            <div class="col-sm banner-content">
                <h5><i class="fas fa-users mr-3"></i>Expert Instructor</h5>
            </div>
            <div class="col-sm banner-content">
                <h5><i class="fas fa-keyboard mr-3"></i>lifetime Access</h5>
            </div>
            <div class="col-sm banner-content">
                <h5><i class="fas fa-rupee-sign mr-3"></i>Money Back Guarantee</h5>
            </div>
        </div>
    </div>


    <!-- Start Course -->
    <div class="container my-5">
        <h1 class="text-center my-3">Popular Courses</h1>
        <div class="card-deck">
            <!-- Start deck 1 -->
            <?php
                $sql = "SELECT * FROM course LIMIT 3";
                $result = mysqli_query($conn , $sql);
                $numRows = mysqli_num_rows($result);
                if($numRows>0){
                    while ($row = mysqli_fetch_assoc($result)) {
                       $course_id = $row['course_id'];
                       echo '<a href="coursedetail.php?course_id='.$course_id.'" class="card-a-link text-dark text-decoration-none">
                       <div class="card">
                           <img class="card-img-top" src="'. str_replace('..','.' ,$row['course_img']).'" alt="Card image cap" height="246.8">
                           <div class="card-body">
                               <h5 class="card-title">'.$row['course_name'].'</h5>
                               <p class="card-text">'.substr($row['course_desc'],0,90) .'...</p>
                           </div>
                           <div class="card-footer">
                               <p class="card-text d-inline">
                                   Price: <small><del> &#8377 '.$row['course_original_price'] .'</del></small>
                                   <span class="font-weight-bolder"> &#8377 '.$row['course_price'] .'</span>
                               </p>
                               <a href="coursedetail.php?course_id='.$course_id.'" class="btn btn-primary text-white font-weight-bolder float-right">Enroll</a>
                           </div>
                       </div>
                   </a>';
                    }
                }
            ?>
        </div>
        <!-- Start deck 2 -->
        <div class="card-deck mt-4">
            <?php
                $sql = "SELECT * FROM course LIMIT 3,3";
                $result = mysqli_query($conn , $sql);
                $numRows = mysqli_num_rows($result);
                if($numRows>0){
                    while ($row = mysqli_fetch_assoc($result)) {
                       $course_id = $row['course_id'];
                       echo '<a href="coursedetail.php?course_id='.$course_id.'" class="card-a-link">
                       <div class="card">
                           <img class="card-img-top" src="'. str_replace('..','.' ,$row['course_img']).'" alt="Card image cap"  height="246.8">
                           <div class="card-body">
                               <h5 class="card-title">'.$row['course_name'].'</h5>
                               <p class="card-text">'.substr($row['course_desc'],0,90) .'...</p>
                           </div>
                           <div class="card-footer">
                               <p class="card-text d-inline">
                                   Price: <small><del> &#8377 '.$row['course_original_price'] .'</del></small>
                                   <span class="font-weight-bolder"> &#8377 '.$row['course_price'] .'</span>
                               </p>
                               <a href="coursedetail.php?course_id='.$course_id.'" class="btn btn-primary text-white font-weight-bolder float-right">Enroll</a>
                           </div>
                       </div>
                   </a>';
                    }
                }
            ?>

        </div>
        <div class="container text-center mt-3">
            <a href="course.php"><button class="btn btn-danger">View All Courses</button></a>
        </div>
    </div>

    <!-- End Courses -->

    <!-- Start Contact section -->
    <?php include 'contact.php'; ?>
    <!-- End Contact section -->


    <!-- Student feedback -->

    <!--Start About, Category ,Address,  -->

    <!-- Footer section -->
    <?php include 'partials/_footer.php'; ?>