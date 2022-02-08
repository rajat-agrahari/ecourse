<?php
 include '_headerAdmin.php'; 
 include '../partials/_dbconnect.php';
    
    if(isset($_REQUEST['courseSubmitBtn'])){
        // checking for empty fields
        if(($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") || ($_REQUEST['course_author'] == "") || ($_REQUEST['course_duration'] == "") || ($_REQUEST['course_original_price'] == "") || ($_REQUEST['course_selling_price'] == "")){
         $msg = '<div class="alert alert-warning col-sm-6 mi-5 m-2"> Fill All Fields</div>' ;
        }
        else{
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

            $sql ="INSERT INTO `course` (`course_name`, `course_desc`, `course_author`, `course_img`, `course_duration`, `course_price`, `course_original_price`) VALUES ('$course_name', '$course_desc', '$course_author', '$img_folder', '$course_duration', '$course_selling_price', '$course_original_price')";

            $result = mysqli_query($conn , $sql);
            if($result == TRUE){
                $msg = '<div class="alert alert-success col-sm-6 mi-5 m-2"> Course Added Successfully</div>' ;
            }
            else {
                $msg = '<div class="alert alert-danger col-sm-6 mi-5 m-2"> Unable to add course</div>' ;
            }
        }
    }
 ?>

<div class="content-admin col-sm-6 jumbotron ml-sm--4 mt-4 pt-5">
    <div class="container text-white">
        <h3 class="text-center text-dark"> Add New Course</h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="course_name">Course Name</label>
            <input type="text" class="form-control" id="course_name" name="course_name">
        </div>
        <div class="form-group">
            <label for="course_desc">Course Description</label>
            <textarea class="form-control" id="course_desc" rows="2" name="course_desc"></textarea>
        </div>
        <div class="form-group">
            <label for="course_author">Author</label>
            <input type="text" class="form-control" id="course_author" name="course_author">
        </div>
        <div class="form-group">
            <label for="course_duration">Course Duration</label>
            <input type="text" class="form-control" id="course_duration" name="course_duration">
        </div>
        <div class="form-group">
            <label for="course_original_price">Course Original Price</label>
            <input type="text" class="form-control" id="course_original_price" name="course_original_price">
        </div>
        <div class="form-group">
            <label for="course_selling_price">Course Selling Price</label>
            <input type="text" class="form-control" id="course_selling_price" name="course_selling_price">
        </div>
        <div class="form-group">
            <label for="course_img">Course Image</label>
            <input type="file" class="form-control-file" id="course_img" name="course_img">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" id="courseSubmitBtn" name="courseSubmitBtn">Submit</button>
            <a href="courseAdmin.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>
</div>

</div>



<?php include '_footerAdmin.php'; ?>