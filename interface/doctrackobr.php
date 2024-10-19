
<style>
	#obrDivContainer{
		font-family:NOR;	
	}
	.balancesTableOBR,.balancesTableOBR1{
		cursor: pointer;
	}
	.balancesTableOBR th{
		background-color:rgb(70, 89, 106);
		padding:5px;
		color:white;
	}
	
	.balancesTableOBR td:nth-child(2){
		background-color:rgb(230, 232, 233);
	}
	.balancesTableOBR td:nth-child(4){
		background-color:rgb(241, 244, 230);
	}
	
	/*
		peor
	*/
	
	.balancesTableOBRpeace{
		cursor: pointer;
	}
	.balancesTableOBRpeace th{
		background-color:rgb(70, 89, 106);
		padding:5px;
		color:white;
	}
	.balancesTableOBRpeace td:nth-child(2){
		background-color:rgb(230, 232, 233);
	}
	.balancesTableOBRpeace td:nth-child(3){
		background-color:rgb(208, 214, 217);
	}
	.balancesTableOBRpeace td:nth-child(4){
		background-color:rgb(241, 244, 230);
	}
	.balancesTableOBRpeace td{
		border-bottom:1px solid white;
		border-right:1px solid white;
		
	}
	.balancesTableOBRpeace tr:hover > td{
		background-color:rgb(249, 234, 72); 
	}
	.balancesTableOBRpeace tr:nth-child(even){ 
		background-color:rgb(237, 243, 245);
	}
	/*
		peor
	*/
	
	.balancesTableOBR1 td:nth-child(2){
		background-color:rgb(234, 235, 236);	
	}
	.balancesTableOBR1 td:nth-child(4){
		background-color:rgb(241, 244, 230);	
	}
	.balancesTableOBR1 td:nth-child(6){
		background-color:rgb(241, 244, 230);	
	}
	.balancesTableOBR1 td:nth-child(8){
		background-color:rgb(230, 232, 233);	
	}
	.balancesTableOBR1 td:nth-child(9){
		background-color:rgb(241, 244, 230);	
	}
	
	.balancesTableOBR1 th{
		background-color:rgb(70, 89, 106);
		padding:5px;	
		color:white;
	}
	.balancesTableOBR td{
		border-bottom:1px solid white;
		
	}
	
	.balancesTableOBR1 td{
		border-bottom:1px solid white;
	}
	.balancesTableOBR tr:hover > td{
		background-color:rgb(249, 234, 72); 
	}
	.balancesTableOBR1 tr:hover > td{
		background-color:rgb(249, 234, 72); 
	}
	.balancesTableOBR tr:nth-child(even){ 
		background-color:rgb(237, 243, 245);
	}
	.balancesTableOBR1 tr:nth-child(even){ 
		background-color:rgb(237, 243, 245);
	}
	
	/*sa edit peor*/
	#tablePeaceAndOrder td:nth-child(2){
		background-color:rgb(241, 244, 230);
	}
	#tablePeaceAndOrder tr:hover>td{
		background-color:rgb(249, 234, 72); 
		font-weight: bold;
	}
	#refreshBalanceIco:hover{
		border:2px solid orange;
		box-shadow: 0px 0px 2px 1px silver;
	}
	
</style>

<div  id = "obrDivContainer"  >
	<table border = "0" style = "width:100%;border-spacing:4px;">
		<tr>
			<td colspan="2" style="background-color: rgb(248, 248, 246);">
				<table style="width:800px;" border ="0">
					<tr>
						<td style = "width:100px;padding:0;padding-right:5px;text-align: right;"><div id = "refreshBalanceIco" onclick="refreshBalance()" style = "border:1px solid silver; border-radius:2px; cursor:pointer; float:left;background:url(../images/refresh.png);background-size:100%; width:18px;height:18px;"></div>Source&nbsp;Fund</td>
						<td style = "width:10px;padding:0;">
								<input id ="inputCodeDisplay" value ="" style ="border:0; border-bottom:1px solid silver;text-align: center;width:120px;" onkeydown = "keypressAndWhatClear(this,event,searchTransactionBalance,1)">
						</td>
						<td id ="obrOfficeContainer" style ="width:0px;padding:0;" >
							&nbsp;
						</td>
						<td style ="font-weight: bold;letter-spacing:1px;" id = "obrFundDescription" onclick="clickSelect()">
							&nbsp;
						</td>
					</tr>
				</table>	
			</td>
		</tr>
		<tr>
			<td  style = "vertical-align:top;width:100px;padding:5px;">
				<div id = "summary1">
					
				</div>
			</td>
			<td  style = "vertical-align:top;padding:5px;">
				<div id = "summary2" ></div>
			</td>
		
		</tr>
		
	</table>
	
