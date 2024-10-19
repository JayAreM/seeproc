<style>
	#divCtrl{
		background-color:white;
		display:inline-block;
		color:rgb(0, 145, 248);
		border-radius:50%;
		height:20px;
		width:20px;
		padding:4px;
		font-size:18px;
		position:absolute;
		margin-left:8px;
		border-left:1px solid grey;
	}
	.td4{
		background-color:rgb(29, 121, 161);
		padding:5px 2px;
	}
	.td3{
		padding:5px 2px;
		border-bottom: 1px solid silver;
	}
	.label7tracker{ 
		font-size: 16px;	
		color:white;
		font-weight: bold;
	}
	.label5tracker{
		font-family: sans-serif;
		font-size:12px;
		text-overflow:nowrap;
		white-space: nowrap;
	}
	.numberPrivate{
		border-radius:10px;
		font-size: 14px;
		font-style: italic;
	}
	.trHover{
		
		cursor: pointer;	
	}
	.splitButton{
		background-color:silver;
		color:black;
		border-radius:2;
		padding:5px 10px;	
		margin-left:20px;
		cursor:pointer;
		font-weight:bold;
		letter-spacing: 1px;
	}
	.splitButton:hover{
		border-bottom:1px solid silver;
		border-right:1px solid silver;
		border-top:1px solid grey;
		border-left:1px solid grey;
		color:white;
		background-color:grey;
	}
	.slider{
		border-radius: 0px 3px 3px 0px;
		border-right:1px solid white;
		margin-bottom:5px; 
		
		border-bottom:0px solid silver;
		padding:2px 5px;
		background-color:rgb(240, 241, 241);
		 background: linear-gradient(to right, white , rgb(233, 238, 239));
		text-overflow:nowrap;
		white-space: nowrap;
		text-align: right;
		font-family: Oswald;
		color:grey;
		font-size: 13px;
		
	}
	.sliderSelected{
		border-right:1px solid white;
		margin-bottom:5px; 
		font-size: 17px;
		border-bottom:0px solid silver;
		padding:2px 5px;
		padding-left: 30px;
		color:white;
		font-weight: bold;
		 background: linear-gradient(to right, white ,rgb(42, 130, 154));
		text-overflow:nowrap;
		white-space: nowrap;
		text-align: right;
		font-family: Oswald;
		
	}
	.sliderSelectedPending{
		border-right:1px solid white;
		margin-bottom:5px; 
		font-size: 17px;
		border-bottom:0px solid silver;
		padding:2px 5px;
		
		padding-left: 30px;
		color:white;
		font-weight: bold;
		 background: linear-gradient(to right, white ,rgb(224, 34, 44));
		text-overflow:nowrap;
		white-space: nowrap;
		text-align: right;
		font-family: Oswald;
		
	}
	.numberSliderNone{
		display:inline-block;
		width:20px;
		height:20px;
		border:2px solid white;
		border-radius: 50%;
		margin:2px 2px;
		font-size: 12px;
		color:rgb(49, 134, 157);
		text-align: center;
	
		background-color: rgb(164, 179, 184);
		background-color: rgb(237, 240, 241);
		//box-shadow: 0px 0px 5px 5px rgb(36, 117, 154) inset;
	}
	.numberSlider{
		display:inline-block;
		width:20px;
		height:20px;
		border:3px solid white;
		border-radius: 50%;
		margin:2px 0px;
		font-size: 12px;
		color:white;
		text-align: center;
		
		//box-shadow: 0px 0px 5px 5px rgb(36, 117, 154) inset;
	}
	.hoverSupplier{
		font-family: Oswald;
		font-size: 18px;
		border: 0;
		
		width:450px;
	}
	.hoverSupplier:hover{
		font-weight: normal;
		background-color: rgb(196, 238, 248);
		cursor: pointer;
		
	}
	#prItemEdit tr:nth-child(even){
		background-color: rgb(228, 231, 232);
	}
	.remarkOffice, .remarkCreated{
		text-align: right;
		font-size: 12px;
		font-family: NOR;
	}
	.remarkMessage{
		background-color: rgb(237, 237, 226);
		padding:5px;
	}
	.remarkOffice{
		border-top:1px solid rgba(206, 222, 230,.5);
	}
	.remarkCreated{
		font-size: 11px;
	}
	#infraPaymentHistory td{
		border-left:1px solid rgb(232, 234, 235);
		border-bottom:1px solid rgb(232, 234, 235);
	}
	#infraPaymentHistory tr:hover td{
		background-color: rgb(252, 244, 196);
	}

	.pxItemSelect {
		/* cursor:pointer; */
		transition:.2s ease-in-out;
	}
	/* .pxItemSelect:hover {
		background-color:white;
	} */

</style>

<div style = "padding:40px; min-width: 650px;">

	<table id = "" border ="0" style = "width:100%;margin-bottom:15px;">
		<tr>
			<td colspan="3" style = "text-align:right;">
				<span class = "data1" style = "margin-right:5px;font-size:18px;" >Search TN# or Claimant</span>
				<input id  ="ok" class = "text3" maxlength="18" style = "width:200px;font-weight: bold;font-family:oswald; padding:2px 5px; font-size: 22px;text-align:center;" onkeydown="keypressAndWhatClear(this,event,searchTracking,1)" value = '' />
			</td>
		</tr>
	</table>
	<table border= "0" >
		<tr>
				<td style = "display:no1ne;vertical-align: top;text-align: right;" >
					<div  id = "sliderStatus" style = "">
					</div>
				</td>
				<td style="vertical-align: top;">
					<div id = "doctrackUpdateContainer" style = "">
						
						
						
					</div>	
				</td>
		</tr>
	</table>
	
</div>

