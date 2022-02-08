<?php
 include '_headerAdmin.php'; 
 include '../partials/_dbconnect.php';
    
    if(isset($_REQUEST['studentSubmitBtn'])){
        // checking for empty fields
        if(($_REQUEST['student_name'] == "") || ($_REQUEST['student_email'] == "") || ($_REQUEST['student_pass'] == "") || ($_REQUEST['student_occup'] == "")){
         $msg = '<div class="alert alert-warning col-sm-6 mi-5 m-2"> Fill All Fields</div>' ;
        }
        else{
            $student_name = $_REQUEST['student_name'];
            $student_email = $_REQUEST['student_email'];
            $student_pass = $_REQUEST['student_pass'];
            $student_occup = $_REQUEST['student_occup'];
            

            $sql ="INSERT INTO `student` (`student_name`, `student_email`, `student_pass`,`student_occup`) VALUES ('$student_name', '$student_email', '$student_pass' ,'$student_occup')";

            $result = mysqli_query($conn , $sql);
            if($result == TRUE){
                $msg = '<div class="alert alert-success col-sm-6 mi-5 m-2"> New Student Added Successfully</div>' ;
            }
            else {
                $msg = '<div class="alert alert-danger col-sm-6 mi-5 m-2"> Unable to add new student</div>' ;
            }
        }
    }
 ?>

<div class="content-admin col-sm-6 jumbotron ml-sm-4 mt-4 pt-5">
    <div class="container text-white">
        <h3 class="text-center text-dark"> Add New Student</h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="student_name">student Name</label>
            <input type="text" class="form-control" id="student_name" name="student_name">
        </div>
        <div class="form-group">
            <label for="student_email">Email</label>
            <input type="text" class="form-control" id="student_email" name="student_email">
        </div>
        <div class="form-group">
            <label for="student_pass">Password</label>
            <input type="text" class="form-control" id="student_pass" name="student_pass">
        </div>
        <div class="form-group">
            <label for="student_occup">Occupation</label>
            <input type="text" class="form-control" id="student_occup" name="student_occup">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success" id="studentSubmitBtn" name="studentSubmitBtn">Submit</button>
            <a href="student.php" class="btn btn-secondary">Close</a>
        </div>
        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>
</div>

</div>



<?php include '_footerAdmin.php'; ?>