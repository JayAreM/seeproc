<?php
	
	require_once('../includes/database.php');
	$database->oopsRedirect(2023,1071,2,0);
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	$sql ="select Year,PR_ProgramCode,Amount from vouchercurrent where TrackingNumber = '"  . $trackingNumber. "' limit 1";
	$record =$database->query($sql);
	$data =$database->fetch_array($record);
	$code = $data['PR_ProgramCode'];
	$amount = $data['Amount'];
	$amountWords = $database->numWordsFinal($amount);
	$year = $data['Year'];
	
	
	$sql ="select Requestor,RequestorTitle from infra where TrackingNumber = '"  . $trackingNumber. "' limit 1";
	$record =$database->query($sql);
	$data =$database->fetch_array($record);
	$requestor = $data['Requestor'];
	$title = $data['RequestorTitle'];
	if($requestor ==''){
		$requestor ='__________';
	}
	if($title ==''){
		$title ='__________';
	}
	
	
	$sql ="select Name,FundYear,Lump,Entry from programcode where TrackingNumberInfra = '"  . $trackingNumber. "' limit 1";
	$record =$database->query($sql);
	$data =$database->fetch_array($record);
	$description = utf8_encode($data['Name']);
	$fundYear = $data['FundYear'];
	$lump = $data['Lump'];
	$entry = $data['Entry'];
	
	$entryType = $entry;
	if($entry =="Regular"){
		$entryType = "ADF";
	}
	
	$fundDescription = '';
	$projectCode = ', with Project Code No.' . $code . '.';
	
	if(strlen($lump) > 0){
		$projectCode = '.';
		$sql ="select Name from programcode where Code = '"  . $code. "' limit 1";
		$record =$database->query($sql);
		$data =$database->fetch_array($record);
		$fundDescription = ' ' . $code . ' ' . $data['Name'] ;
	}
	
	
	
	$dt = time();
	$datePrinted = date('Y-m-d h:i A', $dt);
	$month = date('F', $dt);
	$day =  date('j', $dt);
	$day = $database->ordinal($day);
	
	$sql ="select * from citydoc.signatories where form = 'Certificate of Availability of Fund' order by sunod asc";
	$record =$database->query($sql);
	$data =$database->fetch_array($record);
	$office = $data['Office'];
	
	$data =$database->fetch_array($record);
	$budgetOfficer =utf8_encode($data['Name']);
	$budgetOfficerTitle = $data['Title'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/city/images/print.png"/> 
	<title>Certification</title>
	
	<style>
		@font-face {
	        font-family: "Abel";
	        src: url(../fonts/Abel-Regular.ttf);
		
		}
		body{
			font-family:Tahoma;
			padding:0;
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
		#logo1{
			width:120px;
			height:120px;
			background:url(../images/cbo.png);	
			background-repeat:no-repeat;
			background-size:100% 100%; 
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

	<table border="0" style = "height:100%;width:750px; border-spacing:0px;margin:0 auto;">
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
								<div style = "font-size:26;font-weight: bold;">CITY BUDGET OFFICE</div>
								<div style = "font-size:13;">Trunk Line: Tel. No. 241-1000 locs:208; 210; 274 </div>
								<div style = "font-size:13;">Email add: cbo@davaocity.gov.ph</div>
								
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
			<td style= "line-height: 16px;height:10px;padding-top:10px;border-top:2px solid black;text-align: right;" >
						<div>TN&nbsp;:&nbsp;&nbsp;<span style="font-size:16px;"><?= $trackingNumber ?></span></div>
						<span style="font-weight: normal; padding-right: 3px;font-size: 14px;">DocTrack <span style=" font-size: 14px;"><?php echo $year; ?></span></span>
			</td>
		</tr>
		<tr>
			<td style= "line-height: 24px;height:10px;padding-top:10px;" >
				<div style ="text-align:center;font-weight:normal;font-size: 14px;padding-top:45px;">Ref. No. CBO-<?php echo $year;?>-<input style = "width:50px; border:0;border-bottom: 1px solid black;"></div>
				<div style = "font-size:20px;text-align:center;font-weight:bold;letter-spacing:7px;">CERTIFICATION</div>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<table border="0" style="margin-left:35px;margin-right:35px;">
					<tbody>
						<tr >
							<td style="font-size:15px;text-align: justify;">
								<br>
								<p style="font-style:italic;font-weight: bold;">To Whom It May Concern :</p>
								<p style ="text-indent: 50px;">This is to certify that the appropriation of <b><?php echo ucwords($amountWords);?> (P<?php echo number_format($amount,2); ?>)</b>
								 is available under <?php echo $fundDescription; ?> <?php echo $entryType; ?>, CY<?php echo $fundYear;?>, for the <b><?php echo $description; ?></b><?php echo $projectCode ?></p>
								 
								<p style ="text-indent: 50px;">This certification is issued upon the request of  <?php echo $requestor;?>, <?php echo $title; ?>, <?php echo $office;?>, 
								 	for whatever legal purpose this may serve best.
								</p>
								 
								<p style ="text-indent: 50px;">Issued this <?php echo $day; ?> day of <?php echo $month?>, <?php echo $year; ?>, Davao City. </p>
								 <br/><br/>
								 <table style="text-align: center;float:right;line-height: 12px;font-size:15px;margin-right:20px;">
								 	<tr><td><b><?php echo strtoupper($budgetOfficer);?></b></td></tr>
								 	<tr><td><?php echo $budgetOfficerTitle;?></td></tr>
								 </table>	
							</td>
						</tr>
					</tbody>
				</table>	
			</td>
		</tr>
		
		<tr>
			<td style="text-align:right; height:1%; font-size:10px; padding:2px px; background-color:rgba(242,242,242,1);">
				<span style ="float:left;">www.davaocityportal.com</span><span style=""><strong>Date Printed</strong> :<?= $datePrinted ?></span>
			</td>
		</tr>
	</table>	

</body>
</html>
