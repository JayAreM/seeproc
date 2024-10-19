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
		<td class="tdHeader"><div class = "divHeader1">Guide&nbsp;List</div></td>
	</tr>
	
	
	<tr>
		<td class="tdContent" style="padding:20px;padding-top:35px;" id = "tdContentList">
			<table style = "margin:0 auto;">
				<tr>
					<td style = "text-align:right;width:50%;padding-right:40px;">
						<input type="radio" name="selectType3" id="optAccount" class="radio" onclick = "loadAllAccountTitles()" />
						<label  for="optAccount">Accounts</label></td>
					<td style = "padding-left:10px;width:200px;">
						<input type="radio" name="selectType3" id="optSource" class="radio" onclick="loadAllProgram()" />
						<label  for="optSource">Programs</label></td>
					</td>
					
				</tr>
				<tr>
					<td id = "tdAllAccountCodes" style = "padding-top:15px;" colspan="2">
					    
					</td>
					
				</tr>
			</table>
			
		</td>
	</tr>
</table>
<script>
	
	//whenRefreshList();
	
	function whenRefreshList(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Appropriations"){
			var cookieText = cookieLabel(cookieAppropriationsMenu(),"appropriationMenuContainer");
			if(cookieText == "Account List"){
				
			}
		}
	}
	function loadAllProgram(){
		var queryString = "?loadAllProgram=1";
		var container = document.getElementById('tdAllAccountCodes');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadAllProgram");
	}
	function loadAllAccountTitles(){
		var queryString = "?loadAllAccountTitles=1";
		var container = document.getElementById('tdAllAccountCodes');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadAllAccountTitles");
	}
	
	function loadFirstOption(){
		document.getElementById('optAccount').checked = true;
	}
	
	
</script>