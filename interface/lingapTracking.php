<style>
	.buttonRemoveLingap{
		font-size:12px;
		width:40px;
		text-align:center;
		border-top:1px;
		border-left:1px;
		border-right:2px solid ;
		border-bottom:2px solid ;
	}
</style>
<table style = "margin:20px auto;">
	<tr>
		<td>
			<span class="label2">List of encoded beneficiaries</span>
			<div id = "lingapContainerAll" style = "border:1px solid silver;height:700px;width:900px;overflow-y: auto;">
			</div>
		</td>
		<td style = "vertical-align:top;">
			<div id = "inputContainerLingap2" style = "margin-left:15px;">
				<table class = "tableEncoder">
					<tr>
						<td style = "text-align: right;"><span class="label2">TN#</span></td>
						<td>
							<input id = "lingapTN" readonly class = "inputText1" style ="width:280px;font-size:18px;"  ondblclick="unlock(this)" onkeydown="return isAmount(this,event)" maxlength="4" onkeyup="keypressAndWhat(this,event,searchLingap)"/>
						</td>
					</tr>
					<tr>
						<td style = "text-align: right;"><span class="label2">TOTAL AMOUNT</span></td><td>
							<input  id = "lingapAmount" readonly class = "inputText1"  style ="width:280px;font-size:26px;letter-spacing:0px; font-weight:bold; font-family: Courier New;color:white;text-shadow: 0px 0px 2px black;"/>
						</td>
					</tr>
					<tr>
						<td style = "text-align: right;"><span class = "number">3</span><span class="label2">DOC. TYPE</span></td>
						<td >
							<select  id = "lingapDocType" class = 'inputText' style ="width:280px;font-size:18px;letter-spacing:0px;"  onchange="selectHospital(this)"  >
								 <option value = ''></option>
								<option>ASSISTANCE - FUNERAL</option>
								<option>ASSISTANCE - MEDICAL</option>
							</select>
						</td>
					</tr>
					
					
					<tr>
						<td style = "text-align: right;"><span class="label2">CLAIMANT</span></td>
						<td  id = "lingapHospitalTD">
							<select  id = "lingapHospital" class = 'inputText' style ="width:280px;font-size:18px;letter-spacing:0px;text-align: left;"   >
								 <option value = ''></option>
								
							</select>
						</td>
					</tr>
					<tr>
						<td ></td>
						<td  style = "text-align: center;padding:10px 0px;">
							<div class = "button"id = "saveLingapButton"   onclick = "saveTrackingLingap()">Save</div>
						</td>
					</tr>
				</table>
				
			</div>
			<table style = "width:100%;margin-left:40px;">
					<tr>
						<td colspan="2" style = "padding:15px 0px;padding-bottom: 5px;"><span class="tdHeader" style = "background-color: white;border:0;color:black;">Search Beneficiary</span></td>
					</tr>
					<tr>
						<td style = "text-align: right;"><span class="label2">TYPE NAME</span></td>
						<td>
							<input id = "lingapName"   style ="font-weight:bold;width:260px;font-size:18px;text-align:center;padding:5px;"   maxlength="10" onkeypress="keypressAndWhat1(this,event,searchLingapName,1)"/>
						</td>
					</tr>
				</table>
		</td>
	</tr>
