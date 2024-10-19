
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	$val = $_GET['val'];
	
	if(isset($_COOKIE['RequestedBy'])){
		$head = $_COOKIE['RequestedBy'];
	}else{
		$head = '';
	}

	if(isset($_COOKIE['RequestedDesignation'])){
		$headDesignation = $_COOKIE['RequestedDesignation'];
	}else{
		$headDesignation = 'Department Head';
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
	
	if(isset($_COOKIE['ControlledBy'])){
		$controlledBy = $_COOKIE['ControlledBy'];
	}else{
		$controlledBy = '';
	}
	if(isset($_COOKIE['ControlledDesignation'])){
		$controlledDesignation = $_COOKIE['ControlledDesignation'];
	}else{
		$controlledDesignation = 'Purchasing Supply Officer';
	}
?>


<style>
	body {
		padding:0;
		margin:0;
		font-family: arial;
	}
	.tablePPMPheader{
		text-align: center;
		width:100%;
		border-spacing: 0;
		border-bottom: 1px solid black;
	}
	.tablePPMPheader .trHeader{
		font-size: 12px;
		font-weight: bold;
	}
	.trHeader td{
		border-top:1px solid black;
		border-left:1px solid black;
		padding:0px 2px;
	}
	.tablePPMPheader .tdData{
		font-size: 13px;
		border-top:1px solid black;
		border-left:1px solid black;
		padding:0px 2px;
	}
	#ppmpFormContainer{
		margin:0;
	}
	
	.divContent{
		height:690px;width: 100%;overflow: auto;margin:0 auto;
		//border:2px solid black;
	}
	#tableSummary{
		border-spacing: 0;
		border-top:1px solid black;
		border-right:1px solid black;
	}
	#tableSummary .tdHeader{
		font-weight: bold;
	}
	#tableSummary .tdData , .tdHeader{
		padding:2px 5px;
		border-bottom: 1px solid black;
		border-left: 1px solid black;
		font-size: 14px;
	}
	.sig{
		border:0;
		border-bottom:1px solid black;
		padding:2px 10px;
		text-align: center;
		font-size:12px;
		font-weight: bold;
		width:300px;
	}
	.sigTitle{
		border:0;
		
		padding:2px 20px;
		text-align: center;
		font-size:11px;
		width:250px;
	}
</style>
<!DOCTYPE HTML>
<html>
	<title>PPMP Form</title>
	<link rel="icon" href="/citydoc2018/images/red.png"/> 
	<body>
		<div id = "ppmpFormContainer" style = "width:1150px;margin:0 auto;padding:0;">
			<div  class = "divContent" ></div>
		</div>
	</body>
