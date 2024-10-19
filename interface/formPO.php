<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	
	require_once('../javascript/ajaxFunction.php');
	$tn = $_GET['tn'];

	if(isset($_COOKIE['RequestedBy'])){
		$head = $_COOKIE['RequestedBy'];
		$headDesignation = $_COOKIE['RequestedDesignation'];
		
	}else{
		$head = '';
		$headDesignation = '';
	}

	if(isset($_COOKIE['poDefFontSize'])){
		$defFontSize = $_COOKIE['poDefFontSize'].'px';
	}else{
		$defFontSize = '14px';
	}
?>
<style>
	@font-face {
		font-family: "Oswald";
		src: url("../fonts/Oswald-ExtraLight.ttf");
	}

	body {
		margin:0px;
	}
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
		/* color:white;
		padding:2px 5px;
		padding:10px;
		letter-spacing:1px;
		background-color:rgb(8, 149, 196);
		//background-color:rgb(23, 207, 253);
		text-shadow:0px 0px 2px orange; */

		color:white;
		padding:2px 5px;
		padding:5px;
		letter-spacing:1px;
		text-shadow:0px 0px 2px orange;
		background-color:rgb(54, 102, 139);
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
		height:15px;
		width:15px;
		border-radius:50%;
		float:right;
	}
	.closeEditor:hover{
		cursor:pointer;
		background-color:rgb(250, 98, 116);
	}
	
	.divContent{
		/* height:810px; */
		/* height:750px; */
		height:700px;
		width: 750px;
		overflow: auto;
		margin:0 auto;
		border:2px solid black;
		border-bottom:0;
		
	}
	.tableContent{
		width:100%;
		border-spacing:0;
		border:0px solid red;
	}
	.subTotalDiv{
		//border:1px solid silver;
		border-top:1px solid black;
		border-bottom:1px solid black;
		
	}
	.certifiedDiv{
		/* height:80px; */
		height:190px;
		width: 754px;
		margin:0 auto;
		border:2px solid black;
	
		border-top: 0px;
		/* border:1px solid red;	 */
	}
	.footerDiv{
		height:270px;
		width: 750px;margin:0 auto;
		border:2px solid black;
		
		border-top: 0px;
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
		font-size:14px;
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
		/* font-family: mainFont;
		padding:5px 5px;
		width:150px;
		font-weight:bold;
		font-size: 14px;
		border-top:1px solid silver;
		border-left:1px solid silver;
		background-color:rgba(6, 44, 66,.05); */

		width: 250px;
		border: 0px;
		box-shadow: none;
		font-family: Oswald;
		font-size: 12px;
		letter-spacing: 1px;
		font-weight: bold;
		border-bottom: 1px solid gray;
		background-color:rgba(6, 44, 66,.05);
		padding:3px 5px;
	}

	.btnToggleFontSize {
		font-family:Tahoma;
		font-weight:bold;
		font-size:14px;
		width:26px;
		height:20px;
		line-height:12px;
		text-align:center;
		border-radius:0px;
		margin-left:5px;
		border:2px solid silver;
		border-right:2px solid gray;
		border-bottom:2px solid gray;
		cursor:pointer;
		transition:.1s ease-in;
	}

	.btnToggleFontSize:hover {
		background-color:silver;
	}
</style>
<link rel="icon" href="/citydoc2017/images/print.png"/> 
<title>PO Form</title>
<div id  = "poMain" style = "">
	<div  class = "divContent" style = "border-bottom:2px solid black;">
		<table class = "tableContent">
			<tr id  = "trFirst">
				<td colspan="6"></td>
			</tr>	
			<tr>
				<td class = "tdHeader" style  ="width:10px;padding:0px 5px;">No.</td>
				<td class = "tdHeader"  style  ="width:10px;padding:0px 5px;">Unit</td>
				<td class = "tdHeader"  style  ="width:10px;padding:0px 5px;">Qty</td>
				<td class = "tdHeader">Description</td>
				<td class = "tdHeader" style  ="width:90px;padding:0px 5px;">Unit&nbsp;Cost</td>
				<td class = "tdHeader"  style  ="width:100px;padding:0px 5px;border-right:0;">Amount</td>
			</tr>
			<tr id  = "trThird">
				<td colspan="6"></td>
			</tr>	
		</table>
		
	</div>
	
</div>