</table>
<script>

	loadLingap();
	function loadLingap(){
		var cookieText = readCookie("lastLingapMenu");
		if(cookieText == 1){
			loader();
			var queryString = "?fetchLingapEncoded=1" ;
			var container = "";
			ajaxGetAndConcatenate(queryString,processorLink,container,"lingapReturnTracking");
		}
	}
	function computeTotal(me){
		var amount =  me.parentNode.parentNode.children[3].textContent;
		amount =  parseFloat(amount.replace(/,/g,""));
		var  total = parseFloat(document.getElementById("lingapAmount").value.replace(/,/g,""));
		var row = me.parentNode.parentNode.rowIndex;
		if(me.checked ==  true){
			var balance = total +  amount;
			if(row % 2 == 1 ){
				me.parentNode.parentNode.style.backgroundColor = "rgb(229, 236, 225)";
			}else{
				me.parentNode.parentNode.style.backgroundColor = "";
			}
		}else{
			var balance =total -  amount;
			me.parentNode.parentNode.style.backgroundColor = "rgb(254, 81, 121)";
		}
		document.getElementById("lingapAmount").value = numberWithCommas(balance);
	}
	function computeAll(me){
		var gross = 0;
		var children = me.parentNode.parentNode.parentNode.children.length;
		if(me.checked ==  false){
			for(var i = 2; i < children ; i++){
				me.parentNode.parentNode.parentNode.children[i].children[4].children[0].checked =false;
				me.parentNode.parentNode.parentNode.children[i].style.backgroundColor = "rgb(247, 225, 230)";
			}
			document.getElementById("lingapAmount").value = 0.00;
		}else{
			for(var i = 2; i < children ; i++){
				me.parentNode.parentNode.parentNode.children[i].children[4].children[0].checked = true;
				var amount = parseFloat(me.parentNode.parentNode.parentNode.children[i].children[3].textContent.replace(/,/g,""));
				gross = gross + amount;
				if(i % 2 == 1 ){
					me.parentNode.parentNode.parentNode.children[i].style.backgroundColor  = "rgb(229, 236, 225)";
				}else{
					me.parentNode.parentNode.parentNode.children[i].style.backgroundColor  = "";
				}
			}
			document.getElementById("lingapAmount").value = numberWithCommas(gross);
		}
	}
	function saveTrackingLingap(){
		var docType =  document.getElementById("lingapDocType").value;

		// var claimant =  encodeURIComponent(document.getElementById("lingapHospital").value);
		var clmRec = document.getElementById("lingapHospital").value.split('*j*');
		var claimant = encodeURIComponent(clmRec[0]);
		var oneTax = clmRec[1];

		var amount =  document.getElementById("lingapAmount").value.replace(/,/g,"");
		var parent = document.getElementById("beneficiaryTable").children[0];
		var  length = parent.children.length;
		var ids= "";
		var container = document.getElementById('inputContainerLingap2');		
		var empty = checkEmptyField(container);
		if(amount >0){
			if(empty == 0){
				if(document.getElementById("mainLingapCheck")){
					var mainCheck = document.getElementById("mainLingapCheck").checked;
					if(mainCheck == true){
						for(var i = 2; i < length ; i++){
							var check =  parent.children[i].children[4].children[0].checked;
							if(check == true){
								var id = parent.children[i].children[0].textContent;
								ids += id + ","; 
							}
						}
						
						ids = ids.substr(0,ids.length-1);
						if(ids.length >0 ){
							loader();
							var queryString = "?saveLingapTracking=1&ids=" + ids +"&claimant=" + claimant + "&docType=" + docType+ "&amount=" + amount + "&onetax=" + oneTax ;
							var container = "";
							ajaxGetAndConcatenate(queryString,processorLink,container,"saveLingapTracking");
						}else{
							alert("No beneficiaries selected.");
						}
						
					}else{
						alert("No beneficiaries selected.");
					}
				}else{
					alert("Click tracking for new entry.");
				}
				
			}
		}else{
			alert("No beneficiaries selected.");
		}
		
		
	}	
	function unlock(me){
		me.removeAttribute("readonly");
		me.value = "";
	}
	function searchLingap(){
		var tn = document.getElementById("lingapTN").value.trim();
		if(tn.length > 0){
			loader();
			var queryString = "?searchLingap=1&trackingNumber=" +  tn ;
			var container = "";
			ajaxGetAndConcatenate(queryString,processorLink,container,"searchLingap");
		}else{
			alert("Invalid tracking number.");
		}
	}
	function calculateLingap(me){
		var children = me.parentNode.parentNode.parentNode.children.length;
		var parent= me.parentNode.parentNode.parentNode;
		var gross = 0;
		for(var i = 3; i < children-1 ; i++){
			var amount =  parseFloat(parent.children[i].children[3].children[0].value.replace(/,/g,""));
			if(amount){				
				gross = gross + amount;
			}
		}
		document.getElementById("lingapAmount").value = gross;
	}
	function updateLingap(me){
		var totalAmount = document.getElementById("lingapAmount").value.replace(/,/g,"");
		var claimant = document.getElementById('lingClaimant').textContent.trim();
		var fund = document.getElementById('lingFund').value.trim();
		var trackingNumber = me.id;
		var parent = me.parentNode.parentNode.parentNode;
		var children = parent.children.length;
		var ids = '';
		var nameAll = '';
		var amountAll = '';
		var rafAll = ""; 
		var error  = 0;
		for(var i = 3; i < children-1 ; i++){
			var amount =  parent.children[i].children[3].children[0].value.replace(/,/g,"");
			var raf  =                           encodeURIComponent(parent.children[i].children[1].children[0].value.trim());
			var name  =                        encodeURIComponent(parent.children[i].children[2].children[0].value.trim());
			var  id  = parent.children[i].children[0].textContent;
			
			if(amount.length == 0 || amount == 0){
				 parent.children[i].style.backgroundColor = "rgb(254, 81, 121)";
				 error  = 1;
			}
			if(name.length == 0 ){
				 parent.children[i].style.backgroundColor = "rgb(254, 81, 121)";
				  error  = 1;
			}
			if(raf.length == 0 || amount == 0){
				 parent.children[i].style.backgroundColor = "rgb(254, 81, 121)";
				  error  = 1;
			}
			nameAll += name + '~!~';	
			amountAll  += amount + '~!~';	
			rafAll += raf + '~!~';	
			ids  += id + '~!~';	
		}
		if(error == 0){
				
				var queryString = "?updateLingap=1&nameAll=" + nameAll + "&amountAll=" +amountAll + "&rafAll=" + rafAll + "&amount=" + totalAmount  + "&trackingNumber=" + trackingNumber + "&ids=" + ids + "&claimant=" + encodeURIComponent(claimant) + "&fund=" + fund;
				var container = "";

				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"updateLingap");

		}else{
				alert("Incomplete entry.");
		}
	
	}	
	function selectHospital(me){
		var docType = me.value;
		loader();
		var queryString = "?fetchHospital=1&docType=" + docType ;
		var container = document.getElementById("lingapHospitalTD");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	function searchLingapName(me,para){
		var name   = me.value;
		if(name.length >2){
			loader();
			var queryString = "?fetchLingapName=1&name="  + name ;
			var container = document.getElementById("lingapContainerAll");
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
		}else{
			alert("Taasi gamay.");
		}
	}
	function searchThisLingap(me){
		var tn = me.textContent.substring(5);
		loader();
		var queryString = "?searchLingap=1&trackingNumber=" +  tn ;
		var container = "";
		ajaxGetAndConcatenate(queryString,processorLink,container,"searchLingap");
	}
	function removeBeneficiary(me){
		var id  = me.id;
		var tr= me.parentNode.parentNode;
		var amount = tr.children[3].children[0].value.replace(/,/g,"");
		var  tn = "LING-" +  document.getElementById('lingapTN').value;
		var answer = confirm("You are about to remove beneficiary from this list.");
		if(answer){
			var queryString = "?removeBeneficiary=1&id=" + id + "&tn=" + tn + "&amount=" + amount;
			var container = document.getElementById('lingapContainerAll');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"removeBeneficiary");
		}
	}
</script>