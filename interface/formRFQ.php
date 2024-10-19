<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	
	require_once('../javascript/ajaxFunction.php');
	$tn = $_GET['tn'];

	if(isset($_COOKIE['RFQhead'])){
		$head = $_COOKIE['RFQhead'];
		$headDesignation = $_COOKIE['RFQdesignation'];	
	}else{
		$head = 'h';
		$headDesignation = 'h';
	}
	if(isset($_COOKIE['RFQdesignation'])){
		$headDesignation = $_COOKIE['RFQdesignation'];	
	}else{
		$headDesignation = '';
	}
	
	if(isset($_COOKIE['RFQoffice'])){
		$office = $_COOKIE['RFQoffice'];
	}else{
		$office = '';
	}

	if(isset($_COOKIE['rfqDefFontSize'])){
		$defFontSize = $_COOKIE['rfqDefFontSize'].'px';
	}else{
		$defFontSize = '14px';
	}
?>
<style>
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
		height:700px;width: 750px;overflow: auto;margin:0 auto;
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
		width: 750px;margin:0 auto;
		border:2px solid black;
	
		border-top: 0px;
		
	}
	.footerDiv{
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
		font-size: 14px;
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
	.abcInput{
		text-align: center;
		font-weight: bold;
	}
</style>

<link rel="icon" href="/citydoc2017/images/red.png"/> 
<title>RFQ Form</title>
<style type="text/css">
	.rfqCol{
		border: 1px solid green;
	}
	.rfqRow{
		display: flex;
		/*border: 1px solid red;*/
		/*font-family: Calibri;*/
	}
	.rfqTd{
		/*border: 1px solid blue;*/
		flex: 1;
	}
	.rfqTd1{
		flex: 1;
		border-top: 1px solid black;
		border-left: 1px solid black;
		border-bottom: 1px solid black;
	}
	.rfqTd2{
		flex: 1;
		border-left: 1px solid black;
		/*border-bottom: 1px solid black;*/
	}
	.blnkInput{
		border: 0px;
		border-bottom: 2px solid black;
		min-width:180px;
	}
	.blnkInput1{
		border: 0px;
		/*border: 1px solid red;*/
		width: 200px;
		text-align: center;
		font-family: Times new roman;
	}
	.blnkInput2{
		border: 0px;
		border-bottom: 2px solid black;
	}
	/*table, th, td {
	    border: 1px solid black;
	    padding: 0px;
	    margin: 0px;
	}*/
	.rfqCell{
		border: 1px solid black;
	}
	.blnkDEP{
		border: 0px;
		text-transform: uppercase;
		text-align: center;
		width: 220px;
		font-weight: bold;
		font-size: 14px;
		font-family: Times new roman;
	}
	.divContent{
		border: 0px;
	}
	.certifiedDiv{
		margin-bottom: 20px;
	}
	.delPeriod, .delPeriod1{
		text-align: center;
		font-weight: bold;
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
<div id  = "poMain" style = "">
	<div  class = "divContent" style = "">
		<table class = "tableContent">
			<tr id  = "trFirst">
				
			</tr>	
			<tr >
				<!-- <td class = "tdHeader" style  ="width:10px;padding:0px 5px; border-left: 1px solid black;">No.</td> -->
				<td class = "tdHeader"  style  ="width:10px;padding:0px 5px; border-left: 1px solid black;">Unit</td>
				<td class = "tdHeader"  style  ="width:10px;padding:0px 5px;">Qty</td>
				<td class = "tdHeader">Description</td>
				<td class = "tdHeader" style  ="width:90px;padding:0px 5px;">Unit&nbsp;Cost</td>
				<td class = "tdHeader"  style  ="width:100px;padding:0px 5px;border-right: 1px solid black;">Amount</td>
			</tr>
			<tr id  = "trThird" style="font-size: 12px;">
				<td colspan="6"></td>
			</tr>	
		</table>
	</div>
</div>

<script>
	var year = 2023;
	var head = "<?php echo $head; ?>";
	var headDesignation = "<?php echo $headDesignation; ?>";
	
	var office = "<?php echo $office; ?>";
	var ckOffice = "<?php echo $office; ?>";

	
	var defFontSize = "<?php echo $defFontSize; ?>";
	
	var ofis; 
	var PRnum;
	viewPO();
	function viewPO(){
		var  tn = "<?php  echo $tn ?>";
		
		var container = document.getElementById("poMain");
		var queryString = "?fetchPODetails&tn=" +  tn ;
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchPODetails");			
	}
	var code;
	var program; 
	var delPeriod = "";
	var totalAll;
	function createSheet(details){
		var txt = '';
		var j = JSON.parse(details);
		var len =  j.desc.length;
		var tn =  j.trackingNumber;
		var office =  j.office;
		// ofis = office;
		ofis = ckOffice;
		
		var officeC =  j.officeCode;
		var supplier =  j.supplier;
		var prNumber =  j.prNumber;
		PRnum = prNumber;
		
		var category =  j.catCode;
		var categoryName =  j.catName;
		var quart =  j.qua;

		var terms =  j.terms;
		
		program =  j.programs;
		
		code =  j.codes;
		
		document.getElementById("trFirst").innerHTML = header(office,supplier,prNumber,tn);
		// console.log(header(office,supplier,prNumber,tn));
		document.getElementById("trThird").innerHTML = quarter(quart,category,categoryName);
		var c = poMain.children.length;	
		
		var div = poMain.children[c-1];
		div.style.borderBottom = "0";
		var table = div.children[0];
		var tableBody = div.children[0].children[0];
		// console.log(div.scrollHeight+" <=> "+ div.offsetHeight);
		var on = 0;
		var subTotal = 0;
		
		
		for(var i = 0; i < len; i++){
			
			if(div.scrollHeight > div.offsetHeight){
						var cLen = (tableBody.children.length - 1);
						var lastChild = tableBody.children[cLen];
						var desc = lastChild.children[2].textContent.trim();
						var newLine = desc.split("\n");
						var lenLine = newLine.length-1;
						if (lenLine > 2){

							var td = lastChild.children[2];
							lastChild.children[0].style.borderBottom = "1px solid black";
							lastChild.children[1].style.borderBottom = "1px solid black";
							lastChild.children[2].style.borderBottom = "1px solid black";
							lastChild.children[3].style.borderBottom = "1px solid black";
							lastChild.children[4].style.borderBottom = "1px solid black";
							
							
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
						}else{

							tableBody.removeChild(lastChild); 
							var lastAmount = lastChild.children[4].textContent.replace(/,/g,"");
							//subTotal = subTotal - lastAmount;
							subTotal = subTotal - parseFloat(j.total[i-1].replace(/,/g,""));
							
							// tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:0px solid black;">' +  totalA(1,subTotal) + '<td></tr>';
							tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;">' +  totalA(1,subTotal) + '<td></tr>';
							tempStr1 = '';
							i  = i - 2;
							//console.log(lastChild.innerHTML);
						}
						inspectScrollerLast(div,poMain);
						// poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn) +  '<tr><td class = "tdHeader" style="border-left: 1px solid black;">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit Cost</td><td class = "tdHeader" style = "border-right: 1px solid black;">Amount</td></tr>'  + quarter(quart,category,categoryName)  + forwarded(subTotal) + halfText(tempStr1) +'</table></div>';
						poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn) +  '<tr><td class = "tdHeader" style="border-left: 1px solid black;">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit Cost</td><td class = "tdHeader" style = "border-right: 1px solid black;">Amount</td></tr>'  + quarter(quart,category,categoryName)  + forwarded(subTotal) + halfText(tempStr1) +'</table></div>';
						if(i == len-1){
							var c = poMain.children.length;
							var div = poMain.children[c-1];
							var table = div.children[0];
							var tableBody = div.children[0].children[0];
							// tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
							tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
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

				if(i == len-1){
					if(terms != null && terms.length > 0) {
					// if(terms.length > 0) {
						// desc += '\n\nTERMS AND CONDITIONS\n'+terms;
						desc += '\n\n'+terms;
					}
				}

				var descX = desc.match(/\n/g);
				var descX = desc.split("\n");
			    
			 	// tableBody.innerHTML +="<tr><td  class = 'tdData' style = 'text-align:center; border-left: 1px solid black;'>" +  num + "</td><td class = 'tdData' >" + j.unit[i] +"</td><td class = 'tdData' style = 'text-align:center;' >" +qty+"</td><td class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word;'>" + desc + "</td><td class = 'tdData' style = 'text-align:right;padding-right:5px;'>" +j.cost[i] +"</td><td class = 'tdData'  style = 'text-align:right; border-right: 1px solid black;'>" +  j.total[i] + "</td></tr>";
			 	tableBody.innerHTML +="<tr><td class = 'tdData' style=' border-left: 1px solid black;border-bottom: 1px solid silver; font-size:"+defFontSize+";'>" + j.unit[i] +"</td><td class = 'tdData' style = 'text-align:center;border-bottom: 1px solid silver; font-size:"+defFontSize+";' >" +qty+"</td><td class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word;border-bottom: 1px solid silver; font-size:"+defFontSize+";'>" + desc + "</td><td class = 'tdData' style = 'text-align:right;padding-right:5px;border-bottom: 1px solid silver; font-size:"+defFontSize+";'>" +"</td><td class = 'tdData'  style = 'text-align:right; border-right: 1px solid black;border-bottom: 1px solid silver; font-size:"+defFontSize+";'>" + "</td></tr>";
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
								// tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:0px solid black;">' +  totalA(1,subTotal) + '</td></tr>'; // last div na gi byaan
								tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;">' +  totalA(1,subTotal) + '</td></tr>'; // last div na gi byaan
								var limit = divTrim(div);
								poMain.innerHTML += certifiedBy();
								certTrim(limit);
								poMain.innerHTML += footer();
								
								createNewPage(poMain,div,office,supplier,prNumber,tn, forwarded(subTotal),quart,category,categoryName,subTotal);
								subTotal = parseFloat(subTotal) + parseFloat(total);
								//subTotal = subTotal - lastAmount;
								var c = poMain.children.length;
								var div = poMain.children[c-1];
								var table = div.children[0];
								var tableBody = div.children[0].children[0];
								// tableBody.innerHTML +="<tr><td  class = 'tdData' style = 'text-align:center;' >" +  num + "</td><td class = 'tdData' >" + j.unit[i] +"</td><td class = 'tdData' style = 'text-align:center;' >" +qty+"</td><td class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word;'>" + desc + "</td><td class = 'tdData' style = 'text-align:right;padding-right:5px;'>" +j.cost[i] +"</td><td class = 'tdData'  style = 'text-align:right;border-right:0;'>" +  j.total[i] + "</td></tr>";
								tableBody.innerHTML +="<tr><td class = 'tdData' style=' border-left: 1px solid black;border-bottom: 1px solid silver; font-size:"+defFontSize+";'>" + j.unit[i] +"</td><td class = 'tdData' style = 'text-align:center;border-bottom: 1px solid silver; font-size:"+defFontSize+";' >" +qty+"</td><td class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word;border-bottom: 1px solid silver; font-size:"+defFontSize+";'>" + desc + "</td><td class = 'tdData' style = 'text-align:right;padding-right:5px;border-bottom: 1px solid silver; font-size:"+defFontSize+";'>" +"</td><td class = 'tdData'  style = 'text-align:right;border-right: 1px solid black;border-bottom: 1px solid silver; font-size:"+defFontSize+";'>" + "</td></tr>";
							}else if(tempStr1 == -1){
								
								poMain.innerHTML += comment("Please do not create a very long sentence. Press enter at the end of the paragraph.");
								end; 
							
							}else{
								
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
						
						// tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
						tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
						// if mulapas pag butang sa total then increase div decrease certificate

						 inspectScrollerLast(div,poMain);
					}else{
						//createNewPage(poMain,div,office,supplier,prNumber,tn, forwarded(subTotal),quart,category,categoryName,subTotal);
						
						// tableBody.innerHTML += '<tr><td colspan = "7" style = "border-top:1px solid black;border-bottom:1px solid black;">' + totalA(0,subTotal)  + '</></tr>';
						tableBody.innerHTML += '<tr><td colspan = "7" style = "border-top:1px solid black;">' + totalA(0,subTotal)  + '</></tr>';
						// if mulapas pag butang sa total then increase div decrease certificate

						 inspectScrollerLast(div,poMain);
					}
				}
			}
		}
		totalAll = subTotal;
		var abcIn = document.getElementsByClassName('abcInput');
		[].forEach.call(abcIn, function(e){
			e.value = numberWithCommas(totalAll.toFixed(2));
		});
		countPageLimit();
	}
	function  inspectScrollerLast(div,poMain){
		
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
		// console.log(div.scrollHeight+" - "+div.offsetHeight+" = "+(div.scrollHeight-div.offsetHeight));
		div.style.height = div.offsetHeight + ((div.scrollHeight-div.offsetHeight)-15) + "px";
		// j=0;
		// var h = div.offsetHeight;
		// while(div.scrollHeight + 1 >= div.offsetHeight){
		// 	div.style.height = (h + j)+ "px"; 	
		// 	j = j + 1;
		// }
		
		// return j;
	}
	function certTrim(limit){
		var length = poMain.children.length-1;
		var cert = poMain.children[length];
		var h = cert.offsetHeight;
		cert.style.height = (h - limit)+ "px"; 	
	}
	function inspectScrollerDescriptionAndDivide(tableBody,div){
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
		// poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn) +  '<tr><td class = "tdHeader">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit Cost</td><td class = "tdHeader" style = "border-right:0;">Amount</td></tr>'  +  quarter(quart,category,categoryName) + halfText(tempStr1)  +'</table></div>';
		poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn) +  '<tr><td class = "tdHeader" style="border-left: 1px solid black;">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit&nbsp;Cost</td><td class = "tdHeader" style = "border-right:1px solid black;">Amount</td></tr>'  +  quarter(quart,category,categoryName) + halfText(tempStr1)  +'</table></div>';
		var c = poMain.children.length;
		var div = poMain.children[c-1];
		var table = div.children[0];
		var tableBody = div.children[0].children[0];
	}
	function  header(office,supplier,prNumber,tn){
		if (prNumber == null) {
			prNumber = "";
		}
		var headDesignation1 = "Head of Requesting Office";

		if (headDesignation != "") {
			headDesignation1 = headDesignation;
		}
		var sheet = "";

		var office = tn.substr(3,4);
		var show = "";
		if(office == 'COA1') {
			show = 'display:none;';
		}

		sheet += "<tr><td colspan='12'><div><table style='width: 100%;'>"
				+"	<tr>"
				+"		<td style='text-align: center; padding: 0px 30px; padding-top: 10px;' colspan=''><img src='../images/davaologo.png' style='width: 100px; height: 100px;'></td>"
				+"		<td style='text-align: center; padding: 0px 70px;' colspan=''>"
				+"			<span style='font-weight: bold; font-weight: 16px;'>REPUBLIC OF THE PHILIPPINES</span> <br />"	
				+"			City Government of Davao <br />"
				+"			<span style='font-weight: normal; font-size: 20px; white-space:nowrap;'>REQUEST FOR QUOTATION </span>"
				+"		</td>"
				+"		<td style='text-align:right; white-space:nowrap;' colspan=''>TN: "
				+"			<span style='font-size:22px; font-family:impact;letter-spacing:2px;'>"+tn+"</span><br/>"
				+"			<span style='font-size:12px;font-weight: normal; padding-right: 3px;'>DocTrack <span style='font-weight: bold; font-size: 16px;'>" + year + "</span></span>"
				+"		</td>"
				+"	</tr>"
				+"</table></div>"
				+"	<div><table border='0' style='width: 100%;'>"
				+"		<tr>"
				+"			<td colspan='3' style=''>"
				+"				<input type='text' class='blnkInput'><br>"
				+"				<input type='text' class='blnkInput'>"
				+"			</td>"
				+"			<td colspan='6' style='width: 300px;'>"
				+"			</td>"
				+"			<td colspan='3' style='text-align: right;'>"
				+"				<table border='0' style='font-size: 12px; border-spacing:0px;'>"
				+"					<tr>"
				+"						<td style='text-align:right; white-space:nowrap;'>Date:</td>"
				+"						<td><input type='text' class='blnkInput' style='text-align: center; font-weight: bold;'></td>"
				+"					</tr>"
				+"					<tr>"
				+"						<td style='text-align:right; white-space:nowrap;'>Purchase Quotation No.:</td>"
				+"						<td><input type='text' class='blnkInput' style='text-align: center; font-weight: bold;'></td>"
				+"					</tr>"
				+"					<tr>"
				+"						<td style='text-align:right; white-space:nowrap;'>PR No.:</td>"
				+"						<td><input type='text' class='blnkInput' value='"+prNumber+"' style='text-align: center; font-weight: bold;'></td>"
				+"					</tr>"
				+"				</table>"
				+"			</td>"
				+"		</tr>"
				+"	</table></div>"
				+"	<div><table style='width: 100%;'>"
				+"		<tr>"
				+"			<td colspan='3' style='font-size: 12px;'>"
				+"SIR/MADAM:"
				+"<div style='text-indent: 50px;'>"
				+"	Please quote your lowest price on the item listed below, subject to the General Conditions indicated"
				+"	therein and submit your quotation duly signed by your representative in sealed envelope direct to the BAC"
				+"	Secretariat in charge of RFQ or thru the authorized canvasser of this Department not later than"
				+"	<input type='text' name='' class='blnkInput' style='width: 150px;'> the time and date of the opening of the sealed quotation."
				+"</div>"
				+"<div style='text-indent: 50px;'>"
				+"	This office shall reserve the right to reject any or all proposals/price quotations, if there are defects"
				+"	therein, accepts the offer most advantageous to the government, and assumes no responsibility whatsoever" 
				+"	to compensate or indemnify bidders for any expenses incurred in the preparation to bid."
				+"</div>"
				+"			</td>"
				+"		</tr>"
				+"	</table></div>"
				+"	<div><table border='0' style='width: 100%; padding-top: 30px; border-spacing:0px;'>"
				+"		<tr>"
				+"			<td style='width:90%;'>"
				+"			</td>"
				+"			<td style='font-size: 12px; width:0%;'>"
				+"				<table border='0' style='border-spacing:0px; font-size:12px; white-space:nowrap; "+show+"'>"
				+"					<tr>"
				+"						<td style='font-size: 12px; padding:0px 3px; border-bottom: 1px solid silver; text-align:center; min-width:200px;'>"
				+"							<span class='head' style='font-weight: bold; text-transform: uppercase;'>"+head+"</span>, <span class='headLabel' style='font-size:11px;'>"+headDesignation1+"</span>"
				+"						</td>"
				+"					</tr>"
				+"					<tr>"
				+"						<td class='office' style='text-align: center; font-size:11px;'>"+ofis+"</td>"
				+"					</tr>"
				+"				</table>"
				+"			</td>"
				+"		</tr>"
				+"	</table></div>"
				+"</td></tr>"
				;
		return sheet;
	}
	function quarter(quart,category,categoryName){
		var  sheet = '<tr>';
		      // sheet += '<td class = "tdData" style="border-left: 1px solid black;"></td>';
		      sheet += '<td class = "tdData" style="border-left: 1px solid black;"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "text-align:center; font-weight:bold; padding:8px 0px; font-size:'+defFontSize+';"><input style = "text-align:center;border:0;font-weight:bold; font-family: times; font-size:'+defFontSize+';" value = "' + quart  + '" /><br/>' + category + ' - ' + categoryName  + '</td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "border-right: 1px solid black;text-align:right;font-weight:bold; font-size:'+defFontSize+';"></td>';
		      sheet += '</tr>';
		return sheet;
	}
	function forwarded(subtotal){
		// var  sheet = '<tr>';
		//       sheet += '<td class = "tdData"></td>';
		//       sheet += '<td class = "tdData"></td>';
		//       sheet += '<td class = "tdData"></td>';
		//       sheet += '<td class = "tdData" style = "text-align:center;">Balance Forwarded</td>';
		//       sheet += '<td class = "tdData"></td>';
		//       sheet += '<td class = "tdData" style = "border-right:0;text-align:right;font-weight:bold;">'  + numberWithCommas(subtotal.toFixed(2))  + '</td>';
		      
		//       sheet += '</tr>';
		var sheet = "";
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

			var sheet1 = "<table style='width: 100%;'>"
						+"	<tr>"
						+"		<td style='font-size: 12px;'>"
						+"			Delivery Period <input type='text' name='' class='blnkInput' style='width: 30px;'> Days Upon Receipt of Approved PO"
						+"		</td>"
						+"		<td style='font-size: 12px;'>"
						+"			Approved Budget for the Contract: <input type='text' name='' class='blnkInput' style=''>"
						+"		</td>"
						+"		<td style='font-size: 12px;'>"
						+"			Page <span id='pageNo'>"+no+"</span> of <span class='pageLimit'></span>"
						+"		</td>"
						+"	</tr>"
						+"</table>";
		}else{
			label = "Total";
			var   sheet = '<table style = "width: 100%;"  >';
			sheet += '	<tr >';
			sheet += '	<td style = "font-size:12px;padding-left:5px;">' + convertWordCurrency(total.toFixed(2)) + ' ONLY' + '</td>'
			//sheet += '	<td style = "font-size:12px;padding-left:5px;">' + convertWordCurrency(9998298.10); + ' ONLY' + '</td>';
			sheet += '	<td style = "width:100px;padding-right:5px;text-align:right;font-weight:bold;"><span style = "padding-right:20px;">' + label + '</span>' + numberWithCommas(total.toFixed(2)) + '</td>';
			sheet += '</tr>	';
			sheet += '</table>';

			var sheet1 = "<table style='width: 100%;'>"
						+"	<tr>"
						+"		<td style='font-size: 12px;'>"
						+"			Delivery Period <input type='text' name='' class='blnkInput' style='width: 30px;'> Days Upon Receipt of Approved PO"
						+"		</td>"
						+"		<td style='font-size: 12px;'>"
						+"			Approved Budget for the Contract: <input type='text' name='' class='blnkInput' style=''>"
						+"		</td>"
						+"		<td style='font-size: 12px;'>"
						+"			Page <span id='pageNo'>"+no+"</span> of <span class='pageLimit'></span>"
						+"		</td>"
						+"	</tr>"
						+"</table>";
		}
		
		return "";
	}
	var no = 1;
	function countPageLimit(){
		var limit = document.getElementsByClassName("pageLimit");
		for(var i = 0 ; i < limit.length; i++){
			limit[i].innerHTML = no-1;
			// alert(i);
		}
	}
	function certifiedBy(){
		var sheet =  "<div class='footerDiv' style='border: 0px;'>"
					+"	<table border='0' style='border-spacing:0px; width: 100%;'>"
					+"		<tr style=''>"
					+"		<td style='font-size: 12px; white-space:nowrap;'>"
					+"			<span style='margin-right: 10px;'>Delivery Period <input type='text' name='' value='"+delPeriod+"' class='blnkInput2 delPeriod' style='width: 60px;'> Days Upon Receipt of Approved PO</span>"
					+"			<span style='margin-right: 0px;'>Approved Budget for the Contract: <input type='text' name='' class='blnkInput2 abcInput' style='width: 120px;'></span>"
					+"		</td>"
					+"		<td style='font-size: 12px; white-space:nowrap;'>"
					+"			<span style='float: right;'>Page <span id='pageNo'>"+no+"</span> of <span class='pageLimit'></span></span>"
					+"		</td>"
					+"		</tr>"
					+"		<tr>"
					+"			<td colspan='2' style='font-size:12px;'>"
					+"			General Conditions"
					+"			<ol style='margin-top: -1px; margin-bottom: 0px;'>"
					+"				<li>"
					+"				All entries must be legibly written."
					+"				</li>"
					+"				<li>"
					+"				Bidders must indicate only one quote per item, multiple quotations are grounds for"
					+"				disqualification from participating in the procurement at hand."
					+"				</li>"
					+"				<li>"
					+"				Quoted prices must be inclusive of taxes and other charges of fees and shall not" 
					+"				exceed the Approved Budget for the Contract (ABC)."
					+"				</li>"
					+"				<li>"
					+"				Bidders must indicate BRAND/MODEL of items offered whenever applicable."
					+"				</li>"
					+"				<li>"
					+"				Bidders must indicate warrantist and other term and condition when application."
					+"				</li>"
					+"			</ol>"
					+"			</td>"
					+"		</tr>"
					+"		<tr>"
					+"			<td colspan='2' style='text-indent: 50px; font-size: 12px;'>"
					+"				After having carefully read and accepted your General Conditions, I/We quote you on the item at prices" 
					+"				noted above and bind ourselves to deliver the above articles/merchandise within" 
					+"				<input type='text' name='' value='"+delPeriod+"' class='blnkInput delPeriod1' style='width: 100px;'> working days from the receipt of your" 
					+"				Approved Purchase Order."
					+"			</td>"
					+"		</tr>"
					+"		<tr>"
					+"			<td colspan='2' style=''>"
					+"				<table style='width: 100%; font-size: 12px;'>"
					+"					<tr>"
					+"					<td style='text-align: center; padding-left: 0px;'>"
					+"						<div>Canvassed By :<input type='text' name='' class='blnkInput' style='width: 220px;border-bottom:1px solid grey;'></div>"
					+"						<div style='text-align:right;padding-right:90px;'>Print Name/Signature</div>"
					+"					</td>"
					+"					<td style='text-align: right;'>"
					+"						<div>"
					+"							Supplier: <input type='text' class='blnkInput' style='width: 300px;'>"
					+"						</div>"
					+"						<div>"
					+"							By: <input type='text' class='blnkInput' style='width: 300px;'>"
					+"						</div>"
					+"						<div>"
					+"							Contact No.: <input type='text' class='blnkInput' style='width: 300px;'>"
					+"						</div>"
					+"					</td>"
					+"					</tr>"
					+"				</table>"
					+"			</td>"
					+"		</tr>"
					+"	</table>"
					+"</div>";

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
		      // sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style="border-left: 1px solid black;"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "white-space: pre-line; word-wrap: break-word; font-size:'+defFontSize+';">' + text  +'</td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "border-right:1px solid black;text-align:right;font-weight:bold; font-size:'+defFontSize+';"></td>';
		      sheet += '</tr>';
		return sheet;
	}
	function footer(){
		if (PRnum == null) {
			PRnum = "";
		}
		var sheet 	="<div class='certifiedDiv' style='border: 0px;'><table style='width: 100%; border-spacing: 0px; font-size: 12px; border-top: 2px dashed black; padding-top: 5px;'>"
					+"	<tr>"
					+"		<td colspan='6' style='text-align: center; font-weight: bold;'>"
					+"			DEALER'S ACKNOWLEDGEMENT<br />"
					+"		(ALTERNATIVE METHOD OF PROCUREMENT)"
					+"		</td>"
					+"	</tr>"
					+"	<tr>"
					+"		<td colspan='6'>"
					+"			This is to acknowledge receipt of:"
					+"		</td>"
					+"	</tr>"
					+"	<tr>"	
					+"		<td style='width: 150px; text-align: right;'>Canvass dispatched dated:</td>"
					+"		<td style='' colspan='3'><input type='text' class='blnkInput' style='width: 100%;'></td>"
					+"		<td style=' text-align: right;'>P.R.#:</td>"
					+"		<td style=''>"
					+"			<input type='text' class='blnkInput' style='width: 100%; text-align: center; font-weight: bold;' value='"+PRnum+"'>"
					+"		</td>"
					+"	</tr>"
					+"	<tr>"
					+"		<td style='text-align: right;'>To be returned not later than:</td>"
					+"		<td style='' colspan='3'><input type='text' class='blnkInput' style='width: 100%;'></td>"
					+"		<td style=''></td>"
					+"		<td style=''></td>"
					+"	</tr>"
					+"	<tr>"
					+"		<td style='text-align: right;'>To be open on:</td>"
					+"		<td style=''><input type='text' class='blnkInput' style='width: 100%;'></td>"
					+"		<td style=' text-align: right;'>time:</td>"
					+"		<td style=''><input type='text' class='blnkInput' style='width: 100%;'></td>"
					+"		<td style=''></td>"
					+"		<td style=''></td>"
					+"	</tr>"
					+"	<tr>"
					+"		<td colspan='6' style='padding: 0px;'>"
					+"			<table style='width: 100%; border-spacing: 0px; font-size: 12px; padding-top: 15px;'>"
					+"				<tr>"
					+"					<td style='text-align: center'>"
					+"						<input type='text' class='blnkInput' style='width: 60%;'>"
					+"					</td>"
					+"					<td style='text-align: center'>"
					+"						<input type='text' class='blnkInput' style='width: 60%;'>"
					+"					</td>"
					+"				</tr>"
					+"				<tr>"
					+"					<td style='text-align: center;'>"
					+"						(Company)"
					+"					</td>"
					+"					<td style='text-align: center;'>"
					+"						(Printed Name and Signature)"
					+"					</td>"
					+"				</tr>"
					+"			</table>"
					+"		</td>"
					+"	</tr>"
					+"	<tr>"
					+"		<td style='padding: 0px;' colspan='6'>"
					+"			<table style='width: 100%;font-size: 12px; border-spacing: 0px; padding-top: 5px;'>"
					+"				<tr>"
					+"					<td style='width: 170px; padding: 0px;'>"
					+"						CANVASSER'S NAME/OFFICE:"
					+"					</td>"
					+"					<td style='padding: 0px;'>"
					+"						<input type='text' class='blnkInput' style='width: 100%; font-size: 12px;'>"
					+"					</td>"
					+"				</tr>"
					+"				<tr>"
					+"					<td style='padding: 0px;'>"
					+"					</td>"
					+"					<td style='padding: 0px;'>"
					+"						<input type='text' class='blnkInput' style='width: 100%; font-family: Times new roman; font-size: 14px; border: 0px;' value='City Hall, City Hall Drive, Tel. No. 241-1000'>"
					+"					</td>"
					+"				</tr>"
					+"			</table>"
					+"		</td>"
					+"	</tr>"
					+"</table></div>";
		// console.log(sheet);
		return sheet;
	}
	var editorSetShow = 0;
	window.ondblclick = function() {
		var editorContainer = document.getElementById('editorContainer');
		if (!editorContainer) {
			show();
		}
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
		
		editorSetShow = 0;
		head = document.getElementById("officeHead").value;
		headDesignation = document.getElementById("headLabel").value;
		
		setCookie ("RFQhead",head, 100);
		setCookie ("RFQdesignation",headDesignation, 100);

		office = document.getElementById("ofis").value;
		setCookie ("RFQoffice",office, 100);

		delPeriod = document.getElementById("delPeriod").value;
		var totalABC = parseFloat(document.getElementById('abcBudget').value);
		if (totalABC) {
			totalAll = totalABC;
			totalABC = numberWithCommas(totalABC.toFixed(2));
		} else {
			totalAll = 0;
			totalABC = "";
		}
		
		var pageH  = document.getElementsByClassName("head");
		var pageHD  = document.getElementsByClassName("headLabel");
		var pageDel = document.getElementsByClassName("delPeriod");
		var pageDel1 = document.getElementsByClassName("delPeriod1");
		var pageABC = document.getElementsByClassName("abcInput");
		var pageO = document.getElementsByClassName("office");
		
		var len = pageH.length; 
		for(var i = 0 ; i < len; i++){	
			pageH[i].innerHTML = head;
			pageHD[i].innerHTML = headDesignation;
			pageDel[i].value = delPeriod;
			pageDel1[i].value = delPeriod;
			pageABC[i].value = totalABC;
			pageO[i].innerHTML = office;

		}		
		document.getElementById("editorX").click();
	}
	//editorSet();
	function editorSet(){
		
		var d1 = 1;
		var r1 = 1;
		var  r2 = 1;
		var p1 = 1;
		var sheet ="<div class = 'editorContainer'>"
				  +"	<table border='0' style='padding-bottom:8px; border-spacing:0px; font-family:Arial; font-size:14px;'>"
				  +"		<tr>"
				  +"			<td class = 'editorHeader' colspan = '2' >RFQ Form Settings<div  id  = 'editorX'onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan = '2' ><div style = 'margin:4px; 0px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Department</td>"
				  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'   id = 'ofis'  style = 'text-align:center; text-align:center;' value = '" + ofis +"'/></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Requested By</td>"
				  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'   id = 'officeHead'  style = 'text-align:center; '  value = '" + head + "'  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Designation</td>"
				  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'  id = 'headLabel'  style = 'text-align:center; font-weight:normal;' value = '" + headDesignation + "'  /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Delivery Period</td>"
				  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'  id = 'delPeriod'  style = 'text-align:center; font-weight:normal;' value='"+delPeriod+"' /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style = 'padding-right:10px; text-align:right;'>Approved Budget</td>"
				  +"			<td style = 'padding-top:4px; padding-right:8px;'><input class = 'text3'  id = 'abcBudget'  style = 'text-align:center; font-weight:normal;' value='"+totalAll+"' /></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td colspan='2'><div style='border-bottom:1px solid silver; margin:4px 0px;'></div></td>"
				  +"		</tr>"
				  +"		<tr>"
				  +"			<td style='vertical-align:bottom; font-size:0px; padding-left:10px;'>"
				  +"				<div style='font-size:12px; display:inline-block;'>Change font size</div>"
				  +"				<button class='btnToggleFontSize' onclick='changeFontSize(\"tdData\", -2)'>-</button>"
				  +"				<button class='btnToggleFontSize' onclick='changeFontSize(\"tdData\", 2)'>+</button>"
				  +"			</td>"
				  +"			<td style='text-align:center;padding:20px 0px;padding-bottom:0px;'>"
				  +"				<div  id='1' style='display:inline-block; width:75px; padding:5px 8px; font-size:14px; cursor:pointer; border:1px solid silver;' onclick= 'setParam()'>Set</div>"
				  +"			</td>"
				  +"		</tr>"
				  +"	</table>"
				  +"</div>";
		
		theAbsolute(sheet);
	}

	function changeFontSize(elemClass, sizeChange) {
		var curFontSize = readCookie('rfqDefFontSize');
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
			setCookie("rfqDefFontSize", newFontSize, 1);
		}else {
			fontSize = parseInt(curFontSize);
			newFontSize = fontSize + sizeChange;
			setCookie("rfqDefFontSize", newFontSize, 1);
		}

		location.reload();
	}
	
	
</script>