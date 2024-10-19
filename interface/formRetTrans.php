
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<?php
	session_start();
	
	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
		echo $link;
	}else{
		/*$acct = $_SESSION['employeeNumber'];
		if($_SESSION['accountType'] == 4 || $_SESSION['accountType'] == 7 || $_SESSION['employeeNumber'] == 900101 || $_SESSION['employeeNumber'] == 198000){
			
		}else{
			$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
			echo $link;
		}*/
	}

	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	
	$office = $database->charEncoder($_GET['off']);
	$type = $database->charEncoder($_SESSION['accountType']);
	$name = $database->charEncoder($_GET['name']);
	
	$conditions = "";
	
	if($type == 1){
		$conditions .= "and Office = '".$office."'";
		if($name != ""){
			$conditions .= "and Claimant like '%".$name."%'";
		}
	}else{
		if($name != ""){
			$conditions .= "and Claimant like '%".$name."%'";
		}
	}

	$sql = "select TrackingNumber, TrackingPartner as tnPartner, Claimant, ADV1, PeriodMonth, Amount, Status, NetAmount, checknumber, checkdate
			from vouchercurrent
			where DocumentType = 'BOND - RETENTION MONEY'
			and Status != 'Cancelled'
			".$conditions."
			group by TrackingNumber order by Id desc";
	
	$record = $database->query($sql);
	$page = $sheet1->CreateRetTransPrinting($record);
?>


<!DOCTYPE HTML>
<html>
<title> Check List</title>
<link rel="icon" href="/citydoc2018/images/red.png"/> 
<style>
	.retTransTable{
		border-spacing:0;
		width:100%;
		margin:0px auto;
	}	
	.retTransTable > thead > tr > th {
		border:1px solid gray;
		border-left:0px;
		border-right:0px;
		font-size:14px;
		padding: 0px 5px;
	}
	.retTransTable > tbody > tr > td {
		font-size:14px;
		border-bottom: 1px solid gray;
		padding: 0px 5px;
	}
</style>
<body>
	<div style = "border:0px solid red;width:750px;margin:0 auto;"><?php echo $page; ?></div>
</body>
</html>
