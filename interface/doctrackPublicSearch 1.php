<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<?php

	defined('ROOTER') ? NULL : define("ROOTER","../");	
	require_once(ROOTER . 'javascript/ajaxFunction.php');
	require_once(ROOTER . 'includes/database.php');
?>

<style>
	/*-----------------------------------------------------------------loader*/
	.loader{
			width:140px;
			height:165px;
			top:40%;
			background:url('../images/40.gif');
			background-repeat:no-repeat;
			background-size:120px 120px;
			background-position:48% 48%;
			z-index:100;
			
	}	
	.loaderContainer{
		border:4px solid transparent;
		box-shadow: 0px 0px 30px 0px rgba(11, 60, 110,.2);
		background-color: rgba(7, 7, 7,.81);
		border-radius: 0px 25px 0px 25px ;
		//border-radius:50%;
		display:inline-block;	
	}
	.loaderContainer::after{
		content:"Hulat kadali";
		padding-left:10px;
		color:white;
		position:absolute;
		margin-top:-18px;
		margin-left:-54px;
		font-size:14px;
		letter-spacing: 1px;
		text-shadow: 0px 0px 2px black;
	}
	.absoluteHolder{
		z-index:105;
		position:absolute;
		text-align:center;
		background-color:rgba(4, 4, 4,.3);
		width:100%;
		height:100%;
	}
	.absoluteHolder1{
		z-index:105;
		position:absolute;
		text-align:center;
		//background-color:rgba(252, 254, 254,.8);
		width:100%;
		height:100%;
	}
	.editorContainer{
		border:4px solid transparent;
		border-radius:2px;
		box-shadow:0px 0px 20px 10px rgba(0, 0, 0,.4);
		background-color:white;
		display:inline-block;	
	}
	/*-----------------------------------------------------------------loader*/
	body{
		background:url(../images/or.jpg);	
		background-size:  1920px 1091px; 
		//background-repeat:no-repeat;
		padding:0;
		margin:0;
		font-family:myriad-set-pro_bold;
		
	}
	@font-face{
		src: url(../fonts/myriad-set-pro_bold.ttf);
		font-family:myriad-set-pro_bold;
	}
	@font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
	}
	.bodyDiv{
		width:100%;
		height:100%;
		background:url(../images/BG1.png);
		background-size:300px 100px ;
		opacity: .3;
		background-color: rgba(14, 11, 245,.1);
		background-color: rgba(1, 1, 1,.4);
		position: absolute;
	}
	.bodyDiv1{
		width:100%;
		height:100%;
		background-color: rgba(19, 136, 225,.1);
		position: absolute;
	}
	.skeletal{
		width:100%;
		height:100%;
	}
	.logo,.logo1{
		height:90px;
		width:90px;
		opacity:.3;
		
		margin:0 auto;
		background:url(../images/davao.png);	
		background-size:100% 100%;
		background-repeat:no-repeat;
		
		box-shadow:0px 0px 20px 5px rgba(4, 4, 4,.9);
		display: inline-block;
		border-radius: 50%;
	}
	.logo1{
		background:url(../images/acctg.png);	
		background-size:100% 100%;
	}
	
	.divAdvance{
		width:95%;
		
		margin-top:-100px;
		text-align: right;
	}
	.tdMenu{
		color:white;
	}
	.inputText{
		border-radius:6px;
		padding:8px;
		padding-left:10px;
		border-top:2px solid grey;
		border-left:2px solid grey;
		border-bottom:1px solid white;
		border-right:1px solid white;
		font-family: Arial ;
		font-weight: bold;
		letter-spacing:2px;
		background-color: white;
		font-size:24px;
		width:400px;
		text-align: center;
		letter-spacing: 2px;
		box-shadow: 0px 0px 15px 5px rgb(198, 213, 226) inset ;
		text-shadow: 0px 0px 1px grey;
	}
	.label1{
		color:rgb(246, 242, 243);
		font-size: 22px;
		letter-spacing: 2px;
		text-shadow: 0px 1px 2px black;
	}
	.label2{
		color:silver;	
		font-family:Helvetica;
		font-size: 12px;
		letter-spacing: 1px;
		text-shadow: 0px 1px 2px black;
	}
	.label3{
		color:rgb(27, 141, 198);
		color:silver;
		text-align: center;
		font-family: Courier New;
		font-size: 13px;
		font-weight: bold;
		letter-spacing: -1;
	}
	.containerDiv{
		width:90%;
		height:700px;
		overflow-y: auto;
		margin:0 auto;
		margin-top: 10px;
		padding-top: 10px;
		//background-color: rgba(0, 0, 0,.6);
		box-shadow: 0px 0px 100px 0px rgba(1, 1, 1,.8);
	}
	.label4{
		background-color:rgba(122, 119, 119,.5);
		padding:0 10px;
		font-size:20px;
		text-overflow:nowrap;
		white-space: nowrap;
		text-align: right;
		border-radius: 5px 0px 0px 0px;
		border-right: 1px solid grey;
		
	}
	.label5{
		color:white;
		font-size:29px;
		text-overflow:nowrap;
		white-space: nowrap;
		text-shadow:0px 0px 4px black;
		
	}	
	.label6{
		color:silver;
		font-family: Helvetica;
		font-size: 12px;
		text-overflow:nowrap;
		white-space: nowrap;
	}
	.label7{
		font-size:20px;
		font-weight: bold;
		text-shadow: 0px 0px 2px grey;
		font-family: Arial;
	}
	.label8{
		font-size: 14px;
		color:grey;
	}
	.label9{
		background-color:rgba(1,1,1,.2);
		padding:0px 6px;
		border-right:3px solid grey;
		letter-spacing: 2px;
		font-size: 24px;
		border-radius: 2px;
		color:orange;
		color:rgb(37, 151, 203);
		font-style: italic;
		text-shadow: 0px 1px 3px black;
		font-weight: bold;
		
		
	}
	.td1{
		text-align: right;
		vertical-align: middle;
	}
	.td2{
		border-bottom: 1px dashed grey;
		padding-left:10px;
		padding-top:5px;
	}
	.td3{
		padding:4px 5px;
	}
	.td4{
		background-color:rgba(192, 192, 192,.4);	
		padding:4px 5px;
		border-bottom: 2px solid grey;
	}
	.select{
		background-color: transparent;
		border:1px solid grey;
		font-weight: bold;
		color:grey;
		
	}
	.number{
		height:30px;
		width:30px;
		
		font-size:24px;
		background-color:rgba(128, 128, 128,.8);
		background-color: rgba(0, 0, 0,.3);
		line-height: 32px;
		border-radius: 50%;
		color:rgb(74, 177, 241);
		color:orange;
		text-shadow: 0px 0px 2px black;
		text-align: center;
	}
	.trHover{
		transition: all .3s linear ;
		cursor: pointer;	
	}
	.wiggle{
		animation: myfirst .4s;
		animation-direction: alternate;
    		animation-timing-function: linear;
		
		-webkit-animation: myfirst .4s;
		-webkit-animation-direction: alternate;
    		-webkit-animation-timing-function: linear;
	}
	.buttonLogin{
		
	/*	border:1px solid rgb(149, 156, 159);
		
		
		background-color:rgb(23, 62, 76);
		border-radius:1px;
		box-shadow: 0px 0px 8px  1px grey;
		text-shadow: 0px 0px 3px black;
		color:rgb(209, 216, 218);
		text-align:center;
		
		padding:4px 10px;
		margin:0 auto;
		margin:10px;*/
		padding:4px 10px;
		letter-spacing: 1px;
		font-size:14px;
		cursor:pointer;
		font-weight:bold;
		transition: all .5s;
	}
	.buttonLogin:Hover{
		border:1px solid rgb(150, 154, 155);
		border-right:3px solid grey;
		color:white;
		box-shadow: 0px 0px 6px  1px silver;
	}
	@keyframes myfirst {
		0%   { margin-left:0px; }
	    20%  { margin-left:-16px; }
	    40%  { margin-left:14px; }
	    60%  { margin-left:-12px; }
	    80%  { margin-left:12px; }
		100% { margin-left:8px;}
	}
	@-webkit-keyframes myfirst {
		0%   { margin-left:0px; }
	    20%  { margin-left:-16px; }
	    40%  { margin-left:14px; }
	    60%  { margin-left:-12px; }
	    80%  { margin-left:12px; }
		100% { margin-left:8px;}
	}

	#pubSearchBar::-webkit-input-placeholder,
	#pubSearchBar1::-webkit-input-placeholder {
		font-size:16px;
		letter-spacing: 0px;
		font-weight:normal;
	}
	#pubSearchBar::-moz-placeholder,
	#pubSearchBar1::-moz-placeholder {
		font-size:12px;
	}
	#pubSearchBar::-ms-input-placeholder,
	#pubSearchBar1::-ms-input-placeholder {
		font-size:12px;
	}

	.label1{
		font-weight:normal;
		font-size:14px;
	}
	.hoverLink:hover{
		text-shadow: 0px 0px 10px black;
		transition: all .1s ease-in;
		color: white;
		cursor: pointer;
	}
	.inputText1{
		width:180px;
		border: 0px;
		border-bottom: 1px solid lightgray;
		box-shadow:none;
		background-color: transparent;
		font-family:Oswald;
		font-size:14px;
		text-align: center;
		letter-spacing: 1px;
		font-weight: bold;
		border-bottom: 1px solid gray;
	}
	.searchBtn{
		margin:15px auto;
		background-color:#1291B4;
		border:0px solid silver;
		border-right:1px solid silver;
		border-top:1px solid white;
		border-left:1px solid white;
		border-bottom:1px solid silver;
		width:60px;
		padding:5px;
		text-align:center;
		border-radius:4px;
		letter-spacing:1px;
		cursor:pointer;
		text-shadow:1px 0px 1px grey;
		box-shadow:0px 0px 4px 1px #1291B4;
		height: 25px;
		color: white;
		font-family: Oswald;
		font-size: 16px;
	}
	.searchBtn:hover{
		box-shadow:0px 0px 4px 3px #1291B4;
	}
	input[name="paySearchType"]:checked + label {
	  letter-spacing: 1px;
	  font-weight: bold;
	}
