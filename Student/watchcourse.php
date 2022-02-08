<?php
     include_once '../partials/_dbconnect.php';
     session_start();
    if(!isset($_SESSION['is_login'])){
     header("location:../course.php");
     exit;
    }
    if(isset($_SESSION['is_login'])){
        $stuLogEmail = $_SESSION['stuLogEmail'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Student style sheet -->
    <link rel="stylesheet" href="../css/stuStyle.css">
    <title>Watch course</title>
</head>

<body>
    <div class="container-fluid bg-success p-2">
        <h3>Welcome to eCourse</h3>
        <a href="./mycourse.php" class="btn btn-danger">My Courses</a>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 border-right">
                <h4 class="text-center py-2">Lesson</h4>
                <ul id="playlist" class="nav flex-column">
                    <?php
                        if(isset($_GET['course_id'])){
                            $course_id = $_GET['course_id'];
                            $sql = "SELECT * FROM lesson WHERE lesson_course_id = '$course_id'";
                            $result = mysqli_query($conn , $sql);
                            $numRows = mysqli_num_rows($result);
                            if($numRows > 0){
                                while ($row = mysqli_fetch_assoc($result)) { 
                                    echo '<li class="nav-item border-bottom py-2" movieurl='.$row['lesson_link'].'  style="cursor:pointer;">'.$row['lesson_name'].'</li>';
                                }
                            }
                        }
                    ?>
                </ul>
            </div>
            <div class="col-sm-8">
                <video id="videoarea" src="" class="mt-5 w-75 ml-4" controls></video>
            </div>
        </div>
    </div>

    
    <!-- Jquery and Bootstrap file link -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.mim.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <!-- Font asweome js -->
    <script src="../js/all.min.js"></script>

    <script src="../js/custom.js"></script>
</body>
</html>