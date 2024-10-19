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
	
	if(isset($_POST['ctrFrm'])){
		
		
		$frm = $_POST['ctrFrm'];
		$ctrFrmOption = '<option>' . $frm . '</option>' . $ctrFrmOption;
		$filter2 = " and  DATEDIFF('" . $today . "', substr(c.DateModified,1,10)) >= " .  $frm ;
		if($frm == 1){
			$filter2 = '';
		}
		
	}else{
		$ctrFrmOption = '';
		for($i = 1 ; $i <= 60; $i++){
			$ctrFrmOption .= '<option>' . $i . '</option>';
		}
		$filter2 = '';
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
	$sql = "SELECT group_concat(distinct Status SEPARATOR '*') as Status FROM vouchercurrent where ProjectId != '' and TrackingType = 'PR' and Status like '%Pending%'";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$statuses = $data['Status'];
	
	$sql = "select * from status where type = 'PR'";
	$record = $database->query($sql);
	$statusRow = '<th colspan ="2"><div></div></th>';
	$guideColRow = '<th colspan ="2"></th>';
	
	$statusColor ='';
	$arrayColumn = [];
	$arrayStatusIdPR = [];
	$i = 1;
	$iCtrPR =0;
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
				$guideColRowPX .= '<th style ="padding:0px 3px;background-color:rgb(96, 197, 108);"></th>';
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
			left join ppmpcategories d on c.PR_CategoryCode = d.Code where a.Id > 0 " . $filter1 . $filter2 . ") x left join (select * from vouchercurrent where TrackingType = 'PO' and status != 'Cancelled' group by trackingnumber) y 
			on x.TrackingNumber = y.PR_TrackingNumber 
			left join (select * from vouchercurrent where TrackingType = 'PX' and status != 'Cancelled' group by trackingnumber) z

			on y.TrackingNumber = z.TrackingPartner

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
	$sheet .= '<tr style = "color:black;">' . $statusRow . '
					<th></th>' . $statusRowPO . '
					<th></th>' . $statusRowPX . '
				</tr>';
				
	$sheet .= '<tr style = "background-color:sil1ver;">
					<th colspan ="2" style ="padding:12px;"></th>
					' . $statusColor . '<th ></th>' . $statusColorPO . '<th></th>' . $statusColorPX .'
					<th></th>
				</tr>';			
					
				
	$sheet .= '<tr style = "text-align:right;background-color:rgb(75, 181, 247);color:white;">
					' . $guideColRow . '<th  style ="border-left:1px solid black;background-color:white;"></th>
					' . $guideColRowPO . '<th style ="border-left:1px solid black;background-color:white;"></th>
					' . $guideColRowPX . '<th style ="border-left:1px solid silver;background-color:white;" rowspan ="2"></th>
					
					</tr>';
	$sheet .= '<tr  style = "text-align:left;color:white;">
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
	
	
	$lastCost = 0;
	$lastProjectName = '';
	
	$lastPRcount = 0;
	$lastPOcount = 0;
	$lastPXcount = 0;
	$lastPDcount = 0;
	
	
	$totalPaid = 0;
	
	
	while($data = $database->fetch_array($record)){
		$id = $data['Id'];
		$name = trim($data['Name']);
		$cost = $data['ProjectCost'];
		$status = $data['Status'];
		
		$skey = '';
		$prCompletion = '';
		if(isset($arrayStatusIdPR[$status])){
			$skey = $arrayStatusIdPR[$status];
			$prCompletion  = round(($skey /  ($iCtrPR-1)) * 100);
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
			$poCompletion  = round(($skeyPO /  ($iCtrPO-1)) * 100);
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
			$pxCompletion  = round(($skeyPX /  ($iCtrPX-1)) * 100);
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
		if($flag > 0){
			if($lastName != $name){
				
				$paidPercent = 0.00;
				if($totalPX > 0){
					$paidPercent = round(($totalPaid / $totalPX) * 100,2);
				}else{
					$paidPercent = 0.00;
				}
				$sheet .= '<tr><td colspan ="100%" style ="border-top:1px solid white;border-bottom:1px solid white;background-color:rgb(188, 207, 218);padding:20px;">
						  	<table border ="0" style ="float:right;border-spacing:0;width:80%;">
						  		<tr>
						  			<th style ="text-align:left;padding-right:10px;">Project Name :</th>
						  			<th style ="text-align:right;border-left:1px solid grey;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);width:120px;">Purchase&nbsp;Request</th>
						  			<th style ="text-align:right;border-lef:1px solid grey;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);">Purchase&nbsp;Order</th>
						  			<th style ="text-align:right;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);">Payment</th>
						  			<th style ="text-align:right;border-right:1px solid grey;padding:0px 10px; background-color:rgb(244, 248, 251);">Paid</th>
						  		</tr>
						  		<tr style = "line-height:16px;">	
						  			<td style = "padding-right:20px;font-size:12px;">' . $lastProjectName . '</td>
						  			<td  style ="text-align:right;border-top:1px solid grey;border-left:1px solid grey;border-right:1px solid grey;border-bottom:1px solid grey;padding-right:10px;">' . $prCount . '</td>
						  			<td  style ="text-align:right;border-top:1px solid grey;border-right:1px solid grey;padding-right:10px;border-bottom:1px solid grey;">' . $lastPOcount . '</td>
						  			<td  style ="text-align:right;border-top:1px solid grey;border-right:1px solid grey;padding-right:10px;border-bottom:1px solid grey;">' . $pxCount . '</td>
						  			<th style ="text-align:right;border-right:1px solid grey;padding:0px 10px;border-right:1px solid grey;padding-right:10px;border-bottom:1px solid grey; ">' . $pdCount . '</th>
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
						  		<tr style ="color:green;line-height:11px;">
						  			<td style ="text-align:left;"></td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . round(($totalPR / $lastCost) * 100,2) . '%</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' . round(($totalPO / $lastCost) * 100,2) . '%</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;">' .  round(($totalPX / $lastCost) * 100,2) . '%</td>
						  			<td style ="text-align:right;font-weight:bold;padding:0px 10px;color:rgb(8, 105, 195);">' .  $paidPercent . '%</td>
						  			
						  		</tr>
						  	</table>
						  </td></tr>';
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
								<div  class = "tdSame" style ="font-size:12px;font-weight:bold;background-color:black;color:white;padding:3px;line-height:12px;box-shadow:0px 0px 1px 0px black;">' . $id  . '</div>
							</td>';
				$sheet .= '<td style = "width:300px;font-size:13px;vertical-align:top;padding:10px;padding-right:0px;">
								<div class = "tdSame" style ="background-color:rgba(251, 248, 248,.8);box-shadow:0px 0px 8px 1px rgb(135, 157, 174); padding:5px;border:4px solid white;">
									<div style = "font-weight:bold;">' . $name . '</div>
									<div>' . $fund .   '</div>
									<div>' . $office . '</div> 
									<div>' . number_format($cost,2) . '</div>
								</div>
							</td>';
				$totalPR +=  $amount;
				$totalPO +=  $poAmount;
				$totalPX +=  $pxAmount;
				
				
				
			}else{
				
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
									<div style = "font-weight:bold;">' . $name . '</div>
									<div>' . $fund . '</div>
									<div>' . $office . '</div> 
									<div>' . number_format($cost,2) . '</div>
								</div>
							</td>';
			}
			//------------------------------------------------------------------------------------td PR
			$col = 1;
			if($tn){
				$prCount++;
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
										$sheet .= '<table style ="float:right;width:100%;font-size:13px;padding-right:17px; margin-bottom:5px;margin-top:1px;color:' . $fontColor . '" border="0">';
									}	
						$sheet .= '					<tr>
														<td style = "text-align:right;" >
															<hr style = "border:3px solid rgb(243, 246, 248);margin-left:-5px; box-shadow:2px 0px 10px grey;">
															<div style = "line-height:12px;padding-top:5px;font-weight:bold;">'  . $tn .  '
																<div style ="color:white;position:absolute; display:inline;font-weight:normal;font-size:20px; margin-left:-44px; margin-top:-36px;"><span class ="prCompletion">' .  $prCompletion  . '</span>%</div>
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
																<div style = "margin-top:7px;">' . $status. '<br> (<span class ="dropOffice">'  . $column['Office']. '</span>)</div>
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
															<div style = "line-height:12px;padding-top:5px;font-weight:bold;">' . $poTN . '
																<div style ="color:white;position:absolute; display:inline;font-weight:normal;font-size:20px; margin-left:-44px; margin-top:-36px;"><span class ="poCompletion">' .  $poCompletion  . '</span>%</div>
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
																<div style = "margin-top:7px;">' . $poStatus. '<br> (<span class ="dropOffice">'  . $column['OfficePO']. '</span>)</div>
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
				
				if($pxStatus == "Check Released"){
					$pdCount++;
					$totalPaid += $pxAmount;
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
															<div style = "line-height:12px;padding-top:5px;font-weight:bold;">' . $pxTN . '
																<div style ="color:white;position:absolute; display:inline;font-weight:normal;font-size:20px; margin-left:-44px; margin-top:-36px;"><span class ="pxCompletion">' .  $pxCompletion  . '</span>%</div>
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
																<div style = "margin-top:7px;">' . $pxStatus. '<br> (<span class ="dropOffice">'  . $column['OfficePO']. '</span>)</div>
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
	$sheet .= '</table>';
	
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
	

</style>

<table style=";width:100%;border-spacing: 0;" border="0">
	
	<tr style = "background-color:rgb(105, 123, 130);">
		<td>
			<table style = "float:right;">
				<tr>
					<td class ="label">Sort By</td>
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
		<td style = "width:1px;">
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
		<td style = "width:1px;">
			<table>
				<tr>
					<td  class ="label" >Regulatory</td>
					<td>
						<select id ="selectRegulatory"  onchange ="goRegulatory(this)" style ="width:200px;" >
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
			<table>
				<tr>
					<td ><input type ="checkbox" id  = "showDetails" onclick="checkDetails(this)" checked></td>
					<td class = "label"><label for="showDetails">Show Details</label></td>
				</tr>
			</table>
		</td>
		<td>
			<table style = "background-color:rgb(87, 101, 111);padding:0px 5px;">
				<tr >
					<td style ="color:orange">In Progress Counter </td>
					<td style ="color:white;">
						<select id = "ctrFrm" onchange = "goQuery()" style ="text-align: center;">
							<?php
								echo $ctrFrmOption;
							?>
						</select>
						<span style ="color:orange;">Days</span>
					</td>
				</tr>
			</table>
		</td>
		<td>
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
	</tr>
	<tr>
		<td colspan="100%" style ="background-color:rgb(46, 62, 82);">
		
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
	<tr>
		<td colspan="100%">
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
		var regu  = me.value;
		var arr = document.getElementsByClassName("dropOffice");
		for(var i = 0; i < arr.length; i++){
			var parent = arr[i].parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
			if(regu =="ALL"){
				parent.style.display = 'table-row';
				showHideSame(0);
			}else{
				if(arr[i].textContent == regu){
					parent.style.display = 'table-row';
					showHideSame(1);
				}else{
					parent.style.display = 'none';
				}
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
		var sortby = sortBy.value.trim();
		var order = orderBy.value.trim();
		var selectedOffice = selectOffice.value.trim();
		var viewProj = viewProject.value.trim();
		
		var formData = new FormData();
		formData.append('sort',sortby );
		formData.append('order', order);
		formData.append('selectedOffice', selectedOffice);
		formData.append('ctrFrm', frm);
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
		}else{
			var sh = "table-row";
		}
		var arr = document.getElementsByClassName("trDetails");
		for(var i = 0 ; i < arr.length; i++){
			arr[i].style.display = sh;
		}
	}
	/*function showProject(type){
		
		
		
		var parent = document.getElementById("tableMain");
		if(type == 1){
			for(var i =  3; i < parent.children[0].children.length ; i++){
				var tr = parent.children[0].children[i];
				var details = tr.children[2];
				tr.style.display = "table-row";
			}
		}
		if(type == 2){
			for(var i =  3; i < parent.children[0].children.length ; i++){
				var tr = parent.children[0].children[i];
				var details = tr.children[2];
				if(details.children.length == 0){
					tr.style.display = "none";
				}else{
					tr.style.display = "table-row";
				}
			}
		}
		if(type == 3){
			for(var i =  3; i < parent.children[0].children.length ; i++){
				var tr = parent.children[0].children[i];
				/*if(tr.children.length == 4){
					
				}
				var details = tr.children[2];
				if(details.children.length == 0){
					tr.style.display = "table-row";
				}else{
					tr.style.display = "none";
				}
			}
		}
		

	}*/
</script>


