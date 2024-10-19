<style>
	.select2{
		width:152px;	
		margin-left:5px;
		font-family: arial;
		font-size: 12px;
		color:rgb(0, 97, 142);
	}
	#ppmpViewContainer1 .tdData{
		font-family: arial;
		font-size: 12px;
		color:rgb(0, 97, 142);
	}
	#ppmpViewContainer .tdHeader{
		background-color: rgb(115, 112, 106);
		border-left:1px solid rgb(175, 173, 170);
	}
	.accountCode{
		cursor: pointer;
	}
	
	.accountCode:hover{
		font-style: italic;
		font-weight: bold;
	}
	.accountNameHide{
		
		transition :all 1s ease-in;
		display: none;
	}
	.accountName{
	     transition :all 1s ease-in;
              position :absolute;
             margin-top :-25px;
             border-radius: 3px 3px 3px 0px;
             background-color: rgb(229, 74, 121);
             box-shadow: 0px 0px 5px 0px black;
             border:1px solid white;
             color:white;
             padding:3px 8px;
	}
</style>
<div style = "background-color: white;width: 95%;margin:0 auto;padding:1px;box-shadow: 0px 0px 10px 1px grey;">
	<table style = "width:100%;background-color:rgb(239, 243, 221);padding:1px;">
		<tr>
			<td  style ="vertical-align:top;">
				<div id = "ppmpViewContainer" style = "border:1px solid silver;min-height:600px;background-color:rgb(250, 244, 244);">
					
				</div>
			</td>
			<td  style = "vertical-align: top;width:10px;background-colo1r:rgb(181, 144, 117);padding:25px 10px;">
				<table  style = "border:0px solid silver;border-spacing: 0;" >
					
					<tr style  = "background-color:rgb(228, 226, 222);">
						<td  style  = "padding:8px 2px;padding-bottom:5px;border:1px solid white;">
							<span style = "font-size: 14px;font-weight: bolder;" class = "label15">Search</span>
							<input class = "select2" style = "width:148px;margin-left:4px;" maxlength="8" onkeypress=" keypressAndWhat1(this,event,searchThis,1)"/>
							<div style = "font-size:13px;color:grey;font-style:italic;margin:0 auto;text-align:center;padding:5px;">category, description, items, unit, program, expense code</div>
						</td>
					</tr>
					<tr>
						<td><div style = "border-bottom:1px dashed grey;margin:5px auto;margin-bottom:10px;"></div></td>
					</tr>
					<tr  style="background-color: rgb(233, 223, 181);">
						<td  style ="border:1px solid white;border-bottom: 0;"></td>
					</tr>
					<?php
						if($_SESSION['accountType'] >= 2){
					?>
							<tr  style="background-color: rgb(233, 223, 181);">
								<td  style ="border:1px solid white;border-bottom: 0;border-top: 0;"><span style = "font-size: 14px;" class = "label15">Office</span></td>
							</tr>
							<tr style="background-color: rgb(233, 223, 181);">
								<td  style ="border:1px solid white;border-top: 0;border-bottom: 0;" id = "ppmpViewSelectOfficeContainer">
									<select id = "ppmpViewSelectOffice"class="select2" onchange="this.blur()">
										<option></option>
									</select>
								</td>
							</tr>
					<?php
						}
					?>
					
					<tr style="background-color: rgb(233, 223, 181);">
						<td style ="border:1px solid white;border-bottom: 0;border-top: 0;"><span style = "font-size: 14px;" class = "label15">Entry Type</span></td>
					</tr>
					<tr style="background-color: rgb(233, 223, 181);">
						<td style ="border:1px solid white;border-bottom: 0;border-top: 0;" id = "ppmpViewSelectTypeContainer">
							<select id = "ppmpViewSelectType"class="select2" >
								<option></option>
							</select>
						</td>
					</tr>
					<tr  style="background-color: rgb(233, 223, 181);">
						<td style ="border:1px solid white;border-bottom: 0;border-top: 0;"><span style = "font-size: 14px;" class = "label15">Program Code</span></td>
					</tr>
					<tr style="background-color: rgb(233, 223, 181);">
						<td style ="border:1px solid white;border-top: 0;border-bottom:0;padding-bottom: 5px;"  id = "ppmpViewSelectProgramContainer" >
							<select class="select2"><option></option></select>
						</td>
					</tr>
					
					
					<tr style="background-color: rgb(233, 223, 181);">
						<td style ="border:1px solid white;border-top: 0;border-bottom: 0;">
					
						<span style = "font-size: 14px;" class = "label15">Fund</span></td>
					</tr>
					<tr style="background-color: rgb(233, 223, 181);">
						<td style ="border:1px solid white;border-top: 0;border-top: 0;padding-bottom: 10px;" id = "ppmpViewSelectFundContainer">
							<select id = "ppmpViewSelectFund"class="select2" style = "background-color:rgb(222, 222, 217); " onchange = "getPPMPbyFund(this)">
								<option></option>
							</select>
						</td>
					</tr>
					
					
					<?php
						
						if( $_SESSION['gso'] == 'ONE1' or $_SESSION['accountType'] >1){
							
					?>
							<tr style="">
								<td style ="border:0;padding-bottom: 15px;"></td>
							</tr>
							<tr style="background-color:rgb(225, 229, 206);">
								<td style ="border: 0;padding: 5px 0px;"  id = "" >
									<span  class = "label15" style = "font-size: 14px;font-weight:bold;">Summary</span>
								</td>
							</tr>
							
							<tr style=" background-color: rgb(232, 237, 233);">
								<td style ="border:1px solid white;border-top: 0;border-top: 0;padding-top: 10px;padding-bottom: 5px;text-align:right;" id = "">
									<span style = "font-size: 12px;font-weight:bold;">Fund</span> <select class="select2" style = "background-color:rgb(253, 253, 251);width:110px; " id = "appFund" >
										<option>General Fund</option>
										<option>SEF</option>
										<option>Trust Fund</option>
									</select>
								</td>
							</tr>
							<tr  style = "background-color: rgb(248, 249, 244);">
								<td style ="border:1px solid white;border: 0;padding-bottom: 5px;padding-top:5px;padding-left:10px;"   >
									<div style="cursor:pointer; color:black; font-family:arial;font-size:10px;margin-bottom: 4px;" onclick = "printAPP()">
										<!--<a href="../interface/formAPP.php" target="_blank" style="text-decoration:none;"><span style="color:black;font-family:arial;font-size:10px;" onclick = "gotoLinkApp()">1. PRINT PREVIEW APP - GF</span></a>-->
										<span style="color:black;font-family:arial;font-size:10px;" onclick = "gotoLinkApp()">1. PRINT PREVIEW APP</span>
									</div>
									<div style="cursor:pointer;color:black; font-family:arial;font-size:10px;margin-bottom: 4px;">
										<!--<a href="../interface/formSupplies.php" target="_blank" style="text-decoration:none;"><span style="color:black;font-family:arial;font-size:10px;">2. PRINT PREVIEW SUPPLIES</span></a>-->
										<span style="color:black;font-family:arial;font-size:10px;" onclick = "gotoLinkSupp()">2. PRINT PREVIEW SUPPLIES</span>
									</div>
									<div style="cursor:pointer;color:black; font-family:arial;font-size:10px;margin-bottom: 4px;">
										<span style="color:black;font-family:arial;font-size:10px;" onclick = "gotoLinkBreakdown()">3. SAVE PPMP BREAKDOWN</span>
									</div>
									
									<div style="cursor:pointer;color:black; font-family:arial;font-size:10px;margin-bottom: 4px;">
										<span style="color:black;font-family:arial;font-size:10px;" onclick = "gotoLinkSBsummary()">4. SB SUMMARY</span>
									</div>
									<div style="cursor:pointer;color:black; font-family:arial;font-size:10px;">
										<span style="color:black;font-family:arial;font-size:10px;" onclick = "gotoLinkSBBreakdown()">5. SB BREAKDOWN</span>
									</div>
									
									
									
								</td>
							</tr>
					<?php
						}
					?>
				</table>
				<div id = "ppmpViewContainer1" style="width:165px;border:0px solid silver;min-height:50px;margin-top:20px; ">
					
				</div>
			</td>
		</tr>
		
	</table>
	
