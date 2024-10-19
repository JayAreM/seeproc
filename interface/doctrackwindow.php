
<style>
	#obrDivContainer{
		font-family:NOR;	
	}
	.windowTable{
		cursor: pointer;
	}
	.windowTable th{
		background-color:rgb(70, 89, 106);
		padding:5px;
		color:white;
	}
	.windowTable td:nth-child(2){
		background-color:rgb(230, 232, 233);
	}
	.windowTable td:nth-child(4){
		background-color:rgb(241, 244, 230);
	}
	.windowTable td:nth-child(6){
		background-color:rgb(241, 244, 230);
	}
	.windowTable td:nth-child(7){
		background-color:rgb(230, 232, 233);
	}
	.windowTable td{
		border-bottom:1px solid white;	
		padding:3px;;	
		padding-left:5px;
	}
	.windowTable tr:hover > td{
		background-color:rgb(249, 234, 72); 
	}
	.windowTable tr:nth-child(even){ 
		background-color:rgb(237, 243, 245);
	}
	
	
	.windowTable1{
		cursor: pointer;
		font-size: 13px;
	}
	.windowTable1 th{
		background-color:rgb(70, 89, 106);
		padding:5px;
		color:white;
	}
	.windowTable1 td:nth-child(2){
		background-color:rgb(230, 232, 233);
	}
	.windowTable1 td:nth-child(4){
		background-color:rgb(241, 244, 230);
	}
	.windowTable1 td:nth-child(6){
		//background-color:rgb(241, 244, 230);
	}
	.windowTable1 td:nth-child(7){
		background-color:rgb(230, 232, 233);
	}
	
	.windowTable1 td{
		border-bottom:1px solid white;	
		padding:3px;;	
		padding-left:5px;
		vertical-align:top;
	}
	.windowTable1 tr:hover > td{
		background-color:rgb(249, 234, 72); 
	}
	.windowTable1 tr:nth-child(even){ 
		background-color:rgb(237, 243, 245);
	}
	
</style>

<div  id = "windowDivContainer" style ="min-width: 800px;" >
	<table border = "0" style = "width:100%;border-spacing:4px;">
		
		<tr>
			<td  style = "vertical-align:top;padding:5px;">
				<div id = "window1">
					
				</div>
			</td>
			<td  style = "vertical-align:top;padding:5px;">
				<div>
					<table id="paymasterTableBreakdown" border="0" cellspacing="0" cellpadding="0" style="border:1px solid silver; padding:5px; margin-bottom:10px; min-width:630px; min-height:100px;">
						<tr>
							<td style="font-size:22px; line-height:20px; height:10px; padding:5px 0px 3px 5px; color:white; text-align:left; font-weight:bold; background-color:rgb(32, 128, 201); background-image: linear-gradient(to  left, black ,rgb(32, 128, 201));">Breakdown</td>
						</tr>
						<tr><td id="window2" style="vertical-align:top;"></td></tr>
					</table>

				</div>
			</td>
		
		</tr>
		
	</table>
</div>
<script>
	whenWindowRefresh();
	var expenseCodeBalance = "";
	function whenWindowRefresh(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Window"){
				fetchPaymaster();
			}
		}
	}
	
	
	function fetchPaymaster(){
		var queryString = "?fetchPaymaster=1";
		var container = document.getElementById("window1");
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
	}
	function getPaymasterTracking(me){
		var queryString = "?getPaymasterTracking=1&tn=" + me.id;
		var container = document.getElementById("window2");
		changeTRcolorWindow(me);
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
	}

	function paymasterSaveToExcel(){
		var filename = "paymasterBreakdown";
		var table = document.getElementById("paymasterTableBreakdown");

		exportToExcel(filename, table);
	}

	var lastRowWindow = -1;
	function changeTRcolorWindow(me){
		
		var tbody = me.parentNode.parentNode;
		var tr = tbody.children;

		if(lastRowWindow > -1) {
			var tdS = tr[lastRowWindow].children;
			for(var i = 0; i < tdS.length; i++){
				tdS[i].style.borderBottom = "1px solid white";
				tdS[i].style.fontWeight = "normal";
				// tdS.style.fontWeight = "normal";
			}
		}

		var meTr = me.parentNode;
		for(var i  = 0; i < meTr.children.length; i++){
			meTr.children[i].style.borderBottom = "2px solid rgb(239, 91, 167)";
			meTr.children[i].style.fontWeight = "bold";
		}
		
		lastRowWindow = me.parentNode.rowIndex;
	}
	
</script> 








