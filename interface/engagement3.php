
<style>
	body{
		padding:0;
		margin:0;
	}
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
		
		padding:0px 2px;
	
	}
	#table1 tr > th{
		
		padding:0px 2px;
	}
	#table1 tr > td:nth-child(even) {/* //column */
		background-color:rgba(108, 126, 132,.1);
		
	}
	
	#table1 tr > td:first-child {
		background-color:rgb(27, 54, 84);
		color:silver;
		padding:2px;
	}
	#table1 tr > td:nth-child(1) {
		text-align: center;
		
	}
	#table1 tr > td:nth-child(2) {
		background-color:rgb(20, 38, 59);
		color:silver;
		padding-left:10px;
		border-bottom: 1px solid rgb(1, 45, 78);
	}
	#table1 tr > td:nth-child(3) {
		background-color:rgb(8, 161, 250);
		width:180px;
		text-align: right;
		padding-right:10px;
		border-bottom: 1px solid rgb(17, 135, 226);
		
	}
	
	
	#table1 tr > td:nth-child(n+4) {
		
		border-bottom: 1px solid rgba(110, 162, 221,.1);
	}
	
	#table1 tr > td:last-child {
		background-color:rgba(5, 36, 52,.4);
		color:white;
		border-bottom: 1px solid rgba(30, 60, 88,.2);
	}
	
	#table1 tr:hover > td{	
		background-color:rgb(246, 204, 52);
		color:black;
		cursor:pointer;
		font-weight: bold;
	}
	
	#table2 tr:hover > td{
		
	}
	.selected{
		background-color:rgb(226, 137, 65);
		color:black;
		border-bottom:1px solid white;
		transition: all .6s ease-in;
	}
	.month{
		color:silver;
		cursor: pointer;
	}
	.month:hover{
		background-color:rgb(250, 211, 169);
		color:black;
		border-bottom:1px solid black;
		transition: all .6s ease-in;
	}
	/*#progress1{
		width: 10px;
		height: 100px;
		background: red;
		transition: width 2s;
	}
	#progress1:hover{
		width: 1000px;
		height: 100px;
		background: red;
		transition: width 2s;
	}*/
	
	.progress1{ 
	  width:0px;	 
	  height:5px;
	  animation-name: example;
	  animation-duration: 1s;
	  animation-delay: 0s;
	 animation-iteration-count: infinite;
	}
	@keyframes example {
	  0%   {background-color:grey;  }
	
	  50%  {background-color:silver; }
	
	  100% {background-color:white; width:100%;}
	}
</style>
<html>
	<title>Engagement</title>
</html>

