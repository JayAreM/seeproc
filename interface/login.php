<?php
	require_once("../javascript/ajaxFunction.php");
	require_once('../includes/database.php');
	
	$mt =  time();
	
	
?>
	
	<style>
		body{
			overflow:hidden;
			background:url(../images/gBg.jpg);
		}
		#divHeader{
			//border-top:1px solid #868889;
			//background-color:silver;
			text-align:center;
		}
		#divMenu{
			letter-spacing:2px;
			color:white;
			width:100px;
			margin:0px 10px;
			margin-top:20px;
			text-align:center;
			cursor:pointer;
			display:inline-block;
		}
		#divMenu:hover{
			font-weight:bold;
		}	
		#divMainBody{
			position:relative;
			height:450px;
			width:102%;
			margin-left:-1%;
			margin-top:15%;
		}
		#divBodyA, #divBodyB{
			font-size:78px;
			font-weight:bold;
			text-align:center;
			height:100%;
			width:100%;
			position:absolute;
		}
		#divBodyA{
			//background-color:#126783;
		}
		#divBodyB{
			//background-color:#831252;
			display:none;
		}
		.divBodyAnimateA{
			left:-100%;
			width:0px;
			-moz-animation:slideinA 2s 1; 
			-moz-animation-timing-function: ease;
			
			-webkit-animation:slideinA 2s 1; 
			-webkit-animation-timing-function: ease;
			
			
		}
		.divBodyAnimateB{
			left:0%;
			-moz-animation:slideinB 2s 1; 
			-moz-animation-timing-function: ease;
			
			-webkit-animation:slideinB 2s 1; 
			-webkit-animation-timing-function: ease;
			
		}
		.divBodyAnimateC{
			left:0%;
			-moz-animation:slideinC 2s 1; 
			-moz-animation-timing-function: ease;
			
			-webkit-animation:slideinC 2s 1; 
			-webkit-animation-timing-function: ease;
			
		}
		.divBodyAnimateD{
			left:-100%;
			width:0px;
			-moz-animation:slideinD 2s 1; 
			-moz-animation-timing-function: ease;
			
			-webkit-animation:slideinD 2s 1; 
			-webkit-animation-timing-function: ease;
			
		}
		@-moz-keyframes slideinA{
			from{left:0%;}
			to{left:-100%;}
		}
		@-moz-keyframes slideinB{
			from{left:100%;}
			to{left:0%;}
		}
		@-moz-keyframes slideinC{
			from{left:-100%;}
			to{left:0%;}
		}
		@-moz-keyframes slideinD{
			from{left:0%;}
			to{left:100%;}
		}
		
		@-webkit-keyframes slideinA{
			from{left:0%;}
			to{left:-100%;}
		}
		@-webkit-keyframes slideinB{
			from{left:100%;}
			to{left:0%;}
		}
		@-webkit-keyframes slideinC{
			from{left:-100%;}
			to{left:0%;}
		}
		@-webkit-keyframes slideinD{
			from{left:0%;}
			to{left:100%;}
		}
		
		@keyframes slideinA{
			from{left:0%;}
			to{left:-100%;}
		}
		@keyframes slideinB{
			from{left:100%;}
			to{left:0%;}
		}
		@keyframes slideinC{
			from{left:-100%;}
			to{left:0%;}
		}
		@keyframes slideinD{
			from{left:0%;}
			to{left:100%;}
		}
		
		
		/*-----------------------------------------*/
		#divLoginContainer{
			width:400px;
			color:white;
			box-shadow:-2px 0px 25px 3px #242525;
			margin:0 auto;
			padding-top:20px;
		}
		#tableLoginForm{
			margin:15px auto;
			margin-top:20
		}
		#tableLoginForm td{
			//border:1px solid silver;
		}
		#tdFormHeader{
			padding-left:10px;
			color:white;
			font-size:22px;
			font-weight:bold;
			font-family:Oxygen-Regular;
		}
		#divLoginHeader{
			color:#1291B4;
			border:0px solid white;
			border-top:1px solid transparent;
			border-bottom:1px solid #1D7B95;
			border-radius:0px 0px 0px 0px;
			width:270px;
			height:22px;
			padding-left:25px;
			padding-right:5px;
			padding-bottom:25px;
		}
		#spanConnect{
			background-color:#1291B4;
			color:#F2F8FA;
			padding:0px 15px;
			padding-bottom:3px;
			border-radius:5px;
		}
		.labelLoginRegistration{
			padding:2px;
			padding-top:5px;
			padding-left:45px;
			//color:#1291B4;
			color:white;
			//text-shadow:0px 0px 1px #1291B4;
			text-shadow:0px 0px 1px black;
			letter-spacing:1px;
		}
		.inputLogin{
			width:250px;
			padding:6px;
			margin-left:47px;	
			margin-bottom:10px;	
			border-radius:4px;
			border:1px solid #1291B4;
			font-weight:bold;
			background-color:#DDF4FA;
			letter-spacing:1px;
			color:#063C49;
		}
		#buttonLoginRegistration{
			margin:15px auto;
			background-color:#1291B4;
			border:0px solid silver;
			border-right:1px solid silver;
			border-top:1px solid white;
			border-left:1px solid white;
			border-bottom:1px solid silver;
			width:80px;
			padding:5px;
			text-align:center;
			color:white;
			border-radius:4px;
			letter-spacing:1px;
			cursor:pointer;
			text-shadow:1px 0px 1px grey;
			box-shadow:0px 0px 4px 1px #1291B4;
		}
		#buttonLoginRegistration:hover{
			box-shadow:0px 0px 4px 3px #1291B4;
		}
		#divLoginRemarks{
			width:260px;
			height:50px;
			border-top:1px solid #CCD0D1;
			margin:0 auto;
			margin-top:10px;
			font-size:14px;
			padding:5px;
			padding-top:18px;
		}
		#spanViewerOnly{
			//background-color:#E2E7E8;	
			
			color:orange;
			padding:2px 6px;
			border-radius:2px;
			cursor:pointer;
		}
		#spanViewerOnly:hover{
			font-style:italic;
		}
		
		/* -----------------------*/
		#tableLoginForm2{
			margin:0 auto;
			margin-top:20px;
		
			border:0px solid #4AAECA;
			
			
		}
		#divAccountRegistration{
			border:0px solid white;
			border-top:1px solid transparent;
			border-bottom:1px solid silver;
			width:270px;
			height:22px;
			padding-left:25px;
			padding-right:5px;
			padding-bottom:25px;
		}
		#spanAccount{
			background-color:white;
			color:#1291B4;
			padding:0px 15px;
			padding-bottom:3px;
			border-radius:5px;
		}
		.inputFormregistration{
			width:250px;
			padding:5px;
			margin-left:47px;	
			margin-bottom:10px;	
			border-radius:4px;
			border-top:1px solid #09657F;
			border-left:1px solid #09657F;
			font-weight:bold;
			background-color:#DDF4FA;
			letter-spacing:1px;
		}
		.labelFormRegistration{
			padding:2px;
			padding-top:5px;
			padding-left:45px;
			color:white;
			text-shadow:1px 0px 1px black;
			letter-spacing:1px;
		}
		.buttonFormRegistration{
			margin:15px auto;
			background-color:#1291B4;
			border:0px solid silver;
			border-right:1px solid silver;
			border-top:1px solid white;
			border-left:1px solid white;
			border-bottom:1px solid silver;
			width:80px;
			padding:5px;
			text-align:center;
			color:white;
			border-radius:4px;
			letter-spacing:1px;
			cursor:pointer;
			text-shadow:1px 0px 1px grey;
		}
		.buttonFormRegistration:hover{
			box-shadow:0px 0px 4px 0px white;
			
		}
		#divFormRemarks{
			width:300px;
			//height:80px;
			
			border-top:1px solid #35A3C2;
			margin:0 auto;
			//margin-top:20px;
			margin-bottom:10px;
			font-size:14px;
			padding:5px;
			padding-top:10px;
			color:white;
			
		}
	</style>
