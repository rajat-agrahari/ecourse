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
    <link rel="stylesheet" href="css/style.css">
    <title>eCourses -All Courses</title>
</head>

<body>
    <?php include_once 'partials/_header.php'; ?>

    <!-- img backgroung -->
    <div class="container-fluid px-0 py-0">
        <img src="images/18.jpg" class="img-bg" alt="">
    </div>
    <div class="container col-sm-6 offset-sm-3 my-3">
        <?php
                // if session logout after buy course to show msg for login again
                    if(isset($_GET['afterbuy']) && $_GET['afterbuy'] == true){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Buy successfully !</strong> Please login again to watch your courses.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }
                    // if user buy course without login account
                    if(isset($_GET['loghere']) && $_GET['loghere'] == true){
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>ERROR !</strong> Please login to buy courses.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }
                    // if user buy already course
                    if(isset($_GET['alreadybuy']) && $_GET['alreadybuy'] == true){
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>ERROR ! </strong> You already Purchase this course.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                    }
             ?>
    </div>
    <!-- All courses -->
    <div class="container my-5">
        <h1 class="text-center my-3">All Courses</h1>

        <div class="row mt-3">
            <?php
                $sql = "SELECT * FROM course";
                $result = mysqli_query($conn , $sql);
                $numRows = mysqli_num_rows($result);
                if($numRows>0){
                    while ($row = mysqli_fetch_assoc($result)) {
                       $course_id = $row['course_id'];
                       echo '<div class="col-sm-4 mb-4">
                       <a href="coursedetail.php?course_id='.$course_id.'" class="card-a-link text-dark text-decoration-none">
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
                   </a>
                   </div>';
                    }
                }
            ?>
        </div>
    </div>

    <!-- End All Courses -->

    <!-- Footer section -->
    <?php include 'partials/_footer.php'; ?>