<?php
		session_start();
		require_once("../includes/database.php");
		
		$order = 'employeenumber,name, status,datemodified asc';
		if(isset($_SESSION['officeCode'])){
			$office =  $_SESSION['officeCode']; 
			$sql = "select Code,Name from office where code = '" . $office . "' limit 1";
			$record = $database->query($sql);
			
			$data = $database->fetch_array($record);
			$officeName = $data['Name'];
			$officeCode = $data['Code'];
			$officeSelected = $officeCode;
		}else{
			$link = "<script>window.open('../../citydoc2023/interface/login.php','_self')</script>";
			echo $link;
		}
		
	 	if(isset($_POST['o'])){
			$order = $_POST['o'];
		}
		
		$unsort = 0;
		$icoBefore = '&#9655;';
		if(isset($_POST['i'])){
			if($_POST['i'] == 1){
				$icoBefore = '&#9650;';
			}else{
				$icoBefore = '&#9660;';
			}
			$unsort = $_POST['s'];
		}
		
		if(isset($_POST['m'])){
			$month =  ($_POST['m']+1);
			if($month < 10){
				$month = '0' . $month;
			}
		}else{
			$month = date('m');
			
		}
		
		$filter1 = ' and Officecode = "' . $officeCode . '"';
		if(isset($_POST['f'])){
			$officeSelected = $_POST['f'];
			$officeName = $_POST['n'];
			$filter1 = ' and Officecode = "' . $officeSelected . '"';
			if($officeSelected == 'All'){
				$filter1 = ' and Officecode != "tanan"';
			}
		}
		
		
		$user = 'ALL USERS';
		$filter2 = '';
		if(isset($_POST['u'])){
			$user = $_POST['u'];
			
			$filter2 = ' and modifiedby = "' . $officeSelected . '"';
			if($user == 'ALL USERS'){
				$filter2 = ' and modifiedby != "tanan"';
			}else{
				$filter1 = '';
				
				$arr = explode(',',$user);
				$lastname =  trim($arr[0]);
				$firstname = trim($arr[1]);
				$sql = "select EmployeeNumber from citydoc.employees where lastname = '" . $lastname . "' and firstname = '" . $firstname . "'";
				$record = $database->query($sql);
				
				$case  ='';
				while($data = $database->fetch_array($record)){
					$empNumber = $data['EmployeeNumber'];
					$case .= ",'" . $empNumber . "'";
				}
				
				$case =  substr($case,1,strlen($case));
				$filter2 = " and ModifiedBy in(" . $case  . ")";
			}
		}
		
		$status = "ALL STATUS";
		$filter3 = '';
		if(isset($_POST['st'])){
			$status = $_POST['st'];
			if($status != 'ALL STATUS'){
				$filter3 = " and Activity = '" . $status . "'";
			}
		}
		
		
		$dbYear ='<option>' . date('Y') .'</option>';
		$db = "citydoc" . date('Y');
		if(isset($_POST['db'])){
			$dbYear ='<option>' . $_POST['db'] .'</option>';
			$db = "citydoc" . $_POST['db']; 
		}
		
		
		
		
		if(isset($_POST['y'])){
			$year = $_POST['y'];
			$displayYear ='<option>' . $year .'</option>';
		}else{
			$year = date('Y');
			$displayYear = '';
		}
		$qDate =  $year . '-'. $month;
		
		$sql = "select * from office order by Name asc";
		$record = $database->query($sql);
		
		$optOffice ='<option value = "' . $officeSelected . '" onmouseup = "selectOffice(this)">' . $officeName  . '</option>';
		$optOffice .='<option value = "All" onmouseup = "selectOffice(this)">ALL OFFICE ACCOUNTS</option>';
		while($data = $database->fetch_array($record)){
			$name = $data['Name'];
			$code = $data['Code'];
			$optOffice .='<option value = "' . $code . '" onmouseup = "selectOffice(this)">' . $name  . '</option>';
		}
		$sql = "select a.* from (SELECT * FROM citydoc.employees  where officecode = '" . $officeCode . "') a inner join 
				(select * from $db.voucherhistory group by modifiedby) 
				b on a. employeenumber = b.modifiedby GROUP BY CONCAT(LastName,FirstName) order by LastName asc";
		$record = $database->query($sql);
		
		
		$employeeSelect = '<select id ="employeeSelected" style ="display:inline;width:20px;font-size:14px;font-family:nor;border:0;padding:0px;background-color:rgb(24, 92, 141);color:white;">';
		$employeeSelect .= '<option onclick ="selectEmployee(this)"  >' . $user . '</option>';
		$employeeSelect .= '<option onclick ="selectEmployee(this)"  >ALL USERS</option>';
		while($data = $database->fetch_array($record)){
			$lname = utf8_encode($data['LastName']);
			$fname = utf8_encode($data['FirstName']);
			$employeeSelect .= '<option onclick ="selectEmployee(this)">' .$lname .', ' . $fname . '</option>';
		}
		$employeeSelect .= '</select>';
		
		/*$sql = "select b.employeeNumber, b.OfficeCode ,Activity as Status,substr(DateModified,1,10) as Date, UPPER(concat(b.lastName,', ',b.firstname)) as  Name,sum(Count) as Counter from(            
					SELECT DateModified,Status as Activity,ModifiedBy, Count(Id) as Count FROM $db.voucherhistory 
					where substring(datemodified,1,7) =  '" . $qDate ."'   group by  ModifiedBy, substr(DateModified,1,10),Status) 
				a left join citydoc.employees b on CAST(a.ModifiedBy AS UNSIGNED)  = b.employeenumber where id > 1  " . $filter1 . $filter2 .  $filter3 . "  group by Name,substr(DateModified,1,10),status order by " . $order;*/
		
		
		
		$sql = " select b.employeeNumber, b.OfficeCode ,Activity as Status,substr(DateModified,1,10) as Date, UPPER(concat(b.lastName,', ',b.firstname)) as Name,sum(Count) as Counter  from(
				 SELECT DateModified,Status as Activity,ModifiedBy, Count(Id) as Count FROM $db.voucherhistory where substring(datemodified,1,7) = '" . $qDate ."' group by ModifiedBy, substr(DateModified,1,10),Status
				 union
				 SELECT substr(DateUpdated,1,10) as DateModified, Activity,UpdatedBy as ModifiedBy, count(Id) as Count FROM supplier.logs
				 where Year = '" . $year . "' and substr(DateUpdated,1,7) ='" . $qDate ."'
				 group by Activity,Updatedby,substr(DateUpdated,1,10) 
				 
				 
				 union
 				 SELECT substring(DateEncoded,1,10) as DateModified,'Check Encoded' as Activity,EncodedBy as ModifiedBy,count(Id) as Count FROM chequerist.encodedchecks where substring(DateEncoded,1,7) =  '" . $qDate ."' group by EncodedBy,substring(DateEncoded,1,10)
 					
				 union
				 SELECT DateUpdated as DateModified, Activity,EncodedBy as ModifiedBy,count(DateUpdated) as Counter FROM chequerist.actionlogs where substring(DateUpdated,1,7) =  '" . $qDate ."' group by Activity,EncodedBy,DateUpdated
				 
				 union
				 SELECT  substring(DateEntry,1,10)  as DateModified, 'Encoded Bills' as Activity,EncodedBy as ModifiedBy, Count(Id) as Counter FROM citybills.transactions where substring(DateEntry,1,7) =  '" . $qDate ."' group by EncodedBy, substring(DateEntry,1,10)
				 
				 ) as a
				 left join citydoc.employees b on CAST(a.ModifiedBy AS UNSIGNED) = b.employeenumber where id > 1 " . $filter1 . $filter2 .  $filter3 . "
				 group by Name,substr(DateModified,1,10),status order by  " . $order;
		
		
		$record = $database->query($sql);
		
		$sheet = '<table id = "table1" style = "border-spacing:0px;font-family:NOR;font-size:12px;border:1px solid silver;width:100%;padding:0;margin:0;" border = "0">';
		$sheet .= '<tr style = "background-color:rgb(24, 92, 141);">
						<th id ="engagementHeader" colspan = "100%" style ="text-align:center;font-family:oswald;font-size:14px;padding:10px;padding-left:30px;">
							<table id ="table2" style ="border-spacing:0px;width:100%;color:white;font-family:NOR;text-align:left;" border ="0">
								<tr>
									<th style = "line-height:20px;font-size:23px;font-weight:bold;border-bottom:1px solid rgb(14, 80, 127);padding-right:50px;">Monthly Doctrack User Engagement
										<table style ="float:right;font-size:12px;font-family:NOR;letter-spacing:1px;border-spacing:0;margin-right:50px;" border ="0">
											<tr>
												<th style ="font-size:12px;color:orange;">ACCOUNT OFFICE SELECTED</th>
												<th style ="padding-right:20px;">
													<span id = "s1" style ="color:white;font-size:14px;">' . $officeName . '</span>
													<select id ="selectOfficeId"  style = "display:inline;width:20px;font-size:14px;font-family:nor;border:0;padding:0px;background-color:rgb(24, 92, 141);color:white;">';
													$sheet .= $optOffice;	
													$sheet .= '	</select>
												</th>
												<th style ="font-size:12px;color:orange;">ACCOUNT NAME</th>
												<th style ="">';
												$sheet .='<span id = "selectedUserLabel" style ="color:white;font-size:14px;">' . $user. '</span>';
												$sheet .= $employeeSelect;
												$sheet .= '</th>
												<th style ="">';
													$sheet .= '		<table style ="color:white;float:right;border-spacing:0;" border = "0">
																		<tr>
																			<th style ="font-size:12px;color:orange;">ENTRY YEAR</th>
																			<th style ="padding:0px;">
																				<select id ="selectYear" style ="background-color:rgb(24, 92, 141);font-size:16px;font-family:nor;font-weight:bold; -webkit-appearance: none;-moz-appearance: none;border:0;padding:0px 7px;color:white;">';
																					$sheet .= $displayYear;
																					for($i = 0; $i  < 5; $i++){
																						$sheet .= '<option onmouseup = "searchNow(3)">' . (date('Y') - $i) . '</option>';	
																					}
													$sheet .= '					</select>
																			</th>
																		</tr>
																	</table>';
												$sheet .= '</th>
												<th style ="">';
													$sheet .= '		<table style ="color:white;float:right;border-spacing:0;" border = "0">
																		<tr>
																			<th style ="font-size:12px;color:orange;">DOCTRACK YEAR</th>
																			<th style ="padding:0px;">
																				<select id ="selectDBYear" style ="background-color:rgb(24, 92, 141);font-size:16px;font-family:nor;font-weight:bold; -webkit-appearance: none;-moz-appearance: none;border:0;padding:0px 7px;color:white;">';
																					$sheet .= $dbYear;
																					for($i = 0; $i  < 5; $i++){
																						$sheet .= '<option onmouseup = "searchNow(3)">' . (date('Y') - $i) . '</option>';	
																					}
													$sheet .= '					</select>
																			</th>
																		</tr>
																	</table>';
												$sheet .= '</th>
											</tr>
										</table>
									</th>
								</tr>
								<tr><th style = "line-height:12px;color:silver;font-weight:normal;">Doctrack Administrators, Receiver, Releaser, Etc.</th></tr>
							</table>
						</th>
					</tr>';
					
		$sheet .= '<tr style = "background-color:rgb(24, 92, 141);"><th colspan ="100%">
					<div id ="prog" ></div>	
				   </th></tr>';			
		$sheet .= '<tr style = "background-color:rgb(5, 36, 52);">
						<th colspan ="100%">
							
						</th>
				   </tr>';
		$sheet .= '<tr style = "background-color:rgb(5, 36, 52);">
						<th></th><th style = "text-align:left;"></th>
						<th style = "text-align:left;padding:0;"></th><th colspan ="100%" style ="padding:0;" >';
					
						$sheet .= '<table style ="width:100%;font-size:12px;font-family:NOR;letter-spacing:1px;border-spacing:0;" border ="0"><tr>';
						for($i = 1 ; $i <= 12; $i++){
							$dateObj   = DateTime::createFromFormat('!m', $i);
							$monthName = strtoupper($dateObj->format('F'));
							if(abs($month) == $i){
								$sheet .= '<th class = "selected" style ="width:80px;" onclick ="selectMonth(this)">' . $monthName . '</th>';
							}else{
								$sheet .= '<th class = "month" style ="width:80px;" onclick ="selectMonth(this)">' . $monthName . '</th>';
							}
						}
						$sheet .= '<th style ="width:100px;padding:0;">';
						
						$sheet .= '				</th>';
					$sheet .= '</tr>
				  </table>';
		$sheet .= '</th></tr>';			
		$sheet .= '<tr style ="text-align:center;background-color:rgb(8, 161, 250);color:white;">
					<th style = "width:1%;background-color:rgb(5, 36, 52);rgb(27, 54, 84);border-bottom:2px solid rgb(27, 54, 84);"></th>
					<th style = "background-color:rgb(5, 36, 52); cursor:pointer;letter-spacing:1px;border-bottom:2px solid rgb(27, 54, 84);padding-bottom:10px;"  onclick = "sortNow(this)">'; 
		
		if($unsort == 1){
			$sheet .= '	<label style ="color:orange;">' . $icoBefore . ' </label>'; 
		}else{
			$sheet .= '	<label  >&#9655;  </label>'; 
		}			
			$sheet .= 'DOCTRACK USER</th>
						
					<th style = "width:250px; background-color:rgb(5, 36, 52);cursor:pointer;text-align:right;padding-right:10px;letter-spacing:1px;border-bottom:2px solid rgb(27, 54, 84);" >';
		if($unsort == 2){			
			$sheet .= '<label  style ="color:orange;">' . $icoBefore . ' </label>';
		}else{
			$sheet .= '<label  >&#9655;  </label>';
		}			
					$sql1 ="select status from voucherhistory group by status";
					$record1 = $database->query($sql1);
					
					
					
					$sheet .= '<span onclick = "sortNowProcess(this)" style ="color:orange;">ACTIVITY :</span>';
					$selectStatus = '<select id ="selectStatusId" style ="width:100px;background-color:rgb(5, 36, 52);font-size:12px;letter-spacing:0;font-family:nor; -webkit-appearance: none;-moz-appearance: none;border:0;padding:0px 7px;color:white;">';
					$selectStatus .= '<option  onmouseup = "selectStatus(this)">' . $status  . '</option>';
					$selectStatus .= '<option value = "ALL STATUS" onmouseup = "selectStatus(this)">ALL STATUS</option>';
					while($data1 = $database->fetch_array($record1)){
						$status = $data1['status'];
						$selectStatus .= '<option onmouseup = "selectStatus(this)">'  . $status . '</option>';
					}
					$selectStatus .= '</select>';
					
					$sheet .= $selectStatus;
					
					$sheet .= '</th>';
						for($i = 1; $i <= 31; $i++){
							$sheet .= '<th style ="width:10px;">' . $i . '</th>';
						}	
		$sheet .= '</th>
		
		<th style ="background-color:rgb(51, 71, 93);letter-spacing:1px;">TOTAL</th></tr>';			
		$total = 0;
		$color = "";
		$dateFlag = 0;
		$nameFlag = '';
		$statusFlag = '';
		$fullnameFlag = '';
		$tdBefore = '';
		$start =0;
		$tds = '';
		$tds1 = '';
		$midFlag = 0;
		$countTotal = 0;
		$grandTotal = 0;
		$i = 1;
		while($data = $database->fetch_array($record)){
			$status = $data['Status'];
			$fullname = utf8_encode($data['Name']);
			$name = utf8_encode($data['employeeNumber']);
			$count = $data['Counter'];
			$date = $data['Date'];
			$d = substr($date,8);
			
			if($start > 0){
				
				if($statusFlag != $status){
					$midFlag =0;
					if($nameFlag != $name){
						$tds =  $tds  . gapperEnd($dateFlag) . '<td style = "text-align:center;">' . $countTotal . '</td>';
						$sheet .=  '<tr><td>' . $i++ . '</td><td style ="white-space: nowrap;" >'  .  $fullnameFlag   . '</td><td>'  .  $statusFlag.  '</td>' . $tds . '</tr>' ;
						$tds ='';	
						$tds =  gapperStart($d);
						$countTotal = 0;
					}else{
						$tds = $tds  . gapperEnd($dateFlag) . '<td style = "text-align:center;">' . $countTotal . '</td>';
						$sheet .=  '<tr><td>' . $i++ . '</td><td style ="white-space: nowrap;" >' . $fullnameFlag  . '</td><td>'  .  $statusFlag.  '</td>' . $tds . '</tr>' ;
						$tds ='';	
						$tds =  gapperStart($d);
						$countTotal = 0;
					}
					
				}else{
					$midFlag = 1;
					/*if($nameFlag != $name){
						
						$tds =  $tds . gapperEnd($dateFlag) . '<td style = "text-align:center;">' . $countTotal . '</td>';	
						$sheet .=  '<tr><td>' . $i++ . '</td><td style ="white-space: nowrap;" >' . $name .  $fullnameFlag . '</td><td>'.  $statusFlag.  '</td>' . $tds . '</tr>' ;
						$tds ='';	
						$tds =  gapperStart($d);
						$midFlag =0;
						$countTotal = 0;
					}*/
					if($fullnameFlag != $fullname){
						
						$tds =  $tds . gapperEnd($dateFlag) . '<td style = "text-align:center;">' . $countTotal . '</td>';	
						$sheet .=  '<tr><td>' . $i++ . '</td><td style ="white-space: nowrap;" >'  .  $fullnameFlag . '</td><td>'.  $statusFlag.  '</td>' . $tds . '</tr>' ;
						$tds ='';	
						$tds =  gapperStart($d);
						$midFlag =0;
						$countTotal = 0;
					}
				}
			}else{
				$tds =  gapperStart($d);
				$midFlag = 0;
			}
			$tds .= gapperMid($midFlag, $d,$dateFlag) .'<td style = "text-align:center;">' . $count . '</td>' ;
			$countTotal += $count;
			$grandTotal += $count;
			$dateFlag = $d;
			$statusFlag = $status;
			$nameFlag = $name;
			$fullnameFlag = $fullname;
			$start = 1;
		}
		$sheet .=  '<tr><td>' . $i .'</td><td style ="white-space: nowrap;" >'  .$fullnameFlag  .'</td><td>'.  $statusFlag.  '</td>'  . $tds . gapperEnd($dateFlag) . '<td style = "text-align:center;">' . $countTotal . '</td></tr>' ;
		$sheet .=  '<tr><th  colspan ="34" style ="background-color:rgb(219, 224, 229);border-top:1px solid rgb(167, 169, 171);"></th>
		<th style = "font-weight:bold;font-size:14px;text-align:right;background-color:rgb(241, 181, 52); text-align:center;">' . $grandTotal . '</th></tr>' ;
		$sheet .= '</table>';
		echo $sheet;
		
		function gapperStart($d){
			$tdBefore = '';
			for($i = 1; $i < $d; $i++){
				$tdBefore .= '<td style ="width:40px;"></td>';
			}
			return $tdBefore;
		}
		function gapperMid($midFlag,$d,$dateFlag){
			
			$tdBefore = '';
			if($midFlag  == 1){
				$diff = abs($d-$dateFlag);
				if($diff > 1){
					for($i = 1; $i < $diff; $i++){
						$tdBefore .= '<td style ="width:40px;"></td>';
					}
				}
			}
			return $tdBefore;
		}
		function gapperEnd($d){
			$tdBefore = '';
			for($i = ($d+1); $i <= 31; $i++){
				$tdBefore .= '<td style ="width:40px;"></td>';
			}
			return $tdBefore;
		}
