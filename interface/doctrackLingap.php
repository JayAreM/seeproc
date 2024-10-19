<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<?php 
	session_start();
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	require_once('../includes/loading.php');
	
?>

<style>
	/*-----------------------------------------------------------------loader*/
	.loader{
			width:140px;
			height:165px;
			top:40%;
			background:url('../images/40.gif');
			background-repeat:no-repeat;
			background-size:120px 120px;
			background-position:48% 48%;
			z-index:100;
			
	}	
	.loaderContainer{
		border:4px solid transparent;
		box-shadow: 0px 0px 30px 0px rgba(11, 60, 110,.2);
		//background-color: rgba(7, 7, 7,.81);
		//border-radius: 0px 25px 0px 25px ;
		//border-radius:50%;
		display:inline-block;	
		
	}
	.loaderContainer::after{
		content:"Hulat sa kadali.";
		padding-left:10px;
		color:white;
		color:green;
		color:grey;
		position:absolute;
		margin-top:-18px;
		margin-left:-54px;
		font-size:14px;
		letter-spacing: 1px;
		text-shadow: 0px 0px 2px black;
	}
	.absoluteHolder{
		z-index:105;
		position:absolute;
		text-align:center;
		background-color:rgba(4, 4, 4,.3);
		width:100%;
		height:100%;
	}
	.absoluteHolder1{
		z-index:105;
		position:absolute;
		text-align:center;
		//background-color:rgba(252, 254, 254,.8);
		width:100%;
		height:100%;
	}
	.editorContainer{
		border:4px solid transparent;
		border-radius:2px;
		box-shadow:0px 0px 20px 10px rgba(0, 0, 0,.4);
		background-color:white;
		display:inline-block;	
	}
	/*---------------------------------------------------------------------- empty fields  */
	.inputText{
		padding:4px 0px;
		
		letter-spacing:2px;
		font-size:22px;
		width:400px;
		font-weight: bold;
		border:1px solid rgba(136, 135, 135,.3);
		border-radius:3px;
		
		background:rgb(212, 219, 223);
		text-align:center;
	}
	.inputText1{
		padding:4px 0px;
		color:white;
		letter-spacing:2px;
		font-size:22px;
		width:400px;
		font-weight: bold;
		border:1px solid rgba(136, 135, 135,.3);
		border-radius:3px;
		text-shadow:0px 0px 2px black;
		background:rgb(124, 155, 104);
		text-align:center;
	}
	.inputText:focus,.inputText:hover {
		//background-color:rgba(218, 236, 247,.4);
		background-color: rgba(216, 243, 204,.4);
		border:1px solid rgb(133, 173, 208);
		
		
	}
	.inputTextEmpty{
		
		padding:4px 0px;
		
		letter-spacing:2px;
		font-size:22px;
		width:400px;
		font-weight: bold;
		border:1px solid rgba(136, 135, 135,.3);
		border-radius:3px;
		
		background:rgb(212, 219, 223);
		text-align:center;
		
		transition-property: background-color;
	   	transition-duration: .5s;
	   	transition-delay: 0s;
		
		border:1px solid rgba(249, 78, 98,.4);
		border-radius:3px;
		background:rgb(250, 165, 169);
	}

	
	.labelX{
		color:red;
		display:inline-block;
		position:fixed;
		position:absolute;
		margin-left:5px;
	}
	
	.qoute{
		display:inline-block;
		position:absolute;
		margin-top:-35px;
		margin-left:15px;
		text-align:center;
		padding:12px 8px;
		padding-left:6px;
		background: rgb(250, 165, 169);
		border:4px solid white;
		border-radius:5px;
		font-weight:bold;
		color:white;
	}
	
	.qoute:before {
		content: "";
		position: absolute;
		top:60%;
		margin-left: -32px;
		border-right:23px solid rgb(250, 165, 169);
		border-left:13px solid transparent;
		border-top:12px solid transparent;
		border-bottom:4px solid transparent;
		
	}
	.labelX{
		color:red;
		display:inline-block;
		position:fixed;
		position:absolute;
		margin-left:5px;
	}
	.tdHeader{
		font-family: Verdana;
		font-size:15px;
		text-shadow:0px 0px 2px black;
		color:rgb(46, 133, 3);
		color:white;
		letter-spacing: 1px;
		//font-weight:bold;
		text-align:center;
		padding:3px 10px;	
		border-bottom: 1px solid rgb(65, 132, 32);
		background-color:rgb(77, 138, 47);
	}
	.tdData{
		border-bottom:1px solid silver;
		padding:5px 10px;
		font-size:16px;
		font-weight: bold;
		font-family: Courier New;
	}
	/*-----------------------------------------------------------------loader*/
	body{
		padding:0;	
		margin:0;
		
	}
	#bodyDiv{
		text-align:center;
		margin:0 auto;
		
	}
	
	#container{
		width:100%;
		width:700px;
		margin:0 auto;
	}

	
	.hide{
		display: none;
	}
	.tableEncoder{
		margin:0 auto;
		margin-top:50px;
	}
	
	.number{
		font-size: 20px;
		font-weight:bold;
		color:silver;
		font-style: italic;
		padding-right:5px;
		display:none;
	}
	.label1{
		font-family: impact;
		letter-spacing: 1px;
		
	}
	.label2{
		font-family:impact ;
		letter-spacing:1px;
		color:rgb(82, 143, 29);
		color:grey;
		
		font-size: 22px;
	}
	.label3{
		font-family: impact;
		color:white;
		letter-spacing: 1px;
		font-size: 22px;
		background-color:rgb(11, 82, 137);	
		background-color: rgb(58, 126, 16);
		padding:5px 20px;
		border-bottom:1px solid black;
		border-right:1px solid black;
		cursor: pointer;
		display: inline-block;
		transition:all .2s ease-in;
	}
	.label3:hover{
		background-color:rgb(46, 47, 46);
	}
	.label3selected{
		font-family: impact;
		color:white;
	
		letter-spacing: 1px;
		font-size: 22px;
		background-color:rgb(22, 23, 21);	
		padding:5px 20px;
		border-bottom:1px solid rgb(34, 82, 4);
		border-right:1px solid rgb(34, 82, 4);
		cursor: pointer;
		display: inline-block;
		transition:all .2s ease-in;
	}
	.button{
		display:inline-block;
		border-top:2px solid white;
		border-left:2px solid white;
		border-right:3px solid silver;
		border-bottom:3px solid silver;
		padding:5px 10px;	
		font-size:23px;	
		background-color:rgb(161, 170, 161);
		color:white;
		cursor:pointer;
		transition:all .2s ease-in;
		width: 80px;
	}
	
	.button:hover{
		box-shadow:0px 0px 5px 2px silver;
		background-color:rgb(46, 112, 46);
	}
	.hide{
		display: none;
	}
