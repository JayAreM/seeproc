<style>
	#divManualTrackingNumber{
		display:inline-block;
		font-size:26px;
		letter-spacing:1px;
		font-weight:bold;
	}
	.tableContent{
		background-color:white;
		width:850px;
		height:100%;
		margin:0px auto; 
		
		padding:0px 30px;
		padding-bottom:15px;
	}
	.tdContent{
		background-color:rgba(6, 44, 66,.02);
		background-color:white;
		box-shadow:0px 0px 10px 1px grey;
	}
</style>
	<table id = "tableSelectType" border ="0" style = "padding-bottom:0px;width:822px;">
		<tr>
			<td colspan="4" style = "text-align:right;padding-right:20px">
			<span class = "label3" style = "margin-right:5px;" >Tracking number</span>
			<div id = "divManualTrackingNumber">0000-0</div></td>
		</tr>
		<tr>
			<td colspan="4" style = "padding:20px 0px;"></td>
		</tr>
		<tr >		
			<td width="50%" style = "text-align:right;padding-right:20px;">	
				<input value="" type="radio" name="selectType" id="optMPR" class="radio" onclick = "clickManual(this)"/>
				<label  for="optMPR">PR&nbsp;Tracking</label>
			</td>
			<td style = "text-align:left;padding-left:60px;">	
				<input value="" type="radio" name="selectType" id="optMPO" class="radio" onclick = "clickManual(this)"/>
				<label  for="optMPO">P.O Tracking</label>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="padding-bottom:5px;" >
				<hr style = "border:0;border-top:1px solid rgb(219, 229, 235);"/>
			</td>
		</tr>
	</table>
	
	<table class = "hide" id = "tableMT1" style = "margin:0 auto;margin-top:15px ;" >
		<tr>
			<td style = "padding:15px 0px;border-bottom:1px solid rgb(237, 241, 242);" colspan ="3">
				<span class ="label2" style = "font-weight:bold;">Enter PR#</span>
				<input class = "select2" id = "manualPrNumber" style = "margin-left:20px;width:100px;text-align:center;" maxlength="10" onclick="clickInput(this)"/>
			</td>
		</tr>
		<tr>
			<td style = "padding:10px 0px;padding-top:15px;" colspan="3">
				<span class = "number">1</span><span class ="label2">Select Fund Type</span>
			</td>
		</tr>
		<tr>
			<td style="padding:5px;text-align:center" colspan="3">
			    <select id = "selectManualFund" class = "select2" onclick="clickInput(this)">
					<option></option>	
					<option>General Fund</option>	
					<option>Trust Fund</option>
					<option>SEF</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style = "padding:10px 0px;" colspan="3">
				<span class = "number">2</span><span class ="label2">Select Category</span>
			</td>
		</tr>
		
		<tr>
			<td style="padding:5px;text-align:center" colspan="3" id  = "manualCategoryList" onclick="clickManualCat(this)">
			 	
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<div style = "width:550px;margin:0 auto;display:none;" id ="prManualInfo">
					<span class="label1">PR information :</span><br/>
					<textarea id = "prInformation" class="select2" style = "padding:5px;resize:vertical;border:1px solid grey;" 
					placeholder="Type the categories and other information that describe this PR transaction." onclick = "clickInput(this)" ></textarea>	
				</div>
			</td>
		</tr>
		<tr>
			<td style = "padding-top:20px" colspan="3">
				<span class = "number">3</span><span class ="label2">Specify charges</span>
			</td>
		</tr>
		<tr id = "fund4">
			<td style = "padding:0px 0px;" colspan="3">
				<div style = "border-bottom:0px solid silver;padding:10px;">
					<table style ="width:100%;">
						<tr>
							<td colspan="3" style ="padding-bottom:10px;text-align:center;" >
								<div> 
									<div style = "border-bottom:1px solid silver;padding-top:20px;width:650px;text-align:left;">
										<span class = "label11" style ="padding-left:155px;">&nbsp;&nbsp;Fund&nbsp;&nbsp;</span>
										<span class = "label11" style ="padding-left:68px;">&nbsp;&nbsp;Code&nbsp;&nbsp;</span>
										<span class = "label11" style ="padding-left:50px;">Amount</span>
									</div>
									<div id = "manualChargesContainer" style = " padding:0px 20px;padding-top:10px;text-align:center;background-color:rgb(247, 252, 252);">
										
									</div>
									
									<table style ="margin:25px auto;margin-top:40px;" border ="0">
										<tr>
											<td width ="200"><span class = "label2 tdHeader1">Program</span></td>
											<td width ="100"><span class = "label2 tdHeader1">Account Codes</span></td>
											<td width ="20"><span class = "label2 tdHeader1">Amount</span></td>
											<td width ="20"><span class ="label2">&nbsp;</span></td>	
										</tr>
										<tr>
											<td id = "tdManualSource">
											    <select id = "source1" class = "select2 checkPY" style ="width:200px;">
													<option></option>
													
												</select>
											</td>
											<td id = "tdManualCodes">
											    <select id = "source2" class = "select2 checkPY" style ="width:200px;">
													<option></option>
												</select>
											</td>
											<td ><input onclick="clickInput(this)" id  = "manualAmount" type ="text" style = "width:100px;" class = "text1" maxlength="15" onkeydown="return isAmount(this,event)"/></td>	
											<td ><span class ="label8" onclick = "addManualSource(this)">Add</span></td>
										</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td style = "padding:10px 0px;" colspan="3">
				<div class = "button1" onclick = "saveManualPR()">Save</div><br/>
			</td>
		</tr>
	</table>
	
	<table id = "tableMT2" class="hide" style="padding-top:20px;width:700px;" border ="0">
		<tr>
			<td style = "padding:10px 0px;" colspan="3">
				<span class = "number">1</span><span class ="label2">Input Supplier name</span>
			</td>
		</tr>
		<tr>
			<td style="padding:5px;text-align:center" colspan="3">
				   <input id = "manualSupplierName" type ="text" class = "text1" onclick = "clickInput(this)"/>
			</td>
		</tr>
		<tr>
			<td style = "padding:10px 0px;" colspan="3">
				<span class = "number">2</span><span class ="label2">Select Budget Approved PRs</span>
			</td>
		</tr>
		<tr>
			<td id = "manualReleasedPR" style="padding:5px;text-align:center"  colspan="3">
			
			</td>
		</tr>
		
		<tr >
			<td style = "padding:10px 0px;" colspan="3">
				<span class = "number">3</span><span class ="label2">Enter actual amount.</span>
			</td>
		</tr>
		<tr>
			<td id  = "tdManualPRCharges" style="text-align:center;background-color:rgba(238, 244, 247,.8);padding:5px 10px;" colspan="3" >
				
			</td>
		</tr>
		
		<tr>
			<td style = "padding:10px 0px;" colspan="3">
				<div class = "button1" onclick = "saveManualPO()">Save</div><br/>
			</td>
		</tr>
	</table>