</html>
<script>
	var head = "<?php echo $head; ?>";
	var headDesignation = "<?php echo $headDesignation; ?>";
	
	var certBy = "<?php echo $certifiedBy; ?>";
	var certDesignation = "<?php echo $certifiedDesignation; ?>";
	
	
	
	var controlledBy = "<?php echo $controlledBy; ?>";
	var controlledDesignation = "<?php echo $controlledDesignation; ?>";
	
	viewPPMP();

	function viewPPMP(){
		var  val = "<?php  echo $val ?>";
		var arr = val.split('~');
		var entry = arr[2];
		
		if(entry.substring(0,1) == 'S'){
			headerEntry = "<span style = 'font-weight:bold;' >" + entry  + "</span>"; 
		}else{
			headerEntry = '';
		}
		var container = document.getElementById("poMain");
		var queryString = "?previewPPMP&val=" + encodeURIComponent(val) ;
		ajaxGetAndConcatenate1(queryString,processorLink,container,"previewPPMP");			
	}
	var officeName;
	var fundSource;
	
	function createSheetPPMP(details){
		
		var txt = '';
		var j = JSON.parse(details);
		
		var len =  j.description.length;
		
		var lenConso = j.consoCode.length;
		
		
		officeName =  j.officeName;
		var programCode =  j.programCode;
		var programDescription =  j.programDescription;
		fundSource = programCode + " " + programDescription;
		
		
		var c = ppmpFormContainer.children.length;
		var div = ppmpFormContainer.children[c-1];
		div.innerHTML += headerPPMP(officeName,fundSource);
		div.innerHTML += tableHeaderPPMP();
		
		var dLen = div.children.length;
		var table = div.children[dLen-1];
		
		var k=1;
		var l = 1;
		var first = 1;
		for(var i = 0; i < len; i++){
			var acct = j.accountCode[i];
			var desc = j.description[i];
			var unit = j.unit[i];
			var total = j.total[i];
			
			var jan = toNothing(j.jan[i]);
			var feb = toNothing(j.feb[i]);
			var mar = toNothing(j.mar[i]);
			var apr = toNothing(j.apr[i]);
			var may =toNothing( j.may[i]);
			var jun =toNothing( j.jun[i]);
			
			var jul = toNothing(j.jul[i]);
			var aug =toNothing( j.aug[i]);
			var sep = toNothing(j.sep[i]);
			var oct = toNothing(j.oct[i]);
			var nov =toNothing( j.nov[i]);
			var dec =toNothing( j.dec[i]);
			
			var qty = parseInt(toZero(jan)) + parseInt(toZero(feb)) + parseInt(toZero(mar)) + parseInt(toZero(apr)) + parseInt(toZero(may)) + parseInt(toZero(jun)) + parseInt(toZero(jul))+ parseInt(toZero(aug))+ parseInt(toZero(sep))+ parseInt(toZero(oct))+ parseInt(toZero(nov))+ parseInt(toZero(dec));
			table.innerHTML +=  '<tr><td  class = "tdData" >' +  acct + '</td><td  class = "tdData" style = "text-align:left;padding-left:5px;">' +   desc + '</td><td  class = "tdData" style = "text-align:left;">' +qty + ' ' +   unit + '</td><td  class = "tdData" style = "text-align:right;">' +  total + '</td><td  class = "tdData">' +  jan + '</td><td  class = "tdData">' + feb+ '</td><td  class = "tdData">' + mar+ '</td><td  class = "tdData">' + apr+ '</td><td  class = "tdData">' + may+ '</td><td  class = "tdData">' + jun+ '</td><td  class = "tdData">' + jul+ '</td><td  class = "tdData">' + aug+ '</td><td  class = "tdData">' + sep+ '</td><td  class = "tdData">' + oct+ '</td><td  class = "tdData">' + nov+ '</td><td  class = "tdData"  style = "border-right:1px solid black;">' + dec+ '</td></tr>';
			if(div.scrollHeight > div.offsetHeight){
				if(desc.length < 3000){          // mga dorma desc dili taas so regular loop lng
					i--;
					table.removeChild(table.children[table.children.length-1]);
					ppmpFormContainer.innerHTML += tableFooterPPMP();
					ppmpFormContainer.innerHTML += '<div  class = "divContent" ></div>';
					var c = ppmpFormContainer.children.length;
					var div = ppmpFormContainer.children[c-1];
					div.innerHTML += headerPPMP(officeName,fundSource);
					div.innerHTML += tableHeaderPPMP();
					var dLen = div.children.length;
					var table = div.children[dLen-1];
				}else{
					while(div.scrollHeight > div.offsetHeight){        // mga taas kaayo na desc sobra 1 page
						var td = table.children[table.children.length-1].children[0].children[1];
						var old = desc;
						while(div.scrollHeight > div.offsetHeight){
							var lastIndex = desc.lastIndexOf(" ");
							desc = desc.substring(0, lastIndex);		
							td.innerHTML = desc +" ";
						}
						var exist =  old.replace(desc,"");
						ppmpFormContainer.innerHTML += tableFooterPPMP();
						ppmpFormContainer.innerHTML += '<div  class = "divContent" ></div>';
						var c = ppmpFormContainer.children.length;
						var div = ppmpFormContainer.children[c-1];
						div.innerHTML += headerPPMP(officeName,fundSource);
						div.innerHTML += tableHeaderPPMP();
						var dLen = div.children.length;
						var table = div.children[dLen-1];
						
						table.innerHTML +=  '<tr><td  class = "tdData" ></td><td  class = "tdData" style = "text-align:left;padding-left:5px;">' +   exist + '</td><td  class = "tdData" style = "text-align:left;">&nbsp;</td><td  class = "tdData" style = "text-align:right;">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData">&nbsp;</td><td  class = "tdData"  style = "border-right:1px solid black;">&nbsp;</td>';
						table.innerHTML +=  '</tr>';
						desc = exist;
					}
				}
				
			}
		}
		ppmpFormContainer.innerHTML += tableFooterPPMP();		
		assignPageTotal();
		
		
		ppmpFormContainer.innerHTML += '<div  class = "divContent" ></div>'; //summary
		var c = ppmpFormContainer.children.length;
		var div = ppmpFormContainer.children[c-1];
		div.innerHTML += headerPPMP(officeName,fundSource);
		div.innerHTML += tableHeaderConsoPPMP(officeName,fundSource);
		
		var dLen = div.children.length;
		var table = div.children[dLen-1];
		
		
		var gTotal = 0; // consolidated
		for(var i = 0; i < lenConso; i++){
			var acct = j.consoCode[i];
			var desc = j.consoDesc[i];
			var total = j.consoTotal[i];
			gTotal = parseFloat(gTotal) +parseFloat(total);
			table.innerHTML +=  '<tr><td class= "tdData">' + acct + '</td><td class= "tdData">' + desc + '</td><td class= "tdData" style = "text-align:right;">' + numberWithCommas(total) + '</td></tr>';
			
			if(div.scrollHeight > div.offsetHeight){
				i--;
				table.removeChild(table.children[table.children.length-1]);
				ppmpFormContainer.innerHTML += tableFooterPPMP();
				ppmpFormContainer.innerHTML += '<div class = "divContent" ></div>';
				var c = ppmpFormContainer.children.length;
				var div = ppmpFormContainer.children[c-1];
				div.innerHTML += headerPPMP(officeName,fundSource);
				div.innerHTML += tableHeaderConsoPPMP();
				gTotal = parseFloat(gTotal) - parseFloat(total);
				var dLen = div.children.length;
				var table = div.children[dLen-1];
			}
		}
		table.innerHTML +=  trConsoTotal(gTotal);         //if mag overflow kung mabutangan total first page lng and add
		if(div.scrollHeight > div.offsetHeight){
			
			table.removeChild(table.children[table.children.length-1]);
			ppmpFormContainer.innerHTML += tableFooterPPMP();
			ppmpFormContainer.innerHTML += '<div class = "divContent" ></div>';
			var c = ppmpFormContainer.children.length;
			var div = ppmpFormContainer.children[c-1];
			div.innerHTML += headerPPMP(officeName,fundSource);
			div.innerHTML += tableHeaderConsoPPMP();
			var dLen = div.children.length;
			var table = div.children[dLen-1];
			table.innerHTML +=  trConsoTotal(gTotal);
		}
		ppmpFormContainer.innerHTML += tableFooterPPMP();		
		assignPageTotal();
		
		ppmpFormContainer.innerHTML += '<div  class = "divContent" ></div>';//signatories
		var c = ppmpFormContainer.children.length;
		var div = ppmpFormContainer.children[c-1];
		div.innerHTML += headerPPMP(officeName,fundSource);
		div.innerHTML += signatories();
		ppmpFormContainer.innerHTML += tableFooterPPMP();
		assignPageTotal();
		

	}
	
	function assignPageTotal(){
		var cl = document.getElementsByClassName("pageTotal");
		for(var i = 0 ; i < cl.length; i++){
			cl[i].innerHTML = "Page " + (i+1) + " of " +  cl.length;
		}
	}
	function headerPPMP(officeName,fundSource){	
	
		var h  = '<table style = "margin:0 auto;margin-top:25px;width:100%;border-spacing:0;"  ><tr><td style = "text-align:center;">';
			 h  += '		<span style = "font-weight:bold;font-size:20px;">City Government of Davao</span>';
			 h  += '		<span style = "display:block;">City Hall Drive San Pedro Street, Davao City</span>';
			 h  += '		</td>';
			 h  += '	</tr>';
			 h  += '	<tr>';
			 h  += '		<td style = "text-align:center;font-weight:bold;font-size:20px;">PROJECT PROCUREMENT MANAGEMENT PLAN</td>';
			 h  += '	</tr>';
			 h  += '	<tr>';
			 h  += '		<td style = "text-align:center;font-size:16px;">January - December '+year+' </td>';
			 h  += '	</tr>';
			 h  += '	<tr>';
			 h  += '		<td style = "font-size:14px;padding-top:25px;"><div style = "display:inline-block;width:132px;text-align:right;">OFFICE/UNIT</div> : <b>' + officeName + '</b></td>';
			 h  += '	</tr>';
			  h  += '	<tr>';
			 h  += '		<td style = "font-size:14px;">SOURCE OF FUNDS : ' + headerEntry + ' ' + fundSource + '</td>';
			 h  += '	</tr>';
			 h  += ' </table>';
		return h;
	}
	function tableHeaderPPMP(){	
		var	h = '<table class ="tablePPMPheader" ><tr class = "trHeader">';
			h += '	<td rowspan = "2" >CODE</td>';
			h += '	<td rowspan = "2">GENERAL DESCRIPTION</td>';
			h += '	<td rowspan = "2">QTY / UNIT</td>';
			h += '	<td rowspan = "2">EST. BUDGET</td>';
		
			h += '	<td colspan = "12" style = "text-align:center;border-right:1px solid black;">SCHEDULE/MILESTONE OF ACTIVITIES</td>';
			h += '</tr>';
			h += '<tr class = "trHeader">';
			h += '	<td>Jan</td>';
			h += '	<td>Feb</td>';
			h += '	<td>Mar</td>';
			h += '	<td>Apr</td>';
			h += '	<td>May</td>';
			h += '	<td>Jun</td>';
			h += '	<td>Jul</td>';
			h += '	<td>Aug</td>';
			h += '	<td>Sep</td>';
			h += '	<td>Oct</td>';
			h += '	<td>Nov</td>';
			h += '	<td style = "border-right:1px solid black;">Dec</td>';
			h += '</tr></table>';	
		return h;
	}
	function tableHeaderConsoPPMP(){	
		var	h = '<table id = "tableSummary" style = "width:100%;margin-top:10px;border-top:0;"><tr class = "trHeader">';
			h += '	<td class= "tdHeader">Code</td>';
			h += '	<td class= "tdHeader">Title</td>';
			h += '	<td class= "tdHeader" style = "text-align:center;">Total Estimated</td>';
			h += '</tr></table>';
		return h;
	}
	function trConsoTotal(gTotal){
		var h = '<tr>';
		      h += '<td colspan = "3" class= "tdData" style = "text-align:right;padding:10px 5px;"><span style = "margin-right:10px;">Total</span><span style = "font-weight:bold;font-size:15px;">' + numberWithCommas(gTotal.toFixed(2)) + '</span></td>';
		      h += '</tr>';
		      return h;
	}
	function tableFooterPPMP(){	
		var	h = '<div style = "font-size:12px;">';
			h += 'Note : Technical Specifications for each Item/Project being propose shall be submitted as part of the PPMP.<span class = "pageTotal" style = "float:right;margin-right:20px;"></span>'; 
			h +='</div>';	
		return h;
	}
	
	function summaryCodes(summary){
		var h = '<div>' + summary + '</div>';
		return h;
	}
	function signatories(){
		var h = '<table style = "width:100%;height:400px;border:1px solid black;margin-top:10px;" >';
			h += '<tr>';
			h += '<td style = "vertical-align:bottom;padding-bottom:150px;padding-left:50px;">Prepared By:</td>';
			h += '<td style = "vertical-align:bottom;padding-bottom:150px;">Certified Correct By:</td>';
			h += '<td style = "vertical-align:bottom;padding-bottom:150px;">Submitted By:</td>';
			h += '<tr>';
			
			h += '<tr>';
			h += '<td style = "text-align:center;height:120px;vertical-align:top;"><input id = "control" class ="sig" value = "' + controlledBy + '" onkeyup = "saveCookie(this)"/><input  id = "controlDes" class = "sigTitle"  value = "' + controlledDesignation + '" onkeyup = "saveCookie(this)"/></td>';
			h += '<td style = "text-align:center;vertical-align:top;"><input id = "certified" class ="sig" value = "' + certBy + '" onkeyup = "saveCookie(this)"/><input id = "certifiedDes" class = "sigTitle"  value = "' + certDesignation + '" onkeyup = "saveCookie(this)"/></td>';
			h += '<td style = "text-align:center;vertical-align:top;"><input id = "head" class ="sig" value = "' + head + '" onkeyup = "saveCookie(this)"/><input id = "headDes" class = "sigTitle"  value = "' + headDesignation + '" onkeyup = "saveCookie(this)"/></td>';
			h += '</tr>';
			
			h += '</table>';
			return h;
	}
	function saveCookie(me){
		var id = me.id;
		var value = me.value;
		if(id == "control"){
			setCookie ("ControlledBy",value, 100);
		}else if(id == "certified"){
			setCookie ("CertifiedBy",value, 100);
		}else if(id == "head"){
			setCookie ("RequestedBy",value, 100);
		}else if(id == "controlDes"){
			setCookie ("ControlledDesignation",value, 100);
		}else if(id == "certifiedDes"){
			setCookie ("CertifiedDesignation",value, 100);
		}else if(id == "headDes"){
			setCookie ("RequestedDesignation",value, 100);
		}
	}
</script>