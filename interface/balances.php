
<style>
	#balanceSet{
		min-height:600px;	
		padding:5px;
		font-family: Oswald;
	}
	.trHead{
		border-bottom: 1px dashed grey;
		border-top: 1px solid #AEB5B6;
		letter-spacing: 1px;
		font-weight: bold;
		font-size:12px;
		text-align:center;
		padding:5px 10px;
	}
	
	.tdDataBalance{
		padding:5px 10px;
		font-size:13px;
		border-bottom:1px solid silver;
		border-right:1px solid silver;
		cursor: pointer;
		vertical-align: top;
		
		text-overflow:nowrap;
		white-space: nowrap;

	}
	
	.trData:hover > td{
		background-color:rgb(251, 244, 181);	
		color:black
	}
	
	.hoverLabel{
		color:green;
	}
	.hoverLabel:hover{
		color:white;
		text-shadow: 0px 0px 1px black;
	}
	.hoverPrint{
		font-size:28px;
		font-weight:bold;
	}
	.hoverPrint:hover{
		color:green;
		text-shadow: 0px 0px 1px orange;
		cursor: pointer;
		
	}
</style>

<div  id = "balanceSet"  >
	<table border = "0" style = "width:100%;border-spacing:4px;">
		<tr>
			<td  style = "vertical-align:top;background-color:rgb(211, 221, 226);width:100px;padding:5px;min-width:500px;" onmouseover = "moveLeft()" >
				<div id = "summary1">
					<span onclick ="loadSummary()" style = "cursor:pointer;margin-left:10px;font-size:38px;"  class = "hoverLabel">&#9851;</span>Reload
				</div>
				<div id = "summary2" ></div>
			</td>
			<td  style = "vertical-align:top;background-color:rgb(200, 212, 213);padding:5px;width:500px;" onmouseover = "moveRight()">
				<div id = "summary3" ></div>
			</td>
		
		</tr>
		
	</table>
