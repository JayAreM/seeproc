<?php
 	require_once("../includes/database.php");
 	if(isset($_GET['t'])){
		$dt = time();
		$today = date('Y-m-d h:i A', $dt);
		
		$text = $database->charEncoder($_GET['t']);
		$arr = $database->arraynicationText($text);
		
		$office =  $arr[0];
		$program =  $arr[1];
		$expense =  $arr[2];
		$fund = $arr[3];
		
		$sql = "select * from programcode  where code = '" . $program . "' limit 1";
		$record = $database->query($sql);
		$data= $database->fetch_array($record);
		$programName = $data['Name'];
		
		
		
		
		if($office == 'All'){
			$case =' office != "" ';
			$officeName = "All Offices";
			$colspan = 7;
		}else{
			$colspan = 6;
			$case ="office = '" . $office . "'";
			$sql = "select * from office  where code = '" . $office . "' limit 1";
			$record = $database->query($sql);
			$data= $database->fetch_array($record);
			$officeName = $data['Name'];
		}
		$sql = "select a.*,b.Name as OfficeName from(select a.*,b.Description as CategoryName from(select a.*,b.Title, b.Fund as TitleFund from vouchercurrent a left join fundtitles b on a.PR_AccountCode = b.Code 
					where a.Fund = '" . $fund . "'  and trackingtype = 'PR' and " . $case . "  and PR_ProgramCode = '" . $program . "' and PR_AccountCode = '" . $expense . "' and Status != 'Cancelled' ) a
					left join ppmpcategories b on a.PR_CategoryCode = b.code 	order by a.Id asc) a 
					
					left join office b on a.office = b.Code
					";
		
		
		$record = $database->query($sql);
		$num  = $database->num_rows($record);
		if($num > 1){
			$num  = $num . ' ' . ' transactions';
		}else{
			$num  = $num . ' ' . ' transaction';
		}
		
		$totalAmount = 0;
		$sheet = '';
		$sheet1 = '';
		$sheet2 ='';
		
		
		$i = 0;
		while($data = $database->fetch_array($record)){
			$i++;
			
			$year = $data['Year'];
			$tn = $data['TrackingNumber'];
			$type = $data['TrackingType'];
			
			$claimant = $data['Claimant'];
			$type = $data['TrackingType'];
			$pr_month = $data['PR_Month'];
			$fund = $data['Fund'];
			$multipleAmount = $data['TotalAmountMultiple'];
			$amount = $data['Amount'];
			$category = $data['PR_CategoryCode'];
			$categoryName = $data['CategoryName'];
			$status = $data['Status'];
			$dateEncoded = $data['DateEncoded'];
			$dateModified = $data['DateModified'];
			$type = $data['TrackingType'];
			$expense = $data['Title'];
			$expenseCode = $data['PR_AccountCode'];
			$officeNameAll = $data['OfficeName'];
			
			
			if($i == 1){
				$sheet  ='<table id ="table1" border = "0" style ="margin:40px auto;">';
				
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:center;font-size:22px;padding:10px;font-family:anton;line-height:18px;">List of Purchase Request
								<div style ="font-size:16px;font-family:nor;">(with particular charges below)</div>
							</td></tr>';
				$sheet1 .='<tr><td colspan ="100%" style ="padding:0;">';
				
				$sheet1 .='<table id ="table2"  border ="0" style ="width:100%;">';
				$sheet1 .='<tr><th colspan ="100%"></th></tr>';
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:right;font-weight:bold;">DocTrack ' . $year . '</td></tr>';
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:right;font-size:14px;line-height:12px;"><span style ="font-size:10px; font-style:italic;padding-right:6px;">as of </span> <span  style =" ">' . $today . '</span></td></tr>';
				$sheet1 .='<tr><th>Office</th><td colspan ="100%" style ="font-weight:bold;" ><span class ="tdDetails">' . $officeName . '</span></td></tr>';
				$sheet1 .='<tr><th style ="width:130px;">Budget Year</th><td colspan ="100%" id ="year"><span class ="tdDetails">' . $year . '</span></td></tr>';
				
				$sheet1 .='<tr><th>Fund</th><td colspan ="100%"><span class ="tdDetails">' . $fund . '</span></td></tr>';
				
				$sheet1 .='<tr><th>Responsibility Center</th><td><span class ="tdDetails"><span style ="color:brown;">' . $program . '</span> ' . $programName . '</span></td></tr>';
				
				$sheet1 .='<tr><th>Expense Code</th><td><span class ="tdDetails">' . $expenseCode . '</span></td></tr>';
				$sheet1 .='<tr><th>Expense Description</th><td><span class ="tdDetails">' . $expense . '</span></td></tr>';
				$sheet1 .='<tr><th>Count</th><td><span class ="tdDetails">' . $num . '</span></td></tr>';
				$sheet1 .='<tr><th colspan ="100%" style ="padding:20px;"></th></tr>';
				
				$sheet1 .='</table>';
				
				$sheet1 .='</td></tr>';
				if($office == 'All'){
					$sheet1 .='<tr><th></th><th>Office</th><th>Quarter</th><th>Category</th><th>Encoded</th><th>TN</th><th style ="text-align:right;">Charge Amount </th><th style ="text-align:right;">Status </th><th style ="text-align:left;">Status Updated</th></tr>';
				}else{
					$sheet1 .='<tr><th></th><th>Quarter</th><th>Category</th><th>Encoded</th><th>TN</th><th style ="text-align:right;">Charge Amount </th><th style ="text-align:right;">Status </th><th style ="text-align:left;">Status Updated</th></tr>';
				
				}
				$sheet1 .='<tr><th colspan ="100%" style ="border-top:1px solid rgb(232, 173, 164);"></th></tr>';
			}
			
			
			$totalAmount += $amount;
		
			$sheet2 .= '<tr class ="trData">';
			
			$sheet2 .= '<td style ="font-size:10px;text-align:center; vertical-align:middle;background-color:rgb(249, 248, 244);" class ="tdData">' . $i. '</td>';
			if($office == 'All'){
				$sheet2 .= '<td class ="tdData">' . $officeNameAll . '</td>';
			}
			$sheet2 .= '<td class ="tdData">' . $database->numberToQuarter($pr_month) . '</td>';
			$sheet2 .= '<td class ="tdData">' . ucwords(strtolower($categoryName)) . '</td>';
			$sheet2 .= '<td class ="tdData" style = "padding-right:45px;">' . $dateEncoded . '</td>';
			$sheet2 .= '<td class ="tdData tdDataTN" style ="color:rgb(141, 6, 20);cursor:pointer;" onclick ="showTracking(this)"  id ="tn">' . $tn . '</td>';
			
			
			$sheet2 .= '<td class ="tdData tdDataAmount" style="text-align:right;">' . number_format($amount,2) . '</td>';
			$sheet2 .= '<td class ="tdData">' . $status . '</td>';
			$sheet2 .= '<td class ="tdData">' . $dateModified . '</td>';
			
			$sheet2 .= '</tr>';
		}
		$sheet2 .='<tr><td colspan ="100%" style ="border-bottom:1px solid rgb(232, 173, 164);"></td></tr>';
		$sheet .= $sheet1;
		$sheet .= $sheet2;
		
		
		$sheet .= '<tr>';
		$sheet .= '<td colspan ="' . $colspan . '" style ="text-align:right;padding-top:2px;bold;font-size:18px;color:rgb(253, 3, 20);font-weight:bold;">' . number_format($totalAmount,2) . '</td>';
		$sheet .= '<td colspan ="100%"></td>';
		$sheet .= '</tr>';
		
		
		$sheet  .='</table>';
		echo $sheet;
	}
