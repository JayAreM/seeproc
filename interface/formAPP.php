<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	
	$fund = $database->charEncoder($_GET['fund']);
	
	if($fund == "General Fund"){
		$sql = "select * from (
				select z.Code as Category,z.Description,ifnull(a.CO,0) as CO,ifnull(b.MOOE,0) as MOOE, ifnull(a.CO,0) + ifnull(b.MOOE,0) as Total from ppmpcategories z left join 
				(SELECT Category, Sum(Total) as CO FROM ppmpmain where fund  = '" . $fund . "'   and substr(AccountCode,1,1) = '1' and  OfficeCode != ''
				or
				fund  = 'Development Fund'   and substr(AccountCode,1,1) = '1' and  OfficeCode != ''
				 group by category) a
				on z.Code = a.Category
				left join (SELECT Category, Sum(Total) as MOOE FROM ppmpmain where fund  = '" . $fund . "'    and substr(AccountCode,1,1) = '5' and  OfficeCode != '' 
				or
				fund  = 'Development Fund'    and substr(AccountCode,1,1) = '5' and  OfficeCode != '' 
				group by category) b
				on z.Code = b.Category) x  where Total > 0 order by Category asc
				";	
				
	}else{
		$sql = "select * from (
				select z.Code as Category,z.Description,ifnull(a.CO,0) as CO,ifnull(b.MOOE,0) as MOOE, ifnull(a.CO,0) + ifnull(b.MOOE,0) as Total from ppmpcategories z left join 
				
				(SELECT Category, Sum(Total) as CO FROM ppmpmain where fund  = '" . $fund . "'   and substr(AccountCode,1,1) = '1' and  OfficeCode != ''group by category) a
				on z.Code = a.Category
				left join (SELECT Category, Sum(Total) as MOOE FROM ppmpmain where fund  = '" . $fund . "'    and substr(AccountCode,1,1) = '5' and  OfficeCode != '' group by category) b
				on z.Code = b.Category) x  where Total > 0 order by Category asc
				";	
	}	
	
			
	$record = $database->query($sql);
	$sheet = $database->num_rows($record);
	
	$sheet = "<table id ='mainTable' style = 'border-spacing:0px;margin:0 auto;font-family:Oswald;font-size:12px;' >";
	$sheet .= '<tr><td colspan ="14" style ="text-align:center;">
					<div style  = "letter-spacing:1px;font-size:22px;font-weigth:bold;font-weight:bold;">Republic of the Philippines</div>
					<div style = "font-weight:bold;">City Government of Davao</div>
					<div style  = "letter-spacing:2px;font-size:13px;padding-bottom:10px;font-weight:bold;">ANNUAL PROCUREMENT PLAN FOR CY 2023<br/><span>' . $fund . '</span></div>
					
				</td></tr>';	
	$sheet .= '<tr style = "font-weight:bold;">';
	$sheet .= '<td rowspan ="2" style = "border-top:1px solid black;border-left:1px solid black;" >Category</td>';
	$sheet .= '<td rowspan ="2" style = "border-top:1px solid black;border-left:1px solid black;">Procurement Description</td>';
	$sheet .= '<td rowspan ="2" style = "border-top:1px solid black;border-left:1px solid black;">Office</td>';
	$sheet .= '<td rowspan ="2" style = "border-top:1px solid black;border-left:1px solid black;">Mode of Procurement</td>';
	$sheet .= '<td colspan ="4" style = "text-align:center;border-top:1px solid black;border-left:1px solid black;">Schedule for each procurement activity</td>';
	$sheet .= '<td rowspan ="2" style = "border-top:1px solid black;border-left:1px solid black;">Source of Funds</td>';
	$sheet .= '<td style ="text-align:center;border-top:1px solid black;border-left:1px solid black;" colspan ="3">Estimated Budget(Php)</td>';
	$sheet .= '<td rowspan ="2" style = "border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;">Remarks</td>';
	$sheet .= '</tr>';	
	
	$sheet .= '<tr>';
	$sheet .= '<td style ="border-left:1px solid black;border-top:1px solid black;">Ads/Open of Bids/REI</td>';
	$sheet .= '<td style ="border-left:1px solid black;border-top:1px solid black;">Sub/Open of Bids</td>';
	$sheet .= '<td style ="border-left:1px solid black;border-top:1px solid black;">Notice of Award</td>';
	$sheet .= '<td style ="border-left:1px solid black;border-top:1px solid black;">Contract Signing</td>';
	$sheet .= '<td style ="text-align:center;border-left:1px solid black;border-top:1px solid black;">Total</td>';
	$sheet .= '<td style ="border-left:1px solid black;border-top:1px solid black;width:50px;text-align:center;">MOOE</td>';
	$sheet .= '<td style ="border-left:1px solid black;border-top:1px solid black;width:50px;text-align:center;">CO</td>';
	$sheet .= '</tr>';	
	$grand = 0;
	while($data = $database->fetch_array($record)){
		$category = $data['Category'];
		$desc = $data['Description'];
		$total = $data['Total'];
		$co =   $data['CO'];
		$mooe = $data['MOOE'];
		
		
		$grand = ($grand + $total);
		$sheet .= '<tr>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">' . $category . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">' . $desc . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">&nbsp;</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">&nbsp;</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">&nbsp;</td>';
		
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">&nbsp;</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">&nbsp;</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">&nbsp;</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">&nbsp;</td>';
		$sheet .= '<td style = "text-align:right;border-top:1px solid black;border-left:1px solid black;">' . number_format($total,2) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:right;">' . number_format($mooe,2) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:right;">' . number_format($co,2) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black; border-right:1px solid black;">&nbsp;</td>';
		$sheet .= '</tr>';	
	}
	$sheet .= '<tr>';
	$sheet .= '<td colspan = "9" style = "border-top:1px solid black;font-size:10px;letter-spacing:1px;"> Printed : ' . date('Y-m-d') . '</td>';
	$sheet .= '<td style = "border-top:1px solid black;font-weight:bold;">' .  number_format($grand,2) . '</td>';	
	$sheet .= '<td colspan = "5" style = "border-top:1px solid black;"></td>';
	$sheet .= '</tr>';	
	$sheet .= "</table>";
	echo $sheet;
?>
<style>

	body{
		padding:0;
		margin:0;
	}
	#mainTable td{
		padding:2px 5px; 
	}
	
</style>

<link rel="icon" href="/citydoc2019/images/Print.png"/> 
<title>APP Form</title>
<style type="text/css">
	
</style>
<div  class = "divContent">
		
</div>
<script>
</script>