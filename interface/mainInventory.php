
<style>
	#mainTableInventory{
		
		border-spacing:0;
		width:100%;
		height:100%;
	}



	#InventoryMenuContainer{
		padding:0px 10px;
		background-color:rgb(218, 102, 30);
	}
	.InventoryMenu{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
	}
	.InventoryMenu:hover{
		background-color:rgb(6, 44, 66);
		background-color:rgb(226, 177, 152);
		//background-color:rgb(130, 170, 209);
		color:white;
	}



	.menu7Selected{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
		
		background-color:rgb(6, 44, 66);
		background-color:rgb(199, 108, 133);
		
		background-color:rgb(10, 74, 152);
		//background-color:rgb(229, 111, 52);
		background-color:rgb(145,64,13);
		color:white;
		
	}

	#InventoryMainContainer{
		background-color:white;
		padding:20px;
		display:inline-block;
		margin:0 auto;
	}
	
	/* #InventoryMainContainer{
		background-color:white;
		//width:800px;
		//display:inline-block;
		//height:700px;
		margin:0 auto;
		//box-shadow:0px 0px 4px 1px grey;
		//box-shadow:0px 0px 16px 3px grey;


	} */

	.hover:hover{
		font-weight: bold;
		cursor: pointer;
	}
</style>
<table id  ="mainTableInventory" border = "0">
	<tr>
		<td style = "padding:0;height:10px;" >

			<div id ="InventoryMenuContainer">
				
				<?php 
					
					//if($_SESSION['employeeNumber'] == '016802'  or $_SESSION['employeeNumber'] == '063770' or $_SESSION['employeeNumber'] == '049026') { 
					if( $_SESSION['perm'] == 32) {
					?>
						<div class ="InventoryMenu" onclick="menuClick7(this)">Management</div>
				<?php }else if($_SESSION['gso'] == '1061'  &&  $_SESSION['perm'] == 10) { ?>
						<div class ="InventoryMenu" onclick="menuClick7(this)">Inspection & Inventory</div>
				<?php }else{?>
						<div class ="InventoryMenu" onclick="menuClick7(this)">Ongoing</div>
						<?php if($_SESSION['accountType'] == '7' || $_SESSION['perm'] == '45' || $_SESSION['cbo'] == '1081') {?>
							<div class ="InventoryMenu" onclick="menuClick7(this)">Assets</div>
						<?php } ?>
				<?php } ?>

			</div>
		</td>
	</tr>
	<tr>
		<td  style = "padding-top:40px; padding-bottom:20px; vertical-align:top;text-align:center;background-color: rgba(249, 251, 252,.89); background-color:white;">
				
				<div id  = "InventoryMainContainer" style = "">
					<?php 
						/*if( $_SESSION['employeeNumber'] == '016802' or $_SESSION['employeeNumber'] == '063770' or $_SESSION['employeeNumber'] == '049026') { */
						if( $_SESSION['perm'] == 32) {
					?>
						<div class = "hide">
							 <?php require(ROOTER . 'inventory/itemManagement.php'); ?> 
						</div>
					<?php  }else if($_SESSION['gso'] == '1061' &&  $_SESSION['perm'] == 10) { ?>
								<div class = "hide">
									<div style = "font-family:Oswald;font-size:24px;width:800px;height:500px;padding:20px;text-align:left;letter-spacing:1px;">
										<div style = "padding-left:20px;color:rgb(36, 157, 209);font-weight: bold;border-bottom: 1px solid silver;">Inventory Modules</div>
										<div style ="padding-left:20px;" class="hover" onclick="gotoIn()">1. Inspection and Inventory</div>
										<div style ="padding-left:20px;" class="hover"  onclick="gotoARE()">2. Acknowledgement Receipt for Equipment </div>	
									</div> 
								</div>
					<?php }else{ ?>
							<div class = "hide">
								<div style = "font-family:Oswald; font-size:24px; width:800px; height:400px; padding:20px; text-align:left; letter-spacing:1px;">
									<div style = "padding-left:20px;color:rgb(36, 157, 209);font-weight: bold;border-bottom: 1px solid silver;">Directory</div>
									<div style ="padding-left:20px;" class="hover" onclick="gotoIn()">1. Inventory System</div>
								</div> 
							</div>

							<?php if($_SESSION['accountType'] == '7' || $_SESSION['perm'] == '45' || $_SESSION['cbo'] == '1081') {?>
								<div class = "hide">
									<?php	require(ROOTER . 'interface/inventoryAssetViewer.php'); ?>
								</div>
							<?php } ?>
							
							<!--<div class = "hide1" style = "box-shadow: 0;width:340px;height:340px; margin:0 auto;background:url(../images/under.png);background-repeat: no-repeat;background-position-y:10px;"></div>-->
					<?php } ?>
				</div>
		</td>
	</tr>
