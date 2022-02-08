<?php
     include_once '../partials/_dbconnect.php';
     session_start();
    if(!isset($_SESSION['is_login'])){
     header("location:../course.php?afterbuy=true");
     exit;
    }
    if(isset($_SESSION['is_login'])){
        $stuLogEmail = $_SESSION['stuLogEmail'];
    }
    include '_stuHeader.php';
    $checkcourse =true; 
?>
<div class="bg-light mb-3 col-sm-10">
    <h3 class="text-center pt-3">All Courses</h3>
    <?php
    if(isset($stuLogEmail)){
        $sql= "SELECT co.order_id, c.course_id , c.course_name, c.course_duration ,c.course_desc, c.course_img, c.course_author, c.course_original_price, c.course_price FROM courseorder As co JOIN course As c ON c.course_id = co.course_id WHERE co.stu_email = '$stuLogEmail'";
        $result = mysqli_query($conn , $sql);
        $numRows = mysqli_num_rows($result);
        if($numRows > 0){
            while ($row = mysqli_fetch_assoc($result)) { 
            $checkcourse =false;
             ?>
    <h5 class="card-header course-title-h5" style="font-size:1.6rem; padding-left:13%; padding-top:3%">
        <?php echo $row['course_name'] ?></h5>
    <div class="row py-4 justify-content-center">
        <div class="col-sm-3">
            <img src="<?php echo $row['course_img']; ?>" width="300px" height="165" alt="Image">
        </div>
        <div class="col-sm-6">
            <div class="card-body pt-0">
                <p class="card-text"> <?php echo $row['course_desc']; ?></p>
                <p class="card-text">Duration : <?php echo $row['course_duration']; ?></p>
                <p class="card-text">Instrructor : <?php echo $row['course_author']; ?></p>
                <p class="card-text d-inline">
                    Price: <small><del> &#8377 <?php echo $row['course_original_price']; ?></del></small>
                    <span class="font-weight-bolder"> &#8377 <?php echo $row['course_price']; ?></span>
                </p>
                <a href="watchcourse.php?course_id=<?php echo $row['course_id'] ?>"
                    class="btn btn-primary mt-5 float-right">Watch Course</a>
            </div>
        </div>
    </div>
    <?php            
    }
  }
}
if($checkcourse == true){
    echo'<div class="alert alert-dark col-sm-6 text-center offset-sm-3" role="alert">
        You have not buy any course.
    </div>';
}
?>
</div>
</div>
<?php include '_stuFooter.php'; ?>