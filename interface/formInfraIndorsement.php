<?php
	
	require_once('../includes/database.php');
	//$database->oopsRedirect(2022,1081,2,0);
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');

	$dt = time();
	$datePrinted = date('Y-m-d h:i A', $dt);
	$displayDate = date('Y-m-d', $dt);
	$type = $database->charEncoder($_GET['type']);
	$value = $database->charEncoder($_GET['value']);
	$year = $database->charEncoder($_GET['year']);
	if($type == "indo1"){
		
		$arr = explode('-',$value);
		
		$month = $arr[0];
		if($month < 10){
			if(strlen($month) == 1 ){
				$month = '0' . $month;
			}
		}
		$arr1  = explode(',',$arr[1]);
		$newValue ='';
		for($i = 0; $i < sizeof($arr1); $i++){
			if($arr1[$i] < 10){
				$day =  $arr1[$i];
				if(strlen($arr1[$i]) == 1 ){
					$day = '0' . $arr1[$i];
				}
				
			}	
			$newValue .= ",'" .  $year . '-' . $month . '-' . $day . "'" ;
			
			
		}
		$newValue = substr($newValue, 1);
		
		
		$sql = "SELECT TrackingNumber, Amount, PR_ProgramCode, Fund
				FROM vouchercurrent
				WHERE documenttype = 'Infrastructure Project' and substr(DateEncoded, 1, 10) in (" . $newValue . ")";
		
		
		$record = $database->query($sql);
		
		$rows = [];
		$prgs = [];
		$acct = [];

		$prgsStr = "";
		$acctStr = "";
		while($data = $database->fetch_array($record)){
			$amount = $data['Amount'];
			$fund = $data['Fund'];
			$prgCode = $data['PR_ProgramCode'];
			$prgsStr .= ",'".$prgCode."'";
			$rows[] = $prgCode."*".$amount."*".$fund;
		}

		$prgsStr = substr($prgsStr, 1);
	}
	if($type == "indo2"){
		$sql = "SELECT a.TrackingNumber, a.Amount, a.PR_ProgramCode, a.Fund from vouchercurrent a left join infra b on a.TrackingNumber = b.TrackingNumber where b.BatchNumber = '" . $value . "'";
		$record = $database->query($sql);
		$rows = [];
		$prgs = [];
		$acct = [];
		$prgsStr = "";
		$acctStr = "";
		while($data = $database->fetch_array($record)){
			$amount = $data['Amount'];
			$fund = $data['Fund'];
			$prgCode = $data['PR_ProgramCode'];
			$prgsStr .= ",'".$prgCode."'";
			$rows[] = $prgCode."*".$amount."*". $fund;
		}
		$prgsStr = substr($prgsStr, 1);
	}
	
	$count = $database->num_rows($record);
	if($count == 0){
		echo "No record found for this value : <b>" . $value . "</b>";
		return false;
	}

	$sql = "SELECT Code, Name FROM programcode WHERE Code IN (".$prgsStr.")";
	$record = $database->query($sql);
	while($data = $database->fetch_array($record)){
		$prgs[strval($data['Code'])] = $data['Name'];
	}

	$sheet = "";
	for ($i=0; $i < sizeof($rows); $i++) { 
		$temp = explode("*",$rows[$i]);
		$prgCode = $temp[0];
		$amount = $temp[1];
		$fund = $temp[2];
		if(strtoupper($fund) == "GENERAL FUND"){
			$fund= "GF";
		}else if(strtoupper($fund) == "SEF"){
			$fund= "SEF";
		}else{
			$fund= "TF";
		}
		$prgName = $prgs[$prgCode];
		$sheet .= "	<tr>
						<td style = 'text-align:center;vertical-align:top;'>".($i+1)."</td>
						<td style = 'text-align:center;vertical-align:top;'>".$prgCode."</td>
						<td style = 'center;vertical-align:top;'>". utf8_encode($prgName) ."</td>
						<td style = 'center;vertical-align:top;text-align:center;'>".$fund."</td>
						<td style = 'text-align:right;vertical-align:top;'>Php ".number_format($amount, 2)."</td>
					</tr>"; 
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/city/images/print.png"/> 
	<title>Indorsement</title>
	
	<style>
		@font-face {
	        font-family: "Abel";
	        src: url(../fonts/Abel-Regular.ttf);
		
		}
		body{
			font-family:Abel;
			padding:0;
			margin:0;
		}
		
		#logo{
			width:90px;
			height:90px;
			margin:0 auto;
			background:url(../images/davaologo.jpg);	
			background-repeat:no-repeat;
			background-size:100% 100%; 
			
			position: absolute;
			margin-top:-20px;
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

		#tableProjects{
			width: 100%;
			border-spacing:0px;
			/*border: 1px solid silver;*/
		}


		#tableProjects th{
			border: 1px solid silver;
			border-right: 0px;
			padding: 3px 5px;
		}
		#tableProjects th:last-child{
			border-right: 1px solid silver;
		}


		#tableProjects td{
			border: 1px solid silver;
			border-right: 0px;
			border-top: 0px;
			padding: 3px 5px;
		}
		#tableProjects td:first-child{
			text-align: center;
		}
		#tableProjects td:last-child{
			border-right: 1px solid silver;
		}
	</style>

