<?php	
	
	require_once('../javascript/ajaxFunction.php');
	require_once('../includes/database.php');
	
	$date1 = new DateTime('2023-05-18 09:28 AM'); // First date
   $date2 = new DateTime('2023-08-24 10:36 AM'); // Second date

$interval = $date1->diff($date2); // Calculate the difference between the two dates

$totalDays = $interval->format('%a'); // Get the total number of days

echo "Total days between the two dates: $totalDays";
	
	
	
	$dt = time();
	$today = date('Y-m-d', $dt);
	
	
	$order ='Asc';
	$sort = 'a.Id';
	$listSort = array('a.Id','DateModified','Name','b.Name','ProjectCost','c.DateEncoded','x.TrackingNumber');
	$listViewProjects = array('ALL','Active','Idle');
	$selectSortBy = '';
	$selectOrder = '';
	$ctrFrmOption = '';
	
	
	
	for($i = 1 ; $i <= 60; $i++){
		$ctrFrmOption .= '<option>' . $i . '</option>';
	}
	$projectView = 0;
	if(isset($_POST['projectView'])){
		$projectView = $_POST['projectView'];
		$optionViewProjects = '<option value ="' . $projectView. '">' . $listViewProjects[$projectView]. '</option>';
		$optionViewProjects .= '<option value ="0">ALL</option><option value ="1">Active</option><option value ="2">Idle</option>';
	}else{
		
		$optionViewProjects = '<option value ="' . $projectView. '">' . $listViewProjects[$projectView]. '</option>';
		$optionViewProjects = '<option value ="0">ALL</option><option value ="1">Active</option><option value ="2">Idle</option>';
	}
	if(isset($_POST['ctrType'])){
		$ctrType = $_POST['ctrType'];
		$ctrTypeOption = '<option >' . $ctrType. '</option><option>PR</option><option>PO</option><option>PX</option>';
	}else{
		$ctrTypeOption = '<option>PR</option><option>PO</option><option>PX</option>';
	}
	if(isset($_POST['ctrFrm'])){
		$frm = $_POST['ctrFrm'];
		$ctrFrmOption = '<option>' . $frm . '</option>' . $ctrFrmOption;
		if($ctrType == "PR"){
			$filter2 = " and  DATEDIFF('" . $today . "', substr(c.DateModified,1,10)) >= " .  $frm ;
			if($frm == 1){
				$filter2 = '';
			}
			$filter4 = '';
			$filter3 = '';
		}else if($ctrType == "PO"){
			$filter2 = '';
			$filter4 = '';
			$filter3 = " and y.Status != 'Waiting for Delivery' and  DATEDIFF('" . $today . "', substr(y.DateModified,1,10)) >= " .  $frm ;
		}else if($ctrType == "PX"){
			$filter2 = '';
			$filter3 = '';
			$filter4 = " and z.Status != 'Check Released' and  DATEDIFF('" . $today . "', substr(z.DateModified,1,10)) >= " .  $frm ;
		}
	}else{
		$ctrFrmOption = '';
		for($i = 1 ; $i <= 60; $i++){
			$ctrFrmOption .= '<option>' . $i . '</option>';
		}
		$filter2 = '';
		$filter3 = '';
		$filter4 = '';
	}
	$filter1 = '';
	if(isset($_POST['selectedOffice'])){
		$selectedOffice = $_POST['selectedOffice'];
		if($selectedOffice == "ALL"){
			$filter1 = " and  b.Name != 1";
		}else{
			$filter1 = " and b.Name = '" . addslashes($selectedOffice) . "'";
		}
		$optionOffice = '<option >' .  $_POST['selectedOffice'] . '</option>';
		$optionOffice .= '<option >ALL</option>';
	}else{
		$optionOffice = '<option>ALL</option>';
		$filter1 = " and b.Name != 1";
	}
	$sql = "Select count(a.Id) as Count,b.Name from disasterprojects a left join office b on a.Office = b.Code group by a.Office order by Name asc";
	$record = $database->query($sql);
	
	while($data = $database->fetch_array($record)){
		$name =  $data['Name']; 
		$counter = $data['Count'];
		$optionOffice .= '<option value = "' . $name . '">' .  ucwords(strtolower($name)) . " (" . $counter . ")" . '</option>';
	}
	
	if(isset($_POST['order'])){
		$order = $_POST['order'];
		$sort = $_POST['sort'];
		for($i = 0 ; $i < sizeof($listSort); $i++){
			$value = $listSort[$i] ;
			$text = $listSort[$i]; 
			if($sort != $listSort[$i]){
				if($value =="Name"){
					$text = "Project Name";
				}else if($value == "b.Name"){
					$text = "Office";
				}else if($value == "DateModified"){
					$text = "Date Updated";
				}else if($value == "ProjectCost"){
					$text = "Project Cost";
				}else if($value == "c.DateEncoded"){
					$text = "Date Created";
				}else if($value == "a.Id"){
					$text = "Project Id";
				}else if($value == "x.TrackingNumber"){
					$text = "PR Tracking Number";
				}
				$selectSortBy .= '<option value = "' . $value . '">' . $text .  '</option>';
			}
		}
		if($sort =="Name"){
			$text = "Project Name";
		}else if($sort == "b.Name"){
			$text = "Office";
		}else if($sort == "DateModified"){
			$text = "Date Updated";
		}else if($sort == "ProjectCost"){
			$text = "Project Cost";
		}else if($sort == "a.Id"){
			$text = "Project Id";
		}else if($sort == "c.DateEncoded"){
			$text = "Date Created";
		}else if($value == "x.TrackingNumber"){
			$text = "PR Tracking Number";
		}
		$selectSortBy = "<option value = '" . $sort . "'>" . $text .  "</option>" . $selectSortBy ;
		if($order == "Asc"){
			$selectOrder = "<option value = 'Asc'>Ascending</option><option value ='Desc'>Descending</option>";
		}else{
			$selectOrder = "<option value ='Desc'>Descending</option><option value ='Asc'>Ascending</option>";
		}
	}else{
		$selectOrder = "<option value = 'Asc'>Ascending</option><option value ='Desc'>Descending</option>";
		$selectSortBy = "<option value ='a.Id'>Project Id</option>
						<option value ='DateModified' >Date Updated</option>
						<option value ='Name'>Project Name</option>
						<option value ='b.Name'>Office</option>
						<option value ='ProjectCost'>Project Cost</option>
						<option value ='c.DateEncoded'>Date Created</option>
						<option value ='x.TrackingNumber'>PR Tracking Number</option>
						";
	}
	
	//------------------------------------------------------------------------------sa PR header
	
	
	$sql = "SELECT Office,Color FROM citydoc2023.status where type ='PR' or type ='PO' or type ='PX' group by office";
	$record = $database->query($sql);
	$legend = '<table style ="border-spacing:0px;font-size:10px;background-color:white;padding:5px;box-shadow:0px 0px 5px 0px silver;">';
	$legend .= '<tr><td colspan ="2" style ="background-color:rgb(126, 150, 150);border-bottom:1px solid black;text-align:center; color:white;font-size:14px;">Office Legend</td></tr>';
	while($data = $database->fetch_array($record)){
		$office = $data['Office'];
		$color = $data['Color'];
		
		$legend .= '<tr><td><div style = "background-color:' . $color .  '; width:10px; height:10px;border-radius:2px; border:1px solid grey;"></div></td>
						<td style ="padding-left:5px;">'. $office . '</td>
					</tr>';  
	}
	$legend .= '</table>';
	
	$sql = "SELECT group_concat(distinct Status SEPARATOR '*') as Status FROM vouchercurrent where ProjectId != '' and TrackingType = 'PR' and Status like '%Pending%'";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$statuses = $data['Status'];
	
	$sql = "select * from status where type = 'PR'";
	$record = $database->query($sql);
	$statusRow = '<th colspan ="2">' . $legend . '</th>';
	$guideColRow = '<th colspan ="2"></th>';
	
	$statusColor ='';
	$arrayColumn = [];
	$arrayStatusIdPR = [];
	$i = 1;
	$iCtrPR =1;
	while($data = $database->fetch_array($record)){
		$id = $data['Id'];
		$status = $data['Status'];
		$visible = $data['Visible'];
		$office = $data['Office'];
		$color = $data['Color'];
		
		if($visible == 1){
			
			$statusRow .= '<th class="rotate" ><div ><span>' .$status .'</span></div></th>';
			$statusColor .= '<th ><div style ="float:right;background-color:' . $color . ';border:1px solid rgb(32, 116, 168);height:8px;width:8px;border-radius:2px;">&nbsp;</div></th>';
			$guideColRow .= '<th style ="padding:0px 3px;">' .$iCtrPR .'</th>';
			
			
			$arrayColumn[$i]["Status"] = $status;
			$arrayColumn[$i]["Office"] = $office;
			$arrayStatusIdPR[$status] = $iCtrPR;
			
			$i++;
			$iCtrPR++;
		}else{
			$match = preg_match('/' . $status . '/i', $statuses);
			if($match == 1){
				$statusRow .= '<th class="rotate"><div><span>'. $status . '</span></div></th>';
				$guideColRow .= '<th style ="padding:0px 3px;"></th>';
				$statusColor .= '<th ><div style ="float:right;background-color:' . $color . ';border:1px solid rgb(32, 116, 168);height:8px;width:8px;border-radius:2px;">&nbsp;</div></th>';
				$arrayColumn[$i]["Status"]= $status;
				$arrayColumn[$i]["Office"] = $office;
				$arrayStatusIdPR[$status] = $iCtrPR-1;
				$i++;
			}
		}
	}
	
	//sa --------------------------------------------------------------------------------------PO header
	$sql = "select group_concat(distinct Status SEPARATOR '*') as Status from(
			select Status from
			(SELECT TrackingNumber FROM vouchercurrent where ProjectId > 0 and Status = 'For P.O' group by TrackingNumber) a inner join 
			(SELECT PR_TrackingNumber,TrackingNumber,group_concat(distinct Status SEPARATOR '*') as Status FROM vouchercurrent where TrackingType = 'PO' and Status like '%Pending%'  group by TrackingNumber) b
			on a.TrackingNumber = b.PR_TrackingNumber group by status) a";
			
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$statusesPO = $data['Status'];
	
	$sql = "select * from status where type = 'PO'";
	$record = $database->query($sql);
	
	$statusRowPO = '';
	$guideColRowPO = '';
	$arrayColumnPO = [];
	$arrayStatusIdPO = [];
	$statusColorPO ='';
	$i = 1;
	$iCtrPO =1;
	while($data = $database->fetch_array($record)){
		$id = $data['Id'];
		$status = $data['Status'];
		$visible = $data['Visible'];
		$office = $data['Office'];
		$color = $data['Color'];
		if($visible == 1){
			$statusRowPO .= '<th class="rotate"><div><span>' .$status .'</span></div></th>';
			$guideColRowPO .= '<th style ="padding:0px 3px;background-color:rgb(96, 197, 108);">' .$iCtrPO .'</th>';
			$statusColorPO .= '<th ><div style ="float:right;background-color:' . $color . ';border:1px solid rgb(32, 116, 168);height:8px;width:8px;border-radius:2px;">&nbsp;</div></th>';
			
			$arrayColumnPO[$i]["Status"] = $status;
			$arrayColumnPO[$i]["OfficePO"] = $office;
			$arrayStatusIdPO[$status] = $iCtrPO;
			$i++;
			$iCtrPO++;
		}else{
			$match = preg_match('/' . $status . '/i', $statusesPO);
			if($match == 1){
				$statusRowPO .= '<th class="rotate"><div><span>'. $status . '</span></div></th>';
				$guideColRowPO .= '<th style ="padding:0px 3px;background-color:rgb(96, 197, 108);"></th>';
				$statusColorPO .= '<th ><div style ="float:right;background-color:' . $color . ';border:1px solid rgb(32, 116, 168);height:8px;width:8px;border-radius:2px;">&nbsp;</div></th>';
				$arrayColumnPO[$i]["Status"]= $status;
				$arrayColumnPO[$i]["OfficePO"] = $office;
				$arrayStatusIdPO[$status] = $iCtrPO-1;
				$i++;
			}
		}
	}
	
	
	//sa ---------------------------------------------------------------------------------------------PX header
	$sql = "select group_concat(distinct c.Status SEPARATOR '*') as Status from
			(SELECT TrackingNumber FROM vouchercurrent where TrackingType = 'PR' and ProjectId > 0 and status != 'Cancelled' group by trackingnumber) a inner join
			(SELECT PR_TrackingNumber,TrackingNumber FROM vouchercurrent where TrackingType = 'PO' and status != 'Cancelled' group by trackingnumber) b
			on a.TrackingNumber = b.PR_TrackingNumber
			inner join (SELECT TrackingPartner,TrackingNumber,Status FROM vouchercurrent where 
			TrackingType = 'PX' and status != 'Cancelled'  and Status like '%Pending%'
			
			group by trackingnumber) c
			on b.TrackingNumber = c.TrackingPartner";
	
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$statusesPX = $data['Status'];
	
	$sql = "select * from status where type = 'PX' order by orderStat";
	$record = $database->query($sql);
	
	$statusRowPX = '';
	$guideColRowPX = '';
	$statusColorPX = '';
	$arrayStatusIdPX = [];
	$arrayColumnPX = [];
	$i = 1;
	$iCtrPX =1;
	
	while($data = $database->fetch_array($record)){
		$id = $data['Id'];
		$status = $data['Status'];
		$visible = $data['Visible'];
		$office = $data['Office'];
		$color = $data['Color'];
		
		if($visible == 1){
			
			$statusRowPX .= '<th class="rotate"><div><span>' .$status .'</span></div></th>';
			$guideColRowPX .= '<th style ="padding:0px 3px;background-color:rgb(225, 169, 80);">' .$iCtrPX .'</th>';
			$statusColorPX .= '<th ><div style ="float:right;background-color:' . $color . ';border:1px solid rgb(32, 116, 168);height:8px;width:8px;border-radius:2px;">&nbsp;</div></th>';
			$arrayColumnPX[$i]["Status"] = $status;
			$arrayColumnPX[$i]["OfficePO"] = $office;
			$arrayStatusIdPX[$status] = $iCtrPX;
			$i++;
			$iCtrPX++;
		}else{
			$match = preg_match('/' . $status . '/i', $statusesPX);
			if($match == 1){
				$statusRowPX .= '<th class="rotate"><div><span>'. $status . '</span></div></th>';
				$guideColRowPX .= '<th style ="padding:0px 3px;background-color:rgb(225, 169, 80);"></th>';
				$statusColorPX .= '<th ><div style ="float:right;background-color:' . $color . ';border:1px solid rgb(32, 116, 168);height:8px;width:8px;border-radius:2px;">&nbsp;</div></th>';
				$arrayColumnPX[$i]["Status"]= $status;
				$arrayColumnPX[$i]["OfficePO"] = $office;
				$arrayStatusIdPX[$status] = $iCtrPX-1;
				$i++;
			}
		}
	}
	
	
	$sort1 = str_replace('a.','x.',$sort);		
	$sort1 = str_replace('b.','x.',$sort1);		
	
	//prpopx
	$sql = "select x.*,
			y.TrackingNumber as PO_TrackingNumber,y.Status as PO_Status,y.DateModified as PO_DateModified,y.DateEncoded as PO_DateEncoded, y.PO_Amount as PO_Amount,y.TotalAmountMultiple as PO_TotalAmountMultiple,y.Remarks as PO_Remarks,
			z.TrackingNumber as PX_TrackingNumber, z.Status as PX_Status,z.DateModified as PX_DateModified,z.DateEncoded as PX_DateEncoded, z.Amount as PX_Amount,z.TotalAmountMultiple as PX_TotalAmountMultiple,z.Remarks as PX_Remarks
			
			
			from( SELECT a.Id,a.Office as OfficeCode,a.Name,a.ProjectCost,b.Name as Office,c.Remarks,c.TrackingNumber ,c.Status,c.DateModified,c.Amount,c.PR_CategoryCode, c.TotalAmountMultiple,c.Fund,c.DateEncoded,d.Description as Category 
			FROM disasterprojects a left join office b on a.Office = b.Code 
			left join (select * from vouchercurrent where TrackingType = 'PR' and ProjectId > 0 and Status != 'Cancelled' group by TrackingNumber) c on a.Id = c.ProjectId 
			left join ppmpcategories d on c.PR_CategoryCode = d.Code where a.Id > 0 " . $filter1 . $filter2 . ") x left join (select * from vouchercurrent where TrackingType = 'PO' and status != 'Cancelled'  group by trackingnumber) y 
			on x.TrackingNumber = y.PR_TrackingNumber 
			left join (select * from vouchercurrent where TrackingType = 'PX' and status != 'Cancelled' group by trackingnumber) z

			on y.TrackingNumber = z.TrackingPartner where x.Id > 0 " . $filter3 . $filter4 . "

			order by " . $sort1 . " " . $order  . ",TrackingNumber asc";		
			
	//echo $sql;
	$record = $database->query($sql);
	
	
	
	
	$i = 1;
	$lastName = '';
	$colorOddEven = "rgb(54, 100, 155);";
	$colorOdd = "rgb(92, 154, 211)";
	$bulletColor = "white";
	$fontColor = "black";
	
	$trColor = $colorOddEven;
	$sheet = '<table id = "tableMain" border = "0" style = "border-spacing:0;margin:0 auto;color:' .  $fontColor. ';width:10%;">';
	$sheet .= '<tr style = "color:black;">
					' . $statusRow . '
					<th></th>' . $statusRowPO . '
					<th></th>' . $statusRowPX . '
				</tr>';
				
	$sheet .= '<tr style = "background: linear-gradient(to bottom, rgba(251, 251, 249,.6) ,rgba(51, 198, 252,.3)">
					<th colspan ="2" style ="padding:12px;"></th>
					' . $statusColor . '<th ></th>' . $statusColorPO . '<th></th>' . $statusColorPX .'
				
				</tr>';			
					
				
	$sheet .= '<tr style = "text-align:right;background-color:rgb(75, 181, 247);color:white;">
					' . $guideColRow . '<th  style ="border-left:1px solid black;background-color:rgb(189, 211, 221);"></th>
					' . $guideColRowPO . '<th style ="border-left:1px solid black;background-color:rgb(189, 211, 221);"></th>
					' . $guideColRowPX . '
					</tr>';
	$sheet .= '<tr  style = "text-align:left;color:white;white-space:nowrap;  ">
					<th colspan ="' . (sizeof($arrayColumn)+2) .'" style = "padding:5px 10px;font-weight:normal;font-size:16px;border-top:1px solid grey;background-color:rgb(9, 50, 74);">Purchase Request Process</th>
					<th style ="border-left:1px solid black;background-color:rgb(42, 55, 61)"></th>
					<th colspan ="' . sizeof($arrayColumnPO) .'" style = "padding:5px 10px;font-weight:normal;font-size:16px;border-top:1px solid grey;background-color:rgb(9, 50, 74);">Purchase Order Process</th>
					<th style ="border-left:1px solid black;background-color:rgb(42, 55, 61)"></th>
					<th colspan ="' . sizeof($arrayColumnPX) .'" style = "padding:5px 10px;font-weight:normal;font-size:16px;border-top:1px solid grey;background-color:rgb(9, 50, 74);">Payment Process</th>
					<th colspan ="2" style = "border-left:1px solid black;border-bottom:1px solid silver;"></th>
					
					
				</tr>';
	$oldId= '';
	$oldPRtn = '';
	$pxTNs = '';
	$flag = 0;
	$totalPR = 0;
	$totalPO = 0;
	$totalPX = 0;
	
	$prCount = 0;
	$poCount = 0;
	$pxCount = 0;
	$pdCount = 0;
	
	$prCountAll = 0;
	$poCountAll = 0;
	$pxCountAll = 0;
	$pdCountAll = 0;
	
	
	
	$lastCost = 0;
	$lastProjectName = '';
	
	$lastPRcount = 0;
	$lastPOcount = 0;
	$lastPXcount = 0;
	$lastPDcount = 0;
	$totalPaid = 0;
	
	
	$totalAllcost = 0;
	
	$totalAllpr = 0;
	$totalAllpo = 0;
	$totalAllpx = 0;
	$totalAllpd = 0;
	
	$paidPercent = 0.00;
	
	$countTR = $database->num_rows($record);
	$rowId = 1;
	
	$projectCount = 1;
	while($data = $database->fetch_array($record)){
		$id = $data['Id'];
		$name = trim($data['Name']);
		$cost = $data['ProjectCost'];
		$status = $data['Status'];
		
		$skey = '';
		$prCompletion = '';
		if(isset($arrayStatusIdPR[$status])){
			$skey = $arrayStatusIdPR[$status];
			$prCompletion  =   round(($skey /  ($iCtrPR-1)) * 100);
		}
		$tn =  $data['TrackingNumber'];
		$office =  $data['Office'];
		$category = $data['PR_CategoryCode'];
		$multiple = $data['TotalAmountMultiple'];
		$amount = $data['Amount'];
		$remarks = $data['Remarks'];
		
		$description = $data['Category'];
		$fund = $data['Fund'];
		$encoded = $data['DateEncoded'];
		
		
		
		
		$poTN = $data['PO_TrackingNumber'];
		$poStatus = $data['PO_Status'];
		$poRemarks =  $data['PO_Remarks'];
		$skeyPO = '';
		$poCompletion = '';
		if(isset($arrayStatusIdPO[$poStatus])){
			$skeyPO = $arrayStatusIdPO[$poStatus];
			$poCompletion  =  round(($skeyPO /  ($iCtrPO-1)) * 100);
		}
		
		$poDateModified = $data['PO_DateModified'];
		$poEncoded = $data['PO_DateEncoded'];
		
		$date1 = new DateTime($poEncoded); 
	  	$date2 = new DateTime($poDateModified);
		$interval = $date1->diff($date2); 
		$totalDaysPO = $interval->format('%a'); 
		
		$poAmount = $data['PO_Amount'];
		$poTotalAmountMultiple = $data['PO_TotalAmountMultiple'];
		
		if($poTotalAmountMultiple > 0){
			$poAmount = $poTotalAmountMultiple;
		}
		if($multiple > 0){
			$amount = $multiple;
		}
		$dateUpdated =  $data['DateModified'];
		
			
		$date1 = new DateTime($encoded); 
	  	$date2 = new DateTime($dateUpdated);
		$interval = $date1->diff($date2); 
		$totalDaysPR = $interval->format('%a'); 

		
		
		
		$dateModifiedCount =  $database->ezDateDay($data['DateModified']);
		$dateModifiedCountPO =  $database->ezDateDay($poDateModified);
		
		
		$pxTN =  $data['PX_TrackingNumber'];
		$pxStatus =  $data['PX_Status'];
		$skeyPX = '';
		$pxCompletion = '';
		if(isset($arrayStatusIdPX[$pxStatus])){
			$skeyPX = $arrayStatusIdPX[$pxStatus];
			$pxCompletion  =  round(($skeyPX /  ($iCtrPX-1)) * 100);
		}
		
		$pxDateModified = $data['PX_DateModified'];
		$pxEncoded = $data['PX_DateEncoded'];
		
		$date1 = new DateTime($pxEncoded); 
	  	$date2 = new DateTime($pxDateModified);
		$interval = $date1->diff($date2); 
		$totalDaysPX = $interval->format('%a'); 
		
		$pxAmount = $data['PX_Amount'];
		$pxRemarks = $data['PX_Remarks'];
		
		
		$totalDaysAll = $totalDaysPR + $totalDaysPO + $totalDaysPX;
		
		$pxTotalAmountMultiple = $data['PX_TotalAmountMultiple'];
		if($pxTotalAmountMultiple > 0){
			$pxAmount = $pxTotalAmountMultiple;
		}
		$dateModifiedCountPX =  $database->ezDateDay($pxDateModified);
		
		if($id != $oldId ){
			if($trColor == $colorOdd){
				$trColor = $colorOddEven;
			}else{
				$trColor = $colorOdd;
			}
		}
		if($flag == 0){
			$totalAllcost +=  $cost;
		}
		if($flag > 0){
			
			if($lastName != $name){
				$projectCount++;
				$totalAllcost +=  $cost;
				$paidPercent = 0.00;
				if($totalPX > 0){
					$paidPercent = round(($totalPaid / $totalPX) * 100,2);
				}else{
					$paidPercent = 0.00;
				}
				$sheet1 = '<tr class ="summary1"><td colspan ="100%" style ="border-top:1px solid white;border-bottom:1px solid white;background-color:rgb(188, 207, 218);padding:20px;padding-right:130px;">
						  	<table border ="0" style ="float:right;border-spacing:0;width:80%;">
						  		<tr>
						  			<th style ="text-align:left;padding-right:10px;">Project Name :</th>
						  			<th style ="border-top:1px solid silver;text-align:right;border-left:1px solid grey;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);width:90px;">Purchase&nbsp;Request</th>
						  			<th style ="border-top:1px solid silver;text-align:right;border-lef:1px solid grey;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);width:90px;">Purchase&nbsp;Order</th>
						  			<th style ="border-top:1px solid silver;text-align:right;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);width:90px;">Payment</th>
						  			<th style ="border-top:1px solid silver;text-align:right;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);width:90px;">Paid</th>
						  		</tr>
						  		<tr style = "line-height:16px;">	
						  			<td style = "padding-right:20px;font-size:12px;">' . $lastProjectName . '</td>
						  			<td  style ="text-align:right;border-top:1px solid grey;border-left:1px solid grey;border-right:1px solid grey;border-bottom:1px solid grey;padding-right:10px;">' . $prCount . '</td>
						  			<td  style ="text-align:right;border-top:1px solid grey;border-right:1px solid grey;padding-right:10px;border-bottom:1px solid grey;">' . $poCount . '</td>
						  			<td  style ="text-align:right;border-top:1px solid grey;border-right:1px solid grey;padding-right:10px;border-bottom:1px solid grey;">' . $pxCount . '</td>
						  			<td style ="text-align:right;border-top:1px solid grey;padding:0px 10px;border-right:1px solid grey;padding-right:10px;border-bottom:1px solid grey; font-size:14px;">' . $pdCount . '</td>
						  		</tr>
						  		<tr>
						  			<td colspan ="100%;" ></td>
						  		</tr>
						  		<tr style = "font-size:14px;">
						  			<td style ="text-align:left;font-weight:bold;">' . number_format($lastCost,2) . '</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . number_format($totalPR,2) . '</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . number_format($totalPO,2) . '</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . number_format($totalPX,2) . '</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . number_format($totalPaid,2) . '</td>
						  		</tr>
						  		<tr style ="color:green;line-height:11px;font-size:13px;">
						  			<td style ="text-align:left;"></td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . round(($totalPR / $lastCost) * 100,2) . '%</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . round(($totalPO / $lastCost) * 100,2) . '%</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' .  round(($totalPX / $lastCost) * 100,2) . '%</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;color:rgb(8, 105, 195);">' .  $paidPercent . '%</td>
						  			
						  		</tr>
						  	</table>
						  </td></tr>';
				
				$sheet .= $sheet1;
				
			}
		}
		if($projectView == 0){
			$sheet .= '<tr  style ="background-color:' . $trColor . '; " >';
		}else if($projectView == 1){
			if($tn){
				$sheet .= '<tr style ="background-color:' . $trColor . '; " >';
			}else{
				$sheet .= '<tr style ="background-color:' . $trColor . ';display:none;" >';
			}
		}else if($projectView == 2){
			if($tn){
				
				$sheet .= '<tr style ="background-color:' . $trColor . ';display:none; " >';
			}else{
				$sheet .= '<tr style ="background-color:' . $trColor . '" >';
				
			}
		}
		
		
			if($lastName == $name){
				$sheet .= '<td  style = "width:20px;text-align:center;vertical-align:top;font-size:12px;padding:4px;padding-top:10px;">
								<div  class = "tdSame" style ="font-size:12px;font-weight:bold;background-color:black;color:white;padding:3px;line-height:12px;box-shadow:0px 0px 1px 0px black;">' . $id . '</div>
							</td>';
				$sheet .= '<td style = "width:300px;font-size:13px;vertical-align:top;padding:10px;padding-right:0px;">
								<div class = "tdSame" style ="background-color:rgba(251, 248, 248,.8);box-shadow:0px 0px 8px 1px rgb(135, 157, 174); padding:5px;border:4px solid white;">
									<div style = "font-weight:bold;">' . $name . '</div>
									<div>' . $fund .   '</div>
									<div>' . $office . '</div> 
									<div>' . number_format($cost,2) . '</div>
								</div>
							</td>';
				
				$totalPO +=  $poAmount;
				$totalPX +=  $pxAmount;
				
				
				
				if($oldPRtn != $tn){
					$totalPR +=  $amount;
					$totalAllpr += $amount;
				}
			}else{
					
				$totalAllpr += $amount;
				$prCount = 0;
				$poCount = 0;
				$pxCount = 0;
				$pdCount = 0;
				
				
				$totalPR =  $amount;	
				$totalPO = $poAmount;
				$totalPX = $pxAmount;
				if($pxStatus == "Check released"){
					$totalPaid = $pxAmount;
				}else{
					$totalPaid = 0;
				}

				$sheet .= '<td style = "width:20px;text-align:center;vertical-align:top;font-size:12px;padding:4px;padding-top:10px;">
								<div style ="font-size:12px;font-weight:bold;background-color:black;color:white;padding:3px;line-height:12px;box-shadow:0px 0px 1px 0px black;">' . $id . '</div>
							</td>';
							
							
							
				$sheet .= '<td style = "width:300px;font-size:13px;vertical-align:top;padding:10px;padding-right:0px;">
								<div style ="background-color:rgba(251, 248, 248,.8);box-shadow:0px 0px 8px 1px rgb(135, 157, 174); padding:5px;border:4px solid white;">
									<div style = "font-weight:bold;">' . $name .  '</div>
									<div>' . $fund . '</div>
									<div>' . $office . '</div> 
									<div>' . number_format($cost,2) . '</div>
								</div>
							</td>';
			}
			//------------------------------------------------------------------------------------td PR
			$col = 1;
			if($tn){
				
				foreach ($arrayColumn as $column) {
					if(trim($column['Status']) == $status){
						if(preg_match("/Pending/",$status)){
							$bulletColor = "red";
						}else if(preg_match("/For P.O/",$status)){
							$bulletColor = "rgb(25, 161, 41)";
						}else{
							$bulletColor = "rgb(194, 211, 213)";
						}
						$sheet .= '<td colspan ="' . $col . '" style = "text-align:right;vertical-align:top;padding-top:15px;">';
									if($oldPRtn == $tn){
										$sheet .= '<table style ="display:none;float:right;width:100%;font-size:13px;padding-right:17px; margin-bottom:5px;margin-top:1px;color:' . $fontColor . '" border="0">';
									}else{
										$prCount++;
										$prCountAll++;
										$sheet .= '<table style ="float:right;width:100%;font-size:13px;padding-right:17px; margin-bottom:5px;margin-top:1px;color:' . $fontColor . '" border="0">';
									}	
						$sheet .= '					<tr>
														<td style = "text-align:right;" >
															<hr style = "border:3px solid rgb(243, 246, 248);margin-left:-5px; box-shadow:2px 0px 10px grey;">
															<div style = "line-height:12px;padding-top:5px;font-weight:bold;"><span class = "highlight" onclick = "gotoPRdetails(this)">'  . $tn .  '</span>
																<div style ="color:white;position:absolute; display:inline;font-weight:normal;font-size:20px; margin-left:-67px; margin-top:-36px;">
																<span style ="font-size:10px;color:black;margin-right:5px;">' . $skey . '/'  .($iCtrPR-1) . '</span>
																<span class ="prCompletion">' .  $prCompletion  . '</span>%</div>
															</div>
															
															<div style ="width:13px;height:13px;display:inline-block;border: 2px solid white; background-color:' . $bulletColor . ';margin-right:-12px;border-radius:50%;margin-top:-35px;box-shadow:5px 0px 10px black;">
																
															</div>
														</td>
													</tr>
													<tr class = "trDetails">
														<td style ="text-align:right;padding:5px;">
															<div style = "line-height:13px;">
																<div style ="white-space:nowrap;">Created : '.  $encoded.   '</div>
																<div>' . $description . '</div>
																<div>' . number_format($amount,2) . '</div>
																<div style = "margin-top:7px;">' . $status. '</div>';
																if(preg_match("/Pending/",$status)){
																	$sheet .= '<table  class ="pendingsTable" style ="width:100%;" border ="0"><tr><td><div class ="pendings" >' . $remarks . '</div></td></tr></table>';
																}
																$sheet .= '<div>(<span class ="dropOfficePR">'  . $column['Office']. '</span>)</div>
																<div>Updated : '  . $dateUpdated . '</div>
																<div style ="color:white;">'.  $dateModifiedCount.   '</div>
															</div>
														</td>
													</tr>
												</table>
												
									</td>';
						break;
					}
					$col++;
				}
			}else{
				$col = 0;
			}
			
			if($col < sizeof($arrayColumn)){
				$sheet .= '<td colspan = "' .  (sizeof($arrayColumn) - $col)  . '" ></td>
							<td style ="border-left:1px solid black;background-color:rgb(210, 220, 225);padding-left:1px;vertical-align:top;">';
							if($totalDaysPR > 0){
								if($oldPRtn != $tn){
									$sheet .= '	<div class ="ongoing" >' . $totalDaysPR . '<div style ="font-size:10px;">Days</div>
													<div style ="font-size:10px;">Ongoing</div>
												</div>';
								}
							}
			$sheet .= '	</td>';
			}else{
				$sheet .= '<td style ="border-left:1px solid black;vertical-align:top;background-color:white;font-size:16px;font-family:arial; font-weight:bold;">';
							if($oldPRtn != $tn){
									$sheet .= '<div class ="completed">' . $totalDaysPR . '
										<div style ="font-size:10px;">Days</div>
										<div style ="font-size:10px;">Completed</div>
										</div>';
							}
				$sheet .= '	</td>';
			} 
			//------------------------------------------------------------------------------------td PO
			$col = 1;
			if($poTN){
				$poCount++;
				$poCountAll++;
				$totalAllpo += $poAmount;
				foreach ($arrayColumnPO as $column) {
					if(trim($column['Status']) == $poStatus){
						
						if(preg_match("/Pending/",$poStatus)){
							$bulletColor = "red";
						}else if(preg_match("/ting/",$poStatus)){
							$bulletColor = "rgb(240, 169, 54)";
						}else{
							$bulletColor = "green";
						}
						$sheet .= '<td colspan ="' . $col . '" style = "text-align:right;vertical-align:top;padding-left:8px;padding-top:15px;">
												<table style ="float:right;width:100%;font-size:13px;padding-right:17px; margin-bottom:5px;margin-top:1px;color:' . $fontColor . '" border="0">
													<tr>
														<td style = "text-align:right;" >
															<hr style = "border:3px solid rgb(96, 197, 108);margin-left:-5px; box-shadow:2px 0px 10px black;">
															<div style = "line-height:12px;padding-top:5px;font-weight:bold;"><span class = "highlight" onclick = "gotoPOdetails(this)">'  . $poTN .  '</span>
																<div style ="color:white;position:absolute; display:inline;font-weight:normal;font-size:20px; margin-left:-67px; margin-top:-36px;">
																<span style ="font-size:10px;color:black;margin-right:5px;">' . $skeyPO . '/'  .($iCtrPO-1) . '</span>
																<span class ="poCompletion">' .  $poCompletion  . '</span>%</div>
															</div>
															<div style ="width:13px;height:13px;display:inline-block;border: 2px solid rgb(96, 197, 108); background-color:' . $bulletColor . ';margin-right:-12px;border-radius:50%;margin-top:-35px;box-shadow:5px 0px 10px black;">
															</div>
														</td>
													</tr>
													<tr class = "trDetails">
														<td style ="text-align:right;padding:5px;">
															<div style = "line-height:13px;">
																<div style ="white-space:nowrap;">Created : '.  $poEncoded.   '</div>
																<div> '. number_format($poAmount,2).   '</div>
																<div style = "margin-top:7px;">' . $poStatus. '</div>';
																
																if(preg_match("/Pending/",$poStatus)){
																	$sheet .= '<table  class ="pendingsTable" style ="width:100%;" border ="0"><tr><td><div class ="pendings" >' . $poRemarks . '</div></td></tr></table>';
																}
																 $sheet .= '<div>(<span class ="dropOfficePO">'  . $column['OfficePO']. '</span>)</div>
																<div>Updated : '  . $poDateModified . '</div>
																<div style ="color:white;">'.  $dateModifiedCountPO.   '</div>
															</div>
														</td>
													</tr>
												</table>
												
									</td>';
						break;
					}
					$col++;
				}
			}else{
				$col = 0;
			}
			if($col < sizeof($arrayColumnPO)){
				$sheet .= '<td colspan = "' .  (sizeof($arrayColumnPO)-$col)  . '" style ="text-align:right;"></td>
							<td style ="border-left:1px solid black;background-color:rgb(210, 220, 225);vertical-align:top;">';
				if($totalDaysPO > 0){
					$sheet .= '	<div class ="ongoing" >' . $totalDaysPO . '
									<div style ="font-size:10px;">Days</div>
									<div style ="font-size:10px;">Ongoing</div>
								</div>';
				}
				$sheet .= '	</td>';
			}else{
				$sheet .= '<td style ="border-left:1px solid black;vertical-align:top;background-color:white;font-size:16px;font-family:arial;vertical-align:top; font-weight:bold;">
								<div class ="completed">' . $totalDaysPO . '
									<div style ="font-size:10px;">Days</div>
									<div style ="font-size:10px;">Completed</div>
								</div>
				</td>';
			}
			
				//------------------------------------------------------------------------------------td PX
			$col = 1;
			if($pxTN){
				$pxCount++;
				$pxCountAll++;
				$totalAllpx += $pxAmount;
				
				if($pxStatus == "Check Released"){
					$pdCount++;
					$pdCountAll++;
					$totalPaid += $pxAmount;
					$totalAllpd += $pxAmount;
				}
				foreach ($arrayColumnPX as $column) {
					if(trim($column['Status']) == $pxStatus){
						if(preg_match("/Pending/",$pxStatus)){
							$bulletColor = "red";
						}else if(preg_match("/Check Released/",$pxStatus)){
							$bulletColor = "white";
						}else{
							
							$bulletColor = "rgb(207, 141, 34)";
						}
						$sheet .= '<td colspan ="' . $col . '" style = "text-align:right;vertical-align:top;padding-left:8px;padding-top:15px;">
												<table style ="float:right;width:100%;font-size:13px;padding-right:17px; margin-bottom:5px;margin-top:1px;color:' . $fontColor . '" border="0">
													<tr>
														<td style = "text-align:right;" >
															<hr style = "border:3px solid rgb(237, 168, 20);margin-left:-5px; box-shadow:2px 0px 10px black;">
															<div style = "line-height:12px;padding-top:5px;font-weight:bold;"><span class = "highlight" onclick = "gotoPXdetails(this)">'  . $pxTN .  '</span>
																
																<div style ="color:white;position:absolute; display:inline;font-weight:normal;font-size:20px; margin-left:-78px; margin-top:-36px;">
																<span style ="font-size:10px;color:black;margin-right:5px;">' . $skeyPX . '/'  .($iCtrPX-1) . '</span>
																<span class ="pxCompletion">' .  $pxCompletion  . '</span>%</div>
															</div>
															<div style ="width:13px;height:13px;display:inline-block;border: 2px solid rgb(237, 168, 20); background-color:' . $bulletColor . ';margin-right:-12px;border-radius:50%;margin-top:-35px;box-shadow:5px 0px 10px black;">
															</div>
															
															
															
														</td>
													</tr>
													<tr class = "trDetails">
														<td style ="text-align:right;padding:5px;">
															<div style = "line-height:13px;">
																<div style ="white-space:nowrap;">Created : '.  $pxEncoded.   '</div>
																<div> '. number_format($pxAmount,2).   '</div>
																<div style = "margin-top:7px;">' . $pxStatus. '</div>';
																
																
																if(preg_match("/Pending/",$pxStatus)){
																	$sheet .= '<table class ="pendingsTable" style ="width:100%;" border ="0"><tr><td><div class ="pendings" >' . $pxRemarks . '</div></td></tr></table>';
																}
																$sheet .= '<div> (<span class ="dropOfficePX">'  . $column['OfficePO']. '</span>)</div>
																<div>Updated : '  . $pxDateModified . '</div>
																<div style ="color:white;">'.  $dateModifiedCountPX.   '</div>
															</div>
														</td>
													</tr>
												</table>
												
									</td>';
						break;
					}
					$col++;
				}
			}else{
				$col = 0;
				
			}
			
			
			if($col < sizeof($arrayColumnPX)){
				$sheet .= '<td colspan = "' .  (sizeof($arrayColumnPX)-$col)  . '" style ="text-align:right;"></td><td style ="border-left:1px solid black;background-color:rgb(210, 220, 225);vertical-align:top;;">';
				if($totalDaysPX > 0){
					$sheet .= '	<div class ="ongoing" >' . $totalDaysPX . '
									<div style ="font-size:10px;">Days</div>
									<div style ="font-size:10px;">Ongoing</div>
								</div>';
				}	
				$sheet .= '</td>
				<td style ="background-color:rgb(191, 205, 211);vertical-align:top;"></td>';
			}else{
				$sheet .= '<td style ="border-left:1px solid black;background-color:white;font-size:16px;font-family:arial; font-weight:bold;vertical-align:top;">
								<div class ="completed">' . $totalDaysPX . '
									<div style ="font-size:10px;">Days</div>
									<div style ="font-size:10px;">Completed</div>
								</div>
				</td>
				<td style ="background-color:rgb(184, 189, 53);border-left:1px solid silver;font-size:16px;font-family:arial; font-weight:bold;vertical-align:top;">
					<div class ="completed" style ="color:black;">' . $totalDaysAll . '
						<div style ="font-size:10px;color:white;">Total Days</div>
						<div style ="font-size:10px;">Completed</div>
					</div>
				</td>
				';
			}
			$sheet .= '</tr>';
		
		
		$rowId++;
		
		$flag = 1;
		$lastName = $name;
		$oldId = $id;
		$oldPRtn = $tn;
		$lastCost = $cost;
		$lastProjectName = $name;
		
		$lastPRcount = $prCount;
		$lastPOcount = $poCount;
		$lastPXcount = $pxCount;
	}
	if($lastCost > 0){
		$tr1 = round(($totalPR / $lastCost) * 100,2);
		$tr2 = round(($totalPO / $lastCost) * 100,2);
		$tr3 =round(($totalPX / $lastCost) * 100,2);
		$sheet .= '<tr class = "summary1"><td colspan ="100%" style ="border-top:1px solid white;border-bottom:1px solid white;background-color:rgb(188, 207, 218);padding:20px;padding-right:130px;">
						  	<table border ="0" style ="float:right;border-spacing:0;width:80%;">
						  		<tr>
						  			<th style ="text-align:left;padding-right:10px;">Project Name :</th>
						  			<th style ="text-align:right;border-left:1px solid grey;border-top:1px solid silver; border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);width:90px;">Purchase&nbsp;Request</th>
						  			<th style ="text-align:right;border-lef:1px solid grey;border-top:1px solid silver;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);width:90px;">Purchase&nbsp;Order</th>
						  			<th style ="text-align:right;border-right:1px solid grey;border-top:1px solid silver;padding:0px 10px; background-color:rgb(244, 248, 251);width:90px;">Payment</th>
						  			<th style ="text-align:right;border-right:1px solid grey;border-top:1px solid silver;padding:0px 10px; background-color:rgb(244, 248, 251);width:90px;">Paid</th>
						  		</tr>
						  		<tr style = "line-height:16px;">	
						  			<td style = "padding-right:20px;font-size:12px;">' . $lastProjectName . '</td>
						  			<td  style ="text-align:right;border-top:1px solid grey;border-left:1px solid grey;border-right:1px solid grey;border-bottom:1px solid grey;padding-right:10px;">' . $prCount . '</td>
						  			<td  style ="text-align:right;border-top:1px solid grey;border-right:1px solid grey;padding-right:10px;border-bottom:1px solid grey;">' . $poCount . '</td>
						  			<td  style ="text-align:right;border-top:1px solid grey;border-right:1px solid grey;padding-right:10px;border-bottom:1px solid grey;">' . $pxCount . '</td>
						  			<td style ="text-align:right;border-top:1px solid grey;padding:0px 10px;border-right:1px solid grey;padding-right:10px;border-bottom:1px solid grey; font-size:14px;">' . $pdCount . '</td>
						  		</tr>
						  		<tr>
						  			<td colspan ="100%;" ></td>
						  		</tr>
						  		<tr style = "font-size:14px;">
						  			<td style ="text-align:left;font-weight:bold;padding:0px 10px;">' . number_format($lastCost,2) . '</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . number_format($totalPR,2) . '</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . number_format($totalPO,2) . '</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . number_format($totalPX,2) . '</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . number_format($totalPaid,2) . '</td>
						  		</tr>
						  		<tr style ="color:green;line-height:11px;font-size:13px;">
						  			<td style ="text-align:left;"></td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . $tr1 . '%</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . $tr2 . '%</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . $tr3  . '%</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;color:rgb(8, 105, 195);">' .  $paidPercent . '%</td>					  			
						  		</tr>
						  	</table>
						  </td></tr>';
		
	}
	
	
	//$totalAllpr += $totalPR;
	
	/*$totalAllcost = 1000;
	$totalAllpr =   900;
	$totalAllpo =   600;	
	$totalAllpx = 30;
	$totalAllpd = 30;*/
	$prPercent = 0.00;
	$poPercentPR = 0.00;
	$poPercentCost = 0.00;
	$pxPercentPO = 0.00;
	$pxPercentCost = 0.00;
	$pdPercentPX = 0.00;
	$pdPercentCost = 0.00;
    if($totalAllcost > 0 ){
    	if($totalAllpr > 0){
			$prPercent = round(($totalAllpr /  $totalAllcost) * 100,2); //percentage to total cost of projects  #100
			$poPercentPR = round(($totalAllpo /  $totalAllpr) * 100,2); //percentage to total pr of projects  50%
			$poPercentCost = round(($prPercent * $poPercentPR)/100,2) ; // percentage to total cost of projects  25%
		}
    	if($totalAllpo > 0){
			$pxPercentPO = round(($totalAllpx /  $totalAllpo) * 100,2);
		}
    	if($totalAllpx > 0){
			$pxPercentCost = round(($totalAllpx /  $totalAllcost) * 100,2);
			$pdPercentPX = round(($totalAllpd /  $totalAllpx) * 100,2);
			$pdPercentCost = round(($totalAllpd /  $totalAllcost) * 100,2);
		}
		
		
		
		$sheet .= '<tr class = "summary1"><td colspan ="100%"></td></tr>';
		
		$sheet .= '<tr class = "summary1">
					<td colspan ="100%" style ="background-color:rgb(79, 94, 105);color:white;" > 
						<table class = "graph" style ="color:white;width:100%;white-space:nowrap;border-spacing:0;" border ="0">
							<tr style ="">
								<td  style =""></td>
								<td style ="text-align:center;">Total</td>
								<td style ="border-bottom:1px solid black;" >Trans</td>
								<td style ="border-bottom:1px solid black;" >Percentage</td>
								<td  style ="border-bottom:1px solid black;"></td>	
							</tr>
							<tr>
								<td  style ="width:1%;background-color:rgb(30, 96, 21);">Disaster Projects</td>
								<td style ="background-color:rgb(51, 61, 49);text-align:left;font-size:16px;font-weight:bold;color:orange;">' .  number_format($totalAllcost,2) . '</td>
								<td  style ="background-color:rgb(51, 61, 49);">' . $projectCount . '</td>	
								<td  style ="background-color:rgb(51, 61, 49);"></td>	
								<td style ="width:100%;vertical-align:top;background-color:rgb(32, 32, 40);border:0;padding-left:2px;"><hr style ="border:5px solid rgb(84, 184, 89);width:100%;box-shadow:0px 0px 2px grey;">	
								</td>	
							</tr>
							<tr>
								<td>PR Created</td>
								<td style ="">' .  number_format($totalAllpr,2) . '</td>
								<td style ="">' .  $prCountAll . '</td>
								<td style ="">' . $prPercent . ' <span style ="color:orange;">%</span></td>	
								<td style ="">
									<div style = "height:10px;width:' . $prPercent . '%;background-color:white;"></div>
								</td>
							</tr>
							<tr>
								<td>PO Created</td>
								<td style ="">' .  number_format($totalAllpo,2) . '</td>
								<td style ="">' .  $poCountAll . '</td>
								<td style ="">' . $poPercentPR  . ' <span style ="color:orange;">%</span></td>	
								<td style ="">
									<div style = "height:10px;width:' . $poPercentCost . '%;background-color:white;"></div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td style ="">' . $poPercentCost . ' <span style ="color:orange;">%</span></td>	
								<td style ="">
									<div style = "height:10px;width:' . $poPercentCost . '%;background-color:rgb(84, 184, 89);"></div>
								</td>
							</tr>
							<tr>
								<td>Payment Ongoing</td>
								<td style =" ">' .  number_format($totalAllpx,2) . '</td>	
								<td style =" ">' .  $pxCountAll . '</td>
								<td style =" ">' . $pxPercentPO . ' <span style ="color:orange;">%</span></td>	
								<td style ="">
									
									<div style = "height:10px;width:' . $pxPercentCost . '%;background-color:white;"></div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td ></td>	
								<td style =" " >' . $pxPercentCost  .' <span style ="color:orange;">%</span></td>	
								<td style ="">
									<div style = "height:10px;width:' . $pxPercentCost . '%;background-color:rgb(84, 184, 89);"></div>
								</td>
							</tr>
							<tr>
								<td>Paid Payment </td>
								<td style =" ">' .  number_format($totalAllpd,2) . '</td>	
								<td style =" ">' .  $pdCountAll . '</td>
								<td style =" ">' . $pdPercentPX .  ' <span style ="color:orange;">%</span></td>	
								<td style ="">
									<div style = "height:10px;width:' . $pdPercentCost . '%;background-color:rgb(246, 113, 151);"></div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td ></td>	
								<td style =" " >' . $pdPercentCost  .' <span style ="color:orange;">%</span></td>	
								<td style ="">
									<div style = "height:10px;width:' . $pdPercentCost . '%;background-color:rgb(84, 184, 89);"></div>
								</td>
							</tr>
							<tr>
								<td colspan ="90%" style ="background-color:rgb(19, 21, 28);padding:5px;"></td>
							</tr>
						</table>
						
					</td>
					
			   </tr>';					  
		$sheet .= '</table>';	
	}

