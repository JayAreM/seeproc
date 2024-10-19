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

<div style="width:850px; min-width:850px; margin:0px auto; padding:20px 20px; background-color:white; margin-bottom:20px;">
	<div style="background-color:rgb(112, 99, 77); text-align:center; box-shadow:0px 0px 10px 1px grey;">
		<div class="divHeader1" style="white-space:nowrap; color:white;">New Account Entry</div>
	</div>
	<table border="0" cellpadding="0" style="width:100%; border-collapse:collapse; box-shadow:0px 0px 10px 1px grey; height:100%;">
		<tr>
			<td style="width:0px; padding:20px 20px; vertical-align:top; border-bottom:1px solid silver; height:1px;">
				<table border="0" cellpadding="0" style="border-collapse:collapse; width:100%;">
					<tr>
						<td colspan="2" style="text-align:right; padding:0px 0px 10px 0px;">
							<span class="label11" style="padding:0;">For additional account title - <span class="label8" onclick="loadAllAccountTitles()">view</span></span>
						</td>
					</tr>
					<tr>
						<td style="white-space:nowrap; padding:0px; text-align:right; font-size:14px; padding:5px 5px 0px 5px;">Fund</td>
						<td style="width:0px; padding:5px 0px 0px 0px;">
							<select id="addFund" class="select2" style="width:200px; margin:0px;">
								<option></option>
								<option>MOOE</option>
								<option>Capital Outlay</option>
								<option>Personal Services</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="white-space:nowrap; padding:0px; text-align:right; font-size:14px; padding:5px 5px 0px 5px;">Code</td>
						<td style="width:0px; padding:5px 0px 0px 0px;">
							<input id="addAccountCode" class="text1" style="width:200px;" onkeydown="keypressAndWhat(this,event,moveTo)" />
						</td>
					</tr>
					<tr>
						<td style="white-space:nowrap; padding:0px; text-align:right; font-size:14px; padding:12px 5px 0px 5px; vertical-align:top;">Title</td>
						<td style="width:0px; padding:5px 0px 0px 0px;">
							<textarea id="addAccountTitle" class="textarea1" style="width:200px; min-height:150px; resize:vertical;"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td style="padding:0px; padding-top:20px;">
							<div class="button1" onclick="addNewAccount()">Save</div>
						</td>
					</tr>
				</table>
			</td>
			<td rowspan="2" id="tdAllFunds" style="border-left:1px solid silver; padding:20px 20px;"></td>
		</tr>
		<tr>
			<td style="width:0px; padding:20px 20px; vertical-align:top;">
				<table border="0" cellpadding="0" style="border-collapse:collapse; width:100%;">
					<tr>
						<td colspan="2" style="text-align:right; padding:0px 0px 10px 0px;">
							<span class="label11" style="padding:0;">For additional program/code - <span class="label8" style="" onclick="loadAllProgram()">view</span></span>
						</td>
					</tr>
					<tr>
						<td style="white-space:nowrap; padding:0px; text-align:right; font-size:14px; padding:5px 5px 0px 5px;">Fund</td>
						<td style="width:0px; padding:5px 0px 0px 0px;">
							<select id="addFundForProg" class="select2" style="width:200px; margin:0px;">
								<option></option>
								<option>General Fund</option>
								<option>SEF</option>
								<option>Trust Fund</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="white-space:nowrap; padding:0px; text-align:right; font-size:14px; padding:5px 5px 0px 5px;">Code</td>
						<td style="width:0px; padding:5px 0px 0px 0px;">
							<input id="addProgramCode" class="text1" style="width:200px;" onkeydown="keypressAndWhat(this,event,moveTo1)">
						</td>
					</tr>
					<tr>
						<td style="white-space:nowrap; padding:0px; text-align:right; font-size:14px; padding:5px 5px 0px 5px;">Bank Account</td>
						<td style="width:0px; padding:5px 0px 0px 0px;">
							<input id="addBankAccount" class="text1" style="width:200px;">
						</td>
					</tr>
					<tr>
						<td style="white-space:nowrap; padding:0px; text-align:right; font-size:14px; padding:12px 5px 0px 5px; vertical-align:top;">Name</td>
						<td style="width:0px; padding:5px 0px 0px 0px;">
							<textarea id="addProgramName" class="textarea1" style="width:200px; min-height:150px; resize:vertical;"></textarea>
						</td>
					</tr>
					<tr>
						<td></td>
						<td style="padding:0px; padding-top:20px;">
							<div class="button1" onclick="addNewProgram()">Save</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>

