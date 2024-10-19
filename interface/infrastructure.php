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
	.label4{
		background-color: rgb(31, 44, 26);
	}
	.label4:hover{
		background-color: rgb(2, 5, 0);
		color:orange;
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
	
	.select{
		padding:10px 10px;
		height: 100%;
	}
	.tdDataInfra{
		vertical-align: top;
		padding:2px 5px;
		
		border-bottom:1px solid silver;
		height:35px;
		border-bottom: 1px solid black;
		border-right: 1px solid black;
		font-size: 12px;
		
	}
	.tdHeaderField{
		border-top:1px solid black;
		border-right:1px solid black;
		border-bottom:1px solid black;
		padding:2px 8px;
		font-weight: bold;
		font-size: 15px;
		
	}
	.inputText2{
		background-color: white;
		padding:5px;
		width:50px;
		height: 40px;
		font-size: 22px;
		text-align: center;
		font-weight: bold;
	}
</style>
	
	<title>Infra</title>
	<link rel="icon" href="/citydoc2017/images/green.png"/> 
	
	<table  id  = "infraContainer" style = "width:100%;">
			<tr>
				<td>
					<div id = "mainMenuContainer" style ="background-color:rgb(103, 168, 46); padding:1px 2px;padding-left:40px;">
							<table>
								<tr>
									<td>
										<div class = "label3" >Page Limit</div>
									</td>
									<td>
										<div>
											<input value = "12" class = "inputText2" id ="limit"/>
										</div>
									</td>
									<td>
										<div class = "label3" >Fund</div>
									</td>
									<td>
										<div>
											<select id  = "ppmpType" class = "select">
												<option>General Fund</option>
												<option>SEF</option>
												<option>Trust Fund</option>
											</select>	
										</div>
									</td>
									<td>
										<div class = "label3" >Entry</div>
									</td>
									<td>
										<div>
											<select id  = "entry" class = "select">
												<option>Regular</option>
												<option>SB1</option>
												<option>SB2</option>
												<option>SB3</option>
												<option>SB4</option>
											</select>	
										</div>
									</td>
									<td>
										<div class = "label3" onclick="">Office</div>
									</td>
									<td>
										<div>
											<?php
												$sql ="Select * from office where Infra > 0 order by name asc";
												$result = $database->query($sql);
												$sheet = '<select id  = "officeInfra" class = "select" >';
												$sheet .= 	 '<option ></option>';
												while($data = $database->fetch_array($result)){
													$sheet .= 	 '<option value = "' . $data['Code'] . '">' . strtoupper($data['Name']) .  '</option>';
												}
												$sheet .= '</select>';
												echo $sheet;
											?>
										
										</div>
									</td>
									
									
									
									<td>
										<div class = "label3 label4"  onclick="searchInfra()">Search</div>
									</td>
									<td style = "text-align: center;padding-left:20px;color:white;">
										To print press ESC to show/hide menu. 
									</td>
								</tr>
							</table>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					
				</td>
			</tr>
		</table>
		<div id = "mainContainer" class = "mainContainer"></div>
		
		
<script>
	//loadMain();
	document.body.onkeydown = check;
	var state = 1;
	function check(evt){
		
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 27){
			if(state  == 1){
				document.getElementById('infraContainer').style.display ="none";
				state = 0;
			}else{
				document.getElementById('infraContainer').style.display ="table";
				state = 1;
			}
		}
	}
	function loadMain(){
		var cookieValue = readCookie("lastLingapMenu");
		var parent =  document.getElementById('mainMenuContainer');
		parent.children[cookieValue].className = "label3selected";
		//sa body
		var parentBody =  document.getElementById('mainContainer');
		parentBody.children[cookieValue].className = "showContainer";
	}
	function loadInfra(me){
		var office = me.value;	
		var type = document.getElementById("ppmpType").value;
		var limit  = document.getElementById("limit").value;
		loader();
		var queryString = "?createPPMPpage=1&office=" + office + "&ppmpType=" + type + "&limit="+ limit;
		var container = document.getElementById("mainContainer");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	// searchInfra();
	function searchInfra(){
		var office =document.getElementById("officeInfra").value;	
		var type = document.getElementById("ppmpType").value;
		var entry = document.getElementById("entry").value;
		
		var limit  = document.getElementById("limit").value;
		loader();
		var queryString = "?createPPMPpage=1&office=" + office + "&ppmpType=" + type + "&limit="+ limit + "&entry=" + entry;
		
		var container = document.getElementById("mainContainer");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	
	
</script>



