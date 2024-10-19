<?php

?>
<style>
	input.radioCalendar:empty ~ label {
		cursor: pointer;
		color:black;
	}
	input.radioCalendar:empty ~ label:before {
		display: inline-block;
		content:"";
		background: #D1D3D4;
		background-color: rgb(221, 225, 226);
		border:1px solid grey;
		width:10px;
		height:10px;
		border-radius:50%;
		position:absolute;
		margin-top:5px;
		margin-left:-15px;
		
	}
	/* toggle hover */
	input.radioCalendar:hover:not(:checked) ~ label {
		color:rgb(13, 118, 147);
	}
	/* toggle on */
	input.radioCalendar:checked ~ label:before {
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
		background-color: rgb(4, 145, 210);
	}
	input.radioCalendar:hover:not(:checked) ~ label:before {
		background-color:rgb(170, 180, 183);
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
	}
	input.radioCalendar:checked ~ label {
		font-weight: bold;
	}
	.radioCalendar {
		visibility:hidden;
	}
	input.radioCalendar ~label{
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		font-size: 12px;
	}
	
	
	input.radioCalendarYear:empty ~ label {
		cursor: pointer;
		color:black;
	}
	input.radioCalendarYear:empty ~ label:before {
		display: inline-block;
		content:"";
		background: #D1D3D4;
		background-color: rgb(221, 225, 226);
		border:1px solid grey;
		width:10px;
		height:10px;
		border-radius:50%;
		position:absolute;
		margin-top:5px;
		margin-left:-15px;
		
	}
	/* toggle hover */
	input.radioCalendarYear:hover:not(:checked) ~ label {
		color:rgb(13, 118, 147);
	}
	/* toggle on */
	input.radioCalendarYear:checked ~ label:before {
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
		background-color: rgb(4, 145, 210);
		background-color: rgb(240, 42, 118);
	}
	input.radioCalendarYear:hover:not(:checked) ~ label:before {
		background-color:rgb(170, 180, 183);
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
	}
	input.radioCalendarYear:checked ~ label {
		font-weight: bold;
	}
	.radioCalendarYear {
		visibility:hidden;
	}
	input.radioCalendarYear ~label{
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		font-size: 12px;
	}
	
	
	/*.tableOffice{
		font-size: 13px;
		width:200px;
		border: 1px solid rgb(220, 228, 222);
	}
	.tableOffice td{
		border-bottom: 1px solid silver;
	}
	
	.tableOffice th{
		border-bottom: 1px solid silver;
		background-color: rgb(147, 155, 143);
		background-color: rgba(27, 65, 78,.8);
		color:white;
		font-size: 15px;
	}	 
	
	.tableOffice tr:last-child td {
		border-bottom: 0px;
	}
	.officeTotal{
		color:red;
		text-align: right;
		font-weight: bold;
		
		letter-spacing: 1px;
	}
	.tableOfficeCounter{
		margin:20px auto;
		margin-top:10px;
		border-spacing: 0px;
		border:1px solid rgb(211, 212, 212);
		padding:5px;
	}
	.tableOfficeCounter th:nth-child(2){
		background-color: rgb(43, 50, 56);
	}
	.tableOfficeCounter th{
		padding: 2px 10px;
		font-size: 14px;
	}
	.tableOfficeCounter td{
		font-size: 13px;
		text-align: center;
	}
	.tableOfficeCounter tr:nth-child(even) {
		background-color: rgb(237, 240, 235);
	}
	.tableOfficeCounter tr:hover {
		background: rgb(248, 236, 165);
		transition: all .1s ease-in;
	}*/
	#tableCalendar{
		border-spacing: 0px;
		margin:0 auto;
		margin-top: 10px;
		
	}
	
	#tableCalendar tr:first-child td{
		font-size:13px;
		text-align: center;
		width:20px;
		padding:3px 5px;
	}
	/*
	#tableCalendar tr:nth-child(even) {
		background-color: rgb(237, 240, 235);
	}*/
	
	
	#tableCalendar td{
		text-align: center;
		font-family: roboto;
		
	}
	/*#tableCalendar tr:hover {
		background: rgb(248, 236, 165);
		transition: all .01s ease-in;
	}*/
	#tableCalendar  td:hover {
		background: white;
		cursor: pointer;
		
		font-weight: bold;
		
		line-height: -220px;
		padding:0px;
		color:black;
	}
	#tabletrackingCalendar td{
		border-bottom: 1px solid rgb(237, 237, 233);;
	}
	#tableTrackingCalendar tr:nth-child(even){
		background-color: rgb(236, 244, 247);
	}
	#tableTrackingCalendar tr:hover{
		background-color: rgb(250, 233, 0);
		cursor: pointer;
		
	}
	#tableTrackingCalendar tr:hover td:nth-child(4){
		font-weight: bold;
	}
	#tableTrackingCalendar tr:hover td:nth-child(1){
		font-weight: bold;
	}
	
