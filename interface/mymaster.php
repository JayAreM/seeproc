<?php
	session_start();

	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	/*$year = $database->charEncoder($_GET['year']);
	$trackingNumber = $database->charEncoder($_GET['tn']);
	$officeName ='';*/
	/*$dt = time();
	$datePrinted = date('Y-m-d h:i A', $dt);
	$year  = 2022;
	$db = $database->getDB($year);*/
	
	
	/*if(isset($_SESSION['perm'])){
		if(isset($_SESSION['accountType'])){
			$perm =  $_SESSION['perm'];
			$type =  $_SESSION['accountType'];	
		}else{
			$perm = 0;
			$type = 0;
		}
	}else{
		$perm = 0;
		$type = 0;
	}*/
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/citydoc2023/images/paymaster.jpg"/> 
	<title>Paymaster's List</title>
	<style>
		/*-----------------------------------------------------------------loader*/
		.loader{
				width:200px;
				height:200px;
				top:40%;
				background:url('../images/ajaxloader.gif');
				background-repeat:no-repeat;
			
				background-size:200px 200px;
				background-position:48% 48%;
				z-index:100;
				
		}	
		.loaderContainer{
			border:4px solid transparent;
			border-radius:2px;
			display:inline-block;	
			
		}
		.absoluteHolder1{
			z-index:105;
			position:absolute;
			text-align:center;
			background-color:rgba(252, 254, 254,.4);
			width:100%;
			height:100%;
		}
		
		@font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
		}
		@font-face {
			font-family: "NOR";
			src: url("../fonts/Abel-Regular.ttf");
		}
		@font-face {
			font-family: "curl";
			src: url("../fonts/AlexBrush-Regular.ttf");
		}
		body{
			font-family:NOR;
			padding: 0;
			margin:0;
		}
		.innerModified{
			color:black;
			font-weight: normal;
		}
		#paymasterSoloTable1 {
			width:100%;
			border-spacing: 0px;
			cursor: pointer;
			font-size: 12px;
			
		}
		#paymasterSoloTable1 th{
			border-bottom: 1px solid silver;
			background-color: rgb(234, 234, 233);
		}
		#paymasterSoloTable1 tr:nth-last-child(even)  {
			background-color: rgb(246, 252, 241);
		}
		#paymasterSoloTable1  th  {
			padding:2px 5px;
			font-family: Arial;
			
		}
		#paymasterSoloTable1  td  {
			padding:4px 5px;
			border-bottom: 1px solid silver;
			vertical-align: top;
		}
		#paymasterSoloTable1 tr:hover > td  {
			
			background-color: rgb(102, 177, 49);
			color:white;
			border-bottom: 1px solid green;
			border-top: 1px solid green;
			
		}
		
		.statusDiff{
			font-weight:bold;
			color:rgb(125, 173, 29);
		}
		
		
		#paymasterSoloTable2 {
			width:100%;
			border-spacing: 0px;
			cursor: pointer;
			font-size: 12px;
		}
		#paymasterSoloTable2 th{
			border-bottom: 1px solid silver;
			background-color: rgb(250, 235, 74);
		}
		#paymasterSoloTable2 tr:nth-last-child(even) {
			background-color: rgb(246, 252, 241);
		}
		#paymasterSoloTable2  th  {
			padding:2px 5px;
			font-family: Arial;
			font-size: 12px;
		}
		#paymasterSoloTable2  td  {
			padding:4px 5px;
			border-bottom: 1px solid rgb(242, 239, 208);
		}
		
		#paymasterSoloTable2 tr:hover > td  {
			
			background-color: rgb(102, 177, 49);
			color:white;
			border-bottom: 1px solid green;
			border-top: 1px solid green;
			text-shadow: 0px 0px 2px black;
		}
		#paymasterSoloTable2 tr:hover > td:first-child {
			border-right: 0px;
		}
		
		#paymasterSoloTable3 {
			width:100%;
			border-spacing: 0px;
			cursor: pointer;
			font-size: 12px;
		}
		#paymasterSoloTable3 th{
			border-bottom: 1px solid silver;
			border-top: 1px solid silver;
			background-color: rgb(245, 249, 248);
		}
		#paymasterSoloTable3 tr:nth-last-child(even) {
			background-color: rgb(246, 252, 241);
		}
		#paymasterSoloTable3  th  {
			padding:2px 5px;
			font-family: Arial;
			font-size: 12px;
		}
		#paymasterSoloTable3  td  {
			padding:4px 5px;
			border-bottom: 1px solid rgb(242, 239, 208);
		}
		
		#paymasterSoloTable3 tr:hover > td  {
			
			background-color: rgb(102, 177, 49);
			color:white;
			border-bottom: 1px solid green;
			border-top: 1px solid green;
			text-shadow: 0px 0px 2px black;
		}
		#paymasterSoloTable3 tr:hover > td:first-child {
			border-right: 0px;
		}
		
		
		.trClick1{
			background-color:rgb(102, 177, 49);
			color:white;
			border-bottom: 1px solid green;
			border-top: 1px solid green;
			text-shadow: 0px 0px 2px black;
		}
		.trClick2{
			background-color:rgb(237, 226, 109);
			color:white;
			border-bottom: 1px solid green;
			border-top: 1px solid green;
			text-shadow: 0px 0px 2px black;
		}
		
	</style>

