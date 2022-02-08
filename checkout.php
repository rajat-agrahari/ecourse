<?php
    include_once 'partials/_dbconnect.php';
    session_start();
   if(!isset($_SESSION['is_login'])){
    header("location:course.php?loghere=true");

   }else{
    header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");
    $stuEmail = $_SESSION['stuLogEmail'];
    $course_id = $_POST['course_id'];

    $sql = "SELECT * FROM `courseorder` WHERE course_id ='$course_id' AND stu_email='$stuEmail'";
    $result = mysqli_query($conn , $sql);
    $numRows = mysqli_num_rows($result);
        if($numRows != 0){
            header("location:course.php?alreadybuy=true");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="GENERATOR" content="Evrsoft First Page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Custom Css -->
    <link rel="stylesheet" href="css/style.css">
    <title>CheckOut</title>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-m-6 offset-sm-3 jumbotron">
                <h3 class="mb-5">Welcome to eCourse Payment Page</h3>
                <form action="./PaytmKit/pgRedirect.php" method="post">

                    <div class="form-group row">
                        <!-- <label for="STU_EMAIL" class="col-sm-4 col-form-label">Student Email</label> -->
                        <div class="col-sm-8">
                            <input id="STU_EMAIL" type="hidden" name="STU_EMAIL" autocomplete="off"
                                value="<?php if(isset($stuEmail)){ echo $stuEmail; } ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- <label for="COURSE_ID" class="col-sm-4 col-form-label">COURSE ID</label> -->
                        <div class="col-sm-8">
                            <input id="COURSE_ID" type="hidden" name="COURSE_ID" autocomplete="off"
                                value="<?php if(isset($_POST['course_id'])){ echo $course_id; } ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ORDER_ID" class="col-sm-4 col-form-label">Order ID</label>
                        <div class="col-sm-8">
                            <input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID"
                                autocomplete="off" value="<?php echo  "ORDS" . rand(10000,99999999)?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="CUST_ID" class="col-sm-4 col-form-label">Student Email</label>
                        <div class="col-sm-8">
                            <input id="CUST_ID" tabindex="2" name="CUST_ID" autocomplete="off"
                                value="<?php if(isset($stuEmail)) { echo $stuEmail; } ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="TXT_AMOUNT" class="col-sm-4 col-form-label">Amount</label>
                        <div class="col-sm-8">
                            <input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT"
                                value="<?php if(isset($_POST['price'])){ echo $_POST['price']; } ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- <label for="INDUSTRY_TYPE_ID" class="col-sm-4 col-form-label">INDUSTRY TYPE ID</label> -->
                        <div class="col-sm-8">
                            <input id="INDUSTRY_TYPE_ID" type="hidden" tabindex="4" maxlength="12" size="12"
                                name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- <label for="CHANNEL_ID" class="col-sm-4 col-form-label">CHANNEL_ID</label> -->
                        <div class="col-sm-8">
                            <input id="CHANNEL_ID" type="hidden" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID"
                                autocomplete="off" value="WEB" readonly>
                        </div>
                    </div>
                    <div class="text-center">
                        <input value="Payment" type="submit" class="btn btn-primary" onclick=""><a href="./course.php"
                            class="btn btn-secondary ml-2">Cancel</a>
                    </div>
                </form>
                <small class="form-text text-muted">Note: Complete Payment by Clicking Payment Button</small>
            </div>
        </div>
    </div>

</body>

</html>




<?php
   }
?>