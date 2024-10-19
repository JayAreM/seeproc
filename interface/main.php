<META http-equiv=Content-Type content="text/html; charset=iso-8859-1"/> 
 <meta name="apple-mobile-web-app-capable" content="yes">
<!--<META http-equiv="Content-Type" content="text/html;charset=UTF-8">-->
<?php
	if(!isset($_SESSION)){
		session_start();
	}
	
	defined('ROOTER') ? NULL : define("ROOTER","../");
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
	@font-face{
		font-family: NOR;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Abel-Regular.ttf);
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
		color:white;
		cursor:pointer;
		transition: all .1s ease-in;
		
		-webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; 
		
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
		background-color:rgba(35, 30, 30,.5);
		
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
		background-color: rgb(6, 38, 101);
	}
	.subTitle:after{
		margin-left:5px;
		content:"";
		border-bottom:22px solid transparent;
		border-left:22px solid rgb(3, 44, 126);
		width:0;
		height:0;
		position:absolute;
	}
	.portal{
		height:40px;
		width:450px;
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
	.ads{
		height:120px;
		background:url(../images/heart1.jpg);	
		background-size:100% 115%;
		background-repeat:no-repeat;
		border:1px solid silver;
		border-radius: 10px;
		box-shadow: 0px 0px 20px 10px rgb(5, 16, 51);
		margin:10px;
		margin-bottom: 2px;
	}
</style>

<script>
	// var time = 1800;
	
	// window.onkeyup = function(){
	// 	document.getElementById("timer").textContent = time;
	// }
	// window.onmousemove = function(){
	// 	document.getElementById("timer").textContent = time;
	// }
	// window.onfocus = function() {
	// 	document.getElementById("timer").textContent = time;
	// };
	// window.onblur = function() {
	// 	document.getElementById("timer").textContent = time;
	// };
	// interVal(decreaseTime,1000);
	// function decreaseTime(){
	// 	var x = document.getElementById("timer").textContent;
	// 	document.getElementById("timer").textContent =  x - 1;		
	// 	if(x > 1){
	// 		interVal(decreaseTime,1000);
	// 	}else{
	// 		logout();
	// 	}
	// }
</script>

<html>
	<head>
		<title>2023 DocTrack v7</title>
		<link rel="icon" href="/citydoc2020/images/red.png"/> 
		<link rel="stylesheet" href="../css/style.css" />
	</head>
	<body>
			
			<table class = "mainTable" border ="0"> 
				<tr>
					
					<?php
						if(isset($_SESSION['employeeNumber'])){
					?>
							<td  class = "tdPanel" rowspan = "4" style="width:100px;background-color:rgba(5, 50, 95,.4);">
								
								<table border ="0" style = "border-spacing:0; height:100%; width:225px;">
									
									<tr >	
										<td style = "height:40px;background-color:rgba(1, 1, 1,.6); color:white;text-align:center;font-family:Oswald;">
										
											<div class = "ads" style="display:none;"></div>
											<div style ="font-family: Arial;letter-spacing: 1px;font-size: 14px; display:none;">Happy Valentines <span style ='color:red;font-size:20px;'>&hearts;</span></div>
											<div id ="attentionDisplay">
												<?php
													if(isset($_SESSION['employeeNumber'])){
												?>
														<div class = "onlineContainer" style = "display:no1ne;">
															<div id = "timer" style = "color:grey;font-size:22px; display:none;">1800</div>
															<div class ="activeName" ><?php echo  ucwords(strtolower( htmlspecialchars($_SESSION['fullName']))) ?> </div>
															
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
																	<!--<a  href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/citydoc2017/files/firefox32.exe" target="_blank" style="text-decoration-line: none;"><div style = "border-bottom:1px solid rgba(68, 69, 69,.5);">Firefox 32bit v54</div></a>-->
																	<a  href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/citydoc2017/files/firefox64.exe" target="_blank" style="text-decoration-line: none;"><div style = "border-bottom:1px solid rgba(68, 69, 69,.5);">Firefox v54</div></a>
																</div>
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
				
					<td  id = "tdHeader1" style = "padding:0;height:1px;text-align:center;background:url(../images/Bg1.png);background-size:10%;height:1px; " colspan ="2">
						<div style ="
						                  background-image: linear-gradient(to  top,rgb(2, 8, 48)	 ,rgb(2, 5, 27));
						                  
						                  padding-top:10px;border-top:1px solid black;box-shadow: 0px -2px 10px 2px black;">
							<table style = "margin:0 auto; border-left:1px solid rgba(160, 174, 154,.2);padding-left:10px;" border="0" >
								<tr>
									<td style = "">
										<div class = "logo" style = "opacity:.8;"></div>
										<div class = "logo1" style = "opacity:.7;"></div>
										<div class = "title" >
											<span class = "year" style = "color:white;margin-top:-10px;position:absolute;padding-right:10px;text-shadow:0px 0px 6px black;letter-spacing:1px;font-size:70px;font-weight: bold;" >2023</span>
											<div style = "margin-left: 146px;position:absolute;margin-top:5px;color:white;text-shadow:0px 0px 0px white;font-weight:bold;">Document Tracking System <span class = "version">v7</span></div> 
										</div>
										<div class = "subtitle" >Doctrack / SAAOB / PPMP / Inventory</div>
										<div class = "portal"  ><span style = "font-family: oswald;font-weight:normal;color:silver;font-size:12px;padding-right:5px;">LINKS</span>
										<span class = "years" onclick = "gotoLink(this)">2024</span> | 
										<span class = "years" onclick = "gotoLink(this)">2022</span> | 
										<span class = "years" onclick = "gotoLink(this)">2021</span> | 
										<span class = "years" onclick = "gotoLink(this)">2020</span> | 
										<span class = "years" onclick = "gotoLink(this)">2019</span> | 
										<span class = "years" onclick = "gotoLink(this)">2018</span> | 
										<span class = "years" onclick = "gotoLink(this)">2017</span> | 
										<span class = "years" onclick = "gotoLink(this)">2016</span> | 
										<span class = "years" onclick = "gotoLink(this)">2015</span> | 
										<span class = "years" onclick = "gotoLink(this)">Portal</span>
										</div>
									</td>
								</tr>
								
							</table>
						</div>
					</td>
					<td class = "tdPanel" rowspan = "4" style="background-image: linear-gradient(to  right,rgb(2, 8, 48),rgb(2, 5, 27));width:190px;">
						<div  style = "color:white;width:100%;font-family: nor;margin-top:188px;padding-left:4px;" id = "engagement">
						</div>
					</td>
				</tr>
				<tr>
					<td  class = "tdMainMenu" colspan = "0" style = "vertical-align: bottom;background:url(../images/Bg1.png);height:1px;	background-size:8%;">
						<div class = "menuContainer1" id = "container1" style = "background-image: linear-gradient(to  right,rgb(2, 8, 48)	 ,rgb(2, 5, 27));" >
							<?php
								if(isset($_SESSION['employeeNumber'])){
							?>
									<div class = "menu1" onclick="menuClick1(this)">Document Tracking</div>
									<div class = "menu1" onclick="menuClick1(this)">Appropriations</div>
									<div class = "menu1" onclick="menuClick1(this)">Procurement</div>
									<div class = "menu1" onclick="menuClick1(this)">Inventory</div>
										
									<?php  
                                        if($_SESSION['gso'] == '1081' || $_SESSION['cbo'] == '1071' || $_SESSION['cbo'] == '1091'){
									?>
											<div class = "menu1" onclick="menuClick1(this)">SAAOB</div>
									<?php  
										}
									?>
									<div class = "menu1" onclick="menuClick1(this)">Infrastructure Projects</div>

									<?php	//if($_SESSION['accountType'] == 1) :	?>
									<div class = "menu1" id="GoodsAndServicesModule" onclick="menuClick1(this)">Goods and Services</div>
									<?php	//endif;	?>

									<?php	if($_SESSION['perm'] == 47) :	?>
									<div class = "menu1" id="drrmoModule" onclick="menuClick1(this)">DRRMO</div>
									<?php	endif;	?>

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
                                  	//if($_SESSION['gso'] == '1081' || $_SESSION['cbo'] == '1071' ){
                                  	if($_SESSION['gso'] == '1081' || $_SESSION['cbo'] == '1071' || $_SESSION['cbo'] == '1091'){
								?>
										<div class = "hide">
										 	<?php	require(ROOTER . 'interface/mainSAAOB.php'); ?>
										</div>
								<?php  
									}
								?>
								<div class = "hide">
								 	<?php	require(ROOTER . 'interface/mainInfrastructure.php'); ?>
								</div>
								<div class = "hide">
									<?php	require(ROOTER . 'interface/mainGoodsAndServices.php'); ?>
								</div>

								<?php	if($_SESSION['perm'] == 47) :	?>
								<div class = "hide">
									<?php	require(ROOTER . 'interface/mainDRRMO.php'); ?>
								</div>
								<?php	endif;	?>

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
					<td id = "tdFooter" style = "" colspan ="2">
						<table style = "margin:0px auto;opacity:.4;margin-top:20px;">
							<tr>
								<td>
									
									<div style = "text-align: center;font-size: 10px;letter-spacing:1px;">City Documnent Tracking Systems</div>
									<div class = "footTitle1" style = "">Developed by : VAL B, J.L (AIMTD) </div>
									<div style = "font-size: 10px;letter-spacing:1px;">Accounting Information Management and Technology Division</div>
								</td>
								
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
	function test(){
		//var queryString = "?loadInbox&forumId=" + forumId + "&latestReplyDate=" + latestReplyDate ;
		//var container = document.body;
		//ajaxGetAndConcatenate("","http://192.168.100.6/api/product/read.php",container,"returnOnly");	
	}
	function loadMain(){
		
		//sa menu na cookie
		var cookieValue = readCookie("lastMainMenu");
		
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

		}else if(cookieMainText == "Infrastructure Projects"){
			document.getElementById("container1").children[cookieValue].style.backgroundColor ="rgb(88, 105, 120)";

		}else if(cookieMainText == 'Goods and Services') {
			document.getElementById("container1").children[cookieValue].style.backgroundColor = "rgb(113, 146, 14)";
		}else if(cookieMainText == "DRRMO"){
			document.getElementById("container1").children[cookieValue].style.backgroundColor ="rgb(88, 105, 120)";

		}
	}
	
	function logout(){
		loader();
		var queryString = "?logout=1";
		var container = '';
		ajaxGetAndConcatenate(queryString,processorLink,container,"Logout");
	}
	function menuClick1(me){
	
		if(me.textContent == 'Login' || me.textContent == 'Logout'){
			logout();
		}else{
		
			menuChanger(me,"menu1Selected","lastMainMenu","tdBody","mainBodyshow");
			var ama = me.parentNode;
			for(var i = 0; i < ama.children.length-1; i++){
				ama.children[i].style.backgroundColor = "transparent";
			}
			if(me.textContent == "Document Tracking"){
				me.style.backgroundColor = "rgb(35, 116, 157)";
			}else if(me.textContent == 'Appropriations'){
				me.style.backgroundColor = "rgb(147, 43, 67)";
				loadAppropriation();
				var cookieText = cookieLabel(cookieAppropriationsMenu(),"appropriationMenuContainer");
				if(cookieText == "Encode"){
					loaderAppropriation();
				}else if(cookieText == "Status"){
					loadApproriationStatus();
					loadOfficeInStatus();
				}
			}else if(me.textContent == 'Document Tracking'){
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
				me.style.backgroundColor = "rgb(113, 146, 14)";
			}else if(me.textContent == 'Procurement'){
				me.style.backgroundColor = "rgb(163, 149, 116)";
			}else if(me.textContent == 'Inventory'){ // Inventory
				me.style.backgroundColor = "rgb(218, 102, 30)";
			}else if(me.textContent == 'Infrastructure Projects'){ 
				me.style.backgroundColor = "rgb(88, 105, 120)";
				/*var cookieValue = readCookie("lastMainInfra").trim();
				
				if(cookieValue == 0){
					
					var cont = infraPBPContainer.children.length;
					if(cont == 0){
						infraMenuContainer.children[0].click();
					}
				}*/
			}else if(me.textContent == 'Goods and Services') {
				me.style.backgroundColor = "rgb(113, 146, 14)";
			}else if(me.textContent == 'DRRMO') {
				me.style.backgroundColor = "rgb(88, 105, 120)";
			}
		}
	}
	
	function panels(){
		loadInbox();	
		loadAnnouncement();
		loadStatuses();
		loadEngagement();
	}
	function loadEngagement(){
		var queryString = "?loadEngagement=1";
		var container = document.getElementById('engagement');
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}
	function loadBudgetForApproval(){
		var queryString = "?loadBudgetForApproval=1";
		var container = document.getElementById('budgetPanel');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadBudgetForApproval");
	}
	function loadAnnouncement(){
		var queryString = "?jKlTikSzx=1";
		var container = document.getElementById('attentionMessageContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}
	function loadStatuses(){
		var queryString = "?iosHsueji=1";
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
		var joiners = forumId + "!~!" + latestReplyDate;
		var queryString = "?hXdErt&xzTceAWs=" + vScram1(joiners) ;
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
		if(year == 2024){
			window.open('../../../citydoc2024/interface/main.php', '_new');
		}
		if(year == 2022){
			window.open('../../../citydoc2022/interface/main.php', '_new');
		}
		if(year == 2021){
			window.open('../../../citydoc2021/interface/main.php', '_new');
		}
		if(year == 2020){
			window.open('../../../citydoc2020/interface/main.php', '_new');
		}
		if(year == 2019){
			window.open('../../../citydoc2019/interface/main.php', '_new');
		}
		if(year == 2018){
			window.open('../../../citydoc2018/interface/main.php', '_new');
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
	function viewEngagement1(){
		window.open('../interface/engagement1.php', '_new');
	}
</script>	
			
			