</head>

<?php
	
	$sql = "SELECT distinct(PMClaimant) as Paymaster FROM chequerist.paymaster order by Paymaster";
	$record = $database->query($sql);
	$sheet = '<select style ="padding:5px;float:right;width:180px;" onchange = "fetchTransaction(this)">';
	$sheet .= '<option></option>';
	while($data = $database->fetch_array($record)){
		$paymaster = $data['Paymaster'];
		$sheet .= '<option>' . $paymaster . '</option>';
	}
	$sheet .= '</select>';

?>

<body>

	<!-- 
		8.5 in = 816 px 
		11 in = 1056 px 
		break-inside:avoid; page-break-inside:avoid;
	--> 
	
	<div style="width:100%;  margin:0 auto;vertical-align: top;">
		<table border="0" cellpadding="0" cellspacing="0" style="border-spacing:0px; margin:0 auto; ;text-align: center;border:1px solid rgb(245, 245, 241);min-width:355px;">
			<tr style="background-color: rgb(121, 159, 107);color:white;background-image: linear-gradient(to bottom left, rgb(121, 159, 107) , rgb(157, 183, 12))">
				<td style="padding:10px;font-weight: bold;" colspan="2">
					<span style = "color:rgb(56, 109, 3);text-shadow: 0px 0px 5px grey;font-size:20px; font-weight:normal;font-family: curl;letter-spacing:1px;margin-right: 2px;">MY</span><span style ="font-weight: normal;color:black;font-size:12px;">PAY</span>MASTER'S VIEWER
				</td>
			</tr>
			<tr>
				<td style="border-top:1px solid green;border-bottom:1px solid rgb(198, 208, 135);" ></td>
			</tr>
			<tr>
				<td colspan ="2" style="text-align: right;padding:10px 5px;background-color: rgb(246, 249, 228);"> <div style ="padding-top:5px;padding-right:5px;display:inline-block;">Disbursement Officer</div><?php  echo $sheet; ?></td>
			</tr>
			<tr>
				<td style="border-top:1px solid rgb(236, 239, 217);border-bottom:1px solid rgb(198, 208, 135);" ></td>
			</tr>
			<tr>
				<td style="" colspan ="2" id ="paymasterSoloContainer1"></td>
			</tr>
			<tr>
				<td style="vertical-align:top;" colspan ="2" id ="paymasterSoloContainer2"></td>
			</tr>
			<tr>
				<td style="vertical-align:top;" colspan ="2" id ="paymasterSoloContainer3"></td>
			</tr>
			<tr>
				<td style="vertical-align:top;font-size: 10px;color:grey;padding:10px;line-height: 12px;" colspan ="2" onclick ="window.open('../interface/main.php')">
					www.davaocityportal.com
					<div style = "line-height: 8px; font-size: 8px;color:black;letter-spacing:1px;">2022.06.14</div>
					<div style = "line-height: 8px; font-size: 8px;color:rgb(190, 196, 185);opacity:.5;">vb</div>
				</td>
			</tr>
		</table>
	</div>
	<br>
	
