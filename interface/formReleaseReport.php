<?php
	require_once('../includes/database.php');
	$x = 0;
	if(isset($_GET['date'])){
		$date =  $database->charEncoder($_GET['date']);
		$status = $database->charEncoder($_GET['status']);
		$type = $database->charEncoder($_GET['type']);
	}else{
		$date =  date("Y-m-d");
		$status ="CAO Released";
		$type = "Summary";
	}
	if(isset($_GET['excel'])){
		$x = $database->charEncoder($_GET['excel']);
		if($x == 1){
			$date =  $database->charEncoder($_GET['date']);
			$status =  $database->charEncoder($_GET['status']);
			$type =  $database->charEncoder($_GET['type']);	
			echo excel($status,$date,$type,$database);
		}
	}
?>

<?php
		if($x != 1){
?>

<style>
	body{
		font-family:arial;
		padding:0;
		margin:0;
	}
	#tableMainForm{
		margin:0 auto;
		margin-top:50px;
		width:670px;
		border-spacing:0;
	}
	
	
	.tdData{
		padding:5px 10px;
		vertical-align: top;
		border-left:1px solid silver;
		border-bottom:1px solid grey;
	}
	.tdHeader{
		padding:5px 10px;
		font-weight:bold;
		border:0;
	}
	select{
		padding:5px;
		background-color:rgb(66, 84, 105);
		color:white;
		border:0;
		border-top:1px solid grey;
		border-left:1px solid grey;
		
	}
	.label1{
		color:silver;
		font-weight:bold;
	}
	.button1{
		border-bottom:1px solid silver;
		border-right:1px solid silver;
		
		background-color:rgb(230, 237, 241);
		text-align:center;
		width:100px;
		padding:5px 10px;
		margin-left:10px;
		font-size:16px;
		cursor:pointer;
		letter-spacing: 1px;
		transition: all .5s;
	}
	.button1:hover{
		box-shadow:0px 0px 1px 0px silver;
		
		text-shadow:0px 0px 1px grey;
		background-color:rgb(216, 226, 231);

	}
</style>
<link rel="icon" href="/city/images/print.png"/> 
<title>Report View</title>



<div style= "background-color:rgb(38, 101, 138);padding:10px;">
	<span class = "label1">Type :</span> 
	<select id = "type">
		<option><?php echo $type;  ?></option>
		<option>Summary</option>
		<option>History</option>
	</select>
	<span class = "label1">Status :</span> 
	<select id = "status">
		<option><?php echo $status;  ?></option>
		<option>CAO Received</option>
		<option>CAO Released</option>
		<option>Pending at CAO</option>
		<option>Pending Released - CAO</option>
	</select>
	<span class = "label1">Date :</span> 
	<select id = "date">
		<option><?php echo $date;  ?></option>
		<?php
			$y = date("Y");
			$m = date("m");
			$d = date("d");
			for($i = 0 ; $i < 20 ; $i++){
				$dt =   ($d - $i);
				if($dt <10){
					$dt = '0' . $dt;
				}
				echo "<option>" . $y . "-" . $m . "-" . $dt .  "</option>"; 
			}
		?>
	</select>
	<input type = "button" class = "button1"value = "submit" onclick="ajaxGetAndConcatenate()"/>