</style>
<html>
	<head>
		<title>City Document Tracking v3</title>
		<link rel="icon" href="/citydoc2017/images/red.png"/> 
		
	</head>
	<body>
		
						<div class ="bodyDiv" style = ""></div>
						<div class ="bodyDiv1">
							
							<table class="skeletal" style ="" border = "0">
								<tr>
									<td colspan="2" style = "padding-left:50px;padding-top:5px;height:50px; background-color:rg1ba(5, 78, 147,.4);">
										<div class = "logo"></div>
										<div class = "logo1" style= "margin-left:10px;"></div>
										
										
										<div  class = "divAdvance">
											
											<table style = "position:absolute;margin-left:22px;margin-top:80px;margin-left:50px;" border = "0">
												<tr>
													<td style = "vertical-align:top;padding-top:35px;"><span class = "label8" style = "font-family:Oswald;">Search Year</span></td>
													<td>
														<select id ="year" class = "select" onchange = "changeYear(this)" style = "font-family:Oswald;font-size:42px;border:0;-moz-appearance: none;-webkit-appearance: none;">
															<option>2022</option>
															<option>2021</option>
															<option>2020</option>
															<option>2019</option>
															<option>2018</option>
															<option>2017</option>
															<option>2016</option>
														</select>	
														<div style="">
															<select id ="type" class = "select" onchange = "changeType(this)"  style = "font-weight:normal;margin-top:-17px; font-size:22px;border:0;-moz-appearance: none;-webkit-appearance: none;font-family: Oswald;letter-spacing:1px;">
																
																<option>Tracking</option>
																<option>Advice</option>
															</select>	
														</div>
													</td>
												</tr>
												
											</table>
											<span class = "buttonLogin label9" onclick = "gotoLogIn()">LOGIN</span>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2" class = "tdMenu" style = "height:10px;"></td>
								</tr>
								<tr>
									<td style = "width: 50%; text-align: right;">
										<table style="margin:0 auto; display:inline-block;" border="0">
											<tr>
												<td style = "vertical-align: bottom;">
													
													<span class = "label9" id = "dYear"></span>
													<span class = "label1">DOCUMENT SEARCH</span>
													<div class = "logo2" style= ""></div>
													<div class = "logo3" style= ""></div>
												</td>
											</tr>
											<tr>
												<td>
													<input  class = "inputText " type ="text" maxlength="15" id="pubSearchBar" onkeydown="keypressAndWhatClear(this,event,test,1)" value = "" placeholder="Type tracking number or claimant."/>
												</td>
											</tr>
										</table>
									</td>
									<td style="vertical-align: bottom;">
										<table style="margin:0 auto; margin-left: 12px;" border="0">
											<tr>
												<td style=" vertical-align: bottom;">
													<span class = "label1">PAYROLL</span>
												</td>
												<td style = "padding-bottom: 4px;">
													<div style="display: inline-block; float: right; padding-right:10px; font-family:Oswald; color:orange; font-size:13px; user-select: none; -moz-user-select:none;">
														<span style="color:gray;">Search By :</span>
														<input style="cursor: pointer;" type="radio" name="paySearchType" id="pstName" onchange="showHidePayrollSearch(this)">
														<label style="cursor: pointer;" for="pstName">Name</label>
														<input style="cursor: pointer;" type="radio" name="paySearchType" id="pstEmpNum" onchange="showHidePayrollSearch(this)" checked>
														<label style="cursor: pointer;" for="pstEmpNum">Employee No.</label>
													</div>
												</td>
											</tr>
											<tr>
												<td colspan="2" style="padding-bottom: 3px;">
													<input  class = "inputText " type ="text" maxlength="15" id="pubSearchBar1" onkeydown="keypressAndWhatClear(1,event,payrollSearch,1)" style="padding:8px; width:403px;" placeholder="Type Employee number then press enter."/>
													<span class="inputText" id="pubSearchBar2" style="padding:0px; display: none; ">
														<table border="0" style="border-spacing:0px; margin:0px auto; text-align:center; font-family:Oswald; font-size:11px; color: black; display:inline-block; line-height:16px;">
															<tr>
																<td><input type="" id="pubSearchLName" class="inputText1"></td>
																<td><input type="" id="pubSearchFName" class="inputText1" onkeydown="keypressAndWhatClear(2,event,payrollSearch,1)"></td>
															</tr>
															<tr>
																<td>Last Name</td>
																<td>First Name</td>
															</tr>
														</table>
														<span class="searchBtn" style="position:absolute; margin-left: 26px; margin-top: 4px;" onclick="payrollSearch(2)" id="payrollSearch">Search</span>
													</span>
												</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="2"  style = "vertical-align: top;">
										<div class ="containerDiv" id = "containerDiv">
											<div class = 'wiggle' style = 'color:white;font-size:48px; display:block;margin-top:60px ;text-align:center;text-shadow:0px 2px 2px black;'>You can now track your salary using your name or employee number.</div>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<div style="text-align: center;padding:10px;color:rgb(215, 221, 225);color:lime;background-color: rgb(28, 32, 27);letter-spacing: 1px;">
											<span onclick="gotoSurvey()" class = "hoverLink">CITY GOVERNMENT OF DAVAO CLIENT SATISFACTION FORM</span>
											<br/>
											<span style = "color:silver;font-weight: arial;font-family: helvetica;font-size: 11px;letter-spacing: 1px;">(To improve our services please send us your feedback by clicking the link above.)</span>
										</div>
									</td>
								</tr>
							</table>
							
						</div>
				
		
	</body>
