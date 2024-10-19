<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<style>
	.maintable{
		margin:0 auto;
	}
	.tdHeader{
		padding:5px 10px;
		font-weight: bold;
		border-bottom:2px solid grey;
		border-right:1px solid silver;
		font-size: 14px;
		border-top:1px solid grey;
	}
	.tdFooter{
		padding:5px;
		padding-right:12px;
		border-top:1px solid silver;
		
	}
	.tdData{
		padding:2px 5px;
		padding-right:10px;
		border-bottom:1px solid silver;
		border-right:1px solid silver;
		
	}
	.date{
		font-size:12px;
		font-style: italic;
		color:grey
	}
</style>

<?php
   	session_start();
	
	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
		echo $link;
	}else{
		$acct = $_SESSION['employeeNumber'];
		include("../includes/database.php");
		$programCode =  $database->charEncoder($_GET['pc']);
		if($programCode != "AllCodes"){
			$sql = "Select Name  from programcode where code  = '" . $programCode . "' limit 1";
			$result = $database->query($sql);
			$data = $database->fetch_array($result);
			$programName = $data['Name'];
			$office = $_SESSION['officeCode'];
			if($_SESSION['accountType'] == 4 || $_SESSION['accountType'] == 7 || $_SESSION['employeeNumber'] == 900101 || $_SESSION['employeeNumber'] == 198000){
				$sql = "SELECT b.Fund,a.AccountCode,b.Title,a.Amount as AnnualBudget, c.Amount as Obligated,c.NetLiq as Liquidated, c.Paid,
							(a.Amount - c.Amount) as Balance1, (a.Amount - c.Paid) as Balance2,   (c.Paid - c.NetLiq) as Unliquidated
							FROM 
							(select AccountCode, Amount from funds where  Amount > 1 and ProgramCode = '" . $programCode . "' group by AccountCode) a
							left join 
							fundtitles b on a.AccountCode = b.Code
							left join
							(SELECT PR_AccountCode, sum(Amount) as Amount, sum(JevAmount) as JevTotal,sum(if(checknumber is null,0,if(TrackingType = 'PO',PO_Amount,Amount))) as Paid,
							sum(if(JevNo is null,0,NetAmount)) as NetLiq FROM vouchercurrent 
							where  PR_ProgramCode = '" . $programCode . "' 
							and obr_number > 0 and status != 'Cancelled' group by PR_AccountCode) c
							on a.AccountCode = c.PR_accountCode
							order by b.Fund,b.Title asc";
			}else if($_SESSION['accountType'] == 1){
				$sql = "SELECT b.Fund,a.AccountCode,b.Title,a.Amount as AnnualBudget, c.Amount as Obligated,c.NetLiq as Liquidated, c.Paid,
							(a.Amount - c.Amount) as Balance1, (a.Amount - c.Paid) as Balance2,   (c.Paid - c.NetLiq) as Unliquidated
							FROM 
							(select AccountCode, Amount from funds where OfficeCode ='" . $office . "'  and Amount > 1 and ProgramCode = '" . $programCode . "' group by AccountCode) a
							left join 
							fundtitles b on a.AccountCode = b.Code
							left join
							(SELECT PR_AccountCode, sum(Amount) as Amount, sum(JevAmount) as JevTotal,sum(if(checknumber is null,0,if(TrackingType = 'PO',PO_Amount,Amount))) as Paid,
							sum(if(JevNo is null,0,NetAmount)) as NetLiq FROM vouchercurrent 
							where office ='" . $office . "' and PR_ProgramCode = '" . $programCode . "' 
							and obr_number > 0 and status != 'Cancelled' group by PR_AccountCode) c
							on a.AccountCode = c.PR_accountCode
							order by b.Fund,b.Title asc";
			}else{
				$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
				echo $link;
			}
			
			
		}else{
			$programName = " All account codes";	
			
		}
		
	}	

	
	
			
			
	$record =  $database->query($sql);
	
	$dt = time();
	$today = date('Y-M-d', $dt);
	$sheetSubs = '';
	$sheetSubsAll = '';
	
	$sheet  = '<table class = "mainTable" style = "font-family:Oswald;border-spacing:0;font-size:12px;">';
	$sheet  .= '<tr>
				<td ></td>
				<td colspan ="3" style = "padding:10px 5px;font-size:16px;" >PROGRAM : <span style = "color:rgb(5, 156, 66);">' . $programCode . '</span><span style = "font-weight:bold;color:rgb(25, 125, 183);font-size:16px;"> ' .  $programName .   '</span></td>
			 </tr>';
			
	$sheet  .= '<tr>
				<td >&nbsp;</td>
				<td  class = "tdHeader"   style = "border-left:1px solid silver;">Account Code</td>
				<td  class = "tdHeader" >Title</td>
				<td  class = "tdHeader" style ="text-align:center;">Beginning</td>
				<td  class = "tdHeader" style ="text-align:center;">Obligated</td>
				<td  class = "tdHeader" style ="text-align:center;">Paid</td>
				<td  class = "tdHeader" style ="text-align:center;">Liquidated</td>
				<td  class = "tdHeader" style ="text-align:center;">Unliquidated</td>
			<tr>';
	$i = 1;
	$totalObligated = 0;
	$totalLiquidated = 0;
	$totalAB = 0;
	$totalUnliquidated = 0;
	$totalSavings = 0;		
	
	$totalSubAB = 0;
	$totalSubOBL = 0;
	$totalSubSAV = 0;
	$totalSubLIQ = 0;
	$totalSubUNL = 0;
	
	
	
	$totalPsAB = 0;
	$totalCo = 0;
	$totalMo = 0;
	
	$fundType = '';
	$savings = '';
	while($data = $database->fetch_array($record)){
		
		
		
		$code = $data['AccountCode'];
		$title = $data['Title'];
		$annualBudget = $data['AnnualBudget'];
		$obligated = $data['Obligated'];
		
		$savings = $data['Paid'];
		
		
		
		
		
		
		$liquidated = $data['Liquidated'];
		$unliquidated = $data['Unliquidated'];
		
		$totalObligated = ($totalObligated + $obligated);
		$totalLiquidated = ($totalLiquidated + $liquidated);
		$totalAB =  ($totalAB + $annualBudget);
		$totalUnliquidated =  ($totalUnliquidated + $unliquidated);
		$totalSavings =  ($totalSavings + $savings);
		if($i == 1 ){
			$fundType = $data['Fund'];
			if($fundType == "PS"){
				$totalPsAB = $totalPsAB + $annualBudget;
				$totalSubAB = $totalSubAB + $annualBudget;
				$totalSubOBL = $totalSubOBL + $obligated;
				$totalSubSAV = $totalSubSAV + $savings;
				$totalSubLIQ = $totalSubLIQ + $liquidated;
				$totalSubUNL = $totalSubUNL + $unliquidated;
			}
			if($fundType == "MOOE"){
				$totalSubAB = $totalSubAB + $annualBudget;
				$totalSubOBL = $totalSubOBL + $obligated;
				$totalSubSAV = $totalSubSAV + $savings;
				$totalSubLIQ = $totalSubLIQ + $liquidated;
				$totalSubUNL = $totalSubUNL + $unliquidated;
			}
			if($fundType == "CO"){
				$totalSubAB = $totalSubAB + $annualBudget;
				$totalSubOBL = $totalSubOBL + $obligated;
				$totalSubSAV = $totalSubSAV + $savings;
				$totalSubLIQ = $totalSubLIQ + $liquidated;
				$totalSubUNL = $totalSubUNL + $unliquidated;
			}			
		}
		
		//if($i > 2){
			if($fundType != $data['Fund']){
					$sheetSubs  = '<tr>
									<td colspan = "3"  style = "text-align:right;padding:5px;"><span> '  . $fundType . '</span></td>
									<td   style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; border-bottom:1px solid silver;">' . $database->toNumberFormat($totalSubAB) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; border-bottom:1px solid silver;">' . $database->toNumberFormat($totalSubOBL) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; border-bottom:1px solid silver;">' . $database->toNumberFormat($totalSubSAV) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; border-bottom:1px solid silver;">' .  $database->toNumberFormat($totalSubLIQ) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; border-bottom:1px solid silver;">' . $database->toNumberFormat($totalSubUNL) . '</td>
								<tr>';		
								
					$sheet .= $sheetSubs;
					$sheetSubsAll .= $sheetSubs;
					$fundType = $data['Fund'];
					$totalSubAB = 0;
					$totalSubOBL =  0;
					$totalSubSAV =  0;
					$totalSubLIQ =  0;
					$totalSubUNL =  0;
			}
			if($fundType == "PS"){
				$totalPsAB = $totalPsAB + $annualBudget;
				
				$totalSubAB = $totalSubAB + $annualBudget;
				$totalSubOBL = $totalSubOBL + $obligated;
				$totalSubSAV = $totalSubSAV + $savings;
				$totalSubLIQ = $totalSubLIQ + $liquidated;
				$totalSubUNL = $totalSubUNL + $unliquidated;
			}
			if($fundType == "MOOE"){
				$totalSubAB = $totalSubAB + $annualBudget;
				$totalSubOBL = $totalSubOBL + $obligated;
				$totalSubSAV = $totalSubSAV + $savings;
				$totalSubLIQ = $totalSubLIQ + $liquidated;
				$totalSubUNL = $totalSubUNL + $unliquidated;
			}
			if($fundType == "CO"){
				$totalSubAB = $totalSubAB + $annualBudget;
				$totalSubOBL = $totalSubOBL + $obligated;
				$totalSubSAV = $totalSubSAV + $savings;
				$totalSubLIQ = $totalSubLIQ + $liquidated;
				$totalSubUNL = $totalSubUNL + $unliquidated;
			}
			
		//}		
		$sheet  .= '<tr>
					<td  class = "tdData"  style = "text-align:center;border:0;padding:0;"><div>' . $i++ . '</div></td>
					<td class = "tdData" style = "text-align:center;"><span = "classData"  >' . $code . '</span></td>
					<td class = "tdData" style = "text-align:left;"><span = "classData"  >' .    $title . '</span></td>
					<td class = "tdData"  style = "text-align:right;"><span = "classData" >' . $database->toNumberFormat($annualBudget) . '</span></td>
					<td class = "tdData" style = "text-align:right;"><span = "classData"  >' . $database->toNumberFormat($obligated) . '</span></td>
					<td class = "tdData" style = "text-align:right;"><span = "classData"  >' . $database->toNumberFormat($savings) . '</span></td>
					
					<td class = "tdData" style = "text-align:right;"><span = "classData"  >' . $database->toNumberFormat($liquidated) . '</span></td>
					<td class = "tdData" style = "text-align:right;"><span = "classData"  >' . $database->toNumberFormat($unliquidated) . '</span></td>
				<tr>';	
	}//end loop
	$sheetSubs  = '<tr>
									<td colspan = "3"  style = "text-align:right;padding:5px;"><span> '  . $fundType . '</span></td>
									<td   style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px;">' . $database->toNumberFormat($totalSubAB) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; ">' . $database->toNumberFormat($totalSubOBL) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px;">' . $database->toNumberFormat($totalSubSAV) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; ">' .  $database->toNumberFormat($totalSubLIQ) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; ">' . $database->toNumberFormat($totalSubUNL) . '</td>
								<tr>';		
								
	$sheet .= $sheetSubs;
	$sheetSubsAll .= $sheetSubs;
	// $fundType = $data['Fund'];
	
	$sheetHeader = '<tr><td colspan ="8" style ="">&nbsp;<br/><br/></td></tr>
				      <tr>
						<td colspan = "3" style = "text-align:right;padding:5px;"></td>
						<td  class = "tdHeader" style = "border-bottom:2px solid silver;">Appropriation</td>
						<td  class = "tdHeader" style = "border-bottom:2px solid silver;">Obligated</td>
						<td class = "tdHeader"  style = "border-bottom:2px solid silver;">Issued</td>
						<td class = "tdHeader"  style = "border-bottom:2px solid silver;">Liquidated</td>
						<td  class = "tdHeader"  style = "border-bottom:2px solid silver;">Unliquidated</td>
				     </tr>';
				     
	$sheetHeader .=	$sheetSubsAll;		     
				     
	$sheet .=$sheetHeader;
	
			
	$sheet  .= '<tr>
					<td colspan = "3"  style = "text-align:right;padding:5px;">Total<br/><span class = "date">as of '  . $today . '</span></td>
					<td class = "tdFooter"  style = "text-align:right; background-color:rgb(227, 232, 235);">' . $database->toNumberFormat($totalAB) . '</td>
					<td class = "tdFooter" style = "text-align:right; background-color:rgb(227, 232, 235); ">' . $database->toNumberFormat($totalObligated) . '</td>
					<td class = "tdFooter" style = "text-align:right; background-color:rgb(227, 232, 235);">' . $database->toNumberFormat($totalSavings) . '</td>
					<td class = "tdFooter" style = "text-align:right; background-color:rgb(227, 232, 235);">' . $database->toNumberFormat($totalLiquidated) . '</td>
					<td class = "tdFooter" style = "text-align:right; background-color:rgb(227, 232, 235);">' . $database->toNumberFormat($totalUnliquidated) . '</td>
				<tr>';		
	$sheet  .= '</table><br/><br/>';
	echo $sheet;	

?>
<html>
	<head>
		<title>Fund Summary</title>
		<link rel="icon" href="/city/images/red.png"/> 

	</head>
</html>