</table>
<script>

	whenRefreshInventoryMain();
	cookieInventory();

	function cookieInventory() {
		var returnValuetoZero   = "<?php if( isset($_COOKIE['lastMain7']) )  { echo $_COOKIE['lastMain7']; }?>"; 
		var menu =  document.getElementById('InventoryMenuContainer');
		if(returnValuetoZero) {
			if (returnValuetoZero == 0) {
				loadAcceptanceStyle();
			} else if (returnValuetoZero == 1) {
				if(menu.children[returnValuetoZero].textContent.trim() == 'Assets') {
					// loadAcceptanceStyle();
					itemManagementViewStyle();
					invLoadOffices();
				}else {
					itemManagementViewStyle();
				}
			}
		}
	}

	
	function whenRefreshInventoryMain(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		
		if(cookieMainText == "Inventory"){
			loadInventory();
			
			/*var cookieText = cookieLabel(cookieInventoryMenu(),"doctrackMenuContainer");
			if(cookieText == "Forum"){
				loadForumMessages();
			}*/
			
		}
	}
	
	function loadInventory(){
		//sa menu na cookie
		var cookieValue = readCookie("lastMain7");
		var parent =  document.getElementById('InventoryMenuContainer');
		parent.children[cookieValue].className = "menu7Selected";
		//sa body
		var parentBody =  document.getElementById('InventoryMainContainer');
		// parentBody.children[cookieValue].className = "mainBodyshow";
		parentBody.children[cookieValue].className = ""; // 2022-08-08 remove because class causes div to go out of bounds.
	}
	
	function menuClick7(me){
		menuChanger(me,"menu7Selected","lastMain7","InventoryMainContainer","");
		//var acceptanceDiv = me.parentNode.children[0];
		var menuChoose = me.textContent;
		if (menuChoose == "Acceptance Report") {
			loadAcceptanceStyle();
		}else if (menuChoose == "Management") {
			DataConveyedonManagement();
			itemManagementViewStyle();
		}else if (menuChoose == "Assets") {
			// loadAcceptanceStyle();
			itemManagementViewStyle();
			invLoadOffices();
		}else {
			loadAcceptanceStyle();
		}
	}

	function loadAcceptanceStyle() {
		//document.getElementById('divOuter').style.padding = '20';
		document.getElementById('InventoryMainContainer').style.display = 'inline-block';
		document.getElementById('InventoryMainContainer').style.backgroundColor = 'white';
		document.getElementById('InventoryMainContainer').style.margin = 'auto';
		//document.getElementById('InventoryMainContainer').style.minHeight = '700px';
		document.getElementById('InventoryMainContainer').style.boxShadow  = '0px 0px 4px 1px grey';
		document.getElementById('InventoryMainContainer').style.boxShadow  = '0px 0px 16px 3px grey';
	}

	function itemManagementViewStyle(){
		document.getElementById('InventoryMainContainer').style.display = 'block';
		document.getElementById('InventoryMainContainer').style.padding = '0';
		document.getElementById('InventoryMainContainer').style.margin = '0';
		document.getElementById('InventoryMainContainer').style.backgroundColor = '';
		document.getElementById('InventoryMainContainer').style.boxShadow  = '';
	}
	function gotoIn(){
		//window.open('../interface/doctrackAdvice.php');
		window.open('../../inventory/interface/main.php');
	}	

</script>



