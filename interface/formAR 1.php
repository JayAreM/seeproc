<?php
	session_start();
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	
	require_once('../javascript/ajaxFunction.php');
   
	if (!isset($_SESSION['employeeNumber'])) {
		$redr = "<script>window.open('../../citydoc2020/interface/main.php', '_self');</script>";
		 echo $redr;
	}
	$tn = $database->charEncoder($_GET['tn']);
	
?>
<style>
	/*-----------------------------------------------------------------loader*/
	
	.loader{
			width:120px;
			height:120px;
			top:40%;
			background:url('../images/ajaxloader.gif');
			background-repeat:no-repeat;
			background-size:100px 100px;
			background-position:48% 48%;
			z-index:100;
			
	}	
	.loaderContainer{
		border:4px solid transparent;
		border-radius:2px;
		display:inline-block;	
	}
	.absoluteHolder1{
		z-index:105;
		position:absolute;
		text-align:center;
		background-color:rgba(252, 254, 254,.4);
		width:100%;
		height:100%;
	}
	/*---------------------------------------------------------------editor*/
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
		/*box-shadow:0px 0px 20px 10px rgba(0, 0, 0,.4);*/
		/*background-color:white;*/
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
		//background-color:rgb(23, 207, 253);
		text-shadow:0px 0px 2px orange;
	}
	.editorLabel{
		padding-right:15px;
		padding-left:40px;
		padding-top:40px;
		padding-bottom:20px;
		font-weight:bold;
		
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
		height: 15px;
		width: 15px;
		border-radius:50%;
		float:right;
	}
	.closeEditor:hover{
		cursor:pointer;
		background-color:rgb(250, 98, 116);
	}
	
	.divContent{
		/*height:700px;*/
		height: 848px;
		width: 750px;
		overflow: auto;margin:0 auto;
		border:2px solid black;
		/*border-bottom:0;*/
	}
	.tableContent{
		width: 100%;
		border-spacing:0;
		border-bottom: 1px solid black;
		overflow-y: hidden;
	}
	.subTotalDiv{
		//border:1px solid silver;
		border-top:1px solid black;
		border-bottom:1px solid black;
		
	}
	.certifiedDiv{
		height:170px;
		width: 750px;
		margin:0 auto;
		border:2px solid black;
	
		border-top: 0px;
		
	}
	.footerDiv{
		height:270px;
		width: 750px;margin:0 auto;
		border:2px solid black;
		
		border-top: 0px;
		margin-bottom: 10px;
	}
	.totalWordsDiv{
		height:40px;width: 750px;margin:0 auto;
		
		border:2px solid black;
	}
	.tdData{
		vertical-align: top;
		border-right:1px solid black;
		padding:0px 5px;
		padding-left:5px;
	}
	.tdData1{
		vertical-align: top;
		border-right:1px solid black;
		padding:0px 5px;
		padding-left:5px;
	}
	.tdHeader{
		border-bottom:1px solid black;
		border-right:1px solid black;
		padding-left:5px;
		font-weight: bold;
		border-top:1px solid black;
		text-align: center;
	}
	.text3{
		font-family: mainFont;
		padding: 5px 5px;
		width: 343px;
		font-weight:bold;
		font-size: 14px;
		border-top:1px solid silver;
		border-left:1px solid silver;
		background-color:rgba(6, 44, 66,.05);
	}
	input{
		font-family: Times new roman;
	}
	input:disabled{
		background-color: transparent;
		color: black;
	}
	.rowHover{
		transition: .3s all ease-in;
	}
	html,body{
		margin: 0;
		padding: 0;
	}
	.regular-checkbox {
		-webkit-appearance: none;
		-moz-appearance: none;
		border: 1px solid black;
		/*padding: 9px;*/
		display: inline-block;
		position: relative;
		margin-top: 10px;
	}
	.regular-checkbox:active, .regular-checkbox:checked:active {
		box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
	}

	.regular-checkbox:checked {
		border: 1px solid black;
		color: black;
	}
	.regular-checkbox:checked:after {
		content: '\2714';
		font-size: 14px;
		position: absolute;
		top: -2px;
		left: 2px;
		color: black;
	}
	.big-checkbox {
		/*padding: 10px;*/
		height: 20px;
		width: 20px;
	}

	.big-checkbox:checked:after {
		font-size: 16px;
		left: 4px;
	}
	.setBtn {
		display: inline-block;
		margin-top: 10px;
		color: white;
		background-color: rgb(101, 162, 192);
		padding: 8px 20px;
		cursor: pointer;
		border-top: 1px solid rgb(202, 232, 246);
		border-left: 1px solid rgb(202, 232, 246);
		border-right: 3px solid rgb(96, 153, 179);
		border-bottom: 3px solid rgb(96, 153, 179);
		border-radius: 2px;
		font-weight: bold;
	}
	.setBtn:hover {
		background-color: rgb(80, 139, 167);
		border-top: 2px solid rgb(72, 131, 158);
		border-left: 2px solid rgb(72, 131, 158);
		
		
		border-bottom: 1px solid rgb(110, 161, 184);
		border-right: 1px solid rgb(110, 161, 184);
		
	
		
	}
	.FormAirItmNum{
		width: 50px; 
		float: right;
		text-align: center;
		font-family: mainFont;
		font-weight:bold;
		font-size: 14px;
		border-top:1px solid silver;
		border-left:1px solid silver;
		background-color:rgba(6, 44, 66,.05);
	}
	.oldArDesc{
		width: 100%;
		font-family: mainFont;
		font-size: 14px;
		background-color: transparent;
		color: black;
		text-align: justify;
		white-space: pre-wrap;
		margin-bottom: 5px;
	}
	.newArDesc{
		width: 100%;
		min-height: 120px;
		font-family: mainFont;
		font-size: 14px;
		overflow-y: auto;
		text-align: justify;
		margin-bottom: 5px;
	}
	.floatingTab{
		display: inline-block;
		cursor: pointer;
		background-color: rgb(178, 193, 197);
		color: white;
		transition: .3s all ease-in;
		text-align: center;
		width: 120px;
		padding: 5px 0px;
		margin-right: 2px;
	}
	.floatingTab:hover{
		text-shadow: 0px 0px 2px white;
	}
	.floatingTab1{
		transition: .3s all ease-in;
		cursor: pointer;
		color: white;
		margin-right: 20px;
		font-size: 20px;
	}
	.floatingTab1:hover{
		color: rgb(253,7,7, .5);
	}
	.slctBtn{
		background-color: rgb(85, 177, 200);
		text-shadow: 0px 0px 2px white;
	}
	.revevCont{
		font-size: 12px;
		letter-spacing: 5px;
		margin-right: -3px;
	}
