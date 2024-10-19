<?php
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	$year  = "2023";
	
			
	$sql = "select TrackingNumber, Adv1, Name, Claimant,CheckDate,CheckNumber, NetAmount 
			from vouchercurrent a left join office b on a.office = b.Code  where 
				status = 'Check Advised'  and DATEDIFF(NOW(),CheckDate) > 45
				group by trackingnumber order by Claimant asc";
	$record = $database->query($sql);
	$count =  $database->num_rows($record);
	if($count > 1){
		$count = '(' . $count . ' transactions)';
	}else{
		$count = '(' . $count . ' transaction)';
	}
	$sheet = '<table style = "margin:0 auto;font-family:arial;font-size:12px;border-spacing:0;border-bottom:1px solid black;margin-top:10px;width:700px;" >';
	$sheet .= '<tr>
				<td colspan = "10" style = "text-align:center;padding:15px 10px;">
					<div style = "font-size:16px;font-weight:bold;">LIST OF 45 DAYS DUE CHECKS</div>
				    <div style = "letter-spacing;1px;">' . $count . '</div>	
				</td></tr>';
	$sheet .= '<tr>
				<th></th>
				<th>TN</th>
			
				<th style = "text-align:left;">Office</th>
				<th style = "text-align:left;">Payee Name</th>
				<th style = "text-align:left;">Check&nbsp;N#</th>
				<th>Amount</th>
				<th style = "text-align:left;">Check&nbsp;Date</th>
				<th style = "text-align:left;">Days</th>
				
			  </tr>';
	$i = 1;
	while($data = $database->fetch_array($record)){
		$checkdate  = $data['CheckDate'];
		$ctr = $database->dayCounter($checkdate);
		$tn  = $data['TrackingNumber'];
		$checknumber  = $data['CheckNumber'];
		
		$claimant = $data['Claimant'];
		$net = $data['NetAmount'];
		$adv = $data['Adv1'];
		$office = $data['Name'];
		
		$sheet .= '<tr>';
		$sheet .= '<td style = "text-align:center;">' . $i++ . '</td>';

		$sheet .= '<td>' . $tn . '</td>';
		//$sheet .= '<td style = "text-align:center;">' . $adv . '</td>';
		$sheet .= '<td>' . $office . '</td>';
		$sheet .= '<td>' . $claimant . '</td>';
		
		$sheet .= '<td style = "text-align:center;">' . $checknumber . '</td>';
		
		$sheet .= '<td style = "text-align:right;">' . number_format($net,2) . '</td>';
		
		$sheet .= '<td style = "text-align:center;">' . $checkdate . '</td>';
		$sheet .= '<td style = "text-align:center;">' . $ctr . '</td>';
		
		
		
	}
	$sheet .='</table>';
	
	$sheet .='<div style = "width:700px;margin:0 auto;padding:5px;font-family:arial;font-size:12px;"><span style = "float:right;">Source : DocTrack ' . $year . '</span><span style = "">' . date("Y-m-d H:i:s") . '</span></div>';
	echo $sheet;
	
?>

<style>
	td{
		padding:2px 5px;
		border:1px solid black;
		border-left:0;
		border-bottom: 0;
		display: table-cell;
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
<title>Due Checks</title>