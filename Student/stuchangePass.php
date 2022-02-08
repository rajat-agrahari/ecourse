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

 if(isset($_REQUEST['stuUpdpassBtn'])){
    if($_REQUEST['student_pass'] == ""){
        $msg = '<div class="alert alert-warning col-sm-6 mi-5 m-2"> Enter New Password</div>' ;
    }
    else {
        $sql = "SELECT * FROM student WHERE student_email =  '$stuEmail'";
        $result = mysqli_query($conn , $sql);
        $numRows = mysqli_num_rows($result);
        if($numRows == 1){
            $studentPass = $_REQUEST['student_pass'];
            $sql = "UPDATE student SET student_pass = '$studentPass' WHERE student_email = '$stuEmail'";
            $result = mysqli_query($conn , $sql);
                if($result == TRUE){
                    $msg = '<div class="alert alert-success col-sm-6 mi-5 m-2"> Change Password Successfully</div>' ;
                }
                else {
                    $msg = '<div class="alert alert-danger col-sm-6 mi-5 m-2"> Unable to change </div>' ;
                }
        }
    }
}

?>


<div class="content-student col-sm-6  ml-sm-4 mt-4 my-5 pt-5">
    <form action="" method="post" >
        <div class="form-group col-sm-7">
            <label for="student_email">Email</label>
            <input type="text" class="form-control" id="student_email" name="student_email" value="<?php echo $stuEmail; ?>" readonly>
        </div>
        <div class="form-group col-sm-7">
            <label for="student_pass">New Password</label>
            <input type="text" class="form-control" id="student_pass" name="student_pass" placeholder="New Password">
        </div>
        <div class="col-sm-7">
            <button type="submit" class="btn btn-success" id="stuUpdpassBtn" name="stuUpdpassBtn">Update</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>
</div>



<?php include '_stuFooter.php'; ?>