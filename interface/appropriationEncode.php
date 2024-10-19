<style>
	.tableContentApp{
		background-color:white;
		width:1200px;
		height:100%;
		margin:0px auto; 
		
		padding:10px;
		//padding:0px 30px;
		/padding-bottom:15px;
		//border:1px solid red;
		
		//margin:0 auto;
	    -webkit-touch-callout:select;
	    -webkit-user-select:text;
	    -khtml-user-select: text;
	    -moz-user-select: text;
	    -ms-user-select: text;
	    user-select: text;
	}
	.tdContent{
		background-color:rgba(6, 44, 66,.02);
		background-color:white;
		box-shadow:0px 0px 10px 1px grey;
	}
	
	.returnContainer{
		width:100%;
	}
	.fundInputContainer{
		background-color:rgba(236, 238, 238,.5);	
		padding:15px 10px;
		
	}
	#appropriationMainContainer{
		background-color:white;
		border:1px solid green;
		margin:0 auto;
		border-spacing:0;
	}
	.tdHeader{
		color:rgb(147, 43, 67);
		font-weight:bold;
		padding:2px 5px;	
		border-bottom:1px solid silver;
		background-color:rgb(244, 235, 235);
	}
	.selectOfficeApp{
		width:200;
		font-size:16px;
		padding-left:2px;
	}
	.selectProgramApp{
		width:200;
		font-size:16px;
		padding-left:2px;
	}
	.tdHeader1{
		
		background-color:rgb(134, 132, 132);
	}
</style>

	

