<?php 
    include_once '../partials/_dbconnect.php';

    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['is_login']) || $_SESSION['is_login']!=true){
    header("location:../index.php");
    exit;
    }

    $stuLogEmail = $_SESSION['stuLogEmail'];

    if(isset($stuLogEmail)){
        $sql = "SELECT student_img FROM student WHERE student_email = '$stuLogEmail'";
        $result = mysqli_query($conn , $sql);
        $row = mysqli_fetch_assoc($result);
        $stu_img = $row['student_img'];
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

    <!-- Student style sheet -->
    <link rel="stylesheet" href="../css/stuStyle.css">
    <title>eCourse - Welcome <?php echo $_SESSION['stuLogName']; ?> </title>
</head>

<body>
    <div class="container-fluid admin-head d-print-none">
        <h1>eCourse</h1>
        <h2>My Profile</h2>
    </div>

    <div class="row mx-0">
        <div class="slider-admin col-sm-2 pl-0 d-print-none">
            <ul>
                <li class="my-4"><img src="<?php echo $stu_img; ?>" alt="Student-image"
                        class="img-thumbnail rounded-circle"></li>
                <li><a href="studentProfile.php"><i class="fas fa-user"></i> Profile <span
                            class="sr-only">(current)</span></a></li>
                <li><a href="mycourse.php"><i class="fas fa-book-open"></i>My Courses</a></li>
                <li><a href="studentFeedback.php"><i class="fas fa-comments"></i> Feedback</a></li>
                <li><a href="stuchangePass.php"><i class="fas fa-key"></i> Change Password</a></li>
                <li>
                    <a href="../partials/_logout.php" class=""><i class="fas fa-sign-in-alt"></i>
                        Logout</a>
                </li>
            </ul>
        </div>