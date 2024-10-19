<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	$officeName = str_replace("\\",'',$database->charEncoder($_GET['officeName']));
	$dt = time();
	$datePrinted = date('Y-m-d h:i A', $dt);

	
	
	$sql = "SELECT Year,TrackingNumber,PR_ProgramCode,Amount,PR_AccountCode,Fund,DateEncoded, EncodedBy, InfraId
			FROM vouchercurrent where trackingnumber  = '" . $trackingNumber . "' order by pr_programcode,pr_accountcode limit 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	
	
	$infraId = $data['InfraId'];
	
	$prgCode = $data['PR_ProgramCode'];
	$expCode = $data['PR_AccountCode'];
	$fund = $data['Fund'];
	$amount = $data['Amount'];
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
	
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/city/images/print.png"/> 
	<title>INFRA View</title>

	<style>
		@font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
		}
		body{
			font-family:Oswald;
			padding: 0;
			margin:0;
		}
		
		#logo{
			width:120px;
			height:120px;
			margin:0 auto;
			background:url(../images/davaologo.jpg);	
			background-repeat:no-repeat;
			background-size:100% 100%; 	
			float: right;
		}
		

		.tdLabel {
			text-align:right;
			font-size:13px;
			letter-spacing:1px;
			vertical-align:top;
		}

		.tdValue {
			font-weight:bold;
			padding:5px 5px 0px 5px;
		}
	</style>

