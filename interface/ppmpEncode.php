<style>
	input::-webkit-input-placeholder {
		color: rgb(57, 58, 59) !important;
	}
	 
	input:-moz-placeholder { /* Firefox 18- */
		color: rgb(57, 58, 59) !important;  
	}
	 
	input::-moz-placeholder {  /* Firefox 19+ */
		color: rgb(57, 58, 59) !important;  
	}
	 
	input:-ms-input-placeholder {  
		color: rgb(57, 58, 59) !important;  
	}
	
	/*---------------------------------------------------------------------- empty fields  */
	.inputText{
		
		border-radius:3px;
		color:rgb(7, 124, 174);
		background:rgb(212, 219, 223);
		font-weight: bold;
	}

	.inputText:focus,.inputText:hover {
	
		background-color: rgba(216, 243, 204,.4);
		
	}
	.inputTextEmpty{
		border-radius:3px;
		transition-property: background-color;
	   	transition-duration: .5s;
	   	transition-delay: 0s;
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
	.milestoneTable1 .select2{
		width:200px;	
		font-family: arial;
		font-size: 12px;
		color:rgb(0, 97, 142);
	}
	.label2{
		font-size: 12px;
		font-family: arial;
	}
	.label13{
		font-size: 16px;
	}
	.number{
		font-size: 26px;
		color:gray;
	}
	#tablePPMPedit .select2{
		width:200px;	
		font-family: arial;
		font-size: 12px;
		color:rgb(0, 97, 142);
	}
	#tablePPMPedit1 .select2{
		width:50px;
		text-align:center;	
		font-family: arial;
		font-size: 12px;
		color:rgb(0, 97, 142);
	}
	.milestoneTable2 .select2{
		width:50px;	
		font-family: arial;
		text-align: center;
	}
	
	
	.previousPPMPTable{
		margin:0 auto;
		border:1px solid red;
	}
	#tablePPMPprevious{
		width:400px;
	}
	#tablePPMPprevious td{
		vertical-align: top;
		
	}
	#tablePPMPprevious input{
		color:rgb(187, 32, 86);
		padding:5px 0px;
		text-align: center;
	}
	#tablePPMPprevious td{
		padding:5px 2px;
	}
	.tdHeader{
		background-color:rgb(112, 99, 77);	
		color:white;
		padding:5px 2px;
	}
	.monthInput{
		text-align:center;
		background-color: white;
		border:1px solid silver;
	}
	
	.savedPPMP{
		font-family: arial;
		font-size: 12px;
	}
	.tdHeader{
		text-align:center;
		padding:5px;
	}
	.trData td{
		border-left:1px solid rgb(239, 237, 234);
		border-bottom:1px solid silver;
		padding:2px 5px;
	}
	
	#pppmpItemSelectTable tr:nth-child(even){
		background-color: rgb(243, 244, 226);
	}
	
	#pppmpItemSelectTable tr:nth-child(even) td:nth-child(3){
		background-color: rgb(227, 229, 208);
		
	}
	#pppmpItemSelectTable tr:hover td{
		background-color: rgb(218, 219, 215);
		color:black;
		cursor: pointer;
	}
	#pppmpItemSelectTable tr:hover td:nth-child(3){
		background-color: rgb(218, 219, 215);
		color:black;
		font-weight: bold;
	}
	
