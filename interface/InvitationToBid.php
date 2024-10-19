<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<?php
	
	defined('ROOTER') ? NULL : define("ROOTER","../");
	require_once('../ajax/dataprocessor.php');
	require_once('../javascript/ajaxFunction.php');
	require_once('../includes/loading.php');
	
?>
<!DOCTYPE HTML>
<style>
	body{
		padding:0;
		margin:0;
	}
	.mainTable{
		height:100%;
		width:100%;
		border-spacing:0;
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
		height:95px;
		width:95px;
		background-color:red;
		position:absolute;
		margin-left:-110px;
		margin-top:7px;
		background:url(../images/acctg.png);	
		background-size:100% 100%;
		background-repeat:no-repeat;
		opacity:.6;
	}
	#tdBody{
		background:url(../images/Bg1.png);	
		background-position-x: 0px;
		background-position-y: 70px;
		background-size:340px 120px ;		
	}
	.logo1{
		height:97px;
		width:97px;
		position:absolute;
		margin-left:-210px;
		margin-top:7px;
		
		
		background:url(../images/davao.png);	
		background-size:100% 100%;
		background-repeat:no-repeat;
		opacity:.5;
	}

	.logo2{
		height:97px;
		width:97px;
		
		//position: fixed;
		//margin-left:-210px;
		//margin-top:7px;
		
		
		background:url(../images/davao.png);	
		background-size:100% 100%;
		background-repeat:no-repeat;
		//background-position:0px 520px;
		//opacity:.5;
		
	}
	.title{
		color:white;
		font-weight:bold;
		font-size:24px;
		vertical-align: middle;
		text-shadow:0px 0px 2px black;
		font-family:impact;
		color:silver;
		
	}
	.subTitle{
		color:silver;
		font-size:16px;
		margin:0 auto;
		letter-spacing:2px;
	}
	.subTitle1{
		color:grey;
		font-size:12px;
		margin:0 auto;
		letter-spacing:2px;
		text-shadow:0px 0px 2px black;
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
	
	
</style>

<html>
	<head>
		<title>City Document Tracking v3</title>
		<link rel="icon" href="/citydoc2017/images/red.png"/> 
		<link rel="stylesheet" href="../css/style.css" />
	</head>
	<body>
			
			<table class = "mainTable" border ="0" >
				<tr>
				
					<td  id = "tdBody" style = "padding:0px;background-color: white;">
						<div class = "hi1de" style="height:100%;" >
							<?php	require(ROOTER . 'interface/invitationtobidmain.php'); ?>
						</div>
					</td>
					
				</tr>
				<tr>
					
					<td id = "tdFooter" style = "height:50px;" colspan ="2">
						<table style = "margin:0px auto;">
							<tr>
								<td><div class = "footTitle">Invitation to Bid </div><div class = "footTitle1">Developed by : AIMTD </div>
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
	

	//loadMain();
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
				loadDoctrackMain();
				
				var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
				if(cookieText == "Tracker"){
					
					loadOffice1();
					loadClaimType();
					loadFirstTracker();
				}else if(cookieText == "Forum"){
					loadForumMessages();
				}		
			}else if(me.textContent == 'SAAOB'){
				document.getElementById("container1").children[1].style.backgroundColor ="transparent";
				me.style.backgroundColor = "rgb(113, 146, 14)";
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
		var queryString = "?loadBudgetForApproval";
		var container = document.getElementById('budgetPanel');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadBudgetForApproval");
	}
	function loadAnnouncement(){
		var queryString = "?loadAnnouncement";
		var container = document.getElementById('attentionMessageContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadAnnouncement");
	}
	function loadStatuses(){
		var queryString = "?loadStatuses";
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
				parent.children[i].click();
				var  status = me.id.replace("status","");
				loader();
				var searchType = "Status";
				
				var queryString = "?fetchVoucherFromMain=1&searchType=" + searchType  + "&value=" + status;
				var container =document.getElementById("doctrackUpdateContainer");
				
				ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
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
</script>	
			
			
			
			