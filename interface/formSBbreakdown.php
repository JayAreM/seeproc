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
			$cond =  'fund  = "Development Fund" and type = "' . $type . '"   or  fund  = "General Fund" and type = "' . $type . '"';
		}else{
			$cond = 'fund = "' . $fund . '" and type = "' . $type . '"';
		}	
	/*
		$sql = "SELECT a.Category, b.Description, a.Item, a.Description, a.Unit, a.Cost, sum(a.Total) as Total,
				sum(Jan) as Jan,
				sum(Feb) as Feb,
				sum(Mar) as Mar,
				sum(Apr) as Apr,
				sum(May) as May,
				sum(Jun) as Jun,
				sum(Jul) as Jul,
				sum(Aug) as Aug,
				sum(Sep) as Sep,
				sum(Oct) as Oct,
				sum(Nov) as Nov,
				sum(Dex) as Dex
				FROM ppmpmain a left join ppmpcategories b 
							on a.Category = b.Code where " . $cond . "  group by a.Item,a.Cost order by a.Category,a.Item";*/
				$sql = "SELECT c.Name,a.Category, b.Description as CatDesc, a.Item, a.Description, a.Unit, a.Cost, sum(a.Total) as Total,
				sum(Jan) as Jan,
				sum(Feb) as Feb,
				sum(Mar) as Mar,
				sum(Apr) as Apr,
				sum(May) as May,
				sum(Jun) as Jun,
				sum(Jul) as Jul,
				sum(Aug) as Aug,
				sum(Sep) as Sep,
				sum(Oct) as Oct,
				sum(Nov) as Nov,
				sum(Dex) as Dex
				FROM ppmpmain a 
				left join ppmpcategories b on a.Category = b.Code 
				left join office c on a.OfficeCode = c.Code 
				
				where a.Officecode != '' and  " . $cond . " 
			
				group by c.Name,a.Item,a.Cost order by a.Category,a.Item";
							
							
					
		$record = $database->query($sql);
		$count = $database->num_rows($record);
		
		if($count > 0){
			$sb = str_replace('SB','',$type);	
			echo $sheet1->showTableSBbreakdown($j++,$sb,$record,$fund,$year);
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

<link rel="icon" href="/citydoc2023/images/Print.png"/> 
<title>SB Breakdown <?php echo $year; ?></title>
<style type="text/css">
	
</style>
<div  class = "divContent">
		
</div>
<script>
</script>