?>
<script>
	function showTracking(me){
		var tn = me.textContent;
		window.open('../interface/formPRnew.php?tn='+ tn, '_blank');
		
		var office = "<?php echo $officeName;?>";
		window.open('../interface/formOBR.php?trackingNumber='+ tn + '&officeName=' + office +"&payee=", '_blank');
	}
</script>

<style>
	@font-face{
		font-family: NOR;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Abel-Regular.ttf);
	}
	#table1{
		font-family: NOR;
		border-spacing: 0;
	}
	#table1 td{
		vertical-align: top;
		padding:0px 10px;
	}
	
	#table1 th{
		vertical-align: top;
		padding:0px 10px;
		text-align: left;
	}
	.tdData{
		border-bottom: 1px solid silver;
	}
	#table2{
		border-spacing:0;
		margin-top:20px;
	}
	#table2 th:nth-child(1){
		font-weight: normal;
		color:grey;
		line-height: 20px;
		
	}
	#table2 td:nth-child(2){
		
		line-height: 20px;
	}
	#table1 tr:nth-last-child(3) td {
		border:0;
	}
	.tdDetails{
		width:350px;
		display: inline-block;
		border-bottom: 1px solid silver;
	}
	.trData td:nth-child(5):hover{
		font-weight: bold;
	}
	
	
	.tdDataTN,.tdDataAmount{
		background-color:rgb(252, 231, 228);
	}
	
	.trData:hover td{
		background-color: rgb(251, 231, 152);
		
	}
</style>
<title>Procurement List - Charges</title>
