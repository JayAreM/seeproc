
<style>
	table{
		border-spacing:0px;
		font-family: Arial;
	}
	table th{
		padding:2px 5px;
		background-color:rgb(138, 149, 149);
		color:white;
	}
	table  td{
		border-bottom: 1px solid rgba(206, 210, 210,.7);
		padding:2px 5px;
	}
	table tr:nth-child(even)  > td{
		background-color:rgb(241, 242, 243);
	}
	table tr  > td:first-child {
		background-color:rgb(179, 192, 186);
		text-align: center;
	}
	table tr  > td:last-child {
		
		border-right:1px solid silver;
		border-left:1px solid silver;
		background-color: rgba(234, 241, 214,.5);
	}
	table tr:hover  > td{
		background-color:rgb(253, 233, 106);
	}
	
</style>
<?php
	require_once('../javascript/ajaxFunction.php');
	require_once('../includes/database.php');
	$m =  $_GET['m'];
	$t = $_GET['t'];
	$sql = "select * from defaults";
	$record = $database->query($sql);
	
	$data = $database->fetch_array($record);
	$year = $data['DashboardYear'];
	
 	$sql = "Select *,if(substring(DateModified,1,4) = substring(DateEncoded,1,4),
						 TIMESTAMPDIFF(DAY, substring(DateEncoded,1,10),substring(DateModified,1,10)) + 1 - 
						 (WEEK(substring(DateModified,1,10)) - WEEK(substring(DateEncoded,1,10))) * 2 - 
						 (CASE WHEN WEEKDAY(substring(DateEncoded,1,10)) = 6 THEN 1 ELSE 0 END) -
						 (CASE WHEN WEEKDAY(substring(DateEncoded,1,10)) = 5 THEN 1 ELSE 0 END) -
						 (CASE WHEN WEEKDAY(substring(DateModified,1,10)) = 6 THEN 1 ELSE 0 END) -
						 (CASE WHEN WEEKDAY(substring(DateModified,1,10)) = 5 THEN 1 ELSE 0 END)
					,
						TIMESTAMPDIFF(DAY, concat(substring(DateModified,1,4) ,'-01-01'),substring(DateModified,1,10)) + 1 -
						(WEEK(substring(DateModified,1,10)) - WEEK( concat(substring(DateModified,1,4) ,'-01-01') )) * 2 -
						 (CASE WHEN WEEKDAY(concat(substring(DateModified,1,4) ,'-01-01')) = 6 THEN 1 ELSE 0 END) -
						 (CASE WHEN WEEKDAY(concat(substring(DateModified,1,4) ,'-01-01')) = 5 THEN 1 ELSE 0 END) -
						 (CASE WHEN WEEKDAY(substring(DateModified,1,10)) = 6 THEN 1 ELSE 0 END) -
						 (CASE WHEN WEEKDAY(substring(DateModified,1,10)) = 5 THEN 1 ELSE 0 END) 
						 +
						 TIMESTAMPDIFF(DAY, substring(DateEncoded,1,10), concat(substring(DateEncoded,1,4),'-12-31')) + 1 -
						 (WEEK(concat(substring(DateEncoded,1,4),'-12-31')) - WEEK(substring(DateEncoded,1,10))) * 2 - 
						 (CASE WHEN WEEKDAY(concat(substring(DateEncoded,1,4) ,'-12-31')) = 6 THEN 1 ELSE 0 END) -
						 (CASE WHEN WEEKDAY(concat(substring(DateEncoded,1,4) ,'-12-31')) = 5 THEN 1 ELSE 0 END) -
						 (CASE WHEN WEEKDAY(substring(DateEncoded,1,10)) = 6 THEN 1 ELSE 0 END) -
						 (CASE WHEN WEEKDAY(substring(DateEncoded,1,10)) = 5 THEN 1 ELSE 0 END) 
					)
				 
				 as Diff
				  from vouchercurrent where Periodmonth = '" . $m . "' and  
						PeriodType = 'Monthly' and Status = 'Check Released' and documenttype = '" . $t . "' group by trackingnumber order by dateencoded asc";
 	$record = $database->query($sql);
 	
 	$sheet  = '<table style = "margin:0 auto;font-size:12px;">';
	 $sheet .='<tr style = "">
	 				<th colspan = "100%" style = "background-color:white;"">
	 					<table style = "font-size:12px;">
							<tr>
								<td style = "background-color:white;border:0;">Document Type</td><td style = "background-color:white;border:0;font-weight:bold;">' . $t . '</td>
							</tr>
							<tr>
								<td style = "background-color:white;border:0;">Period</td><td style = "background-color:white;border:0;font-weight:bold;">'  . $m . '</td>
							</tr>
						</table>
	 				
	 				</th>	
	 			  </tr>';
	 	
 	$sheet .='<tr style = "text-align:left;">
 				<th></th>
 				<th>TN</th>
 				<th>Claimant</th>
 				
 				<th>Encoded</th>
 				<th>Updated</th>
 				<th>Process Time</th>
 			  </tr>';
 	$i = 1;
 	while($data = $database->fetch_array($record)){
		
		$tn = $data['TrackingNumber'];
		$claimant =  utf8_encode($data['Claimant']);
		$type = $data['DocumentType'];
		$encoded = substr($data['DateEncoded'],0,10);
		$updated = substr($data['DateModified'],0,10);
		$diff = $data['Diff'];
		$period = $data['PeriodMonth'];
		$sheet .='<tr>
					<td >' . $i++ . '</td>
	 				<td>' . $tn . '</td>
	 				<td>' . $claimant . '</td>
	 				
	 				<td>' . $encoded . '</td>
	 				<td>' . $updated . '</td>
	 				
	 				<td style = "text-align:center;">' . $diff . '</td>
	 			  </tr>';
	}
	$sheet .='<tr style = "text-align:left;">
 				<td colspan ="100%" style = "background-color:white;padding:10px 5px;font-size:10px;text-align:right;border:0;border-top:1px solid grey;">Note : The calculation of process time values considers only weekdays, excluding Saturdays and Sundays.</td>
 			  </tr>';
	$sheet .='</table>';
 	echo $sheet;
?>