</html>
<script>
	pstEmpNum.click();
	document.getElementById("dYear").innerHTML = "2022";
	
	function  changeYear(me){
		var year = me.value;
		document.getElementById("dYear").innerHTML = year;
	}
	function  changeType(me){
		if(me.value == "Tracking"){
			document.getElementById("pubSearchBar").placeholder = "Type tracking number or claimant then press enter.";
		}else{
			document.getElementById("pubSearchBar").placeholder = "Type checknumber or adv number then press enter.";
		}
	}
	function test(me,evt){
		var key = me.value;	
		var year  = document.getElementById("year").value;
		var type = document.getElementById("type").value;

		if(type == "Tracking"){
			if(key.length > 2 ){
				var queryString = "?publicSearch=1&searchKey=" + key + "&year=" + year;
				var container = document.getElementById('containerDiv');
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
			}else{
				
				var container = document.getElementById('containerDiv');
				container.innerHTML = "<div class = 'wiggle' style = 'color:white;font-size:48px;   display:block;margin-top:60px ;text-align:center;text-shadow:0px 2px 2px black;'>Taasi gamay ang i search.</div>";
			}
		}else{
			var queryString = "?publicSearchAdviser=1&searchKey=" + key;
			var container = document.getElementById('containerDiv');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
		}
		
	}

	function payrollSearch(type){
		var fname = document.getElementById('pubSearchFName').value;
		var lname = document.getElementById('pubSearchLName').value;
		var empno = document.getElementById('pubSearchBar1').value;
		var year  = document.getElementById("year").value;

		if(year > 2020){
			var key = "";
			if(type == 1){
				key = empno;
			}else{
				if(lname != "" || fname != ""){
					key = lname+"*j*"+fname;
				}else{
					key = "";
				}
			}

			if(key.length > 1){
				var queryString = "?publicSearchPayroll=1&searchKey=" + key + "&year=" + year+ "&type=" + type;
				var container = document.getElementById('containerDiv');
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
			}else{
				var container = document.getElementById('containerDiv');
				container.innerHTML = "<div class = 'wiggle' style = 'color:white;font-size:48px;   display:block;margin-top:60px ;text-align:center;text-shadow:0px 2px 2px black;'>Taasi gamay ang i search.</div>";
			}
		}else{
			var container = document.getElementById('containerDiv');
				container.innerHTML = "<div class = 'wiggle' style = 'color:white;font-size:48px; display:block;margin-top:60px ;text-align:center;text-shadow:0px 2px 2px black;'>Payroll search available only for year 2021 and above.</div>"
				+"<div style='color:silver;font-size:36px;text-align:center;text-shadow:0px 2px 2px black; font-family:Oswald;'>"
				+"	Please use document search."
				+"</div>";
		}
		
	}
	
	function searchPOTracking(me){
		var tn = me.textContent;
		var year  = document.getElementById("year").value;
		var queryString = "?publicSearch=1&searchKey=" + tn + "&year=" + year;
		var container = document.getElementById('containerDiv');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	
	//searchThis("mtcc-148");
	function searchThis(key){
		var year  = document.getElementById("year").value;
		var queryString = "?publicSearch=1&searchKey=" + key + "&year=" + year;
		var container = document.getElementById('containerDiv');
		
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	function showBatchAdvice(me){
		var id = me.textContent;
		var x = me.parentNode.children[0].innerHTML;
		
		var queryString = "?adviseBatch=1&adviceId=" + id + "&year=" + x;
		var container = document.getElementById('containerDiv');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	function highlight(me){
		var  color = me.style.backgroundColor;
		var row = me.rowIndex + 1;
		var status = me.children[6].children[0];
		if(color != "orange"){
			me.style.backgroundColor = "orange";
			status.style.color ="black";
			status.style.color ="white";
			status.style.textShadow ="0px 0px 2px white";
			status.style.textShadow ="0px 0px 2px black";
		}else{
			if(row %  2 == 0){
				me.style.backgroundColor ="rgba(2, 2, 2,0)";
			}else{
				me.style.backgroundColor = "rgba(2, 2, 2,.3)";
			}
			if(status.textContent == "CAO Released"){
				status.style.color ="rgb(235, 76, 158)";
				status.style.textShadow ="0px 0px 2px black";
			}else{
				
				if(status.textContent.indexOf("Pending") > -1){
					status.style.color ="green";
					status.style.textShadow ="0px 0px 3px black";
				}else{
					status.style.color ="rgb(23, 183, 236)";
					status.style.textShadow ="0px 0px 3px black";
				}
			}
		}
	}
	
	function clickToSearch(me){
		var trackingNumber = me.children[1].children[0].textContent;
		searchThis(trackingNumber);
	}
	function error(t){ 
		t.className += " wiggle"
		setTimeout(
			function(){		
				t.className = t.className.replace(/\b wiggle\b/,'');
				
			},800);
	}//wiggle
	
	function gotoLogIn(){
		window.open('../interface/login.php','_self');
	}
	function gotoSurvey(){
		window.open('https://docs.google.com/forms/d/e/1FAIpQLSdQz-HUgd49qt_AMEvKo4GAaCXCtmcYNSstmFyGiQPgusMejQ/viewform?fbclid=IwAR3MUPFXFyx7KFiMIbY8ooXb469BWQ2rMJkfGe6GssjVPiBjAbpzO9yRs9k');
	}

	function showHidePayrollSearch(me){
		var type = me.id;

		var empno = document.getElementById('pubSearchBar1');
		var name = document.getElementById('pubSearchBar2');

		if(type == "pstName"){
			empno.style.display = "none";
			name.style.display = "inline-block";
		}else{
			empno.style.display = "";
			name.style.display = "none";
		}
	}
</script>


