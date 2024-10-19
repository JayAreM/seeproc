<style>
	
	.programCodeContainer{
		border:1px solid rgb(245, 244, 244);
		width:400px;
		height:400px;
		overflow-x:auto;
		
	}
	.rowColor:hover{
		background-color:rgb(227, 250, 194);
		cursor:pointer;
	}
	
	.tdSAAOBHeader{
		padding:2px 5px;
		text-align:center;
		background-color:rgb(216, 217, 218);
		font-size:15px;
		font-weight:bold;
		border-radius:2px 2px 0px 0px;
	}
	.tdSAAOBHeader2{
		
		padding:2px 5px;
		text-align:center;
		background-color:rgba(167, 197, 180,.5);
		font-size:15px;
		font-weight:bold;
		border-radius:2px 2px 0px 0px;
	}
	.tdSAAOBContent{
		padding:3px 0px;
		text-align:center;
		font-size:15px;
		border-radius:2px 2px 0px 0px;
		border-bottom:1px solid rgb(227, 234, 224);
		border-right:1px solid rgb(227, 234, 224);
		
	}
	.tdSAAOBContent:hover{
		background-color:rgb(227, 250, 194);
		cursor:pointer;
	}
	.selectOfficeOBR{
		width:400px;
	}
	/*-----------------------------------------------------------------------*/
	
	.tableContentSAAOBEncode{
		background-color:white;
		width:1300px;
		height:100%;
		margin:0px auto; 
		
		padding:10px;
		
	}
	.tdContent{
		background-color:rgba(6, 44, 66,.02);
		background-color:white;
		box-shadow:0px 0px 10px 1px grey;
	}
	
	
	.returnContainer{
		width:100%;
		overflow-y:auto;
		
	}
	#returnContainerOBRencode{
		-webkit-touch-callout:select;
	    -webkit-user-select:text;
	    -khtml-user-select: text;
	    -moz-user-select: text;
	    -ms-user-select: text;
	    user-select: text;
	}
	#tablePOmark{
		margin:0 auto;
	    -webkit-touch-callout:select;
	    -webkit-user-select:text;
	    -khtml-user-select: text;
	    -moz-user-select: text;
	    -ms-user-select: text;
	    user-select: text;
	}
	#tablePOmark td{
		vertical-align:top;
	}
	.check:hover{
		font-style:normal;
		font-weight:bold;
		font-size:18px;
		color:red;
	}
</style>

	