<script>
	//loaderAppropriation();
	
	whenRefreshFundEncode();
	
	function whenRefreshFundEncode(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		
		if(cookieMainText == "Appropriations"){
			var cookieText = cookieLabel(cookieAppropriationsMenu(),"appropriationMenuContainer");
			if(cookieText == "Encode"){
				loaderAppropriation();
			}
		}
	}
	function loaderAppropriation(){
		loadOfficeApp();
		loadProgramsApp();
		//loadEncodedFund();
	}
	function loadProgramsApp(){
		var queryString = "?loadProgramsApp=1";
		var container = document.getElementById('projectCodeContainer1');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadProgramsApp");
	}
	function loadAppPerOffice(me){
		var office = me.value;
		var queryString = "?loadAppPerOffice=1&officeCode=" + office;
		var container = document.getElementById('returnContainer1');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadAppPerOffice");
	}
	function loadAppPerProgram(me){
		var program= me.value;
		var officeCode = document.getElementById("tdOfficeApp").children[0].value;
		if(officeCode!= ""){
			var queryString = "?loadAppPerProgram=1&program=" + program + "&officeCode=" + officeCode;
			var container = document.getElementById('returnContainer1');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"loadAppPerProgram");
		}else{
			alert("Please select office in step 1.");
			 selectToIndexZeroA(me);
		}
		
	}
	function loadOfficeApp(){
		var queryString = "?loadOfficeApp=1";
		var container = document.getElementById('tdOfficeApp');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadOfficeApp");
	}
	function loadEncodedFund(){
		var queryString = "?laodEncodedFund=1";
		var container = document.getElementById('returnContainer1');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadEncodedFund");
	}
	function moveTo(){
		focusNext("fundAmountId");
	}
	function saveFund(){
		
		var code = document.getElementById('keywordFund').value;
		var amount = document.getElementById('fundAmountId').value;
		var programCode = document.getElementById('projectCodeContainer1').children[0].value;
		var office = document.getElementById("tdOfficeApp").children[0].value;
	
		if(office != ""){
			if(programCode){
				if(code){
					var amount = document.getElementById('fundAmountId').value;
					if(amount){
						var amountFiltered = amount.replace(/,/g,"");
						var allow = amountFiltered.substring(0,3);
						if(isNumber(amountFiltered) == true || allow == 'del'){
							if(allow == "del"){
								amount = 'del';
							}
							clearOneInput('keywordFund');
							clearOneInput('fundAmountId');
							focusNext('keywordFund');
							var queryString = "?saveFund=1&office=" + office + "&code=" + code + "&amount=" + amount + "&programCode=" + programCode;
							var container = document.getElementById('returnContainer1');
							loader();
							ajaxGetAndConcatenate(queryString,processorLink,container,"SaveFund");
						}else{
							alert("Please check amount. Invalid number format.");
						}
					}else{
						alert("Please input amount.");	
					}
				
				}else{
					alert("Please input account code.");
					focusNext('keywordFund');
				}	
			}else{
				alert("Please select budget program/code.");
				
			}
		}else{
			alert("Please select office in step 1.");
		}
	} 
	function getEncodedByFund(me){
		var fund = me.textContent;
		if(fund  == "CO"){
			fund = "Capital Outlay";
		}else if(fund == "PS"){
			fund = "Personal Services";
		}else if(fund == "MOOE"){
			fund = "MOOE";
		}else{
			fund = "-";
		}	
		var programCode = me.id;
		var queryString = "?getEncodedByFund=1&fund=" + fund + "&programCode=" + programCode;
		var container = document.getElementById('returnContainer1');
		ajaxGetAndConcatenate(queryString,processorLink,container,"getEncodedByFund");
	}
	function getEncodedByProgramCode(me){
		var programCode =  me.id;
		var queryString = "?getEncodedByProgramCode=1&programCode=" + programCode;
		var container = document.getElementById('returnContainer1');
		ajaxGetAndConcatenate(queryString,processorLink,container,"getEncodedByProgramCode");
	}
	function SelectByPogramCode(me){
		var index = me.options.selectedIndex;
		var code  = me.options[index].value;
		var name = me.options[index].innerHTML.replace(code+"&nbsp;&nbsp;","");
		var codeD = "<span class = 'label5'>"  + code + "</span><br/>";
		document.getElementById('programCodeDisplay').innerHTML = codeD + "<span style  = 'color:rgb(8, 149, 196)'>" + name + "</span>";
		document.getElementById('programCodeDisplay').codeD = code;
	}
	
	
	function putDash2(me,evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		var code = '';
		var x = me.value.toString();
		if(charCode != 8){		
			var length = x.length;
			if(length == 1){
				me.value += '-';
			}else if(length >= 4){
				me.value += '-';
			}
		}
	}
	function putDash1(me,evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		var code = '';
		var x = me.value.toString();
		if(charCode != 8 || charCode != 13){		
			var length = x.length;
			if(length == 1){
				me.value += '-';
			}else if(length == 4){
				me.value += '-';
			}else if(length == 7){
				me.value += '-';
			}
		}
		if(charCode == 13){
			
			if(x.length == 11){
				focusNext("fundAmountId");
			}
		}
	}
	
	function checkApp(){
		
		validityApp(document.getElementById('inputTextFileAppropriation').value);
	}
	function getFrameByNameApp(name) {
		  for (var i = 0; i < frames.length; i++)
		    if (frames[i].name == name)
		      return frames[i];
		 
		  return null;
	}
	function validityApp(uploadValue){ 
		
		if(uploadValue != ''){ 
			var n = uploadValue.split('.');
			var validExtensions = ['txt','TXT'];
			var ext = uploadValue.substr(uploadValue.lastIndexOf('.') + 1);
			var found  = 0;
			
			for(var i=0; i < validExtensions.length; i++){
				  if(ext == validExtensions[i]){
				  	found  = 1;
				  }
			}
			if(found == 1){
				
				loader();
				document.getElementById('submitFileAppropriation').click();
			}else{
				 alert("Dili valid ang file.");	
				 refreshInput();
			}
		} 
	}
	function uploadDoneApp(me) {
		
		var frame = getFrameByNameApp(me.name);
	
		if(frame) {
			 ret = frame.document.getElementsByTagName("body")[0].innerHTML;
		
			 if(ret != 0  ){
			 	
			 	loader();
			 	document.getElementById("returnContainer1").innerHTML = ret;
			 }
		}
	}	
	function refreshInputApp(){
	 	document.getElementById('tdFileHolderApp').innerHTML = '<input style="background-color:white;padding:3px;" type = "file" name  = "inputTextFileAppropriation" id = "inputTextFileAppropriation">';
	}
	function saveFileApp(){
		if(document.getElementById("fileAppTable")){
			if(document.getElementById("tdOfficeApp").children[0].value != ""){
				var office = document.getElementById("tdOfficeApp").children[0].value;
				var parent = document.getElementById("fileAppTable").children[0];
				var length = parent.children.length;
				var ctr = 0;
				
				var data = '';
				for(var i = 0; i < length; i++){
					var no = parent.children[i].children[0].innerHTML;
					if(no > 0){
						ctr++;
						var code = parent.children[i].children[1].innerHTML;
						var program =  parent.children[i].children[2].children[0].value;
						var amount = parent.children[i].children[3].children[0].value.replace(/,/g,"");
						data += code + "!~!" + program + "!~!" + amount + "!*!";
					}
				}
				if(i > 0){
					loader();
					var queryString = "saveFileApp=1&data=" + data + "&office=" + office;
					var container = document.getElementById('returnContainer1');
					ajaxPost(queryString,processorLink,container,"saveFileApp");
				}
				
			}else{
				alert("Please select office in step 1.");
			}
			
		}else{
			alert("No file loaded.");
		}
		
	}
	function removeApp(me){
		var answer = confirm("Confirm action?");
		if(answer){
			var table = me.parentNode.parentNode.parentNode;
			var tr =  me.parentNode.parentNode;
			var officeCode = document.getElementById("tdOfficeApp").children[0].value;
			var program	= tr.children[2].textContent;
			var code	= tr.children[3].textContent;
			
			table.removeChild(tr);
			loader();
			var queryString = "?removeApp=1&programCode=" + program + "&officeCode=" + officeCode + "&code=" + code;
			var container = document.getElementById('returnContainer1');
			ajaxGetAndConcatenate(queryString,processorLink,container,"removeApp");
		}
	}
	function gotoNext(){
		 focusNext('fundAmountId');
	}