</head>
<body>

	<!-- 
		8.5 in = 816 px 
		11 in = 1056 px 
	--> 
	
		<table border="0" style = "height:100%;width:750px; border-spacing:0px;margin:0 auto;">
			<!--<tr>
				<td style="height:10%;">
					<table border="0" style ="width:100%;border-spacing:0;">
						<tr>
							<td style= "padding:5px 0px 10px 40px;"><div id = "logo"></div></td>
							<td style ="text-align:center;">
								<div style ="width:445px;line-height:22px; ">
									<div style = "font-size:20px;font-weight:bold;">Republic of the Philippines</div>
									<div style = "font-size:16px;">City Government of Davao</div>
								</div>
							</td>
							<td style= "font-size:12px; vertical-align:bottom; padding-right:5px; text-align:right;">
								TN&nbsp;:&nbsp;&nbsp;<span style="font-size:22px; font-family:impact;letter-spacing:2px;"><?= $trackingNumber ?></span>
								<br>
								<span style="font-weight: normal; padding-right: 3px;">DocTrack <span style="font-weight: bold; font-size: 16px;">2022</span></span>
							</td>
						</tr>
						<tr>
							<td colspan ="3" style = "font-size:18px;text-align:center;font-weight:bold;letter-spacing:1px;">
								INFRASTRUCTURE PROJECT FORM
							</td>
						</tr>
					</table>
				</td>
			</tr>-->
		<tr>
			<td style="height:10%;padding-top:20px;height:120px;padding-bottom:15px;">
				<table border="0" style ="width:100%;border-spacing:0;">
					<tr>
						<td style= "padding:0px;width:150px;">
							<div id = "logo"></div>
						</td>
						<td style ="text-align:center;">
							<div style ="width:445px;border:">
								<div style = "font-size:20px;">Republic of the Philippines</div>
								<div style = "font-size:16px;">City Government of Davao</div>
								<div style = "font-size:26;font-weight: bold;">INFRASTRUCTURE PROJECT</div>
							</div>
						</td>
						<td style= "width:150px;">
							<div id = "logo1"></div>	
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style= "line-height: 18px;height:10px;padding-top:10px;padding-right:10px; border-top:2px solid black;text-align: right;" >
				<div style = "font-size: 12px;">TN&nbsp;:&nbsp;&nbsp;<span style="font-size:14px;font-weight:bold;"><?= $trackingNumber ?></span></div>
				<div><span style="font-weight: normal; font-size: 12px;letter-spacing:1px;">DocTrack <span style=" font-size: 14px;"><?php echo $year; ?></span></span></div>
			</td>
		</tr>
			<tr>
				<td style="vertical-align:top; padding-top:20px;">
					<table border="0" style="border-spacing:0px; font-size:18px; line-height:23px;width:100%;">
						<tbody>
							<tr>
								<td class="tdLabel" style='width:85px; padding:7px 0px 0px 5px;'>
									Office :
								</td>
								<td class="tdValue"><?= $officeName ?></td>
							</tr>
							<tr><td colspan='2' style='padding:3px;'></td></tr>

							<tr>
								<td class="tdLabel" style='padding:7px 0px 0px 5px;'>
									Source of Fund : 
								</td>
								<td class="tdValue"><?= $fund . ' - ADF( ' . $year . ' )'?> </td>
							</tr>
							<tr>
								<td class="tdLabel" style='padding:0px 0px 0px 5px;'>
									
								</td>
								<td class="tdValue" style='padding:0px 5px 0px 5px;'><?= $prgCode . ' ' . $entry  ?></td>
							</tr>
							
							<tr>
								<td class="tdLabel" style='padding:0px 0px 0px 5px;'>
									
								</td>
								<td class="tdValue" style='padding:0px 5px 0px 5px;'><?=  $prgTitle ?></td>
							</tr>
							
							<tr><td colspan="2" style = "padding:10px;"></td></tr>
							
							<tr>
								<td class="tdLabel" style='padding:0px 0px 0px 5px;'>
									Project Title :
								</td>
								<td class="tdValue" style='padding:0px 5px 0px 5px; letter-spacing:.5px;'><?= $projectName  ?></td>
							</tr>
							<tr>
								<td class="tdLabel" style='padding:7px 0px 0px 5px;'>
									Expense Code :
								</td>
								<td class="tdValue"><?= $expCode ?></td>
							</tr>
							<tr>
								<td class="tdLabel" style='padding:0px 0px 5px 5px;'>
									Type :
								</td>
								<td class="tdValue" style='padding:0px 0px 15px 5px;'><?= $expTitle ?></td>
							</tr>
							<tr>
								<td class="tdLabel" style='padding:0px 0px 0px 5px;'>
									Location :
								</td>
								<td class="tdValue" style='padding:0px 5px 0px 5px; letter-spacing:.5px;'><?= $location ?></td>
							</tr>
							<tr>
								<td class="tdLabel" style='padding:0px 0px 0px 5px;'>
									Duration :
								</td>
								<td class="tdValue" style='padding:0px 5px 0px 5px; letter-spacing:.5px;'><?= $duration ?></td>
							</tr>
							<tr><td colspan='2' style='padding:3px;'></td></tr>
							
							<tr>
								<td colspan='2' style='text-align:right; border-top:1px solid silver; padding:5px 15px 0px 0px;'>
									<span style='margin-right:10px; font-size:13px; letter-spacing:1px;'>Budget Amount</span>
									<span style='font-weight:bold;'><?= number_format($amount,2) ?></span>
								</td>
							</tr>
						</tbody>
					</table>	
				</td>
			</tr>
			<tr>
				<td style="height:10%; padding-bottom:20px;">
					<table border="0" style="font-size:12px;">
						<tr>
							<td colspan="2">
								<div style='text-align:left; padding-left:8px;'>Prepared by :</div>
								<div style='margin-top:16px;'><input style='border:0px; text-align:center; font-size:14px; width:250px; padding:3px 0px; font-weight:bold;' placeholder='Name' type='text' value ="<?php echo $preparedBy; ?>"></div>
								<div style='margin-bottom:12px;'>
									<input style='border:0px; text-align:center; font-size:12px; width:250px; padding:3px 0px; border-top:1px solid black;' placeholder='Position' type='text' value = "<?php echo $division; ?>" >
									<div style = "text-align: center;line-height: 8px;font-size:11px;font-family: tahoma;"><?php echo $preparedOffice; ?></div>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="text-align:right; height:1%; font-size:10px; padding:5px; background-color:rgba(242,242,242,1);">
					<span style="margin-right:8px;float:left;letter-spacing:1px;">www.davaocityportal.com</span>
					<span style="margin-right:8px;"><strong>Date Encoded</strong> :<?= $dateEncoded ?></span>
					<span style=""><strong>Date Printed</strong> :<?= $datePrinted ?></span>
				</td>
			</tr>
		</table>	
	
	

</body>
</html>
