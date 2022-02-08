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

    if(isset($_POST['cheackLog']) && isset($_POST['adminEmail']) && isset($_POST['adminPassword'])){
        $Admin_email = $_POST['adminEmail'];
        $Admin_pass = $_POST['adminPassword'];

        $sql = "SELECT * FROM `admin` WHERE admin_email ='$Admin_email'";
        $result = mysqli_query($conn , $sql);
        $numRows = mysqli_num_rows($result);
        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);
            if($row['admin_pass'] == $Admin_pass){
                // echo json_encode($numRows);
                
                $_SESSION['is_admin_login'] = true;
                $_SESSION['AdminEmail'] = $Admin_email;
                $_SESSION['AdminName'] = $row['admin_name'];
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