?>

<script>
	

	var sortName = 0;
	var sortNameProcess = 0;
	var sortValue = 0;
	function selectStatus(me){
		var select =  me.value;
		searchNow(3);
	}
	function selectEmployee(me){
		var fullName =  me.value;
		selectedUserLabel.textContent = fullName;
		searchNow(3);
	}
	function selectOffice(me){
		document.getElementById('s1').textContent =document.getElementById("selectOfficeId").options[document.getElementById("selectOfficeId").selectedIndex].text;
		searchNow(3);
	}
	function sortNow(me){
		var order = '';
		if(sortName == 1){
			sortName = 2;
		}else{
			sortName = 1;
		}
		sortValue = sortName;
		searchNow(1);
	}
	function sortNowProcess(me){
		var order = '';
		if(sortNameProcess == 1){
			sortNameProcess = 2;
		}else{
			sortNameProcess = 1;
		}
		sortValue = sortNameProcess;
		searchNow(2);
	}
	function selectMonth(me){
		var len = me.parentNode.children.length;
		for(var i = 0; i < len; i++){
			me.parentNode.children[i].className = "month";
		}
		me.className = "selected";
		searchNow(3);
	}
	function searchNow(sortColumn){
		document.getElementById("prog").className = "progress1";
		var office = document.getElementById("selectOfficeId").value;
		var officeName = document.getElementById("selectOfficeId").options[document.getElementById("selectOfficeId").selectedIndex].text;
		var status = document.getElementById("selectStatusId").value;
		
		var user = document.getElementById("employeeSelected").value;
		
		if(sortColumn == 1 ){
			if(sortName == 1){
				order = "name,status,datemodified asc";
			}else{
				order = "name desc,status,datemodified asc";
			}
		}else if(sortColumn == 2){
			if(sortNameProcess == 1){
				order = "status,name,datemodified asc";
			}else{
				order = "status desc,name,datemodified asc";
			}
		}else if(sortColumn == 3){
			order = "name,status,datemodified asc";
		}
		
		var m = document.getElementsByClassName("selected");
		var month = m[0].cellIndex;
		var year  = document.getElementById('selectYear').value;
		var dbYear  = document.getElementById('selectDBYear').value;
		
		
		
		var formData = new FormData();
		formData.append('m',month );
		formData.append('y', year);
		formData.append('o', order);
		formData.append('i', sortValue);
		formData.append('s', sortColumn);
		formData.append('f', office);
		formData.append('n', officeName);
		formData.append('u', user);
		formData.append('st', status);
		formData.append('db', dbYear);
		
		
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
	
</script>

















