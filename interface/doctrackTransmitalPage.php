<?php 
	session_start();
	
	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('login.php','_self')</script>";
		echo $link;
	}
	
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	require_once('../includes/loading.php');
	
?>

<style>
	@font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
	}
	body{
		padding:0;	
		margin:0;
		
	
	}
	.back{
		z-index: -20;
		position: fixed;
		top:790px;
		height:180px;
		width:100%;
		
		background:url(../images/forest2.png);	
		background-repeat:no-repeat;
		//background-position:0px 500px;	
		background-size:100% 100% ;
	}
	
	.tableHeader{
		margin:0 auto;
		//margin-bottom:15px;
		text-align:center;
		border-spacing:0px;
		border:1px solid white;
		height:165px;
		width:100%;
		padding:10px 0px;
	}
	
	#bodyDiv{
		//margin:0 auto;
		text-align:center;
	}
	.selectType{
		color:white;
		padding:2px 8px;
		font-family: oswald;
		
		font-size: 14px;
		border-top:1px solid grey;
		border-left:10px solid grey;
		border-bottom:1px solid white;
		border-right:1px solid white;
		
		background-color: #EBE9E3;
		
		font-weight: bold;
		color:black;
	}
	.spanLabel{
		font-family: oswald;
		color:white;
		margin-left:20px;
	}
	#closeMenu{
		background-color:#577B50;
		font-family: oswald;
		
		border:1px solid grey;
		height:20px;
		width:20px;
		
		float:right;
		
		border-radius:50%;
		
		margin-right:20px;
		cursor:pointer;
	}
	#closeMenu:hover{
		font-weight:bold;
		background-color: black;
		
	}

	.button1{
		border-bottom:1px solid silver;
		border-right:1px solid silver;
		
		background-color:rgb(230, 237, 241);
		text-align:center;
		font-family: oswald;
		padding:2px 15px;
		margin:0 auto;
		font-size:18px;
		cursor:pointer;
		font-weight:bold;
		transition: all .5s;
	}
	.b1{
		padding:10px 20px;;
		display: inline-block;
	}
	.button1:hover{
		box-shadow:0px 0px 1px 0px silver;
		text-shadow:0px 0px 1px grey;
		background-color:rgb(216, 226, 231);
	}
	
	
	
	#resultTable{		
		margin:0 auto;
		border-spacing:0;
		width:100%;
		white-space: nowrap; 
	}
	
	.tdData{
		letter-spacing:0px; 
		font-size:14px;
	}
	
	.trData:hover{
		background-color:#A5DDF0;
	}
	.tdFieldHeader{
		font-weight:bold;
		padding:2px 4px;
		border-right:2px solid silver;
		border-top:2px solid silver;
		border-bottom:2px solid silver;
		font-size:16px;
		
	}
	.textControls{
		width:30px;
		font-family: oswald;
		text-align: center;
		font-weight: bold;
		font-size: 16px;
		background-color: #B4CEA6;
	}
	
	.select2{
		font-family: oswald;
		padding:5px;
		font-size: 18px;
		font-weight: bold;
	}
	/*-----------------------------------------------------------------loader*/
	.loader{
			width:120px;
			height:120px;
			top:40%;
			background:url('../images/ajaxloader.gif');
			background-repeat:no-repeat;
			background-size:100px 100px;
			background-position:48% 48%;
			z-index:100;
			
	}	
	.loaderContainer{
		border:4px solid transparent;
		border-radius:2px;
		display:inline-block;	
	}
	.absoluteHolder1{
		z-index:105;
		position:absolute;
		text-align:center;
		background-color:rgba(252, 254, 254,.4);
		width:100%;
		height:100%;
	}
	

	.absoluteHolder{
		z-index:105;
		position:absolute;
		text-align:center;
		background-color:rgba(4, 4, 4,.3);
		width:100%;
		height:100%;
	}
	/*---------------------------------------------------------------editor*/
	.editorContainer{
		border:4px solid transparent;
		border-radius:2px;
		box-shadow:0px 0px 20px 10px rgba(0, 0, 0,.4);
		background-color:white;
		display:inline-block;	
	}
	.editorTable{
		border-spacing:0;
		margin:25px;
		background-color:rgb(245, 248, 248);
	}
	.editorHeader{
		color:white;
		padding:2px 5px;
		padding:10px;
		letter-spacing:1px;
		font-size: 20px;
		font-family: oswald;
		font-weight: bold;
		background-color: #4D6842;
		
		//text-shadow:0px 0px 2px orange;
	}
	.editorLabel{
		padding-right:15px;
		padding-left:40px;
		padding-top:40px;
		padding-bottom:20px;
		font-weight:bold;
		font-family: oswald;
		
	}
	.editorInput{
		width:140px;
		padding:7px 5px;
		margin:5px;
		margin-top:15px;
		margin-right:15px;
		
		border-top:1px solid rgb(215, 213, 213);
		border-right:1px solid rgb(215, 213, 213);
		
		border-left:1px solid rgb(234, 232, 232);
		border-bottom:1px solid rgb(234, 232, 232);
		
		border-radius:4px;
		
		font-size:14px;
		text-align:center;
		letter-spacing:1px;
		
	}
	.closeEditor{
		color:white;
		background-color:silver;
		border:2px solid white;
		display:inline-block;
		height:15px;
		width:15px;
		border-radius:50%;
		float:right;
	}
	.closeEditor:hover{
		cursor:pointer;
		background-color:rgb(250, 98, 116);
	}
	
	/*---------------------------------------------------------------editor*/
	.tdMessage{
		padding:10px;
		padding-bottom:20px;
		text-align:justify;
		font-size:18px;
		//background-color:silver;
		font-family: oswald;
		min-width:100px;
	}
	.hiddenInput{
		color:red;
		display:inline;
		border:0;
		background-color:transparent;
		font-size:1px;
		font-family: oswald;
		color:transparent;
	}
	.messageContainer{
		min-width:100px;
		margin:20px auto;	
	}
	.messageBox{
		font-size:16px;
		color:black;
		border-radius:10px;
		text-align:justify;
		text-shadow:0px 0px 1px white;
		padding:0px 10px;
	}
	.closeMessage{
		border:1px solid white;
		display:block;
		background-color:grey;
		color:white;
		font-weight:bold;
		width:70px;	
		margin:10px auto;
		padding:5px;
		text-align:center;
		cursor:pointer;
		border-radius:2px;
		transition: all .5s;
	}
	.closeMessage:hover{
		box-shadow:0px 0px 10px 0px grey;
		background-color:rgb(16, 62, 91);
	}
		/*---------------------------------------------------------------msgbox*/
	
	
	
	.dataHeader1{
		background-color: rgb(121, 137, 141);
		font-family: Oswald;
		font-size: 18px;
		color:white;
		font-weight: bold;
	}
	.countTotal{
		padding-left:2px;
		font-size:16px;
		font-weight:normal;
		color:orange;
	}
	.data1{
		font-family: Oswald;
		padding-right:2px;
	}
	.text3{
		font-family: mainFont;
		padding:5px 5px;
		width:150px;
		font-size:22px;
		font-weight:bold;
		text-align:center;
		border-top:1px solid silver;
		border-left:1px solid silver;
		
		background-color:rgba(6, 44, 66,.05);
		text-transform:uppercase;
	}
	#divCtrl{
		background-color:white;
		display:inline-block;
		color:rgb(0, 145, 248);
		border-radius:50%;
		height:20px;
		width:20px;
		padding:6px;
		font-size:16px;
		position:absolute;
		margin-left:15px;
		margin-top:4px;
		
		border-left:1px solid grey;
	}
	.button2{
		cursor:pointer; 
		border-left:2px solid black;
		padding-left:5px;
		background-color:transparent;
		color:white;
		font-family: oswald;
		font-weight:bold;
		
	}
	.button2:hover{
		
		color:black;
	}
	.edit{
		font-size:14px;
		font-weight: normal;
		padding:0px 3px;
		letter-spacing:1px;
		cursor: pointer;
		color:silver;
		transition: all .2s;
	}
	.edit:hover{
		text-shadow: 0px 0px 13px #67A82E;
		letter-spacing: 5px;
		font-weight: bold;
		color:red;
	}
	.norecord{
		
		//font-weight:bold;
		font-family: impact;
		font-size: 108px;
		color:rgb(230, 94, 132);
		color:grey;
		padding-top:140px;
		
	}
	