</style>

	<table style = "width:95%;margin:0 auto" border ="0">
		<tr>
			<td class="tdContent" valign="top" >
				
					<table  class = "milestoneTable1" style = "border-spacing:0;width: 100%;" border ="0">
						<tr>
							<td style="background-color: rgb(227, 230, 218); padding:0px;padding-bottom:40px;">
								
								<table style="border-spacing:0;width: 100%;" border="0">
									<tr >
										<td colspan="2">
											<div class = "label15" style="">PPMP ENTRY</div>
										</td>
										<td>
											<div class = "label15" style = "text-align: center;">PPMP ENCODED LIST</div>	
										</td>
									</tr>
									<tr>
											<td  id = "containerPPMPentries"   valign="top" style = "width:20px;background-color:rgb(248, 246, 243);padding:10px 5px;">																																																																																																			
														<table style = "margin-top:20px;border-spacing:0;display:no1ne;">
																		<tr>
																			<td><span class = "number">1</span><span class = "label2">Entry&nbsp;Type</span></td>
																			<td  style="padding:0px 10px;"> 
																				<select class = "select2" id  = "selectPPMPtype" onchange="selectCategory(this)"  >
																					<option></option>
																					<option>Regular</option>
																					<option>Previous Year </option>
																					<option>SB1</option>
																					<option>SB2</option>
																					<option>SB3</option>
																					<option>SB4</option>
																					<option>Infrastructure </option>
																				</select>
																			</td>
																		</tr>
																		<tr>
																			<td><span class = "number">2</span><span class = "label2">Fund</span></td>
																			<td  style="padding:0px 10px;"> 
																				<select class = "select2"  id  = "selectPPMPfund"  >
																					<option>General Fund</option>
																					<option>Trust Fund</option>
																					<option>SEF</option>
																					<option>Development Fund</option>
																				</select>
																			</td>
																		</tr>
																		<tr>
																			<td><span class = "number">3</span><span class = "label2">Program&nbsp;Code</span></td>
																			<td  style="padding:0px 10px;" id = "ppmpProgramContainer"> 
																				<select class = "select2"   onchange = "fetchPPMPbyProgram(this)">
																					<option></option>
																				</select>
																			</td>
																		</tr>
																		<tr>
																			<td><span class = "number">4</span><span class = "label2">Account&nbsp;Code</span></td>																				
																			<td  style="padding:0px 10px;"  id = "ppmpAccountContainer"> 
																				<select class = "select2"  >
																					<option></option>
																				</select>
																				
																			</td>
																		</tr>
																								
																		<tr>
																			<td><span class = "number">5</span><span class = "label2">Category</span></td>
																			<td  style="padding:0px 10px;"  id = "ppmpCategoryContainer" onchange = "clearSelected()"> 
																				<select class = "select2"  >
																					<option></option>
																				</select>
																			</td>
																		</tr>
																		<tr>
																			<td style="vertical-align: top"><span class = "number">6</span><span class = "label2">Select Item</span></td>
																			<td  style="padding-top:10px;"> 
																				<div  style = "font-family: arial;font-size: 12px;margin-left:5px; ">
																					<div onclick ="showItemSelect()" style = "cursor:pointer;color:black;font-weight: bold;text-align: right;padding-right: 10px;">&#9777; <font color ="green">SHOW </font>ITEM LIST</div>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td style="vertical-align: top"><input id = "itemId" type = 'hidden' /></td>
																			<td  style="padding-left:15px;padding-bottom: 5px;padding-top:2px;"> 
																				
																				<textarea ondblclick ="showItemSelect()"  id = "ppmpDescription"  style = "padding:10px;overflow:hidden; border:1px dashed grey; width:200px; min-height:160px;" readonly>
																					
																				</textarea>
																				
																			</td>
																		</tr>
																		<tr>
																			<td><span class = "number">8</span><span class = "label2">Measurement</span></td>
																			<td id = "ppmpUnitContainer"  style="padding:0px 10px;padding-top:10px;"> 
																				<select class = "select2"  >
																					<option></option>
																				</select>
																				
																			</td>
																		</tr>
																		<!--<tr>
																			<td style="vertical-align: top"><span class = "number">6</span><span class = "label2">Item Type</span></td>
																			<td  style="padding:0px 10px;padding-top:10px;"> 
																				
																				<div  id = "ppmpItemsContainer">
																					<select class = "select2"   id = "ppmpSelectItem" onchange = "selectItem(this)" >
																					<option></option>
																						<option></option>
																					</select>
																				</div>
																				<div>
																					<input disabled  id = "ppmpOtherItem" onkeyup="changePlaceHolder()"  placeholder="Type here if not listed above."  class = "select2" 
																					      style = "width:100%;border:0px;border-bottom:1px solid silver;display:none;"/>
																				</div>
																			</td>
																		</tr>
																		<tr>
																			<td style="vertical-align: top"><span class = "number">7</span><span class = "label2">Description</span></td>
																		        <td  style="padding:0px 10px;padding-top:10px;" > 
																				<textarea class = "select2" style = "padding-left:5px;min-height:120px;" id  = "ppmpDescription" disabled  >
																				
																				</textarea>
																			</td>
																		</tr>
																		<tr>
																			<td><span class = "number">8</span><span class = "label2">Measurement</span></td>
																			<td id = "ppmpUnitContainer"  style="padding:0px 10px;padding-top:10px;"> 
																				<select class = "select2"  >
																					<option></option>
																				</select>
																			</td>
																		</tr>-->
																		<tr>
																			<td><span class = "number">9</span><span class = "label2">Unit&nbsp;Cost</span></td>
																			<td  style="padding:0px 10px;"> 
																				<input  class = "select2" id  = "ppmpCost" maxlength="13"  onkeyup="keyInCost(this)"  onkeydown="return isAmount(this,event)" />
																			</td>
																		</tr>
														</table>
											</td>
											<td valign="top" style="width:20px;background-color:rgb(248, 246, 243);">
												<div style="padding-top:30px; display:no1ne;">
													<div><span class = "number">10</span><span class = "label2">Milestone / Qty</span></div>
																																																																																																																																									
															<table id = "milestoneTable2" class = "milestoneTable2" style="margin:10px;">
																	<tr>
																		<td ><span class = "label2">Jan</span></td><td><input class = "select2" style= "width:55px;"  maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																		<td ><span class = "label2">Jul</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																	</tr
																	<tr>
																		<td ><span class = "label2">Feb</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																		<td ><span class = "label2">Aug</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																		
																	</tr>
																	<tr>
																		<td ><span class = "label2">Mar</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																		<td ><span class = "label2">Sep</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																		
																	</tr>
																	<tr>
																		<td ><span class = "label2">Apr</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																		<td ><span class = "label2">Oct</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																		
																	</tr>
																	<tr>
																		<td ><span class = "label2">May</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																		<td ><span class = "label2">Nov</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																		
																	</tr>
																	<tr>
																		<td ><span class = "label2">Jun</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																		<td ><span class = "label2">Dec</span></td><td><input class = "select2" style= "width:55px;" maxlength = "6" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCost()" /></td>
																	</tr>
															</table>
															
													<div style = "text-align:right; padding:10px 5px;">
															<span class = "label2" style = "padding-right:20px;">Est. Total Cost</span>
															<div>
																<span  id  = "ppmpTotalCost" class = "label11" style = "font-size: 18px;margin-right: 10px;color:red;">0.00</span>
															</div>
													</div>
												</div>
												<div style = "margin:0 auto;width:65%;background-color:white;padding:20px; text-align:center;border-top:1px dashed rgb(128, 91, 69);">
													<span  class = "button2" style = "margin-right: 5px;font-size: 16px;" onclick = "savePPMP(this)" id = "savePPMPencode">Save</span>
													<span  style = "font-size: 16px;" class = "button2" onclick = "clearPPMP()">Clear</span>
												</div>
											</td>
											<td style="vertical-align: top;background-color:rgb(221, 218, 218);">
												<div id = "savedPPMPcontainer">
												</div>
											</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					
					<div style = "margin:0 auto;border:1px solid red;display:none;" >
						<div class = "label15">PREVIOUS PPMP</div>
						<table >
							<tr>
								<td style = "text-align: right;"><span>Program Code</span></td>
								<td style = "text-align: right;">
									<select  id = "selectByCode" onchange="selectPreviousPPMP(this)">
										<option></option>
										<option>1081</option>
										<option>1081-1</option>
										<option>1081-2</option>
									</select>
								</td>
								<td style = "text-align: right;"><span>Category</span></td>
								<td style = "text-align: right;">
									<select id  = "selectByCat" onchange="selectPreviousPPMP(this)">
										<option></option>
										<option>CAT 10</option>
										<option>CAT 44</option>
										<option>CAT 6</option>
									</select>
								</td>
							</tr>
						</table>
						<div  id  = "previousPPMPContainer" style = "width:800px;"></div>
					</div>
						
			</td>
		</tr>
	</table>

