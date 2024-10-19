<?php	
	
	require_once('../javascript/ajaxFunction.php');
	require_once('../includes/database.php');
	
	
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
		$optionOffice .= '<option value = "' . $name . '">' .  $name . " (" . $counter . ")" . '</option>';
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
				$arrayStatusIdPR[$status] = $iCtrPR;
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
				$arrayStatusIdPO[$status] = $iCtrPO;
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
				$arrayStatusIdPX[$status] = $iCtrPX;
				$i++;
			}
		}
	}
	
	
	$sort1 = str_replace('a.','x.',$sort);		
	
	//prpopx
	$sql = "select x.*,
			y.TrackingNumber as PO_TrackingNumber,y.Status as PO_Status,y.DateModified as PO_DateModified,y.DateEncoded as PO_DateEncoded, y.PO_Amount as PO_Amount,y.TotalAmountMultiple as PO_TotalAmountMultiple,
			z.TrackingNumber as PX_TrackingNumber, z.Status as PX_Status,z.DateModified as PX_DateModified,z.DateEncoded as PX_DateEncoded, z.Amount as PX_Amount,z.TotalAmountMultiple as PX_TotalAmountMultiple
			from( SELECT a.Id,a.Office as OfficeCode,a.Name,a.ProjectCost,b.Name as Office,c.TrackingNumber ,c.Status,c.DateModified,c.Amount,c.PR_CategoryCode, c.TotalAmountMultiple,c.Fund,c.DateEncoded,d.Description as Category 
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
					<th></th>
				</tr>';			
					
				
	$sheet .= '<tr style = "text-align:right;background-color:rgb(75, 181, 247);color:white;">
					' . $guideColRow . '<th  style ="border-left:1px solid black;background-color:white;"></th>
					' . $guideColRowPO . '<th style ="border-left:1px solid black;background-color:white;"></th>
					' . $guideColRowPX . '<th style ="border-left:1px solid silver;background-color:white;" rowspan ="2"></th>
					
					</tr>';
	$sheet .= '<tr  style = "text-align:left;color:white;white-space:nowrap;  ">
					<th colspan ="' . (sizeof($arrayColumn)+2) .'" style = "padding:5px 10px;font-weight:normal;font-size:16px;border-top:1px solid grey;background-color:rgb(9, 50, 74);">Purchase Request Process</th>
					<th style ="border-left:1px solid black;"></th>
					<th colspan ="' . sizeof($arrayColumnPO) .'" style = "padding:5px 10px;font-weight:normal;font-size:16px;border-top:1px solid grey;background-color:rgb(9, 50, 74);">Purchase Order Process</th>
					<th style ="border-left:1px solid black;"></th>
					<th colspan ="' . sizeof($arrayColumnPX) .'" style = "padding:5px 10px;font-weight:normal;font-size:16px;border-top:1px solid grey;background-color:rgb(9, 50, 74);">Payment Process</th>
					
					
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
			$prCompletion  = '<span style ="font-size:10px;color:black;margin-right:5px;">' . $skey . '/'  .($iCtrPR-1) . '</span>' .  round(($skey /  ($iCtrPR-1)) * 100);
		}
		$tn =  $data['TrackingNumber'];
		$office =  $data['Office'];
		$category = $data['PR_CategoryCode'];
		$multiple = $data['TotalAmountMultiple'];
		$amount = $data['Amount'];
		
		
		$description = $data['Category'];
		$fund = $data['Fund'];
		$encoded = $data['DateEncoded'];
		
		$poTN = $data['PO_TrackingNumber'];
		$poStatus = $data['PO_Status'];
		$skeyPO = '';
		$poCompletion = '';
		if(isset($arrayStatusIdPO[$poStatus])){
			$skeyPO = $arrayStatusIdPO[$poStatus];
			$poCompletion  = '<span style ="font-size:10px;color:black;margin-right:5px;">' . $skeyPO . '/'  .($iCtrPO-1) . '</span>' . round(($skeyPO /  ($iCtrPO-1)) * 100);
		}
		
		$poDateModified = $data['PO_DateModified'];
		$poEncoded = $data['PO_DateEncoded'];
		$poAmount = $data['PO_Amount'];
		$poTotalAmountMultiple = $data['PO_TotalAmountMultiple'];
		if($poTotalAmountMultiple > 0){
			$poAmount = $poTotalAmountMultiple;
		}
		if($multiple > 0){
			$amount = $multiple;
		}
		$dateUpdated =  $data['DateModified'];
		$dateModifiedCount =  $database->ezDateDay($data['DateModified']);
		$dateModifiedCountPO =  $database->ezDateDay($poDateModified);
		
		
		$pxTN =  $data['PX_TrackingNumber'];
		$pxStatus =  $data['PX_Status'];
		$skeyPX = '';
		$pxCompletion = '';
		if(isset($arrayStatusIdPX[$pxStatus])){
			$skeyPX = $arrayStatusIdPX[$pxStatus];
			$pxCompletion  = '<span style ="font-size:10px;color:black;margin-right:5px;">' . $skeyPX . '/'  .($iCtrPX-1) . '</span>' . round(($skeyPX /  ($iCtrPX-1)) * 100);
		}
		
		$pxDateModified = $data['PX_DateModified'];
		$pxEncoded = $data['PX_DateEncoded'];
		
		$pxAmount = $data['PX_Amount'];
		
		
		
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
				$sheet1 = '<tr class ="summary1"><td colspan ="100%" style ="border-top:1px solid white;border-bottom:1px solid white;background-color:rgb(188, 207, 218);padding:20px;">
						  	<table border ="0" style ="float:right;border-spacing:0;width:80%;">
						  		<tr>
						  			<th style ="text-align:left;padding-right:10px;">Project Name :</th>
						  			<th style ="border-top:1px solid silver;text-align:right;border-left:1px solid grey;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);width:120px;">Purchase&nbsp;Request</th>
						  			<th style ="border-top:1px solid silver;text-align:right;border-lef:1px solid grey;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);">Purchase&nbsp;Order</th>
						  			<th style ="border-top:1px solid silver;text-align:right;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);">Payment</th>
						  			<th style ="border-top:1px solid silver;text-align:right;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);">Paid</th>
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
																<div style ="color:white;position:absolute; display:inline;font-weight:normal;font-size:20px; margin-left:-67px; margin-top:-36px;"><span class ="prCompletion">' .  $prCompletion  . '</span>%</div>
															</div>
															
															<div style ="width:13px;height:13px;display:inline-block;border: 2px solid white; background-color:' . $bulletColor . ';margin-right:-12px;border-radius:50%;margin-top:-35px;box-shadow:5px 0px 10px black;">
																
															</div>
														</td>
													</tr>
													<tr class = "trDetails">
														<td style ="text-align:right;padding:5px;">
															<div style = "line-height:13px;">
																<div>Created : '.  $encoded.   '</div>
																<div>' . $description . '</div>
																<div>' . number_format($amount,2) . '</div>
																<div style = "margin-top:7px;">' . $status. '<br> (<span class ="dropOfficePR">'  . $column['Office']. '</span>)</div>
																<div>Updated : '  . $dateUpdated . '</div>
																<div>'.  $dateModifiedCount.   '</div>
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
							<td style ="border-left:1px solid black;background-color:rgb(123, 172, 193);padding-left:1px;"></td>';
			}else{
				$sheet .= '<td style ="border-left:1px solid black;background-color:rgb(123, 172, 193);"></td>';
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
																<div style ="color:white;position:absolute; display:inline;font-weight:normal;font-size:20px; margin-left:-67px; margin-top:-36px;"><span class ="poCompletion">' .  $poCompletion  . '</span>%</div>
															</div>
															<div style ="width:13px;height:13px;display:inline-block;border: 2px solid rgb(96, 197, 108); background-color:' . $bulletColor . ';margin-right:-12px;border-radius:50%;margin-top:-35px;box-shadow:5px 0px 10px black;">
															</div>
														</td>
													</tr>
													<tr class = "trDetails">
														<td style ="text-align:right;padding:5px;">
															<div style = "line-height:13px;">
																<div>Created : '.  $poEncoded.   '</div>
																<div> '. number_format($poAmount,2).   '</div>
																<div style = "margin-top:7px;">' . $poStatus. '<br> (<span class ="dropOfficePO">'  . $column['OfficePO']. '</span>)</div>
																<div>Updated : '  . $poDateModified . '</div>
																<div>'.  $dateModifiedCountPO.   '</div>
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
				$sheet .= '<td colspan = "' .  (sizeof($arrayColumnPO)-$col)  . '" style ="text-align:right;"></td><td style ="border-left:1px solid black;background-color:rgb(123, 172, 193);"></td>
							';
			}else{
				$sheet .= '<td style ="border-left:1px solid black;background-color:rgb(123, 172, 193);"></td>';
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
																<div style ="color:white;position:absolute; display:inline;font-weight:normal;font-size:20px; margin-left:-78px; margin-top:-36px;"><span class ="pxCompletion">' .  $pxCompletion  . '</span>%</div>
															</div>
															<div style ="width:13px;height:13px;display:inline-block;border: 2px solid rgb(237, 168, 20); background-color:' . $bulletColor . ';margin-right:-12px;border-radius:50%;margin-top:-35px;box-shadow:5px 0px 10px black;">
															</div>
														</td>
													</tr>
													<tr class = "trDetails">
														<td style ="text-align:right;padding:5px;">
															<div style = "line-height:13px;">
																<div>Created : '.  $pxEncoded.   '</div>
																<div> '. number_format($pxAmount,2).   '</div>
																<div style = "margin-top:7px;">' . $pxStatus. '<br> (<span class ="dropOfficePX">'  . $column['OfficePO']. '</span>)</div>
																<div>Updated : '  . $pxDateModified . '</div>
																<div>'.  $dateModifiedCountPX.   '</div>
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
				$sheet .= '<td colspan = "' .  (sizeof($arrayColumnPX)-$col)  . '" style ="text-align:right;"></td><td style ="border-left:1px solid silver;background-color:white;"></td>
							';
			}else{
				$sheet .= '<td style ="border-left:1px solid silver;background-color:white;"></td>';
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
		$sheet .= '<tr class = "summary1"><td colspan ="100%" style ="border-top:1px solid white;border-bottom:1px solid white;background-color:rgb(188, 207, 218);padding:20px;">
						  	<table border ="0" style ="float:right;border-spacing:0;width:80%;">
						  		<tr>
						  			<th style ="text-align:left;padding-right:10px;">Project Name :</th>
						  			<th style ="text-align:right;border-left:1px solid grey;border-top:1px solid silver; border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);width:120px;">Purchase&nbsp;Request</th>
						  			<th style ="text-align:right;border-lef:1px solid grey;border-top:1px solid silver;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);">Purchase&nbsp;Order</th>
						  			<th style ="text-align:right;border-right:1px solid grey;border-top:1px solid silver;padding:0px 10px; background-color:rgb(244, 248, 251);">Payment</th>
						  			<th style ="text-align:right;border-right:1px solid grey;border-top:1px solid silver;padding:0px 10px; background-color:rgb(244, 248, 251);">Paid</th>
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
								<td style ="">' . $prPercent . '</td>	
								<td style ="">
									<div style = "height:10px;width:' . $prPercent . '%;background-color:white;"></div>
								</td>
							</tr>
							<tr>
								<td>PO Created</td>
								<td style ="">' .  number_format($totalAllpo,2) . '</td>
								<td style ="">' .  $poCountAll . '</td>
								<td style ="">' . $poPercentPR  . '</td>	
								<td style ="">
									<div style = "height:10px;width:' . $poPercentCost . '%;background-color:white;"></div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td style ="">' . $poPercentCost . '</td>	
								<td style ="">
									<div style = "height:10px;width:' . $poPercentCost . '%;background-color:rgb(84, 184, 89);"></div>
								</td>
							</tr>
							<tr>
								<td>Payment Ongoing</td>
								<td style =" ">' .  number_format($totalAllpx,2) . '</td>	
								<td style =" ">' .  $pxCountAll . '</td>
								<td style =" ">' . $pxPercentPO . '</td>	
								<td style ="">
									
									<div style = "height:10px;width:' . $pxPercentCost . '%;background-color:white;"></div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td ></td>	
								<td style =" " >' . $pxPercentCost  .'</td>	
								<td style ="">
									<div style = "height:10px;width:' . $pxPercentCost . '%;background-color:rgb(84, 184, 89);"></div>
								</td>
							</tr>
							<tr>
								<td>Paid Payment </td>
								<td style =" ">' .  number_format($totalAllpd,2) . '</td>	
								<td style =" ">' .  $pdCountAll . '</td>
								<td style =" ">' . $pdPercentPX .  '</td>	
								<td style ="">
									<div style = "height:10px;width:' . $pdPercentCost . '%;background-color:rgb(246, 113, 151);"></div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td ></td>	
								<td style =" " >' . $pdPercentCost  .'</td>	
								<td style ="">
									<div style = "height:10px;width:' . $pdPercentCost . '%;background-color:rgb(84, 184, 89);"></div>
								</td>
							</tr>
							<tr>
								<td colspan ="100%" style ="background-color:rgb(19, 21, 28);padding:5px;"></td>
							</tr>
						</table>
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
		font-family: NOR;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Abel-Regular.ttf);
	}
	body{
		font-family: NOR;
		
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
		color:white;
		font-weight: bold;
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
</style>

<table style=";width:100%;border-spacing: 0;" border="0">
	
	<tr class ="tools" style = "background-color:rgb(105, 123, 130);">
		<td style = "width:1%;">
			<table style = "float:right;">
				<tr>
					<td class ="label">Sort&nbsp;By</td>
					<td>
						<select id  = "sortBy" onchange="goQuery()">
							<?php
								echo $selectSortBy;
							?>
						</select>
					</td>
					<td  class ="label" >Order</td>
					<td>
						<select id  = "orderBy" onchange="goQuery()">
							<?php
								echo $selectOrder;
							?>	
						</select>
					</td>
				</tr>
			</table>
		</td>
		<td style = "width:1%;">
			<table>
				<tr>
					<td  class ="label" >Office</td>
					<td>
						<select  id = "selectOffice" onchange ="goQuery()" style ="width:200px;" >
							<?php
								echo $optionOffice;
							?>
						</select>
					</td>
					
				</tr>
			</table>
		</td>
		<td style = "width:1%;">
			<table>
				<tr>
					<td  class ="label" >Regulatory</td>
					<td>
						<select id ="selectRegulatory"  onchange ="goRegulatory(this)" style ="width:170px;" >
							<option>ALL</option>
							<option>Bids and Awards Committee</option>
							<option>City Accountant's Office</option>
							<option>City Administrator's Office</option>
							<option>City Budget Office</option>
							<option>City Engineer's Office</option>
							<option>City Treasurer's Office</option>
							<option>General Service Office</option>
						</select>
					</td>
					
				</tr>
			</table>
		</td>
		
		
		<td>
			<table style = "background-color:rgb(87, 101, 111);padding:0px 5px;">
				<tr >
					<td style ="color:orange">
						<select id = "ctrType" onchange = "goQuery()" style ="text-align: center;border:0;font-weight:bold;padding:0px 5px;">
							<?php
								echo $ctrTypeOption;
							?>
						</select>
					</td>
					<td style ="color:orange">In Progress Counter </td>
					<td style ="color:white;">
						<select id = "ctrFrm" onchange = "goQuery()" style ="text-align: center;border:0;font-weight:bold;padding:0px 5px;">
							<?php
								echo $ctrFrmOption;
							?>
						</select>
						<span style ="color:orange;">Days</span>
					</td>
				</tr>
			</table>
		</td>
		
		<td style ="width:1%;">
			<table border = "0"  style = "background-color:rgb(87, 101, 111);padding:0px 5px;">
				<tr>
					<td style ="color:orange">Show </td>
					<td>
						<select id ="viewProject"  style ="text-align: center;" onchange = "goQuery()">
							<?php
								echo $optionViewProjects;
							?>
						</select>
					</td>
					<td style ="color:orange">Projects </td>
				</tr>
			</table>
		</td>
		<td style ="width:1%;">
			<table>
				<tr>
					<td ><input type ="checkbox" id  = "showDetails" onclick="checkDetails(this)" checked></td>
					<td class = "label"><label for="showDetails">Show&nbsp;Details</label></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr class ="tools">
		<td colspan="100%" style ="background-color:rgb(46, 62, 82);width:100%;">
		
			<table style="border-spacing: 0;">
				<tr>
					<td>
						<table id = "prTablePercentage" style ="color:silver;border-spacing;font-size:12px;background-color:rgb(0, 0, 0);font-size: 16px;">
							<tr style = "color:silver;">
								<td style ="background-color: rgb(20, 74, 128);color:white;padding:0px 5px;font-size: 14px;">PR PROGRESS</td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="pr10"><label for ="pr10">10%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="pr25"><label for ="pr25">25%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="pr50"><label for ="pr50">50%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="pr75"><label for ="pr75">75%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="pr100"><label for ="pr100">100%</label></td>
							</tr>
						</table>
					</td>
					<td style ="padding-left:20px;">
						<table id = "poTablePercentage" style ="color:white;border-spacing;font-size:12px;font-size: 16px;">
							<tr style = "color:silver;">
								<td style ="background-color: rgb(20, 74, 128);color:white;padding:0px 5px;font-size: 14px;">PO PROGRESS</td>
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="po10"><label for ="po10">10%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="po25"><label for ="po25">25%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="po50"><label for ="po50">50%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="po75"><label for ="po75">75%</label></td>	
								<td><input type ="checkbox" onclick ="showPercentage(this)" id ="po100"><label for ="po100">100%</label></td>	
							</tr>
						</table>
					</td>
					<td  style ="padding-left:20px;">
						<table id = "pxTablePercentage" style ="color:white;border-spacing;font-size:12px;background-color:rgb(0, 0, 0);font-size: 16px;">
							<tr style = "color:silver;">
								<td style ="background-color: rgb(20, 74, 128);color:white;padding:0px 5px;font-size: 14px;">PY PROGRESS</td>	
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
	</tr>
	<tr style ="background-color:rgb(243, 247, 248);background: linear-gradient(to left, transparent ,rgb(231, 235, 229)">
		<td colspan="100%" >
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
			var arr = document.getElementById("prTablePercentage").children[0].getElementsByTagName("input");
			var classCompletion = "prCompletion";
			completionType(arr,classCompletion);
		}else if(type == "po"){
			var arr = document.getElementById("poTablePercentage").children[0].getElementsByTagName("input");
			var classCompletion = "poCompletion";
			completionType(arr,classCompletion);
		}else if(type == "px"){
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
				arr[i].parentNode.children[1].style.color = "grey";
				arr[i].parentNode.children[1].style.fontWeight = "normal";
			}
		}
		var parent = document.getElementById("tableMain").children[0];
		for(var i = 4 ; i < parent.children.length; i++){
			var tr = parent.children[i];
			if(firstFilter > 0){
				if(tr.getElementsByClassName(classCompletion)[0]){
					var trPercentage = parseInt(tr.getElementsByClassName(classCompletion)[0].textContent.trim());
					
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
	function checkDetails(me){
		if(me.checked == false){
			var sh = "none";
			viewHideSummary(1);
		}else{
			var sh = "table-row";
			viewHideSummary(2);
		}
		var arr = document.getElementsByClassName("trDetails");
		for(var i = 0 ; i < arr.length; i++){
			arr[i].style.display = sh;
		}
	}
	
</script>


