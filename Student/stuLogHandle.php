<?php
if(!isset($_SESSION)){
    session_start();
}
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
// include_once 'partials/_dbconnect.php';

    if(isset($_POST['cheackLog']) && isset($_POST['stuLoginEmail']) && isset($_POST['stuLoginPassword'])){
        $stuLog_email = $_POST['stuLoginEmail'];
        $stuLog_pass = $_POST['stuLoginPassword'];

        $sql = "SELECT * FROM `student` WHERE student_email ='$stuLog_email'";
        $result = mysqli_query($conn , $sql);
        $numRows = mysqli_num_rows($result);
        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);
            if($row['student_pass'] == $stuLog_pass){
                // echo json_encode($numRows);
                
                $_SESSION['is_login'] = true;
                $_SESSION['stuLogEmail'] = $stuLog_email;
                $_SESSION['stuLogName'] = $row['student_name'];
                echo json_encode("valid email password");
            }
            else{
                echo json_encode("password do not match");
                // echo json_encode($numRows);
            }
        }
        else{
            echo json_encode("Invalid email");
            // echo json_encode($numRows);
        }

    }

?>