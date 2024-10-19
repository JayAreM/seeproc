<?php
	require_once('../includes/database.php');
	// require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	$officeName = str_replace("\\",'',$database->charEncoder($_GET['officeName']));
	$dt = time();
	$datePrinted = date('Y-m-d h:i A', $dt);

	
	
	$sql = "SELECT Year, TrackingNumber, PR_ProgramCode, Amount, NetAmount, PR_AccountCode, Fund, DateEncoded, EncodedBy, InfraId
			FROM vouchercurrent where trackingnumber  = '" . $trackingNumber . "' order by pr_programcode,pr_accountcode limit 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	
	
	$infraId = $data['InfraId'];
	
	$prgCode = $data['PR_ProgramCode'];
	$expCode = $data['PR_AccountCode'];
	$fund = $data['Fund'];
	$amount = $data['Amount'];
	$netAmount = $data['NetAmount'];
	$dateEncoded = $data['DateEncoded'];
	$encodedBy = $data['EncodedBy'];
	$year = $data['Year'];
	
	/*$sql = "SELECT Name as ProgramName
			FROM programcode where code  = '" . $prgCode . "'limit 1";*/
	$sql = "SELECT Name as ProgramName,Code,Lump, Entry
			FROM programcode where Id  = '" . $infraId . "'limit 1";		
			
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$code = $data['Code'];
	$lump = $data['Lump'];
	$entry= $data['Entry'];
	$prgTitle = '';
	$projectName = $data['ProgramName'];	
	if($entry == "Regular"){
		$entry = '';
	}
	if(strlen($lump) > 0 ){
		$sql = "SELECT Name as ProgramName
			FROM programcode where Code  = '" . $lump . "'limit 1";
			$record = $database->query($sql);
			$data = $database->fetch_array($record);
			$prgTitle = $data['ProgramName'];
			
	}
	
	$sql = "SELECT Title
			FROM fundtitles where Code  = '" . $expCode . "'limit 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$expTitle = $data['Title'];
	
	
	$sql = "SELECT concat(FirstName,' ', LastName) as Name
			FROM citydoc.employees where employeenumber  = '" . $encodedBy . "'limit 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$encoder = $data['Name'];
	
	$sql = "SELECT Location, Duration
			FROM infra where TrackingNumber  = '" . $trackingNumber . "'limit 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$location = $data['Location'];
	$duration = $data['Duration'];
	
	$preparedBy = $encoder;
	$preparedOffice = "City Engineer's Office";
	$division = "Programming and Design Division";

	$sql = "select * from infrapayment where InfraTracking ='" . $trackingNumber ."' order by id asc";
	$record = $database->query($sql);
	$count = $database->num_rows($record);
	$sheet = '';
	if($count > 0){
		// $sheet .= ' <tr>
		// 				<td colspan = "3" style = "padding:15px 0px 5px 0px;">
		// 					<span class = "data1" style  = ";color:rgb(64, 161, 202);font-weight:bold;font-size:20px;">Payment History </span>
		// 				</td>
		// 			</tr>';
		$sheet .= ' <tr>
						<td colspan ="3">
							<table id="infraPaymentHistory" border="0"  style="font-family:NOR;margin:0 auto;font-size:14px;border-collapse:collapse;width:100%;background-color:white;padding:50px;" border ="0">';
		$sheet .= ' 			<tr>
									<th style = "border-left:1px solid rgb(232, 234, 235);">TN</th>
									<th style = "text-align:left;">Payment</th>
									<th style = "">Variation</th>
									<th style = "">Unperformed</th>
									<th style = "">Contract</th>
									<th style = "">Adjustment</th>
									<th style = "">T.Progress</th>
									<th style = "">B.Progress</th>
									<th style = "text-align:center;">S.Curve</th>
									<th style = "text-align:right;">Billed&nbsp;Amount</th>
									<th style = "text-align:right;">2(%)</th>
									<th style = "text-align:right;">5(%)</th>
									<th style = "text-align:right;">Tax</th>
									<th style = "text-align:right;">Ret</th>
									<th style = "text-align:right;">Delay</th>
									<th style = "text-align:right;">LD</th>
									<th style = "text-align:right;border-right:1px solid rgb(232, 234, 235);">Net</th>
								</tr>
								<tr><td colspan="100%" style="border:0px; border-top:1px solid grey; padding:1px 0px;"></td></tr>
					';
		$totalGross = 0;		   
		$totalNet = 0;
		$totalTwo = 0;
		$totalFive = 0;
		$totalRetention = 0;
		$totalTax = 0;
		$totalLD = 0;
		
		$retentionTotal = 0;
		$done = 0;
		$lastProgress = 0;
		$billedProgress = 0;
		$ld = 0;
		$type = array('1st Payment','2nd Payment','3rd Payment','4th Payment','5th Payment','6th Payment','7th Payment','Final Payment');
		while($data = $database->fetch_array($record)){
				$infaTN = $data['TrackingNumber'];
				$infaPaymentType = $data['Type'];
				$arrayKey = array_search($infaPaymentType, $type);
				unset($type[$arrayKey]);
				if($infaPaymentType == 'Final Payment'){
					$done = 1;
				}
				
				$progress = $data['Progress'];
				$actual = $data['Actual'];
				
				
				$variationSaved =  $data['Variation'];
				$unperformedSaved = $data['Unperformed'];
				if($variationSaved > 0 || $unperformedSaved > 0){
					$adjustment = number_format($data['ActualAdjustment']);
				}else{
					$adjustment = '';
				}
				$gross = $data['Gross'];
				$billedProgress = $data['BilledProgress'];
				$lastProgress = $progress;
				$sCurve = $data['Scurve'];
				$delay = $data['Delay'];
				$tax = $data['Tax'];
				$retention = $data['Retention'];
				
				$net = $data['Net'];
				$two = $data['Two'];
				$five = $data['Five'];
				$ld = $data['LD'];

				$retentionTotal += $retention;
				$totalTax += $tax;
				$totalTwo += $two;
				$totalFive += $five;
				$totalNet += $net;
				$totalGross += $gross;

				$sheet .= '	<tr>
							<td style = "">' . $infaTN . '</td>
							<td style = "white-space:nowrap;">' . $infaPaymentType . '</td>
							<td style = "text-align:right;">' . $database->zeroToNothing(number_format($variationSaved,2)) . '</td>
							<td style = "text-align:right;">' . $database->zeroToNothing(number_format($unperformedSaved,2)) . '</td>
							<td style = "text-align:right;">' . number_format($actual,2) . '</td>
							<td style = "text-align:right;">' . $adjustment . '</td>
							<td style = "text-align:center;">' . $progress . '</td>
							<td style = "text-align:center;">' . $billedProgress . '</td>
							
							<td style = "text-align:center;">' . $sCurve . '</td>
							<td style = "text-align:right;">' . number_format($gross,2) . '</td>
							<td style = "text-align:right;">' . number_format($two,2) . '</td>
							<td style = "text-align:right;">' . number_format($five,2) . '</td>
							<td style = "text-align:right;">' . number_format($tax,2) . '</td>
							<td style = "text-align:right;">' . number_format($retention,2) . '</td>
							<td style = "text-align:right;">' . $database->zeroToEmpty($delay) . '</td>
							<td style = "text-align:right;">' . $database->zeroToEmpty(number_format($ld,2)) . '</td>
							<td style = "text-align:right;">' . number_format($net,2) . '</td>
						</tr>';
				
			}
			$sheet .= ' <tr>
							<td colspan="9" style=""></td>
							<td style=" text-align:right; font-weight:bold;">' . number_format($totalGross,2) .'</td>
							<td style=" padding:5px; text-align:right;">' . number_format($totalTwo,2) . '</td>
							<td style=" padding:5px; text-align:right;">' . number_format($totalFive,2) . '</td>
							<td style=" padding:5px; text-align:right;">' . number_format($totalTax,2) . '</td>
							<td style=" padding:5px; text-align:right;">' . number_format($retentionTotal,2) . '</td>
							<td style=""></td>
							<td style=" padding:5px; text-align:right;">' . $database->zeroToEmpty(number_format($ld,2)) . '</td>
							<td style=" padding:5px; text-align:right;"><span style = "font-weight:bold;">' . number_format($totalNet,2) . '</span></td>
						</tr>';	
		$sheet .= '</table></td></tr>';
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/city/images/print.png"/> 
	<title>INFRA Payment History</title>

	<style>
		@font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
		}
		@font-face {
			font-family: "NOR";
			src: url("../fonts/Abel-Regular.ttf");
		}
		body{
			font-family:NOR;
			padding: 0;
			margin:0;
		}
		
		#logo{
			width:105px;
			height:105px;
			margin:0 auto;
			background:url(../images/davaologo.jpg);	
			background-repeat:no-repeat;
			background-size:100% 100%; 	
			float: right;
		}
		

		.tdLabel {
			text-align:right;
			font-size:12px;
			letter-spacing:1px;
			vertical-align:top;
			white-space:nowrap;
		}

		.tdValue {
			font-weight:bold;
			/* padding:5px 5px 0px 5px; */
		}

		#infraPaymentHistory > tbody > tr > th {
			border-bottom:1px solid black;
			border-top:1px solid rgb(232, 234, 235);
			padding:2px 5px;
			font-size:13px;
			letter-spacing:1px;
		}
		#infraPaymentHistory > tbody > tr > td {
			padding:0px 5px;
			border:1px solid rgb(232, 234, 235);
			font-size:13px;
		}
		#infraPaymentHistory > tbody > tr:last-child > td {
			border: 0px;
		}
		#infraPaymentHistory > tbody > tr:nth-last-child(2) > td {
			border-bottom:1px solid black;
		}
	</style>

