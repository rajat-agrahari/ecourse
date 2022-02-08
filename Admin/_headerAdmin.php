<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['is_admin_login']) || $_SESSION['is_admin_login']!=true){
    header("location:../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon link -->
    <link rel="shortcut icon" type="images/png" href="../images/favicon.png">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Font Awesome css -->
    <link rel="stylesheet" href="../css/all.min.css">

    <!-- Custom Css -->
    <link rel="stylesheet" href="../css/custom.css">

    <!-- Admin style sheet -->
    <link rel="stylesheet" href="../css/adminStyle.css">

    <title class="d-print-none">eCourse - Dashboard </title>
    <!-- <style>

    .slider-admin ul li  .active{
        background: #131360;
        color: #fff;
    } 
    </style> -->
</head>

<body>
    <div class="container-fluid admin-head d-print-none">
        <h1>eCourse</h1>
        <h2>Admin Pannel</h2>
    </div>

    <div class="row mx-0">
        <div class="slider-admin col-md-2 pl-0 d-print-none">
            <ul id="myuli">
                <li class="mt-4"><a href="adminDashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="courseAdmin.php"><i class="fas fa-book-open"></i> Courses</a></li>
                <li><a href="lesson.php"><i class="fas fa-book-reader"></i> Lesson</a></li>
                <li><a href="student.php"><i class="fas fa-users"></i> Student</a></li>
                <li><a href="sellReport.php"><i class="fas fa-th-list"></i> Sell Report</a></li>
                <li><a href="adminpaymentStatus.php"><i class="fas fa-file-invoice"></i> Payment Status</a></li>
                <li><a href="feedbackAdmin.php"><i class="fas fa-comments"></i> Feedback</a></li>
                <li><a href="adminchangePass.php"><i class="fas fa-key"></i> Change Password</a></li>
                <li>
                    <a href="../partials/_logout.php"><i class="fas fa-sign-in-alt"></i>
                        Logout</a>
                </li>
            </ul>
        </div>