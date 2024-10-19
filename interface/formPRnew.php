<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	
	require_once('../javascript/ajaxFunction.php');
	$tn = $_GET['tn'];

	if(isset($_COOKIE['RequestedBy'])){
		$head = $_COOKIE['RequestedBy'];
		$headDesignation = $_COOKIE['RequestedDesignation'];	
	}else{
		$head = 'h';
		$headDesignation = 'h';
	}
	if(isset($_COOKIE['RequestedDesignation'])){
		$headDesignation = $_COOKIE['RequestedDesignation'];	
	}else{
		$headDesignation = '';
	}
	
	if(isset($_COOKIE['CertifiedBy'])){
		$certifiedBy = $_COOKIE['CertifiedBy'];
	}else{
		$certifiedBy = '';
	}
	if(isset($_COOKIE['CertifiedDesignation'])){
		$certifiedDesignation = $_COOKIE['CertifiedDesignation'];
	}else{
		$certifiedDesignation = 'Administrative Officer';
	}
	
	if(isset($_COOKIE['ApprovedBy'])){
		$approvedBy = $_COOKIE['ApprovedBy'];
	}else{
		// $approvedBy = 'SARA Z. DUTERTE';
		$approvedBy = 'SEBASTIAN Z. DUTERTE';
	}
	if(isset($_COOKIE['ApprovedDesignation'])){
		$approvedDesignation = $_COOKIE['ApprovedDesignation'];
	}else{
		$approvedDesignation = 'City Mayor';
	}
	
	if(isset($_COOKIE['ControlledBy'])){
		$controlledBy = $_COOKIE['ControlledBy'];
	}else{
		$controlledBy = '';
	}

	if(isset($_COOKIE['prDefFontSize'])){
		$defFontSize = $_COOKIE['prDefFontSize'].'px';
	}else{
		$defFontSize = '14px';
	}

	/*
	if(isset($_COOKIE['ControlledDesignation'])){
		$controlledDesignation = $_COOKIE['ControlledDesignation'];
	}else{
		$controlledDesignation = 'Purchasing Supply Officer';
	}*/
	
	
