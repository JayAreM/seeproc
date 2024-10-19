<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	$fund = $database->charEncoder($_GET['fund']);
	
	
	if($fund == "General Fund"){
		$cond =  'fund  = "Development Fund" and a.Category = "CAT 44" or  
				  fund  = "Development Fund" and  a.Category = "CAT 13"  or 
				  fund  = "General Fund" and a.Category = "CAT 44" or 
				  fund  = "General Fund" and a.Category = "CAT 13" ';
		
	}else{
		$cond = 'fund = "' . $fund . '" and  a.Category = "CAT 44" or
				 fund = "' . $fund . '" and  a.Category = "CAT 13"
		';
	}	
	
	
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
						on a.Category = b.Code where " . $cond . "  group by a.Item,a.Cost order by a.Category,a.Item";
	
	
	
	
	
	$record = $database->query($sql);
	$sheet = $database->num_rows($record);
	
	$sheet = "<table id ='mainTable' style = 'border-spacing:0px;margin:0 auto;font-family:Oswald;width:1000px;font-size:12px;' >";
	$sheet .= '<tr><td colspan ="24" style ="text-align:center;">
					<div style  = "letter-spacing:1px;font-size:22px;font-weigth:bold;font-weight:bold;">Republic of the Philippines</div>
					<div style = "font-weight:bold;">City Government of Davao</div>
					<div style  = "letter-spacing:2px;font-size:13px;padding-bottom:10px;font-weight:bold;">ANNUAL PROCUREMENT PLAN FOR CY 2023<br/>
					<span>Computer and Office Supplies</span><br/>
					<span>' . $fund .  '</span>
					</div>
				</td></tr>';	
	$sheet .= '<tr style = "font-weight:bold;">';
	$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;" ></td>';
	$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;" >Category</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;width:400px;">Item</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Description</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Unit</td>';
	$sheet .= '<td  style = "text-align:center;border-top:1px solid black;border-left:1px solid black;">Cost</td>';

	
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Jan</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Feb</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Mar</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">1st&nbsp;Quarter</td>';
	
	
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Apr</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">May</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Jun</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">2nd&nbsp;Quarter</td>';
	
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Jul</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Aug</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Sep</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">3rd&nbsp;Quarter</td>';
	
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Oct</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Nov</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">Dec</td>';
	$sheet .= '<td  style = "border-top:1px solid black;border-left:1px solid black;">4th&nbsp;Quarter</td>';
	
	$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;"></td>';
	$sheet .= '<td  style = "text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;">Total</td>';
	$sheet .= '</tr>';	
	
	
	$grand = 0;
	
	$tFirst = 0;
	$tSecond = 0;
	$tThird = 0;
	$tFourth = 0;
	$i = 0;
	while($data = $database->fetch_array($record)){
		$i++;
		$category = $data['Category'];
		$desc = $data['Description'];
		$item = $data['Item'];
		if(strlen($item) > 70){
			$item = substr($item,0,70) . '...';
		}else{
			$item = $data['Item'];
		}
		$cost = $data['Cost'];
		$total = $data['Total'];
		$unit = $data['Unit'];
		$jan = $data['Jan'];
		$feb = $data['Feb'];
		$mar = $data['Mar'];
		$apr = $data['Apr'];
		$may = $data['May'];
		$jun = $data['Jun'];
		$jul = $data['Jul'];
		$aug = $data['Aug'];
		$sep = $data['Sep'];
		$oct = $data['Oct'];
		$nov = $data['Nov'];
		$dec = $data['Dex'];
		
		$first = ($jan + $feb + $mar) * $cost;
		$tFirst = $tFirst + $first;
		$second = ($apr + $may + $jun) * $cost;
		$tSecond = $tSecond + $second;
		$third = ($jul + $aug + $sep) * $cost;
		$tThird = $tThird + $third;
		$fourth = ($oct + $nov+ $dec) * $cost;
		$tFourth = $tFourth + $fourth;
		
		$grand = ($grand + $total);
		
		$sheet .= '<tr>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $i . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">' . $category . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">' . $item . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;">' . $desc . '</td>';
		
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:right;">' . $unit . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:right;font-weight:bold;">' . number_format($cost,2) . '</td>';
		
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($jan) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($feb) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($mar) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:right;font-weight:bold;">' . $database->zeroToNothing(number_format($first,2)) . '</td>';
			
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($apr) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($may) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($jun) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:right;font-weight:bold;">' . $database->zeroToNothing(number_format($second,2)) . '</td>';
		
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($jul) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($aug) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($sep) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:right;font-weight:bold;">' . $database->zeroToNothing(number_format($third,2)) . '</td>';
		
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($oct) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($nov) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:center;">' . $database->zeroToNothing($dec) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;text-align:right;font-weight:bold;">' . $database->zeroToNothing(number_format($fourth,2)) . '</td>';
		$sheet .= '<td style = "border-top:1px solid black;border-left:1px solid black;padding:0;"></td>';	
		
		$sheet .= '<td style = "text-align:right;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;">' . number_format($total,2) . '</td>';		
		$sheet .= '</tr>';	
	}
	$sheet .= '<tr>';
	$sheet .= '<td colspan = "9" style = "border-top:1px solid black;font-size:10px;letter-spacing:1px;"> Printed : ' . date('Y-m-d') . '</td>';
	$sheet .= '<td style = "border-top:1px solid black;font-weight:bold;text-align:right;">' .  number_format($tFirst,2) . '</td>';
	$sheet .= '<td colspan = "3" style = "border-top:1px solid black;"></td>';
	$sheet .= '<td style = "border-top:1px solid black;font-weight:bold;text-align:right;">' .  number_format($tSecond,2) . '</td>';
	$sheet .= '<td colspan = "3" style = "border-top:1px solid black;"></td>';
	$sheet .= '<td style = "border-top:1px solid black;font-weight:bold;text-align:right;">' .  number_format($tThird,2) . '</td>';
	$sheet .= '<td colspan = "3" style = "border-top:1px solid black;"></td>';	
	$sheet .= '<td style = "border-top:1px solid black;font-weight:bold;text-align:right;">' .  number_format($tFourth,2) . '</td>';
	$sheet .= '<td style = "border-top:1px solid black;"></td>';
	$sheet .= '<td style = "border-top:1px solid black;font-weight:bold;">' .  number_format($grand,2) . '</td>';
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
<title>Supplies List</title>
<style type="text/css">
	
</style>
<div  class = "divContent">
		
</div>
<script>
</script>