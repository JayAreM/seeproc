<?php
 	require_once("../includes/database.php");
 	if(isset($_GET['office'])){
		$dt = time();
		$today = date('Y-m-d h:i A', $dt);
		
		$type = $database->charEncoder($_GET['type']);
		$mode = $database->charEncoder($_GET['mode']);
		
		$office = $database->charEncoder($_GET['office']);
		
		$transaction = 'Purchase Request';
		if($office == 'All'){
			$case =' office != "" ';
			$officeName = "All Offices";
			$colspan = 9;
		}else{
			$colspan = 8;
			$case ="office = '" . $office . "'";
			$sql = "select * from office  where code = '" . $office . "' limit 1";
			$record = $database->query($sql);
			$data= $database->fetch_array($record);
			$officeName = $data['Name'];
		}
		
		
		$sql ="select a.*,b.Type,c.Description as CategoryName,d.Name as OfficeName from
				(select Year,Fund,Office,PR_Month, TrackingNumber,Claimant,ModeOfProcurement , if(totalAmountMultiple > 0, totalAmountMultiple,PO_Amount) as Amount,
				Status,DateEncoded,DateModified,PR_CategoryCode
				from citydoc2023.vouchercurrent 
				where TrackingType = 'PO' and " . $case . "  and modeofprocurement = '" . $mode . "' and status != 'Cancelled' group by TrackingNumber) a
				left join citydoc.modeofprocurement b on a.ModeOfProcurement = b.Number
				left join citydoc2023.ppmpcategories c on a.PR_CategoryCode = c.Code
				left join office d on a.office = d.code 
					order by a.Claimant asc ";
		
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
			
			
			$claimant = utf8_encode($data['Claimant']);
			
			
			$pr_month = $data['PR_Month'];
			if($pr_month == 1){
				$quarterLabel = " 1st Quarter";
			}else if($pr_month == 2){
				$quarterLabel = " 2nd Quarter";
			}else if($pr_month == 3){
				$quarterLabel = " 3rd Quarter";
			}else{
				$quarterLabel = " 4th Quarter";
			}
			$fund = $data['Fund'];
			
			
			
			$amount = $data['Amount'];
			$officeAll = $data['OfficeName'];
			$mode= $data['Type'];
			
			
			$category = $data['PR_CategoryCode'];
			$categoryName = $data['CategoryName'];
			$status = $data['Status'];
			$dateEncoded =  substr($data['DateEncoded'],0,10);
			$dateModified = substr($data['DateModified'],0,10);
			
			
			if($i == 1){
				$sheet  ='<table id ="table1" border = "0" style ="margin:40px auto;">';
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:center;font-size:22px;padding:10px;font-family:anton;line-height:18px;">List of Procurement Transactions
								<div style ="font-size:16px;font-family:nor;">(base on mode of procurement)</div>
							</td></tr>';
				$sheet1 .='<tr><td colspan ="100%" style ="padding:0;">';
				
				$sheet1 .='<table id ="table2"  border ="0" style ="width:100%;">';
				$sheet1 .='<tr><th colspan ="100%"></th></tr>';
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:right;font-weight:bold;">DocTrack ' . $year . '</span></td></tr>';
				
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:right;font-size:14px;line-height:12px;"><span style ="font-size:10px; font-style:italic;padding-right:6px;">as of </span> <span  style =" ">' . $today . '</span></td></tr>';
				$sheet1 .='<tr><th>Office</th><td colspan ="100%" style ="font-weight:bold;" ><span class ="tdDetails">' . $officeName . '</span></td></tr>';
				$sheet1 .='<tr><th style ="width:90px;">Budget Year</th><td colspan ="100%" id ="year" ><span class ="tdDetails">' . $year . '</span></td></tr>';
				$sheet1 .='<tr><th>Transaction</th><td><span class ="tdDetails">Purchase Order</span></td></tr>';
				if($type == 1){
					$statusDisplay = $mode;
				}else{
					$statusDisplay = "Various";
				}
				$sheet1 .='<tr><th>Procurement</th><td><span class ="tdDetails">' . $statusDisplay . '</span></td></tr>';
				
				$sheet1 .='<tr><th>Count</th><td><span class ="tdDetails">' . $num . '</span></td></tr>';
				
				$sheet1 .='<tr><th colspan ="100%" style ="padding:20px;"></th></tr>';
				
				$sheet1 .='</table>';
				
				$sheet1 .='</td></tr>';
				$sheet1 .='<tr><th></th>';
				if($office == "All"){
					$sheet1 .='<th>Office</th>';
				}
				
				$sheet1 .='<th>Quarter</th><th>Fund</th>
							<th>Category</th>';
				if($type > 1){		  
					$sheet1 .='<th>Mode</th>';
				}
				$sheet1 .='<th>Encoded</th>
						   <th>TN</th>
						   <th>Claimant</th>
						   <th style ="text-align:right;">Total Amount</th>';
				
				$sheet1 .='<th style ="text-align:left;">Status</th>';
				$sheet1 .='<th style ="text-align:left;">Updated</th></tr>';
				$sheet1 .='<tr><th colspan ="100%" style ="border-top:1px solid rgb(232, 173, 164);"></th></tr>';
			}
			
			
			$totalAmount += $amount;
		
			$sheet2 .= '<tr class ="trData">';
			$sheet2 .= '<td class ="tdData" style ="font-size:10px;text-align:center; vertical-align:middle;background-color:rgb(249, 248, 244);">' . $i. '</td>';
			if($office == "All"){
				$sheet2 .='<td class ="tdData">' . $officeAll . '</td>';
			}
			$sheet2 .= '<td class ="tdData">' . $quarterLabel . '</td>';
			$sheet2 .= '<td class ="tdData">' . $fund . '</td>';
			$sheet2 .= '<td class ="tdData">' . $categoryName . '</td>';
			if($type > 1){
				$sheet2 .= '<td class ="tdData">' . $mode . '</td>';
			}
			
			$sheet2 .= '<td class ="tdData" style = "padding-right:45px;">' . $dateEncoded . '</td>';
			
			$sheet2 .= '<td class ="tdData tdDataTN" style ="cursor:pointer;color:rgb(141, 6, 20);" onclick ="showTracking(this)"  id ="tn">' . $tn . '</td>';
			$sheet2 .= '<td class ="tdData">' . $claimant . '</td>';
			$sheet2 .= '<td class ="tdData tdDataAmount" style="text-align:right;">' . number_format($amount,2) . '</td>';
			
			
			$sheet2 .= '<td class ="tdData">' . $status . '</td>';
			
			
			$sheet2 .= '<td class ="tdData">' . $dateModified . '</td>';
			
			$sheet2 .= '</tr>';
		}
		$sheet2 .='<tr><td colspan ="100%" style ="border-bottom:1px solid rgb(232, 173, 164);"></td></tr>';
		if( strlen($sheet) > 1 ){
			$sheet .= $sheet1;
			$sheet .= $sheet2;
			$sheet .= '<tr>';
			$sheet .= '<td colspan ="' .$colspan . '" style ="text-align:right;padding-top:2px;bold;font-size:18px;color:rgb(253, 3, 20);font-weight:bold;">' . number_format($totalAmount,2) . '</td>';
			$sheet .= '<td colspan ="100%"></td>';
			$sheet .= '</tr>';
			$sheet  .='</table>';
		}else{
			echo "No record found.";
		}
		
		
		echo $sheet;
	}
?>
<script>
	function showTracking(me){
		var tn = me.textContent;
		window.open('../interface/formDV.php?trackingNumber='+ tn, '_blank');
		
	}
</script>
<title>Procurement List - Mode</title>
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
		font-size: 12px;
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
		width:200px;
		display: inline-block;
		border-bottom: 1px solid silver;
	}
	.tdDataTN:hover{
		font-weight: bold;
	}
	
	.tdDataTN,.tdDataAmount{
		background-color:rgb(252, 231, 228);
	}
	.trData:hover td{
		background-color: rgb(251, 231, 152);
		
	}
</style>

