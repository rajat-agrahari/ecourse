<?php
    include '_stuHeader.php';
    include_once '../partials/_dbconnect.php';
    if(isset($_SESSION['is_login'])){
        $stuEmail = $_SESSION['stuLogEmail'];
    }

    $sql = "SELECT * FROM student WHERE student_email = '$stuEmail'";
    $result = mysqli_query($conn , $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows == 1){
        $row = mysqli_fetch_assoc($result);
        $stuId = $row['student_id'];
        $stuName = $row['student_name'];
        $stuOcc = $row['student_occup'];
        $stuImg = $row['student_img'];
    }

    if(isset($_REQUEST['updateStuBttn'])){
        if($_REQUEST['student_name'] == ""){
            $msg = '<div class="alert alert-warning col-sm-6 mi-5 m-2" role="alert"> Fill All Fields</div>' ;
        }else{
            $stuName = $_REQUEST['student_name'];
            $stuOcc = $_REQUEST['student_occup'];

            $stu_img = $_FILES['stuImg']['name'];
            $stu_img_temp = $_FILES['stuImg']['tmp_name'];
            $img_folder = '../images/stuImage/'. $stu_img;
            move_uploaded_file($stu_img_temp , $img_folder);

            $sql= "UPDATE student SET student_name = '$stuName', student_occup = '$stuOcc' , student_img = '$img_folder' WHERE student_email = '$stuEmail'";
            $result = mysqli_query($conn , $sql);
            if($result == TRUE){
                $msg = '<div class="alert alert-success col-sm-6 mi-5 m-2"> Updated Successfully</div>' ;
            }
            else {
                $msg = '<div class="alert alert-danger col-sm-6 mi-5 m-2"> Unable to update</div>' ;
            }
        }
    }
?>



<div class="content-admin col-sm-6 jumbotron ml-sm-4  pt-5">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="student_id">Student Id</label>
            <input type="text" class="form-control" id="student_id" name="student_id"
                value="<?php if(isset($stuId)) echo $stuId; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="student_email">Email</label>
            <input type="text" class="form-control" id="student_email" name="student_email"
                value="<?php echo $stuEmail; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="student_name">Name</label>
            <input type="text" class="form-control" id="student_name" name="student_name"
                value="<?php if(isset($stuName)) echo $stuName; ?>">
        </div>
        <div class="form-group">
            <label for="student_occup">Occupation</label>
            <input type="text" class="form-control" id="student_occup" name="student_occup"
                value="<?php if(isset($stuOcc)) echo $stuOcc; ?>">
        </div>
        <div class="form-group">
            <label for="stuImg">Upload Image</label>
            <input type="File" class="form-control-file" id="stuImg" name="stuImg">
        </div>
        <div >
            <button type="submit" class="btn btn-success" id="updateStuBttn" name="updateStuBttn">Update</button>
        </div>
        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>
</div>





<?php include '_stuFooter.php'; ?>