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
		background-color: rgba(7, 7, 7,.81);
		border-radius: 0px 25px 0px 25px ;
		//border-radius:50%;
		display:inline-block;	
	}
	.loaderContainer::after{
		content:"Have Patience ";
		padding-left:10px;
		color:white;
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
	/*-----------------------------------------------------------------loader*/
	body{
		padding:0;	
		margin:0;
		font-family: sans-serif;
	}
	#bodyDiv{
		text-align:center;
		margin:0 auto;
		
	}
	#tableForm{
		margin:0 auto;
		width:700px;
	}
	#container{
		width:100%;
		width:700px;
		//min-height:600px;
		//height: 800px;
		//border:1px solid black;
		margin:0 auto;
	}
	.tdHeader{
		padding:5px;
		
		border-bottom:1px solid black;
		border-right:1px solid  black;
		text-align: center;
		font-size:13px;
		vertical-align: top;
	}
	.tdData{
		padding:3px 2px;
		text-align: center;
		border-bottom:1px solid black;
		border-right:1px solid  black;
		font-size:12px;
		vertical-align: top;
	}
	.button1{
		padding:10px;
		color:white;
		background-color:grey;
		text-align: center;
		font-size:20px;
		width:200px;
		cursor: pointer;
	}
	.label1{
		font-weight:bold;
		font-size: 16px;
	}
	.tds{
		padding:10px 15px;
		padding-bottom: 5px;
		border-bottom:1px solid black;
	}
	#buttonSet{
		display:inline-block;
		border-top:2px solid white;
		border-left:2px solid white;
		border-right:2px solid silver;
		border-bottom:2px solid silver;
		padding:5px 2px;	
		border-radius: 2px;
		text-shadow: 0px 0px 2px black;
		font-size:18px;	
		background-color:#53BCEC;
		color:white;
		cursor:pointer;
		//width:210px;
	}
	
	#buttonSet:hover{
		box-shadow:0px 0px 2px 1px silver;
		font-style:italic;
	}
	#buttonSet:hover{
		box-shadow:0px 0px 2px 1px silver;
		font-style:italic;
	}
	.text1{
		padding:5px;
		font-size: 14px;
		width:150px;
		background-color:silver;
		border:1px solid silver;
		border-radius: 2px;
	}
