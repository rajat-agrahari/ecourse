<?php
 include '../partials/_dbconnect.php';
 include '_headerAdmin.php'; 
    // Update course

    if(isset($_REQUEST['update'])){
        // checking for empty fields
        if(($_REQUEST['student_id'] == "") || ($_REQUEST['student_name'] == "") || ($_REQUEST['student_email'] == "") || ($_REQUEST['student_pass'] == "") || ($_REQUEST['student_occup'] == "")){
         $msg = '<div class="alert alert-warning col-sm-6 mi-5 m-2"> Fill All Fields</div>' ;
        }
        else{
            $student_id = $_REQUEST['student_id'];
            $student_name = $_REQUEST['student_name'];
            $student_email = $_REQUEST['student_email'];
            $student_pass = $_REQUEST['student_pass'];
            $student_occup = $_REQUEST['student_occup'];
            

            $sql ="UPDATE  `student` SET `student_id` = '$student_id', `student_name` ='$student_name',  `student_email` = '$student_email' ,`student_pass` ='$student_pass' , `student_occup` = '$student_occup' WHERE student_id = '$student_id'";

            $result = mysqli_query($conn , $sql);
            if($result == TRUE){
                $msg = '<div class="alert alert-success col-sm-6 mi-5 m-2"> Student Details Updated Successfully</div>' ;
            }
            else {
                $msg = '<div class="alert alert-danger col-sm-6 mi-5 m-2"> Unable to update </div>' ;
            }
        }
    }

?>



<div class="content-admin col-sm-6 jumbotron ml-sm-4 mt-4 pt-5">
    <div class="container text-white">
        <h3 class="text-center text-dark pb-3"> Update Student Details</h3>
    </div>
    <?php
        // select data display in form
        if(isset($_REQUEST['edit'])){
            $sql = "SELECT * FROM `student` WHERE student_id = {$_REQUEST['editid']}";
            $result = mysqli_query($conn , $sql);
            $row = mysqli_fetch_assoc($result);
        }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="student_id">student Id</label>
            <input type="text" class="form-control" id="student_id" name="student_id"
                value="<?php if(isset($row['student_id'])) echo $row['student_id'] ?>" readonly>
        </div>
        <div class="form-group">
            <label for="student_name">student Name</label>
            <input type="text" class="form-control" id="student_name" name="student_name"
                value="<?php if(isset($row['student_name'])) echo $row['student_name'] ?>">
        </div>
        <div class="form-group">
            <label for="student_email">Email</label>
            <input type="text" class="form-control" id="student_email" name="student_email"
                value="<?php if(isset($row['student_email'])) echo $row['student_email'] ?>">
        </div>
        <div class="form-group">
            <label for="student_pass">Password</label>
            <input type="text" class="form-control" id="student_pass" name="student_pass"
                value="<?php if(isset($row['student_pass'])) echo $row['student_pass'] ?>">
        </div>
        <div class="form-group">
            <label for="student_occup">Occupation</label>
            <input type="text" class="form-control" id="student_occup" name="student_occup"
                value="<?php if(isset($row['student_occup'])) echo $row['student_occup'] ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" id="update" name="update">Update</button>
            <a href="student.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>
</div>



<?php include '_footerAdmin.php'; ?>