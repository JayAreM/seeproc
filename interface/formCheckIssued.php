
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<?php
	session_start();
	
	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
		echo $link;
	}else{
		
		$acct = $_SESSION['employeeNumber'];
		require_once('../includes/database.php');
		require_once('../interface/sheets.php');
		require_once('../javascript/ajaxFunction.php');
		$programCode = $_GET['pr'];
		$accountCode = $_GET['a'];
		$periodType = $_GET['p'];
		$month = $_GET['m'];
		$day = $_GET['d'];
		$year = $_GET['y'];
		
		
		$p = '<span>Source</span>&nbsp;<span style = "font-weight:bold;">' . $programCode  . '</span>';
		if($accountCode != 0){
			$c = '&nbsp;&nbsp;&nbsp;<span>Code</span>&nbsp;<span style = "font-weight:bold;">' . $accountCode  . '</span>';
		}else{
			$c = '';
		}
		if($accountCode == 0){
			$searchCondition1 = '';
		}else{
			$searchCondition1 = " and a.pr_accountcode = '" . $accountCode . "' "; 
		}
		
		if($periodType == 2){
			$checkDate = $year . '-' . $month . '-' . $day;
			$searchCondition2 = " and substr(a.CheckDate,1,10) = '" . $checkDate . "'" ;	
		}else if($periodType == 3){
			$checkDate = $year . '-' . $month ;
			$searchCondition2 = " and substr(a.CheckDate,1,7) = '" . $checkDate . "'" ;
		}else{
			$searchCondition2 = '';
		}
		
		if($_SESSION['accountType'] == 4 || $_SESSION['accountType'] == 7 || $_SESSION['employeeNumber'] == 900101 || $_SESSION['employeeNumber'] == 198000){
			$sql = "SELECT a.Id,a.Adv1,a.OBR_Number,a.TrackingType,a.TrackingNumber,a.ChargeType,a.NetAmount,a.CheckNumber,a.CheckDate,a.DocumentType,a.Claimant,a.Status,a.Amount, a.PO_Amount, a.TotalAmountMultiple,a.NetAmount,a.DateModified,
					b.Particulars 
			
					FROM vouchercurrent a left join particulars b on a.trackingnumber = b.trackingnumber
					
					where a.pr_programcode = '" . $programCode  . "'" . $searchCondition1  . "
					and a.obr_number > 0 " . $searchCondition2 . "
					group by a.trackingnumber
					order by a.DateModified Desc;";
			
			
			
		}else if($_SESSION['accountType'] == 1 ){
			$sql = "SELECT a.Id,a.Adv1,a.OBR_Number,a.TrackingType,a.TrackingNumber,a.ChargeType,a.NetAmount,a.CheckNumber,a.CheckDate,a.DocumentType,a.Claimant,a.Status,a.Amount, a.PO_Amount, a.TotalAmountMultiple,a.NetAmount,a.DateModified, 
			b.Particulars 
			FROM vouchercurrent a left join particulars b on a.trackingnumber = b.trackingnumber
			 where a.office = '" . $_SESSION['officeCode'] . "' and a.pr_programcode = '" . $programCode  . "'" . $searchCondition1  . "
			and a.obr_number > 0 " . $searchCondition2 . "
			group by a.trackingnumber
			order by a.DateModified Desc;";
		
		}else{
			$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
			echo $link;
		}
	}

	
	
	
	
	
	$record = $database->query($sql);
	$page = $sheet->CreateCheckList($record,$checkDate,$p,$c);
	
?>


<style>
	
</style>
<!DOCTYPE HTML>
<html>
	<title> Check List</title>
	<link rel="icon" href="/citydoc2018/images/red.png"/> 
	<body>
		
		<div style = "border:0px solid red;width:w00%;margin:0 auto;">
			<?php
				echo $page;
			?>
			
		</div>
		
	</body>
</html>
