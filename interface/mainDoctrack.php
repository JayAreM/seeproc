
<style>
	#doctrackMainTable{
		
		border-spacing:0;
		width:100%;
		height:100%;
	}
	
	#doctrackMenuContainer{
		padding:0px 10px;
		//background-color:rgb(16, 113, 169);
		background-color:rgb(9, 102, 118);
		background-color:rgb(149, 56, 65);
		background-color:rgb(35, 116, 157);
	}
	.doctrackMenu{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
	}
	.doctrackMenu:hover{
		background-color:rgb(6, 44, 66);
		background-color:rgb(199, 108, 133);
		background-color:rgb(130, 170, 209);
		color:white;
	}
	#doctrackMainContainer{
		background-color:white;
		display:inline-block;
		margin:0 auto;
		box-shadow:0px 0px 4px 1px grey;
		box-shadow:0px 0px 16px 3px grey;
	}
	.menu4Selected{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
		
		background-color:rgb(6, 44, 66);
		background-color:rgb(199, 108, 133);
		
		background-color:rgb(10, 74, 152);
		background-color:rgb(16, 71, 126);
		color:white;
	}
	#newMenu:after{
		content:"New";
		position: absolute;
		margin-top: 18px;
		margin-left: -15px;
		color:white;
		padding:0px 2px;
		background-color: red;
		height:12px;
		color:white;
		font-size: 10px;
		font-style:italic;
		letter-spacing: 1px;
		text-shadow: 0px 0px 1px black;
	}
	
	#tableDoctrackDBFList{
        margin:0px auto;
        margin-bottom:5px;
        border:1px solid rgb(211, 212, 212);
        border-bottom: 3px solid rgb(211, 212, 212);
        font-size:11px;
        padding:2px;
        font-family:Oswald;
        border-spacing: 0px;
        /* border-collapse:collapse; */
    }

    #tableDoctrackDBFList td{
        text-align: right;
        border:1px solid white;
        padding:5px;
    }

    #tableDoctrackDBFList td:nth-child(11), #tableDoctrackDBFList td:nth-child(12), #tableDoctrackDBFList td:nth-child(13){
        background-color:rgb(241, 244, 230);
    }

    #tableDoctrackDBFList td:nth-child(10), #tableDoctrackDBFList td:nth-child(14){
        background-color:rgb(230, 232, 233);
    }

    #tableDoctrackDBFList tr:nth-child(odd) {
        background-color:rgb(230, 243, 246);
    }

    #tableDoctrackDBFList tr:hover > td {
        background: rgb(248, 236, 165);
    }

	.wgsPlainInput{
		display:block; 
		font-family:Oswald; 
		font-size:16px; 
		font-weight:bold;
		background-color:white;
		border:0px;
		padding:0px;
		color:black;
	}
	.wgsValuePlain{
		display:block; 
		font-family:Oswald; 
		font-size:16px; 
		font-weight:bold;
		background-color:white;
		border:0px;
		padding:0px;
		color:black;
		text-align:right;
	}
	.wgsDPDPlain{
		font-family: Oswald;
		padding: 3px 6px;
		font-size: 16px;
		font-weight: bold;
		border: 1px solid silver;
		width: 270px;
		border:0px;
		border-bottom:1px solid silver;
	}

	#tablePeaceAndOrderWGS th {
		background-color:rgb(70, 89, 106);
		position: -webkit-sticky; /* Safari */
 		position: sticky;
		top:0px;
		font-size:14px;
		text-align:left;
		color:white;
		padding:2px 5px;
	}
	#tablePeaceAndOrderWGS td{
		border:1px solid black;
		border-left:0px;
		border-top:0px;
		padding:2px 5px;
	}

	#tablePeaceAndOrderWGS td:first-child{
		border-left:1px solid black;
	}

	#tablePeaceAndOrderWGS td:nth-child(2){
		background-color:rgb(241, 244, 230);
	}

	#tablePeaceAndOrderWGS tr:hover > td{
		background-color:rgb(248, 236, 165);
	}

	#tablePeaceAndOrderWGSCont {
		overflow-y: scroll;
		scrollbar-width: thin; 
		-ms-overflow-style: thin;
	}

	/* #tablePeaceAndOrderWGSCont {
		overflow-y: scroll;
		scrollbar-width: none; 
		-ms-overflow-style: none;
	}
	#tablePeaceAndOrderWGSCont::-webkit-scrollbar { 
		width: 0;
		height: 0;
	} */
