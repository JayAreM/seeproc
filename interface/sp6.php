<?php
 	require_once("../includes/database.php");
 	if(isset($_GET['ty'])){
		$dt = time();
		$today = date('Y-m-d h:i A', $dt);
		
	
		$type = $database->charEncoder($_GET['ty']);
		
		$office = $database->charEncoder($_GET['office']);
		$case1 = '';
		if($type =="PR"){
			$transaction  ="Purchase Request";
			$case1 = " and Status != 'For P.O' ";
		}else if($type =="PO"){
			$transaction  ="Purchase Order";
			$case1 = " and Status != 'Waiting for Delivery' ";
		}else{
			$transaction  ="Procurement Payment";
			$case1 = " and Status != 'Check Released' ";
		}
		
		
		if($office == 'All'){
			$case =' office != "" ';
			$officeName = "All Offices";
			$colspan = 8;
		}else{
			$colspan = 7;
			$case ="office = '" . $office . "'";
			$sql = "select * from office  where code = '" . $office . "' limit 1";
			$record = $database->query($sql);
			$data= $database->fetch_array($record);
			$officeName = $data['Name'];
		}
		
		
		
		
	/*	$sql = "select a.*,b.Description as CategoryName from(select a.*,b.Title, b.Fund as TitleFund from vouchercurrent a left join fundtitles b on a.PR_AccountCode = b.Code 
					where a.Fund = '" . $fund . "'  and trackingtype = 'PR' and  office = '" . $office . "' and Status != 'Cancelled' ) a
					left join ppmpcategories b on a.PR_CategoryCode = b.code 	order by a.Id asc";
		$record = $database->query($sql);*/
		
		
		
		$sql = "select a.*,b.Name as OfficeName from(select a.*,b.Description as CategoryName from(select a.*,b.Title, b.Fund as TitleFund from vouchercurrent a left join fundtitles b on a.PR_AccountCode = b.Code 
					where trackingtype ='" . $type . "'  and " . $case . " and Status != 'Cancelled' " . $case1 . " group by trackingnumber  order by Id asc) a
					left join ppmpcategories b on a.PR_CategoryCode = b.code) a
					left join office b on a.office = b.code  order by a.Id asc
					";
					
		
		$record = $database->query($sql);
		$num  = $database->num_rows($record);
		if($num > 1){
			$numLabel  = $num . ' ' . ' transactions';
		}else{
			$numLabel  = $num . ' ' . ' transaction';
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
			
			$claimant = $data['Claimant'];
			$amount = $data['Amount'];
			
			if($type == 'PO'){
				$amount = $data['PO_Amount'];
			}
			if($multipleAmount > 0){
				$amount = $multipleAmount;
			}
			$category = $data['PR_CategoryCode'];
			$categoryName = $data['CategoryName'];
			$status = $data['Status'];
			$dateEncoded = $data['DateEncoded'];
			$dateModified = $data['DateModified'];
			
			$type = $data['TrackingType'];
			$officeNameAll = $data['OfficeName'];
			
			
			if($i == 1){
				$sheet  ='<table id ="table1" border = "0" style ="margin:40px auto;">';
				
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:center;font-size:22px;padding:10px;font-family:anton;line-height:18px;">List of Procurement Transactions
								<div style ="font-size:16px;font-family:nor;">(ongoing ' . strtolower($transaction) . ' transactions)</div>
							</td></tr>';
				$sheet1 .='<tr><td colspan ="100%" style ="padding:0;">';
				
				$sheet1 .='<table id ="table2"  border ="0" style ="width:100%;">';
				$sheet1 .='<tr><th colspan ="100%"></th></tr>';
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:right;font-weight:bold;">DocTrack ' . $year . '</span></td></tr>';
				
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:right;font-size:14px;line-height:12px;"><span style ="font-size:10px; font-style:italic;padding-right:6px;">as of </span> <span  style =" ">' . $today . '</span></td></tr>';
				$sheet1 .='<tr><th>Office</th><td colspan ="100%" style ="font-weight:bold;" ><span class ="tdDetails">' . $officeName . '</span></td></tr>';
				$sheet1 .='<tr><th style ="width:90px;">Budget Year</th><td colspan ="100%" id ="year" ><span class ="tdDetails">' . $year . '</span></td></tr>';
				$sheet1 .='<tr><th >Transaction</th><td colspan ="100%" id ="year" ><span class ="tdDetails">' . $transaction . '</span></td></tr>';
				
				
				$sheet1 .='<tr><th>Count</th><td><span class ="tdDetails">' . $numLabel . '</span></td></tr>';
				$sheet1 .='<tr><th colspan ="100%" style ="padding:20px;"></th></tr>';
				
				$sheet1 .='</table>';
				
				$sheet1 .='</td></tr>';
				$sheet1 .='<tr><th></th>';
				if($office == "All"){
					$sheet1 .='<th>Office</th>';
				}
				$sheet1 .='<tr><th></th><th>Fund</th><th>Quarter</th><th>Category</th><th>Encoded</th>';
				if($type != 'PR'){
					$sheet1 .='<th>Supplier </th>';
				}
				
				$sheet1 .='<th>TN</th><th style ="text-align:right;">Total Amount </th>
				<th >Status</th>
				<th style ="text-align:left;">Status Updated</th></tr>';
				
				$sheet1 .='</tr>';
				
				
				
				$sheet1 .='<tr><th colspan ="100%" style ="border-top:1px solid rgb(232, 173, 164);"></th></tr>';
			}
			
			
			$totalAmount += $amount;
			$sheet2 .= '<tr class ="trData">';
			$sheet2 .= '<td class ="tdData" style ="font-size:10px;text-align:center; vertical-align:middle;background-color:rgb(249, 248, 244);">' . $i. '</td>';
			if($office == 'All'){
				$sheet2 .= '<td class ="tdData">' . $officeNameAll . '</td>';
			}
			$sheet2 .= '<td class ="tdData">' . $fund . '</td>';
			$sheet2 .= '<td class ="tdData">' . $database->numberToQuarter($pr_month) . '</td>';
			$sheet2 .= '<td class ="tdData">' . ucwords(strtolower($categoryName)) . '</td>';
			$sheet2 .= '<td class ="tdData" style = "padding-right:45px;">' . $dateEncoded . '</td>';
			if($type != 'PR'){
				$sheet2 .='<td class ="tdData" >' . $claimant . '</td>';
			}
			$sheet2 .= '<td class ="tdData tdDataHighlight" style ="color:rgb(141, 6, 20);cursor:pointer;" onclick ="showTracking(this)"  id ="tn">' . $tn . '</td>';
			$sheet2 .= '<td class ="tdData tdDataHighlight" style="text-align:right;">' . number_format($amount,2) . '</td>';
			$sheet2 .= '<td class ="tdData" style = "">' . $status . '</td>';
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
		if($num  > 0){
			echo $sheet ;
		}else{
			echo "No record." ;
		}
		
	}
?>
<script>
	function showTracking(me){
		var tn = me.textContent;
		var ty = "<?php echo $type;?>";
		var office = "<?php echo $officeName;?>";
	
		
		
		
		if(ty == "PR"){
			window.open('../interface/formPRnew.php?tn='+ tn, '_blank');
			window.open('../interface/formOBR.php?trackingNumber='+ tn + '&officeName=' + office +"&payee=", '_blank');
		}else if(ty == "PO"){
			window.open('../interface/formPO.php?tn='+ tn, '_blank');
			window.open('../interface/formOBR.php?trackingNumber='+ tn + '&officeName=' + office +"&payee=", '_blank');
		}else{
			window.open('../interface/formDVgoods.php?trackingNumber='+ tn, '_blank');
		}
		
		
		
		
	}
</script>
<title>Procurement List - On going</title>
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
		width:200px;
		display: inline-block;
		border-bottom: 1px solid silver;
	}
	.trData td:nth-child(6):hover{
		font-weight: bold;
	}
	.tdDataHighlight{
		background-color:rgb(252, 231, 228);
	}
	
	
	.trData:hover td{
		background-color: rgb(251, 231, 152);
		
	}
</style>

