<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	
	
	$year = 2023;
	$funds = ['General Fund*SB1','General Fund*SB2','General Fund*SB3','General Fund*SB4','SEF*SB1','SEF*SB2','SEF*SB3','SEF*SB4'];
	$j = 0;
	for($i = 0 ; $i < sizeof($funds) ; $i++){
		$fundset = $funds[$i];
		$arrF = explode('*',$fundset);
		$fund = $arrF[0];
		$type = $arrF[1];
	
	
		if($fund == "General Fund"){
			$sql = "select * from (
					select z.Code as Category,z.Description,ifnull(a.CO,0) as CO,ifnull(b.MOOE,0) as MOOE, ifnull(a.CO,0) + ifnull(b.MOOE,0) as Total from ppmpcategories z left join 
					(SELECT Category, Sum(Total) as CO FROM ppmpmain where Type = '" . $type . "' and fund  = '" . $fund . "'   and substr(AccountCode,1,1) = '1' and  OfficeCode != ''
					or
					Type = '" . $type . "' and fund  = 'Development Fund'   and substr(AccountCode,1,1) = '1' and  OfficeCode != ''
					 group by category) a
					on z.Code = a.Category
					left join (SELECT Category, Sum(Total) as MOOE FROM ppmpmain where Type = '" . $type . "' and fund  = '" . $fund . "'    and substr(AccountCode,1,1) = '5' and  OfficeCode != '' 
					or
					Type = '" . $type . "' and fund  = 'Development Fund'    and substr(AccountCode,1,1) = '5' and  OfficeCode != '' 
					group by category) b
					on z.Code = b.Category) x  where Total > 0 order by Category asc
					";	
					
		}else{
			$sql = "select * from (
					select z.Code as Category,z.Description,ifnull(a.CO,0) as CO,ifnull(b.MOOE,0) as MOOE, ifnull(a.CO,0) + ifnull(b.MOOE,0) as Total from ppmpcategories z left join 
					
					(SELECT Category, Sum(Total) as CO FROM ppmpmain where Type = '" . $type . "' and fund  = '" . $fund . "'   and substr(AccountCode,1,1) = '1' and  OfficeCode != ''group by category) a
					on z.Code = a.Category
					left join (SELECT Category, Sum(Total) as MOOE FROM ppmpmain where Type = '" . $type . "' and fund  = '" . $fund . "'    and substr(AccountCode,1,1) = '5' and  OfficeCode != '' group by category) b
					on z.Code = b.Category) x  where Total > 0 order by Category asc
					";	
		}	
		
	
				
		$record = $database->query($sql);
		$count = $database->num_rows($record);
		if($count > 0){
			$sb = str_replace('SB','',$type);
			echo $sheet1->showTableSB($j++,$sb,$record,$fund,$year);
		}
		
	}
	
	
	
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
<title>SB Summary <?php echo $year; ?></title>
<style type="text/css">
	
</style>
<div  class = "divContent">
		
</div>
<script>
</script>