<script>
	
	function clickManual(me){
		var type  = me.id;
		if(type == "optMPR"){
			document.getElementById("tableMT1").style.display = "inline-table";
			document.getElementById("tableMT2").style.display = "none";
		}else if(type == "optMPO"){
			document.getElementById("tableMT1").style.display = "none";
			document.getElementById("tableMT2").style.display = "inline-table";
		}
		var queryString = "?selectManualDoctrack=1&type=" + type;
		var container = document.getElementById('divManualTrackingNumber');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"selectManualDoctrack");
	}
	//loadFirstOption();
	function loadFirstOption(){
		//document.getElementById('optMPR').click();
		document.getElementById('optMPO').click();
		//document.getElementById('optMPR').checked = true;
	}
	function selectManualCategory(me){
		if(me.value == "myPeak"){
			document.getElementById('prManualInfo').style.display = "block";
		}else{
			document.getElementById('prManualInfo').style.display = "none";
		}
	}
	function selectManualSource(me){
		var fund = me.value;
		var programCode = me.value;
	
		var queryString = "?fetchAccountCodesMultipleSource=1&programCode=" + fund;
		var container = document.getElementById('tdManualCodes');
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchAccountCodesMultipleSource");
	}
	var obrData = '';
	var gTotal = 0;
	function addManualSource(me){
		var fund  = document.getElementById("tdManualSource").children[0].value;
		var code  = document.getElementById("tdManualCodes").children[0].value;
		var amount  = document.getElementById("manualAmount").value;
	
		if(fund != 0){
			if(code != 0){
				if(amount){
					if(amount > 0){
					   var searchThis = fund + '*' + code + '*' + amount + '~';
					 
						var f = obrData.includes(searchThis);
						if(f == false){
							
							gTotal = parseFloat(gTotal) + parseFloat(amount);
							obrData += fund + '*' + code + '*' + amount + '~';
							
							
							var sheet = '<div style = "border-bottom:1px solid rgb(232, 235, 235);">';
							sheet += '<span class = "label17" style ="width:100px;text-align:left;">' + fund + '</span>'
							sheet += '<span class = "label17" style ="width:100px;">' + code + '</span>'
							sheet+= '		 <span class = "label17" style ="width:100px;">' + amount + '</span>';
							sheet += '		 <div class = "label18" onclick ="removeCharge1(this)"></div></div>';
							
							document.getElementById('manualChargesContainer').innerHTML  += sheet;	
						}else{
							msg("You already added <font color = 'red'><b>" + fund + ' - ' + code + "</b></font>. Please review your entry.");
						}
						
					}else{
						msg("Should be greater than zero.");
					}
				}else{
					document.getElementById('manualAmount').style.backgroundColor = "rgb(250, 152, 158)";
					msg("Please input amount.");
				}
				
			}else{
				document.getElementById("tdManualCodes").children[0].style.backgroundColor = "rgb(250, 152, 158)";
				msg("Please select account code.");
			}
		}else{
			document.getElementById("tdManualSource").children[0].style.backgroundColor = "rgb(250, 152, 158)";
			msg("Please select source of fund.");
		}
	}
	function removeCharge1(me){
		var parent = me.parentNode.parentNode;
		var parentDiv = me.parentNode;
		
		var fund = parentDiv.children[0].textContent;
		var code = parentDiv.children[1].textContent;
		var amount = parentDiv.children[2].textContent;
		
		gTotal = parseFloat(gTotal)- parseFloat(amount);
		
		obrData = obrData.replace(fund + '*' + code + '*' + amount + '~','');
		parent.removeChild(parentDiv);
	}
	
	function saveManualPR(){
		var error = 0;
		var fund = document.getElementById('selectManualFund').value;
		var category = document.getElementById('manualCategoryList').children[0].value;
		var x = document.getElementById("manualCategoryList").children[0].selectedIndex;
		var details = document.getElementById("manualCategoryList").children[0].options[x].text;
		var prNumber = document.getElementById('manualPrNumber').value;
		var prInfo = document.getElementById("prInformation").value;
		
		if(prNumber.length == 0){
			error = 1;
			document.getElementById('manualPrNumber').style.backgroundColor = "rgb(250, 152, 158)";
		}
		if(category.length == 0){
			error = 1;
			document.getElementById('manualCategoryList').children[0].style.backgroundColor = "rgb(250, 152, 158)";
		}
		if(category == "myPeak"){
			var details = document.getElementById("prInformation").value;
			if(details.length == 0){
				document.getElementById("prInformation").style.backgroundColor = "rgb(250, 152, 158)";
				error = 1;
			}
		}
		if(fund.length == 0){
			error = 1;
			document.getElementById('selectManualFund').style.backgroundColor = "rgb(250, 152, 158)";
		}
		
		if(obrData.length == 0){
			document.getElementById('manualAmount').style.backgroundColor = "rgb(250, 152, 158)";
			document.getElementById("tdManualCodes").children[0].style.backgroundColor = "rgb(250, 152, 158)";
			document.getElementById("tdManualSource").children[0].style.backgroundColor = "rgb(250, 152, 158)";	
			error = 1;
		}
		
		if(error != 1){
			var answer = confirm("Confirm action?");
			if(answer){
				var queryString = "?saveManualPR=1&obrData=" + obrData + "&fund=" + fund +"&category=" + category + 
				                   "&prTotal=" + gTotal + "&prNumber=" + prNumber + "&details=" + details;
				var container = document.getElementById('divManualTrackingNumber');
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"saveManualPR");
			}
		}else{
			msg("Please complete the required fields.");
		}
	}
	function saveManualPO(){
			
			var error  = 0;
			var supplier = document.getElementById('manualSupplierName').value;
			
			
			
			if(supplier.length == 0){
				error = 1;
				document.getElementById('manualSupplierName').style.backgroundColor = "rgb(250, 152, 158)";
			}
			
			var categoryTracking =  document.getElementById('manualReleasedPR').children[0].value;
			if(categoryTracking.length == 0){
				error = 1;
				document.getElementById('manualReleasedPR').children[0].style.backgroundColor = "rgb(250, 152, 158)";
			}
			if(document.getElementById('prManualHidden')){
				var splits = document.getElementById('prManualHidden').value.split("~");
				var obrNumber = splits[0];
				var prNumber = splits[1];
				var program = splits[2];
			}
			
			if(document.getElementById('manualPOTotal')){
				var poTotal = document.getElementById('manualPOTotal').textContent;
				var x = document.getElementById("manualReleasedPR").children[0].selectedIndex;
		   		var details = document.getElementById("manualReleasedPR").children[0].options[x].text;
				
				if(document.getElementById('prManualdetails')){
					details = document.getElementById('prManualdetails').textContent;
				}
				var poData = '';
				var parent = document.getElementById('manualPOtable');
				var trLength = parent.children[0].children.length;
				
				for(var i = 1 ; i < trLength-1; i++){
					var checkMe = parent.children[0].children[i].children[0].children[0].checked;
					if(checkMe == true){
						var fund = parent.children[0].children[i].children[1].textContent;
						var code = parent.children[0].children[i].children[2].textContent;
						var obrTotal = parent.children[0].children[i].children[3].textContent;
						var amount = parent.children[0].children[i].children[4].children[0].value;
						if(amount == 0){
							error = 1;
							parent.children[0].children[i].children[4].children[0].style.backgroundColor = "rgb(250, 152, 158)";
						}
						poData += fund + '~' + code + '~' + obrTotal + '~' + amount + '*';	
					}	
				}
			}
			if(poTotal <= 0){
				error = 2;
			}
			if(error == 0){
				var answer = confirm("Confirm action?");
				if(answer){
					var queryString = "?saveManualPO=1&categoryTracking=" + categoryTracking + "&supplier=" + supplier + "&details=" + details + "&poData=" + poData + "&obrNumber=" + obrNumber + "&poTotal=" + poTotal + "&prNumber=" + prNumber + "&fund=" + program;
					var container = document.getElementById('divManualTrackingNumber');
					//alert(queryString);
					loader();
					ajaxGetAndConcatenate(queryString,processorLink,container,"saveManualPO");
				}
			}else{
				if(error == 2){
					msg("Please check the source of fund and indicate the total amount.");
				}else{
					msg("Please complete the required fields.");
				}
				
			}
			
	}
	
	function clickManualCat(me){
		me.children[0].style.backgroundColor = "white";
	}
	function clearFieldsMPR(){
		document.getElementById('manualCategoryList').children[0].selectedIndex = "0";
		document.getElementById("tdManualCodes").children[0].selectedIndex = "0";
		document.getElementById("tdManualSource").children[0].selectedIndex = "0";
		
		document.getElementById('manualChargesContainer').innerHTML = '';
		document.getElementById('manualAmount').value = '';
		document.getElementById('manualPrNumber').value = '';
		document.getElementById('prInformation').value = '';
		
		document.getElementById('prManualInfo').style.display = "none";
		
		gTotal = 0;
	    obrData = '';
	}
	function clearFieldsMPO(){
		document.getElementById('manualReleasedPR').children[0].selectedIndex = "0";
		document.getElementById('manualSupplierName').value = '';
		
		
		document.getElementById('tdManualPRCharges').innerHTML = '';

	}

	function viewApprovedPRfunds(me){
		var splits =  me.value.split('~');
		var trackingNumber = splits[1];
		
		var queryString = "?searchManualApprovedTracking=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('tdManualPRCharges');
		if(trackingNumber){
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"searchManualApprovedTracking");
		}else{
			container.innerHTML  = '';
		}
		
	}
	
	function calculateManual(me){
		var angCheck =  me.parentNode.parentNode.children[0].children[0].checked;
		var amount = me.value.replace(/,/g,"");
		if(amount){
			var gTotal = 0;
			var parent = me.parentNode.parentNode.parentNode;
			for(var i = 1; i < parent.children.length-1; i++){
				var angCheck =  parent.children[i].children[0].children[0].checked;
				if(angCheck == true){
					var amount = parent.children[i].children[4].children[0].value;
					var gTotal = gTotal + parseFloat(amount);		
				}
			}
			document.getElementById('manualPOTotal').innerHTML = gTotal.toFixed(2);
		}
	}
	function selectCalculate(me){
		if(me.checked == true){
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "inherit";
			var total = parent.children[4].children[0].value.replace(/,/g,"");
			if(total){
				var gTotal = parseFloat(document.getElementById('manualPOTotal').textContent.replace(/,/g,"")) + parseFloat(total);
				document.getElementById('manualPOTotal').innerHTML = gTotal.toFixed(2);
			}
		}else{
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "rgb(229, 228, 228)";
			var total = parent.children[4].children[0].value.replace(/,/g,"");
			if(total){
				var gTotal = parseFloat(document.getElementById('manualPOTotal').textContent.replace(/,/g,"")) - parseFloat(total);
				document.getElementById('manualPOTotal').innerHTML = gTotal.toFixed(2);
			}
		}
	}
</script>