<!--/*------------------------------------------------------------------------*/-->


	<head>
		<title>2020 DocTrack v5</title>
		<link rel="icon" href="/citydoc2019/images/red.png"/> 
		<link rel="stylesheet" href="../css/style.css" />
	</head>

	
	<!--<div id = "cont" style = "position: absolute;color:white;"></div>-->
		
	<div id = "divMainBody" >
		<div id = "divBodyA" class ="divBodyA" style="display1:none;">
				<div id = "divLoginContainer" >
					<table id = "tableLoginForm">
						<tr>
							<td colspan ="2"id = "tdFormHeader"><div id = "divLoginHeader"><span id = "spanConnect">Login</span>  to Doctrack</div> </td>
						</tr>
						<tr>
							<td colspan="2"><input type ='hidden' id = "mt" /><br/></td>
						</tr>
						<tr>
							<td colspan="2" class = "labelLoginRegistration">Enter Employee Number</td>
						</tr>
						<tr>
							<td colspan="2" ><input id = "inputLoginEmployeeNumber" class = "inputLogin"type = "text" value = '' onkeypress="return isEmployeeNumber(this,event)" maxlength="6" /></td>
						</tr>
						<tr>
							<td colspan="2" class = "labelLoginRegistration">Enter password</td>
						</tr>
						<tr>
							<td colspan="2"><input id = "inputLoginPassword" class = "inputLogin" type = "password" value = "" onkeypress="passwordLoginKeypress(this,event)" maxlength="20"/></td>
						</tr>
						<tr>
							<td colspan="2"><div id = "buttonLoginRegistration" onclick="submitLogin()"> Login </div></td>
						</tr>
						<tr>
							<td colspan="2" style = "text-align:center" >
								<div id = "divLoginRemarks">
									<font color ="#D5DEE1"> &#9679; For voucher tracking only. <span id = "spanViewerOnly" onclick="clickSpanViewerOnly()">Click here</span></font>
								</div>
							</td>
						</tr>
					</table>
					
				</div>
				<div id  ="xx" style = "font-size: 16px;text-align: left;padding-left:100px;position: absolute;top:0;"></div>
		</div>
		
		
		
		
		
		<div id = "divBodyB" class ="divBodyB">
			<div id = "divloginContainer">
				<table id = "tableLoginForm2">
						<tr>
							<td colspan ="2"id = "tdFormHeader"><div id = "divAccountRegistration"><span id = "spanAccount">Account</span>&nbsp;&#9679;&nbsp;Registration</div> </td>
						</tr>
						<tr>
							<td colspan="2"><br/></td>
						</tr>
						<tr>
							<td colspan="2" class = "labelFormRegistration">Employee Number</td>
						</tr>
						<tr>
							<td colspan="2" ><input value = "" id = "inputRegistrationEmployeeNumber" class = "inputFormRegistration" type = "text" onkeypress="return isEmployeeNumber(this,event)" value = "" maxlength="6"  /></td>
						</tr>
						<tr>
							<td colspan="2" class = "labelFormRegistration">Surname</td>
						</tr>
						<tr>
							<td colspan="2" ><input value = "" id = "inputRegistrationSurname" class = "inputFormRegistration" type = "text" onkeypress="surnameKeypress(this,event)" value = "" maxlength="20"  /></td>
						</tr>
						<tr>
							<td colspan="2" class = "labelFormRegistration">Create a password</td>
						</tr>
						<tr>
							<td colspan="2"><input  value = "" id = "inputRegistrationPassword" class = "inputFormRegistration" type = "password" onkeypress="passwordKeypress(this,event)" value ="" maxlength="20" /></td>
						</tr>
						<tr>
							<td colspan="2"><div id = "buttonFormRegistration" class = "buttonFormRegistration" onclick="submitRegistration()"> Register </div></td>
						</tr>
						<tr>
							<td colspan="2" >
							<div id = "divFormRemarks">
								<font color ="white"> &#9679;</font> Complete the required information above.
							</div></td>
						</tr>
						
				</table>
			</div>
		</div>
	
	</div>
		
	<div id = "divHeader">	
		<div id  ="divMenu" onclick="clickState()">- Register - </div>
	</div>
	