</style>
<link rel="icon" href="/citydoc2017/images/print.png"/> 
<title>AIR Form</title>
<div id  = "poMain" style = "">
	<div  class = "divContent" style = "">
		<table class = "tableContent" style="border-bottom: 1px solid black;">
			<tr id  = "trFirst">
				<td colspan="6"></td>
			</tr>	
			<tr>
				<td class = "tdHeader" style  ="padding:0px 5px;">No.</td>
				<td class = "tdHeader"  style  ="width:10px;padding:0px 5px;">Unit</td>
				<td class = "tdHeader">Description</td>
				<td class = "tdHeader"  style  ="padding:0px 5px; border-right: 0px;">Qty</td>
			</tr>
			<tr id  = "trThird">
				<td colspan="6"></td>
			</tr>	
		</table>
		
	</div>
	
</div>

<script>
	var ofis; 
	var itemNum = 0;
	viewPO();
	getArUploadTypes();
	function viewPO(){
			
		var  tn = "<?php  echo $tn ?>";
		var container = document.getElementById("poMain");
		var queryString = "?fetchPODetails&tn=" +  tn ;
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchPODetails");			
	}
	function getInvDetails(){
		var  tn = "<?php  echo $tn ?>";
		var container = "";
		var queryString = "?fetchPartInv&tn=" +  tn ;
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchPartInv");			
	}
	var invNo = "";
	var invDate = "";
	var invRecBy = "";
	var invAcc = "";
	var invAccDate = "";
	function setInv(invs) {
	    var temp = invs.split("<!>");
	    console.log(temp);
	    invNo = temp[0];
	    invDate = temp[1];
	    invRecBy = temp[2];
	    invPoDate = temp[4];
	    invAccDate = temp[5];
	    
		if(temp[3] == ""){
			invAcc = "";
		} else {
			invAcc = temp[3];
		}
	    checkAll(invAcc);

	    var disInvNo = document.getElementsByName('disInvNo');
	    var disInvDate = document.getElementsByName('disInvDate');
	    var disAccName = document.getElementsByName('disAccName');
	    var disPoDate = document.getElementsByName('poDate');
	    var disAccDateReceived = document.getElementsByName('disAccDateReceived');

	    for (var i = 0; i < disInvNo.length; i++) {
	    	disInvNo[i].value = invNo;
	    	disInvDate[i].value = invDate;
	    	disAccName[i].value = invRecBy;
	    	disPoDate[i].value = invPoDate;
	    	disAccDateReceived[i].value = invAccDate;
	    }

	}
	var arUploadTypes = "";
	function getArUploadTypes(){
		var queryString = "?getArUploadTypes=1";
	    var container = "";
	    ajaxGetAndConcatenate(queryString, processorLink, container, "getArUploadTypes");
	}
	function setArUploadTypes(types){
		arUploadTypes = types;
	}
	var jsonDetails;
	function createSheet(details){
		
		var txt = '';
		var j = JSON.parse(details);
		jsonDetails = j;
		var len =  j.desc.length;
		var tn =  j.trackingNumber;
		
		var office =  j.office;
		ofis = office;
		var officeC =  j.officeCode;
		var supplier =  j.supplier;

		var tSupplier = supplier.split(" ").reverse().join("").substring(0, 3);
		var tTotal = 0;
		var tNumber = "<?php  echo $tn ?>";

		var prNumber =  j.prNumber;
		prNumber = j.poNumber;

		if (prNumber == "" || prNumber == null) {
			prNumber = "";
		}
		
		var category =  j.catCode;
		var categoryName =  j.catName;
		var quart =  j.qua;
		
		document.getElementById("trFirst").innerHTML = header(office,supplier,prNumber,tn);
		document.getElementById("trThird").innerHTML = quarter(quart,category,categoryName);
		var c = poMain.children.length;	
		
		var div = poMain.children[c-1];
		div.style.borderBottom = "0";
		var table = div.children[0];
		var tableBody = div.children[0].children[0];

		var on = 0;
		var subTotal = 0;
		
		
		for(var i = 0; i < len; i++){
			tTotal += parseFloat(j.total[i].replace(",", ""));
			if(div.scrollHeight > div.offsetHeight){
				var cLen = (tableBody.children.length - 1);
				var lastChild = tableBody.children[cLen];
				
				div.scrollTop = 10000;
				var desc = lastChild.children[2].textContent.trim();
				
				var newLine = desc.split("\n");
				var lenLine = newLine.length-1;
				if (lenLine > 2){
					var td = lastChild.children[2];
					lastChild.children[0].style.borderBottom = "1px solid black";
					lastChild.children[1].style.borderBottom = "1px solid black";
					lastChild.children[2].style.borderBottom = "1px solid black";
					lastChild.children[3].style.borderBottom = "1px solid black";
					
					if (lastChild.parentElement.parentElement.style.borderBottom == '1px solid black') {
						lastChild.parentElement.parentElement.style.borderBottom = "0px";
					}
					
					td.innerHTML = "";
					var tempStr = '';
					var tempStr1 = '';
					for(var a = 0; a <= lenLine; a++){
						td.innerHTML += newLine[a] + "\n";
						
						if(div.scrollHeight > div.offsetHeight){		
							tempStr1 += newLine[a] + "\n";
						}else{
							tempStr += newLine[a] + "\n";
						}
					}
					var x = document.createElement("tr");
					
					tableBody.insertBefore(x,lastChild);
					//tableBody.appendChild(x);
					tableBody.removeChild(x);
					
					td.textContent = tempStr;
					 trimmer(div,poMain);
					//div.style.borderBottom = "1px solid black";
						i  = i -1;
				}else{
					 trimmer(div,poMain);
					tableBody.removeChild(lastChild); 
					var lastAmount = lastChild.children[2].textContent.replace(/,/g,"");;
					subTotal = subTotal - lastAmount;
					// tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:0px solid black;">' +  totalA(1,subTotal) + '<td></tr>';
					tempStr1 = '';
					i  = i -2;
				}
				inspectScrollerLast(div,poMain,"","");
				poMain.innerHTML +=  '<div class = "divContent" style="border-bottom: 0;"><table class = "tableContent" style="border-bottom: 1px solid black;">' + header(office,supplier,prNumber,tn) +  '<tr><td class = "tdHeader">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Description</td><td class = "tdHeader" style="border-right: 0px;">Qty</td></tr>'  + quarter(quart,category,categoryName) + halfText(tempStr1) +'</table></div>';
				
				if(i == len-1){
					
					var c = poMain.children.length;
					var div = poMain.children[c-1];
					var table = div.children[0];
					var tableBody = div.children[0].children[0];
					tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
					// if mulapas pag butang sa total then increase div decrease certificate
					 inspectScrollerLast(div,poMain,"","");
				}else{
					var c = poMain.children.length;
					var div = poMain.children[c-1];
					var table = div.children[0];
					var tableBody = div.children[0].children[0];
				}			
			}else{
				var num = (i + 1);
				
				var total =  j.total[i].replace(/,/g,"");
				var qty =  Math.abs(j.qty[i]);
				var desc =  j.desc[i].trim();
				var arr = desc.split("Replacement:\n");
				
				if(arr.length > 1){
					desc = arr[1];
				}
				var descX = desc.match(/\n/g);
				var descX = desc.split("\n");

			 	// tableBody.innerHTML +="<tr class='rowHover' id='rowNum"+num+"'><td style='width: 2%;' class = 'tdData' var='itemNum"+i+"'>" +  num + "</td><td class = 'tdData'  style='width: 2%;'>" + j.unit[i] +"</td><td id='desc"+j.poID[i]+"' class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word;'>" + desc + "</td><td class = 'tdData' style = 'text-align:center; border-right: 0px;' >" +qty+"</td></tr>";
			 	tableBody.innerHTML +="<tr class='rowHover' id='rowNum"+num+"'><td style='padding: 0px 12px;' class = 'tdData' id='itemNum"+i+"'>" +  num + "</td><td class = 'tdData'  style='padding: 0px 12px;'>" + j.unit[i] +"</td><td id='desc"+j.poId[i]+"' class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word;'>" + desc + "</td><td class = 'tdData' style = 'padding: 0px 12px; border-right: 0px;' >" +qty+"</td></tr>";
				subTotal = parseFloat(subTotal) + parseFloat(total) ;
				
				if(i == len-1){
					if(div.scrollHeight > div.offsetHeight){
						var y = 0;
						do{
							var tempStr1 = inspectScrollerDescriptionAndDivide(tableBody,div);
							trimmer(div,poMain);
							poMain.innerHTML += footer();
							createNewPage(poMain,div,office,supplier,prNumber,tn,tempStr1,quart,category,categoryName,subTotal);
							var c = poMain.children.length;
							var div = poMain.children[c-1];
							var table = div.children[0];
							var tableBody = div.children[0].children[0];
							y++;
						}while(div.scrollHeight  > div.offsetHeight);
						
						// if mulapas pag butang sa total then increase div decrease certificate

						 inspectScrollerLast(div,poMain,"","");
					}else{
						 trimmer(div,poMain);
						// if mulapas pag butang sa total then increase div decrease certificate
						 inspectScrollerLast(div,poMain,"","");
					}
				}
			}
			
		}
		
		var cer =document.getElementsByClassName("pagesPO");
		for(var i = 0 ; i < cer.length ; i++){
			cer[i].innerHTML = "Page " +(i+1) + " of " + cer.length;
		}

		itemNum = num;
		getInvDetails();
	}
	//New Function
	var globRow;
	function getPoItem(porecord, row){
		var queryString = "?getPoItem=1&item="+porecord;
		var container = document.getElementById('updateAirForm');

		var airContainer = document.getElementById('updateAirForm');
		var airTxtArea = document.getElementById('AIRDesc');
		var hiddenAir = document.getElementById('AIRItem');

		hiddenAir.value = porecord;
		airTxtArea.innerHTML = row.children[2].innerHTML;
		globRow = row.children[2];
		closeUpdateAir();
		ajaxGetAndConcatenate(queryString, processorLink, container, 'getPoItem');
	}
	function updateAir(){
		var airContainer = document.getElementById('updateAirForm');
		var airTxtArea = document.getElementById('AIRDesc');
		var airTxtArea1 = document.getElementById('AIRDesc1');
		var hiddenAir = document.getElementById('airItmNum');
		var row = document.getElementById('rowNum'+hiddenAir.value);
		var formData = new FormData();

		if (airTxtArea.innerHTML.replace(/\s/g,'') != "" && airTxtArea1.value.replace(/\s/g,'') != "") {
			var rowCode = row.children[2].id.split('desc');
			formData.append("updateAirItem", 1);
			formData.append("AirId", rowCode[1]);
			formData.append("oldDesc", airTxtArea.innerHTML);
			formData.append("newDesc", airTxtArea1.value);
			document.getElementById('editorX').click();
			loader();
			ajaxFormUpload(formData, processorLink, 'updateAirItem');
		} else {
			alert("Please fill up missing fields.");
		}
	}
	function closeUpdateAir(){
		var airContainer = document.getElementById('updateAirForm');

		if (airContainer.style.display == 'none') {
			airContainer.style.display = '';
		} else {
			airContainer.style.display = 'none';
		}
	}
	function trimmer(div,poMain){
		
		if(div.scrollHeight >= div.offsetHeight){
			
			div.style.height = (div.offsetHeight + 34)+ "px";                             
			var  x =  poMain.children.length;
			var cert = poMain.children[x-1];
			cert.style.height =(cert.offsetHeight - 34) + "px";
		}
	}
	function  inspectScrollerLast(div,poMain,head,headDesignation){
		
		if(div.scrollHeight > div.offsetHeight){
			
			div.style.height = (div.offsetHeight + 34)+ "px";                             
			var  x =  poMain.children.length;
			var cert = poMain.children[x-1];
			cert.style.height =(cert.offsetHeight - 34) + "px";
		}else{
			
			trimmer(div,poMain);
		}
		poMain.innerHTML += footer();
	}
	function inspectScrollerDescriptionAndDivide(tableBody,div){
		trimmer(div,poMain);
		var cLen = (tableBody.children.length - 1);
		var lastChild = tableBody.children[cLen];
		
		var desc = lastChild.children[2].textContent.trim();

		var newLine = desc.split("\n");
		var lenLine = newLine.length-1;
		var td = lastChild.children[2];

		td.innerHTML = "";
		var tempStr = '';
		var tempStr1 = '';
		var mark ;
		for(var a = 0; a <= lenLine; a++){
			td.innerHTML += newLine[a] + "\n";
			if(div.scrollHeight > div.offsetHeight){		
				tempStr1 += newLine[a] + "\n";
			}else{
				tempStr += newLine[a] + "\n";
				mark = a;
			}
		}
		td.textContent =   tempStr;
		
		// tableBody.innerHTML += '<tr><td class="randomBlank" colspan = "7" style = ""></td></tr>';
	
		return  tempStr1;
	}
	function createNewPage(poMain,div,office,supplier,prNumber,tn,tempStr1,quart,category,categoryName,subTotal){
		poMain.innerHTML +=  '<div class = "divContent" style="border-bottom: 0;"><table class = "tableContent">' + header(office,supplier,prNumber,tn) +  '<tr><td class = "tdHeader">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Description</td><td class = "tdHeader" style="border-right: 0px;">Qty</td></tr>'  +  quarter(quart,category,categoryName) + halfText(tempStr1)  +'</table></div>';
		var c = poMain.children.length;
		var div = poMain.children[c-1];
		var table = div.children[0];
		var tableBody = div.children[0].children[0];
	}
	function  header(office,supplier,prNumber,tn){
		var sheet = '<tr><td colspan = "6">';
		      sheet += '	<div>';
		      	sheet += '<table border="0" style="border-spacing:0;margin:0 auto;width:100%;" >';
			sheet += '			<tr>';
			sheet += '				<td valign="top" colspan="4" style = "border-bottom: 2px solid black;">';
			sheet += '					  <table border="0" style="margin: 0px auto; width: 100%; text-align: center;">'
										+'	<tr>'
										+'		<td style="padding-left: 50px;"><img src="../images/davaologo.png" style="width: 90px;"></td>'
										+'		<td>'
										+'			<div style = "font-size:20px;font-weight:bold;">ACCEPTANCE & INSPECTION REPORT</div>'
										+'			<div style = "">City Government of Davao</div>'
										+'			<div style = "letter-spacing:2px;">LGU</div>'
										+'		</td>'
										+'		<td valign="bottom" style="text-align: right;">'
										+'			TN : <span style = "font-weight:bold;font-size:21px;font-family:impact;letter-spacing:1px;">' + tn  + '</span>'
										+'			<div class="revevCont">DocTrack 2021</div>'
										+'		</td>'
										+'	</tr>'
										+'</table>'
			sheet += '				</td>';
			sheet += '			</tr>';
			sheet += '			<tr>';
			sheet += '				<td style = "border-bottom: 2px solid black;" colspan="2">';

			sheet +=					'<table border="0" style="font-size: 13px; width: 100%; padding: 10px 0px;">';
			sheet +=						'<tr>'
			sheet +=							'<td>Supplier</td>'
			sheet +=							'<td colspan="8">'
			sheet +=								'<input disabled style="border: 0px; border-bottom: 1px solid black; width: 100%; font-weight: bold;" value="'+supplier+'"></td>'
			sheet +=							'</td>'
			sheet +=						'</tr>'
			sheet +=						'<tr>'
			sheet +=							'<td valign="bottom" style="padding-top: 10px;">PO No.</td>'
			sheet +=							'<td valign="bottom">'
			sheet +=								'<input style="font-weight: bold; border: 0px; border-bottom: 1px solid black; width: 170px; padding-left: 3px; " value="'+prNumber+'">'
			sheet +=							'</td>'
			sheet +=							'<td valign="bottom"><div style="width: 10px;"></div></td>'
			sheet +=							'<td valign="bottom" class="invoiceTitle">Invoice No.</td>'
			sheet +=							'<td valign="bottom">'
			sheet +=								'<input name="disInvNo" style="padding-left: 3px; border: 0px; border-bottom: 1px solid black; width: 200px;">'
			sheet +=							'</td>'
			sheet +=							'<td valign="bottom"></td>'
			sheet +=							'<td valign="bottom">AR No.</td>'
			sheet +=							'<td valign="bottom">'
			sheet +=								'<input name="disAirNo" style="border: 0px; border-bottom: 1px solid black; width: 170px;">'
			sheet +=							'</td>'
			sheet +=						'</tr>'
			sheet +=						'<tr>'
			sheet +=							'<td>Date</td>'
			sheet +=							'<td><input name="poDate" style="padding-left: 3px; border: 0px; border-bottom: 1px solid black; width: 170px;" value="'+invPoDate+'"></td>'
			sheet +=							'<td></td>'
			sheet +=							'<td>Date</td>'
			sheet +=							'<td><input name="disInvDate" style="padding-left: 3px; border: 0px; border-bottom: 1px solid black; width: 200px;"></td>'
			sheet +=							'<td valign="bottom"><div style="width: 10px;"></div></td>'
			sheet +=							'<td></td>'
			sheet +=							'<td></td>'
			sheet +=						'</tr>'
			sheet +=					'</table>';
			sheet += '				</td>';
			sheet += '			</tr>';
			
			sheet += '			<tr>';
			sheet += '				<td style="padding-left: 5px; font-size: 13px; width: 190px;">Requisitioning Office/Department : </td>'
			sheet += '				<td style="font-size:13px;" colspan = "6">'+office+'</td>';
			sheet += '			</tr>';
			
			
			sheet += '		</table>';
			      	
	        sheet += ' </div>';
	        sheet += '</td></tr>';

		return sheet;
	}
	function quarter(quart,category,categoryName){
		var  sheet = '<tr>';
		      sheet += '<td class = "tdData1"></td>';
		      sheet += '<td class = "tdData1"></td>';
		      sheet += '<td class = "tdData1" style = "text-align:center;font-weight:bold;padding:8px 0px;font-size:14px;">' + category + ' - ' + categoryName  + '</td>';
		      // sheet += '<td class = "tdData" style = "text-align:center;font-weight:bold;padding:8px 0px;font-size:14px;">' + quart  +'<br/>' + category + ' - ' + categoryName  + '</td>';
		      sheet += '<td class = "tdData1" style="border-right: 0px;"></td>';
		      sheet += '</tr>';

		return sheet;
	}
	function forwarded(subtotal){
		var  sheet = '<tr>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "text-align:center;">Balance Forwarded</td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "border-right:0;text-align:right;font-weight:bold;">'  + numberWithCommas(subtotal.toFixed(2))  + '</td>';
		      
		      sheet += '</tr>';
		return sheet;
	}
	function totalA(label,total){
		
		if(label == 1){
			label = "Subtotal";
			var   sheet = '<table style = "width: 100%;" border = "0" >';
			sheet += '	<tr >';
			
			sheet += '	<td colspan = "2" style = "width:100px;padding-right:5px;text-align:right;font-weight:bold;"><span style = "padding-right:20px;">' + label + '</span>' + numberWithCommas(total.toFixed(2)) + '</td>';
			sheet += '</tr>	';
			sheet += '</table>';
		}else{
			label = "Total";
			var   sheet = '<table style = "width: 100%;" border = "0" >';
			sheet += '	<tr >';
			sheet += '	<td style = "font-size:12px;padding-left:5px;">' + convertWordCurrency(total.toFixed(2)) + ' ONLY' + '</td>'
			sheet += '	<td style = "width:100px;padding-right:5px;text-align:right;font-weight:bold;"><span style = "padding-right:20px;">' + label + '</span>' + numberWithCommas(total.toFixed(2)) + '</td>';
			sheet += '</tr>	';
			sheet += '</table>';
		}
		
		
		return sheet;
	}
	function certifiedBy(head,headDesignation){
		var   sheet = '<div class = "certifiedDiv" ><table style = "width: 100%;" >';
			sheet += '	<tr >';
			sheet += '	<td style = "text-align:right;padding-right:160px;font-size:12px; font-weight:bold;vertical-align:bottom;"><div  style = "text-align:left" class = "pagesPO"></div></td>';
			sheet += '	<td style = "width:245px;padding-right:20px;verical-align:top;">';
			
			sheet += '		<table style ="width:100%;" class = "tableSig" >';
			sheet += '			<tr>';
			sheet += '			<td>Certified Correct</td>';
			sheet += '			</tr>';
			sheet += '			<tr>';
			sheet += '				<td style ="text-align:center;height:65px;vertical-align:bottom;"><input value = "'+ head + '" style = "font-size:12px;border:0px solid white;border-bottom:1px solid black;width:100%;text-align:center;font-weight:bold;" placeholder = "Type Name"/><input placeholder = "Type Position" value = "'+ headDesignation + '"   style = "font-size:12px;border:0;width:100%;text-align:center;"/></td></td>';
			sheet += '			</tr>';
			sheet += '		</table>';
		
			sheet += '	</td>';
			sheet += '</tr>	';
			sheet += '</table></div>';
		return sheet;
	}
	function totalWords(num){
		var   sheet = '<div class = "totalWordsDiv"><table style = "width: 100%;height:100%;">';
			sheet += '	<tr >';
			sheet += '	<td style = "width:170px;vertical-align:top;">Total amount in words : </td>';
			sheet += '	<td style = "vertical-align:top;font-size:14px;">' + convertWordCurrency(num) + ' ONLY' +  '</td>';
			sheet += '</tr>	';
			sheet += '</table></div>';
		return sheet;
	}
	function halfText(text){
		var  sheet = '<tr>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "white-space: pre-line; word-wrap: break-word;">' + text  +'</td>';
		      sheet += '<td class = "tdData" style="border-right: 0px;"></td>';
		      sheet += '</tr>';
		return sheet;
	}
	function footer(officeC){
		var sheet 	="<div class='footerDiv'>"
					+"<table border='0' style='margin: 0px auto; width: 100%; border-spacing: 0px; height: 100%;'>"
					+"<tr>"
					+"<td colspan='2'>"
					+"<div class='pagesPO' style='font-size: 12px; text-align: center; font-weight: bold;'></div>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: center; font-weight: bold; border: 1px solid black; border-bottom: 2px solid black; border-top: 2px solid black; border-left: 0px; height: 20px;'>ACCEPTANCE</td>"
					+"<td style='text-align: center; font-weight: bold; border: 1px solid black; border-bottom: 2px solid black; border-top: 2px solid black; border-left: 0px; height: 20px; border-right: 0px;'>INSPECTION</td>"
					+"</tr>"
					+"<tr>"
					+"<td valign='top' style='padding-top: 10px; border: 1px solid black; border-bottom: 0px; border-left: 0px; border-top: 0;'>"
					+"<table border='0' style='margin: 0px auto; width: 100%;'>"
					+"<tr>"
					+"<td style='text-align: right; width: 100px;'>Date Received</td>"
					+"<td colspan='3'><input style='border: 0px; border-bottom: 1px solid black; width: 250px; text-align: center;' name='disAccDateReceived'></td>"
					+"</tr>"
					+"<tr><td><div style='height: 20px;'></div></td></tr>"
					+"<tr>"
					+"<td style='text-align: right;'>"
					+"<input class='regular-checkbox big-checkbox' type='checkbox' onclick='checkAll(1)' name='compCheck'>"
					+"</td>"
					+"<td>"
					+"<label for='compCheck' style='margin-top: 10px; display: inline-block;'>Complete</label>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right;'>"
					+"<input class='regular-checkbox big-checkbox' type='checkbox' onclick='checkAll(2)' name='partCheck'>"
					+"</td>"
					+"<td>"
					+"<label for='partCheck' style='margin-top: 10px; display: inline-block;'>Partial</label>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td colspan='4' style='text-align: center; height: 82px;'>"
					+"<div><input name='disAccName' style='text-transform: uppercase; border: 0px; border-bottom: 1px solid black; width: 80%; text-align: center; font-size: 14px; font-weight: bold;' placeholder='Type in Name'></div>"
					+"<div><input name='disAccPos' style='border: 0px; width: 80%; text-align: center; font-size: 12px;' value='PSO Designate' placeholder='Type in position'></div>"
					+"</td>"
					+"</tr>"
					+"</table>"
					+"</td>"
					+"<td valign='top' style='padding-top: 10px;'>"
					+"<table border='0' style='margin: 0px auto; width: 100%;'>"
					+"<tr>"
					+"<td style='text-align: right; width: 100px;'>Date Inspected</td>"
					+"<td><input style='border: 0px; border-bottom: 1px solid black; width: 250px;'></td>"
					+"</tr>"
					+"<tr>"
					+"<td colspan='2' style='height: 100px;'>"
					+"<ul style='list-style-type: none;'>"
					+"<li>"
					+"<input class='regular-checkbox big-checkbox' type='checkbox' name='inspCheck'>"
					+"<label for='inspCheck' style='width: 250px; display: inline-block; padding-left: 5px;'>"
					+"Inspected, verified and found OK as to quantity and specification"
					+"</label>"
					+"</li>"
					+"</ul>"	
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td colspan='2' style='text-align: center; height: 82px;'>"
					+"<div><input name='disInsName' style='text-transform: uppercase; border: 0px; border-bottom: 1px solid black; width: 80%; text-align: center; font-size: 14px; font-weight: bold;' placeholder=''></div>"
					+"<div><input style='border: 0px; width: 80%; text-align: center; font-size: 12px;' value='Inspection Officer/Committee' disabled='disabled' placeholder='Type in position'></div>"
					+"</td>"
					+"</tr>"
					+"</table>"
					+"</td>"
					+"</tr>"
					+"</table>"
					+"</div>";

		return sheet;
	}
	function checkAll(type){
		var rtype = "";
		if (type == 1) {
			rtype = 'partCheck';
			ctype = "compCheck";
		} else if (type == 2) {
			rtype = 'compCheck';
			ctype = "partCheck";
		}else{
			 ctype = 'compCheck';
			 rtype = "partCheck";
		}

		if (type != "") {
			var boxes = document.getElementsByName(ctype);
			var rboxes = document.getElementsByName(rtype);
		
			for (var i = 0; i < boxes.length; i++) {
				boxes[i].checked = true;
				rboxes[i].checked = false;
			}	
		}
	}
	function checkEditorSet(type){
		var editorChk = document.getElementsByName('accChk');
		for(var i=0; i<editorChk.length; i++){
			if(editorChk[i].value == type){
				editorChk[i].checked = true;
			} else {
				editorChk[i].checked = false;
			}
		}
	}
	window.ondblclick = function() {
		show();
	}
	function show(){
		if(!document.getElementById('editorContainer')){
	    	editorSet();	
		}
	}
	var invTitle = "Invoice no.";
	var invAccPos = "PSO Designate";
	var invInsBy = "";
	var invPoDate = "";
	function set(){
		// Function for removing unnecessary spaces .replace(/\s/g,'')
		var formAirINV = document.getElementById('FormAirINV').value;
		var formAirDate = document.getElementById('FormAirDate').value;
		var formAirRecBy = document.getElementById('FormAirRecBy').value;
		var formAirPOR = document.getElementById('FormAirPOR').value;
		var formAirDateRec = document.getElementById('FormAirDateRec').value;
		var formAirInsBy = document.getElementById('FormAirInsBy').value;
		var formAirInvTit = document.getElementById('FormAirInvTit').value;
		var formAirPoDate = document.getElementById('FormAirPoDate').value;

		var setINV = document.getElementsByName('disInvNo');
		var setInvDate = document.getElementsByName('disInvDate');
		var setRectBy = document.getElementsByName('disAccName');
		var setRecPos = document.getElementsByName('disAccPos');
		var setRecDate = document.getElementsByName('disAccDateReceived');
		var setInsBy = document.getElementsByName('disInsName');
		var invoiceTitle = document.getElementsByClassName('invoiceTitle');
		var poDate = document.getElementsByName('poDate');
		
		var accChk = document.getElementsByName('accChk');
		// var accVal;
		[].forEach.call(accChk, function(el){
			if(el.checked){
				invAcc = el.value;
				// accVal = el.value;
			}
		});

		for (var i = 0; i < setINV.length; i++) {
			setINV[i].value = formAirINV;
			setInvDate[i].value = formAirDate;
			setRectBy[i].value = formAirRecBy;
			setRecPos[i].value = formAirPOR;
			setInsBy[i].value = formAirInsBy;
			setRecDate[i].value = formAirDateRec;
			invoiceTitle[i].innerHTML = formAirInvTit;
			poDate[i].value = formAirPoDate;
		}

		document.getElementById('editorX').click();

		invTitle = formAirInvTit;
		invNo = formAirINV;
		invDate = formAirDate;
		invAccPos = formAirPOR;
		invInsBy = formAirInsBy;
		invRecBy = formAirRecBy;
		invPoDate = formAirPoDate;
		invAccDate = formAirDateRec;
		
		checkAll(invAcc);

		if (invAcc == "") {
			invAcc = 0;
		}

		var  tn = "<?php  echo $tn ?>";
		var queryString = "setInvoiceDetails=1&tn="+tn+"&invs="+formAirINV+"&invsdate="+formAirDate+"&receivedBy="+formAirRecBy+"&acceptance="+invAcc+"&poDate="+invPoDate+"&dateReceived="+invAccDate;
		var container = "";

		ajaxPost(queryString, processorLink, container, 'setInvoiceDetails');
	}
	function editorSet(){
		
		var sheet = "";

		sheet += "<div id='editorContainer' class='editorContainer' style='border: 0px; min-height: 620px;'>" 
				+"<table border='0' style='padding: 0px; border-spacing: 0px;'>"
				
				+"<tr>"
				+"<td>"
				+"<div style='display: inline-block;'>"
				+"	<table border='0' style='border-spacing: 0px; padding: 0px;'>"
				+"		<tr>"
				+"			<td style='padding: 0px;'><span id='col0' class='floatingTab slctBtn' onclick='changeCol(this)'>AIR Entries</span></td>"
				+"			<td style='padding: 0px;'><span id='col1' class='floatingTab' onclick='changeCol(this)'>Replacements</span></td>"
				+"			<td style='padding: 0px;'><span id='col2' class='floatingTab' onclick='changeCol(this)'>Attachments</span></td>"
				+"		</tr>"
				+"	</table>"
				+"</div>"
				+"<span id='editorX' class='floatingTab1' style='float: right;' onclick='closeAbsolute(this)'>&#10006;</span>"
				+"</td>"
				+"</tr>"

				+"<tr>"
				+"<td valign='top' style=''>"
					+"<table border='0' style='padding: 10px; background-color: white;'>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px; padding-bottom: 6px;' valign='bottom'>"
					+"Label"
					+"</td>"
					+"<td>"
					+"<input class='text3' style='text-align:left; margin-top: 20px;' id='FormAirInvTit' value='"+invTitle+"'>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px; padding-bottom: 6px;' valign='bottom'>"
					+"Invoice No."
					+"</td>"
					+"<td>"
					+"<input class='text3' style='margin-top: 5px; text-align:left;' id='FormAirINV' value='"+invNo+"'>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px; padding-bottom: 6px;' valign='bottom'>"
					+"Invoice Date"
					+"</td>"
					+"<td>"
					+"<input class='text3' style='margin-top: 5px; text-align:left;' id='FormAirDate' value='"+invDate+"'>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px; padding-bottom: 6px;' valign='bottom'>"
					+"PO Date"
					+"</td>"
					+"<td>"
					+"<input class='text3' style='margin-top: 5px; text-align:left;' id='FormAirPoDate' value='"+invPoDate+"'>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px;' valign='middle'>"
					+"Acceptance"
					+"</td>"
					+"<td>"
					+"<table>"
					+"<tr>"
					+"<td style='text-align: right;'>"
					+"<input name='accChk' value='1' class='regular-checkbox big-checkbox' type='checkbox' onclick='checkEditorSet(1)'>"
					+"</td>"
					+"<td>"
					+"<label for='compCheck' style='margin-top: 10px; display: inline-block;'>Complete</label>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right;'>"
					+"<input name='accChk' value='2' class='regular-checkbox big-checkbox' type='checkbox' onclick='checkEditorSet(2)'>"
					+"</td>"
					+"<td>"
					+"<label for='partCheck' style='margin-top: 10px; display: inline-block;'>Partial</label>"
					+"</td>"
					+"</tr>"
					+"</table>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px; padding-bottom: 6px;' valign='bottom'>"
					+"Received by"
					+"</td>"
					+"<td>"
					+"<input class='text3' style='margin-top: 20px; text-align:left; background-color: rgb(216, 224, 228);' id='FormAirRecBy' value='"+invRecBy+"'>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px; padding-bottom: 6px;' valign='bottom'>"
					+"Title"
					+"</td>"
					+"<td>"
					+"<input class='text3' style='margin-top: -2px; text-align:left; background-color: rgb(216, 224, 228);' id='FormAirPOR' value='"+invAccPos+"'>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px; padding-bottom: 6px;' valign='bottom'>"
					+"Date"
					+"</td>"
					+"<td>"
					+"<input class='text3' style='margin-top: -2px; text-align:left; background-color: rgb(216, 224, 228);' id='FormAirDateRec' value='"+invAccDate+"'>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px; padding-bottom: 6px;' valign='bottom'>"
					+"Inspected by"
					+"</td>"
					+"<td>"
					+"<input class='text3' style='margin-top: 5px; text-align:left; background-color: rgb(216, 224, 228);' id='FormAirInsBy' value='"+invInsBy+"'>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td>"
					+"</td>"
					+"<td style='padding-top: 10px; padding-bottom: 20px; text-align: center;'>"
					+"<span class='setBtn' onclick='set()'>Set</span>"
					+"</td>"
					+"</tr>"
					+"</table>"

					+"<table border='0' style='display: none; padding: 10px; background-color: white;'>"
					+"<tr>"
					+"<td colspan='2' style=' padding-top: 20px; padding-bottom: 5px; border-bottom: 1px solid silver;' valign='bottom'>"
					+"<input class='FormAirItmNum' onkeyup='getAirItemDetails(event)' id='airItmNum'><span style='float: right; padding: 0px 5px;'>Item No.</span>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<tr>"
					+"<td style='padding-left: 5px;' class='' colspan='2'>"
					+"Description"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='' colspan='2'>"
					+"<div style='overflow-y: auto; max-height: 250px; max-width: 434px; min-width: 434px; padding: 2px; margin-bottom: 10px;'>"
					+"<div id='AIRDesc' class='oldArDesc' style='max-width: 385px; min-width: 350px; font-weight: bold; padding-left: 30px; padding-top: 10px;'>"
					+"</div>"
					+"</div>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='padding-left: 5px;' class='' colspan='2'>"
					+"Replacement"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='' colspan='2'>"
					+"<textarea id='AIRDesc1' class='newArDesc' placeholder='Type here' style='width: 434px; padding-left: 30px; padding-top: 10px;'></textarea>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style=' text-align: center; padding-top: 5px; padding-bottom: 20px;' colspan='2'>"
					+"<span class='setBtn' onclick='updateAir()'>Update</span>"
					+"</td>"
					+"</tr>"
					+"</table>"

					+"<table border='0' style='display: none; padding: 10px; background-color: white;'>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px; padding-bottom: 6px;' valign='bottom'>"
					+"Classification"
					+"</td>"
					+"<td style='padding-top: 20px;' valign='bottom'>"
					+"<select id='arUploadType' class='text3' style='width: 337px; text-align: left; border: 0px; border-left: 1px solid silver; border-top: 1px solid silver;'>"
					+arUploadTypes
					+"</select>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td style='text-align: right; padding-right: 10px;' valign='bottom'>"
					// +"Choose image"
					+"</td>"
					+"<td>"
					+"<label class='text3' style='margin-top: 5px; display: inline-block; width: 325px;' for='resoFile' id='resoFileLabel'>Choose image</label>"
					+"<input class='text3' type='file' style='display: none; text-align:left; margin-top: 5px;' id='resoFile' onchange='updateFileLabel(\"resoFileLabel\");'>"
					+"</td>"
					+"</tr>"
					+"<tr>"
					+"<td>"
					+"</td>"
					+"<td style='padding-top: 10px; padding-bottom: 20px; text-align: center;'>"
					+"<span class='setBtn' onclick='uploadFile()'>Upload</span>"
					+"</td>"
					+"</tr>"
					+"</table>"

				+"</td>"
				
				+"</tr>"
				+"</table>"
				+"</div>"
				;

		theAbsolute(sheet);
		checkEditorSet(invAcc);
	}
	function getAirItemDetails(event){
		if (event.keyCode == 13) {
			var airItmNum = document.getElementById('airItmNum');
			// var row = document.getElementById('rowNum'+airItmNum.value);

			var divContents = document.getElementsByClassName('divContent');

			var desc = "";
			var breakFlag = false;
			var contFlag = false;
			for (var x=0; x < divContents.length; x++) {
				for (var i=0; i < divContents[x].children[0].children[0].children.length; i++) {
					var row = divContents[x].children[0].children[0].children[i];
					if (row.children[0].classList.contains('tdData')) {
						if (row.children[0].innerText == airItmNum.value) {
							desc += row.children[2].textContent.trim();
							contFlag = true;
						} else if (contFlag == true) {
							if (row.children[0].innerText == "") {
								desc += row.children[2].textContent.trim();
							} else {
								breakFlag = true;
								break;
							}
						}
					}
				}
				if (breakFlag == true) {
					break;
				}
			}
			var oldDesc = document.getElementById('AIRDesc');
			var newDesc = document.getElementById('AIRDesc1');
			newDesc.innerHTML = "";
			var disDesc = desc.split("\nReplacement:\n");


			if (disDesc.length > 1) {
				oldDesc.innerHTML = disDesc[0];
				newDesc.innerHTML = disDesc[1];
			} else {
				if (disDesc[0] != "") {
					oldDesc.innerHTML = disDesc[0];
				} else {
					oldDesc.innerHTML = "";
					alert("Item number not found.");
				}
			}
		}
	}
	function showReplacements(btn){
		var rows = btn.parentElement.parentElement.parentElement.children;

		if (rows[9].children[0].children[0].style.display == "") {
			rows[9].children[0].children[0].style.display = "none";
		} else {
			rows[9].children[0].children[0].style.display = "";
		}

	}
	function uploadFile(type){
		var file = document.getElementById('resoFile').files;
		
		if(file.length > 0){
				
			var allowedExtensions = ['jpeg', 'jpg', 'png','pdf'];
			var fileType = false;
			allowedExtensions.forEach(function(type){
				if (file[0].type.match('image/'+type)) {
					fileType = true;
				}else if(file[0].type.match('application/'+type)){
					fileType = true;
				}
			});

			if (fileType == true) {
				var subject = document.getElementById('arUploadType');
				var tn = "<?= $tn ?>";

				var formData = new FormData();

				formData.append('uploadARFile', 1);
				formData.append('trackingNumber', tn);
				formData.append('subject', subject.value);
				formData.append('arFile', file[0]);

				document.getElementById('editorX').click();

				ajaxFormUpload(formData, processorLink, 'uploadARFile');
			} else {
				alert('Please make sure that the file is an image.');
			}
		} else {
			alert('Please choose a file.');
		}
	}
	function changeCol(btn){
		var tdNum = btn.id.split('col')[1];
		var mainCont = btn.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
		var viewCont = mainCont.children[1].children[0].children;

		var btns = btn.parentElement.parentElement.children;

		[].forEach.call(btns, function(spans){
			if (spans.children[0].id != "") {
				spans.children[0].classList.remove('slctBtn');
			}
		});

		btn.classList.add('slctBtn');

		[].forEach.call(viewCont, function(td){
			td.style.display = "none";
		});

		viewCont[tdNum].style.display = "";
	}
	function updateFileLabel(el){
		var elCont = document.getElementById(el);
		var input = document.getElementById('resoFile');
		var filename;

		if (input.files.length > 0) {
			filename = "File: "+input.files[0].name;
		} else {
			filename = "Choose image";
		}

		elCont.innerHTML = filename;
	}
</script>
