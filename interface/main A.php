<META http-equiv=Content-Type content="text/html; charset=iso-8859-1"> 
<!--<META http-equiv="Content-Type" content="text/html;charset=UTF-8">-->
<?php
	if(!isset($_SESSION)){
		session_start();
	}
	defined('ROOTER') ? NULL : define("ROOTER","../");
	//defined('ROOTER') ? NULL : define("ROOTER","/");
	require_once(ROOTER . 'javascript/ajaxFunction.php');
	require_once(ROOTER . 'includes/database.php');
	
	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
		echo $link;
	}
	
?>
<!DOCTYPE HTML>


<style>
	@font-face {
	        font-family: "Robot";
	        src: url("../fonts/AlexBrush-Regular.ttf");
	}
	@font-face {
	        font-family: "r1";
	        src: url("../fonts/AlexBrush-Regular.ttf");
	}
	body{
		padding:0;
		margin:0;
	}
	
	.mainTable{
		height:100%;
		width:100%;
		border-spacing:0;
		border:0px solid transparent;
		background:url(../images/or.jpg);	
		background-size:120%; 
		//background-repeat:no-repeat;
		background-position:0px -190px;	
	}
	
	.tdMainMenu{ 
		padding:0;	
	}
	#tdFooter{
		background:url(../images/footer.jpg);	
		background-repeat:repeat;
		background-position:0px -20px;
	}
	
	.menuContainer1{
		text-align:right;
		padding-right:20px;
		
	}
	.menu1{
		display:inline-block;
		padding:5px 10px;
		color:silver;
		cursor:pointer;
		transition: all .3s ease-in;
		height:100%;
		
	}
	.menu1Selected{
		display:inline-block;
		color:white;
		background-color:rgb(150, 56, 66);
		
		background-color:rgb(35, 116, 157);
		
		text-shadow:0px 0px 2px black;
		border-radius:2px 2px 0px 0px;
		padding:5px 10px;
	}
	.menu1:hover{
		color:white;
		text-shadow:0px 0px 2px black;
		padding:5px 10px;
	}
	#mainContainer{
		background-color:rgb(243, 241, 242);
		
		height:100%;
		margin:0 auto;
	}
	.hide{
		display:none;
	}
	.mainBodyshow{
		height:100%;
	}
	.logo{
		height:90px;
		width:160px;
		
		position:absolute;
		margin-left:-172px;
		
		background:url(../images/lifeishere.png);	
		//background-color: white;
		
		background-size:100% 100%;
		background-repeat:no-repeat;
		//opacity:.8;
	}
	.logo1{
		height:107px;
		width:107px;
		position:absolute;
		margin-left:-282px;
		margin-top:-10px;
		background:url(../images/dvo.png);	
		background-size:100% 100%;
		background-repeat:no-repeat;
		//opacity:.8;
	}
	#tdBody{
		background:url(../images/Bg1.png);	
		background-position-x: 0px;
		background-position-y: 70px;
		background-size:340px 120px ;		
	}
	
	.title{
		color:white;
		font-weight:bold;
		font-size:24px;
		display:inline-block;
		margin:0 auto;
		
		text-shadow:0px 0px 2px black;
		
		height: 10px;
	}
	@font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
	}
	@font-face {
	        font-family: "Anton";
	        src: url("../fonts/Anton-Regular.ttf");
	}
	.year{
	
		font-family: Anton;
	}
	.subTitle{
		color:white;
		font-size:14px;
		margin:0 auto;
		margin-top:21px;
		letter-spacing:2px;
		font-family: Oswald;
		padding-left:130px;
		
		text-align:right;
		padding-right: 5px;
		border-top:1px solid black; 
		
		background-color: rgb(146, 148, 95);
	}
	.subTitle:after{
		margin-left:5px;
		content:"";
		border-bottom:22px solid transparent;
		border-left:22px solid rgb(146, 148, 95);
		width:0;
		height:0;
		position:absolute;
	}
	.portal{
		height:40px;
		width:240px;
		font-family: oswald;
		color:white;
		padding-left:210px;
		padding-right: 20PX;
		cursor: pointer;
	}
	.years:hover{
		color:white;
		font-family: anton;
		letter-spacing: 1px;
	}
	.version{
		font-size:12px;
		color:orange;
		font-weight:normal;
	}
	.footTitle{
		color:rgb(42, 56, 67);
		color:black;
		//font-weight:bold;
		font-size:14px;
		letter-spacing:2px;
		text-shadow:0px 0px 2px white;
		text-align:center;
	}
	.footTitle1{
		color:rgb(42, 56, 67);
		color:black;
		//font-weight:bold;
		font-size:10px;
		letter-spacing:2px;
		text-shadow:0px 0px 2px white;
		text-align:center;
	}
	.footTitle2{
		color:rgb(42, 56, 67);
		color:black;
		//font-weight:bold;
		font-size:10px;
		letter-spacing:2px;
		text-shadow:0px 0px 2px white;
	}
	.onlineContainer{
		display:inline-block;
		color:white;
		
		width:100%;
		text-shadow:0px 0px 0px;
		float:right;
		
		border-radius:0px 0px 0px 2px; 
		
		font-size:16px;
		text-shadow:0px 0px 2px black;
		margin-top:30px;
		
	
	}
	.activeName{
		//font-family: mainFont;
		
		font-weight: bold;
		font-size:20px;
		letter-spacing:2px;
	}
	.activePosition{
		border-top:1px solid rgb(91, 97, 102);
		border-top:1px solid rgb(54, 76, 96);
		
		font-size:13px;
		color:rgb(28, 138, 217);
		letter-spacing:2px;
		text-shadow:0px 0px 0px rgb(35, 116, 157);
		
		//background-color: rgb(22, 42, 56);
		padding:3px 0px;
	}
	.activeOffice{
		color:orange;
		font-size: 12px;
		letter-spacing: 1px;
		//color:rgb(206, 164, 108);
		//font-style:italic;
		
	}
	.panelDiv{
		background-color: transparent;
		margin:5px;
		height:600px;
		width:150px;
	}
	.tdPanel{
		vertical-align:top;
		background:url(../images/BG1.png);
		
		background-size:340px 120px ;
		background-position:-119px -50px;	
		padding:0;
	}
	#infoStatus{
		background-color:white;
		float:right;
		width:20px;
		
		background:url(../images/info.png);	
		background-size:100% 100%;
		background-repeat:no-repeat;
		opacity:.7;
	}
	
	.showMessage{
		
		transition: all 1s;
		
		position:absolute;
		background-color: rgb(3, 3, 3);
		
		border-radius:8px 8px 8px 0px;
		
		margin-top:-100px;
		height:620px;
		width:180px;
		
		padding:1px 2px;
		padding-bottom:20px;
		border:1px solid rgb(85, 87, 88);
		box-shadow:0px 0px 10px 1px black;
	}
	.hideMessage{
		transition: all 1s;	
		height:0px;
		width:0px;
	}
	.onhover:hover{
		color:white;
		font-style: italic;
		cursor: pointer;
	}
	.close{
		cursor: pointer;
		height:16px;
		width:16px;
		border-radius: 2px;
		border-right:1px solid silver;
		border-bottom:1px solid silver;
	}
	#attentionDisplay{
		width:190px;
		height:145px;
		border:1px solid black;
		
		position: absolute;
		display: inline-block;
		
		margin-left: -95px;
		//background:url(../images/feb1.png);
		box-shadow: 0px 0px 10px 2px  black;
		background-repeat: no-repeat;
		background-position: -15px -16px;
		background-size:210px 180px ;
		//display: none;
	}
	.linksA:hover{
		color:white;
		cursor: pointer;
		font-style: italic;
	}
	a{
		color:silver;
		text-decoration: none;
	}
	a:hover{
		color:white;
	}
	.decor{
		background:url(../images/hugs.gif);
		background-size:150px 130px ;
		background-repeat: no-repeat;
		width:150px;
		height:200px;
		margin:10px auto;
		border-radius: 15px;
		box-shadow: 0px 0px 40px 0px rgba(238, 230, 220,.5);
		border:2px solid black;
	}
	.decor:before{
		content:"Merry Christmas";
		//background-color:grey;
		padding:0px 4px;
		display: inline-block;
		position: absolute;
		font-size: 26px;
		margin-top:135px;
		margin-left:-88px;
		font-family: r1;
		border-radius:5px;
	}
	.decor:after{
		content:"Everyone";
		padding:0px 4px;
		display: inline-block;
		position: absolute;
		font-size: 35px;
		margin-top:165px;
		border-top:1px dashed rgb(110, 206, 250);
		margin-left:-70px;
		font-family: r1;
		letter-spacing: 3px;
		width: 130px;
	}
