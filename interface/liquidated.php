<?php
	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
		echo $link;
	}else{
		$acct = $_SESSION['employeeNumber'];
		$acctType = $_SESSION['accountType'];
		$office = $_SESSION['officeCode'];
		if($_SESSION['accountType'] >= 1){
			
		}else{
			$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
			echo $link;
		}
	}
?>
<style>
	#liquidatedSet{
		width:1500px;
		min-height:600px;	
		padding:5px;
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

	#tableLiqBrkDwn{
		font-family: Arial;
		font-size:10px;
		margin:0px auto;
		padding: 5px 8px 20px 8px;
		width:100%;
	}
	#tableLiqBrkDwn th{
		padding:5px 6px;
		font-size:12px;
	}
	#tableLiqBrkDwn tr:hover{
		background-color:rgb(251, 244, 181);
	}
	#tableLiqBrkDwn td{
		padding:3px 5px;
		vertical-align:top;
		text-transform:uppercase;
		border-bottom:1px solid silver;
	}
	#tableLiqBrkDwn td:first-child{
		width:10px;
		padding:3px 3px;
		text-align:right;
		border:0px;
	}
	#tableLiqBrkDwn td:nth-last-child(3){
		border-right:2px dashed rgb(186, 196, 194)
	}

	.tableLiquidatedOptions {
		margin:auto 0px auto auto;
	}

	.tableLiquidatedOptions input[type="radio"] {
		display:none;
	}
	.tableLiquidatedOptions label{
		/* font-family: "Roboto Mono", monospace; */
		font-family: Arial;
		text-align:center;
		font-size:12px;
		padding:3px 5px;
		/* font-weight:bold; */
		letter-spacing:1px;

		transition:.2s ease-in;

	}

	.tableLiquidatedOptions label::before{
		content:"";
		position:relative;
		padding:0px 7px;
		border-radius:50px;
		margin-right:5px;
		border:2px solid silver;
	}

	.tableLiquidatedOptions label:hover{
		font-weight:bold;
	}
	.tableLiquidatedOptions input[type="radio"]:checked+label{
		font-weight:bold;
	}
	.tableLiquidatedOptions input[type="radio"]:checked+label:before{
		border:2px solid silver;
		background-color:rgb(35, 116, 157);
	}



</style>

<div id="liquidatedSet" style="">
	<table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
		<tr>
			<td style="padding:8px;">
				<table border="0" cellpadding="0" cellspacing="0" style="width:100%; background-color:rgb(211, 221, 226); padding:5px;" class="tableLiquidatedOptions">
					<tr>
						<td style="padding:0px; text-align:right; padding-right:20px;">
							<?php
								if($_SESSION['accountType'] > 1){
							?>
								Select Office&nbsp;&nbsp;
								<select id = "officeLiquidated" class = "data2" style = "width:240px;" onchange="changeFetch();"><option>&nbsp;</option></select>
							<?php
								}
							?>
						</td>
						<td style="padding:0px; width:120px;">
							<input type="radio" id="vliqBrk" name="vliqVwSel" onclick="loadLiquidatedWBrkDwn();" style="cursor:pointer;"><label for="vliqBrk">Breakdown</label>
						</td>
						<td style="padding:0px; width:120px;">
							<?php
								if($_SESSION['accountType'] > 1){
							?>
								<input type="radio" id="vliqMnt" name="vliqVwSel" onclick="changeFetch();" style="cursor:pointer;" checked><label for="vliqMnt">Monitoring</label>
							<?php
								}else{
							?>
								<input type="radio" id="vliqMnt" name="vliqVwSel" onclick="loadCashAdvanceOffice();" style="cursor:pointer;" checked><label for="vliqMnt">Monitoring</label>
							<?php
								}
							?>
						</td>
						<td style="padding:0px; width:100px; text-align:right; padding-right:10px;">
							Search Name
						</td>
						<td style="padding:0px; width:100px; text-align:right; font-size:12px;">
							<input onkeydown="keypressAndWhatClear(this,event,searchCashAdvanceName,1)" maxlength = "15" value ="" style="font-size:16px;font-family:Oswald;letter-spacing:1px;background-color:rgb(242, 243, 243); padding:4px 5px;border:0;border-left:1px solid silver;border-top:1px solid silver;text-align: center;font-weight: bold;width:150px;" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td style="padding:0px;">
				<div id = "containerLiquidated" ></div>
			</td>
		</tr>
	</table>
</div>