</div>
<script>
	whenOBRbalanceRefresh();
	var expenseCodeBalance = "";
	function whenOBRbalanceRefresh(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Balance"){
				loadOBRfunds();
			}
		}
	}
	function searchTransactionBalance(me){
		var code = me.value.trim();
		var iCode = code;
		var s = document.getElementById("selectOBRfund");
		for ( var i = 0; i < s.options.length; i++ ) {
		    if( s.options[i].value == code ) {
	            s.options[i].selected = true;
	           break;
	        }
	    }
	  
	    s.selectedindex = i;
	    var desc = s.options[s.selectedIndex].text;
		var code = s.value.trim();
		if(s.options.length != i){
			
			var newDesc = desc.replace(code,"");
			document.getElementById("obrFundDescription").innerHTML = "<span style = 'font-weight:bold;color:rgb(1, 130, 185);'>" + code + "</span>" +  newDesc;
			
			var queryString = "?selectFundOBR=1&code=" + code;
			var container = document.getElementById('summary1');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
		}else{
			alert(iCode  + " program code not found.");
		}
	}
	
	function loadOBRfunds(){
		var queryString = "?loadOBRfunds=1";
		var container = document.getElementById('obrOfficeContainer');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
	}
	function selectFundOBR(me){
		
		var desc = me.options[me.selectedIndex].text;
		var code = me.value.trim();
		
		var newDesc = desc.replace(code,"");
		document.getElementById("obrFundDescription").innerHTML = "<span style = 'font-weight:bold;color:rgb(1, 130, 185);'>" + code + "</span>" +  newDesc;
		
		
		inputCodeDisplay.value = code;
		
		var queryString = "?selectFundOBR=1&code=" + code;
		var container = document.getElementById('summary1');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
		document.getElementById('summary2').innerHTML = "";
	}
	var lastRow = -1;
	var lastTable = -1; 
	var lastTRcolor = '';
	function changeTRcolor(me,type){
		
		if(lastTable  >= 0){
			var container = document.getElementById("summary1");
			
			var div = container.children[lastTable];
		
			if(div.children[0].children[0].children[lastRow]){
				var tr = div.children[0].children[0].children[lastRow];
				for(var i  = 0; i < tr.children.length; i++){
					tr.children[i].style.borderBottom = "1px solid white";
					tr.children[i].style.fontWeight = "normal";
					tr.style.fontWeight = "normal";
				}
			}
		}
		for(var i  = 0; i < me.children.length; i++){
			me.children[i].style.borderBottom = "2px solid rgb(239, 91, 167)";
			me.children[i].style.fontWeight = "bold";
		}
		
		if(type == "PY"){
			lastTable = 0;
		}else if(type == "PR"){
			lastTable = 1;
		}else{
			lastTable = 2;
		}
		lastRow = me.rowIndex;
	}
	//test();
	function refreshBalance(){
		var program =  selectOBRfund.value.trim();
		if(program.length > 0 ){
			var queryString = "?selectFundOBR=1&code=" + program ;
			var container = document.getElementById('summary1');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
		}
		
	}
	function test(){
		var queryString = "?selectFundOBR=1&code=1091";
		var container = document.getElementById('summary1');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
	}
	function selectTransactionsInBalances(me){
		var program =  selectOBRfund.value.trim();
		var pId ="";
		if(program == "1011-1"){
			var arr = me.children[0].id.split("*");
			var expenseCode = arr[0];
			pId = arr[1];
			
		}else{
			var expenseCode = me.children[1].textContent;
		}
		expenseCodeBalance = expenseCode;
		document.body.scrollTop = 0;
		
		var type = me.id;
		changeTRcolor(me,type);
		var queryString = "?selectTransactionsInBalances=1&program= " + program + "&expenseCode=" + expenseCode + "&type=" + type + "&pId=" + pId;
		var container = document.getElementById('summary2');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
	}
	function toExcel1(me){
		
		var filename  = document.getElementById('tableOBRtransactions').children[0].children[0].textContent;
		
		
		exportToExcel(filename,document.getElementById('tableOBRtransactions'));
	}
	
	function printView(){
		var table = document.getElementById("tableOBRtransactions");
		var title = document.getElementById('tableOBRtransactions').children[0].children[0].textContent;
		newWin= window.open("");
		newWin.document.write('<html><head><title>' + title + '</title>');
		newWin.document.write('<link rel="icon" href="/city/images/print.png">');
		newWin.document.write('<link rel="stylesheet" href="../css/alldump.css">');
		newWin.document.write('</head><body>');
		newWin.document.write(table.outerHTML);
		newWin.document.write('</body></html>');
		newWin.document.close();
	}
	function clickThisBalance(me){
		var trackingNumber = me.textContent.trim();
		var cont = document.getElementById("doctrackMenuContainer");
		for(var i = 0 ; i < cont.children.length; i++){
			if(cont.children[i].textContent == "Tracker"){
				cont.children[i].click();
				break;
			}
		}
		var queryString = "?searchTrackingNumber=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"searchTrackingNumber");
	}
	
	
	function changeSubcode(me){
		var tn = me.parentNode.children[1].textContent;
		var queryString = "?fetchSubProgramBalance=1&tn=" + tn;
		var container = "";
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchSubProgramBalance");	
	}
	function selectSubProgramPeace(me){
		var arr = me.id.split("*");
		var officeId = arr[0];
		var subcode = arr[1];
		var tn = arr[2];
		document.getElementById("clickClose").click();
		var program =  selectOBRfund.value.trim();
		var queryString = "?updatePeaceSubcode=1&officeId=" + officeId + "&subcode=" + subcode + "&program=" + program + "&expenseCode=" + expenseCodeBalance + "&tn=" + tn;
		var container = document.getElementById('summary2');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
		
	}
</script> 








