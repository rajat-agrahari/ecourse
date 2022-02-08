<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

    include("./partials/_dbconnect.php");
	// following files need to be included
	require_once("./PaytmKit/lib/config_paytm.php");
	require_once("./PaytmKit/lib/encdec_paytm.php");

	$ORDER_ID = "";
	$requestParamList = array();
	$responseParamList = array();

	if (isset($_POST["ORDER_ID"]) && $_POST["ORDER_ID"] != "") {

		// In Test Page, we are taking parameters from POST request. In actual implementation these can be collected from session or DB. 
		$ORDER_ID = $_POST["ORDER_ID"];

		// Create an array having all required parameters for status query.
		$requestParamList = array("MID" => PAYTM_MERCHANT_MID , "ORDERID" => $ORDER_ID);  
		
		$StatusCheckSum = getChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY);
		
		$requestParamList['CHECKSUMHASH'] = $StatusCheckSum;

		// Call the PG's getTxnStatusNew() function for verifying the transaction status.
		$responseParamList = getTxnStatusNew($requestParamList);
	}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon link -->
    <link rel="shortcut icon" type="images/png" href="images/favicon.png">
    
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Font Awesome css -->
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Custom Css -->
    <link rel="stylesheet" href="css/style.css">
    <title>eCourses -All Courses</title>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <!-- img backgroung -->
    <div class="container-fluid px-0 py-0 d-print-none">
        <img src="images/18.jpg" class="img-bg" alt="Banner image">
    </div>

    <!-- Payment status -->
    <div class="container my-4">
        <h2 class="text-center pb-3 d-print-none"> Payment status</h2>
        <form action="" method="post">
            <div class="row payment-row d-print-none">
                <div class="col-4-auto mx-0">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Order Id</div>
                        </div>
                        <input id="ORDER_ID" class="form-control mx-3" tabindex="1" maxlength="20" size="20"
                            name="ORDER_ID" placeholder="Enter Your Order Id" autocomplete="off"
                            value="<?php echo $ORDER_ID ?>">
                    </div>
                </div>
                <div class="col-1-auto d-inline mx-0">
                    <button type="submit" class="btn btn-primary mb-2">View</button>
                </div>
            </div>
        </form>
        <?php
		if (isset($responseParamList) && count($responseParamList)>0 )
		{ 
		?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto table-responsive">
                    <h3 class="text-center py-3">Payment Receipt</h3>
                    <table class="table table-bordered">
                        <tbody>
                            <?php
					foreach($responseParamList as $paramName => $paramValue) {
				            ?>
                            <tr>
                                <td><label><?php echo $paramName?></label></td>
                                <td><?php echo $paramValue?></td>
                            </tr>
                            <?php
					        }
				            ?>
                            <tr>
                                <td><button type="button" class="btn btn-primary d-print-none"
                                        onclick="javascript:window.print();">Print Reciept</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <?php
		}
		?>
    </div>




    <!-- Contact section -->
    <?php include 'contact.php'; ?>

    <!-- Footer section -->
    <?php include 'partials/_footer.php'; ?>