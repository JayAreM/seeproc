<style>
	.tableContent{
		background-color:white;
		width:880px;
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
		<td class="tdHeader"><div class = "divHeader1">Fund&nbsp;Changes</div></td>
	</tr>
	<tr>
		<td class="tdContent" valign="top" id = "tdContentSettings">
			<table border = "0" >
				<tr>
					<td style = "vertical-align:top;width:310px;">
						<table style = "padding:20px;margin:0 auto;width:250px;">
							<tr>
								<td style = "padding:10px;padding-left:0px;" colspan="2"><span class = "label11" style="padding:0;">For additional account title </span></td>
							</tr>
							<tr>
								<td style = "width:60px;padding-left:20px;" ><span class = "label2">Office</span></td>
								<td id = "office_changes">
									
									<select class="select2" style = "width:283px;" >
										<option>&nbsp;</option>
										
									</select>
									
								</td>
								
							</tr>
							<tr>
								<td style = "padding-left:20px;"><span class = "label2">Type</span></td>
								<td>
									<select id ="type_changes" class="select2" style = "width:283px;color:rgb(244, 92, 110);font-weight:bold;" onchange="selectChangeType(this)">
										<option></option>
										<option>Reappropriation</option>
										<option>Reallignment</option>
										<option>Augmentation</option>
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<hr style = "border:0;border-top:1px solid silver;"/>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<table id  = "tableReallignment" border = "0"  style="display:none1; border-spacing:0; width:200px; padding:10px 2px;box-shadow:0px 0px 5px 1px silver;">
										<tr id  = "labelFrom">
											<td  colspan="3" style = "font-weight:bold; padding:20px;padding-bottom:0px;">
											<span  class = "label2" style ="display:block;background-color:rgba(246, 226, 229,.3);border-top:1px solid rgb(236, 241, 242); border-bottom:2px solid rgb(244, 92, 110);padding:5px 10px;padding-right:30px;padding-left:10px;">
											<span  class = "label1" style = "color:rgb(21, 171, 213);font-size:14px; letter-spacing:2px;">Less amount </span> From</span></td>
										</tr>
										<tr>
											<td style = "padding:20px;padding-bottom:5px;">
											<span class = "label2"><span style = "" class = "number1">1&nbsp;</span>Program&nbsp;Code</span></td>
											<td style = "padding:20px;padding-bottom:5px;padding-left:0px;" id = "programCodeFrom">
												<select  class="select2" style = "width:400px;" >
													<option></option>
												</select>
											</td>
										</tr>
										<tr>
											<td style = "padding:20px;padding-top:0px;"><span class = "label2"><span class = "number1">2&nbsp;</span>Code</span></td>
											<td style = "padding:20px;padding-top:0px;padding-left:0px;" id  = "accountCodeFrom">
												<select  class="select2" style = "width:400px;" >
													<option></option>
												</select>
											</td>	
										</tr>
										
										<tr id  = "labelTo">
											<td colspan="3" style = "font-weight:bold; padding:20px;padding-bottom:0px;">
											<span class = "label2" style ="border-top:1px solid rgb(236, 241, 242);display:block;background-color:rgba(246, 226, 229,.3);border-bottom:2px solid rgb(244, 92, 110);padding:5px 10px;padding-right:50px;padding-left:10px;">
											<span class = "label1" style = "color:rgb(21, 171, 213);font-size:14px; letter-spacing:2px;">Add amount </span>To</span>
											</td>
										</tr>
										<tr>
											<td style = "padding:20px;padding-bottom:0px;"><span class = "label2"><span class = "number1">3&nbsp;</span>Program&nbsp;Code</span></td>
											<td style = "padding:20px;padding-bottom:0px;padding-left:0px;" id = "programCodeTo">
												<select id ="" class="select2" style = "width:400px;">
													<option></option>
												</select>
											</td>
										</tr>
										<tr>
											<td style = "padding:20px;padding-top:5px;padding-bottom:0px;"><span class = "label2"><span class = "number1">4&nbsp;</span>Code</span></td>
											<td style = "padding:20px;padding-top:5px;padding-left:0px;padding-bottom:0px;" id  = "accountCodeTo">
												<select id ="" class="select2" style = "width:400px;">
													<option></option>
												</select>
											</td>	
										</tr>
										<tr>
											<td colspan="3" style = "padding:5px;padding-left:20px;padding-top:20px;font-size:10px;font-weight:bold;">
											<span class = "label1" style = "color:rgb(21, 171, 213);font-size:14px; letter-spacing:2px;">Affected Amount</span>
											</td>
										</tr>
										<tr>
											<td style = "padding-left:20px;"><span class = "label2"><span class = "number1">5&nbsp;</span>Amount</span></td>
											<td style = "padding-left:20px;padding-left:0px;"><input id = "amountChange" class = "text1" style = "width:200px;" onkeydown="return isAmount(this,event)"></input></td>	
										</tr>
										<tr>
											<td colspan="2" style="padding-top:15px;padding-bottom:10px;"><div id = "buttonReallignment" class = "button1" onclick = "applyChanges(this)">Save</div></td>
										</tr>
									</table>
								</td>
							</tr>
							
							
						</table>
						
						
					</td>
					<td id = "" style = "vertical-align:top;padding:20px;border-left:1px solid silver;">
						
						
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<script>
	whenRefreshFundChanges();
	function selectChangeType(me){
		var changeType = me.value;
		if(changeType == "Reallignment"){
			document.getElementById("tableReallignment").style.display = "table";
		}else if(changeType == "Reappropriation"){
			document.getElementById("tableReallignment").style.display = "none";
		}else if(changeType == "Augmentation"){
			document.getElementById("tableReallignment").style.display = "none";
		}
	}
	function whenRefreshFundChanges(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		
		if(cookieMainText == "Appropriations"){
			var cookieText = cookieLabel(cookieAppropriationsMenu(),"appropriationMenuContainer");
			if(cookieText == "Changes"){
				loadOfficeChanges();
			}
		}
	}
	function loadOfficeChanges(){
		var queryString = "?loadOfficeData=1";
		var container = document.getElementById('office_changes');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadOffice");
	}
	function getOfficeProgramCOde(me){
		var office = me.value;
		var container = document.getElementById("programCodeFrom");
		var queryString = "?getOfficeProgramCode=1&office=" + office;
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"getOfficeProgramCode");
	}
	function getAccountCodeByProgram(me){
		var program =  me.value;
		var office =  document.getElementById('office_changes').children[0].value;
		var queryString = "?getAcountCodeInChanges=1&program=" + program + "&office=" + office;
		
		
		var parent = me.parentNode.parentNode.parentNode;
		var row =  me.parentNode.parentNode.rowIndex;
		var label = parent.children[row-1].id;
		
		if(label == "labelFrom"){
			var container = document.getElementById('accountCodeFrom');
		}else if(label == "labelTo"){
			var container = document.getElementById('accountCodeTo');
		}
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"getAcountCodeInChanges");
	}
	
	function applyChanges(me){
		
		var id  = me.id;
		if(id == "buttonReallignment"){
			checkReallignment();
		}
	}
	function checkReallignment(){
		var office = document.getElementById('office_changes').children[0].value;
		var type = document.getElementById('type_changes').value;
		
		var programFrom = document.getElementById('programCodeFrom').children[0].value;
		var accountFrom = document.getElementById('accountCodeFrom').children[0].value;
		
		
		
		var programTo = document.getElementById('programCodeTo').children[0].value;
		var accountTo = document.getElementById('accountCodeTo').children[0].value;
		
		var amount = document.getElementById('amountChange').value;
		
		var err = 0;
		var obj = '';
		
		if(programFrom.length == 0 ){
			err = 1;
			
		}else if(programTo.length == 0 ){
			err = 1;
		}
		
		if(accountFrom.length == 0 ){
			err = 2;
		}else if(accountTo.length == 0 ){
			err = 2;
		}
		
		if(amount.length == 0 ){
			err = 3;
		}
		
		
		if(programFrom == programTo){
			err = 4;
		}
		
		alert(err);
	}
</script>


