</style>
	
	<title>The Lingap</title>
	<link rel="icon" href="/city/images/green.png"/> 
	
		<table style = "width:100%;border-spacing:0;" >
			<tr>
				<td style ="background-color:rgb(103, 168, 46); ">
					<div id = "mainMenuContainer" style ="background-color:rgb(103, 168, 46); padding:1px 2px;padding-left:40px;">
							<div class = "label3" onclick="menuMainClick(this)">Add</div>
							<div class = "label3" onclick="menuMainClick(this)">Tracking</div>	
							
					</div>
				</td>
				<td   style ="background-color:rgb(103, 168, 46); padding:1px 2px;padding-right:40px;width:100px;" >
					
					<span style = "text-overflow:nowrap;white-space: nowrap;font-family: impact;font-size: 20px;font-weight: bold;letter-spacing:2px;color:white;text-shadow:0px 0px 2px black;">
						<?php 
							echo $_SESSION['fullName'];	
						?>	
					</span>
					<span style = "font-size:12px;font-family: tahoma;"><span style = "font-weight:bold;">L</span>INGAPER</span>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div id = "mainContainer" class = "mainContainer">
							<div class = "hide">
									<div id = "inputContainer">
										<table class = "tableEncoder">
											<tr>
												<td style = "text-align: right;"><span class = "number">1</span><span class="label2">AMOUNT</span></td><td><span>
												<input id = "lingAmount" class = "inputText" onkeydown =  "keypressAndUpDown(this,event,0,'lingRAF','lingAmount','lingRAF')" /></span></td>
											</tr>
											<tr>
												<td style = "text-align: right;"><span class = "number">2</span><span class="label2">RAF#</span></td><td><span><input id  = "lingRAF" class = "inputText"   onkeydown = "keypressAndUpDown(this,event,0,'lingName','lingAmount','lingName')" /></span></td>
											</tr>
											<tr>
												<td style = "text-align: right;"><span class = "number">3</span><span class="label2">FULLNAME</span></td><td><span>
												<input  id = "lingName" class = "inputText" style = "text-transform:uppercase;" onkeydown = "keypressAndUpDown(this,event,saveLingap,'1','lingRAF','lingName')"/></span></td>
											</tr>
										</table>
									</div>
								        <div id = "container"  style= "border-top:1px solid silver;margin-top:20px;">
										<table id = "tableLingap" style = "margin:20px auto;min-width: 500px;">
											<tr>
												<td class = "tdHeader" style = "text-align:center;">ID</td>
												<td class = "tdHeader">RAF</td>
												<td class = "tdHeader" style = "text-align: left;">NAME</td>
												<td class = "tdHeader">AMOUNT</td>
											</tr>
										</table>
									</div>
							</div>	
							<div class = "hide"><?php	require('../interface/lingapTracking.php'); ?></div>
					</div>
				</td>
			</tr>
		</table>
		
		
		