</style>
	
	<title>2019 The Adviser</title>
	<link rel="icon" href="../images/advice.png"/> 
	
	<div id = "menuContainer">
		
		<div style ="background-color:rgb(16, 38, 54);color:white;text-align:left;padding:0px;margin-bottom:5px;">
				<table style = "color:white;border-spacing:0;" border = "0">
					<tr style = "background-color:rgb(11, 82, 137);">
						<td class = "tds"><span class = "label1">Limit</span></td>
						<td class = "tds"><span class = "label1">Fund</span></td>
						<td class = "tds"><span class = "label1">View</span></td>
						
						
						<td class = "tds"  ><span class = "label1">Set</span></td>
						<td  class = "tds"style = "width:100%;">&nbsp; </td>
						<td class = "tds"><span class = "label1">Search&nbsp;Advice </span> </td>
						<td  class = "tds"><span class = "label1">Search&nbsp;Adv</span></td>
					</tr>
					<tr style = "background-color:rgb(26, 63, 92)">
						<td style= "vertical-align: top;text-align:center;padding:10px;">
							<input class = "text1" id = "rowLimit" value = "20" maxlength="3" style = "text-align:center;width:50px;" onkeydown="return isValueNumber(this,event)" onkeypress="clearAll()">
						</td>
						<td style = "vertical-align:top;padding:10px;">
							<select class = "text1"  id = "fund" onchange = "selectFund(this)" style= "background-color:white;">
								<option>General Fund</option>
								<option>SEF</option>
								<option>Trust Fund</option>
							</select>
						</td>
						<td style= "vertical-align: top;vertical-align:middle;">
							<div id = "radioContainer" style = "width:120px;margin-left:10px;margin-top:5px;">
								<!--<input id = "ad" type ="radio" name ="viewAd" onclick="fetchAdvice(this)">Adviced<br/>-->
								<input style = "cursor: pointer;"  id = "tba" type ="radio" name ="viewAd" onclick="fetchAdvice(this)" ><label style = "cursor: pointer;" for ="tba">TBA </label><br/>
								<!--<input id = "aAll" type ="radio" name ="viewAd" onclick="fetchAdvice(this)">All-->
							</div>
						</td>
						
						<!--<td>
							<table id = "tableMonth" border = "0" style = "margin:0 auto;width:250px;background-color:rgb(240, 241, 240);padding:0px;">
								<tr>
									<td class = "tdMonth"><input type = "checkbox" id = "mJan" onclick = "filterMonth(this)"><label  for="mJan" class = "label3">Jan</label></td>
									<td class = "tdMonth"><input type = "checkbox" id = "mFeb" onclick = "filterMonth(this)"><label  for="mFeb" class = "label3">Feb</label></td>
									<td class = "tdMonth"><input type = "checkbox" id = "mMar" onclick = "filterMonth(this)"><label  for="mMar" class = "label3">Mar</label></td>	
								</tr>
								<tr>
									<td class = "tdMonth"><input type = "checkbox" id = "mApr" onclick = "filterMonth(this)"><label  for="mApr" class = "label3">Apr</label></td>
									<td class = "tdMonth"><input type = "checkbox" id = "mMay" onclick = "filterMonth(this)"><label  for="mMay" class = "label3">May</label></td>
									<td class = "tdMonth"><input type = "checkbox" id = "mJun" onclick = "filterMonth(this)"><label  for="mJun" class = "label3">Jun</label></td>	
								</tr>
								<tr>
									<td class = "tdMonth"><input type = "checkbox" id = "mJul" onclick = "filterMonth(this)"><label  for="mJul" class = "label3">Jul</label></td>
									<td class = "tdMonth"><input type = "checkbox" id = "mAug" onclick = "filterMonth(this)"><label  for="mAug" class = "label3">Aug</label></td>
									<td class = "tdMonth"><input type = "checkbox" id = "mSep" onclick = "filterMonth(this)"><label  for="mSep" class = "label3">Sep</label></td>	
								</tr>
								<tr>
									<td class = "tdMonth"><input type = "checkbox" id = "mOct" onclick = "filterMonth(this)"><label  for="mOct" class = "label3">Oct</label></td>
									<td class = "tdMonth"><input type = "checkbox" id = "mNov" onclick = "filterMonth(this)"><label  for="mNov" class = "label3">Nov</label></td>
									<td class = "tdMonth"><input type = "checkbox" id = "mDec" onclick = "filterMonth(this)"><label  for="mDec" class = "label3">Dec</label></td>	
								</tr>
							</table>
						</td>-->
						
						
						<td style= "vertical-align: top;padding:10px;vertical-align:middle;">
							<div id = "buttonSet" class = "button1" onclick = "setAdvice(this)" style= "width:280px;display: none;">Save&nbsp;Advice&nbsp;No.&nbsp;
								<span id = "preFund" style = "color:black;font-family: arial-black;font-weight:bold;text-shadow:0px 0px 0px; "></span><span id  ="adviceSequence" style = "color:black;font-family: arial-black;font-weight:bold;text-shadow:0px 0px 0px;">X</span>
							</div>
						</td>
						<td style = "width:100%;"> </td>
						<td style= "vertical-align: top;text-align:center;padding:10px;">
							<input class = "text1"  id = "adviceKey" value = "" maxlength="20" style = "text-align:center;width:150px;"  onkeypress=" keypressAndWhat(this,event,searchAdvice)" />
						</td>
						<td style= "vertical-align: top;text-align:center;padding:10px;">
							<input class = "text1"  id = "advKey" value = "" maxlength="6" style = "text-align:center;width:100px;"  onkeypress=" keypressAndWhat(this,event,searchAdviceAdv)" />
						</td>
					</tr>
					
					
				</table>
				
				
		</div>
		<!--<input type="button" onclick="printDiv('bodyDiv')" value="print a div!" />-->
	</div>

	
	<div id = "container" ><br/>
		
		
	</div>