<script>

	function saveAPFundRevertedTN(me) {

		var trackingNumber = document.getElementById('fundRevertTN').textContent.trim();
		var remarks = document.getElementById('fundRevertReason').value.trim();

		var queryString = "?saveAPFundRevertedTN=1&trackingNumber=" + trackingNumber + "&remarks=" + encodeURIComponent(remarks);    
		var container = document.getElementById('doctrackUpdateContainer');	

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"saveAPFundRevertedTN");

	}

	function cancelFundReverted(me) {
		var trackingNumber = me.id.trim();

		var sheet = '';

		sheet +='<div class="editorContainer">'
			+'	<table border="0" cellpadding="0" class="editorTable" style="font-family:Oswald; border-spacing:0px;">'
			+'		<tr style="background-color:rgb(234, 59, 149); color:white;">'
			+'			<td class="editorHeader" style="background-color:transparent;">Fund Revert Transaction<span id="fundRevertTN" style="font-weight:bold; font-size:20px; margin-left:5px;">'+trackingNumber+'</span></td>'
			+'			<td style="padding-right:10px; padding-top:2px; text-align:center; width:0px;"><div onclick="closeAbsolute(this)" class="closeEditor" style="margin:0px auto;"></div></td>'
			+'		</tr>'
			+'		<tr>'
			+'			<td colspan="2" style="padding:20px 40px 20px 40px;">'
			+'				<div style="font-weight:bold; padding-left:8px;">Remarks</div>'
			+'				<textarea class="select2" id="fundRevertReason" style="padding:10px; width:350px; height:120px; font-size:16px;"></textarea>'
			+'			</td>'
			+'		</tr>'
			+'		<tr>'
			+'			<td style="padding-bottom:20px;">'
			+'				<div id="" class="button1 b1" onclick="saveAPFundRevertedTN()">Save</div>'
			+'			</td>'
			+'		</tr>'
			+'	</table>'
			+'</div>';

		theAbsolute(sheet);
	}

	function saveAllTNsRemark(me){
		var tn =  me.id;
		var value = encodeURIComponent(remValue.value);
		var trackType = document.getElementById('trackType').textContent.trim().replace(' -', '');

		var queryString = "?saveAllTNsRemark=1&tn=" + tn + "&value=" + value+ "&type=" + trackType;
		var container = document.getElementById('doctrackUpdateContainer');
		
		ajaxGetAndConcatenate(queryString,processorLink,container,"saveAllTNsRemark");
		closeAbsolute(1);
		loader();
	}

	function createRemarkAllTNs(me) {
		var trackingNumber = me.id.replace('remarksNote', '');
		remarks1("Add Remark","Remark",trackingNumber,"saveAllTNsRemark(this)");
	}

	// function cancelFundReverted(me) {

	// 	var trackingNumber = me.id.trim();

	// 	var answer = confirm("Are you sure?");
	// 	if(answer){
	// 		var queryString = "?cancelFundReverted=1&trackingNumber=" + trackingNumber;    
	// 		var container = document.getElementById('doctrackUpdateContainer');	

	// 		loader();
	// 		ajaxGetAndConcatenate(queryString,processorLink,container,"cancelFundReverted");
	// 	}

	// }

	function clickNFContractorInEdit(me) {

		var contractor = me.value;
		var allow = 0;

		var trackingNumber = document.getElementById('nfConTN').value.trim();
		var oldValue = document.getElementById('nfConOld').value.trim();

		var queryString = "?editNFContractor=1&trackingNumber=" + trackingNumber + "&contractor=" + encodeURIComponent(contractor) + "&oldValue=" + encodeURIComponent(oldValue);    
		var container = document.getElementById('doctrackUpdateContainer');	

		closeAbsolute(me);

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"editNFContractor");

	}

	function shortSrchContractor(me) {
		var key = me.value.trim().toUpperCase();

		var list = document.getElementById('nfConSelList').children;
		for (let i = 0; i < list.length; i++) {
			var contractor = list[i].textContent.trim().toUpperCase();
			if(contractor.indexOf(key) !== -1) {
				list[i].style.display = ""; 
			}else {
				list[i].style.display = "none"; 
			}
		}

	}

	function goUpdateDRRMO(me) {
		var trackingNumber = me.id.replace("editor","");
		var oldValue = document.getElementById('hiddens').value;
		var newValue = document.getElementById('drrmoSelect').value;

		var queryString = "?goUpdateDRRMO=1&trackingNumber="+trackingNumber+"&newValue="+newValue+"&oldValue="+oldValue;
		var container = "";	
			
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"goUpdateDRRMO");
	}

	function editDRRMO(me) {
		var trackingNumber = me.id.replace("editor","");
		var queryString = "?editDRRMO=1&trackingNumber=" + trackingNumber;
		var container = "";	
				
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"editDRRMO");
	}


	function updateFundCorrected(me) {
		var trackingNumber = me.id.replace("button","");
		var queryString = "?updateFundCorrected=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');	
				
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"updateFundCorrected");
	}

	function updateFundCorrection(me) {
		var trackingNumber = me.id.replace("button","");
		var queryString = "?updateFundCorrection=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');	
				
		// updateTrackingStatus
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"updateFundCorrection");
	}

	function itemSequence(me) {
		var trackingNumber = me.id.replace('prSeq', '');
		window.open('../interface/itemsSequence.php?tn='+trackingNumber, '_new');
	}

	function updateDateTagTaxifier(me) {

		var trackingNumber = me.id.replace('button', '');

		var queryString = "?updateDateTagTaxifier=1&tn="+trackingNumber;
		var container = '';

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"updateDateTagTaxifier");

	}

	function alertAIRForm() {
		alert('To print the ACCEPTANCE & INSPECTION REPORT. \n Go to the INVENTORY system.');
	}

	//--------------------------------------------------------------------------------------------------------------WAGES PARTICULARS EDIT - START

	function updateNewRETENTION(me) {
		var table = document.getElementById('updateRETTable');
		var totalRetention = document.getElementById('updateRETTotal');
		var trS = table.children[0].children;

		var trackingNumber = me.id.replace('updateRET','');

		var newTotal = 0;
		var details = "";
		for (var i = 1; i <= (trS.length - 3); i++) {

			var chkbox = trS[i].children[0].children[0];
			var poTN = trS[i].children[1].textContent;
			var poNumber = trS[i].children[2].textContent;
			// var invNumber = trS[i].children[3].children[0].value;
			// var invDate = trS[i].children[4].children[0].value;
			var invNumber = trS[i].children[3].textContent;
			var invDate = trS[i].children[4].textContent;
			var retention = parseFloat(trS[i].children[5].textContent.replace(/,/g,""));

			if(chkbox.checked == true) {
				details += "*j*"+poTN+'~j~'+poNumber+'~j~'+invNumber+'~j~'+invDate+'~j~'+retention;
			}

		}

		var total = parseFloat(document.getElementById('updateRETTotal').textContent.replace(/,/g,""));

		if(total > 0) {
			var formData = new FormData();
			formData.append('updateNewRETENTION', 1);
			formData.append('details', encodeURIComponent(details.substring(3)));
			formData.append('total', total);
			formData.append('trackingNumber', trackingNumber);

			loader();
			ajaxFormUpload(formData, processorLink, 'updateNewRETENTION');
		}else {
			alert("Please select at least one(1) PO to proceed.");
		}
		

	}

	function newRETChangeTotalInEdit() {
		var table = document.getElementById('updateRETTable');
		var totalRetention = document.getElementById('updateRETTotal');
		var trS = table.children[0].children;

		var newTotal = 0;
		for (var i = 1; i <= (trS.length - 3); i++) {

			var chkbox = trS[i].children[0].children[0];
			var retention =  parseFloat(trS[i].children[5].textContent.replace(/,/g,""));

			if(chkbox.checked == true) {
				newTotal += retention;
			}

		}

		totalRetention.innerHTML = numberWithCommas( round2(trimTwoDecimals(newTotal)) );

	}

	function openRetentionEditor(me){
		var tn = me.id.replace('newRET', '');
		var queryString = "?editRetention=1&tn="+tn;
		var container = "";
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"editRetention");
	}

	function editParticularsForThisWGS(me) {

		var trackingNumber = me.id.replace('editor', '');
		// var explanation = me.parentNode.parentNode.children[0].children[0].textContent.trim();
		var explanation = document.getElementById('wgsNewExplanation').textContent.trim();

		var sheet = " <div class='editorContainer'>"
					+"	<table border='0' style='padding:20px; border-spacing:0px;'>"
					+"		<tr>"
					+"			<td class='editorHeader'>Edit Particulars</td>"
					+"			<td class='editorHeader'><div onclick='closeAbsolute(this)' id='wgsPartCloser' class='closeEditor'></div></td>"
					+"		</tr>"
					+"		<tr>"
					+"			<td colspan='2' style='text-align:left; padding:10px 0px 10px 0px;'>"
					+"				<textarea id='updatedWGSParticulars' style='font-family:mainFont; font-size:16px; min-width:500px; max-width:540px; min-height:120px; padding:10px 10px;'>"+explanation+"</textarea>"
					+"			</td>"
					+"		</tr>"
					+"		<tr>"
					+"			<td colspan='2' style='padding-top:10px;'>"
					+"				<div id='editor"+trackingNumber+"' class='button1 b1' style='width:70px; font-size:18px;' onclick='updateWGSParticulars(this)'>Update</div>"
					+"			</td>"
					+"		</tr>"
					+"	</table>"
					+"</table>";

		theAbsolute(sheet);							

	}

	function updateWGSParticulars(me) {

		var trackingNumber = me.id.replace('editor', '');
		var particulars = document.getElementById('updatedWGSParticulars').value.trim();

		var queryString = "?updateWGSParticulars=1&tn="+trackingNumber+"&particulars="+encodeURIComponent(particulars);
		var container = '';

		document.getElementById('wgsPartCloser').click();

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"updateWGSParticulars");


	}


	//--------------------------------------------------------------------------------------------------------------WAGES PARTICULARS EDIT - END

	//--------------------------------------------------------------------------------------------------------------UPDATE GAS ACCOUNT NUMBER - START

	function goUpdateGas(me){
		
		var trackingNumber = me.id.replace('gasAcct', '');
		var oldAccount = document.getElementById('hiddens').value.trim();
		var newAccount = document.getElementById('newGasAccount').value.trim();

		var queryString = "?goUpdateGas=1&trackingNumber="+trackingNumber+"&newAccount="+newAccount+"&oldAccount="+oldAccount;
		var container = '';

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"goUpdateGas");
	}

	//--------------------------------------------------------------------------------------------------------------UPDATE GAS ACCOUNT NUMBER - END


	//--------------------------------------------------------------------------------------------------------------PARTICULARS EDIT PX - START

	function editParticularsForThisPX(me) {

		var trackingNumber = me.id.replace('editor', '');
		var queryString = "?editParticularsForThisPX=1&tn="+trackingNumber;
		var container = '';

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"editParticularsForThisPX");

	}

	function updatePXParticulars(me) {

		var trackingNumber = me.id.replace('editor', '');
		var particulars = document.getElementById('updatedPXParticulars').value;
		var queryString = "?updatePXParticulars=1&tn="+trackingNumber+"&particulars="+encodeURIComponent(particulars);
		var container = '';

		document.getElementById('pxPartCloser').click();

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"updatePXParticulars");

	}

	//--------------------------------------------------------------------------------------------------------------PARTICULARS EDIT PX - START

	//--------------------------------------------------------------------------------------------------------------MANPOWER - START

	function editManpower(me) {

		var parent = me.parentNode.parentNode;
		var fieldName = parent.querySelector('.genDtlLabel').textContent.trim();
		var oldValue = me.parentNode.parentNode.children[1].textContent.trim();

		var trackingNumber = me.id.replace('editor', '');
		var queryString = "?editManpower=1&trackingNumber="+trackingNumber+"&field="+fieldName+"&old="+oldValue;
		var container = "";

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"editManpower");

	}

	function goUpdateManpower(me) {

		var field = me.id.replace('editor', '');
		var temp = field.split("*");
		var fieldName = temp[0];
		var trackingNumber = temp[1];

		var person = document.getElementById('newPerson').value.trim();
		var oldPerson = document.getElementById('oldPerson').value.trim();

		if(person.trim().length > 0) {
			var queryString = "?goUpdateManpower=1&field="+fieldName+"&trackingNumber="+trackingNumber+"&person="+ encodeURIComponent(person)+"&oldPerson="+ encodeURIComponent(oldPerson);
			var container = document.getElementById('doctrackUpdateContainer');

			var closer = document.getElementsByClassName('closeEditor');
			closer[0].click();

			ajaxGetAndConcatenate(queryString,processorLink,container,"goUpdateManpower");
		}else {
			alert('Please select a person.');
		}

	}

	//--------------------------------------------------------------------------------------------------------------MANPOWER - END
	
	
	//--------------------------------------------------------------------------------------------------------------TRANSFER TO TAXIFIER - START

	function transferToTaxifier(me) {
		var trackingNumber = me.id.replace('toTaxify', '');
		var queryString = "?transferToTaxifier=1&trackingNumber="+trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"transferToTaxifier");
	}

	//--------------------------------------------------------------------------------------------------------------TRANSFER TO TAXIFIER - END


	//--------------------------------------------------------------------------------------------------------------PO Edit Nature and Specifics - START

	function goUpdateNatureAndSpecifics(me) {
		var trackingNumber =  me.id.replace("editor","");
		var nature = document.getElementById('newNatureOfPayment').value;
		var specifics = document.getElementById('newSpecifics').value;
		var error = 0;

		if(nature == "") {
			error = 1;
		}else if(specifics == "") {
			error = 2;
		}

		if(error == 0) {
			var queryString = "?editNature=1&trackingNumber=" + trackingNumber + "&nature=" + encodeURIComponent(nature) + "&specifics=" + encodeURIComponent(specifics);     
			var container = document.getElementById('doctrackUpdateContainer'); 

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"editNature");
			
		}else {
			if(error == 1){
				msg("Please select Nature of Payment.");
			}else if(error == 2){
				msg("Please select Specifics.");
			}
		}
		
	}

	function setEditorSpecifics(me) {
		var container = document.getElementById('newSpecifics');
        var nature = me.value;
		var modeOfProc = document.getElementById('poPOMode').textContent.trim();

        var sheet = "";

        if(nature != "") {

            if(nature == 'Goods/Items') {

				// sheet = "<option></option>"
				//       + "<option>Agricultural Products</option>"
				//       + "<option>General</option>"
				//       + "<option>Items (PPE)</option>"
				//       + "<option>Meals/Snacks</option>"
				//       + "<option>Mineral products & Quarry resources</option>";

				if(modeOfProc == 'Competitive Bidding') {
                    sheet = "<option></option>"
                            + "<option>Agricultural Products</option>"
                            + "<option>Agricultural products & other Goods/Items</option>" 
                            + "<option>Agricultural Products Without Retention</option>"
                            + "<option>General</option>"
                            + "<option>Gasoline</option>"
                            + "<option>Without Retention</option>";

                }else {
					sheet = "<option></option>"
							+ "<option>Agricultural Products</option>"
							+ "<option>Agricultural products & other Goods/Items</option>" 
                            + "<option>Agricultural Products Without Retention</option>"
							+ "<option>General</option>"
							+ "<option>Gasoline</option>";
				}


			}else if(nature == 'Services') {

				// sheet = "<option></option>"
				//       + "<option>General</option>"
				//       + "<option>Services/Rentals</option>"
				//       + "<option>Gross > 720,000</option>";

				sheet = "<option></option>"
					+ "<option>General</option>"
					+ "<option>Gross > 720,000</option>"
					+ "<option>With Retention</option>";

			}else if(nature == 'Rentals') {

				sheet = "<option></option>"
					+ "<option>General</option>"
					+ "<option>Heavy Machineries</option>"
					+ "<option>Building/Venue</option>";

			}

		}else {
			sheet = "<option></option>";
		}

        container.innerHTML = sheet;
	}

	function clickSupplierGoodsPOInEdit(me) {

		var supplier = me.value;
		var allow = 0;

		// var trackingNumber = document.getElementById('poSupTN').value.trim();
		// var field = "Claimant";
		// var oldValue = document.getElementById('poSupOld').value.trim();

		// var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + supplier + "&oldValue=" + oldValue;    
		// var container = document.getElementById('doctrackUpdateContainer');	

		var trackingNumber = document.getElementById('poSupTN').value.trim();
		var oldValue = document.getElementById('poSupOld').value.trim();

		var queryString = "?editPOSupplier=1&trackingNumber=" + trackingNumber + "&supplier=" + encodeURIComponent(supplier) + "&oldValue=" + encodeURIComponent(oldValue);    
		var container = document.getElementById('doctrackUpdateContainer');	

		closeAbsolute(me);

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"editPOSupplier");

	}

	//--------------------------------------------------------------------------------------------------------------PO Edit Nature and Specifics - END

	//--------------------------------------------------------------------------------------------------------------PX Funcs - START

	// function pxAddThisItemToCurrentEdit(me) {
		
	// 	var item = parent.children[0].children[1].value;
	// 	var programCode = parent.children[1].children[0].value;
	// 	var accountCode = parent.children[1].children[1].value;
	// 	var description = parent.children[2].children[0].value;
	// 	var qty = parent.children[3].children[0].value;
	// 	var unit = parent.children[3].children[1].value;
	// 	var unitCost = parent.children[5].children[0].value.replace(/,/g,"");
	// 	var total = parent.children[7].children[0].value.replace(/,/g,"");

	// 	var table = document.getElementById('pxItemsTableED');
	// 	var numRows = (table.children[0].children.length - 3) + 1;
	// 	var specifics = document.getElementById('pxSpecifics').textContent.trim();

	// 	var hidden = 'display:none;';
	// 	if(specifics == 'Agricultural products & other Goods/Items') {
	// 		hidden = '';
	// 	}


	// 	var sheet = "		<td style='width:0px; padding:8px 8px; border-bottom:2px solid white; vertical-align:top;'>"
	// 				+"			<span class='goodsItemNum'>"+numRows+"</span><input type='hidden' value='"+item+"'><input type='hidden' value='"+qty+"'><input type='hidden' value='"+unitCost+"'>"
	// 				+"		</td>"
	// 				+"		<td style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
	// 				+"			<input class='data1 goodsItemPlainInp' onclick='clickInput(this)' style='font-size:14px; font-weight:bold; border-bottom:1px solid silver;' value='"+programCode+"'>"
	// 				+"			<input class='data1 goodsItemPlainInp' onclick='clickInput(this)' style='font-size:14px;' value='"+accountCode+"'>"
	// 				+"		</td>"
	// 				+"		<td style='padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
	// 				+"			<textarea style='font-size:14px; resize:vertical; color:black; font-family:NOR; width:450px; max-width:450px; min-height:60px; overflow:hidden; padding:2px 5px; background-color:white;' onclick='this.style.backgroundColor=\"white\";' disabled>"+description+"</textarea>"
	// 				+"		</td>"
	// 				+"		<td style='width:0px; padding:12px 10px; border-bottom:2px solid white; vertical-align:top; background-color:rgb(222, 228, 231);'>"
	// 				+"			<input type='checkbox' onclick='selectCalculateAddPXInEdit(this)' style=''>"
	// 				+"		</td>"
	// 				+"		<td style='width:0px; padding:12px 10px; border-bottom:2px solid white; vertical-align:top; background-color:rgb(222, 228, 231); "+hidden+"'>"
	// 				+"			<input type='checkbox' name='agriCheckedItemsED' onclick='calculateAddPXInEdit(this)'>"
	// 				+"		</td>"
	// 				+"		<td style='width:0px; padding:5px 5px; padding-top:8px; border-bottom:2px solid white; vertical-align:top;'>"
	// 				+"			<input class='data1 goodsItemPlainInp' onclick='clickInput(this)' onkeydown='return isAmount(this,event)' onkeyup='calculateAddPXInEdit(this)' value='"+qty+"' maxlength='8' style='font-size:14px; font-weight:bold; border-bottom:1px solid silver; color:rgb(45, 90, 118);'>"
	// 				+"			<input class='data1 goodsItemPlainInp' onclick='clickInput(this)' style='font-size:14px;' value='"+unit+"'>"
	// 				+"		</td>"
	// 				+"		<td style='width:0px; padding:8px 5px; border-bottom:2px solid white; vertical-align:top; font-size:12px;'>"
	// 				+"			&#10006;"
	// 				+"		</td>"
	// 				+"		<td style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
	// 				+"			<input class='data1' onkeydown='return isAmount(this,event)' onkeyup='calculateAddPXInEdit(this)' value='"+numberWithCommas(unitCost)+"' style='background-color:rgb(220, 228, 232);  width:97px; text-align:right; color:black; border:0; font-size:14px; font-weight:bold; padding:2px 5px; font-family:NOR;' >"
	// 				+"		</td>"
	// 				+"		<td style='width:0px; padding:6px 3px; border-bottom:2px solid white; vertical-align:top; font-weight:bold;'>=</td>"
	// 				+"		<td style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
	// 				+"			<input class='data1' value='"+numberWithCommas(total)+"' style='color:rgb(45, 90, 118); font-weight:bold; width:97px; border:0; font-size:14px; background-color:transparent; padding:2px 5px 2px 5px; font-family:NOR; text-align:right;' disabled>"
	// 				+"		</td>"
	// 				+"		<td style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
	// 				+"			<input class='data1' onkeydown='return isAmount(this,event)' onkeyup='calculateAddPXInEdit(this)' value='' style='background-color:rgb(220, 228, 232);  width:97px; text-align:center; color:black; border:0; font-size:14px; font-weight:bold; padding:2px 5px; font-family:NOR;' >"
	// 				+"		</td>"
	// 				+"		<td style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
	// 				+"			<input class='data1' value='0.00' style='color:rgb(45, 90, 118); text-align:right; font-weight:bold; width:97px; border:0; font-size:14px; background-color:transparent; padding:2px 5px; font-family:NOR;' name='pxLD' disabled>"
	// 				+"		</td>"
	// 				+"		<td colspan='2' style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
	// 				+"			<input class='data1' value='"+numberWithCommas(total)+"' style='color:rgb(45, 90, 118); text-align:right; font-weight:bold; width:97px; border:0; font-size:14px; background-color:transparent; padding:2px 5px; font-family:NOR;' disabled>"
	// 				+"		</td>";

	// 	var tr = document.createElement('tr');
	// 	tr.innerHTML = sheet;

	// 	table.children[0].insertBefore(tr, table.children[0].children[ table.children[0].children.length - 1 ])

	// 	pxEditorClose.click();
	// }

	function pxAddThisItemToCurrentEdit(me) {

		var parent = me.parentNode.parentNode;
		var item = parent.children[0].children[1].value;
		var programCode = parent.children[1].children[0].value;
		var accountCode = parent.children[1].children[1].value;
		var description = parent.children[2].children[0].value;
		var qty = parent.children[3].children[0].value;
		var unit = parent.children[3].children[1].value;
		var unitCost = parent.children[5].children[0].value.replace(/,/g,"");
		var total = parent.children[7].children[0].value.replace(/,/g,"");

		var table = document.getElementById('pxItemsTableED');
		var numRows = (table.children[0].children.length - 3) + 1;
		var specifics = document.getElementById('pxSpecifics').textContent.trim();

		var hidden = 'display:none;';
		if(specifics == 'Agricultural products & other Goods/Items') {
			hidden = '';
		}


		var sheet = "		<td style='width:0px; padding:8px 8px; border-bottom:2px solid white; vertical-align:top;'>"
					+"			<span class='goodsItemNum'>"+numRows+"</span><input type='hidden' value='"+item+"'><input type='hidden' value='"+qty+"'><input type='hidden' value='"+unitCost+"'>"
					+"		</td>"
					+"		<td style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
					+"			<input class='data1 goodsItemPlainInp' onclick='clickInput(this)' style='font-size:14px; font-weight:bold; border-bottom:1px solid silver;' value='"+programCode+"'>"
					+"			<input class='data1 goodsItemPlainInp' onclick='clickInput(this)' style='font-size:14px;' value='"+accountCode+"'>"
					+"		</td>"
					+"		<td style='padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
					+"			<textarea style='font-size:14px; resize:vertical; color:black; font-family:NOR; width:450px; max-width:450px; min-height:60px; overflow:hidden; padding:2px 5px; background-color:white;' onclick='this.style.backgroundColor=\"white\";'>"+description+"</textarea>"
					+"		</td>"
					+"		<td style='width:0px; padding:12px 10px; border-bottom:2px solid white; vertical-align:top; background-color:rgb(222, 228, 231);'>"
					+"			<input type='checkbox' onclick='selectCalculateAddPXInEdit(this)' style=''>"
					+"		</td>"
					+"		<td style='width:0px; padding:12px 10px; border-bottom:2px solid white; vertical-align:top; background-color:rgb(222, 228, 231); "+hidden+"'>"
					+"			<input type='checkbox' name='agriCheckedItemsED' onclick='calculateAddPXInEdit(this)'>"
					+"		</td>"
					+"		<td style='width:0px; padding:5px 5px; padding-top:8px; border-bottom:2px solid white; vertical-align:top;'>"
					+"			<input class='data1 goodsItemPlainInp' onclick='clickInput(this)' onkeydown='return isAmount(this,event)' onkeyup='calculateAddPXInEdit(this)' value='"+qty+"' maxlength='8' style='font-size:14px; font-weight:bold; border-bottom:1px solid silver; color:rgb(45, 90, 118);'>"
					+"			<input class='data1 goodsItemPlainInp' onclick='clickInput(this)' style='font-size:14px;' value='"+unit+"'>"
					+"		</td>"
					+"		<td style='width:0px; padding:8px 5px; border-bottom:2px solid white; vertical-align:top; font-size:12px;'>"
					+"			&#10006;"
					+"		</td>"
					+"		<td style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
					+"			<input class='data1' onkeydown='return isAmount(this,event)' onkeyup='calculateAddPXInEdit(this)' value='"+numberWithCommas(unitCost)+"' style='background-color:rgb(220, 228, 232);  width:97px; text-align:right; color:black; border:0; font-size:14px; font-weight:bold; padding:2px 5px; font-family:NOR;' >"
					+"		</td>"
					+"		<td style='width:0px; padding:6px 3px; border-bottom:2px solid white; vertical-align:top; font-weight:bold;'>=</td>"
					+"		<td style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
					+"			<input class='data1' value='"+numberWithCommas(total)+"' style='color:rgb(45, 90, 118); font-weight:bold; width:97px; border:0; font-size:14px; background-color:transparent; padding:2px 5px 2px 5px; font-family:NOR; text-align:right;' disabled>"
					+"		</td>"
					+"		<td style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
					+"			<input class='data1' onkeydown='return isAmount(this,event)' onkeyup='calculateAddPXInEdit(this)' value='' style='background-color:rgb(220, 228, 232);  width:97px; text-align:center; color:black; border:0; font-size:14px; font-weight:bold; padding:2px 5px; font-family:NOR;' >"
					+"		</td>"
					+"		<td style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
					+"			<input class='data1' value='0.00' style='color:rgb(45, 90, 118); text-align:right; font-weight:bold; width:97px; border:0; font-size:14px; background-color:transparent; padding:2px 5px; font-family:NOR;' name='pxLD' disabled>"
					+"		</td>"
					+"		<td colspan='2' style='width:0px; padding:5px 5px; border-bottom:2px solid white; vertical-align:top;'>"
					+"			<input class='data1' value='"+numberWithCommas(total)+"' style='color:rgb(45, 90, 118); text-align:right; font-weight:bold; width:97px; border:0; font-size:14px; background-color:transparent; padding:2px 5px; font-family:NOR;' disabled>"
					+"		</td>";

		var tr = document.createElement('tr');
		tr.innerHTML = sheet;

		table.children[0].insertBefore(tr, table.children[0].children[ table.children[0].children.length - 1 ]);

		pxEditorClose.click();
	}


	function pxAddItemFromPO(tn) {
		var queryString = '?pxAddItemFromPO=1&poTN='+tn;
		var container = '';

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"pxAddItemFromPO");
	}

	function updateCombiDetailsInEdit() {

		var agriTax = document.getElementById('agriTaxED');
		if(agriTax) {
			agriTax.parentNode.removeChild(agriTax);
		}

		var taxCont = document.getElementById('pxTaxesContED');
		var sheet = "";
		var totalTax = parseFloat(document.getElementById('pxTotalTaxED').value.replace(/,/g,""));
		var type = 'EXP';
		var taxPercent = 0.01;
		agriTotal = 0;

		var notax = document.getElementById('pxTaxNTX');

		if(notax == null) {

			var chkBoxes = document.getElementsByName('agriCheckedItemsED');
			for (var i = 0; i < chkBoxes.length; i++) {
				var itemChkBox = chkBoxes[i].parentNode.parentNode.children[3].children[0];
				if(itemChkBox.checked == true && chkBoxes[i].checked == true) {
					var baseAmount = parseFloat(chkBoxes[i].parentNode.parentNode.children[12].children[0].value.replace(/,/g,""));
					agriTotal += parseFloat( round2(trimTwoDecimals(baseAmount)) )
				}
			}

			var taxValue = agriTotal * parseFloat(taxPercent);
			if(taxValue > 0) {
				totalTax += parseFloat( round2(trimTwoDecimals(taxValue)) );

				var taxDisp = (taxPercent * 100);
				var code = 28;
				var atc = 'WC610';
				var specifics = encodeURIComponent('Agricultural Products');

				// sheet +="<div id='agriTaxED'>"
				// 	+ "<span style='font-size:12px; color:gray;' name='pxTaxPerED' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+specifics+"~"+round2(trimTwoDecimals(agriTotal))+"'>(<span id='agriTotalED'>"+numberWithCommas( round2(trimTwoDecimals(agriTotal)) )+"</span> &#10006; "+taxDisp+"%)</span><span style='padding:3px 5px;'>"+type+"</span>"
				// 	+ "<input style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; text-align:right;' name='pxTaxValueED' value='"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"' disabled>"         
				// 	+ "</div>";

				sheet += "<tr id='agriTaxED'>"
						+"<td style='font-size:14px; padding-right:5px; '>"+type+"</td>"
						+"<td style='font-size:12px; color:gray; padding-right:8px;' name='pxTaxPerED' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+specifics+"~"+round2(trimTwoDecimals(agriTotal))+"~"+round2(trimTwoDecimals(agriTotal))+"'>(<span id='agriTotalED'>"+numberWithCommas( round2(trimTwoDecimals(agriTotal)) )+"</span> &#10006; "+taxDisp+"%)</td>"
						+"<td style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; text-align:right; padding-left:5px;' name='pxTaxValueED'>"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"</td>"
						+"</tr>";

				taxCont.innerHTML += sheet;

			}

		}

	}

	function selectAllPXInEdit(me){
		var b = me.parentNode.parentNode.parentNode;
		var tr = b.children;
		for(var i = 1; i < tr.length-1; i++){
			var td = tr[i];
			if(td.children.length == 13){
				var newCheck = me.checked;
				var oldCheck = td.children[3].children[0].checked;
				if(newCheck != oldCheck){
					td.children[3].children[0].click();
				}
			}			
		}
	}

	function editPX(me){
		var elemId = me.id.replace("pxEdit","");
		var temp = elemId.split("*");
		var trackingNumber = temp[0];
		var trackingNumberPO = temp[1];
		var container = document.getElementById("doctrackUpdateContainer");
		var queryString = "?pxEdit=1&trackingNumber=" + trackingNumber + "&poTrackingNumber=" + trackingNumberPO;
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"pxEdit");
	}

	// function updatePXAmountDetailsInEdit() {
    //     var totalLD = parseFloat(document.getElementById('totalAmountItemsPXLD').value.replace(/,/g,""));
    //     var totalPO = parseFloat(document.getElementById('totalAmountItemsPX').value.replace(/,/g,""));

    //     document.getElementById('totalAmountItemsPXDispOnlyED').value = numberWithCommas( round2(trimTwoDecimals(totalPO)) );
    //     document.getElementById('totalAmountItemsPXLDDispOnlyED').value = numberWithCommas( round2(trimTwoDecimals(totalLD)) );

	// 	var specifics = document.getElementById('pxSpecifics').textContent.trim();
	// 	var category = document.getElementById('pxCatCode').value.trim();
	// 	var withRetention = document.getElementById('pxWithRetention').value.trim();
	// 	var recType = document.getElementById('pxRecType').textContent.trim();

    //     updateCombiDetailsInEdit();

	// 	var agriTotal = document.getElementById('agriTotalED');
    //     var agriDeduct = 0;
    //     if(agriTotal) {
    //         agriDeduct = parseFloat( agriTotal.textContent.replace(/,/g,"") );
    //     }

    //     var computedBaseAmount = (totalLD - agriDeduct);

    //     var baseAmount = computedBaseAmount/1.12;
	// 	if(recType == 'NON-VAT') {
	// 		baseAmount = computedBaseAmount;
	// 	}

	// 	baseAmount = parseFloat(round2(trimTwoDecimals(baseAmount)));

    //     // var baseAmount = parseFloat( round2(trimTwoDecimals(totalLD/1.12)) );

    //     var taxes = document.getElementsByName('pxTaxesED');
    //     var taxCont = document.getElementById('pxTaxesContED');
    //     var sheet = "";
    //     var totalTax = 0;
	// 	if(computedBaseAmount > 0) {

	// 		for (var i = 0; i < taxes.length; i++) {
	// 			var type = taxes[i].id.replace("pxTax", "");
	// 			var taxPercent = taxes[i].value;
	// 			var taxValue = baseAmount * parseFloat(taxPercent);
	// 			var taxDisp = (taxPercent * 100);

	// 			var code = document.getElementById('px'+type+'Code').value.trim();
	// 			var atc = document.getElementById('px'+type+'ATC').value.trim();
	// 			// var taxValue = document.getElementById('px'+type+'Amount').value.trim();
	// 			// var taxDisp = parseInt(taxPercent);

	// 			// totalTax += parseFloat( round2(trimTwoDecimals(taxValue)) );

	// 			var thisSpecifics = specifics;
	// 			if(thisSpecifics == 'Agricultural products & other Goods/Items') {
	// 				thisSpecifics = 'General';
	// 			}

	// 			// sheet += "<div>"
	// 			//        + "<span style='font-size:12px; color:gray;' name='pxTaxPerED' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+encodeURIComponent(thisSpecifics)+"~"+round2(trimTwoDecimals(computedBaseAmount))+"'>("+numberWithCommas( round2(trimTwoDecimals(computedBaseAmount)) )+" / 1.12 &#10006; "+taxDisp+"%)</span><span style='padding:3px 5px;'>"+type+"</span>"
	// 			//        + "<input style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; text-align:right;' name='pxTaxValueED' value='"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"' disabled>"         
	// 			//        + "</div>";

	// 			if(recType == 'NON-VAT') {
	// 				sheet += "<tr>"
	// 						+"<td style='font-size:14px; padding-right:5px;'>"+type+"</td>"
	// 						+"<td style='font-size:12px; color:gray; padding-right:8px;' name='pxTaxPerED' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+encodeURIComponent(thisSpecifics)+"~"+round2(trimTwoDecimals(baseAmount))+"~"+round2(trimTwoDecimals(computedBaseAmount))+"'>("+numberWithCommas( round2(trimTwoDecimals(computedBaseAmount)) )+" &#10006; "+taxDisp+"%)</td>"
	// 						+"<td style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; text-align:right; padding-left:5px;' name='pxTaxValueED'>"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"</td>"
	// 						+"</tr>";
	// 			}else {
	// 				sheet += "<tr>"
	// 						+"<td style='font-size:14px; padding-right:5px;'>"+type+"</td>"
	// 						+"<td style='font-size:12px; color:gray; padding-right:8px;' name='pxTaxPerED' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+encodeURIComponent(thisSpecifics)+"~"+round2(trimTwoDecimals(baseAmount))+"~"+round2(trimTwoDecimals(computedBaseAmount))+"'>("+numberWithCommas( round2(trimTwoDecimals(computedBaseAmount)) )+" / 1.12 &#10006; "+taxDisp+"%)</td>"
	// 						+"<td style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; text-align:right; padding-left:5px;' name='pxTaxValueED'>"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"</td>"
	// 						+"</tr>";
	// 			}

	// 		}

	// 	}

    //     // taxCont.innerHTML = sheet;

	// 	var agriTax = document.getElementById('agriTaxED');
    //     var oldTaxes = "";
    //     if(agriTax) {
    //         oldTaxes = agriTax.outerHTML;
    //     }
    //     taxCont.innerHTML = sheet + oldTaxes;

	// 	var modeOfProc = document.getElementById('pxPOModeED').value;

	// 	// if(modeOfProc == 5 || modeOfProc == 12 || category == 'CAT 80' || category == 'CAT 25') {
    //     //     retentionLabelInEdit.innerHTML = '';
    //     // }else {
    //     // 	retentionLabelInEdit.innerHTML = "("+numberWithCommas( round2(trimTwoDecimals(totalPO)) )+" &#10006; 1%)";
    //     // }

	// 	if(withRetention == 1) {
	// 		retentionLabelInEdit.innerHTML = "("+numberWithCommas( round2(trimTwoDecimals(totalPO)) )+" &#10006; 1%)";
	// 	}else {
    //         retentionLabelInEdit.innerHTML = '';
	// 	}


    //     var totalLDCont = document.getElementById('pxTotalLDED');
    //     var ldList = document.getElementsByName('pxLD');
    //     var totalJustLD = 0;
    //     for (var i = 0; i < ldList.length; i++) {
	// 		var tr = ldList[i].parentNode.parentNode;
	// 		var chk = tr.children[3].children[0].checked;

	// 		if(chk == true) {
	// 			var justLD = parseFloat(ldList[i].value.replace(/,/g,""));  
    //         	totalJustLD += justLD;  
	// 		}
    //     } 

    //     totalLDCont.value = numberWithCommas( round2(trimTwoDecimals(totalJustLD)) );

    //     var retentionCont = document.getElementById('pxRetentionED');

    //     // var retention = totalLD * 0.1;
    //     // var retention = totalPO * 0.01; // change to totalLD 2023-06-03
    //     var retention = totalLD * 0.01;
	// 	// if(modeOfProc == 5 || modeOfProc == 12 || category == 'CAT 80' || category == 'CAT 25') {
    //     //     retention = 0;
    //     // }
	// 	if(withRetention == 0) {
    //         retention = 0;
	// 	}

    //     retentionCont.value = numberWithCommas( round2(trimTwoDecimals(retention)) );

    //     var adj  = document.getElementById('pxAdjustmentAmountED').value.replace(/,/g,"");
	// 	var adjT  = document.getElementById('pxAdjustmentTypeED').value;

    //     if(adjT.length > 0) {
    //         if(adj.trim().length > 0) {
    //             if(adj < 0){
    //                 adj = 0;
    //             }else {
    //                 if(adjT == 'Add') {
    //                     adj = adj * -1;
    //                 }
    //             }
    //         }else {
    //             adj = 0;
    //         }
    //     }else {
    //         adj = 0;
    //         document.getElementById('pxAdjustmentAmountED').value = '';
    //         document.getElementById('pxAdjustmentDescED').value = '';
    //     }

    //     var totalTaxForDisp = document.getElementById('pxTotalTaxED');
	// 	var taxesValue = document.getElementsByName('pxTaxValueED');
    //     var totalTax = 0;
    //     for (var i = 0; i < taxesValue.length; i++) {
    //         var tax = parseFloat(taxesValue[i].textContent.replace(/,/g,""));   
    //         totalTax += parseFloat( round2(trimTwoDecimals(tax)) );
    //     }

    //     totalTaxForDisp.value = numberWithCommas( round2(trimTwoDecimals( parseFloat(totalTax) )) );

    //     var total = parseFloat(retention) + parseFloat(totalTax) + parseFloat(adj);
    //     var total = round2(trimTwoDecimals(total));
    //     var net = totalLD - total;

	// 	// document.getElementById('pxNetAmountED').value = numberWithCommas( round2(trimTwoDecimals(net)) );
	// 	document.getElementById('pxNetAmountED').textContent = numberWithCommas( round2(trimTwoDecimals(net)) );

	// 	// pxChkAll.click(); // uncheck
	// 	// pxChkAll.click(); // check

    // }

	function updatePXAmountDetailsInEdit() {
        var totalLD = parseFloat(document.getElementById('totalAmountItemsPXLD').value.replace(/,/g,""));
        var totalPO = parseFloat(document.getElementById('totalAmountItemsPX').value.replace(/,/g,""));

		var specifics = document.getElementById('pxSpecifics').textContent.trim();
		var category = document.getElementById('pxCatCode').value.trim();
		var withRetention = document.getElementById('pxWithRetention').value.trim();
		var recType = document.getElementById('pxRecType').textContent.trim();


		// 2023-06-26
		// to prevent changes in amounts due to decimal differences
		// TOTAL of ONLY LD is deducted from TOTAL PO
		// as opposed to previous computation using TOTAL PO-LD from INDIVIDUAL rows.
		var totalLDCont = document.getElementById('pxTotalLDED');
        var ldList = document.getElementsByName('pxLD');
        var totalJustLD = 0;
        for (var i = 0; i < ldList.length; i++) {
			var tr = ldList[i].parentNode.parentNode;
			var chk = tr.children[3].children[0].checked;

			if(chk == true) {
				var justLD = parseFloat(ldList[i].value.replace(/,/g,""));  
            	totalJustLD += justLD;  
			}
        } 
        totalLDCont.value = numberWithCommas( round2(trimTwoDecimals(totalJustLD)) );
		totalJustLD = parseFloat(round2(trimTwoDecimals(totalJustLD)));

		var totalLD = (totalPO - totalJustLD);

		document.getElementById('totalAmountItemsPXDispOnlyED').value = numberWithCommas( round2(trimTwoDecimals(totalPO)) );
        document.getElementById('totalAmountItemsPXLDDispOnlyED').value = numberWithCommas( round2(trimTwoDecimals(totalLD)) );

        updateCombiDetailsInEdit();

		var agriTotal = document.getElementById('agriTotalED');
        var agriDeduct = 0;
        if(agriTotal) {
            agriDeduct = parseFloat( agriTotal.textContent.replace(/,/g,"") );
        }

        var computedBaseAmount = (totalLD - agriDeduct);

        var baseAmount = computedBaseAmount/1.12;
		if(recType == 'NON-VAT') {
			baseAmount = computedBaseAmount;
		}

		baseAmount = parseFloat(round2(trimTwoDecimals(baseAmount)));

        // var baseAmount = parseFloat( round2(trimTwoDecimals(totalLD/1.12)) );

        var taxes = document.getElementsByName('pxTaxesED');
        var taxCont = document.getElementById('pxTaxesContED');
        var sheet = "";
        var totalTax = 0;
		if(computedBaseAmount > 0) {

			for (var i = 0; i < taxes.length; i++) {
				var type = taxes[i].id.replace("pxTax", "");
				var taxPercent = taxes[i].value;
				var taxValue = baseAmount * parseFloat(taxPercent);
				var taxDisp = (taxPercent * 100);

				var code = document.getElementById('px'+type+'Code').value.trim();
				var atc = document.getElementById('px'+type+'ATC').value.trim();
				// var taxValue = document.getElementById('px'+type+'Amount').value.trim();
				// var taxDisp = parseInt(taxPercent);

				// totalTax += parseFloat( round2(trimTwoDecimals(taxValue)) );

				var thisSpecifics = specifics;
				if(thisSpecifics == 'Agricultural products & other Goods/Items') {
					thisSpecifics = 'General';
				}

				if(thisSpecifics == 'With Retention') {
					thisSpecifics = 'General';
				}

				if(thisSpecifics == 'Without Retention') {
					thisSpecifics = 'General';
				}

				// sheet += "<div>"
				//        + "<span style='font-size:12px; color:gray;' name='pxTaxPerED' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+encodeURIComponent(thisSpecifics)+"~"+round2(trimTwoDecimals(computedBaseAmount))+"'>("+numberWithCommas( round2(trimTwoDecimals(computedBaseAmount)) )+" / 1.12 &#10006; "+taxDisp+"%)</span><span style='padding:3px 5px;'>"+type+"</span>"
				//        + "<input style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; text-align:right;' name='pxTaxValueED' value='"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"' disabled>"         
				//        + "</div>";

				if(recType == 'NON-VAT') {
					sheet += "<tr>"
							+"<td style='font-size:14px; padding-right:5px;'>"+type+"</td>"
							+"<td style='font-size:12px; color:gray; padding-right:8px;' name='pxTaxPerED' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+encodeURIComponent(thisSpecifics)+"~"+round2(trimTwoDecimals(baseAmount))+"~"+round2(trimTwoDecimals(computedBaseAmount))+"'>("+numberWithCommas( round2(trimTwoDecimals(computedBaseAmount)) )+" &#10006; "+taxDisp+"%)</td>"
							+"<td style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; text-align:right; padding-left:5px;' name='pxTaxValueED'>"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"</td>"
							+"</tr>";
				}else {
					sheet += "<tr>"
							+"<td style='font-size:14px; padding-right:5px;'>"+type+"</td>"
							+"<td style='font-size:12px; color:gray; padding-right:8px;' name='pxTaxPerED' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+encodeURIComponent(thisSpecifics)+"~"+round2(trimTwoDecimals(baseAmount))+"~"+round2(trimTwoDecimals(computedBaseAmount))+"'>("+numberWithCommas( round2(trimTwoDecimals(computedBaseAmount)) )+" / 1.12 &#10006; "+taxDisp+"%)</td>"
							+"<td style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; text-align:right; padding-left:5px;' name='pxTaxValueED'>"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"</td>"
							+"</tr>";
				}

			}

		}

        // taxCont.innerHTML = sheet;

		var agriTax = document.getElementById('agriTaxED');
        var oldTaxes = "";
        if(agriTax) {
            oldTaxes = agriTax.outerHTML;
        }
        taxCont.innerHTML = sheet + oldTaxes;

		var modeOfProc = document.getElementById('pxPOModeED').value;

		// if(modeOfProc == 5 || modeOfProc == 12 || category == 'CAT 80' || category == 'CAT 25') {
        //     retentionLabelInEdit.innerHTML = '';
        // }else {
        // 	retentionLabelInEdit.innerHTML = "("+numberWithCommas( round2(trimTwoDecimals(totalPO)) )+" &#10006; 1%)";
        // }

		if(withRetention == 1) {
			// retentionLabelInEdit.innerHTML = "("+numberWithCommas( round2(trimTwoDecimals(totalPO)) )+" &#10006; 1%)"; // change to totalLD 2023-06-03
			retentionLabelInEdit.innerHTML = "("+numberWithCommas( round2(trimTwoDecimals(totalLD)) )+" &#10006; 1%)";
		}else {
            retentionLabelInEdit.innerHTML = '';
		}


        

        var retentionCont = document.getElementById('pxRetentionED');

        // var retention = totalLD * 0.1;
        // var retention = totalPO * 0.01; // change to totalLD 2023-06-03
        var retention = totalLD * 0.01;
		// if(modeOfProc == 5 || modeOfProc == 12 || category == 'CAT 80' || category == 'CAT 25') {
        //     retention = 0;
        // }
		if(withRetention == 0) {
            retention = 0;
		}

        retentionCont.value = numberWithCommas( round2(trimTwoDecimals(retention)) );

        var adj  = document.getElementById('pxAdjustmentAmountED').value.replace(/,/g,"");
		var adjT  = document.getElementById('pxAdjustmentTypeED').value;

        if(adjT.length > 0) {
            if(adj.trim().length > 0) {
                if(adj < 0){
                    adj = 0;
                }else {
                    if(adjT == 'Add') {
                        adj = adj * -1;
                    }
                }
            }else {
                adj = 0;
            }
        }else {
            adj = 0;
            document.getElementById('pxAdjustmentAmountED').value = '';
            document.getElementById('pxAdjustmentDescED').value = '';
        }

        var totalTaxForDisp = document.getElementById('pxTotalTaxED');
		var taxesValue = document.getElementsByName('pxTaxValueED');
        var totalTax = 0;
        for (var i = 0; i < taxesValue.length; i++) {
            var tax = parseFloat(taxesValue[i].textContent.replace(/,/g,""));   
            totalTax += parseFloat( round2(trimTwoDecimals(tax)) );
        }

        // totalTaxForDisp.value = numberWithCommas( round2(trimTwoDecimals( parseFloat(totalTax) )) );

        // var total = parseFloat(retention) + parseFloat(totalTax) + parseFloat(adj);
		// var total = parseFloat(round2(trimTwoDecimals(retention))) + parseFloat(round2(trimTwoDecimals(totalTax))) + parseFloat(round2(trimTwoDecimals(adj)));
        // var total = round2(trimTwoDecimals(total));
        // var net = totalLD - total;

		retention = parseFloat(round2(trimTwoDecimals(retention)));
		totalTax = parseFloat(round2(trimTwoDecimals(totalTax)));
		adj = parseFloat(round2(trimTwoDecimals(adj)));

        totalTaxForDisp.value = numberWithCommas(round2(trimTwoDecimals(totalTax)));

		var totalDeductions = retention + totalTax + adj;

        var net = totalLD - totalDeductions;

		document.getElementById('pxNetAmountED').textContent = numberWithCommas( round2(trimTwoDecimals(net)) );

    }

	function calculateAddPXInEdit(me){

		var parent = me.parentNode.parentNode;

		var defQty = parent.children[0].children[2].value;
		var price = parent.children[0].children[3].value;
		var qty = parent.children[5].children[0].value;
		var cost = parent.children[7].children[0].value.replace(/,/g,"");
		var totalCost =  parseFloat(qty * cost);
		var days = parent.children[10].children[0].value;
		var ldField = parent.children[11].children[0];
		var total = parent.children[12].children[0];

		var chk = parent.children[3].children[0].value;

		if(totalCost == 0) {
			parent.children[7].children[0].value = numberWithCommas( round2(trimTwoDecimals(price)) );
			parent.children[5].children[0].value = defQty;
			calculateAddPXInEdit(me);
		}else {
			var totalCostContainer = parent.children[9].children[0];

			totalCost = parseFloat(round2(trimTwoDecimals(totalCost)));
			totalCostContainer.value = numberWithCommas(round2(trimTwoDecimals(totalCost)));

			var ld = 0;
			if(days > 0) {
				// ld = parseFloat(totalCost * .01 * .1  * days); 
				ld = totalCost * .01 * .1  * days; 
			}
			ldField.value = numberWithCommas( round2(trimTwoDecimals(ld)) );

			// 2023-10-02 -> trim
			ld = parseFloat(round2(trimTwoDecimals(ld)));

			// var newTotal = numberWithCommas( round2(trimTwoDecimals( parseFloat(totalCost - ld) )) );
			// 2023-10-02 -> no need to round off for addition and subtraction
			// var newTotal = numberWithCommas(parseFloat(trimTwoDecimals(totalCost - ld)));

			var newTotal = totalCost - ld;

			if(ld > 0) {
				total.value = numberWithCommas(newTotal);
			}else {
				total.value = numberWithCommas(round2(trimTwoDecimals(totalCost)));
			}

			// total.value = newTotal;
		}

		var trLength = parent.parentNode.children.length;
		inputTotalsPXInEdit(parent.parentNode,trLength);

	}

	function inputTotalsPXInEdit(parent,length){
        var g = 0;
        var wLd = 0;
        for(var i = 1 ; i < length-1; i++){
            var check = parent.children[i].children[3].children[0];
            if(check.checked == true && check.id != 'pxChkAll'){
                var total =  parseFloat(parent.children[i].children[9].children[0].value.replace(/,/g,""));
                var totalMLd =  parseFloat(parent.children[i].children[12].children[0].value.replace(/,/g,""));

                g += total;
                wLd += totalMLd
            }
        }

        document.getElementById('totalAmountItemsPX').value = numberWithCommas( round2(trimTwoDecimals(g)) );
        document.getElementById('totalAmountItemsPXLD').value = numberWithCommas( round2(trimTwoDecimals(wLd)) );

        updatePXAmountDetailsInEdit();
    }

	function showHideAdjTableInEdit(me) {
        var container = document.getElementById('pxAdjustmentTableED');

        if(me.checked == true) {
            container.style.display = 'table';
            document.getElementById('adjustmentLabelED').style.borderBottom = '1px solid silver';
        }else {
            container.style.display = 'none';
            document.getElementById('pxAdjustmentAmountED').value = '';
            document.getElementById('pxAdjustmentDescED').value = '';
            document.getElementById('adjustmentLabelED').style.borderBottom = '0px';
            selectToIndexZero('pxAdjustmentTypeED');
        }

        updatePXAmountDetailsInEdit();

    }

	function selectCalculateAddPXInEdit(me){	
		var b = me.parentNode.parentNode.parentNode;
		var totality = b.children[b.children.length-1].children[0].children[0];
		if(me.checked == true){
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "rgb(206, 215, 218)";//  "rgb(239, 242, 244)";
            calculateAddPXInEdit(me);
		}else{
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "inherit";

			// var agriChk = parent.children[4].children[0];
			// if(agriChk.checked == true) {
			// 	agriChk.click();
			// }

            calculateAddPXInEdit(me);
		}
	}

	function updatePX(me){

		var error = 0;
		var trackingNumber = me.id.replace('updatePX', '');
		var taxes = "";

		var nature = document.getElementById('pxNature').textContent.trim();
		var specifics = document.getElementById('pxSpecifics').textContent.trim();

		var pxTaxValue = document.getElementsByName('pxTaxValueED');
		var pxTaxPer = document.getElementsByName('pxTaxPerED');
		if(pxTaxValue.length > 0) {
			for (var i = 0; i < pxTaxValue.length; i++) {
				var temp = pxTaxPer[i].id.split('~');
				taxes += "*j*"+temp[0]+"~"+temp[1]+"~"+parseFloat(pxTaxValue[i].textContent.replace(/,/g,""))+"~"+temp[2]+"~"+temp[3]+"~"+temp[4]+"~"+temp[5]+"~"+temp[6];
			}
		}else {
            // taxes += "*j*NAN~0.00~0~0~0";
			taxes += "*j*NAN~0.00~0~0~0~"+specifics+"~0~0";
        }
		taxes = taxes.substr(3);

		var tnYear = document.getElementById('pxTNYear').value.trim();
		var fund = document.getElementById('pxFund').value.trim();
		var supplier = document.getElementById('pxSupplier').value.trim();

		
		var classification = document.getElementById('pxClassification').textContent.trim();
		var recType = document.getElementById('pxRecType').textContent.trim();

		var tin = document.getElementById('pxTIN').value.trim();
		var suppCode = document.getElementById('pxSuppCode').value.trim();

		var totalLD = document.getElementById('pxTotalLDED').value.replace(/,/g,"");
		var retention = document.getElementById('pxRetentionED').value.replace(/,/g,"");
		var adjType = document.getElementById('pxAdjustmentTypeED').value;
		var adjDesc = document.getElementById('pxAdjustmentDescED').value;
		var adjAmount = document.getElementById('pxAdjustmentAmountED').value.replace(/,/g,"");
		var netAmount = document.getElementById('pxNetAmountED').textContent.replace(/,/g,"");

		var totalLDAll = document.getElementById('totalAmountItemsPXLD').value.replace(/,/g,"");
		// var baseAmount = round2(trimTwoDecimals( parseFloat(totalLDAll)/1.12 ));

		var agriTotal = document.getElementById('agriTotalED');
        var agriDeduct = 0;
        if(agriTotal) {
            agriDeduct = parseFloat( agriTotal.textContent.replace(/,/g,"") );
        }

        var computedBaseAmount = (totalLDAll - agriDeduct);
        var baseAmount = round2(trimTwoDecimals( computedBaseAmount/1.12 ));

		var category = document.getElementById('pxCategoryED').value;

		var unchecked = 0;
		var poData = '';
		var dummyProgram = '';
		var programs = '';
		var totalDetails = '';
		var parent = document.getElementById('pxItemsTableED');
		var trLength = parent.children[0].children.length;
		for(var i = 2 ; i < trLength-1; i++){
			var checkMe = parent.children[0].children[i].children[3].children[0].checked;
			if(checkMe == true){
				var itemDes = encodeURIComponent(parent.children[0].children[i].children[0].children[1].value.trim());
				var program = encodeURIComponent(parent.children[0].children[i].children[1].children[0].value.trim());
				var code = encodeURIComponent(parent.children[0].children[i].children[1].children[1].value.trim());
			
				var desc =  encodeURIComponent(parent.children[0].children[i].children[2].children[0].value.replace(/{+}/g,"~").trim());	
				var itemId =  parent.children[0].children[i].children[2].children[0].id.replace('item', '');	
				var qty = parent.children[0].children[i].children[5].children[0].value.trim();
				var unit = encodeURIComponent(parent.children[0].children[i].children[5].children[1].value.trim());
				var cost = parent.children[0].children[i].children[7].children[0].value.replace(/,/g,"");
				var total = parent.children[0].children[i].children[9].children[0].value.replace(/,/g,"");
				var days = parent.children[0].children[i].children[10].children[0].value.trim();
				var ld = parent.children[0].children[i].children[11].children[0].value.replace(/,/g,"");
				var totalLD = parent.children[0].children[i].children[12].children[0].value.replace(/,/g,"");

				var agriChecked = parent.children[0].children[i].children[4].children[0].checked;
                if(agriChecked == true) {
                    agriChecked = 1;
                }else {
                    agriChecked = 0;
                }

				if(days.trim() == "") {
					days = 0;
				}

				if(ld.trim() == "") {
					ld = 0;
				}
			
				if(program.length < 4){
					parent.children[0].children[i].children[1].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(code.length < 8){
					parent.children[0].children[i].children[1].children[1].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(desc.length < 1){
					parent.children[0].children[i].children[2].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(qty.length < 1){
					parent.children[0].children[i].children[5].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(unit.length < 1){
					parent.children[0].children[i].children[5].children[2].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(cost.length < 1){
					parent.children[0].children[i].children[7].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				
				poData += '~#~' + program + '~!~' + code + '~!~' + desc + '~!~' + qty + '~!~' + unit + '~!~'  +  cost + '~!~' + itemDes + '~!~' + days + '~!~' + ld + '~!~' + totalLD + '~!~' + agriChecked;	
				totalDetails += '!#!' + program + '~!~' + code + '~!~' + totalLD + '~!~' + total;
				
				if(dummyProgram != program){
					programs += program + '~';
					dummyProgram = program;
				}
			}else {
				unchecked++;
			}
	
		}

		//pigeon sort
		var detailsA = totalDetails.substr(3).split('!#!');
		var batchTotals = {};
		for(var i = 0 ; i < detailsA.length; i++){
			var detailsB = detailsA[i].split('~!~');
			var program = detailsB[0];
			var code = detailsB[1];
			var total = detailsB[2];
			var poTotal = detailsB[3];

			if(batchTotals[program+ '~' + code] == undefined){
				batchTotals[program+ '~' + code] = 0;
			}

			batchTotals[program+ '~' + code] = parseFloat( batchTotals[program+ '~'+code]) +  parseFloat(poTotal);
		}

		var grp = '';
		var oTotal = 0;
		for (var key in batchTotals) { 
			var splitA = key.split('~');
			var program = splitA[0];
			var code = splitA[1];
			var total = batchTotals[key] ;
			oTotal = oTotal + total;
			grp += encodeURIComponent(program)+ '~!~' +  encodeURIComponent(code) + '~!~' + total + '~#~';
		}

		if(oTotal == 0){
			error = 3;
		}

		var poTotal = parseFloat(document.getElementById('totalAmountItemsPXPO').value.replace(/,/g,""));

		if(adjType.trim().length > 0 || adjDesc.trim().length > 0 || adjAmount > 0) {
			if(adjType.trim().length > 0 && adjDesc.trim().length > 0 && adjAmount > 0) {
				error = 0;
			}else {
				error = 7;
			}
		}

		if(parseFloat(netAmount) <= 0) {
			error = 8;
		}

		if( (trLength - 2) == unchecked ) {
			error = 9;
		}

		var poTotal = parseFloat(document.getElementById('totalAmountItemsPXPO').value.replace(/,/g,""));

		var trackedPXTotal = document.getElementById('totalAmountPXsTracked');
		if(trackedPXTotal) {
			trackedPXTotal = parseFloat(trackedPXTotal.textContent.replace(/,/g,""));
		}else {
			trackedPXTotal = 0;
		}

		var curPXTotal = parseFloat(document.getElementById('totalAmountItemsPX').value.replace(/,/g,""));
		var pxTotal = trackedPXTotal + curPXTotal;

		if(pxTotal > poTotal) {
			error = 6;
		}

		if(error == 0){

			var queryString =   "updateTrackingPostPX=1" + 
								"&trackingNumber=" + trackingNumber + 
								"&tnYear=" + tnYear + 
								"&fund=" + fund + 
								"&supplier=" + encodeURIComponent(supplier) + 
								"&nature=" + encodeURIComponent(nature) + 
								"&specifics=" + encodeURIComponent(specifics) + 
								"&classification=" + classification + 
								"&recType=" + recType + 
								"&tin=" + tin + 
								"&suppCode=" + suppCode + 
								"&grp=" + grp +
								"&poData=" + poData.substr(3) + 
								"&oTotal=" + oTotal +
								"&taxes=" + taxes +
								"&totalLD=" + totalLDAll +
								"&ret=" + retention +
								"&aType=" + adjType +
								"&aDesc=" + adjDesc +
								"&aAmnt=" + adjAmount +
								"&baseAmnt=" + baseAmount +
								"&category=" + category +
								"&net=" + netAmount;

			var container = document.getElementById('doctrackUpdateContainer');

			loader();
			ajaxPost(queryString,processorLink, container,"updateTrackingPostPX");
		}else if(error == 1){
			msg("Please complete the required fields.");
		}else if(error == 2){
			msg("Please select schedule in step 2. </br>PR items must be reviewed again.");
		}else if(error == 3){
			msg("Please complete the required fields.");
		}else if(error == 6){
			msg("You cannot exceed the total PO Amount.</br>Please review your Items.");
		}else if(error == 7){
			msg("Please check adjustment details.");
		}else if(error == 8){
			msg("Please complete the required fields.");
		}else if(error == 9){
			msg("Please check at least one(1) item.");
		}

	}

	//--------------------------------------------------------------------------------------------------------------PX Funcs - END

	//--------------------------------------------------------------------------------------------------------------PO Compute LD - START

	function revertForComputeLD(me) {
		var trackingNumber = me.id.replace("prEdit","");

		var queryString = "?revertForComputeLD=1&tn=" + trackingNumber;
		var container = "";

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"revertForComputeLD");	
	}
	
	//--------------------------------------------------------------------------------------------------------------PO Compute LD - END

	//--------------------------------------------------------------------------------------------------------------LIQUIDATION JS PRINTOUT - START

	function generateLiqPrintView(trackingNumber, year, caTracking, obr, officeName) {
		var table = document.getElementById('nliqOBRBreakdown');
		var datePrinted = new Date();

		var sheet = '<table border="0" style = "height:100%;width:750px; border-spacing:0px;margin:0 auto;">'
					+'	<tr>'
					+'		<td style="height:10%; padding-top:20px; height:120px; padding-bottom:10px; vertical-align:bottom;">'
					+'			<table border="0" style ="width:100%;border-spacing:0;">'
					+'				<tr>'
					+'					<td style ="width:20%;"></td>'
					+'					<td style ="text-align:center; line-height:18px; vertical-align:top;">'
					+'						<div style = "font-size:20px;font-weight: bold;">LIQUIDATION EXPENSE BREAKDOWN</div>'
					+'						<div style = "font-size:12px;">'+decodeURIComponent(officeName)+'</div>'
					+'					</td>'
					+'					<td style= "width:20%; vertical-align:bottom; text-align:right; padding-top:30px;">'
					+'						<table border="0" cellpadding="0" cellspacing="0" style="font-size:12px; margin:0px 0px 0px auto;">'
					+'							<tr>'
					+'								<td style="white-space:nowrap; text-align:right; padding:0px 3px;">Liquidation TN :</td>'
					+'								<td style="font-size:14px; font-weight:bold;">'+trackingNumber.toString()+'</td>'
					+'							</tr>'
					+'							<tr>'
					+'								<td style="white-space:nowrap; text-align:right; padding:0px 3px;">Cash Advance TN :</td>'
					+'								<td style="font-size:14px; font-weight:bold;">'+caTracking.toString()+'</td>'
					+'							</tr>'
					+'							<tr>'
					+'								<td style="white-space:nowrap; text-align:right; padding:0px 3px;">OBR Number :</td>'
					+'								<td style="font-size:14px; font-weight:bold;">'+obr.toString()+'</td>'
					+'							</tr>'
					+'						</table>'
					+'					</td>'
					+'				</tr>'
					+'			</table>'
					+'		</td>'
					+'	</tr>'
					+'	<tr>'
					+'		<td style="vertical-align:top; padding-top:5px;">'
					+			table.outerHTML
					+'		</td>'
					+'	</tr>'
					+'	<tr>'
					+'		<td style="text-align:left; height:1%; font-size:10px; padding:5px; background-color:rgba(242,242,242,1); color:black; font-weight:bold;">'
					+'			<span style="letter-spacing:1px;">DocTrack'+year+'</span>'
					+'			<span style="float:right; letter-spacing:1px;">Date Printed : '+datePrinted.toLocaleString()+'</span>'
					+'		</td>'
					+'	</tr>'
					+'</table>';
		
		newWin = window.open("");
		newWin.document.write('<html><head><title>Liquidation Expense Form</title>');
		newWin.document.write('<link rel="icon" href="/city/images/print.png">');
		newWin.document.write('<link rel="stylesheet" href="../css/styleLiquidation.css">');
		newWin.document.write('</head><body>');
		newWin.document.write(sheet);
		newWin.document.write('</body></html>');
		newWin.document.close();
	}

	//--------------------------------------------------------------------------------------------------------------LIQUIDATION JS PRINTOUT - END

	//--------------------------------------------------------------------------------------------------------------NEW LIQUIDATION - START

	function newKeyUpSpentNLIQ1(me){

		var curCA = document.getElementById("nliqCurCA1");
		var curSpent = document.getElementById("nliqCurSpent1");
		var curRefund = document.getElementById("nliqCurRefund1");
		var curReimb = document.getElementById("nliqCurReimb1");
		var curTax = document.getElementById("nliqTax1");

		var amounts = document.getElementsByName('nliqOBRValue1');

		var newTotalSpent = 0;
		for (var i = 0; i < amounts.length; i++) {
			var newVal = 0;
			if(amounts[i].value != ""){
				newVal = parseFloat(amounts[i].value.replace(/,/g,""));
			}
			
			// else{
			// 	amounts[i].value = 0;
			// }
			newTotalSpent += newVal;
		}

		curSpent.textContent = numberWithCommas(round2(newTotalSpent));

		var curCA1 = parseFloat(curCA.textContent.replace(/,/g,""));
		var curSpent1 = parseFloat(curSpent.textContent.replace(/,/g,""));
		var curRefund1 = parseFloat(curRefund.textContent.replace(/,/g,""));
		var curReimb1 = parseFloat(curReimb.textContent.replace(/,/g,""));

		var curTax1 = 0;
		if(curTax.value.trim().length > 0) {
			curTax1 = parseFloat(curTax.value.trim().replace(/,/g,""));
		}

		// Computation
		var refnd2 = round2(curCA1 - curSpent1);
		var reimb2 = 0;
		if(refnd2 < 0){
			reimb2 = numberWithCommas(refnd2.replace(/-/g,""))
			refnd2 = 0;
		}

		me.value = numberWithCommas(me.value.replace(/,/g,""));
		curRefund.textContent = numberWithCommas(refnd2);
		curReimb.textContent = numberWithCommas(reimb2);
	}

	function updateNLIQ(tn){
		var caAmnt = document.getElementById("nliqCurCA1").textContent.replace(/,/g,"");
		var caSpent = document.getElementById("nliqCurSpent1").textContent.replace(/,/g,"");
		var caRefund = document.getElementById("nliqCurRefund1").textContent.replace(/,/g,"");
		var caORDets = document.getElementById("nliqCurORDets1").value;
		var caReimb = document.getElementById("nliqCurReimb1").textContent.replace(/,/g,"");
		var caTax = document.getElementById("nliqTax1").value.trim().replace(/,/g,"");

		if(caTax == "") {
			caTax = 0;
		}

		var chkTax = 0;
		if(document.getElementById("nliqTaxRow1").style.display != "none") {
			chkTax = 1;
		}

		var amounts = document.getElementsByName('nliqOBRValue1');
		var obrBrkd = document.getElementsByName('nliqOBRHidden1');

		var breakdown = "";
		for (var i = 0; i < amounts.length; i++) {
			breakdown += "~"+obrBrkd[i].value+"*"+parseFloat(amounts[i].value.replace(/,/g,""));
		}

		breakdown = breakdown.substring(1);

		var proc = 0;
		if(caRefund > 0 && caORDets == ""){
			proc = 1;
		}

		if(chkTax == 1 && caTax <= 0) {
			proc = 2;
		}
		
		if(proc == 0){
			var queryString = "?updateNewLiquidation=1"
						+ "&tn=" + tn
						+ "&amount=" + caAmnt
						+ "&spent=" + caSpent
						+ "&refund=" + caRefund
						+ "&orDetails=" + caORDets
						+ "&reimb=" + caReimb
						+ "&breakdown=" + breakdown
						+ "&tax=" + caTax
						;

			var container = "";

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"updateNewLiquidation");	
		}else{
			if(proc == 1) {
				alert("Please fill in OR Details.");
			}else if(proc == 2) {
				alert("Please fill in Tax Amount.");
			}
		}
	}

	function getEncLiqAcctEdMode() {
		var progCode = document.getElementById('encLiqProgEd').value.trim();
		if(progCode != "") {
			var container = document.getElementById('encLiqAcctEd');
			var queryString = "?getEncLiqAcct=1&prog="+progCode;
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
		}
	}

	function encLiqAddChargesEd() {
		var hidden = document.getElementsByName('nliqOBRHidden1');
		var selProg = document.getElementById('encLiqProgEd');
		var selAcct = document.getElementById('encLiqAcctEd');
		var len = hidden.length;
		var obrTable = document.getElementById('encLiqTableEd');
		var tbody = obrTable.children[0];

		var addedRow = "";
		var nextSibling = len;
		var allowAdd = 1;
		for (var i = 0; i < len; i++) {
			var temp = hidden[i].value.split('*');
			var curProg = temp[0];
			var curAcct = temp[1];
			var isNew = temp[2];

			var prgTd = "";
			if(curProg != selProg.value) {
				nextSibling = i;
			}else {
				if(curAcct == selAcct.value) {
					allowAdd = 0;
				}
			}
			
		}

		if(selAcct.value.trim().length == 0) {
			allowAdd = 2;
		}
		
		if(allowAdd == 1) {
			var selectedAcct = selAcct.options[selAcct.selectedIndex].text;
			var acctTitle = selectedAcct.split(selAcct.value+" ")[1];

			addedRow ="		<td style='padding:0px 5px;'>"+prgTd+"</td>"
					+"		<td style='padding:0px 5px; padding-bottom:8px;'>"
					+"			<span style='display:block; font-weight:bold;'>"+selAcct.value+"</span>"
					+"			<span>"+acctTitle+"</span>"
					+"		</td>"
					+"		<td style='padding:0px 5px;'>"
					+"			<input name='nliqOBRValue1' class='data2' style='width:130px; text-align:right; border:0px; border-bottom:1px dashed silver;' value='0.00' onkeydown='return isAmount(this,event)' onkeyup='newKeyUpSpentNLIQ1(this)'>"
					+"			<input type='hidden' name='nliqOBRHidden1' value='"+selProg.value+"*"+selAcct.value+"*1'>"
					+"		</td>";
			
			if(nextSibling == len) {
				tbody.innerHTML += "<tr>"+addedRow+"</tr>";
			}else {
				var tr = document.createElement('TR');
				tr.innerHTML = addedRow;
				// tbody.children.insertBefore(tr, tbody.children[nextSibling]);
				tbody.insertBefore(tr, tbody.children[nextSibling]);
			}
		}else {
			if(allowAdd == 0) {
				alert("Account already added. Please select another account.");
			}else if(allowAdd == 2) {
				alert("Please select account code.");
			}
		}
		
	}

	//--------------------------------------------------------------------------------------------------------------NEW LIQUIDATION - END



	//--------------------------------------------------------------------------------------------------------------INFRA NF - START

	function editINFRAStatus(me, status){
		var tn = me.id.replace("obrEdit", "");
		
		var queryString = "?getNFStatusList=1&tn="+tn+"&status="+status;
		var container = null;

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"getNFStatusList");
	}

	function editNFUpdateStatus(me){
		var tn = me.id.replace("editor", "");
		var status = document.getElementById('editNFStatus').value;

		var queryString = "?editNFUpdateStatus=1&tn="+tn+"&status="+status;
		var container = null;

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"editNFUpdateStatus");
	}

	//--------------------------------------------------------------------------------------------------------------INFRA NF - START

	//--------------------------------------------------------------------------------------------------------------Multiple Liquidation - START

	// function selectCashAdvanceMLQ1(){

	// 	var caList = document.getElementById('selectCashAdvanceMLQList1');
	// 	var caListCont = document.getElementById('caListAddedMLQ1');
	// 	var tbody = caListCont.children[1];
	// 	var claimantMLQ = document.getElementById('claimantMLQ1');
	
	// 	// clearCashAdvanceMLQ();
	// 	var arr = caList.value.split("@");
	// 	if(arr.length > 1){
	// 		var tn = arr[0];
	// 		var amount  = numberWithCommas(arr[1]);
	// 		var claimant = arr[2];
	// 		var month = arr[3];

	// 		// if(claimantMLQ.value.trim() == "" || claimantMLQ.value.trim() == claimant){

	// 			claimantMLQ.value = claimant;

	// 			var chking = checkCAListMLQ1(tn);
	// 			if(chking == 0){
	// 				var remove = "<i style='cursor:pointer;font-size:24px;font-weight:bold;color:red;' onclick='removeThisRowMLQ1(this)'>×</i>";

	// 				var tr = "<tr>"
	// 					   + "<td style='padding-left:10px; width:100px;'>"
	// 					   + "<input name='caTNList1' value='"+tn+"' style='font-family:Oswald; width:100%; color:black; background-color:white; border:0px; font-size:14px; font-weight:bold; padding:0px;' disabled>"
	// 					   + "</td>"
	// 					   + "<td style='padding:0px 10px; font-size:14px;'>"+month+"</td>"
	// 					   + "<td style='padding:0px 10px; font-size:14px;'>"
	// 					   + "<span class='caNameList1'>"+claimant+"</span>"
	// 					   + "</td>"
	// 					   + "<td style='padding-right:10px; font-size:14px; text-align:right;'>"
	// 					   + "	<input maxlength='16' name='mlqCAAmount1' class='data2' style='font-size:13px; width:110px; text-align:right; border:0px; background-color:white; color:black;' value='"+amount+"' disabled>"
	// 					   + "</td>"
	// 					   + "<td style='padding:5px 5px;'>"
	// 					   + "	<input maxlength='16' name='mlqSpent1' onkeydown='return isAmount(this,event)' class='data2' style='font-size:13px; width:110px; text-align:right; border:0px; border-bottom:1px dashed black;' onkeyup='newKeyUpSpentMLQ1(this)'>"
	// 					   + "</td>"
	// 					   + "<td style='padding:5px 5px;'>"
	// 					   + "	<input maxlength='16' name='mlqRefund1' onkeydown='return isAmount(this,event)' class='data2' style='font-size:13px; width:110px; text-align:right; border:0px; border-bottom:1px dashed black; background-color:white;' value='0' disabled>"
	// 					   + "</td>"
	// 					   + "<td style='padding:5px 5px;'>"
	// 					   + "	<input maxlength='16' name='mlqORDetails1' onkeydown='return isAmount(this,event)' class='data2' style='font-size:13px; width:110px; text-align:right; border:0px; border-bottom:1px dashed black;'>"
	// 					   + "</td>"
	// 					   + "<td style='padding:5px 5px;'>"
	// 					   + "	<input maxlength='16' name='mlqReimbrsmnt1' onkeydown='return isAmount(this,event)' class='data2' style='font-size:13px; width:110px; text-align:right; border:0px; border-bottom:1px dashed black; background-color:white;' value='0' disabled>"
	// 					   + "</td>"
	// 					   + "<td style='text-align:center;'>"+remove+"</td>"
	// 					   + "</tr>";

	// 				// tbody.innerHTML += tr;
	// 				tbody.insertAdjacentHTML('beforeend',tr);
	// 				// document.getElementById("cashAdvanceTNMLQ").value = tn;
	// 				var total = document.getElementById("cashAdvanceAmountMLQ1");
	// 				var curTotal = 0;
	// 				if(total.value != ""){
	// 					curTotal = parseFloat(total.value.replace(/,/g,""));
	// 				}
	// 				var toAdd = parseFloat(amount.replace(/,/g,""));
	// 				total.value = numberWithCommas(curTotal + toAdd);
	// 			} else {
	// 				alert(tn+" already added.");
	// 			}
	// 		// }else{
	// 		// 	alert(tn+" has a different claimant.");
	// 		// }
	// 	}
		
	// }

	// function checkCAListMLQ1(tn){
	// 	var caTNList = document.getElementsByName('caTNList1');

	// 	if(caTNList.length > 0){
	// 		for (var i = 0; i < caTNList.length; i++) {
	// 			if(caTNList[i].value == tn){
	// 				return 1;
	// 				break;
	// 			}
	// 		}
	// 	}
	// 	return 0;
	// }

	// function saveMLQ1(trackingNumber){

	// 	var caTNList = document.getElementsByName('caTNList1');
	// 	var caAmountList = document.getElementsByName('mlqCAAmount1');		
	// 	var caSpentList = document.getElementsByName('mlqSpent1');		
	// 	var caRefundList = document.getElementsByName('mlqRefund1');		
	// 	var caReimbList = document.getElementsByName('mlqReimbrsmnt1');

	// 	var caORDetList = document.getElementsByName('mlqORDetails1');

	// 	var caAmountTotal = document.getElementById('cashAdvanceAmountMLQ1').value.replace(/,/g,"");		
	// 	var caSpentTotal = document.getElementById('cashSpentMLQ1').value.replace(/,/g,"");		
	// 	var caRefundTotal = document.getElementById('cashAdvanceRefundMLQ1').value.replace(/,/g,"");		
	// 	var caReimbTotal = document.getElementById('cashAdvanceReimbursedMLQ1').value.replace(/,/g,"");

	// 	var claimant = document.getElementById("claimantMLQ1").value.trim();
		
	// 	var caAll = "";
	// 	var oops = 0;
	// 	if(caTNList.length > 0){
	// 		for (var i = 0; i < caTNList.length; i++) {
	// 			var tn = caTNList[i].value;
	// 			var spent = caSpentList[i].value.replace(/,/g,"");
	// 			var refund = caRefundList[i].value.replace(/,/g,"");
	// 			var reimbrs = caReimbList[i].value.replace(/,/g,"");
	// 			var orDets = encodeURIComponent(caORDetList[i].value);

	// 			caAll += "*j*"+tn+"~"+spent+"~"+refund+"~"+reimbrs+"~"+orDets;

	// 			if(refund > 1){
	// 				if(orDets == ''){
	// 					oops = 1;
	// 					break;
	// 				}
	// 			}
	// 			if(tn == ''){
	// 				oops = 2;
	// 				break;
	// 			}
	// 			if(spent == ''){
	// 				oops = 3;
	// 				break;
	// 			}

	// 		}

	// 		caAll = caAll.substring(3);

	// 		if(oops == 0){
	// 			var queryString = "?updateTrackingMLQ=1"
	// 							+ "&tn="    	  + trackingNumber
	// 							+ "&caAmount="    + caAmountTotal
	// 							+ "&caSpent=" 	  + caSpentTotal
	// 							+ "&caRefund=" 	  + caRefundTotal
	// 							+ "&caReim=" 	  + caReimbTotal
	// 							+ "&claimant=" 	  + claimant
	// 							+ "&caBreakdown=" + caAll;
	// 			var container = document.getElementById('divNewTrackingNumber');
				
	// 			loader();
	// 			ajaxGetAndConcatenate(queryString,processorLink,container,"updateTrackingMLQ");
	// 		}else if(oops == 1){
	// 			alert("Please enter official receipt details.");
	// 		}else if(oops == 2){
	// 			alert("Please select cash advance.");
	// 		}else if(oops == 3){
	// 			alert("Please enter cash spent.");
	// 		}
	// 	}else{
	// 		alert("Please add cash advance.");
	// 	}
		
		
	// }

	// // 2021-12-13 For Multiple/Consolidated Liquidation with different details
	// function newKeyUpSpentMLQ1(me){
	// 	//Elements
	// 	var tbody = me.parentNode.parentNode.parentNode;
	// 	var caAmt = me.parentNode.parentNode.children[3].children[0];
	// 	var spent = me.parentNode.parentNode.children[4].children[0];
	// 	var refnd = me.parentNode.parentNode.children[5].children[0];
	// 	var reimb = me.parentNode.parentNode.children[7].children[0];

	// 	// Values
	// 	var caAmt1 = parseFloat(caAmt.value.replace(/,/g,""));
	// 	var spent1 = 0;
	// 	if(spent.value != ""){
	// 		spent1 = parseFloat(spent.value.replace(/,/g,""));
	// 	}
	// 	var refnd1 = parseFloat(refnd.value.replace(/,/g,""));
	// 	var reimb1 = parseFloat(reimb.value.replace(/,/g,""));

	// 	// if(spent1 == ""){
	// 	// 	// Re-assigning
	// 	// 	refnd.value = numberWithCommas(0);
	// 	// 	reimb.value = numberWithCommas(0);
	// 	// }else{

	// 		// Computation
	// 		var refnd2 = round2(caAmt1 - spent1);
	// 		var reimb2 = 0;
	// 		if(refnd2 < 0){
	// 			reimb2 = numberWithCommas(refnd2.replace(/-/g,""))
	// 			refnd2 = 0;
	// 		}

	// 		// Re-assigning
	// 		refnd.value = numberWithCommas(refnd2);
	// 		reimb.value = numberWithCommas(reimb2);
	// 	// }

	// 	// spent.value = numberWithCommas(spent1);

	// 	mlqUpdateValues1(tbody);		
	// }

	// function mlqUpdateValues1(parent){
	// 	var caTotal = document.getElementById("cashAdvanceAmountMLQ1");
	// 	var spentTotal = document.getElementById("cashSpentMLQ1");
	// 	var refundTotal = document.getElementById("cashAdvanceRefundMLQ1");
	// 	var reimbTotal = document.getElementById("cashAdvanceReimbursedMLQ1");

	// 	var newCATotal = 0;
	// 	var newSPTotal = 0;
	// 	var newRFTotal = 0;
	// 	var newRETotal = 0;

	// 	for(var i = 0 ; i < parent.children.length; i++){
	// 		newCATotal += parseFloat(parent.children[i].children[3].children[0].value.replace(/,/g,""));
	// 		newSPTotal += parseFloat(parent.children[i].children[4].children[0].value.replace(/,/g,""));
	// 		newRFTotal += parseFloat(parent.children[i].children[5].children[0].value.replace(/,/g,""));
	// 		newRETotal += parseFloat(parent.children[i].children[7].children[0].value.replace(/,/g,""));
	// 	}

	// 	caTotal.value = numberWithCommas(newCATotal);
	// 	spentTotal.value = numberWithCommas(newSPTotal);
	// 	refundTotal.value = numberWithCommas(newRFTotal);
	// 	reimbTotal.value = numberWithCommas(newRETotal);
	// }

	// function removeThisRowMLQ1(me){
	// 	var tbody = me.parentElement.parentElement.parentElement;
	// 	var tr = me.parentElement.parentElement;
		
	// 	tbody.removeChild(tr);

	// 	mlqUpdateValues1(tbody);		
	// 	updateCurrentClaimantMLQ1();
	// }

	// function updateCurrentClaimantMLQ1(){
	// 	var claimantMLQ = document.getElementById('claimantMLQ1');
	// 	var caNameList = document.getElementsByClassName('caNameList1');
	// 	var len = caNameList.length;
	// 	if(len > 0){
	// 		var lastChild = caNameList[len - 1];
	// 		claimantMLQ.value = lastChild.textContent.trim();
	// 	}
	// }

	//--------------------------------------------------------------------------------------------------------------Multiple Liquidation - END

	
	//--------------------------------------------------------------------------------------------------------------WAGES - START
	var sessActType = <?= $_SESSION['accountType']; ?>;
	var sessOffice = <?= "'".$_SESSION['cbo']."'"; ?>;
	var allowWGSfuncs = 0;

	if(sessActType == 2 && sessOffice == "1071") {
		allowWGSfuncs = 1;
	}

	if(sessActType != 1 && sessOffice == "1081") {
		allowWGSfuncs = 1;
	}

	// if(sessActType != 4 && sessOffice == "1081") {
	// 	allowWGSfuncs = 1;
	// }

	if(sessActType == 7) {
		allowWGSfuncs = 1;
	}

	if(allowWGSfuncs == 1){
		// function searchPTRS(me){
		// 	var ptrs = me.value.trim();

		// 	if(ptrs != ""){
		// 		var container = "";
		// 		var docType = "";
		// 		var upType = 0;

		// 		if(me.id == "sequenceNumWGS1"){
		// 			container = document.getElementById('dbfTable1');
		// 			docType = document.getElementById('selectDocTypeWGS1').value.toUpperCase();
		// 			upType = 1;
		// 		}else{
		// 			container = document.getElementById('dbfTable');
		// 			docType = document.getElementById('selectDocTypeWGS').value.toUpperCase();
		// 		}

		// 		loader();
		// 		var queryString = "?searchPTRS=1&ptrs="+ptrs+"&doctype="+docType+"&uptype="+upType;
		// 		ajaxGetAndConcatenate(queryString,processorLink,container,"searchPTRS");	
		// 	}else{
		// 		alert("Please check details.");
		// 	}
			
		// }


		function searchPTRS(me){
			var ptrs = me.value.trim();
			// var selectDocTypeWGS = document.getElementById('selectDocTypeWGS').value.toUpperCase();
			// var selectPeriodWGS = document.getElementById('selectPeriodWGS1').value;

			if(ptrs != ""){
				var temp = ptrs.replace(/\s/g,"");
				var arr1 = temp.split(",");
				var proc = 0;
				for(var i = 0; i < arr1.length; i++) {
					if(arr1[i] == ""){
						proc = 1;
						break;
					}

					var arr2 = arr1[i].split("-");
					if(arr2.length < 3){
						proc = 2;
						break;
					}

				}
				
				if(proc == 0){
					var container = "";
					var docType = "";
					var upType = 0;

					if(me.id == "sequenceNumWGS1"){
						container = document.getElementById('dbfTable1');
						docType = document.getElementById('selectDocTypeWGS1').value.toUpperCase();
						upType = 1;
					}else{
						container = document.getElementById('dbfTable');
						docType = document.getElementById('selectDocTypeWGS').value.toUpperCase();
					}

					loader();
					var queryString = "?searchPTRS=1&ptrs="+ptrs+"&doctype="+docType+"&uptype="+upType;
					ajaxGetAndConcatenate(queryString,processorLink,container,"searchPTRS");
				}else if(proc == 1){
					alert('Please remove excess ",".');
				}else if(proc == 2){
					alert('Please make sure to enter the PTRS number completely. (e.g. RP-000000-0000 OR SP-000000-0000)');
				}
			}else{
				alert("Please enter PTRS Number.");
			}
			
		}

		function showHideWGSSubPrgCode(me){
			var code = me.value;
			var wgsSubPrgCodeCnt = document.getElementById('wgsSubPrgCodeCnt');

			if(me.value == "1011-1"){
				wgsSubPrgCodeCnt.style.display = "";
			}else{
				wgsSubPrgCodeCnt.style.display = "none";
				selectToIndexZero("wgsSubPrgCode");
			}

		}

		function resetDbfTable(){
			var sequenceNumWGS = document.getElementById('sequenceNumWGS');
			var dbfTable = document.getElementById('dbfTable');

			if(sequenceNumWGS != null && sequenceNumWGS.value.length > 0){
				dbfTable.innerHTML = "";
			}
		}

		var wgsModeF = 0;
		function wgsMode(me){
			var id = me.id;

			var wgsChargesTblM = document.getElementById('wgsChargesTblM');
			var wgsChargesTbl = document.getElementById('wgsChargesTbl');

			wgsChargesTblM.style.display = "none";
			wgsChargesTbl.style.display = "none";

			if(id == "wgsManl"){
				wgsChargesTblM.style.display = "table";
				wgsModeF = 1;
			}else{
				wgsChargesTbl.style.display = "table";
				wgsModeF = 0;
			}
		}

		function wgsAddMultipleSource(me){
			var tr = me.parentElement.parentElement.children;
			var th = me.parentElement.children;

			var progSel = tr[0].children[0].children[0];
			var program = progSel.value;
			
			var acctSel = tr[1].children[1].children[0];
			var account = acctSel.value;

			var amount = th[1].value;

			var progTitle = progSel.options[progSel.selectedIndex].text;
			progTitle = progTitle.replace(program, "").trim();

			var acctTitle = acctSel.options[acctSel.selectedIndex].text;
			acctTitle = acctTitle.replace(account, "").trim();

			if(program != "" && account != "" && amount != ""){
				var wgsExisting = wgsCheckExisitingCharges(program, account);

				if(wgsExisting == 0){
					var newTotal = wgsUpdateRemainingTotal("-", amount);

					if(newTotal == 0){
						var temp  = "<tr>";
						temp += "	<td style='padding:5px 8px; vertical-align:top; width:220px;'>";
						temp += "		<input type='text' class='wgsValuePlain' style='text-align:left;' name='wgsPrgCodeM' disabled value='"+program+"'>";
						temp += 		progTitle;
						temp += "	</td>";
						temp += "	<td style='padding:5px 8px; vertical-align:top; width:320px;'>";
						temp += "		<input type='text' class='wgsPlainInput' name='wgsAccCodeM' disabled value='"+account+"'>";
						temp += 		acctTitle;
						temp += "	</td>";
						temp += "	<td style='padding:5px 8px; vertical-align:center; width:215px;'>";
						temp += "		<input type='text' class='wgsValuePlain' style='width:75%;' name='wgsValuesM' disabled value='"+numberWithCommas(parseFloat(amount).toFixed(2))+"'>";
						temp += "	</td>";
						temp += "	<td style='padding:5px 8px; '>";
						temp += "		<div class='label18' onclick='wgsRemoveRow(this)'></div>";
						temp += "	</td>";
						temp += "</tr>";

						var wgsChargesTblM = document.getElementById('wgsChargesTblM');
						var tbody = wgsChargesTblM.children[1];
						tbody.innerHTML += temp;
					}else{
						alert("Please check remaining balance.");
					}
				}else{
					alert('Fund details already added.');
				}
				
				
			}else{
				alert('Please check details.');
			}
			
		}

		function wgsCheckExisitingCharges(prog, acct){
			var prgCodeAll = document.getElementsByName('wgsPrgCodeM');
			var accCodeAll = document.getElementsByName('wgsAccCodeM');
		
			for (let i = 0; i < accCodeAll.length; i++) {
				if(prgCodeAll[i].value == prog && accCodeAll[i].value == acct){
					return 1;
				}			
			}

			return 0;
		}

		function wgsUpdateRemainingTotal(operation, amount){
			var wgsTotalAmountMultiple = document.getElementById('wgsTotalAmountMultiple');
			// var selectDocTypeWGS = document.getElementById('selectDocTypeWGS').value;
			if(document.getElementById('selectDocTypeWGS1') == null){
				var docType = document.getElementById('selectDocTypeWGS').value.trim();
			}else{
				var docType = document.getElementById('selectDocTypeWGS1').value.trim();
			}

			if(wgsTotalAmountMultiple.tagName == "INPUT"){
				var curTotal = wgsTotalAmountMultiple.value.replace(/,/g,"");
			}else{
				var curTotal = wgsTotalAmountMultiple.innerText.replace(/,/g,"");
			}

			var newTotal = 0;
			if(operation == "+"){
				newTotal =  parseFloat(curTotal) + parseFloat(amount);
			}else{
				newTotal =  parseFloat(curTotal) - parseFloat(amount);
			}

			if(newTotal >= 0){
				if(wgsTotalAmountMultiple.tagName == "INPUT"){
					wgsTotalAmountMultiple.value = numberWithCommas(parseFloat(newTotal).toFixed(2));
				}else{
					wgsTotalAmountMultiple.innerText = numberWithCommas(parseFloat(newTotal).toFixed(2));
				}

				return 0;
			}else{
				return 1;
			}
		}

		function wgsRemoveRow(me){
			var tr = me.parentElement.parentElement; 
			var tbody = me.parentElement.parentElement.parentElement; 
			var amount = tr.children[2].children[0].value.replace(/,/g,"");
			tbody.removeChild(tr);
			
			var newTotal = wgsUpdateRemainingTotal("+", amount);
		}

		function onChangeWGSCodesPY(){
			var span = document.getElementById('wgsAcctSourceM');
			// var span = tr.children[1].children[1];
			var programCode = "";

			loader();
			var queryString = "?fetchAccountCodesPYWGS=1&programCode=" + programCode;
			var container = span;
			ajaxGetAndConcatenate(queryString,processorLink,container,"fetchAccountCodesPY");
		} 

		function LoadProgramFundsByOfficeWages(){
			var queryString = "?LoadProgramFundsByOfficeWages=1";
			var container = document.getElementById('wgsFundSourceM');
			ajaxGetAndConcatenate(queryString,processorLink,container,"LoadProgramFundsByOfficeWages");
			onChangeWGSCodesPY();
		}

		function clearFieldsWGS(){
			selectToIndexZero("selectDocTypeWGS");
			selectToIndexZero("selectFundWGS");
			selectToIndexZero("selectClaimTypeWGS");
			selectToIndexZero("selectPeriodWGS");

			var claimantWGS = document.getElementById('claimantWGS');
			if(claimantWGS != undefined){
				claimantWGS.value = ""
			}
			var dbfTable = document.getElementById('dbfTable');
			if(dbfTable != undefined){
				dbfTable.innerHTML = "";
			}
			var sequenceNumWGS = document.getElementById('sequenceNumWGS');
			sequenceNumWGS.value = "";
		}

		function autoModeSelect(){
			if(document.getElementById('selectDocTypeWGS1') == null){
				var docType = document.getElementById('selectDocTypeWGS').value.trim();
			}else{
				var docType = document.getElementById('selectDocTypeWGS1').value.trim();
			}

			const autoDef = [
							'WAGES - BACK PAY',
							'WAGES - OVERTIME PAY (Plantilla)', 
							'WAGES - SALARY PLANTILLA',
							'WAGES - SALARY DIFFERENTIAL'
						];
			
			if(!autoDef.includes(docType)){
				document.getElementById('wgsManl').click();
				document.getElementById('wgsAuto').style.display = "none";
				document.getElementById('wgsAuto').nextElementSibling.style.display = "none";
			}
		}

		function showHidePEORCodeWGS(me){
			var progCode = me.value;
			var row = document.getElementById('peorCodeRow');
			var subCode = document.getElementById('peorSubCodeWGS');
			var ofcId = document.getElementById('peorOfcIdWGS');
			var codeCont = document.getElementById('peorCodesWGS');
			var show1 = 0;
			var show2 = 0;

			subCode.value = 0;
			codeCont.textContent = "";
			ofcId.value = 0;

			if(progCode == "1011-1"){
				show1 = 1;
			}else{
				show1 = 0;
			}

			if(wgsModeF == 0){
				var prgCodeAll = document.getElementsByName('wgsPrgCode');
			}else{
				var prgCodeAll = document.getElementsByName('wgsPrgCodeM');
			}

			if(prgCodeAll.length > 0){
				for (let i = 0; i < prgCodeAll.length; i++) {
					if(prgCodeAll[i].value == "1011-1"){
						show2 = 1;
					}else{
						show2 = 0;
					}
				}
			}


			if(show1 == 1 || show2 == 1){
				row.style.display = 'table';
			}else{
				row.style.display = 'none';
			}
		}

	}

	

	// function setSubCodeForManualWGS1(){
	// 	var peorOfcId = document.getElementById('peorWGSOfcId').value;
	// 	var subCode = document.getElementById('peorWGSSubCode').value;
	// 	var ofcName = document.getElementById('peorWGSOfcName').textContent;
	// 	var subName = document.getElementById('peorWGSSubName').textContent;
	// 	var codeCont = document.getElementById('peorCodesWGS');
	// 	var wgsSubCodeHid = document.getElementById('peorSubCodeWGS');
	// 	var wgsOfcIdHid = document.getElementById('peorOfcIdWGS');

	// 	if(peorOfcId != "" && subCode != ""){
	// 		document.getElementById('clickClose').click();
	// 		// saveWGS(subCode, peorOfcId);
			
	// 		codeCont.textContent = ofcName+" "+subName;
	// 		wgsSubCodeHid.value = subCode;
	// 		wgsOfcIdHid.value = peorOfcId
	// 	}else{
	// 		alert("Please select a Sub-Program Code.");
	// 	}
	// }

	function setWGSPEORDetails1(me){
		var ofcName = document.getElementById('peorWGSOfcName');
		var subName = document.getElementById('peorWGSSubName');
		var ofcId = document.getElementById('peorWGSOfcId');
		var sudCode = document.getElementById('peorWGSSubCode');
		
		var codeCont = document.getElementById('peorCodesWGS');
		var wgsSubCodeHid = document.getElementById('peorSubCodeWGS');
		var wgsOfcIdHid = document.getElementById('peorOfcIdWGS');

		var temp = me.id.split("*");
		var selOfcId = temp[0];
		var selSubCode = temp[1];

		var tdS = me.children;
		var cellOfcName = tdS[1].textContent;
		var cellSubName = tdS[2].textContent;

		codeCont.innerHTML = "<span style='color:rgb(35, 116, 157);'>"+cellOfcName+"</span> "+cellSubName;
		wgsSubCodeHid.value = selSubCode;
		wgsOfcIdHid.value = selOfcId;

		document.getElementById('clickClose').click();
	}

	function showSubCodeSelectionWGS1(tType){
		var queryString = "?fetchSubProgramBalanceForWGS=1&upType=1";
		var container = "";
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchSubProgramBalanceForWGS");

	}

	function checkChargesForSubWGS1(){
		if(wgsModeF == 0){
			var prgCodeAll = document.getElementsByName('wgsPrgCode');
		}else{
			var prgCodeAll = document.getElementsByName('wgsPrgCodeM');
		}

		var tableDoctrackDBFList = document.getElementById('tableDoctrackDBFList');
		var tbody = tableDoctrackDBFList.children[1].children;
		var wgsSubCodeHid = document.getElementById('peorSubCodeWGS').value;
		var wgsOfcIdHid = document.getElementById('peorOfcIdWGS').value;

		var proc = 0;
		if(tbody.length > 0){
			for(let i = 0; i < prgCodeAll.length; i++){
				if(prgCodeAll[i] != null && prgCodeAll[i].value == "1011-1"){
					if(wgsOfcIdHid == 0 && wgsSubCodeHid == 0){
						proc = 1;
						break;
					}
				}
			}
			if(proc == 0){
				updateTrackingWGS();
			}else{
				alert("Please select a Sub-Program Code.");
			}
		}else{
			alert('Please check details.');
		}
		
	}
	
	function updateTrackingWGS(){
		var selectDocTypeWGS = document.getElementById('selectDocTypeWGS1').value;
		var wgsTracking = document.getElementById('updateWGSTn').value;
		var claimantWGS = document.getElementById('claimantWGS').value;
		// var wgsSubPrgCode = document.getElementById('wgsSubPrgCode').value;
		var wgsPTRS = document.getElementById('sequenceNumWGS1').value;
		var wgsSubPrgCode = document.getElementById('peorSubCodeWGS').value;
		var wgsPEOROfcId = document.getElementById('peorOfcIdWGS').value;
		var wgsTotalNetUniv = document.getElementById('wgsTotalNetUniv').textContent.replace(/,/g,"");

		var wgsTotCompensation = document.getElementById('wgsTotCompensation').textContent.replace(/,/g,"");
		var wgsTotPERA = document.getElementById('wgsTotPERA').textContent.replace(/,/g,"");
		var wgsTotGSIS = document.getElementById('wgsTotGSIS').textContent.replace(/,/g,"");
		var wgsTotPHealth = document.getElementById('wgsTotPHealth').textContent.replace(/,/g,"");
		var wgsTotPIbig = document.getElementById('wgsTotPIbig').textContent.replace(/,/g,"");
		var wgsTotECIP = document.getElementById('wgsTotECIP').textContent.replace(/,/g,"");
		var wgsTotGross = document.getElementById('wgsTotGross').textContent.replace(/,/g,"");
		var wgsTotLWOP = document.getElementById('wgsTotLWOP').textContent.replace(/,/g,"");
		var wgsTotDeductions = document.getElementById('wgsTotDeductions').textContent.replace(/,/g,"");
		var wgsTotTax = document.getElementById('wgsTotTax').textContent.replace(/,/g,"");

		var wgsTotGSISPS = document.getElementById('wgsTotGSISPS').value.replace(/,/g,"");
		var wgsTotPIbigPS = document.getElementById('wgsTotPIbigPS').value.replace(/,/g,"");
		var wgsTotPHealthPS = document.getElementById('wgsTotPHealthPS').value.replace(/,/g,"");

		var wgsMultipleRecs = document.getElementById('wgsMultipleRecs').value;

		var tableDoctrackDBFList = document.getElementById('tableDoctrackDBFList');
		var wgsChargesTbl = document.getElementById('wgsChargesTbl');

		var tbody = tableDoctrackDBFList.children[1].children;
		var empStr = "";

		if(tbody.length > 0 && claimantWGS != "" && selectDocTypeWGS != ""){
			if(wgsModeF == 0){
				var prgCodeAll = document.getElementsByName('wgsPrgCode');
				var accCodeAll = document.getElementsByName('wgsAccCode');
				var wgsValuAll = document.getElementsByName('wgsValues');
			}else{
				var prgCodeAll = document.getElementsByName('wgsPrgCodeM');
				var accCodeAll = document.getElementsByName('wgsAccCodeM');
				var wgsValuAll = document.getElementsByName('wgsValuesM');
			}

			var curPrgCode = "";
			var totalStr = "";

			$alertF = 0;

			if(wgsValuAll.length > 0){
				for (let i = 0; i < wgsValuAll.length; i++) {
					if(prgCodeAll[i] != null){
						curPrgCode = prgCodeAll[i].value;
						if(prgCodeAll[i].value == ""){
							$alertF = 1;
						}
					}

					totalStr += "$"+curPrgCode+"~"+accCodeAll[i].value.replace(/,/g,"")+"~"+wgsValuAll[i].value.replace(/,/g,"");
				}

				var empBreakdown = "";
				var tbody1 = document.getElementById('wagesEmployeeDetailsContainer');
				var trS1 = tbody1.children;
				for (let i = 0; i < trS1.length-1; i++) {
					if(trS1[i].children[1].id != '') {
						var offName = trS1[i].children[1].textContent.trim();
						var offCode = trS1[i].children[1].id;
						var empName = trS1[i].children[2].textContent.trim();
						var empNumb = trS1[i].children[2].id;
						var compensation = trS1[i].children[3].textContent.trim().replace(/,/g,"");
						var pera = trS1[i].children[4].textContent.trim().replace(/,/g,"");
						var gsis = trS1[i].children[5].textContent.trim().replace(/,/g,"");
						var philhealth = trS1[i].children[6].textContent.trim().replace(/,/g,"");
						var pagibig = trS1[i].children[7].textContent.trim().replace(/,/g,"");
						var ecip = trS1[i].children[8].textContent.trim().replace(/,/g,"");
						var gross = trS1[i].children[9].textContent.trim().replace(/,/g,"");
						var absences = trS1[i].children[10].textContent.trim().replace(/,/g,"");
						var deductions = trS1[i].children[11].textContent.trim().replace(/,/g,"");
						var tax = trS1[i].children[12].textContent.trim().replace(/,/g,"");
						var net = trS1[i].children[13].textContent.trim().replace(/,/g,"");
						var header = trS1[i].children[13].id;

						empBreakdown += "*j*"+offName+"~"+offCode+"~"+empName+"~"+empNumb+"~"+compensation+"~"+pera+"~"+gsis+"~"+philhealth+"~"+pagibig+"~"+ecip+"~"+gross+"~"+absences+"~"+deductions+"~"+tax+"~"+net+"~"+header;
					}
				}	
				
				if($alertF == 0){
					var formData = new FormData();

					formData.append('empBreakdown', empBreakdown.substring(3));
					formData.append('ptrs', wgsPTRS);
					formData.append('tn', wgsTracking);
					formData.append('totalBreakdown', totalStr.substring(1));
					formData.append('claimant', claimantWGS);
					formData.append('docType', selectDocTypeWGS);
					formData.append('subPrgCode', wgsSubPrgCode);
					formData.append('peorOfcId', wgsPEOROfcId);
					formData.append('netAmount', wgsTotalNetUniv);

					formData.append('totCompensation', wgsTotCompensation);
					formData.append('totPERA', wgsTotPERA);
					formData.append('totGSIS', wgsTotGSIS);
					formData.append('totPHealth', wgsTotPHealth);
					formData.append('totPIbig', wgsTotPIbig);
					formData.append('totECIP', wgsTotECIP);
					formData.append('totGross', wgsTotGross);
					formData.append('totLWOP', wgsTotLWOP);
					formData.append('totDeductions', wgsTotDeductions);
					formData.append('totTax', wgsTotTax);

					formData.append('totGSISPS', wgsTotGSISPS);
					formData.append('totPIbigPS', wgsTotPIbigPS);
					formData.append('totPHealthPS', wgsTotPHealthPS);
					formData.append('multipleRecs', wgsMultipleRecs);

					var wgsTotalAmountMultiple = document.getElementById('wgsTotalAmountMultiple');
					var curTotal = wgsTotalAmountMultiple.innerText.replace(/,/g,"");
					if(parseFloat(curTotal) > 0 && wgsModeF == 1){
						alert("Remaining balance is greater than 0. Please check.");
					}else{
						loader();
						formData.append('updateWages', 1);
						ajaxFormUpload(formData, processorLink, 'updateWages');
					}
					
				}else{
					alert("Please fill in all missing fields.");
				}
			}else{
				alert("OBR details are missing.");
			}
		}else{
			alert('Please check details.');
		}
	}
	//---------------------------------------------- WAGES - END

	//---------------------------------------------- RETENTION - START
	// function openRetentionEditor(tn){
	// 	var queryString = "?editRetention=1&tn="+tn;
	// 	var container = "";
	// 	loader();
	// 	ajaxGetAndConcatenate(queryString,processorLink,container,"editRetention");
	// }
	function removeRetention1(elem) {
		var parent = elem.parentElement.parentElement.parentElement;
		var row = elem.parentElement.parentElement;
		updateRetTotal1("-"+row.children[5].innerText)
		parent.removeChild(row);
	}
	function updateRetTotal1(amount){
		var retTotalElem = document.getElementById('retEditTotal');
		var retTotal = parseFloat(retTotalElem.innerText.replace(/,/g,""));
		
		amount = parseFloat(amount.replace(/,/g,""));
		
		var tempTotal = retTotal + amount;
		retTotalElem.innerHTML = numberWithCommas(tempTotal.toFixed(2));

		var totalTr = document.getElementById('retEditCont1');
		var saveTr = document.getElementById('retEditCont2');
		if(tempTotal > 0){
			totalTr.style.display = "block";
			saveTr.style.display = "block";
		}else{
			totalTr.style.display = "none";
			saveTr.style.display = "none";
		}
	}
	function getPODetailsForRET1(field) {
		var tn = field.value;
		var queryString = "?getPODetailsForRET=1&trackingNumber="+tn+"&dntChk=1";
		var container = "";

		loader();
		ajaxGetAndConcatenate(queryString, processorLink, container, "getPODetailsForRET1");
	}
	function addMultipleRET1(record) {
		var invNum = record[0];
		var invDate = record[1];
		var amount = record[2];
		var poNum = record[3];
		var trackingNumber = record[4];
		var amountPer = amount*0.01;
		var claimant = record[5];

		var claimantRETEdit = document.getElementById('claimantRETEdit').value.trim();

		if(claimant == claimantRETEdit){
			var oneTimeAlert = "Missing :";
			var alertF = 0;
			if(invNum === "" || invNum === null){
				invNum = "";
			}
			if(invDate === "" || invDate === null){
				invDate = "";
			}

			var chker = checkExistingRetention1(trackingNumber);
			
			if(chker == 0){
				var trString ="<tr>"
							+"<td style='border-bottom:1px solid rgba(0,0,0,.1);text-align:left;padding-left:10px;'>"+trackingNumber+"</td>"
							+"<td style='border-bottom:1px solid rgba(0,0,0,.1);text-align:left;padding-left:10px;'>"+poNum+"</td>"
							+"<td style='border-bottom:1px solid rgba(0,0,0,.1);cursor:pointer;'>"
							+"<input type='text' style='width:150px; font-family:mainFont;font-size:16px;border:0px;background-color:transparent;padding-left:10px;' onclick='changeToEditable(this)' onkeydown='keypressAndWhatClear(this,event,updateRetElem1,1);setUpdateInvFlag(this);' value='"+invNum+"' readonly>"
							+"</td>"
							+"<td style='border-bottom:1px solid rgba(0,0,0,.1);cursor:pointer;'>"
							+"<input type='text' style='width:150px; font-family:mainFont;font-size:16px;border:0px;background-color:transparent;padding-left:10px;' onclick='changeToEditable(this)' onkeydown='keypressAndWhatClear(this,event,updateRetElem1,1);setUpdateInvFlag(this);' value='"+invDate+"' readonly>"
							+"</td>"
							+"<td style='border-bottom:1px solid rgba(0,0,0,.1);text-align:right;padding-right:10px;'>"+numberWithCommas(amount)+"</td>"
							+"<td style='border-bottom:1px solid rgba(0,0,0,.1);text-align:right;padding-right:10px;' style='cursor:pointer;'>"
							+numberWithCommas(amountPer.toFixed(2))
							+"</td>"
							+"<td style='text-align:center;'>"
							+"<i style='cursor:pointer;font-size:24px;font-weight:bold;color:red;' onclick='removeRetention1(this)'>&times;</i>"
							+"<input type='hidden' value='0'>"
							+"</td>"
							+"</tr>";

				
				var table = document.getElementById("retentionList1");
				var tbody = table.children[1];
				// insertAdjacentHTML ang gamit kay i-reload niya ang uban fields kung innerHTML+= ang gamit.
				tbody.insertAdjacentHTML('beforeend', trString);
				updateRetTotal1(amountPer.toFixed(2));
				var claimantRET = document.getElementById('claimantRETEdit');
				claimantRET.value = claimant;
			} else {
				alert(trackingNumber + " is already in the list.");
			}
		}else{
			alert("Please create another retention tracking for a different supplier.");
		}

		
	}

	function checkExistingRetention1(trackingNumber){
		var table = document.getElementById('retentionList1');
		var tbody = table.children[1].children;

		for(var i=0; i < tbody.length; i++){
			if(tbody[i].children[0].innerText == trackingNumber){
				return 1;
			}
		}
		return 0;
	}

	function updateRetention(tn){
		var table = document.getElementById('retentionList1');
		var tbody = table.children[1].children;
		var saveFlag = 0;
		var tnPartner = "";

		var getData = [];
		for(var i=0; i < tbody.length; i++){
			var td = tbody[i].querySelectorAll('td');

			var trackingNumber = td[0].innerText;
			var poNum = td[1].innerText;
			var invNum = td[2].children[0].value;
			var invDate = td[3].children[0].value;
			var amountPer = parseFloat(td[5].innerText.replace(/,/g, ""));
			var updateInvFlag = 1;

			if(invNum == "" || invDate == "") {
				alert("Check for missing details.");
				saveFlag = 1;
				break;
			} else {
				getData.push(trackingNumber+"!"+invNum+"!"+poNum+"!"+invDate+"!"+amountPer+"!"+updateInvFlag);
			}
		}

		if(tbody.length == 1) {
			tnPartner = trackingNumber;
		}else if(tbody.length > 1){
			tnPartner = "";
		}

		if(saveFlag == 0) {
			var getString = getData.join("~");
			var retGross = parseFloat(document.getElementById('retEditTotal').innerText.replace(/,/g,"")); 
			var fund = "General Fund";
			var claimant = document.getElementById('claimantRETEdit').value.trim();


			var queryString = "?updateTrackingRET=1&retDetails="+getString+"&gross="+retGross+"&fund="+fund+"&tn="+tn+"&tnPartner="+tnPartner+"&claimant="+claimant;
			var container = document.getElementById('divNewTrackingNumber');

			loader();
			ajaxGetAndConcatenate(queryString, processorLink, container, "updateTrackingRET");
		}
	}
	//---------------------------------------------- RETENTION - END

	//---------------------------------------------- PAYMASTER - START
	function openPaymasterEditor(tn){
		var queryString = "?editPaymaster=1&tn="+tn;
		var container = "";
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"editPaymaster");
	}

	function getPYDetailsForPAY1(field) {
		var tn = field.value;
		var queryString = "?getPYDetailsForPAY=1&trackingNumber="+tn;
		var container = "";

		loader();
		ajaxGetAndConcatenate(queryString, processorLink, container, "getPYDetailsForPAY1");
	}

	function addMultiplePAY1(content){
		var temp = content.split('*payContent*');
		var tn = temp[0];
		var claimant = temp[1];
		var vcGross = temp[2];
		var vcNet = temp[3];
		var empsNum = temp[4];
		var fund = temp[5];
		var officeAssigned = temp[6];

		if(officeAssigned == ""){
			officeAssigned = "<input class='data2' style='border:0px; width:100px; font-size:14px; border-bottom:1px solid silver; text-align:center;'>";
		}

		
		if(vcNet.length > 0 && vcNet > 0){
			var chker = checkExistingPaymaster1(tn);

			if(chker == 0){
				var table = document.getElementById('paymasterList1');
				var tbody = table.children[1];

				if(empsNum == 0){
					empsNum = "<input class='data2' onkeyup='updateEmpsNum1()' onkeydown='return isAmount(this,event)' style='border:0px; width:80px; font-size:14px; border-bottom:1px solid silver; text-align:center;'>";
				}

				var tr = "<tr>"
						+"<td style='padding-left:10px;'>"+tn+"</td>"
						+"<td style='padding-left:10px;'>"+claimant+"</td>"
						+"<td style='padding:3px 2px; text-align:center;'>"+officeAssigned+"</td>"
						+"<td style='padding:3px 2px; text-align:center;'>"+empsNum+"</td>"
						+"<td style='padding:3px 5px; text-align:right;'>"+numberWithCommas(round2(vcGross))+"</td>"
						+"<td style='padding:3px 5px; text-align:right;'>"+numberWithCommas(round2(vcNet))+"</td>"
						+"<td style='text-align:center;'>"
						+"<i style='cursor:pointer; font-weight:bold; color:red; font-style:normal; font-size:12px;' onclick='removePaymaster1(this)'>&#x2715;</i>"
						+"</td>"
						+"</tr>";

				tbody.insertAdjacentHTML('beforeend', tr);
				updatePayTotal1(vcNet);
				updateEmpsNum1();
			}else{
				alert(tn + " is already in the list.");
			}
			
		}else{
			alert("Please update Net Amount of TN : "+tn);
		}
		


		// var chker = checkExistingPaymaster1(tn);

		// if(chker == 0){
		// 	var table = document.getElementById('paymasterList1');
		// 	var tbody = table.children[1];

		// 	var tr = "<tr>"
		// 			+"<td style='padding-left:10px;'>"+tn+"</td>"
		// 			+"<td style='padding-left:10px;'>"+claimant+"</td>"
        //         	+"<td style='text-align:center;'>"+empsNum+"</td>"
		// 			+"<td style='text-align:right;padding-right:10px;'>"+numberWithCommas(round2(amount))+"</td>"
		// 			+"<td style='text-align:center;'>"
		// 			+"<i style='cursor:pointer; font-weight:bold; color:red; font-style:normal; font-size:12px;' onclick='removePaymaster(this)'>&#x2715;</i>"
		// 			+"</td>"
		// 			+"</tr>";

		// 	tbody.insertAdjacentHTML('beforeend', tr);
		// 	updatePayTotal1(amount);
		// 	updateEmpsNum1();
		// }else{
		// 	alert(tn + " is already in the list.");
		// }
	} 

	function checkExistingPaymaster1(trackingNumber){
		var table = document.getElementById('paymasterList1');
		var tbody = table.children[1].children;

		for(var i=0; i < tbody.length; i++){
			if(tbody[i].children[0].innerText == trackingNumber){
				return 1;
			}
		}
		return 0;
	}

	function removePaymaster1(elem) {
		var parent = elem.parentElement.parentElement.parentElement;
		var row = elem.parentElement.parentElement;
		updatePayTotal1("-"+row.children[5].innerText)
		parent.removeChild(row);
		updateEmpsNum1();
	}

	function updatePayTotal1(amount){
		var totalElem = document.getElementById('paymasterTotal1');
		var total = parseFloat(totalElem.innerText.replace(/,/g,""));
		
		amount = parseFloat(amount.replace(/,/g,""));
		
		var tempTotal = total + amount;
		totalElem.innerHTML = numberWithCommas(tempTotal.toFixed(2));

		var totalTrPay = document.getElementById('totalTrPay');
		var saveTrPay = document.getElementById('saveTrPay');
		if(tempTotal > 0){
			// totalTrPay.style.display = "table-row";
			saveTrPay.style.display = "table-row";
		}else{
			// totalTrPay.style.display = "none";
			saveTrPay.style.display = "none";
		}

		updatePMGrandTotal();
	}

	function updatePMGrandTotal() {
		var added = parseFloat(document.getElementById('paymasterTotal1').textContent.replace(/,/g,""));
		var current = parseFloat(document.getElementById('paymasterTotalOld').textContent.replace(/,/g,""));
		var grand = document.getElementById('paymasterGrandTotal');
		var newGrand = 0;

		newGrand = current + added;
		grand.textContent = numberWithCommas(newGrand.toFixed(2))
	}

	function updateEmpsNum1(){
		var empsNum = document.getElementById('payEmpsNum1');
		var table = document.getElementById('paymasterList1');
		var tbody = table.children[1];
		var newTotal = 0;
		var len = tbody.children.length;

		if(len > 0){
			for(var i = 0; i < len; i++){
				// var empNumCell = tbody.children[i].children[2].textContent;
				// var num = 0;
				// if(empNumCell != "N/A"){
				// 	num = parseInt(empNumCell);
				// }
				// newTotal += num;

				var empNumCell = tbody.children[i].children[3];
				var num = 0;
				if(empNumCell.children.length > 0){
					if(empNumCell.children[0].value.length == 0){
						num = 0;
					}else{
						num = parseFloat(empNumCell.children[0].value);
					}
				}else{
					num = parseInt(empNumCell.textContent);
				}
				newTotal += num;
			}
		}
		empsNum.innerHTML = newTotal;
	}

	function updateTrackingPaymaster(tn){
    	var empsNum1 = parseInt(document.getElementById('payEmpsNum1').textContent.trim());
    	var empsNumCur = parseInt(document.getElementById('payEmpsCur').textContent.trim());
		var totalEmps = empsNumCur + empsNum1;
		var table = document.getElementById('paymasterList1');
		var tbody = table.children[1].children;
		var proc = 0;
    	var caughtTN = "";
		var tnPartner = "";

		var getData = [];
		if(tbody.length > 0){
			for(var i=0; i < tbody.length; i++){
				var td = tbody[i].querySelectorAll('td');

				var trackingNumber = td[0].textContent;
				var claimant = td[1].textContent;

				if(td[2].children.length > 0){
					var office = td[2].children[0].value.trim();
				}else{
					var office = td[2].textContent;
				}

            	var empsRow = td[3];
				var empsNum = 0;
				var amount = parseFloat(td[5].textContent.replace(/,/g, ""));

				if(empsRow.children.length > 0){
					if(empsRow.children[0].value.length == 0){
						proc = 1;
						caughtTN = trackingNumber;
						break;
					}else{
						empsNum = parseFloat(empsRow.children[0].value);
					}
				}else{
					empsNum = parseInt(empsRow.textContent);
				}

				if(amount > 0){
					getData.push(trackingNumber+"*pm*"+claimant+"*pm*"+amount+"*pm*"+empsNum+"*pm*"+office);
				}else{
					proc = 2;
					caughtTN = trackingNumber;
					break;
				}
			}

			if(proc == 0){
				var getString = getData.join("~");
				// var payGross = parseFloat(document.getElementById('paymasterTotal1').innerText.replace(/,/g,"")); 
				var payGross = parseFloat(document.getElementById('paymasterGrandTotal').textContent.replace(/,/g,"")); 
				var payGrossOld = parseFloat(document.getElementById('paymasterTotalOld').textContent.replace(/,/g,"")); 

				var queryString = "?updateTrackingPaymaster=1&payDetails="+getString+"&gross="+payGross+"&grossOld="+payGrossOld+"&tn="+tn+"&empsNum="+totalEmps;
				var container = "";

				loader();
				ajaxGetAndConcatenate(queryString, processorLink, container, "updateTrackingPaymaster");
			}else if(proc == 1){
				alert("Please set the Number of Employees of TN : "+caughtTN);
			}else if(proc == 2){
				alert("Please update the Net Amount of TN : "+caughtTN);
			}
		}else{
			alert("Please input at least 1 TN.");
		}
	}

	function clearTrackingPaymaster(tn){
		var queryString = '?clearTrackingPaymaster=1&tn='+tn;
		var container = '';

		var answer = confirm("Are you sure?");
		if(answer){
			loader();
			ajaxGetAndConcatenate(queryString, processorLink, container, "clearTrackingPaymaster");
		}
	}

	function pmRemoveThisDirectInTracker(tn){
		var queryString = "?pmRemoveThisDirectInTracker=1&trackingNumber="+tn;
		var container = "";

		loader();
		ajaxGetAndConcatenate(queryString, processorLink, container, "pmRemoveThisDirectInTracker");
	}

	function pmSaveToExcel(tn){
		var queryString = "?pmSaveToExcel=1&trackingNumber="+tn;
		var container = "";

		ajaxGetAndConcatenate(queryString, "../ajax/excelCreator.php", container, "returnNothing");
	}
	//---------------------------------------------- PAYMASTER - END


	//searchTracking(document.getElementById("ok"),1);
	function searchTracking(me,para){
		var trackingNumber = me.value.toUpperCase();
		var cancel = trackingNumber.substr(0,6).toUpperCase(); 
		if(cancel == "CANCEL"){
			var orig = trackingNumber.replace("CANCEL","");
			//var answer = confirm("You are about to cancel TN# : " + orig);
			//if(answer){
				remarks("Cancel Transaction","Remarks",orig,"-","cancelThis(this)");
			//}
		}else{
			if(trackingNumber.length > 1){
				var queryString = "?searchTrackingNumber=1&trackingNumber=" + trackingNumber;
				var container = document.getElementById('doctrackUpdateContainer');
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"searchTrackingNumber");
			}
		}		
	}
	function cancelThis(me){
		
		var foo = encodeURIComponent(document.getElementById("remValue").value);
		if(foo.length > 3){
			var trackingNumber = me.id;
			document.getElementById("closeRem").click();
			var queryString = "?cancelTrackingNumber=1&trackingNumber=" + trackingNumber + "&remark=" + foo;
			var container = document.getElementById('doctrackUpdateContainer');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"searchTrackingNumber");
		}else{
			alert("Everything happens for a reason. Then you must have one.");
		}

	}
	
	function searchThisPartner(me){
		var trackingNumber  = me.textContent;
		var queryString = "?searchTrackingNumberPartner=1&trackingNumber=" + trackingNumber;
		document.getElementById('ok').value = trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"searchTrackingNumber");
	}
	function showPPMPdetails(me){
		var container = document.getElementById('ppmpDetails');
		if(container.children.length == 0){
			me.innerHTML = "hide details";
			var splits = me.id.split("~");
			var year  = splits[0];
			var office  = splits[1];
			var categoryCode  = splits[2];
			var prMonth  = splits[3];
			var docType  = splits[4];
			var trackingNumber  = splits[5];
			var programCode  = splits[6];
			
			programCode = 'all';
		
			var queryString = "?selectByCategoryPPMP=1&searchType=1&year=" + year + 
								"&officeCode=" + office + 
								"&categoryCode=" + categoryCode + 
								"&prMonth=" + prMonth +
								"&docType=" + docType +
								"&trackingNumber=" + trackingNumber + 
								"&programCode=" + programCode;
			
						
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"selectByCategoryPPMP");
		}else{
			me.innerHTML = "view details";
			container.innerHTML = "";
		}
	}

	function callNFRequestorForm(tn){
		
		var queryString = "?saveINFRADetails=1&trackingNumber=" + tn ;
		var container = "";		
		ajaxGetAndConcatenate(queryString,processorLink,container,"saveINFRADetails");
		/*var sheet  = "<div class = 'editorContainer'>"
					+"	<table class='editorTable' style ='font-family:Oswald;'>"
					+"		<tr><td class = 'editorHeader' colspan = '2' >Details<div onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>"
					+"		<tr>"
					+"			<td class = 'editorLabel'>"
					+"				Requestor Name"
					+"			</td>"
					+"			<td style = 'padding-bottom:5px; padding-top:30px;padding-right:40px;'>"
					+"				<input id='infraRqstrName' class='select2' style = 'width:400px;padding:10px;font-family:Oswald;font-size:18px;' />"
					+"			</td>"
					+"		</tr>"
					+"		<tr>"
					+"			<td class = 'editorLabel' style='padding-top:0px;'>"
					+"				Requestor Title"
					+"			</td>"
					+"			<td style = 'padding-bottom:20px; padding-right:40px;'>"
					+"				<input id='infraRqstrTitle' class='select2' style = 'width:400px;padding:10px;font-family:Oswald;font-size:18px;' />"
					+"			</td>"
					+"		</tr>"
					+"		<tr>"
					+"			<td colspan = '2' style = 'padding-bottom:20px;text-align:center;'>"
					+"				<div class ='button1 b1' onclick= 'saveINFRADetails(\""+tn+"\")'>Save</div>"
					+"			</td>";
					+"		</tr>"
					+"	</table>"
					+"</div>";
		theAbsolute(sheet);*/
	}

	function saveINFRADetails(tn){
		var name = document.getElementById('infraRqstrName').value.trim();
		var title = document.getElementById('infraRqstrTitle').value.trim();

		if(name != "" && title != ""){
			var queryString = "?saveINFRADetails=1&trackingNumber=" + tn + "&name=" + name +"&title=" + title;
			var container = "";		
			ajaxGetAndConcatenate(queryString,processorLink,container,"saveINFRADetails");
		}else{
			alert("Please fill in all details.");
		}
		
	}

	function updateTrackingInfraEncodedOnly(me){
		var labelStatus = document.getElementById('labelStatus').textContent;
		var btnTxt = me.textContent.trim(); // 01-20-2022 Added para "For Adjustment", "For Pick-up"
		var trackingNumber = me.id.replace("button","");
		var docType =  document.getElementById("pyDocType").textContent;
		var dateEncoded = document.getElementById("trackingEncoded").textContent;
		var dateModified = document.getElementById("trackingModified").textContent;
		var trackType = document.getElementById("trackType").textContent.replace("-","").trim(); 
		var trackingAmount = 1;
		var obrApprove = 0;
		var inputNumber = 1; 
		var fund = displayFund.innerHTML;
		var queryString = "?updateTrackingStatusInfra=1&trackingNumber=" + trackingNumber + 
							"&inputNumber=" + inputNumber + 
							"&status=" + labelStatus +
							"&dateEncoded=" + dateEncoded + 
							"&dateModified=" + dateModified +
							"&trackingAmount=" + trackingAmount +
							"&trackType=" + trackType +
							"&btnTxt=" + btnTxt + "&fund=" + fund;
		var container = document.getElementById('doctrackUpdateContainer');			
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"updateTrackingStatus");
	}

	function updateTracking(me){
		var button = me.textContent;
		if(document.getElementById("selectedPRPOtable")){
			var table = document.getElementById("selectedPRPOtable");
			var cat = table.children[0].children[1].children[2].textContent;
			if(button == "Receive(Payment)"){
				if(cat != "CAT 80" & cat != "CAT 69" & cat != "CAT 25" & cat != "CAT 75" & cat != "CAT 100" & cat != "CAT 83" & cat != "CAT 94" & cat != "CAT 36" & cat != "CAT 29" & cat != "NO CAT" & cat != "CAT 35.1" & cat != "CAT 35" & cat != "CAT 12"){
					alert("Only gasoline, rental, subscription, hauling and meals payment only.");
					exit;
				}
			}
		}
		
		
		var answer = confirm("Confirm action?");
		if(answer){
			var labelStatus = document.getElementById('labelStatus').textContent;
			var track = me.id.split('*');
			var btnTxt = me.textContent.trim(); // 01-20-2022 Added para "For Adjustment", "For Pick-up"
			if(track.length == 2){
				var trackingNumber = track[1];
				var labelStatus = "EncodedPayment";
			}else{
				var trackingNumber = me.id.replace("button","");
			}
			if(document.getElementById("pyDocType")){
				var docType =  document.getElementById("pyDocType").textContent;
			}else{
				var docType = "";
			}
			var dateEncoded = document.getElementById("trackingEncoded").textContent;
			var dateModified = document.getElementById("trackingModified").textContent;
			var trackType = document.getElementById("trackType").textContent.replace("-","").trim(); 
			if(document.getElementById("prTotal")){
				var trackingAmount = document.getElementById("prTotal").textContent.replace(/,/g,"");
			}else{
				var trackingAmount = 1;
			}
			var obrApprove = 0;
			if(document.getElementById('inputNumber')){
				var inputNumber = document.getElementById('inputNumber').value.trim();	
				if(inputNumber.length == 0){
					var user   = "<?php echo $_SESSION['accountType'];  ?>";
					if(user == 4){
						inputNumber = "TBA";
					}
				}
			}else{
				
				if(docType == "INFRASTRUCTURE - CONTRACT"){
					var inputNumber = "TBA";
				}else{
					var inputNumber = 1; 
				}
			}
			if(trackType == "NF"){
				
					var batchNumber = displayInfraBatchNumber.innerHTML;
					var fund = displayFund.innerHTML;
					var queryString = "?updateTrackingStatusInfra=1&trackingNumber=" + trackingNumber + 
										"&inputNumber=" + inputNumber + 
										"&status=" + labelStatus +
										"&dateEncoded=" + dateEncoded + 
										"&dateModified=" + dateModified +
										"&trackingAmount=" + trackingAmount +
										"&trackType=" + trackType +
										"&btnTxt=" + btnTxt + "&fund=" + fund + "&batchNumber=" + batchNumber;
										
					var container = document.getElementById('doctrackUpdateContainer');			
					loader();
					ajaxGetAndConcatenate(queryString,processorLink,container,"updateTrackingStatus");
			}else{
				if(inputNumber){
					var queryString = "?updateTrackingStatus=1&trackingNumber=" + trackingNumber + 
									"&inputNumber=" + inputNumber + 
									"&status=" + labelStatus +
									"&dateEncoded=" + dateEncoded + 
									"&dateModified=" + dateModified +
									"&trackingAmount=" + trackingAmount +
									"&trackType=" + trackType +
									"&btnTxt=" + btnTxt;
					var container = document.getElementById('doctrackUpdateContainer');				
					
					loader();
					ajaxGetAndConcatenate(queryString,processorLink,container,"updateTrackingStatus");
					sendSms(trackingNumber);
				}else{
					if(trackType.trim() == "PR"){
						var inputNumber = '0';
						var queryString = "?updateTrackingStatus=1&trackingNumber=" + trackingNumber + 
									"&inputNumber=" + inputNumber + 
									"&status=" + labelStatus +
									"&dateEncoded=" + dateEncoded + 
									"&dateModified=" + dateModified +
									"&trackingAmount=" + trackingAmount +
									"&trackType=" + trackType
									"&btnTxt=" + btnTxt;
						var container = document.getElementById('doctrackUpdateContainer');					
						loader();
						ajaxGetAndConcatenate(queryString,processorLink,container,"updateTrackingStatus");
						sendSms(trackingNumber);
					}else{
						msg("Please input the required field.");
					}
				}
			}
		}
	}

	function updateTrackingForwardPending(me){
		var tn = me.id;
		var remarks = document.getElementById('ptrsRemarks').textContent;
		loader();
		var queryString = "?updateTrackingForwardPending=1&trackingNumber=" + tn + "&remarks=" + remarks;
		var container = document.getElementById('doctrackUpdateContainer');		
		ajaxGetAndConcatenate(queryString,processorLink,container,"updateTrackingStatus");
		sendSms(tn);
	}

	function prCTOreceive(me){
		var tn = me.id.replace("button","");
		loader();
		var queryString = "?prCTOreceive=1&trackingNumber=" + tn;
		var container = document.getElementById('doctrackUpdateContainer');		
		ajaxGetAndConcatenate(queryString,processorLink,container,"prCTOreceive");
		sendSms(trackingNumber);
		
	}
	function ctoForward(me){
		var arr = me.id.split("~");
		var type = arr[0];
		var trackingNumber = arr[1];
		loader();
		var queryString = "?forwardCTO=1&type=" + type + "&trackingNumber=" + trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');		
		ajaxGetAndConcatenate(queryString,processorLink,container,"forwardCTO");
		sendSms(trackingNumber);
	}
	function adminForward(me){
		
		var trackingNumber = me.id;
		loader();
		var queryString = "?forwardAdmin=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');		
		ajaxGetAndConcatenate(queryString,processorLink,container,"forwardAdmin");
		sendSms(trackingNumber);
	}
	
	function revertAdmin(me){
		var trackingNumber = me.id;
		loader();
		var queryString = "?revertAdmin=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');		
		ajaxGetAndConcatenate(queryString,processorLink,container,"revertAdmin");
		sendSms(trackingNumber);
	}
	
	function prCTOforward(me){
		var trackingNumber =  me.id;
		loader();
		var queryString = "?prCTOforward=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');		
		ajaxGetAndConcatenate(queryString,processorLink,container,"prCTOforward");
		sendSms(trackingNumber);
	}
	
	function ctoClaim(me){
		var dateEncoded = document.getElementById("trackingEncoded").textContent;
		var trackingNumber = me.id;
		var queryString = "?ctoClaim=1&trackingNumber=" + trackingNumber + "&dateEncoded=" + dateEncoded;
		loader();
		var container = document.getElementById('doctrackUpdateContainer');		
		ajaxGetAndConcatenate(queryString,processorLink,container,"ctoClaim");
		sendSms(trackingNumber);
		sendSmsAlways(trackingNumber);
	}
	
	function ctoClaimRevert(me){
		
		var trackingNumber = me.id;
		loader();
		var queryString = "?ctoClaimRevert=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');		
		ajaxGetAndConcatenate(queryString,processorLink,container,"ctoClaimRevert");
		sendSms(trackingNumber);
	}
	function ctoClaimReProcess(me){
		
		var trackingNumber = me.id;
		loader();
		var queryString = "?ctoClaimReProcess=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');		
		ajaxGetAndConcatenate(queryString,processorLink,container,"ctoClaimReProcess");
		sendSms(trackingNumber);
	}
	
	function receivedPayment(me){
		alert(me.id);
	}
	function pendingThis(me,cont){
		var parent = me.parentNode;
		
		parent.style.display = "none";
		document.getElementById(cont).style.display = "block";
		document.getElementById('pendingNote').focus();
		document.body.scrollTop =document.body.scrollHeight;
		
	}
	function cancelPending(me,cont){
		var parent = me.parentNode;
		parent.style.display = "none";
		document.getElementById(cont).style.display = "block";
	}
	function savePending(me){
		var answer = confirm("Confirm action?");
		if(answer){
			var value = me.id;
			var pendingNote = encodeURIComponent(document.getElementById("pendingNote").value.trim());
			if(document.getElementById('oldPending')){
				var oldNote = document.getElementById('oldPending').innerHTML;
			}else{
				var oldNote = '';
			}
			if(pendingNote.length != 0){
				loader();
				var queryString = "?savePending=1&value=" + value + "&pendingNote=" + pendingNote + "&oldNote=" + encodeURIComponent(oldNote);
			
				var container = document.getElementById('doctrackUpdateContainer');		
				ajaxGetAndConcatenate(queryString,processorLink,container,"savePending");
				
			
				var x = value.split("Pending");
				var trackingNumber = x[1];
				sendSms(trackingNumber);
			}else{
				alert("Please write pending note.");
			}
		}
	}
	function updateTracking1(me){
		var answer = confirm("Confirm action?");
		if(answer){

			var trackType = document.getElementById('trackType').textContent.trim().replace(' -', '');

			var splits =  me.id.split('~');
			var status = splits[0];
			var trackingNumber = splits[1];
			loader();
			var container = document.getElementById('doctrackUpdateContainer');		
			var queryString = "?updateTracking1=1&trackingNumber=" + trackingNumber + "&status=" + status + "&tracktype=" + trackType;
			ajaxGetAndConcatenate(queryString,processorLink,container,"updateTracking1");
			
			sendSms(trackingNumber);

		}
	}
	function updateTrackingToSLP(tn){
		var answer = confirm("Confirm action?");
		if(answer){
			loader();
			var container = "";		
			var queryString = "?updateTrackingToSLP=1&trackingNumber=" + tn;
			ajaxGetAndConcatenate(queryString,processorLink,container,"updateTrackingToSLP");
		}
	}
	function viewControl(me){
		
		
		var adv = document.getElementById('advTrack').textContent;
		if(adv != "99999"){
			var parent = me.parentNode.parentNode;
			me.parentNode.style.display = "none";
			parent.children[1].style.display = "block";
			
			
			var trackingNumber = me.id.replace("button",'');
			var queryString = "?countControlNumber=1&trackingNumber=" + trackingNumber; 
			var container = document.getElementById('divCtrl'); 
			ajaxGetAndConcatenate(queryString,processorLink,container,"countControlNumber");	
		}else{
			alert("Please assign ADV number");	
		}
		
		
	}
	function saveControl(me){
		var ctrlNo = -1;
		var answer = confirm("Confirm action?");
		if(answer){
			var trackingNumber = me.id.replace("control",'');
			var encoded = document.getElementById('trackingEncoded').textContent;
			ctrlNo = document.getElementById('divCtrl').textContent; 
			//loader();
			var queryString = "?saveControl=1&trackingNumber=" + trackingNumber + "&ctrlNo=" + ctrlNo + "&encoded=" + encoded;    
			var container = document.getElementById('doctrackUpdateContainer'); 
		
			//ajaxGetAndConcatenate(queryString,processorLink,container,"saveControl");
		}
	}
	function skipAndSave(me){
		var ctrlNo = -1;
		var answer = confirm("Confirm action?");
		if(answer){
			var trackingNumber = me.id.replace("skipAndSave",'');
			var encoded = document.getElementById('trackingEncoded').textContent;
			if(document.getElementById('divCtrl')){
				ctrlNo = document.getElementById('divCtrl').textContent;
			}else{
				ctrlNo = 0;
			}
			loader();
			var queryString = "?skipAndSave=1&trackingNumber=" + trackingNumber + "&ctrlNo=" + ctrlNo + "&encoded=" + encoded;    
			var container = document.getElementById('doctrackUpdateContainer'); 
			ajaxGetAndConcatenate(queryString,processorLink,container,"skipAndSave");
		}
	}
	function viewSLP(me){
		var parent = me.parentNode.parentNode;
		//me.parentNode.style.display = "none";
		//parent.children[1].style.display = "block";
		
		msg1(sheetSLP(me.id));
		var trackingNumber = me.id.replace("button",'');
		var queryString = "?countControlNumber=1&trackingNumber=" + trackingNumber; 
		var container = document.getElementById('divCtrl'); 
		//ajaxGetAndConcatenate(queryString,processorLink,container,"countControlNumber");	
	}
	//msg1(sheetSLP());
	function sheetSLP(tn){//old
		var sheet = "<div id ='slpBox'><table style = 'width:100%;height:100%;border-spacing:0;' border= '0'>";
			sheet += "<tr><td style ='border-bottom:1px solid silver;height:10px;'><div class = 'label14'>Kung first half ni na payroll. <span style = 'color:red;'>...Plantilla lang ha.</span></div></td></tr>";
			sheet += "<tr><td style ='height:80%;background-color:rgb(227, 241, 242);'>";
			sheet += "<table style = 'border:0px solid silver;margin:0 auto;'>";
			sheet += "<tr><td style = 'text-align:right;'><span class ='label2'>Adv #</span></td><td><input id = 'advSLP2' class = 'select2' style = 'width:150px;'/></td><td rowspan = '2'><span id ='slp2~"+ tn +"' onclick = 'saveSLP(this)' class = 'button11'>Save</span></td></tr>";
			sheet += "<tr><td><span class ='label2'>First half amount</span></td><td><input id = 'halfAmount' maxlength = '15'  onkeydown='return isAmount(this,event)' class = 'select2' style = 'width:150px;'/></td></tr>";
			sheet += "</table>";
			sheet += "</td></tr>";
			
			sheet += "<tr><td style ='height:10px;border-bottom:1px solid silver;padding:20px;'><span class = 'label14'>Kung whole month.</span></td></tr>";
			sheet += "<tr><td>";
			sheet += "<tr><td style ='background-color:rgb(249, 236, 219); height:20%;'>";
			
			sheet += "<table style = ' margin:0 auto;border-spacing:0;'>";
			sheet += "<tr><td><span class ='label2'>Adv #</span></td><td><input id = 'advSLP1' class = 'select2' style = 'width:150px;'/></td>";
			sheet += "<td style = 'padding:25px 10px;text-align:center' colspan ='2'><span id ='slp1~" + tn + "' class = 'button1' onclick = 'saveSLP(this)'>Save</span></td></tr>";
			sheet += "</table>";
			
			sheet += "</td></tr>";	   
			sheet += "</table></div>";
		return sheet;
	}
	function saveSLP(me){
		var splits = me.id.split('~');
		var halfAmount  = '';
		var type = splits[0];
		var trackingNumber = splits[1];
		var error = 0;
		if(type == "slp1"){
			var slpType = 1;
			
			var netAmount = encodeURIComponent(document.getElementById('netAmount').value.replace(/,/g,""));
			var payeeNumber = encodeURIComponent(document.getElementById('payeeNumberA').value);
			
			if(netAmount > 0 ){
				if(payeeNumber.length >5){
					var queryString = "?saveSLP=1&payeeNumber=" + payeeNumber + "&netAmount=" + netAmount + "&trackingNumber=" + trackingNumber + "&slpType=" + slpType ;    
					var container = document.getElementById('doctrackUpdateContainer'); 
					loader();
					ajaxGetAndConcatenate(queryString,processorLink,container,"saveSLP");
				}else{
					alert("Invalid  employee number.");
				}
			}else{
				alert("Invalid  employee number.");
			}
		}else{
			var slpType = 2;
			
			var netAmount1= encodeURIComponent(document.getElementById('netAmount1').value.replace(/,/g,""));
			var netAmount2 = encodeURIComponent(document.getElementById('netAmount2').value.replace(/,/g,""));
			var payeeNumber = encodeURIComponent(document.getElementById('payeeNumberB').value);
			
			if(netAmount1.length == 0){
				error = 1;
			}
			if(netAmount2.length == 0){
				error = 1;
			}
			if(payeeNumber.length == 0){
				error = 1;
			}
			if(error == 0){
				var queryString = "?saveSLP=1&payeeNumber=" + payeeNumber + "&netAmount1=" + netAmount1 + "&netAmount2=" + netAmount2 + "&trackingNumber=" + trackingNumber + "&slpType=" + slpType;    
				loader();
				var container = document.getElementById('doctrackUpdateContainer'); 
				ajaxGetAndConcatenate(queryString,processorLink,container,"saveSLP");
			}else{
				alert("Incomplete ang entry. ");
			}
		}
		/*if(advNumber.length != 0){
			if(slpType == 2){
				if (halfAmount.length != 0){
					var queryString = "?saveSLP=1&advNumber=" + advNumber + "&halfAmount=" + halfAmount + "&trackingNumber=" + trackingNumber + "&slpType=" + slpType;    
					var container = document.getElementById('doctrackUpdateContainer'); 
					ajaxGetAndConcatenate(queryString,processorLink,container,"saveSLP");
					
				}else{
					alert("Please input first half total.");
				}
			}else{
				var queryString = "?saveSLP=1&advNumber=" + advNumber + "&halfAmount=" + halfAmount + "&trackingNumber=" + trackingNumber + "&slpType=" + slpType;    
				var container = document.getElementById('doctrackUpdateContainer'); 
				
				ajaxGetAndConcatenate(queryString,processorLink,container,"saveSLP");
				
			}
			
		}else{
			alert("Please input ADV number.");
		}
		*/
	}

	function sanitizeBeforeEditThis(me) {

		// var fieldName = me.parentNode.parentNode.children[0].textContent.trim();
		// var fieldNum = me.parentNode.parentNode.children[0].children[0];

		// if(fieldNum) {
		// 	fieldName = fieldName.replace(fieldNum.textContent.trim(), '');
		// }

		// editThis(me, fieldName);

	}

	function editThis(me){

		// 	var fieldName = me.parentNode.parentNode.children[0].textContent.trim();

		var parent = me.parentNode.parentNode;
		var fieldName = parent.querySelector('.genDtlLabel').textContent.trim();
		
		// if(fieldName == "Claimant" || fieldName  == "Contractor"){
		if(fieldName == "Claimant"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName  == "Contractor") {
			var trackingNumber = me.id.replace("editor","");
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editorContractor(trackingNumber,oldValue);
		}else if(fieldName  == "Supplier") {
			var trackingNumber = me.id.replace("editor","");
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editorSupplier(trackingNumber,oldValue);
		}else if(fieldName == "Amount"){
			var trackingNumber =  me.id.replace("editor","");
			var queryString = "?editFieldAmount=1&trackingNumber=" + trackingNumber;    
			var container = document.getElementById('doctrackUpdateContainer'); 
			ajaxGetAndConcatenate(queryString,processorLink,container,"editFieldAmount");
		}else if(fieldName.substring(0,2)== "PR"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			
			fieldName = "PR_Number"
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "PO Date" ){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			fieldName = "PoDate"
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName.substring(0,2)== "PO" ){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			fieldName = "PO_Number"
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName.substring(0,3)== "OBR"){
			
			var trackingNumber =  me.id.replace("editor","");
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			fieldName = "OBR_Number"
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Fund"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent;
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName.substring(0,3) == "ADV"){
			
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Document"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent;
			
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Period"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName.substring(6) == "Type"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName.substring(0,3) == "Net"){
			if(me.textContent.substring(0,5)  == "SPLIT"){ // sa pag split sa lto mura og slp type
				var trackingNumber = me.id;
				var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
				fieldName = "LTO Renewal fee";
			}else{
			 	if(document.getElementById("pyDocType")){
					var docType = document.getElementById("pyDocType").textContent; // sa pag edit na ni siya kay lain ang lto edit dapat ma change pud partner
					if(docType == "LTO REGISTRATION"){
						fieldName = "Renewal fee";	
					}
				}
				var trackingNumber = me.id;
				var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			}
			if(oldValue == 0){
				oldValue ='';
			}
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName.substring(6)  == "Number"){
			fieldName = "CheckNumber";
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();	
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName.substring(0,5)  == "Check"){
			fieldName = "CheckDate";
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();	
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName.substring(0,5)  == "Gross"){
			
			fieldName = "Amount";
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();	
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName === "Amount spent"){
			fieldName = "Spent";
			var trackingNumber = me.id;
			var queryString = "?editTrackingNLIQ=1&tn="+trackingNumber;
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"editTrackingNLIQ");
		}else if(fieldName.substring(0,3) == "Sub"){
			fieldName = "Sub Program";
			var trackingNumber = me.id;
			
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();	
			
			editor(fieldName,trackingNumber,oldValue,goUpdate);
			loadSubCodes();
		}else if(fieldName.substring(0,5) == "Batch"){
		 	fieldName = "Batch Number";	
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			if(oldValue == 0){
				oldValue ='';
			}
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Location"){
			
		 	fieldName = "Location";	
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			if(oldValue == 0){
				oldValue ='';
			}
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Duration"){
		 	fieldName = "Duration";	
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			if(oldValue == 0){
				oldValue ='';
			}
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Remarks"){
		 	fieldName = "Remarks";	
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			if(oldValue == 0){
				oldValue ='';
			}
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Mode of Procurement"){
		 	fieldName = "Mode of Procurement";	
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			if(oldValue == 0){
				oldValue ='';
			}
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Actual Cost"){
		 	fieldName = "Actual Cost";	
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			if(oldValue == 0){
				oldValue ='';
			}
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Office Assigned"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Cash Release"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Window"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Construction Start Date"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Construction End Date"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Project Programmer"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Construction Inspector"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Construction Extension Date"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Transaction Classification"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Barangay"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Variation 1 OBR Number"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Variation 2 OBR Number"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Nature of Payment"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editorNatureOfPayment(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Mode"){
		 	fieldName = "Mode";	
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Payment Term"){
		 	fieldName = "PaymentTerm";	
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Invoice Number"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Invoice Date"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Gas Account"){
			var trackingNumber = me.id.replace('editor', '');
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			// editor(fieldName,trackingNumber,oldValue,goUpdate);

			var queryString = "?editGasAccount=1&trackingNumber="+trackingNumber+"&curAccount="+encodeURIComponent(oldValue);
			var container = "";

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"editGasAccount");
		}else if(fieldName == "Gas Period"){
			var trackingNumber = me.id;
			var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			editor(fieldName,trackingNumber,oldValue,goUpdate);
		}else if(fieldName == "Accounting Evaluator"){
			var trackingNumber = me.id.replace('editor', '');
			// var oldValue = me.parentNode.parentNode.children[1].textContent.trim();
			var oldValue = me.parentNode.parentNode.children[1].id;
			oldValue = oldValue.replace('officer', '');

			editorComplianceOfficer('1081', trackingNumber, oldValue);
		}
	}

	function editorComplianceOfficer(office, trackingNumber, oldValue) {

		var queryString = "?editorComplianceOfficer=1&office="+office+"&trackingNumber="+trackingNumber+"&oldValue="+oldValue;
		var container = "";

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"editorComplianceOfficer");

	}

	function goUpdateThisOfficer(me) {

		var trackingNumber = me.id.replace('mpower', '');

		var newOfficer = document.getElementById('newOfficer').value;
		var oldValue = document.getElementById('hiddens').value;
		var type = document.getElementById('hiddensOfficer').value;

		var queryString = "?goUpdateThisOfficer=1&trackingNumber="+trackingNumber+"&oldValue="+oldValue+"&newValue="+newOfficer+"&type="+type;
		var container = "";

		editCloser.click();

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"goUpdateThisOfficer");


	}

	function  loadSubCodes(){
		var container = document.getElementById("editSub");
		loader();
		var queryString = "?loadSubCodes=1";
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadSubCodes");
	}
	function viewPeriod(me){
		var body = me.parentNode.parentNode.parentNode;
		var tr = body.children[2];
		if(me.value == "Payroll"){
			tr.style.display = "table-row";
		}else{
			tr.style.display = "none";
		}
	}
	// function goUpdate(me){
		
	// 	var field = me.parentNode.parentNode.parentNode.children[1].children[0].textContent;

	// 	var value =  encodeURIComponent(me.parentNode.parentNode.parentNode.children[1].children[1].children[0].value);
	// 	var error = 0;
	// 	if(value == 0){
	// 		error  = 1;
	// 	}
	// 	if(value.length == 0){
	// 		error  = 2;
	// 	}
	// 	var oldvalue = me.parentNode.children[0].value;
		
	// 	if(field == "Supplier" || field == "Contractor"){
	// 		field = "Claimant";
	// 	}
	// 	if(field.substring(0,3) == "ADV"){
	// 		field = "Adv1";
	// 	}
	// 	if(field.substring(0,3) == "Net"){
	// 		field = "NetAmount";
	// 	}
	// 	if(field.substring(0,3) == "LTO"){
	// 		field = "LTO";
	// 	}
	// 	if(field.substring(6) == "Type"){
	// 		field = "ClaimType";
	// 	}
	// 	if(field == "Document"){
	// 		field = "DocumentType";
	// 	}
	// 	if(field == "Period"){
	// 		field = "PeriodMonth";
	// 	}
	// 	if(field === "Sub Program"){
	// 		field = "SubCode";
	// 	}
	// 	if(field === "Actual Cost"){
	// 		field = "NetAmount";
	// 	}
	// 	if(field === "Batch Number"){
	// 		field = "BatchNumber";
	// 	}
	// 	if(field === "Mode of Procurement"){
	// 		field = "Mode";
	// 	}
	// 	if(field === "Office Assigned"){
	// 		field = "OfficeAssigned";
	// 	}
	// 	if(field === "Cash Release"){
	// 		field = "CashRelease";
	// 	}
	// 	if(field === "Construction Start Date"){
	// 		field = "Started";
	// 	}
	// 	if(field === "Construction End Date"){
	// 		field = "Completed";
	// 	}
	// 	if(field === "Project Programmer"){
	// 		field = "Programmer";
	// 	}
	// 	if(field === "Construction Inspector"){
	// 		field = "Inspector";
	// 	}
	// 	if(field === "Construction Extension Date"){
	// 		field = "Extension";
	// 	}
	// 	if(field === "Transaction Classification"){
	// 		field = "Complex";
	// 	}
	// 	if(field === "Variation OBR Number"){
	// 		field = "VariationOBR";
	// 	}
	// 	if(field === "Mode"){
	// 		field = "ModeOfProcurement";
	// 	}		
	// 	if(field === "Payment Term"){
	// 		field = "PaymentTerm";
	// 	}
	// 	if(field === "Invoice Number"){
	// 		field = "InvoiceNumber";
	// 	}
	// 	if(field === "Invoice Date"){
	// 		field = "InvoiceDate";
	// 	}
	// 	if(field === "Gas Account Number"){
	// 		field = "AccountNumber";
	// 	}
	// 	if(field === "Gas Period"){
	// 		field = "GasPeriod";
	// 	}

		
	// 	if(error  == 0){
	// 		if(field == "OBR_Number"){
	// 			var trackingNumber =  me.id;
	// 			var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue;     
	// 			var container = document.getElementById('doctrackUpdateContainer'); 
	// 		}else if (field == "TransactionType"){
	// 			if(value == 'Payroll'){
	// 				value = value + "*" + document.getElementById('editorP1').value +  "*" + document.getElementById('editorP2').value + "&oldValue=" + oldvalue;    
	// 			}
	// 			var trackingNumber =  me.id.replace("editor","");
	// 			var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue;     
	// 			var container = document.getElementById('doctrackUpdateContainer'); 
	// 		}else if (field.substring(0,3) == "ADV"){
	// 			var arr  =  me.id.replace("editor","").split("*");
	// 			var trackingNumber = arr[0];
	// 			var field =  arr[1];
				
	// 			var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue;      
	// 			var container = document.getElementById('doctrackUpdateContainer'); 
			
	// 		}else if(field.substring(0,7)  == "Renewal"){
				
	// 			field = "ComputerFee";
	// 			var trackingNumber =  me.id.replace("editor","");
	// 			var obrTotal = document.getElementById("prTotal").textContent.replace(/,/g,"");
	// 			oldvalue = oldvalue +'~' + obrTotal; 
				
	// 			var trackingPartner = document.getElementById("pyTrackingPartner").textContent;
	// 			trackingNumber = trackingNumber + '~' + trackingPartner;
				
	// 			var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue;    
	// 			var container = document.getElementById('doctrackUpdateContainer'); 	
				
	// 		}else{
	// 			var trackingNumber =  me.id.replace("editor","");
	// 			var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue;    
	// 			var container = document.getElementById('doctrackUpdateContainer');			
	// 		}
			
	// 		// loader();
	// 		// ajaxGetAndConcatenate(queryString,processorLink,container,"editField");
	// 	}else{
	// 		alert("Please enter new " + field + " value.");
	// 	}
	// }

	function goUpdate(me){
		
		var field = me.parentNode.parentNode.parentNode.children[1].children[0].textContent;

		var value =  encodeURIComponent(me.parentNode.parentNode.parentNode.children[1].children[1].children[0].value);
		var error = 0;
		if(value == 0){
			error  = 1;
		}
		if(value.length == 0){
			error  = 2;
		}
		var oldvalue = me.parentNode.children[0].value;
		
		if(field == "Supplier" || field == "Contractor"){
			field = "Claimant";
		}else if(field.substring(0,3) == "ADV"){
			field = "Adv1";
		}else if(field.substring(0,3) == "Net"){
			field = "NetAmount";
		}else if(field.substring(0,3) == "LTO"){
			field = "LTO";
		}else if(field.substring(6) == "Type"){
			field = "ClaimType";
		}else if(field == "Document"){
			field = "DocumentType";
		}else if(field == "Period"){
			field = "PeriodMonth";
		}else if(field === "Sub Program"){
			field = "SubCode";
		}else if(field === "Actual Cost"){
			field = "NetAmount";
		}else if(field === "Batch Number"){
			field = "BatchNumber";
		}else if(field === "Mode of Procurement"){
			field = "Mode";
		}else if(field === "Office Assigned"){
			field = "OfficeAssigned";
		}else if(field === "Cash Release"){
			field = "CashRelease";
		}else if(field === "Construction Start Date"){
			field = "Started";
		}else if(field === "Construction End Date"){
			field = "Completed";
		}else if(field === "Project Programmer"){
			field = "Programmer";
		}else if(field === "Construction Inspector"){
			field = "Inspector";
		}else if(field === "Construction Extension Date"){
			field = "Extension";
		}else if(field === "Transaction Classification"){
			field = "Complex";
		}else if(field === "Variation 1 OBR Number"){
			field = "VariationOBR";
		}else if(field === "Variation 2 OBR Number"){
			field = "VariationOBR2";
		}else if(field === "Mode"){
			field = "ModeOfProcurement";
		}else if(field === "Payment Term"){
			field = "PaymentTerm";
		}else if(field === "Invoice Number"){
			field = "InvoiceNumber";
		}else if(field === "Invoice Date"){
			field = "InvoiceDate";
		}else if(field === "Gas Account Number"){
			field = "AccountNumber";
		}else if(field === "Gas Period"){
			field = "GasPeriod";
		}

		if(error  == 0){
			if(field == "OBR_Number"){
				var trackingNumber =  me.id;
				var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue;     
				var container = document.getElementById('doctrackUpdateContainer'); 
			}else if (field == "TransactionType"){
				if(value == 'Payroll'){
					value = value + "*" + document.getElementById('editorP1').value +  "*" + document.getElementById('editorP2').value + "&oldValue=" + oldvalue;    
				}
				var trackingNumber =  me.id.replace("editor","");
				var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue;     
				var container = document.getElementById('doctrackUpdateContainer'); 
			}else if (field.substring(0,3) == "ADV"){
				var arr  =  me.id.replace("editor","").split("*");
				var trackingNumber = arr[0];
				var field =  arr[1];
				
				var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue;      
				var container = document.getElementById('doctrackUpdateContainer'); 
			
			}else if(field.substring(0,7)  == "Renewal"){
				
				field = "ComputerFee";
				var trackingNumber =  me.id.replace("editor","");
				var obrTotal = document.getElementById("prTotal").textContent.replace(/,/g,"");
				oldvalue = oldvalue +'~' + obrTotal; 
				
				var trackingPartner = document.getElementById("pyTrackingPartner").textContent;
				trackingNumber = trackingNumber + '~' + trackingPartner;
				
				var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue;    
				var container = document.getElementById('doctrackUpdateContainer'); 	
				
			}else{
				var trackingNumber =  me.id.replace("editor","");
				var queryString = "?editField=1&trackingNumber=" + trackingNumber + "&field=" + field + "&value=" + value + "&oldValue=" + oldvalue;    
				var container = document.getElementById('doctrackUpdateContainer');			
			}
			
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"editField");
		}else{
			alert("Please enter new " + field + " value.");
		}
	}

	function saveEditOBR(){
		var table = document.getElementById("editorTableOBR");
		var length = table.children[0].children.length;
		var error  = 0;
		
		var ids  = '';
		var codes = '';
		var amounts = '';
		
		var total = 0;
		for(var i = 2; i < length-1; i++){
			var splits = table.children[0].children[i].id.split('~');
			
			var id = splits[0];
			var trackingNumber = splits[1];
			
			
			var code = table.children[0].children[i].children[0].children[0].value;
			var amount = table.children[0].children[i].children[1].children[0].value;
			if(code.length != 0){
				if(amount.length != 0){
					ids += id + "~";
					codes += code + "~";
					amounts += amount + "~";
					total =  parseFloat(total)  + parseFloat(amount);
				}else{
					error  = 1;
				}
			}else{
				error  = 1;
			}		
		}
		if(error  == 1){
			alert("Please do not leave the input box empty.");
		}else{
			if(total){
				var queryString = "?saveEditorAmounts=1&ids=" + ids + "&codes=" + codes + "&amounts=" + amounts + "&total=" + total + "&trackingNumber=" + trackingNumber;    
				var container = document.getElementById('doctrackUpdateContainer'); 
				ajaxGetAndConcatenate(queryString,processorLink,container,"saveEditorAmounts");
			}else{
				alert("Incorrect amount entry.");
			}
		}
	}
	function viewHistory(me){
		var trackingNumber  = me.id.replace("history",'');
		var container =  document.getElementById("historyContainer");
		if(container.children.length > 0){
			document.getElementById("historyArrow").innerHTML = "&#9658";
			container.innerHTML = "";
		}else{
			document.getElementById("historyArrow").innerHTML = "&#9660";
			loader();
			var queryString = "?viewHistory=1&trackingNumber=" + trackingNumber;
			ajaxGetAndConcatenate(queryString,processorLink,container,"viewHistory");
		}
	}
	//editPR(1);
	function editPR(me){
		var trackingNumber = me.id.replace("prEdit","");
		//var trackingNumber = "PR-1081-8";
		var container = document.getElementById("doctrackUpdateContainer");
		var queryString = "?prEdit=1&trackingNumber=" + trackingNumber;
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"prEdit");
		//editOBRAmount
	}

	//Addt'l parameter na type para sa identification sa unsa na editor ang gamiton - 05-21-2021
	// function editOBRAmount(me,type){
	// 	var trackingNumber = me.id.replace("obrEdit","");
	// 	var container = document.getElementById("doctrackUpdateContainer");
	// 	var queryString = "?obrEdit=1&trackingNumber=" + trackingNumber + "&type=" + type;
	// 	loader();
	// 	ajaxGetAndConcatenate(queryString,processorLink,container,"prEdit");
	// }
	function editOBRAmount(me,type){
		var trackingNumber = me.id.replace("obrEdit","");
		var container = document.getElementById("doctrackUpdateContainer");
		var queryString = "?obrEdit=1&trackingNumber=" + trackingNumber + "&type=" + type;
		loader();

		if(type == 2){
			wgsModeF = 0;
			// clearFieldsWGS();
			ajaxGetAndConcatenate(queryString,processorLink,container,"obrEditManualWGS");
		}else{
			ajaxGetAndConcatenate(queryString,processorLink,container,"prEdit");
		}
	}
	function calculateAddPR(me){
		var parent = me.parentNode.parentNode;
		var qty = parent.children[4].children[0].value;
		var cost = parent.children[6].children[0].value.replace(/,/g,"");
		var total =  parseFloat(qty * cost);
		var totalContainer = parent.children[8].children[0];
		totalContainer.value  = numberWithCommas(total.toFixed(2));
		var trLength = parent.parentNode.children.length;
		inputTotals(parent.parentNode,trLength);
	}
	function inputTotals(parent,length){
		var g = 0;
		for(var i = 1 ; i < length-1; i++){
			var check = parent.children[i].children[3].children[0].checked;
			if(check){
				var  total =  parseFloat(parent.children[i].children[8].children[0].value.replace(/,/g,""));
				g = g + total;
			}
		}
		document.getElementById('totalAmountItems').value = numberWithCommas(g.toFixed(2));
	}
	function selectCalculateAddPRtracker(me){	
		if(me.checked == true){
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "rgb(206, 215, 218)";
			var total = parent.children[8].children[0].value.replace(/,/g,"");
			if(total){
				var gTotal = parseFloat(document.getElementById('totalAmountItems').value.replace(/,/g,"")) + parseFloat(total);
				document.getElementById('totalAmountItems').value = numberWithCommas(gTotal.toFixed(2));
			}
		}else{
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "inherit";
			var total = parent.children[8].children[0].value.replace(/,/g,"");
			if(total){
				var gTotal = parseFloat(document.getElementById('totalAmountItems').value.replace(/,/g,"")) - parseFloat(total);
				document.getElementById('totalAmountItems').value = numberWithCommas(gTotal.toFixed(2));
			}
		}
	}
	function updatePR(){
		
		var error = 0;
		var prData = '';
		
		var dummyProgram = '';
		var programs = '';
		var totalDetails = '';
		var parent = document.getElementById('prItemsTable');
		var trLength = parent.children[0].children.length;
		
		for(var i = 1 ; i < trLength-1; i++){
			var checkMe = parent.children[0].children[i].children[3].children[0].checked;
			if(checkMe == true){
				var trackingNumber = document.getElementById("prEditTracking").value;
				
				var program =encodeURIComponent(parent.children[0].children[i].children[1].children[0].value.trim());
				
				var code = encodeURIComponent(parent.children[0].children[i].children[1].children[1].value.trim());
						
				var category = encodeURIComponent(parent.children[0].children[i].children[2].children[0].children[1].value.trim());
				
				var item = encodeURIComponent(parent.children[0].children[i].children[2].children[1].children[1].value.trim());
			
				var itemId = encodeURIComponent(parent.children[0].children[i].children[2].children[1].children[0].children[0].value);
				
				var desc =encodeURIComponent(parent.children[0].children[i].children[2].children[2].value.trim());
				
				
				
				var qty = parent.children[0].children[i].children[4].children[0].value.trim();
				var unit = encodeURIComponent(parent.children[0].children[i].children[4].children[2].value.trim());
				var cost = parent.children[0].children[i].children[6].children[0].value.replace(/,/g,"");
				var total = parent.children[0].children[i].children[8].children[0].value.replace(/,/g,"");
				
				
				if(program.length < 4){
					parent.children[0].children[i].children[1].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(code.length < 8){
					parent.children[0].children[i].children[1].children[1].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(category.length < 4){
					parent.children[0].children[i].children[2].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(desc.length < 1){
					parent.children[0].children[i].children[2].children[1].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(qty.length < 1){
					parent.children[0].children[i].children[4].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(unit.length < 1){
					parent.children[0].children[i].children[4].children[2].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(cost.length < 1){
					parent.children[0].children[i].children[6].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				prData += category + '~!~' +  program + '~!~' + code + '~!~' + desc + '~!~' + qty + '~!~' + unit + '~!~' + itemId + '~!~' +  cost + '~#~';	
				totalDetails += category + '~!~' +  program + '~!~' + code + '~!~' + total + '!#!';
				if(dummyProgram != program){
					programs += program + '~';
					dummyProgram = program;
				}
			}	
		}
		
		//pigeon sort
		var detailsA = totalDetails.split('!#!');
		var batchTotals = {};
		for(var i = 0 ; i < detailsA.length-1; i++){
			var detailsB = detailsA[i].split('~!~');
			var category = detailsB[0];
			var program = detailsB[1];
			var code = detailsB[2];
			var total = detailsB[3];
			if(batchTotals[category + '~' + program+ '~' + code] == undefined){
				batchTotals[category + '~' + program+ '~'+code] = 0;
			}
			batchTotals[category + '~' + program+ '~'+code] = parseFloat( batchTotals[category + '~' +program+ '~'+code]) +  parseFloat(total);
		}
		
		var grp = '';
		var oTotal = 0;
		for (var key in batchTotals) { 
		    var splitA =   key.split('~');
		    var category = splitA[0];
		    var program = splitA[1];
		    var code = splitA[2];
		    var total = 	batchTotals[key] ;
		    oTotal = oTotal + total;
		   grp += encodeURIComponent(category) + '~!~' + encodeURIComponent(program)+ '~!~' +  encodeURIComponent(code) + '~!~' + total + '~#~';
		}

		var terms = document.getElementById('goodsPReditTerms');
		var header = document.getElementById('goodsPReditHeader');
		// if(terms.value.trim().length == 0) {
		// 	error = 4;
		// }

		if(error == 0){
			var trackType = '';
			var queryString = "updatePR=1&trackType=" + trackType + 
							"&grp=" + grp +
							"&prData=" + prData  + 
							"&oTotal=" + oTotal +
							"&trackingNumber=" + trackingNumber +
							"&terms=" + encodeURIComponent(terms.value.trim()) + 
							"&header=" + encodeURIComponent(header.value.trim());
			var container = document.getElementById('doctrackUpdateContainer');

			loader();
			ajaxPost(queryString,processorLink, container,"updatePR");
		}else if(error == 1){
			msg("Please complete the required fields.");
		}
	}
	function updateOBR(){
		var error = 0;
		var obrData = '';
		var parent = document.getElementById('obrItemsTable');
		var trLength = parent.children[0].children.length;
		var trackingNumber = document.getElementById("obrEditTracking").value;
		var total = document.getElementById("totalAmountItems").value.replace(/,/g,"");
		var prg='';
		var prgCount =0;

		//var ptrs = document.getElementById('sequenceNumWGS1').value.trim();
		var ptrs = 1;
		if(document.getElementById('sequenceNumWGS1') != null) {
			 ptrs = document.getElementById('sequenceNumWGS1').value.trim();
		}

		if(ptrs.length > 0) {
			alert("PTRS Number is not empty. Please hit ENTER.");	
		}else {
			for(var i = 1 ; i < trLength-2; i++){
				var program =encodeURIComponent(parent.children[0].children[i].children[1].children[0].childNodes[0].textContent);
				var code =encodeURIComponent(parent.children[0].children[i].children[2].children[0].childNodes[0].textContent);
				var amount =encodeURIComponent(parent.children[0].children[i].children[3].children[0].value);
				if(program == ""){
					error = 1;
					parent.children[0].children[i].children[1].children[0].style.backgroundColor = "rgb(251, 212, 212)";
				}
				if(code == ""){					
					parent.children[0].children[i].children[2].children[0].style.backgroundColor = "rgb(251, 212, 212)";
					error = 1;
				}
				if(amount == "" || amount == 0){
					parent.children[0].children[i].children[3].children[0].style.backgroundColor = "rgb(251, 212, 212)";
					error = 1;
				}
				if(prg != program){
					prgCount++;
					prg = program;
				}
				obrData += program + "~!~" + code + "~!~"   +  amount + "~~";	
			}
			
			var chargeType;
			if(i > 2){
				if(prgCount > 1){
					chargeType = 3; 
				}else{
					chargeType = 2;
				}
			}else{
				chargeType =1;
			}
			
			
			if(error == 0){
				//var sub = 0;
				
				// var subC = document.getElementById("editOBRsubCodeSelect").value;
				var subC = document.getElementById('peorSubCodeEDIT').value;
				var peorOfc = document.getElementById('peorOfcIdEDIT').value;
				/*if(document.getElementById("editOBRsubCodeSelect").value == 0){
					alert("wala");
				}else if(document.getElementById("editOBRsubCodeSelect").value == -1){
					alert("wala gi pili");
				}else{
					alert("naa");
				}*/
				
				var queryString = "?updateOBR=1&oTotal=" + total + "&trackingNumber=" + trackingNumber  + "&grp=" + obrData + "&chargeType=" + chargeType + "&subC=" + subC + "&peorOfc=" + peorOfc;
				var container = document.getElementById('doctrackUpdateContainer');
				
				loader();
				ajaxGetAndConcatenate(queryString,processorLink, container,"updateOBR");
			}else if(error == 1){
				msg("Please complete the required fields.");
			}
		}
		
	}
	
	function showSubCodeSelectionEditDirect(me) {
		var tn = me.id.replace("editor","");
		var queryString = "?showSubCodeSelectionEditDirect=1&tn="+tn;
		var container = "";
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"showSubCodeSelectionEditDirect");
	}

	function updateEDITPEORDirect(me) {
		var temp = me.id.split("*");
		var selOfcId = temp[0];
		var selSubCode = temp[1];
		var tn = temp[2];

		document.getElementById('clickClose').click();

		var queryString = "?updateEDITPEORDirect=1&subCode="+selSubCode+"&peorOfc="+selOfcId+"&tn="+tn;
		var container = "";
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"updateEDITPEORDirect");

	}

	function showSubCodeSelectionEdit(key) {
		var queryString = "?fetchSubProgramBalanceForEdit=1&key="+key;
		var container = "";
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchSubProgramBalanceForEdit");
	}

	function setEDITPEORDetails(me) {
		var temp = me.id.split("*");
		var selOfcId = temp[0];
		var selSubCode = temp[1];
		var contName = temp[2];

		var subCodeHid = document.getElementById('peorSubCode'+contName);
		var ofcIdHid = document.getElementById('peorOfcId'+contName);
		var codeCont = document.getElementById('peorCodes'+contName);

		var tdS = me.children;
		var cellOfcName = tdS[1].textContent;
		var cellSubName = tdS[2].textContent;

		codeCont.innerHTML = "<span style='color:rgb(35, 116, 157);'>"+cellOfcName+"</span> "+cellSubName;
		subCodeHid.value = selSubCode;
		ofcIdHid.value = selOfcId;

		document.getElementById('clickClose').click();
	}
	
	function cancelEditPR(me){
		var trackingNumber = me.id.replace("editPR","");
		var trackingNumber = trackingNumber.replace("editOBR","");
		
		
		var container = document.getElementById("doctrackUpdateContainer");
		var queryString = "?prEditCancel=1&trackingNumber=" + trackingNumber;
		
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"prEdit");
	}
	function AddOBR(){
		var parent = document.getElementById("obrItemsTable");
		
		var children = parent.children[0].children.length;
	
		/*for(var i = 1; i <children-2; i++){
			var tr = parent.children[0].children[i].children[1].children[0].value;
			
		}*/
		var trFirst = document.createElement("tr");
		trFirst.innerHTML = '<td colspan = "5">' + children  + '</td>';
		var    y = '<td style = "padding:0 10px;border:1px solid white;border-top:0px solid white;border-bottom:2px solid white;background-color:rgb(222, 228, 231);"><input  onclick ="removeOBR(this)" type = "checkbox" checked/></td>';
			 y += ' 	    <td style = "padding:10px 5px;border-bottom:2px solid white;text-align:center;vertical-align:top;">' + document.getElementById("fundHidden").innerHTML  +  '</td>';
			 y += '	     <td style = "padding:10px 5px;text-align:center;border-bottom:2px solid white;vertical-align:top;" onclick ="clickInputAccount1(this)">' + document.getElementById("accountHidden").innerHTML + '</td>';
			 y += '	     <td style = "padding:10px 10px;text-align:center;border-bottom:2px solid white;vertical-align:top;"><input onclick = "clickInput(this)" onkeydown="return isAmount(this,event)"  onkeyup="calculateAddOBR(this)" maxlength = "15" class = "select2" style = "padding-right:10px;font-size:18px;width:95%;text-align:right;" /></td>';
			 y +=  '<td style = "padding:10 10px;border:1px solid white;border-top:0px solid white;border-bottom:2px solid white;background-color:rgb(222, 228, 231);">&nbsp;</td></tr>';
						
		var  x=  parent.children[0].children[1].innerHTML;
		trFirst.innerHTML = y;
		
		parent.children[0].insertBefore(trFirst,parent.children[0].children[1]);
	}
	function removeOBR(me){	
		var parent = me.parentNode.parentNode.parentNode;
		var tr =  me.parentNode.parentNode;
		var  amount = tr.children[3].children[0].value.replace(/,/g,"");
		if(amount > 0){
			var total  = document.getElementById("totalAmountItems").value.replace(/,/g,"");
			document.getElementById("totalAmountItems").value = total - amount;
		}
		parent.removeChild(tr);
	}
	function calculateAddOBR(me){
		var parent = document.getElementById("obrItemsTable");
		var children = parent.children[0].children.length;
		var total = 0;
		for(var i = 1; i <children-2; i++){
			var amount = parent.children[0].children[i].children[3].children[0].value;
			if(amount > 0){
				total = parseFloat(total) + parseFloat(amount);
			}
		}
		document.getElementById("totalAmountItems").value = numberWithCommas(total.toFixed(2));
	}
	function inputTotals(parent,length){
		var g = 0;
		for(var i = 1 ; i < length-1; i++){
			var check = parent.children[i].children[3].children[0].checked;
			if(check){
				var  total =  parseFloat(parent.children[i].children[8].children[0].value.replace(/,/g,""));
				g = g + total;
			}
		}
		document.getElementById('totalAmountItems').value = numberWithCommas(g.toFixed(2));
	}
	function clickInputProgram(me){
		var office = me.id.replace("obr",'') ;
		var fund = document.getElementById("fundHidden").innerHTML;
		me.parentNode.innerHTML = fund;
	}
	function clickInputAccount1(me){
		var  me1 = me.children[0];
		if (checkFundEmpty(me1) == ""){
			alert("Select program code first.");
		}
	}
	function clickInputAccount(me){
		
		if(checkFundEmpty(me)){
			var acct = document.getElementById("accountHidden").innerHTML;
			me.parentNode.innerHTML = acct;
		}else{
			alert("Select program code first.");
		}
	}
	function checkFundEmpty(me){
		var type=  me.parentNode.parentNode.children[1].children[0].tagName;
		if(type == "SELECT"){
			var select  = me.parentNode.parentNode.children[1].children[0].value;
			if(select){
				return true;	
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
	function checkProgram(me){
		var acct = me.parentNode.parentNode.children[2].children[0];
		if(acct.tagName == "DIV"){
			checkPair(acct);
		}
		var program =  me.value;
		var x = me.selectedIndex;
		var y = me.options;
		var text = y[x].text.replace(program,"") 
		var  value = '<div onclick = "clickInputProgram(this)" class = "select2" style = "width:95%;font-size:16px;text-align:left;background-color:white;">' +  program + '<br/><span style = "color:rgb(64, 179, 219);"> ' + text + '</span></div>';
		me.parentNode.innerHTML = value;
		
		getSubCodeEditOBR(program);
	}
	function getSubCodeEditOBR(programCode){
		
		var queryString = "?getSubCodeEditOBR=1&subCode=" + programCode;
		var container = document.getElementById('subCodeSelect');
		ajaxGetAndConcatenate(queryString,processorLink,container,"getSubCodeEditOBR");
	}
	function checkPair(me){
		if(me.tagName == "SELECT"){
			var accountCode = me.value;
			var  row = me.parentNode.parentNode.rowIndex;
			var prog = me.parentNode.parentNode.parentNode.children[row].children[1].children[0].childNodes[0].textContent;
			var  id = prog + accountCode;
		}else if(me.tagName == "DIV"){
			var accountCode = me.childNodes[0].textContent;
			var  row = me.parentNode.parentNode.rowIndex;
			var prog = me.parentNode.parentNode.parentNode.children[row].children[1].children[0].value;
			var  id = prog + accountCode;
		}
		
		var parent = me.parentNode.parentNode.parentNode;
		
		var length = parent.children.length;
		
		var pair = 0;
		for(var  i = 1; i < length - 2;i++){
			if(i!= row){
				var fund=  parent.children[i].children[1].children[0].childNodes[0].textContent;
				var acct = parent.children[i].children[2].children[0].childNodes[0].textContent;
				var id2 = fund + acct;	
				
				if(id ==  id2){
					if(me.tagName == "SELECT"){
						selectToIndexZeroA(me);
					}else{
						 parent.children[row].children[1].innerHTML = document.getElementById("fundHidden").innerHTML;
					}
					parent.children[i].children[3].children[0].style.backgroundColor = "rgb(254, 216, 216)";
					pair = i;
					break;
				}
			}
		}
		if(pair != 0){
			alert("Edit the existing selection.");
		}else{
			if(me.tagName != "DIV"){
				var x = me.selectedIndex;
				var y = me.options;
				var text = y[x].text.replace(accountCode,"") 
				var  value = '<div onclick = "clickInputAccount(this)" class = "select2" style = "width:95%;font-size:16px;text-align:left;background-color:white;">' +  accountCode + '<br/><span style = "color:rgb(64, 179, 219);"> ' + text + '</span></div>';
				me.parentNode.innerHTML = value;
			}
		}
	}
	function saveCheckDetails(me){
		var trackingNumber = me.id.replace("check",'');
		var checkNumber = document.getElementById("addCheckNumber").value;
		var checkAmount = Math.abs(document.getElementById("addCheckAmount").value.replace(/,/g,""));
		var net = document.getElementById("adviceNetAmount");
		var checkDate = document.getElementById("addCheckDate").value;
		var accountNumber = document.getElementById("addCheckAccount").value;
		var error = 0;
		if(net){
			var netAmount =  Math.abs(net.innerHTML.replace(/,/g,""));
			if(netAmount != checkAmount){
				error = 4;	
			}
		}
		if(checkNumber.length < 6){
			error = 1; 
		}
		if(checkDate.length < 8){
			error = 1; 
		}
		if(checkAmount.length < 1){
			error = 2;
		}
		if(checkAmount  <= 0){
			error = 3;
		}
		if(error == 1){
			alert("Please review your entries. Too short.");
		}else if(error == 2){
			alert("Please type check amount.");
		}else if(error == 3){
			alert("Invalid check amount.");
		}else if(error == 4){
			alert("Mismatch. Please correct net amount.");
		}else{
			loader();
			var container = document.getElementById("doctrackUpdateContainer");
			var queryString = "?addCheckInfo=1&trackingNumber=" + trackingNumber + "&checkNumber=" + checkNumber + "&checkDate=" + checkDate + "&accountNumber=" + accountNumber + "&checkAmount=" + checkAmount ;
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
		}
	}
	function gotoCheckDate(me,para){
		var length = me.value.length; 
		if(length > 5){
			focusNext("addCheckDate");
		}else{
			alert("Kulang man ang check number.");
		}
	}
	function gotoCheckAmount(me,para){
		var length = me.value.length; 
		focusNext("addCheckNumber");
		/*if(length > 5){
			focusNext("addCheckAmount");
		}else{
			alert("Kulang man ang check number.");
		}*/
	}
	function gotoSaveCheck(me,para){
		var length = me.value.length; 
		if(length > 7){
			var button = me.parentNode.parentNode.parentNode.children[3].children[2].children[0];
			button.click();
		}else{
			alert("Invalid check date.");
		}
	}
	function AddPRItem(me){
		var table = me.parentNode.parentNode.parentNode;
		var tr1 = table.children[0].children[1].innerHTML;
		var tr0 = document.createElement("tr");
		tr0.style.backgroundColor = "rgb(206, 233, 244)";
		tr0.innerHTML = tr1;
		
		tr0.children[0].children[0].innerHTML = 0;
		tr0.children[0].children[0].style.backgroundColor = "rgb(249, 158, 169)";
		tr0.children[0].children[0].style.border = "2px solid white";
		tr0.children[2].children[1].value = "";
		tr0.children[3].children[0].checked = false;
		table.children[0].insertBefore( tr0,table.children[0].children[1]);
	}
	function highlight(me){
		
		var  color = me.style.backgroundColor;
	
		var row = me.rowIndex + 1;
		var status = me.children[12].children[0];
		
		var tn = me.children[1].children[0];
		var obr = me.children[2].children[0];
		var  adv = me.children[3].children[0];
		var  pr = me.children[4].children[0];
		var  po = me.children[5].children[0];
		
		
		
	
		if(color != "orange"){
			me.style.backgroundColor = "orange";
			tn.style.fontWeight = "bold";
			status.style.color ="black"
			tn.style.color ="black";
			obr.style.color ="black";
			adv.style.color ="black";
			pr.style.color ="black";
			po.style.color ="black";
			
			
		}else{
			tn.style.color ="rgb(7, 146, 185)";
			obr.style.color ="rgb(225, 74, 127)";
			adv.style.color ="rgb(9, 147, 18)";
			pr.style.color ="rgb(219, 118, 10)";
			po.style.color ="rgb(107, 109, 14)";
			
			
			
			
			tn.style.fontWeight = "normal";
			
			if(row %  2 == 0){ // sa row
				me.style.backgroundColor ="white";
			}else{
				me.style.backgroundColor = "rgb(217, 228, 232)";
			}
			
			if(status.textContent == "Check Advised"  || status.textContent == "Forwarded to CTO"){ //sa cell
				status.style.color ="orange";
			}else{
				var text = status.textContent;
				var  n = text.indexOf("Pending"); 
				if(n != -1){
					status.style.color ="rgb(250, 64, 85)";
				}else{
					status.style.color = "rgb(7, 146, 185)";
				}
				
			}
		}
	
	}
	function clickToSearch(me){
		var trackingNumber = me.children[1].children[0].textContent;
		//document.getElementById("ok").value = trackingNumber;
		var queryString = "?searchTrackingNumber=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"searchTrackingNumber");
	}
	function loadMore(me){
		var parent = me.parentNode.parentNode.parentNode;
		var tr =  me.parentNode.parentNode;
		parent.removeChild(tr);
		var split = me.id.split('~');
		var id = split[0];
		var ctr = split[1];
		var key = split[2];
		loader();
		var queryString = "?loadMore=1&id=" + id + "&ctr=" + ctr + "&key=" + key;
		var container = parent;
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadMore");
	}
	function previewPO(me){
		var queryString = "?previewPO=1&tn=" + me.id;
		var container = ""	;
		ajaxGetAndConcatenate(queryString,processorLink,container,"previewPO");
	}
	function enteredSpent(me){
		var amount = me.value.replace(/,/g,"");
		var reim = '';
		var cashAdvance = document.getElementById("caEditAmount").value.replace(/,/g,"");
		var refund =  round2(parseFloat(cashAdvance) - parseFloat(amount));
		if(amount != ''){
			if(refund < 0){
				reim = numberWithCommas(refund.replace(/-/g,"")); 
				refund = '';
				document.getElementById("trEditOR").style.display = "none";
				document.getElementById("editOR").value = '';
			}else if(refund == 0){
				refund = '';
				reim = '';
				document.getElementById("trEditOR").style.display = "none";
				document.getElementById("editOR").value = '';
			}else{
				
				refund = numberWithCommas(refund);
				document.getElementById("trEditOR").style.display = "table-row";
				if(document.getElementById("editOR")){
					if(document.getElementById("orDetailsDis")){
						document.getElementById("editOR").value = document.getElementById("orDetailsDis").textContent;
					}else{
						document.getElementById("editOR").value = "";
					}
					
				}else{
					document.getElementById("editOR").value = "";
				}
			}
			
			
			document.getElementById("amountRefundEdit").value = refund;
			document.getElementById("amountReimEdit").value = reim ;
			me.value = numberWithCommas(amount);
		}
	}	
	function goUpdateLiquidation(me){
		var ref = document.getElementById("amountRefundEdit").value.replace(/,/g,"");
		var reim = document.getElementById("amountReimEdit").value.replace(/,/g,""); 
		var spent  = document.getElementById("amountSpentEdit").value.replace(/,/g,"");
		var trackingNumber = me.id.replace("editor",'');
		
		
		var go = 1;
		if(ref > 0){
			var or  = document.getElementById("editOR").value;
			if(or.length > 5){
				go = 1;
			}else{
				go = 0;
			}
		}else{
			var or  = "";
		}
		if(spent != ''){
			if(go == 1){
				var queryString = "?editLiquidationAmount=1&trackingNumber=" + trackingNumber + "&ref=" + ref +"&reim=" + reim + "&spent=" + spent + "&or=" + or;
				var container = document.getElementById('doctrackUpdateContainer');
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"editLiquidationAmount");
			}else{
				alert("Please complete OR details.");
			}
		}else{
			alert("Please enter amount.");
		}
	}
	function getSubCodeEditOBR(programCode){
		
		var queryString = "?getSubCodeEditOBR=1&subCode=" + programCode;
		var container = document.getElementById('editOBRsubCodeSelect');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"getSubCodeEditOBR");
	}
	function viewItemList(me){
		var  cat =  me.parentNode.parentNode.children[0].children[1].value.trim();
		var id =    me.id.replace('itemB','');
		
		var queryString = "?loadItemsByCat=1&cat=" + cat + "&id=" + id;
		var container = "";
		
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadItemsByCat");
	}
	function clickPPMPItem(me){
		var arr  = me.id.split("!");
		var prIdA ="itemA" + arr[0];
		var prIdB ="itemB" + arr[0];
		var prIdC ="itemC" + arr[0];
		var id = arr[1];
		var itemName  =  me.textContent;
		
		document.getElementById(prIdA).value = id;
		document.getElementById(prIdB).value = itemName;
		document.getElementById(prIdC).value = itemName;
		closeAbsolute(me);
	}
	function changeCat(me){
		var arr = document.getElementsByClassName("catcat");
		for(var i = 0; i < arr.length; i++ ){
			arr[i].value = me.value.toUpperCase(); 
		}
	}
	function createRemark(me){
		var tn = me.id.replace("remarkTN","");
		remarks1("Create Message","Remark",tn,"saveRemark(this)");
	}
	function saveRemark(me){
		var tn =  me.id;
		var value = encodeURIComponent(remValue.value);
		
		var queryString = "?saveRemark=1&tn=" + tn + "&value=" + value;
		var container = document.getElementById('doctrackUpdateContainer');
		
		ajaxGetAndConcatenate(queryString,processorLink,container,"saveRemark");
		closeAbsolute(1);
		loader();
	}
	function cancelCheck(me){
		var answer = confirm("You are about to cancel the check for this transaction. Please confirm.");
		if(answer){
			
			var tn = me.id;
			var d = "<table><tr><th style = 'text-align:left;'>Note</th></tr><tr><td><textarea id ='cancelCheckReason' style = 'width:200px;'></textarea></td></tr><tr><td style = 'padding:10px;'><div id = '" + tn + "' onclick = 'saveCancelCheck(this)' class ='button1' style= 'width:100px;font-size:14px;'>Save Cancel</div></td></tr></table>";
			msg2(d);
		}
	}
	function saveCancelCheck(me){
		
		var tn = me.id;
		var reason = encodeURIComponent(document.getElementById("cancelCheckReason").value.trim());
		var queryString = "?cancelCheck=1&tn=" + tn + "&reason=" + reason;
		var container = document.getElementById('doctrackUpdateContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"updateTracking1");
		document.getElementById("clickClose").click();
		loader();
		sendSms(tn);
	}
	function reissueCheck(me){
		var answer = confirm("Reprocess transaction and issue new check?");
		if(answer){
			var tn = me.id;
			
			var queryString = "?reissueCheck=1&tn=" + tn;
			var container = document.getElementById('doctrackUpdateContainer');
			ajaxGetAndConcatenate(queryString,processorLink,container,"updateTracking1");
			loader();
			sendSms(tn);
		}
		
	}
</script>


