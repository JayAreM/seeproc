
<style>
	#infraMainTable{
		width:100%;
		height:100%;
		border-spacing:0;
	}

	#infraMenuContainer{
		padding:0px 10px;
		background-color:rgb(88, 105, 120);
	}
	.infraMenu{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
	}
	.infraMenu:hover{
		background-color:rgb(135, 132, 129);
		color:white;
	}
	#ppmpContainer{
		
		display:inline-block;
		margin:0 auto;
		box-shadow:0px 0px 4px 1px grey;
	}
	.menuInfrastructureSelected{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
		background-color:rgb(41, 52, 67);
		color:white;
	}
	
</style>

<table id  ="infraMainTable"  >
	<tr>
		<td style = "padding:0;height:1px;">
			<div id ="infraMenuContainer">
				<?php
					if($_SESSION['cbo'] == '8751' ){
				?>
					<div id = "i1" class ="infraMenu" onclick="menuClickInfra(this)">Tracking</div>
				<?php
					}
				?>
				<?php
					if($_SESSION['cbo'] == '8751' || $_SESSION['cbo'] == '1081' || $_SESSION['cbo'] == '1071'){
				?>
					<div id = "i6" class ="infraMenu" onclick="menuClickInfra(this)">Projects</div>
				<?php
					}
				?>
				<div id = "i2" class ="infraMenu" onclick="menuClickInfra(this)">Preparation, Bidding and Pre-construction</div>
				<div id = "i3" class ="infraMenu" onclick="menuClickInfra(this)">Construction</div>
			<!--	<div id = "i4" class ="infraMenu" onclick="menuClickInfra(this)">Payment</div>-->
				<?php
					if($_SESSION['cbo'] == '8751'){
				?>
						<!--<div id = "i5" class ="infraMenu" onclick="menuClickInfra(this)">Forms</div>-->
				<?php
					}
				?>
				<div id = "i6" class ="infraMenu" onclick="menuClickInfra(this)">Upload</div>
				<div id = "i7" class ="infraMenu" onclick="menuClickInfra(this)">Revisions</div>
				<div id = "i8" class ="infraMenu" onclick="menuClickInfra(this)">Finder</div>
				
			</div>
		</td>
	</tr>
	<tr>
		<td style = "background-color:rgb(240, 245, 247); vertical-align:top;text-align:center;background-color: rgba(251, 248, 246,.88);padding:0;height:100%;">
			<div id  = "infrastructureMainContainer" style = "min-height:700px; background-color: rgba(255,255,255,.5);height:100%;"  >
				<?php
					if($_SESSION['cbo'] == '8751'){
				?>
				<div  class = "hide" style="padding:10px 0px;">
					<?php require(ROOTER . 'interface/infraencode.php'); ?>
				</div>
				
				<?php
					}
				?>
				<?php
					if($_SESSION['cbo'] == '8751' || $_SESSION['cbo'] == '1081' || $_SESSION['cbo'] == '1071'){
				?>
				<div  class = "hide" style="padding:10px 0px;"><?php require(ROOTER . 'interface/infraProjects.php'); ?></div>
				<?php
					}
				?>
				<div  class = "hide">
						<?php require(ROOTER . 'interface/infraPBP.php'); ?>
				</div>
				<div  class = "hide" >
						<?php require(ROOTER . 'interface/infraConstruction.php'); ?>
				</div>
				<!--<div  class = "hide">-->
						<?php //require(ROOTER . 'interface/infraphase3.php'); ?>
				<!--</div>-->
				<?php
					if($_SESSION['cbo'] == '8751'){
				?>
					<!--<div  class = "hide">
							<div style = "padding-top:50px;">
								<table style ="margin:0 auto;width:700px;padding:50px;font-size:18px;background-color:rgb(254, 252, 252);box-shadow:0px 0px 10px 5px silver; ">
									<tr>
										<td>1. Print Indorsement by </td><td>Date Encoded</td><td><input style = "text-align: center;" value =''  /></td><td><input id = "indo1" onclick = "openIndorsement(this)" type ="button" value ='Open' /></td>
									</tr>
									<tr>
										<td>2. Print Indorsement by </td><td>Batch Number</td><td><input style = "text-align: center;" value ='' /></td><td><input  id = "indo2" onclick = "openIndorsement(this)" type ="button" value ='Open' /></td>
									</tr>
								</table>
							</div>
					</div>-->
				<?php
					}
				?>
				<div  class = "hide">
						<?php require(ROOTER . 'interface/infraUploader.php'); ?>
				</div>
				<div  class = "hide">
						<?php require(ROOTER . 'interface/infraRevision.php'); ?>
				</div>
				<div  class = "hide">
						<?php require(ROOTER . 'interface/infraViewer.php'); ?>
				</div>
			</div>
		</td>
	</tr>
