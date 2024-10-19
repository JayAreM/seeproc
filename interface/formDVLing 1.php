<?php
	session_start();

	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('../../citydoc2023/interface/login.php','_self')</script>";
		echo $link;
	}
	
	
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	
	
	
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);

	$sql = "SELECT * FROM vouchercurrent WHERE TrackingNumber = '".$trackingNumber."'";
	$record = $database->query($sql);
	$count = $database->num_rows($record);

	if($count > 0) {
		$acct = $_SESSION['accountType'];	
		$logOffice = $_SESSION['officeCode'];
		$m1 = strrev(substr($trackingNumber,0,2));
		$year = "2023";
		$charges = '<span style = "font-weight:bold;font-size:12px;">Chges: </span>';

		$office = "";
		$trackingType = "";
		$claimant = ""; 
		$periodMonth = "";
		$fundType = "";
		$fund = "";
		$amount = 0;
		$year = "";
		$periodYear = "";
		$netAmount = 0;
		$adv = "";
		$docType = "";

		$gross = 0;

		$obrParent = "";
		$categoryCode = "";
		$poNumber = "";
		$progCodes = "";
		$arrProg = [];
		while($data = $database->fetch_array($record)){
			$fundYear = $data['FundYear'];
			$program = $data['PR_ProgramCode'];
			$categoryCode = $data['PR_CategoryCode'];
			$obrParent = $data['OBR_Number'];
			$poNumber = $data['PO_Number'];
			$pxAmount = $data['Amount'];

			$office = $data['Office'];
			$trackingType = $data['TrackingType'];
			$claimant = $data['Claimant']; 
			$periodMonth = $data['PeriodMonth'];
			$fundType = $data['Fund'];
			$fund = $data['Fund'];
			$amount = $data['Amount'];
			$year = $data['Year'];
			$periodYear = $data['Year'];
			$netAmount = 0;
			$adv = $data['ADV1'];
			$docType = $data['DocumentType'];

			$gross += $amount;

			$charges = $fundYear .'*'. $program .'*'. $pxAmount;
			$progCodes .= ",'".$program."'";

			array_push($arrProg,$charges);
		}

		$a = array_unique($arrProg);
		$charges ='';
		for($i = 0 ; $i < sizeof($a); $i++){
			$arr = explode('*', $arrProg[$i]);
			$fundYear =  $arr[0];
			$program = $arr[1];
			$pxAmount = $arr[2];
			$charges .= ", ".$program." : ".$pxAmount;
		}
		$charges = substr($charges,1);

		$m2 = strrev(substr($claimant,1,3));

		if($adv == 0 || $adv == 99999){
			$adv = '&nbsp;&nbsp;&nbsp;&nbsp;';
		}

		if( strtoupper($fund) == "GENERAL FUND"){
			$fund = "<span style = 'font-family:impact;font-size:36px;'>GEN FUND</span><br/><span style = 'font-family:helvetica;font-weight:bold;'>100</span> <span style = 'font-family:helvetica'>" . $year . "</span>";
		}
		if(strtoupper($fund) == "SEF"){
			$fund = "<span style = 'font-family:impact;font-size:48px;'>SEF</span><br/><span style = 'font-family:helvetica;font-weight:bold;'>200</span> <span style = 'font-family:helvetica'>" . $year . "</span>";
		}
		if(strtoupper($fund) == "TRUST FUND"){
			$fund = "<span style = 'font-family:impact;font-size:30px;'>TRUST FUND</span><br/><span style = 'font-family:helvetica;font-weight:bold;'>300</span> <span style = 'font-family:helvetica'>" . $year . "</span>";
		}

		$sql = "SELECT Name FROM office WHERE Code = '" . $office . "' LIMIT 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$officeName = $data['Name'];

		$sql = "SELECT * FROM claimant WHERE Name = '".addslashes($claimant)."' LIMIT 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$oneTax = $data['OneTax'];

		$sql = "SELECT Address FROM supplier.supplierinfo WHERE Name = '" . addslashes($claimant) . "' LIMIT 1";
		$record = $database->query($sql);
		if($database->num_rows($record) > 0) {
			$data = $database->fetch_array($record);
			$address = $data['Address'];
		}else {
			$address = "";
		}

		// $sql = "SELECT * FROM pxvouchertax WHERE TrackingNumber = '".$trackingNumber."'";
		$sql = "SELECT * FROM supplier.vouchers WHERE Year = '".$year."' AND TrackingNumber = '".$trackingNumber."'";
		$record = $database->query($sql);

		$taxes = "";
		$amount = 0;
		$baseAmount = 0;
		$liquidatedDamages = 0;
		$retention = 0;
		$netAmount = 0;
		$adjustmentLabel = '';
		$adjustmentType = '';
		$adjustmentAmount = 0;
		$totalTax = 0;
		$receiptType = "";
		while ($data = $database->fetch_array($record)) {
			$amount = $data['Amount'];
			$baseAmount = $data['BaseAmount'];
			$liquidatedDamages = $data['LiquidatedDamages'];
			$retention = $data['Retention'];
			$netAmount = $data['NetAmount'];
			$adjustmentLabel = $data['AdjustmentLabel'];
			$adjustmentType = $data['AdjustmentType'];
			$adjustmentAmount = $data['AdjustmentAmount'];
			$receiptType = $data['ReceiptType'];

			$percentage = intval($data['Percentage']);
			if(is_numeric( $percentage ) && floor( $percentage ) != $percentage) {
				$percentage = $data['Percentage'];
			}

			$percentageAmount = $data['PercentageAmount'];
			$codeType = $data['CodeType'];
			$specifics = $data['Specifics'];

			if($codeType == 'Expanded') {
				$codeType = 'EXP';
			}

			// $compBase = number_format( ($baseAmount / 1.12) , 2 );
			// $compDisp = number_format($baseAmount, 2)." / 1.12 (<strong>".$compBase."</strong>) &#10006; ".$percentage."%";

			$compBase = number_format( ($amount / 1.12) , 2 );
			$compDisp = number_format($amount, 2)." / 1.12 (<strong>".$compBase."</strong>) &#10006; ".$percentage."%";
			
			if($specifics == 'Agricultural Products') {
				$compDisp = "AGRI (<strong>".number_format($baseAmount, 2)."</strong>) &#10006; ".$percentage."%";
			}

			if($receiptType == 'NON-VAT') {
				$compDisp = "(<strong>".number_format($baseAmount, 2)."</strong>) &#10006; ".$percentage."%";
			}

			$taxes .= "	<tr>
							<td style='padding-right:5px;'>".$codeType."</td>
							<td style='padding-right:5px;'>".$compDisp."</td>
							<td style='text-align:right; padding:0px 95px 0px 5px;'>".number_format($percentageAmount, 2)."</td>
						</tr>";

			$totalTax += $percentageAmount;
		}

		$recTypeLabel = "<span style='margin-left:5px;'>(".$receiptType.")</span>";

		$notax = "";
		$hideNoTax = "";
		$noTaxGross = 0;
		$noTaxNet = 0;
		if($oneTax == 2) {
			$taxes = "";
			$notax = "<span style='margin-left:5px;'>(TAX EXEMPT)</span>";
			$recTypeLabel = "";
			$hideNoTax = "display:none;";
			$noTaxGross = $gross;
			$noTaxNet = $gross;
		}

		$adjustmentDetails = "";

		if($adjustmentType != "") {

			if($adjustmentType == 'Add') {
				// $currentBalance = ($grossWLD - $totalTax) - $retention;
				$currentBalance = ($gross - $totalTax) - $retention;
				
				$adjSign = "ADD";
				$adjustmentDetails = "	<tr>
											<td colspan='2' style='text-align:right; padding:0px 5px 0px 0px;'>Current Balance</td>
											<td style='text-align:right; padding-left:8px; padding-right:3px; border-top:1px solid black; font-weight:bold;'>".number_format($currentBalance, 2)."</td>
										</tr>
										<tr>
											<td colspan='2' style='text-align:right; padding:5px 5px 0px 0px;'><span style='font-weight:bold; font-size:10px;'>".$adjSign." :</span> ".$adjustmentLabel."</td>
											<td style='text-align:right; padding:5px 3px 0px 8px;'>".number_format($adjustmentAmount, 2)."</td>
										</tr>";
			}else {
				$adjSign = "LESS";
				$adjustmentDetails = "	<tr>
											<td colspan='2' style='text-align:right; padding:5px 5px 0px 0px;'><span style='font-weight:bold; font-size:10px;'>".$adjSign." :</span> ".$adjustmentLabel."</td>
											<td style='text-align:right; padding:5px 3px 0px 8px;'>".number_format($adjustmentAmount, 2)."</td>
										</tr>";
			}
			
		}
		
		unset($record);

		$liquidatedDamages = 0;

		$sql = "SELECT count(Id) as cnt FROM citydoc2023.listattachments WHERE TrackingNumber = '".$trackingNumber."'";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$beneficiaries = $data['cnt'];

		unset($record);

		$partType = "medical";
		if($docType == 'ASSISTANCE - FUNERAL') {
			$partType = "funeral";
		}

		$particulars = "To payment of ".$partType." expenses of the following beneficiaries of the City Mayor's Office, as per supporting papers hereto attached.";

		$sql = "SELECT * FROM listattachments WHERE TrackingNumber = '" . $trackingNumber  . "' ORDER BY Name ASC";
		$record = $database->query($sql);

		$names = "<br><br>Please see the list of ".$beneficiaries." names of beneficiaries attached.";
		if($database->num_rows($record) <= 5) {
			$names = "<br><br>
					  <table border='0' cellpadding='0' style='border-collapse:collapse; font-size:12px;'>
						<tr>
							<td style='padding:1px 5px 3px 5px;'>RAF</td>
							<td style='padding:1px 5px 3px 5px; text-align:right;'>AMOUNT</td>
							<td style='padding:1px 5px 3px 5px;'>NAME</td>
						</tr>
						<tr>
							<td colspan='3' style='border-top:1px dashed black; padding-bottom:3px;'></td>
						</tr>";
			while($data = $database->fetch_array($record)){
				$raf = $data["RAF"];
				$name = utf8_decode($data["Name"]);
				$amountLingap = number_format($data['Amount'],2);
				$row = $data['Rows'];

				$names .= "	<tr>
								<td style='padding:1px 5px;'>".$raf."</td>
								<td style='padding:1px 5px;'>".$amountLingap."</td>
								<td style='padding:1px 5px;'>".$name."</td>
							</tr>";
			}
			$names .= "</table>";
		}

		$particulars .= $names;
	}
	