</div>
<?php
		if($type == "Summary"){
			 $case = "select a.*,b.DateModified,b.Count from 
					(SELECT TrackingNumber,TrackingType,DocumentType,ADV1,ADV2,Claimant,PeriodMonth,Remarks,Amount,TotalAmountMultiple,ChargeType,Completion,DateEncoded
					 FROM vouchercurrent where Status = '" . $status . "' and substr(DocumentType,1,5) = 'Wages' and substr(Datemodified,1,10) = '" . $date . "' group by trackingnumber) a
					 left join 
					 (SELECT *,count(Id) as Count FROM voucherhistory where status = 'Pending at CAO' group by trackingnumber order by trackingnumber) b
					 on a.TrackingNumber = b.TrackingNumber order by a.claimant ";	
			 echo createSheetA($case,$date,$status,$type,$database);
		}else{
			$case = "select a.*,b.DateModified,b.Status,b.Completion,a.Id as Count  from 
					(SELECT Id, TrackingNumber,TrackingType,DocumentType,ADV1,ADV2,Claimant,PeriodMonth,Remarks,Amount,TotalAmountMultiple,ChargeType
					 FROM vouchercurrent where Status = '" . $status . "' and substr(DocumentType,1,5) = 'Wages'   and substr(Datemodified,1,10) = '" . $date . "' group by trackingnumber) a
					 left join 
					voucherhistory  b
					 on a.TrackingNumber = b.TrackingNumber order by a.TrackingNumber,b.Id";
			 echo createSheetB($case,$date,$status,$type,$database);
		}
	
	}
	
	function createSheetA($case,$date,$status,$type,$database){
		//include('../includes/database.php');
		$record = $database->SelectQuery($case);
		$sheet = '<table style = "border-spacing:0;width:800px;margin:40px auto;">';
		$sheet .='<tr >';
		$sheet .='	<td colspan ="8" class = "tdHeader" style = "">Release date :  <span  style = "font-weight:bold;color:rgb(37, 150, 216);">' . $date . '</span></td>';
		$sheet .='</tr>';
		$sheet .='<tr style = "background-color1:rgb(208, 210, 209);">';
		$sheet .='	<td colspan ="8" class = "tdHeader" style = "padding-left:59px;">Status  :  <span  style = "font-weight:bold;color:rgb(37, 150, 216);">' . $status . '</span></td>';
		$sheet .='</tr>';
		$sheet .='<tr style = "background-color1:rgb(208, 210, 209);">';
		$sheet .='	<td colspan ="8" class = "tdHeader" style = "padding-left:70px;">Type :  <span  style = "font-weight:bold;color:rgb(37, 150, 216);">' . $type . '</span></td>';
		$sheet .='</tr>';
		$sheet .='<tr style = "background-color1:rgb(208, 210, 209);">';
		$sheet .='	<td colspan ="8" class = "tdHeader" style = "padding-left:65px;">Rows :  <span  style = "font-weight:bold;color:rgb(37, 150, 216);">'  . $database->num_rows($record) . '</span></td>';
		$sheet .='</tr>';
		$sheet .='<tr style = "background-color:rgb(201, 227, 243);">';
		$sheet .='	<td class = "tdHeader">&nbsp;</td>';
		$sheet .='	<td class = "tdHeader">TN</td>';
		$sheet .='	<td class = "tdHeader">ADV</td>';
		$sheet .='	<td class = "tdHeader">Claimant</td>';
		$sheet .='	<td class = "tdHeader">Amount</td>';
		$sheet .='	<td class = "tdHeader">Type</td>';
		$sheet .='	<td class = "tdHeader">Period</td>';
		
		$sheet .='	<td class = "tdHeader">X</td>';
		$sheet .='	<td class = "tdHeader" style = "border-right:1px solid silver;">Remarks</td>';
		$sheet .='	<td class = "tdHeader" style = "border-right:1px solid silver;">Date Encoded</td>';
		$sheet .='	<td class = "tdHeader" style = "border-right:1px solid silver;">Completion</td>';
		$sheet .='</tr>';
		$tn = '';
		$i = 1;
		while($data = $database->fetch_array($record)){
			$trackingNumber = $data['TrackingNumber'];
			$trackingType = $data['TrackingType'];
			$documentType = $data['DocumentType'];	
			$adv1 =  $data['ADV1'];	
			$adv2 =  $data['ADV2'];
			if($adv2 > 0){
				$adv = $adv2;
			}else{
				$adv = $adv1;
			}
			$claimant = strtoupper( $database->CharEncoder($data['Claimant'])); 
			$periodMonth = $data['PeriodMonth'];
			$encoded = $data['DateEncoded'];
			$completion = $data['Completion'];
			$amount = number_format($data['Amount'],2);
			$totalAmount = $data['TotalAmountMultiple'];
			$count = $data['Count'];
			if($totalAmount != 0){
				$amount =number_format( $totalAmount,2);
			}
			$chargeType = $data['ChargeType'];
		
			$remarks = $data['Remarks'];
			if($tn != $trackingNumber){
				$tn = $trackingNumber;
			}else{
				$trackingNumber = '';
				$claimant = '';
				$transactionType = '';
				$amount = '';
				$remarks ='';
			}
			if($i % 2 == 0){
				$sheet .='<tr style = "background-color:rgb(221, 221, 218);">';
			}else{
				$sheet .='<tr style = "background-color:rgb(249, 246, 230);">';
			}
			$sheet .='	<td class = "tdData" style=  "background-color:white;font-weight:bold;">' . $i++  . '</td>';
			$sheet .='	<td class = "tdData">' . $trackingNumber  . '</td>';
			$sheet .='	<td class = "tdData">' . $adv  . '</td>';
			$sheet .='	<td class = "tdData"  style = "text-overflow:nowrap;white-space: nowrap;">' . $claimant  . '</td>';
			$sheet .='	<td class = "tdData" style = "text-align:right;">' . $amount . '</td>';
			$sheet .='	<td  class = "tdData" style = "text-overflow:nowrap;white-space: nowrap;">' . $documentType  . '</td>';
			$sheet .='	<td  class = "tdData">' . $periodMonth  . '</td>';
			
			$sheet .='	<td class = "tdData">' . $count  . '</td>';
			$sheet .='	<td class = "tdData" style = "border-right:1px solid silver;">' . $remarks . '</td>';		
			$sheet .='	<td class = "tdData" style = "text-overflow:nowrap;white-space: nowrap;">' . $encoded  . '</td>';
			$sheet .='	<td class = "tdData">' . $completion  . '</td>';
			$sheet .='</tr>';
		}
		$sheet .= '<tr><td colspan = "10"><div class = "button1" onclick = "ajaxGetExcel()" style = "margin:20px auto;">Save</div></td></tr>';
		$sheet .= '</table>';
		return $sheet ;
	}
	function createSheetB($caseB,$date,$status,$type,$database){
		//include('../includes/database.php');
		$record = $database->SelectQuery($caseB);
		$sheet = '<table style = "border-spacing:0;width:800px;margin:40px auto;">';
		$sheet .='<tr >';
		$sheet .='	<td colspan ="10" >Release Date : <span  style = "font-weight:bold;color:rgb(37, 150, 216);">' . $date . '</span></td>';
		$sheet .='</tr>';
		$sheet .='<tr >';
		$sheet .='	<td colspan ="10" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type : <span  style = "font-weight:bold;color:rgb(37, 150, 216);">' .ucwords( $type) . '</span></td>';
		$sheet .='</tr>';
		
		$sheet .='<tr style = "background-color:rgb(201, 227, 243);">';
		$sheet .='	<td class = "tdHeader" style = "border-top:1px solid silver;border-left:1px solid silver;">&nbsp;</td>';
		$sheet .='	<td class = "tdHeader" style = "border-top:1px solid silver;">TN</td>';
		$sheet .='	<td class = "tdHeader" style = "border-top:1px solid silver;">ADV</td>';
		$sheet .='	<td class = "tdHeader" style = "border-top:1px solid silver;">Claimant</td>';
		$sheet .='	<td class = "tdHeader" style = "border-top:1px solid silver;">Amount</td>';
		$sheet .='	<td class = "tdHeader" style = "border-top:1px solid silver;">Type</td>';
		$sheet .='	<td class = "tdHeader" style = "border-top:1px solid silver;">Modified</td>';
		$sheet .='	<td class = "tdHeader" style = "border-top:1px solid silver;">Status</td>';
		$sheet .='	<td class = "tdHeader" style = "border-top:1px solid silver;">Completion</td>';
		
		$sheet .='	<td class = "tdHeader" style = "border-top:1px solid silver;border-right:1px solid silver;">Remarks</td>';
		$sheet .='</tr>';
		$tn = '';
		$i = 1;
		while($data = $database->fetch_array($record)){
			$trackingNumber = $data['TrackingNumber'];
			$trackingType = $data['TrackingType'];
			$documentType = $data['DocumentType'];	
			$adv1 =  $data['ADV1'];	
			$adv2 =  $data['ADV2'];
			if($adv2 > 0){
				$adv = $adv2;
			}else{
				$adv = $adv1;
			}
			$claimant = strtoupper( $database->CharEncoder($data['Claimant'])); 
			$periodMonth = $data['PeriodMonth'];
			
			$amount = number_format($data['Amount'],2);
			$totalAmount = $data['TotalAmountMultiple'];
			$count = $data['Count'];
			$status = $data['Status'];
			$dateModified =  $data['DateModified'];
			if($totalAmount != 0){
				$amount =number_format( $totalAmount,2);
			}
			$completion = $data['Completion'];
			$chargeType = $data['ChargeType'];
			$remarks = $data['Remarks'];
			if($tn != $trackingNumber){
				$sheet .='<tr style = "background-color:rgb(221, 221, 218);">';	
				$tn = $trackingNumber;
				
				$sheet .='	<td class = "tdData" style=  "background-color:white;font-weight:bold;border-top:1px solid grey;">' . $i++  . '</td>';
				$sheet .='	<td class = "tdData" style = "border-top:1px solid grey;">' . $trackingNumber  . '</td>';
				$sheet .='	<td class = "tdData" style = "border-top:1px solid grey;">' . $adv  . '</td>';
				$sheet .='	<td class = "tdData"  style = "text-overflow:nowrap;white-space: nowrap;border-top:1px solid grey;">' . $claimant  . '</td>';
				$sheet .='	<td class = "tdData" style = "border-top:1px solid grey;">' . $amount . '</td>';
				$sheet .='	<td  class = "tdData" style = "border-top:1px solid grey; text-overflow:nowrap;white-space: nowrap;">' . $documentType  . '</td>';
				$sheet .='	<td  class = "tdData"  style = "text-overflow:nowrap;white-space: nowrap;border-top:1px solid grey;">' . $dateModified . '</td>';
				$sheet .='	<td class = "tdData" style = "text-overflow:nowrap;white-space: nowrap;border-top:1px solid grey;">' . $status . '</td>';
				$sheet .='	<td class = "tdData" style = "text-overflow:nowrap;white-space: nowrap;border-top:1px solid grey;">' . $completion . '</td>';
				
				$sheet .='	<td class = "tdData" style = "border-top:1px solid grey;">' . $remarks . '</td>';		
				
			}else{
				$sheet .='<tr style = "background-color:rgb(248, 248, 245);">';
				$trackingNumber = '';
				$claimant = '';
				$transactionType = '';
				$amount = '';
				$remarks ='';
				$adv = '';
				
				$sheet .='	<td class = "tdData" style=  "border:0;" ></td>';
				$sheet .='	<td class = "tdData" style= "border:0;">' . $trackingNumber  . '</td>';
				$sheet .='	<td class = "tdData" style= "border:0;">' . $adv  . '</td>';
				$sheet .='	<td class = "tdData"  style = "text-overflow:nowrap;white-space: nowrap;border:0;">' . $claimant  . '</td>';
				$sheet .='	<td class = "tdData" style= "border:0;">' . $amount . '</td>';
				$sheet .='	<td  class = "tdData" style= "border:0;">' . $transactionType  . '</td>';
				$bg = '';
				if($status == "Pending at CAO"){
					$bg = "background-color: rgb(247, 216, 228);";
				}else{
					$bg = "";
				}
				$sheet .='	<td  class = "tdData"  style = " border-bottom:1px solid rgb(222, 227, 233);text-overflow:nowrap;white-space: nowrap;font-size:12px;letter-spacing:1px;'  . $bg . '">' . $dateModified . '</td>';
				$sheet .='	<td class = "tdData" style = "border-bottom:1px solid rgb(222, 227, 233);border-right:1px solid rgb(222, 227, 233); text-overflow:nowrap;white-space: nowrap;'  . $bg . '">' . $status . '</td>';
				$sheet .='	<td class = "tdData" style = "border-bottom:1px solid rgb(222, 227, 233);border-right:1px solid rgb(222, 227, 233); text-overflow:nowrap;white-space: nowrap;'  . $bg . '">' . $completion . '</td>';
				$sheet .='	<td class = "tdData" style = "border:0;">' . $remarks . '</td>';		
			}
			$sheet .='</tr>';
		}
		$sheet .= '<tr><td colspan = "10"><div class = "button1" onclick = "ajaxGetExcel()" style = "margin:20px auto;">Save</div></td></tr>';
		$sheet .= '</table>';
		return $sheet ;
	}

	function excel($status,$date,$type){
		$count = 0;
		$data ='';
		$header ='';
		if($type == "Summary"){
			/* $case = "select a.*,b.DateModified,b.Count from 
					(SELECT TrackingNumber,TransactionType,ClaimType,ADV1,ADV2,Claimant,PeriodMonth,Remarks,Amount,TotalAmountMultiple,ChargeType,Completion,DateEncoded
					 FROM citydoc.vouchercurrent where Status = '" . $status . "' and ClaimType = 'Salary' and substr(Datemodified,1,10) = '" . $date . "' group by trackingnumber) a
					 left join 
					 (SELECT *,count(Id) as Count FROM citydoc.voucherhistory where status = 'Pending at CAO' group by trackingnumber order by trackingnumber) b
					 on a.TrackingNumber = b.TrackingNumber order by a.claimant ";	*/
			 $case = "select a.*,b.DateModified,b.Count from 
					(SELECT TrackingNumber,TrackingType,DocumentType,ADV1,ADV2,Claimant,PeriodMonth,Remarks,Amount,TotalAmountMultiple,ChargeType,Completion,DateEncoded
					 FROM vouchercurrent where Status = '" . $status . "' and substr(DocumentType,1,5) = 'Wages' and substr(Datemodified,1,10) = '" . $date . "' group by trackingnumber) a
					 left join 
					 (SELECT *,count(Id) as Count FROM voucherhistory where status = 'Pending at CAO' group by trackingnumber order by trackingnumber) b
					 on a.TrackingNumber = b.TrackingNumber order by a.claimant ";	
			
		}else{
			/*$case = "select a.*,b.DateModified,b.Status,b.Completion  from 
					(SELECT TrackingNumber,TransactionType,ClaimType,ADV1,ADV2,Claimant,PeriodMonth,Remarks,Amount,TotalAmountMultiple,ChargeType
					 FROM citydoc.vouchercurrent where Status = '" . $status . "' and ClaimType = 'Salary'  and substr(Datemodified,1,10) = '" . $date . "' group by trackingnumber) a
					 left join 
					citydoc.voucherhistory  b
					 on a.TrackingNumber = b.TrackingNumber order by a.TrackingNumber,b.Id";*/
			$case = "select a.*,b.DateModified,b.Status,b.Completion,a.Id as Count  from 
					(SELECT Id, TrackingNumber,TrackingType,DocumentType,ADV1,ADV2,Claimant,PeriodMonth,Remarks,Amount,TotalAmountMultiple,ChargeType
					 FROM vouchercurrent where Status = '" . $status . "' and substr(DocumentType,1,5) = 'Wages'   and substr(Datemodified,1,10) = '" . $date . "' group by trackingnumber) a
					 left join 
					voucherhistory  b
					 on a.TrackingNumber = b.TrackingNumber order by a.TrackingNumber,b.Id";
		}
		
		//include('../includes/database.php');
		$result = $database->SelectQuery($case);
		$count = mysqli_num_fields($result);
		
		while ($property = mysqli_fetch_field($result)) {
		      $header .= $property->name . "\t";
		}
		while($row = mysqli_fetch_row($result))  {
		  $line = '';
		  foreach($row as $value)       {
		    if(!isset($value) || $value == "")  {
		      $value = "\t";
		    }   else  {
		        $value = str_replace('"', '""',urldecode($value));
		         $value = '"' . $value . '"' . "\t";
		    }
		    $line .= $value;
		  }
		  $data .= trim($line)."\n";
		}
		  $data = str_replace("\r", "", $data);
		if ($data == "") {
		  $data = "\nno matching records found\n";
		}
		
		$count = mysqli_num_fields($result);

		header('Content-Encoding: UTF-8');
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=excelfile.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		return $header."\n".$data;
	}
