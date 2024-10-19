<?php
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	$year  = "2023";
	$tn = $database->charEncoder($_GET['tn']);
	$sql = "select TrackingNumber, Adv1, Name, Claimant, NetAmount from vouchercurrent a left join office b on a.office = b.Code  where TrackingNumber  = '" . $tn . "' group by trackingnumber limit 1";
	$record = $database->query($sql);
	$count =  $database->num_rows($record);
	$data = $database->fetch_array($record);
	$claimant = $data['Claimant'];
	
	echo $claimant . ' - Letter Format' ;
	
?>


<link rel="icon" href="/citydoc2023/images/cheque1.png"/> 
<title>Unclaimed - <?php echo $claimant; ?></title>
