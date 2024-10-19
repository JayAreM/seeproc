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
	#tableInfra{
		
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

	th.rotate {
	  /* Something you can count on */
	  height: 270px;
	  white-space: nowrap;
	}
	th.rotate > div {
	  transform: 
	    /* Magic Numbers */
	    translate(6px, 122px)
	    /* 45 is really 360 - 45 */
	   /* rotate(315deg);*/
	   rotate(290deg);
	  width: 20px;
	 
	  float:right;
	}
	th.rotate > div > span {
	 border-bottom: 1px solid grey;
	 font-size: 14px;
	 font-weight: normal;
	}
	.chargeTotalRow{
		background-color:rgb(223, 224, 208);
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
	 #tableFundControls > input,label{
	 	cursor: pointer;
	 	-webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; 
	 }
	 #tableFundControls td:hover{
	 	font-weight: bold;
	 	box-shadow: 0px 0px 5px 1px silver;
	 	transition: box-shadow .2s ease-out;
	 }
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
	
	
</style>

<table style="background-color: white;width:100%;height:100%;margin:0;border-spacing:0" border="0">
	<tr>
		<td style="vertical-align: top;">
			<div id = "infraPBPContainer" >
			</div>
		</td>
	</tr>
	<tr id ="footerInfra">
		<td style ="font-family: NOR;opacity:.7;padding-top:10px;">
			<div style = "text-align: center;font-size: 10px;letter-spacing:1px;">Document Tracking System <span style ="color:white;background-color:rgb(186, 191, 188);padding:0px 5px;"> 2023</span></div>
			<div style = "text-align: center;font-size: 8px;letter-spacing:1px;color:silver;">Created By : Val G. Balangue</div>
		</td>
	</tr>
</table>
<script>
	
	function showPhase1(){
		var queryString = "?showInfraPhase1=1";
	
		var container = document.getElementById('infraPBPContainer');			
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnPBP");
	}
	function  clickFundType(me){
		var fund  = me.id.replace("opt","");
		var checkList = document.getElementById("checkList").checked;
		
		var arr = document.getElementsByClassName("trContentInfra");
		for(var i = 0; i < arr.length ; i++){
			
			if(checkList == true){
				var fundRow = arr[i].getAttribute("name").substring(0,2);	
				
				if(fund != "All"){
					
					if(fundRow != fund){
						arr[i].style.display ="none";
					}else{
						
						arr[i].style.display ="table-row";
					}
				}else{
					arr[i].style.display ="table-row";
				}
			}else{
				var fundRowName = arr[i].getAttribute("name");
				var fundRow = arr[i].getAttribute("name").substring(0,2);	
				
				//alert("dili parehas " + fundRow + " " + fund);
				if(fund != "All"){
					if(fundRow != fund){
						
						arr[i].style.display ="none";
					}else{
						if(fundRowName == fundRow + "*1"){
							arr[i].style.display ="table-row";
						}else{
							arr[i].style.display ="none";
						}
					}
				}else{
					
					if(fundRowName == fundRow + "*1"){
						arr[i].style.display ="table-row";
					}else{
						arr[i].style.display ="none";
					}
				}
			}
		}
	}
	function tdClickFund(me){
		me.children[0].click();
	}
	function showCode(me){
		var arr = document.getElementsByClassName("programCode");
		for(var i = 0; i < arr.length; i++){
			if(me.checked == true){
				arr[i].style.display ="inline";
			}else{
				arr[i].style.display ="none";
			}
		}
	}
	detect();
	function detect(){
		if(document.getElementById("panelContainer1")){
			
			document.getElementById("footerInfra").style.display = "none";
		}else{
			showPhase1();
		}
	}
	function newLink(){
		window.open('../interface/infrapbp.php', '_new');
	}

	function newLinkProjectPBP(me){
		var year = infraPBPYear.textContent;
		var tn = me.id;
		
		window.open('../interface/infraProjectDetails.php?year=' + year + "&tn=" + tn , '_blank');
	}

	function hoverColor(me){
		var arr  = me.id.split("*");
		
		var encoded = arr[0];
		var tn = arr[1];
		var amount = arr[2];
		var net = arr[3];
		var location = arr[4];
		if(net.length == 0){
			net = '---------';
		}
		if (me.children.length > 0){
			var b = "";
		}else{
			var b = "<div class = 'balloon' style='height:175px;'>" + 
			
						"<table class = 'balloon1'  style = 'border-collapse:collapse;' border ='0'>" +
							"<tr style ='background-color:rgb(202, 237, 78);'><th style = 'text-align:right;' colspan ='2'>TN :<b>" + tn + "</b></th></tr>" +
							"<tr style ='background-color:rgb(202, 237, 78);'><th style = 'padding-left:5px;'>Project&nbsp;Fund</th><th colspan ='2' style = 'color:red;font-weight:bold;text-align:right;'>" + numberWithCommas(amount,2) + "</th></tr>" +
							"<tr style ='background-color:rgb(202, 237, 78);'><th style = 'padding-left:5px;'>Actual&nbsp;Cost</th><th colspan ='2' style = 'color:rgb(0, 113, 251);font-weight:bold;text-align:right;'>" + numberWithCommas(net,2) + "</th></tr>" +
							"<tr  style ='background-color:rgb(202, 237, 78);'><th colspan ='2' style = 'padding-left:5px;padding-top:15px;font-weight:bold;'>Document location</th> </tr><tr><th style = 'text-align:center;'colspan ='2'>" + location + "</th></tr>" +	
							"<tr  style ='background-color:rgb(202, 237, 78);'><th colspan ='2' style = 'padding-left:5px;font-weight:bold;'>Encoded</th> </tr><tr><th style = 'text-align:center;'colspan ='2'>" + encoded + "</th></tr>" +
							"<tr  style ='background-color:rgb(202, 237, 78);'><th colspan ='2' style = 'text-align:center; padding-top:8px; font-size:0px;'><span class='button1' style='display:inline-block; font-size:10px; width:40px; padding:5px 5px 4px 5px;' id='"+tn+"' onclick='newLinkProjectPBP(this)'>SHOW</span></th> </tr>" +
						"</table></div>";
		}
		me.innerHTML = b;
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


