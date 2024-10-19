<style>
	.tableContent{
		/*width:100%;
		width:900px;
		height:100%;
		margin:10px 0px; 
		padding-bottom:15px;*/
		
		background-color:white;
		width:850px;
		height:100%;
		margin:0px auto; 
		
		padding:0px 30px;
		padding-bottom:15px;
	}
	
	.tdContent{
		background-color:rgba(6, 44, 66,.02);
		background-color:white;
		box-shadow:0px 0px 10px 1px grey;
	}
	.menu3{
		//border:1px solid black;
		width:50px;
		height:20px;
		display:inline-block;
	}
	
	.menu3selected{
		
		padding:5px 10px;
		background-color:rgba(150, 56, 66,.7);
		cursor:pointer;
		border-right:90px solid rgba(227, 231, 232,.9);
	
		
		border-bottom:2px solid rgb(239, 244, 245);
		width:0px;
		color:black;
		
		font-weight:bold;
		background-color:rgba(8, 149, 196,.7);
		background-color:rgb(103, 141, 152);
		text-shadow:0px 0px 0px white;
	}
	
	
	.menuContainer3{
		
		padding:5px 5px;
		display:inline-block;
		width:100%;
		background-color:rgba(227, 231, 232,.3);
		
	}
	.contentContainer3{
		height:100%;
	}
	.officeContainer{
		display:block;	
	}
	.menu3fund{
		color:grey;
		font-size:14px;
		display:inline-block;
		cursor:pointer;
		padding:0px 5px;
	}
	.menu3fund:hover{
		color:black;
	}
</style>
<table class = "tableContent" >
	<tr>
		<td class="tdHeader"><div class = "divHeader1">Fund&nbsp;View</div></td>
	</tr>
	<tr>
		<td class="tdContent" valign="top">
			<div style = "padding-left:20px;padding-top:20px;padding-right:10px;padding-bottom:20px;">
				<table style = "border:0px solid silver;width:100%;" border ="0">
					<tr>
						<td>
							<div class = "officeContainer" id ="officeContainer" >
								<span class = "label3"><span class ="number">1</span>Search Office Code</span><br/>
								<!--<input class = "textbox1" type ="text" maxlength="9" onkeydown="keypressAndWhat1(this,event,searchEncodedFund)"/>-->
							</div>
							
						</td>
						
					</tr>
					<tr>
						<td colspan="2" id  = "programCodeContainer" style="">
							
						</td>
					</tr>
					<tr>
						<td colspan="2">
							
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div id = "returnContainer2" class = "returnContainer"></div>	
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<script>
	
	whenRefreshFundApproval();
	
	function whenRefreshFundApproval(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Appropriations"){
			var cookieText = cookieLabel(cookieAppropriationsMenu(),"appropriationMenuContainer");
			if(cookieText == "Approve"){
				loadOffice();
			}
		}
	}
	
	function loadEncodedFund(){
		var queryString = "?laodEncodedFund=1";
		var container = document.getElementById('returnContainer2');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadEncodedFund");
	}
	function loadOffice(){
		var queryString = "?loadOffice=1";
		var container = document.getElementById('officeContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadOffice");
	}
	
	function SelectProgramCodeByOffice(me){
		var officeCode = me.value;
		var queryString = "?selectProgramCodeByOffice=1&officeCode=" + officeCode;
		var container = document.getElementById('officeContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"selectProgramCodeByOffice");
	}
	function SelectFundsByProgramCode(me){
		var programCode = me.value.trim();
		
		var officeCode = document.getElementById('selectOfficeCodeFund').value;
		
		
		
		var queryString = "?selectFundsByProgramCode=1&officeCode= " + officeCode + "&programCode=" + programCode;
		var container = document.getElementById('returnContainer2');
		ajaxGetAndConcatenate(queryString,processorLink,container,"selectFundsByProgramCode");
	}
	function searchEncodedFund(me){
	    var officeCode = me.value;
		var queryString = "?selectFundByOffice=1&officeCode=" + officeCode;
		var container = document.getElementById('returnContainer2');
		ajaxGetAndConcatenate(queryString,processorLink,container,"selectFundByOffice");
		
	}
	function selectAllFund(me){
		var allChecked =document.getElementsByName('fundCheck');
		var selection = me.checked;
		if(selection){
			for(var i = 0; i < allChecked.length ; i++){
				allChecked[i].checked = true;
			}
		}else{
			for(var i = 0; i < allChecked.length ; i++){
				allChecked[i].checked = false;
			}
		}
	}
	function updateApproval(me){
		var value = me.checked;
		var fundId = me.id.replace("idFund",'');
		var queryString = "?updateApproval=1&fundId=" + fundId + "&value=" + value;
		var container = "";
		ajaxGetAndConcatenate(queryString,processorLink,container,"updateApproval");	
	}
	function getEncodedByFund2(me){
		var fund = me.textContent;
		if(fund  == "CO"){
			fund = "Capital Outlay";
		}else if(fund == "PS"){
			fund = "Personal Services";
		}else if(fund == "MOOE"){
			fund = "MOOE";
		}else if(fund == "UNCHECK"){
			fund = "UNCHECK";
		}else{
			fund = "-";
		}
		
		
		
		var officeCode  = document.getElementById('selectOfficeCodeFund').value;
		//var programCode  = document.getElementById('selectProgramCode2').value;
		if(document.getElementById('selectProgramCode2')){
			var programCode  = document.getElementById('selectProgramCode2').value;
		}else{
			programCode = 1;
		}
		
		
		var queryString = "?getEncodedByFund2=1&fund=" + fund + "&officeCode=" + officeCode + "&programCode=" + programCode;
		var container = document.getElementById('returnContainer2');
		
		ajaxGetAndConcatenate(queryString,processorLink,container,"getEncodedByFund2");
	
		

	}	
</script>