<?php 
	
	require_once("../includes/database.php");
	
	if(isset($_GET['consolidated'])){
		$count = 0;
		$data ='';
		$header ='';

		//$result = $database->ConsolidatedRecord();
		/*$sql = 'SELECT TrackingNumber,ADV1,Claimant,PR_ProgramCode as RespoCenterCode,c.Name as RespoCenterName,OBR_number,b.Fund as FundClass, PR_AccountCode as AccountCode,b.Title as AccountTitle,Amount as OBRAmount,CheckNumber,Checkdate,
				JevNo, JevAmount,DateModified as DateReleased
				 FROM vouchercurrent  a left join fundtitles b on a.PR_AccountCode = b.Code  left join programcode c on a.PR_programcode = c.code where a.status = "CAO Released" and OBR_Number is not null and substr(DateModified,1,4) = "2017"  order by substr(a.DateModified,1,7) asc ';
		*/
		$sql = "SELECT DateModified as DateReleased,TrackingType, TrackingNumber,ADV1,Claimant,PR_ProgramCode as RespoCenterCode,c.Name as RespoCenterName,OBR_number,b.Fund as FundClass, PR_AccountCode as AccountCode,
				b.Title as AccountTitle,Amount as OBRAmount,PO_Amount,CheckNumber,Checkdate, JevNo, JevAmount 
				FROM vouchercurrent a left join fundtitles b on a.PR_AccountCode = b.Code left join programcode c on a.PR_programcode = c.code
				 where 
				 a.status = 'CAO Released' and OBR_Number is not null and substr(DateModified,1,4) = '2018' or 
				 a.status = 'Check Advised' and OBR_Number is not null and substr(DateModified,1,4) = '2018' or 
				 a.status = 'Forwarded to CTO' and OBR_Number is not null and substr(DateModified,1,4) = '2018' or 
				 a.status = 'CBO Released' and OBR_Number is not null and substr(DateModified,1,4) = '2018' 
				 order by substr(a.DateModified,1,10) asc";
				 
		$result = $database->query($sql);		
		$count = mysqli_num_fields($result);
		$fields =  $result->fetch_fields();
		 while ($fieldinfo=mysqli_fetch_field($result)){
			  $header .= $fieldinfo->name . "\t";
		  }
		$line = '';
		while($row = $database->fetch_array($result))  {
			for($i = 0 ;$i < $count; $i++){
				$line .= $row[$i] . "\t ";
			}
			$line .= "\n";
		}
		$data = str_replace("\r", "", $line);
		if ($data == "") {
		  $data = "\nno matching records found\n";
		}
		header('Content-Encoding: UTF-8');
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=DocTrackConsolidated.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $header."\n".$data;
	}
	if(isset($_GET['periodic'])){
		$count = 0;
		$data ='';
		$header ='';
		$from = $database->charEncoder($_GET['from']);
		$to = $database->charEncoder($_GET['to']);
		
		/*$sql = "SELECT DateModified as DateReleased,TrackingType, TrackingNumber,ADV1,Claimant,PR_ProgramCode as RespoCenterCode,c.Name as RespoCenterName,OBR_number,b.Fund as FundClass, PR_AccountCode as AccountCode,
				b.Title as AccountTitle,Amount as OBRAmount,PO_Amount,CheckNumber,Checkdate, JevNo, JevAmount 
				FROM vouchercurrent a left join fundtitles b on a.PR_AccountCode = b.Code left join programcode c on a.PR_programcode = c.code
				 where a.status = 'CAO Released' and OBR_Number is not null and substr(DateModified,6,5) >= '" . $from  . "' and substr(DateModified,6,5) <= '" . $to . "' or 
				 a.status = 'CBO Released' and OBR_Number is not null and substr(DateModified,6,5) >= '" . $from  . "' and substr(DateModified,6,5) <= '" . $to . "' order by substr(a.DateModified,1,7) asc";*/
		
		$sql = "SELECT DateModified as DateReleased,TrackingType, TrackingNumber,ADV1,Claimant,PR_ProgramCode as RespoCenterCode,c.Name as RespoCenterName,OBR_number,b.Fund as FundClass, PR_AccountCode as AccountCode,
				b.Title as AccountTitle,Amount as OBRAmount,PO_Amount,CheckNumber,Checkdate, JevNo, JevAmount 
				FROM vouchercurrent a left join fundtitles b on a.PR_AccountCode = b.Code left join programcode c on a.PR_programcode = c.code
				 where 
				 a.status = 'CAO Released' and OBR_Number is not null and substr(DateModified,1,10) >= '" . $from  . "' and substr(DateModified,1,10) <= '" . $to . "' or 
				 a.status = 'Check Advised' and OBR_Number is not null and substr(DateModified,1,10) >= '" . $from  . "' and substr(DateModified,1,10) <= '" . $to . "' or 
				 a.status = 'Forwarded to CTO' and OBR_Number is not null and substr(DateModified,1,10) >= '" . $from  . "' and substr(DateModified,1,10) <= '" . $to . "' or 
				 a.status = 'CBO Released' and OBR_Number is not null and substr(DateModified,1,10) >= '" . $from  . "' and substr(DateModified,1,10) <= '" . $to . "' 
				 order by substr(a.DateModified,1,10) asc";
				 		 
		/*$result = $database->query($sql);		
		$count = mysqli_num_fields($result);
		$fields =  $result->fetch_fields();
		while ($fieldinfo=mysqli_fetch_field($result)){
		  $header .= $fieldinfo->name . "\t";
		}
		/*$line = '';
		while($row = $database->fetch_array($result))  {
			for($i = 0 ;$i < $count; $i++){
				$line .= $row[$i] . "\t ";
			}
			$line .= "\n";
		}
		$data = str_replace("\r", "", $line);
		if ($data == "") {
		  $data = "\nno matching records found\n";
		}*/
		$result = $database->query($sql);		
		$count = mysqli_num_fields($result);
		$sheet = '<table border ="1" style = "text-align:center;">';
		$sheet .= '<tr>';
		while ($fieldinfo=mysqli_fetch_field($result)){
			  $sheet .= '<td style = "text-align:center;">' . $fieldinfo->name . '</td>';
		}
		$sheet .= '</tr>';
		while($data = $database->fetch_array($result))  {
			
			$sheet .= '<tr>';	
			for($i = 0 ;$i < $count; $i++){
				$val = $data[$i];
				$sheet .= '<td>' . $val . '</td>';
			}
			
			$sheet .= '</tr>'; 
		}
		$sheet .= '</table>';
		
		header('Content-Encoding: UTF-8');
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=DocTrackPeriodic.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		//echo $header."\n".$data;
		echo $sheet;
	}
	if(isset($_GET['checksExcel'])){
		$count = 0;
		$data ='';
		$header ='';
		
		$programCode = $_GET['program'];
		$accountCode = $_GET['accountCode'];
		$periodType = $_GET['period'];
		$month = $_GET['periodMonth'];
		$day = $_GET['periodDay'];
		$year = $_GET['periodYear'];
		
		if($accountCode == 0){
			$searchCondition1 = '';
		}else{
			$searchCondition1 = " and pr_accountcode = '" . $accountCode . "' "; 
		}
		
		if($periodType == 2){
			$checkDate = $year . '-' . $month . '-' . $day;
			$searchCondition2 = " and substr(CheckDate,1,10) = '" . $checkDate . "'" ;	
		}else if($periodType == 3){
			$checkDate = $year . '-' . $month ;
			$searchCondition2 = " and substr(CheckDate,1,7) = '" . $checkDate . "'" ;
		}else{
			$searchCondition2 = '';
		}
		
		/*$sql = "SELECT Id,TrackingType,TrackingNumber,DocumentType,Claimant,Adv1,OBR_Number,Amount as Gross,TotalAmountMultiple as GrossMultiple, PO_Amount,NetAmount,CheckNumber,CheckDate,Status, DateModified 
				FROM citydoc2018.vouchercurrent where pr_programcode = '" . $programCode  . "'" . $searchCondition1  . " " . $searchCondition1 . " 
				and obr_number > 0 " . $searchCondition2 . "
				group by trackingnumber
				order by DateModified Desc;";*/
				
				
		$sql = "SELECT a.Id,a.Adv1 as Adv,a.OBR_Number,a.TrackingType,a.TrackingNumber,a.Claimant, replace(trim(replace(b.Particulars,'\t',' ')),'\n','') as Part,a.Amount, a.PO_Amount,a.NetAmount,a.CheckNumber,a.CheckDate,a.DateModified
					
			
					FROM vouchercurrent a left join particulars b on a.trackingnumber = b.trackingnumber
					
					where a.pr_programcode = '" . $programCode  . "'" . $searchCondition1  . "
					and a.obr_number > 0 " . $searchCondition2 . "
					group by a.trackingnumber
					order by a.DateModified Desc;";		
				
				
				
		$result = $database->query($sql);		
		$count = mysqli_num_fields($result);
		$fields =  $result->fetch_fields();
		$sheet = '<table border = "1">';
		$sheet .= '<tr>';
		while ($fieldinfo=mysqli_fetch_field($result)){
			 // $header .= $fieldinfo->name . "\t";
			
			$sheet .= '<td >' . $fieldinfo->name . '</td>';
			 
			
		}
		$sheet .= '</tr>';
		$line = '';
		while($row = $database->fetch_array($result))  {
			$sheet .= '<tr>';
			for($i = 0 ;$i < $count; $i++){
				//$line .= $row[$i] . "\t ";
			
				$sheet .= '<td style = "vertical-align:top;">' . $row[$i] . '</td>';			
			}
			//$line .= "\n";
			$sheet .= '</tr>';
		}
		$sheet .= '</table>';
		$data = str_replace("\r", "", $line);
		if ($data == "") {
		  $data = "\nno matching records found\n";
		}
		header('Content-Encoding: UTF-8');
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=CHeckList.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		//echo $header."\n".$data;
		echo $header."\n".$sheet;
		//echo $header;
	}
	
	if(isset($_GET['genBreakdown'])){
		$header ='';
		$sql = "select b.Name,AccountCode,Fund,Category,c.Description,Item,Unit,Cost,Total,Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dex  
				from
				(SELECT * FROM ppmpmain where OfficeCode != '' ) a 
				left join office b on a.OfficeCode = b.Code
				left join ppmpcategories c on Category = c.Code ORDER BY b.Name,Category asc";
		$result = $database->query($sql);		
		$count = mysqli_num_fields($result);
		$fields =  $result->fetch_fields();
		$sheet = '<table border = "1">';
		$sheet .= '<tr>';
		while ($fieldinfo=mysqli_fetch_field($result)){
			$sheet .= '<td >' . $fieldinfo->name . '</td>';	
		}
		$sheet .= '</tr>';
		$line = '';
		while($row = $database->fetch_array($result))  {
			$sheet .= '<tr>';
			for($i = 0 ;$i < $count; $i++){
				$sheet .= '<td style = "vertical-align:top;">' . $row[$i] . '</td>';			
			}
			$sheet .= '</tr>';
		}
		$sheet .= '</table>';
		
		header('Content-Encoding: UTF-8');
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=PPMP-Breakdown.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $header."\n".$sheet;
		
	}

	if(isset($_GET['pmSaveToExcel'])){
		$header ='';
		$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
		$sql = "SELECT * FROM vouchercurrent WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$officer = $data['Claimant'];
		$fund = $data['Fund'];
		$year = $data['Year'];
		$dt = time();
		$datetime = date('Y-m-d h:i A', $dt);

		$sql = "SELECT Window, NumOfEmps FROM particulars WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$headerWindow = $data['Window'];


		$sql = "SELECT 
				a.*, b.NumOfEmps, b.Window, b.OfficeAssigned
				FROM 
				vouchercurrent a 
				LEFT JOIN particulars b ON a.TrackingNumber = b.TrackingNumber
				where a.TrackingPartner = '".$trackingNumber."' GROUP BY a.TrackingNumber ORDER BY a.Claimant ASC";
		$record = $database->query($sql);
		
		$sheet = "<table border='1'>
					<thead>
						<tr>
							<th rowspan='2'></th>
							<th rowspan='2'>Name</th>
							<th rowspan='2'>No. of Persons</th>
							<th rowspan='2'>TN</th>
							<th rowspan='2'>Office</th>
							<th rowspan='2'>OBR No.</th>
							<th rowspan='2'>ADV</th>
							<th rowspan='2'>Fund</th>
							<th rowspan='2'>Type of Claims</th>
							<th colspan='2'>Allotment</th>
							<th colspan='2'>Amount</th>
						</tr>
						<tr>
							<th>Class</th>
							<th>Code</th>
							<th>PS</th>
							<th>MOOE</th>
						</tr>
					</thead>
					<tbody>";

		$row = 0;
		$rowDis = 0;
		$curTotalEmps = 0;
		$curTotal = 0;
		$grandTotalEmps = 0;
		$grandTotal = 0;
		$page = 0;
		while($data = $database->fetch_array($record)){
			$name = $data['Claimant'];
			$window = $data['Window'];
			$officeAssigned = $data['OfficeAssigned'];
			$numOfPers = intval($data['NumOfEmps']);
			$obr = $data['OBR_Number'];
			$officeCode = $data['Office'];
			$progCode = $data['PR_ProgramCode'];
			$windowTN = $data['TrackingNumber'];
		
			$periodMonth = $data['PeriodMonth'];
			$periodType = $data['PeriodType'];
			
			if($periodType  == 1 ){
				$p = '&nbsp;1&nbsp;-&nbsp;15,&nbsp;';
			}else if($periodType  == 2){
				$p = '&nbsp;16&nbsp;-&nbsp;31,&nbsp;';
			}else{
				$p = '';
			}
		
			$period = "(".$periodMonth.$p.")";
		
		
			$fundType = "";
			$acctCode = $data['PR_AccountCode'];
			if(substr($acctCode, 0, 3) == "501"){
				$fundType = "PS";
			}else if(substr($acctCode, 0, 3) == "502"){
				$fundType = "MOOE";
			}
		
			$adv = $data['ADV1'];
			$progCode = $data['PR_ProgramCode'];
			$docType = $data['DocumentType'];
		
			$amountPS = 0;
			$amountMOOE = floatval($data['NetAmount']);
			
			if($fundType == "PS"){
				$amountPS = $amountMOOE;
				$amountMOOE = 0;
			}
		
			$sheet .= " <tr>
							<td>".++$row."</td>
							<td>".$name."</td>
							<td>".$numOfPers."</td>
							<td>".$windowTN."</td>
							<td>".$officeAssigned."</td>
							<td>".$obr."</td>
							<td>".$adv."</td>
							<td>".$progCode."</td>
							<td>".$docType."&nbsp;".$period."</td>
							<td>".$fundType."</td>
							<td>".$acctCode."</td>
							<td>".$database->toNumberFormat($amountPS)."</td>
							<td>".$database->toNumberFormat($amountMOOE)."</td>
						</tr>";
		}

		$sheet .= " </tbody>
				</table>";

		header('Content-Encoding: UTF-8');
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=Paymaster Summary of ".$trackingNumber.".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		echo $header."\n".$sheet;
	}
	
?>
