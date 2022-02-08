<?php
include '../partials/_dbconnect.php';
include '_headerAdmin.php'; 
    $adminEmail = $_SESSION['AdminEmail'];

    if(isset($_REQUEST['updatePassBtn'])){
        if($_REQUEST['admin_pass'] == ""){
            $msg = '<div class="alert alert-warning col-sm-6 mi-5 m-2"> Enter New Password</div>' ;
        }
        else {
            $sql = "SELECT * FROM admin WHERE admin_email=  '$adminEmail'";
            $result = mysqli_query($conn , $sql);
            $numRows = mysqli_num_rows($result);
            if($numRows == 1){
                $adminPass = $_REQUEST['admin_pass'];
                $sql = "UPDATE admin SET admin_pass = '$adminPass' WHERE admin_email = '$adminEmail'";
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

<div class="content-admin col-sm-6 jumbotron ml-4 mt-4 pt-5">
    <form action="" method="post" >
        <div class="form-group col-sm-7">
            <label for="admin_email">Email</label>
            <input type="text" class="form-control" id="admin_email" name="admin_email" value="<?php echo $adminEmail; ?>" readonly>
        </div>
        <div class="form-group col-sm-7">
            <label for="admin_pass">New Password</label>
            <input type="text" class="form-control" id="admin_pass" name="admin_pass" placeholder="New Password">
        </div>
        <div class="col-sm-7">
            <button type="submit" class="btn btn-success" id="updatePassBtn" name="updatePassBtn">Update</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
        <?php if(isset($msg)){
            echo $msg;
        } ?>
    </form>
</div>

</div>

<?php include '_footerAdmin.php'; ?>