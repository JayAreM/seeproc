<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<?php

	
	defined('ROOTER') ? NULL : define("ROOTER","../");
	require_once('../ajax/dataprocessor.php');
	require_once('../javascript/ajaxFunction.php');

	if(!isset($_SESSION)){
		session_start();
	}
?>
<!DOCTYPE HTML>
<style>
	@font-face {
	        font-family: "sac";
	        src: url("../fonts/Sacramento-Regular.ttf");
	}
	@font-face {
	        font-family: "kan1";
	        src: url("../fonts/Khand-Light.ttf");
	}
	@font-face {
	        font-family: "kan2";
	        src: url("../fonts/Khand-Regular.ttf");
	}
	@font-face {
	        font-family: "kan3";
	        src: url("../fonts/Khand-Medium.ttf");
	}
	@font-face {
	        font-family: "tit";
	        src: url("../fonts/BebasNeue-Regular.ttf");
	}
	@font-face {
	        font-family: "tit1";
	        src: url("../fonts/Dosis-VariableFont_wght.ttf");
	}
	@font-face {
	        font-family: "tit22";
	        src: url("../fonts/Dosis-Light.ttf");
	}
	
	body{
		font-family: kan1;
		padding:0;
		margin:0;
	}
	/*-----------------------------------------------------------------loader*/
	.absoluteHolder{
		z-index:105;
		position:absolute;
		text-align:center;
		
		background-color:rgba(252, 254, 254,.1);
		
		width:100%;
		height:100%;
	}
	.loader{
			background:url('../images/loader1a.gif');
			top:40%;
			background-repeat:no-repeat;
			z-index:100;
			width:420px;
			height:400px;
			background-size:460px 400px;
			background-position:48% 48%;
			
	}	
	.loaderContainer{
		border:4px solid transparent;
		border-radius:2px;
		display:inline-block;	
		
	}
	.absoluteHolder1{
		z-index:105;
		position:absolute;
		text-align:center;
		background-color:rgba(252, 254, 254,.1);
		width:100%;
		height:100%;
	}
	/*-----------------------------------------------------------------loader*/
	input{
		font-family: "kan2";		
	}
	#mainTable{
		height: 100%;
		width:100%;
		border-spacing: 0;
		background: linear-gradient(to right, transparent ,rgba(246, 247, 234));
	}
	#mainTable td{
		border-spacing: 0;
		width:100%;
		
	}
	#mainTableInner{
		border-spacing: 0;
		display: inline-block;
		font-size: 16px;
		-webkit-user-select: none;
		//opacity: .5;
	}
	#mainTableInner:hover{
		opacity:1;
	}
	.mainDivMenu{
		width: 100px;
		text-align: center;
		font-family: kan2;
		cursor: pointer;
		transition: all .3s ease-in;
		//font-family: tit;
		
	}
	.mainDivMenu:hover{
		color:green;
		text-shadow: 0px 0px 2px white;
		letter-spacing: 1px;
		transition: all .3s ease-in;
		font-family: tit;
	}
	.selected{
		width:120px;
		font-family: kan2;
		font-weight:bold;
		color:rgb(75, 117, 34);
		text-align: center;
		transition: all .3s ease-in;
		letter-spacing: 1px;
	}
	.selected:before{
		content: "*";
		margin-right:10px;
		color:red;
	}	
	
	.hide{
		display: none;
	}
	.show{
		display:block;
		height:100%;
	}
	.highlightMenu{
		text-shadow: 0px 0px 2px white;
		transition: all 1s ease-in;
		
		cursor: pointer;
	}
	.highlightMenu:hover{
		font-family: kan2;
		color:green;
		text-shadow: 0px 0px 2px white;
		letter-spacing: 1px;
		transition: all 1s ease-in;
	}
	.linkBill{
		color:rgb(41, 83, 20);
	}
	.linkBill:hover{
		color:orange;
		letter-spacing: 2px;
		transition: all .1s ease-in;
	}
	#mainTable{
		border:0px solid transparent;
		background:url(../images/bg1.png);	
		//background-repeat: no-repeat;
		//background-size:660px 230px;
		background-size:100%;
		//background-position: 350px 150px;
	}
	body{
		background:url(../images/let.png);	
	}
	.bg{
		border:0px solid transparent;
		//background:url(../images/davaologo7.png);	
		background-repeat: no-repeat;
		background-size:660px 230px;
		background-position: 50px 50px;
	}
	.title1{
		color:gray;
		font-family: tit;
		font-size: 28px;
		padding-left:95px;
		text-shadow: 0px 0px 2px white;
		display: inline-block;
		position: absolute;
		background: linear-gradient(to left, transparent ,rgba(138, 162, 40,.5));
		padding-right:15px;
		z-index: -2;
	}
	.title2{
		font-size:14px;
		font-weight: normal;
		text-align: right;
		font-family: tit;
		line-height: 50px;color:rgb(97, 143, 74);
		font-size:62px;
		font-weight: bold;
		
		z-index: -3;
		text-shadow: 0px 0px 2px white;
		padding-right:50px;	
	}
	.linkTo{
		cursor: pointer;
		font-weight: bold;
		color:black;
		padding-left:15px;
		color:silver;
	}
	.linkTo:hover{
		color:orange;
		
	}