</script>



<table class ="tableContentApp" border ="0" style="padding-top: 10px;">
		<!--<tr>
			<td class="tdHeader"><div class = "divHeader1">Fund&nbsp;Entry</div></td>
		</tr>-->
		<tr>
			<td class="tdContent" valign="top">
				<div style = "padding-left:20px;padding-top:20px;padding-right:10px;">
					<table style = "border:0px solid silver;width:100%;" border ="0">
						<tr>
							<td valign="top">
								<table border="0" style = "margin-top:10px;">
									<tr>
										<td width= "10" ><span class = "number1">1</span><span class = "label3">Office</span></td>
										<td colspan="4" id = "tdOfficeApp">
											<select class = "select2" style = "width:200px;">
												<option></option>
											</select>
										</td>
									</tr>
									<tr>
										<td width= "10" ><span class = "number1">2</span><span class = "label3">Program</span></td>
										<td colspan="4" id = "projectCodeContainer1">
											<select class = "select2" style = "width:200px;">
												<option></option>
											</select>
										</td>
									</tr>
									<!--<tr>
										<td width= "10" colspan ="2" style="padding-top:10px;"><div class = "label4" id = "programCodeDisplay"></div></td>
									</tr>-->
									<tr>
										<td width= "10" ><span class = "number1">3</span><span class = "label3">Acct&nbsp;Code</span></td>
										<td >
											<div style = "margin:0px;margin-left:0px;">
												<!--<input id = "keywordFund" type = "text" class ="inputText" onkeyup="putDash(this,event)" onkeydown="keypressAndWhat(this,event,moveTo)" />-->
												<input id = "keywordFund" type = "text" class ="inputText"  style = "width:200px;"  value  = ''  onkeydown="keypressAndWhat(this,event,gotoNext)"  maxlength="11" />
											</div>
										</td>
									</tr>
									<tr>
										<td><span class = "number1">4</span><span class = "label3">Amount</span></td>
										<td><input id = "fundAmountId" type = "text" class ="inputText" style = "width:200px;"   onkeydown="keypressAndWhat(this,event,saveFund)"</td>
									</tr>
									
									
									<tr>
										<td colspan="2" style = "color:rgb(123, 154, 127);font-size:16px;color:black;padding:2px 10px;padding-top:85px; border-bottom:1px solid silver; font-weight: bold;" class="label2">LOAD FILE</td>
									</tr>
									
									<tr>
										<td colspan="2">
											<form id ="myForm" action="../ajax/uploadprocessor.php" method=post enctype='multipart/form-data' target=hiddenUploadApp onchange="checkApp()">
												<table style = "margin-top:5px;border:1px solid rgb(233, 234, 233)" border = "0">
													
													<tr>
														<td id = "tdFileHolderApp" style="text-align:center;padding:5px 10px;background-color:rgb(250, 245, 248);">
															<input style="width:215px; background-color:white;padding:4px;font-size:14px;" type = "file" name  = "inputTextFileAppropriation" id = "inputTextFileAppropriation">
														</td>
													</tr>
												</table>
												<input type="submit" name = "submit" id = "submitFileAppropriation" value = "Load" style = "display:none;" >
												<iframe  id="hiddenUploadApp" name="hiddenUploadApp"  onload='uploadDoneApp(this)'style='width:0;height:0;border:0px solid #fff'></iframe>
											</form>
										</td>
										
									</tr>
									<tr>
										<td colspan="4" id = "tdOfficeApp" style = "text-align: center;">
											<div class = "button1" style = "font-size: 18px;" onclick="saveFileApp()">Save</div>
										</td>
									</tr>
									<tr>
										<td valign="top" colspan="2" style = "padding-top:10px;">
											<div id = "returnContainerSummary">
												
											</div>
										</td>
									</tr>
								</table>
							</td>
							 
							
							<td valign="top" colspan="2" rowspan="6" style="padding:10px;background-color:rgb(237, 242, 244);">
								<div >
									<div id = "returnContainer1" class = "returnContainer" style="background-color:white;min-height:600px;width:822px;"></div>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