</div>
<script>

	whenBalances();
	function whenBalances(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Balance"){
				loadSummary();	
			}
		}
	}
	
	function selectWhatOffice(me){
		
		var searchType = document.getElementById("")
		var queryString = "?selectWhatOffice=1&program=" + me.value;
		var container = document.getElementById('tableForBalance');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"selectWhatOffice");	
	}
	
	function loadSummary(){
		var searchType = document.getElementById("")
		var queryString = "?loadSummary=1";
		var container = document.getElementById('summary1');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadSummary");	
	}
	var p1Prog;
	var p2Des;
	var p3Prog;
	var p4Des;
	var p3Acct = 0;
	function clickTR(me){
		
		var period = document.getElementById("balancePeriod").value;
		var month = document.getElementById("periodBalanceMonth").value;
		var day = document.getElementById("periodBalanceDay").value;
		var year = document.getElementById("periodBalanceYear").value;
		
		var queryString = "?loadBalanceByProgram=1&program=" + me.id + "&period=" + period + "&periodDay=" + day +  "&periodYear=" + year + "&periodMonth=" + month ;
		var container = document.getElementById('summary2');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadBalanceByProgram");	
		highlightBalance(me,"rgb(235, 241, 244)");
		p1Prog = me.children[1].children[0].textContent;
		p2Des =  me.children[1].children[1].textContent;
		
		p3Acct = 0;
	}
	
	function clickTRAcct(me){
		
		var period = document.getElementById("balancePeriod").value;
		var month = document.getElementById("periodBalanceMonth").value;
		var day = document.getElementById("periodBalanceDay").value;
		var year = document.getElementById("periodBalanceYear").value;	
		
		highlightBalance(me,"rgb(236, 248, 238)");
		var accountCode = me.id;
		var program = document.getElementById('p1').textContent;
		var queryString = "?loadBalanceByAccount=1&accountCode=" + accountCode + "&program=" + program + "&period=" + period + "&periodDay=" + day +  "&periodYear=" + year + "&periodMonth=" + month ;
		var container = document.getElementById('summary3');

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadBalanceByAccount");	
		
		p3Acct = me.children[1].childNodes[0].textContent;
		p4Des =  me.children[1].childNodes[1].textContent;
	}
	function searchThisBalance(me){
		
		searchThisPartner(me);
		document.getElementById("doctrackMenuContainer").children[0].click();
		
		var me = me.parentNode;

		highlightBalance(me,"rgb(219, 221, 221)");
	}
	function highlightBalance(me,colr){
		var parent = me.parentNode.children;
		var len = me.parentNode.children.length;
		for(var i = 2 ; i < len; i++){
			if(i % 2 == 0){
				color = colr;
			}else{
				color = "white";
			}
			parent[i].style.backgroundColor = color;
			parent[i].style.color = "black";
		}
		me.style.backgroundColor = "rgb(86, 103, 112)";
		me.style.color = "white";
	}
	function previewBalance(){
		var program = document.getElementById('p1').textContent;
		window.open("../interface/formBalance.php?pc=" + program +  "");
	}
	function checksOnly(me){
		if(me.checked == 1){
			var table = document.getElementById("tableBalancesDetails");
			var len = table.children[0].children.length;
			var total = 0;
			for(var i = 2 ; i < len; i++){
				var checkNo =table.children[0].children[i].children[10].textContent;
				if(checkNo == ''){
					table.children[0].children[i].style.display ="none";
				}else{
					var checkAmount =table.children[0].children[i].children[9].textContent;
					checkAmount = checkAmount.replace(/,/g,"");
					total =  parseFloat(total)  + parseFloat(checkAmount);
				}
			}
			var tr = document.createElement('tr');
				tr.innerHTML = "<td colspan = '9'></td><td style = 'font-weight:bold;font-size:12px;letter-spacing:1px;'>" +  numberWithCommas(round2(total)) + "</td>";
			table.children[0].appendChild(tr);
		}else{
			var table = document.getElementById("tableBalancesDetails");
			var len = table.children[0].children.length;
			for(var i = 2 ; i < len; i++){
				var checkNo =table.children[0].children[i].children[8].textContent;
				if(checkNo == ''){
					table.children[0].children[i].style.display ="table-row";
				}
			}
		}
		
	}
	function selectWhatPeriod(me){
		if(me.value > 1){
			document.getElementById("tableBalanceDate").style.display = "block";
		}else{
			document.getElementById("tableBalanceDate").style.display = "none";
		}
	}
	function previewChecks(){
		var period = document.getElementById("balancePeriod").value;
		if(period > 1){
			var month = document.getElementById("periodBalanceMonth").value;
			var day = document.getElementById("periodBalanceDay").value;
			var year = document.getElementById("periodBalanceYear").value;
			
			
			var queryString = "?a=" + p3Acct + "&pr=" + p1Prog + "&p=" 
			                        + period + "&d=" + day +  "&y=" 
			                        + year + "&m=" 
			                        + month;
			
			window.open("../interface/formCheckIssued.php" + queryString +  "");
		}else{
			alert("Please select view type.");
		}
		
	}
	function moveRight(){
		var w =  document.body.scrollWidth;
		document.body.scrollLeft = w;
	}
	
	
	
	function moveLeft(){
		document.body.scrollLeft = 0;
	}
	function excelChecks(){
		var period = document.getElementById("balancePeriod").value;
		if(period > 1){
			var period = document.getElementById("balancePeriod").value;
			var month = document.getElementById("periodBalanceMonth").value;
			var day = document.getElementById("periodBalanceDay").value;
			var year = document.getElementById("periodBalanceYear").value;	
			var queryString = "?checksExcel=1&accountCode=" + p3Acct + "&program=" + p1Prog + "&period=" + period + "&periodDay=" + day +  "&periodYear=" + year + "&periodMonth=" + month ;
			var container = "";
			
			window.open('../ajax/excelCreator.php' + queryString + ' ','_top');
			
		}else{
			alert("Please select view type.");
		}	
	}
</script> 