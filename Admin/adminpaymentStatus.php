<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

    include("../partials/_dbconnect.php");
	include '_headerAdmin.php'; 
	// following files need to be included
	require_once("../PaytmKit/lib/config_paytm.php");
	require_once("../PaytmKit/lib/encdec_paytm.php");

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


<div class="container">
    <h2 class="text-center my-4 d-print-none">Payment Status</h2>
    <form action="" method="post">
        <div class="form-group row offset-sm-3 d-print-none">
            <label for="" class="col-form-label">Order ID: </label>
            <div>
                <input id="ORDER_ID" class="form-control mx-3" tabindex="1" maxlength="20" size="20" name="ORDER_ID"
                    autocomplete="off" value="<?php echo $ORDER_ID ?>">
            </div>
            <div>
                <input type="submit" class="btn btn-primary mx-sm-4" value="View">
            </div>
        </div>
    </form>
    <?php
		if (isset($responseParamList) && count($responseParamList)>0 )
		{ 
		?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <h3 class="text-center py-3">Payment Receipt</h3>
                <div class="table-responsive">
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
                                <td><button type="button" class="btn-sm btn-primary d-print-none"
                                        onclick="javascript:window.print();">Print Reciept</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <?php
		}
		?>

</div>
<?php include '_footerAdmin.php'; ?>