</div>

<script>
	
	whenRefreshPPMPView();
	function whenRefreshPPMPView(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Procurement"){
			var cookieValue = readCookie("lastMain6").trim();
			var cookieText = cookieLabel(cookieValue,"ppmpMenuContainer");
			if(cookieText == "View"){
				loadPPMPviewOffice();
			}
		}
	}
	function loadPPMPviewOffice(){
		loader();
		var queryString = "?loadPPMPviewOffice=1";
		var container = '';
		ajaxGetAndConcatenate1(queryString,processorLink,container,"loadPPMPviewOffice");
	}
	function loadSelectViewProgram(){
	
		loader();
		var queryString = "?loadSelectViewProgram=1";
		var container = document.getElementById('ppmpViewSelectProgramContainer');
		ajaxGetAndConcatenate1(queryString,processorLink,container,"loadSelectViewProgram");
	}
	function fetchSavePPMP(me){
	
		me.blur();
		var officeCode=1;
		var program = me.value;
		var type = document.getElementById("ppmpViewSelectType").value;
		if(document.getElementById("ppmpViewSelectOffice")){
			officeCode = document.getElementById("ppmpViewSelectOffice").value;
		}
		selectToIndexZero("ppmpViewSelectFund");
		loader();
		var queryString = "?fetchSavePPMP=1&program=" + program + "&type=" + type + "&officeCode=" +officeCode;
		var container = "";
		
		ajaxGetAndConcatenate1(queryString,processorLink,container,"searchPPMPview");
	}
	function previewPPMP(me){
		var para =  me.id;
		var queryString = "?previewPPMP=1&para=" + para;
		var container = "";
		ajaxGetAndConcatenate1(queryString,processorLink,container,"previewPPMP");
	}
	function fetchPPMPprogramPerOffice(me){
	
		loader();
		var officeCode = me.value;
		var queryString = "?fetchPPMPprogramPerOffice=1&officeCode=" + officeCode;
		var container = document.getElementById('ppmpViewSelectProgramContainer');
		
		ajaxGetAndConcatenate1(queryString,processorLink,container,"fetchPPMPprogramPerOffice");
	}
	function selectProgramPerType(me){
		var officeCode = 1;
		var type = me.value;
		if(document.getElementById("ppmpViewSelectOffice")){
			officeCode = document.getElementById("ppmpViewSelectOffice").value;
			if(officeCode == ""){
				alert("Please select office.");
			}
		}
		loader();
		var queryString = "?selectProgramPerType=1&officeCode=" + officeCode + "&type=" + type;
		var container = "";
		ajaxGetAndConcatenate1(queryString,processorLink,container,"selectProgramPerType");
	}

	function searchThis(me){
		var officeCode = 1;
		var key  = me.value;
		if(document.getElementById("ppmpViewSelectOffice")){
			officeCode = document.getElementById("ppmpViewSelectOffice").value;
		}
		if(officeCode.length == 0){
			alert("Please select office.");
		}else{
			if(key.length > 2){
				loader();
				var queryString = "?searchValue=1&key=" + key + "&officeCode=" + officeCode;
				var container = document.getElementById("ppmpViewContainer");
				ajaxGetAndConcatenate1(queryString,processorLink,container,"returnLoader");
			}else{
				alert("Must be more than 2 characters long.")
			}
		}
	}
	function viewPerCode(me){
		var code = me.textContent;
		var officeCode = 1;
		if(document.getElementById("ppmpViewSelectOffice")){
			officeCode = document.getElementById("ppmpViewSelectOffice").value;
		}
		var programCode = document.getElementById("ppmpViewSelectProgram").value;
		var type = document.getElementById("ppmpViewSelectType").value;
		
		loader();
		var queryString = "?searchPPPMPperAccount=1&officeCode=" + officeCode + "&programCode=" + programCode + "&type=" + type + "&code=" + code;
		var container = document.getElementById("ppmpViewContainer");
		ajaxGetAndConcatenate1(queryString,processorLink,container,"returnLoader");
	}
	function viewName(me){
		var value  = me.textContent;
		var cs = me.children[0].className;
		
		if(cs == "accountNameHide"){
			me.children[0].className = "accountName";
			me.children[0].innerHTML = me.children[0].id;
		}else{
			me.children[0].className = "accountNameHide";
			me.children[0].innerHTML = "";
		}
	}
	function getPPMPbyFund(me){
		var fund  = me.value;
		var type = document.getElementById("ppmpViewSelectType").value;
		var program = document.getElementById("ppmpViewSelectProgram").value;
		if(document.getElementById("ppmpViewSelectOffice")){
			var officeCode = document.getElementById("ppmpViewSelectOffice").value;
		}else{
			var officeCode = '';
		}
		loader();
		var queryString = "?getPPMPbyFund=1&officeCode=" + officeCode + "&programCode=" + program + "&type=" + type+ "&fund=" + fund;
		var container = document.getElementById("ppmpViewContainer");
		ajaxGetAndConcatenate(queryString,processorLink,container,"getPPMPbyFund");
	}
	function viewPPMPPreview(){
		if(document.getElementById("ppmpViewSelectOffice")){
			var office = document.getElementById("ppmpViewSelectOffice").value;
		}else{
			var office = "<?php echo $_SESSION['officeCode']; ?>";
		}
		var type = document.getElementById("ppmpViewSelectType").value;
		var program = document.getElementById("ppmpViewSelectProgram").value;
		
		
		var fund = document.getElementById("ppmpViewSelectFund").value;
		if(fund == "All" || fund == ''){
			alert("Please select fund.");
		}else{
			var id  = office + "~" + program + "~" + type + "~" + fund;
			var url = "../../../citydoc2023/interface/formPPMP.php?val=" + id;
			window.open(url, "_new");
		}
	}

	function gotoLinkApp(){
		var fund = document.getElementById("appFund").value;
		window.open('../interface/formAPP.php?fund=' + fund);
	}
	
	function gotoLinkSupp(){
		var fund = document.getElementById("appFund").value;
		window.open('../interface/formSupplies.php?fund=' + fund);
	}
	
	function gotoLinkBreakdown(){
		var fund = document.getElementById("appFund").value;
		window.open('../ajax/excelCreator.php?genBreakdown=1');
	}
	function gotoLinkSBsummary(){
		window.open('../interface/formSB.php');
	}
	function gotoLinkSBBreakdown(){
		window.open('../interface/formSBbreakdown.php');
	}

</script>






