?>
<style>
	body{
		padding:0;
		margin:0;	
	}
	@font-face{
			font-family: Oxy;
			//src: url(fonts/Roboto-Light.ttf);
			//src: url(../fonts/Armata-Regular.ttf);
			//src: url(../fonts/Monda-Regular.ttf);
			//src: url(../fonts/Kameron-Regular.ttf);
			src: url(../fonts/Oxygen-Regular.ttf);
			
			
		}
	@font-face{
		font-family: NOR;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Abel-Regular.ttf);
	}
	@font-face{
		font-family: Anton;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Anton-Regular.ttf);
	}
	body{
		font-family: nor;
		
	}
	th{
		font-size: 12px;
	}
	th.rotate {
	  /* Something you can count on */
		height: 186px;
		white-space: nowrap;
	}
	th.rotate > div {
		transform: 
		/* Magic Numbers */
		translate(6px, 80px)
		/* 45 is really 360 - 45 */
		/* rotate(315deg);*/
		rotate(290deg);
		width: 20px;
		float:right;
	}
	th.rotate > div > span {
		//border-bottom: 1px solid grey;
		font-size: 14px;
		font-weight: normal;
	}
	.chargeTotalRow{
		background-color:rgb(223, 224, 208);
	}
	.label{
		display: block;
		white-space: nowrap;
		font-size: 12px;
		color:white;
		font-weight: bold;
		font-family:nor;
		color:white;
		text-align:right; 
		background-color:rgb(93, 81, 14);
		padding:2px 5px;
	}
	.dropOffice{
		//background-color:red;
	}
	.tdSame{
		display: none;
	}
	.tdSameShow{
		display: table-row;
	}
	.graph  td{
		padding:0px 10px;
		text-align: right;
	}
	
	.graph tr > td:nth-child(1){
		background-color: rgb(48, 65, 75);
		border-bottom:1px solid rgb(78, 85, 95);
		border-right:1px solid black; 
		
	}
	.graph tr > td:nth-child(2){
		background-color: rgb(9, 23, 43);
		border-bottom:1px solid rgb(34, 51, 78); 
	}
	.graph tr > td:nth-child(3){
		background-color: rgb(43, 139, 223);
		border-bottom:1px solid rgb(141, 189, 231); 
		border-left:1px solid black; 
		text-align:center;
	}
	.graph tr > td:nth-child(4){
		
		border-bottom:1px solid rgb(65, 135, 196); 
		border-right:1px solid black; 
		background-color: rgb(11, 74, 134);
		
	}
	.graph tr > td:nth-child(5){
		padding-left:2px;
		background-color:rgb(32, 32, 40);
		
	}
	.graph tr:first-child>td {
		background-color: rgb(229, 231, 239);
		border-top:2px solid white;
		color:black;
		padding:2px 10px;
		font-weight:bold;
	}
	.highlight:hover{
		background-color:red;
		cursor:pointer;
		color:white;
		padding:0px 5px;
		font-weight: normal;
		transition: all .1s ease-in;
		box-shadow: 0px 0px 10px 0px silver;
	}
	.tools{
		display:no1ne;
	}
	.logo{
		background:url(../images/davaologo.png);
		background-position-x: -20px;
		width:100%;
		height:100%;
		position: absolute;
		z-index: -1;
		opacity: .03;
	}
	.logo1{
		background:url(../images/davao.png);
		background-size: 100%;
		background-repeat: no-repeat;
		margin-top:-9px;
		margin-left:7px;
		border-radius: 50%;
		box-shadow: 0px 0px 10px 0px grey;
		border:1px solid silver;
		width:50px;
		height:50px;
		position: absolute;
	}
	.pendingsTable{
		display:none;
	}
	.pendings{
		background: linear-gradient(to right, rgba(253, 250, 250,.5) ,white);
		padding:15px 15px;
		padding-right:5px;
		box-shadow:0px 0px 10px 5px rgba(0, 0, 0,.2);
		float:right;
		font-size:12px;
		width:200px;
		margin:5px 0px;
		text-align: right;
		border-top:3px dashed rgb(195, 115, 115);
	}
	.selectF{
		background-color:transparent;border:0;color:silver;width:100px;
	}
	.header{
		padding-left:10px;
		border-bottom:1px solid rgb(66, 101, 141);
		color:white; 
		font-size:10px;
		font-family: nor;
		//font-weight:bold;
		letter-spacing:1px;
		white-space: nowrap;
	}
	.buttons{
		border:1px solid white;
		cursor:pointer;
		font-size:10px;
		width:90px;
		margin:0 auto;
	}
	.completed{
		padding:2px;
		text-align:center;
		margin:2px;
		border-bottom:1px solid black;
		color:green;
	}
	.ongoing{
		padding:2px;
		text-align:center;
		margin:2px;
		border-bottom:1px solid grey;
	}