</style>
	
	<title>2021 Releaser's List</title>
	
	<link rel="icon" href="/citydoc2019/images/gate4.png"/> 
	<div id = "menuContainer">
		<div  >	
			<div style =" color:white;text-align:left;">
					
					<table border ="0" style = "width:100%;background-color:#67A82E;border-spacing:0;border-bottom: 1px solid silver;border-top: 1px solid grey; box-shadow:0px 0px 10px black; padding: 1px;" >
						<tr>
							<td width ="1">
									<span class ="spanLabel">Fund</span>
							</td>
							<td width ="1">
								<select id = "fundType"  class = "selectType">
									<option>General Fund</option>
									<option>SEF</option>
									<option>Trust Fund</option>
								</select>
							</td>
							<td width ="1">
									<span class ="spanLabel">Claim&nbsp;Type</span>
							</td>
							<td width ="1">
									<select id = "claimType" class = "selectType">
										<option>Check</option>
										<option>Window</option>
										<option>Others</option>
									</select>
							</td>
						
							<td width ="1">
									<span class ="spanLabel">Status</span>
							</td>
							<td width ="1">
									<select id = "status" class = "selectType">
										<option>CAO Released</option>
										<option>Check Advised</option>
										<option>CAO Received</option>	
										
										<option>Check Preparation - CTO</option>
										<option>Forwarded to CTO</option>
										<option>Pending at CAO</option>
										<option>Pending Released - CAO</option>
										
										
									</select>
							</td>
					
					
							
						<td  width ="1">
										<input type ="checkbox" style = "margin-left:20px;" id ="dateActive" checked  />
						</td>
						<td width ="1">			
										<span class ="spanLabel" style = "margin-left:0px;">Date</span>
						</td>
						<td width ="1">			
										<div id = "dateContainer" style = "display:no1ne;" >
									
														<table>
															<tr>
																<td>			
																	
																		<select class = "selectType" id = "sMonth">	
																			<option value = "01">January</option>
																			<option value = "02">February</option>
																			<option value = "03">March</option>
																			<option value = "04">April</option>
																			<option value = "05">May</option>
																			<option value = "06">June</option>
																			<option value = "07">July</option>
																			<option value = "08">August</option>
																			<option value = "09">September</option>
																			<option value = "10">October</option>
																			<option value = "11">November</option>
																			<option value = "12">December</option>
																		</select>
																</td>
																<td>
																<select class = "selectType" id = "sDay">
						<?php
							for($i = 1; $i <= 31 ;$i++){
								if($i < 10){
									echo '<option value = '. $i .'>' . '0' .  $i . '</option>';
								}else{
									echo '<option value = '. $i .'>' . $i . '</option>';
								}
							}
						?>
					</select>
					
																</td>
																<td>
																<select  class = "selectType" id = "sYear">
										<!--	<option value = "2013">2013</option>
											<option value = "2012">2012</option>
											<option value = "2014"> 2014</option>-->
											<?php
												date_default_timezone_set('Asia/Manila');	
												
												$year =  date("Y");
												// $year =  2022;
												
												for($i = 0; $i <= 5;$i++){
													echo "<option>" . intval($year-$i) . "</option>";
												}
											?>
											</select>
								   		 						</td>
								   		 					</tr>
								   		 				</table>
								   		 </div>
								
					  	</td>				
				<?php
					if(isset($_SESSION['accountType'])){
					if($_SESSION['accountType'] == 5){
				?>
						<td width ="1">	
							<span class ="spanLabel">From</span>
						</td>
						<td width ="1">
							<input id = "controlFrom" type ="text"  class = "textControls" value = "1" onkeydown = "return isPressDigit(this,event)" maxlength = "3"/>
						</td>
						<td width ="1">	
							<span class ="spanLabel">To</span>
						</td>
						<td width ="1">
						<input id = "controlUntil" type ="text" class = "textControls" value = "10" onkeydown = "return isPressDigit(this,event)" maxlength = "3"/>
						</td>
				<?php
					}}
				?>
					<td width ="1" style = "padding-right:100px;padding-left:45px;">		
						<span id ="generateButton" class = "button1" onclick="generateReport()">Generate</span>
					</td>
					
					<td width ="1" style = "background-color:#7A8276;border-left:10px solid white;">
						<span class ="spanLabel" style="padding-right:10px;">Search</span>
					</td>
					<td width ="1" style = "background-color:#7A8276;padding-right:20px;">
						<input type ="text" id = "searchInput" style ="padding:5px;letter-spacing:2px;width:130px;font-family:oswald;text-align:center;font-weight:bold;"  onkeypress = "searchNow(this,event)"/>
					</td>
					<td width ="1" style = "padding-left:40px;">		
						<span style = "" id ="" class = "button2"  onclick="document.getElementById('bodyDiv').style.display='none';document.getElementById('encoder').style.display='block'">Releaser</span>
					</td>	
					<td width ="1" style = "padding-left:30px;">		
						<span style = "border-left:2px solid black;padding-left:5px;background-color:transparent;color:white;font-family: oswald;font-weight:bold;" id =""  onclick="">DB&nbsp;Year</span>
					</td>	
					<td width ="1" style = "">		
						<select id = "dbYear" style = "color:red;" class = "selectType" onchange = "changeClaimType(this)">
							<!--<option>2019</option>	
							<option>2018</option>	
							<option>2017</option>	
							<option>2016</option>	-->
							<?php
								date_default_timezone_set('Asia/Manila');	
								// $year =  date("Y");
								$year =  2023;
								for($i = 0; $i <= 6;$i++){
									echo "<option>" . intval($year-$i) . "</option>";
								}
							?>
						</select>
					</td>	
					<td>
						<div id = "closeMenu" onclick="closeMenu()" ></div>
					</td>
				</tr>
				</table>	
			</div>
		</div>
	</div>

	<div id  = "headerDiv">
		
	</div>
	
	<div id = "bodyDiv" style = "display:no1ne">
		<?php
			echo "<div style = 'padding-top:40px;'>Press <b>Esc</b> to Hide or Show tools.</div>";
			echo "<div style = 'padding-top:40px;border:0px solid silver;width:800px;margin:0 auto;text-align:left;color:grey;'><b>Search Criteria</b>
						 : Adv, TrackingNumber, Claimant, *Checknumber, -Officecode, /OBRnumber, @PRnumber, #POnumber
				      </div>
						";
			if(isset($_SESSION['fullName'])){
				echo "<div style= padding-top:40px;font-size:14px;color:grey;>" . $_SESSION['fullName'];
				echo "<br/>" . $_SESSION['position'] . "</div>";
			}else{
				
			}
		
		?>

	</div>
	<div id = "encoder" style = "width:770px;margin:0 auto;margin-top:50px;box-shadow: 0px 0px 20px 1px silver;padding:30px;display:none;background-color:rgba(255, 255, 255,.5)">
		<table id = "" border ="0" style= "width:100%;">
			<tr>
				<td colspan="3" style = "text-align:right;">
					<span class = "data1" style = "margin-right:5px;font-size:18px;" >Search TN#</span>
					<input id  ="ok" class = "text3" maxlength="18" style = "width:200px;font-weight: bold;font-family:oswald; padding:2px 5px; font-size: 22px;text-align:center;" onkeydown="keypressAndWhatClear(this,event,searchTracking,1)"   value = '' />
				</td>
			</tr>
			<tr>
				<td>
					<div id = "doctrackUpdateContainer" style = "min-height: 600px;">
				
					</div>	
				</td>
			</tr>
		</table>
	</div>
	<div id = "background" class = "back">
	</div>