?>

<style>
	
	#tableMainForm{
		margin:0 auto;
		width:700px;
		border-spacing:0;
		border:2px solid black;
		//font-family:Oswald;
	}
	.headPhil{
		font-weight:bold;
		font-family:Oswald;
		font-size: 28px;
	}
	#logo{
		
		border-radius: 50%;
		
		width:100px;
		height:100px;
		float: right;
		background:url(../images/dvo.png);	
		background-repeat:no-repeat;
		background-size:100% 100%; 
		box-shadow: 0px 0px 10px 2px white inset;
	}
	
	.textAreaInput{
		display:block;
		width:100%;
		height:100%;
		margin:0 auto;
		overflow:hidden;
	
		border:0;
		padding:5px;
		
		letter-spacing:1px;
		resize:none;
		
		font-size:15px;
		//white-space: pre;
		font-family: sans-serif;
		text-align: left;
	}
	.saving{
		transition:all .5s ease-in;	
		float:right;
		display:inline;
		position: absolute;
		margin-left:160px;
		padding: 0px 10px;
		color:white;
		visibility: hidden;
		
	}
	.saving1{
		transition:all .5s ease-in;
		float:right;
		display:inline;
		position: absolute;
		margin-left:160px;
		padding: 0px 10px;
		background-color: red;
		color:white;
	}
	.fontUp, .fontDown{
		
		color:grey;
		margin-top:-6px;cursor:pointer;font-size:28px;
		font-size:22px;
		webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; 
		transition: all .4s ease-in;
	}
	.fontUp:hover{
		color:orange;
	}
	.fontDown:hover{
			color:orange;
	}
	.fontUp:hover:after{
		
		content: "Increase font size.";
		font-family: Oswald;
		position: absolute;
		color:white;
		background-color: orange;
		width:200px;
		border-bottom: 1px solid black;
		margin-top:-26px;
		margin-left:-9px;
	}
	.fontDown:hover:after{
		content: "Decrease font size.";
		font-family: Oswald;
		position: absolute;
		color:white;
		background-color: orange;
		width:200px;
		border-bottom: 1px solid black;
		margin-top:-26px;
		margin-left:-2px;
	}
