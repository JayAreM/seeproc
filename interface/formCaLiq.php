
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
	
	$office = $_GET['a'];
	$type = $_GET['t'];
	
	
	
	if($office == 'all'){
		$sql = "select a.*,b.Status as LQstatus from vouchercurrent a left join (select * from vouchercurrent) as b
						on a.TrackingPartner = b.TrackingNumber
						 where 
						 	 a.documenttype = 'CASH ADVANCE'  or 
						 	 a.documenttype = 'ALLOWANCE - TRAVEL' 
						 	group by a.trackingnumber
						 	order by a.datemodified desc";
	}else{
		$sql = "select a.*,b.Status as LQstatus from vouchercurrent a left join (select * from vouchercurrent) as b
						on a.TrackingPartner = b.TrackingNumber
						 where 
						 	a.office = '" . $office . "' and a.documenttype = 'CASH ADVANCE'  or 
						 	a.office = '" . $office . "' and a.documenttype = 'ALLOWANCE - TRAVEL' 
						 	group by a.trackingnumber
						 	order by a.datemodified desc";
	}
	
	$record = $database->query($sql);
	$page = $sheet->CreateCandL($record);
	
?>


<style>
	
</style>
<!DOCTYPE HTML>
<html>
	<title> Check List</title>
	<link rel="icon" href="/citydoc2018/images/red.png"/> 
	<body>
		
		<div style = "border:0px solid red;width:750px;margin:0 auto;">
			<?php
				echo $page;
			?>
			
		</div>
		
	</body>
</html>