</style>
<html>
	<title>2023 City Disaster Projects</title>
	<link rel="icon" href="/citydoc2023/images/green.png"/> 
</html>

<div style ="background: linear-gradient(to left, transparent ,rgb(35, 85, 131));padding:1px;border-bottom: 1px solid rgb(32, 71, 115);border-top: 1px solid rgba(35, 85, 131,.2);box-shadow:0px 0px 10px 1px white;margin-top:5px;">
	<div class ="logo"></div>
	<div class ="logo1"></div>
	<table style ="border-spacing:0;line-height: 14px;font-family: monda;color:white;padding-left:62px;" border ="0">
		<tr>
			<td rowspan ="2">
				<span style ="font-family: anton;font-size:22px;color:white;background: linear-gradient(to right,black,rgb(86, 105, 124));border-right:1px solid white;padding-right:15px;padding-left:20px;">CITY DISASTER <span style ="color:red;">2023</span> PROJECT MONITORING SYSTEM</span>
			</td>
			<td>Davao City</td>
		</tr>
		<tr>
			<td style ="font-size:12px;color:white;line-height:10px;padding-bottom: 5px;">Document Tracking System</td>
		</tr>
	</table>
</div>
<table style="width:100%;border-spacing: 0;" border="0">
	<tr class ="tools" style = "background-color:rgb(26, 30, 34);">
		<td rowspan ="2" style ="padding-left:60px;"></td>
		<td colspan="100%" style ="padding:10px;"></td>
	</tr>
	<tr class ="tools" style = "background-color:rgb(26, 30, 34);">
		<td style = "width:1%;vertical-align:top;">
			<table style = "border-spacing:0;" border ="0">
				<tr>
					<td colspan="2" class ="header" >DATA ARRANGEMENT</td>
				</tr>	
				<tr style ="background: linear-gradient(to left, transparent ,rgb(1, 73, 104));">
					<td style ="border-bottom:1px solid rgb(24, 63, 80);"><div class ="label">Sort&nbsp;By</div></td>
					<td style ="border-bottom:1px solid rgb(24, 63, 80);">
						<select id  = "sortBy" onchange="goQuery()" class ="selectF" >
							<?php
								echo $selectSortBy;
							?>
						</select>
					</td>
				</tr>
				<tr style ="background: linear-gradient(to left, transparent ,rgb(1, 73, 104));">
					<td style ="border-bottom:1px solid rgb(24, 63, 80);"> <div class ="label">Order</div></td>
					<td style ="border-bottom:1px solid rgb(24, 63, 80);">
						<select id  = "orderBy"  class ="selectF" onchange="goQuery()" >
							<?php
								echo $selectOrder;
							?>	
						</select>
					</td>
				</tr>
			</table>
		</td>
		<td style = "width:1%;vertical-align:top;padding-left:20px;">
			<table style ="border-spacing: 0;">
				<td colspan ="2" class ="header">OFFICE&nbsp;FILTERS</td>
				<tr style ="background: linear-gradient(to left, transparent ,rgb(1, 73, 104));">
					<td  style ="border-bottom:1px solid rgb(24, 63, 80);"><span class ="label" >Implementing Office</span></td>
					<td style ="border-bottom:1px solid rgb(24, 63, 80);">
						<select  id = "selectOffice" onchange ="goQuery()"  class ="selectF" style ="width: 275px;" >
							<?php
								echo $optionOffice;
							?>
						</select>
					</td>
				</tr>
				<tr style ="background: linear-gradient(to left, transparent ,rgb(1, 73, 104));">
					<td  style ="border-bottom:1px solid rgb(24, 63, 80);"><span class ="label" >Regulatory Office</span></td>
					<td style ="border-bottom:1px solid rgb(24, 63, 80);">
						<select id ="selectRegulatory"  onchange ="goRegulatory(this)" class ="selectF"  style ="width: 275px;">
							<option>ALL</option>
							<option>Bids and Awards Committee</option>
							<option>City Accountant's Office</option>
							<option>City Administrator's Office</option>
							<option>City Budget Office</option>
							<option>City Treasurer's Office</option>
							<option>General Service Office</option>
						</select>
					</td>
					
				</tr>
			</table>
		</td>
		
		<td style ="width:1%;vertical-align:top;padding-left:20px;">
			<table style ="border-spacing: 0;">
				<td colspan ="2"class ="header">TRANSACTION&nbsp;FILTERS</td>
				<tr style ="background: linear-gradient(to left, transparent ,rgb(1, 73, 104));">
					<td  style ="border-bottom:1px solid rgb(24, 63, 80);"><span class ="label" >Transaction Type</span></td>
					<td style ="border-bottom:1px solid rgb(24, 63, 80);">
						<select id = "ctrType" onchange = "goQuery()" class ="selectF"  style ="width: 75px;" >
							<?php
								echo $ctrTypeOption;
							?>
						</select>
					</td>
				</tr>
				<tr style ="background: linear-gradient(to left, transparent ,rgb(1, 73, 104));">
					<td style ="border-bottom:1px solid rgb(24, 63, 80);"><span class ="label" >Delayed Days</span></td>
					<td style ="border-bottom:1px solid rgb(24, 63, 80);">
						<select id = "ctrFrm" onchange = "goQuery()" class ="selectF"  style ="width: 75px" >
							<?php
								echo $ctrFrmOption;
							?>
						</select>
					</td>
				</tr>	
				<tr style ="background: linear-gradient(to left, transparent ,rgb(1, 73, 104));">
					<td style ="border-bottom:1px solid rgb(24, 63, 80);"><span class ="label" >Show Projects</span></td>
					<td style ="border-bottom:1px solid rgb(24, 63, 80);">
						<select id ="viewProject"  onchange = "goQuery()" class ="selectF" style ="width: 75px" >
							<?php
								echo $optionViewProjects;
							?>
						</select>
					</td>
				</tr>
			</table>
		</td>
		
		<td style="vertical-align:top;padding-left:20px;">
			<table style="border-spacing: 0;" id ="percentageTable" border ="0">
				<tr>
					<td class ="header">PROGRESS FILTERS</td>
				</tr>
				<tr>
					<td style ="border-bottom:1px solid rgb(24, 63, 80);background: linear-gradient(to left, transparent ,rgb(1, 73, 104));">
						<table id = "prTablePercentage" style ="color:silver;border-spacing;font-size:12px;" >
							<tr style = "color:silver;">
								<td><span class ="label">PR</span></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="pr10"><label for ="pr10">10%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="pr25"><label for ="pr25">25%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="pr50"><label for ="pr50">50%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="pr75"><label for ="pr75">75%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="pr100"><label for ="pr100">100%</label></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td  style ="border-bottom:1px solid rgb(24, 63, 80);background: linear-gradient(to left, transparent ,rgb(1, 73, 104));">
						<table id = "poTablePercentage" style ="color:white;border-spacing;font-size:12px;" >
							<tr style = "color:silver;">
								<td > <span class ="label">PO</span></td>
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="po10"><label for ="po10">10%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="po25"><label for ="po25">25%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="po50"><label for ="po50">50%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="po75"><label for ="po75">75%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="po100"><label for ="po100">100%</label></td>	
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td   style ="border-bottom:1px solid rgb(24, 63, 80);background: linear-gradient(to left, transparent ,rgb(1, 73, 104));">
						<table id = "pxTablePercentage" style ="color:white;border-spacing;font-size:12px;" >
							<tr style = "color:silver;">
								<td > <span class ="label">PY</span></td>
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="px10"><label for ="px10">10%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="px25"><label for ="px25">25%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="px50"><label for ="px50">50%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="px75"><label for ="px75">75%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="px100"><label for ="px100">100%</label></td>	
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		
		<td style ="width:10%;background: linear-gradient(to right, transparent ,rgb(1, 73, 104));">
			<table style="margin:0 auto;">
				<tr>
					<td class ="header" STYLE ="text-align:center;">DISPLAY TOOLS</td>
				</tr>
				<tr>
					<td style ="padding:5px 10px;"><input type ="button" class ="buttons"  onclick="checkDetails(this)"   value ="Hide Details"/></td>
				</tr>
				<tr>
					<td style ="padding:0px 10px;"><input type ="button" class ="buttons" style ="" onclick ="showNotes(this)" value ="Show Notes"/></td>
				</tr>
				<tr>
					<td style ="padding:5px 10px;"><input type ="button" class ="buttons"  onclick ="reset()" value ="Reset Filters"/></td>
				</tr>
			</table>
		</td>
		
	</tr>
	<tr class ="tools">
		<td colspan="100%" style ="background-color:rgb(26, 30, 34);width:100%;padding:20px 0px;">
		
			
		</td>
	</tr>
	<tr style ="background-color:rgb(243, 247, 248);background: linear-gradient(to left, transparent ,rgb(231, 235, 229)">
		<td colspan="100%" style = "padding:10px;" >
			<?php
				echo $sheet;
			?>
		</td>
	</tr>
	<tr id ="footerInfra">
		<td style ="opacity:.7;padding-top:10px;" colspan="100%">
			<div style = "text-align: center;font-size: 10px;letter-spacing:1px;">Document Tracking System <span style ="color:white;background-color:rgb(186, 191, 188);padding:0px 5px;"> 2023</span></div>
			<div style = "text-align: center;font-size: 8px;letter-spacing:1px;color:silver;">Created By : Val G. Balangue</div>
		</td>
	</tr>
	
