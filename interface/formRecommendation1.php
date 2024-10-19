<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	
	require_once('../javascript/ajaxFunction.php');
	$tn = $_GET['tn'];
	$refCode = date('Y')."-".$tn;
	$dateToday = date('F d, Y');
	
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
		$approvedBy = 'SARA Z. DUTERTE';
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
	/*
	if(isset($_COOKIE['ControlledDesignation'])){
		$controlledDesignation = $_COOKIE['ControlledDesignation'];
	}else{
		$controlledDesignation = 'Purchasing Supply Officer';
	}*/
	
	
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
		/*height:700px;*/height:870px; width: 750px;overflow: auto;margin:0 auto;
		border: 2px solid black;
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
		height:170px;width: 750px;margin:0 auto;
		border:2px solid black;
	
		border-top: 0px;
		
	}
	.footerDiv{
		height:270px;
		width: 750px;margin:0 auto;
		/*border:2px solid black;*/
		
		border-top: 0px;
		margin-bottom: 1px;
		padding-top: 30px;
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
		padding:5px 5px;
		width:150px;
		font-weight:bold;
		font-size: 14px;
		border-top:1px solid silver;
		border-left:1px solid silver;
		background-color:rgba(6, 44, 66,.05);
	}
</style>

<link rel="icon" href="/citydoc2017/images/red.png"/> 
<title>Recommendation Form</title>
<div id  = "poMain" style = "">
	<div  class = "divContent" style = "border-bottom:2px solid black;">
		<table class = "tableContent">
			<tr id  = "trFirst">
				<td colspan="6"></td>
			</tr>	
			<tr>
				<td class = "tdHeader" style  ="width:10px;padding:0px 5px; border-left: 1px solid black;">No.</td>
				<td class = "tdHeader"  style  ="width:10px;padding:0px 5px;">Unit</td>
				<td class = "tdHeader"  style  ="width:10px;padding:0px 5px;">Qty</td>
				<td class = "tdHeader">Description</td>
				<td class = "tdHeader" style  ="width:90px;padding:0px 5px;">Unit&nbsp;Cost</td>
				<td class = "tdHeader"  style  ="width:100px;padding:0px 5px;">Amount</td>
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

	var refCode = "<?php echo $refCode; ?>";
	var dateToday = "<?php echo $dateToday; ?>";
	
	
	var ofis; 
	viewPO();
	var code;
	var program; 
	function viewPO(){
		var  tn = "<?php  echo $tn ?>";
	
		
		
		var container = document.getElementById("poMain");
		var queryString = "?fetchRecoDetails&tn=" +  tn ;
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchPODetails");			
	}
	
	function createSheet(details){
		
		var txt = '';
		var j = JSON.parse(details);
		console.log(j);
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
		
		program =  j.programs;
		
		code =  j.codes;
		
		var canDate = "";

		if (len == 1) {
			canDate = j.dateCanvassed[0];
		}

		var purpose = j.purpose;
		
		document.getElementById("trFirst").innerHTML = header(office,supplier,prNumber,tn, category, categoryName, canDate, purpose);
		var c = poMain.children.length;	
		
		var div = poMain.children[c-1];
		div.style.borderBottom = "0";
		var table = div.children[0];
		var tableBody = div.children[0].children[0];
		
		var on = 0;
		var subTotal = 0;
		
		
		for(var i = 0; i < len; i++){
			var canvassDate = "";
			if (j.dateCanvassed[i] !== "" && len > 1) {
				canvassDate = "("+j.dateCanvassed[i]+")";
			}
			
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
						}else{
							tableBody.removeChild(lastChild); 
							var lastAmount = lastChild.children[5].textContent.replace(/,/g,"");; 
							subTotal = subTotal - lastAmount;
							tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid blue;border-bottom:0px solid red;">' +  totalA(1,subTotal) + '<td></tr>';
							tempStr1 = '';
							i  = i -2;
						}
						inspectScrollerLast(div,poMain);
						// poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn, category, categoryName, canDate, purpose) +  '<tr><td class = "tdHeader" style="border-left: 1px solid black;">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit Cost</td><td class = "tdHeader" style = "">Amount</td></tr>'  + forwarded(subTotal) + halfText(tempStr1) +'</table></div>';
						poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn, category, categoryName, canDate, purpose) +  '<tr><td class = "tdHeader" style="border-left: 1px solid black;">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit Cost</td><td class = "tdHeader" style = "">Amount</td></tr>' + halfText(tempStr1) +'</table></div>';
						
						if(i == len-1){
							var c = poMain.children.length;
							var div = poMain.children[c-1];
							var table = div.children[0];
							var tableBody = div.children[0].children[0];
							tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid blue;border-bottom:1px solid red;">' +  totalA(0,subTotal) + '<td></tr>';
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
				var descX = desc.match(/\n/g);
				var descX = desc.split("\n");
			    
			 	tableBody.innerHTML +="<tr><td  class = 'tdData' style = 'text-align:center; border-left: 1px solid black;'>" +  num + "</td><td class = 'tdData' >" + j.unit[i] +"</td><td class = 'tdData' style = 'text-align:center;' >" +qty+"</td><td class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word;'>" + desc + "</td><td class = 'tdData' style = 'text-align:right;padding-right:5px;'>" +j.cost[i] +"</td><td class = 'tdData'  style = 'text-align:right;'><div>" +  j.total[i] + "</div><div style='font-size: 11px; font-style: italic;'>"+canvassDate+"</div></td></tr>";
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
								tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:0px solid black;"></td></tr>'; // last div na gi byaan
								// tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:0px solid black;">' +  totalA(1,subTotal) + '</td></tr>'; // last div na gi byaan
								var limit = divTrim(div);
								// poMain.innerHTML += certifiedBy();
								certTrim(limit);
								poMain.innerHTML += footer();
								
								createNewPage(poMain,div,office,supplier,prNumber,tn, "",quart,category,categoryName,subTotal, canDate, purpose);
								// createNewPage(poMain,div,office,supplier,prNumber,tn, forwarded(subTotal),quart,category,categoryName,subTotal, canDate, purpose);
								subTotal = parseFloat(subTotal) + parseFloat(total);
								//subTotal = subTotal - lastAmount;
								var c = poMain.children.length;
								var div = poMain.children[c-1];
								var table = div.children[0];
								var tableBody = div.children[0].children[0];
								tableBody.innerHTML +="<tr><td  class = 'tdData' style = 'text-align:center; border-left: 1px solid black;' >" +  num + "</td><td class = 'tdData' >" + j.unit[i] +"</td><td class = 'tdData' style = 'text-align:center;' >" +qty+"</td><td class = 'tdData' style = 'white-space: pre-line; word-wrap: break-word;'>" + desc + "</td><td class = 'tdData' style = 'text-align:right;padding-right:5px;'>" +j.cost[i] +"</td><td class = 'tdData'  style = 'text-align:right;'><div>" +  j.total[i] + "</div><div style='font-size: 11px; font-style: italic;'>"+canvassDate+"</div></td></tr>";
							}else if(tempStr1 == -1){
								
								poMain.innerHTML += comment("Please do not create a very long sentence. Press enter at the end of the paragraph.");
								end; 
							
							}else{
								var limit = divTrim(div);
								// poMain.innerHTML += certifiedBy();
								certTrim(limit);
								poMain.innerHTML += footer();
								
								createNewPage(poMain,div,office,supplier,prNumber,tn,tempStr1,quart,category,categoryName,subTotal, canDate, purpose);
								var c = poMain.children.length;
								var div = poMain.children[c-1];
								var table = div.children[0];
								var tableBody = div.children[0].children[0];
								//tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
								//inspectScrollerLast(div,poMain);
							}	
							y++;
							
						}while(div.scrollHeight  > div.offsetHeight);
						
						tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
						// tableBody.innerHTML +=  '<tr><td colspan = "7"  style = "border-top:1px solid black;border-bottom:1px solid black;">' +  totalA(0,subTotal) + '<td></tr>';
						// if mulapas pag butang sa total then increase div decrease certificate
						 inspectScrollerLast(div,poMain);
					}else{
						//createNewPage(poMain,div,office,supplier,prNumber,tn, forwarded(subTotal),quart,category,categoryName,subTo, purposetal);
						
						tableBody.innerHTML += '<tr><td colspan = "7" style = "border:1px solid black;">' + totalA(0,subTotal)  + '</></tr>';
						// tableBody.innerHTML += '<tr><td colspan = "7" style = "border-top:1px solid black;border-bottom:1px solid black;">' + totalA(0,subTotal)  + '</></tr>';
						// if mulapas pag butang sa total then increase div decrease certificate
						 inspectScrollerLast(div,poMain);
					}
				}
			}
		}
		countPageLimit();
		removeBorders();
	}
	function removeBorders(){
		var divContent = document.getElementsByClassName('divContent');
		for (var i = 0; i < divContent.length; i++) {
			divContent[i].style.border = "0px";
		}
	}
	function inspectScrollerLast(div,poMain){
		
		if(div.scrollHeight > div.offsetHeight){
			var limit = divTrim(div);
			certTrim(limit);
		}else{    
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
		cert.style.height = (h - limit)+ "px"; 	
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
	function createNewPage(poMain,div,office,supplier,prNumber,tn,tempStr1,quart,category,categoryName,subTotal, canDate, purpose){
		poMain.innerHTML +=  '<div class = "divContent"><table class = "tableContent">' + header(office,supplier,prNumber,tn, category, categoryName, canDate, purpose) +  '<tr><td class = "tdHeader" style="border-left: 1px solid black;">No.</td><td class = "tdHeader">Unit</td><td class = "tdHeader">Qty</td><td class = "tdHeader">Description</td><td class = "tdHeader">Unit Cost</td><td class = "tdHeader" style = "">Amount</td></tr>'+ halfText(tempStr1)  +'</table></div>';
		var c = poMain.children.length;
		var div = poMain.children[c-1];
		var table = div.children[0];
		var tableBody = div.children[0].children[0];
	}
	function header(office,supplier,prNumber,tn, category, categoryName, canDate, purpose){
		
		var sheet = '<tr><td colspan = "6">';
		      sheet += '	<div>';
		      	sheet += '<table border="0" style="border-spacing:0;margin:0 auto;width:100%;">';
			sheet += '			<tr>';
			sheet += '				<td colspan="4" style = "border-bottom:4px s black; padding:0px 0px;padding-bottom:5px;">';

			sheet += '					<table border="0" style ="margin:0 auto;">';
			sheet += '						<tr>';
			sheet += '							<td style ="text-align:center; width: 60px; padding: 0px 10px;" rowspan="5"><img src="../images/davaologo.png" style="width: 90px;"></td>';
			sheet += '							<td style="padding: 0px 15px; padding-right: 100px;">';
			sheet += '								<div style ="text-align: center; font-size: 14px;">Republic of the Philippines</div>';
			sheet += '								<div style ="text-align: center; font-size: 14px;">City of Davao</div>';
			sheet += '								<div style ="text-align: center; font-size: 24px;">OFFICE OF THE CITY ADMINISTRATOR</div>';
			sheet += '								<div style ="text-align: center; font-size: 14px;">City Information Technology Center</div>';
			sheet += '								<div style ="text-align: center; font-size: 14px;">Dial: 241-1000, Local nos.: (200/201/202/203/291/243)</div>';
			sheet += '							</td>';
			sheet += '						</tr>';
			sheet += '					</table>';
			sheet += '				</td>';
			sheet += '			</tr>';
			
			sheet += '			<tr>';
			sheet += '				<td style="padding: 20px 0px 15px 0px; text-align: center; border-top: 2px solid black;">';
			sheet += '					<span style="padding: 0px 15px; font-weight: bold;">Hardware and Software Technical Specifications<span>';
			sheet += '				</td>';
			sheet += '			</tr>';
			
			sheet += '			<tr>';
			sheet += '				<td style="padding-bottom: 12px;">';
			sheet += '					<table border="0" style="border-spacing: 0px 5px;">';
			sheet += '						<tr>';
			sheet += '							<td style="text-align: right; font-size: 13px; padding-right: 5px;">';
			sheet += '								<span style="display: inline-block; width: 60px;">Office&nbsp;: </span>'
			sheet += '							</td>';
			sheet += '							<td style="border-bottom: 1px solid black; vertical-align: bottom;">';
			sheet += '								<span style="font-size: 12px; display: inline-block; padding-left: 3px; width: 425px; vertical-align: bottom;">'+office+'</span>'
			sheet += '							</td>';
			sheet += '							<td style="text-align: right; font-size: 13px; padding-right: 5px;">';
			sheet += '								<span style="display: inline-block; width: 90px;">Ref. No.&nbsp;: </span>'
			sheet += '							</td>';
			sheet += '							<td style="vertical-align: bottom;">';
			sheet += '								<span style="border-bottom: 1px solid black; font-size: 15px; letter-spacing: 1px; display: inline-block; padding-left: 3px; width: 145px; vertical-align: bottom;">'+refCode+'</span>'
			sheet += '							</td>';
			sheet += '						</tr>';
			sheet += '						<tr>';
			sheet += '							<td style="text-align: right; font-size: 13px; padding-right: 5px;">';
			sheet += '								<span style="display: inline-block; width: 60px;">Category&nbsp;: </span>'
			sheet += '							</td>';
			sheet += '							<td style="border-bottom: 1px solid black; vertical-align: bottom;">';
			sheet += '								<span style="font-size: 13px; display: inline-block; padding-left: 3px; width: 425px; vertical-align: bottom;">'+category+" - "+categoryName+'</span>'
			sheet += '							</td>';
			sheet += '							<td style="text-align: right; font-size: 13px; padding-right: 5px;">';
			sheet += '								<span style="display: inline-block; width: 90px;">Canvass Date&nbsp;: </span>'
			sheet += '							</td>';
			sheet += '							<td style="vertical-align: bottom;">';
			sheet += '								<span style="border-bottom: 1px solid black; display: inline-block; padding-left: 3px; width: 145px; vertical-align: bottom; font-size: 13px;">'+canDate+'</span>'
			sheet += '							</td>';
			sheet += '						</tr>';
			sheet += '						<tr>';
			sheet += '							<td style="text-align: right; font-size: 13px; padding-right: 5px; vertical-align: top;">';
			sheet += '								<span style="display: inline-block; width: 60px;">Purpose&nbsp;: </span>'
			sheet += '							</td>';
			sheet += '							<td style="border-bottom: 1px solid black; vertical-align: bottom;">';
			sheet += '								<span style="display: inline-block; padding-left: 3px; width: 425px; vertical-align: bottom; font-size: 13px;">'+purpose+'</span>'
			sheet += '							</td>';
			
			sheet += '							<td style="text-align: right; font-size: 13px; padding-right: 5px; vertical-align: top;">';
			sheet += '								<span style="display: inline-block; width: 90px;">Date Printed&nbsp;: </span>'
			sheet += '							</td>';
			sheet += '							<td style="vertical-align: top;">';
			sheet += '								<span style="border-bottom: 1px solid black; font-size: 13px; display: inline-block; padding-left: 3px; width: 145px; vertical-align: bottom;">'+dateToday+'</span>'
			sheet += '							</td>';
			sheet += '						</tr>';
			sheet += '					</table>';
			sheet += '				</td>';
			sheet += '			</tr>';
			sheet += '	</table>';
		    sheet += ' </div>';
		    sheet += '</td></tr>';
		return sheet;
	}
	function quarter(quart,category,categoryName){
		var  sheet = '<tr>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "text-align:center;font-weight:bold;padding:8px 0px;font-size:14px;">' + quart  +'<br/>' + category + ' - ' + categoryName  + '</td>';
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
		      sheet += '<td class = "tdData" style = "text-align:center;">Balance Forwarded</td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "border-right:0;text-align:right;font-weight:bold;">'  + numberWithCommas(subtotal.toFixed(2))  + '</td>';
		      
		      sheet += '</tr>';
		return sheet;
	}
	function totalA(label,total){
		// if(label == 1){
		// 	label = "Subtotal";
		// 	var   sheet = '<table style = "width: 100%;"  >';
		// 	sheet += '<tr >';
		
		// 	sheet += '	<td  colspan = "2" style = "width:100px;padding-right:5px;text-align:right;font-weight:bold;"><span style = "padding-right:20px;">' + label + '</span>' + numberWithCommas(total.toFixed(2)) + '</td>';
		// 	sheet += '</tr>	';
		// 	sheet += '</table>';
		// }else{
			label = "Total";
			var   sheet = '<table style = "width: 100%;"  >';
			sheet += '	<tr >';
			sheet += '	<td style = "font-size:12px;padding-left:5px;"></td>'
			// sheet += '	<td style = "font-size:12px;padding-left:5px;">' + convertWordCurrency(total.toFixed(2)) + ' ONLY' + '</td>'
			sheet += '	<td style = "width:100px;padding-right:5px;text-align:right;font-weight:bold;"><span style = "padding-right:20px;">' + label + '</span>' + numberWithCommas(total.toFixed(2)) + '</td>';
			sheet += '</tr>	';
			sheet += '</table>';
		// }
		
		return sheet;
	}
	var no = 1;
	function countPageLimit(){
		var limit = document.getElementsByClassName("pageLimit");
		for(var i = 0 ; limit.length; i++){
			limit[i].innerHTML = no-1;
		}
	}
	function certifiedBy(){
		
		var   sheet = '<div class = "certifiedDiv"  ><table style = "width: 100%;height:100%;" >';
			sheet += '<tr >';
			sheet += '	<td style = "vertical-align:bottom;">';
			sheet += '		<table style ="width:100%;"  >';
			sheet += '		<tr>';
			sheet += '			<td style = "text-align:right;font-size:13px;"> <div style = "font-size:13px;padding-right:25px;">Delivery Period <input class = "numDays" style = "font-weight:bold;text-align:center;font-size:16px;border:0;border-bottom:1px solid black;width:35px;padding:0px 3px;" value = "-"/>';
			sheet += '			Days Upon Receipt of Approved PO</div>Page <span id = "pageNo">' + no + '</span> of <span class = "pageLimit" style = "padding-right:100px;"></span></td>';
			sheet += '		</tr>';
			sheet += '		</table >';
			
			sheet += '       </td>';
			sheet += '	<td style = "width:220px;padding-right:20px;verical-align:top;">';
		
			sheet += '		<table style ="width:100%;" class = "tableSig" >';
			sheet += '			<tr>';
			sheet += '				<td style = "font-size:12px;">THIS IS TO CERTIFY that the items stated above are included in the PPMP of this Office.</td>';
			sheet += '			</tr>';
			sheet += '			<tr>';
			sheet += '				<td style ="text-align:center;height:65px;vertical-align:bottom;"><input class = "certBy" value = "' + certBy + '" style = "font-size:11px;border:0px solid white;border-bottom:1px solid black;width:100%;text-align:center;font-weight:bold;" placeholder = "Type Name"/><input class = "certLabel" placeholder = "Type Position" value = "' + certDesignation + '"   style = "font-size:12px;border:0;width:100%;text-align:center;"/></td></td>';
			sheet += '			</tr>';
			sheet += '		</table>';
		
			sheet += '	</td>';
			sheet += '</tr>	';
			sheet += '</table></div>';
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
		      sheet += '<td class = "tdData" style="border-left: 1px solid black;"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "white-space: pre-line; word-wrap: break-word;">' + text  +'</td>';
		      sheet += '<td class = "tdData"></td>';
		      sheet += '<td class = "tdData" style = "text-align:right;font-weight:bold;"></td>';
		      sheet += '</tr>';
		return sheet;
	}
	function footer(){

		var sheet = "";

		sheet="<div class='footerDiv'>"
			 +"	<table border='0' style='margin: 0px auto; height: 100%; width: 100%; font-size: 13px;'>"
			 +"		<tr>"
			 +"			<td valign='top'>"
			 +"				<div>Noted By:</div>"
			 +"				<div style='padding-top: 50px;'>RICARTE D. FRANCO, JR.</div>"
			 +"				<div>Information Technology Officer II</div>"
			 +"				<div>Officer-in-Charge, CITC</div>"
			 +"				<div style='margin-top: 10px;'>Date&nbsp;:&nbsp;<span style='display: inline-block; width: 170px; border-bottom: 1px solid black;'></span></div>"
			 +"			</td>"
			 +"			<td>"
			 +"				<div style='width: 200px;'></div>"
			 +"			</td>"
			 +"			<td valign='top'>"
			 +"				<div>Prepared By:</div>"
			 +"				<div style='padding-top: 50px;'>ROWENA HENEDINE D. NARAJOS</div>"
			 +"				<div>Information Technology Officer II</div>"
			 +"				<div>Head, CEMG</div>"
			 +"				<div style='margin-top: 10px;'>Date&nbsp;:&nbsp;<span style='display: inline-block; width: 170px; border-bottom: 1px solid black;'></span></div>"
			 +"			</td>"
			 +"		</tr>"
			 +""
			 +"	</table>"
			 +"</div>";
		return sheet;
	}
	// window.ondblclick = function() {
	// 	show();
	// }
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
		
		
		
		
		
		var length = pageH.length; 
		for(var i = 0 ; i < length; i++){
			pageC[i].value = certBy;
			pageCD[i].value = certDesignation;
			
			pageH[i].value = head;
			pageHD[i].value = headDesignation;
			
			pageA[i].value = approvedBy;
			pageAD[i].value = approvedDesignation;
			
			pageCtrl[i].value = controlledBy;
			
			pageP[i].value = purpose;
			pageS[i].innerHTML = section;
			pageN[i].value = numDays;
			
			pageO[i].innerHTML = office;
		}		
		document.getElementById("editorX").click();
	}
	//editorSet();
	function editorSet(){
		
		// var d1 = 1;
		// var r1 = 1;
		// var  r2 = 1;
		// var p1 = 1;
		// var  sheet = "<div class = 'editorContainer'><table border ='0' style = 'padding-bottom:20px;width:450px;' >";
		//        sheet += "<tr><td class = 'editorHeader' colspan = '2' >PO Form Settings<div  id  = 'editorX'onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>";
		//        sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:0px solid silver;margin:10px; 0px;'></div></td>";
		       
		//        sheet += '<tr><td style = "padding-left:10px;">Department</td><td style = "padding-right:10px;"><input class = "text3"   id = "ofis"  style = "text-align:center;width:100%;text-align:left;" value = "' + ofis +'"/></td></tr>';
		       
		//        sheet += "<tr><td style = 'padding-left:10px;width:145px;'>Section</td><td style = 'padding-right:10px;'><input  id = 'section' class = 'text3'  style = 'text-align:center;width:100%;text-align:left;' value = ''/></td></tr>";
		//        sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:0px solid silver;margin:10px; 0px;'></div></td>";
		      
		//        sheet += "<tr><td style = 'padding-left:10px;width:145px;'>No. of days</td><td style = 'padding-right:10px;'><input  id = 'numDays' class = 'text3'  style = 'text-align:center;width:100%;text-align:left;' value = ''/></td></tr>";
		//        sheet += "<tr><td colspan = '2' ><div style = 'border-bottom:1px solid silver;margin:10px; 0px;'></div></td>";
		//        sheet += "<tr><td style = 'padding-left:10px;text-align:right;vertical-align:top;padding-right:10px;'>Purpose</td><td style = 'padding-right:10px;'><textarea  id = 'purpose'  class = 'text3' style = 'width:100%'></textarea></td></tr>";
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

		var sheet = "";

		sheet="<div class='editorContainer'>"
			 +"	<table border='1' style=''>"
			 +"		<tr>"
			 +"			<td>"
			 +"			</td>"
			 +"			<td>"
			 +"			</td>"
			 +"		</tr>"
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +""
			 +"	</table>"
			 +"</div>"
			 ;
		
		        theAbsolute(sheet);
	}
	
	
</script>