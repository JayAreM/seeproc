<?php
	session_start();
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	$sql = "select * from listattachments where trackingnumber = '" . $trackingNumber . "' order by name asc";
	$record = $database->query($sql);
	
	$count = $database->num_rows($record);
	
	$sheet = '<table style = "margin:0 auto;width:700px;">';
	$sheet .= '<tr>
					<td class = "tdHeader" style = "border:0;width:10px;">&nbsp;</td>
					<td class = "tdHeader" style = "text-align:center;width:10px;">RAF</td>
					<td class = "tdHeader" style = "padding-left:10px;">FULLNAME</td>
					<td class = "tdHeader" style = "text-align:center;">AMOUNT</td>	
				  </tr>';
	$i = 1;
	$total = 0;
	while($data = $database->fetch_array($record)){
		$raf = $data['RAF'];
		$name =  $data['Name'];
		$amount = $data['Amount'];
		$total = $total + $amount;	
		$sheet .= '<tr>
					<td class = "tdContent" style = "text-align:center;width:10px;border:0;">' . $i. '.</td>
					<td class = "tdContent" style = "text-align:center;">' . $raf . '</td>
					<td class = "tdContent">' . $name . '</td>
					<td class = "tdContent" style = "text-align:right;">' . number_format($amount,2) . '</td>	
				  </tr>';
		$i++;
	}
	
	$sheet .= '<tr>
					
					<td colspan ="4"  style = "text-align:right;padding:5px 10px;">Total   <span style = "font-weight:bold;letter-spacing:1px;font-size:20px;padding-left:10px;">' .  number_format($total,2) . '</span></td>	
				  </tr>';
	$sheet .= '</table>';
	
	echo LingapHeader($trackingNumber,$count);
	echo $sheet;
	function LingapHeader($trackingNumber,$count){
		$pre = $_SESSION['perm'];
		if($pre == 30){
			$h = 'PCSO';
		}else{
			$h = 'LINGAP';
		}
		if($count > 1){
			$label = "names";
		}else{
			$label = "name";
		}
		$sheet = '<table class = "header" style = "">
					<tr>
						<td style = "text-align:right;font-weight:normal;font-size:16px;">TN#:<span style = "font-size:18px;font-weight:bold;padding-right:20px;"> ' . $trackingNumber . '</span></td>	
					</tr>
					<tr>
						<td style = "padding:5px 20px;text-align:center;"><span style = "border-bottom:1px solid black;padding:2px 20px;">List of ' . $h . '   Beneficiaries<span style = "font-size:14px;"> ('  .$count .' ' . $label  .  ' )</span></span></td>
						
					</tr>
					
				</table>';
		return $sheet;
	}
	

?>


<style>
	.header{
		margin:0 auto;
		font-size: 22px;
		font-weight: bold;
		width:700px;
		margin-bottom: 20px;
	}
	.tdHeader{
		font-weight:bold;
		
	}
	.tdContent{
		padding:2px 10px;
		border-bottom: 1px solid silver;
		
	}
</style>
<link rel="icon" href="/citydoc/images/greenlike.png"/> 
<title>LINGAP List</title>
<div>
	
</div>