<script >
	//whenRefreshSAAOBEncode();
	
	window.onload = function(){
	    if(window.File && window.FileList && window.FileReader){
		        var filesInput = document.getElementById("inputTextFileLiquidated");
		        filesInput.addEventListener("change", handleFiles);
		        
		        var filesInput = document.getElementById("inputTextFileLiquidatedTN");
		        filesInput.addEventListener("change", handleFiles1);
	    }else{
		 		console.log("Your browser does not support File API");
		}
	}
	var dataAll = '~~';
	function handleFiles(e) {
		  dataAll = '~~';	
		  document.getElementById('returnContainerOBRencode').innerHTML = "";
		  var file = this.files[0];
		  var reader = new FileReader();
		  reader.onload = function(progressEvent){
		    var lines = this.result.split('\n');
		    
		   	 document.getElementById('returnContainerOBRencode').innerHTML = CreateSheet(lines);
			 x = lines;
		  };
		  reader.readAsText(file);
	}
	function handleFiles1(e) {
		
		  dataAll = '~~';	
		  document.getElementById('returnContainerOBRencode').innerHTML = "";
		  var file = this.files[0];
		  var reader = new FileReader();
		  reader.onload = function(progressEvent){
		    var lines = this.result.split('\n');
		   
		   	 document.getElementById('returnContainerOBRencode').innerHTML = CreateSheet1(lines);
			 x = lines;
		  };
		  reader.readAsText(file);
	}
	var accountCode = '';
	function CreateSheet(lines){
		 var sheet = '<table style ="width:100%;margin:0 auto;" border = "0"><tr><td style = "">';   
			sheet += '<table border ="0" style = "border-bottom:1px solid rgba(232, 233, 233,.5);">';
			sheet += '<tr>';
			sheet += '<td class = "tdSAAOBHeader2" style = "padding:5px 0px;width:37px;">No</td>';
			sheet += '<td class = "tdSAAOBHeader2" style = "padding:5px 0px;width:218px;">JevNo</td>';
			sheet += '<td class = "tdSAAOBHeader2" style = "padding:5px 0px;width:184px;">CheckNo</td>';
			sheet += '<td class = "tdSAAOBHeader2"  style = "padding:5px 0px;text-align:center;width:130px;">ENGAS</td>';
			sheet += '<td class = "tdSAAOBHeader2"  style = "padding:5px 0px;text-align:center;width:142px;">Doctrack</td>';
			sheet += '</tr>';
			sheet += '</table>';
			sheet += '<div id = "dynamicSheet" style = " width:100%; height:610px;overflow-y:auto; border:0px solid blue;"><table style = "width:100%;border-spacing:0;" border="0">';
		var j = 1;
		var total = 0;
		var  row = '';
		for(var i = 0; i < lines.length; i++){
			var line = lines[i].split("\t");
			if(line.length == 4){
				var jevNo = line[0];
				var checkNo = line[1];
				var  x =  isNumber(checkNo) ;
				if (x == false){
					row = row + '<tr><td style = "text-align:center;border-bottom:1px solid silver;border-right:1px solid silver;padding: 0px 5px;">' + (i+1) + '</td><td style = "text-align:center;border-bottom:1px solid silver;border-right:1px solid silver;padding: 0px 5px;"> ' + checkNo + '</td></tr>';
				}
				var amountDisplay = line[3].replace(/["]/g,"");
				var amount = line[3].replace(/[,"]/g,"");
				var  code = line[2];
				accountCode = code;
				total = total + parseFloat(amount,2);
				if(j % 2 == 0){
					var color = "rgb(239, 242, 239)";
				}else{
					var color = "rgba(248, 251, 248,.3)";
				}
				sheet += '<tr style = "background-color:' + color + '">';
				sheet += 	'<td style = "padding:5px;text-align:center;width:30px;background-color:white;">' + j  + '</td>';
				sheet += 	'<td style = " padding:5px;text-align:center;border-bottom:1px solid rgb(227, 234, 224);border-right:1px solid rgb(227, 234, 224);width:193;">' + jevNo + '</td>';
				sheet += 	'<td ondblclick = "checkDetails(this)" class ="check" style = "font-style:italic; cursor:pointer;padding:5px;text-align:center;border-bottom:1px solid rgb(227, 234, 224);border-right:1px solid rgb(227, 234, 224);width:163px;">' + checkNo + '</td>';
				sheet += 	'<td id = "td4' + checkNo + '" style = "border-bottom:1px solid rgb(227, 234, 224);border-right:1px solid rgb(227, 234, 224);width:120px;"><div style = "padding:5px;text-align:right;padding-right:10px;">' + amountDisplay + '</div></td>';
				sheet += 	'<td id = "td5' + checkNo + '" style = "border-bottom:1px solid rgb(227, 234, 224);border-right:1px solid rgb(227, 234, 224);width:120px;"><div style = "width: 50%;margin:0 auto; padding-right:10px;height:1px;background-color:rgb(253, 188, 215);"></div></td>';
				sheet += '</tr>';
				j++;
			}else{
				break;
			}
	    }
	    sheet += '</table></div></td>';
		sheet +="<td ><table style = 'margin:0 auto;width:200px;' border = '0'>";
		sheet += "<tr><td colspan ='3' style = 'padding:5px;font-size:12px;border-bottom:1px solid gray;font-weight:bold;' class = 'label3'>ENGAS File </td></tr>";
		sheet += "<tr><td style = 'padding:5px;text-align:right;' class = 'label3'>Rows : </td><td colspan = '2' id = 'tdFileSize' style = 'padding-left:10px;border-bottom:1px solid rgb(227, 234, 224);font-weight:bold;'>" + i + "</td></tr>";
		i--;
		sheet += "<tr><td style = 'padding:5px;text-align:right;' class = 'label3'>Total : </td><td colspan = '2' style = 'padding-left:10px;border-bottom:1px solid rgb(227, 234, 224);font-weight:bold;'>" + numberWithCommas(total.toFixed(2)) + "</td></tr>";
		sheet += "<tr><td colspan ='3' style = 'padding:5px;font-size:12px;border-bottom:1px solid gray;font-weight:bold;' class = 'label3'>Doctrack Record </td></tr>";
		sheet += "<tr><td colspan = '2' style = 'padding:5px 2px;' ><input id = 'notFound' onclick = 'viewDiff(this)' type = 'checkbox'/>&nbsp;Not&nbsp;Found</td><td id = 'tdAffected' style = 'padding-left:10px;border-bottom:1px solid rgb(227, 234, 224);font-weight:bold;'>&nbsp;</td></tr>";
		sheet += "<tr><td colspan = '2' style = 'padding:5px 2px;'><input id = 'misMatch' onclick = 'viewDiff(this)' type = 'checkbox'/>&nbsp;Mismatch</td><td id = 'tdMismatch' style = 'padding-left:10px;border-bottom:1px solid rgb(227, 234, 224);font-weight:bold;'>&nbsp;</td></tr>";
		
		sheet += "<tr><td colspan = '2' style = 'padding:5px 2px;text-align:right;font-weight:bold;'>Match&nbsp;&nbsp;</td><td id = 'tdMatch' style = 'padding-left:10px;border-bottom:1px solid rgb(227, 234, 224);font-weight:bold;'>&nbsp;</td></tr>";
		
		sheet += "<tr><td colspan = '3' style = 'text-align:center;padding:20px;'><div id = 'divTransfer'  class ='button2' onclick = 'submitTextUploader()'>Begin Transfer</div></td></tr></table>";
		sheet +="</td></tr></table>";
		
		if(row.length > 1){
			var  y = "<table border = '0'><tr><td colspan = '2' style = 'color:red;font-size:24px;'>Please review invalid check number.</td></tr><tr style = 'background-color:rgb(206, 209, 206);'><td style ='text-align:center; padding:5px;border-bottom:1px solid silver;'>Row</td><td style ='text-align:center;padding:5px;border-bottom:1px solid silver;'>Check Number</td></tr>" + row + "</table>";
		}else{
			
			var y = '';
		}
		return y + sheet;
	}
	function CreateSheet1(lines){
		 var sheet = '<table style ="width:100%;margin:0 auto;" border = "0"><tr><td style = "">';   
			sheet += '<table border ="0" style = "border-bottom:1px solid rgba(232, 233, 233,.5);">';
			sheet += '<tr>';
			sheet += '<td class = "tdSAAOBHeader2" style = "padding:5px 0px;width:37px;">No</td>';
			sheet += '<td class = "tdSAAOBHeader2" style = "padding:5px 0px;width:218px;">JevNo</td>';
			sheet += '<td class = "tdSAAOBHeader2" style = "padding:5px 0px;width:184px;">TrackingNumber</td>';
			sheet += '<td class = "tdSAAOBHeader2"  style = "padding:5px 0px;text-align:center;width:130px;">ENGAS</td>';
			sheet += '<td class = "tdSAAOBHeader2"  style = "padding:5px 0px;text-align:center;width:142px;">Doctrack</td>';
			sheet += '</tr>';
			sheet += '</table>';
			sheet += '<div id = "dynamicSheet" style = " width:100%; height:610px;overflow-y:auto; border:0px solid blue;"><table style = "width:100%;border-spacing:0;" border="0">';
		var j = 1;
		var total = 0;
		var  row = '';
		for(var i = 0; i < lines.length; i++){
			var line = lines[i].split("\t");
			if(line.length == 4){
				var jevNo = line[0];
				var tn = line[1];
				var  x =  isNumber(tn) ;
				x = true;
				if (x == false){
					row = row + '<tr><td style = "text-align:center;border-bottom:1px solid silver;border-right:1px solid silver;padding: 0px 5px;">' + (i+1) + '</td><td style = "text-align:center;border-bottom:1px solid silver;border-right:1px solid silver;padding: 0px 5px;"> ' + tn + '</td></tr>';
				}
				var amountDisplay = line[3].replace(/["]/g,"");
				var amount = line[3].replace(/[,"]/g,"");
				var  code = line[2];
				accountCode = code;
				total = total + parseFloat(amount,2);
				if(j % 2 == 0){
					var color = "rgb(239, 242, 239)";
				}else{
					var color = "rgba(248, 251, 248,.3)";
				}
				sheet += '<tr style = "background-color:' + color + '">';
				sheet += 	'<td style = "padding:5px;text-align:center;width:30px;background-color:white;">' + j  + '</td>';
				sheet += 	'<td style = " padding:5px;text-align:center;border-bottom:1px solid rgb(227, 234, 224);border-right:1px solid rgb(227, 234, 224);width:193;">' + jevNo + '</td>';
				sheet += 	'<td ondblclick = "checkDetails(this)" class ="check" style = "font-style:italic; cursor:pointer;padding:5px;text-align:center;border-bottom:1px solid rgb(227, 234, 224);border-right:1px solid rgb(227, 234, 224);width:163px;">' + tn + '</td>';
				sheet += 	'<td id = "td4' + tn + '" style = "border-bottom:1px solid rgb(227, 234, 224);border-right:1px solid rgb(227, 234, 224);width:120px;"><div style = "padding:5px;text-align:right;padding-right:10px;">' + amountDisplay + '</div></td>';
				sheet += 	'<td id = "td5' + tn + '" style = "border-bottom:1px solid rgb(227, 234, 224);border-right:1px solid rgb(227, 234, 224);width:120px;"><div style = "width: 50%;margin:0 auto; padding-right:10px;height:1px;background-color:rgb(253, 188, 215);"></div></td>';
				sheet += '</tr>';
				j++;
			}else{
				break;
			}
	    }
	    sheet += '</table></div></td>';
		sheet +="<td ><table style = 'margin:0 auto;width:200px;' border = '0'>";
		sheet += "<tr><td colspan ='3' style = 'padding:5px;font-size:12px;border-bottom:1px solid gray;font-weight:bold;' class = 'label3'>ENGAS File </td></tr>";
		sheet += "<tr><td style = 'padding:5px;text-align:right;' class = 'label3'>Rows : </td><td colspan = '2' id = 'tdFileSize' style = 'padding-left:10px;border-bottom:1px solid rgb(227, 234, 224);font-weight:bold;'>" + i + "</td></tr>";
		i--;
		sheet += "<tr><td style = 'padding:5px;text-align:right;' class = 'label3'>Total : </td><td colspan = '2' style = 'padding-left:10px;border-bottom:1px solid rgb(227, 234, 224);font-weight:bold;'>" + numberWithCommas(total.toFixed(2)) + "</td></tr>";
		sheet += "<tr><td colspan ='3' style = 'padding:5px;font-size:12px;border-bottom:1px solid gray;font-weight:bold;' class = 'label3'>Doctrack Record </td></tr>";
		sheet += "<tr><td colspan = '2' style = 'padding:5px 2px;' ><input id = 'notFound' onclick = 'viewDiff(this)' type = 'checkbox'/>&nbsp;Not&nbsp;Found</td><td id = 'tdAffected' style = 'padding-left:10px;border-bottom:1px solid rgb(227, 234, 224);font-weight:bold;'>&nbsp;</td></tr>";
		sheet += "<tr><td colspan = '2' style = 'padding:5px 2px;'><input id = 'misMatch' onclick = 'viewDiff(this)' type = 'checkbox'/>&nbsp;Mismatch</td><td id = 'tdMismatch' style = 'padding-left:10px;border-bottom:1px solid rgb(227, 234, 224);font-weight:bold;'>&nbsp;</td></tr>";
		
		sheet += "<tr><td colspan = '2' style = 'padding:5px 2px;text-align:right;font-weight:bold;'>Match&nbsp;&nbsp;</td><td id = 'tdMatch' style = 'padding-left:10px;border-bottom:1px solid rgb(227, 234, 224);font-weight:bold;'>&nbsp;</td></tr>";
		
		sheet += "<tr><td colspan = '3' style = 'text-align:center;padding:20px;'><div id = 'divTransfer'  class ='button2' onclick = 'submitTextUploader()'>Begin Transfer</div></td></tr></table>";
		sheet +="</td></tr></table>";
		
		if(row.length > 1){
			var  y = "<table border = '0'><tr><td colspan = '2' style = 'color:red;font-size:24px;'>Please review invalid tracking number.</td></tr><tr style = 'background-color:rgb(206, 209, 206);'><td style ='text-align:center; padding:5px;border-bottom:1px solid silver;'>Row</td><td style ='text-align:center;padding:5px;border-bottom:1px solid silver;'>Check Number</td></tr>" + row + "</table>";
		}else{
			
			var y = '';
		}
		return y + sheet;
	}
	function checkDetails(me){
		var check = me.textContent;
		var queryString = "?CheckDetailsSAAOB=1&checkNumber=" + check;
		var container = document.getElementById('returnContainerOBRencode');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"CheckDetailsSAAOB");
	} 
	function whenRefreshSAAOBEncode(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "SAAOB"){
			var cookieText = cookieLabel(cookieSAAOBMenu(),"saaobMenuContainer");
			if(cookieText == "Encode"){
				var obrNmber = '';
				var queryString = "?SearchInEncodeLiquidation=1&field=" + field + "&searchValue=" + searchValue;
				var container = document.getElementById('returnContainerOBRencode');
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"SearchInEncodeLiquidation");
			}
		}
	}
	function searchOBR(me){
		var searchValue = me.value;
		var field;
		if(searchValue.length > 5){
			field = "CheckNumber";
		}else{
			field = "OBR_Number";
		}
		
		if(searchValue){
			var queryString = "?SearchInEncodeLiquidation=1&field=" + field + "&searchValueSaaob=" + searchValue;
			var container = document.getElementById('returnContainerOBRencode');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"SearchInEncodeLiquidation");
		}else{
			alert("Please input OBR Number");
		}
	}
	function saveClick(){
		var jev = document.getElementById("saaobJevNumber");
		saveOBRJEV(jev);
	}
	function saveOBRJEV(me){
		if(me.value.length != 0 ){
			
			var checkField = document.getElementById("saaobCHKNo");
			
			if(checkField){
				var checkNumber = document.getElementById("saaobCHKNo").textContent;
				
				if(checkNumber.length >= 5){
					
						var jevNo =  me.value.trim();
						
						var trackingNumber = document.getElementById('saaobTrackingNo').textContent;
						var saaobOBRNo = document.getElementById("saaobOBRNo").textContent;
						var saaobOBRadv = document.getElementById("saaobOBRadv").textContent;
						
						var status = document.getElementById("saaobOBRstatus").textContent;
						var claimType = document.getElementById("saaobEncodeClaimType").textContent;
					
						var claimant = document.getElementById("saaobEncodeClaimant").textContent;
						
					
						var chargeType = document.getElementById("chargeTypeSAAOB").value;
						
					
						
						if(chargeType > 1){
							var table = document.getElementById("tableEncodeJev");
							var row = table.children[0].children.length;
							var programCode = '';
							var accountCode = '';
							var amount = '';
							
						
							for(var i = 1; i < row-1; i++ ){
								if(chargeType == 2){
									programCode += table.children[0].children[1].children[0].textContent + '~!~';
								}else{
									programCode += table.children[0].children[i].children[0].textContent + '~!~';
								}	
								accountCode += table.children[0].children[i].children[1].textContent + '~!~';	
								amount +=      table.children[0].children[i].children[2].textContent.replace(/,/g,"") + '~!~';
							}
						}else{
							var programCode = document.getElementById("saaobEncodeProgramCode").textContent;
							var accountCode = document.getElementById("saaobEncodeAccountCode").textContent;
							var amount = parseFloat(document.getElementById("saaobEncodeAmount").textContent.replace(/,/g,""));	
						}
						
						if(status == "CAO Released" || status == "Check Advised"){
							var queryString = "?saveOBRJEV=1&jevNo=" + jevNo + "&trackingNumber=" + trackingNumber + "&saaobOBRNo=" + saaobOBRNo + "&claimType=" + claimType;
								queryString += "&claimant=" + claimant + "&programCode=" + programCode + "&amount=" + amount + "&accountCode=" + accountCode;
								queryString += "&chargeType=" + chargeType + "&adv=" + saaobOBRadv + "&checkNumber=" + checkNumber;
							var container = document.getElementById('returnContainerOBRencode');
							
							
							loader();
							ajaxGetAndConcatenate(queryString,processorLink,container,"saveOBRJEV");
						}else{
							alert("Not allowed.");
						}
					
				}else{
					focusNext("saaobOBRinput");
					alert("No checknumber.");
					
				}
			}else{
				alert("Please search obr or checknumber.");
			}
		
		}else{
			alert("No jev number entered.");
		}
		
		
	}
	function submitTextUploader(){
		if(document.getElementById("inputTextFileLiquidated").value != ''){
			loader();
			var len = dataAll.split("~~");
			
			var queryString = "BeginTransfer=1&data=" + dataAll + "&accountCode=" + accountCode;
			var container = document.getElementById('returnContainerOBRencode');
			ajaxPost(queryString,processorLink,container,"BeginTransfer");
			
		}else if(document.getElementById("inputTextFileLiquidatedTN").value != ''){
			loader();
			var len = dataAll.split("~~");
			var queryString = "BeginTransferTN=1&data=" + dataAll + "&accountCode=" + accountCode;
			
			var container = document.getElementById('returnContainerOBRencode');
			ajaxPost(queryString,processorLink,container,"BeginTransferTN");
		}else{
			alert("No file selected.");
		}
		
	}

	function check(){
		validity(document.getElementById('inputTextFileLiquidated').value);
	}
	function checkTN(){
		validityTN(document.getElementById('inputTextFileLiquidatedTN').value);
	}
	function refreshInput(){
	 	document.getElementById('tdFileHolder').innerHTML = '<input style="background-color:white;padding:3px;" type = "file" name  = "inputTextFileLiquidated" id = "inputTextFileLiquidated" value = "">';
	}
	function validity(uploadValue){ 
		if(uploadValue != ''){ 
			var n = uploadValue.split('.');
			var validExtensions = ['txt','TXT'];
			var ext = uploadValue.substr(uploadValue.lastIndexOf('.') + 1);
			var found  = 0;
			for(var i=0; i < validExtensions.length; i++){
				  if(ext == validExtensions[i]){
				  	found  = 1;
				  }
			}
			if(found == 1){
				loader();
				document.getElementById('submitFileLiquidated').click();
			}else{
				 alert("Dili valid ang file.");	
				 refreshInput();
			}	
		} 
	}
	function validityTN(uploadValue){ 
		if(uploadValue != ''){ 
			var n = uploadValue.split('.');
			var validExtensions = ['txt','TXT'];
			var ext = uploadValue.substr(uploadValue.lastIndexOf('.') + 1);
			var found  = 0;
			for(var i=0; i < validExtensions.length; i++){
				  if(ext == validExtensions[i]){
				  	found  = 1;
				  }
			}
			if(found == 1){
				loader();
				document.getElementById('submitFileLiquidatedTN').click();
			}else{
				 alert("Dili valid ang file.");	
				 refreshInput();
			}	
		} 
	}	
	function getFrameByName(name) {
	
	  for (var i = 0; i < frames.length; i++)
	    if (frames[i].name == name)
	  
	      return frames[i];
	 
	  return null;
	}
	function uploadDone(me) {
		var frame = getFrameByName(me.name);
		if(frame) {
			
			 ret = frame.document.getElementsByTagName("body")[0].innerHTML;
				
			 if(ret != 0  ){
			 	if(ret != '-1'){
			 	
					loader();
				 	var mismatch = 0;
				 	var matcher = 0;
					var result = ret.split("*");
					var errs = '';	
					
					for(var i = 1; i < result.length; i++){
						var field = result[i].split("-");
						var check = field[0];
						var amount = field[1].trim(" ");
						
						
						var id  = "td4" + check;
						if(document.getElementById(id)){
							var me = document.getElementById("td4" + check).children[0];
							var you = document.getElementById("td5" + check).children[0];
							
							var jevNo =  document.getElementById("td4" + check).parentNode.children[1].textContent;
							var  engasAmount =me.textContent;
							
							//dataAll += jevNo + "," + check + "," + amount.replace(/[,"]/g,"") + "~~"; 
							dataAll += jevNo + "," + check + "," + engasAmount.replace(/[,"]/g,"") + "~~"; 
							
							var jAmount = me.textContent.trim(" ");
							you.innerHTML = amount + "&nbsp;&nbsp;&nbsp;";
							
							you.style.backgroundColor = "";
							you.style.padding = "5px 0px";
							you.style.paddingRight = "0px";
							you.style.marginRight = "0";
							you.style.textAlign = "right";
							you.style.height = "100%";
							
							you.style.width = "100%";
							
							
							if(jAmount != amount){
								me.style.backgroundColor ="rgb(253, 188, 215)";
								you.style.backgroundColor ="rgb(253, 188, 215)";
								you.parentNode.parentNode.className = "misMatch";
								mismatch = mismatch +1;
							}else{
								matcher = matcher  +1;
								you.parentNode.parentNode.className = "match";
							}
						}else{
							
							 errs += check  + ", ";
						}
					}
					
					document.getElementById("tdAffected").textContent = document.getElementById("tdFileSize").textContent - (result.length-1); 
					document.getElementById("tdMismatch").textContent = mismatch;
					document.getElementById("tdMatch").textContent = matcher;
				}else{
					loader();
					alert("No match for this account code.");
				}
				if(errs.length > 0){
					document.getElementById("returnContainerOBRencode").innerHTML += "<div style = 'padding:5px 10px;font-size:24px; '>Contact programmer on this matter : <span style = 'color:red'>"  +  errs.substring(1,errs.length-2)  + "</span></div>";
				}	
			 }
		}
	}
	function uploadDoneTN(me) {
		var frame = getFrameByName(me.name);
		if(frame) {
			 ret = frame.document.getElementsByTagName("body")[0].innerHTML;
			 if(ret != 0  ){
			 	if(ret != '-1'){
			 
					loader();
				 	var mismatch = 0;
				 	var matcher = 0;
					var result = ret.split("*");
					var errs = '';	
					
					for(var i = 1; i < result.length; i++){
						var field = result[i].split("~");
						var tn =  field[0];
						var amount = field[1].trim(" ");
						var id  = "td4" + tn;
						if(document.getElementById(id)){
							var me = document.getElementById("td4" + tn).children[0];
							var you = document.getElementById("td5" + tn).children[0];
							
							var jevNo =  document.getElementById("td4" + tn).parentNode.children[1].textContent;
							var  engasAmount =me.textContent;
							
							//dataAll += jevNo + "," + tn + "," + amount.replace(/[,"]/g,"") + "~~"; 
							dataAll += jevNo + "," + tn + "," + engasAmount.replace(/[,"]/g,"") + "~~"; 
							
							var jAmount = me.textContent.trim(" ");
							you.innerHTML = amount + "&nbsp;&nbsp;&nbsp;";
							
							you.style.backgroundColor = "";
							you.style.padding = "5px 0px";
							you.style.paddingRight = "0px";
							you.style.marginRight = "0";
							you.style.textAlign = "right";
							you.style.height = "100%";
							
							you.style.width = "100%";
							
							
							if(jAmount != amount){
								me.style.backgroundColor ="rgb(253, 188, 215)";
								you.style.backgroundColor ="rgb(253, 188, 215)";
								you.parentNode.parentNode.className = "misMatch";
								mismatch = mismatch +1;
							}else{
								matcher = matcher  +1;
								you.parentNode.parentNode.className = "match";
							}
						}else{
							
							 errs += tn  + ", ";
						}
					}
					
					document.getElementById("tdAffected").textContent = document.getElementById("tdFileSize").textContent - (result.length-1); 
					document.getElementById("tdMismatch").textContent = mismatch;
					document.getElementById("tdMatch").textContent = matcher;
				}else{
					loader();
					alert("No match for this account code.");
				}
				if(errs.length > 0){
					document.getElementById("returnContainerOBRencode").innerHTML += "<div style = 'padding:5px 10px;font-size:24px; '>Contact programmer on this matter : <span style = 'color:red'>"  +  errs.substring(1,errs.length-2)  + "</span></div>";
				}	
			 }
		}
	}
	function viewThisSAAOB(me){
		
		var searchValue = me.textContent;
		
		var queryString = "?SearchInEncodeLiquidation=1&field=CheckNumber&searchValueSaaob=" + searchValue;
		var container = document.getElementById('returnContainerOBRencode');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"SearchInEncodeLiquidation");	
	}
	function editInLiquidated(me){
		
		var checkNumber = document.getElementById("saaobCHKNo").textContent;
		
		if(checkNumber.length >= 5){
			var type = me.parentNode.childNodes.length;
			var id =  me.id.replace("theId","");
			if(type > 2){
				
				var code = document.getElementById("code" + id).textContent;
				var amount = document.getElementById("amount" + id).textContent;
				editor1(code, id,amount,"save(this)");
			}else{
				
				var code = document.getElementById("saaobEncodeAccountCode").textContent;
				var amount = me.parentNode.childNodes[0].textContent;
				editor1(code, id,amount,"save(this)");
			}
		}else{
			alert("Not allowed, no check number.");
		}
		
	}
	function save(me){
		var id  = me.id;
		var checkNumber = document.getElementById("saaobCHKNo").textContent;
		if(checkNumber){
				var code = document.getElementById("saaobEncodeAccountCode");
				if(code){
					var amountOld = document.getElementById("saaobEncodeAmount").childNodes[0].textContent.replace(/,/g,"").trim();
					var amount = document.getElementById("amountEntered" + id).value.replace(/,/g,"").trim();
				
					var res = document.getElementById("type" + id).value.split("-");
					var type = res[0];
					var charge = res[1];
					if(type == "PY"){
						field  = "Amount";
					}else{
						field = "PO_Amount";
					}
					var checkNumber = document.getElementById("saaobCHKNo").textContent;
				}else{
					var amountOld = document.getElementById("amount" + id).textContent.replace(/,/g,"").trim();
					var amount = document.getElementById("amountEntered" + id).value.replace(/,/g,"").trim();
			
					var res = document.getElementById("type" + id).value.split("-");
					var type = res[0];
					var charge = res[1];
					if(type == "PY"){
						field  = "Amount";
					}else{
						field = "PO_Amount";
					}
				}
				
				if(amount != amountOld){
					var queryString = "?EditInLiquidated=1&field=" + field + "&value=" + amount + "&id=" + id + "&checkNumber=" + checkNumber + "&type=" + type + "&charge=" + charge + "&amountOld=" + amountOld;
					var container = document.getElementById('returnContainerOBRencode');
					
					loader();
					ajaxGetAndConcatenate(queryString,processorLink,container,"EditInLiquidated");	
				}else{
					alert("Parehas lang man!");
				}
		}else{
			alert("Wala'y check number.");
		}
	}
	function viewDiff(me){
		var parent = document.getElementById("dynamicSheet");
		var trs = parent.children[0].children[0];
		var len = trs.children.length;
		for(var i = 0 ; i < len; i++){
			if(me.id == "notFound"){
				if(me.checked == true){
					if(trs.children[i].className.length != 0 ){
						trs.children[i].style.display = "none";
					}
				}else{
					trs.children[i].style.display = "table-row";
				}
			}else{
				if(me.checked == true){
					if(trs.children[i].className != me.id){
						trs.children[i].style.display = "none";
					}
				}else{
					trs.children[i].style.display = "table-row";
				}
			}
			
		}
		
		/*var misMatch = parent.getElementsByClassName("misMatch");
		var mtch = parent.getElementsByClassName("match");
		
		if(me.checked == true){
			if(me.id == "misMatch"){
				
				for(var i = 0 ; i < mtch.length; i++){
					mtch[i].style.display = 'table-row';
				}
			}else{
				
			}
		}else{
			if(me.id == "misMatch"){
				for(var i = 0 ; i < mtch.length; i++){
					mtch[i].style.display = 'none';
				}
			}else{
				
			}	
		}*/
		
		/*var parent = document.getElementById("dynamicSheet");
		var divs = parent.getElementsByClassName("mismatch");
 		alert(divs.length);*/
	}
</script>


<table class ="tableContentSAAOBEncode" border ="0">
		<tr>
			<td class="tdContent" valign="top" >
				<div style = "padding:20px;">
					<table style = "border:0px solid silver;width:100%;" border ="0">
						<tr>
							<td valign="top" style = "width:20px;background-color:rgb(238, 241, 243);padding:10px 10px;">
								<table style = "margin-top:20px;border-spacing:0;">
									<tr>
										<td colspan="2" style = "padding-left:10px;color:rgb(123, 154, 127);font-size:20px; background-color:rgb(157, 167, 134);color:white;padding:5px 10px;" class="label2">Jev by Check</td>
									</tr>
									<tr style = "background-color:rgb(234, 240, 232);"><td colspan="2" style ="padding:6px;"></td></tr>
									<tr style = "background-color:rgb(234, 240, 232);">
										<td style = "padding-left:10px;"><span class= "label2" style = "font-size:16px;"><span class = "number">1</span>OBR/CHK&nbsp;</span></td>
										<td><input id = "saaobOBRinput" value = "" class = "select2" style = "width:170px;text-align:center;font-weight:bold;font-size:16px;" onkeydown="return isValueNumber(this,event)" onkeypress="keypressAndWhat1(this,event,searchOBR,1)" maxlength="10"/></td>
									</tr>
									<tr style = "background-color:rgb(234, 240, 232);">
										<td style = "padding-left:10px;;"><span class= "label2"><span class = "number">2</span>Jev#</span></td>
										<td style = "padding-right:10px;">
											<input id = "saaobJevNumber" value = "" class = "select2" style = "background-color:white;font-size:14px;width:170px;text-align:center;font-weight:bold;" maxlength="25" onkeydown="keypressAndWhat1(this,event,saveOBRJEV,1)"/>
										</td>
									</tr>
									
									<tr style = "background-color:rgb(239, 244, 237);">
										<td colspan="" style =""></td>
										<td colspan="" style ="padding:10px;">
											<div class = "button1" onclick = "saveClick()">Save</div>
										</td>
									</tr>
								</table>
								
								<form id ="myForm" action="../ajax/uploadprocessor.php" method=post enctype='multipart/form-data' target=hiddenUploadLiq onchange="check()">
									<table style = "width:100px;margin-top:20px;border:0px solid rgb(233, 234, 233)" border = "0">
										<tr>
											<td style = "color:rgb(123, 154, 127);font-size:20px; background-color:rgb(157, 167, 134);color:white;padding:5px 10px;" class="label2">Text file(Check Number)</td>
										</tr>
										<tr>
											<td id = "tdFileHolder" style="text-align:center;padding:20px 10px;background-color:rgb(234, 240, 232);">
											<input style="background-color:white;padding:4px;font-size:14px;" type = "file" name  = "inputTextFileLiquidated" id = "inputTextFileLiquidated">
											</td>
										</tr>
									</table>
									<input type="submit" name = "submit" id = "submitFileLiquidated" value = "Load" style = "display:none;" >
									<IFRAME id="hiddenUploadLiq" name="hiddenUploadLiq" onLoad="uploadDone(this)"style='width:0;height:0;border:0px solid #fff'></IFRAME>
								</form>
								
								<form id ="myForm1" action="../ajax/uploadprocessor.php" method=post enctype='multipart/form-data' target=hiddenUploadLiqTN onchange="checkTN()">
									<table style = "width:100px;margin-top:20px;border:0px solid rgb(233, 234, 233)" border = "0">
										<tr>
											<td style = "color:rgb(123, 154, 127);font-size:20px; background-color:rgb(142, 178, 144);color:white;padding:5px 10px;" class="label2">Text file(Tracking Number)</td>
										</tr>
										<tr>
											<td id = "tdFileHolder" style="text-align:center;padding:20px 10px;background-color:rgb(234, 240, 232);">
												<input style="background-color:white;padding:4px;font-size:14px;" type = "file" name  = "inputTextFileLiquidatedTN" id = "inputTextFileLiquidatedTN">
											</td>
										</tr>
									</table>
									<input type="submit" name = "submitTN" id = "submitFileLiquidatedTN" value = "Load" style = "display:none;" >
									<IFRAME id="hiddenUploadLiqTN" name="hiddenUploadLiqTN" onLoad="uploadDoneTN(this)"style='width:0;height:0;border:0px solid #fff'></IFRAME>
								</form>
							</td>
							<td valign="top" colspan="2" rowspan="6" style="padding:10px;background-color:rgb(237, 242, 244);">
								<div id = "returnContainerOBRencode" class = "returnContainer" style="padding-top:15px; background-color:white;height:670p1x;"></div>	
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>

