
<style>
	@font-face {
	        font-family: "Robot";
	        src: url("../fonts/AlexBrush-Regular.ttf");
	}
	@font-face{
		font-family: NOR;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Abel-Regular.ttf);
	}
	#table1 tr > td{
		border-bottom: 1px solid white;
	}
	
	
	#table1 tr > td:first-child {
		background-color:rgb(187, 191, 192);
	}
	#table1 tr > td:nth-child(2) {
		background-color:rgb(254, 253, 253);
	}
	#table1 tr:hover > td{
		background-color:rgb(64, 144, 242);
		color:white;
		cursor:pointer;
	}
	#table2 tr > td{
		border-bottom: 0px solid white;
	}
	#table2 tr:hover > td{
		
	}
</style>
<html>
	<head>
		<title>User Engagement</title>
		<link rel="icon" href="/citydoc2020/images/red.png"/> 
		
	</head>
</html>
<?php
		require_once("../includes/database.php");
		$today = date('Y-m-d');
	  	/*$sql = "SELECT a.TrackingNumber,Activity as Status,UpdatedBy as ModifiedBy, count(a.Id) as Count, concat(b.LastName,', ',b.FirstName) as Name,b.OfficeCode FROM supplier.logs a left join citydoc.employees b
				on a.UpdatedBy = b.employeenumber
				 where substring(dateupdated,1,10) = '" . $today . "'  group by Activity,Updatedby
				 union
				 SELECT trackingnumber,Status,ModifiedBy, Count(a.Id) as Count, concat(b.lastName,', ',b.firstname) as Name,b.OfficeCode FROM voucherhistory a left join citydoc.employees b
								on a.ModifiedBy = b.employeenumber
								where substring(datemodified,1,10) = '" . $today . "' and Status != 'Encoded' group by ModifiedBy order by count desc";	*/	
		$sql = "select Activity as Status,concat(b.lastName,', ',b.firstname)as Name,sum(Count) as Counter,b.OfficeCode  from
				(            
				SELECT Activity,UpdatedBy as ModifiedBy, count(Id) as Count FROM supplier.logs 
				where substring(dateupdated,1,10) =  '" . $today . "'  group by Activity,Updatedby
				union
				SELECT Status as Activity,ModifiedBy, Count(Id) as Count FROM voucherhistory 
				where substring(datemodified,1,10) =  '" . $today . "' and Status != 'Encoded' group by Status,ModifiedBy 
				union
				SELECT 'Check Encoded' as Activity,EncodedBy,count(Id) as Count FROM chequerist.encodedchecks where substring(DateEncoded,1,10) =  '" . $today . "' group by EncodedBy
					
				union
				SELECT Activity,EncodedBy,count(DateUpdated) as Counter FROM chequerist.actionlogs where substring(DateUpdated,1,10) = '" . $today . "' group by EncodedBy
				union
                SELECT 'Encoded' as Activity,EncodedBy, Count(Id) as Counter FROM citybills.transactions where substr(DateEntry,1,10) = '" . $today . "' group by EncodedBy 
				
				) 
				a left join citydoc.employees b on CAST(a.ModifiedBy AS UNSIGNED)  = b.employeenumber group by Status,Name order by Counter Desc";
		
		$record = $database->query($sql);
		
		
		$sheet = '<table id = "table1" style = "border-spacing:0px;font-family:NOR;margin:0 auto;width:600px;border:1px solid silver;">';
		$sheet .= '<tr style = "background-color:rgb(24, 92, 141);">
						<th id ="engagementHeader" colspan = "100%" style ="text-align:center;font-family:oswald;font-size:14px;padding:10px;padding-left:30px;">
							<table id ="table2" style ="border-spacing:0px;width:100%;color:white;font-family:NOR;text-align:left;" border ="0">
								<tr><th style = "line-height:20px;font-size:23px;font-weight:bold;border-bottom:1px solid rgb(14, 80, 127);">Daily Doctrack Administrator Engagement</th></tr>
								<tr><th style = "line-height:12px;color:silver;font-weight:normal;"> <b>City Doctrack 2023</b> Administrators, Receiver, Releaser, Taggers, Etc.</th></tr>
							</table>
						</th>
						
					</tr>';
		$i =1;
		$total = 0;
		$color = "";
		$sheet .= '<tr style ="background-color:">
					<th></th>	
					<th colspan = "2" style = "text-align:left;">Doctrack user</th>	
		 			<th style ="text-align:left;">Activity</th>
		 			<th style ="width:8px;padding-right:5px;">Trans</h>
				   </tr>';
	  $sheet  .= '<tr><td colspan = "100%" style = ""></td></tr>';
		while($data = $database->fetch_array($record)){
			$status = $data['Status'];
			$name = $data['Name'];
			$count = $data['Counter'];
			$total += $count;
			$office = $data['OfficeCode'];
			if($office == "1081"){
				$color = 'rgb(2, 157, 247)';
				$color1 = 'rgba(2, 157, 247,.2)';
				$officeName  = 'CAO';
			}else if($office == "1091"){
				$color = 'rgb(250, 187, 99)';
				$color1 = 'rgba(187, 67, 177,.2)';
				$officeName  = 'CTO';
			}else if($office == "1071"){
				$color = 'rgb(250, 99, 240)';
				$color1 = 'rgba(244, 196, 4,.2)';
				$officeName  = 'CBO';
			}else if($office == "1061"){
				$color = 'rgb(41, 106, 137)';
				$color1 = 'rgba(173, 179, 186,.8)';
				$officeName  = 'GSO';
			}else if($office == "1031"){
				$color = 'rgb(68, 178, 25)';
				$color1 = 'rgba(68, 178, 25,.2)';
				$officeName  = 'ADM';
			}
			//$color1 = '';
			$color = '';
			$sheet .= '<tr style ="background-color:' . $color1 . '">
						<td style ="padding:0px 5px;text-align:center;font-size:12px;border-right:1px solid white;">' . $i++ . '</td>	
						<td style = "border-right:1px solid white;border-bottom:1px solid rgb(217, 228, 232);border-right:1px solid rgb(217, 228, 232);"> <div style = "border:0px solid black;text-align:center;font-size:13px;font-family:NOR;padding:2px; background-color:' . $color . ' ">' . $officeName . '</div></td>
			 			<td style ="padding-left:5px;">' . utf8_encode($name) . '</td>
			 			<td style ="">' . $status. '</td>
			 			<td style ="width:8px;padding-right:5px;text-align:right;">' . $count . '</td>
					   </tr>';
					   
		}
		$sheet .= '<tr style = "">
						<td colspan = "100%" style =" text-align:right;font-family:NOR;font-size:15px;background-color:rgb(24, 92, 141);color:white;padding-right:5px;font-weight:bold;">
						<span style = "font-weight:normal;padding-right:5px;">Total Transaction</span>' . $total . '</td>
					</tr>';
		$sheet .= '</table>';
		echo $sheet;
?>