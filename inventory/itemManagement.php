<style>
	.select2{
		width:230px;	
		//margin-left:5px;
		margin-left:0px !important;
		font-family:Oswald;
		font-size: 12px;
		//color:rgb(0, 97, 142);
		padding:5px 2px;
	}

	.selectCategoryonEntryList{
		width:152px;	
		//margin-left:5px;
		margin-left:0px !important;
		font-family: arial;
		font-size: 12px;
		//color:rgb(0, 97, 142);
	}

	#ItemManagementViewContainer1 .tdData{
		font-family: arial;
		font-size: 12px;
		color:rgb(0, 97, 142);
	}
	#ItemManagementViewContainer .tdHeader{
		//background-color: rgb(115, 112, 106);
		background: rgb(225, 92, 51) none repeat scroll 0% 0%;
		background-color: rgb(221, 216, 182);
		border-left:1px solid rgb(175, 173, 170);
		color:black;
		font-weight: bold;
	}
	

	.label2 {
		font-family: oswald;
		font-size: 15px;
	}

	.checkbox1{
		//visibility: hidden;
		cursor: pointer;
		border:5px solid grey !important;
	}

	.tdBorderLeftandRight,  .tdBorderFilterView {
		border-left:1px solid rgb(228, 226, 222);
		border-right:1px solid rgb(228, 226, 222);
		border-bottom:1px solid rgb(228, 226, 222);	
		//padding-right: 15px;
		border:0;
	}
	.label2{
		font-size:13px;	
	}
	

