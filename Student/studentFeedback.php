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
 }
//  on submit feedback
 if(isset($_REQUEST['addFeedbackBtn'])){
    if($_REQUEST['stu_feedback'] == ""){
        $msg = '<div class="alert alert-warning col-sm-6 mi-5 m-2" role="alert"> Fill All Fields</div>' ;
    }else{
        $stu_feedback = $_REQUEST['stu_feedback'];

        $sql= "INSERT INTO feedback (feedback_content , f_stu_id ) VALUES ('$stu_feedback','$stuId')";
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





<div class="content-admin col-sm-6  ml-sm-4  pt-5">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="student_id">Student Id</label>
            <input type="text" class="form-control" id="student_id" name="student_id"
                value="<?php if(isset($stuId)) echo $stuId; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="stu_feedback">Your Feedback</label>
            <textarea class="form-control" id="stu_feedback" name="stu_feedback" row="3"></textarea>
        </div>
        <div>
            <button type="submit" class="btn btn-success" id="addFeedbackBtn" name="addFeedbackBtn">Submit</button>
        </div>
        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>
</div>


<?php include '_stuFooter.php'; ?>