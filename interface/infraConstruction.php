<?php	
	defined('ROOTER') ? NULL : define("ROOTER","../");
	require_once(ROOTER . 'javascript/ajaxFunction.php');
	require_once(ROOTER . 'includes/database.php');
?>
<style>
	body{
		padding:0;
		margin: 0;
	}
	@font-face{
		font-family: NOR;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Abel-Regular.ttf);
	}
	#logoInfra{
		background:url(../images/dvo.png);	
		background-repeat: no-repeat;
		background-size:100%;
		opacity: .05;
		float: right;
		
		display: inline-block;
		height:150px;
		width:150px;
		position: absolute;
		margin-left: -110;
		margin-top: -90px;
		
	}
	/*#tableInfra{
		
		margin:0 auto;
		border-collapse: collapse;
		
	}
	#tableInfra tr:nth-child(even) {
		background-color: rgb(237, 240, 235);
	}
	
	
	#tableInfra tr:nth-child(even) td:last-child {
		background-color: rgba(195, 217, 217,.5);
		border:1px solid white;
	}
	#tableInfra tr:nth-child(even) td:nth-last-child(2) {
		background-color: rgba(105, 114, 116,.2);
		border:1px solid white;
	}
	#tableInfra tr:nth-child(even) td:nth-last-child(3) {
		background-color: rgba(105, 114, 116,.4);
		border:1px solid white;
	}
	
	#tableInfra tr:nth-child(odd) td:last-child {
		background-color: rgb(236, 238, 238);
		border:1px solid white;
	}
	#tableInfra tr:nth-child(odd) td:nth-last-child(2) {
		background-color: rgb(236, 238, 238);
		border:1px solid white;
	}
	#tableInfra tr:nth-child(odd) td:nth-last-child(3) {
		background-color: rgb(236, 238, 238);
		border:1px solid white;
	}
	
	.trContentInfra:hover td{
		background-color:FCF4C4;
	}
	#tableInfra tr:hover td:nth-last-child(1)  {
		background-color:FCF4C4;
	}
	#tableInfra tr:hover td:nth-last-child(2)  {
		background-color:FCF4C4;
	}
	#tableInfra tr:hover td:nth-last-child(3)  {
		background-color:FCF4C4;
	}
	
	#tableLegend th{
		font-weight: normal;
		padding:2px 8px;
		 
	}
	
	
	#tableInfra td{
		padding:0px 5px;
		font-size: 10px;
		
	}

	
	
	
	.idStatus{
		padding:2px;
		color:red;
		text-align: right;
	}
	.headerRow{
		text-align: right;
		font-weight: normal;
		font-size: 12px;
		line-height: 12px;
		padding-right: 5px;
	}
	.headerNumber{
		vertical-align:top;text-align:center;
		background-color:rgb(105, 114, 116);
		color:white;
		font-family: arial;
		font-size: 10px;
		padding:2px 2px;
		border:1px solid silver;
		border-right:1px solid white;
	}
	.tdContentInfra{
		border-right:1px solid rgba(220, 232, 212);
		
		
	}
	.tdOffice{
		border-bottom:1px solid grey;
		border-right:1px solid silver;
		background-color:rgb(226, 236, 226);
		color:silver;
		text-align: right;
		font-size: 10px;
	}
	.colorOffice{
		
		border-radius: 2px;
		width:15px;
		height:15px;
		margin-left: 2px;
		margin-top: 1px;
		margin:0 auto;
	}
	.colorOfficeMid{
		
		border-radius: 2px;
		width:15px;
		height:15px;
		cursor:pointer;
	}
	.colorOfficeMid:hover{
		box-shadow: 0px 0px 5px 1px silver;
		border:2px solid white;
	}
	.infraTracking{
		font-family: tahoma;
		font-weight: bold;
		

	}
	.infraDaysUpdated{
		font-family: arial;
		font-weight: bold;
		font-size: 10px;
		color:green;
	
	}

	.totalDays{
		
		font-size: 10px;
		width:100px;
		background-color: D2DFE2;
		
		padding:2px;
		font-family: tahoma;
		text-align: center;
		font-style: italic;
		
	}
	 .triangle { 
	 	display: inline-block; 
	 	position: absolute;
	 	border-top: 50px solid rgb(114, 122, 114); border-right: 50px solid transparent;
	 	background:url(../images/dvo.png);	
		background-repeat: no-repeat;
		background-size:100%;
		z-index: 0;
		cursor:pointer;
	 }
	 .trianglePointer { 
	 	z-index: 1;
	 	display: inline-block; 
	 	position: absolute;
	 	background:url(../images/hand.png);	
		background-repeat: no-repeat;
		background-size:100%;
		width:20px;
		height:20px;
		margin-left:3px;
		margin-top:4px;
		opacity: .3;
		cursor:pointer;
	 }

	 #tableFundControls td:hover{
	 	font-weight: bold;
	 	box-shadow: 0px 0px 5px 1px silver;
	 	transition: box-shadow .2s ease-out;
	 }*/
	 .balloon{
	 	position:absolute;
	 	width:145px;
	 	/* height:140px; */
	 	height:185px;
	 	box-shadow:0px 0px 8px 2px grey; 
	 	border:3px dashed white;
	 	background-color:rgb(202, 237, 78);
	 	padding:5px;
	 	margin-top:-165px;
	 	margin-left:20px;
	 	font-size: 16px;
	 	border-radius:10px 10px 10px 0px;
	 	
	 }
	  .balloon1{
	  	width:100%;
	  }
	 .balloon1 th{
	 	font-weight:normal;
	 	font-size:12px;
	 	text-align: left;
	 }
	#constructionTableGraph th{
		padding:0px 5px;
		background-color: rgb(209, 215, 217);
		border-bottom:1px solid white;
		border-right:1px solid white;
		font-size: 13px;
		
	}
	#constructionTableGraph{
		font-family:NOR;
		border-spacing: 0px;
		margin:0 auto;
		font-size:12px;
		border:1px solid silver;
	}
	#constructionTableGraph td{
		border-bottom:1px solid white;
		border-right:1px solid white;
		padding:2px 5px;
		vertical-align: top;
	}
	#constructionTableGraph tr:nth-child(even) {
		background-color: rgb(237, 240, 235);
	}
	
	
	#constructionTableGraph tr:hover > td:nth-last-child(3){
		font-weight: bold;
		color:black;
		font-size: 22px;
	}
	#constructionTableGraph tr > td:nth-last-child(1){
		//background-color:rgb(226, 227, 225);
	}
	#constructionTableGraph tr > td:first-child{
		padding:0px 5px;
		background-color: rgb(209, 215, 217);
	}
	#constructionTableGraph tr:hover td  {
		background-color: rgb(252, 244, 196);
		color:rgb(65, 85, 7);
		cursor:pointer;
	}
	.button1{
		border-bottom:1px solid silver;
		border-right:1px solid silver;
		
		background-color:rgb(230, 237, 241);
		text-align:center;
		font-weight: normal;
		
		
		margin:0 auto;
		font-size:12px;
		cursor:pointer;
		
		
	}
	.button1:hover{
		box-shadow:0px 0px 2px 1px white;
		font-weight: bold;
		color:black;
		background-color:rgb(207, 215, 210);
		/*border-top:2px solid silver;
		border-left:2px solid silver;*/
	}