<!--/*------------------------------------------------------------------------*/-->

<script>
	var pageSlide = 1;
	var state = 1;
	
	function clickState(){
		
		if(state == 1){
			viewMenu1();
			document.getElementById('divMenu').innerHTML = " - Login - ";	
			state = 2;
		}else{
			viewMenu2();
			document.getElementById('divMenu').innerHTML = " - Register - ";
			state = 1;
		}
	}
	
	function viewMenu1(){
		document.getElementById('divBodyA').className = "divBodyAnimateA";
		document.getElementById('divBodyB').className = "divBodyAnimateB";
		document.getElementById('divBodyB').style.display ="block";
	}
	function viewMenu2(){
		document.getElementById('divBodyA').className = "divBodyAnimateC";
		document.getElementById('divBodyB').className = "divBodyAnimateD";
		document.getElementById('divBodyB').style.display ="block";
	}
	function spread(){
		if(pageSlide == 1){
			document.getElementById('divBodyA').className = "divBodyAnimateA";
			
		}else if(pageSlide == 2){
			document.getElementById('divBodyA').className = "divBodyAnimateB";
		}	
	}
	/*--------------------------------------*/
	
	function isEmployeeNumber(me,evt){
		 
		  var number = me.value; 	 
          var charCode = (evt.which) ? evt.which : event.keyCode;
		  if(charCode == 44){
				return false;
		  }
		  if(charCode == 46){
				return false;
		  }
		  if(charCode == 13){
		  	//if(number.length == 6 ){
				if(me.id == 'inputLoginEmployeeNumber'){
					document.getElementById('inputLoginPassword').focus();
				}else{
					document.getElementById('inputRegistrationSurname').focus();
				}
			//}
		  }    
          if (charCode != 46 && charCode > 31  && (charCode < 48 || charCode > 57)){
		  	 return false;
		  }else{
		  	 return true;
		  }     
       }
	function isLetter(stringValue){
		var onlyLetters = /^[a-zA-Z\u00C0-\u00ff]+$/.test(stringValue);
		return onlyLetters;  
	}
	function surnameKeypress(me,evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 13){
			/*if(!isLetter(me.value)){
			
				alert("Your Surname contain/s invalid character, please review.");
			}else{*/
				document.getElementById('inputRegistrationPassword').focus();
			//}
		}
	}
	function passwordKeypress(me,evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 13){
			if(me.value.length == 0){
				alert("No password entered. Please complete the required information.");
			}else{
				document.getElementById('buttonFormRegistration').click();
			}
		}
	}
	
	function passAllowed(text){
		var validCount = 0;
		if(text.match(/[0-9]/g)){
			validCount++;
		}
		if(text.match(/[a-zA-Z]/g)){
			validCount++;
		}
		if(validCount > 1){
			return text;
		}else{
			return false;
		}
	}
	function submitRegistration(){
		setCookie("valbalangue",1, 1);
		var employeeNumber  = document.getElementById('inputRegistrationEmployeeNumber').value;
		var surname  = document.getElementById('inputRegistrationSurname').value;
		var password  = document.getElementById('inputRegistrationPassword').value;
		
		//alert(passAllowed(password));
		var x = ForeColor(password);
		
		//alert(password.match(/[!@#$%^&*(),.?":{}|<>0-9a-zA-Z]/g));
		
		
		if(employeeNumber.length < 6 ){
			alert("Employee number should be six digit long. Please try again.");
		}else if(surname.length == 0){
			alert("No Surname entered. Please complete the required information.");
		}/*else if(!isLetter(surname)){
			alert("Your Surname contain/s invalid character, please review.");
		}*/else if(password.length < 7) {
			alert("Password should be more than 7 characters long.");
		}else{
			//alert(password.match(/[a-z]/i)); number only
			//alert(password.match(/\d+/) + " = " + password.match(/[a-zA-Z]/)); text only
			
			//alert(password.match(/^([0-9]+[a-zA-Z]+|[a-zA-Z]+[0-9]+)[0-9a-zA-Z]*$/));
			
			if(passAllowed(password)){
				var joiners =  employeeNumber + '@#$' + surname  + '@#$' + password;
				joiners = encodeURIComponent(vScram(joiners));
				
				//var queryString = "?register=1&employeeNumber=" + employeeNumber + "&surname=" + surname +  "&password=" + x;
				var queryString = "?fuJxy1za=1&xaYvsfTs=" +  joiners;
				var container = '';
				ajaxGetAndConcatenate(queryString,processorLink,container,"fuJxy1za");
			}else{
				alert("Please combine letters and numbers.");
			}
			 
			/*if (password.match(/^([0-9]+[^a-zA-Z]+|[^a-zA-Z]+[0-9]+)[^0-9a-zA-Z]*$/) == null) {
			   alert("Please combine letters and numbers.");
			}else{
				var queryString = "?register=1&employeeNumber=" + employeeNumber + "&surname=" + surname +  "&password=" + x;
				var container = '';
				ajaxGetAndConcatenate(queryString,processorLink,container,"Register");
			}*/
			
			//if (password.match(/[a-z]/i)) {
			    // alphabet letters found
			//}
			
			/*var queryString = "?register=1&employeeNumber=" + employeeNumber + "&surname=" + surname +  "&password=" + password;
			var container = '';
			ajaxGetAndConcatenate(queryString,processorLink,container,"Register");*/
		}
	}
	


	
	
	
	function ForeColor(sftx){
		var lxt =  "x772hjfssw";
		var xPadding = "<?php echo $padding; ?>";
		var rsy  = "";
		var rsm = "";
		/*196kbywwwk
		lx4gr6fgum
		83kk4ps8w4*/
		var yts = sftx.length;
		var airam = xPadding.length;
		for(var lav = 0 ; lav < airam+1; lav++){	
			gsx = Math.random().toString(36).substring(2);
			gsx = gsx.substring(0,10);
			rsy += gsx;
			
		}
		var rsq ="";
		var xft = yts-1;
		var ftx = 1;
		var xst = "";
		for(var xtr = 0; xtr < rsy.length-yts; xtr++){
			ftx++;
			xst += rsy[xtr];
			if(xtr == airam){
				rsq =  rsy[xtr];
			}
			if(ftx == airam ){
				if(sftx[xft]){
					xst += sftx[xft];
					
				}
				xft--;
				
				ftx = 1;
			}
		}
		
		return xst + yts + rsq;
	
	}
	function clearRegistration(){
		document.getElementById('inputRegistrationEmployeeNumber').value = '';
		document.getElementById('inputRegistrationSurname').value = '';
		document.getElementById('inputRegistrationPassword').value = '';
	}
	function passwordLoginKeypress(me,evt){
		
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if(charCode == 13){
			if(me.value.length == 0){
				alert("No password entered. Please complete the required information.");
			}else{
				document.getElementById('buttonLoginRegistration').click();
			}
		}
	}
	
	/*function gt(){
		var queryString = "?fdskdjgt=1";
		
		var container = document.getElementById('mt');
		ajaxGetAndConcatenate(queryString,processorLink,container,"fdskdjgt");
	}*/
	
	//vScram1("ñ12DSJw2");
	/*function vScram1(text){
		var x = Math.random();
		var crambles = x.toString(36).substr(2,8);
		var crambles = "99999999999";
		var y = '',j =0;
		for(var i  = 0; i < text.length ; i++){
			if(!crambles[j]){
				j = 0;
			}
			y += text[i] + crambles[j++];
		}
		return y;//alert(y);
	}
	vScram2('1ñ');
	
	
	function b6(text){
		return btoa(unescape(encodeURIComponent(text)));
	}*/
	
	/*function stringToBinaryToDecimal(text){
		s = unescape( encodeURIComponent( text ) );
	    var chr, i = 0, l = s.length, out = '';
	    for( ; i < l; i ++ ){
	        chr = s.charCodeAt( i ).toString( 2 );
	        while( chr.length % 8 != 0 ){ chr = '0' + chr; }
	        out += chr;
	    }
	    
	    var dec = parseInt(out, 2);
	    return dec
	}
	function vScram2(str){
		s = unescape( encodeURIComponent( str ) );
	    var chr, i = 0, l = s.length, out = '';
	    for( ; i < l; i ++ ){
	        chr = s.charCodeAt( i ).toString( 2 );
	        while( chr.length % 8 != 0 ){ chr = '0' + chr; }
	        out += chr;
	    }
	    
	    document.getElementById("cont").innerHTML += "<br/><br/><br/>binary : " + out;
	    //alert(parseInt(out, 2));
	    var dec = parseInt(out, 2);
	    document.getElementById("cont").innerHTML += "<br/>decimal : " + dec;
	    
	    
	    var hexy = dec.toString(16);
	    document.getElementById("cont").innerHTML += "<br/>decimal to hex : " + hexy;
	     
	    var bin = (+dec).toString(2);
	    document.getElementById("cont").innerHTML += "<br/>binary : " + bin;
	    s = out;
	    var i = 0, l = s.length, chr, out = '';
	    for( ; i < l; i += 8 ){
	        chr = parseInt( s.substr( i, 8 ), 2 ).toString( 16 );
	        out += '%' + ( ( chr.length % 2 == 0 ) ? chr : '0' + chr );
	    }
	    document.getElementById("cont").innerHTML += "<br/>original text : " + decodeURIComponent(out);
	   // alert(decodeURIComponent( out ));
	    
	}	

	var utf8ToBin = function(){
	    s = unescape( encodeURIComponent( s ) );
	    var chr, i = 0, l = s.length, out = '';
	    for( ; i < l; i ++ ){
	        chr = s.charCodeAt( i ).toString( 2 );
	        while( chr.length % 8 != 0 ){ chr = '0' + chr; }
	        out += chr;
	    }
	    return out;
	};*/
	//alert(vScram1("0kFine2019!"));
	function submitLogin(){
		setCookie("valbalangue",1, 1);
		var mt = "<?php echo $mt; ?>";
		
		var employeeNumber  = document.getElementById('inputLoginEmployeeNumber').value + mt;
		var password  =  document.getElementById('inputLoginPassword').value;
		if(employeeNumber.length < 6 ){
			alert("Invalid employee number. Please try again.");
		}else if(password.length < 1) {
			alert("No record found.");
		}else{
			var joiners = employeeNumber + '~!~' + password;	
			joiners =  vScram(joiners);
			//joiners = b6(password);
			//alert(joiners);
			var queryString = "?fujxyza=1&xaXvsfTs=" + encodeURIComponent(joiners);
			
			var container = '';
			ajaxGetAndConcatenate(queryString,processorLink,container,"fujxyza");
		}
	}
	
	function clickSpanViewerOnly(){
		window.open('doctrackPublicSearch.php', '_self');
	}
</script>



