
<?php
	// if(isset($_COOKIE["PHPSESSID"])){
	// 	header('Set-Cookie: PHPSESSID='.$_COOKIE["PHPSESSID"].'; SameSite=None');
	// }

	require_once("../includes/database.php");
	
	$sql = "select * from type order by Type asc";
	$record = $database->queryV($sql);
	$docTypeSelect = "<select class = 'select2' style = 'width:400px; font-family:Oswald;font-size:20px;'>";
	while($data = $database->fetch_array($record)){
		$type = $data['Type'];
		$docTypeSelect .= "<option>" .  $type . "</option>" ;
	}
	$docTypeSelect .= "</select>";
	$sql = "select * from citydoc.defaults";
	$pagination =  $database->queryV($sql);
	$margin =  $database->fetch_array($pagination);
	$padding = $margin['Title'];
	
	
?>
<script>
		
		
		var processorLink = "../ajax/dataprocessor.php";
		var uploadLink = '../ajax/uploadFile.php';
		
		var year = "2023";
		
		function allowMyAjax(){
			
			var cookieValue = readCookie("valbalangue");
			
			var x = window.location.pathname.split('/');
			path = x[x.length-1];
			if(path != "doctrackPublicSearch.php"){
				if(cookieValue == 2){
					window.open('../../citydoc2023/interface/login.php','_self');
				}
			}
		}
		function ajaxGetAndConcatenate(queryString,processorLink,container,ajaxType){
			
				
				// allowMyAjax();
				var ajaxRequest;
				try{
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							alert("Your browser broke!");
							return false;
						}
					}
				}
				ajaxRequest.open("GET", processorLink + queryString, true);
				ajaxRequest.send(null); 
				ajaxRequest.onreadystatechange = function(){	
					
					if(ajaxRequest.readyState == 4){
					
						var result =  ajaxRequest.responseText.trim();
						
						if(ajaxType == "fuJxy1za"){
							
							if(result == 1){
								alert('Your password has been changed successfully.');
								clearRegistration();
								document.getElementById('inputLoginEmployeeNumber').focus();
							}else if(result == 2){
							alert('Please wait for the activation of your acount.');
							clearRegistration();
						}else if(result == 3){
							alert('Already registered. You can log in now.');
							clearRegistration();
							document.getElementById('inputLoginEmployeeNumber').focus();
						}else if(result == 4){
							clearRegistration();	
							alert('Registration completed, please wait for the activation of your acount.');
						}else if(result == 5){
							alert('No match. Please review the information entered.');
						}else{
							alert(result);
						}	
						}else if(ajaxType == "seeProc"){
							loader();
						
							container.innerHTML = result.trim();
						
							showPie();
							showPieBudget();
						}else if(ajaxType == "fujxyza"){
							//document.getElementById("cont").innerHTML = result + "<br/>";


							if(result == 1){
								setCookie("valbalangue",1, 1);
								window.open('main.php', '_self');
							}else if(result == 2){
								alert('Please wait for the activation of your account.')
							}else if (result == 3){
								alert('Not found. Please try again.');
							}else if(result == 4){
								alert("Please don\'t.");
							}
						}else if(ajaxType == "Logout"){
								
								setCookie("valbalangue",2, 1);
								window.open('login.php', '_self');
						}else if(ajaxType == "SaveFund"){ // --------------------------------------------------------------- fund
							loader();
							container.innerHTML = result;
							/*var tabs = result.split('*');
							container.innerHTML = tabs[0];
							document.getElementById("returnContainerSummary").innerHTML = tabs[1];*/
						}else if(ajaxType == "loadEncodedFund"){
							
							var tabs = result.split('*');
							container.innerHTML = tabs[0];
							document.getElementById("returnContainerSummary").innerHTML = tabs[1];
						}else if(ajaxType == "GetTotalFund"){ 
							DistributeTotalFund(result);
							GetEncodedFund();
						}else if(ajaxType == "SaveAB"){ 
							alert(result);
						}else if(ajaxType == "GetEncodedFund"){ 
							container.innerHTML =  result;
						}else if(ajaxType == "GetLastEncodedFund"){ 
							container.innerHTML =  result;
						}else if(ajaxType == "getEncodedByFund"){ 
							container.innerHTML =  result;
						}else if(ajaxType == "loadOfficeInBudgetStatus"){
							 if(container){
							 	container.innerHTML =  result;
							 }
							
						}else if(ajaxType == "selectProgramCodeByOffice"){ // fund view approve
							var res = result.split('(*');
							
							if(res[0] == 1){ //isa lng ang pcode
								document.getElementById('returnContainer2').innerHTML = res[1];	
								document.getElementById('programCodeContainer').innerHTML = '';
							}else if(res[0] == 2){//daghan lng ang pcode
								document.getElementById('returnContainer2').innerHTML = '';	
								document.getElementById('programCodeContainer').innerHTML = res[1];
							}else if(res[0] == 3){
								document.getElementById('returnContainer2').innerHTML = '';	
								document.getElementById('programCodeContainer').innerHTML = '';
							}
						}else if(ajaxType == "selectFundsByProgramCode"){
							container.innerHTML = result;

						}else if(ajaxType == "loadOffice"){ 
							container.innerHTML =  result;
						}else if(ajaxType == "updateApproval"){ 
							//container.innerHTML =  result;
						}else if(ajaxType == "getEncodedByFund2"){ 
							
							if(result == 0){
								alert("No record found.");
							}else{
								container.innerHTML =  result;
							}
							
						}else if(ajaxType == "viewBalanceByOffice"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "selectAppropriationByFund"){ //---------------------------doctrack add new
							container.innerHTML =  result;
							
						}else if(ajaxType == "loadProgramsApp"){ 
							container.innerHTML =  result;
						}else if(ajaxType == "getEncodedByProgramCode"){
							container.innerHTML =  result;
						}else if(ajaxType == "selectNewDoctrack"){
							loader();

							var type = result.substr(0, 5);

							if(result.substr(0, 5) == 'optPX') {
								var res = result.split('*j*');
								container.innerHTML =  res[1];
								document.getElementById('poDoctrackSelect').innerHTML = res[2];
							}else if(result.substr(0, 6) == "optRET") {
								var res = result.split('*j*');
								container.innerHTML = res[1];
								document.getElementById('selectRETSupplier').innerHTML = res[2];
							}else {
								var res = result.split('*');
								
								if(res[0] == "optPR"){
									container.innerHTML =  res[1];
								}else if(res[0] == "optPO"){
									container.innerHTML =  res[1];
									document.getElementById('prDoctrackSelect').innerHTML = res[2];
									SelectItemsByPRRelease(document.getElementById("selectTrackingPR"));
								}else if(res[0] == "optPY"){
									container.innerHTML =  res[1];
									if(document.getElementById('tdSource1') != null){
										document.getElementById('tdSource1').innerHTML = res[2];
										document.getElementById('tdDocumentType').innerHTML = res[3];
									}
								}else if(res[0] == "optLQ"){
									var res = result.split('*');
									container.innerHTML =  res[1];
									document.getElementById('lqDoctrackSelect').innerHTML = res[2];
								}else if(res[0] == "optWGS"){
									container.innerHTML = res[1];
								}else if(res[0] == "optPAY"){
									container.innerHTML = res[1];
								}else if(res[0] == "optMLQ"){
									var res = result.split('*');
									container.innerHTML =  res[1];
									document.getElementById('mlqDoctrackSelect').innerHTML = res[2];
								}else if(res[0] == "optINP"){
									var res = result.split('*');
									container.innerHTML =  res[1];
									document.getElementById('inSelectTracking').innerHTML = res[2];
								}else if(res[0] == "optNLIQ"){
									var res = result.split('*');
									container.innerHTML =  res[1];
									document.getElementById('nlqDoctrackSelect').innerHTML = res[2];
								}else if(res[0] == "optPONew"){
									container.innerHTML =  res[1];
									document.getElementById('prGoodsSelect').innerHTML = res[2];
									SelectItemsByPRReleaseNew(document.getElementById("selectTrackingPRNew"));
								}
							}
							
						}else if(ajaxType == "selectByCategoryPPMP"){
							loader();
							
							if(result != 0){
								container.innerHTML =  result;
								
								if(document.getElementById("trPR1")){
									document.getElementById("trPR1").style.display = "table-row";
									document.getElementById("trPR2").style.display = "table-row";
									document.getElementById("trPR3").style.display = "table-row";
								}
							}else{
								container.innerHTML = "<br/>No record found.<br/><br/>";
								if(document.getElementById("trPR1")){
									document.getElementById("trPR1").style.display = "none";
									document.getElementById("trPR2").style.display = "none";
									document.getElementById("trPR3").style.display = "none";
								}
							}
						}else if(ajaxType == "selectByCategoryPPMP1"){
							loader();
							if(result != 0){
								container.innerHTML = result;
								if(document.getElementById("trPO1")){
									document.getElementById("trPO1").style.display = "table-row";
									document.getElementById("trPO2").style.display = "table-row";
									document.getElementById("trPO3").style.display = "table-row";
								}
							}else{
								if(document.getElementById("trPO1")){
									document.getElementById("trPO1").style.display = "none";
									document.getElementById("trPO2").style.display = "none";
									document.getElementById("trPO3").style.display = "none";
								}
								container.innerHTML = "No PR tracking selected.";
							}
						}else if(ajaxType == "saveTracking"){
							loader();
							var res = result.split("~");
							document.getElementById("trPR1").style.display = "none";
							document.getElementById("trPR2").style.display = "none";
							document.getElementById("trPR3").style.display = "none";
							document.getElementById("tdReviewContentPR").innerHTML = "";
							document.getElementById("selectSchedPPMP").selectedIndex = "0";
							document.getElementById("selectCategoryPPMP").selectedIndex = "0";
							
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							
							
						}else if(ajaxType == "saveTrackingPO"){
							
							loader();
							var res = result.split("~");
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							
							document.getElementById("trPO1").style.display = "none";
							document.getElementById("tdReviewContainerPO").innerHTML = "";
							document.getElementById("trPO2").style.display = "none";
							document.getElementById("trPO3").style.display = "none";
							
							document.getElementById("supplierName").value = "";
							
							selectToIndexZero("selectTrackingPR");
							
							
						}else if(ajaxType == "saveTrackingPY"){
							loader();
							var res = result.split("~");
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							
							clearFieldsPY();
							
						}else if(ajaxType == "fetchAccountCodesPY"){
							
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "loadProgramPPMP"){
							container.innerHTML = result;
						}else if(ajaxType == "loadProgramFundsByOffice"){
							container.innerHTML = result;
						}else if(ajaxType == "fetchAccountCodesMultipleSource"){
							
							container.innerHTML = result;
						}else if(ajaxType == "searchTrackingNumber"){ //---------------------------doctrack add update
							loader();
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							
						}else if(ajaxType == "searchPOARNumber"){ // Inventory - Search Tracker
							loader();
							var arr = result.split('*v*');
							document.getElementById("InventorysliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
						}else if(ajaxType == "savePending"){ 
							
							loader();
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							scrollTop();
							focusNext("ok");
							
						}else if(ajaxType == "updateTrackingStatus"){
							loader();
							if(result.substring(0,1) == '~'){
								var adv = result.substring(1,result.length);
								msg("Adv number already exist in TN# : <span class = 'label2' style = 'color:red;'>" + adv + "</span>");
							}else if(result.substring(0,1) == '*'){
								var obr = result.substring(1,result.length);
								msg("OBR number already exist in TN# : <span class = 'label2' style = 'color:red;'>" + obr + "</span>");
							}else{
								var arr = result.split('*v*');
								document.getElementById("sliderStatus").innerHTML = arr[0];
								container.innerHTML = arr[1];
								//container.innerHTML = result;
							}
							scrollTop();
							document.getElementById("ok").focus();
						}else if(ajaxType == "updateTracking1"){
							loader();
							//container.innerHTML =  result;
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							scrollTop();
							focusNext("ok");
						}else if(ajaxType == "countControlNumber"){ 
							container.innerHTML = result;
						}else if(ajaxType == "saveControl"){ 
							loader();
							container.innerHTML = result;
							scrollTop();
							focusNext("ok");
						}else if(ajaxType == "skipAndSave"){ 
							loader();
							//container.innerHTML = result;
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							scrollTop();
							focusNext("ok");
						}else if(ajaxType == "saveSLP"){ 
								loader();
								//container.innerHTML = result;
								var arr = result.split('*v*');
								document.getElementById("sliderStatus").innerHTML = arr[0];
								container.innerHTML = arr[1];
						}else if(ajaxType == "editField"){
							loader();
							if(result.substring(0,1) == '*'){
								var obr = result.substring(1,result.length);
								msg("Already exist in TN# : <span class = 'label2' style = 'color:red;'>" + obr + "</span>");
							}else{
								//container.innerHTML = result;
								var arr = result.split('*v*');
								document.getElementById("sliderStatus").innerHTML = arr[0];
								container.innerHTML = arr[1];
								closeAbsolute(container);
							}
							
						}else if(ajaxType == "editFieldAmount"){
							msg2(result);
						}else if(ajaxType == "saveEditorAmounts"){
							container.innerHTML = result;
							closeAbsolute(container);
						}else if(ajaxType == "loadApproriationStatus"){//---------------------------appropriation status
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "fundBreakdown"){
							container.innerHTML =  result;
						}else if(ajaxType == "loadTracker"){//---------------------------tracker
							container.innerHTML =  result;
						}else if(ajaxType == "loadMoreResult"){
							loader();
							container.innerHTML += result;
						}else if(ajaxType == "insertEfficiencyRanking"){
							loader();
							container.innerHTML += result;
						}
						else if(ajaxType == "loadTrackerOffice"){//--------------------------------------------------------------------------atik kaau
							container.innerHTML =  result;
						}else if(ajaxType == "fetchVoucherBy"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "loadClaimType"){
							
							container.innerHTML =  result;
							
						}else if(ajaxType == "receiveDocument"){
							container.innerHTML =  result;
						}else if(ajaxType == "generateReport"){//------------------------------------------- doctrack transmittal
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "SearchByTransmitalValue"){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "uKxRbAUuSf"){//------------------------------------------- forum
							loader();
							container.innerHTML = result;
							
						}else if(ajaxType == "kusdGrWvDFh"){
							
							container.innerHTML = result;
							loader();
							
						}else if(ajaxType == "zxRtaPxr"){
							loader();
							container.innerHTML = result;
							
						}else if(ajaxType == "cDsZrtEtrDFttrXly"){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "yudfhGYAsaYgmPsXstZ"){
							loader();
							document.getElementById("tableResult" + result.trim()).style.display = "none";
						}else if(ajaxType == "LoadMoreMessage"){
							
							container.innerHTML += result;
						}else if(ajaxType == "hsjuuw6YSDasuYsj"){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "LoadNotifier"){ 
							container.innerHTML = result;
						}else if(ajaxType == "addNewAccount"){  //-------------------------------------------------settings
							container.innerHTML = result;
						}else if(ajaxType == "loadAllAccountTitles"){
							container.innerHTML = result;
						}else if(ajaxType == "loadAllProgram"){
							container.innerHTML = result;
						}else if(ajaxType == "addNewProgram"){
							container.innerHTML = result;
						}else if(ajaxType == "loadBudgetForApproval"){  //-------------------------------------------------main / panel
							container.innerHTML = result;
						}else if(ajaxType == "loadAllOBRs"){
							loader();
							container.innerHTML = result;	
						}else if(ajaxType == "selectManualDoctrack"){ //---------------------------------------------------------manual 
							loader();
							var res = result.split('*');
							if(res[0] == "optMPR"){
								container.innerHTML =  res[1];
								document.getElementById('manualCategoryList').innerHTML = res[2];
								document.getElementById('tdManualSource').innerHTML = res[3];
								
							}else if(res[0] == "optMPO"){
								container.innerHTML =  res[1];
								document.getElementById('manualReleasedPR').innerHTML = res[2];
							}
						}else if(ajaxType == "saveManualPR"){ 
							loader();
							
							clearFieldsMPR();
							var res = result.split("~");
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							
						}else if(ajaxType == "searchManualApprovedTracking"){
							
							loader();
							container.innerHTML = result;	
							
						}else if(ajaxType == "saveManualPO"){ 
							
							loader();
							clearFieldsMPO();
							var res = result.split("~");
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
						}else if(ajaxType == "getOfficeProgramCode"){ //------------------------------------ fund changes
							loader();
							container.innerHTML = result;	
							document.getElementById('programCodeTo').innerHTML  = result;
							
						}else if(ajaxType == "getAcountCodeInChanges"){ 
							loader();
							container.innerHTML = result;	
						}else if(ajaxType == "LoadOfficeSAAOB"){//---------------------------------SAAOB
							container.innerHTML = result;
						}else if(ajaxType == "LoadProgramSAAOB"){
							loader();
							var res = result.split("~!~");
							container.innerHTML =  res[0];
							var label = '';
							if(parseInt(res[1]-1) > 1){
								label = "rows";
							}else{
								label = "row";
							}
							document.getElementById('saaobRow').innerHTML  = "<span style = 'font-weight:bold;font-size:20px;'>" +  (res[1]-1) + "</span>  " + label;
						}else if(ajaxType == "LoadProgramLiquidated"){
							loader();
							document.getElementById("tableOtotal").style.display = "block";
							var res = result.split("~!~");
							container.innerHTML =  res[0];
							var label = '';
							if(parseInt(res[1]-1) > 1){
								label = "Rows";
							}else{
								label = "Row";
							}
							
							//var fields = "No,Code,OBR,JEV,Diff,&nbsp;&nbsp;Desc";
							var fields = "&nbsp;,PRGM,BDGT,OBLD,LQD,ULQD,SVNGS,&nbsp;&nbsp;DESC";
							
							document.getElementById("programCodeLiquidatedHeaderContainer").innerHTML = createRowHeader("markId",fields);
							document.getElementById('oRow').innerHTML  = (res[1]-1);
							document.getElementById('oRowLabel').innerHTML  = label;
							document.getElementById('oOBR').innerHTML  = res[2];
							document.getElementById('oJEV').innerHTML  = res[3];
							document.getElementById('oDiff').innerHTML  = res[4];
							document.getElementById('oAB').innerHTML  = res[5];
							document.getElementById('oSAV').innerHTML  = res[6];
						
						}else if(ajaxType == "LoadDisbursement"){
							loader();
							var res = result.split("~!~");
							container.innerHTML =  res[0];
							var label = '';
							if(parseInt(res[1]) > 1){
								label = "rows";
							}else{
								label = "row";
							}
							document.getElementById('saaobRow1').innerHTML  = "<span style = 'font-weight:bold;font-size:20px;'>" +  (res[1]) + "</span>  " + label;
							document.getElementById('saaobRowTotal').innerHTML  = "<span style = 'font-weight:bold;font-size:20px;letter-spacing:1px;'>" +  (res[2]) + "</span> ";
							
						}else if(ajaxType == "FetchOfficeOBR"){
							loader();
							var res = result.split("~!~");
							var label = '';
							if(parseInt(res[1]) > 1){
								label = "rows";
							}else{
								label = "row";
							}
							container.innerHTML = res[0];
							document.getElementById('saaobRow1').innerHTML  = "<span style = 'font-weight:bold;font-size:20px;'>" +  (res[1]) + "</span>  " + label;
							
						}else if(ajaxType == "SearchInEncodeLiquidation"){
							loader();
							var res = result.split("~!~");
							if(res[0] == 0){
								container.innerHTML = res[1];
							}else{
								container.innerHTML = result;
								focusNext("saaobJevNumber");
							}
							
						}else if (ajaxType == "saveOBRJEV"){
							
							loader();
							
							container.innerHTML = result;
							
							document.getElementById("saaobOBRinput").value = "";
							document.getElementById("saaobJevNumber").value = "";
							focusNext("saaobOBRinput");
						}else if (ajaxType == "LoadAccountCodes"){
							loader();
							var res  =result.split("~!~");
							container.innerHTML = res[0];
							document.getElementById('oRow').innerHTML  = (res[1]-1);
							if(parseInt(res[1]) > 1){
								label = "Cols";
							}else{
								label = "Col";
							}
							document.getElementById('oRowLabel').innerHTML  = label;
							document.getElementById('oOBR').innerHTML  = res[2];
							document.getElementById('oJEV').innerHTML  = res[3];
							document.getElementById('oDiff').innerHTML  = res[4];
							document.getElementById('oAB').innerHTML  = res[5];
							document.getElementById('oSAV').innerHTML  = res[6];
							
							
							document.getElementById("tableOtotal").style.display = "block";
						}else if (ajaxType == "LoadAccountCodesLiquidated"){
							
							loader();
							container.innerHTML = result;
							var total =0;
							var amount = 0;
							var row = 0;
							var parent =  document.getElementById("tableLiquidated").children[0];
							
							for(var i = 0 ; i < parent.children.length; i++){
								var tr = parent.children[i];
								var amount = tr.children[7].textContent.replace(/,/g,"");	
								
								total =  parseFloat(total) + parseFloat(amount);
								row++;
							}
							
							totals(row,total);
						}else if (ajaxType == "CheckDetailsSAAOB"){
							loader();
							//container.innerHTML = result;
							msg(result);
							
						}else if(ajaxType == "EditInLiquidated"){
							loader();
							container.innerHTML = result;
							closeAbsolute(document.getElementById('absoluteHolder'));
						}else if(ajaxType == "LoadCategoryList"){
							
							loader();
							container.innerHTML = result;
							
						}else if(ajaxType == "GetCategoryItems"){
							loader();
							if(result == 0){
								container.innerHTML = "No data found.";
								document.getElementById("trPR1").style.display = "none";
								document.getElementById("trPR2").style.display = "none";
								document.getElementById("trPR3").style.display = "none";
							}else{
								
								container.innerHTML = result;
								document.getElementById("trPR1").style.display = "table-row";
								document.getElementById("trPR2").style.display = "table-row";
								document.getElementById("trPR3").style.display = "table-row";
								
							}
						}else if(ajaxType == "GetCategoryItemsByMonth"){
						
							loader();
							if(result == 0){
								container.innerHTML = "No data found.";
								document.getElementById("trPR1").style.display = "none";
								document.getElementById("trPR2").style.display = "none";
								document.getElementById("trPR3").style.display = "none";
							}else{
								container.innerHTML = result;
								document.getElementById("trPR1").style.display = "table-row";
								document.getElementById("trPR2").style.display = "table-row";
								document.getElementById("trPR3").style.display = "table-row";
							}
							
						}else if(ajaxType == "viewHistory"){
						
							loader();
							container.innerHTML = result;
							document.body.scrollTop = document.body.scrollHeight;
							
						}else if(ajaxType == "viewHistoryPOAR"){ // Inventory - Doctrack Status Flow
						
							loader();
							container.innerHTML = result;
							document.body.scrollTop = document.body.scrollHeight;
							
						}else if(ajaxType == "SelectPrReleased"){
							loader();
							if(result != 0){
								document.getElementById("trPO1").style.display = "table-row";
								document.getElementById("trPO2").style.display = "table-row";
								document.getElementById("trPO3").style.display = "table-row";
								container.innerHTML = result;	
							}else{
								document.getElementById("trPO1").style.display = "none";
								document.getElementById("trPO2").style.display = "none";
								document.getElementById("trPO3").style.display = "none";
								container.innerHTML = "";
							}
						}else if(ajaxType == "loadOfficeApp"){
							container.innerHTML = result;	
						}else if(ajaxType == "loadAppPerOffice"){
							loader();
							container.innerHTML = result;	
						}else if(ajaxType == "loadAppPerProgram"){
							loader();
							container.innerHTML = result;	
						}else if(ajaxType ==  "removeApp"){
							loader();
							msg(result + " item removed.");
						}else if(ajaxType == "prEdit"){
							loader();
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							container.innerHTML = arr[1];
							//container.innerHTML = result;	
						}else if(ajaxType == "pisEditz"){ // PIS
							loader();
							var arr = result.split('*v*');
							document.getElementById("InventorysliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
						}else if(ajaxType == "updatePISData"){ // PIS
							loader();
							var arr = result.split('*v*');
							document.getElementById("InventorysliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
						}else if(ajaxType == "updatePIS"){ // PIR RECORD LIST
							loader();
							var arr = result.split('*v*');
							document.getElementById("InventorysliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
						}else if(ajaxType == "updateOBR"){
							loader();
							//container.innerHTML = result;	
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							
						}else if(ajaxType == "loadAnnouncement"){
							container.innerHTML = result;	
						}else if(ajaxType == "returnOnly"){
							container.innerHTML = result;	
						}else if(ajaxType == "noReturn"){
							
						}else if(ajaxType == "returnOnlyLoader"){
							loader();
							container.innerHTML = result;	
						}else if(ajaxType == "returnOnlyLoaderjay"){
							loader();
							container.innerHTML = result;	
							window.scrollTo(0, container.offsetTop + container.scrollHeight); 
						}else if(ajaxType == "searchFromMain"){
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							loader();
						}else if(ajaxType == "setAdvice"){
							
							loader();
							clearOption();	
							document.getElementById("buttonSet").style.display = "none";	
						}else if(ajaxType == "viewAdvice"){
							loader();
							if(result != "0"){
								var  arr = result.split("xValx");
								container.innerHTML = arr[0];
								
								document.getElementById("adviceSequence").innerHTML = arr[1] ;
							}else{
								document.getElementById("buttonSet").style.display = "none";	
								container.innerHTML = "<div style = 'padding:20px;font-size:32px;text-align:center;'>No record found.</div>";
							}
						}else if(ajaxType == "viewSearchAdvice"){
							loader();
							if(result != "0"){
								var  arr = result.split("xValx");
								container.innerHTML = arr[0];
								document.getElementById("adviceContainer").innerHTML = arr[1];
							}else{
								document.getElementById("buttonSet").style.display = "none";	
								container.innerHTML = "<div style = 'padding:20px;font-size:32px;text-align:center;'>No record found.</div>";
							}
						}else if(ajaxType == "lingapReturn"){
							var tr = document.createElement("tr");
							tr.innerHTML = result;
							document.getElementById("tableLingap").insertBefore(tr,document.getElementById("tableLingap").children[1]);
						}else if(ajaxType == "lingapReturnTracking"){
							var arr  = result.split("~!~");
							document.getElementById("lingapContainerAll").innerHTML = arr[0];
							document.getElementById("lingapTN").value = arr[2];
							document.getElementById("lingapAmount").value = arr[1];
							document.getElementById("saveLingapButton").style.visibility = "visible";
							loader();
						}else if(ajaxType == "saveLingapTracking"){

							loader();
							if(result == 1) {
								alert('Claimant has no record in registry.');
							}else {

								document.getElementById("lingapTN").value = "";
								document.getElementById("lingapAmount").value = "";
								selectToIndexZero("lingapDocType");
								selectToIndexZero("lingapHospital");
								loadLingap();
								alert("Tracking number " +  result +" has been saved.");

							}

							// document.getElementById("lingapTN").value = "";
							// document.getElementById("lingapAmount").value = "";
							// selectToIndexZero("lingapDocType");
							// selectToIndexZero("lingapHospital");
							// loader();
							// loadLingap();
							// alert("Tracking number " +  result +" has been saved.");

						}else if(ajaxType == "searchLingap"){
							var arr  = result.split("~!~");
							document.getElementById("lingapContainerAll").innerHTML = arr[0];
							document.getElementById("lingapAmount").value = arr[1];
							document.getElementById("saveLingapButton").style.visibility = "hidden";
							loader();
						}else if(ajaxType == "updateLingap"){
							loader();
							if(result == 1) {
								alert('Claimant has no record in registry.');
							}else {
								alert("Updated " + result + " information.");
							}
						}else if(ajaxType == "returnNothing"){
							
						}else if(ajaxType == "loadMore"){
						
							loader();
							container.innerHTML += result;
						} else if(ajaxType ==  "removeUpload"){
							loader();
							msg("1 item removed.");
						}else if(ajaxType ==  "removeBeneficiary"){
							
							if(result == 0){
								loader();
								alert("This transaction has been released already. Please contact programmer.");
							}else{
								loader();
								searchLingap();
							}
							
						}else if(ajaxType ==  "fetchPODetails"){
							
							//document.body.innerHTML = result;
							createSheet(result);
						}else if(ajaxType ==  "fetchAIRDetails"){  // Inventory - AR
							createSheetAR(result);
						}else if(ajaxType == "loadSummary"){
							container.innerHTML = result;
							loader();
						}else if(ajaxType == "loadSummaryOffice"){
							container.innerHTML = result;
							loader();
						}else if(ajaxType == "loadBalanceByProgram"){
							loader();
							var arr = result.split('~!~');
							container.innerHTML = arr[0];
							document.getElementById('summary3').innerHTML = arr[1];
							document.getElementById("p1").innerHTML = '<span style = "font-weight:normal;color:black;">' + p1Prog + '</span>';
							document.getElementById("p2").textContent = p2Des;
							document.getElementById("p3").innerHTML = '<span style = "font-weight:normal;color:black;">' + p1Prog + '</span> ' +  p2Des;
							var periodType = document.getElementById("balancePeriod").value;
							if(periodType != 1){
								var month = document.getElementById("periodBalanceMonth").value;
								var day = document.getElementById("periodBalanceDay").value;
								var year = document.getElementById("periodBalanceYear").value;	
								document.getElementById('checksOnly').click();
								if(periodType == 2){
									document.getElementById("periodT").innerHTML = "Check issued on <b>" + year + '-' + month + '-' + day + "</b>";
								}else if(periodType == 3){
									document.getElementById("periodT").innerHTML = "Check issued on <b>" + year + '-' + month + "</b>";
								}
							}
							
						}else if(ajaxType == "loadBalanceByAccount"){
							container.innerHTML = result;
							loader();
							document.getElementById("p3").innerHTML = '<span style = "font-weight:normal;color:black;">' + p1Prog + '</span> ' +  p2Des;
							document.getElementById("p4").innerHTML =  p3Acct + ' <b>' +  p4Des + '</b>';
							var periodType = document.getElementById("balancePeriod").value;
							if(periodType != 1){
								document.getElementById('checksOnly').click();
								var month = document.getElementById("periodBalanceMonth").value;
								var day = document.getElementById("periodBalanceDay").value;
								var year = document.getElementById("periodBalanceYear").value;	
								document.getElementById('checksOnly').click();
								if(periodType == 2){
									document.getElementById("periodT").innerHTML = "Check issued on <b>" + year + '-' + month + '-' + day + "</b>";
								}else if(periodType == 3){
									document.getElementById("periodT").innerHTML = "Check issued on <b>" + year + '-' + month + "</b>";
								}
							}
						}else if(ajaxType == "previewChecks"){
							alert(result);
							//container.innerHTML = result;
							loader();
						}else if(ajaxType == "saveTrackingLQ"){
							loader();
							var res = result.split("~");
							container.innerHTML =  res[0];
							clearCashAdvance();
							selectToIndexZeroA(document.getElementById("lqDoctrackSelect").children[0]);
							msg("Tracking number " +  res[1]  + " has been saved.");
							
						}else if(ajaxType == "editLiquidationAmount"){
							
							loader();
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							closeAbsolute(container);
							
						}else if(ajaxType == "loadLiquidated"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "loadLiquidatedWBrkDwn"){
							loader();
							var temp = result.split('!j!');
							container.innerHTML =  temp[0];
							setLiquidatedTitles(temp[1], temp[2]);

							// totalPerTNLiquidatedBrkDwn();
							// addLiquidatedBrkDwnDetails(temp[3]);
						}else if(ajaxType == "searchCashAdvanceNameBrkDwn"){
							loader();

							var temp = result.split('!j!');
							container.innerHTML =  temp[0];
							setLiquidatedTitles(temp[1], temp[2]);
							// addLiquidatedBrkDwnDetails(temp[1]);
						}else if(ajaxType == "searchCashAdvanceName"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "loadCashAdvanceOffice"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "selectWhatOffice"){
							loader();
							container.innerHTML =  result;
							document.getElementById('summary2').innerHTML = "";
							document.getElementById('summary3').innerHTML = "";
							
						}else if(ajaxType == "getSubCode"){
							container.innerHTML =  result;
						}else if(ajaxType == "loadSubCodes"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "getSubCodeEditOBR"){
							loader();
							if(result != '-'){
								document.getElementById("editSubContainer").style.display = "block";
								container.innerHTML =  result;
							}
						}else if(ajaxType == "searcher"){
							container.innerHTML = result;
						}else if(ajaxType == "loadSupplierAdd"){
							
							loader();
							msg(result);
						}else if (ajaxType == "fetchPartInv") {
							if (result) {
								setInv(result);
							}
						}else if(ajaxType == 'getArUploadTypes'){
							if (result) {
								setArUploadTypes(result);
							}
						}else if(ajaxType == 'loadPPMPlockOffice'){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == 'loadPPMPlockFund'){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == 'loadPPMPlockSort'){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == 'lockThis'){
							
						}else if(ajaxType == 'lockThisFund'){
						
						}else if(ajaxType == 'loadItemsByCat'){
							loader();
							msg(result);	
						}else if (ajaxType == 'savePrPurpose') {
							if (result) {
								// console.log(result);
							}
						}else if (ajaxType == 'deleteThisSelectedRow'){
							loader();
						}else if (ajaxType == 'getAttachments'){
							loader();
							container.innerHTML =  result;
						}else if (ajaxType == 'deleteAttachments'){
							loader();
							container.innerHTML =  result;
						}else if (ajaxType == 'loadMoreAttach'){
							loader();
							container.innerHTML +=  result;
						}else if (ajaxType == 'forwardCTO'){
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							loader();
						}else if (ajaxType == 'forwardAdmin'){
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							loader();
						}else if (ajaxType == 'revertAdmin'){
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							loader();
						}else if (ajaxType == 'ctoClaim'){
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							loader();
						}else if (ajaxType == 'ctoClaimLate'){
							loader();
							//container.innerHTML = result;
						}else if (ajaxType == 'ctoUnClaimLate'){
							loader();
							//container.innerHTML = result;
						}else if (ajaxType == 'prCTOforward'){
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							loader();
						}else if (ajaxType == 'ctoClaimRevert'){
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							loader();
						}else if (ajaxType == 'ctoClaimReProcess'){
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							loader();
						}else if (ajaxType == 'getPPMPbyFund'){
							loader();
							var arr = result.split("!~!");
							document.getElementById('ppmpViewContainer').innerHTML = arr[0];
							document.getElementById('ppmpViewContainer1').innerHTML = arr[1];
						}else if(ajaxType == "generateItemSelect"){
							loader();
							theAbsolute(result);
						}else if(ajaxType == "sendSMS"){

						}else if(ajaxType == "sendSMSAlways"){
							//alert(result);
							//container.innerHTML += result;
						}else if(ajaxType == "jkytafiwTY"){
							loader();
							msg("SMS service has been updated.");
						}else if(ajaxType == "getSMSsetup"){
							loader();
							displaySettings(result);
						}else if(ajaxType == "searchPPMPitems"){
							loader();
							container.innerHTML = result;
							
						}else if(ajaxType == "fetchSupplierAddress"){
							loader();
							var cer =document.getElementsByClassName("address");
							for(var i = 0 ; i < cer.length ; i++){
								cer[i].innerHTML = result ;
							}
						}else if(ajaxType == "updateOBRParticulars") {
							if (result == 1) {
								loadSaving();
							}
						}else if(ajaxType == "getPODetailsForRET"){
							loader();
							var jsond = JSON.parse(result);
							if(jsond[1] == 0){
								var err = jsond[0].join("\n");
								alert(err);
							}else{
								addMultipleRET(jsond[0]);
							}
						}else if(ajaxType == "saveTrackingRET"){
							loader();
							var res = result.split("~");
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							
							clearFieldsRET();
							
						}else if(ajaxType == "searchRetentionBySupplier"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "loadRetention"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "searchPOTrackingPartnerRET"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "loadRetentionOffice"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "prCTOreceive"){
							loader();
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							
						}else if(ajaxType == "fetchCounter"){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == 'getPrSummaryTotal'){
							loader();
							container.innerHTML = result;
							var viewBtn = document.getElementsByClassName('prSumDetBtn');
							if(viewBtn.length > 0){
								viewBtn[1].click();
							}
						}else if(ajaxType == 'getPrSumDet'){
							loader();
							container.innerHTML = result;
							prSumDetUpdateRowTotalView();
						}else if(ajaxType == 'getPrSumDetLoadMore'){
							loader();
							
							if(result == 1){
								var loadMoreCont = document.getElementById('prSumDetLoadMore');
								loadMoreCont.innerHTML = "No more records.";
							}else{
								container.children[1].innerHTML += result;
								prSumDetTableReNumber();
							}
							prSumDetUpdateRowTotalView();
						}else if(ajaxType == 'fetchCalendar'){
							loader();
							calendarWriter(result);
						}else if(ajaxType == 'getTrackingFromCalendar'){
							loader();
							container.innerHTML = result;
							getTotalComplex();
						}else if(ajaxType == 'forCheckReleased'){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == 'showCheckUnclaimed'){
							loader();
							container.innerHTML = result;
							
						}else if(ajaxType == 'ctoBackToAdvise'){
								loader();
						
						}else if(ajaxType == "LoadProgramFundsByOfficeWages"){ //------------------- WAGES - START
							container.innerHTML = result;
						}else if(ajaxType == "wagesOtherDetails"){
							loader();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == "updateTrackingToSLP"){
							loader();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == "searchPTRS"){
							loader();
							var arr = result.split('*j*');
							// document.getElementById('dbfTable').innerHTML = arr[0];
							container.innerHTML = arr[0];

							wgsModeF = 0;
							if(arr[0] != ""){
								LoadProgramFundsByOfficeWages();
							}else{
								alert("Please check details.");
							}
							autoModeSelect();
						}else if(ajaxType == "obrEditManualWGS"){ 
							loader();
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];

							wgsModeF = 0;
							// LoadProgramFundsByOfficeWages();
						}else if(ajaxType == "fetchSubProgramBalanceForWGS"){ //------------------- WAGES - END
							loader();
							msg2(result);
						}else if(ajaxType == "getPYDetailsForPAY"){ //------------------- PAYMASTER - START
							loader();
							
							var jsond = JSON.parse(result);
							var res = jsond.split('*j*');
							if(res[0] != ""){
								alert(res[0]);
							}else{
								addMultiplePAY(res[1]);
							}
							
						}else if(ajaxType == "savePaymasterNew") {
							loader();

							var temp = result.split("*j*");
							if(temp[1] != ""){
								alert(temp[1]);
							}else{
								var res = temp[0].split("~");
								container.innerHTML =  res[0];
								// msg1("Tracking number " +  res[1]  + " has been saved.");
       							msg("Tracking number " +  res[1]  + " has been saved.");
								clearFieldsPAY1();
								clearFieldsPAY2();

								document.getElementById('pmNewAddToBtn').click();
								document.getElementById('searchPYPayForAdd').value = res[1].trim();
								searchPMForAdding();
							}
						}else if(ajaxType == "searchPMForAdding") {
							loader();
							if(result){
								var arr = result.split('*j*');
								var tn = document.getElementById('pmNewAddToTN');
								var officer = document.getElementById('pmNewAddToOfficer');
								var fund = document.getElementById('pmNewAddToFund');
								var windowField = document.getElementById('pmNewAddToWindow');

								tn.value = arr[0];
								officer.value = arr[1];
								fund.value = arr[2];
								windowField.value = arr[3];

								getTrackingUnderPM(arr[0]);
							}
							
						}else if(ajaxType == "getTrackingUnderPM") {
							loader();
							if(result){
								container.innerHTML = result;
								addedListTotal();
							}
						}else if(ajaxType == "addToPaymaster") {
							loader();
							if(result) {
								getTrackingUnderPM(result);
								clearFieldsPAY2();
							}
						}else if(ajaxType == "pmRemoveThisDirect") {
							loader();
							if(result) {
								getTrackingUnderPM(result);
							}
						}else if(ajaxType == "pmRemoveThisDirectInTracker") {
							loader();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == "rtkTransferTracking"){//------------------- RETRACKING - START
							loader();
							if(result == 0){
								alert("Tracking number already transferred.");
							}else if(result == 1){
								alert("Please use PR Tracking Number when transferring PO.");
							}else if(result == 2){
								alert("Tracking Number does not exist.");
							}else{
								var res = result.split("~");
								var container1 = document.getElementById('divNewTrackingNumber');

								container1.innerHTML =  res[0];
								msg("Tracking number " +  res[1]  + " has been saved.");
								
								rtkClearFields();							
							}

						}else if(ajaxType == "selectNewDoctrackRTK"){//------------------- RETRACKING - END
							loader();
							// console.log(result);
							if(result == 0){
								alert("This office does not exist.");
							}else{
								var res = result.split('*');
							
								if(res[0] == "optPR"){
									container.innerHTML =  res[1].toUpperCase();
								}else{
									container.innerHTML =  res[1].toUpperCase();
								}
							}
						}else if(ajaxType == "editRetention"){
							loader();
							if(result){
								theAbsolute(result);
							}
						}else if(ajaxType == "getPODetailsForRET1"){
							loader();
							var jsond = JSON.parse(result);
							if(jsond[1] == 0){
								var err = jsond[0].join("\n");
								alert(err);
							}else{
								addMultipleRET1(jsond[0]);
							}
						}else if(ajaxType == 'updateTrackingRET'){
							loader();
							closeAbsolute();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == 'fetchOfficeInfra'){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == 'fetchNewTrackingInfra'){
							var arr = result.split("!@!");
							var tn = arr[0];
							var options = arr[1];
							loader();
							container.innerHTML = tn;
							document.getElementById("infraSelectProjects").innerHTML = options;
						}else if(ajaxType == 'fetchAccountName'){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == 'saveTrackingInfra'){
							var arr = result.split("!@!");
							var tn = arr[0];
							var newTN = arr[1];
							loader();
							container.innerHTML = newTN;
							msg("Tracking Number for this contact is " + tn );
							clearInfra();
						}else if(ajaxType == "saveTrackingMLQ"){ // ------------------ Multiple Liquidation - START
							loader();
							var res = result.split("~");
							container.innerHTML =  res[0];
							clearCashAdvanceMLQ();
							msg("Tracking number " +  res[1]  + " has been saved.");
						}else if(ajaxType == "editTrackingMLQ"){
							loader();
							theAbsolute(result);
						}else if(ajaxType == "updateTrackingMLQ"){ // ------------------ Multiple Liquidation - END
							loader();
							document.getElementById("closeEditorMLQ").click();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == "fetchINTNDetails"){ // --------------------- INFRA - START
							loader();
							var temp = result.split('*');
							document.getElementById('inSelectClaimant').textContent = temp[0];
							document.getElementById('inSelectFund').textContent = temp[1];
							document.getElementById('infraPYCode').textContent = temp[2];
							document.getElementById('infraPYName').textContent = temp[3];
							document.getElementById('infraPYAccountCode').textContent = temp[4];
							document.getElementById('infraPYAccountName').textContent = temp[5];
							document.getElementById('infraPYCost').textContent = temp[6];
							document.getElementById('infraPYCostActual').textContent = temp[7];
						
							
							infraTrackingNumber.textContent = temp[8];
							document.getElementById('infraPaymentHistory').innerHTML = temp[9];
							document.getElementById('infraPaymentType').innerHTML = temp[10];
							document.getElementById('infraPYProgress').innerHTML = temp[11];
							document.getElementById('infraPYRetention').innerHTML = temp[12];
							document.getElementById('infraPYRetentionCovered').innerHTML = temp[13];
							document.getElementById('infraPYRetentionBalance').innerHTML = temp[14];
							document.getElementById('infraProgress').value = temp[15];
							
							document.getElementById('infraPYvariation').textContent = temp[16];
							document.getElementById('infraPYunperformed').textContent = temp[17];
							document.getElementById('infraPYadjusted').textContent = temp[18];
							document.getElementById('infraPYfundYear').textContent = temp[19];
							
							document.getElementById('infraPYBatchNumber').textContent = temp[20];
							
							computerInfra();
							
							document.getElementById('inSelectProjDetails').style.display = "";
							if(temp[11] >= 100){
								infraPYDelay.disabled  = false;
								infraLDpercentage.disabled = false;
							}else{
								infraPYDelay.disabled  = true;
								infraLDpercentage.disabled = true;
								
								document.getElementById('infraPYDelay').value = '';
								document.getElementById('infraLDpercentage').value = '';
							}
							infraPaymentBreakdown.style.display = "block";
						}else if(ajaxType == "saveTrackingInfraPY"){
							loader();
							var arr = result.split("!@!");
							var tn = arr[0];
							var newTN = arr[1];
							container.innerHTML = newTN;
							msg("Tracking number " +  tn  + " has been saved.");
							clearInfraPY();
						}else if(ajaxType == "getNFStatusList"){
							loader();
							theAbsolute(result);
						}else if(ajaxType == "editNFUpdateStatus"){
							loader();
							closeAbsolute();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == "saveINFRADetails"){
							
							updateTrackingInfraEncodedOnly(document.getElementById(result));
						}else if(ajaxType == "returnPBP"){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "selectInfraPayment"){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "fetchCAOBRBreakdown"){ // --------------- NEW LIQUIDATION - START
							loader();
							var arr = result.split("*j*");
							if(arr[0] != "x" || arr[0] != "x"){
								container.innerHTML = arr[0];
								// document.getElementById("nliqCurSpent").textContent = numberWithCommas(arr[1]);
								document.getElementById("nliqCurCAGross").textContent = numberWithCommas(arr[1]);
								document.getElementById("nliqContMain").style.display = "table-cell";
								document.getElementById("nliqContSave").style.display = "table-cell";

								var gross = parseFloat(document.getElementById("nliqCurCAGross").textContent.trim().replace(/,/g,""));
								var net  = parseFloat(document.getElementById("nliqCurCA").textContent.trim().replace(/,/g,""));
								
								if(gross != net) {
									document.getElementById("nliqTaxRow").style.display = "table-row";
								}else {
									document.getElementById("nliqTaxRow").style.display = "none";
								}

								encLiqLoadProgCodes();
							}else{
								nliqClearFields();
								msg("Already liquidated under "+arr[1]+".");
							}
							
						}else if(ajaxType == "encLiqLoadProgCodes") {
							// console.log(result);
							container.innerHTML = result;
							getEncLiqAcct();
						}else if(ajaxType == "saveNewLiquidation"){
							loader();
							var res = result.split("~");
							var container1 = document.getElementById('divNewTrackingNumber');

							container1.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							
							nliqClearFields();	
						}else if(ajaxType == "editTrackingNLIQ"){
							loader();
							theAbsolute(result);
							getEncLiqAcctEdMode();
						}else if(ajaxType == "updateNewLiquidation"){
							loader();
							closeAbsolute();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == "saveRemark"){
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							loader();
						}else if(ajaxType == "saveNewProject"){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "fetchInfraProjects"){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "loadCashAdvanceOffice"){
							loader();
							container.innerHTML =  result;
						}else if(ajaxType == "saveNowMyNumber"){
							loader();
							msg("<div style = 'margin:10px;width:200px;text-align:center;'>You will be updated as the transaction progresses.</div>");
						}else if(ajaxType == "fetchSubProgramBalance"){
							loader();
							msg2(result);
						}else if(ajaxType == "fetchSubProgramBalanceForEdit"){ //------------------- WAGES - END
							loader();
							msg2(result);
						}else if(ajaxType == "showSubCodeSelectionEditDirect"){
							loader();
							msg2(result);
						}else if(ajaxType == "updateEDITPEORDirect"){
							loader();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == "fetchINTNDetailsForInfraUp") {
							loader();
							var temp = result.split('*j*');
							if(temp.length > 2) {
								document.getElementById('infraUpSelectClaimant').textContent = temp[0];
								document.getElementById('infraUpPYName').textContent = temp[1];
								document.getElementById('infraUpLocation').textContent = temp[2];
								document.getElementById('infraUpSelectTN').textContent = temp[3];

								// document.getElementById('infraUpProjDetails').style.display = "";
							}else {
								msg(temp[0]);
							}
							
						}else if(ajaxType == "saveInfraUploadDetails") {
							
							loader();
							if(result) {
								container.innerHTML = result;
								clearInfraUpFields();
							}else{
								alert(result);
							}
								
						}else if(ajaxType == 'fetchCalendarNcal'){
							loader();
							calendarWriterNcal(result);
						}else if(ajaxType == 'getTotalNumberOfComplexTN') {
							container.innerHTML = result;
						}else if(ajaxType == 'getTrackingFromCalendarNcal'){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == 'getTrackingComplexNcal'){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == 'fetchMultiProjIPb'){ //	------------------- INFRA PAYMENT TYPE B
							loader();
							container.innerHTML = result;
						}else if(ajaxType == 'getTNsUnderThisBatchNumber'){ //	------------------- INFRA PAYMENT TYPE B
							loader();
							var arr = result.split('*j*');
							container.parentElement.style.border = "1px solid silver";
							container.innerHTML = arr[0];
							document.getElementById('ipbDisplayHistory').innerHTML = arr[1];
							document.getElementById('ipbPaymentType').innerHTML = arr[2];
							var arr1 = arr[3].split('~');
							document.getElementById('ipbSelectContractor').innerHTML = arr1[0];
							document.getElementById('ipbSelectFundYear').innerHTML = arr1[1];
							document.getElementById('ipbSelectFund').innerHTML = arr1[2];
							document.getElementById('ipbSelectDuration').innerHTML = arr1[3];
							document.getElementById('ipbTotalCurProgress').innerHTML = arr1[4];
							document.getElementById('ipbTotalVariation').innerHTML = arr1[5];
							document.getElementById('ipbTotalUnperformed').innerHTML = arr1[6];
							document.getElementById('ipbPYCost').innerHTML = arr1[7];
							document.getElementById('ipbPYCostActual').innerHTML = arr1[8];
							document.getElementById('ipbTotalAdjustment').innerHTML = arr1[9];
							document.getElementById('ipbProgress').value = arr1[10];
							document.getElementById('ipbPYRetention').innerHTML = arr1[11];
							document.getElementById('ipbPYRetentionCovered').innerHTML = arr1[12];
							document.getElementById('ipbPYRetentionBalance').innerHTML = arr1[13];
							document.getElementById('ipbDetailsContainer').style.display = "";
							computerInfraIpb();


							if(arr1[4] >= 100){
								ipbPYDelay.disabled  = false;
								ipbLDpercentage.disabled = false;
							}else{
								ipbPYDelay.disabled  = true;
								ipbLDpercentage.disabled = true;
								
								document.getElementById('ipbPYDelay').value = '';
								document.getElementById('ipbLDpercentage').value = '';
							}

							
						}else if(ajaxType == "saveTrackingInfraPYIPB"){
							loader();
							var arr = result.split("!@!");
							var tn = arr[0];
							var newTN = arr[1];
							container.innerHTML = newTN;
							msg("Tracking number " +  tn  + " has been saved.");
							clearInfraPYIpb();
						}else if(ajaxType == 'saveMap'){ 
							loader();
							var arr = result.split("~!~")
							var linkSource = arr[0];
							if(linkSource == 1){
								sourceBody.style.display = "block";
								sourceBodyNone.style.display = "none";
								sourceLocation.src = arr[1];
								checkLoadIframe();
								bigMapCaption.style.display ="block";
								bigMaplink.href =arr[1];
							}else{
								sourceBody.style.display = "none";
								sourceBodyNone.style.display = "block";
								mapCaption.innerHTML = arr[1];
								
								bigMapCaption.style.display ="none";
							}
						}else if(ajaxType == 'fetchINTNDetailsForInfraUp1'){
						
							loader();
							document.getElementById("uploadInfraContainer1").innerHTML = result;
							document.getElementById("uploadInfraContainer2").innerHTML = result;
							document.getElementById("uploadInfraContainer3").innerHTML = result;
						}else if(ajaxType == 'fetchViewerInfra') {
							loader();
							container.innerHTML = result;
						}else if(ajaxType == 'getProgressDetails') {
							loader();
							var arr = result.split('*j*');
							document.getElementById('infraUpProgressEdit').value = arr[0];
							document.getElementById('infraUpDetailsEdit').value = arr[1];
							document.getElementById('infraUpFileEdit').innerHTML = arr[2];
							document.getElementById('infraVideoLinkEdit').value = arr[3];
						}else if(ajaxType == 'removeThisInfraProgFile') {
							loader();
						}else if(ajaxType == 'updateInfraUploadDetails') {
							loader();
							resetUpdateProgress();
							container.innerHTML = result;
						}else if(ajaxType == 'showImgOrigSize') {
							window.open(result, '_blank');
						}else if(ajaxType == 'loadMoreMobileVouchers') {
							loader();
							container.innerHTML += result;
						}else if(ajaxType == 'loadMoreMobileGoods') {
							loader();
							container.innerHTML += result;
						}else if(ajaxType == 'loadMoreMobileInfra') {
							loader();
							container.innerHTML += result;
						}else if(ajaxType == 'loadMoreMobilePayroll') {
							loader();
							container.innerHTML += result;
						}else if(ajaxType == 'saveRegisterNotification') {
							loader();
							var arr = result.split("!@!");
							var ind = arr[0];
							if(ind == 0){
								alert("Employee record not found. \nPlease review information or contact system administrator for clarification.");
							}else if(ind == 1 || ind == 2){
								
								clickClose.click();
								alert(arr[1]);
								notifyNote.style.display = "block";
								
							}else{
								alert(result);
							}
						}else if(ajaxType == 'getGenDetailsVouchers') {
							loader();
							container.innerHTML = result;
							revealShowMore(container);
						}else if(ajaxType == 'getGenDetailsGoods') {
							loader();
							container.innerHTML = result;
							revealShowMore(container);
						}else if(ajaxType == 'getGenDetailsInfra') {
							loader();
							container.innerHTML = result;
							revealShowMore(container);
						}else if(ajaxType == 'getGenDetailsPayroll') {
							loader();
							container.innerHTML = result;
							revealShowMore(container);
						}else if (ajaxType == 'invLoadOffices') {
							container.innerHTML = result;
							// invLoadCategory();
							loadInvCategoriesView();
						}else if (ajaxType == 'revertForComputeLD') {
							loader();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == 'getInfraTrackingDetails') {
							loader();
							if(result != 0) {
								var temp = result.split('*j*');

								container.innerHTML = temp[0];
								document.getElementById('trRETIN1').style.display = 'table-row';
								document.getElementById('infraTrackingNumber').innerHTML = temp[1];

							}else {
								container.innerHTML = '';
								document.getElementById('trRETIN1').style.display = 'none';
							}
							
						}else if(ajaxType == 'saveTrackingInfraRETIN') {
							loader();

							fetchMultiProjRETIN();
							document.getElementById('tdReviewInfraRetention').innerHTML = '';
							document.getElementById('trRETIN1').style.display = 'none';

							var res = result.split("~");
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");					
						}else if(ajaxType == 'inventorySearchByKey') {
							loader();
							// console.log(result);
							container.innerHTML = result;
						}else if(ajaxType == 'editNature') {
							loader();
							var closer = document.getElementsByClassName('closeEditor');
							closer[0].click();		
							
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == "getDetailsByPORelease"){
							loader();
							if(result != 0){
								// document.getElementById("trPX1").style.display = "table-row";
								document.getElementById("trPX2").style.display = "table-row";
								document.getElementById("trPX3").style.display = "table-row";

								container.innerHTML = result;
								updatePXAmountDetails();
							}else{
								// document.getElementById("trPX1").style.display = "none";
								document.getElementById("trPX2").style.display = "none";
								document.getElementById("trPX3").style.display = "none";
								container.innerHTML = "";
							}
						}else if(ajaxType == "pxEdit"){
							loader();
							// console.log(result);
							var arr = result.split('*j*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];

							// updatePXAmountDetailsInEdit();

							// 2023-08-03 - gi add ni kay pag mag chk n unchk ang taas for computation mawala ang hidden na chk sa agricultural products na nature
							var specifics = document.getElementById('pxSpecifics').textContent.trim();
							var agriChks = document.getElementsByName('agriCheckedItemsED');
							for (var i = 0; i < agriChks.length; i++) {
								if(specifics == 'Agricultural Products' || specifics == 'Agricultural Products Without Retention') {
									agriChks[i].checked = true;
								}else {
									agriChks[i].checked = false;
								}
							}

							pxChkAll.click(); // uncheck
							pxChkAll.click(); // check

						}else if(ajaxType == "loadSupplierAddNewPO"){
							loader();
							msg(result);
						}else if(ajaxType == "loadSupplierAddNewPOInEdit"){
							loader();
							msg(result);
						}else if(ajaxType == "SelectPrReleasedGoods"){
							loader();
							if(result != 0){
								var temp = result.split('*j*');

								document.getElementById("goodsPRGenDetailsForPO").innerHTML = temp[0];

								document.getElementById("trPONew2").style.display = "table-row";
								container.innerHTML = temp[1];	

								document.getElementById("trPONew3").style.display = "table-row";
            					document.getElementById("tdHeaderPOGoods").innerHTML = temp[3];

								document.getElementById("trPONew4").style.display = "table-row";
            					document.getElementById("tdTermsPOGoods").innerHTML = temp[2];

								document.getElementById("trPONew5").style.display = "table-row";
							}else{
								document.getElementById("goodsPRGenDetailsForPO").innerHTML = "";

								document.getElementById("trPONew2").style.display = "none";
								container.innerHTML = "";

								document.getElementById("trPONew3").style.display = "none";
            					document.getElementById("tdHeaderPOGoods").innerHTML = "";

								document.getElementById("trPONew4").style.display = "none";
            					document.getElementById("tdTermsPOGoods").innerHTML = "";

								document.getElementById("trPONew5").style.display = "table-row";
							}
						}else if(ajaxType == "pxAddItemFromPO") {
							loader();
							if(result) {
								theAbsolute(result);							
							}
						}else if(ajaxType == "transferToTaxifier") {
							loader();

							if(result == 1) {
								msg("Tracking already taxified.<br/>Please check Taxifier or reset taxified record.");
							}else {
								msg("Tracking Number <strong>"+result+"</strong> has been taxified.");
							}
						}else if(ajaxType == "editManpower") {
							loader();
							theAbsolute(result);
						}else if(ajaxType == "goUpdateManpower") {
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == "editPOSupplier"){
							loader();
							
							if(result == 0) {
								msg("You already have a PO tracking number with the same Supplier.<br/>Please view other PO Tracking Numbers.");
							}else {
								var ok = document.getElementById('ok');
								ok.value = result;
								searchTracking(ok);
							}
							
						}else if(ajaxType == 'editParticularsForThisPX'){
							loader();
							if(result) {
								theAbsolute(result);							
							}
						}else if(ajaxType == 'updatePXParticulars'){
							loader();
							
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == 'editGasAccount') {
							loader();
							if(result) {
								theAbsolute(result);							
							}
						}else if(ajaxType == 'goUpdateGas') {
							loader();
							
							document.getElementById('editCloser').click();

							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == 'updateWGSParticulars'){
							loader();
							
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == 'checkWGSDuplicates'){
							loader();

							if(result.trim().length > 0) {
								msg(result);
							}else {
								checkChargesForSubWGS();
							}
						}else if(ajaxType == 'editorComplianceOfficer') {
							loader();
							theAbsolute(result);
						}else if(ajaxType == 'goUpdateThisOfficer') {
							loader();
							
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == 'updateDateTagTaxifier') {
							loader();

							// console.log(result);
							if(result == 1) {
								alert('Successfully taxified.');
							}
						}else if(ajaxType == 'getPOListForRetention') {
							loader();

							if(result.trim().length > 0) {
								document.getElementById('trNewRET1').style.display = "";
								document.getElementById('trNewRET2').style.display = "";
								document.getElementById('trNewRET3').style.display = "";

								container.innerHTML = result;
							}else {
								clearNewRetentionFields();
								container.innerHTML = "<div class='norecord'>No record found.</div>";
								document.getElementById('trNewRET2').style.display = "";
							}

						}else if(ajaxType == 'updateItemSequence') {
							loader();
							location.reload();
						}else if(ajaxType == 'updateFundCorrection') {
							loader();
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
						}else if(ajaxType == 'updateFundCorrected') {
							loader();
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
						}else if(ajaxType == 'editDRRMO') {
							loader();

							if(result) {
								var temp = result.split('*j*');
								var trackingNumber = temp[2];
								var id = 'editor'+trackingNumber;

								var sheet = "";

								sheet += "<div class='editorContainer'>"
										+"	<table class='editorTable' style='font-family:Oswald;'>"
										+"		<tr><td class='editorHeader' colspan='2' >Editor<div onclick='closeAbsolute(this)' class='closeEditor'></div></td></tr>"
										+"		<tr>"
										+"			<td class='editorLabel'>DRRMO Project</td>"
										+"			<td style='padding-bottom:20px; padding-top:40px; padding-right:40px;'>"
										+"				<select id='drrmoSelect' class='select2' style='width:300px; font-family:Oswald; font-size:20px;'><option></option>"+temp[0]+"</select>"
										+"			</td>"
										+"		</tr>"
										+"		<tr>"
										+"			<td colspan='2' style='padding-bottom:20px; text-align:center;'>"
										+"				<input type='hidden' id='hiddens' value='"+temp[1]+"'>"
										+"				<div id='"+id+"' class='button1 b1' onclick='goUpdateDRRMO(this)'>Save</div>"
										+"			</td>"
										+"		</tr>"
										+"	</table>"
										+"</div>";

								theAbsolute(sheet);
							}

						}else if(ajaxType == 'goUpdateDRRMO') {
							loader();
							closeAbsolute(container);
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == 'loadContractorsInEdit') {
							loader();
							msg(result);
						}else if(ajaxType == "editNFContractor"){
							loader();
						
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == 'editDRRMO') {
							loader();

							if(result) {
								var temp = result.split('*j*');
								var trackingNumber = temp[2];
								var id = 'editor'+trackingNumber;

								var sheet = "";

								sheet += "<div class='editorContainer'>"
										+"	<table class='editorTable' style='font-family:Oswald;'>"
										+"		<tr><td class='editorHeader' colspan='2' >Editor<div onclick='closeAbsolute(this)' class='closeEditor'></div></td></tr>"
										+"		<tr>"
										+"			<td class='editorLabel'>DRRMO Project</td>"
										+"			<td style='padding-bottom:20px; padding-top:40px; padding-right:40px;'>"
										+"				<select id='drrmoSelect' class='select2' style='width:300px; font-family:Oswald; font-size:20px;'><option></option>"+temp[0]+"</select>"
										+"			</td>"
										+"		</tr>"
										+"		<tr>"
										+"			<td colspan='2' style='padding-bottom:20px; text-align:center;'>"
										+"				<input type='hidden' id='hiddens' value='"+temp[1]+"'>"
										+"				<div id='"+id+"' class='button1 b1' onclick='goUpdateDRRMO(this)'>Save</div>"
										+"			</td>"
										+"		</tr>"
										+"	</table>"
										+"</div>";

								theAbsolute(sheet);
							}

						}else if(ajaxType == 'goUpdateDRRMO') {
							loader();
							closeAbsolute(container);
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == 'returnModalLoader') {
							loader();
							theAbsolute(result);
						}else if(ajaxType == 'drrmoUpdateGenDetails') {
							if(result == 1) {
								loadDRRMOEncodedProjects();
							}
						}else if(ajaxType == 'drrmoAddNewExpCode') {
							if(result == 1) {
								loadDRRMOEncodedProjects();
							}else if(result == 2) {
								msg("This Expense Account is already on this project.");
							}
						}else if(ajaxType == 'drrmoRemoveThisCode') {
							loader();
							if(result == 1) {
								loadDRRMOEncodedProjects();
							}
						}else if(ajaxType == 'cancelFundReverted') {
							loader();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else if(ajaxType == "saveAllTNsRemark"){
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							loader();
						}else if(ajaxType == 'saveAPFundRevertedTN') {
							loader();
							closeAbsolute();
							var ok = document.getElementById('ok');
							ok.value = result;
							searchTracking(ok);
						}else{
							alert("Variable not found.");
						}
					}
				}
		}
		function ajaxGetAndConcatenate1(queryString,processorLink,container,ajaxType){
				var ajaxRequest;
				try{
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							alert("Your browser broke!");
							return false;
						}
					}
				}
				ajaxRequest.open("GET", processorLink + queryString, true);
				ajaxRequest.send(null); 
				ajaxRequest.onreadystatechange = function(){	
					if(ajaxRequest.readyState == 4){
						var result =  ajaxRequest.responseText.trim();
						if(ajaxType == "returnLoader"){
							
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "searchViewItemList"){ // Inventory - Item Management
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "ListOutCategoryandItemClassification"){ // Inventory - Item Management
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "returnOnly"){
							container.innerHTML = result;
						}else if(ajaxType == "loadPPMPbyCode"){
							loader();
							container.innerHTML = result;
						}else if(ajaxType == "preLoad"){
							loader();
						
							var select  = result.split("~~");
							
							document.getElementById("ppmpProgramContainer").innerHTML = select[0];
							document.getElementById("ppmpAccountContainer").innerHTML = select[1];
							document.getElementById("ppmpCategoryContainer").innerHTML = select[2];
							document.getElementById("ppmpUnitContainer").innerHTML = select[3];
							
							var lock = select[4];
						
							if(lock == 1){
								document.getElementById("savePPMPencode").textContent = "Locked";
							}
							
						}else if(ajaxType == "ItemManagementReload"){ // Ineventory - Item Management
							loader();
							var arr = result.split("!~!");
							document.getElementById('ViewCategories').innerHTML = arr[0];
							document.getElementById('ViewCategoriesonEntry').innerHTML = arr[1];
							document.getElementById('itemPurchasedUnit').innerHTML = arr[2];
							//document.getElementById('itemReleasedUnit').innerHTML = arr[2];
							createPPMPunitsDropDown(arr[3]);
							document.getElementById('ViewCategories3').innerHTML = arr[4];
						}else if (ajaxType == "deleteThisSelectedRow"){ // Inventory -  Item Management
							loader();
							var id =  result;
							var tr = document.getElementById(id).parentNode.parentNode;
							var table =tr.parentNode; // document.getElementById(id).parentNode;
							table.removeChild(tr);		
						}else if (ajaxType == "deletePPMP"){
							loader();
							var id =  result;
							var tr = document.getElementById(id).parentNode.parentNode;
							var table =tr.parentNode; // document.getElementById(id).parentNode;
							table.removeChild(tr);
						}else if(ajaxType == "searchPPMPview"){
							loader();
							var arr = result.split("!~!");
							document.getElementById('ppmpViewContainer').innerHTML = arr[0];
							document.getElementById('ppmpViewContainer1').innerHTML = arr[1];
							
						}else if(ajaxType == "loadSelectViewProgram"){
							loader();
							var arr = result.split("!~!");
							
							document.getElementById('ppmpViewSelectProgramContainer').innerHTML = arr[0];
							document.getElementById('ppmpViewContainer').innerHTML = arr[1];
							document.getElementById('ppmpViewContainer1').innerHTML = arr[2];
						
						}else if(ajaxType == "previewPPMP"){
							
							createSheetPPMP(result);
						
						}else if(ajaxType == "loadPPMPviewOffice"){
							loader();
							var arr = result.split("!~!");
							
							document.getElementById('ppmpViewSelectProgramContainer').innerHTML = arr[0];
							document.getElementById('ppmpViewContainer').innerHTML = arr[1];
							document.getElementById('ppmpViewContainer1').innerHTML = arr[2];
							
							if(document.getElementById('ppmpViewSelectOfficeContainer')){
								document.getElementById('ppmpViewSelectOfficeContainer').innerHTML = arr[3];
							}
							document.getElementById('ppmpViewSelectTypeContainer').innerHTML = arr[4];
							if(document.getElementById('ppmpViewSelectFund')){
								document.getElementById('ppmpViewSelectFund').innerHTML =arr[5];
							}
							
							
						}else if(ajaxType == "fetchPPMPprogramPerOffice"){
							
							loader();
							var arr = result.split("!~!");
							
							container.innerHTML = arr[0];
							document.getElementById('ppmpViewContainer').innerHTML = arr[1];
							document.getElementById('ppmpViewContainer1').innerHTML = arr[2];
							document.getElementById('ppmpViewSelectTypeContainer').innerHTML = arr[3];
							
							
							
							
							document.getElementById('ppmpViewSelectFund').innerHTML = arr[4];
							
							
							
						}else if(ajaxType == "selectProgramPerType"){
							loader();
							var arr = result.split("!~!");
							
							document.getElementById('ppmpViewSelectProgramContainer').innerHTML = arr[0];
							document.getElementById('ppmpViewContainer').innerHTML = arr[1];
							document.getElementById('ppmpViewContainer1').innerHTML = arr[2];
						}else if(ajaxType == "loadPPMPCategoryList"){
							loader();
							container.innerHTML = result;
							absoluteHeader("trCategoryListHeader",document.getElementById("containerHeader"),"dataHeader1");
							
						}else if(ajaxType == "GetCategoryItems"){
							loader();
							container.innerHTML = result;
							//absoluteHeader("trCategoryListHeader",document.getElementById("containerHeader"),"dataHeader1");
							
						}else if(ajaxType == "searchTrackingNumber2018"){
							loader();
							container.innerHTML = result;
							//absoluteHeader("trCategoryListHeader",document.getElementById("containerHeader"),"dataHeader1");
							
						}else if(ajaxType == "saveControl2018"){
							loader();
							container.innerHTML = result;
							//absoluteHeader("trCategoryListHeader",document.getElementById("containerHeader"),"dataHeader1");
							focusNext('ok');
							document.getElementById('ok').value = '';
						}else if(ajaxType == "skipAndSave2018"){ 
							loader();
							container.innerHTML = result;
							focusNext("ok");
							document.getElementById('ok').value = '';
						}else if(ajaxType == "viewHistory2018"){ 
							
							loader();
							container.innerHTML = result;
							
						}else if(ajaxType == "editField2018"){
							loader(); 
							closeAbsolute(container);
							if(result.substring(0,1) == '*'){
								var obr = result.substring(1,result.length);
								msg("Already exist in TN# : <span class = 'label2' style = 'color:red;'>" + obr + "</span>");
							}else{
								container.innerHTML = result;
								closeAbsolute(container);
							}
						}else if(ajaxType == "receive2018"){ 
							loader();
							container.innerHTML = result;
							focusNext("ok");
						}else if(ajaxType == "loadPPMPCategoryListNewPR"){
							loader();
							container.innerHTML = result;
							absoluteHeader("trCategoryListHeaderNewPR",document.getElementById("containerHeaderNewPR"),"dataHeader1");
							
						}else if(ajaxType == "GetCategoryItemsNewPR"){
							loader();
							// container.innerHTML = result;
							var temp = result.split('*j*');
							container.innerHTML = temp[0];
							document.getElementById('tdTermsNConditionsNewPR').innerHTML = temp[1];
							document.getElementById('tdHeaderNewPR').innerHTML = temp[2];

							if(temp[3].trim().length > 0) {
								document.getElementById('tdDisaProjectNewPR').innerHTML = temp[3];
							}else {
								document.getElementById('tdDisaProjectNewPR').innerHTML = '<option value="0">Regular Procurement</option>';
								document.getElementById("trNewPR4").style.display = "none";
								document.getElementById("trNewPR5").style.display = "none";
							}

						}else{
							alert("Variable not found.");
						}
					}
				}
		}																																																																																				
		function ajaxPost(queryString,processorLink, container,ajaxType) {
			  var xmlHttp = null;
			  if(window.XMLHttpRequest) {		
			    xmlHttp = new XMLHttpRequest();
			  }else if(window.ActiveXObject) {	
			    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			  }	
			  var ajaxRequest =  xmlHttp;		
			  ajaxRequest.open("POST", processorLink, true);			
			  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			  ajaxRequest.send(queryString);	
			  
			  ajaxRequest.onreadystatechange = function() {
			    if (ajaxRequest.readyState == 4) {
					var result = ajaxRequest.responseText.trim();
						if(ajaxType == "saveTrackingPost"){
							
							loader();
							
							var res = result.split("~");
							
							document.getElementById("trSelectCategory").style.display = "none";
							document.getElementById("divCategoryList").innerHTML = "";
							
							
							document.getElementById("trPR1").style.display = "none";
							document.getElementById("trPR2").style.display = "none";
							document.getElementById("trPR3").style.display = "none";
							document.getElementById("tdReviewContentPR").innerHTML = "";
							
							clearRadios('tableSelectQtr');
							//clearRadios("tableMonth");
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							
						}else if(ajaxType == "saveTrackingPostPO"){
							
							loader();
							
							var res = result.split("~");
										
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							selectToIndexZero("selectTrackingPR");
							document.getElementById("trPO1").style.display = "none";
							document.getElementById("trPO2").style.display = "none";
							document.getElementById("trPO3").style.display = "none";
							document.getElementById("tdReviewContentPO").innerHTML = "";
							document.getElementById("supplierName").value = "";
							
							
						}else if(ajaxType == "saveTrackingPOPost"){
							loader();
							var res = result.split("~");
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							document.getElementById("trPO1").style.display = "none";
							document.getElementById("tdReviewContainerPO").innerHTML = "";
							document.getElementById("trPO2").style.display = "none";
							document.getElementById("trPO3").style.display = "none";
							document.getElementById("supplierName").value = "";
							
							selectToIndexZero("selectTrackingPR");
						}else if(ajaxType == "BeginTransfer"){
							loader();
							
							msg(result);
							//container.innerHTML =  result;
						}else if(ajaxType == "BeginTransferTN"){
							loader();
							
							msg(result);
							//container.innerHTML =  result;
						}else if(ajaxType == "saveFileApp"){
							loader();
							msg(result + " rows saved.");
						}else if(ajaxType == "updatePR"){
							loader();
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
							//container.innerHTML = result;
						}else if(ajaxType == 'setInvoiceDetails'){
							if (result != 1) {
								alert("Something seems wrong. Please try again.");
								// console.log(result);
							}
						}else if(ajaxType == "returnNothing"){
							
						}else if(ajaxType == "saveTrackingPostPX"){
							loader();

							var res = result.split("~");
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							// document.getElementById("trPX1").style.display = "none";
							document.getElementById("trPX2").style.display = "none";
							document.getElementById("trPX3").style.display = "none";
							pxAdjustmentTable.style.display = "none";
							tdReviewDetailsPX.innerHTML = '';
							pxTaxDetails.innerHTML = '';
							pxTaxesCont.innerHTML = '';
							retentionLabel.innerHTML = '';

							totalAmountItemsPXDispOnly.value = '0.00';
							pxTotalLD.value = '0.00';
							totalAmountItemsPXLDDispOnly.value = '0.00';
							pxTotalTax.value = '0.00';
							pxRetention.value = '0.00';
							pxNetAmount.textContent = '0.00';

							pxAdjustmentDesc.value = '';
							pxAdjustmentAmount.value = '';

							showHideAdj.checked = false;

							selectToIndexZero("selectTrackingPO");
							selectToIndexZero("pxAdjustmentType");
							
						}else if(ajaxType == "saveTrackingPostGoods"){
							
							loader();
							
							var res = result.split("~");
							
							document.getElementById("trSelectCategoryGoods").style.display = "none";
							document.getElementById("divCategoryListGoods").innerHTML = "";
							
							
							document.getElementById("trNewPR1").style.display = "none";
							document.getElementById("trNewPR2").style.display = "none";
							document.getElementById("trNewPR3").style.display = "none";
							document.getElementById("trNewPR4").style.display = "none";
							document.getElementById("trNewPR5").style.display = "none";
							document.getElementById("trNewPR6").style.display = "none";
							document.getElementById("tdReviewContentNewPR").innerHTML = "";
							document.getElementById("goodsMgsField").innerHTML = "";
							document.getElementById("tdTermsNConditionsNewPR").innerHTML = "";
							document.getElementById("tdHeaderNewPR").innerHTML = "";
							document.getElementById('tdDisaProjectNewPR').innerHTML = "";
							
							clearRadios('tableSelectQtrGoods');
							//clearRadios("tableMonth");
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							
						}else if(ajaxType == "saveTrackingPostPOGoods"){
							
							loader();
							
							var res = result.split("~");
										
							container.innerHTML =  res[0];
							msg("Tracking number " +  res[1]  + " has been saved.");
							selectToIndexZero("selectTrackingPRNew");
							selectToIndexZero("goodsPOMode");
							selectToIndexZero("goodsPONature");
							selectToIndexZero("goodsPOSpecifics");

							document.getElementById("supplierNameGoods").value = "";
							document.getElementById("goodsPRGenDetailsForPO").innerHTML = "";

							document.getElementById("trPONew2").style.display = "none";
							document.getElementById("tdReviewContentPOGoods").innerHTML = "";

							document.getElementById("trPONew3").style.display = "none";
            				document.getElementById("tdHeaderPOGoods").innerHTML = "";

							document.getElementById("trPONew4").style.display = "none";
            				document.getElementById("tdTermsPOGoods").innerHTML = "";

							document.getElementById("trPONew5").style.display = "none";

							var container1 = document.getElementById('goodsPOTerm');
							var options = "<option></option>"
										+" <option value='1'>After full delivery</option>"
										+" <option value='2'>Per Statement</option>";
										
							container1.innerHTML = options;
							selectToIndexZero("goodsPOTerm");
							
						}else if(ajaxType == 'updateTrackingPostPX') {
							loader();
							var arr = result.split('*v*');
							document.getElementById("sliderStatus").innerHTML = arr[0];
							container.innerHTML = arr[1];
						}else{
							alert("AJAXFUNCTION variable not found.");
						}
				    }
			  }
		}
		function round2(n) {
			//https://stackoverflow.com/questions/10015027/javascript-tofixed-not-rounding?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa
			// answered Sep 16 '15 at 9:45 Shura
			var digits = 2;
	        if (digits === undefined) {
	            digits = 0;
	        }
	        var multiplicator = Math.pow(10, digits);
	        n = parseFloat((n * multiplicator).toFixed(11));
	        x = Math.round(n) / multiplicator;
	        return x.toFixed(digits);
	    }

		// function round2(n) {
		// 	return parseFloat(n).toFixed(2);
		// }

		function trimTwoDecimals(num){
			var n = num.toString();
			var arr = n.split('.');
			if(arr.length > 1){
				var a = arr[0];
				var b = arr[1].substring(0,4);
				var c = a + '.' + b;
				var num = c;
			}
			return num;
		}

		function ajaxPost1(queryString,processorLink, container,ajaxType) {
			  var xmlHttp = null;
			  if(window.XMLHttpRequest) {		
			    xmlHttp = new XMLHttpRequest();
			  }else if(window.ActiveXObject) {	
			    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			  }	
			  var ajaxRequest =  xmlHttp;		
			  ajaxRequest.open("POST", processorLink, true);			
			  ajaxRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			  ajaxRequest.send(queryString);	
			  
			  ajaxRequest.onreadystatechange = function() {
			    if (ajaxRequest.readyState == 4) {
					var result = ajaxRequest.responseText.trim();
						
						if(ajaxType == "savePPMP"){
							loader();
							
							appendTR(result);
						}else if (ajaxType == "saveItemEntry") { // Inventory - Item Management
							loader(); 
							if(isNumber(result)){
								alert("Already exist in item number : " + result + " ");
							}else{
								appendItemEntryList(result);
							}
							
						}else if(ajaxType == "updateItemManagementItems"){ // Inventory Item Management 
							loader();
							
							var arr = result.split("!~!");
							var id  = 'tr'+arr[1].trim();
							var oldCount = document.getElementById(id).children[0].textContent;
							document.getElementById(id).innerHTML = arr[0];
							document.getElementById(id).children[0].innerHTML = oldCount;
							document.getElementById(id).children[0].style.fontWeight = "bold";
							document.getElementById(id).children[0].style.backgroundColor = "orange";
						}else if(ajaxType == "updatePPMP"){
							loader();
							var arr = result.split("!~!");
							var id  = 'tr'+arr[1].trim();
							var oldCount = document.getElementById(id).children[0].textContent;
							document.getElementById(id).innerHTML = arr[0];
							document.getElementById(id).children[0].innerHTML = oldCount;
							document.getElementById(id).children[0].style.fontWeight = "bold";
							document.getElementById(id).children[0].style.backgroundColor = "orange";
						}else{
							alert("AJAXFUNCTION variable not found.");
						}
				    }
			  }
		}
		
		function ajaxFormUpload(formData,uploadLink,ajaxType){
			var xhr = new XMLHttpRequest();
			xhr.open('POST',uploadLink, true);
			xhr.onload = function (){
				 if (xhr.status === 200) {
				  	var result = xhr.responseText.trim();
					
					if(ajaxType == "saveWagesComp"){//---------------------------------- WAGES - START
						loader();
						
						var res = result.split("~");
						var container = document.getElementById('divNewTrackingNumber');

						container.innerHTML =  res[0];
						msg("Tracking number " +  res[1]  + " has been saved.");

						wgsModeF = 0;
						clearFieldsWGS();
					}else if(ajaxType == "saveWagesDBF"){
						loader();
						var res = result.split("~");
						var container = document.getElementById('divNewTrackingNumber');

						container.innerHTML =  res[0];
						msg("Tracking number " +  res[1]  + " has been saved.");

						wgsModeF = 0;
						clearFieldsWGS();

					}else if(ajaxType == "updateWages"){//---------------------------------- WAGES - END
						loader();
						
						wgsModeF = 0;
						var temp = result.split("*j*");
						if(temp[1] != ""){
							alert(temp[1]);
						}
						var ok = document.getElementById('ok');
						ok.value = temp[0];
						searchTracking(ok);
					}else if(ajaxType == "bacUpload"){
				  		if(result == 1){
				  			loader();	
							alert("The file selected already exist.");
						}else{
							loader();	
							alert("File has been saved.");
							clearFieldsBac();
						}
						
					}else if (ajaxType == 'updateAirItem') {
						loader();
						location.reload(true);
					}else if (ajaxType == 'uploadARFile') {
						if (result == 1) {
							alert("File uploaded.");
						} else {
							alert(result);
						}
					}else if (ajaxType == "posting") {
						loader();
						document.getElementById("mSubject").value = "";
						document.getElementById("mRemark").value = "";
						document.getElementById("mFileUpload").value = "";
						
						selectToIndexZero("mOffice");
						document.getElementById("linkMaterial").textContent = "Browse file here";
						document.getElementById("linkMaterial").style.color = "rgb(23, 178, 250)";
						document.getElementById('attachContainer').innerHTML = result;
					}else if(ajaxType == "saveInfraUpload") {
						
					}else if(ajaxType == "saveNewRETENTION") {
						// sampNewRetTxt.innerHTML = result;
						loader();

						var res = result.split("~");
						var container = document.getElementById('divNewTrackingNumber');

						container.innerHTML =  res[0];
						msg("Tracking number " +  res[1]  + " has been saved.");

						clearNewRetentionFields();
					}else if(ajaxType == "updateNewRETENTION") {
						// sampNewRetTxt.innerHTML = result;
						loader();
						document.getElementsByClassName('closeEditor')[0].click();
						var ok = document.getElementById('ok');
						ok.value = result;
						searchTracking(ok);
					}else if(ajaxType == 'saveDRRMOProject'){
						loader();
						if(result == 1) {
							clearDRRMOEncoder();
							loadDRRMOEncodedProjects();
						}else if(result == 2) {
							msg("Project already exists.");
						}
					}else{
						alert("Ajax type variable undefined.");
					}
				} else {
				   	alert('An error occurred!');
				}
			};
			xhr.send(formData);
		}
		function ajaxFormUpload1(formData,uploadLink,ajaxType,container){
			var xhr = new XMLHttpRequest();
			xhr.open('POST',uploadLink, true);
			xhr.onload = function (){
				  if (xhr.status === 200) {
				  	var result = xhr.responseText.trim();
					if(ajaxType == "saveInfraUploadPre") {
						loader();
						document.getElementById('infraVideoLinkPre').value = "";
       					document.getElementById('infraUpFileLabelPre').innerHTML = "Browse file/s";
					}else if(ajaxType == "updateInfraUploadFull") {
						loader();
						resetUpdateProgress();
						container.innerHTML = result;
					}else{
						alert("Ajax type variable undefined.");
					}
				  } else {
				   	alert('An error occurred!');
				  }
			};
			xhr.send(formData);
		}		
		
		function ajaxAuth(id,pass){
				var url = "localhost/ajax/receiver.php";
				var queryString = "?id='" + id + "'&pass='" + pass + "'";
				
				//var cname = "tokeen";

				var xhr = new XMLHttpRequest();
				xhr.open("GET", url+queryString, true);
				xhr.setRequestHeader('Content-type','application/json; charset=utf-8');
				xhr.onreadystatechange = function () {
					var result = "";
					if (xhr.readyState == 4) {
						result = JSON.parse(xhr.responseText);
						alert(result);
						//var d = new Date();
					    //d.setTime(d.getTime() + (1*24*60*60*1000));
					    //var expires = "expires="+ d.toUTCString();
					    //document.cookie = cname + "=" + result.token + ";" + expires + ";path=/";
					} else {
						console.error(result);
					}
				}
				xhr.send(null);
		}
		
		
		//---------------------------------------------------------------soft seeking
		function printViewer(title,sheet){
		
			
			newWin= window.open("");
			newWin.document.write('<html><head><title>' + title + '</title>');
			newWin.document.write('<link rel="icon" href="/city/images/print.png">');
			newWin.document.write('<link rel="stylesheet" href="../style/custom.css">');
			newWin.document.write('</head><body>');
			newWin.document.write(sheet);
			newWin.document.write('</body></html>');
			newWin.document.close();
		}
		function exportToExcel(filename,table){
			var htmls = "";
	        var uri = 'data:application/vnd.ms-excel;base64,';
	        var template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'; 
	        var base64 = function(s) {
	            return window.btoa(unescape(encodeURIComponent(s)))
	        };

	        var format = function(s, c) {
	            return s.replace(/{(\w+)}/g, function(m, p) {
	                return c[p];
	            })
	        };

	        htmls =  table.innerHTML;
	        var ctx = {
	            worksheet : 'Worksheet',
	            table : htmls
	        }
	        var link = uri + base64(format(template, ctx));  
	       	var downloadLink = document.createElement("a");
			downloadLink.href = link;
			
			downloadLink.download = filename + ".xls";
			document.body.appendChild(downloadLink);
			downloadLink.click();
			document.body.removeChild(downloadLink);  
		}
		
		var limit= 0;
		var entered = 0;
		var index = 0;
		function getAcctgEntry(){ // para sa pagkuha sa accounting entries unya ibutang sa array
				var ajaxRequest;
				try{
					ajaxRequest = new XMLHttpRequest();
				} catch (e){
					try{
						ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
						try{
							ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (e){
							alert("Your browser broke!");
							return false;
						}
					}
				}
				var queryString = "?loadAccountTiles=1";
				ajaxRequest.open("GET", processorLink + queryString, true);
				ajaxRequest.send(null); 
				ajaxRequest.onreadystatechange = function(){
					if(ajaxRequest.readyState == 4){
						var result = ajaxRequest.responseText.trim();	
						list  =  result.split('~?'); 
					}
				}
			}
		function search(me){
			 var i = 0, id = 1;
			 var key = me.value;
		     var parent = me.parentNode;
			 var result = parent.children[2];
			 if(entered == 1){
				result.innerHTML = "";
				entered = 0;
			 }else{ 
			 	if(key != ""){
					
					result.style.border= "1px dashed #289ED5";	
					result.style.borderTop= "0px dashed #289ED5";		
					result.style.padding= "10px";
					result.style.paddingTop= "0px";
					result.innerHTML ="";
					firstKey =  key.substring(0,1);
					if(isNumber(firstKey)){
						while(i < list.length){
							var data  =  list[i];
							if(key.toLowerCase() == data.substr(0,key.length).toLowerCase()){
								var span = document.createElement('span');
								
								var ind = data.indexOf(" ");
								var code = data.substr(0,ind);
								var title = data.substr(ind);
								
								span.innerHTML = "<ss style = 'color:rgb(105, 147, 173);'>" + code + "</ss> " + title;
								span.id = "span" + id; 
								span.className = "spanFound";
								if(span.addEventListener) {   
					                span.addEventListener ("click", clickEntry, false);
					            }
								result.appendChild(span);
								id++;
							}
							i++;
						}
					 }else{
						while(i < list.length){
							var data  =  list[i];
							if(key.toLowerCase() == data.substr(4,key.length).toLowerCase()){
								var span = document.createElement('span');
							
								var ind = data.indexOf(" ");
								var code = data.substr(0,ind);
								var title = data.substr(ind);
								span.innerHTML = "<ss style = 'color:rgb(105, 147, 173);'>" + code + "</ss> " + title;
								
								span.id = "span" + id; 
								span.className = "spanFound";
								if (span.addEventListener) {   
					                span.addEventListener ("click", clickEntry, false);
					            }
								result.appendChild(span);
								id++;
							}
							i++;
						}
					 }
					if(id == 1){
						result.style.display = "none";
					}
				 	document.getElementById("span"  + index ).style.color = "red";
					document.getElementById("span"  + index ).style.fontSize = "13px";
					document.getElementById("span"  + index ).style.fontWeight = "bold";	
				 }else{
				  	result.style.display = "none";
				 }
			 } 
		}
		//--------------------------------------------------------------------------------------------
		function validExtensions(extensions,selected){
			var arr =  extensions.split(",");
			var selected = selected.substring(selected.lastIndexOf('.')+1);
			x = 0;
			for(var i=0; i < arr.length; i++){
			  if(selected === arr[i]){
			  	x = 1;
			  }
			}
			return x;
		}
		function numberWithCommas(x) {
		    var parts = x.toString().split(".");
		    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		    return parts.join(".");
		}
		function getSelectText(id) {
		    return id.options[id.selectedIndex].text;
		}
		function selectToIndexZero(id){
			document.getElementById(id).selectedIndex = "0";
		}
		function selectToIndexZeroA(obj){
			obj.selectedIndex = "0";
		}
		function setSelectedIndex(s, v) {
		
		    for ( var i = 0; i < s.options.length; i++ ) {
		    	
		        if ( s.options[i].text == v ) {
		            s.options[i].selected = true;
		            return;
		        }
		    }
		}
		
		function clickEntry(func){
			var selected = this.textContent;
			var ind = selected.indexOf(" ");
			var code = selected.substr(0,ind);
			var title = selected.substr(ind).trim();
			entered = 1;
			this.parentNode.style.display= "none";
			setterValue(this,code,title)
		}
		function setterValue(me,code,title){
			var cookieValue = readCookie("lastMainMenu").trim();
			if(cookieValue == 1){
				document.getElementById('inputCode').value = code;
				document.getElementById('textareaDescription').value = title + " - PY";
			}else if(cookieValue == 2){
				document.getElementById('keywordFund').value = code;
				focusNext('fundAmountId');
			}
		}
		
		function keyPress(me,evt,func){
			var press =(evt.which) ? evt.which : event.keyCode;
			var parent = me.parentNode;
			var result = parent.children[2];
			if(parent.children.length == 2 ){	
				parent.appendChild(createResultDiv(me.offsetLeft));
			}
			var limit = result.childNodes.length;
			if(result.style.display == "none"){
				result.style.display = "block";
			}
			if(press == 27){
				result.style.display = "none";
				me.value = "12";
			}
			if(limit > 0){
				if(press == 38){
					index--;
					if(index < 1 ){
						index = 1;
					}
					document.getElementById("span"  + index ).style.color = "red";
				 }else if(press == 40){
					if(index < limit ){
						index++;	
					}
					document.getElementById("span"  + index ).style.color = "red";
				 }else if(press == 13){
				 	entered = 1;
					result.style.display = "none";
				 	var selected =  document.getElementById("span"  + index ).textContent;
					var ind = selected.indexOf(" ");
					var code = selected.substr(0,ind);
					var title = selected.substr(ind).trim();
					func(me,code,title);
					
				 }else{
				 	index = 1;
				 }
			}
		}
		function createResultDiv(me){
			var res = document.createElement('div');
			res.id = 'result';
			res.className = 'resultAccounts';
			
			res.style.marginLeft = (me) + "px"; 
			return res;
		}
		
		function toZero(value){
			if(value.length == 0 || value == ""  || value == "&nbsp;"   ){
				return 0;
			}else{
				return value;
			}
		}
		function toEmpty(value){
			if(value.length == 0 || value == ""  || value == "&nbsp;"   ){
				return '';
			}else{
				return value;
			}
		}
		function toNothing(value){
			
			if(value == 0){
				return "";
			}else if(value == null){
				return "";
			}else{
				return value;
			}
		}
		//--------------------------------------------------------------soft seek end
		function isValueNumber(me,evt){
			var id = me.value; 	 
			
			var charCode = (evt.which) ? evt.which : event.keyCode;
			
			if((charCode >= 37 && charCode <= 40) || (charCode >= 96 && charCode <= 105) || charCode >= 48 && charCode <= 57  || charCode == 8 || charCode == 46 || charCode == 13){
				return true;
			}else{
			 	return false;
			}     
		}
		function isAmount(me,evt){
			
			var id = me.value; 	 
			var charCode = (evt.which) ? evt.which : event.keyCode;
			var dashArray = id.match(/\./g);
			if(dashArray){
				if(charCode == 190 || charCode == 110){
				  if(dashArray.length == 1){
					return false;
				  }
				}	
			}	
			
			if (charCode == 190 || charCode == 110 || (charCode >= 37 && charCode <= 40) || (charCode >= 96 && charCode <= 105) || charCode >= 48 && charCode <= 57  || charCode == 8 || charCode == 46){
			 	return true;
			}else{
			 	return false;
			}    
		}
		function interVal(own,t){ 
			setTimeout(
				function(){		
					own();
				},t);
		}//time before execution
		function interVal1(own,t,par){ 
			setTimeout(
				function(){		
					own(par);
				},t);
		}
		function clearInputbox(containerId){
			var container = document.getElementById(containerId);
			var inputs = container.getElementsByTagName('input');
			for(var i = 0; i < inputs.length ; i++){
				inputs[i].value = "";
			}
		}
		
		function checkEmptyField(container){
			var empty = 0;
			var inputs = container.getElementsByTagName('input');
			var select  = container.getElementsByTagName('select');
			var textArea  = container.getElementsByTagName('textArea');
			for(var j = 0 ; j < 3; j++ ){
				if(j == 1){
					inputs = select;
				}else if(j == 2){
					inputs = textArea;
				}	
				for(var i = 0; i < inputs.length ; i++){
					if(inputs[i].value.trim().length == 0 ){
						if(inputs[i].parentNode.children.length <= 1){ //filter para dili ma doble ang empty action
							if(empty == 0){
								var qoute = document.createElement('span');
								qoute.className = 'qoute empty';
								qoute.innerHTML = '&nbsp;Please complete the required fields.';
								inputs[i].parentNode.appendChild(qoute);
							}else{
								var mark = document.createElement('span');
								mark.className = 'labelX empty';
								mark.innerHTML = 'x';
								inputs[i].parentNode.appendChild(mark);
							}
							inputs[i].addEventListener("focus", removeInvalids);
							inputs[i].className += " inputTextEmpty";
						}
						empty++;
					}
				}
			}
			return empty;
		}
		function checkEmptyField1(container,originalClass ){
			var empty = 0;
			var inputs = container.getElementsByTagName('input');
			var select  = container.getElementsByTagName('select');
			var textArea  = container.getElementsByTagName('textArea');
			for(var j = 0 ; j < 3; j++ ){
				if(j == 1){
					inputs = select;
				}else if(j == 2){
					inputs = textArea;
				}	
				for(var i = 0; i < inputs.length ; i++){
					if(inputs[i].value.trim().length == 0 ){
						if(inputs[i].parentNode.children.length <= 1){ //filter para dili ma doble ang empty action
							if(empty == 0){
								var qoute = document.createElement('span');
								qoute.className = 'qoute empty';
								qoute.innerHTML = '&nbsp;Please complete the required fields.';
								inputs[i].parentNode.appendChild(qoute);
							}else{
								var mark = document.createElement('span');
								mark.className = 'labelX empty';
								mark.innerHTML = 'x';
								inputs[i].parentNode.appendChild(mark);
							}
							inputs[i].addEventListener("focus", removeInvalidInfra);
							inputs[i].className += " inputTextEmpty";
						}
						empty++;
					}
				}
			}
			return empty;
		}
		function checkInvalidField(arrayInvalid){//para sa invalid value
			for(var i = 0; i < arrayInvalid.length ; i++){
				var inp = document.getElementById(arrayInvalid[i]);
				if(inp.parentNode.children.length <= 1){
					if(i == 0){
						var qoute = document.createElement('span');
						qoute.className = 'qoute empty';
						qoute.innerHTML = '&nbsp;Mali ni! Taronga.';
						inp.parentNode.appendChild(qoute);
					}else{
						var mark = document.createElement('span');
						mark.className = 'labelX empty';
						mark.innerHTML = 'x';
						inp.parentNode.appendChild(mark);
					}
					inp.addEventListener("focus", removeInvalids);
					inp.className = "inputTextEmpty";
				}
			}
			return arrayInvalid.length;
		}
		function removeInvalids(){
			clickInput1(this);
		}
		function removeInvalidInfra(){
			clickInputInfra(this);
		}
		function clickInputInfra(me){
			var parent =  me.parentNode;
			var child = parent.children.length;
			if(child > 1 ){
				me.parentNode.removeChild(me.parentNode.children[1]);
			}
			me.className = "inputProject";
		}
		function clickInput1(me){
			var parent =  me.parentNode;
			var child = parent.children.length;
			if(child > 1 ){
				me.parentNode.removeChild(me.parentNode.children[1]);
			}
			//var className = me.className.replace(" inputTextEmpty","");
			//me.className = className;
			me.className = "inputText";
		}
		function clickInput(me){
			me.style.backgroundColor = "transparent";
		}
		
		
		
		function checkEmptyNew(container, obj, msg,allowList,func){
			var emp = 0;
			var allow = allowList.split(',');
			var arrObj = obj.split(',');
			for(var k  = 0; k < arrObj.length; k++){
				var inputs = container.getElementsByTagName(arrObj[k]);
				var q = container.getElementsByClassName("qoute").length;
				for(var i = 0; i < inputs.length ; i++){
					
					for(var j = 0 ; j < allow.length; j++){
						if(allow[j] != inputs[i].id){
							var hit = 0;
						}else{
							var hit  = 1;
							break;
						}
					}
					if(hit < 1){
						if(inputs[i].value.trim().length == 0 || inputs[i].value.trim() == ''){
							var arr =inputs[i].className.split(' ');//filter para dili ma doble ang empty action
							if(arr.length == 1){
								if(q == 0){
									if(msg){	
										qouter(inputs[i],"qoute empty", msg);
									}
									q = 1;
								}else{
									qouter(inputs[i],"labelX empty","x");
								}
								classter(inputs[i],func);
							}
							emp++;
						}
					}	
				}
			}
			return emp;
		}
		function classter(me,func){
			me.className += " inputTextEmpty";
			me.addEventListener("focus", func);
		}
		function qouter(me,className,msg){
			var parent = me.parentNode;
			var exist = 0;
			for(var i = 0 ; i < parent.children.length; i++){
				var  cls = parent.children[i].className;
				res = cls.match(/empty/g);
				if(res){
					exist  = 1;
				}
			}
			if(exist == 0 ){
				var qoute = document.createElement('span');
				qoute.className = className;
				qoute.innerHTML = '&nbsp;' + msg;
				me.parentNode.insertBefore(qoute, me.parentNode.children[1]);
			}
			
		}
		
		function remover(me,textClass){
			var parent =  me.parentNode;
			var child = parent.children.length;
			me.className = textClass;
			for(var i = 0; i < child; i++){
				if(parent.children[i].className == "qoute empty" || parent.children[i].className == "labelX empty"){
					me.parentNode.removeChild(me.parentNode.children[i]);
				}
			}
		}
		
		
		function error(t){ 
			t.className += " wiggle"
			setTimeout(
				function(){		
					t.className = t.className.replace(/\b wiggle\b/,'');
					
				},800);
		}//wiggle
		function keypressNext(evt,id){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if(charCode == 13){
				var target = document.getElementById(id);
				target.focus();
				clickInput(target);
			}
		}
		function keypressNext1(evt,id){
			
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if(charCode == 13){
				var target = document.getElementById(id);
				target.focus();
			}
		}
		function focusNext(id){
			document.getElementById(id).focus();
		}
		function keypressAndWhat(me,evt,func){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if(charCode == 13){
				if(func){
					func();
				}
			}
		}
		function keypressAndWhat1(me,evt,func,para){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if(charCode == 13){
				if(func){
					func(me,para);
				}
			}
		}
		function keypressAndWhatClear(me,evt,func,para){
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if(charCode == 13){
				if(func){
					func(me,para);
				}
			}else if(charCode == 17){
				
				searchClear(me);
			}
		}
		function searchClear(me){
			//wala lang
		}
		function keypressAndWhatClearAndAmisSearch(me,evt,func,para){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			
			if(charCode == 13){
				if(func){
					func(me,para);
				}
			}else if(charCode == 17){
				searchClear(me);
			}
		}
		/*function searchClear(me){
			
		}*/
		function keypressAndUpDown(me,evt,func,enter,up,down){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if(charCode == 13){
				if(func == 0){
					focusNext(enter);
				}else{
					func();
				}
				
			}else if(charCode == 38){
				focusNext(up);
			}else if(charCode == 40){
				focusNext(down);
			}
		}
		function clearOneInput(id){
			document.getElementById(id).value = "";
		}
		function keypressSubmit(evt,id){
			var charCode = (evt.which) ? evt.which : event.keyCode;
			if(charCode == 13){
				var target = document.getElementById(id);
				target.click();
			}	  
		}
		//--------------------------------------------------------------------------------- cookie
		function setCookie ( name, value, days){
			var cookie_string = name + "=" + escape ( value );	
		    if(days){
				var date = new Date();
				date.setTime(date.getTime()+(days*24*60*60*1000));
				cookie_string += "; expires="+date.toGMTString();
			}
			document.cookie = cookie_string;
		}
		
		function readCookie(cookieName) {
		
			var cValue = -1;
			var ca = document.cookie.split(';');
			
			for(var i = 0 ; i < ca.length;i++){
				var c = ca[i].split('=');
				if(cookieName.trim() == c[0].trim()){	
					cValue = c[1];
					break;
				}
			}
			
			return cValue;
		}
		
		function cookieMainMenu(){
			var cV = "<?php if(isset($_COOKIE['lastMainMenu'])){ echo $_COOKIE['lastMainMenu'];} ?>";
			return cV;
		}
		function cookieDoctrackMenu(){
			var cV = "<?php if(isset($_COOKIE['lastMain4'])){ echo $_COOKIE['lastMain4'];} ?>";
			return cV;
		}
		function cookieAppropriationsMenu(){
			var cV = "<?php if(isset($_COOKIE['lastMain2'])){ echo $_COOKIE['lastMain2'];} ?>";
			return cV;
		}
		function cookieSAAOBMenu(){
			var cV = "<?php if(isset($_COOKIE['lastMain5'])){ echo $_COOKIE['lastMain5'];} ?>";
			return cV;
		}
		function cookiePPMPMenu(){
			var cV = "<?php if(isset($_COOKIE['lastMain6'])){ echo $_COOKIE['lastMain6'];} ?>";
			return cV;
		}
		
		function cookieInventoryMenu(){
			var cV = "<?php if(isset($_COOKIE['lastMain7'])){ echo $_COOKIE['lastMain7'];} ?>";
			return cV;
		}
		function cookieInfraMenu(){
			var cV = "<?php if(isset($_COOKIE['lastMainInfra'])){ echo $_COOKIE['lastMainInfra'];} ?>";
			return cV;
		}
		function cookieLabel(ind,containerId){
			
			var parent = document.getElementById(containerId);
			if(parent.children[ind]){
				return parent.children[ind].textContent;
			}
		} 
		
		function isNumber(n) {
		  return !isNaN(parseFloat(n)) && isFinite(n);
		}
		//getAcctgEntry();
		var sc = 0;
		
		function editor(fieldName,fieldId,oldValue,func){
			
			var id =  fieldId;
			var sheet = "<div class = 'editorContainer'><table class='editorTable' style ='font-family:Oswald;'>";
				sheet += "<tr><td class = 'editorHeader' colspan = '2' >Editor<div onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>";
			    sheet += "<tr><td class = 'editorLabel' >" + fieldName + "</td><td style = 'padding-bottom:20px; padding-top:40px;padding-right:40px;'>";
				
				if(fieldName == "Fund"){
					sheet += "<select class = 'select2' style = 'width:200px;font-family:Oswald;font-size:20px;'><option>General Fund</option><option>Trust Fund</option><option>SEF</option></select>";
				}else if(fieldName == "Period"){
					sheet += "<select class = 'select2' onchange ='viewPeriod(this)' style = 'width:200px;font-family:Oswald;font-size:20px;'>";
					sheet += "<option>January</option>";
					sheet += "<option>February</option>";
					sheet += "<option>March</option>";
					sheet += "<option>April</option>";
					sheet += "<option>May</option>";
					sheet += "<option>June</option>";
					sheet += "<option>July</option>";
					sheet += "<option>August</option>";
					sheet += "<option>September</option>";
					sheet += "<option>October</option>";
					sheet += "<option>November</option>";
					sheet += "<option>December</option>";
					sheet += "</select>";
					
				}else if(fieldName === "Sub Program"){
					sheet += "<select id = 'editSub' class = 'select2' onchange ='viewPeriod(this)' style = 'width:200px;font-family:Oswald;font-size:20px;'>";
					sheet += "<option>&nbsp;</optiom>";
					sheet += "</select>";
					
				}else if(fieldName == "Document"){
					sheet += "<?php echo $docTypeSelect; ?>";
				}else if(fieldName== "Type"){
					sheet += "<select class = 'select2' style = 'width:200px;font-family:Oswald;font-size:20px;'><option>Check</option><option>Window</option><option>Others</option><option value = 'Payroll'>2016 Payroll</option><option value = 'Voucher'>2016 Voucher</option></select>";
				}else if(fieldName== "Mode of Procurement"){
					sheet += "<select class = 'select2' style = 'width:200px;font-family:Oswald;font-size:20px;'><option>High Value</option><option>Small Value</option><option>Negotiated</option></select>";
				}else if(fieldName == "Mode") {

					sheet += "<select class='select2' style='width:300px; font-family:Oswald; font-size:16px;'>";
					sheet += "	<option></option>";
					sheet += "	<option value='1'>Competitive Bidding</option>";
					sheet += "	<option value='2'>Shopping</option>";
					sheet += "	<option value='3'>Shopping 52.1.b</option>";
					sheet += "	<option value='4'>Alternative</option>";
					sheet += "	<option value='5'>Agency to Agency</option>";
					sheet += "	<option value='18'>Agency to Agency (DBM)</option>";
					sheet += "	<option value='6'>Negotiated</option>";
					sheet += "	<option value='7'>Negotiated Procurement 53.9(SVP)</option>";
					sheet += "	<option value='8'>Negotiated Procurement 53.1(TFB)</option>";
					sheet += "	<option value='9'>Negotiated Procurement 53.6(MS)</option>";
					sheet += "	<option value='10'>Negotiated Procurement 53.7</option>";
					sheet += "	<option value='11'>Negotiated Procurement 53.2(E.C.)</option>";
					sheet += "	<option value='12'>Postal Office</option>";
					sheet += "	<option value='13'>Direct Contracting</option>";
					sheet += "	<option value='14'>Repeat Order</option>";
					sheet += "	<option value='15'>Twice Failed Bidding(TFB)</option>";
					sheet += "	<option value='16'>Extension of Contract Appx. 21 Sec. 3.31</option>";
					sheet += "	<option value='17'>Renewal of Contract Based on Appendix 21 3.3.1.3</option>";
					sheet += "	<option value='19'>Lease of Real Property Sec 5.10</option>";
					sheet += "</select>";

				}else if(fieldName== "Transaction Classification"){
					sheet += "<select class = 'select2' style = 'width:200px;font-family:Oswald;font-size:20px;'><option value = '-1'></option><option value = '1'>Simple</option><option value = '2'>Complex</option></select>";
				}else if(fieldName== "Barangay"){
					sheet += "<select class = 'select2' style = 'width:200px;font-family:Oswald;font-size:20px;'>" + 
						       "<option>Acacia</option><option>Agdao Proper</option><option>Alambre</option><option>Angalan</option><option>Angliongto</option><option>Atan-awe</option><option>Baganihan</option><option>Bago Aplaya</option><option>Bago Gallera</option><option>Bago Oshiro</option><option>Baguio Proper</option><option>Balingaeng</option><option>Baliok</option><option>Bangkas Height</option><option>Bantol</option><option>Baracatan</option><option>1-A</option><option>10-A</option><option>11-B</option><option>12-B</option><option>13-B</option><option>14-B</option><option>15-B</option><option>16-B</option><option>17-B</option><option>18-B</option><option>19-B</option><option>2-A</option><option>20-B</option><option>21-C</option><option>22-C</option><option>23-C</option><option>24-C</option><option>25-C</option><option>26-C</option><option>27-C</option><option>28-C</option><option>29-C</option><option>3-A</option><option>30-C</option><option>31-D</option><option>32-D</option><option>33-D</option><option>34-D</option><option>35-D</option><option>36-D</option><option>37-D</option><option>38-D</option><option>39-D</option><option>4-A</option><option>40-D</option><option>5-A</option><option>6-A</option><option>7-A</option><option>8-A</option><option>9-A</option><option>Bato</option><option>Bayabas</option><option>Biao Escuela</option><option>Biao Guianga</option><option>Biao Joaquin</option><option>Binugao</option><option>Bucana</option><option>Buda</option><option>Buhangin Proper</option><option>Bunawan Proper</option><option>Cabantian</option><option>Cadalian</option><option>Calinan Poblacion</option><option>Callawa</option><option>Camansi</option><option>Carmen</option><option>Catalunan Grande</option><option>Catalunan Pequeño</option><option>Catigan</option><option>Cawayan</option><option>Centro</option><option>Colosas</option><option>Communal</option><option>Crossing Bayabas</option><option>Dacudao</option><option>Dalag</option><option>Dalagdag</option><option>Daliao</option><option>Daliaon Plantation</option><option>Datu Salumay</option><option>Dominga</option><option>Dumoy</option><option>Eden</option><option>Fatima</option><option>Gatungan</option><option>Gumalang</option><option>Gumitan</option><option>Hizon</option><option>Ilang</option><option>Inayagan</option><option>Indangan</option><option>Kilate</option><option>Lacson</option><option>Lamanan</option><option>Lampianao</option><option>Langub</option><option>Lapu-lapu</option><option>Lasang</option><option>Leon Garcia</option><option>Lizada</option><option>Los Amigos</option><option>Lubogan</option><option>Lumiad</option><option>Ma-a</option><option>Mabuhay</option><option>Magsaysay</option><option>Magtuod</option><option>Mahayag</option><option>Malabog</option><option>Malagos</option><option>Malamba</option><option>Manambulan</option><option>Mandug</option><option>Manuel Guianga</option><option>Mapula</option><option>Marapangi</option><option>Marilog Proper</option><option>Matina Aplaya</option><option>Matina Biao</option><option>Matina Crossing</option><option>Matina Pangi</option><option>Megcawayan</option><option>Mintal</option><option>Mudiang</option><option>Mulig</option><option>New Carmen</option><option>New Valencia</option><option>Paciano Bangoy</option><option>Pampanga</option><option>Panacan</option><option>Pañalum</option><option>Pandaitan</option><option>Pangyan</option><option>Paquibato Proper</option><option>Paradise Embac</option><option>R. Castillo</option><option>Riverside</option><option>Salapawan</option><option>Salaysay</option><option>Saloy</option><option>San Antonio</option><option>San Isidro</option><option>Sasa</option><option>Sibulan</option><option>Sirawan</option><option>Sirib</option><option>Sto. Niño</option><option>Suawan</option><option>Subasta</option><option>Sumimao</option><option>Tacunan</option><option>Tagakpan</option><option>Tagluno</option><option>Tagurano</option><option>Talandang</option><option>Talomo Proper</option><option>Talomo River</option><option>Tamayong</option><option>Tambobong</option><option>Tamugan</option><option>Tapak</option><option>Tawan-tawan</option><option>Tibuloy</option><option>Tibungco</option><option>Tigatto</option><option>Tomas Monteverde</option><option>Toril Poblacion</option><option>Tugbok Proper</option><option>Tungkalan</option><option>Ubalde</option><option>Ula</option><option>Vicente Duterte</option><option>Waan</option><option>Wangan</option><option>Aquino</option><option>Wines</option>" +
						     "</select>";
				}else if(fieldName == "PaymentTerm") {
					
					var poMode = document.getElementById('poPOMode').textContent.trim();
					if(poMode == 'Agency to Agency' || poMode == 'Postal Office' || poMode == 'Agency to Agency (DBM)') {

						sheet += "<select class='select2' style='width:200px; font-family:Oswald; font-size:16px;'>";
						sheet += "<option value='3'>Cash on Delivery</option>";
						sheet += "<option value='4'>Complete Delivery</option>";
						sheet += "</select>";

					}else {

						sheet += "<select class='select2' style='width:200px; font-family:Oswald; font-size:16px;'>";
						sheet += "<option></option>";
						sheet += "<option value='1'>After full delivery</option>";
						sheet += "<option value='2'>Per Statement</option>";
						sheet += "</select>";

					}

				}else if(fieldName == "Gas Period"){

					sheet += "<select class='select2' style='width:200px; font-family:Oswald; font-size:20px;'>";
					sheet += "<option>January</option>";
					sheet += "<option>February</option>";
					sheet += "<option>March</option>";
					sheet += "<option>April</option>";
					sheet += "<option>May</option>";
					sheet += "<option>June</option>";
					sheet += "<option>July</option>";
					sheet += "<option>August</option>";
					sheet += "<option>September</option>";
					sheet += "<option>October</option>";
					sheet += "<option>November</option>";
					sheet += "<option>December</option>";
					sheet += "</select>";
					
				}else{
					sheet += "<input class='select2' style = 'margin:0 auto;width:400px;padding:10px;font-family:Oswald;font-size:18px;'  id = 'old" + oldValue + "'  onclick = 'clickInput(this)' value = '" + oldValue + "'  />";
				}
				
				sheet += "</td></tr id = 'editorPeriod' >";
				sheet += "<tr style = 'display:none;'><td colspan = '2' style = ''><table style = 'border:1px solid white;margin-left:57px;margin-bottom:20px;background-color:rgba(192, 192, 192,.3);'>";
				sheet += " <tr><td class = 'editorLabel' style = 'vertical-align:top;padding-top:10px;' >Period</td><td style = ''>";
				sheet += " <select id = 'editorP1' class = 'select2' style= 'width:200px;font-family:Oswald;font-size:20px;'><option>Monthly</option><option>Quarterly</option><option>First Half</option><option>Second Half</option></select></td></tr>";
				sheet += " <tr><td class = 'editorLabel' style = 'vertical-align:top;padding-top:10px;' >Value</td><td style = ''>";
				sheet += " <select id = 'editorP2' class = 'select2' style= 'width:200px;font-family:Oswald;font-size:20px;'><option>January</option><option>February</option><option>March</option><option>April</option><option>May</option><option>June</option><option>July</option><option>August</option><option>September</option><option>October</option><option>November</option><option>December</option><option>1st Quarter</option><option>2nd Quarter</option><option>3rd Quarter</option><option>4th Quarter</option></select></td></tr>";
				
				sheet += "</table></td></tr>";
				sheet += "<tr><td colspan = '2' style = 'padding-bottom:20px;text-align:center;'><input type = 'hidden' id = 'hiddens' value = '"  + oldValue +  "'><div   id = '" + id + "' class ='button1 b1' onclick= 'goUpdate(this)'>Save</div></td></tr>";
				sheet += "</table></div>";
			theAbsolute(sheet);
			//document.getElementById("old" + oldValue).focus();
		}
		function editor1(fieldName,fieldId,oldValue,func){
			var id =  fieldId;
			var sheet = "<div class = 'remarkEditorContainer'><table class='editorTable'>";
				sheet += "<tr><td class = 'editorHeader' colspan = '2' >Editor<div onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>";
			    sheet += "<tr><td class = 'editorLabel' >" + fieldName + "</td><td style = 'padding-bottom:20px; padding-top:40px;padding-right:40px;'>";
				sheet += "<input class='select2' style = 'padding:10px;width:auto;' id = 'amountEntered" + id + "'  value = '" + oldValue + "' onkeydown = 'return isAmount(this,event)'  />";
				sheet += "</td></tr>";
				sheet += "<tr><td colspan = '2' style = 'padding-bottom:20px;text-align:center;'><div   id = '" + id + "' class ='button1' onclick= " + func + ">Save</div></td></tr>";
				
				sheet += "</table></div>";
			theAbsolute(sheet);
		}
		function remarks(title,fieldName,fieldId,oldValue,func){
			var id =  fieldId;
			var sheet = "<div class = 'editorContainer' ><table style = 'font-family:Oswald;margin:0px;' class='editorTable'>";
				sheet += "<tr><td class = 'editorHeader' colspan = '2' style = 'background-color:rgb(234, 59, 149);color:white;' >" + title + " <b style ='font-size:20px;'>" +  id +"</b><div id = 'closeRem' onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>";
			    sheet += "<tr><td class = 'editorLabel' style = 'vertical-align:top;padding-top:47px;' >" + fieldName + "</td><td style = 'padding-bottom:20px; padding-top:40px;padding-right:40px;'>";
				sheet += "<textarea class='select2' style = 'padding:10px;width:250px;height:120px;font-size:16px;' placeholder = '' id = 'remValue'/></textarea>";
				sheet += "</td></tr>";
				sheet += "<tr><td colspan = '2' style = 'padding-bottom:20px;text-align:center;padding-left:50px;'><div   id = '" + id + "' class ='button1' onclick = '" + func + "'>Save</div></td></tr>";
				sheet += "</table></div>";
			theAbsolute(sheet);
			
		}
		function remarks1(title,fieldName,fieldId,func){
			var id =  fieldId;
			var sheet = "<div class = 'editorContainer' ><table style = 'font-family:Oswald;margin:0px;' class='editorTable'>";
				sheet += "<tr><td class = 'editorHeader' colspan = '2' style = 'background-color:rgb(8, 149, 196);color:white;' >" + title + " <div id = 'closeRem' onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>";
			    sheet += "<tr><td class = 'editorLabel' style = 'vertical-align:top;padding-top:47px;' >" + fieldName + "</td><td style = 'padding-bottom:20px; padding-top:40px;padding-right:40px;'>";
				sheet += "<textarea class='select2' maxlength ='200' style = 'padding:10px;width:250px;height:120px;font-size:16px;' placeholder = '' id = 'remValue'></textarea>";
				sheet += "</td></tr>";
				sheet += "<tr><td colspan = '2' style = 'padding-bottom:20px;text-align:center;padding-left:50px;'><div  id = '" + id + "' class ='button1' onclick = '" + func + "'>Save</div></td></tr>";
				sheet += "</table></div>";
			theAbsolute(sheet);
			
		}
		function editorLiquidation(fieldName,fieldId,oldValue,func){
			
			var id =  fieldId;
			var arr = oldValue.split("~");
			
			var ca = arr[0];
			var spent = arr[1].trim();
			
			
			var sheet = "<div class = 'editorContainer'>";
				sheet += "<table class='editorTable' border = '0' style = 'font-family:Oswald;text-align:right;'>";
				sheet += "<tr><td class = 'editorHeader' colspan = '2' style = 'text-align:left;' >Editor<div onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>";
			    sheet += "<tr><td colspan ='1' style ='padding:5px;'></td></tr>";
			    sheet += "<tr><td>Cash Advance</td><td style = 'padding:3px;padding-right: 5px;'>";
				sheet += "<input id ='caEditAmount' disabled style = 'font-weight:bold;font-size:18px;font-family:Oswald;text-align:center;'   value = '" + numberWithCommas(ca) + "'  />";
				sheet += "</td></tr>";
				
				sheet += "<tr><td >" + fieldName + "</td><td style = 'padding:3px;padding-right:5px;'>";
				sheet += "<input  style = 'font-weight:bold;font-size:18px;text-align:center;font-family:Oswald;' id = 'amountSpentEdit'  onkeyup='enteredSpent(this)' value = '' onkeydown = 'return isAmount(this,event)'  />";
				sheet += "</td></tr>";
				
				sheet += "<tr><td colspan ='1' style ='padding:2px;'></td></tr>";
			    sheet += "<tr><td>Refund</td><td style = 'padding:3px;padding-right:5px;'>";
				sheet += "<input disabled style = 'font-weight:bold;font-size:18px;font-family:Oswald;text-align:center;' id = 'amountRefundEdit' value = ''  />";
				sheet += "</td></tr>";
				
				sheet += "<tr><td colspan ='1' style ='padding:2px;padding-right:5px;'></td></tr>";
			    sheet += "<tr><td>To be reimbursed</td><td style = 'padding:3px;padding-right:5px;'>";
				sheet += "<input disabled style = 'font-weight:bold;font-size:18px;font-family:Oswald;text-align:center;'id = 'amountReimEdit'  value = ''  />";
				sheet += "</td></tr>";
				
				sheet += "<tr ><td colspan ='1' style ='padding:2px;padding-right:5px;'></td></tr>";
			    sheet += "<tr id = 'trEditOR' style = 'display:none;'><td>OR details</td><td style = 'padding:3px;padding-right:5px;'>";
				sheet += "<input maxlength = '20'  style = 'font-weight:bold;font-size:18px;font-family:Oswald;text-align:center;'id = 'editOR'  value = ''  />";
				sheet += "</td></tr>";
				
				sheet += "<tr><td colspan ='1' style ='padding:10px;'></td></tr>";
				
				sheet += "<tr><td></td><td style = 'padding-bottom:20px;text-align:center;'><div   id = '" + fieldId + "' class ='button1' onclick= 'goUpdateLiquidation(this)'>Save</div></td></tr>";
				
				sheet += "</table></div>";
			theAbsolute(sheet);
		}

		function editorNatureOfPayment(fieldName,fieldId,oldValue,func) {

			var sheet = "";

			sheet = "<div class='editorContainer'>"
					+ "	<table class='editorTable' border='0' cellpadding='0' style=''>"
					+ "		<tr><td class = 'editorHeader' colspan = '2' style = 'text-align:left;' >Editor<div onclick ='closeAbsolute(this)' class = 'closeEditor'></div></td></tr>"
					+ "		<tr>"
					+ "			<td style='width:0px; white-space:nowrap; font-weight:bold; padding:0px 5px 0px 20px;'>Nature of Payment</td>"
					+ "			<td style='padding:10px 20px 5px 0px;'>"
					+ "				<select class='select2' id='newNatureOfPayment' style='width:200px; font-family:Oswald; font-size:20px;' onchange='setEditorSpecifics(this)'>"
					+ "					<option></option>"
					+ "					<option>Goods/Items</option>"
					+ "					<option>Services</option>"
					+ "					<option>Rentals</option>"
					+ "				</select>"
					+ "			</td>"
					+ "		</tr>"
					+ "		<tr>"
					+ "			<td style='width:0px; white-space:nowrap; font-weight:bold; padding:0px 5px 0px 20px;'>Specifics</td>"
					+ "			<td style='padding:5px 20px 10px 0px;'>"
					+ "				<select class='select2' id='newSpecifics' style='width:200px; font-family:Oswald; font-size:20px;'>"
					+ "					<option></option>"
					+ "				</select>"
					+ "			</td>"
					+ "		</tr>"
					+ "		<tr>"
					+ "			<td></td>"
					+ "			<td style='padding:10px 20px 20px 0px; padding-right:20px;'>"
					+ "				<div   id = '" + fieldId + "' class ='button1' onclick= 'goUpdateNatureAndSpecifics(this)'>Save</div>"
					+ "			</td>"
					+ "		</tr>"
					+ ""
					+ "	</table>"
					+ "</div>";

			theAbsolute(sheet);

		}

		function editorSupplier(trackingNumber,oldValue) {
			var queryString = "?loadSupplierAddNewPOInEdit=1&trackingNumber="+trackingNumber+"&oldValue="+ encodeURIComponent(oldValue);
            var container = document.getElementById('tdMessage');
            loader();
            ajaxGetAndConcatenate(queryString,processorLink,container,"loadSupplierAddNewPOInEdit");
		}

		function editorContractor(trackingNumber,oldValue) {
			var queryString = "?loadContractorsInEdit=1&trackingNumber="+trackingNumber+"&oldValue="+ encodeURIComponent(oldValue);
            var container = document.getElementById('tdMessage');
            loader();
            ajaxGetAndConcatenate(queryString,processorLink,container,"loadContractorsInEdit");
		}
		
		function msg(message){
			var sheet = "<div class = 'editorContainer'><table class='editorTable'>";
				sheet += "<tr><td class = 'tdMessage' >" + message.trim() + "</td>";
				sheet += "<tr><td style ='text-align:center;'><input class = 'hiddenInput' type = 'hidden' id = 'hiddenInput' onkeydown = 'keypressAndWhat(this,event,closeAbsolute)' /><input id = 'messageBoxClose' type = 'submit'  class = 'closeMessage' onclick ='closeAbsolute(this)' value = 'Close'/></td>";
				sheet += "</table></div>";
			
			theAbsolute(sheet);
			document.getElementById('absoluteHolder').style.zIndex = 106;
		}
		
		function msg1(message){
			var sheet = "<div class = 'editorContainer'><table class='editorTable'>";
				sheet += "<tr style = 'background-color:white;'>";
				sheet += "<td style = 'float:right;'><input class = 'hiddenInput' type = 'hidden' id = 'hiddenInput'onkeydown = 'keypressAndWhat(this,event,closeAbsolute)' /><input id = 'clickClose' type = 'submit' class = 'button2' style = 'padding:10px;cursor:pointer;font-weight:normal;' onclick ='closeAbsolute(this)' value = 'Cancel'/></td>";
				sheet += "<tr><td class = 'tdMessage' >" + message.trim() + "</td>";
				sheet += "</table></div>";
			
			theAbsolute(sheet);
			document.getElementById('absoluteHolder').style.zIndex = 106;
		}
		function msg2(message){
			var sheet = "<div class = 'editorContainer'><table class='editorTable'>";
				sheet += "<tr style = 'background-color:white;'>";
				sheet += "<td style = 'float:right;'><input class = 'hiddenInput' type = 'hidden' id = 'hiddenInput'onkeydown = 'keypressAndWhat(this,event,closeAbsolute)' /><input id = 'clickClose' type = 'submit' class = 'button2' style = 'background-color:rgb(248, 226, 230); text-shadow:0px 0px 1px white; padding:2px 5px;cursor:pointer;font-weight:bold;' onclick ='closeAbsolute(this)' value = '&#215;'/></td>";
				sheet += "<tr><td class = 'tdMessage' >" + message.trim() + "</td>";
				sheet += "</table></div>";
			
			theAbsolute(sheet);
			document.getElementById('absoluteHolder').style.zIndex = 106;
		}
		function msg3(message){
			var sheet = "<div class = 'editorContainer' style ='background-color:rgba(252, 255, 255,.1);padding:10px 15px;'><table class='editorTable'>";
				sheet += "<tr style = 'background-color:transparent;'>";
				sheet += "<td style = 'float:right;'><input class = 'hiddenInput' type = 'hidden' id = 'hiddenInput'onkeydown = 'keypressAndWhat(this,event,closeAbsolute)' /><input id = 'clickClose' type = 'submit' class = 'button2' style = 'display:none;background-color:rgb(248, 226, 230); text-shadow:0px 0px 1px white; padding:2px 5px;cursor:pointer;font-weight:bold;' onclick ='closeAbsolute(this)' value = '&#215;'/></td>";
				sheet += "<tr><td class = 'tdMessage' >" + message.trim() + "</td>";
				sheet += "</table></div>";
			
			theAbsolute(sheet);
			document.getElementById('absoluteHolder').style.zIndex = 106;
		}
		function loader(){
			var sheet = "<div class = 'loaderContainer' ><table id = 'loader' style ='z-Index:100px;'  >";
				sheet += "<tr style = ''>";
				sheet += "<td style = 'float:right;'><div class = 'loader' ></div></td>";
				sheet += "</table></div>";
			
			var exist = document.getElementById("loader");
			if(exist){
				closeAbsolute(1);
			}else{
				theAbsolute1(sheet);
				document.getElementById('absoluteHolder').style.zIndex = 106;
			}
		}
		function theAbsolute(sheet){
			var table = document.createElement('table');
			table.id = "absoluteHolder";
			table.className = "absoluteHolder";
			sc = document.body.scrollLeft;
			document.body.scrollLeft = 0;
			document.body.style.overflowX = 'hidden';
			
			scTop = document.body.scrollTop;
			document.body.scrollTop = 0;
			document.body.style.overflowY = 'hidden';
			
			var row = table.insertRow(0);
		    	var cell = row.insertCell(0);
			cell.innerHTML = sheet;
			document.body.insertBefore(table, document.body.children[0]);
		}
		
		function theAbsolute1(sheet){
			var table = document.createElement('table');
			table.id = "absoluteHolder";
			table.className = "absoluteHolder1";
			sc = document.body.scrollLeft;
			document.body.scrollLeft = 0;
			document.body.style.overflowX = 'hidden';
			
			scTop = document.body.scrollTop;
			document.body.scrollTop = 0;
			document.body.style.overflowY = 'hidden';
			
			var row = table.insertRow(0);
		      var cell = row.insertCell(0);
			cell.innerHTML = sheet;
			document.body.insertBefore(table, document.body.children[0]);
		}
		function closeAbsolute(me){
			document.body.scrollLeft = sc;
			document.body.scrollTop = scTop;
			
			var parent = document.getElementById('absoluteHolder');
			parent.parentNode.removeChild(parent);
			document.body.style.overflowX = 'auto';
			document.body.style.overflowY= 'auto';
		}
		//----------------------------------------------------------- appropriations
		function menuChanger(me,menuSelected,menuType,container,containerClass){
		
			var parent =  me.parentNode;
			var label = me.textContent;
			var className = me.className;
			var containerBody = document.getElementById(container);
			if(className != menuSelected){
				for(var i = 0 ; i < parent.children.length; i++){
					parent.children[i].className = className;
					if(containerBody.children[i]){
						containerBody.children[i].className ="hide";
					}
					if(label == parent.children[i].textContent){
						me.className = menuSelected;
						if(containerBody.children[i]){
								containerBody.children[i].className = containerClass;
						}
					
						setCookie(menuType,i, 100);
					}
				}	
			}
		}
		function closex(){
			closeAbsolute(1);
		}
		//-------------------------------------------
		function createRowHeader(Id,fields){
			
				var table = document.getElementById(Id);
				var tableWidth = table.offsetWidth;
				
				var length = table.children[0].children[0].children.length;
				if(length){
					
				
					var td = table.children[0].children[0].children;
					
					var field = fields.split(",");
					
					var sheet = "<table style = 'width:" + tableWidth + "px;border-spacing:1;'><tr>";
					var align = "left"
					for(var i = 0; i < td.length ; i++){
						var width = td[i].offsetWidth;
						if(i == 7){
							align =  "left;";
						}else{
							align =  "center";
						}
						sheet += "<td width=" + width + " class = 'tdSAAOBHeader3' style = ' font-size:12px; text-align:" + align + ";'>" + field[i] +  "</td>";
					}
					sheet += "</tr></table>";
				
					return sheet;
				}
			}
		
		function scrollTop(){
			document.body.scrollTop = 0;
		}
		function scrollBottom(){
			document.body.scrollTop = document.body.scrollTop;
		}
		var th = ['','thousand','million', 'billion','trillion'];
			// uncomment this line for English Number System
			// var th = ['','thousand','million', 'milliard','billion'];
		var dg = ['zero','one','two','three','four','five','six','seven','eight','nine']; 
		var tn =['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen','seventeen','eighteen','nineteen']; 
		var tw = ['twenty','thirty','forty','fifty','sixty','seventy','eighty','ninety']; 


		function convertWordCurrency(ss){
			var ss = ss.toString(); 
			var num = ss.split('.');
			 if(num.length == 2){
				var numA = parseInt(num[0]);
				var numB =num[1];
				if(numB.length == 1){              //decimal remove trailing zero
					numB = numB + "0";
				}else{
					if(numB.substr(0,1) == '0'){
						numB = parseInt(numB);
					}
				}
				if(numB > 1){
					var cen = " CENTAVOS";	
					cen = '';
					var inWords = toWords(numA) +  ' PESOS AND ' +   numB +  '/100' + cen;
				}
				 if(numB == 1){
					var cen = " CENTAVO";	
					cen = '';
					var inWords = toWords(numA) +  ' PESOS AND  ' +   numB +  '/100' +  cen;
				}
				if(numB == 0){
					var inWords = toWords(numA) +  ' PESOS'
				}
			}else{
				var numA =  num[0];
				var inWords = toWords(numA) +  ' PESOS'
			}
			return  inWords.toUpperCase();
		}
		function toWords(s){
			s = s.toString(); 
			s =s.replace(/[\, ]/g,''); 
			if (s != parseFloat(s)) return 'not a number'; 
			var x = s.indexOf('.'); 
			if (x == -1) x = s.length; 
			if (x > 15) return 'too big'; 
			var n =s.split(''); 
			var str = ''; 
			var sk = 0; 
			for (var i=0; i < x; i++) {
				if((x-i)%3==2) {
					if (n[i] == '1') {
						str += tn[Number(n[i+1])] + ' '; 
						i++; 
						sk=1;
				}else if (n[i]!=0) {
					str += tw[n[i]-2] + ' ';
					sk=1;}
				} else if (n[i]!=0) {
					str +=dg[n[i]] +' '; 
					if ((x-i)%3==0) str += 'hundred ';
						sk=1;
					} 
					if ((x-i)%3==1) {
						if (sk)str += th[(x-i-1)/3] + ' ';sk=0;
					}
				} if (x != s.length) {
					var y = s.length; str +='and '; 
				for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';
				} 
				return str.replace(/\s+/g,' ');
		}
		function vScram1(text){
			var x = Math.random();
			var crambles = x.toString(36).substr(2);
			return crambles.substring(3,7) +  btoa(unescape(encodeURIComponent(text))) + crambles.substring(0,3);
		}
		function vScram(b){
			var key = "<?php echo $padding;?>";
			
			var pads = '';
			var x1 = 0;
			for(var i = 0 ; i < key.length; i++){
				var x = key.charCodeAt(i).toString(10);
				x1 = parseInt(x1) + parseInt(x);
				pads += x;
			}
			var a = b.substr(0);
			var ind = parseInt(a.length / 2);
			var first = a.substr(ind);
			var second = a.substring(0,ind);
			
			var s = '';
			
			var f1 = first.split('').reverse().join("");	
			var lastlen =  first.length;
			
			for(var i = 0; i < lastlen; i++){
				if(s.length < lastlen){
					s += first[i];
				}
				if(s.length < lastlen){
					s += f1[i];
				}else{
					break;
				}
			}
			var text = second.split('').reverse().join("") + s;
			var x = Math.random();
			var crambles = x.toString(36).substr(2,8);
			var crunch = '';
			var j = 0;
			for(var i = 0; i < text.length; i++){
				if(j < crambles.length){
					var cramb =  crambles[j];
					j++;
				}else{
					j = 0;
					var cramb =  crambles[j];
				}
				var t = text[i];
				crunch += cramb + t ;
			}
			
			var cLen = crunch.length;
			if(x1 <= cLen ){
				t = x1;
			}else{
				var t = x1;
				while(t > 0){
					if(t - cLen > 0){
						t = parseInt(t) - parseInt(cLen);
					}else{
						break;
					}
				}
			}
			var crunchier =  ''
			for(var i = 0; i < cLen;i++){
				crunchier += crunch[i];
				if(i >= (t-1)){
					var yInd  = Math.floor((Math.random() * crambles.length-1) + 1);
					crunchier +=  crambles[yInd];
				}
			}
			crunchier = crunchier + key[1] + cLen;
			return crunchier;
		}
		function sendSms(trackingNumber){
			
			interVal1(actualSender,5000,trackingNumber)		
		}
		function actualSender(trackingNumber){
			var container = "";
			var queryString = "?sendSMS=1&trackingNumber=" + trackingNumber ;
			ajaxGetAndConcatenate(queryString,processorLink,container,"sendSMS");
		}
		function sendSmsAlways(trackingNumber){	
			interVal1(actualSenderAlways,5000,trackingNumber)		
		}
		function actualSenderAlways(trackingNumber){
			var container = "";
			var container = document.getElementById('doctrackUpdateContainer');		
			var queryString = "?sendSMSAlways=1&trackingNumber=" + trackingNumber ;
			ajaxGetAndConcatenate(queryString,processorLink,container,"sendSMSAlways");
		}
		function numberToMonth(month){
			if(month == 1){
				month = "January";
			}else if(month == 2){
				month = "February";
			}else if(month ==3){
				month = "March";
			}else if(month == 4){
				month = "April";
			}else if(month == 5){
				month = "May";
			}else if(month == 6){
				month = "June";
			}else if(month == 7){
				month = "July";
			}else if(month == 8){
				month = "August";
			}else if(month == 9){
				month = "September";
			}else if(month == 10){
				month = "October";
			}else if(month == 11){
				month = "November";
			}else if(month == 12){
				month = "December";
			}
			return month;
		}

		function fileCheckJS(file, allowed) {
			var fileName = file.name;
			var fileType = file.type;
			var fileExtn = fileName.split('.').pop().toUpperCase();

			var allowedExt = allowed.toUpperCase().split(',');
			var allowedType = [];
			var type = "";
			for(var i = 0 ; i < allowedExt.length; i++){
				type = "";
				if(allowedExt[i] == "JPG"){
					type = "image/jpeg";
				}else if(allowedExt[i] == "JPEG"){
					type = "image/jpeg";
				}else if(allowedExt[i] == "PNG"){
					type = "image/png";
				}else if(allowedExt[i] == "GIF"){
					type = "image/gif";
				}else if(allowedExt[i] == "XLS"){
					type = "application/vnd.ms-excel";
				}else if(allowedExt[i] == "XLSX"){
					type = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
				}else if(allowedExt[i] == "DOC"){
					type = "application/msword";
				}else if(allowedExt[i] == "DOCX"){
					type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
				}else if(allowedExt[i] == "PDF"){
					type = "application/pdf";
				}else if(allowedExt[i] == "DBF"){
					type = "application/octet-stream";
				}
				if(type != "") {
					allowedType[i] = type;
				}
			}

			var err = 0;
			if(allowedType.length == allowedExt.length) {
				
				if(!allowedExt.includes(fileExtn)) {
					err = 1;
				}

				if(!allowedType.includes(fileType)) {
					err = 1;
				}

			}else {
				err = 1;
			}

			return err;
		}
		function checkDuplicate(arr){
			var x = 0;
			for(var j = 0; j < arr.length; j++){
				for(var k = 0; k < arr.length; k++){
					if(j != k){
						var a = arr[j].trim();
						var b = arr[k].trim();
						if(a == b ){
					    	x =1;
					    	break
					    }
					}
				}  
				if(a == b ){
					break
				}   
			}
			return x;	
		}

		function loader2(){
			var sheet = "<div class = 'loaderContainer'><table id = 'loader' style ='z-Index:100px;'>";
				sheet += "<tr style = ''>";
				sheet += "<td style = 'float:right;'><div class = 'loader2'></div></td>";
				sheet += "</table></div>";
			
			var exist = document.getElementById("loader");
			if(exist){
				closeAbsolute(1);
			}else{
				theAbsolute2(sheet);
				document.getElementById('absoluteHolder').style.zIndex = 106;
			}
		}

		function theAbsolute2(sheet){
			var table = document.createElement('table');
			table.id = "absoluteHolder";
			table.className = "absoluteHolder2";
			sc = document.body.scrollLeft;
			document.body.scrollLeft = 0;
			document.body.style.overflowX = 'hidden';
			
			scTop = document.body.scrollTop;
			document.body.scrollTop = 0;
			document.body.style.overflowY = 'hidden';
			
			var row = table.insertRow(0);
		    var cell = row.insertCell(0);
			cell.innerHTML = sheet;
			document.body.insertBefore(table, document.body.children[0]);
		}

		function theAbsolute3(sheet){
			var table = document.createElement('table');
			table.id = "absoluteHolder";
			table.className = "absoluteHolder2";
			sc = document.body.scrollLeft;
			document.body.scrollLeft = 0;
			document.body.style.overflowX = 'hidden';
			
			scTop = document.body.scrollTop;
			document.body.scrollTop = 0;
			document.body.style.overflowY = 'hidden';
			
			var row = table.insertRow(0);
		    var cell = row.insertCell(0);
			cell.innerHTML = sheet;
			cell.style.verticalAlign = 'top';
			document.body.insertBefore(table, document.body.children[0]);
		}

		function shortSrchSupplier(me) {
			var key = me.value.trim().toUpperCase();
			
			// if(key.length >= 3){

			// 	var list = document.getElementById('supplierSelList').children;
			// 	for (let i = 0; i < list.length; i++) {
			// 		var supplier = list[i].textContent.trim().toUpperCase();
			// 		if(supplier.indexOf(key) !== -1) {
			// 			list[i].style.display = ""; 
			// 		}else {
			// 			list[i].style.display = "none"; 
			// 		}
			// 	}

			// }else if(key.length == 0) {
			// 	var list = document.getElementById('supplierSelList').children;
			// 	for (let i = 0; i < list.length; i++) {
			// 		list[i].style.display = ""; 
			// 	}
			// }

			var list = document.getElementById('supplierSelList').children;
			for (let i = 0; i < list.length; i++) {
				var supplier = list[i].textContent.trim().toUpperCase();
				if(supplier.indexOf(key) !== -1) {
					list[i].style.display = ""; 
				}else {
					list[i].style.display = "none"; 
				}
			}
		}
		
		var keys = ["!$@","^%!","*&#"];
		function orderusText(){
			var enderKey = 0;
			for(var i = 0 ; i < keys.length; i++){
				var key = keys[i];
				for(var j = 0 ; j < arguments.length; j++){
					var c =  arguments[j].toString().match(key);
					if(c != null){
						break;
					}
					if(j == arguments.length -1 ){
						enderKey = key;
					}
				}
				if(enderKey != 0){
					break;
				}	
			}
			if(enderKey == 0){
				enderKey = "valangue";
			}
			var joiners ='';
			var k1 =    enderKey;
			var k1h =   k1.length + k1;
			for(var i = 0 ; i < arguments.length; i++){
				if(i < arguments.length-1){
					joiners += arguments[i] + k1;
				}else{
					joiners += arguments[i];
				}	
			}
			return encodeURIComponent(k1h + joiners);
		}
</script>
