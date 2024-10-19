<style>
	.tableContentLiquidated{
		background-color:white;
		width:1690px;
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
	}
	
	.selectOfficeLiquidated{
		width:320px;
	}
	.liquidatedCodeContainer{
		
		border-left:1px solid rgb(218, 229, 219);
		
		margin-left:80px;
		width:1320px;
		overflow-x:auto;
	}
	.programCodeContainerAuto{
		border:1px solid rgb(245, 244, 244);
		width:400px;
		overflow-x:auto;
	}
	.programCodeContainerFix{
		border:1px solid rgb(245, 244, 244);
		width:400px;
		height:400px;
		overflow-x:auto;
		overflow-y:auto;
	}
	.headerCodes{
		cursor:pointer;
		font-weight:bold;
		width:100px;
		background-color:rgb(246, 250, 247);
		border-bottom:1px solid rgb(232, 237, 231);
		border-right:1px solid rgb(232, 237, 231);
		
		padding:5px;
		color:rgb(41, 164, 78);
	}
	.headerCodes:hover{
		background-color:rgb(201, 221, 206);
		
		font-weight:bold;
	}
	.tdSAAOBHeader1{
		padding:2px 5px;
		text-align:center;
		background-color:white;
		font-size:15px;
		font-weight:bold;
		border-radius:2px 2px 0px 0px;
	}
	.returnContainerLiquidatedCodeTotal{
		width:150px;
		height:100%;
	}
	.tdSAAOBHeader3{
		background-color:rgba(167, 197, 180,.5);
		font-size:15px;
		font-weight:bold;
		border-radius:2px 2px 0px 0px;
	}
	.tdMonth{
		background-color:white;
		padding:5px 2px;
		text-align:center;
		
	}
</style>

	<table class ="tableContentLiquidated" border ="0">
	
		<tr>
			<td class="tdContent" valign="top" >
				<div style = "padding:20px;">
					<table style = "width:100%;" border ="0">
						<tr>
							<td valign="top" style = "width:50px;">
								<table style = "margin-top:5px;">
									<tr>
										<td id  ="liquidatedOfficeTd"  ><span class = "number1">1</span><span class = "label3">Office</span></td>
										
									</tr>
									
									<tr>
										<td id = "saaobOfficeLiquidated">
											<select class="select2" style = "width:320px;" >
												<option>&nbsp;</option>
											</select>
										</td>
									</tr>
									<tr id  = "tr2MainA" style = "display:none;">
										<td  style="vertical-align:top;"><span class = "number1" >2</span><span class = "label3">Program List</span></td>
									</tr>
									<tr id  = "tr2MainB" style = "display:none1;">
										<td colspan="4" >
											<div  id = "programCodeLiquidatedHeaderContainer" style = "overflow-x:hidden;width:320px;"></div>
											<div  id = "programCodeLiquidatedContainer"  ></div>
											<div style = "padding:2px">
												<table id = "tableOtotal" border ="0" style = "float:right;padding:5px;display:none;">
													<tr>
														<td colspan="2" style="text-align:right;padding-right:60px;">
															<span id = "oRow" style = "font-size:17px;font-style:italic; font-weight:bold;" ></span>
															<span id  = "oRowLabel" style = "font-size:12px;font-style:italic; "></span>
														</td>
													</tr>
													<tr>
														<td style="text-align:right;border-top:1px solid rgb(235, 239, 235);">
															<span id = "oAB" style = "padding:0px 5px; font-size:15px;color:rgb(12, 129, 10);letter-spacing:1px;background-color:rgb(228, 236, 228);border-right:1px solid silver; " ></span></td>
														<td ><span  style = "color:grey;font-size:12px;">BUDGET</span></td>
													</tr>
													<tr>
														<td style="text-align:right;"><span id = "oOBR" style = "padding:0px 5px;font-size:15px;color:rgb(12, 129, 10);letter-spacing:1px;background-color:rgb(228, 236, 228); border-right:1px solid silver;" ></span></td>
														<td ><span  style = "color:grey;font-size:12px;">OBLIGATED</span></td>
													</tr>
													<tr>
														<td style="text-align:right;"><span id = "oSAV" style = "padding:0px 5px;font-size:15px;color:rgb(12, 129, 10);letter-spacing:1px;background-color:rgb(228, 236, 228);border-right:1px solid silver; " ></span></td>
														<td ><span  style = "color:grey;font-size:12px;">SAVINGS</span></td>
													</tr>
													<tr>
														<td style="text-align:right;"><span id = "oJEV" style = "padding:0px 5px;font-size:15px;color:rgb(12, 129, 10); letter-spacing:1px;background-color:rgb(228, 236, 228);border-right:1px solid silver; " ></span></td>
														<td ><span  style = "color:grey;font-size:12px;">LIQUIDATED&nbsp;&nbsp;</span></td>
													</tr>
													<tr>
														<td style="text-align:right;"><span id = "oDiff" style = "padding:0px 5px;font-size:15px;color:rgb(12, 129, 10); letter-spacing:1px;background-color:rgb(228, 236, 228);border-right:1px solid silver; " ></span></td>
														<td ><span  style = "color:grey;font-size:12px;">UNLIQUIDATED&nbsp;&nbsp;</span></td>
													</tr>
													<!--<tr>
														<td style="text-align:right;border-top:1px solid silver;"><span id = "oDiff" style = "font-size:18px;color:rgb(194, 18, 65);font-weight:bold;letter-spacing:1px;" ></span></td>
														<td ><span  style = "color:grey;font-size:12px;">Diff&nbsp;&nbsp;</span></td>
													</tr>-->
												</table>
												
											</div>
										</td>
									</tr>
								</table>
							</td>
							
							<td valign="top" colspan="2" rowspan="6" style="padding:10px;;background-color:rgb(237, 242, 244);">
								<div id = "returnContainerLiquidatedCode" class ="liquidatedCodeContainer"></div>	
								<div id = "returnContainerLiquidated" class = "returnContainer1" style="padding:0px;background-color:white; height:670px;"></div>	
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>

