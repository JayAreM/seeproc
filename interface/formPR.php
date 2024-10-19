<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	
	require_once('../javascript/ajaxFunction.php');
	$certifiedBy =  "";
	$approvedBy =  "";
	$controlledBy =  "";
	$requestedBy =  "";
	if(isset($_COOKIE['CertifiedBy'])){
		$certifiedBy = $_COOKIE['CertifiedBy'];
		$approvedBy = $_COOKIE['ApprovedBy'];
		$controlledBy = $_COOKIE['ControlledBy'];
		$requestedBy = $_COOKIE['RequestedBy'];
	}
	
	if(isset($_GET['data'])){
		$splits = explode("~",urldecode($_GET['data']));
		$defaultYear =  $splits[0];
		$officeCode =  $splits[1];
		$officeName =  $splits[2];
		$categoryCode =  $splits[3];
		$month =  $splits[4];
		$categoryName =  $splits[5];
		$trackingNumber =  $splits[6];
		$pageItems = 18;
	}
	
	if(isset($_GET['limit'])){
		$limit = $_GET['limit'];
		$pageItems = $limit;
	}else{
		$limit = 15;
	}
	if(isset($_GET['dataPeople'])){
		$dataPeople = $_GET['dataPeople'];
		
		if(strlen($dataPeople) > 0){
				$s = explode("~",$dataPeople);
				
				$r1 = $s[0];
				$r2 = $s[1];
			
				
				$c1 = $s[2];
				$c2 = $s[3];
				
				$a1 = $s[4];
				$a2 = $s[5];
				
				$d1 = $s[6];
				
				if(strlen($s[7])>96){
					$p1 = trim(substr($s[7],0,95));
					$p2 = trim(substr($s[7],95));
				}else{
					$p1 = $s[7];
					$p2 = '';
				}
				
				$o1 = $s[8];
			}else{
				$r1 = '-';
				$r2 = '-';
				
				
				
				$c1 = '-';
				$c2 = '-';
				
				$a1 = '-';
				$a2 = '-';
				
				$d1 = '-';
				
				$p1 = '-';
				$p2 = '';
				$o1 = '-';
			}
	
		
	}else{
		$dataPeople = '';
		$r1 = '-';
		$r2 = '-';
		
		
		$c1 = '-';
		$c2 = '-';
		
		$a1 = '-';
		$a2 = '-';
		
		$d1 = '-';
		
		$p1 = '-';
		$p2 = '';
		$o1 = '-';
		
	}
?>