<script>
	var sMonth = document.getElementById('sMonth');
	var sDay = document.getElementById('sDay');
	var sYear = document.getElementById('sYear');
	var d = new Date();
	//(d.getDay()+1);
	var monthIndex = d.getMonth();
	var dayIndex = d.getDate()-1;
	
	sMonth.selectedIndex = monthIndex;
	
	sDay.selectedIndex = dayIndex;
	
	sYear.value  = d.getFullYear();
	
	document.body.onkeydown = check;
	//generateReport();
	var state = 1;
	function check(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		
		if(charCode == 27){
			if(state  == 1){
				document.getElementById('menuContainer').style.display ="none";
				document.getElementById("background").style.display = "none";
				state = 0;
			}else{
				document.getElementById('menuContainer').style.display ="block";
				document.getElementById("background").style.display = "block";
				state = 1;
			}
		}
	}
	function closeMenu(){
		document.getElementById('menuContainer').style.display ="none";
		state = 0;
	}
	function changeClaimType(me){
		var year = me.value;
		document.getElementById("doctrackUpdateContainer").innerHTML = "";	
		focusNext('ok');
		if(year != 2016){
			document.getElementById('claimType').innerHTML = "<option>Check</option><option>Window</option><option>Other</option>";
		}else{
			document.getElementById('claimType').innerHTML = "<option>Payroll</option><option>Voucher</option>";
		}
	}
	
	function generateReport(){
		document.getElementById("bodyDiv").style.display = "block";
		document.getElementById("encoder").style.display = "none";
		
		 
		if(document.getElementById('dateActive').checked == true){
			var month = document.getElementById('sMonth').value;
			var day = document.getElementById('sDay').value;
			if(day < 10){
				day = "0" + day;
			}
			
			var year = document.getElementById('sYear').value;
			var sDate = year + "-" + month + "-" + day;
		}else{
			var sDate = "2";
		}	
		var claimType = document.getElementById('claimType').value;
		var fundType = document.getElementById('fundType').value;
		var status = document.getElementById('status').value;
		var dbYear = document.getElementById('dbYear').value;
		
		var from = "";
		var until = "";
		if(document.getElementById('controlFrom')){
			from = document.getElementById('controlFrom').value;
			until = document.getElementById('controlUntil').value;
		}
		loader();
		var queryString = "?generateReport=1&claimType=" + claimType + "&fundType=" + fundType + "&status=" + status + "&sDate=" + sDate + "&from=" + from + "&until=" + until + "&dbYear=" + dbYear;
		var container = document.getElementById('bodyDiv'); 
		ajaxGetAndConcatenate(queryString,processorLink,container,"generateReport");
		
	}
	function searchNow(me,evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		var dbYear = document.getElementById('dbYear').value;
		if(charCode == 13){
			document.getElementById("bodyDiv").style.display = "block";
			document.getElementById("encoder").style.display = "none";
			var searchValue = me.value;
			
			if(isValueNumber(searchValue)){
				var field  = "ADV";
			}else{
				var field  = "Claimant";
			}
			loader();
			var queryString = "?searchByTransmitalValue=1&field=" + field + "&searchValueReleaser=" + encodeURIComponent(searchValue) + "&dbYear=" + dbYear ;
			var container = document.getElementById('bodyDiv'); 
			ajaxGetAndConcatenate(queryString,processorLink,container,"SearchByTransmitalValue");
		}
	}
	function isValueNumber(number){
		var onlyNumber = /^[0-9]+$/.test(number);
		return onlyNumber;  
	}
	function showDate(me){
		if(me.checked == true){
			document.getElementById('dateContainer').style.display = "inline-block";
		}else{
			document.getElementById('dateContainer').style.display = "none";
		}	
	}
	//searchTracking(1,1);
	function searchTracking(me,para){
		
		var dbYear = document.getElementById('dbYear').value;
		//var trackingNumber = "pr-1011-13";
		//var trackingNumber = "4411-458";
		
		var trackingNumber =document.getElementById('ok').value;
		
		
		//var trackingNumber = "AN";
		//var trackingNumber = me.value.toUpperCase();
		var cancel = trackingNumber.substr(0,6).toUpperCase(); 
		
		if(cancel == "CANCEL"){
			var orig = trackingNumber.replace("CANCEL","");
			var answer = confirm("You are about to cancel TN# : " + orig);
			if(answer){
				var queryString = "?cancelTrackingNumber=1&trackingNumber=" + orig;
				var container = document.getElementById('doctrackUpdateContainer');
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"searchTrackingNumber");
			}
		}else{
			if(trackingNumber.length > 1){
				var queryString = "?searchTrackingNumber2018=1&trackingNumber=" + trackingNumber + "&dbYear=" + dbYear;
				var container = document.getElementById('doctrackUpdateContainer');
				
				loader();
				ajaxGetAndConcatenate1(queryString,processorLink,container,"searchTrackingNumber2018");
			}
		}		
	}
	function saveControl(me){
		var adv = document.getElementById('adv').textContent;
		if(adv == 99999){
			alert("Please change ADV number.");
		}else{
			var ctrlNo = -1;
			var answer = confirm("Confirm action?");
			if(answer){
				var trackingNumber = me.id.replace("control",'');
				var claimType = document.getElementById("claimTypeTrans").textContent;
				var trackingType = document.getElementById("trackingType").textContent;
				var docType = document.getElementById("docTypeTrans").textContent;
				
				var dbYear = document.getElementById('dbYear').value;
				//var encoded = "2017-10-09 09:03 AM";
				var encoded = document.getElementById('trackingEncoded').textContent;
				ctrlNo = document.getElementById('divCtrl').textContent; 

				var netAmount = 0.00;
				var netElem = document.getElementById('forReleaseNet');
				if(typeof(netElem) != 'undefined' && netElem != null) {
					netAmount = netElem.textContent.trim().replace(/,/g, "");
				}
				
				loader();
				var queryString = "?saveControl2018=1&trackingNumber=" + trackingNumber + "&ctrlNo=" + ctrlNo + "&encoded=" + encoded + "&dbYear=" + dbYear + "&claimType=" + claimType  + "&trackingType=" + trackingType + "&docType=" + docType + "&netAmount=" + netAmount;       
				var container = document.getElementById('doctrackUpdateContainer'); 
				ajaxGetAndConcatenate1(queryString,processorLink,container,"saveControl2018");
				
				sendSms(trackingNumber);
			}
		}
	}
	function skipAndSave(me){
		var adv = document.getElementById('adv').textContent;
		if(adv == 99999){
			alert("Please change ADV number.");
		}else{
			var ctrlNo = -1;
			var answer = confirm("Confirm action?");
			if(answer){
				var trackingNumber = me.id.replace("skipAndSave",'');
				var claimType = document.getElementById("claimTypeTrans").textContent;
				var trackingType = document.getElementById("trackingType").textContent;
				var docType = document.getElementById("docTypeTrans").textContent;
				var dbYear = document.getElementById('dbYear').value;
				//var encoded = "2017-10-09 09:03 AM";
				var encoded = document.getElementById('trackingEncoded').textContent;
				if(document.getElementById('divCtrl')){
					ctrlNo = document.getElementById('divCtrl').textContent;
				}else{
					ctrlNo = 0;
				}

				var netAmount = 0.00;
				var netElem = document.getElementById('forReleaseNet');
				if(typeof(netElem) != 'undefined' && netElem != null) {
					netAmount = netElem.textContent.trim().replace(/,/g, "");
				}
				
				loader();
				var queryString = "?skipAndSave2018=1&trackingNumber=" + trackingNumber + "&ctrlNo=" + ctrlNo + "&encoded=" + encoded + "&dbYear=" + dbYear + "&claimType=" + claimType  + "&trackingType=" + trackingType + "&docType=" + docType + "&netAmount=" + netAmount;      
				var container = document.getElementById('doctrackUpdateContainer'); 
			
				ajaxGetAndConcatenate1(queryString,processorLink,container,"skipAndSave2018");
				sendSms(trackingNumber);
			}
		}
	}
	function viewHistory(me){
		var dbYear = document.getElementById('dbYear').value;
		var trackingNumber  = me.id.replace("history",'');
		var container =  document.getElementById("historyContainer");
		if(container.children.length > 0){
			document.getElementById("historyArrow").innerHTML = "&#9658";
			container.innerHTML = "";
		}else{
			document.getElementById("historyArrow").innerHTML = "&#9660";
			loader();
			var queryString = "?viewHistory2018=1&trackingNumber=" + trackingNumber + "&dbYear=" + dbYear;
			ajaxGetAndConcatenate1(queryString,processorLink,container,"viewHistory2018");
		}
	}
	function editThis(me){
		var arr = me.id.split('*');
		var trackingNumber = arr[0];
		var fieldName = arr[1];
	
		/*if(fieldName == "Claimant"){
			
			var oldValue = me.parentNode.children[0].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}
		if(fieldName == "Adv"){
			var oldValue = me.parentNode.children[0].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}
		if(fieldName == "Fund"){
			var oldValue = me.parentNode.children[0].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}*/
		var oldValue = me.parentNode.children[0].textContent.trim();
		
		editor(fieldName,trackingNumber,oldValue,goUpdate);
	}
	function goUpdate(me){
		
		var field = me.parentNode.parentNode.parentNode.children[1].children[0].textContent;
		var dbYear = document.getElementById('dbYear').value;
		var value =  encodeURIComponent(me.parentNode.parentNode.parentNode.children[1].children[1].children[0].value);
		var error = 0;
		if(value == 0){
			error  =1;
		}
		if(value.length == 0){
			error  = 2;
		}
		var oldvalue = me.parentNode.children[0].value;
		
		/*if(field == "Type"){
			if(dbYear == "2016"){
				field = "TransactionType";
			}else{
				field = "ClaimType";
			}
		}*/
		if(field.substring(0,3) == "ADV"){
			field = "Adv1";
		}/*
		if(field.substring(0,3) == "Net"){
			field = "NetAmount";
			
		}
		if(field.substring(0,3) == "LTO"){
			field = "LTO";
		}
		if(field.substring(6) == "Type"){
			field = "ClaimType";
		}
		if(field == "Document"){
			field = "DocumentType";
		}
		if(field == "Period"){
			field = "PeriodMonth";
		}*/
		
		if(error  == 0){
			if(field == "Fund"){
				var trackingNumber =  me.id;
				var queryString = "?editField2018=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue + "&dbYear=" + dbYear;              
				var container = document.getElementById('doctrackUpdateContainer'); 
			}else if (field == "Document"){
				if(dbYear == "2016"){
					field = "ClaimType";
				}else{
					field = "DocumentType";
				}
				var trackingNumber =  me.id.replace("editor","");
				var queryString = "?editField2018=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue + "&dbYear=" + dbYear;    
				var container = document.getElementById('doctrackUpdateContainer'); 		
			}else if (field.substring(0,3) == "Adv"){
				var trackingNumber =  me.id.replace("editor","");
				field = field + "1";
				var queryString = "?editField2018=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue + "&dbYear=" + dbYear;         
				var container = document.getElementById('doctrackUpdateContainer'); 
						
			}else if (field.substring(0,4) == "Type"){
				if(dbYear == "2016"){
					field = "TransactionType";
				}else{
					field = "ClaimType";
				}
				var trackingNumber =  me.id.replace("editor","");
				var queryString = "?editField2018=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue + "&dbYear=" + dbYear;    
				var container = document.getElementById('doctrackUpdateContainer'); 		
			}else{
				var trackingNumber =  me.id.replace("editor","");
				var queryString = "?editField2018=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue + "&dbYear=" + dbYear;    
				var container = document.getElementById('doctrackUpdateContainer'); 	
			}
			loader();
			ajaxGetAndConcatenate1(queryString,processorLink,container,"editField2018");
		}else{
			alert("Please enter new " + field + " value.");
		}
	}
	
	

</script>