?>
<style>
	@font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
	}

	/*-----------------------------------------------------------------loader*/
	body{
		padding:0;
		margin:0;
	}
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
		color:white;
		padding:2px 5px;
		/* padding:10px; */
		padding:5px;
		letter-spacing:1px;
		/* background-color:rgb(8, 149, 196); */
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
		/* height:700px; */
		/* height:770px; */
		height:740px;
		width: 750px;overflow: auto;margin:0 auto;
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
		/* height:170px; */
		/* height:110px; */
		height:140px;
		width: 750px;margin:0 auto;
		border:2px solid black;
	
		border-top: 0px;
		
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
	.purpose:disabled{
		background-color: white;
		color: black;
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

<link rel="icon" href="/citydoc2020/images/red.png"/> 
<title>PR Form</title>
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
	
	var certBy = "<?php echo $certifiedBy; ?>";
	var certDesignation = "<?php echo $certifiedDesignation; ?>";
	
	var approvedBy = "<?php echo $approvedBy; ?>";
	var approvedDesignation = "<?php echo $approvedDesignation; ?>";
	
	var controlledBy = "<?php echo $controlledBy; ?>";

	var defFontSize = "<?php echo $defFontSize; ?>";

	var ofis; 
	viewPO();
	var code;
	var program; 
	var purpose = '';
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
		
		program =  j.programs;
		
		code =  j.codes;
		purpose = decodeURIComponent(j.purpose);
		
	
		
		document.getElementById("trFirst").innerHTML = header(office,supplier,prNumber,tn);
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
							td.textContent = tempStr;
							i  = i -1;
							
							tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-bottom:0px solid black;">' +  totalA(1,subTotal) + '</td></tr>'; // 08-17-2022 gi-add para sa mga taas na text

						}else{
							tableBody.removeChild(lastChild); 
							var lastAmount = lastChild.children[5].textContent.replace(/,/g,"");; 
							subTotal = subTotal - lastAmount;
							tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:0px solid black;">' +  totalA(1,subTotal) + '<td></tr>';
							tempStr1 = '';
							i  = i -2;
						}
						inspectScrollerLast(div,poMain);
						poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn) +  '<tr><td class = "tdHeader">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit Cost</td><td class = "tdHeader" style = "border-right:0;">Amount</td></tr>'  + quarter(quart,category,categoryName)  + forwarded(subTotal) + halfText(tempStr1) +'</table></div>';
						
						if(i == len-1){
							var c = poMain.children.length;
							var div = poMain.children[c-1];
							var table = div.children[0];
							var tableBody = div.children[0].children[0];
							tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
							// if mulapas pag butang sa total then increase div decrease certificate
							
							 inspectScrollerLast(div,poMain);
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
					if(terms != null && terms.length > 0) {
						// desc += '\n\nTERMS AND CONDITIONS\n'+terms;
						desc += '\n\n'+terms;
					}
				}

				var descX = desc.match(/\n/g);
				var descX = desc.split("\n");
			    
			 	tableBody.innerHTML +="<tr><td  class = 'tdData' style = 'text-align:center; font-size:"+defFontSize+"; '>" + toNothing(itemRow) + "</td><td class = 'tdData' style='font-size:"+defFontSize+";'>" + j.unit[i] +"</td><td class = 'tdData' style = 'text-align:center; font-size:"+defFontSize+";' >" + toNothing(qty)+"</td><td class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word; font-size:"+defFontSize+";'>" + desc + "</td><td class = 'tdData' style = 'text-align:right;padding-right:5px; font-size:"+defFontSize+";'>" + toNothing(j.cost[i]) +"</td><td class = 'tdData'  style = 'text-align:right;border-right:0; font-size:"+defFontSize+";'>" + toNothing(j.total[i]) + "</td></tr>";
				subTotal = parseFloat(subTotal) + parseFloat(total) ;
				
				if(i == len-1){
					if(div.scrollHeight > div.offsetHeight){
						
						var y = 0;
						do{	
							var tempStr1 = inspectScrollerDescriptionAndDivide(tableBody,div);
							if(tempStr1 == 0){
								var cLen = (tableBody.children.length - 1);
								var lastChild = tableBody.children[cLen];
								tableBody.removeChild(lastChild); 
								subTotal = subTotal - total;
								tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:0px solid black;">' +  totalA(1,subTotal) + '</td></tr>'; // last div na gi byaan
								
								var limit = divTrim(div);
								poMain.innerHTML += certifiedBy();
								certTrim(limit);
								poMain.innerHTML += footer(purpose);
								
								createNewPage(poMain,div,office,supplier,prNumber,tn, forwarded(subTotal),quart,category,categoryName,subTotal);
								subTotal = parseFloat(subTotal) + parseFloat(total);
								//subTotal = subTotal - lastAmount;
								var c = poMain.children.length;
								var div = poMain.children[c-1];
								var table = div.children[0];
								var tableBody = div.children[0].children[0];
								tableBody.innerHTML +="<tr><td  class = 'tdData' style = 'text-align:center; font-size:"+defFontSize+";' >" + toNothing(itemRow) + "</td><td class = 'tdData' style='font-size:"+defFontSize+";'>" + j.unit[i] +"</td><td class = 'tdData' style = 'text-align:center; font-size:"+defFontSize+";' >" +toNothing(qty)+"</td><td class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word; font-size:"+defFontSize+";'>" + desc + "</td><td class = 'tdData' style = 'text-align:right;padding-right:5px; font-size:"+defFontSize+";'>" + toNothing(j.cost[i]) +"</td><td class = 'tdData'  style = 'text-align:right;border-right:0; font-size:"+defFontSize+";'>" + toNothing(j.total[i]) + "</td></tr>";
							}else if(tempStr1 == -1){
								
								poMain.innerHTML += comment("Please do not create a very long sentence. Press enter at the end of the paragraph.");
								end; 
							
							}else{
								tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-bottom:0px solid black;">' +  totalA(1,subTotal) + '</td></tr>'; // 08-17-2022 gi-add para sa mga taas na text

								var limit = divTrim(div);
								poMain.innerHTML += certifiedBy();
								certTrim(limit);
								poMain.innerHTML += footer();
								
								createNewPage(poMain,div,office,supplier,prNumber,tn,tempStr1,quart,category,categoryName,subTotal);
								var c = poMain.children.length;
								var div = poMain.children[c-1];
								var table = div.children[0];
								var tableBody = div.children[0].children[0];
								//tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
								//inspectScrollerLast(div,poMain);
							}	
							y++;
							
						}while(div.scrollHeight  > div.offsetHeight);
						
						tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
						// if mulapas pag butang sa total then increase div decrease certificate
						 inspectScrollerLast(div,poMain);
					}else{
						//createNewPage(poMain,div,office,supplier,prNumber,tn, forwarded(subTotal),quart,category,categoryName,subTotal);
						
						tableBody.innerHTML += '<tr><td colspan = "7" style = "border-top:1px solid black;border-bottom:1px solid black;">' + totalA(0,subTotal)  + '</></tr>';
						// if mulapas pag butang sa total then increase div decrease certificate
						 inspectScrollerLast(div,poMain);
					}
				}

			}
		}
		countPageLimit();
	}
	function inspectScrollerLast(div,poMain){
		
		if(div.scrollHeight > div.offsetHeight){
			var limit = divTrim(div);
			poMain.innerHTML += certifiedBy();
			certTrim(limit);
		}else{    
			poMain.innerHTML += certifiedBy();
			certTrim(limit);	
		}
		poMain.innerHTML += footer();
	}
	function divTrim(div){
		j=0;
		var h = div.offsetHeight;
		while(div.scrollHeight + 1 >= div.offsetHeight){
			div.style.height = (h + j)+ "px"; 	
			j = j + 1;
		}
		
		return j;
	}
	function certTrim(limit){
		var length = poMain.children.length-1;
		var cert = poMain.children[length];
		var h = cert.offsetHeight;
		cert.style.height = ((h - limit) + 11)+ "px"; 	
	}
	function inspectScrollerDescriptionAndDivide(tableBody,div){
		var cLen = (tableBody.children.length - 1);
		var lastChild = tableBody.children[cLen];
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
		
		if(a > 1){
			td.textContent =   tempStr;
			tableBody.innerHTML += '<tr><td colspan = "7" style = "border-top:1px solid black;"></td></tr>';
		}else{	
			/*if(tempStr.length > 0){
				 tempStr1 = 0;	
				 if(tempStr1.length > 1000){
					 tempStr1 = -1;
				}
			}else{
				if(tempStr1.length > 1000){
					 tempStr1 = -1;
				}
			}*/
			
			/*if(tempStr.length > 1000){
				 tempStr1 = -1;
			}else{
				tempStr1 = 0;	
			}*/
			if(tempStr1.length > 1000){
				 tempStr1 = -1;
			}else{
				tempStr1 = 0;	
			}
		}
		return  tempStr1;
	}
	function createNewPage(poMain,div,office,supplier,prNumber,tn,tempStr1,quart,category,categoryName,subTotal){
		poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn) +  '<tr><td class = "tdHeader">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit Cost</td><td class = "tdHeader" style = "border-right:0;">Amount</td></tr>'  +  quarter(quart,category,categoryName) + halfText(tempStr1)  +'</table></div>';
		var c = poMain.children.length;
		var div = poMain.children[c-1];
		var table = div.children[0];
		var tableBody = div.children[0].children[0];
	}
	function header(office,supplier,prNumber,tn){
		
		var sheet = '<tr><td colspan = "6">';
		      sheet += '	<div>';
		      	sheet += '<table style="border-spacing:0;margin:0 auto;width:100%;">';
			sheet += '			<tr>';
			sheet += '				<td colspan="4" style = "border-bottom:4px s black;padding:15px 0px;padding-bottom:5px;">';
			sheet += '					<table style ="margin:0 auto;width:715px;"  >';
			sheet += '						<tr>';
			sheet += '							<td style ="text-align:center;"><span style = "font-size:20px;font-weight:bold;">PURCHASE REQUEST</span></td>';
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
			sheet += '								TN : <span style = "font-size:22px;font-family:impact;letter-spacing:2px;">' + tn  + '</span>';
			sheet += '							</td>';
			sheet += '						</tr>';
							
			sheet += '					</table>';
			sheet += '				</td>';
			sheet += '			</tr>';
		
			sheet += '<tr>';
			sheet += '				<td  valign="top" >';
			sheet += '					<table border ="0" style="width:100%;font-size:14px;">';
			sheet += '						<tr>';
			sheet += '							<td valign="top" style = "width:10px;">Department&nbsp;:</td>';
			sheet += '							<td style="border-bottom:2px solid black;"><span class = "office">' + office + '</span></td>';
			sheet += '						</tr>';
			sheet += '						<tr>';
			sheet += '							<td>Section :</td>';
			sheet += '							<td style="border-bottom:2px solid black;" ><span class = "section"></span></td>';
								
			sheet += '						</tr>';
			sheet += '					</table>';
			sheet += '				</td>';
			sheet += '				<td width = "45%" style = "">';
			sheet += '					<table border ="0" style = "font-size:14px;">';
			sheet += '						<tr>';
			sheet += '							<td>PR. No :</td><td width ="125px;" style="border-bottom:2px solid black;"></td>';
			sheet += '							<td>Date:</td><td width ="80px;" style="border-bottom:2px solid black;"></td>';
			sheet += '						</tr>';
			sheet += '						<tr>';
			sheet += '							<td>SAI No :</td><td style="border-bottom:2px solid black;"></td><td>Date:</td>';
			sheet += '							<td style="border-bottom:2px solid black;"></td>';
			sheet += '						</tr>';
			sheet += '						<tr>';
			sheet += '							<td>Alobs No :</td><td style="border-bottom:2px solid black;"></td><td>Date:</td>';
			sheet += '							<td style="border-bottom:2px solid black;"></td>';
			sheet += '						</tr>';
			sheet += '					</table>';
			sheet += '				</td>';
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
		      sheet += '<td class = "tdData" style = "text-align:center;font-weight:bold;padding:8px 0px;font-size:'+defFontSize+';"><input style = "text-align:center;border:0;font-weight:bold;font-size:'+defFontSize+';" value = "' + quart  +'" /><br/>' + category + ' - ' + categoryName  + '</td>';
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
		      sheet += '<td class = "tdData" style = "text-align:center; font-size:'+defFontSize+';">Balance Forwarded</td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "border-right:0;text-align:right;font-weight:bold;font-size:'+defFontSize+';">'  + numberWithCommas(subtotal.toFixed(2))  + '</td>';
		      
		      sheet += '</tr>';
		return sheet;
	}
	function totalA(label,total){
		if(label == 1){
			label = "Subtotal";
			var   sheet = '<table style = "width: 100%;"  >';
			sheet += '<tr >';
		
			sheet += '	<td  colspan = "2" style = "width:100px;padding-right:5px;text-align:right;font-weight:bold;"><span style = "padding-right:20px;">' + label + '</span>' + numberWithCommas(total.toFixed(2)) + '</td>';
			sheet += '</tr>	';
			sheet += '</table>';
		}else{
			label = "Total";
			var   sheet = '<table style = "width: 100%;"  >';
			sheet += '	<tr >';
			sheet += '	<td style = "font-size:12px;padding-left:5px;">' + convertWordCurrency(total.toFixed(2)) + ' ONLY' + '</td>'
			//sheet += '	<td style = "font-size:12px;padding-left:5px;">' + convertWordCurrency(9998298.10); + ' ONLY' + '</td>';
			sheet += '	<td style = "width:100px;padding-right:5px;text-align:right;font-weight:bold;"><span style = "padding-right:20px;">' + label + '</span>' + numberWithCommas(total.toFixed(2)) + '</td>';
			sheet += '</tr>	';
			sheet += '</table>';
		}
		
		return sheet;
	}
	var no = 1;
	function countPageLimit(){
		var limit = document.getElementsByClassName("pageLimit");
		for(var i = 0 ; i < limit.length; i++){
			limit[i].innerHTML = no-1;
		}
	}
	function certifiedBy(){
		
		// var sheet  = '<div class = "certifiedDiv"  ><table border="1" cellpadding="0" cellspacing="0" style = "width: 100%;height:100%;" >';
		// 	sheet += '<tr >';
		// 	sheet += '	<td style = "vertical-align:bottom;">';
		// 	sheet += '		<table border="1" cellpadding="0" cellspacing="0" style ="width:100%;"  >';
		// 	sheet += '		<tr>';
		// 	sheet += '			<td style = "text-align:right;font-size:13px;"> <div style = "font-size:13px;padding-right:25px;">Delivery Period <input class = "numDays" style = "font-weight:bold;text-align:center;font-size:16px;border:0;border-bottom:1px solid black;width:35px;padding:0px 3px;" value = "-"/>';
		// 	sheet += '			Days Upon Receipt of Approved PO</div>Page <span id = "pageNo">' + no + '</span> of <span class = "pageLimit" style = "padding-right:100px;"></span></td>';
		// 	sheet += '		</tr>';
		// 	sheet += '		</table >';
			
		// 	sheet += '       </td>';
		// 	sheet += '	<td style = "width:220px;padding-right:20px;verical-align:top;">';
		
		// 	sheet += '		<table border="1" cellpadding="0" cellspacing="0" style ="width:100%;" class = "tableSig" >';
		// 	sheet += '			<tr>';
		// 	sheet += '				<td style = "font-size:12px;">THIS IS TO CERTIFY that the items stated above are included in the PPMP of this Office.</td>';
		// 	sheet += '			</tr>';
		// 	sheet += '			<tr>';
		// 	sheet += '				<td style ="text-align:center;height:65px;vertical-align:bottom;"><input class = "certBy" value = "' + certBy + '" style = "font-size:11px;border:0px solid white;border-bottom:1px solid black;width:100%;text-align:center;font-weight:bold;" placeholder = "Type Name"/><input class = "certLabel" placeholder = "Type Position" value = "' + certDesignation + '"   style = "font-size:12px;border:0;width:100%;text-align:center;"/></td></td>';
		// 	sheet += '			</tr>';
		// 	sheet += '		</table>';
		
		// 	sheet += '	</td>';
		// 	sheet += '</tr>	';
		// 	sheet += '</table></div>';


		var sheet ='<div class="certifiedDiv" style="">'
				  +'	<table border="0" cellpadding="0" cellspacing="0" style="width:100%; height:100%; padding-bottom:5px;">'
				  +'		<tr>'
				  +'			<td style="vertical-align:bottom;">'
				  +'				<table border="0" cellpadding="0" cellspacing="0" style="float:right; font-size:12px; margin-bottom:8px; width:466px;">'
				  +'					<tr>'
				  +'						<td style="text-align:right; padding-right:10px; padding-bottom:14px;">'
				  +'							<span style="display:inline-block; width:230px; text-align:justify;">THIS IS TO CERTIFY that the items stated above are included in the PPMP of this Office.</span>'
				  +'						</td>'
				  +'						<td style="width:0px; vertical-align:bottom;">'
				  +'							<table border="0" style="border-spacing:0px">'
				  +'								<tr>'
				  +'									<td><input class = "certBy" value = "' + certBy + '" style = "font-size:11px; border:0px solid white; border-bottom:1px solid black; width:220px; text-align:center; font-weight:bold;" placeholder = "Type Name"/></td>'
				  +'								</tr>'
				  +'								<tr>'
				  +'									<td><input class = "certLabel" placeholder = "Type Position" value = "' + certDesignation + '"   style = "font-size:12px; border:0; width:220px; text-align:center;"/></td>'
				  +'								</tr>'
				  +'							</table>'
				  +'						</td>'
				  +'					</tr>'
				  +'				</table>'
				  +'				<table border="0" cellpadding="0" cellspacing="0" style="width:100%; font-size:12px;">'
				  +'					<tr>'
				  +'						<td style="width:0%; white-space:nowrap; padding-left:5px;">'
				  +'							Delivery Period <input class = "numDays" style = "font-weight:bold;text-align:center;font-size:16px;border:0;border-bottom:1px solid black;width:35px;padding:0px 3px;" value = "-"/> Days Upon Receipt of Approved PO'
				  +'						</td>'
				  +'						<td style="padding-left:60px;">'
				  +'							Page <span id = "pageNo">' + no + '</span> of <span class = "pageLimit" style = ""></span>'
				  +'						</td>'
				  +'					</tr>'
				  +'				</table>'
				  +'			</td>'
				  +'		</tr>'
				  +'	</table>'
				  +'</div>';
		no++;
		return sheet;
	}
	function comment(comment){
		
		var   sheet = '<div class = "certifiedDiv" >';
			sheet += '<div style = "padding:20px;background-color:orange;font-size:20px;font-weight:bold;">' + comment + '</div>';
			sheet += '</div>';
			
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
		      sheet += '<td class = "tdData" style = "white-space: pre-line; word-wrap: break-word ;font-size:'+defFontSize+';">' + text  +'</td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "border-right:0;text-align:right;font-weight:bold;"></td>';
		      sheet += '</tr>';
		return sheet;
	}
	
	function footer(){
		if(purpose == null){
			purpose = '&nbsp;';
		}
		var  tn = "<?php  echo $tn ?>";
		if(tn.substr(3,4)== "ONE1"){
			code = '';
			program = '';
		}
		
		var   sheet = '<div class = "footerDiv" ><table style = "width: 100%;height:100%;font-size:12px;border-spacing:0;"  >';
		
			 sheet += '<tr><td style = "vertical-align:bottom;padding:0;">';
			
			 sheet += '<table border = "0"  style = "width:100%;padding-bottom:0px;border-spacing:0;"><tr>';
			 sheet += '<td style="width:50px;font-size:12px;padding-left:5px;">Purpose</td>';
			 sheet += '<td style="font-size:12px;vertical-align:top;" rowspan = "2"  ><div class = "purpose" style  = "border-bottom:1px solid black;">' + purpose + '</div></td>';
			 sheet += '</tr>';
			 sheet += '<tr>';
			 sheet += '<td >&nbsp;</td>';
			
			 sheet += '</tr>';
			 sheet += '</table>';
				   
			 sheet += '<table style ="font-size:12px; border-spacing:0; margin:0 auto;width:100%;border-top:0;">';
			 sheet += '	<tr>';
			sheet += '		<td style = "border:2px solid black;border-left:0;"></td>';
			sheet += '		<td style = "width:250px;border-right:2px solid black;border-bottom:2px solid black;border-top:2px solid black;text-align:center;">Requested by:</td>';
			sheet += '		<td style= "border-right:2px solid black;border-bottom:2px solid black;text-align:center;border-top:2px solid black;">Cash availability</td>';
			sheet += '		<td style= "text-align:center;border-top:2px solid black;border-bottom:2px solid black;border-right:0;">Approved by:</td>';
			sheet += '	</tr>';
				
							
							
		  	 sheet += '	<tr>';
			 sheet += '		<td style = "border-bottom:0px solid black;border-right:2px solid black;width:80px;padding-left:10px;">';
			 sheet += '			<input value ="Signature" style = "font-family:Arial; font-size:10px;border:0;width:100%;"/>';
			 sheet += '			<input value ="Printed Name"  style = "border:0;font-family:Arial; font-size:10px;width:100%;"/>';
			 sheet += '			<input value ="Designation"  style = "border:0;font-family:Arial; font-size:10px;width:100%;"/>';
									
			
			
			 sheet += '			</br>';
			 sheet += '			</br>';
			 sheet += '			</br>';
			 sheet += '			</br>';
			
			 						
			 sheet += '		</td>';
			 sheet += '		<td style = "border-bottom:0px solid black;border-right:2px solid black;padding-top:55px;">';
									
			 sheet += '			<input  style = "font-family:Arial; font-size:10px;width:100%;border:0;text-align:center;"/>';
			 sheet += '			<input class = "head" value ="' + head + '" style = "font-family:Arial; font-size:10px;font-weight:bold;width:100%;border:0;text-align:center;"/>';
			 sheet += '			<input class = "headLabel"  value ="' + headDesignation + '"  style = "width:100%;border:0;text-align:center;font-family:Arial; font-size:11px;"/>';
			 sheet += '			</br>';
			 sheet += '			</br><span style = "font-size:10px;">&nbsp;Controlled/charged&nbsp;to:<span class="prFootCharges1" style = "font-weight:bold;">' + program + '</span></span>';
			 sheet += '			</br><span style = "font-size:10px;">&nbsp;Fund Acct. Code:<span class="prFootCharges2" style = "font-weight:bold;">' + code + '</span></span>';

			//  sheet += '			</br><span style = "font-size:10px;">&nbsp;Controlled/charged&nbsp;to:<input style="font-size:9px; font-weight:bold; padding:0px; width:155px; border:0px;" value="'+program+'"></span>';
			//  sheet += '			</br><span style = "font-size:10px;">&nbsp;Fund Acct. Code:<input style="font-size:9px; font-weight:bold; padding:0px; width:175px; border:0px;" value="'+code+'"></span>';

			 sheet += '			<input class = "controlled" value ="' + controlledBy + '" style = "font-family:Arial; font-size:10px;font-weight:bold;width:100%;border:0;text-align:center;margin-top:20px;"/>';
			 sheet += '			<input value ="Fund Controller"  style = "width:100%;border:0;text-align:center;font-family:Arial; font-size:10px;"/>';
									
									
									
			 sheet += '		</td>';
			 sheet += '		<td style = "border-bottom:0px solid black;border-right:2px solid black;">';
									
			 sheet += '			<input style = "font-family:Arial; font-size:10px;width:100%;border:0;text-align:center;"/>';
			 sheet += '			<input value ="LAWRENCE D. BANTIDING" style = "font-family:Arial; font-size:10px;font-weight:bold;width:100%;border:0;text-align:center;"/>';
			 sheet += '			<input value ="City Treasurer"  style = "width:100%;border:0;text-align:center;font-family:Arial; font-size:11px;"/>';
									
			 sheet += '			</br>';
			 sheet += '			</br>';
			 sheet += '			</br>';
			 sheet += '			</br>';

			 sheet += '		</td>';
			 sheet += '		<td style = "border-bottom:0px solid black;padding-top:15px;">';
									
			 sheet += '			<input  style = "font-family:Arial; font-size:10px;width:100%;border:0;text-align:center;"/>';
			 sheet += '			<input class = "approve" value ="' + approvedBy + '" style = "font-family:Arial; font-size:10px;font-weight:bold;width:100%;border:0;text-align:center;"/>';
			 sheet += '			<input class = "approveLabel" value ="' + approvedDesignation + '"  style = "width:100%;border:0;text-align:center;font-family:Arial; font-size:11px;"/>';
			
			
			 sheet += '			</br>';
			 sheet += '			</br>';
			 sheet += '			</br>';
			 sheet += '			</br>';
			 sheet += '			</br>';
									
									
			 sheet += '		</td>';
			 sheet += '	</tr>';
			 sheet += '</table>';		
		
			
			
			sheet += '</td></tr></table></div><div style = "width:750px;margin:0 auto;font-size:10px;">Original copy; Green copy for City Treasurer\'s Office; Blue copy for City Accounting Office; Pink copy for City General Services Office; White copy for the Requisitioning Dept.</div>';
		return sheet;
	}
	window.ondblclick = function() {
		show();
	}
	function show(){
	    editorSet();
	}
	function set(){
		/*var ad= document.getElementById("address").value;
		var place =  document.getElementById("placeDelivery").value;
		var date = document.getElementById("dateDelivery").value;
		var term = document.getElementById("deliveryTerm").value;
		var pay= document.getElementById("paymentTerm").value;
		var mod = document.getElementById("procurementMode").value;
		var head = document.getElementById("officeHead").value;
		var pos = document.getElementById("positionLabel").value;
		var modes = document.getElementsByClassName("tableHeader1");
		var length = modes.length;
		
		for(var i = 0 ; i < length; i++){
		    var parent = modes[i].children[0];
		    parent.children[2].children[1].innerHTML = ad;
		    parent.children[2].children[3].children[0].value = mod;
		}
		
		var tables = document.getElementsByClassName("tableHeader2");
		var length = tables.length;
		
		for(var i = 0 ; i < length; i++){
			var parent = tables[i].children[0];
		
			parent.children[0].children[1].innerHTML = place;
			parent.children[0].children[3].children[0].value = term;
			
			parent.children[1].children[3].children[0].value = pay;
			parent.children[1].children[1].children[0].value = date;
			
		}
		var signa = document.getElementsByClassName("tableSig");
		var length = signa.length;
		
		for(var i = 0 ; i < length; i++){
			var parent = signa[i].children[0];
			
			parent.children[1].children[0].children[0].value = head;
			parent.children[1].children[0].children[1].value = pos;
			
		}
		document.getElementById("editorX").click();
		*/
	}
	function setParam(){
		
		head = document.getElementById("officeHead").value;
		headDesignation = document.getElementById("headLabel").value;
		
		setCookie ("RequestedBy",head, 100);
		setCookie ("RequestedDesignation",headDesignation, 100);
		
		certBy = document.getElementById("certEdit").value;
		certDesignation = document.getElementById("certEditLabel").value;
		
		setCookie ("CertifiedBy",certBy, 100);
		setCookie ("CertifiedDesignation",certDesignation, 100);
		
		approvedBy = document.getElementById("approvedBy").value;
		approvedDesignation = document.getElementById("approvedDesignation").value;
		
		setCookie ("ApprovedBy",approvedBy, 100);
		setCookie ("ApprovedDesignation",approvedDesignation, 100);
		
		controlledBy = document.getElementById("controlledBy").value;
		setCookie ("ControlledBy",controlledBy, 100);
		
		
		purpose = document.getElementById("purpose").value;
		
		section = document.getElementById("section").value;
		numDays = document.getElementById("numDays").value;
		office = document.getElementById("ofis").value;

		prgCodesFoot = document.getElementById("chargedToFoot").value;
		actCodesFoot = document.getElementById("fundAcctCodeFoot").value;
		
		var pageC  = document.getElementsByClassName("certBy");
		var pageCD  = document.getElementsByClassName("certLabel");
		
		var pageH  = document.getElementsByClassName("head");
		var pageHD  = document.getElementsByClassName("headLabel");
		
		var pageA  = document.getElementsByClassName("approve");
		var pageAD  = document.getElementsByClassName("approveLabel");
		
		var pageCtrl  = document.getElementsByClassName("controlled");
		var pageP  = document.getElementsByClassName("purpose");
		var pageS = document.getElementsByClassName("section");
		var pageN = document.getElementsByClassName("numDays");
		var pageO = document.getElementsByClassName("office");
		
		var footPRGs = document.getElementsByClassName("prFootCharges1");
		var footACTs = document.getElementsByClassName("prFootCharges2");
		
		
		var length = pageH.length; 
		for(var i = 0 ; i < length; i++){
			pageC[i].value = certBy;
			pageCD[i].value = certDesignation;
			
			pageH[i].value = head;
			pageHD[i].value = headDesignation;
			
			pageA[i].value = approvedBy;
			pageAD[i].value = approvedDesignation;
			
			pageCtrl[i].value = controlledBy;
			
			pageP[i].textContent = purpose;
			pageS[i].innerHTML = section;
			pageN[i].value = numDays;
			
			pageO[i].innerHTML = office;

			footPRGs[i].innerHTML = prgCodesFoot;
			footACTs[i].innerHTML = actCodesFoot;

		}		
		document.getElementById("editorX").click();

		var formData = new FormData();
		var  tn = "<?php  echo $tn ?>";

		var queryString = "?savePrPurpose&tn="+tn+"&purpose="+purpose;
		var container = "";

		ajaxGetAndConcatenate(queryString, processorLink, container, "savePrPurpose");
	}

	//editorSet();
	function editorSet(){
		
		var d1 = 1;
		var r1 = 1;
		var  r2 = 1;
		var p1 = 1;
		// var  sheet = "<div class = 'editorContainer'><table border ='0' style = 'padding-bottom:20px;width:450px;' >";
		//        sheet += "<tr><td class = 'editorHeader' colspan = '2' >PR Form Settings<div  id  = 'editorX'onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>";
		//        sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:0px solid silver;margin:10px; 0px;'></div></td>";
		       
		//        sheet += '<tr><td style = "padding-left:10px;">Department</td><td style = "padding-right:10px;"><input class = "text3"   id = "ofis"  style = "text-align:center;width:100%;text-align:left;" value = "' + ofis +'"/></td></tr>';
		       
		//        sheet += "<tr><td style = 'padding-left:10px;width:145px;'>Section</td><td style = 'padding-right:10px;'><input  id = 'section' class = 'text3'  style = 'text-align:center;width:100%;text-align:left;' value = ''/></td></tr>";
		//        sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:0px solid silver;margin:10px; 0px;'></div></td>";
		      
		//        sheet += "<tr><td style = 'padding-left:10px;width:145px;'>No. of days</td><td style = 'padding-right:10px;'><input  id = 'numDays' class = 'text3'  style = 'text-align:center;width:100%;text-align:left;' value = ''/></td></tr>";
		//        sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";
		//        sheet += "<tr><td style = 'padding-left:10px;text-align:right;vertical-align:top;padding-right:10px;'>Purpose</td><td style = 'padding-right:10px;'><textarea  id = 'purpose' maxlength='114' class = 'text3' style = 'width:100%'>"+purpose+"</textarea></td></tr>";
		//        sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";
		     
		//        sheet += "<tr><td style = 'padding-right:10px;text-align:right;'>Certified By</td><td style = 'padding-right:10px;'><input class = 'text3'   id = 'certEdit'  style = 'text-align:center;width:100%;'  value = '" + certBy + "'  /></td></tr>";
		//        sheet += "<tr><td style = 'padding-right:10px;text-align:right;'>Designation</td><td style = 'padding-right:10px;'><input class = 'text3'  id = 'certEditLabel'  style = 'text-align:center;width:100%;font-weight:normal;' value = '" + certDesignation + "'  /></td></tr>";
		//          sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";
		       
		//        sheet += "<tr><td style = 'padding-right:10px;text-align:right;'>Requested By</td><td style = 'padding-right:10px;'><input class = 'text3'   id = 'officeHead'  style = 'text-align:center;width:100%;'  value = '" + head + "'  /></td></tr>";
		//        sheet += "<tr><td style = 'padding-right:10px;text-align:right;'>Designation</td><td style = 'padding-right:10px;'><input class = 'text3'  id = 'headLabel'  style = 'text-align:center;width:100%;font-weight:normal;' value = '" + headDesignation + "'  /></td></tr>";
		//         sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";
		      
		//        sheet += "<tr><td style = 'padding-right:10px;text-align:right;'>Approved By</td><td style = 'padding-right:10px;'><input class = 'text3'   id = 'approvedBy'  style = 'text-align:center;width:100%;'  value = '" + approvedBy + "'  /></td></tr>";
		//        sheet += "<tr><td style = 'padding-right:10px;text-align:right;'>Designation</td><td style = 'padding-right:10px;'><input class = 'text3'  id = 'approvedDesignation'  style = 'text-align:center;width:100%;font-weight:normal;' value = '" + approvedDesignation + "'  /></td></tr>";
		//         sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";
		     
		//        sheet += "<tr><td style = 'padding-right:10px;text-align:right;'>Controlled By</td><td style = 'padding-right:10px;'><input class = 'text3'  id = 'controlledBy'  style = 'text-align:center;width:100%;' value = '" + controlledBy + "'  /></td></tr>";
		     
		//        sheet += "<tr><td colspan = '2' style = 'text-align:center;padding:20px 0px;padding-bottom:0px;'><div  id = '1' class='button1 label19' style='margin:0 auto;width:75px;text-shadow:0px 0px 1px GREY; padding:5px 10px;font-weight:bold;color:white;letter-spacing:1px;font-size:14px;background-color:rgb(18, 184, 240);cursor:pointer; ' onclick= 'setParam()'>Set</div></td></tr>";
		     
		//        sheet += "</table></div>";

		var prgCode = document.getElementsByClassName('prFootCharges1')[0].textContent.trim();
		var actCode = document.getElementsByClassName('prFootCharges2')[0].textContent.trim();

		var sheet ="<div class = 'editorContainer'>"
				  +"	<table border='0' style = 'border-spacing:0px; padding-bottom:20px; font-family:Arial; font-size:14px;' >"
				  +"		<tr>"
				  +"			<td class = 'editorHeader' colspan = '2'  style='font-size:16px;'>PR Form Settings<div  id  = 'editorX'onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan = '2' ><div style = 'border-bottom:0px solid silver; margin:3px 0px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Department</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input class = 'text3'   id = 'ofis'  style = 'text-align:center; text-align:left;' value = '"+ ofis +"'/></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Section</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input  id = 'section' class = 'text3'  style = 'text-align:center; text-align:left;' value = ''/></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>No. of days</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input  id = 'numDays' class = 'text3'  style = 'text-align:center; text-align:left;' value = ''/></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan = '2' ><div style = 'border-bottom:1px solid silver; margin:4px 0px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'text-align:right;vertical-align:top;padding-right:10px;'>Purpose</td>"
				  +"			<td style = 'padding-right:5px;'><textarea  id = 'purpose' maxlength='114' class = 'text3' style = ''>"+purpose+"</textarea></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan = '2' ><div style = 'border-bottom:1px solid silver; margin:4px 0px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Certified By</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input class = 'text3'   id = 'certEdit'  style = 'text-align:center;'  value = '" + certBy + "'  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Designation</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input class = 'text3'  id = 'certEditLabel'  style = 'text-align:center;font-weight:normal;' value = '" + certDesignation + "'  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan = '2' ><div style = 'border-bottom:1px solid silver; margin:4px 0px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Requested By</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input class = 'text3'   id = 'officeHead'  style = 'text-align:center;'  value = '" + head + "'  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Designation</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input class = 'text3'  id = 'headLabel'  style = 'text-align:center;font-weight:normal;' value = '" + headDesignation + "'  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan = '2' ><div style = 'border-bottom:1px solid silver; margin:4px 0px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Approved By</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input class = 'text3'   id = 'approvedBy'  style = 'text-align:center;'  value = '" + approvedBy + "'  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Designation</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input class = 'text3'  id = 'approvedDesignation'  style = 'text-align:center;font-weight:normal;' value = '" + approvedDesignation + "'  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan = '2' ><div style = 'border-bottom:1px solid silver; margin:4px 0px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px;text-align:right;'>Controlled By</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input class = 'text3'  id = 'controlledBy'  style = 'text-align:center;' value = '" + controlledBy + "'  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan = '2' ><div style = 'border-bottom:1px solid silver; margin:4px 0px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px;text-align:right;'>Controlled/charged to</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input class = 'text3'  id = 'chargedToFoot'  style = '' value = '"+prgCode+"' /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px;text-align:right;'>Fund Acct. Code</td>"
				  +"			<td style = 'padding-right:5px; padding-top:3px;'><input class = 'text3'  id = 'fundAcctCodeFoot'  style = '' value = '"+actCode+"' /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style='vertical-align:bottom; font-size:0px; padding-left:10px;'>"
				  +"				<div style='font-size:12px; display:inline-block;'>Change font size</div>"
				  +"				<button class='btnToggleFontSize' onclick='changeFontSize(\"tdData\", -2)'>-</button>"
				  +"				<button class='btnToggleFontSize' onclick='changeFontSize(\"tdData\", 2)'>+</button>"
				  +"			</td>"
				  +"			<td style = 'padding:20px 0px; padding-bottom:0px; text-align:center;'>"
				  +"				<div  id = '1' style='display:inline-block; width:75px; padding:5px 8px; font-size:14px; cursor:pointer; border:1px solid silver;' onclick= 'setParam()'>Set</div>"
				  +"			</td>"
				  +"		</tr>"
				  +"	</table>"
				  +"</div>";
		
		
		theAbsolute(sheet);
	}
	
	function changeFontSize(elemClass, sizeChange) {
		var curFontSize = readCookie('prDefFontSize');
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
			setCookie("prDefFontSize", newFontSize, 1);
		}else {
			fontSize = parseInt(curFontSize);
			newFontSize = fontSize + sizeChange;
			setCookie("prDefFontSize", newFontSize, 1);
		}

		location.reload();
	}
	
</script>