</table>
<script>
    var show = 1;
	window.onkeyup = function(e){
		if (e.keyCode == 27) {
			var arr = document.getElementsByClassName("tools");
			if(show == 1){
				for(var i = 0 ; i < arr.length; i++ ){
					arr[i].style.display ="none";
				}
				show = 0;
			}else{
				for(var i = 0 ; i < arr.length; i++ ){
					arr[i].style.display ="table-row";
				}
				show = 1;
			}
		}
	}
	var flagNotes = 0;
	function showNotes(me){
		var arr = document.getElementsByClassName("pendingsTable");
		var x = 0;
		for(var i = 0 ; i < arr.length; i++){
			arr[i].style.display ="table";
		}
		if(flagNotes == 0){
			for(var i = 0 ; i < arr.length; i++){
				arr[i].style.display ="table";
			}	
			flagNotes = 1;
			me.value = "Hide Notes";
		}else{
			for(var i = 0 ; i < arr.length; i++){
				arr[i].style.display ="none";
			}	
			flagNotes = 0;
			me.value = "Show Notes";
		}
	}
	function reset(){
		setSelectedIndex(ctrType, "PR");
		setSelectedIndex(ctrFrm, "1");
		setSelectedIndex(selectRegulatory, "ALL");
		setSelectedIndex(selectOffice, "ALL");
		setSelectedIndex(orderBy, "Ascending");
		setSelectedIndex(sortBy, "Project Id");
		setSelectedIndex(viewProject, "ALL");	
		
		resetCheckPercentage();
		goQuery();
	}
	function resetCheckPercentage(id){
		var arr = document.getElementById("percentageTable");
		var arr1 = arr.getElementsByTagName("input");
		
		for(var i = 0; i < arr1.length; i++){
			if(arr1[i].checked == true){
				if(id){
					var ob  =arr1[i].parentNode.parentNode.parentNode.parentNode.id;
					if(ob !=  id.toString()){
						arr1[i].parentNode.children[1].style.color = "grey";
						arr1[i].parentNode.children[1].style.fontWeight = "normal";
						arr1[i].checked = false;
					}
				}else{
					arr1[i].parentNode.children[1].style.color = "grey";
					arr1[i].parentNode.children[1].style.fontWeight = "normal";
					arr1[i].checked = false;
				}
				
			}
		}
	}
	function gotoPRdetails(me){
		var tn = me.textContent.trim();
		window.open('../interface/formPRnew.php?tn='+ tn, '_blank');
	}
	function gotoPOdetails(me){
		var tn = me.textContent.trim();
		window.open('../interface/formPO.php?tn='+ tn, '_blank');
	}
	function gotoPXdetails(me){
		var tn = me.textContent.trim();
		window.open('../interface/formDVgoods.php?trackingNumber='+ tn, '_blank');
	}
	function viewHideSummary(state){
		var  cls = document.getElementsByClassName("summary1");
		for(var i = 0; i < cls.length; i++){
			if(state == 1){
				cls[i].style.display = "none";
			}else{
				cls[i].style.display = "table-row";	
			}
		}
	}
	function showPercentage(me){
		var type = me.id.substring(0,2);
		if(type == "pr"){
			resetCheckPercentage("prTablePercentage");
			var arr = document.getElementById("prTablePercentage").children[0].getElementsByTagName("input");
			var classCompletion = "prCompletion";
			completionType(arr,classCompletion);
		}else if(type == "po"){
			resetCheckPercentage("poTablePercentage");
			var arr = document.getElementById("poTablePercentage").children[0].getElementsByTagName("input");
			var classCompletion = "poCompletion";
			completionType(arr,classCompletion);
		}else if(type == "px"){
			resetCheckPercentage("pxTablePercentage");
			var arr = document.getElementById("pxTablePercentage").children[0].getElementsByTagName("input");
			var classCompletion = "pxCompletion";
			completionType(arr,classCompletion);
		}
	}
	function completionType(arr,classCompletion){
		var firstFilter = 0;
		var lastFilter = 0;
		for(var i = 0; i < arr.length;i++){
			if(arr[i].checked == true){
				if(firstFilter == 0){
					firstFilter = parseInt(arr[i].id.substring(2));
				}
				lastFilter = parseInt(arr[i].id.substring(2));
				
				arr[i].parentNode.children[1].style.color = "orange";
				arr[i].parentNode.children[1].style.fontWeight = "bold";
				arr[i].parentNode.children[1].style.fontSize = "14px";
				
			}else{
				arr[i].parentNode.children[1].style.color = "silver";
				arr[i].parentNode.children[1].style.fontWeight = "normal";
				arr[i].parentNode.children[1].style.fontSize = "12px";
			}
		}
		
		var parent = document.getElementById("tableMain").children[0];
		for(var i = 4 ; i < parent.children.length; i++){
			var tr = parent.children[i];
			if(firstFilter > 0){
				if(tr.getElementsByClassName(classCompletion)[0]){
					var trPercentage = parseInt(tr.getElementsByClassName(classCompletion)[0].textContent.trim());
					//alert(trPercentage);
					if(firstFilter == lastFilter){
						
						if(trPercentage >= firstFilter){
							tr.style.display = "table-row";
						}else{
							tr.style.display = "none";
						}
					}else{
						if(trPercentage >= firstFilter && trPercentage <= lastFilter ){
							tr.style.display = "table-row";
						}else{
							tr.style.display = "none";
						}
					}
				}else{
					tr.style.display = "none";
				}
			}else{
				tr.style.display = "table-row";
			}
		}
	}
	function goRegulatory(me){
		var type = ctrType.value;
		
		var regu  = me.value;
		if(type == "PR"){
			var arr = document.getElementsByClassName("dropOfficePR");
		}else if(type == "PO"){
			var arr = document.getElementsByClassName("dropOfficePO");
		}else if(type == "PX"){
			var arr = document.getElementsByClassName("dropOfficePX");
		}
		for(var i = 0; i < arr.length; i++){
			var parent = arr[i].parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
			if(regu =="ALL"){
				parent.style.display = 'table-row';
				showHideSame(0);
				viewHideSummary(2);
			}else{
				if(arr[i].textContent == regu){
					parent.style.display = 'table-row';
					showHideSame(1);
				}else{
					parent.style.display = 'none';
				}
				viewHideSummary(1);
			}
		}
	}
	function showHideSame(state){
		var arr = document.getElementsByClassName("tdSame");
		for(var i = 0 ; i < arr.length; i++){
			if(state == 1){
				arr[i].style.display = "block";
			}else{
				arr[i].style.display = "none";
				
			}
		}
	}
	function goQuery(){
		var regulatory =  selectRegulatory.value.trim();
		var frm = ctrFrm.value;
		var ctrTypeValue = ctrType.value;
		var sortby = sortBy.value.trim();
		var order = orderBy.value.trim();
		var selectedOffice = selectOffice.value.trim();
		var viewProj = viewProject.value.trim();
		
		var formData = new FormData();
		formData.append('sort',sortby );
		formData.append('order', order);
		formData.append('selectedOffice', selectedOffice);
		formData.append('ctrFrm', frm);
		formData.append('ctrType', ctrTypeValue);
		formData.append('regulatory', regulatory);
		formData.append('projectView', viewProj);
		
		
		ajaxFormUpload(formData, window.location.href, '1');
	}
	function ajaxFormUpload(formData,processorLink,ajaxType){
		var xhr = new XMLHttpRequest();
		xhr.open('POST',processorLink, true);
		xhr.onload = function (){
			if (xhr.status === 200) {
				var result = xhr.responseText.trim();
				if(ajaxType == "1"){
					document.body.innerHTML = result;
				}else{
					alert("Ajax type variable undefined.");
				}
			}else {
				alert('An error occurred!');
			}
		};
		xhr.send(formData);
	}
	var flagDetails = 1;
	function checkDetails(me){
		/*if(me.checked == false){
			var sh = "none";
			viewHideSummary(1);
		}else{
			var sh = "table-row";
			viewHideSummary(2);
		}*/
		if(flagDetails== 1){
			var sh = "none";
			flagDetails = 0;
			viewHideSummary(1);
			me.value ="Show Details";
		}else{
			var sh = "table-row";
			flagDetails = 1;
			viewHideSummary(2);
			
			me.value ="Hide Details";
		}
		var arr = document.getElementsByClassName("trDetails");
		for(var i = 0 ; i < arr.length; i++){
			arr[i].style.display = sh;
		}
	}
	
</script>


