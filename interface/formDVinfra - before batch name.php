<?php
	session_start();

	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('../../citydoc2023/interface/login.php','_self')</script>";
		echo $link;
	}
	
	
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	
	
	
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	
	//$record = $database->SearchByTrackingNumber($trackingNumber);
	//$record = $database->SearchTracking($trackingNumber);
	//$record = $database->SearchTrackingToVoucher($trackingNumber);
	$sql = "select * from vouchercurrent where trackingnumber = '" . $trackingNumber . "' limit 1";
	$record = $database->query($sql);
	$count = $database->num_rows($record);
	
	if($count > 0){
		$acct =$_SESSION['accountType'];	
		$logOffice = $_SESSION['officeCode'];
		$m1 = strrev(substr($trackingNumber,0,2));
		$year  = "2023";
		$charges = '<span style = "font-weight:bold;font-size:12px;">Chges: </span>';
		
	 
		$data = $database->fetch_array($record);
		$office = $data['Office'];
		
		
		$trackingType = $data['TrackingType'];
		
		$claimant  = $data['Claimant']; 
		
		
		
		$m2 = strrev(substr($claimant,1,3));
		$fund  = $data['Fund'];
		
		
		$amount = $data['Amount'];
		$year = $data['Year'];
		
		$netAmount = $data['NetAmount'];
		$adv = $data['ADV1'];
		if($adv == 0 || $adv ==99999){
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
		
		$sql = "select Address from supplier.supplierinfo where name = '" . $claimant . "' limit 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$address = $data['Address'];

		
		$sql = "select Name from office where code = '" . $office . "'";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$officeName = $data['Name'];
				
		$sql = "SELECT * FROM infrapayment where trackingnumber = '" . $trackingNumber . "' limit 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		
		$infraTracking = $data['InfraTracking'];
		$type = $data['Type'];
		$actual = $data['Actual'];
		$adjustment = $data['ActualAdjustment'];
		$progress = $data['BilledProgress'];
		$totalProgress = $data['Progress'];
		$sCurve = $data['Scurve'];
		
		$from = $data['PeriodFrom'];
		$to = $data['PeriodTo'];
		
		$tax2 = $data['Two'];
		$tax5 = $data['Five'];
		$tax = $data['Tax'];
		$gross = $data['Gross'];
		
		
		
		$net = $data['Net'];
		
		$variation = $data['Variation'];
		$unperformed = $data['Unperformed'];
		$retention = $data['Retention'];
		$ld = $data['LD'];
		$delay = $data['Delay'];
		
		$ldPercentage = $data['LDpercentage'];
		$beforeLD = $gross + $ld;
		
		$delayCaption = '';
		$delayValue = '';
		if($delay > 0){
			$delayCaption ='Delay : ';
			$delayValue = $delay . " days";
		}
		$deduction = ($tax + $retention + $ld);
		
		$sql = "select Name, BankAccount from programcode where TrackingNumberinfra = '" . $infraTracking . "' limit 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$projectName = $data['Name'];

		$hideBnkAccount = "display:none;";
		$bankAccount = "";
		if(strlen(trim($data['BankAccount'])) > 0) {
			$bankAccount = $data['BankAccount'];
			$hideBnkAccount = "";
		}
		
		$particulars = "For ("  . $type . ") of a bid contract for the project : "  . $projectName . " covering for the period of " . $from . " to " . $to . " as per supporting documents hereto attached in the amount of ....";			
		
		
		$sql = "select OBR_Number from vouchercurrent where TrackingNumber = '" . $infraTracking . "' limit 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$obrParent = $data['OBR_Number'];
		
		$sql = "select PR_ProgramCode,FundYear from vouchercurrent where TrackingType = 'NF' and OBR_Number = '" . $obrParent . "'";
		$record = $database->query($sql);
		$arrProg = array();
		while($data = $database->fetch_array($record)){
			$fundYear = $data['FundYear'];
			$program = $data['PR_ProgramCode'];
			$charges = $fundYear . '*'. $program;
			
			array_push($arrProg,$charges);
		}

		$a = array_unique($arrProg);
		$charges ='';
		for($i = 0 ; $i < sizeof($a); $i++){
			$arr = explode('*', $arrProg[$i]);
			$year =  $arr[0];
			$program = $arr[1];
			$charges .= ', ' .$year . '(' . $program . ')' ;
		}
		$charges = substr($charges,1);
		
		
		$sql = "SELECT sum(Gross) as Previous FROM infrapayment where infratracking = '" . $infraTracking . "' and Variation <= 0 and Unperformed <= 0";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$previousBilling  = $data['Previous'];
		$adj =  $variation + $unperformed;
	
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
					<td style = "width:20px;border:1px solid black;""></td>
					<td style = "width:30px;text-align:left;">Cash</td>
					<td style = "width:20px;border:1px solid black;""></td>
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
					<td style = "text-align:center;border-right:1px solid black;border-top:1px solid black;height:273px;padding:0px 5px;vertical-align:top;"><!--286-->
						<div id = "textArea"  style = "text-indent: 30px;text-align: justify;text-justify: inter-word; padding-bottom:10px; line-height: 16px;font-family:Arial; font-size: 14px;padding-top:10px;width:100%;" >
							<?php 
								
								
								if($delay > 0){
									echo trim($particulars);
									$sheet1 = "<table border ='0' style ='text-align:right;border-spacing:0;line-height:12px;width:100%;font-family:Arial;font-size:12px;'>";
									$sheet1 .= "	<tr>
														<td>Project Tracking</td><td  >" . $infraTracking . "</td><td>S-Curve : </td><td style ='text-align:left;' colspan ='100%;' >" . $sCurve . "</td>
													</tr>";
									/*if($adjustment > 0){*/
										$sheet1 .= "<tr>
														<td>Contract Amount</td><td >" . number_format($actual,2). "</td><td  ></td><td style ='text-align:left;' colspan ='100%;' ></td>
													</tr>";
													
										if($variation >  0){
											$sheet1 .= "<tr>
														<td>Add. Fund due to Variation order No. 1</td><td >" . number_format($variation,2). "</td><td colspan ='100%'></td>
													</tr>";
											$sheet1 .= "<tr>
														<td>Revised Contract Amount</td><td style ='border-top:1px solid black;'>" . number_format($adjustment,2). "</td><td colspan ='100%'></td>
													</tr>";
										}
										if($unperformed >  0){
											$sheet1 .= "<tr>
														<td>Unperformed Works</td><td >" . number_format($unperformed,2). "</td><td colspan ='100%'></td>
													</tr>";
											$sheet1 .= "<tr>
														<td>Revised Contract Amount</td><td style ='border-top:1px solid black;'>" . number_format($adjustment,2). "</td><td colspan ='100%'></td>
													</tr>";
										}
										if($adj > 0){
											$sheet1 .= "<tr>
															<td style ='padding-bottom:5px;'>Less  Previous Billing " . "(" . ($totalProgress - $progress)  . "%)"  . "</td><td style ='padding-bottom:5px;padding-left:10px;'>" . number_format($previousBilling,2) .  "</td><td colspan ='100%'></td>
														</tr>";	
										}		
									/*}else{
										$sheet1 .= "<tr>
														<td>Contract Amount</td><td >" . number_format($actual,2). "</td><td></td><td colspan ='100%;' style ='text-align:left;'></td>
													</tr>";
									}*/
									$sheet1 .= "	<tr><td>Total Accomplishment to Date</td><td>" . $totalProgress . " %</td><td colspan ='100%'></td></tr>";	
									$sheet1 .= "	<tr>
														<td style = 'white-space:nowrap;'>Accomplishment Before Expiry Date </td><td >" . $ldPercentage * 100 . " %</td><td ></td><td style = 'text-align:right;'>Billed Amount </td>
														<td style = 'text-align:right;font-weight:bold;font-size:15px;'>" . number_format($beforeLD,2). "</td>
													</tr>	
													<tr>
														<td colspan ='100%' style ='text-align:center;font-weight:bold;padding-left:120px;'>LESS </td>
													</tr>
													<tr>
														<td></td><td></td><td colspan ='2' style = 'white-space:nowrap; '>Liquidated Damages("  . $delayValue . ")</td><td >" . number_format($ld,2). "</td>
													</tr>
													<tr>
														<td></td><td></td><td></td><td></td><td style ='border-top:1px solid black;'>" . number_format($gross,2). "</td>
													</tr>
													<tr>
														<td style ='text-align:left;padding:4px 0px;' colspan = '4'>
															<table style ='float:right;border-spacing:0;line-height:12px;font-family:Arial;font-size:12px;' border ='0'>
																<tr>
																	<td>Tax 2%</td><td style ='text-align:right;'>" . number_format($tax2,2). "</td>
																</tr>
																<tr>
																	<td>Tax 5%</td><td style ='text-align:right;'>" . number_format($tax5,2). "</td>
																</tr>
															</table>
														</td>
														<td></td>
													</tr>
													
													<tr>	
														<td colspan='3' rowspan='4' style='vertical-align:bottom;'></td>
														<td style = 'text-align:right;'>Total Tax </td><td>" . number_format($tax,2). "</td>
													</tr>
													<tr>
														<td style = 'text-align:right;'>Retention </td><td style = 'text-align:right;'>" . number_format($retention,2). "</td>
													</tr>";
									
									$sheet1 .= "<tr>
													<td style = 'text-align:right;'>Total Deduction </td><td style = 'font-weight:bold;text-align:right;border-top:1px solid black;padding:5px 0px;'>" . number_format($deduction,2). "</td>
												</tr>";			
									$sheet1 .= "</table>";
								}
								if($delay <= 0){
									echo trim($particulars);
									$sheet1 = "<table border ='0' style ='text-align:right;border-spacing:0;line-height:12px;width:100%;font-family:Arial;font-size:12px;'>";
									$sheet1 .= "	<tr>
														<td>Project Tracking</td><td  >" . $infraTracking . "</td><td>S-Curve&nbsp;:&nbsp;</td><td style ='text-align:left;  ' colspan ='100%;' >" . $sCurve . "</td>
													</tr>";
									/*if($adjustment > 0){*/
										$sheet1 .= "<tr>
														<td>Contract Amount</td><td >" . number_format($actual,2). "</td><td  >" . $delayCaption . "</td><td style ='text-align:left;' colspan ='100%;' >" . $delayValue . "</td>
													</tr>";
													
										if($variation >  0){
											$sheet1 .= "<tr>
														<td>Add. Fund due to Variation order No. 1</td><td >" . number_format($variation,2). "</td><td colspan ='100%'></td>
													</tr>";
													
											$sheet1 .= "<tr>
														<td>Revised Contract Amount</td><td style ='border-top:1px solid black;'>" . number_format($adjustment,2). "</td><td colspan ='100%'></td>
													</tr>";
										}
										if($unperformed >  0){
											$sheet1 .= "<tr>
														<td>Unperformed Works</td><td >" . number_format($unperformed,2). "</td><td colspan ='100%'></td>
													</tr>";
											$sheet1 .= "<tr>
														<td>Revised Contract Amount</td><td style ='border-top:1px solid black;'>" . number_format($adjustment,2). "</td><td colspan ='100%'></td>
													</tr>";
										}
										if($adj > 0){ 			
											$sheet1 .= "<tr>
															<td style ='padding-bottom:5px;'>Less  Previous Billing " . "(" . ($totalProgress - $progress)  . "%)"  . "</td><td style ='padding-bottom:5px;padding-left:10px;'>" . number_format($previousBilling,2) .  "</td><td colspan ='100%'></td>
														</tr>";
										}
									/*}else{
										$sheet1 .= "<tr>
														<td>Contract Amount</td><td >" . number_format($actual,2). "</td><td>" . $delayCaption . "</td><td colspan ='100%;' style ='text-align:left;'>" . $delayValue . "</td>
													</tr>";
									}*/
									$sheet1 .= "	<tr><td>Total Accomplishment to Date</td><td>" . $totalProgress . " %</td><td colspan ='100%'></td></tr>";	
									$sheet1 .= "	<tr>
														<td>Billed to Date </td><td >" . $progress. " %</td><td ></td><td style = 'text-align:right;'>Billed Amount </td><td style = 'text-align:right;font-weight:bold;font-size:15px;'>" . number_format($gross,2). "</td>
													</tr>
													<tr>
														<td colspan ='100%' style ='text-align:center;font-weight:bold;padding-left:120px;'>LESS </td>
													</tr>
													
													
													<tr>
														<td style ='text-align:left;padding:4px 0px;' colspan = '4'>
															<table style ='float:right;border-spacing:0;line-height:12px;font-family:Arial;font-size:12px;' border ='0'>
																<tr>
																	<td>Tax 2%</td><td style ='text-align:right;'>" . number_format($tax2,2). "</td>
																</tr>
																<tr>
																	<td>Tax 5%</td><td style ='text-align:right;'>" . number_format($tax5,2). "</td>
																</tr>
															</table>
														</td>
														<td></td>
													</tr>
													
													<tr>	
														<td colspan='3' rowspan='4' style='vertical-align:bottom;'></td>
														<td style = 'text-align:right;'>Total Tax </td><td>" . number_format($tax,2). "</td>
													</tr>
													<tr>
														<td style = 'text-align:right;'>Retention </td><td style = 'text-align:right;'>" . number_format($retention,2). "</td>
													</tr>";
									if($delay >  0){
										$sheet1 .= "<tr>
														<td>Liquidated Damages</td><td >" . number_format($ld,2). "</td>
													</tr>";	
									}
									$sheet1 .= "<tr>
													<td style = 'text-align:right;'>Total Deduction </td><td style = 'font-weight:bold;text-align:right;border-top:1px solid black;padding:5px 0px;'>" . number_format($deduction,2). "</td>
												</tr>";			
									$sheet1 .= "</table>";
								}
								
							 ?>
						</div>
						<div>
							<?php echo  $sheet1;?>
						</div>
					</td>
					<td style = "text-align:right;padding-right:2px;padding-top:5px; font-family:arial;letter-spacing:1px; font-weight: bold; border-top:1px solid black;height:260px;vertical-align:top;">
						
					</td>
				</tr>
				<tr>
					<td style="border-right:1px solid black; padding:0px; font-size:11px; font-family:Arial;">
						<div style="text-align:left; padding-left:5px; <?= $hideBnkAccount ?>">
							<span style="padding:0px 0px;">BANK ACCOUNT :</span>
							<span style="padding:0px 5px;"><?= $bankAccount ?></span>
						</div>
					</td>
					<td></td>
				</tr>
				<tr>
					<td style = "border-right:1px solid black;padding-left:10px;font-size: 11px;font-family: Arial;"><?php echo $charges; ?>
						<span style = "float:right;font-weight: bold;padding-right:5px;font-size: 13px;font-weight: bold;font-family:arial;">Net Amount</span>
					</td>
					<td style="border-top:1px solid black; ">
						<input style = "font-family:arial; width:142px;border:0;text-align:center;font-weight:bold;font-size:14px;letter-spacing:1px;padding-right:1px" value ="<?php echo  $database->zeroToNothing(number_format($netAmount,2)); ?>"/>
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



