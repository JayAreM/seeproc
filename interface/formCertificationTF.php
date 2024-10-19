<?php
	
	require_once('../includes/database.php');
	$database->oopsRedirect(2023,1081,7,0);
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	
	$dt = time();
	$datePrinted = date('Y-m-d h:i A', $dt);
	$currentYear = date('Y');
	
	$month = date('F', $dt);
	$day =  date('j', $dt);
	$day = $database->ordinal($day);
	
	$sql ="select Year,PR_ProgramCode,Amount from vouchercurrent where TrackingNumber = '"  . $trackingNumber. "' limit 1";
	$record =$database->query($sql);
	$data =$database->fetch_array($record);
	$code = $data['PR_ProgramCode'];
	$amount = $data['Amount'];
	$amountWords = $database->numWordsFinal($amount);
	$year = $data['Year'];
	
	
	$sql ="select Requestor,RequestorTitle,Fund, ReferenceCert from infra where TrackingNumber = '"  . $trackingNumber. "' limit 1";
	$record =$database->query($sql);
	$data =$database->fetch_array($record);
	
	$ref = $data['ReferenceCert'];
	$requestor = $data['Requestor'];
	$title = $data['RequestorTitle'];
	$fund = $data['Fund'];
	if(strlen($fund) == 0){
		$fund = '-------------------------';
	}
	if($requestor ==''){
		$requestor ='__________';
	}
	if($title ==''){
		$title ='__________';
	}
	
	if(strlen($ref) == 0){
		$sql ="select TF from citydoc.defaults where YearFundEncoded = '" . $currentYear . "' limit 1";
		$record = $database->query($sql);
		$data = $data = $database->fetch_array($record);
		$seq = $data['TF'] + 1;
		$ref = 'CAO-' . $currentYear . '-' . $seq;
	}
	
	$sql ="select Name from programcode where Code = '"  . $code. "' limit 1";
	$record =$database->query($sql);
	$data =$database->fetch_array($record);
	$description = utf8_encode($data['Name']);
	
	
	
	
	
	$sql ="select * from citydoc.signatories where form = 'Certificate of Available Appropriation' order by sunod asc";
	$record =$database->query($sql);
	$data =$database->fetch_array($record);
	$office = $data['Office'];
	
	$data =$database->fetch_array($record);
	$controller = utf8_encode($data['Name']);
	$controllerTitle = $data['Title'];
	
	
	
	
	
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
			background:url(../images/acctg2.png);	
			background-repeat:no-repeat;
			background-size:100% 100%; 
		}
		.fund:hover{
			cursor:pointer;
			background-color:rgb(254, 250, 3);
		}
	</style>

</head>
<body>

	<table border="0" style = "height:100%;width:750px; border-spacing:0px;margin:0 auto;">
		<!--<tr>
			<td style="height:10%;padding-top:20px;height:120px;">
				<table border="0" style ="width:100%;border-spacing:0;">
					<tr>
						<td style= "padding:0px;width:155px;"></td>
						<td style ="text-align:center;">
							<div style ="width:445px;border:">
								<div id = "logo"></div>
								<div style = "font-size:20px;font-weight:bold;">Republic of the Philippines</div>
								<div style = "font-size:16px;">City Government of Davao</div>
							</div>
						</td>
						<td style= "font-size:12px; vertical-align:bottom;  text-align:right;width:150px;line-height: 16px;padding-right: 15px;">
							<div>TN&nbsp;:&nbsp;&nbsp;<span style="font-size:20px;letter-spacing:1px;font-weight: bold;"><?= $trackingNumber ?></span></div>
							<span style="font-weight: normal; padding-right: 3px;">DocTrack <span style=" font-size: 16px;font-weight: bold;"><?php echo $year; ?></span></span>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style= "line-height: 20px;height:10px;" >
				
				<div style = "font-size:24px;text-align:center;font-weight:bold;letter-spacing:4px;border-top:2px solid black;padding-top:25px;">CERTIFICATION</div>
				<div style ="text-align:center;font-weight:normal;font-size: 14px;">Ref. No. <?php echo $ref;?></div>
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
								<div style = "font-size:22;font-weight: bold;">OFFICE OF THE CITY ACCOUNTANT</div>
								<div style = "font-size:13;">Trunk Line: Tel. No. 241-1000 locs:251 to 255 </div>
								<div style = "font-size:13;">Email add: cao@davaocity.gov.ph</div>
								
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
				<div style = "font-size:20px;text-align:center;font-weight:bold;letter-spacing:4px;padding-top:25px;">CERTIFICATION</div>
				<div style ="text-align:center;font-weight:normal;font-size: 14px;">Ref. No. <?php echo $ref;?></div>
			</td>
		</tr>
		
		
		
		<tr>
			<td style="vertical-align:top;">
				<table border="0" style="margin-left:35px;margin-right:35px;">
					<tbody>
						<tr >
							<td style="font-size:15px;text-align: justify;">
								<br>
								<p style="font-weight: bold;">To Whom It May Concern :</p>
								<p style ="text-indent: 50px;">This is to certify that the amount of <b><?php echo ucwords($amountWords);?> (P<?php echo number_format($amount,2); ?>)</b>
								 is available   
								 in the books of accounts of the City Government of Davao under <span class = "fund" id ="<?php echo $trackingNumber . '*' . $ref; ?>" onclick = "showInputter(this)"><?php echo $fund; ?></span>,  for the <b><?php echo $description; ?></b>, with Project Code No. <?php echo $code?>.</p>
								 
								<p style ="text-indent: 50px;">This certification is issued upon the request of  <?php echo $requestor;?>, <?php echo $title; ?>, <?php echo $office;?>, 
								 	for whatever legal purpose this may serve best.
								</p>
								 
								<p style ="text-indent: 50px;">Issued this <?php echo $day; ?> day of <?php echo $month?>, <?php echo $year; ?>, Davao City. </p>
								 <br/><br/>
								 <table style="text-align: center;float:right;line-height: 12px;margin-right:20px;font-size:15px;">
								 	<tr><td><b><?php echo strtoupper($controller);?></b></td></tr>
								 	<tr><td><?php echo $controllerTitle;?></td></tr>
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
<script>
	function showInputter(me){
		var arr = me.id.split('*');
		var trackingNumber = arr[0];
		var reference = arr[1];
		
		
		let fund = prompt("Please source of fund", me.innerHTML);
		if(fund.length == 0){
			me.innerHTML = '-------------------------';
		}else{
			me.innerHTML = fund;
			var queryString = "?updateInfraTF=1&trackingNumber=" + trackingNumber + "&fund=" + fund + "&reference=" + reference;
			var container = "";			
			ajaxGetAndConcatenate(queryString,processorLink,container,"noReturn");
		}
		
		
	}
</script>