<?php
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	$year  = "2023";
	$sql = "select a.*,c.Name as Office,b.Claimant,b.DocumentType,b.NetAmount from cancelledchecks a 
				left join vouchercurrent b on a.TrackingNumber = b.TrackingNumber
				left join office c on b.Office = c.Code 
				order by a.id desc";
	$record = $database->query($sql);
	$count =  $database->num_rows($record);
	if($count > 1){
		$count = '(' . $count . ' transactions)';
	}else{
		$count = '(' . $count . ' transaction)';
	}
	$sheet = '<table style = "margin:0 auto;font-family:arial;font-size:12px;border-spacing:0;border-bottom:1px solid black;margin-top:10px;width:800px;" >';
	$sheet .= '<tr>
				<td colspan = "100%" style = "text-align:center;padding:15px 10px;">
					<div style = "font-size:16px;font-weight:bold;">LIST OF CANCELLED CHECKS</div>
				    <div style = "letter-spacing;1px;">' . $count . '</div>	
				</td></tr>';
	$sheet .= '<tr>
				<th></th>
				<th style = "text-align:left;">Office</th>
				<th >TN</th>
				<th style = "text-align:left;">Claimant</th>
				<th style = "text-align:left;">Transaction Type</th>
				<th style = "text-align:right;">Amount</th>
				<th >Check Number</th>
				<th>Check Date</th>
				<th>Date Cancelled</th>
			  </tr>';
	$i = 1;
	while($data = $database->fetch_array($record)){
		$tn = $data['TrackingNumber'];
		$checknumber = $data['CheckNumber'];
		$checkdate = $data['CheckDate'];
		$dateModified = $data['DateModified'];
		$modifiedBy  = $data['ModifiedBy'];
		$remarks  = $data['Remarks'];
		$reiisue  = $data['Reissue'];
		$office  = $data['Office'];
		$claimant  = $data['Claimant'];
		$docType  = $data['DocumentType'];
		$net  = $data['NetAmount'];
		
		$sheet .= '<tr>';
		$sheet .= '<td style = "text-align:center;vertical-align:top;">' . $i++ . '</td>';

	
		$sheet .= '<td style = "">' . $office . '</td>';
		$sheet .= '<td style = "text-align:left;vertical-align:top;">' . $tn . '</td>';
		$sheet .= '<td style = "text-align:left;vertical-align:top;">' . $claimant . '</td>';
		$sheet .= '<td style = "text-align:left;vertical-align:top;">' . $docType . '</td>';
		$sheet .= '<td style = "text-align:right;">' . number_format($net,2) . '</td>';
		$sheet .= '<td style = "vertical-align:top;text-align:center;"> ' . $checknumber . '</td>';
		$sheet .= '<td style = "vertical-align:top;text-align:center;">' . $checkdate . '</td>';
		$sheet .= '<td style = "vertical-align:top;text-align:center;">' . $dateModified . '</td>';
		
		
	}
	$sheet .='</table>';
	
	$sheet .='<div style = "width:800px;margin:0 auto;padding:5px;font-family:arial;font-size:12px;"><span style = "float:right;">Source : DocTrack ' . $year . '</span><span style = "">' . date("Y-m-d H:i:s") . '</span></div>';
	echo $sheet;
	
?>

<style>
	td{
		padding:2px 5px;
		border:1px solid black;
		border-left:0;
		border-bottom: 0;
	}
	td:first-child{
		border-left:1px solid black;
	}
	
	th{
		padding:5px 8px;
		font-weight: bold;
		border:1px solid black;
		border-left:0;
	}
	th:first-child{
		border-left:1px solid black;
	}
</style>
<link rel="icon" href="/citydoc2023/images/cheque1.png"/> 
<title>Unclaimed Checks</title>