</head>
<body>

	<table border="0" style = "height:100%;width:750px; border-spacing:0px;margin:0 auto;">
		<tr>
			<td style="height:10%;padding-top:20px;height:120px;">
				<table border="0" style ="width:100%;border-spacing:0;">
					<tr>
						<td style= "padding:0px;width:155px;"></td>
						<td style ="text-align:center;">
							<div style ="width:445px;border:">
								<div id = "logo"></div>
								<div style = "font-size:14px;">Republic of the Philippines</div>
								<div style = "font-size:20px;font-weight:bold;">OFFICE OF THE CITY ENGINEER</div>
								<div style = "font-size:16px;">City of Davao</div>
							</div>
						</td>
						<td style= "font-size:12px; vertical-align:bottom;  text-align:right;width:150px;line-height: 16px;padding-right: 15px;">
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style= "line-height: 22px;height: 100px;vertical-align:top;" >
				<div style = "font-size:24px;text-align:center;font-weight:bold;letter-spacing:2px;border-top:2px solid black;padding-top:25px;">1<sup>st</sup> Indorsement</div>
				<div style ="text-align:center;font-weight:normal;font-size: 14px;"><?= $displayDate ?></div>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div style="text-indent:50px; text-align: justify;">
					Respectfully forwarded to <span id="signatory1" style="font-weight:bold;">Atty. Osmundo P. Villanueva</span>, Chairman, Bids and Award Committee,
					the herein approved Plans and Program of Works and Technical Specification of the following projects requesting for schedule of procurement/bidding
					the soonest possible time.
				</div>
				<div style="padding:10px 0px;">
					<table id="tableProjects" border="0" style="">
						<thead>
							<tr>
								<th>No.</th>
								<th>Project Code</th>
								<th>Project Title</th>
								<th>Source of Fund</th>
								<th>Approved Budget for the Contract (ABC)</th>
							</tr>
						</thead>
						<tbody><?= $sheet ?></tbody>
					</table>
				</div>
				<div style="text-indent:50px; text-align: justify;">
					Your favorable action herein is highly appreciated.
				</div>
			</td>
		</tr>
		
		<tr>
			<td style="text-align:right; height:1%; font-size:10px; padding:2px px;">
				<table border="0" style="text-align: center; border-spacing:0px; display:inline-block;">
					<tr>
						<td style="padding-bottom:50px;">Very truly yours,</td>
					</tr>
					<tr>
						<td>
							<span id="signatory2" style="font-weight: bold; text-transform: uppercase;">ATTY. JOSEPH DOMINIC S. FELIZARTA, C.E., EnP</span>
						</td>
					</tr>
					<tr>
						<td>Officer-In-Charge</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>	

</body>
</html>