</table>
<script>
	whenRefreshInfraMain();
	function whenRefreshInfraMain(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Infrastructure Projects"){
			loadInfraMain();
			var cookieValue = readCookie("lastMainInfra").trim();
			/*
			if(cookieValue == 0){
				
			}else if(cookieValue == 1){
				showPhase1();	
			}else if(cookieValue == 2){
				
			}else if(cookieValue == 3){
				
			}else if(cookieValue == 4){
				
			}else if(cookieValue == 5){
				loadInfraProjectOffice();
				loadInfraProjects();
			}*/
			var menuTitle =  cookieLabel(cookieValue,"infraMenuContainer");
			
			if(menuTitle == "Projects"){
				loadInfraProjectOffice();
				loadInfraProjects();
			}else if(menuTitle == "Preparation, Bidding and Pre-construction"){
				showPhase1();	
			}else if(menuTitle == "Construction"){
				showPhase2();
			}
			/*if(cookieValue == 0){
				
			}else if(cookieValue == 1){
				
			}else if(cookieValue == 2){
				
			}else if(cookieValue == 3){
				
			}else if(cookieValue == 4){
				
			}else if(cookieValue == 5){
				
			}*/
		}
		
	
	}
	function loadInfraMain(){
		//sa menu na cookie
		var cookieValue = readCookie("lastMainInfra").trim();
		var parent =  document.getElementById('infraMenuContainer');
		parent.children[cookieValue].className = "menuInfrastructureSelected";
		//sa body
		var parentBody =  document.getElementById('infrastructureMainContainer');
		parentBody.children[cookieValue].className = "mainBodyshow";
	}
	function menuClickInfra(me){
		menuChanger(me,"menuInfrastructureSelected","lastMainInfra","infrastructureMainContainer","");
		var menu = me.id;
		
		if(menu == "i1"){
			var x = infraSelectOffice.children.length;
			if(x < 2){
				fetchOfficeInfra();
			}
		}else if(menu == "i2"){
			var cont = infraPBPContainer.children.length;
			if(cont == 0){
				showPhase1();
			}
		}else if(menu == "i3"){
			var cont = infraConstructionContainer.children.length;
			if(cont == 0){
				showPhase2();
			}
		}else if(menu == "i4"){
			/*var cont = infraPhase3Container.children.length;
			if(cont == 0){
				showPhase3();
			}*/
		}else if(menu == "i5"){
			
		}else if(menu == "i6"){
		/*	if(infraProjectSelectOffice.children.length == 0){
				loadInfraProjectOffice();
			}
			if(infraProjectsContainer.children.length == 0){
				loadInfraProjects();
			}*/	
		}else if(menu == "i8"){
	
		}
		
	}

	function openIndorsement(me){
		var type = me.id;
		var value  = me.parentNode.parentNode.children[2].children[0].value;
		window.open('../interface/formInfraIndorsement.php?type=' + type + '&value=' + value + '&year=' + year, '_new');
	}
</script>