</style>
<div style = "background-color: white;min-width:1100px;margin:0 auto;padding:1px;box-shadow: 0px 0px 10px 1px grey;">
	<table style = "width:100%;background-color:rgb(239, 243, 221);padding:1px; border-spacing:5px;" border ="0">
		<tr>
		<td id="EntryForm" style="vertical-align:top; display: none1;"> 								
					<table id = "ItemEntryDiv" style="border-spacing: 3;  border:1px solid rgb(228, 226, 222);background-color:rgb(237, 239, 229);width:380px;">
						<tr style=" ">
							<td colspan="2" style="padding:5px; background: rgb(158, 156, 156);padding-left:15px;font-weight:bold;">
								<span class="label2" style="color:white">ADD ENTRY</span>
							</td>
						</tr>
						<tr>
							<td class="tdBorderLeftandRight" style="border:0;width:115px; ">
								<span class = "number">&nbsp;1</span>
								<span style = "font-size: 14px; font-family:Oswald;" >Category</span>
							</td>
							<td   id = "ViewCategoriesonEntry" class="tdBorderLeftandRight" style="padding:2px;padding-top:10px;">
								<select class = "select2" >
									<option>&nbsp;</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class="tdBorderLeftandRight" style="">
								<span class = "number">&nbsp;2</span>
								<span class="label2" >Description</span>
							</td>
							<td class="tdBorderLeftandRight" style="padding: 2px;">
								<!--<input  class = "select2" id  = "itemRDescription"  />-->
								<textarea class = "select2" id  = "itemRDescription"  style="min-height:100px;font-size:18px;">
								</textarea>
								
							</td>
						</tr>
						
						<tr>
							<td class="tdBorderLeftandRight" style="">
								<span class = "number">&nbsp;3</span>
								<span class="label2" >Classification</span>
							</td>
							<td class="tdBorderLeftandRight" style="padding: 2px;">
								<select class="select2"  id="itemEntryClassificationView">
									<option></option>
									<option>Expensable</option>
									<option>Semi-Expensable</option>
									<option>Non Expensable</option>
								</select>
							</td>
						</tr>
						
						<!--<tr>
							<td class="tdBorderLeftandRight" style=" ;">
								<span class = "number">&nbsp;4</span>
								<span class="label2">Economic Life</span>
							</td>
							<td class="tdBorderLeftandRight" style="padding:2px">
								<input  class = "select2" id  = "itemEconomicLife"   value="0"/>
							</td>
						</tr>-->
						
						<tr>
							<td class="tdBorderLeftandRight" style="">
								<span class = "number">&nbsp;4</span>
								<span class="label2">Unit</span>
							</td>
							<td   id = "itemPurchasedUnit" class="tdBorderLeftandRight" style="padding:2px;">
								<select class = "select2"  style ="font-size: 14px;">
									<option></option>
								</select>
							</td>
						</tr>
						<!--<tr>
							<td class="tdBorderLeftandRight" style="">
								<span class = "number">&nbsp;6</span>
								<span class="label2">Unit of Release</span>
							</td>
							<td   id = "itemReleasedUnit" class="tdBorderLeftandRight" style="padding: 2px;">
								<select class = "select2" >
									<option></option>
								</select>
							</td>
						</tr>-->
						
						<!--<tr>
							<td class="tdBorderLeftandRight" style="">
								<span class = "number">&nbsp;7</span>
								<span class="label2" >Quantity</span>
							</td>
							<td class="tdBorderLeftandRight" style="padding: 2px;">
								<input maxlength="6" class = "select2" id  = "itemOrder"  value = "0"  />					
							</td>
						</tr>-->
						
						<!--<tr>
							<td class="tdBorderLeftandRight" style="">
								<span class = "number">&nbsp;8</span>
								<span class="label2" >Reorder Unit</span>
							</td>
							<td class="tdBorderLeftandRight" style="padding: 2px;">
								<input maxlength="6" class = "select2" id  = "itemReOrderUnit" value="0"  />
							</td>
						</tr>-->
						
						<tr>
							<td class="tdBorderLeftandRight" style="">
								
									<span class = "number">&nbsp;5</span>
									<span class="label2" >Estimated Price</span>
								
							</td>
							<td class="tdBorderLeftandRight" style="padding: 2px;">
								<input  class = "select2" id  = "itemEstimatedPrice" maxlength="13" onkeyup ="toKama(this)" style="padding-left:5px;font-weight: bold;font-size: 16px;letter-spacing:1px;" />
							</td>
						</tr>
					<!--	<tr>
							<td class="tdBorderLeftandRight" style="">
								<span class = "number">10</span>
								<span class="label2">Reorder Point</span>
							</td>
							<td class="tdBorderLeftandRight" style="padding: 2px;">
								<input  class = "select2" id  = "itemReOrderPoint" value = "0"  />
							</td>
						</tr>-->
						<tr>
							<td class="tdBorderLeftandRight" style="">
								<span class = "number">&nbsp;6</span>
								<span class="label2">Date&nbsp;Canvassed</span>
							</td>
							<td class="tdBorderLeftandRight" style="padding: 2px;">
								<input  class = "select2" id  = "dateCanvass" value = "<?php echo date('Y-m-d'); ?>" style="padding-left:5px;font-weight: bold;font-size: 14px;letter-spacing:1px;"/>
							</td>
						</tr>
						<tr>
							<td></td>
							<td  style="text-align: center;  font-family: oswald; padding:5px; ">
							<span  style = "font-size: 16px; font-weight: normal;margin-right:10px;" class = "button2" onclick = "clearItemEntry()">Clear</span>			
								<span class = "button2" style = " font-weight: normal; margin-right: 5px;padding:5px 15px;font-size: 16px;" onclick = "saveItemEntry()">Save</span>
												
							</td>
						</tr>
					</table>
 			</td>
			<td id="datatableContainer" style ="vertical-align:top;min-width:800px;">
				<div id = "ItemManagementViewContainer" style = "border:1px solid silver;min-height:600px;background-color:rgb(250, 244, 244);">
				</div>
			</td>
			<td  style = "vertical-align: top;width:10px;background-colo1r:rgb(181, 144, 117);padding:25px 10px;">
				<table  style = "border:0px solid silver;border-spacing: 0;" >
					<tr id="itemManagementView">
							<tr>
								<td style=" background-color: rgb(233, 223, 181); padding-left:5px; border:1px solid silver;border-bottom:0;">
									<span class = "number">1</span>
									<span class="label2">Search Description</span>
								</td>
							</tr>

							<tr style = "background-color:rgb(223, 224, 219);">
								<td  style="border:1px solid rgb(228, 226, 222);padding:10px;border:1px solid silver;border-top:0; ">
									<input class = "select2" style = "font-family:Oswald; text-transform: uppercase;margin:0 auto;text-align: center;font-weight:bold;letter-spacing: 1px;font-size: 15px;" onkeypress=" keypressAndWhat1(this,event,searchViewItemList,1)"/>
								</td>
							</tr>

							<tr>
								<td><div style="margin-top:10px;"></div></td>
							</tr>

							<tr style="background-color: rgb(233, 223, 181);">
								<td style = "padding-left:5px;border:1px solid silver;border-bottom:0;">
									<span class = "number">2</span>
									<span class="label2">Search Criteria</span>
								</td>

							</tr>
							<tr style = "background-color:rgb(223, 224, 219);">
								<td class="tdBorderFilterView" style="padding-left:15px;padding-top:10px;border-left:1px solid silver; border-right:1px solid silver;border-top:0;border-bottom:0; ">
									<span class="label2">Category</span>
								</td>
							</tr>
							<tr style = "background-color:rgb(223, 224, 219);">
								<td   id = "ViewCategories" class="tdBorderFilterView" style="padding: 0px 8px;border-left:1px solid silver; border-right:1px solid silver;border-top:0;border-bottom:0;"> 
									<select class = "select2" >
										<option>&nbsp;</option>
									</select>
								</td>	
							</tr>
							<tr style = "background-color:rgb(223, 224, 219);">
								<td class="tdBorderFilterView" style="padding-left:15px;border-left:1px solid silver; border-right:1px solid silver;border-top:0;border-bottom:0;">
									<span class="label2">Classification</span>
								</td>
							</tr>
							<tr style = "background-color:rgb(223, 224, 219);">
								<td class="tdBorderFilterView" style="padding: 0px 8px; padding-bottom:10px; border:1px solid silver;border-top:0;">
									<select class="select2"  id = "itemClassificationOnView" onchange="reAlterValue(this)">
										<option></option>
										<option>Expensable</option>
										<option>Semi-Expsensable</option>
										<option>Non Expensable</option>
									</select>
								</td>
							</tr>
						
							<tr>
								<td><div style="margin-top:10px;"></div></td>
							</tr>
							<tr style="background-color: rgb(233, 223, 181);">
								<td style = "padding-left:5px;border:1px solid silver;border-bottom:0;">
									 <span class = "number">3</span> 
									<span class="label2" style="">Print Selection</span>
								</td>
							</tr>
							<tr style = "background-color:rgb(223, 224, 219);">
								<td class="tdBorderFilterView" style="padding-left:15px;padding-top:5px;border-left:1px solid silver; border-right:1px solid silver;border-top:0;border-bottom:0;">
									<span class="label2">Category</span>
								</td>
							</tr>
							<tr style = "background-color:rgb(223, 224, 219);">
								<td   id = "ViewCategories3" style="border-bottom: 0px; padding: 0px 10px;border-left:1px solid silver; border-right:1px solid silver;border-top:0;border-bottom:0;"> 
									<select class = "select2" >
										<option>&nbsp;</option>
									</select>
								</td>	
							</tr>	
							<tr style = "background-color:rgb(223, 224, 219);">
								<td style="text-align: center; font-family: oswald; padding: 10px; border:1px solid silver;border-top:0;" class="tdBorderFilterView">
									<span class = "button2" style = " font-weight: normal; width:70px; font-size: 15px;" onclick = "PrintThis()">Print Preview</span>					
								</td>
							</tr>
							<tr>
								<td><div style="margin-top:10px;"></div></td>
							</tr>
							<tr style="background-color: rgb(233, 223, 181);">
								<td style = "padding-left:5px;border:1px solid silver;border-bottom:0;">
									 <span class = "number">4</span> 
									<span class="label2" >Add Entry</span>
								</td>
							</tr>
							<tr style = "background-color:rgb(223, 224, 219);">
								<td style="text-align: center; font-family: oswald; padding: 10px; border:1px solid silver;border-top:0;">
									<span class = "button2" style = "width:70px; font-weight: normal;  font-size: 15px;" onclick = "showFormPanel()">Show Form</span>					
								</td>
							</tr>
					</tr>
				</table>
			</td>
		</tr>
		
	</table>
			