<script>
	loadMain();
	
	function loadMain(){
	
		var cookieValue = readCookie("lastLingapMenu");
		
		var parent =  document.getElementById('mainMenuContainer');
		parent.children[cookieValue].className = "label3selected";
		//sa body
		var parentBody =  document.getElementById('mainContainer');
		parentBody.children[cookieValue].className = "showContainer";
	
		//pag  change sa color sa main menu
		/*var cookieMainText = cookieLabel(cookieValue,"mainMenuContainer");
		if(cookieMainText == "Module 1"){
			document.getElementById("mainMenuContainer").children[cookieValue].style.backgroundColor = "rgb(35, 116, 157)";
		}else if(cookieMainText == "Module 2"){
			document.getElementById("mainMenuContainer").children[cookieValue].style.backgroundColor = "rgb(147, 43, 67)";
		}else if(cookieMainText == "Module 3"){
			document.getElementById("mainMenuContainer").children[cookieValue].style.backgroundColor = "rgb(113, 146, 14)";
		}*/
	}
	function menuMainClick(me){
		
		menuText = me.textContent;
		if(menuText == 'Login' || menuText == 'Logout'){
			var queryString = "?logout=1";
			var container = '';
			ajaxGetAndConcatenate(queryString,processorLink,container,"Logout");
		}else{
			
			menuChanger(me,"label3selected","lastLingapMenu","mainContainer","showContainer");
			if(menuText == "Tracking"){
				loadLingap();
			}
			/*if(menuText == 'Module 1'){
				menuToDefault("mainMenuContainer");
				me.style.backgroundColor = "rgb(35, 116, 157)";
			}else if(menuText == 'Module 2'){
				menuToDefault("mainMenuContainer");
				me.style.backgroundColor = "rgb(147, 43, 67)";
					
			}else if(menuText == 'Module 3'){
				menuToDefault("mainMenuContainer");
				me.style.backgroundColor = "rgb(113, 146, 14)";
			}*/
		}
	}
	document.body.onkeydown = check;
	focusNext('lingAmount');
	var state = 1;
	function check(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		
		if(charCode == 27){
			if(state  == 1){
				document.getElementById('menuContainer').style.display ="none";
				state = 0;
			}else{
				document.getElementById('menuContainer').style.display ="block";
				state = 1;
			}
		}
	}
	function  saveLingap(){
		var error  = 0;
		var container = document.getElementById('inputContainer');		
		
		var amount = document.getElementById("lingAmount").value.trim();	
		var raf = document.getElementById("lingRAF").value.trim();
		var  name  = document.getElementById("lingName").value.trim();
		var empty = checkEmptyField(container);
		
		if(amount.length == 0 || amount <= 0 ){
			error = 1;
		}
		if(raf.length <= 6 ){
			error = 2;
		}
		if(name.length <= 6 ){
			error = 3;
		}
		if(isNumber(raf) == false){
			error = 4;
		}
		if(isNumber(amount) == false){
			error = 5;
		}
		if(error  ==  0){
			document.getElementById("lingName").value = "";
			document.getElementById("lingRAF").value = "";
			focusNext("lingAmount");
			
			var queryString = "?saveLingap=1&name=" + name + "&raf=" + raf + "&amount=" + amount ;
			var container = document.getElementById('container');
			ajaxGetAndConcatenate(queryString,processorLink,container,"lingapReturn");
		}else if(error == 1){
			alert("Invalid amount.");
			focusNext("lingAmount");
		
		}else if(error == 2){
			alert("RAF incomplete value.");
			focusNext("lingRAF");
		
		}else if(error == 3){
			alert("Fullname too short.");
			focusNext("lingName");
		
		}else if(error == 4){
			alert("Invalid RAF number.");
			focusNext("lingRAF");
		}else if(error == 5){
			alert("Invalid Amount value.");
			focusNext("lingAmount");
		}
	}
	
</script>



