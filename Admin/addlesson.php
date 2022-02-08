
<?php
include '../partials/_dbconnect.php';
include '_headerAdmin.php'; 

if(isset($_REQUEST['lessonSubmiBtn'])){
    // checking for empty fields
    if(($_REQUEST['lesson_name'] == "") || ($_REQUEST['lesson_desc'] == "") || ($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "")){
     $msg = '<div class="alert alert-warning col-sm-6 mi-5 m-2"> Fill All Fields</div>' ;
    }
    else{
        $lesson_name = $_REQUEST['lesson_name'];
        $lesson_desc = $_REQUEST['lesson_desc'];
        $course_id = $_REQUEST['course_id'];
        $course_name = $_REQUEST['course_name'];

        $lesson_link = $_FILES['lesson_link']['name'];
        $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
        $link_folder = '../video/lessonvid/'. $lesson_link;
        move_uploaded_file($lesson_link_temp , $link_folder);

        $sql ="INSERT INTO `lesson` (`lesson_name`, `lesson_desc`, `lesson_link`, `lesson_course_id`, `lesson_course_name`) VALUES ('$lesson_name', '$lesson_desc', '$link_folder', '$course_id', '$course_name')";

        $result = mysqli_query($conn , $sql);
        if($result == TRUE){
            $msg = '<div class="alert alert-success col-sm-6 ml-5 m-2"> Lesson Added Successfully</div>' ;
        }
        else {
            $msg = '<div class="alert alert-danger col-sm-6 ml-5 m-2"> Unable to add lesson</div>' ;
        }
    }
}

?>

<div class="col-sm-6 mt-5 mx-sm-3 jumbotron">
    <h3 class="text-center">Add New Lesson</h3>

    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course_id">Course ID</label>
            <input type="text" class="form-control" id="course_id" name="course_id"
                value="<?php if(isset($_SESSION['course_id'])){ echo $_SESSION['course_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name"
                value="<?php if(isset($_SESSION['course_name'])){ echo $_SESSION['course_name'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="lesson_name">Lesson Name</label>
            <input type="text" class="form-control" id="lesson_name" name="lesson_name">
        </div>
        <div class="form-group">
            <label for="lesson_desc">Lesson Description</label>
            <textarea class="form-control" id="lesson_desc" rows="2" name="lesson_desc"></textarea>
        </div>
        <div class="form-group">
            <label for="lesson_link">Lesson Video link</label>
            <input type="FILE" class="form-control-file" id="lesson_link" name="lesson_link">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" id="lessonSubmiBtn" name="lessonSubmiBtn">Submit</button>
            <a href="lesson.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>
</div>



<?php include '_footerAdmin.php'; ?>