<style>
	body{
		font-family:Sans-Serif;
		font-family:Roman;
		font-family:arial;
		padding:0;
		margin:0;
	}
	.rowData{
		font-size:13px;
		padding:0px 5px;
		vertical-align:top;
	}
	#formSet{
		display:none;
	}
	.absoluteHolder{
		z-index:105;
		position:absolute;
		text-align:center;
		background-color:rgba(4, 4, 4,.3);
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
	.editorTable{
		border-spacing:0;
		margin:25px;
		background-color:rgb(245, 248, 248);
	}
	.editorHeader{
		color:white;
		padding:2px 5px;
		padding:10px;
		letter-spacing:1px;
		background-color:rgb(8, 149, 196);
		font-size:20px;
		text-shadow:0px 0px 2px orange;
	}
	.editorLabel{
		padding-right:15px;
		padding-left:20px;	
	}
	.editorInput{
		width:140px;
		padding:7px 5px;
		margin:5px;
		margin-top:15px;
		margin-right:15px;
		
		border-top:1px solid rgb(215, 213, 213);
		border-right:1px solid rgb(215, 213, 213);
		
		border-left:1px solid rgb(234, 232, 232);
		border-bottom:1px solid rgb(234, 232, 232);
		
		border-radius:4px;
		
		font-size:14px;
		text-align:center;
		letter-spacing:1px;
	}
	.closeEditor{
		color:white;
		background-color:silver;
		border:2px solid white;
		display:inline-block;
		height:15px;
		width:15px;
		border-radius:50%;
		float:right;
	}
	.closeEditor:hover{
		cursor:pointer;
		background-color:rgb(250, 98, 116);
	}
	.closeMessage{
		border:1px solid white;
		display:block;
		background-color:grey;
		color:white;
		font-weight:bold;
		width:70px;	
		margin:10px auto;
		padding:5px;
		text-align:center;
		cursor:pointer;
		border-radius:2px;
		transition: all .5s;
	}
	.closeMessage:hover{
		box-shadow:0px 0px 10px 0px grey;
		background-color:rgb(16, 62, 91);
	}
	.tdMessage{
		padding:10px;
		padding-bottom:20px;
		text-align:justify;
		font-size:18px;
		background-color:white;
		min-width:100px;
	}
	.hiddenInput{
		color:red;
		display:inline;
		border:0;
		background-color:transparent;
		font-size:1px;
		color:transparent;
	}
	.messageContainer{
		min-width:100px;
		margin:20px auto;	
	}
	.messageBox{
		font-size:16px;
		color:black;
		border-radius:10px;
		text-align:justify;
		text-shadow:0px 0px 1px white;
		padding:0px 10px;
	}
	.label2{
		font-size:20px;
	}
	.select2{
		font-family: mainFont;
		border:0px;
		
		border:1px solid silver;
		width:50px;
		
		padding:5px 5px;
		font-size:14px;
		color:black;
		display:inline-block;
		text-align:left;
		
	}
	.button1{
		border-bottom:1px solid silver;
		border-right:1px solid silver;
		background-color:rgb(230, 237, 241);
		text-align:center;
		width:50px;
		padding:8px 20px;
		margin:0 auto;
		font-size:16px;
		cursor:pointer;
		font-weight:bold;
		transition: all .5s;
	}
	.button1:hover{
		box-shadow:0px 0px 1px 0px silver;
		text-shadow:0px 0px 1px grey;
		background-color:rgb(216, 226, 231);
	}
</style>
<head>
	<title>PR View</title>
	<link rel="icon" href="/city/images/red.png"/> 
	
</head>

<div id = "formSetContainer">
<form id = "formSet" method="GET" action="formPR.php" >
   	Items per page: <input id = "formLimit" type="text" name="limit" value ="<?php echo $limit; ?>" style = "width:50px;"><br/>
	<input id ="dataContent" type="hidden" name="data" value="<?php echo $_GET['data']; ?>">
	
 	<input id ="dataPeople" type="hidden" name="dataPeople" value="0">
	
	<input id ="fR1" type="hidden"  value="<?php echo $r1; ?>">
	<input id ="fR2" type="hidden"  value="<?php echo $r2; ?>">
	
	<input id ="fC1" type="hidden"  value="<?php echo $c1; ?>">
	<input id ="fC2" type="hidden"  value="<?php echo $c2; ?>">
	
	<input id ="fA1" type="hidden"  value="<?php echo $a1; ?>">
	<input id ="fA2" type="hidden"  value="<?php echo $a2; ?>">

	<input id ="fD1" type="hidden"  value="<?php echo $d1; ?>">
	
	<input id ="fP1" type="hidden"  value="<?php echo $p1 . ' ' . $p2; ?>">
	
	<input id ="fO1" type="hidden"  value="<?php echo $o1; ?>">
	
	
   <br><br>
  
   <input id = "formSubmit" type="submit" name="submit" value="Submit">
</form>
</div>

<?php
		$record = $database->FetchonPRrecordForPRForm($defaultYear,$trackingNumber);
		$sheet->CreateFormPR($record,$month,$categoryName,$officeName,$pageItems,$dataPeople,$trackingNumber);
?>

	<script type="text/javascript">
		window.ondblclick = function() {
			show();
		}
		function show(){
		    editorSet();
		}
		// editorSet();
		function set(){
			document.getElementById("formLimit").value = document.getElementById("itemCount").value;
			var r1 = document.getElementById("r1").value;
			var r2 = document.getElementById("r2").value;
			setCookie ("RequestedBy",r1, 100);
			setCookie ("RequestedDesignation",r2, 100);
			
			var c1 = document.getElementById("c1").value;
			var c2 = document.getElementById("c2").value;
			setCookie ("CertifiedBy",c1, 100);
			setCookie ("CertifiedDesignation",c2, 100);
			
			var a1 = document.getElementById("a1").value;
			var a2 = document.getElementById("a2").value;
			setCookie ("ApprovedBy",a1, 100);
			setCookie ("ApprovedDesignation",a2, 100);
			
			var d1 = document.getElementById("d1").value;
			
			var p1 = document.getElementById("p1").value;
			
			var o1 = document.getElementById("o1").value;
			setCookie ("ControlledBy",o1, 100);
			
			document.getElementById("dataPeople").value = r1 + '~' +  r2 + '~' + c1 + '~' +  c2 + '~' + a1 + '~' +  a2 + '~' +  d1 + '~' +  p1 + '~' +  o1;
			document.getElementById("formSubmit").click();
			
		}
		function editorSet(){
			var divPR  = document.getElementsByClassName("containerPRform");
			var x = divPR.length;
			
			var r1 = document.getElementById("fR1").value;
			var r2 = document.getElementById("fR2").value;
			
			var requestedBy = readCookie("RequestedBy");
			var requestedDesignation = readCookie("RequestedDesignation");
			if(requestedBy !=  -1){
				r1 =  (requestedBy);
				r1 = "<?php echo $requestedBy; ?>";
			}
			if(requestedDesignation !=  -1){
				r2 =  (requestedDesignation);
			}
			
			
			var c1 = document.getElementById("fC1").value;
			var c2 = document.getElementById("fC2").value;
			
			var certifiedBy = readCookie("CertifiedBy");
			var certifiedDesignation = readCookie("CertifiedDesignation");
			if(certifiedBy !=  -1){
				c1 = "<?php echo $certifiedBy; ?>";
			}
			if(certifiedDesignation !=  -1){
				c2 =  (certifiedDesignation);
			}
			
			var a1 = document.getElementById("fA1").value;
			var a2 = document.getElementById("fA2").value;
			
			var approvedBy = readCookie("ApprovedBy");
			var  approvedDesignation = readCookie("ApprovedDesignation");
			if(approvedBy !=  -1){
				a1 =  (approvedBy);
				a1 = "<?php echo $approvedBy; ?>";
			}
			if(approvedDesignation !=  -1){
				a2 =  (approvedDesignation);
			}
			
			
			
			var d1 = document.getElementById("fD1").value;
			
			var p1 = document.getElementById("fP1").value;
			
			var o1 = document.getElementById("fO1").value;
			
			var  controlledBy = readCookie("ControlledBy");
			if(controlledBy !=  -1){
				o1 =  (controlledBy);
				o1 = "<?php echo $controlledBy; ?>";
			}
			
			var limit = document.getElementById("formLimit").value;
			
			var sheet = "<div class = 'editorContainer'><table border ='0' style = 'padding-bottom:20px;' >";
				sheet += "<tr><td class = 'editorHeader' colspan = '2' >PR Form settings<div onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>";
			   
			        sheet += "<tr><td class = 'editorLabel' style = 'padding-top:20px;' >Items per page</td><td style = 'padding-right:20px;padding-top:20px;'>";
				sheet += "<input class='select2' style = 'text-align:center;width:60px;'  id = 'itemCount'   value = '<?php echo $limit; ?>' onkeydown='return isAmount(this,event)'' /></td></tr>";
				
				sheet += "<tr><td class = 'editorLabel' >Number of days:</td><td style = 'padding-right:20px;'>";
				sheet += "<input class='select2' maxlength = '4' style = 'text-align:center;width:60px;'  id = 'd1' value = '"  + d1 + "'    /></td></tr>";
				
				sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";//--
				
				sheet += "<tr><td class = 'editorLabel' >Requested By:</td><td style = ''>";
				sheet += "<input class='select2' style = 'width:200px;'  id = 'r1' value = '"  + r1 + "'  /></td></tr>";
				
				sheet += "<tr><td class = 'editorLabel' >Designation</td>";
				sheet += "<td style = ''><input class='select2' style = 'width:200px;'  id = 'r2'  value = '"  + r2 + "'/></td></tr>";
				
				sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";//--
				
				sheet += "<tr><td class = 'editorLabel' >Certified By:</td><td style = ''>";
				sheet += "<input class='select2' style = 'width:200px;'  id = 'c1' value = '"  + c1 + "'  /></td></tr>";
				
				sheet += "<tr><td class = 'editorLabel' >Designation</td>";
				sheet += "<td style = ''><input class='select2' style = 'width:200px;'  id = 'c2' value = '"  + c2 + "'  /></td></tr>";
				
				sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";//--
				
				sheet += "<tr><td class = 'editorLabel' >Approved By:</td><td style = ''>";
				sheet += "<input class='select2' style = 'width:200px;'  id = 'a1'  value = '" + a1+ "' /></td></tr>";
				
				sheet += "<tr><td class = 'editorLabel' >Designation</td>";
				sheet += "<td style = ''><input class='select2' style = 'width:200px;'  id = 'a2' value = '" + a2 + "'  /></td></tr>";
				
				sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";//--
				sheet += "<tr><td class = 'editorLabel' >Controlled by:</td><td style = ''>";
				sheet += "<input class='select2' style = 'width:200px;'  id = 'o1'  value = '" + o1 + "' /></td></tr>";
				
				sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";//--
				
				
				sheet += "<tr><td class = 'editorLabel' >Purpose:</td><td style = 'padding-right:20px;'>";
				sheet += "<textarea class='select2' style = 'width:200px;resize:vertical;'  id = 'p1' >" + p1 + "</textarea></td></tr>";
				
				sheet += "<tr><td colspan = '2' style = 'text-align:center;padding:20px 0px;'><div  id = '1' class ='button1' onclick= 'set()'>Set</div></td></tr>";
				
				sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";//--
				
				var msg = "Mao ning part na pwede nimo i manual og print ang";
				    msg += " kada isa ka page depende sa kung unsa lang imong gi view sa browser.";
				
				
				sheet += "<tr><td colspan = '2' style = 'padding:10px;text-align:center;width:200px;text-align:left;color:grey;'>" + msg + "</td></tr>";
				
				sheet += "<tr><td class = 'editorLabel' colspan = '2' style = 'text-align:center;'>View";
				sheet += "<select class = 'select2'  style = 'width:90px;margin-left:10px;margin-top:10px;' onchange = 'displayOnly(this)'>";
				sheet += "<option value = 'all'>All Pages</option>";
				for(var i = 0; i < x; i++){
					sheet += "<option value = '" + i + "'>Page " + parseInt(i+1) + "</option>";
				}
				
				
				
				sheet += "</select></td></tr>";
				
				sheet += "</table></div>";
			theAbsolute(sheet);
		}
		function displayOnly(me){
			var own =  me.value;
			var parent  = document.getElementsByClassName("containerPRform");
			var x = parent.length;
			for(var i = 0 ; i < x; i++ ){
				if(own == i || own == "all"){
					parent[i].style.display = "block";
				}else{
					parent[i].style.display = "none";
				}
				
			}
		}
		function check(me,evt){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if(charCode == 13){
				
					var s =  document.getElementById("overflowContainer").scrollTop;
					if(s>0){
						var lineArr = me.value.substr(0, me.selectionStart).split("\n");
					    var numChars = 0;
					    for (var i = 0; i < lineArr.length-1; i++) {
					        numChars += lineArr[i].length+1;
					    }
						document.getElementById("overflowContainer").scrollTop = 0;
						setSelectionRange(me, 0, 0);
						document.getElementById("overflowContainer").scrollTop = 0;
						
					}
				
			}
		}
		function setSelectionRange(input, selectionStart, selectionEnd) {
			if (input.setSelectionRange) {
				input.focus();
				input.setSelectionRange(selectionStart, selectionEnd);
			}else if (input.createTextRange) {
				var range = input.createTextRange();
				range.collapse(true);
				range.moveEnd('character', selectionEnd);
				range.moveStart('character', selectionStart);
				range.select();
			}
		}
		function setCaretToPos (input, pos) {
				setSelectionRange(input, pos, pos);
		}
		
		/*function setCookie ( name, value, days){
			var cookie_string = name + "=" + escape ( value );	
		    if(days){
				var date = new Date();
				date.setTime(date.getTime()+(days*24*60*60*1000));
				cookie_string += "; expires="+date.toGMTString();
			}
			document.cookie = cookie_string;
		}
		
		function readCookie(cookieName) {
		}*/
		
	</script>

