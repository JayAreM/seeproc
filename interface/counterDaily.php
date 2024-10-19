<style>
	input.radioCalendarNcal:empty ~ label {
		cursor: pointer;
		color:black;
	}
	input.radioCalendarNcal:empty ~ label:before {
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
	input.radioCalendarNcal:hover:not(:checked) ~ label {
		color:rgb(13, 118, 147);
	}
	/* toggle on */
	input.radioCalendarNcal:checked ~ label:before {
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
		background-color: rgb(4, 145, 210);
	}
	input.radioCalendarNcal:hover:not(:checked) ~ label:before {
		background-color:rgb(170, 180, 183);
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
	}
	input.radioCalendarNcal:checked ~ label {
		font-weight: bold;
	}
	.radioCalendarNcal {
		visibility:hidden;
	}
	input.radioCalendarNcal ~label{
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		font-size: 12px;
	}
	
	
	input.radioCalendarNcalYear:empty ~ label {
		cursor: pointer;
		color:black;
	}
	input.radioCalendarNcalYear:empty ~ label:before {
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
	input.radioCalendarNcalYear:hover:not(:checked) ~ label {
		color:rgb(13, 118, 147);
	}
	/* toggle on */
	input.radioCalendarNcalYear:checked ~ label:before {
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
		background-color: rgb(4, 145, 210);
		background-color: rgb(240, 42, 118);
	}
	input.radioCalendarNcalYear:hover:not(:checked) ~ label:before {
		background-color:rgb(170, 180, 183);
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
	}
	input.radioCalendarNcalYear:checked ~ label {
		font-weight: bold;
	}
	.radioCalendarNcalYear {
		visibility:hidden;
	}
	input.radioCalendarNcalYear ~label{
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		font-size: 12px;
	}
	
	
	
	#tableCalendarNcal{
		border-spacing: 0px;
		margin:0 auto;
		margin-top: 10px;
		
	}
	
	#tableCalendarNcal tr:first-child td{
		font-size:13px;
		text-align: center;
		width:20px;
		padding:3px 5px;
	}
	
	#tableCalendarNcal td{
		text-align: center;
		font-family: roboto;
		
	}

	#tableCalendarNcal  td:hover {
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
			<span style = "border-bottom:1px dashed silver; font-size:20px;font-family:Oswald;text-align: center;letter-spacing:2px;color:red;font-weight: bold;">Daily Summary</span></td>
		</tr>
		
		<tr style = 'background-color:rgb(240, 243, 241)'>
			<td style = "padding-top:0px;text-align: right;height:1px;">
				<table id =""  style = "border-spacing:0;padding-right: 8px;float:right;"  border ="0">
					<td >	
						<input value="01" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal1"  class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '01'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal1">Jan</label>
					</td>
					<td >	
						<input value="02" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal2" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)"<?php if($month == '02'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal2">Feb</label>
					</td>
					<td >	
						<input value="03" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal3" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '03'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal3">Mar</label>
					</td>
					<td >	
						<input value="04" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal4" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '04'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal4">Apr</label>
					</td>
					<td >	
						<input value="05" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal5" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '05'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal5">May</label>
					</td>
					
					<td >	
						<input value="06" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal6" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '06'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal6">Jun</label>
					</td>
					<td >	
						<input value="07" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal7" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '07'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal7">Jul</label>
					</td>
					<td >	
						<input value="08" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal8" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '08'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal8">Aug</label>
					</td>
					<td >	
						<input value="09" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal9" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '09'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal9">Sep</label>
					</td>
					<td >	
						<input value="10" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal10" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '10'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal10">Oct</label>
					</td>
					<td >	
						<input value="11" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal11" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '11'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal11">Nov</label>
					</td>
					<td >	
						<input value="12" type="radio" name="selectCalendarMonthNcal" id="optCalendarNcal12" class="radioCalendarNcal" onclick = "clickOptionCalendarNcal(this)" <?php if($month == '12'){ echo 'checked';} ?>/>
						<label  for="optCalendarNcal12">Dec</label>
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
							<input value="<?php echo $year-1; ?>" type="radio" name="selectCalendarYearNcal" id="optCalendarYearNcal1"  class="radioCalendarNcalYear" onclick = "clickOptionCalendarNcal(this)" />
							<label  for="optCalendarYearNcal1"><?php echo ($year-1); ?></label>
						</td>
						<td width="" style = "">	
							<input value="<?php echo $year; ?>" type="radio" name="selectCalendarYearNcal" id="optCalendarYearNcal2"  class="radioCalendarNcalYear" onclick = "clickOptionCalendarNcal(this)" checked />
							<label  for="optCalendarYearNcal2"><?php echo $year; ?></label>
						</td>
						<td style = "">	
							<input value="<?php echo $year+1; ?>" type="radio" name="selectCalendarYearNcal" id="optCalendarYearNcal3" class="radioCalendarNcalYear" onclick = "clickOptionCalendarNcal(this)" />
							<label  for="optCalendarYearNcal3"><?php echo ($year+1); ?></label>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			
			<td id = "calendarContainer" style = "vertical-align:top;" colspan="2">
					<div style = 'padding-top:5px; background-color: rgb(245, 249, 249); font-size: 11px;padding-left:5px;'>On going transactions from Doctrack2023  month 
						of &nbsp; 
						<span style = 'font-weight:bold;font-size: 14px;' id = "labelMonthNcal"><?php echo  $database->numberToMonth($month); ?></span> 
						<span style = 'font-weight:bold;font-size: 14px;' id = "labelYearNcal"><?php echo $year ?></span>.
					</div>
					<div id="cDailyTotalCmpx" style="padding-left:5px;"></div>
					<table id  ="tableCalendarNcal"  >
						<tr id="ncalListOfDays" style="background-color:rgb(252, 244, 196);"></tr>
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
							<td style="font-size:11px; padding:0px 2px;">TOTAL</td>
						</tr>
						<!-- <tr> -->
							<?php
							$statusArr =  [ 'CAO Received','On Evaluation - Accounting','Evaluated - Accounting','Carded - Accounting','SLP Created - Accounting',
											'Pending at CAO','Pending Released - CAO','Forwarding Transmittal', 'CAO Released',
											'CBO Received','Pending at CBO','Pending Released - CBO','Fund Control',
											'GSO Received','Pending at GSO','Pending Released - GSO','Served to Supplier','Supplier Conformed',
											'For Inspection','Inspected','Pending at GSO - Inspection','Pending Released - Inspection',
											'Inventory','Pending at GSO - Inventory','Pending Released - Inventory',
											'CTO Received','Pending at CTO','Pending Released - CTO','Check Preparation - CTO',
											'Admin Received','Pending at Admin','Pending Released - Admin',
											'Forwarded to Admin - Administration','Forwarded to Admin - Operation','Forwarded to SP - Admin', 'BAC Received', 'Pending at BAC',
											'Pending Released - BAC','Encoded','Waiting for Delivery','Cancelled'];
											
								$j = 1;			
								foreach ($statusArr as $stat) {
									echo "<tr style = 'background-color:rgb(247, 250, 247);'>";
									if($j ==  1){
										echo "<td rowspan = '9' style = 'background-color:rgb(176, 180, 182);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>Accounting</td>";
									}else if($j == 10 ){
										echo "<td rowspan = '4' style = 'background-color:rgb(200, 204, 204);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>Budget</td>";
									}else if($j == 14){
										echo "<td rowspan = '12' style = 'background-color:rgb(176, 180, 182);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>GSO</td>";
									}else if($j == 26 ){
										echo "<td rowspan = '4' style = 'background-color:rgb(200, 204, 204);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>CTO</td>";
									}else if($j == 30 ){
										echo "<td rowspan = '5' style = 'background-color:rgb(176, 180, 182);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>Admin</td>";
									}else if($j == 35 ){
										echo "<td  style = 'background-color:rgb(200, 204, 204);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>SP</td>";
									}else if($j == 36 ){
										echo "<td rowspan = '3' style = 'background-color:rgb(176, 180, 182);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'>BAC</td>";
									}else if($j == 39 ){
										echo "<td rowspan ='3' style = 'background-color:rgb(200, 204, 204);font-family:Oswald;font-size:12px;letter-spacing:1px;font-weight:bold;'></td>";
									}
									
									if($j <= 9){
										$color = "rgb(176, 180, 182)";
									}else if($j <= 13){
										$color = "rgb(200, 204, 204)";
										
									}else if($j <= 25 ){           //gso                            
										$color = "rgb(176, 180, 182)";
									}else if($j <= 29 ){
										$color = "rgb(200, 204, 204)";//cto
									}else if($j <= 34 ){
										$color = "rgb(176, 180, 182)";//admin
									}else if($j <= 35 ){
										$color = "rgb(200, 204, 204)";
									}else if($j <= 38 ){
										$color = "rgb(176, 180, 182)";
									}else if($j <= 41 ){
										$color = "rgb(200, 204, 204)";
									}
									echo "<td style = 'text-align:right;padding-right:5px;font-size:12px;border-right:1px solid gray; white-space:nowrap; background-color:" . $color . "'>" . $stat . "</td>";
									for($i = 1; $i <= 32; $i++ ){
										if($i< 10){
											$day = '0' . $i;
										}else{
											$day = $i;
										}
										$color = '';
										if($i % 2 == 1 ){
											if($j <= 9){
												$color = "background-color:rgb(217, 229, 232);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 13){
												$color = "background-color:rgb(207, 212, 213);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 25){
												$color = "background-color:rgb(217, 229, 232);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 29){
												$color = "background-color:rgb(207, 212, 213);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 34){
												$color = "background-color:rgb(217, 229, 232);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 35){
												$color = "background-color:rgb(207, 212, 213);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 38){
												$color = "background-color:rgb(217, 229, 232);border-right:1px solid rgb(141, 171, 178);";
											}else if($j <= 41){
												$color = "background-color:rgb(207, 212, 213);border-right:1px solid rgb(141, 171, 178);";
											}	
										}

										$onclick = "onclick = 'getTrackingFromCalendarNcal(this)'";
										$bold = "";
										if($i == 32){
											$color .= "border-right:1px solid gray;";
											$bold = "font-weight:bold;";
											$onclick = "";
										}

										// echo "<td id = '" .  $stat . $day ."' style = '" . $color . "border-bottom:1px solid silver; font-size:14px;' class = 'tdCalendarValues' onclick = 'getTrackingFromCalendar(this)'></td>";
										
										echo "<td id = 'ncal" .  $stat . $day ."' style = '" . $color . "border-bottom:1px solid silver; font-size:14px; ".$bold." ' class = 'tdCalendarValuesNcal' ".$onclick."></td>";
									}
									$j++;
									echo "</tr>";
								}
								echo "<td colspan = '45' style = 'height:5px;'></td>"
							?>	
						<!-- </tr> -->
					</table>
					<div id = 'containerCalendarNcal'><div style = "text-align:right;font-size: 11px;background-color:rgb(245, 249, 249);padding:10px;font-family: mainFont;">Click quantity to view records.</div></div>
			</td>
		</tr>
		
	</table>
</div>
<script>
	
	whenRefreshCalendarNcal();
	function whenRefreshCalendarNcal(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Counter Daily"){
				goCalendarNcal();
			}
		}
	}

	function getCalendarYearNcal(){
		var yearArr = document.getElementsByName("selectCalendarYearNcal");
		var yearSelected = '';
		for(var i = 0 ; i < yearArr.length; i++){
			if(yearArr[i].checked == true ){
				yearSelected = yearArr[i].value;
				break;
			}	
		}
		return yearSelected;
	}

	function getCalendarMonthNcal(){
		var monthArr = document.getElementsByName("selectCalendarMonthNcal");
		var monthSelected = '';
		for(var i = 0 ; i < monthArr.length; i++){
			if(monthArr[i].checked == true ){
				monthSelected = monthArr[i].value;
				break;
			}	
		}
		return monthSelected;
	}

	function updateNcalListOfDays(year, month) {
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

		document.getElementById('ncalListOfDays').innerHTML = sheet;
	}

	function goCalendarNcal(){
		var year = getCalendarYearNcal();
		var month = getCalendarMonthNcal();

		updateNcalListOfDays(year, month);

		loader();
		var queryString = "?fetchCalendarNcal=1&month=" + month + "&year=" +year;
		var container = "";
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchCalendarNcal");
			
	}

	function calendarWriterNcal(result){
		var arRow = result.split('*');
		
		for(var i = 0 ; i < arRow.length-1; i++){
			var arrCell = arRow[i].split("~");
			var id = arrCell[0];

			var count = arrCell[1];
			document.getElementById(id).innerHTML = count;
		}
		
		calcTotalPerStatus();
		getTotalNumberOfComplexTN();
	}

	function clickOptionCalendarNcal(me){
		var x = '<div style = "text-align:right;font-size: 11px;background-color:rgb(245, 249, 249);padding:10px;font-family: mainFont;">Click quantity to view records.</div>';
		document.getElementById('containerCalendarNcal').innerHTML = x;
		
		var yearSelected = getCalendarYearNcal();
		var month = getCalendarMonthNcal();

		updateNcalListOfDays(yearSelected, month);
		
		document.getElementById("labelMonthNcal").textContent = numberToMonth(month) ;
		document.getElementById("labelYearNcal").textContent = yearSelected;
		
		clearTDValuesNcal();
		loader();
		var queryString = "?fetchCalendarNcal=1&month=" + month + "&year=" +yearSelected;
		var container = "";
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchCalendarNcal");
	}
	
	function clearTDValuesNcal(){
		var tdCalendarValues = document.getElementsByClassName("tdCalendarValuesNcal");
		for(var i = 0; i < tdCalendarValues.length;i++){
			tdCalendarValues[i].innerHTML = '';
		}
	}

	function getTrackingFromCalendarNcal(me){
		
		var cont = me.textContent;
		if(cont){
			var matches = me.id.match(/\d+/g); 
			var day = matches;
			var status =  me.id.replace(day,'').replace('ncal', '');
			var yearSelected = getCalendarYearNcal();
			var month = getCalendarMonthNcal();
			
			loader();
			var queryString = "?getTrackingFromCalendarNcal=1&month=" + month + "&year=" +yearSelected + "&day=" + day + "&status=" + status ;
			var container = document.getElementById("containerCalendarNcal");
			ajaxGetAndConcatenate(queryString,processorLink,container,"getTrackingFromCalendarNcal");
		}
	}

	function getTrackingComplexNcal() {
		var yearSelected = getCalendarYearNcal();
		var month = getCalendarMonthNcal();

		loader();
		var queryString = "?getTrackingComplexNcal=1&month=" + month + "&year=" +yearSelected;
		var container = document.getElementById('containerCalendarNcal');
		ajaxGetAndConcatenate(queryString,processorLink,container,"getTrackingComplexNcal");
	}

	function gotoFormCalendarNcal(day, status, year, month){
		window.open("formCalendarV2.php?day="+day+"&status="+status+"&year="+year+"&month="+month);
	}

	function gotoFormCalendarComplex(year, month) {
		window.open("formCalendarV3.php?&year="+year+"&month="+month);
	}

	function calcTotalPerStatus() {
		var table = document.getElementById('tableCalendarNcal');
		var rows = table.children[0].children;

		for (let i = 2; i < (rows.length - 1); i++) {

			var status = rows[i].children[0].textContent;
			if(rows[i].children.length > 33) {
				status = rows[i].children[1].textContent;
			}

			var total = 0;
			for (let j = 1; j <= 31; j++) {
				num = j.toString();
    			while (num.length < 2) num = "0" + num;

				var val = document.getElementById('ncal'+status+num).textContent.trim();
				total += parseFloat(toZero(val));
			}
			if(total > 0) {
				document.getElementById('ncal'+status+'32').innerHTML = numberWithCommas(total);
			}
		}
	}

	function getTotalNumberOfComplexTN() {
		var yearSelected = getCalendarYearNcal();
		var month = getCalendarMonthNcal();

		var queryString = "?getTotalNumberOfComplexTN=1&month=" + month + "&year=" +yearSelected;
		var container = document.getElementById('cDailyTotalCmpx');
		ajaxGetAndConcatenate(queryString,processorLink,container,"getTotalNumberOfComplexTN");
	}
</script>











 