<style></style>

<div>	
	<table id = "tableDoctrackInfraFinal" class = "hide1"  style="padding-top:0;padding:20px; font-family: Oswald;" border = "0">
		<tr>
			<td colspan="2" style = "text-align:right;">
				
				<span class =  "data1" style = "" >Tracking Number</span>
				<div id = "infraFinalTrackingNumber" style = "font-size:30px;text-align:right;font-weight: bold;" class = "data1">0000-0</div>
			</td>
		</tr>
		<tr>
			<td><span class="numb">1</span><span class="numberField">Select Office</span></td>
			<td>
				<select class="data2" id="ifSelectContOffice" onchange="fetchOfficeIFTracking(this)">
					<option>&nbsp;</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><span class="numb">2</span><span class="numberField">Select CO Tracking</span></td>
			<td>
				<select class="data2" id="ifSelectContTN" onchange="fetchOfficeIFTNDetails(this)">
					<option>&nbsp;</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><span class="numb">3</span><span class="numberField">Supplier Name</span></td>
			<td>
				<input type="text" class="data2" style="background-color:white; border:0px; border-bottom: 1px dashed black; color:black;" id="ifSelectClaimant" disabled>
			</td>
		</tr>
		<tr>
			<td><span class="numb">4</span><span class="numberField">BAC Resolution No.</span></td>
			<td>
				<input type="text" class="data2" style="background-color:white; border:0px; border-bottom: 1px dashed black; color:black;" id="ifSelectBACReso" disabled>
			</td>
		</tr>
		<tr>
			<td></td>
			<td id="ifSelectProjDetails"></td>
		</tr>
	</table>
</div>



<script type="text/javascript">
	whenRefreshDoctrackInfraFinal();
	function whenRefreshDoctrackInfraFinal(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Infra Final"){
				fetchOfficeInfraFinal();
			}
		}
	}

	function fetchOfficeInfraFinal(){
		loader();
		var container = document.getElementById("ifSelectContOffice");
		var queryString = "?fetchOfficeInfra=1" ;
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchOfficeInfra");
	}

	function getAllInfraFinal(){
		var container = documentgetElementById('ifSelectCont');
		var queryString = "?getAllInfraFinal=1";
		loader();
	}

	function fetchOfficeIFTracking(me){
		var office = me.value;
		var container = document.getElementById("ifSelectContTN");
		var queryString = "?fetchOfficeIFTracking=1&office="+office;

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchOfficeIFTracking");
	}

	function fetchOfficeIFTNDetails(me){
		var temp = me.value.split("*j*");
		var tn = temp[0];
		var container = document.getElementById('ifSelectProjDetails');
		var queryString = "?fetchOfficeIFTNDetails=1&tn="+tn;

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchOfficeIFTNDetails");
	}

	function saveTrackingInfraFinal(){
		var office = document.getElementById('ifSelectContOffice').value;
		
		var coTN = document.getElementById('ifSelectContTN').value.split("*j*");

		var tn = coTN[0];
		var fund = coTN[1];

		var supplier = document.getElementById('ifSelectClaimant').value;
		var bacReso = document.getElementById('ifSelectBACReso').value;
		var prgCode = document.getElementById('infraFinalCode').textContent.trim();
		var actCode = document.getElementById('infraFinalAccountCode').textContent.trim();
		var cost = document.getElementById('infraFinalCost').value.replace(/,/g,"");
		
		var queryString = "?saveTrackingInfraFinal=1"
						+ "&office="+office
						+ "&tn="+tn
						+ "&fund="+fund
						+ "&supplier="+encodeURIComponent(supplier)
						+ "&bacReso="+bacReso
						+ "&prgCode="+prgCode
						+ "&actCode="+actCode
						+ "&cost="+cost;
		var container = document.getElementById('infraFinalTrackingNumber');

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"saveTrackingInfraFinal");
	}

	function clearInfraFinal(){
		selectToIndexZero('ifSelectContOffice');
		selectToIndexZero('ifSelectContTN');

		document.getElementById('infraFinalTrackingNumber').value = "";
		document.getElementById('ifSelectClaimant').value = "";
		document.getElementById('ifSelectBACReso').value = "";
		document.getElementById('ifSelectProjDetails').innerHTML = "";
	}
	
</script>