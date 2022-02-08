<?php
 include '_headerAdmin.php'; 
 include '../partials/_dbconnect.php';
    // Update course

    if(isset($_REQUEST['update'])){
        // checking for empty fields
        if(($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") || ($_REQUEST['course_author'] == "") || ($_REQUEST['course_duration'] == "") || ($_REQUEST['course_original_price'] == "") || ($_REQUEST['course_selling_price'] == "")){
         $msg = '<div class="alert alert-warning col-sm-6 mi-5 m-2"> Fill All Fields</div>' ;
        }
        else{
            $course_id = $_REQUEST['course_id'];
            $course_name = $_REQUEST['course_name'];
            $course_desc = $_REQUEST['course_desc'];
            $course_author = $_REQUEST['course_author'];
            $course_duration = $_REQUEST['course_duration'];
            $course_selling_price = $_REQUEST['course_selling_price'];
            $course_original_price = $_REQUEST['course_original_price'];

            $course_img = $_FILES['course_img']['name'];
            $course_img_temp = $_FILES['course_img']['tmp_name'];
            $img_folder = '../images/'. $course_img;
            move_uploaded_file($course_img_temp , $img_folder);

            $sql ="UPDATE  `course` SET `course_id` = '$course_id', `course_name` ='$course_name', `course_desc` = '$course_desc', `course_author` = '$course_author' , `course_img`='$img_folder' , `course_duration` ='$course_duration' , `course_price` = '$course_selling_price', `course_original_price` = '$course_original_price' WHERE course_id = '$course_id'";

            $result = mysqli_query($conn , $sql);
            if($result == TRUE){
                $msg = '<div class="alert alert-success col-sm-6 mi-5 m-2"> Course Updated Successfully</div>' ;
            }
            else {
                $msg = '<div class="alert alert-danger col-sm-6 mi-5 m-2"> Unable to add course</div>' ;
            }
        }
    }

?>



<div class="content-admin col-sm-6 jumbotron ml-sm-4 mt-4 pt-5">
    <div class="container text-white">
        <h3 class="text-center text-dark"> Update Course</h3>
    </div>
    <?php
        // select data display in form
        if(isset($_REQUEST['edit'])){
            $sql = "SELECT * FROM `course` WHERE course_id = {$_REQUEST['editid']}";
            $result = mysqli_query($conn , $sql);
            $row = mysqli_fetch_assoc($result);
        }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course_id">Course ID</label>
            <input type="text" class="form-control" id="course_id" name="course_id"
                value="<?php if(isset($row['course_id'])){ echo $row['course_id'];} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name"
                value="<?php if(isset($row['course_name'])){ echo $row['course_name'];} ?>">
        </div>
        <div class="form-group">
            <label for="course_desc">Course Description</label>
            <textarea class="form-control" id="course_desc" rows="2"
                name="course_desc"><?php if(isset($row['course_desc'])){ echo $row['course_desc'];} ?></textarea>
        </div>
        <div class="form-group">
            <label for="course_author">Author</label>
            <input type="text" class="form-control" id="course_author" name="course_author"
                value="<?php if(isset($row['course_author'])){ echo $row['course_author'];} ?>">
        </div>
        <div class="form-group">
            <label for="course_duration">Course Duration</label>
            <input type="text" class="form-control" id="course_duration" name="course_duration"
                value="<?php if(isset($row['course_duration'])){ echo $row['course_duration'];} ?>">
        </div>
        <div class="form-group">
            <label for="course_original_price">Course Original Price</label>
            <input type="text" class="form-control" id="course_original_price" name="course_original_price"
                value="<?php if(isset($row['course_original_price'])){ echo $row['course_original_price'];} ?>">
        </div>
        <div class="form-group">
            <label for="course_selling_price">Course Selling Price</label>
            <input type="text" class="form-control" id="course_selling_price" name="course_selling_price"
                value="<?php if(isset($row['course_price'])){ echo $row['course_price'];} ?>">
        </div>
        <div class="form-group">
            <label for="course_img">Course Image</label>
            <img src="<?php if(isset($row['course_img'])){ echo $row['course_img'];} ?>" alt="" class="img-thumbnail">
            <input type="file" class="form-control-file" id="course_img" name="course_img">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" id="update" name="update">Update</button>
            <a href="courseAdmin.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>
</div>



<?php include '_footerAdmin.php'; 