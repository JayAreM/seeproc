<?php
 	require_once("../includes/database.php");
 	if(isset($_GET['office'])){
		$dt = time();
		$today = date('Y-m-d h:i A', $dt);
		$type = $database->charEncoder($_GET['type']);
		
		$cat = '';
		if($type < 3){
			$cat = $database->charEncoder($_GET['cat']);
			$case2 = " PR_CategoryCode = '" . $cat . "' ";
		}else{
			$case2 =  " PR_CategoryCode != 'x' ";
		}
		
	
		
		$office = $database->charEncoder($_GET['office']);
		
		$transaction = 'Purchase Request';
		if($office == 'All'){
			$case1 =' office != "" ';
			$officeName = "All Offices";
			$colspan = 8;
		}else{
			$colspan = 7;
			$case1 ="office = '" . $office . "'";
			$sql = "select * from office  where code = '" . $office . "' limit 1";
			$record = $database->query($sql);
			$data= $database->fetch_array($record);
			$officeName = $data['Name'];
		}
		
		
		
		$subtitle = "(base on purchased request category)";
		if($type == 1){
			$sql = "select a.*,b.Description as CategoryName ,c.Name as OfficeName
				from(select * from vouchercurrent where Trackingtype = 'PR' and " .  $case1 ." and $case2 and status != 'Cancelled' group by trackingnumber ) a
				left join ppmpcategories b on a.PR_CategoryCode = b.code
				left join office c on a.office = c.code 
				 order by c.Name asc,a.Id asc";	
		}else if($type == 2){
			$sql = "select a.*,b.Description as CategoryName ,c.Name as OfficeName
				from(select * from vouchercurrent where Trackingtype = 'PR' and " .  $case1 ." and $case2 and status = 'For P.O' group by trackingnumber ) a
				left join ppmpcategories b on a.PR_CategoryCode = b.code
				left join office c on a.office = c.code 
				 order by c.Name asc,a.Id asc";	
		}else if($type == 3){
			$sql = "select a.*,b.Description as CategoryName ,c.Name as OfficeName
				from(select * from vouchercurrent where Trackingtype = 'PR' and " .  $case1 ." and $case2 and  status != 'Cancelled'  group by trackingnumber ) a
				left join ppmpcategories b on a.PR_CategoryCode = b.code
				left join office c on a.office = c.code 
				 order by c.Name asc,a.Id asc";	
			$subtitle = "(all purchase  request transactions)";
		}else if($type == 4){
			$sql = "select a.*,b.Description as CategoryName ,c.Name as OfficeName
				from(select * from vouchercurrent where Trackingtype = 'PR' and " .  $case1 ." and $case2 and  status = 'For P.O'  group by trackingnumber ) a
				left join ppmpcategories b on a.PR_CategoryCode = b.code
				left join office c on a.office = c.code 
				 order by c.Name asc,a.Id asc";	
			$subtitle = "(all awarded purchase  request transactions)";
			
		}
			
				 
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
			
			
			$claimant = $data['Claimant'];
			
			$prNumber = $data['PR_Number'];
			
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
			$multipleAmount = $data['TotalAmountMultiple'];
			
			
			$amount = $data['Amount'];
			$officeAll = $data['OfficeName'];
			
			
			if($multipleAmount > 0){
				$amount = $multipleAmount;
			}
			$category = $data['PR_CategoryCode'];
			$categoryName = $data['CategoryName'];
			$status = $data['Status'];
			$dateEncoded = $data['DateEncoded'];
			$dateModified = $data['DateModified'];
			//$type = $data['TrackingType'];
			
		
			
			
			
			if($i == 1){
				$sheet  ='<table id ="table1" border = "0" style ="margin:40px auto;">';
				
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:center;font-size:22px;padding:10px;font-family:anton;line-height:18px;">List of Procurement Transactions
								<div style ="font-size:16px;font-family:nor;">' . $subtitle . '</div>
							</td></tr>';
				$sheet1 .='<tr><td colspan ="100%" style ="padding:0;">';
				
				$sheet1 .='<table id ="table2"  border ="0" style ="width:100%;">';
				$sheet1 .='<tr><th colspan ="100%"></th></tr>';
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:right;font-weight:bold;">DocTrack ' . $year . '</span></td></tr>';
				
				$sheet1 .='<tr><td colspan ="100%" style ="text-align:right;font-size:14px;line-height:12px;"><span style ="font-size:10px; font-style:italic;padding-right:6px;">as of </span> <span  style =" ">' . $today . '</span></td></tr>';
				$sheet1 .='<tr><th>Office</th><td colspan ="100%" style ="font-weight:bold;" ><span class ="tdDetails">' . $officeName . '</span></td></tr>';
				$sheet1 .='<tr><th style ="width:90px;">Budget Year</th><td colspan ="100%" id ="year" ><span class ="tdDetails">' . $year . '</span></td></tr>';
				
				
			
				
				$statusDisplay = $status;
				if($type == 1 or $type == 3){
					$statusDisplay ="Various";
				}
				
				$sheet1 .='<tr><th>Status</th><td><span class ="tdDetails">' . $statusDisplay . '</span></td></tr>';
				
				if($type < 3){
					$sheet1 .='<tr><th>Category</th><td><span class ="tdDetails">' . $categoryName . '</span></td></tr>';
				}
				
				$sheet1 .='<tr><th>Count</th><td><span class ="tdDetails">' . $num . '</span></td></tr>';
				
				$sheet1 .='<tr><th colspan ="100%" style ="padding:20px;"></th></tr>';
				
				$sheet1 .='</table>';
				
				$sheet1 .='</td></tr>';
				$sheet1 .='<tr><th></th>';
				if($office == "All"){
					$sheet1 .='<th>Office</th>';
				}
				if($type >2 ){
					$sheet1 .='<th>Category</th>';
				}
				
				$sheet1 .='<th>Quarter</th><th>Fund</th><th>Encoded</th><th>PR Number</th><th>TN</th><th style ="text-align:right;">Total Amount </th>';
			
				if($type == 1 or $type == 3){
					$sheet1 .='<th style ="text-align:left;">Status</th>';
				}
				
					
				$sheet1 .='<th style ="text-align:left;">Status Updated</th></tr>';
				$sheet1 .='<tr><th colspan ="100%" style ="border-top:1px solid rgb(232, 173, 164);"></th></tr>';
			}
			
			
			$totalAmount += $amount;
		
			$sheet2 .= '<tr class ="trData">';
			$sheet2 .= '<td class ="tdData" style ="font-size:10px;text-align:center; vertical-align:middle;background-color:rgb(249, 248, 244);">' . $i. '</td>';
			if($office == "All"){
				$sheet2 .='<td class ="tdData">' . $officeAll . '</td>';
			}
			if($type >2 ){
				$sheet2 .= '<td class ="tdData">' . $categoryName . '</td>';
			}
			$sheet2 .= '<td class ="tdData">' . $quarterLabel . '</td>';
			$sheet2 .= '<td class ="tdData">' . $fund . '</td>';
			
			
			$sheet2 .= '<td class ="tdData" style = "padding-right:45px;">' . $dateEncoded . '</td>';
			$sheet2 .= '<td class ="tdData">' . $prNumber . '</td>';
			$sheet2 .= '<td class ="tdData tdDataTN" style ="cursor:pointer;color:rgb(141, 6, 20);" onclick ="showTracking(this)"  id ="tn">' . $tn . '</td>';
			
			
			$sheet2 .= '<td class ="tdData tdDataAmount" style="text-align:right;">' . number_format($amount,2) . '</td>';
			
			
			if($type == 1 or $type == 3){
				$sheet2 .= '<td class ="tdData">' . $status . '</td>';
			}
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
		window.open('../interface/formPRnew.php?tn='+ tn, '_blank');
		
		var office = "<?php echo $officeName;?>";
		window.open('../interface/formOBR.php?trackingNumber='+ tn + '&officeName=' + office +"&payee=", '_blank');
	}
</script>
<title>Procurement List - Quarterly</title>
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