</style>

<div style = "min-width:900px;padding:5px;padding-top:10px;">

	
	<table style="width:100%;border-spacing: 0;" >
		<?php
			$year = date('Y');
			$month =   date('m');
			
		?>
		<tr>
			<td style = "text-align: center;height:0px;" colspan="2"><span style = "font-weight: bold;font-size: 16px;">Document Tracking System </span>
			<span style = "border-bottom:1px dashed silver; font-size:20px;font-family:Oswald;text-align: center;letter-spacing:2px;color:red;font-weight: bold;">Monitoring Calendar</span></td>
		</tr>
		
		<tr style = 'background-color:rgb(240, 243, 241)'>
			<td style = "padding-top:0px;text-align: right;height:1px;">
				<table id =""  style = "border-spacing:0;padding-right: 8px;float:right;"  border ="0">
					<td >	
						<input value="01" type="radio" name="selectCalendarMonth" id="optCalendar1"  class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '01'){ echo 'checked';} ?>/>
						<label  for="optCalendar1">Jan</label>
					</td>
					<td >	
						<input value="02" type="radio" name="selectCalendarMonth" id="optCalendar2" class="radioCalendar" onclick = "clickOptionCalendar(this)"<?php if($month == '02'){ echo 'checked';} ?>/>
						<label  for="optCalendar2">Feb</label>
					</td>
					<td >	
						<input value="03" type="radio" name="selectCalendarMonth" id="optCalendar3" class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '03'){ echo 'checked';} ?>/>
						<label  for="optCalendar3">Mar</label>
					</td>
					<td >	
						<input value="04" type="radio" name="selectCalendarMonth" id="optCalendar4" class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '04'){ echo 'checked';} ?>/>
						<label  for="optCalendar4">Apr</label>
					</td>
					<td >	
						<input value="05" type="radio" name="selectCalendarMonth" id="optCalendar5" class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '05'){ echo 'checked';} ?>/>
						<label  for="optCalendar5">May</label>
					</td>
					
					<td >	
						<input value="06" type="radio" name="selectCalendarMonth" id="optCalendar6" class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '06'){ echo 'checked';} ?>/>
						<label  for="optCalendar6">Jun</label>
					</td>
					<td >	
						<input value="07" type="radio" name="selectCalendarMonth" id="optCalendar7" class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '07'){ echo 'checked';} ?>/>
						<label  for="optCalendar7">Jul</label>
					</td>
					<td >	
						<input value="08" type="radio" name="selectCalendarMonth" id="optCalendar8" class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '08'){ echo 'checked';} ?>/>
						<label  for="optCalendar8">Aug</label>
					</td>
					<td >	
						<input value="09" type="radio" name="selectCalendarMonth" id="optCalendar9" class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '09'){ echo 'checked';} ?>/>
						<label  for="optCalendar9">Sep</label>
					</td>
					<td >	
						<input value="10" type="radio" name="selectCalendarMonth" id="optCalendar10" class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '10'){ echo 'checked';} ?>/>
						<label  for="optCalendar10">Oct</label>
					</td>
					<td >	
						<input value="11" type="radio" name="selectCalendarMonth" id="optCalendar11" class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '11'){ echo 'checked';} ?>/>
						<label  for="optCalendar11">Nov</label>
					</td>
					<td >	
						<input value="12" type="radio" name="selectCalendarMonth" id="optCalendar12" class="radioCalendar" onclick = "clickOptionCalendar(this)" <?php if($month == '12'){ echo 'checked';} ?>/>
						<label  for="optCalendar12">Dec</label>
					</td>
				</table>
			</td>
			<td style = "width: 300px;">
				<table id =""  style = "border-spacing:0;margin:0 auto;padding-right: 8px;"  border ="0">
					<tr>
						<td  style = "font-family: Roboto;font-size:10px;color:grey;">	
							YEAR UPDATED
						</td>
						<td  style = "">	
							<input value="<?php echo $year-1; ?>" type="radio" name="selectCalendarYear" id="optCalendarYear1"  class="radioCalendarYear" onclick = "clickOptionCalendar(this)" />
							<label  for="optCalendarYear1"><?php echo ($year-1); ?></label>
						</td>
						<td width="" style = "">	
							<input value="<?php echo $year; ?>" type="radio" name="selectCalendarYear" id="optCalendarYear2"  class="radioCalendarYear" onclick = "clickOptionCalendar(this)" checked />
							<label  for="optCalendarYear2"><?php echo $year; ?></label>
						</td>
						<td style = "">	
							<input value="<?php echo $year+1; ?>" type="radio" name="selectCalendarYear" id="optCalendarYear3" class="radioCalendarYear" onclick = "clickOptionCalendar(this)" />
							<label  for="optCalendarYear3"><?php echo ($year+1); ?></label>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			
			<td id = "calendarContainer" style = "vertical-align:top;" colspan="2">
					<div style = 'padding-top:5px; background-color: rgb(245, 249, 249); font-size: 11px;padding-left:5px;'>On going transactions from Doctrack2023  month 
						of &nbsp; 
						<span style = 'font-weight:bold;font-size: 14px;' id = "labelMonth"><?php echo  $database->numberToMonth($month); ?></span> 
						<span style = 'font-weight:bold;font-size: 14px;' id = "labelYear"><?php echo $year ?></span>.</div>
					<table id  ="tableCalendar">
						<tr id="calListOfDays" style="background-color:rgb(252, 244, 196);"></tr>
						<tr  style = 'background-color:rgb(12, 71, 123);font-family: Arial;color:white;'>
							<td style = "background-color: rgb(53, 59, 60);width:100px;">Office</td>
							<td style = "background-color: rgb(136, 163, 183);width:210px;color:black;font-weight: bold;border-right:1px solid black;">Status</td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
							<td>8</td>
							<td>9</td>
							
							<td>10</td>
							<td>11</td>
							<td>12</td>
							<td>13</td>
							<td>14</td>
							<td>15</td>
							<td>16</td>
							<td>17</td>
							<td>18</td>
							<td>19</td>
							<td>20</td>
							<td>21</td>
							<td>22</td>
							<td>23</td>
							<td>24</td>
							<td>25</td>
							<td>26</td>
							<td>27</td>
							<td>28</td>
							<td>29</td>
							<td>30</td>
							<td>31</td>
							<td style="background-color:rgba(50,50,50,1); font-family:Arial; font-size:12px;">cmpx</td>
						</tr>
						<tr>
							<?php
							$statusArr =  [ 'CAO Received','Pending at CAO','Pending Released - CAO','Forwarding Transmittal', 'CAO Released',
											'Requesting for Fund Certification','Acknowledge Certification Request','Fund Certification Signed',
											'CBO Received','Pending at CBO','Pending Released - CBO','Fund Control',
											'Requesting for Fund Certification','Acknowledge Certification Request','Fund Certification Signed', 'Obligation Request for Pick-up',
											'GSO Received',
											'Pending at GSO','Pending Released - GSO',
											'Served to Supplier','Supplier Conformed',
											'For Inspection','Inspected','Pending at GSO - Inspection','Pending Released - Inspection',
											'Inventory','Pending at GSO - Inventory','Pending Released - Inventory',
											'CTO Received','Pending at CTO','Pending Released - CTO','Check Preparation - CTO',
											'Admin Received','Pending at Admin','Pending Released - Admin','PO Signed',
											'Forwarded to Admin - Administration','Forwarded to Admin - Operation','Forwarded to SP - Admin', 'BAC Received', 'Pending at BAC',
											'Pending Released - BAC','Encoded','Waiting for Delivery','Cancelled'];
											
								$j = 1;			
								foreach ($statusArr as $stat) {
									echo "<tr style = 'background-color:rgb(247, 250, 247);'>";
									if($j ==  1){
										echo "<td rowspan = '8' style = 'background-color:rgb(176, 180, 182);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>Accounting</td>";
									}else if($j == 9 ){
										echo "<td rowspan = '8' style = 'background-color:rgb(200, 204, 204);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>Budget</td>";
									}else if($j == 17 ){
										echo "<td rowspan = '12' style = 'background-color:rgb(176, 180, 182);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>GSO</td>";
									}else if($j == 29 ){
										echo "<td rowspan = '4' style = 'background-color:rgb(200, 204, 204);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>CTO</td>";
									}else if($j == 33 ){
										echo "<td rowspan = '6' style = 'background-color:rgb(176, 180, 182);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>Admin</td>";
									}else if($j == 39 ){
										echo "<td  style = 'background-color:rgb(200, 204, 204);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>SP</td>";
									}else if($j == 40 ){
										echo "<td rowspan = '3' style = 'background-color:rgb(176, 180, 182);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>BAC</td>";
									}else if($j == 43 ){
										echo "<td rowspan ='3' style = 'background-color:rgb(200, 204, 204);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'></td>";
										
									}
									
									if($j <= 8){
										$color = "rgb(176, 180, 182)";
									}else if($j <= 16 ){
										$color = "rgb(200, 204, 204)";
									}else if($j <= 28 ){           //gso                            
										$color = "rgb(176, 180, 182)";
									}else if($j <= 32 ){
										$color = "rgb(200, 204, 204)";//cto
									}else if($j <= 38 ){
										$color = "rgb(176, 180, 182)";//admin
									}else if($j <= 39 ){
										$color = "rgb(200, 204, 204)";
									}else if($j <= 42 ){
										$color = "rgb(176, 180, 182)";
									}else if($j <= 45 ){
										$color = "rgb(200, 204, 204)";
									}
									echo "<td style = 'text-align:right;padding-right:5px;font-size:12px;border-right:1px solid gray; white-space:nowrap;  background-color:" . $color . "'>" . $stat . "</td>";
									for($i = 1; $i <= 32; $i++ ){
										if($i< 10){
											$day = '0' . $i;
										}else{
											$day = $i;
										}
										$color = '';
										if($i % 2 == 1 ){
											if($j <= 8){
												$color = "background-color:rgb(217, 229, 232);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 16){
												$color = "background-color:rgb(207, 212, 213);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 28){
												$color = "background-color:rgb(217, 229, 232);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 32){
												$color = "background-color:rgb(207, 212, 213);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 38){
												$color = "background-color:rgb(217, 229, 232);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 39){
												$color = "background-color:rgb(207, 212, 213);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 42){
												$color = "background-color:rgb(217, 229, 232);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 45){
												$color = "background-color:rgb(207, 212, 213);border-right:1px solid rgb(141, 171, 178);";
											}	
										}
										if($i == 32){
											$color .= "border-right:1px solid silver;";
										}

										if($stat != 'Requesting for Fund Certification' && $stat != 'Acknowledge Certification Request' && $stat != 'Fund Certification Signed') {
											echo "<td id = '" .  $stat . $day ."' style = '" . $color . "border-bottom:1px solid silver; font-size:14px;' class = 'tdCalendarValues' onclick = 'getTrackingFromCalendar(this)'></td>";
										}else {
											if($j <= 8){
												$office = "Accounting";
											}else if($j <= 16 ){
												$office = "Budget";
											}
											echo "<td id = '". $office . $stat . $day ."' style = '" . $color . "border-bottom:1px solid silver; font-size:14px;' class = 'tdCalendarValues' onclick = 'getTrackingFromCalendar(this)'></td>";
										}
										
									}
									$j++;
									echo "</tr>";
								}
								echo "<td colspan = '45' style = 'height:5px;'></td>"
							?>	
						</tr>
					</table>
					<div id = 'containerCalendar'><div style = "text-align:right;font-size: 11px;background-color:rgb(245, 249, 249);padding:10px;font-family: mainFont;">Click quantity to view records.</div></div>
			</td>
		</tr>
		
	</table>
