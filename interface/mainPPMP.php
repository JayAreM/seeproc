
<style>
	#ppmpMainTable{
		
		border-spacing:0;
		width:100%;
		height:100%;
	}

	#ppmpMenuContainer{
		padding:0px 10px;
		background-color:rgb(185, 136, 3);
		background-color:rgb(163, 149, 116);
	}
	.ppmpMenu{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
	}
	.ppmpMenu:hover{
		background-color:rgb(151, 137, 121);
		color:white;
	}
	#ppmpContainer{
		
		display:inline-block;
		margin:0 auto;
		box-shadow:0px 0px 4px 1px grey;
	}
	.menu6Selected{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
		background-color:rgb(135, 107, 68);
		color:white;
	}
	
</style>

<table id  ="ppmpMainTable" border = "0">
	<tr>
		<td style = "padding:0;height:1px;">
			<div id ="ppmpMenuContainer">
				<div class ="ppmpMenu" onclick="menuClick6(this)">Encode</div>
				<div class ="ppmpMenu" onclick="menuClick6(this)">View</div>
				<div class ="ppmpMenu" onclick="menuClick6(this)">Infrastructure</div>
				<?php
					if($_SESSION['accountType'] == 2 and $_SESSION['cbo'] == '1071' or $_SESSION['accountType'] == 7 ){
						echo '<div class ="ppmpMenu" onclick="menuClick6(this)">Lock</div>';
					}
				?>
				
			</div>
		</td>
	</tr>
	<tr>
		<td style = "background-color:rgb(240, 245, 247);padding-top:20px;padding-bottom:20px; vertical-align:top;text-align:center;background-color: rgba(251, 248, 246,.88);">
			<div id  = "ppmpMainContainer" style = "min-height:700px;"  >
				<div class = "hide">
						<?php require(ROOTER . 'interface/ppmpEncode.php'); ?>
				</div>
				<div class = "hide">
						<?php require(ROOTER . 'interface/ppmpView.php'); ?>
				</div>
				<div class = "hide">
						<?php //require(ROOTER . 'interface/ppmpView.php'); ?>
				</div>
				<?php
					if($_SESSION['accountType'] == 2 and $_SESSION['cbo'] == '1071' or $_SESSION['accountType'] == 7){
				?>
						<div class = "hide">
							<div id = "lockerA">
								<?php require(ROOTER . 'interface/ppmpLockFund.php'); ?>
							</div>
							<div id = "lockerB" style = "display:none;">
								<?php require(ROOTER . 'interface/ppmpLock.php'); ?>
							</div>
						</div>
				<?php		
					}
				?>
				
			</div>
		</td>
	</tr>
</table>
<script>
	whenRefreshPPMPMain();
	function whenRefreshPPMPMain(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Procurement"){
			loadPPMPMain();
		}
	}
	function loadPPMPMain(){
		//sa menu na cookie
		var cookieValue = readCookie("lastMain6").trim();
		var parent =  document.getElementById('ppmpMenuContainer');
		parent.children[cookieValue].className = "menu6Selected";
		//sa body
		var parentBody =  document.getElementById('ppmpMainContainer');
		parentBody.children[cookieValue].className = "mainBodyshow";
	}
	
	function menuClick6(me){
		
		if(me.textContent == "Infrastructure"){
			window.open('infrastructure.php');	
		}else{
			menuChanger(me,"menu6Selected","lastMain6","ppmpMainContainer","");
			var menu = me.textContent;
			if(menu == "Encode"){
				var x = checkIfcontains("ppmpProgramContainer");
				if(x == 0){
					preLoad();
				}
			}else if(menu == "View"){
				var x = checkIfcontains("ppmpViewSelectProgramContainer");
				if(x == 0){
					//loadSelectViewProgram();
					loadPPMPviewOffice();
				}
				
			}else if(menu == "Lock"){
					
					field  = "Name";
					loadPPMPlockFund(1,field);
					loadPPMPlockOffice(1);
			}
		}
	}
	function checkIfcontains(id){
		var select = document.getElementById(id).children[0];
		if(select.length == 1){
			if(select.value.length == 0){
				return 0;
			}else{
				return 1;
			}
		}else{
			return 1;
		}
		
	}
	
</script>