<script>
	//whenRefreshSAAOBOBRLiquidated();
	function whenRefreshSAAOBOBRLiquidated(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "SAAOB"){
			var cookieText = cookieLabel(cookieSAAOBMenu(),"saaobMenuContainer");
			if(cookieText == "Liquidated"){
				loadOfficeLiquidated();
			}
		}
	}
	var x = 0;
	function myFunction(me) {
		document.getElementById("programCodeLiquidatedHeaderContainer").scrollLeft = me.scrollLeft;
	}
	
	function loadOfficeLiquidated(){
		var classBakit = "selectOfficeLiquidated";
		var func = "getOfficeProgramCodeLiquidated";
		var queryString = "?LoadOfficeSAAOB=1&classBakit=" + classBakit + "&func=" + func;
		var container = document.getElementById('saaobOfficeLiquidated');
		ajaxGetAndConcatenate(queryString,processorLink,container,"LoadOfficeSAAOB");
	}
	function getOfficeProgramCodeLiquidated(me){
		var classBakit = "programTable1";
		var func = "selectThisLiquidatedProgram";
		var office = me.value;	
		
		if(office != ''){
			if(office == "AllCodes"){
				markOfficeCode = 0;
				
				hideThis("tr2MainA");
				document.getElementById("programCodeLiquidatedHeaderContainer").innerHTML = "";
				document.getElementById("programCodeLiquidatedContainer").innerHTML = "";
				
				var queryString = "?LoadAccountCodes=1&office=AllCodes&programCode=AllCodes";
				var container = document.getElementById('returnContainerLiquidatedCode');
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"LoadAccountCodes");	
						
			}else{
				showThis("tr2MainA,tr2MainB");
				document.getElementById('returnContainerLiquidatedCode').innerHTML = ""
				document.getElementById('returnContainerLiquidated').innerHTML = "";
				
				var queryString = "?LoadProgramSAAOB=1&office=" + office + "&classBakit=" + classBakit + "&func=" + func;
				var container = document.getElementById('programCodeLiquidatedContainer');
				lastSelected = -1;
				
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"LoadProgramLiquidated");
			}
		}
	}
	function hideThis(list){
		var name = list.split(",");
		for(var i = 0; i < name.length; i++ ){
			document.getElementById(name[i]).style.display = "none";
		}
	}
	function showThis(list){
		var name = list.split(",");
		for(var i = 0; i < name.length; i++ ){
			document.getElementById(name[i]).style.display = "table-row";
		}
	}
	var lastSelected = -1;
	var markProgramCode = 0;
	var markOfficeCode = 0;
	
	
	function selectThisLiquidatedProgram(me){
		
		if(lastSelected != me.rowIndex){
			var parent = me.parentNode.parentNode;
			if(lastSelected > -1){
				parent.children[0].children[lastSelected].style.backgroundColor = "transparent";
			}
			me.style.backgroundColor = "rgb(211, 250, 156)";
			lastSelected = me.rowIndex;
			lastIndes = -1;
			
			var programCode = me.children[1].textContent;
			markProgramCode = programCode;
			
			var programName = me.children[2].textContent;
			var office = document.getElementById("saaobOfficeLiquidated").children[0].value;
			markOfficeCode = office;
			
			document.getElementById('returnContainerLiquidated').innerHTML = "";
			
			var queryString = "?LoadAccountCodes=1&office=" + office + "&programCode=" + programCode;
			
			var container = document.getElementById('returnContainerLiquidatedCode');
			
			
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"LoadAccountCodes");	
		}
	}
	var lastIndes = -1;
	function selectThisLiquidatedCode(me){
		var cellIndex = me.parentNode.cellIndex;
		if(lastIndes != cellIndex){
			var parent = me.parentNode.parentNode;
			if(lastIndes > -1){
				var div = parent.children[lastIndes].children[0];
				    div.style.backgroundColor = "rgb(246, 250, 247)";
				    div.style.color = "rgb(41, 164, 78)";		
				    
				   div.style.borderRight ="1px solid rgb(206, 213, 205)";
				   div.style.borderBottom ="1px solid rgb(206, 213, 205)";
				   me.style.borderRadius = "0px"; 
			}
			me.style.backgroundColor = "rgb(153, 188, 161)";
			me.style.color = "white";
			me.style.borderRight ="1px solid white";
			me.style.borderBottom ="1px solid white";
			
			me.style.borderRadius = "8px 8px 0px 0px"; 
			
			lastIndes = cellIndex;
			if(markOfficeCode == 0){
				markOfficeCode = "AllCodes";
				markProgramCode = "AllCodes";
			}
			
			var code = me.textContent;
			var queryString = "?LoadAccountCodesLiquidated=1&office=" + markOfficeCode + "&programCode=" + markProgramCode + "&accountCode=" + code;
		
			var container = document.getElementById('returnContainerLiquidated');
			
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"LoadAccountCodesLiquidated");	
		}
	}
	var markCheck = '';
	function showHideRow(me){
		var whatToSee = me.id;
		
		markCheck = whatToSee;
		if(whatToSee == "l1"){
			document.getElementById("trMonth").style.display = "none";
			viewTableRow("rowColor");
		}else if(whatToSee == "l2"){
			viewCalendar();
			viewTableRow("withData");
			hideTableRow("noData");
		}else if(whatToSee == "l3"){
			viewCalendar();
			viewTableRow("noData");
			hideTableRow("withData");
		}
		
		
	}
	function viewTableRow(cName){
		var total = 0;
		var row = 0;
		var parent =  document.getElementById("tableLiquidated");
		
		var hit = parent.getElementsByClassName(cName);
		for(var i = 0; i < hit.length ; i++){
			hit[i].style.display = "table-row";
			var amount = hit[i].children[7].textContent.replace(/,/g,"");
			total =  parseFloat(total) + parseFloat(amount);
			row++;
		}
		totals(row,total);
		
	}
	function totals(row,total){
		if(row > 1){
			document.getElementById("rowLabel").innerHTML = "&nbsp;Rows";
		}
		document.getElementById("monthlyRow").innerHTML = row;
		document.getElementById("monthlyTotal").innerHTML = numberWithCommas(total.toFixed(2));
	}
	function hideTableRow(cName){
		var total = 0;
		var row = 0;
		var parent =  document.getElementById("tableLiquidated");
		
		var hit = parent.getElementsByClassName(cName);
		for(var i = 0; i < hit.length ; i++){
			hit[i].style.display = "none";
		}
		
	}
	function viewCalendar(){
		document.getElementById("trMonth").style.display = "table-row";
		var parent =  document.getElementById("tableMonth").children[0]; 
		for(var i = 0 ; i < parent.children.length; i++){
			var tr = parent.children[i];
			
			for(var j = 0; j < tr.children.length; j++){
				var td = tr.children[j];
				td.children[0].checked = false;
			}
		}
	}
	function filterMonth(me){
		var state = me.checked;
		var month  = me.id;
		var list  = '';
		var hit ='';
		var parent =  document.getElementById("tableMonth").children[0];
		for(var i = 0 ; i < parent.children.length; i++){
			var tr = parent.children[i];
			for(var j = 0; j < tr.children.length; j++){
				var td = tr.children[j];
				var chk = td.children[0].checked;
				if(td.children[0].checked == true){
					if(td.children[1].textContent == 'Jan'){
						list += '1,';
					}else if(td.children[1].textContent == 'Feb'){
						list += '2,';
					}else if(td.children[1].textContent == 'Mar'){
						list += '3,';
					}else if(td.children[1].textContent == 'Apr'){
						list += '4,';
					}else if(td.children[1].textContent == 'May'){
						list += '5,';
					}else if(td.children[1].textContent == 'Jun'){
						list += '6,';
					}else if(td.children[1].textContent == 'Jul'){
						list += '7,';
					}else if(td.children[1].textContent == 'Aug'){
						list += '8,';
					}else if(td.children[1].textContent == 'Sep'){
						list += '9,';
					}else if(td.children[1].textContent == 'Oct'){
						list += '10,';
					}else if(td.children[1].textContent == 'Nov'){
						list += '11,';
					}else if(td.children[1].textContent == 'Dec'){
						list += '12,';
					}
				}
			}
		}
		
		var listArray = list.split(",");
		
		var parent =  document.getElementById("tableLiquidated");
		if(markCheck == "l2"){
			hit = parent.getElementsByClassName("withData");
		}else if("l3"){
			hit = parent.getElementsByClassName("noData");
		}
		
		
		var total = 0;
		var row = 0;
		for(var i = 0; i < hit.length ; i++){
			if(markCheck == "l2"){
				var jevM = parseInt(hit[i].children[5].textContent.substr(9,2));
			}else if("l3"){
				var jevM = parseInt(hit[i].children[4].textContent);
			}
		
			var condition = '';
			for(var j = 0; j < listArray.length-1; j++){
				if(jevM == listArray[j]){
					var amount = hit[i].children[7].textContent.replace(/,/g,"");
					total =  parseFloat(total) + parseFloat(amount);
					row++;
					hit[i].style.display = 'table-row';
					break;
				}else{
					hit[i].style.display = 'none';
				}	
			}
		}	
		
		
		if(listArray.length == 1){
			
			for(var i = 0; i < hit.length ; i++){
				hit[i].style.display = "table-row";
				var amount = hit[i].children[7].textContent.replace(/,/g,"");
				total =  parseFloat(total) + parseFloat(amount);
				row++;
			}
		}
		if(row > 1){
			document.getElementById("rowLabel").innerHTML = "&nbsp;Rows";
		}else{
			document.getElementById("rowLabel").innerHTML = "&nbsp;Row";
		}
		document.getElementById("monthlyRow").innerHTML = row;
		document.getElementById("monthlyTotal").innerHTML = numberWithCommas(total.toFixed(2));
	}
	function SaveToExcel(){
		window.open('../ajax/excelCreator.php?consolidated=1','_top');
	}
	function SaveToExcelPeriodically(){
		
		var from = document.getElementById("fromDate").value.trim();
		if(from){
			var to  = document.getElementById("toDate").value.trim();
			if(to){
				window.open('../ajax/excelCreator.php?periodic=1&from=' + from + '&to='+ to + '','_top');
			}else{
				alert("Please complete the fields required.");
			}
		}else{
			alert("Please complete the fields required.");
		}
		
	
		
	}
	function PreviewSummarySAAOB(){
		
		window.open("../interface/formSAAOB.php?programCode=" + markProgramCode +  "");
	}
</script>




