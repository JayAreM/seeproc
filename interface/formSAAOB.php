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
		
		border-top:1px solid grey;
		
		
	}
	.tdFooter{
		padding:5px;
		border-top:1px solid silver;
		
	}
	.tdData{
		padding:5px;
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
	include("../includes/database.php");
	$programCode =  $database->charEncoder($_GET['programCode']);
	if($programCode != "AllCodes"){
		$sql = "Select Name  from programcode where code  = '" . $programCode . "' limit 1";
		$result = $database->query($sql);
		$data = $database->fetch_array($result);
		$programName = $data['Name'];
		
		$sql = "SELECT b.Fund, a.AccountCode,b.Title,a.Amount as AnnualBudget, c.Amount as Obligated, c.JevTotal as Liquidated, (a.Amount - c.Amount) as Savings,   (c.Amount - c.JevTotal) as Unliquidated
				FROM 
				(select AccountCode, sum(Amount)as Amount from funds where  ProgramCode ='" . $programCode . "'group by AccountCode) a
				left join 
				fundtitles b on a.AccountCode = b.Code
				left join
				(SELECT PR_AccountCode, sum(if(PO_Amount > 0,PO_Amount,Amount)) as Amount, sum(JevAmount) as JevTotal FROM vouchercurrent where  PR_ProgramCode = '" .  $programCode . "' 
				and Status = 'CAO Released' and obr_number > 0 group by PR_AccountCode) c
				on a.AccountCode = c.PR_accountCode order by b.Fund desc, a.AccountCode asc";
		
		/*$sql = "SELECT DateModified as DateReleased,TrackingType, TrackingNumber,ADV1,Claimant,PR_ProgramCode as RespoCenterCode,c.Name as RespoCenterName,OBR_number,b.Fund as FundClass, PR_AccountCode as AccountCode,
				b.Title as AccountTitle,Amount as OBRAmount,PO_Amount,CheckNumber,Checkdate 
				FROM citydoc2017.vouchercurrent a left join fundtitles b on a.PR_AccountCode = b.Code left join citydoc2017.programcode c on a.PR_programcode = c.code
				 where a.status = 'CAO Released' and OBR_Number is not null and substr(DateModified,1,4) = '2017' or 
				 a.status = 'CBO Released' and OBR_Number is not null and substr(DateModified,1,4) = '2017' order by substr(a.DateModified,1,7) asc";*/
	}else{
		$programName = " All account codes";	
		$sql = "SELECT b.Fund, a.AccountCode,b.Title,a.Amount as AnnualBudget, c.Amount as Obligated, c.JevTotal as Liquidated, (a.Amount - c.Amount) as Savings,   (c.Amount - c.JevTotal) as Unliquidated
				FROM 
				(select AccountCode, sum(Amount)as Amount from funds group by AccountCode) a
				left join 
				fundtitles b on a.AccountCode = b.Code
				left join
				(SELECT PR_AccountCode, sum(if(PO_Amount > 0,PO_Amount,Amount)) as Amount, sum(JevAmount) as JevTotal FROM vouchercurrent where Status = 'CAO Released' and obr_number > 0 group by PR_AccountCode) c
				on a.AccountCode = c.PR_accountCode order by b.Fund desc, a.AccountCode asc";
	}
	
			
			
	$record =  $database->query($sql);
	
	$dt = time();
	$today = date('Y-M-d', $dt);
	$sheetSubs = '';
	$sheetSubsAll = '';
	
	$sheet  = '<table class = "mainTable">';
	$sheet  .= '<tr>
				<td ></td>
				<td colspan ="3" style = "padding:10px 5px;" >PROGRAM : <span style = "color:rgb(5, 156, 66);">' . $programCode . '</span> |<span style = "font-weight:bold;color:rgb(25, 125, 183);"> ' .  $programName .   '</span></td>
			 </tr>';
			
	$sheet  .= '<tr>
				<td >&nbsp;</td>
				<td  class = "tdHeader"   style = "border-left:1px solid silver;">Account Code</td>
				<td  class = "tdHeader" >Title</td>
				<td  class = "tdHeader" style ="text-align:center;">Appropriation</td>
				<td  class = "tdHeader" style ="text-align:center;">Allotment</td>
				<td  class = "tdHeader" style ="text-align:center;">Bal. of Appropriation</td>
				<td  class = "tdHeader" style ="text-align:center;">Obligation</td>
				<td  class = "tdHeader" style ="text-align:center;">Unobligated Bal.</td>
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
	while($data = $database->fetch_array($record)){
		$code = $data['AccountCode'];
		$title = $data['Title'];
		$annualBudget = $data['AnnualBudget'];
		$obligated = $data['Obligated'];
		$savings = $data['Savings'];
		
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
		
		if($i > 1){
			if($fundType != $data['Fund']){
					$sheetSubs  = '<tr>
									<td colspan = "3"  style = "text-align:right;padding:5px;"><span> '  . $fundType . '</span></td>
									<td   style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; border-bottom:1px solid silver;">' . number_format($totalSubAB,2) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; border-bottom:1px solid silver;">' . number_format($totalSubOBL,2) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; border-bottom:1px solid silver;">' . number_format($totalSubSAV,2) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; border-bottom:1px solid silver;">' .  $database->zeroToNothing(number_format($totalSubLIQ,2)) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; border-bottom:1px solid silver;">' . $database->zeroToNothing(number_format($totalSubUNL,2)) . '</td>
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
			
		}		
		$sheet  .= '<tr>
					<td  class = "tdData"  style = "text-align:center;"><div style = "background-color:rgb(234, 235, 234);padding:2px;" >' . $i++ . '</div></td>
					<td class = "tdData" style = "text-align:center;"><span = "classData"  >' . $code . '</span></td>
					<td class = "tdData" style = "text-align:left;"><span = "classData"  >' .    $title . '</span></td>
					<td class = "tdData"  style = "text-align:right;"><span = "classData" >' . $database->zeroToNothing(number_format($annualBudget,2)) . '</span></td>
					<td class = "tdData" style = "text-align:right;"><span = "classData"  >' . $database->zeroToNothing(number_format($obligated,2)) . '</span></td>
					<td class = "tdData" style = "text-align:right;"><span = "classData"  >' . $database->zeroToNothing(number_format($savings,2)) . '</span></td>
					
					<td class = "tdData" style = "text-align:right;"><span = "classData"  >' . $database->zeroToNothing(number_format($liquidated,2)) . '</span></td>
					<td class = "tdData" style = "text-align:right;"><span = "classData"  >' . $database->zeroToNothing(number_format($unliquidated,2)) . '</span></td>
				<tr>';	
	}//end loop
	$sheetSubs  = '<tr>
									<td colspan = "3"  style = "text-align:right;padding:5px;"><span> '  . $fundType . '</span></td>
									<td   style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px;">' . number_format($totalSubAB,2) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; ">' . number_format($totalSubOBL,2) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px;">' . number_format($totalSubSAV,2) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; ">' .  $database->zeroToNothing(number_format($totalSubLIQ,2)) . '</td>
									<td  style = "text-align:right;color:rgb(41, 138, 199);padding-right:10px; ">' . $database->zeroToNothing(number_format($totalSubUNL,2)) . '</td>
								<tr>';		
								
	$sheet .= $sheetSubs;
	$sheetSubsAll .= $sheetSubs;
	$fundType = $data['Fund'];
	
	$sheetHeader = '<tr><td colspan ="8" style ="">&nbsp;<br/><br/></td></tr>
				      <tr>
						<td colspan = "3" style = "text-align:right;padding:5px;"></td>
						<td  class = "tdHeader" style = "border-bottom:2px solid silver;">Appropriation</td>
						<td  class = "tdHeader" style = "border-bottom:2px solid silver;">Allotment</td>
						<td class = "tdHeader"  style = "border-bottom:2px solid silver;">Bal. of Appropriation</td>
						<td class = "tdHeader"  style = "border-bottom:2px solid silver;">Obligation</td>
						<td  class = "tdHeader"  style = "border-bottom:2px solid silver;">Bal. of Unbligated</td>
				     </tr>';
				     
	$sheetHeader .=	$sheetSubsAll;		     
				     
	$sheet .=$sheetHeader;
	
			
	$sheet  .= '<tr>
					<td colspan = "3"  style = "text-align:right;padding:5px;">Total<br/><span class = "date">as of '  . $today . '</span></td>
					<td class = "tdFooter"  style = "text-align:right; background-color:rgb(227, 232, 235);">' . $database->zeroToNothing(number_format($totalAB,2)) . '</td>
					<td class = "tdFooter" style = "text-align:right; background-color:rgb(227, 232, 235); ">' . $database->zeroToNothing(number_format($totalObligated,2)) . '</td>
					<td class = "tdFooter" style = "text-align:right; background-color:rgb(227, 232, 235);">' . $database->zeroToNothing(number_format($totalSavings,2)) . '</td>
					<td class = "tdFooter" style = "text-align:right; background-color:rgb(227, 232, 235);">' . $database->zeroToNothing(number_format($totalLiquidated,2)) . '</td>
					<td class = "tdFooter" style = "text-align:right; background-color:rgb(227, 232, 235);">' . $database->zeroToNothing(number_format($totalUnliquidated,2)) . '</td>
				<tr>';		
	$sheet  .= '</table><br/><br/>';
	echo $sheet;	

?>
<html>
	<head>
		<title>SAAOB SUMMARY</title>
		<link rel="icon" href="/city/images/red.png"/> 
		
	</head>
</html>