</body>
</html>
<script>
	function fetchTransaction(me){
		var name  = me.value;
		var o = vScram(name)
		var queryString = "?fetchPaymasterSolo=1&name="+o;
		var container = document.getElementById("paymasterSoloContainer1");
		
		loader();
		ajaxGetAndConcatenate(queryString, processorLink, container, "returnOnlyLoader");
		
		paymasterSoloContainer2.innerHTML = "";
		paymasterSoloContainer3.innerHTML = "";
	}
	
	function fetchPayroll1(me){
		
		changeColorTRpaymaster1(me);
		var arr = me.id.split("*");
		var year = arr[0];
		var tn = arr[1];
		
		var o = vScram(year + "**" + tn);
		var queryString = "?fetchPaymasterSoloPayroll=1&test=" + o;
		var container = document.getElementById("paymasterSoloContainer2");
		loader();
		ajaxGetAndConcatenate(queryString, processorLink, container, "returnOnlyLoader");
		
		paymasterSoloContainer3.innerHTML = "";
		
	}
	function fetchPayroll2(me){
		changeColorTRpaymaster2(me);
		var arr = me.id.split("**");
		var year = arr[0];
		var tn = arr[1];
		
		var office = me.children[1].textContent;
		var firstPerson = me.children[3].textContent;
		
		var o = vScram(year + "**" + tn + "**" + firstPerson+ "**" + office);
		var queryString = "?fetchPaymasterSoloPayrollVoucher=1&test=" + o;
		var container = document.getElementById("paymasterSoloContainer3");
		loader();
		ajaxGetAndConcatenate(queryString, processorLink, container, "returnOnlyLoader");
	}
	var lastRow1 = '0';
	var lastRow2 = '0';
	var lastRow3 = '0';
	
	function changeColorTRpaymaster1(me){
		if(lastRow1 > 0){
			if(paymasterSoloTable1.children[0].children[lastRow1]){
				tr = paymasterSoloTable1.children[0].children[lastRow1];
				for(var i = 0 ; i < tr.children.length; i++){
					tr.children[i].className = '';
					tr.children[i].style.fontWeight ="normal";
					if(i == me.children.length-1){
						tr.children[i].style.fontWeight ="normal";	
						var text = tr.children[i].childNodes[0].textContent;
						if(text != "Check Released"){
							tr.children[i].style.color = "rgb(125, 173, 29)";
							tr.children[i].style.fontWeight = "bold";
						}else{
							tr.children[i].style.color = "black";
						}	
					}
				}
			}
			
		}
		for(var i = 0 ; i < me.children.length; i++ ){
			me.children[i].className  = "trClick1"; 
			if(i == me.children.length-1){
				
				me.children[i].style.color = "white";
			}
			me.children[i].style.fontWeight ="bold";
		}
		
		lastRow1 = me.rowIndex;
	}	
	function changeColorTRpaymaster2(me){
		if(lastRow2 > 0){
			if(paymasterSoloTable2.children[0].children[lastRow2]){
				tr = paymasterSoloTable2.children[0].children[lastRow2];
				for(var i = 0 ; i < tr.children.length; i++){
					tr.children[i].className = '';
				}
			}
			
		}
		for(var i = 0 ; i < me.children.length; i++ ){
			me.children[i].className  = "trClick1"; 
		}
		lastRow2 = me.rowIndex;
	}
	function changeColorTRpaymaster3(me){
		if(lastRow3 > 0){
			tr = paymasterSoloTable3.children[0].children[lastRow3];
			for(var i = 0 ; i < tr.children.length; i++){
				tr.children[i].className = '';
			}
		}
		for(var i = 0 ; i < me.children.length; i++ ){
			me.children[i].className  = "trClick1"; 
		}
		lastRow3 = me.rowIndex;
	}
	function viewBreakdown(me){
		var arr = me.id.split("**");
		var year = arr[0];
		var tn = arr[1];
		window.open('/citydoc2023/interface/formbreakdownwages.php?tn='+tn);
	}	
</script>