</style>

<table style="background-color: white;width:100%;height:100%;margin:0;border-spacing:0" border="0">
	<tr>
		<td style="vertical-align: top;">
			<div id = "infraConstructionContainer" >
			</div>
		</td>
	</tr>
	<tr id ="footerInfraCon">
		<td style ="font-family: NOR;opacity:.7;padding-top:10px;">
			<div style = "text-align: center;font-size: 10px;letter-spacing:1px;">Documnent Tracking System <span style ="color:white;background-color:rgb(186, 191, 188);padding:0px 5px;"> 2023</span></div>
			<div style = "text-align: center;font-size: 8px;letter-spacing:1px;color:silver;">Created By : Val G. Balangue</div>
		</td>
	</tr>
</table>
<script>
	
	function showPhase2(){
		var queryString = "?showInfraPhase2=1";
	
		var container = document.getElementById('infraConstructionContainer');			
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnPBP");
	}
	
	detectCon();
	function detectCon(){
		if(document.getElementById("panelContainer1")){
			
			document.getElementById("footerInfraCon").style.display = "none";
		}else{
			showPhase2();
		}
	}
	function newLinkProject(me){
		var year = infraConsYear.textContent;
		var tn = me.id;
		
		
		window.open('../interface/infraProjectDetails.php?year=' + year + "&tn=" + tn , '_new');
	}
	function newLink1(){
		window.open('../interface/infraConstruction.php', '_new');
	}

	function clickToSearchInfra(me){
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