</style>

<html>
	<head>
		<title>2018 DocTrack v4</title>
		<link rel="icon" href="/citydoc2018/images/red.png"/> 
		<link rel="stylesheet" href="../css/style.css" />
	</head>
	<body>
			
			<table class = "mainTable" border ="0"  >
				<tr>
					
					<?php
						if(isset($_SESSION['employeeNumber'])){
					?>
							<td  class = "tdPanel" rowspan = "4" style="width:100px;background-colo:rgba(5, 50, 95,.4);">
								
								<table border ="0" style = "border-spacing:0; height:100%; width:225px;">
									<tr >	
										<td style = "height:40px;background-color:rgba(1, 1, 1,.6); color:white;text-align:center;font-family:Oswald;">
											<div id = "decor" class = "decor"></div>	
											<div id ="attentionDisplay">
												<?php
													if(isset($_SESSION['employeeNumber'])){
												?>
														
														<div class = "onlineContainer" style = "display:no1ne;">
															<div class ="activeName" ><?php echo  ucwords( strtolower($_SESSION['fullName'])) ?> </div>
															<div class = "activeOffice"><?php echo  $_SESSION['officeName']; ?></div> 
															<div class ="activePosition"><?php echo strtoupper($_SESSION['position']) ?> </div>
														</div>
														
												<?php
													}	
												?>
											</div>
											
										</td>
									</tr>
									<tr >	
										<td  id = "panelContainer1" style = "background-color:rgba(1, 1, 1,.5);vertical-align:top;padding-top:150px;">
											
											<div id ="attentionInboxContainer"></div>
											<div id ="attentionMessageContainer" ></div>
											<div id ="attentionStatusContainer" ></div>
											<div id = "attentionUpgrade" style = "">
												<table style ="border-spacing:0;margin:0 auto;margin-left:12px;width:92%;font-family: Oswald;">
													<tr>
															<td style = "padding:0;">
															 	<div id ="" style = "font-size:16px;padding:5px;background-color:rgba(39, 42, 43,.8);color:white;border-radius:5px 5px 0px 0px;text-shadow:0px 0px 2px black;letter-spacing:2px;text-align: center;">Browser Installer</div>
															 </td>
													</tr>
													<tr>
														<td style = "padding:2px 1px;padding-left:10px;vertical-align:top;background-color:rgba(61, 60, 60,.7);background-color:rgba(0, 0, 0,.8);color:silver;">
																<div style= "padding:5px;padding-left:10px;">
																	<a  href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/citydoc2017/files/firefox32.exe" target="_blank" style="text-decoration-line: none;"><div style = "border-bottom:1px solid rgba(68, 69, 69,.5);">Firefox 32bit v54</div></a>
																	<a  href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/citydoc2017/files/firefox64.exe" target="_blank" style="text-decoration-line: none;"><div style = "border-bottom:1px solid rgba(68, 69, 69,.5);">Firefox 64bit v54</div></a>
																</div>
														</td>
													</tr>
												</table>
											</div>
											<div id = "attentionLinks" style = "display:none;" >
												<table style ="border-spacing:0;margin:0 auto;margin-top:5px;margin-left:12px;width:92%;">
													<tr>
															<td style = "padding:0;">
															 	<div id ="" style = "font-size:16px;padding:5px;background-color:rgba(194, 199, 200,.4);color:white;border-radius:5px 5px 0px 0px;text-shadow:0px 0px 2px black;">Links</div>
															 </td>
													</tr>
													<tr>
														<td style = "padding:2px 1px;vertical-align:top;background-color:rgba(61, 60, 60,.7); color:silver;padding-bottom:5px;font-size:14px;border-radius:0px 0px 10px 10px;">
															<div style = "margin-left:10px;margin-top:5px;border-bottom: 1px solid grey;"> <span style = "color:orange1;font-size:12px;">Document Tracking System</span></div>
															<!--<div class = "linksA" style = "margin-left:30px;margin-top:5px;" onclick = "window.open('/doctrackNew/interface/main.php', 'new');" >1. Doctrack <span style = "color:orange;">2015</span></div>
															<div class = "linksA" style = "margin-left:30px; " onclick = "window.open('/citydoc/interface/main.php', 'new');" >2. Doctrack <span style = "color:orange;">2016</span></div>
															<div class = "linksA" style = "margin-left:30px; " onclick = "window.open('/citydoc2017/interface/main.php','_self');" >3. Doctrack <span style = "color:orange;">2017</span></div>
															<div style = "margin-left:10px;margin-top:10px; border-bottom: 1px solid grey;" > <span style = "color:orange1;font-size:12px;">Project Procurement Management Plan</span></div>
															<div   class = "linksA"style = "margin-left:30px;margin-top:5px;">
																<a  href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/bac" target="_blank">1. PPMP <span style = "color:orange;">2016</span></a>
															</div>
															<div   class = "linksA" style = "margin-left:30px;" >
																<a  href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/bacv2" target="_blank">2. PPMP <span style = "color:orange;">2017</span></a>
															</div>-->
															<div class = "linksA" style = "margin-left:30px;margin-top:5px;" onclick = "window.open('/citydoc2017/interface/main.php', '_self');" >1. Doctrack <span style = "color:orange;">2017</span></div>
														</td>
													</tr>
												</table>
											</div>		
										</td>
									</tr>
								</table>
							</td>
					<?php
						}
					?>
					<td  id = "tdHeader1" style = "height:1px;text-align:center;background-color:rgba(12, 50, 31,.5);background-color:rgba(12, 50, 31,.5);" colspan ="2">
						<table style = "margin:0 auto;border-left:1px solid silver;margin-top:15px;padding-left:10px;height:1px;" >
							<tr>
								<td>
									<div class = "logo"></div>
									<div class = "logo1"></div>
									<div class = "title" >
										<span class = "year" style = "color:white;margin-top:-10px;position:absolute;padding-right:10px;text-shadow:0px 0px 6px black;letter-spacing:1px;font-size:70px;font-weight: bold;">2018</span>
										<div style = "margin-left: 146px;width:360px;position:absolute;margin-top:5px;">Document Tracking System <span class = "version">v4</span></div> 
									</div>
									<div class = "subtitle" >Doctrack / SAAOB / PPMP / Inventory</div>
									<div class = "portal"  ><span style = "font-family: oswald;font-weight:normal;color:silver;font-size:12px;padding-right:5px;">LINKS</span>
									<span class = "years" onclick = "gotoLink(this)">2019</span> | 
									<span class = "years" onclick = "gotoLink(this)">2017</span> | 
									<span class = "years" onclick = "gotoLink(this)">2016</span> | 
									<span class = "years" onclick = "gotoLink(this)">2015</span> | 
									<span class = "years" onclick = "gotoLink(this)">Portal</span>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td  class = "tdMainMenu" colspan = "0" style = "vertical-align: bottom;height:10px;background-color:rgba(12, 50, 31,.5);">
						<div class = "menuContainer1" id = "container1" >
							<?php
								if(isset($_SESSION['employeeNumber'])){
							?>
									<div class = "menu1" onclick="menuClick1(this)">Document Tracking</div>
									<div class = "menu1" onclick="menuClick1(this)">Appropriations</div>
									<div class = "menu1" onclick="menuClick1(this)">Procurement</div>
									<div class = "menu1" onclick="menuClick1(this)">Inventory</div>
									
									<?php  
										//if($_SESSION['officeCode'] == '1081'  || $_SESSION['officeCode'] == '1071' ){
                                           			 if($_SESSION['gso'] == '1081' || $_SESSION['cbo'] == '1071' ){
									?>
											<div class = "menu1" onclick="menuClick1(this)">SAAOB</div>
									<?php  
										}
									?>
									
									<div class = "menu1" onclick="menuClick1(this)" style = "padding-left:50px;">Logout</div>
							<?php
								}else{
							?>		
									<div class = "menu1" style = "cursor:pointer;border-radius:2px;" onclick="menuClick1(this)">Login</div>
							<?php		
								}
							?>
						</div>
					</td>
				</tr>
				<tr>
					<?php
						if(isset($_SESSION['employeeNumber'])){
					?>
							
							
							<td  id = "tdBody" style = "padding:0px;background-color: white;">
								
								<div class = "hide">
									<?php	require(ROOTER . 'interface/mainDoctrack.php'); ?>
								</div>
								<div class = "hide">
								 	<?php	require(ROOTER . 'interface/mainAppropriation.php'); ?>
								</div>
								<div class = "hide">
								 	<?php  require(ROOTER . 'interface/mainPPMP.php'); ?>
								</div>
								<div class = "hide">
								 	<?php  require(ROOTER . 'interface/mainInventory.php'); ?>
								</div>


								<?php  
									//if($_SESSION['gso'] == '1081'  || $_SESSION['cbo'] == '1071' ){
                                  			  if($_SESSION['gso'] == '1081' || $_SESSION['cbo'] == '1071' ){
								?>
										<div class = "hide">
										 	<?php	require(ROOTER . 'interface/mainSAAOB.php'); ?>
										</div>
								<?php  
									}
								?>
								
								<div class = "hide">
									3
								</div>
							</td>
					<?php		
						}else{
					?>
							
							<td  id = "tdBody" style = "padding-top:20px;background-size: 30%; vertical-align:top;text-align:center;background-color:rgba(0, 0, 0,.8);">
								<div style = "display:inline-block;"  >
										<?php	require(ROOTER . 'interface/trackernew.php'); ?>

								</div>
							</td>
					<?php		
						}
					?>
				</tr>
				<tr>	
					<td id = "tdFooter" style = "height:50px;" colspan ="2">
						<table style = "margin:0px auto;">
							<tr>
								<td><div class = "footTitle">CityDoc 2018 </div><div class = "footTitle1">Developed by : AIMTD </div>
								<div class = "footTitle2">Accounting Information Management and Technology Division</div></td>
							</tr>
							<tr>
								<td></td>
							</tr>
							
						</table>
					</td>
				</tr>
			</table>
			
	</body>