<script>
	var head = "<?php echo $head; ?>";
	var headDesignation = "<?php echo $headDesignation; ?>";
	var ofis; 

	var defFontSize = "<?php echo $defFontSize; ?>";

	viewPO();
	function viewPO(){
		var  tn = "<?php  echo $tn ?>";
		
		var container = document.getElementById("poMain");
		var queryString = "?fetchPODetails&tn=" +  tn ;

		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchPODetails");			
	}
	function createSheet(details){
		var txt = '';
		var j = JSON.parse(details);
		var len =  j.desc.length;
		var tn =  j.trackingNumber;
		
		var office =  j.office;
		ofis = office;
		var officeC =  j.officeCode;
		var supplier =  j.supplier;
		
		var prNumber =  j.prNumber;
		
		var category =  j.catCode;
		var categoryName =  j.catName;
		var quart =  j.qua;

		var terms =  j.terms;

		var pyTerm =  j.paymentTerm;
		var mdOfProc =  j.modeOfProc;

		document.getElementById("trFirst").innerHTML = header(office,supplier,prNumber,tn,pyTerm,mdOfProc);
		document.getElementById("trThird").innerHTML = quarter(quart,category,categoryName);
		var c = poMain.children.length;	
		
		var div = poMain.children[c-1];
		div.style.borderBottom = "0";
		var table = div.children[0];
		var tableBody = div.children[0].children[0];
		
		var on = 0;
		var subTotal = 0;
		
		var itemRow = 0
		
		for(var i = 0; i < len; i++){
			if(div.scrollHeight > div.offsetHeight){
						
						var cLen = (tableBody.children.length - 1);
						var lastChild = tableBody.children[cLen];
						
						div.scrollTop = 10000;
						var desc = lastChild.children[3].textContent.trim();
						
						var newLine = desc.split("\n");
						var lenLine = newLine.length-1;
						
						if (lenLine > 2){
							var td = lastChild.children[3];
							lastChild.children[0].style.borderBottom = "1px solid black";
							lastChild.children[1].style.borderBottom = "1px solid black";
							lastChild.children[2].style.borderBottom = "1px solid black";
							lastChild.children[3].style.borderBottom = "1px solid black";
							lastChild.children[4].style.borderBottom = "1px solid black";
							lastChild.children[5].style.borderBottom = "1px solid black";
							
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
							
							td.textContent = tempStr;
							 trimmer(div,poMain);
							//div.style.borderBottom = "1px solid black";
							i  = i -1;
						}else{
							 trimmer(div,poMain);
							tableBody.removeChild(lastChild); 
							var lastAmount = lastChild.children[5].textContent.replace(/,/g,"");; 
							subTotal = subTotal - lastAmount;
							tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:0px solid black;">' +  totalA(1,subTotal) + '<td></tr>';
							tempStr1 = '';
							i  = i -2;
						}
						inspectScrollerLast(div,poMain,head,headDesignation);
						poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn,pyTerm,mdOfProc) +  '<tr><td class = "tdHeader">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit Cost</td><td class = "tdHeader" style = "border-right:0;">Amount</td></tr>'  + quarter(quart,category,categoryName)  + forwarded(subTotal) + halfText(tempStr1) +'</table></div>';
						
						if(i == len-1){
							
							var c = poMain.children.length;
							var div = poMain.children[c-1];
							var table = div.children[0];
							var tableBody = div.children[0].children[0];
							tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
							// if mulapas pag butang sa total then increase div decrease certificate
							 inspectScrollerLast(div,poMain,head,headDesignation);
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

				if(j.poId[i] == 0) {
					itemRow = 0;
				}else {
					itemRow = i;
					if(j.poId[0] != 0) {
						itemRow = num;
					}
				}

				if(i == len-1){
					// if(terms.length > 0) {
					if(terms != null && terms.length > 0) {
						// desc += '\n\nTERMS AND CONDITIONS\n'+terms;
						desc += '\n\n'+terms;
					}
				}

				var descX = desc.match(/\n/g);
				var descX = desc.split("\n");
			
			 	tableBody.innerHTML +="<tr><td style = 'font-size:"+defFontSize+";' class = 'tdData' >" + toNothing(itemRow) + "</td><td class = 'tdData' style='font-size:"+defFontSize+";'>" + j.unit[i] +"</td><td class = 'tdData' style = 'text-align:center; font-size:"+defFontSize+";' >" +toNothing(qty)+"</td><td class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word; font-size:"+defFontSize+";'>" + desc + "</td><td class = 'tdData' style = 'text-align:right;padding-right:5px; font-size:"+defFontSize+";'>" +toNothing(j.cost[i]) +"</td><td class = 'tdData'  style = 'text-align:right;border-right:0; font-size:"+defFontSize+";'>" +  toNothing(j.total[i]) + "</td></tr>";
				subTotal = parseFloat(subTotal) + parseFloat(total) ;
				
				if(i == len-1){
					
					if(div.scrollHeight > div.offsetHeight){
						var y = 0;
						do{
							var tempStr1 = inspectScrollerDescriptionAndDivide(tableBody,div);
							 trimmer(div,poMain);
							poMain.innerHTML += certifiedBy(head,headDesignation);
							poMain.innerHTML += footer();
							createNewPage(poMain,div,office,supplier,prNumber,tn,tempStr1,quart,category,categoryName,subTotal,pyTerm,mdOfProc);
							var c = poMain.children.length;
							var div = poMain.children[c-1];
							var table = div.children[0];
							var tableBody = div.children[0].children[0];
							y++;
						}while(div.scrollHeight  > div.offsetHeight);
						
						tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
						// if mulapas pag butang sa total then increase div decrease certificate
						 inspectScrollerLast(div,poMain,head,headDesignation);
					}else{
						 trimmer(div,poMain);
						tableBody.innerHTML += '<tr><td colspan = "7" style = "border-top:1px solid black;border-bottom:1px solid black;">' + totalA(0,subTotal)  + '</></tr>';
						// if mulapas pag butang sa total then increase div decrease certificate
						 inspectScrollerLast(div,poMain,head,headDesignation);
					}
				}
			}
			
		}
		fetchSupplierAddress(supplier);
		var cer =document.getElementsByClassName("pagesPO");
		for(var i = 0 ; i < cer.length ; i++){
			cer[i].innerHTML = "Page " +(i+1) + " of " + cer.length;
		}
	}
	
	function fetchSupplierAddress(supplier){
		loader();
		var container = "";
		var queryString = "?fetchSupplierAddress=1&supplier=" +  supplier ;
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchSupplierAddress");	
	}
	
	
	function trimmer(div,poMain){
		
		if(div.scrollHeight >= div.offsetHeight){
			
			div.style.height = (div.offsetHeight + 37)+ "px";                             
			var  x =  poMain.children.length;
			var cert = poMain.children[x-1];
			cert.style.height =(cert.offsetHeight - 31) + "px";
		}
	}
	function  inspectScrollerLast(div,poMain,head,headDesignation){
		
		if(div.scrollHeight > div.offsetHeight){
			
			div.style.height = (div.offsetHeight + 37)+ "px";                             
			poMain.innerHTML += certifiedBy(head,headDesignation);
			var  x =  poMain.children.length;
			var cert = poMain.children[x-1];
			cert.style.height =(cert.offsetHeight - 31) + "px";
		}else{
			
			trimmer(div,poMain);
			poMain.innerHTML += certifiedBy(head,headDesignation);	
		}
		poMain.innerHTML += footer();
	}
	function inspectScrollerDescriptionAndDivide(tableBody,div){
		trimmer(div,poMain);
		var cLen = (tableBody.children.length - 1);
		var lastChild = tableBody.children[cLen];
		
		/*alert(div.offsetHeight +  "  " + div.scrollHeight);*/
		var desc = lastChild.children[3].textContent.trim();
		var newLine = desc.split("\n");
		var lenLine = newLine.length-1;
		var td = lastChild.children[3];
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
		
		tableBody.innerHTML += '<tr><td colspan = "7" style = "border-top:1px solid black;"></td></tr>';
	
		
		return  tempStr1;
	}
	function createNewPage(poMain,div,office,supplier,prNumber,tn,tempStr1,quart,category,categoryName,subTotal,pyTerm,mdOfProc){
		poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn,pyTerm,mdOfProc) +  '<tr><td class = "tdHeader">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit Cost</td><td class = "tdHeader" style = "border-right:0;">Amount</td></tr>'  +  quarter(quart,category,categoryName) + halfText(tempStr1)  +'</table></div>';
		var c = poMain.children.length;
		var div = poMain.children[c-1];
		var table = div.children[0];
		var tableBody = div.children[0].children[0];
	}
	function  header(office,supplier,prNumber,tn,pyTerm,mdOfProc){
		var sheet = '<tr><td colspan = "6">';
		      sheet += '	<div>';
		      	sheet += '<table style="border-spacing:0;margin:0 auto;width:100%;" >';
			sheet += '			<tr>';
			sheet += '				<td colspan="4" style = "border-bottom:4px double black;padding:15px 0px;padding-bottom:5px;">';
			sheet += '					<table style ="margin:0 auto;width:650px;">';
			sheet += '						<tr>';
			sheet += '							<td style ="text-align:center;"><span style = "font-size:20px;font-weight:bold;">PURCHASE ORDER</span></td>';
			sheet += '						</tr>';
			sheet += '						<tr>';
			sheet += '							<td style ="text-align:center;"><span >City Government of Davao</span></td></td>';
			sheet += '						</tr>';
			sheet += '						<tr>';
			sheet += '							<td style ="text-align:center;">';
			sheet += '								<span style ="letter-spacing:2px;">LGU</span>';
			sheet += '							</td>';
			sheet += '						</tr>';
			
			sheet += '						<tr>';
			sheet += '							<td style ="text-align:right;font-size:12px;">';
			sheet += '								TN : <span style = "font-weight:bold;font-size:21px;font-family:impact;letter-spacing:2px;">' + tn  + '</span>';
			sheet += '							</td>';
			sheet += '						</tr>';
							
			sheet += '					</table>';
			sheet += '				</td>';
			sheet += '			</tr>';
			sheet += '			<tr>';
			sheet += '				<td style = "border-bottom:4px double black;height:110px; vertical-align:top;" >';
			sheet += '					<table style="width:100%;border-spacing:0;font-size:13px; margin-top:5px;" class = "tableHeader1" >';
			sheet += '						<tr>';
			sheet += '							<td valign="top" style = "width:10px;padding-left:10px;">Supplier:</td>';
			sheet += '							<td rowspan = "2" style = "padding-left:5px;vertical-align:top;width:290px;" ><div style = " border-bottom:1px solid black;font-size:14px;font-weight:bold;">' + supplier + '</div></td>';
			sheet += '							<td style="padding-left:10px;">P.O No.:</td>';
			sheet += '							<td style = "border-bottom:1px solid black;width:240px;"></td>';
			sheet += '						</tr>';
			
			sheet += '						<tr>';
			sheet += '							<td style=""></td>';				
			sheet += '							<td style="padding-left:10px;">Date:</td>';
			sheet += '							<td style = "border-bottom:1px solid black;"></td>';
			sheet += '						</tr>';
			
			sheet += '						<tr>';
			sheet += '							<td valign="top" style = "width:10px;padding-left:10px;">Address:</td>';
			sheet += '							<td  style = "padding-left:5px;vertical-align:top; font-size:12px;font-family:Oswald;" rowspan = "2"><div class = "address" style = "border-bottom:1px solid black;">&nbsp;</div></td>';
			sheet += '							<td style="padding-left:10px;">Mode of Procurement:</td>';
			// sheet += '							<td style = "border-bottom:1px solid black;"><input  class = "inputMode" style = "width:100%;border:0;text-align:center;font-weight:bold;font-size:12px;"/></td>';
			sheet += '							<td style = "border-bottom:1px solid black; line-height:12px;"><div style="text-align:center;">'+mdOfProc+'</div></td>';
			sheet += '						</tr>';
			
			sheet += '						<tr>';
			sheet += '							<td style=""></td>';
		
			sheet += '							<td style="padding-left:10px;">P.R. No.:</td>';
			sheet += '							<td style = "border-bottom:1px solid black;text-align:center;font-weight:bold;font-size:14px;">' + prNumber + '</td>';
			sheet += '						</tr>';
			
			sheet += '					</table>';
			sheet += '				</td>';
			sheet += '			</tr>';
			
			sheet += '			<tr>';
			sheet += '				<td style="padding:5px;padding-left:10px;font-size:14px;border-bottom:1px solid black;" colspan = "6">Gentlemen : Please furnish this office the following articles subject to the terms and conditions contained herein.</td>';
			sheet += '			</tr>';
			
			sheet += '			<tr>';
			sheet += '				<td style="padding-left:10px;padding-bottom:15px;border-bottom:1px solid black;" colspan = "6">';
			
			sheet += '					<table class = "tableHeader2" style="width:100%;border-spacing:0;margin-top:5px;font-size:13px;" border = "0">';
			sheet += '						<tr>';
			sheet += '							<td valign="top" style = "width:110px;">Place of Delivery:</td>';
			sheet += '							<td style = "border-bottom:1px solid black;width:390px;font-size:13px;" >' + office + '</td>';
			sheet += '							<td style="vertical-align:bottom;padding-left:10px;width:90px;">Delivery Term:</td>';
			sheet += '							<td style = "border-bottom:1px solid black;width:180px;vertical-align:bottom;"><input style = "border:0;width:100%;"/></td>';
			sheet += '						</tr>';
			
			sheet += '						<tr>';
			sheet += '							<td style="">Date of Delivery:</td>';
			sheet += '							<td style="border-bottom:1px solid black;"><input style = "width:100%;border:0;"/></td>';
			sheet += '							<td style="padding-left:10px;">Payment Term:</td>';
			sheet += '							<td style = "border-bottom:1px solid black;"><input style = "border:0;width:100%;" value="'+pyTerm+'" /></td>';
			sheet += '						</tr>';
			
			sheet += '					</table>';
			
			sheet += '                                </td>';
			sheet += '			</tr>';
			
			
			sheet += '		</table>';
			      	
		        sheet += ' </div>';
		        sheet += '</td></tr>';
		return sheet;
	}
	function quarter(quart,category,categoryName){
		var  sheet = '<tr>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "text-align:center;font-weight:bold;padding:8px 0px; font-size:'+defFontSize+'; "><input style = "text-align:center;border:0;font-weight:bold; font-size:'+defFontSize+'; " value = "' + quart  +'" /><br/>' + category + ' - ' + categoryName  + '</td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "border-right:0;text-align:right;font-weight:bold;"></td>';
		      sheet += '</tr>';
		return sheet;
	}
	function forwarded(subtotal){
		var  sheet = '<tr>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "text-align:center; font-size:'+defFontSize+'; ">Balance Forwarded</td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "border-right:0; text-align:right; font-weight:bold; font-size:'+defFontSize+'; ">'  + numberWithCommas(subtotal.toFixed(2))  + '</td>';
		      
		      sheet += '</tr>';
		return sheet;
	}
	function totalA(label,total){
		
		if(label == 1){
			label = "Subtotal";
			var   sheet = '<table style = "width: 100%;" border = "0" >';
			sheet += '	<tr >';
			
			sheet += '	<td colspan = "2" style = "width:100px;padding-right:5px;text-align:right;font-weight:bold; vertical-align:top; font-size:14px;"><span style = "padding-right:20px;">' + label + '</span>' + numberWithCommas(total.toFixed(2)) + '</td>';
			sheet += '</tr>	';
			sheet += '</table>';
		}else{
			label = "Total";
			var   sheet = '<table style = "width: 100%;" border = "0" >';
			sheet += '	<tr >';
			sheet += '	<td style = "font-size:12px;padding-left:5px;">' + convertWordCurrency(total.toFixed(2)) + ' ONLY' + '</td>'
			sheet += '	<td style = "width:100px;padding-right:5px;text-align:right;font-weight:bold; vertical-align:top; font-size:14px;"><span style = "padding-right:20px;">' + label + '</span>' + numberWithCommas(total.toFixed(2)) + '</td>';
			sheet += '</tr>	';
			sheet += '</table>';
		}
		
		
		return sheet;
	}
	function certifiedBy(head,headDesignation){
		var  tn = "<?php  echo $tn ?>";
		var  office = tn.substr(0,4);
		var sheet = '<table border="0" class = "certifiedDiv" style=""><tr><td style="vertical-align:bottom;"><table style = "width: 100%;" >';
			sheet += '	<tr >';
			//sheet += '	<td style = "text-align:right;padding-right:160px;font-size:12px; font-weight:bold;"><span style = "position:absolute; margin-top:40px;" class = "pagesPO"></span></td>';
			sheet += '	<td style = "text-align:right;padding-right:120px;font-size:12px; font-weight:bold;vertical-align:bottom;"><div  style = "text-align:left" class = "pagesPO"></div></td>';
			sheet += '	<td style = "width:245px;padding-right:180px;verical-align:top;">';
			
		var show = "";
		if(office == 'COA1') {
			show = 'display:none;';
		}

			sheet += '		<table border="0" class = "tableSig" style="'+show+'">';
			sheet += '			<tr>';
			sheet += '			</tr>';
			sheet += '			<tr>';
			sheet += '				<td style="white-space:nowrap; padding-right:5px; vertical-align:top;">Certified Correct</td>';
			sheet += '				<td style ="text-align:center;vertical-align:bottom;"><input value = "'+ head + '" style = "font-size:12px;border:0px solid white;border-bottom:1px solid black;width:240px;text-align:center;font-weight:bold;" placeholder = "Type Name"/><input placeholder = "Type Position" value = "'+ headDesignation + '"   style = "font-size:12px;border:0;width:100%;text-align:center;"/></td></td>';
			sheet += '			</tr>';
			sheet += '		</table>';
		
			sheet += '	</td>';
			sheet += '</tr>	';
			sheet += '</table></td></tr></table>';
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
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "white-space: pre-line; word-wrap: break-word; font-size:'+defFontSize+'; ">' + text  +'</td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "border-right:0;text-align:right;font-weight:bold; font-size:'+defFontSize+'; "></td>';
		      sheet += '</tr>';
		return sheet;
	}
	function footer(officeC){
		var   sheet = '<div class = "footerDiv"><table style = "width: 100%;height:100%;font-size:12px;"  >';
			sheet += '<tr >';
			sheet += '	<td colspan = "2" style = "vertical-align:top;" >&nbsp; &nbsp;In case of failure to make the full delivery within time specified above, a penalty of one-tenth(1/10) of one percent for everyday of delay shall be imposed.</td>';
			sheet += '</tr>	';
			sheet += '<tr >';
			sheet += '	<td  >';
			sheet += '		<table style ="width:65%;margin-top:18px;margin-left:30px;" >';
			sheet += '			<tr>';
			sheet += '				<td colspan = "2">Conforme :</td>';
			sheet += '			</tr>';
			sheet += '			<tr>';
			sheet += '				<td colspan = "2" style ="text-align:center;height:60px;vertical-align:bottom;"><input style = "font-size:12px;border:0;width:100%;text-align:center;font-weight:bold;" /><input style = "font-size:12px;border:0;border-bottom:1px solid black;width:100%;text-align:center;font-weight:bold;" /><input value = "Signature over printed name" style = "font-size:12px;border:0;width:100%;text-align:center;"/></td></td>';
			
			sheet += '			</tr>';
			sheet += '			<tr>';
			sheet += '				<td style ="vertical-align:top;text-align:right;width:10px;">Date:</td><td style = "font-size:13px;"><input   style = "font-size:13px;border:0;width:100%;"/></td>';
			sheet += '			</tr>';
			sheet += '		</table>';	
			sheet += '	</td>';
			
			sheet += '	<td style = "vertical-align:top;" >';
			sheet += '		<table style ="width:60%;" >';
			sheet += '			<tr>';
			sheet += '				<td colspan = "2">Very truly yours,</td>';
			sheet += '			</tr>';
			sheet += '			<tr>';
			
			if(officeC == "1021" || officeC == "1016"){
				// sheet += '				<td colspan = "2" style ="text-align:center;height:80px;vertical-align:bottom;"><input value = "SEBASTIAN Z. DUTERTE" style = "font-size:12px;border:0;border-bottom:1px solid black;width:100%;text-align:center;font-weight:bold;" placeholder = "Type Name"/><input value = "City Mayor"  style = "font-size:12px;border:0;width:100%;text-align:center;"/></td></td>';
				sheet += '				<td colspan = "2" style ="text-align:center;height:80px;vertical-align:bottom;"><input value = "J. MELCHOR B. QUITAIN, JR." style = "font-size:12px;border:0;border-bottom:1px solid black;width:100%;text-align:center;font-weight:bold;" placeholder = "Type Name"/><input value = "City Mayor"  style = "font-size:12px;border:0;width:100%;text-align:center;"/></td></td>';
			}else{
				// sheet += '				<td colspan = "2" style ="text-align:center;height:80px;vertical-align:bottom;"><input value = "SARA Z. DUTERTE" style = "font-size:12px;border:0;border-bottom:1px solid black;width:100%;text-align:center;font-weight:bold;" placeholder = "Type Name"/><input value = "City Mayor"  style = "font-size:12px;border:0;width:100%;text-align:center;"/></td></td>';
				sheet += '				<td colspan = "2" style ="text-align:center;height:80px;vertical-align:bottom;"><input value = "SEBASTIAN Z. DUTERTE" style = "font-size:12px;border:0;border-bottom:1px solid black;width:100%;text-align:center;font-weight:bold;" placeholder = "Type Name"/><input value = "City Mayor"  style = "font-size:12px;border:0;width:100%;text-align:center;"/></td></td>';
			}
			
			
			sheet += '			</tr>';
			
			sheet += '		</table>';	
			sheet += '	</td>';
			sheet += '</tr>	';
			sheet += '<tr >';
			sheet += '	<td colspan = "2" style = "vertical-align:top;border-top:2px solid black;" >(In case of Negotiation Purchase pursuant to Section 369(a) of RA 7160, this portion must be accompished).</td>';
			sheet += '</tr>	';
			sheet += '<tr >';
			sheet += '	<td colspan = "2"  style = "vertical-align:top;" >Approved per Sanggunian Res. No.<input style = "vertical-align:top;border:0;border-bottom:1px solid black;width:500px;"/></td>';
			sheet += '</tr>	';
			sheet += '<tr >';
			sheet += '	<td colspan = "2"  style = "vertical-align:top;" >Certified Correct<input style = "margin-right:20px;border:0;border-bottom:1px solid black;width:250px;"/>Date:<input style = "vertical-align:top;border:0;border-bottom:1px solid black;width:200px;"/></td>';
			sheet += '</tr>	';
			sheet += '<tr >';
			sheet += '	<td colspan = "2"  style = "vertical-align:top;padding-left:140px;" >Secretary to the Sanggunian</td>';
			sheet += '</tr>	';
			
			sheet += '</table></div><div style = "width:750px;margin:0 auto;font-size:10px;">Original Copy: Pink copy for City General Services Office; Yellow copy for the City Auditor\'s Office; White Copy - extra copy</div>';
		
		
		
		return sheet;
	}
	window.ondblclick = function() {
		show();
	}
	function show(){
	    editorSet();
	}
	function set(){
			var ad= document.getElementById("address").value;
			var place =  document.getElementById("placeDelivery").value;
			var date = document.getElementById("dateDelivery").value;
			var term = document.getElementById("deliveryTerm").value;
			// var pay= document.getElementById("paymentTerm").value;
			// var mod = document.getElementById("procurementMode").value;
			var head = document.getElementById("officeHead").value;
			var pos = document.getElementById("positionLabel").value;
			var modes = document.getElementsByClassName("tableHeader1");
			var length = modes.length;
			
			for(var i = 0 ; i < length; i++){
			    var parent = modes[i].children[0];
			    parent.children[2].children[1].children[0].innerHTML = ad;
			    // parent.children[2].children[3].children[0].value = mod;
			    // parent.children[2].children[3].children[0].innerHTML = mod;
			}
			
			var tables = document.getElementsByClassName("tableHeader2");
			var length = tables.length;
			
			for(var i = 0 ; i < length; i++){
				var parent = tables[i].children[0];
			
				parent.children[0].children[1].innerHTML = place;
				parent.children[0].children[3].children[0].value = term;

				// parent.children[1].children[3].children[0].value = pay;
				
				parent.children[1].children[1].children[0].value = date;
				
			}
			var signa = document.getElementsByClassName("tableSig");
			var length = signa.length;
			
			for(var i = 0 ; i < length; i++){
				// var parent = signa[i].children[0];
				
				// parent.children[1].children[0].children[0].value = head;
				// parent.children[1].children[0].children[1].value = pos;

				var parent = signa[i].children[0].children[1].children[1];
				
				parent.children[0].value = head;
				parent.children[1].value = pos;
				
			}
			document.getElementById("editorX").click();
			
		}
	function editorSet(){
		var d1 = 1;
		var r1 = 1;
		var  r2 = 1;
		var p1 = 1;
		
		var address = document.getElementsByClassName("address")[0].innerHTML;
		// var sheet = "<div class = 'editorContainer'><table border ='0' style = 'padding-bottom:20px;width:450px;' >";
		// 	sheet += "<tr><td class = 'editorHeader' colspan = '2' >PO Form Settings<div  id  = 'editorX'onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>";
		// 	sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:0px solid silver;margin:10px; 0px;'></div></td>";
		// 	sheet += "<tr><td style = 'padding-left:10px;width:145px;'>Supplier Address</td><td style = 'padding-right:10px;'><input  id = 'address' class = 'text3'  style = 'text-align:center;width:100%;text-align:left;' value = '" + address + "'/></td></tr>";
			
		// 	sheet += "<tr><td style = 'padding-left:10px;'>Place of Delivery</td><td style = 'padding-right:10px;'><input class = 'text3'   id = 'placeDelivery'  style = 'text-align:center;width:100%;text-align:left;' value = '"+ ofis+"'/></td></tr>";
		// 	sheet += "<tr><td style = 'padding-left:10px;'>Date of Delivery</td><td style = 'padding-right:10px;'><input class = 'text3'   id = 'dateDelivery'  style = 'text-align:center;width:100%;text-align:left;' value = '30 days upon receipt of approved P.O.'/></td></tr>";
		// 	sheet += "<tr><td style = 'padding-left:10px;'>Delivery Term</td><td style = 'padding-right:10px;'><input class = 'text3'  id = 'deliveryTerm'  style = 'text-align:center;width:100%;text-align:left;' value = 'Complete Delivery' /></td></tr>";
		// 	sheet += "<tr><td style = 'padding-left:10px;'>Payment Term</td><td style = 'padding-right:10px;'><input class = 'text3'   id = 'paymentTerm'  style = 'text-align:center;width:100%;text-align:left;' value = 'After full delivery' /></td></tr>";
		// 	sheet += "<tr><td style = 'padding-left:10px;'>Mode of Procurement</td><td style = 'padding-right:10px;'>";
		// 	sheet += "<select class = 'text3'  style = 'width:100%;' id = 'procurementMode'>";
		// 	sheet += "<option>Competitive Bidding</option>";
		// 	sheet += "<option>Shopping</option>";
		// 	sheet += "<option>Shopping 52.1.b</option>";
		// 	sheet += "<option>Alternative</option>";
		// 	sheet += "<option>Agency to Agency</option>";
			
		// 	sheet += "<option>Negotiated</option>";
		// 	sheet += "<option>Negotiated Procurement 53.9(SVP)</option>";
		// 	sheet += "<option>Negotiated Procurement 53.1(TFB)</option>";
		// 	sheet += "<option>Negotiated Procurement 53.6(MS)</option>";
		// 	sheet += "<option>Negotiated Procurement 53.7</option>";
			
		// 	sheet += "<option>Negotiated Procurement 53.2(E.C.)</option>";
			
			
		// 	sheet += "<option>Postal Office</option>";
		// 	sheet += "<option>Direct Contracting</option>";
		// 	sheet += "<option>Repeat Order</option>";
		// 	sheet += "<option>Twice Failed Bidding(TFB)</option>";
		// 	sheet += "<option>Extension of Contract Appx. 21 Sec. 3.31</option>";
		// 	sheet += "<option>Renewal of Contract Based on Appendix 21 3.3.1.3</option>";
		
		// 	sheet += "</select>";
		// 	sheet += '</td></tr>';
		// 	sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";
		// 	sheet += "<tr><td style = 'padding-right:10px;text-align:right;'>Certified By</td><td style = 'padding-right:10px;'><input class = 'text3'   id = 'officeHead'  style = 'text-align:center;width:100%;'  value = " + head + "  /></td></tr>";
		// 	sheet += "<tr><td style = 'padding-right:10px;text-align:right;'>Designation</td><td style = 'padding-right:10px;'><input class = 'text3'  id = 'positionLabel'  style = 'text-align:center;width:100%;' value = " + headDesignation + "  /></td></tr>";
		// 	sheet += "<tr><td colspan = '2' style = 'text-align:center;padding:20px 0px;padding-bottom:0px;'><div  id = '1' class='button1 label19' style='margin:0 auto;width:75px;text-shadow:0px 0px 1px GREY; padding:5px 10px;font-weight:bold;color:white;letter-spacing:1px;font-size:14px;background-color:rgb(18, 184, 240);cursor:pointer; ' onclick= 'set()'>Set</div></td></tr>";

				
		// 	sheet += "</table></div>";
		
		// var sheet ="<div class = 'editorContainer'>"
		// 		  +"	<table border='0' style = 'padding-bottom:20px; border-spacing:0px; font-family:Arial; font-size:14px;'>"
		// 		  +"		<tr>"
		// 		  +"			<td class = 'editorHeader' colspan = '2' style='font-size:16px;'>PO Form Settings<div  id  = 'editorX'onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td colspan = '2' ><div style = 'margin:4px; 0px;'></div></td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td style = 'padding-right:10px; text-align:right;'>Supplier Address</td>"
		// 		  +"			<td style = 'padding-top:4px; padding-right:8px;'><input  id = 'address' class = 'text3'  style = 'text-align:center;width:100%;text-align:left;' value = '" + address + "'/></td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td style = 'padding-right:10px; text-align:right;'>Place of Delivery</td>"
		// 		  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'   id = 'placeDelivery'  style = 'text-align:center;width:100%;text-align:left;' value = '"+ ofis  +"'/></td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td style = 'padding-right:10px; text-align:right;'>Date of Delivery</td>"
		// 		  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'   id = 'dateDelivery'  style = 'text-align:center;width:100%;text-align:left;' value = '30 days upon receipt of approved P.O.'/></td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td style = 'padding-right:10px; text-align:right;'>Delivery Term</td>"
		// 		  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'  id = 'deliveryTerm'  style = 'text-align:center;width:100%;text-align:left;' value = 'Complete Delivery' /></td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td style = 'padding-right:10px; text-align:right;'>Payment Term</td>"
		// 		  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'   id = 'paymentTerm'  style = 'text-align:center;width:100%;text-align:left;' value = 'After full delivery' /></td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td style = 'padding-right:10px; text-align:right;'>Mode of Procurement</td>"
		// 		  +"			<td style = 'padding-top:4px; padding-right:8px;'>"
		// 		  +"				<select class = 'text3'  style = 'width:100%;' id = 'procurementMode'>"
		// 		  +"					<option>Competitive Bidding</option>"
		// 		  +"					<option>Shopping</option>"
		// 		  +"					<option>Shopping 52.1.b</option>"
		// 		  +"					<option>Alternative</option>"
		// 		  +"					<option>Agency to Agency</option>"
		// 		  +"					<option>Negotiated</option>"
		// 		  +"					<option>Negotiated Procurement 53.9(SVP)</option>"
		// 		  +"					<option>Negotiated Procurement 53.1(TFB)</option>"
		// 		  +"					<option>Negotiated Procurement 53.6(MS)</option>"
		// 		  +"					<option>Negotiated Procurement 53.7</option>"
		// 		  +"					<option>Negotiated Procurement 53.2(E.C.)</option>"
		// 		  +"					<option>Postal Office</option>"
		// 		  +"					<option>Direct Contracting</option>"
		// 		  +"					<option>Repeat Order</option>"
		// 		  +"					<option>Twice Failed Bidding(TFB)</option>"
		// 		  +"					<option>Extension of Contract Appx. 21 Sec. 3.31</option>"
		// 		  +"					<option>Renewal of Contract Based on Appendix 21 3.3.1.3</option>"
		// 		  +"				</select>"
		// 		  +"			</td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td colspan = '2' ><div style = 'border-bottom:1px solid silver; margin:4px 0px;'></div></td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td style = 'padding-right:10px; text-align:right;'>Certified By</td>"
		// 		  +"			<td style = 'padding-right:8px;'><input class = 'text3'   id = 'officeHead'  style = 'text-align:center;width:100%;'  value = " + head + "  /></td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td style = 'padding-right:10px; text-align:right;'>Designation</td>"
		// 		  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'  id = 'positionLabel'  style = 'text-align:center;width:100%;' value = " + headDesignation + "  /></td>"
		// 		  +"		</tr>"
		// 		  +"		<tr>"
		// 		  +"			<td style='vertical-align:bottom; font-size:0px; padding-left:10px;'>"
		// 		  +"				<div style='font-size:12px; display:inline-block;'>Change font size</div>"
		// 		  +"				<button class='btnToggleFontSize' onclick='changeFontSize(\"tdData\", -2)'>-</button>"
		// 		  +"				<button class='btnToggleFontSize' onclick='changeFontSize(\"tdData\", 2)'>+</button>"
		// 		  +"			</td>"
		// 		  +"			<td style='padding:20px 0px; padding-bottom:0px; text-align:center;'>"
		// 		  +"				<div  id = '1' style='display:inline-block; width:75px; padding:5px 8px; font-size:14px; cursor:pointer; border:1px solid silver;' onclick= 'set()'>Set</div>"
		// 		  +"			</td>"
		// 		  +"		</tr>"
		// 		  +"	</table>"
		// 		  +"</div>";

		var sheet ="<div class = 'editorContainer'>"
				  +"	<table border='0' style = 'padding-bottom:20px; border-spacing:0px; font-family:Arial; font-size:14px;'>"
				  +"		<tr>"
				  +"			<td class = 'editorHeader' colspan = '2' style='font-size:16px;'>PO Form Settings<div  id  = 'editorX'onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan = '2' ><div style = 'margin:4px; 0px; min-width:400px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding:0px 10px 0px 20px; white-space:nowrap; text-align:right; width:0px; white-space:nowrap;'>Supplier Address</td>"
				  +"			<td style = 'padding-top:4px; padding-right:8px;'><input  id = 'address' class = 'text3'  style = 'text-align:center;width:100%;text-align:left;' value = '" + address + "'/></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding:0px 10px 0px 20px; white-space:nowrap; text-align:right;'>Place of Delivery</td>"
				  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'   id = 'placeDelivery'  style = 'text-align:center;width:100%;text-align:left;' value = '"+ ofis  +"'/></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding:0px 10px 0px 20px; white-space:nowrap; text-align:right;'>Date of Delivery</td>"
				  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'   id = 'dateDelivery'  style = 'text-align:center;width:100%;text-align:left;' value = '30 days upon receipt of approved P.O.'/></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding:0px 10px 0px 20px; white-space:nowrap; text-align:right;'>Delivery Term</td>"
				  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'  id = 'deliveryTerm'  style = 'text-align:center;width:100%;text-align:left;' value = 'Complete Delivery' /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan = '2' ><div style = 'border-bottom:1px solid silver; margin:4px 0px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding:0px 10px 0px 20px; white-space:nowrap; text-align:right;'>Certified By</td>"
				  +"			<td style = 'padding-right:8px;'><input class = 'text3'   id = 'officeHead'  style = 'text-align:center;width:100%;'  value = " + head + "  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding:0px 10px 0px 20px; white-space:nowrap; text-align:right;'>Designation</td>"
				  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'  id = 'positionLabel'  style = 'text-align:center;width:100%;' value = " + headDesignation + "  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style='vertical-align:bottom; font-size:0px; padding-left:10px; white-space:nowrap;'>"
				  +"				<div style='font-size:12px; display:inline-block;'>Change font size</div>"
				  +"				<button class='btnToggleFontSize' onclick='changeFontSize(\"tdData\", -2)'>-</button>"
				  +"				<button class='btnToggleFontSize' onclick='changeFontSize(\"tdData\", 2)'>+</button>"
				  +"			</td>"
				  +"			<td style='padding:20px 0px; padding-bottom:0px; text-align:center;'>"
				  +"				<div  id = '1' style='display:inline-block; width:75px; padding:5px 8px; font-size:14px; cursor:pointer; border:1px solid silver;' onclick= 'set()'>Set</div>"
				  +"			</td>"
				  +"		</tr>"
				  +"	</table>"
				  +"</div>";

		theAbsolute(sheet);
	}
	
	function changeFontSize(elemClass, sizeChange) {
		var curFontSize = readCookie('poDefFontSize');
		var fontSize = 0;
		var newFontSize = 0;

		if(curFontSize == -1) {
			var elem = document.getElementsByClassName(elemClass);
			for (let i = 0; i < elem.length; i++) {
				if(elem[i].style.fontSize != "") {
					fontSize = parseInt(elem[i].style.fontSize.replace("px", ""));
					break;
				}			
			}

			newFontSize = fontSize + sizeChange;
			setCookie("poDefFontSize", newFontSize, 1);
		}else {
			fontSize = parseInt(curFontSize);
			newFontSize = fontSize + sizeChange;
			setCookie("poDefFontSize", newFontSize, 1);
		}

		location.reload();
	}
	
</script>