<script>
	whenLiquidated();
	function whenLiquidated(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Liquidated"){
				//loadLiquidated();	
				loadCashAdvanceOffice()
			}
		}
	}
	function loadCashAdvanceOffice(){
		
		if(document.getElementById("officeLiquidated")){
			var container = document.getElementById('officeLiquidated');
			var queryString = "?loadCashAdvanceOffice=1&office=" + 1081;
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"loadCashAdvanceOffice");
		}else{
			var container = document.getElementById('containerLiquidated');
			var queryString = "?loadCashAdvanceOfficeAcct1=1";
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"loadCashAdvanceOffice");
		}
	}
	
	function changeFetch(){
		if(document.getElementById('vliqMnt').checked == true){
			var office = document.getElementById("officeLiquidated").value;
			var container = document.getElementById('containerLiquidated');
			var queryString = "?loadLiquidated=1&office=" + office;
			
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"loadLiquidated");
		}else{
			loadLiquidatedWBrkDwn();
		}
	}
	function loadLiquidated(){
		
		if(document.getElementById("officeLiquidated")){
			
		}else{
			//var office = document.getElementById("officeLiquidated").value;
			loader();
			var office = "<?php echo $office ?>";
			var container = document.getElementById('containerLiquidated');
			var queryString = "?loadLiquidated=1&office=" + office;
			
			ajaxGetAndConcatenate(queryString,processorLink,container,"loadLiquidated");
		}	
	}
	
	function loadLiquidatedWBrkDwn(){

		if(document.getElementById("officeLiquidated") != null){
			var office = document.getElementById("officeLiquidated").value;
		}else{
			var office = <?= $office ?>;
		}

		if(office != ""){
			var container = document.getElementById('containerLiquidated');
			var queryString = "?loadLiquidatedWBrkDwn=1&office=" + office;

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"loadLiquidatedWBrkDwn");
		}
	}

	function setLiquidatedTitles(programs, funds){
		var table = document.getElementById('tableLiqBrkDwn');
		var rows = table.children[1].children;

		for (let i = 0; i < rows.length; i++) {
			var progCode = rows[i].children[5];
			var acctCode = rows[i].children[6];

			if(progCode.children.length > 0){
				var elem = progCode.children[0];
				var code = elem.textContent.trim();
				if(code != ""){
					var x = programs.indexOf(code);
					var x1 = programs.indexOf(":", x);
					var x2 = programs.indexOf("~", x1);
					var sub = programs.substring((x1+1),x2);
					elem.parentElement.innerHTML += "<span>"+sub+"</span>";
				}
			}

			if(acctCode.children.length > 0){
				var elem = acctCode.children[0];
				var code = elem.textContent.trim();
				if(code != ""){
					var x = funds.indexOf(code);
					var x1 = funds.indexOf(":", x);
					var x2 = funds.indexOf("~", x1);
					var sub = funds.substring((x1+1),x2);
					elem.parentElement.innerHTML += "<span>"+sub+"</span>";
				}
			}
		}
	}

	function addLiquidatedBrkDwnDetails(details){
		var temp = details.split('*j*');

		if(details.length > 0){
			for(var i = 0; i < temp.length; i++){
				var temp1 = temp[i].split('~j~');
				var amountId = "amount"+temp1[0];
				var amountCont = document.getElementById(amountId);
				if(amountCont != null){
					document.getElementById(amountId).innerHTML = temp1[1];
				}
			}
		}

		totalPerTNLiquidatedBrkDwn();
	}

	function totalPerTNLiquidatedBrkDwn(){
		var table = document.getElementById('tableLiqBrkDwn');
		var rows = table.children[1].children;
		

		var caTotal = 0;
		var lqTotal = 0;
		var curTN = "";
		for (let i = 0; i < rows.length; i++) {
			var tn = rows[i].children[1].textContent;
			var rowCATotal = rows[i].children[7];
			var rowLQTotal = rows[i].children[9];
			var caAmount = rowCATotal.textContent.replace(/,/g, "");
			var lqAmount = rowLQTotal.textContent.replace(/,/g, "");
			console.log(lqAmount+"---------"+lqAmount.length);
			if((curTN == "") || (curTN != tn && tn != "")){
				curTN = tn;
				caTotal = 0;
				lqTotal = 0;
			}

			if(lqAmount != ""){
				lqTotal += parseFloat(lqAmount);
			}


			if(caAmount != ""){
				if(parseFloat(caAmount) > 0) {
					caTotal += parseFloat(caAmount);
				}
			}else{
				rowCATotal.textContent = numberWithCommas(caTotal.toFixed(2));
				rowLQTotal.textContent = numberWithCommas(lqTotal.toFixed(2));
			}

		}
		
	}

	function searchCashAdvanceName(me){
		if(document.getElementById("officeLiquidated")){
			var office = document.getElementById("officeLiquidated").value;
		}else{
			var office = 1;
		}

		var name = me.value;
		var container = document.getElementById('containerLiquidated');

		if(document.getElementById('vliqMnt').checked == true){
			var queryString = "?searchCashAdvanceName=1&name=" + name + "&office=" + office;

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"searchCashAdvanceName");	
		}else{
			var queryString = "?searchCashAdvanceNameBrkDwn=1&name=" + name + "&office=" + office;

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"searchCashAdvanceNameBrkDwn");	
		}
		
	}
	function previewCandL(){
		if(document.getElementById("officeLiquidated")){
			var type = 1;
			var user = "<?php echo $acctType; ?>";
			var office = document.getElementById("officeLiquidated").value;
			if(office != ""){
				var queryString = "?a=" + office + "&t=" + type;	
				window.open("../interface/formCaLiq.php" + queryString +  "");
			}else{
				alert("Please select office.");
			}
		}else{
			var office = "<?php echo $office ?>";
			var type = 1;
			var queryString = "?a=" + office + "&t=" + type;
			window.open("../interface/formCaLiq.php" + queryString +  "");
		}
	}
	function searchThisCashAdvance(me){
		searchThisPartnerLiquidated(me);
		var type = "<?php echo $acctType;?>";
		
		if(type == 1){
			document.getElementById("doctrackMenuContainer").children[1].click();
		}else{
			document.getElementById("doctrackMenuContainer").children[0].click();
		}
		
		var me = me.parentNode;
		highlightBalance(me,"rgb(219, 221, 221)");
	}
	function searchThisPartnerLiquidated(me){
		var trackingNumber  = me.textContent;
		var queryString = "?searchTrackingNumberPartner=1&trackingNumber=" + trackingNumber;
		document.getElementById('ok').value = trackingNumber;
		var container = document.getElementById('doctrackUpdateContainer');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"searchTrackingNumber");
	}
</script> 