</html>
<script>	
	
	
	
	
	loadMain();
	function loadMain(){
		
		//sa menu na cookie
		var cookieValue = readCookie("lastMainMenu").trim();
		var parent =  document.getElementById('container1');
		parent.children[cookieValue].className = "menu1selected";
		//sa body
		var parentBody =  document.getElementById('tdBody');
		parentBody.children[cookieValue].className = "mainBodyshow";
		
		//pag  change sa color sa main menu
		
		var cookieMainText = cookieLabel(cookieValue,"container1");
		
		if(cookieMainText != "Login"){
			panels();
		}
		if(cookieMainText == "Appropriations"){
			document.getElementById("container1").children[cookieValue].style.backgroundColor ="rgb(147, 43, 67)";
		}else if(cookieMainText == "SAAOB"){
			document.getElementById("container1").children[cookieValue].style.backgroundColor ="rgb(113, 146, 14)";
		}else if(cookieMainText == "Procurement"){
			
			document.getElementById("container1").children[cookieValue].style.backgroundColor ="rgb(163, 149, 116)";
		}else if(cookieMainText == "Inventory"){
			//document.getElementById("container1").children[cookieValue].style.backgroundColor ="rgb(247, 129, 66)";
			document.getElementById("container1").children[cookieValue].style.backgroundColor ="rgb(218, 102, 30)";
			
		}
	}
	function menuClick1(me){
		
		if(me.textContent == 'Login' || me.textContent == 'Logout'){
			var queryString = "?logout=1";
			var container = '';
			ajaxGetAndConcatenate(queryString,processorLink,container,"Logout");
		}else{
			
			menuChanger(me,"menu1Selected","lastMainMenu","tdBody","mainBodyshow");
			
			if(me.textContent == 'Appropriations'){
				me.style.backgroundColor = "rgb(147, 43, 67)";
				document.getElementById("container1").children[2].style.backgroundColor ="transparent";
				document.getElementById("container1").children[3].style.backgroundColor ="transparent";
				document.getElementById("container1").children[4].style.backgroundColor ="transparent";
				loadAppropriation();
				var cookieText = cookieLabel(cookieAppropriationsMenu(),"appropriationMenuContainer");
				if(cookieText == "Encode"){
					loaderAppropriation();
				}else if(cookieText == "Status"){
					loadApproriationStatus();
					loadOfficeInStatus();
				}
			}else if(me.textContent == 'Document Tracking'){
				
				document.getElementById("container1").children[1].style.backgroundColor ="transparent";
				document.getElementById("container1").children[2].style.backgroundColor ="transparent";
				document.getElementById("container1").children[3].style.backgroundColor ="transparent";
				document.getElementById("container1").children[4].style.backgroundColor ="transparent";
				loadDoctrackMain();
				
				var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
				if(cookieText == "Tracker"){
					
					//loadOffice1();
					//loadClaimType();
					//loadFirstTracker();
				}else if(cookieText == "Forum"){
					loadForumMessages();
				}		
			}else if(me.textContent == 'SAAOB'){
				document.getElementById("container1").children[1].style.backgroundColor ="transparent";
				document.getElementById("container1").children[2].style.backgroundColor ="transparent";
				document.getElementById("container1").children[3].style.backgroundColor ="transparent";
				me.style.backgroundColor = "rgb(113, 146, 14)";
			}else if(me.textContent == 'Procurement'){
				me.style.backgroundColor = "rgb(163, 149, 116)";
				document.getElementById("container1").children[1].style.backgroundColor ="transparent";
				document.getElementById("container1").children[3].style.backgroundColor ="transparent";
				document.getElementById("container1").children[4].style.backgroundColor ="transparent";
			}else if(me.textContent == 'Inventory'){ // Inventory
				//me.style.backgroundColor = "rgb(247, 129, 66)";
				me.style.backgroundColor = "rgb(218, 102, 30)";
				document.getElementById("container1").children[1].style.backgroundColor ="transparent"; 
				document.getElementById("container1").children[2].style.backgroundColor ="transparent";
				document.getElementById("container1").children[4].style.backgroundColor ="transparent"; 
				//loadInventory();
				//var cookieText = cookieLabel(cookieInventoryMenu(),"InventoryMenuContainer");
			}
		}
	}
	//loadBudgetForApproval();
	function panels(){
		loadInbox();	
		loadAnnouncement();
		loadStatuses();
	}
	function loadBudgetForApproval(){
		var queryString = "?loadBudgetForApproval=1";
		var container = document.getElementById('budgetPanel');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadBudgetForApproval");
	}
	function loadAnnouncement(){
		var queryString = "?loadAnnouncement=1";
		var container = document.getElementById('attentionMessageContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadAnnouncement");
	}
	function loadStatuses(){
		var queryString = "?loadStatuses=1";
		var container = document.getElementById('attentionStatusContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");	
	}
	function showMessage(me){
		
		      var close = document.getElementById("closethis");
		      if(close == null){
			document.getElementById("mesCont").className = "showMessage";
			interVal(displayText,1000);
		     }
	}
	function displayText(){
		var m = '<div id ="closethis" ><div style = "font-size:16px;padding:5px;background-color:rgba(255, 0, 0,.7);color:white;border-radius:5px 5px 0px 0px;">Tracking Status Guide<div onclick = "hideMessage(this,event)" class = "close" style = "font-size:12px;text-align:center;background-color:grey;float:right;" >X</div></div>';
		      m += "<div style = 'padding:0 5px;'><div style = 'font-weight:bold;color:red;'>PR Tracking</div><div style = 'font-size:14px;padding-left:5px;'>";
		      m += "<span style = 'color:orange;'>1.</span> Encoded<br/>";
		      m += "<span style = 'color:orange;'>2.</span> PR - GSO Received<br/>";
		      m += "&nbsp;&nbsp;<span style = 'color:silver;'>a.  Pending at  GSO<br/>";
		      m += "&nbsp;&nbsp;b.  Pending Released - GSO<br/>";
		      m += "&nbsp;&nbsp;c.   PR - GSO Received<br/></span>";
		      m += "<span style = 'color:orange;'>3.</span> PR - CBO Received<br/>";
		      m += "&nbsp;&nbsp;<span style = 'color:silver;'>a.  Pending at  CBO<br/>";
		      m += "&nbsp;&nbsp;b.  Pending Released - CBO<br/>";
		      m += "&nbsp;&nbsp;c.   PR - CBO Received<br/></span>";
		      m += "<span style = 'color:orange;'>4.</span> PR - CBO Released<br/>";
		      m += "</div>";
		     
		     m += "<div style = 'font-weight:bold;color:red;'>PO Tracking</div><div style = 'font-size:14px;padding-left:5px;'>";
		      m += "<span style = 'color:orange;'>1.</span>Encoded<br/>";
		      m += "<span style = 'color:orange;'>2.</span> GSO Received<br/>";
		      m += "&nbsp;&nbsp;<span style = 'color:silver;'>a.  Pending at  GSO<br/>";
		      m += "&nbsp;&nbsp;b.  Pending Released - GSO<br/>";
		      m += "&nbsp;&nbsp;c.   GSO Received<br/></span>";
		      m += "<span style = 'color:orange;'>3.</span> CAO Received<br/>";
		      m += "&nbsp;&nbsp;<span style = 'color:silver;'>a.  Pending at  CAO<br/>";
		      m += "&nbsp;&nbsp;b.  Pending Released - CAO<br/>";
		      m += "&nbsp;&nbsp;c.   CAO Received<br/></span>";
		      m += "<span style = 'color:orange;'>4.</span> CAO Released<br/>";
		     m += "</div>";
		    
		      m += "<div style = 'font-weight:bold;color:red;'>Other Vouchers</div><div style = 'font-size:14px;padding-left:5px;'>";
		       m += "<span style = 'color:orange;'>1.</span> Encoded<br/>";
		      m += "<span style = 'color:orange;'>2.</span> CBO Received<br/>";
		      m += "&nbsp;&nbsp;<span style = 'color:silver;'>a.  Pending at  CBO<br/>";
		      m += "&nbsp;&nbsp;b.  Pending Released - CBO<br/>";
		      m += "&nbsp;&nbsp;c.   CBO Received<br/></span>";
		      m += "<span style = 'color:orange;'>3.</span> CAO Received<br/>";
		      m += "&nbsp;&nbsp;<span style = 'color:silver;'>a.  Pending at  CAO<br/>";
		      m += "&nbsp;&nbsp;b.  Pending Released - CAO<br/>";
		      m += "&nbsp;&nbsp;c.   CAO Received<br/></span>";
		      m += "<span style = 'color:orange;'>4.</span> CAO Released<br/>";
		     m += "</div></div>";
		document.getElementById("mesCont").innerHTML =m;
	}
	function hideMessage(me){
		 document.getElementById("mesCont").innerHTML = "";
		 document.getElementById("mesCont").className = "hideMessage";
	}
	function showByStatus(me){
		var parent=  document.getElementById("doctrackMenuContainer");
		var len = parent.children.length;
		for(var  i = 0; i < len ; i++ ){
			var menu = parent.children[i].textContent;
			if(menu == "Tracker"){
				
				document.getElementById("sliderStatus").innerHTML = "";
				
				parent.children[i].click();
				var  status = me.id.replace("status","");
				loader();
				var searchType = "Status";
				
				var queryString = "?fetchVoucherFromMain=1&searchType=" + searchType  + "&value=" + status;
				var container =document.getElementById("doctrackUpdateContainer");
				
				ajaxGetAndConcatenate(queryString,processorLink,container,"searchFromMain");	
				break;
			}
		}
	}
	
	function loadInbox(){
		var  forumId = readCookie("forumId");
		var latestReplyDate = readCookie("replyDate");
		
		var queryString = "?loadInbox&forumId=" + forumId + "&latestReplyDate=" + latestReplyDate ;
		var container = document.getElementById('attentionInboxContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");	
	}

	function gotoForum(me){
		var parent=  document.getElementById("doctrackMenuContainer");
		var len = parent.children.length;
		for(var  i = 0; i < len ; i++ ){
			var menu = parent.children[i].textContent;
			if(menu == "Forum"){
				setCookie ("forumId", me.id, 100)
				parent.children[i].click();
				break;
			}
		}
	}
	function gotoReplies(me){
		var parent=  document.getElementById("doctrackMenuContainer");
		var len = parent.children.length;
		for(var  i = 0; i < len ; i++ ){
			var menu = parent.children[i].textContent;
			if(menu == "Forum"){
				var ids = document.getElementById("repliesId").value;
				var forumTab = parent.children[i];
				latestReplyDate =  me.id;
				setCookie ("replyDate", latestReplyDate, 100);
				break;
			}
		}
		
		menuChanger(forumTab,"menu4Selected","lastMain4","doctrackMainContainer","");
		var container = document.getElementById("divForumMessageContainer");
		var queryString = "?loadReplyUpdates&forumIds=" + ids ;
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");			
	}

	function gotoLink(me){
		var year = me.textContent;
		if(year == 2019){
			window.open('../../../citydoc2019/interface/main.php', '_new');
		}
		if(year == 2017){
			window.open('../../../citydoc2017/interface/main.php', '_new');
		}
		if(year == 2016){
			window.open('../../../citydoc/interface/main.php', '_new');
		}
		if(year == 2015){
			window.open('../../../doctracknew/interface/main.php', '_new');
		}
		if(year == "Portal"){
			window.open('../../../../index.php', '_new');
		}
	}
</script>	
			
			