<script>
	
	document.body.onkeydown = check;
	
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
	
	function printDiv(divName) {
	     var printContents = document.getElementById(divName).innerHTML;
	     var originalContents = document.body.innerHTML;
	     document.body.innerHTML = printContents;
	     window.print();
	     document.body.innerHTML = originalContents;
	}
	function selectFund(me){
	
		clearAll(me);
		
	}
	
	var sel = 0;
	function fetchAdvice(me){
		//document.getElementById("adviceContainer").innerHTML = "";	
		
		var fund = document.getElementById("fund").value;
		var pre = preF(fund);
		
		sel = me.id;
		if(sel == "tba"){
			document.getElementById("buttonSet").style.display = "block";
			document.getElementById("preFund").innerHTML = pre + "-";
		}else{
			document.getElementById("buttonSet").style.display = "none";	
		}
		
		var rowLimit = document.getElementById("rowLimit").value.trim();
	
		if(rowLimit.length == "" || rowLimit <1 ){
			rowLimit = 0;
		}
		
		var queryString = "?viewAdvice=1&fund=" + fund + "&sel=" + sel + "&rowLimit=" +rowLimit;
		
		var container = document.getElementById('container');
		
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"viewAdvice");
	}
	function setAdvice(me){
		var seq =  document.getElementById("adviceSequence").innerHTML.trim();
		var fund = document.getElementById("fund").value;
		var pre = preF(fund);
		var  adviceId = pre + '-' + seq;
		if(sel == "tba"){
			if(document.getElementById("adviceHidden")){
				var answer = confirm("You are about to assign this advice number : " + adviceId);
				if(answer){
					var  ids = document.getElementById("adviceHidden").value;
					var rowLimit = document.getElementById("rowLimit").value.trim();
					document.getElementById("adviceContainer").innerHTML = adviceId;
					
					var queryString = "?assignAdvice=1&ids=" + ids + "&adviceId=" + adviceId + "&seq=" + seq; 
					var container = document.getElementById('container');
					loader();
					ajaxGetAndConcatenate(queryString,processorLink,container,"setAdvice");
				}
			}else{
				alert("No record found.");
			}
			
		}else{
			alert("Already assigned.");
		}
	}
	function preF(fund){
		var pre = '';
		var d = new Date();
		
	    	var n = ("0" + d.getMonth()).slice(-2);
	    	var y = ("0" + d.getMonth()).slice(-2);
	    	var  n =  parseInt(y) + 1;
	    	
		if(fund == "General Fund"){
			pre = "100-" + year +"-" + n;
		}else if(fund == "SEF"){
			pre = "200-"+ year +"-"+ n;
		}else{
			pre = "300-"+ year+"-"+ n;
		}
		return pre;
	}
	function clearAll(){
		clearOption();	
		document.getElementById("container").innerHTML = "";
		if(document.getElementById("adviceContainer")){
			document.getElementById("adviceContainer").innerHTML = "";
		}
		if(document.getElementById("buttonSet")){
			document.getElementById("buttonSet").style.display = "none";	
		}
		
	}
	function clearOption(){
		var cont = document.getElementById("radioContainer");
		var x  = cont.getElementsByTagName("input");
		for(var i = 0 ; i < x.length ; i++){
			x[i].checked = false;
		}
	}
	function searchAdvice(){
		var adviceNo = document.getElementById("adviceKey").value;
		var fund = document.getElementById("fund").value;
		if(adviceNo != ""){
			var queryString = "?searchAdvice=1&adviceNo=" + adviceNo + "&fund=" + fund; 
			var container = document.getElementById('container');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"viewSearchAdvice");
		}
	}
	function searchAdviceAdv(){
		var advNo = document.getElementById("advKey").value;
		var fund = document.getElementById("fund").value;
		if(advNo != ""){
			
			var queryString = "?searchAdviceAdv=1&advNo=" + advNo + "&fund=" + fund ; 
			var container = document.getElementById('container');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"viewSearchAdvice");
		}
	}
	
</script>