</style>

<table id  ="doctrackMainTable" border = "0"  >
	<tr>
		<td style = "padding:0;height:1px;">
			<div id ="doctrackMenuContainer" >
				<?php
				
					if($_SESSION['accountType'] == 1){
				?>
						<div class ="doctrackMenu" onclick="menuClick4(this)">New</div>
				<?php
					}
				?>
				<div class ="doctrackMenu" onclick="menuClick4(this)">Tracker</div>
				<div class ="doctrackMenu" onclick="menuClick4(this)">Forum</div>
				
				<!-- <div class ="doctrackMenu" onclick="menuClick4(this)" style = "background-color:rgb(108, 130, 86);">Additional PO Tracking Status </div> -->
				
				<?php
					if($_SESSION['officeCode'] ==  '8751'  or $_SESSION['officeCode'] ==  'LSBD' ){
				?>
					<div class ="doctrackMenu" onclick="menuClick4(this)">PPMP</div>
				<?php
					}
				?>
				
				<?php
					if($_SESSION['accountType'] > 2 || $_SESSION['officeCode'] == 'SUGA'  || $_SESSION['officeCode'] == 'BILL'){
						if($_SESSION['accountType'] !=  10){
				?>
							<div class ="doctrackMenu" onclick="menuClick4(this)">Settings</div>
							
				<?php
						}else if($_SESSION['accountType'] ==  10){
				?>
							<div class ="doctrackMenu" onclick="menuClick4(this)">BAC Posting</div>
							<div class ="doctrackMenu" onclick="menuClick4(this)">Supplier Registry</div>		
				<?php
						}
					}
				?>
				<?php
					if($_SESSION['accountType'] == 4 || $_SESSION['accountType'] == 7 || $_SESSION['employeeNumber'] == 900101 || $_SESSION['employeeNumber'] == 198000){
				?>
					<div class ="doctrackMenu" onclick="menuClick4(this)">Balance</div>
				<?php
					}if($_SESSION['accountType'] == 1){
				?>
					
						<div class ="doctrackMenu" onclick="menuClick4(this)">Balance</div>
				<?php		
					}if($_SESSION['accountType'] == 2 and $_SESSION['cbo'] == '1071'){
					
				?>	
						
						<div class ="doctrackMenu" onclick="menuClick4(this)">Balance</div>	
				<?php
					}
				?>
				<?php
					if($_SESSION['accountType'] == 1 || $_SESSION['cbo'] == 1071 || $_SESSION['gso'] == 1081){
				?>
						<div class ="doctrackMenu" onclick="menuClick4(this)">Liquidated</div>
				<?php
					}
				?>
				<div class ="doctrackMenu" onclick="menuClick4(this)">Attachments</div>
				<?php
					if($_SESSION['accountType'] == 1 ){
				?>
					<div class ="doctrackMenu" onclick="menuClick4(this)" >SMS</div>
				<?php
					}
				?>
				<?php
					if($_SESSION['perm'] == 33 ){
				?>
					<div class ="doctrackMenu" onclick="goto1(this)" >Light</div>
				<?php
					}
				?>
				<?php
					if($_SESSION['perm'] == 33 ){
				?>
						<div class ="doctrackMenu" onclick="gotoWater(this)" >Water</div>
				<?php
					}
				?>
				<?php
					if($_SESSION['perm'] == 34 ){
				?>
					 <div class ="doctrackMenu" onclick="gotoLingap(this)" >Lingap</div> 
				<?php
					}
				?>
				
				<div class ="doctrackMenu" onclick="menuClick4(this)">Retention</div>
				<div class ="doctrackMenu" onclick="menuClick4(this)">Counter Daily</div>
				<div class ="doctrackMenu" onclick="menuClick4(this)">Counter Qtr</div>
				<div class ="doctrackMenu" onclick="menuClick4(this)">PR Summary</div>
				<div class ="doctrackMenu" onclick="menuClick4(this)">Calendar</div>
				<div class ="doctrackMenu" onclick="menuClick4(this)">Checks</div>
				<div class ="doctrackMenu" onclick="gotoCheckerist(this)">CTO</div>
			<?php
					 if($_SESSION['cbo'] == '1091' ){
				?>
						<div class ="doctrackMenu" onclick="menuClick4(this)">PM</div>
						<div class ="doctrackMenu" onclick="menuClick4(this)">Window</div>
			<?php
					 }
			?>
				<!-- <div class ="doctrackMenu" onclick="menuClick4(this)">Infra</div> -->
			</div>
		</td>
	</tr>
	<tr>
		<td  style = "padding-top:20px;padding-bottom:20px; vertical-align:top;text-align:center;background-color: rgba(249, 251, 252,.89);">
			<div style = "padding:20px;background-color:white;display:inline-block;">
				<div id  = "doctrackMainContainer" style = "min-height:700px;">
					<?php
						if($_SESSION['accountType'] == 1){
					?>
							<div class = "hide"><?php	require(ROOTER . 'interface/doctrack_Add2018.php'); ?></div>
					<?php
						}
					?>
					
					<div class = "hide">
							<?php	require(ROOTER . 'interface/trackerNew.php'); ?>
					</div>
					<div class = "hide">
							<?php	require(ROOTER . 'interface/forum.php'); ?>
					</div>
					
					<!-- <div class = "hide">
							<?php	//require(ROOTER . 'interface/guide.php'); ?>
					</div> -->
					<?php
						if($_SESSION['officeCode'] ==  '8751'  or $_SESSION['officeCode'] ==  'LSBD' ){
					?>
						<div class = "hide">
								<?php	require(ROOTER . 'interface/ppmpSettings.php'); ?>
						</div>
					<?php
						}
					?>
					<?php
						if($_SESSION['accountType'] > 2 || $_SESSION['officeCode'] == 'SUGA'  || $_SESSION['officeCode'] == 'BILL'){
							if($_SESSION['accountType'] !=  10){
					?>
							<div class = "hide">
								<?php	require(ROOTER . 'interface/doctracksettings.php'); ?>
							</div>
							
					<?php
							}else if($_SESSION['accountType'] ==  10){
					?>
								<div class = "hide"></div>
								<div class = "hide"></div>
					<?php		
							}	
							
						}
						
					?>
					
					
					<?php
						if($_SESSION['cbo'] == 1071 || $_SESSION['accountType'] == 4 || $_SESSION['accountType'] == 7 || $_SESSION['employeeNumber'] == 900101 || $_SESSION['employeeNumber'] == 198000  ){
					?>
							<div class = "hide"><?php	require(ROOTER . 'interface/doctrackobr.php'); ?></div>
					<?php
						}
						if($_SESSION['accountType'] == 1){
					?>		
							<div class = "hide"><?php	require(ROOTER . 'interface/balancesOffice.php'); ?></div>
					<?php
						}
					?>	
					
					<?php		
						if($_SESSION['accountType'] == 1 || $_SESSION['cbo'] == 1071 || $_SESSION['gso'] == 1081){
					?>
						<div class = "hide">
								<?php	require(ROOTER . 'interface/liquidated.php'); ?>
						</div>
					<?php
						}
					?>
					<div class = "hide">
								<?php	require(ROOTER . 'interface/materials.php'); ?>
					</div>
					<?php
						if($_SESSION['accountType'] == 1 ){
					?>
						<div class = "hide">
								<?php	require(ROOTER . 'interface/smsregister.php'); ?>
						</div>
					<?php
						}
					?>
					<?php
						if($_SESSION['perm'] == 33 ){
					?>
							<div class = "hide"></div>
							<div class = "hide"></div>
							
					<?php
						}
					?>
					
					
					<div class = "hide">
								<?php	
									require(ROOTER . 'interface/retention.php'); 
								?>
					</div>
					<div class = "hide">
								<?php	require(ROOTER . 'interface/counterDaily.php'); ?>
					</div>
					<div class = "hide">
								<?php	require(ROOTER . 'interface/counter.php'); ?>
					</div>
					
					<div class = "hide">
								<?php	require(ROOTER . 'interface/prSummary.php'); ?>
					</div>
					<div class = "hide">
								<?php	require(ROOTER . 'interface/calendar.php'); ?>
					</div>
					<div class = "hide">
								<?php	require(ROOTER . 'interface/advisedlist.php'); ?>
					</div>
					<div class = "hide"></div>
					<?php
						if($_SESSION['cbo'] == '1091' ){
					?>
						<div class = "hide">
									<?php	require(ROOTER . 'interface/paymaster.php'); ?>
						</div>
						<div class = "hide">
									<?php	require(ROOTER . 'interface/doctrackwindow.php'); ?>
						</div>
					<?php
						}
					?>
					<!-- <div class = "hide">
						<?php	// require(ROOTER . 'interface/infraencode.php'); ?>
					</div> -->
				</div>
			</div>
		</td>
	</tr>