</style>

<html>
	<head>
		<title>Bills</title>	
		<link rel="icon" href="/bills/images/water.png"/> 
	</head>
	<body>
		<div class = "bg" >
			<table style = "position: absolute;margin-left:50px;margin-top:20px;border-left:3px dashed grey;border-bottom:3px dashed grey;z-index: -1;opacity:.9;width:150px;" >
				<tr><td><span class ="title1">WATER</span></td><td class ="title2">BILL</td></tr>
				<tr><td><span class ="title1">TELECOM</span></td><td class ="title2" style = "color:rgb(55, 104, 63);">BILL</td></tr>
				<tr><td><span class ="title1">CABLE</span></td><td class ="title2">BILL</td></tr>
				<tr><td colspan = "2">
					<div style="letter-spacing:3px;margin-top:12px;font-family:kan2;line-height:15px;font-weight:b1old;position: absolute;bor1der:1px solid silver;font-size:12px;width:160px;">
						Billing Preparation and Monitoring Sytem 
							<span style = "color:rgb(44, 77, 9);font-size: 16px;font-family: tit;"> 
							{<?php  echo   $year ; ?>}
							</span>
					</div></td>
				</tr>
				
			</table>
			
			<table border="0"  id = "mainTable"  >
			<tr>
				<td style = "height:10px;text-align: center;line-height: 9px;">
					<table id = "mainTableInner" border= "0" style="margin-left:200px;">
						<tr>
							<td><div style = "display: none;"></div></td>
							<td><div class = "mainDivMenu" onclick="clickMenu(this)">Water</div></td>
							<td><div class = "mainDivMenu" onclick="clickMenu(this)">TBA</div></td>
							<td><div class = "mainDivMenu" onclick="clickMenu(this)">TBA</div></td>
							<td><div class = "mainDivMenu" onclick="clickMenu(this)">Accounts</div></td>
							
						</tr>
					</table>
					<div style = "display: inline-block;border:0px solid black;float: right;padding-right:20px;padding-top:10px;letter-spacing: 1px;color:silver;font-size: 12px;color:rgb(112, 141, 9);">
					<span style = "color:grey;padding-right:3px;font-weight: bold;">Hello </span><?php echo $_SESSION['fullName'] ?>
					<span class = "linkTo" style = "" onclick = "gotoDoctrack()">DocTrack Main</span>
					
					<span class = "linkTo" style = "padding-right: 0;">Monitoring</span>
					<select id = "monitoringYear"  style = "border:0;">
						<option><?php  echo   $year ; ?></option>
						<option><?php  echo   ($year-1) ; ?></option>
					</select>
					</div>
				</td>
			</tr>
			<tr>
				<td id = "mainBodyContainer" style = "vertical-align: top;background:url(../images/davaologo7.png);background-repeat: no-repeat;background-position: 50px 50px;padding-bottom: 20px;" >
					<div>
						<table border = "0" style = "width:240px;margin:0 auto;margin-top:300px;">
							<tr>
								<td style = "width:100px;">
									<div id =  "homeBody" style = "font-family:kan3;padding:0px 10px;color:red;">
										BILLING
									</div>
								</td>
								<td>
									<div style ="opacity:.7;text-align:left;border-left:1px dashed grey; padding-left:10px;">
										Water, Cable and Telecommunication Bills
									</div>
								</td>
							</tr>
						</table>
						
					</div>
					<div class = "hide">
						<?php	require(ROOTER . 'interface/mainwater.php'); ?>
					</div>
					
					<div class = "hide">
					 	
					</div>
					
					<div class = "hide">
					 	
					</div>
					<div class = "hide">
					 	<?php	require(ROOTER . 'interface/mainaccount.php'); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td style = "height:10px;text-align: center;font-family:tit1;font-size: 10px;letter-spacing: 2px;">
					City Integrated Systems @ valbalangue <span style="font-size: 8px;">2020.07</span>
				</td>
			</tr>
		</table>
		</div>
	</body>
</html>

<script>
	loadMain();
	function loadMain(){
		var cookieValue = readCookie("mainMenu");
		if(cookieValue > -1 ){
			mainTableInner.children[0].children[0].children[cookieValue].children[0].className = "selected";
			mainBodyContainer.children[cookieValue].className = "show";
			mainBodyContainer.children[0].className = "hide";
		}else{
			mainBodyContainer.children[0].className = "show";
		}
		
	}
	function  clickMenu(me){
		var col = me.parentNode.cellIndex;
		
		var cont = me.parentNode.parentNode;
		var len = cont.children.length;
		var body = document.getElementById("mainBodyContainer");
		for(var i = 0; i < len; i++){
			cont.children[i].children[0].className = "mainDivMenu";
			body.children[i].className = "hide";
		}
		me.className = "selected";
		body.children[col].className = "show";
		
		setCookie ("mainMenu", col, 2);
		
	}
	function gotoDoctrack(){
		window.open('../../citydoc' + '<?php echo $year; ?>' + '/interface/main.php');
	}
</script>

			
			