</head>
<body>

	<!-- 
		8.5 in = 816 px 
		11 in = 1056 px 
		break-inside:avoid; page-break-inside:avoid;
	--> 
	<div style="width:1150px; height:720px; margin:0 auto;">
		<table border="0" cellpadding="0" cellspacing="0" style="border-spacing:0px; margin:0 auto; width:100%; height:100%;">
			<tr>
				<td style="">
					<table border="0" cellpadding="0" cellspacing="0" style="border-spacing:0px; margin:0 auto; width:100%; height:100%;">
						<tr>
							<td style="height:1px; padding-top:10px; height:120px; padding-bottom:15px; border-bottom:1px solid black;">
								<table border="0" style ="width:100%; border-spacing:0;">
									<tr>
										<td style= "padding:0px;">
											<div id = "logo"></div>
										</td>
										<td style ="text-align:center; width:320px;">
											<div style ="line-height:22px; letter-spacing:1px;">
												<div style = "font-size:20px;">Republic of the Philippines</div>
												<div style = "font-size:16px;">City Government of Davao</div>
												<div style = "font-size:24;font-weight: bold;">INFRASTRUCTURE PROJECT</div>
												<div style = "font-size:14px;">Payment History</div>
											</div>
										</td>
										<td style= "width:380px; text-align:right; vertical-align:bottom; padding-right:10px;">
											<div style = "font-size: 12px;">TN&nbsp;:&nbsp;&nbsp;<span style="font-size:18px;font-weight:bold; letter-spacing:1px;"><?= $trackingNumber ?></span></div>
											<div><span style="font-weight: normal; font-size: 12px;letter-spacing:1px;">DocTrack <span style=" font-size: 14px;"><?php echo $year; ?></span></span></div>	
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="height:1px; vertical-align:top; padding-top:8px;">
								<table border="0" style="border-spacing:0px 3px; line-height:14px; font-size:14px; width:100%; letter-spacing:.5px;">
									<tbody>
										<tr>
											<td class="tdLabel" style='width:85px; '>
												Office :
											</td>
											<td class="tdValue"><?= $officeName ?></td>
										</tr>
										<tr>
											<td class="tdLabel" style=''>
												Source of Fund : 
											</td>
											<td class="tdValue"><?= $fund . ' - ADF( ' . $year . ' )'?> </td>
										</tr>
										<tr>
											<td class="tdLabel" style=''>
												
											</td>
											<td class="tdValue" style=''><?= $prgCode . ' ' . $entry  ?></td>
										</tr>
										
										<tr>
											<td class="tdLabel" style=''>
												
											</td>
											<td class="tdValue" style=''><?=  $prgTitle ?></td>
										</tr>
										<tr>
											<td class="tdLabel" style=''>
												Project Title :
											</td>
											<td class="tdValue" style='letter-spacing:.5px;'><?= $projectName  ?></td>
										</tr>
										<tr>
											<td class="tdLabel" style=''>
												Expense Code :
											</td>
											<td class="tdValue"><?= $expCode ?></td>
										</tr>
										<tr>
											<td class="tdLabel" style=''>
												Type :
											</td>
											<td class="tdValue" style=''><?= $expTitle ?></td>
										</tr>
										<tr>
											<td class="tdLabel" style=''>
												Location :
											</td>
											<td class="tdValue" style='letter-spacing:.5px;'><?= $location ?></td>
										</tr>
										<tr>
											<td class="tdLabel" style=''>
												Duration :
											</td>
											<td class="tdValue" style='letter-spacing:.5px;'><?= $duration ?></td>
										</tr>
										<tr>
											<td colspan='2' style='text-align:right; font-size:16px; padding:5px 15px 0px 0px;'>
												<span style='margin-right:10px; font-size:13px; letter-spacing:1px;'>Budget Amount</span>
												<span style='font-weight:bold;'><?= number_format($amount,2) ?></span>
											</td>
										</tr>
										<tr>
											<td colspan='2' style='text-align:right; font-size:16px; padding:5px 15px 0px 0px;'>
												<span style='margin-right:10px; font-size:13px; letter-spacing:1px;'>Actual Amount</span>
												<span style='font-weight:bold;'><?= number_format($netAmount,2) ?></span>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td style="vertical-align:top; padding-top:15px;">
								<table border="0" cellpadding="0" cellspacing="0" style="font-family:NOR; width:100%;"><?php echo $sheet; ?></table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="height:1px;">
					<div style="text-align:right; font-size:10px; padding:5px; background-color:rgba(242,242,242,1);">
						<span style="margin-right:8px;float:left;letter-spacing:1px;">www.davaocityportal.com</span>
						<span style="margin-right:8px;"><strong>Date Encoded</strong> :<?= $dateEncoded ?></span>
						<span style=""><strong>Date Printed</strong> :<?= $datePrinted ?></span>
					</div>
				</td>
			</tr>
		</table>
	</div>

</body>
</html>
