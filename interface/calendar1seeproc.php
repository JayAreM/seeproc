<?php
	require_once("../includes/database.php");
	//$tn =  $database->charEncoder($_GET['tn']);
	/*$status =  $database->charEncoder($_GET['status']);
	$date =  $database->charEncoder($_GET['date']);
	$type =  $database->charEncoder($_GET['type']);*/
	
	$date = "2023-08-10";
	$type = "PR";
	$status = "BAC Received";
	$document = "Purchase Request";
	
	/*$sql = "select * from citydoc2023.vouchercurrent where Status = '" . $status . "'
			and TrackingType = '" . $type . "' and substr(DateModified,1,10) =  '" . $date . "'";*/
			
			
	if($document == "Purchase Request"){
			$sql = "
				select a.*,b.Name as OfficeName,c.Description,c.Code from(select * from vouchercurrent where trackingtype = 'PR' and status  = '" . $status . "' and substr(DateModified,1,10) = '" . $date . "' group by trackingnumber) a
				left join office b on a.Office = b.Code
				left join ppmpcategories c on a.PR_CategoryCode = c.code
				order by OfficeName asc
				";
	}else if($document == "Purchase Order"){
		$sql = "select a.*,b.Name as OfficeName,c.Description,c.Code from(select * from vouchercurrent where trackingtype = 'PO' and status  = '" . $status . "' and substr(DateModified,1,10) = '" . $date . "' group by trackingnumber) a
				left join office b on a.Office = b.Code
				left join ppmpcategories c on a.PR_CategoryCode = c.code
				
				order by OfficeName asc
				";
	}else {
		$sql = "select a.*,b.Name as OfficeName,c.Description,c.Code from(select * from vouchercurrent where documenttype = '" . $document . "' and status  = '" . $status . "' and substr(DateModified,1,10) = '" . $date . "' group by trackingnumber) a
				left join office b on a.Office = b.Code
				order by OfficeName asc";
	}		
			
	
	$record = $database->query($sql);

	
	$sheet = '<table id = "c1" border = "1">';
	
	$sheet .= '<tr>';
	$sheet .= '<td></td>';	
	$sheet .= '<td>TN</td>';
	$sheet .= '<td>Claimant</td>';
	$sheet .= '<td>Amount</td>';
	$sheet .= '<td>Status</td>';
	$sheet .= '<td>Updated</td>';
	$sheet .= '</tr>';
	$i = 1;
	while($data = $database->fetch_array($record)){
		$tn = $data['TrackingNumber'];
		$claimant = $data['Claimant'];
		$status = $data['Status'];
		$amount = $data['Amount'];
		$modified = $data['DateModified'];
		$remark1 = $data['Remarks'];
		
		$remark1 = $data['Description'];
		$remark1 = $data['Code'];
		
		$sheet .= '<tr>';
		$sheet .= '<td>' . $i++ . '</td>';	
		$sheet .= '<td>' . $tn . '</td>';
		$sheet .= '<td>' . $claimant . '</td>';
		$sheet .= '<td>' . $amount . '</td>';
		$sheet .= '<td>' . $status . '</td>';
		$sheet .= '<td>' . $modified . '</td>';
		$sheet .= '</tr>';
		
	}
	$sheet .= '</table>';
	/*
	$sql = "select * from citydoc2023.vouchercurrent where TrackingNumber = '" . $tn . "' limit 1";
	$record = $database->query($sql);

	$data = $database->fetch_array($record);
	
	$tn = $data['TrackingNumber'];
	$claimant = $data['Claimant'];
	$status = $data['Status'];
	$amount = $data['Amount'];
	$modified = $data['DateModified'];
	$remark1 = $data['Remarks'];
	
	$sheet = '<table id = "c1" border = "1">';
	$sheet .= '<tr><td colspan ="2" style ="background-color:silver;color:white;">General Information</td></tr>';
	$sheet .= '<tr><td>Tracking Number</td><td>' . $tn . '</td></tr>';
	$sheet .= '<tr><td>Claimant</td><td>' . $claimant . '</td></tr>';
	$sheet .= '<tr><td>Amount</td><td>' . $amount . '</td></tr>';
	$sheet .= '<tr><td>Status</td><td>' . $status . '</td></tr>';
	$sheet .= '<tr><td>Updated</td><td>' . $modified . '</td></tr>';
	$sheet .= '</table>';*/
	
	echo $sheet;
	
?>
<style>
	#c1{
		border:1px solid silver;
		margin:0 auto;
		padding:20px;
		border-spacing: 0;
	}
	#c1 td{
		padding:2px 5px;
	}
</style>
