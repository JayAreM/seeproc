<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	$officeName = str_replace("\\",'',$database->charEncoder($_GET['officeName']));
	//$officeName = $_GET['officeName'];
	
	$payee = str_replace("\\",'',$database->charEncoder($_GET['payee']));	
?>

<style>
	body{
		font-family:arial;
	}
	#tableMainForm{
		margin:0 auto;
		margin-top:50px;
		width:670px;
		border-spacing:0;
	}
	
	#logo{
		width:100px;
		height:100px;
		margin:0 auto;
		background:url(../images/davaologo.jpg);	
		background-repeat:no-repeat;
		background-size:100% 100%; 
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
</style>
<link rel="icon" href="/city/images/print.png"/> 
<title>OBR View</title>

<?php

	$sql = "SELECT * FROM vouchercurrent WHERE TrackingNumber = '".$trackingNumber."' ORDER BY PR_ProgramCode,PR_AccountCode";
	$record = $database->query($sql);

	
	$newRecord = [];
	$codes = [];
	$prgCodes = '';
	$accCodes = '';
	$cnt = 0;
	while($data = $database->fetch_array($record)) {
		if($cnt == 0) {
			$newRecord['TrackingNumber'] = $data['TrackingNumber'];
			$newRecord['OBR_Number'] = $data['OBR_Number'];
			$newRecord['Claimant'] = $data['Claimant'];

			$subCode = $data['SubCode'];
			$sub = 0;
			if($subCode > 0){
				$sub = $subCode;
			}
			$newRecord['SubCode'] = $sub;
			
			$newRecord['TrackingType'] = $data['TrackingType'];
			$newRecord['ChargeType'] = $data['ChargeType'];
			$newRecord['PeriodMonth'] = $data['PeriodMonth'];
			$newRecord['Office'] = $data['Office'];
			$newRecord['ProjectId'] = $data['ProjectId'];
		}
		$cnt++;

		$prg = $data['PR_ProgramCode'];
		$acc = $data['PR_AccountCode'];

		if($newRecord['TrackingType'] == "PO"){
			$amount = $data['PO_Amount'];
			// $officeName = '';
		}else{
			$amount = $data['Amount'];
		}

		$total = $data['TotalAmountMultiple'];
		if($total > 0) {
			$newRecord['TotalAmountMultiple'] = $total;
		}else {
			$newRecord['TotalAmountMultiple'] = $amount;
		}

		$codes[$prg][$acc] = $prg . '~' . $acc . '~' . $amount . '~' . $newRecord['TotalAmountMultiple'];
		$prgCodes .= ",'".$prg."'";
		$accCodes .= ",'".$acc."'";
	}

	unset($data);

	$newRecord['OfficeName'] = $officeName;
	$newRecord['Payee'] = $payee;

	if($newRecord['SubCode'] > 0) {
		$sql = "SELECT * FROM subprogramcode WHERE SubCode = '" . $sub . "' LIMIT 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$newRecord['SubTitle'] = $data['Description'];

		unset($data);
	}else {
		$newRecord['SubTitle'] = '';
	}

	if($newRecord['Claimant'] != '') {

		$sql = "SELECT Name, Address FROM supplier.supplierinfo WHERE Name = '".addslashes($newRecord['Claimant'])."' LIMIT 1";
		$record = $database->query($sql);
		if($database->num_rows($record) > 0) {
			$data = $database->fetch_array($record);
			$newRecord['Address'] = $data['Address'];
			unset($data);

			if($newRecord['TrackingType'] != "PO"){ 
				$newRecord['Address'] = '';
			}
		}else {
			$newRecord['Address'] = '';
		}
		
	}else {
		$newRecord['Address'] = '';
	}

	$sql = "SELECT OBRParticulars FROM particulars WHERE TrackingNumber = '" . $trackingNumber . "' LIMIT 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	if($database->num_rows($record) > 0) {
		$newRecord['OBRParticulars'] = $data['OBRParticulars'];
	}else {
		$newRecord['OBRParticulars'] = '';
	}

	unset($data);

	$grp = '';
	if($prgCodes != "") {
		$prgNames = [];
		$sql = "SELECT Code, Name FROM programcode WHERE Code IN (".substr($prgCodes, 1).") LIMIT ".substr_count($prgCodes, ',');
		$record = $database->query($sql);
		while($data = $database->fetch_array($record)) {
			$code = $data['Code'];
			$name = $data['Name'];

			$prgNames[$code] = $name;
		}

		unset($data);

		$accNames = [];
		$sql = "SELECT Code, Title FROM fundtitles WHERE Code IN (".substr($accCodes, 1).") LIMIT ".substr_count($accCodes, ',');
		$record = $database->query($sql);
		while($data = $database->fetch_array($record)) {
			$code = $data['Code'];
			$title = $data['Title'];

			$accNames[$code] = $title;
		}

		unset($data);

		foreach ($codes as $progCode => $waccCodes) {
			foreach ($waccCodes as $accCode => $grpPart1) {
				$prgName1 = '';
				if(isset($prgNames[$progCode])) {
					$prgName1 = $prgNames[$progCode];
				}
				$grp .= '*'.$grpPart1.'~'.$prgName1.'~'.$accNames[$accCode];
			}
		}

		unset($codes);
		unset($prgNames);
		unset($accNames);	
	}

	$newRecord['GRP'] = substr($grp, 1);

	$newRecord['ProjectName'] = "";

	if($newRecord['ProjectId'] > 0) {
		$sql = "SELECT * FROM disasterprojects WHERE Id = '".$newRecord['ProjectId']."' LIMIT 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
	
		$newRecord['ProjectName'] = $data['Name'];
	}

	echo $sheet->CreateFormOBR($newRecord);
?>
<script>
	
	function setToCookieName(me){
		var obrCertified =   me.value.trim();
		setCookie("obrCertifiedBy",obrCertified, 100);
	}
	function setToCookieDesignation(me){
		var obrCertifiedDesignation =   me.value.trim();
		setCookie("obrCertifiedDesignation",obrCertifiedDesignation, 100);
	}

	var thisCount = 3;
	var contEntry = 0;
	function checkBeforeSave() {
		thisCount = 3;
		if (contEntry == 0) {
			contEntry = 1;
			saveParticulars();
		}
	}

	function saveParticulars() {
		var tn = document.getElementById('trackingNum').innerText;
		var particulars = encodeURIComponent(document.getElementById('obrParticulars').value);

		var queryString = "?updateOBRParticulars=1&trackingNumber="+tn+"&obrparticulars="+particulars;
		var container = "";
		
		console.log(thisCount);
		thisCount--;
		if (thisCount > 0) {
			setTimeout("saveParticulars()", 400);
		} else {
			loadSaving();
			thisCount = 3;
			contEntry = 0;
			ajaxGetAndConcatenate(queryString, processorLink, container, "updateOBRParticulars");
		}
	}

	function loadSaving() {
		var saving = document.getElementById("showSaving");
		if (saving.style.display == "none") {
			saving.style.display = "inline-block";
		} else {
			saving.style.display = "none";
		}
	}
</script>
