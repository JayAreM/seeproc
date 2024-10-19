<style>
	.tableContent{
		
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
</style>
<table class = "tableContent" >
	<tr>
		<td class="tdHeader"><div class = "divHeader1">Balances</div></td>
	</tr>
	<?php
		if($_SESSION['accountType'] == 2 && $_SESSION['officeCode'] == '1071' or $_SESSION['accountType'] >= 2 && $_SESSION['officeCode'] == '1081'){
	?>
			<tr>
				<td id = "tdSelectOfficeInStatus" style = "padding-bottom:15px;"></td>
			</tr>
	<?php
		}
	?>	
		
	<tr>
		<td class="tdContent" valign="top" id = "tdContentStatus">
			
		</td>
	</tr>
</table>
<script>
	
	whenRefreshFundStatus();
	
	function whenRefreshFundStatus(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Appropriations"){
			var cookieText = cookieLabel(cookieAppropriationsMenu(),"appropriationMenuContainer");
			if(cookieText == "Status"){
				loadApproriationStatus();
				loadOfficeInStatus();
				
			}
		}
	}
	
	
	function loadOfficeInStatus(){
		
		var queryString = "?loadOfficeInBudgetStatus=1";
		var container = document.getElementById('tdSelectOfficeInStatus');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadOfficeInBudgetStatus");
	}
	
	function loadApproriationStatus(){
		var queryString = "?loadApproriationStatus=1";
		var container = document.getElementById('tdContentStatus');
		loader();					
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadApproriationStatus");
	}
	
	function fundBreakdown(me){
		var currentRow = me.parentNode.rowIndex;
		if(me.textContent == '+'){
			var splits = me.id.split("~");
			var officeCode = splits[0];
			var program = splits[1];
			var fundName = splits[2];
			var queryString = "?fundBreakdown=1&officeCode=" + officeCode + "&program=" + program +  "&fundName=" + fundName;
			var container = me.parentNode.parentNode.children[currentRow+1].children[0];
			ajaxGetAndConcatenate(queryString,processorLink,container,"fundBreakdown");
					
			me.parentNode.parentNode.children[currentRow+1].style.backgroundColor = "rgb(216, 221, 225)";
			//me.style.backgroundColor = "rgb(216, 221, 225)";
			me.className = "label12a";
			me.innerHTML  = '-';
		}else{
			me.parentNode.parentNode.children[currentRow+1].children[0].innerHTML = '';
			me.innerHTML  = '+';
			me.parentNode.parentNode.children[currentRow+1].style.backgroundColor = "white";
			me.className = "label12";
		}	
	}
	
	function SelectOfficeInStatus(me,para){
		var officeCode = me.value;
		
		document.getElementById('maskOffice').value = officeCode;
		var searchType = "selectOffice";
		
		var queryString = "?viewBalanceByOffice=1&officeCode=" + officeCode;
		var container = document.getElementById('tdContentStatus');
		
		ajaxGetAndConcatenate(queryString,processorLink,container,"viewBalanceByOffice");
	}
	function SelectOfficeInStatus(me,para){
		
		var officeCode = me.value;
		document.getElementById('maskOffice').value = officeCode;
		
		var queryString = "?viewBalanceByOffice=1&officeCode=" + officeCode;
		var container = document.getElementById('tdContentStatus');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"viewBalanceByOffice");
	}
</script>