</div>
	<span  id = "UnitReleaseId"  style="display: none;"></span>
	<span  id = "UnitIssueId"  style="display: none;"></span>
<script>

	whenrefreshInventory();
	
	function whenrefreshInventory(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		
		if(cookieMainText == "Inventory"){
			DataConveyedonManagement();
			/*if(cookieText == "Management"){
				alert(1);
				//loadForumMessages();
			}*/
		}
	}

	
	

	function DataConveyedonManagement() {
		
		var queryString = "?ItemManagementReload=1";
		loader();
		var container = '';
		ajaxGetAndConcatenate1(queryString,processorLink,container,"ItemManagementReload");
	}
	function createPPMPunitsDropDown(unitValue){
		var unit = JSON.parse(unitValue);
		var unitX = unit['unit'];
		var	sheetReleased  = '<select id = "editReleasedunit" class = "select2" >';
		var sheetIssue = '<select id = "editpurchasedunit" class = "select2" >';
		var sheet = '';
			//sheet += 	'<option></option>';
		for(var i=0; i < unitX.length; i++) {
			sheet += '	<option style = "color:black;">'+unitX[i]+'</option>';
		}	
		sheet += 	'</select>';

		sheetReleased = sheetReleased + sheet;
		sheetIssue = sheetIssue + sheet;

		document.getElementById('UnitReleaseId').innerHTML = sheetReleased;
		document.getElementById('UnitIssueId').innerHTML = sheetIssue;
	}
	
	function checkifEmptyField(container,obj,msg){
		var empty = 0;
		var inputs = container.getElementsByTagName(obj); 
		for(var i = 0; i < inputs.length ; i++){

			if (inputs[i].id != 'editReorderUnit' && inputs[i].id != 'editReorderPoint' && inputs[i].id != 'itemReOrderUnit' && inputs[i].id != 'itemReOrderPoint' && inputs[i].id  != 'itemEconomicLife' && inputs[i].id != 'editEconomiclife' &&  inputs[i].id != 'itemOrder' &&  inputs[i].id != 'itemEstimatedPrice' &&  inputs[i].id != 'editReorderPoint'  &&  inputs[i].id != 'editEstimatedPrice'  &&  inputs[i].id != 'editOrder') {
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
		}
		return empty;
	}




	function showFormPanel(){
		var html = '';
		var display;
		var div = document.getElementById('EntryForm');
		div.style.display = '';
		var div1 = document.getElementById('datatableContainer');
		div1.style.width = '100% auto;';//'683.9px';
		var div2 = document.getElementById('ItemManagementViewContainer');
		div2.innerHTML = '';
	}


	var oldSelectValueCat;
	var oldOptionCat;
	var selectClickCatforView = 0;
	function reAlterValue(me){	
		var x = me.selectedIndex; 
		var y = me.options;
		var value = y[x].text;
		//var classification = document.getElementById('itemClassificationOnView').value;
		var category = document.getElementById('ViewCategories').children[0].value;
		
		//var entrycategory = document.getElementById('ViewCategoriesonEntry').children[0].value;//ViewCategoriesonEntry 
		
		
		var div = document.getElementById('EntryForm');
			div.style.display = 'none';
		var substring = '';
		if (me.id == "itemCategorySelectonView"){

			var code  = value.substr(0,9);
			var cat = code.trim();
			var desc = value.substr(10);
			oldSelectValueCat = value;
			oldOptionCat =  y[x];
			y[x].text = code;
			DisplaythisCategory(cat);
		} else if (me.id == "itemClassificationOnView") {
			var itemclass = value;
			DisplaythisClassification(itemclass, category);
		} 
	}
	var selectCategoryValue;
	var oldOptionCategory;
	var selectClickCatEntry = 0;
	function rechangeVal(me){	
		var x = me.selectedIndex;
		var y = me.options;
		var value = y[x].text;
		if (me.id == "itemEntryCategory"){
			var code  = value.substr(0,9);
			var cat = code.trim();
			var desc = value.substr(10);
			selectCategoryValue = value;
			oldOptionCategory =  y[x];
			y[x].text = code;
			fetchCategoryonAddEntry(cat);
		}	
	}
	var selectCategoryValueThree;
	var oldOptionCategoryThree;
	var selectClickCatEntryThree = 0;
	function rechangeThisValue(me){	
		var x = me.selectedIndex;
		var y = me.options;
		var value = y[x].text;
		if (me.id == "itemEntryCategory"){
			var code  = value.substr(0,9);
			var cat = code.trim();
			var desc = value.substr(10);
			selectCategoryValueThree = value;
			oldOptionCategoryThree =  y[x];
			y[x].text = code;
		}	
	}
	function revertBackValue(me) {
		 if(oldOptionCat) {
			if(selectClickCatforView == 1){
				oldOptionCat.text = oldSelectValueCat;
				selectClickCatforView = 0;
			}else{
				selectClickCatforView++;
			}
		 }
	}
	function retraceValue(me){
		if(oldOptionCategory){
			if(selectClickCatEntry == 1){
				oldOptionCategory.text = selectCategoryValue;
				selectClickCatEntry = 0;
			}else{
				selectClickCatEntry++;
			}
		}
	}
	function retraceValue3(me){
		if(oldOptionCategoryThree){
			if(selectClickCatEntryThree == 1){
				oldOptionCategoryThree.text = selectCategoryValueThree;
				selectClickCatEntryThree = 0;
			}else{
				selectClickCatEntryThree++;
			}
		}
	}
	function DisplaythisCategory(category){
		var queryString = "?ListOutCategory=1&category="+ category;
		loader();
		var container = document.getElementById("ItemManagementViewContainer");
		ajaxGetAndConcatenate1(queryString,processorLink,container,"ListOutCategoryandItemClassification");
	}
	function DisplaythisClassification(itemclassification,category){
		var queryString = "?ListOutItemClassification=1&itemclassification="+ itemclassification + "&category=" + category;
		loader();
		var container = document.getElementById("ItemManagementViewContainer");
		ajaxGetAndConcatenate1(queryString,processorLink,container,"ListOutCategoryandItemClassification");
	}
	function searchViewItemList(me) {
		var key  = me.value;
		var div = document.getElementById('EntryForm');
		div.style.display = 'none';
		//if (key.length > 2) {
			loader();
			var queryString = "?searchViewItemList=1&key=" + key;
			var container = document.getElementById("ItemManagementViewContainer");
			ajaxGetAndConcatenate1(queryString,processorLink,container,"searchViewItemList");	
		/*} else {
			alert("Must be more than 2 characters long.");
		}	*/
	}
	function fetchCategoryonAddEntry(me){
		var category = me;
		//loader();
		var queryString = "?ListOutCategory=1&category="+ category;
		var container = document.getElementById("ItemManagementViewContainer");
		ajaxGetAndConcatenate1(queryString,processorLink,container,"returnOnly");
	}
	function saveItemEntry() {
		checkThis();	
	}
	function checkThis() {
		var table  = document.getElementById("ItemEntryDiv");
		var empty = 0;
		empty += checkifEmptyField(table,"select",1);
		empty += checkifEmptyField(table,"input");

		if(empty == 0){

			var category = document.getElementById('ViewCategoriesonEntry').children[0].value;
			var description = encodeURIComponent(document.getElementById('itemRDescription').value.trim());
			var classification = document.getElementById('itemEntryClassificationView').value;
			//var economiclife = document.getElementById('itemEconomicLife').value; 

			//var purchasedunit = document.getElementById('itemPurchasedUnit').value;
			var purchasedunit = document.getElementById('itemPurchasedUnit').children[0].value;
			//var releasedunit = document.getElementById('itemReleasedUnit').value;
			//var releasedunit = document.getElementById('itemReleasedUnit').children[0].value;
			//var order = document.getElementById('itemOrder').value;
			//var reorderunit = document.getElementById('itemReOrderUnit').value;
			var estimatedprice = toZero(document.getElementById('itemEstimatedPrice').value.replace(/,/g,""));
			//var reorderpoint = document.getElementById('itemReOrderPoint').value;
			var date = document.getElementById("dateCanvass").value;

			if (description.length > 2) {
				loader();
				var queryString  = "saveItemEntry=1&category=" + category + "&description=" + description + "&classification=" + classification + "&purchasedunit=" + purchasedunit + "&estimatedprice=" + estimatedprice + "&date=" + date;
				var container = '';
				
				ajaxPost1(queryString,processorLink,container,"saveItemEntry");	
			} else {
				alert("Description Field Must be more than 2 characters long.");	
			}
	
		} 
	}

	function putZeroValueIfEmpty(me){
		if (me.value.trim().length == 0 || me.value.trim() == 0 ) {
			me.value = 0;
		}
	}







	function HoverIn(me){
		me.style.backgroundColor = "rgb(228, 235, 237)";	
		var tds = me.getElementsByTagName("td");
		for(var i = 0 ; i <  tds.length; i++){
			tds[i].style.borderBottom = "2px solid rgb(252, 126, 139)";
		} 
	}

	function HoverOut(me){
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


	function trHoverAdd(){
		this.style.backgroundColor = "rgb(228, 235, 237)";	
		var tds = this.getElementsByTagName("td");
		for(var i = 0 ; i <  tds.length; i++){
			tds[i].style.borderBottom = "2px solid rgb(252, 126, 139)";
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

	function putCommas(me){
		if (me.value.trim().length == 0 || me.value.trim() == 0 ) {
			me.value = 0;
		}
		var num = me.value.replace(/,/g,"");
		me.value = numberWithCommas(num);
	}

	function clearItemEntry(){
		var cont  = document.getElementById("ItemEntryDiv");
		var select = cont.getElementsByTagName("select");
		for(var i = 0; i < select.length ; i++){
			selectToIndexZeroA(select[i]);
		}

		document.getElementById('itemRDescription').value = "";
		//document.getElementById('itemEconomicLife').value = "0"; 
		document.getElementById('itemPurchasedUnit').value = "";
		//document.getElementById('itemReleasedUnit').value = "";
		//document.getElementById('itemOrder').value = "0";
		//document.getElementById('itemReOrderUnit').value = "";
		document.getElementById('itemEstimatedPrice').value = "0";
		//document.getElementById('itemReOrderPoint').value = "0";
	}

	function appendItemEntryList(result){
		if(document.getElementById("ItemEncodeEntry")){
			
			var table = document.getElementById("ItemEncodeEntry").children[0];
			var maxId = parseInt(table.children[2].children[0].textContent)+1;
			
			var t = document.createElement("tr");
			t.className = "tdData";
			t.innerHTML =result;
			
			
			
			var id = t.children[1].innerHTML;
			

			t.id = "tr" +  id;
			t.style.backgroundColor ="rgb(253, 252, 218)";
			
			t.addEventListener("mouseover", trHoverAdd);
			t.addEventListener("mouseout", trHoverOutAdd);
			table.insertBefore(t, table.children[2]);
			table.children[2].children[0].children[0].innerHTML = maxId;
			

			/*var tr = table.children[1];
			tr.children[1].style.paddingLeft = "5px";
			tr.children[2].style.paddingLeft = "5px";
			for(var i = 0 ; i <  tr.children.length; i++){
				tr.children[i].style.borderBottom = "1px solid silver";
				tr.children[i].style.borderLeft = "1px solid rgb(239, 237, 234)";
			} */
			
		}else{
			//sa first entry
			var header = ""
			header += '<tr>';
			header += '<td class = "tdHeader" style = "width:10px;">&nbsp</td>';
			header += '<td class = "tdHeader" style = "text-align:left;">Item</td>';
			header += '<td class = "tdHeader">Description</td>';		
			header += '<td class = "tdHeader">Classification</td>';				
			//header += '<td class = "tdHeader">Economic Life</td>';
			header += '<td class = "tdHeader">Unit of Issue</td>';
			//header += '<td class = "tdHeader">Unit of Release</td>';
			//header += '<td class = "tdHeader">Quantity</td>';
			//header += '<td class = "tdHeader">Reorder Unit</td>';	
			header += '<td class = "tdHeader">Estimated Price</td>';
			//header += '<td class = "tdHeader">Reorder Point</td>';		
			header += '<td colspan = "2" class = "tdHeader"></td>';	
			header += '</tr>';	

			var t = '<table id  = "ItemEncodeEntry" class = "ItemEncodeEntry" style = "font-family: Oswald;font-size: 12px;width:100%;border-spacing:0;">' + header +'<tr class = "trData" style = "background-color:white;" onmouseover = "trHover(this)" onmouseout = "trHoverOut(this)">' + result + '</tr></table>';
			
			
			document.getElementById("ItemManagementViewContainer").innerHTML = t;
			document.getElementById("ItemEncodeEntry").children[0].children[1].children[0].children[0].innerHTML = 1;
			var  id = document.getElementById("ItemEncodeEntry").children[0].children[1].children[0].id;
			document.getElementById(id).parentNode.id = "tr"+ id.replace("first","");
		}

	}


	function ifEmptyValuesetZero(value){
		var valNew;
		if(value.trim().length == 0 || value.trim() == 0 ){
			valNew = 0;
		} else {
			valNew = value;
		}
		return valNew;
	}

	function updateThisSelectedRow(me) {

		var id = me.id;
	
		var tr = me.parentNode.parentNode;
		var itemId = tr.children[1].innerHTML;
		var desc = tr.children[2].innerHTML;
		var classification = tr.children[3].innerHTML;
		var unit = tr.children[4].innerHTML;
		var price = toEmpty(tr.children[5].innerHTML.trim());
		var canvassDate = tr.children[6].innerHTML;
		//var category = document.getElementById("itemCategoryMan").textContent;
		
		var category = me.parentNode.children[1].value;
		
		
		/*
		var description = tr.children[2].textContent;
		var classification = tr.children[3].textContent;
		//var economiclife = ifEmptyValuesetZero(tr.children[4].textContent);
		var purchasedunit = tr.children[5].textContent;
		//var releasedunit = tr.children[6].textContent;
		//var order = ifEmptyValuesetZero(tr.children[7].textContent);
		//var reorderunit = tr.children[8].textContent;
		var estimatedprice = ifEmptyValuesetZero(tr.children[9].textContent);
		var reorderpoint = ifEmptyValuesetZero(tr.children[10].textContent);
		var dateCanvassed = ifEmptyValuesetZero(tr.children[11].textContent);
		*/
		/*
		var  x = '<table style = "border-spacing:2px;" id = "tableItemManagementUpdate" border ="0">';
		     
		     x += '     <tr>';
			 x += '	         <td><span class = "number">1</span> <span class = "label2">Category</span></td>';
			 x += '	         <td  style="padding:0px 5px;">';
			 x += '		        <input class = "select2" id  = "editCategory" maxlength="13"  value = "'+category+'"  />';
			 x += '	         </td>';
			 x += '      </tr>';

			 x += '     <tr>';
			 x += '	         <td><span class = "number">2</span> <span class = "label2">Description</span></td>';
			 x += '	         <td  style="padding:0px 5px;">';
			// x += '		        <input class = "select2" id  = "editDescription"   value = "'+description+'"  />';
			 x += '		        <textarea id  = "editDescription"  class = "select2" style = "height:200px;">' + description  + '</textarea>';
			 x += '	         </td>';
			 x += '      </tr>'
				
			 x += '     <tr>';
			 x += '	         <td><span class = "number">3</span> <span class = "label2">Classification</span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		        <select class = "select2"  id  = "editClassification"  >';
			 x += '				<option>Expensable</option>';
			 x += '				<option>Semi-Expensable</option>';
			 x += '				<option>Non Expensable</option>';
			 x += '		        </select>';
			 x += '	          </td>';
			 x += '      </tr>';
			
			 x += '     <tr>';
			 x += '	         <td><span class = "number">4</span> <span class = "label2">Economic life</span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		        <input class = "select2" id  = "editEconomiclife"   value = "'+economiclife+'" onkeyup="putZeroValueIfEmpty(this)" />';
			 x += '	         </td>';
			 x += '      </tr>';
			
			 x += '     <tr>';
			 x += '	         <td><span class = "number">5</span> <span class = "label2">Unit of Issue</span></td>';
			
			 x += '			<td style="padding:0px 5px;">';
			 x += 				document.getElementById('UnitIssueId').innerHTML;
			 x += '			</td>';

			 x += '      </tr>';
			
		
				
			 x += '		<tr>';
			 x += '	        <td><span class = "number">6</span> <span class = "label2">Unit of Release</span></td>';
			 x += '			<td style="padding:0px 5px;">';
			 x +=				 document.getElementById('UnitReleaseId').innerHTML;
			 x += '			</td>';
			 x += '		</tr>';
			

			 x += '     <tr>';
			 x += '	         <td><span class = "number">7</span> <span class = "label2">Quantity</span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		        <input maxlength="6" class = "select2" id  = "editOrder"  value = "'+order+'" onkeyup="putZeroValueIfEmpty(this)" />';
			 x += '	         </td>';
			 x += '      </tr>';
			
			 x += '     <tr>';
			 x += '	         <td><span class = "number">8</span> <span class = "label2">Reorder Unit</span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		        <input maxlength="6" class = "select2" id  = "editReorderUnit"  value = "'+reorderunit+'"  "/>';
			 x += '	         </td>';
			 x += '      </tr>';
					
			 x += '     <tr>';
			 x += '	         <td><span class = "number">9</span> <span class = "label2">Estimated Price</span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		        <input class = "select2" id  = "editEstimatedPrice"   maxlength="13"  onkeyup="putCommas(this)" value = "'+estimatedprice+'"  />';
			 x += '	         </td>';
			 x += '      </tr>';
					  

			 x += '     <tr>';
			 x += '	         <td><span class = "number">10</span> <span class = "label2">Reorder Point</span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		        <input class = "select2" id  = "editReorderPoint"  value = "'+reorderpoint+'" onkeyup="putZeroValueIfEmpty(this)"  />';
			 x += '	         </td>';
			 x += '      </tr>';
			 
			 x += '     <tr>';
			 x += '	         <td><span class = "number">11</span> <span class = "label2">Date Canvassed</span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		        <input class = "select2" id  = "dateCanvassed"  value = "'+dateCanvassed+'"   />';
			 x += '	         </td>';
			 x += '      </tr>';
					 
			 x += '      </table>';
			 
	
			 			
		var    table = '<div style = "font-weight:bold;padding:2px; font-family:Oswald;">Update Information</div>'; 			
		       table += '<table style = "background-color:rgb(245, 249, 233);padding:0px 20px;padding-bottom:10px;border:1px solid silver; font-family:Oswald;" >';
		       table += '<tr><td id = "updateItemManagementContainer">' + x + '</td></tr>';	//<td style = "vertical-align:top;">' +  y + '</td>
		       table += "<input type = 'hidden' id = 'editItemId' value = '"+id+"'/>";
		       table += '</table>';				

		closeAndUpdateModal(table);*/
		
		var  x = '<table style = "border-spacing:2px;" id = "tableItemManagementUpdate" border ="0">';
		     
		     x += '     <tr>';
			 x += '	         <td><span class = "number">1</span> <span class = "label2">Category</span></td>';
			 x += '	         <td  style="padding:0px 5px;">';
			 x += '		        <input class = "select2" id  = "editCategory" maxlength="13"  value = "'+category+'"  />';
			 x += '	         </td>';
			 x += '      </tr>';
			
			 x += '     <tr>';
			 x += '	         <td><span class = "number">2</span> <span class = "label2">Unit of Measurement</span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		    <select class = "select2"  id  = "editUnit"  >';
			 x += '				<option>' + unit + '</option>';
			 x += 				document.getElementById('editReleasedunit').innerHTML;
			 x += '		        </select>';
			 x += '	          </td>';
			 x += '      </tr>';	
			
			 x += '     <tr>';
			 x += '	         <td><span class = "number">3</span> <span class = "label2">Description</span></td>';
			 x += '	         <td  style="padding:0px 5px;">';
			
			 x += '		        <textarea id  = "editDescription"  class = "select2" style = "height:200px;">' + desc  + '</textarea>';
			 x += '	         </td>';
			 x += '      </tr>'
				
			 x += '     <tr>';
			 x += '	         <td><span class = "number">4</span> <span class = "label2">Classification</span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		        <select class = "select2"  id  = "editClassification"  >';
			 x += '				<option>' + classification + '</option>';
			 x += '				<option>Expensable</option>';
			 x += '				<option>Semi-Expensable</option>';
			 x += '				<option>Non Expensable</option>';
			 x += '		        </select>';
			 x += '	          </td>';
			 x += '      </tr>';
			 
			 
			
			 
			  x += '     <tr>';
			 x += '	         <td><span class = "number">5</span> <span class = "label2">Estimated Price </span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		        <input class = "select2" style = "font-weight:bold;letter-spacing:1px;padding-left:7px;" id  = "editPrice"  value = "'+price+'" onkeydown="return isAmount(this,event)" onkeyup="toKama(this)"   />';
			 x += '	         </td>';
			 x += '      </tr>';
			 
			 x += '     <tr>';
			 x += '	         <td><span class = "number">6</span> <span class = "label2">Date Canvassed</span></td>';
			 x += '	         <td  style="padding:0px 5px;">'; 
			 x += '		        <input class = "select2" id  = "editCanvass" style = "letter-spacing:1px;padding-left:7px;" value = "'+canvassDate+'"   />';
			 x += '	         </td>';
			 x += '      </tr>';
			 x += '      </table>';
			 
		
			 			
		var    table = '<div style = "font-weight:bold;padding:2px; font-family:Oswald;">Update Information</div>'; 			
		       table += '<table style = "background-color:rgb(245, 249, 233);padding:0px 20px;padding-bottom:10px;border:1px solid silver; font-family:Oswald;" >';
		       table += '<tr><td id = "updateItemManagementContainer">' + x + '</td></tr>';	//<td style = "vertical-align:top;">' +  y + '</td>
		       table += "<input type = 'hidden' id = 'editItemId' value = '"+id+"'/>";
		       table += '</table>';				

		closeAndUpdateModal(table);
	}

	function closeAndUpdateModal(message) {
		var sheet = "<div class = 'editorContainer'><table class='editorTable' border ='0'>";
			sheet += "<tr><td class = 'tdMessage' >" + message.trim() + "</td>";
			sheet += "</tr>";
			sheet += "<tr style = 'background-color:white;'><td colspan = '2' style = 'text-align:center;'><span class='closeButton' id='closeButton' style='font-size:16px; font-family: oswald;  border-bottom: 1px solid silver; border-right: 1px solid silver; background-color: rgb(230, 237, 241); padding: 10px;  cursor:pointer;' onclick ='closeAbsolute(this)'>Cancel</span>&nbsp;&nbsp;<span class='updateButton' style='font-size:16px; font-family: oswald;  border-bottom: 1px solid silver; border-right: 1px solid silver; background-color: rgb(230, 237, 241); padding:10px;  cursor:pointer;' onclick= 'updateMe()'>Update</span>";
			sheet += "</td></tr></table></div>";
		
		theAbsolute(sheet);
		document.getElementById('absoluteHolder').style.zIndex = 106;
	}


	function updateMe(){
		
		checkEmptyFieldonUpdateItems();
	}


	function checkEmptyFieldonUpdateItems() {
		
		var table = document.getElementById('updateItemManagementContainer');
			
		var empty = 0;
			//empty += checkifEmptyField(table,"select",1);
			//empty += checkifEmptyField(table,"input",1);
			var editCategory = document.getElementById('editCategory').value;	
			if (editCategory.length > 4) {
				var editItemId = document.getElementById('editItemId').value;
				
				
				var editDescription = encodeURIComponent(document.getElementById('editDescription').value);
				
				if(editDescription.length > 5){
					var editClassification = document.getElementById('editClassification').value;
					
					if(editClassification.length > 5){
						var editpurchasedunit = document.getElementById('editUnit').value;
						
						if(editpurchasedunit.length > 2){
							var dateCanvassed = document.getElementById('editCanvass').value;
							var editEstimatedPrice = toZero(document.getElementById('editPrice').value.replace(/,/g,""));
							document.getElementById("closeButton").click();
							loader();
							var queryString  = "updateItemManagementItems=1&id=" + editItemId + "&editCategory=" + editCategory +"&editDescription=" + editDescription + "&editClassification=" + editClassification;
								queryString +=  "&editpurchasedunit=" + editpurchasedunit;
								queryString +=  "&editEstimatedPrice=" + editEstimatedPrice + "&dateCanvassed=" + dateCanvassed;
							var container = '';
							ajaxPost1(queryString,processorLink, container,"updateItemManagementItems");
						}else{
							alert("Please select unit.");
						}
					}else{
						alert("Please select classification.");
					}
					
					
				}else{
					alert("Item description too short.");
				}
				
				
				
			}else{
				alert("Invalid category code.");
			}
	}
	
	
	
	function PrintThis(){
		var empno = '<?php echo $_SESSION['employeeNumber'] ?>';
		var cat = document.getElementById('itemOnPdf').value;
		
		var strWindowFeatures = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
		window.open("../inventory/pdfItemManagement.php?cat="+cat+"&empno="+empno,'Item Management Form',strWindowFeatures);
	}
	function deleteThisSelectedRow(me){
		var item = me.parentNode.parentNode.children[2].textContent;
		var  id  = me.id;
		var answer = confirm("You are about to delete  : " + item);
		if(answer){
			 me.parentNode.parentNode.style.display ="none";
			loader();
			var queryString = "?deleteThisSelectedRow=1&id="+ id + "&item=" + item;
			var container = "";
			ajaxGetAndConcatenate(queryString,processorLink,container,"deleteThisSelectedRow");
		}
		
	}
	function selectUnitManagement(me){
		/*var unit = me.value;
		 var ind = document.getElementById("itemReleasedUnit").children[0];
		 setSelectedIndex(ind, unit);*/
		
	}
	function toKama(me){
		var x = me.value.replace(/,/g,"");
		me.value = numberWithCommas(x);
	}
	
</script>






















