
<?php
// To connect database

$servername = "localhost";
$username = "root";
$password ="";
$database = "ecourse";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn){
    die("Fail to connect:" . mysqli_connect_error());
}
?>
<?php
// Check email already exist or not

if(isset($_POST['cheackEmail']) && isset($_POST['signupEmail'])){
    $stu_Email = $_POST['signupEmail'];
    $existsql = "SELECT * FROM `student` WHERE student_email ='$stu_Email'";
    $result = mysqli_query($conn , $existsql);
    $numRows = mysqli_num_rows($result);
    echo json_encode($numRows);
}



// Insert Signup data
if(isset($_POST['cheackSignup']) && isset($_POST['signupName']) && isset($_POST['signupEmail']) && isset($_POST['signupPassword'])){
    
    $stu_name = $_POST['signupName'];
    $stu_Email = $_POST['signupEmail'];
    $stu_Pass = $_POST['signupPassword'];
    
    $sql = "INSERT INTO `student` (`student_name`, `student_email`, `student_pass`, `student_occup`, `student_img` ) VALUES ('$stu_name', '$stu_Email', '$stu_Pass','','')";
    $result = mysqli_query($conn , $sql);
    // echo var_dump($result);
    if($result == TRUE){
        echo json_encode("ok");
    }
    else{
        echo json_encode("failed");
    }
}

?>