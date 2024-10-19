<style>
	.mainTableAppropriation{
		width:100%;
		//border:1px solid silver;
		border-spacing:0;
	}
	.td{
		padding:0;
		height:10px;
	}
	
	.menu2{
		cursor:pointer;
		transition: all .3s ease-in;
		text-align:right;
		border-bottom:2px solid rgb(239, 244, 245);
		width:90px;
		color:white;
		font-weight:bold;
		background-color:silver;
		text-shadow:0px 0px 2px black;
		padding:5px 10px;
		z-index:100;
	}
	
	
	.appropriationMenu{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
	}
	.appropriationMenu:hover{
		background-color:rgb(6, 44, 66);
		background-color:rgb(199, 108, 133);
		//background-color:rgb(130, 170, 209);
		color:white;
	}
	.menu2Selected{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
		
		background-color:rgb(6, 44, 66);
		background-color:rgb(199, 108, 133);
		
		background-color:rgb(10, 74, 152);
		background-color:rgb(196, 37, 109);
		color:white;
		
	}
	#tdContainers2{
		//border:1px solid red;
		vertical-align:top;
	}
	#appropriationMenuContainer{
		padding:0px 10px;
		background-color:rgb(9, 102, 118);
		background-color:rgb(149, 56, 65);
		
		background-color:rgb(35, 116, 157);
		background-color:rgb(147, 43, 67);
	}
	.contentContainer2{
		//height:100%;
	}
	.show{
		display:block;
	}
	.hide{
		display:none;
	}
</style>  
<table class = "mainTableAppropriation" border = "0" style = "height:100%;">
	<tr>
		<td style = "padding:0;height:10px;" colspan="4">
			<div id ="appropriationMenuContainer">
				<?php
					if($_SESSION['accountType'] == 1){
				?>
						
				<?php
					}
				?>
				<?php
					if($_SESSION['accountType'] == 2 && $_SESSION['officeCode'] == '1071' or $_SESSION['accountType'] >= 2 or $_SESSION['officeCode'] == '8751' ){
				?>
						<div class ="appropriationMenu" onclick="menuClick2(this)">Encode</div>
						
						<div class ="appropriationMenu" onclick="menuClick2(this)">Account List</div>
						<div class ="appropriationMenu" onclick="menuClick2(this)">Changes</div>
						<div class ="appropriationMenu" onclick="menuClick2(this)">Approve</div>
						<div class ="appropriationMenu" onclick="menuClick2(this)">Settings</div>
						<div class ="appropriationMenu" onclick="menuClick2(this)">OBRs</div>
				<?php
					}
				?>
				<?php
					if($_SESSION['accountType'] == 1 or $_SESSION['accountType'] >= 2 && $_SESSION['officeCode'] == '1081'  ){
				?>
						<div class ="appropriationMenu" onclick="menuClick2(this)">Status</div>
				<?php
					}
				?>
			</div>
		</td>
	</tr>
	<tr>
		
		<td id = "tdContainers2" colspan="3" style="background-color:rgb(240, 245, 247);padding-top:20px;">
			<?php
				if($_SESSION['accountType'] == 1){
			?>
					
			<?php
				}
			?>
			<?php
				if($_SESSION['accountType'] == 2 && $_SESSION['officeCode'] == '1071' or $_SESSION['accountType'] >= 2 && $_SESSION['officeCode'] == '1081' or $_SESSION['officeCode'] == '8751'){
			?>
				<div class = "hide">
					<?php	require(ROOTER . 'interface/appropriationEncode.php'); ?>
				</div>
				
				<div class = "hide">
					<?php	require(ROOTER . 'interface/list.php'); ?>
				</div>
				<div class = "hide">
						<?php	require(ROOTER . 'interface/appropriationChanges.php'); ?>
					</div>
				<div class = "hide">
					<?php	require(ROOTER . 'interface/appropriationViewer.php'); ?>
				</div>
				<div class = "hide">
					<?php	require(ROOTER . 'interface/settings.php'); ?>
				</div>
				<div class = "hide">
					<?php	require(ROOTER . 'interface/appropriationTracker.php'); ?>
				</div>
			<?php
				}
			?>
			<?php
				if($_SESSION['accountType'] == 1 or $_SESSION['accountType'] >= 2 && $_SESSION['officeCode'] == '1081'){
				?>
					<div class = "hide">
						<?php echo "<div style = 'padding:20px;height:700px;'>Under Renovation...</br> No need to encode your appropriations. </div>";	//require(ROOTER . 'interface/appropriationStatus.php'); ?>
						
					</div>
			<?php
				}
			?>
		</td>
	</tr>
</table>
<script>

	whenRefreshAppropriationMain();
	function whenRefreshAppropriationMain(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");	
		if(cookieMainText == "Appropriations"){
			loadAppropriation();
		}
	}
	function loadAppropriation(){
		var cookieValue = readCookie("lastMain2").trim();
		
		var parent =  document.getElementById('appropriationMenuContainer');
		parent.children[cookieValue].className = "menu2Selected";
		
		var parentContainer =  document.getElementById('tdContainers2');
		
		parentContainer.children[cookieValue].className = "show";
	
	}
	function menuClick2(me){
		
		menuChanger(me,"menu2Selected","lastMain2","tdContainers2","contentContainer2show");
		
		if(me.textContent == "Encode"){
			loaderAppropriation();
		}else if(me.textContent == "Status"){
			
			loadApproriationStatus();
			loadOfficeInStatus();
		}else if(me.textContent == "Approve"){
			loadOffice();
		}else if(me.textContent == "Settings"){
			
			//loadAllAccountTitles();
		}else if(me.textContent == "Changes"){
			loadOfficeChanges();
		}
		
	}
</script>



