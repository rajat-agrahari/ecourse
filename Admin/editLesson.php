<?php
 include '../partials/_dbconnect.php';
 include '_headerAdmin.php'; 
    // Update course

    if(isset($_REQUEST['lessonUpdateBtn'])){
        // checking for empty fields
        if(($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "") || ($_REQUEST['lesson_name'] == "") || ($_REQUEST['lesson_desc'] == "")){
         $msg = '<div class="alert alert-warning col-sm-6 mi-5 m-2"> Fill All Fields</div>' ;
        }
        else{
            $course_id = $_REQUEST['course_id'];
            $course_name = $_REQUEST['course_name'];
            $lesson_id = $_REQUEST['lesson_id'];
            $lesson_name = $_REQUEST['lesson_name'];
            $lesson_desc = $_REQUEST['lesson_desc'];
            
            $lesson_link = $_FILES['lesson_link']['name'];
            $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
            $link_folder = '../video/lessonvid/'. $lesson_link;
            move_uploaded_file($lesson_link_temp , $link_folder);

            $sql ="UPDATE  `lesson` SET `lesson_id` = '$lesson_id', `lesson_name` ='$lesson_name',  `lesson_desc` = '$lesson_desc' ,`lesson_link` ='$link_folder' , `lesson_course_id` = '$course_id' , `lesson_course_name` = '$course_name' WHERE lesson_id = '$lesson_id'";

            $result = mysqli_query($conn , $sql);
            if($result == TRUE){
                $msg = '<div class="alert alert-success col-sm-6 mi-5 m-2"> Lesson Details Updated Successfully</div>' ;
            }
            else {
                $msg = '<div class="alert alert-danger col-sm-6 mi-5 m-2"> Unable to update </div>' ;
            }
        }
    }

?>

<div class="content-admin col-sm-6 jumbotron ml-sm-4 mt-4 pt-5">
    <div class="container text-white">
        <h3 class="text-center text-dark"> Update Lesson</h3>
    </div>
    <?php
        // select data display in form
        if(isset($_REQUEST['edit'])){
            $sql = "SELECT * FROM `lesson` WHERE lesson_id = {$_REQUEST['editid']}";
            $result = mysqli_query($conn , $sql);
            $row = mysqli_fetch_assoc($result);
        }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course_id">Course ID</label>
            <input type="text" class="form-control" id="course_id" name="course_id"
                value="<?php if(isset($row['lesson_course_id'])){ echo $row['lesson_course_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name"
                value="<?php if(isset($row['lesson_course_name'])){ echo $row['lesson_course_name'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="lesson_id">Lesson ID</label>
            <input type="text" class="form-control" id="lesson_id" name="lesson_id"
                value="<?php if(isset($row['lesson_id'])){ echo $row['lesson_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="lesson_name">Lesson Name</label>
            <input type="text" class="form-control" id="lesson_name" name="lesson_name"
                value="<?php if(isset($row['lesson_name'])){ echo $row['lesson_name'];} ?>">
        </div>
        <div class="form-group">
            <label for="lesson_desc">Lesson Description</label>
            <textarea class="form-control" id="lesson_desc" rows="2"
                name="lesson_desc"><?php if(isset($row['lesson_desc'])){ echo $row['lesson_desc'];} ?></textarea>
        </div>
        <div class="form-group">
            <label for="lesson_link">Lesson Video link</label>
            <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="<?php if(isset($row['lesson_link'])){ echo $row['lesson_link'];} ?>" allowfullscreen></iframe>
            </div>
            <input type="FILE" class="form-control-file" id="lesson_link" name="lesson_link">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" id="lessonUpdateBtn" name="lessonUpdateBtn">Update</button>
            <a href="lesson.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>
</div>



<?php include '_footerAdmin.php'; ?>