</style>
<link rel="icon" href="/citydoc2023/images/Print.png"/> 
<title>DV View</title>
<input value = "10" type="hidden" id = "time"/>
<input value = "10" type="hidden" id = "timePayee"/>	
<table id = "tableMainForm" border = "0" >
	<tr>
		<td  style = "border:1px solid black;padding:10px 0px; " valign="top">
			<table style ="width:100%;" border ="0">
				<tr >
					<td style= "width:200px;"><div id = "logo"></div></td>
					<td style ="text-align:center;text-overflow:nowrap;white-space: nowrap;"><span class = "headPhil" style = "">Republic of the Philippines</span><br/><span style = "font-family:Oswald;font-weight:bold;text-shadow: 0px 0px 5px white;">City Government of Davao</span></td>
					<td style= "width:150px;text-align:center;vertical-align:bottom;"><?php echo $fund; ?><div style = 'padding-top:5px;letter-spacing:2px;font-size:12px;font-family: Oswald;'><?php echo $m1 . ':' . $m2  . ':' . substr($amount,0,3);  ?>&#9788;</div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td  style = "padding:2px;text-align:center;border:1px solid black;" valign="top">
			<span style = "font-weight:bold;font-size:20px;letter-spacing:1px;font-family: Oswald;font-weight: bold;">DISBURSEMENT VOUCHER</span>
		</td>
	</tr>
	<tr>
		<td  style = "padding:2px;text-align:center;border:1px solid black;" valign="top">
			<table style = "width:90%;border-spacing:0px;margin-left:20px;" border="0">
				<tr>
					<td style = "width:20px;border:1px solid black;"></td>
					<td style = "width:30px;text-align:left;">Check</td>
					<td style = "width:20px;border:1px solid black;"></td>
					<td style = "width:30px;text-align:left;">Cash</td>
					<td style = "width:20px;border:1px solid black;"></td>
					<td style = "width:150px;text-align:left;">Others</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td  style = "padding:2px;text-align:center;border:1px solid black;border-bottom:0;" valign="top">
			<table style = "border-spacing:0;width:100%;" border ="0">
				<tr>
					<td style = "letter-spacing:1px;font-family: Oswald;font-weight: bold;">Payee&nbsp;:</td>
					<td style = "border-bottom:1px solid black;"><span style = "font-weight:bold;font-size:16px;font-family: Oswald;letter-spacing:1px;"><?php echo $claimant; ?></span></td>
					<td style = "border-bottom:1px solid black;text-align:left;letter-spacing:1px;font-family: Oswald;font-weight: bold;">&nbsp;&nbsp;ADV&nbsp;No.</td>
					<td style = "border-bottom:1px solid black;"><span style = "font-weight:bold;font-size: 20px;"><?php echo $adv; ?></span></td>
				</tr>
				<tr>
					<td style = "width:70px;letter-spacing:1px;font-family: Oswald;font-weight: bold;">Address&nbsp;:</td>
					<td style = "width:430px;border-bottom:1px solid black;"><input style = "width:100%;border:0px;font-family: Oswald;font-size:12px;" value = "<?php echo $address ;?>"/></td>
					<td style = "border-bottom:1px solid black;text-align:left;letter-spacing:1px;font-family: Oswald;font-weight: bold;">&nbsp;&nbsp;OBR&nbsp;No.</td>
					<td style = "border-bottom:1px solid black;"><span style = "font-weight:bold;font-size: 18px;"></span></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td  style = "padding:2px;text-align:center;border:1px solid black;border-top:0px; " valign="top">
			<table style = "border-spacing:0;width:100%;" border = "0">
				<tr>	
					<td colspan="3" style = "padding-left:11px;text-align:left;border-bottom:1px solid black;letter-spacing:1px;font-family: Oswald;">Responsibility Center</td>
					<td style = "width:214px;text-align:right;padding-right:8px;border-bottom:1px solid black;letter-spacing:1px;font-family: Oswald;font-weight: bold;">TN : <span id = "dvTracking" style = "padding-left:4px;font-weight:bold;font-size:20px;"><?php echo $trackingNumber; ?></span></td>
				</tr>
				<tr>
					<td colspan = "5" style = "width:150px;border-left:0px solid black;padding-left:10px;letter-spacing:1px;font-family: Oswald;font-weight: bold;">Office :<input style = "border:0;width:90%;display:inline;"  value = "<?php echo  $officeName;  ?>"/></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td  style = "padding:2px;text-align:center;border:1px solid black;border-top:0px; " valign="top">
			<table style = "border-spacing:0;border-top:1px solid black;" border = "0">
				<tr>
					<td style = "text-align:center; border-right:1px solid black;padding:2px;font-family: Oswald;font-weight: bold;letter-spacing: 1px;" onmouseover="showSize()" onmouseout = "hideSize()">
							<span id = "size1" class = "fontDown" style ="visibility:hidden; float:left;position:absolute;margin-left:-219px;margin-top:-4px;" onclick = "changeSize('down')">&#9660;</span>
							<span id = "size2" class = "fontUp" style ="visibility:hidden;float:left;position:absolute;margin-left:-235px;margin-top:-8px;" onclick = "changeSize('up')">&#9650;</span>
							<span style = "cursor: pointer;" onclick = "forceSave()">Explanation</span>
							<span class = "saving" id = "saving">Saved...</span></td>
					<td style = "text-align:center;padding:2px;width:10%;font-family: Oswald;font-weight: bold;letter-spacing:1px;">Amount</td>
				</tr>
				<tr>
					<td style = "text-align:center;border-right:1px solid black;border-top:1px solid black;height:286px;padding:0px 5px;vertical-align:top;"><!--286-->
						<div id = "textArea"  style = "text-indent: 30px;text-align: justify;text-justify: inter-word; padding-bottom:10px; line-height: 16px; font-family:Arial; font-size: 12px; padding-top:10px; width:100%; text-transform:uppercase;" >
							<?php 
								echo trim($particulars);
							?>
						</div>
						<div style="width:100%;">
							<table border="0" cellpadding="0" id="taxBreakdown" style="border-spacing:0px; margin:0px 0px 0px auto; font-size:12px; font-family:Arial; <?= $hideNoTax ?>">
								<tr>
									<td colspan="2" style="text-align:right; padding:0px 5px 0px 0px; font-weight:bold; vertical-align:bottom;">Gross</td>
									<td style="text-align:right; font-weight:bold; font-size:14px;" id="pxGross"><?= number_format($gross, 2) ?></td>
								</tr>
								<?php
									if($liquidatedDamages > 0) {
								?>
								<tr>
									<td colspan="2" style="text-align:right; padding:0px 5px 0px 0px;"><span style="font-weight:bold; font-size:10px;">LESS :</span> Liquidated Damages</td>
									<td style="text-align:right; padding-left:8px; padding-right:3px;"><?= number_format($liquidatedDamages, 2) ?></td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:right; padding:0px 5px 0px 0px;">Total</td>
									<td style="text-align:right; font-weight:bold; border-top:1px solid black; padding-left:8px; padding-right:3px;"><?= number_format($grossWLD, 2) ?></td>
								</tr>
								<?php
									}
								?>
								<tr>
									<td style="font-weight:bold; padding-top:2px; padding-right:10px; font-size:10px; white-space:nowrap;">TAX BREAKDOWN<?= $notax ?><?= $recTypeLabel ?></td>
									<td style="width:0px;"></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="2" style="padding:5px 5px 0px 0px;">
										<table border="0" cellpadding="0" id="taxesCont" style="border-spacing:0px; font-size:12px; margin:0px 0px 0px auto;"><?= $taxes ?></table>
									</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td style="padding:5px 5px 0px 0px; white-space:nowrap;"><span style="font-weight:bold; font-size:10px;">LESS :</span> Total Tax</td>
									<td style="text-align:right; padding:5px 3px 0px 8px;"><?= number_format($totalTax, 2) ?></td>
								</tr>
								<?php
									if($retention > 0){
								?>
								<tr>
									<td></td>
									<td style="padding:0px 5px 0px 0px; white-space:nowrap;"><span style="font-weight:bold; font-size:10px;">LESS :</span> Retention</td>
									<td style="text-align:right; padding:0px 3px 0px 8px;"><?= number_format($retention, 2) ?></td>
								</tr>
								<?php
									}
								?>
								<?= $adjustmentDetails ?>
								<tr>
									<td colspan="2"></td>
									<td style="text-align:right; border-top:1px solid black; font-weight:bold; padding-left:5px; padding-right:3px;"><?= number_format($netAmount, 2) ?></td>
								</tr>
							</table>
						</div>
					</td>
					<td style = "text-align:center; padding-right:2px; padding-top:10px; font-family:arial; letter-spacing:1px; font-weight:bold; border-top:1px solid black; height:260px; font-size:14px; vertical-align:top;">
						<?php echo  $database->zeroToNothing(number_format($noTaxGross,2)); ?>
					</td>
				</tr>
				<tr>
					<td style = "border-right:1px solid black;padding-left:10px;font-size: 11px;font-family: Arial;"><?php echo $charges; ?>
						<span style = "float:right;font-weight: bold;padding-right:5px;font-size: 13px;font-weight: bold;font-family:arial;">Net Amount</span>
					</td>
					<td style="border-top:1px solid black; width:0px;">
						<?php if($noTaxNet > 0) { ?>
								<input style = "font-family:arial; width:125px; border:0px; text-align:center; font-weight:bold; font-size:14px; letter-spacing:1px; padding-right:1px" value ="<?php echo  $database->zeroToNothing(number_format($noTaxNet,2)); ?>"/>
							<?php
							}else {
							?>
								<input style = "font-family:arial; width:125px; border:0px; text-align:center; font-weight:bold; font-size:14px; letter-spacing:1px; padding-right:1px" value ="<?php echo  $database->zeroToNothing(number_format($netAmount,2)); ?>"/>
						<?php }	?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style = "border:1px solid;width:100%;">
			<table style ="border-spacing:0;">
				<tr>
					<td style = "width:50%;border-right:1px solid;vertical-align:top;">
						<table style ="border-spacing:0;font-size:11px;" border="0">
							<tr>
								<td>A.Certified:</td>
								<td></td>
							</tr>
							<tr>
								<td><div style = "border:1px solid;">&nbsp;</div></td>
								<td>Allotment obligated for the  purpose as indicated above</td>
							</tr>
							<tr>
								<td><div style = "border:1px solid;">&nbsp;</div></td>
								<td>Supporting documents complete</td>
							</tr>
							<tr>
								<td colspan = "2" style = "padding:15px 0px;"></td>
							</tr>
							<tr>
								<td colspan = "2" style = "font-weight:bold; padding:10px;padding-left:45px;text-align:center;font-size: 14px;">
									VINGELIN A. BAJAN<br/><span style = "font-weight:normal;" >City Accountant</span>
								</td>
							</tr>
						</table>	
					</td>
					<td style = "width:50%;border:0px solid;vertical-align:top;" >
						<table style = "width:100%; border-spacing:0; font-size: 11px;" border="0">
							<tr>
								<td colspan="2">B.Certified:</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
								
							</tr>
							<tr>
								<td style = "width:100px;">&nbsp;</td>
								<td >Funds Available</td>
							</tr>
							<tr>
								<td colspan="2" style = "padding:16px 0px;">&nbsp;</td>
							</tr>
							<tr>
								<td colspan = "2" style = "font-weight:bold; padding:5px;text-align:center;font-size: 14px;">
									LAWRENCE D. BANTIDING<br/><span style = "font-weight:normal;" >City Treasurer</span>
								</td>
							</tr>
							
						</table>	
					</td>
					
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style = "border:1px solid;border-bottom:1px solid black;">
			<table style ="border-spacing:0;">
				<tr>
					<td style = "width:50%;border-right:1px solid;vertical-align:top;">
						<table style ="border-spacing:0;width:100%;font-size: 11px;" border="0">
							<tr>
								<td colspan="2">C. Approved for Payment</td>
								
							</tr>
							
							<?php
								if($office == "1021" || $office == "1016"){
									// $name = "SEBASTIAN Z. DUTERTE";
									$name = "J. MELCHOR B. QUITAIN, JR.";
									$designation = "City Vice Mayor";
								}else{
									// $name = "SARA Z. DUTERTE";
									$name = "SEBASTIAN Z. DUTERTE";
									$designation = "City Mayor";
								}
							?>
							<tr>
								<td colspan = "2" style = "font-weight:bold; padding:5px;padding-top:100px;text-align:center;">
									<input style="text-align:center;border:0;width:100%;font-weight:bold;font-size:14px;" value = "<?php echo $name; ?>"/><br/>
									<input style="text-align:center;border:0;font-size:14px;" value = "<?php echo $designation; ?>"/><br/>
								</td>
							</tr>
						</table>	
					</td>
					<td style = "width:50%;border:0px solid;vertical-align:top;">
						<table style = "width:100%; border-spacing:0;font-size:11px; " border="0">
							<tr>
								<td colspan="2">D. Received Payment:</td>
							</tr>
							<tr>
								<td >Check No.:</td>
								<td style = "border-bottom:1px solid black;"></td>
							</tr>
							<tr>
								<td >Name of Bank:</td>
								<td style = "border-bottom:1px solid black;"></td>
							</tr>
							<tr>
								<td style = "width:150px;padding-top:10px;">Signature:</td>
								<td style = "border-bottom:1px solid black;padding-top:10px;"></td>
							</tr>
							<tr>
								<td style = "width:150px;">&nbsp;</td>
								<td style = "border-bottom:0px solid black;"></td>
							</tr>
							<tr>
								<td colspan="2" style = "border:1px solid black;padding:2px 0px;border-left:0px;border-right:0px;">Printed Name :
									<input style = "width:310px;border:1px;font-weight:bold;"/>
								</td>
							</tr>
							<tr>
								<td >Date Received:</td>
								<td style = "border-bottom:1px solid black;"><input style = "width:100%;border:0;font-weight:bold;"/></td>
							</tr>
							<tr>
								<td colspan ="2">O.R. No./Other relevant document issued:</td>
							</tr>
							<tr>
								<td style = "width:150px;padding-top:0px;">JEV No.:</td>
								<td style = "border-bottom:1px solid black;padding-top:10px;"></td>
							</tr>
							<tr>
								<td style = "width:150px;padding-top:0px;">Date:</td>
								<td style = "padding-top:10px;"></td>
							</tr>
						</table>	
					</td>
					
				</tr>
			</table>
		</td>
	</tr>
</table>



<script>
	
	function changeSize(change){
		var text = document.getElementById("textArea");
		var taxes = document.getElementById("taxBreakdown");
		var taxesBod = document.getElementById("taxesCont");
		var gross = document.getElementById("pxGross");

		var oldSize = text.style.fontSize.replace("px","");
		var lineheight = text.style.lineHeight.replace("px","");
		if(change == "up"){
			oldSize++;
			lineheight++;
		}else{
			oldSize--;
			lineheight--;
		}
		text.style.fontSize = oldSize + "px";
		text.style.lineHeight = lineheight + "px";

		taxes.style.fontSize = oldSize + "px";
		taxes.style.lineHeight = lineheight + "px";

		taxesBod.style.fontSize = oldSize + "px";
		taxesBod.style.lineHeight = lineheight + "px";

		gross.style.fontSize = oldSize + "px";
		gross.style.lineHeight = lineheight + "px";
	}
	function showSize(){
		
		document.getElementById('size1').style.visibility = "visible";
		document.getElementById('size2').style.visibility = "visible";
		
	}
	function hideSize(){
		document.getElementById('size1').style.visibility = "hidden";
		document.getElementById('size2').style.visibility = "hidden";
	}
	
</script>