<!-- <table class = "tableContent" >
	<tr>
		<td class="tdHeader"><div class = "divHeader1">New&nbsp;Account&nbsp;Entry</div></td>
	</tr>
	<tr>
		<td class="tdContent" valign="top" id = "tdContentSettings">
			<table border = "0" >
				<tr>
					<td style = "vertical-align:top;width:310px;">
						<table style = "padding:20px;margin:0 auto;width:250px;">
							<tr>
								<td style = "padding:10px;padding-left:0px;" colspan="2"><span class = "label11" style="padding:0;">For additional account title - <span class = "label8" onclick="loadAllAccountTitles()">view</span></span></td>
							</tr>
							<tr>
								<td ><span class = "label2">Fund</span></td>
								<td>
									<select id ="addFund" class="select2" style = "width:200px;">
										<option></option>
										<option>MOOE</option>
										<option>Capital Outlay</option>
										<option>Personal Services</option>
									</select>
								</td>
								
							</tr>
							<tr>
								<td><span class = "label2">Code</span></td><td><input id = "addAccountCode" class = "text1" style = "width:200px; margin-left:5px;" onkeydown="keypressAndWhat(this,event,moveTo)"></input></td>
							</tr>
							<tr>
								<td><span class = "label2">Title</span></td><td><textarea id = "addAccountTitle" class="textarea1" style = "width:200px;resize:vertical; margin-left:5px;"></textarea></td>
							</tr>
							<tr>
								<td colspan="2" style="padding-top:15px;"><div class = "button1" onclick = "addNewAccount()">Save</div></td>
							</tr>
						</table>
						
						<hr style = "border:0;border-top:1px solid silver;"/>
						
						<table style = "padding:20px;margin:0 auto;">
							<tr>
								<td style = "padding:10px;padding-left:0px;" colspan="2"><span class = "label11" style="padding:0;">For additional program/code - <span class = "label8" style = "" onclick="loadAllProgram()">view</span></span></td>
							</tr>
							<tr>
								<td><span class = "label2">Fund</span></td>
								<td>
									<select id ="addFundForProg" class="select2" style = "width:200px;">
										<option></option>
										<option>General Fund</option>
										<option>SEF</option>
										<option>Trust Fund</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><span class = "label2">Code</span></td><td><input id = "addProgramCode" class = "text1" style = "width:200px; margin-left:5px;" onkeydown="keypressAndWhat(this,event,moveTo1)"></input></td>
							</tr>
							<tr>
								<td><span class = "label2">Name</span></td><td><textarea id = "addProgramName" class="textarea1" style = "width:200px;resize:vertical; margin-left:5px;"></textarea></td>
							</tr>
							<tr>
								<td colspan="2" style="padding-top:15px;"><div class = "button1" onclick = "addNewProgram()">Save</div></td>
							</tr>
						</table>
					</td>
					<td id = "tdAllFunds" style = "vertical-align:top;padding:20px;border-left:1px solid silver;">
						
						
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table> -->

<script>

	whenRefreshSettings();
	
	function whenRefreshSettings(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Appropriations"){
			var cookieText = cookieLabel(cookieAppropriationsMenu(),"appropriationMenuContainer");
			if(cookieText == "Settings"){
				//loadAllAccountTitles();
				//loadAllProgram();
			}
		}
	}

	function loadAllAccountTitles(){
		var queryString = "?loadAllAccountTitles=1";
		var container = document.getElementById('tdAllFunds');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadAllAccountTitles");
	}

	function loadAllProgram(){
		var queryString = "?loadAllProgram=1";
		var container = document.getElementById('tdAllFunds');
	
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadAllProgram");
	}

	function addNewAccount(){

		var code = document.getElementById("addAccountCode").value;
		var title = document.getElementById("addAccountTitle").value.trim();
		var fund = document.getElementById("addFund").value;
		if(code){
			if(title){
				if(fund.length == 0){
					fund = '-';
				}
				var queryString = "?addNewAccount=1&code=" + code + "&title=" + title + "&fund=" + fund;
				var container = document.getElementById('tdAllFunds');
				ajaxGetAndConcatenate(queryString,processorLink,container,"addNewAccount");
			}else{
				alert("Please type account title.");
			}
		}else{
			alert("Please type account code.");
		}

	}
	
	function addNewProgram(){

		var code = document.getElementById("addProgramCode").value;
		var name = encodeURIComponent(document.getElementById("addProgramName").value.trim());
		var fund = document.getElementById("addFundForProg").value;
		var bankAccount = document.getElementById("addBankAccount").value.trim();

		var err = 0;
		if(code == "") {
			err = 1;
		}
		if(name == "") {
			err = 2;
		}
		if(fund == "") {
			err = 3;
		}

		if(err == 0) {
			// var queryString = "?addNewProgram=1&code=" + code + "&name=" + name + "&fund=" + fund + "&ac=" + bankAccount;
			var joiners = code + "^(*" + name + "^(*" + fund + "^(*" + bankAccount;
			joiners = vScram(joiners);

			var queryString = "?mwyeiNyduddadP5mmrmayoiriyyg5a26=1&zr0azbrpugaagrzs0a2mga12="+encodeURIComponent(joiners);
			var container = document.getElementById('tdAllFunds');
			ajaxGetAndConcatenate(queryString,processorLink,container,"addNewProgram");
		}else {
			var msg = "";
			if(err == 1) {
				msg = "Please type program code.";
			}else if(err == 2) {
				msg = "Please type program title.";
			}else if(err == 3) {
				msg = "Please select fund.";
			}
			alert(msg);
		}

	}

	// function addNewProgram(){
	// 	var code = document.getElementById("addProgramCode").value;
	// 	var name = encodeURIComponent(document.getElementById("addProgramName").value.trim());
		
	// 	if(code){
	// 		if(name){
	// 			var queryString = "?addNewProgram=1&code=" + code + "&name=" + name;
	// 			var container = document.getElementById('tdAllFunds');
	// 			ajaxGetAndConcatenate(queryString,processorLink,container,"addNewProgram");
	// 		}else{
	// 			alert("Please type program name.");
	// 		}
	// 	}else{
	// 		alert("Please type program code.");
	// 	}
	// }

	function moveTo1(){
		focusNext("addProgramName");
	}
</script>


