</table>
<script>
	whenRefreshDoctrackMain();
	
	function whenRefreshDoctrackMain(){
		
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		
		if(cookieMainText == "Document Tracking"){
			loadDoctrackMain();		
		}
	}
	
	function loadDoctrackMain(){
		
		//sa menu na cookie
		var cookieValue = readCookie("lastMain4");
		
		var parent =  document.getElementById('doctrackMenuContainer');
		var len  =  parent.children.length;
		if(cookieValue >= len){//pag lapas sa menu ang cookie
			cookieValue = 0;
		}
		parent.children[cookieValue].className = "menu4Selected";
		//sa body
		var parentBody =  document.getElementById('doctrackMainContainer');
		
		parentBody.children[cookieValue].className = "mainBodyshow";
		
	}
	
	function menuClick4(me){
		if(me.textContent == "Reports"){
			window.open('../interface/doctrackTransmitalPage.php');
		}else if(me.textContent == "BAC Posting"){
			window.open('/baxia/interface/main.php');	
		}else if(me.textContent == "Supplier Registry"){
			window.open('/sure/interface/main.php');	
		}else{
			menuChanger(me,"menu4Selected","lastMain4","doctrackMainContainer","");
			
			
			if(me.textContent == "Tracker"){
				//loadClaimType();
				//loadFirstTracker();
				//loadOffice1();
			}else if (me.textContent == "Forum"){
				lastForumId =  document.getElementById("lastForumId");
				if(lastForumId){
					setCookie ("forumId", lastForumId.children[0].id, 10);
				}
				loadForumMessages();
			}else if (me.textContent == "Liquidated"){
				loadCashAdvanceOffice();
				loadLiquidated();
			}else if (me.textContent == "Balance"){
				if(obrOfficeContainer.children.length == 0){
					loadOBRfunds();
				}
				
			}else if (me.textContent == "Attachments"){
				getAttachments();
			}else if(me.textContent == "SMS"){
				getSMSsettings();	
			}else if(me.textContent == "Retention"){
				loadRetentionOffice();
				loadRetention();
			}else if(me.textContent == "New"){
				//alert("Do not encode here yet.  Thanks");	
			}else if(me.textContent == "Counter Qtr"){
				fetchCounter();	
			}else if(me.textContent == "Counter Daily"){
				goCalendarNcal();	
			}else if (me.textContent == "PR Summary"){
				loadPrSummaryTotal();
			}else if (me.textContent == "Calendar"){
				goCalendar();
			}else if (me.textContent == "Checks"){
				//optForReleased1.click();
			}else if(me.textContent == "PM"){
				payCallTrackingType();
			}else if(me.textContent == "Window"){
				fetchPaymaster();
			}
			
		}
	}
	function goto1(me){
		window.open('../../lighter/interface/main.php');
	}
	function gotoWater(me){
		window.open('../../bills/interface/main.php');
	}
	function gotoLingap(me){
		window.open('../interface/doctrackLingap.php');
	}
	function gotoCheckerist(me){
		window.open('../../chequerist/interface/main.php');
	}


</script>



