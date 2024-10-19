
<style>
	#saaobMainTable{
		
		border-spacing:0;
		width:100%;
		height:100%;
	}

	#saaobMenuContainer{
		
		padding:0px 10px;
		background-color:rgb(113, 146, 14);
		
		
		
	}
	.saaobMenu{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
	}
	.saaobMenu:hover{
		background-color:rgb(160, 181, 39);
		color:white;
	}
	#saaobContainer{
		background-color:white;
		display:inline-block;
		margin:0 auto;
		box-shadow:0px 0px 4px 1px grey;
	}
	.menu5Selected{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
		
		
		background-color:rgb(180, 203, 28);
		color:white;
	}
	
</style>

<table id  ="saaobMainTable" border = "0">

	<tr>
		<td style = "padding:0;height:1px;">
			<div id ="saaobMenuContainer">
				
				<div class ="saaobMenu" onclick="menuClick5(this)">Encode</div>
				<div class ="saaobMenu" onclick="menuClick5(this)">Liquidated</div>
			</div>
			
			
		</td>
	</tr>
	<tr>
		<td style = "background-color:rgb(240, 245, 247);padding-top:20px;padding-bottom:20px; vertical-align:top;text-align:center;">
			<div id  = "saaobMainContainer" style = "min-height:700px;" >
			
				
				<div class = "hide">
						<?php require(ROOTER . 'interface/saaobEncode.php'); ?>
				</div>
				<div class = "hide">
						<?php require(ROOTER . 'interface/saaobLiquidated.php'); ?>
				</div>
			</div>
		</td>
	</tr>
</table>
<script>
	//whenRefreshSAAOBMain();
	
	function whenRefreshSAAOBMain(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "SAAOB"){
			loadSAAOBMain();		
		}
	}
	
	function loadSAAOBMain(){
		//sa menu na cookie
		var cookieValue = readCookie("lastMain5").trim();
		var parent =  document.getElementById('saaobMenuContainer');
		parent.children[cookieValue].className = "menu5Selected";
		//sa body
		var parentBody =  document.getElementById('saaobMainContainer');
		parentBody.children[cookieValue].className = "mainBodyshow";
	}
	
	function menuClick5(me){
		menuChanger(me,"menu5Selected","lastMain5","saaobMainContainer","");
		
		if(me.textContent == "Liquidated"){
			loadOfficeLiquidated();
		}
		/*if(me.textContent == "Reports"){
			window.open('../interface/doctrackTransmitalPage.php');
		}else{
			menuChanger(me,"menu5Selected","lastMain5","saaobMainContainer","");
			if(me.textContent == "Tracker"){
				loadClaimType();
				loadFirstTracker();
			
				loadOffice1();
				
			}else if (me.textContent == "Forum"){
				loadForumMessages();
			}
		}*/
	}
</script>