<script>
	whenRefreshProcurement();	
	function whenRefreshProcurement(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Procurement"){
			var cookieValue = readCookie("lastMain6").trim();
			var cookieText = cookieLabel(cookieValue,"ppmpMenuContainer");
			if(cookieText == "Encode"){
				preLoad();
			}
		}
	}
	function preLoad(){
		loader();
		var queryString = "?preLoad=1";
		var container = document.getElementById('ppmpProgramContainer');
		
		ajaxGetAndConcatenate1(queryString,processorLink,container,"preLoad");
	}
	function selectPreviousPPMP(me){
		var programCode = document.getElementById("selectByCode").value;
		var categoryCode = document.getElementById("selectByCat").value;
		var queryString = "?loadPPMPbyCode=1&programCode=" + programCode + "&categoryCode=" + categoryCode;
		var container = document.getElementById('previousPPMPContainer');
		loader();
		ajaxGetAndConcatenate1(queryString,processorLink,container,"loadPPMPbyCode");
	}
	var oldSelectValueAcct;
	var oldOptionAcct;
	var oldSelectValueCat;
	var oldOptionCat;
	
	var selectClickAcct = 0;
	var selectClickCat = 0;
	function changeValue(me){	
		var x = me.selectedIndex;
		var y = me.options;
		var value = y[x].text;
		if(me.id == "ppmpAcctCodeSelect"){
			var code  = value.substr(0,11);
			var desc = value.substr(13);
			
			oldSelectValueAcct = value;
			oldOptionAcct =  y[x];
			y[x].text = code;
		}else if(me.id == "ppmpCatSelect"){
			var code  = value.substr(0,9);
			var desc = value.substr(10);
			oldSelectValueCat = value;
			oldOptionCat =  y[x];
			y[x].text = code;
			
			//fetchItemsByCategory(me.value.trim());
			
		}
	}
	function restoreValueAccountCode(me){
		 if(oldOptionAcct){
		 	if(selectClickAcct == 1){
				oldOptionAcct.text = oldSelectValueAcct;
				selectClickAcct = 0;
			}else{
				selectClickAcct++;
			}
		}
	}
	function restoreValueCatCode(me){
		 if(oldOptionCat){
			if(selectClickCat == 1){
				oldOptionCat.text = oldSelectValueCat;
				selectClickCat = 0;
			}else{
				selectClickCat++;
			}
		}
	}
	
	
	/*function fetchItemsByCategory(categoryCode){
		loader();
		var queryString = "?fetchItemsByCategory=1&categoryCode=" + categoryCode;
		var container = document.getElementById('ppmpItemsContainer');
		ajaxGetAndConcatenate1(queryString,processorLink,container,"returnLoader");
		document.getElementById("ppmpOtherItem").value = "";
	}*/
	
	
	//fetchPPMPbyProgram(1)
	function fetchPPMPbyProgram(me){
		var programCode = me.value;
		//var programCode = 1081;
		//loader();
		var queryString = "?fetchPPMPbyProgram=1&programCode=" + programCode ;
		var container = document.getElementById("savedPPMPcontainer");
		ajaxGetAndConcatenate1(queryString,processorLink,container,"returnOnly");
	}
	function selectItem(me){
		
		var arr = me.value.split("~");
		document.getElementById("ppmpDescription").value = arr[1];
		document.getElementById("ppmpOtherItem").value = "";
		var unit  = arr[3];
		
		 var ind = document.getElementById("ppmpSelectUnit");
		 //setSelectedIndex(ind, unit);
		 
		//selectUnit.selectedIndex = 2;
		//alert(unit);
		
		var cost = arr[2];
		if(cost > 0){
			document.getElementById('ppmpCost').value = numberWithCommas(arr[2]);
			document.getElementById('ppmpCost').readOnly = true; 
		}else{
			document.getElementById('ppmpCost').value = "";
			document.getElementById('ppmpCost').readOnly = false; 
		}
		
	}
	function changePlaceHolder(){
		selectToIndexZero("ppmpSelectItem");
	}
	function calculateTotalCost(){
		var table = document.getElementById("milestoneTable2");
		var inputs = table.getElementsByTagName("INPUT");
		var qty = 0;
		for(var i = 0 ; i <  inputs.length; i++){
			var inputValue = inputs[i].value;
			if( isNumber(inputValue) ){
				qty = qty + parseInt(inputValue);
			}
		}
		var cost = parseFloat(document.getElementById("ppmpCost").value.replace(/,/g,""));
		var totalCost = cost * qty;
		document.getElementById("ppmpTotalCost").innerHTML =  numberWithCommas(totalCost.toFixed(2));;
	}
	function calculateTotalCostEdit(){
		var table = document.getElementById("tablePPMPedit1");
		
		var inputs = table.getElementsByTagName("INPUT");
		var qty = 0;
		
		for(var i = 0 ; i <  inputs.length; i++){
			var inputValue = inputs[i].value;
			if( isNumber(inputValue) ){
				qty = qty + parseInt(inputValue);
			}
		}
		
		var cost = parseFloat(document.getElementById("editCost").value.replace(/,/g,""));
		
		var totalCost = cost * qty;
		document.getElementById("editTotalCost").innerHTML =  numberWithCommas(totalCost.toFixed(2));;
	}
	function keyInCost(me){
		var num = me.value.replace(/,/g,"");
		me.value = numberWithCommas(num);
		if(me.id == "ppmpCost"){
			calculateTotalCost();
		}else{
			calculateTotalCostEdit();
		}
	}
	function savePPMP(me){
		if(me.textContent == "Save"){
			checkEmpty();
		}else{
			alert("Already locked for encoding. Please refer to budget office.");
		}
		
	}
	function savePPMPupdate(){
		checkEmptyUpdate();
	}
	
	function checkEmptyPPMP(container,obj,msg){
		var empty = 0;
		var inputs = container.getElementsByTagName(obj); 
		for(var i = 0; i < inputs.length ; i++){
			if(inputs[i].value.trim().length == 0 || inputs[i].value.trim() == 0  ){
				if(inputs[i].parentNode.children.length <= 1){ //filter para dili ma doble ang empty action
					if(empty == 0){
						if(msg){
							var qoute = document.createElement('span');
							qoute.className = 'qoute empty';
							qoute.innerHTML = '&nbsp;Please complete the required fields.';
							inputs[i].parentNode.appendChild(qoute);
						}
					}else{
						var mark = document.createElement('span');
						mark.className = 'labelX empty';
						mark.innerHTML = 'x';
						inputs[i].parentNode.appendChild(mark);
					}
					inputs[i].addEventListener("focus", removeInvalids);
					inputs[i].className += " inputTextEmpty";
				}
				empty++;
			}
		}
		return empty;
	}
	function removeInvalids(){
		clickInput1(this);
	}
	function clickInput1(me){
		var parent =  me.parentNode;
		var child = parent.children.length;
		if(child > 1 ){
			me.parentNode.removeChild(me.parentNode.children[1]);
		}
		me.className = "select2";
	}
	function filterMilestone(){
		var empty =0;
		var table = document.getElementById("milestoneTable2");
		var inputs = table.getElementsByTagName("input");
		var  updateCase = '';
		for(var i = 0; i < inputs.length; i++){
			if(inputs[i].value.length > 0){
				var cell = inputs[i].parentNode.cellIndex;
				var field =  inputs[i].parentNode.parentNode.children[cell-1].textContent;
				if(field == "Dec"){
					field = "Dex";
				}
				
				var v = inputs[i].value;
				updateCase += field + "=" + v +",";
			}
		}
		return updateCase.substr(0,updateCase.length-1);
	}
	function checktotalCost(){
		var total = document.getElementById("ppmpTotalCost").textContent.replace(/,/g,"");
		if(total <1){
			return 1;
		}else{
			return 0;
		}
	}
	function checktotalCostEdit(){
		var total = document.getElementById("editTotalCost").textContent.replace(/,/g,"");
		if(total < 1){
			return 1;
		}else{
			return 0;
		}
	}
	var itemName;
	function specialFilter(){
		var empty = 0;
		
		return 0;
	}
	function checkEmpty(){
		var table  = document.getElementById("containerPPMPentries");
		var empty = 0;
		empty += checkEmptyPPMP(table,"select",1);
		empty += checkEmptyPPMP(table,"input");
		empty += checkEmptyPPMP(table,"textarea");
		empty -= specialFilter();
		
		if(empty == 0){
			var emptyTotal = checktotalCost();
			if(emptyTotal == 0){
				
				//var arr = document.getElementById("ppmpSelectItem").value.split("~");
				var itemNo = document.getElementById("itemId").value;
				
				
				
				var desc = encodeURIComponent(document.getElementById("ppmpDescription").value.trim());
				//var itemName = desc;
				//var desc = encodeURIComponent(arr[1].trim());
				var type = document.getElementById("selectPPMPtype").value;
				var fund = document.getElementById("selectPPMPfund").value;
				var programCode = document.getElementById("ppmpProgramContainer").children[0].value;
				var code = document.getElementById("ppmpAccountContainer").children[0].value;
				var category = document.getElementById("ppmpCategoryContainer").children[0].value;
				
			
				var unit = document.getElementById("ppmpUnitContainer").children[0].value;
				var cost = document.getElementById("ppmpCost").value.replace(/,/g,"");
				
				var total = document.getElementById("ppmpTotalCost").textContent.replace(/,/g,"");
				
				var addCase = filterMilestone();
				
				loader();
				var queryString ="savePPMP=1&type=" + type + "&fund=" + fund + "&programCode=" + programCode+ "&code=" + code + "&category="+ category + "&itemNo=" + itemNo +  "&desc=" + desc + "&unit=" + unit + "&cost=" + cost  +"&total=" + total +   "&addCase=" + addCase;
				var container = '';
				ajaxPost1(queryString,processorLink, container,"savePPMP");
				
			} else{
				alert("Please input quantity in step 10.");
			}
		}
	}
	function checkEmptyUpdate(){
		
		var table  = document.getElementById("updatePPMPcontainer");
		var empty = 0;
		empty += checkEmptyPPMP(table,"select",1);
		empty += checkEmptyPPMP(table,"input",1);
		empty += checkEmptyPPMP(table,"textarea");
		
		if(empty == 0){
			
			var emptyTotal = checktotalCostEdit();
			
			if(emptyTotal == 0){
				
				
				
				
				var id = document.getElementById("editId").value;
				var type = document.getElementById("editType").value;
				var fund = document.getElementById("editFund").value;
				
				var programCode = document.getElementById("editProgram").value;
				var code = document.getElementById("editAccount").value;
				
				var category = document.getElementById("editCategory").value;
				
				var item =  encodeURIComponent(document.getElementById("editItem").textContent.trim());
				
				var desc = encodeURIComponent(document.getElementById("editDescription").value.trim());
				
				var unit = document.getElementById("editUnit").value;
				var cost = document.getElementById("editCost").value.replace(/,/g,"");
				var total = document.getElementById("editTotalCost").textContent.replace(/,/g,"");
				
				
				var jan = document.getElementById("jan").value;
				var feb = document.getElementById("feb").value;
				var mar = document.getElementById("mar").value;
				var apr = document.getElementById("apr").value;
				var may = document.getElementById("may").value;
				var jun = document.getElementById("jun").value;
				var jul = document.getElementById("jul").value;
				var aug = document.getElementById("aug").value;
				var sep = document.getElementById("sep").value;
				var oct = document.getElementById("oct").value;
				var nov = document.getElementById("nov").value;
				var dec = document.getElementById("dec").value;
				document.getElementById("messageBoxClose").click();
				
				loader();
				var queryString ="updatePPMP=1&id= " + id + "&type=" + type + "&fund=" + fund + "&programCode=" + programCode+ "&code=" + code + "&category="+ category + "&item=" + item + "&desc=" + desc + "&unit=" + unit + "&cost=" + cost  + "&total=" + total +  "&jan=" + jan +   "&feb=" + feb + "&mar=" + mar + "&apr=" + apr + "&may=" + may + "&jun=" + jun + "&jul=" + jul + "&aug=" + aug + "&sep=" + sep + "&oct=" + oct + "&nov=" + nov + "&dec=" + dec ; 
				var container = '';
				ajaxPost1(queryString,processorLink, container,"updatePPMP");
				
			} else{
				alert("Please input quantity in step 10.");
			}
		}
	}
	function trHover(me){
		me.style.backgroundColor = "rgb(228, 235, 237)";	
		var tds = me.getElementsByTagName("td");
		for(var i = 0 ; i <  tds.length; i++){
			tds[i].style.borderBottom = "2px solid rgb(252, 126, 139)";
		} 
	}
	function trHoverAdd(){
		this.style.backgroundColor = "rgb(228, 235, 237)";	
		var tds = this.getElementsByTagName("td");
		for(var i = 0 ; i <  tds.length; i++){
			tds[i].style.borderBottom = "2px solid rgb(252, 126, 139)";
		} 
	}	
	function trHoverOut(me){
		if(me.rowIndex % 2 == 0){
			me.style.backgroundColor = "rgb(249, 246, 241)";	
		}else{
			me.style.backgroundColor = "white";	
		}
		var tds = me.getElementsByTagName("td");
		for(var i = 0 ; i <  tds.length; i++){
			tds[i].style.borderBottom = "1px solid silver";
		} 
	}
	function trHoverOutAdd(){
		if(this.rowIndex % 2 == 0){
			this.style.backgroundColor = "rgb(249, 246, 241)";	
		}else{
			this.style.backgroundColor = "white";	
		}
		var tds = this.getElementsByTagName("td");
		for(var i = 0 ; i <  tds.length; i++){
			tds[i].style.borderBottom = "1px solid silver";
		} 
	}
	function deletePPMP(me){
		var answer = confirm("Confirm delete action?");
		if(answer){
			var id  = me.id;
			loader();
			var queryString ="?deletePPMP=1&ppmpId=" + id;
			var container = '';
			ajaxGetAndConcatenate1(queryString,processorLink, container,"deletePPMP");
		}
	}
	function clearPPMP(){
		var table = document.getElementById("milestoneTable2");
		var inputs = table.getElementsByTagName("INPUT");
		for(var i = 0 ; i <  inputs.length; i++){
			 inputs[i].value = "";
		}
		
		var cont = document.getElementById("containerPPMPentries");
		var select = cont.getElementsByTagName("select");
		for(var i = 0; i < select.length ; i++){
			selectToIndexZeroA(select[i]);
		}
		
		//document.getElementById("ppmpOtherItem").value = "";
		document.getElementById("ppmpCost").value = "";
		document.getElementById("ppmpTotalCost").innerHTML = "0.00";
		document.getElementById("ppmpDescription").value = "";
		
	}
	function appendTR(result){
		if(document.getElementById("savedPPMPtable")){
			var table = document.getElementById("savedPPMPtable").children[0];
			var maxId = parseInt(table.children[1].children[0].textContent)+1;
			var t = document.createElement("tr");
			t.className = "tdData";
			t.innerHTML =result;
			var id = t.children[18].children[0].id;
			t.id = "tr" +  id;
			t.style.backgroundColor ="rgb(253, 252, 218)";
			
			t.addEventListener("mouseover", trHoverAdd);
			t.addEventListener("mouseout", trHoverOutAdd);
			table.insertBefore(t, table.children[1]);
			table.children[1].children[0].children[0].innerHTML = maxId;

			var tr = table.children[1];
			tr.children[1].style.paddingLeft = "5px";
			tr.children[2].style.paddingLeft = "5px";
			for(var i = 0 ; i <  tr.children.length; i++){
				tr.children[i].style.borderBottom = "1px solid silver";
				
				if(i == 5 || i == 17){
					tr.children[i].style.borderLeft = "1px solid silver";
				}else{
					tr.children[i].style.borderLeft = "1px solid rgb(239, 237, 234)";
				}
			} 
		}else{
			//sa first entry
			
			var header = ""
			header += '<tr>';
			header += '<td class = "tdHeader" style = "width:10px;">&nbsp</td>';
			header += '<td class = "tdHeader" style = "text-align:left;">Fund</td>';
		
			header += '<td class = "tdHeader" style = "text-align:left;">Item</td>';
			header += '<td class = "tdHeader">Unit</td>';
			header += '<td class = "tdHeader">Cost</td>';				
					
			header += '<td class = "tdHeader">Jan</td>';
			header += '<td class = "tdHeader">Feb</td>';
			header += '<td class = "tdHeader">Mar</td>';
			header += '<td class = "tdHeader">Apr</td>';
			header += '<td class = "tdHeader">May</td>';
			header += '<td class = "tdHeader">Jun</td>';
			header += '<td class = "tdHeader">Jul</td>';
			header += '<td class = "tdHeader">Aug</td>';
			header += '<td class = "tdHeader">Sep</td>';
			header += '<td class = "tdHeader">Oct</td>';
			header += '<td class = "tdHeader">Nov</td>';
			header += '<td class = "tdHeader">Dec</td>';
			header += '<td class = "tdHeader">Total</td>';		
			header += '<td colspan = "2" class = "tdHeader"></td>';		
			header += '</tr>';
			var t = '<table id  = "savedPPMPtable" class = "savedPPMP" style = "width:100%;border-spacing:0;">' + header +'<tr class = "trData" style = "background-color:white;" onmouseover = "trHover(this)" onmouseout = "trHoverOut(this)">' + result + '</tr></table>';
			document.getElementById("savedPPMPcontainer").innerHTML = t;
			document.getElementById("savedPPMPtable").children[0].children[1].children[0].children[0].innerHTML = 1;
			var  id = document.getElementById("savedPPMPtable").children[0].children[1].children[0].id;
			
			document.getElementById(id).parentNode.id = "tr"+ id.replace("first","");
			
		}
	}
	
	function updatePPMP(me){
		
		var arr = me.id.split("-");
		var id = arr[0];
		var lock = arr[1];
		var rem = '';
		if(lock == 1){
			rem = "<span style ='color:red;font-size:14px;'> You can update PR informations only. Please refer to budget office.</span>";
			var locker = "disabled";
		}
		
		
		var tr = me.parentNode.parentNode;
		
		
		var programCode = tr.children[1].children[0].textContent;
		var accountCode = tr.children[1].children[1].textContent;
		var type = tr.children[1].children[2].textContent;
		
		var  tdItems =tr.children[2].children.length;
		if(tdItems> 2){
			var cat = tr.children[2].children[0].textContent;
			var item = tr.children[2].children[1].textContent;
			var desc = tr.children[2].children[2].textContent;
		}else{
			var cat = tr.children[2].children[0].textContent;
			var item = tr.children[2].children[1].textContent;
			var desc = tr.children[2].children[1].textContent;
		}
		var unit = tr.children[3].textContent;
		var cost = tr.children[4].textContent ;
		
		var jan = tr.children[5].textContent;
		var feb = tr.children[6].textContent;
		var mar = tr.children[7].textContent;
		var apr = tr.children[8].textContent;
		var may = tr.children[9].textContent;
		var jun = tr.children[10].textContent;
		var jul = tr.children[11].textContent;
		var aug = tr.children[12].textContent;
		var sep = tr.children[13].textContent;
		var oct = tr.children[14].textContent;
		var nov = tr.children[15].textContent;
		var dec = tr.children[16].textContent;
		
		var total = parseFloat(tr.children[17].textContent.replace(/,/g,""));
		
		

		var   x = '<table style = "border-spacing:0;" id = "tablePPMPedit">';
		        x += '	 <tr>';
		        x += '			<td><span class = "number">1</span><span class = "label2">Entry&nbsp;Type</span></td>';
		        x += '			<td  style="padding:0px 10px;">'; 
			x += '			<select ' + locker + ' class = "select2" id  = "editType"  >';
			x += '				<option>Regular</option>';
			x += '				<option>Previous Year</option>';
			
			x += '				<option>SB1</option>';
			x += '				<option>SB2</option>';
			x += '				<option>SB3</option>';
			x += '				<option>SB4</option>';
			x += '				<option>Infrastructure </option>';
			x += '			</select>';
			x += '		</td>';
			x += '	</tr>';
			
			 x += '     <tr>';
			 x += '	         <td><span class = "number">2</span><span class = "label2">Fund</span></td>';
			 x += '	         <td style="padding:0px 10px;">'; 
			 x += '		        <select ' + locker + '  class = "select2"  id  = "editFund"  >';
			 x += '			    <option>General Fund</option>';
			 x += '			    <option>Trust Fund</option>';
			 x += '			    <option>SEF</option>';
			 x += '			    <option>Development Fund</option>';
			 x += '		        </select>';
			 x += '	          </td>';
			 x += '      </tr>';
			
			 x += '     <tr>';
			 x += '	         <td><span class = "number">3</span><span class = "label2">Program</span></td>';
			 x += '	         <td  style="padding:0px 10px;">'; 
			 x += '		        <input ' + locker + ' class = "select2" id  = "editProgram" maxlength="13"  value = "' + programCode + '"  />';
			 x += '	         </td>';
			 x += '      </tr>';
			
			 x += '     <tr>';
			 x += '	         <td><span class = "number">4</span><span class = "label2">Account Code</span></td>';
			 x += '	         <td  style="padding:0px 10px;">'; 
			 x += '		        <input ' + locker + ' class = "select2" id  = "editAccount" maxlength="13"  value = "' + accountCode + '"  />';
			 x += '	         </td>';
			 x += '      </tr>';
			 
			 x += '     <tr>';
			 x += '	         <td><span class = "number">5</span><span class = "label2">Category</span></td>';
			 x += '	         <td  style="padding:0px 10px;">'; 
			 x += '		        <input class = "select2" id  = "editCategory" maxlength="13"  value = "' + cat + '"  />';
			 x += '	         </td>';
			 x += '      </tr>';
			 
			 x += '     <tr>';
			 x += '	         <td><span class = "number">6</span><span class = "label2">Item type</span></td>';
			 x += '	         <td  style="padding:0px 10px;">'; 
			 x += '		        <span  class = "select2" id  = "editItem" style ="width:188px;"   onclick = "alert(\'Please dump this entry and encode new for item correction.\')">' + item + '<span/>';
			 
			 x += '	         </td>';
			 x += '      </tr>';
			
			 x += '     <tr>';
			 x += '	         <td><span class = "number">7</span><span class = "label2">Description</span></td>';
			 x += '	         <td  style="padding:0px 10px;">'; 
			 x += '		        <textarea class = "select2" id = "editDescription" >' + desc +  '</textarea>';
			 x += '	         </td>';
			 x += '      </tr>';
			
			 x += '     <tr>';
			 x += '	         <td><span class = "number">8</span><span class = "label2">Measurement</span></td>';
			 x += '	         <td  style="padding:0px 10px;">'; 
			 x += '		        <input class = "select2" id  = "editUnit" maxlength="13"  value = "' + unit + '"  />';
			 x += '	         </td>';
			 x += '      </tr>';
			 
			 x += '     <tr>';
			 x += '	         <td><span class = "number">9</span><span class = "label2">Cost</span></td>';
			 x += '	         <td  style="padding:0px 10px;">'; 
			 x += '		        <input ' + locker + ' class = "select2" id  = "editCost" maxlength="13"   onkeyup="keyInCost(this)"  onkeydown="return isAmount(this,event)"   value = "' + cost + '" style = "color:red;"/>';
			 x += '	         </td>';
			 x += '      </tr>';
			 x += '      </table>';
			 
			 
		  var y = '<div style = "margin-top:20px;"><span class = "number" style = "padding:0;">10</span><span class = "label2">Quantity</span></div>';
		 	y += '  <table id = "tablePPMPedit1" class = "" style="margin:10px;margin-top:0;" border ="0">';
			y += '  		<tr>';
			y += '  			<td ><span class = "label2">Jan</span></td><td><input ' + locker + ' id = "jan" value = "' +  toNothing(jan) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
			y += '  			<td ><span class = "label2">Jul</span></td><td><input ' + locker + ' id = "jul" value = "' + toNothing( jul) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
			y += '  		</tr>';
			y += '  		<tr>';
			y += '  			<td ><span class = "label2">Feb</span></td><td><input ' + locker + ' id = "feb" value = "' +  toNothing(feb) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
			y += '  			<td ><span class = "label2">Aug</span></td><td><input ' + locker + ' id = "aug" value = "' +  toNothing(aug) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
						
			y += '  		</tr>';
			y += '  		<tr>';
			y += '  			<td ><span class = "label2">Mar</span></td><td><input ' + locker + ' id = "mar" value = "' +  toNothing(mar) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
			y += '  			<td ><span class = "label2">Sep</span></td><td><input ' + locker + ' id = "sep"value = "' +  toNothing(sep) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
						
			y += '  		</tr>';
			y += '  		<tr>';
			y += '  			<td ><span class = "label2">Apr</span></td><td><input ' + locker + ' id = "apr" value = "' +  toNothing(apr) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
			y += '  			<td ><span class = "label2">Oct</span></td><td><input ' + locker + ' id = "oct" value = "' +  toNothing(oct) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
			y += '  		</tr>';
			y += '  		<tr>';
			y += '  			<td ><span class = "label2">May</span></td><td><input ' + locker + ' id = "may" value = "' +  toNothing(may) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
			y += '  			<td ><span class = "label2">Nov</span></td><td><input ' + locker + ' id = "nov" value = "' +  toNothing(nov) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
						
			y += '  		</tr>';
			y += '  		<tr>';
			y += '  			<td ><span class = "label2">Jun</span></td><td><input ' + locker + ' id = "jun" value = "' + toNothing( jun) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
			y += '  			<td ><span class = "label2">Dec</span></td><td><input ' + locker + ' id = "dec" value = "' +  toNothing(dec) + '" class = "select2" maxlength = "5" onkeydown="return isAmount(this,event)" onkeyup="calculateTotalCostEdit()" /></td>';
			y += '  		</tr>';
			y += '  </table>';
			
			y += '	<div style = "text-align:right; padding:10px 5px;">';
			y += '			<span class = "label2" style = "padding-right:20px;">Est. Total Cost</span>';
			y += '			<div>';
			y += '				<span  id  = "editTotalCost" class = "label11" style = "font-size: 18px;margin-right: 10px;color:red;">' + numberWithCommas(total.toFixed(2)) + '</span>';
			y += '			</div>';
			y += '	</div>';
			
			y += '	<div style = "margin:0 auto;width:65%;background-color:white;padding:20px; text-align:center;border-top:1px dashed rgb(128, 91, 69);">';
			y += '		<span class = "button2" style = "margin-right: 5px;font-size: 16px;" onclick = "savePPMPupdate()">Update</span>';
			y += '		<input type = "hidden" id = "editId" value = "' +id + '"/>';
			
			y += '	</div>';
		
	
			 			
		var  table = '<div style = "font-weight:bold;padding:2px;">Update Information : ' + rem + '</div>'; 			
		       table += '<table style = "background-color:rgb(245, 249, 233);padding:0px 20px;padding-bottom:10px;border:1px solid silver;" >';
		       table += '<tr><td id = "updatePPMPcontainer">' + x + '</td><td style = "vertical-align:top;">' +  y + '</td></tr>';	
		       table += '</table>';				
		msg(table);
	}
	//showItemSelect();
	function showItemSelect(){
		var category = document.getElementById("ppmpCatSelect").value;

		if(category){
			loader();
			var queryString ="?generateItemSelect=1&category=" + category;
			var container = '';
			ajaxGetAndConcatenate(queryString,processorLink, container,"generateItemSelect");
		}else{
			alert("No category selected.");
		}
	}
	function selectThisItem(me){
		
		var cat = me.id;
		
		var unit = me.children[0].children[0].value;
		
		var itemNo = me.children[1].textContent;
		var description = me.children[2].textContent;
	
		var price = me.children[3].textContent;
		var ind = document.getElementById("ppmpSelectUnit");
			
		setSelectedIndex(ind, unit);
		
		document.getElementById("ppmpDescription").value = description;
		document.getElementById("editorX").click();
		document.getElementById("ppmpCost").value = price;
		document.getElementById("itemId").value = itemNo;
		
		
		document.getElementById("ppmpCategoryContainer").children[0].value = cat;
		
	
	}
	function clearSelected(){
		document.getElementById('ppmpDescription').value = '';
		var ind = document.getElementById("ppmpSelectUnit");
		setSelectedIndex(ind, 0);
		document.getElementById("ppmpCost").value = '';
		
		
		var cat  = document.getElementById("ppmpCatSelect").value;
		if(cat == "CAT 44" || cat == "CAT 13"){
			document.getElementById("ppmpCost").readOnly = true;
		}else{
			document.getElementById("ppmpCost").readOnly = false;
		}
	}
	function searchKeywordPPMP(me,event){
		document.getElementById("ppmpItemCat").innerHTML = "";
		loader();
		var queryString ="?searchPPMPitems=1&keyword=" + encodeURIComponent(me.value);
		var container = document.getElementById("pppmpItemSelectTable");
		ajaxGetAndConcatenate(queryString,processorLink, container,"searchPPMPitems");
	}
	function selectCategory(me){
		if(me.value == "Infrastructure"){
			var s  = document.getElementById("ppmpCategoryContainer").children[0];
			setSelectedIndexByValue(s);
		}
	}
	function setSelectedIndexByValue(s) {
	    for ( var i = 0; i < s.options.length; i++ ) {
	        if (s.options[i].text.substring(0,7) == "CAT 100") {
	            s.options[i].selected = true;
	            return;
	        }
	    }
	}
	function goToPrintCATItems(cat,des,year) {
		var queryString = "?cat=" + cat + "&des=" + des + "&year=" + year;	
		window.open("../interface/formPPMPCatItems.php" + queryString);
	}
</script>




