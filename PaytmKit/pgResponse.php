<?php
  session_start();

header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
  include '../partials/_dbconnect.php'; 


// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	// echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.

		if(isset($_POST['ORDERID']) && isset($_POST['TXNAMOUNT'])){
			$order_id = $_POST['ORDERID'];
			$stuEmail = $_GET['email'];
			$course_id = $_GET['courseid'];
			$status = $_POST['STATUS'];
			$respmsg = $_POST['RESPMSG'];
			$amount = $_POST['TXNAMOUNT'];
			$date = $_POST['TXNDATE'];
			$txn_id = $_POST['TXNID'];
			  
			  $txn_id= "TX".substr($txn_id,14,5)."LOP". rand(10000,999999);
			$sql = "INSERT INTO courseorder (order_id , txn_id, stu_email , course_id , status , respmsg , amount, order_date) VALUE ('$order_id' ,'$txn_id', '$stuEmail' , '$course_id' , '$status' , '$respmsg' , '$amount' , '$date')";
			$result = mysqli_query($conn , $sql);
			if($result == TRUE){
				echo "Redirecting to My Profile...........";
				echo "<script> setTimeout(()=>{
					window.location.href= '../Student/mycourse.php';
				}, 1500);  </script>";
			}
		}
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}

	// if (isset($_POST) && count($_POST)>0 )
	// { 
	// 	foreach($_POST as $paramName => $paramValue) {
	// 			echo "<br/>" . $paramName . " = " . $paramValue;
	// 	}
	// }
	

}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>