</div>
<script>
	
	
	
	
	whenRefreshCalendar();
	function whenRefreshCalendar(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Calendar"){
				goCalendar();
			}
		}
	}
	
	
	function getCalendarYear(){
		var yearArr = document.getElementsByName("selectCalendarYear");
		var yearSelected = '';
		for(var i = 0 ; i < yearArr.length; i++){
			if(yearArr[i].checked == true ){
				yearSelected = yearArr[i].value;
				break;
			}	
		}
		return yearSelected;
	}
	function getCalendarMonth(){
		var monthArr = document.getElementsByName("selectCalendarMonth");
		var monthSelected = '';
		for(var i = 0 ; i < monthArr.length; i++){
			if(monthArr[i].checked == true ){
				monthSelected = monthArr[i].value;
				break;
			}	
		}
		return monthSelected;
	}
	function clickOptionCalendar(me){
		var x = '<div style = "text-align:right;font-size: 11px;background-color:rgb(245, 249, 249);padding:10px;font-family: mainFont;">Click quantity to view records.</div>';
		containerCalendar.innerHTML = x;
		
		var yearSelected = getCalendarYear();
		var month = getCalendarMonth();
		
		document.getElementById("labelMonth").textContent = numberToMonth(month) ;
		document.getElementById("labelYear").textContent = yearSelected;
		
		updateCalListOfDays(yearSelected, month);
		
		clearTDValues();
		loader();
		var queryString = "?fetchCalendar=1&month=" + month + "&year=" +yearSelected;
		var container = "";
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchCalendar");
	}

	function updateCalListOfDays(year, month) {
		var sheet = "<td colspan='2' style='background-color:white;'></td>";
		var days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];

		for(var i = 1; i <= 31; i++) {
			var dateStr = year+'-'+month+'-'+i;
			var date = new Date(dateStr);
			if(!isNaN(date.getDay())) {
				var fWeight = "";
				var day = days[date.getDay()];

				if(day == 'Sat' || day == 'Sun') {
					fWeight = 'font-weight:bold;';
				}

				var borderLeft = '';
				if(i == 1) {
					borderLeft = 'border-left:1px solid silver;';
				}
				var borderRight = '';
				// if(i == 31) {
				// 	borderRight = 'border-right:1px solid silver;';
				// }

				sheet += '<td style="font-family:Oswald; font-size:12px; letter-spacing:1px; border-left:1px solid white; border-top:1px solid silver; '+borderLeft+' '+fWeight+' '+borderRight+'">'+day+'</td>';
			}else {
				sheet += '<td style="border-left:1px solid white; border-top:1px solid silver; '+borderRight+'"></td>';
			}
		}
		sheet += '<td style="border-left:1px solid white; border-top:1px solid silver; border-right:1px solid silver;"></td>';
		document.getElementById('calListOfDays').innerHTML = sheet;
	}
	
	function goCalendar(){
		var year = getCalendarYear();
		var month = getCalendarMonth();

		updateCalListOfDays(year, month);

		loader();
		var queryString = "?fetchCalendar=1&month=" + month + "&year=" +year;
		var container = "";
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchCalendar");
	}
	function calendarWriter(result){
		
		var arRow = result.split('*');
		
		for(var i = 0 ; i < arRow.length-1; i++){
			var arrCell = arRow[i].split("~");
			var id = arrCell[0];
			
			var count = arrCell[1];
			document.getElementById(id).innerHTML = count;
		}	

	}

	function getTotalComplex() {
		var table = document.getElementById('tableTrackingCalendar');
		var tbody = table.children[0];
		var len = tbody.children.length - 2;

		var cmpxCnt = 0;
		for (var i = 1; i < len; i++) {
			var tr = tbody.children[i];
			var cmpx = tr.children[8].textContent.trim();
			if(cmpx == 'Complex') {
				cmpxCnt++;
			}
		}

		var div = document.createElement('DIV');
		div.style.textAlign = 'right';
		var innerDiv = "<span style='font-size:12px;'>Total Complicated TN :</span><span style='font-size:12px;padding-left:5px; margin-right:5px;'>"+cmpxCnt+"</span>";
		div.innerHTML = innerDiv;

		var cont = document.getElementById('containerCalendar');
		cont.insertBefore(div, cont.children[cont.children.length - 1]);
	}

	function clearTDValues(){
		var tdCalendarValues = document.getElementsByClassName("tdCalendarValues");
		for(var i = 0; i < tdCalendarValues.length;i++){
			tdCalendarValues[i].innerHTML = '';
		}
	}
	function getTrackingFromCalendar(me){
		
		var cont = me.textContent;
		if(cont){
			
			var matches = me.id.match(/\d+/g); 
			var day = matches;
			var status =  me.id.replace(day,'');
			var office = '';
			if(status.substring(0,6) == 'Budget') {
				status =  status.replace('Budget','');
				office = 'Budget';
			}else if(status.substring(0,10) == 'Accounting') {
				status =  status.replace('Accounting','');
				office = 'Accounting';
			}

			var yearSelected = getCalendarYear();
			var month = getCalendarMonth();
			
			loader();
			var queryString = "?getTrackingFromCalendar=1&month=" + month + "&year=" +yearSelected + "&day=" + day + "&status=" + status + "&office=" + office;
			var container = document.getElementById("containerCalendar");
			ajaxGetAndConcatenate(queryString,processorLink,container,"getTrackingFromCalendar");
		}
	}
	//optCalendar11.click();

	function gotoFormCalendar(day, status, year, month){
		console.log(day+"-"+status+"-"+year+"-"+month);

		window.open("formCalendar.php?day="+day+"&status="+status+"&year="+year+"&month="+month);
	}
	
	function clickToSearchCalendar(me){
		if(document.getElementById("container1")){
			document.getElementById("container1").children[0].click();
			for(var i  = 0 ; i < document.getElementById("doctrackMenuContainer").children.length;i++){
				if(document.getElementById("doctrackMenuContainer").children[i].textContent == "Tracker"){
					document.getElementById("doctrackMenuContainer").children[i].click();
					break;
				}
			}
			var trackingNumber = me.textContent;
			var queryString = "?searchTrackingNumber=1&trackingNumber=" + trackingNumber;
			var container = document.getElementById('doctrackUpdateContainer');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"searchTrackingNumber");
		}
		
	}
</script>











 