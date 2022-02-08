<?php    
session_start();
include_once 'partials/_dbconnect.php'; ?>

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
    <?php include 'partials/_header.php'; ?>
    <!-- img backgroung -->
    <div class="container-fluid px-0 py-0">
        <img src="images/18.jpg" class="img-bg" alt="">
    </div>

    <!-- Course details -->
    <div class="container my-4 pt-5">
        <div class="row">
            <?php 
                if(isset($_GET['course_id'])){
                    $course_id = $_GET['course_id'];
                    $_SESSION['course_id']= $course_id;
                    $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
                    $result = mysqli_query($conn , $sql);
                    $row = mysqli_fetch_assoc($result);
                }
            ?>
            <div class="col-sm-4">
                <img src="<?php echo str_replace('..','.' ,$row['course_img']) ?>" width="300px" alt="Image">
            </div>
            <div class="col-sm-8">
                <div class="card-body pt-0">
                    <h5 class="card-title">Course Name : <?php echo $row['course_name'] ?></h5>
                    <p class="card-text">Description : <?php echo $row['course_desc']; ?></p>
                    <p class="card-text">Duration : <?php echo $row['course_duration']; ?></p>
                    <form action="checkout.php" method="post">
                        <p class="card-text d-inline">
                            Price: <small><del> &#8377 <?php echo $row['course_original_price']; ?></del></small>
                            <span class="font-weight-bolder"> &#8377 <?php echo $row['course_price']; ?></span>
                        </p>
                        <input type="hidden" name="price" value="<?php echo $row['course_price']; ?>">
                        <input type="hidden" name="course_id" value="<?php echo $row['course_id']; ?>">
                        <button type="submit" class="btn btn-primary text-white font-weight-bolder float-right"
                            name="buy">Buy Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col-4">Lesson No.</th>
                        <th scope="col-8">Lesson Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $count=1;
                    $sql = "SELECT * FROM lesson WHERE lesson_course_id = '$course_id'";
                    $result = mysqli_query($conn , $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                        <th scope="row">'.$count.'</th>
                        <td>'.$row['lesson_name'].'</td>
                    </tr>';
                    $count++;
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer section -->
    <?php include 'partials/_footer.php'; ?>