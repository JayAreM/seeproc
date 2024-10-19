
<style>

	#invitationMenuContainer{
		padding:0px 10px;
		background-color:rgba(131, 131, 131,.9);
		border-bottom:1px solid white;
		border-top:1px solid black;
	}
	.invitationMenu{
		font-family: Helvetica;
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
	}
	.invitationMenu:hover{
		background-color:rgb(62, 60, 61);
		color:white;
	}
	#invitationMainContainer{
		background-color:rgba(249, 250, 252,.5);
		display:inline-block;
		//height:700px;
		margin:0 auto;
		box-shadow:0px 0px 16px 1px grey;
	}
	.invitationMenuSelected{
		font-family: Helvetica;
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
		background-color:rgb(47, 39, 42);
		color:white;
	}
	
</style>

<table id  ="" border = "0" style ="width:100%;height:100%;border-spacing:0px;z-index: 100;"  >
	<tr>
		<td  style = "background-color:rgba(6, 29, 41,.95);vertical-align: middle;height: 10px; ">
			<div  style = "width:900px;margin:0px auto;letter-spacing:1px;" class = "title" >
					CITY GOVERNMENT OF DAVAO PROCUREMENT POSTING
			</div>
		</td>
	</tr>
	<tr>
		<td style = "padding:0;height:1px;">
			<div id ="invitationMenuContainer" >
				
				<?php
					if(isset( $_SESSION['accountType'])){
						$acct  = $_SESSION['accountType'];
					}else{
						$acct  =0;
					}
					if($acct == 10){
				?>
					<div class ="invitationMenu" onclick="menuClick4(this)">UPLOAD</div>
				<?php
					}
				?>
				<div class ="invitationMenuSelected" onclick="menuClick4(this)">SCHEDULE</div>
			</div>
		</td>
	</tr>
	<tr>
		<td   style = "vertical-align:top;background-color: rgba(249, 251, 252,.89);">
			
			<table style = "margin:0 auto;width:100%;height:100%;"  border = "0">
				<tr>
					<td  style = "background:url(../images/davao.png);background-position:20px 20px;	background-repeat:no-repeat;width:15%;opacity:.2;"></td>
					
					<td  style = "text-align: center;vertical-align: middle;">
						<div  id  = "invitationMainContainer" >
							<?php
								if(isset( $_SESSION['accountType'])){
									$acct  = $_SESSION['accountType'];
								}else{
									$acct  =0;
								}
								
								if($acct == 10){
							?>
							<div class = "hide">
									<?php	require(ROOTER . 'interface/invitationUpload.php'); ?>
							</div>
							<?php
								}
							?>
							<div class = "hi1de">
									<?php	require(ROOTER . 'interface/invitationSchedule.php'); ?>
							</div>
						</div>
					</td>
					<td  style = "width:15%;"></td>
				</tr>
			
			</table>
			
			
		</td>
	</tr>
</table>

<script>
	
	
	function loadInvitationMain(){
		//sa menu na cookie
		var cookieValue = readCookie("lastMain4").trim();
		var parent =  document.getElementById('invitationMenuContainer');
		var len  =  parent.children.length;
		if(cookieValue >= len){//pag lapas sa menu ang cookie
			cookieValue = 0;
		}
		parent.children[cookieValue].className = "invitationMenuSelected";
		//sa body
		var parentBody =  document.getElementById('invitationMainContainer');
		parentBody.children[cookieValue].className = "mainBodyshow";
	}
	
	function menuClick4(me){
		
		menuChanger(me,"invitationMenuSelected","lastMainInvitation","invitationMainContainer","");
			
	}
</script>