?>

<?php
		if($x != 1){

?>
<script> 

	 function ajaxGetAndConcatenate(){
		var status = document.getElementById("status").value;
		var date = document.getElementById("date").value;
		var type = document.getElementById("type").value;
		var queryString ="?status=" + status + "&date=" + date + "&type=" + type;
		document.body.innerHTML  = "<div style = 'margin:100px auto;font-weight:bold;width:300px;font-size:20px;'>Hulat sa kadali. . .</div>";
		try{
			ajaxRequest = new XMLHttpRequest();
		} catch (e){
			try{
				ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try{
					ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e){
					alert("Your browser broke!");
					return false;
				}
			}
		}
		ajaxRequest.open("GET", "../interface/formreleasereport.php" + queryString, true);
		ajaxRequest.send(null); 
		ajaxRequest.onreadystatechange = function(){	
			if(ajaxRequest.readyState == 4){
				var result =  ajaxRequest.responseText.trim();
				document.body.innerHTML = result;
			}
		}
	}
	 function ajaxGetExcel(){
		var status = document.getElementById("status").value;
		var date = document.getElementById("date").value;
		var type = document.getElementById("type").value;
		var queryString ="?status=" + status + "&date=" + date + "&type=" + type + "&excel="  + 1;
		window.open('../interface/formreleasereport.php' + queryString,'_top');
		
	}
</script>
<?php
		}

?>
