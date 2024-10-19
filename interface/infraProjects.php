<style>
	@font-face{
		font-family: days;
		src: url(fonts/Roboto-Light.ttf);
	}
	.labelProject{
		text-align: right;
	}
	.labelProjectNumber{
		font-weight:bold;
		margin-left:10px;
		margin-right:5px;
		
	}
	.inputProject{
		color:rgb(35, 116, 157);
		width:100%;
		padding:2px;
		font-weight: bold;
		font-family: NOR;
		
		border: 1px solid rgb(217, 225, 229);
		border-bottom:1px solid silver;
	}
	.titleproject{
		border-bottom:1px dashed black;
		font-weight: bold;
		letter-spacing:1px;
		display: inline-block;
	}
	.inputTextEmpty{
		border:1px solid pink;
	}
	#infraTableProjects tr:nth-child(odd) {
		background-color: rgb(237, 240, 235);
	}
	#infraTableProjects tr:hover td{
		background-color:rgb(252, 244, 196);
		cursor: pointer;
	}
	#infraTableProjects th{
		font-weight: normal;
		
		padding:2px 0px;
		padding-left:5px;
		padding-top:5px;
		text-align: left;
		background-color: rgb(60, 101, 126);
		color:white;
	}
	.buttonProjectEditor{
		cursor: pointer;
		text-align: center;
		height: 20px;
		width:20px;
		border-radius: 1px;
		transition: all .2s ease-in; 
	}
	.buttonProjectEditor:hover{
		cursor: pointer;
		color:red;
		text-align: center;
		text-shadow: 0px 0px 2px white;
		
		border-radius: 1px;
		font-weight: bold;
		
	}
	#infraTableProjects td:nth-child(4){
		background-color:rgba(220, 225, 225,.5);
	}
	#infraTableProjects  td:nth-child(5) {
		background-color: rgba(232, 246, 250,.4);
		padding-left:5px;
	}
	#infraTableProjects  td:nth-child(7) {
		background-color:rgba(220, 225, 225,.5);
		border-bottom:1px solid white;
		padding:0px 5px;
	}
	#infraTableProjects tr > td:nth-last-child(1):hover {
		background-color:rgb(221, 220, 220);
	}
	
	#infraTableProjects td {
		font-size: 12px;
		padding:0px 5px;
		vertical-align: top;
		border-right:1px solid white;
	}
	.remarks{
		color:rgb(234, 27, 75);
		padding:10px;
	}
	.button1Infra{
		
		padding: 5px;
		display: inline-block;
		-webkit-touch-callout: none; /* iOS Safari */
	    -webkit-user-select: none; /* Safari */
	    -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; 
	}
	
</style>

<div style = "height:100%;background-color:white;display:inline-block;padding:20px;">
	<div id  = "infraOutContainer" style = "padding:40px 10px; min-height:700px;">
		<table style="padding-top:0;width:100%;font-family: Nor;border-collapse:collapse;" border ="0" >
			<tr>
				<td style = "padding-bottom: 10px;">
					<div class  = "titleProject">
						INFRASTRUCTURE PROJECT ENTRY
					</div>
				</td>
				<td style = "width:10px;" rowspan="2"></td>
				<td style = "padding-bottom: 10px;">
					<div class  = "titleProject">
						PROJECT LIST
					</div>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top;">
					<table id = "infraEntryProjects" style="padding-top:0;width:100%;font-family: Nor;border-collapse:collapse;" border = "0">
						<tr>
							<td class ="labelProject">
								<span >Lumpsum</span><span class ="labelProjectNumber">1</span>
							</td>
							<td  style="">
								<select class = "inputProject" id = "infraProjectSelectLump" style="width:50px;" >
									
									<option>No</option>
									<option>Yes</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class ="labelProject">
								<span >Office</span><span class ="labelProjectNumber">2</span>
							</td>
							<td  style="">
								<select class = "inputProject" id = "infraProjectSelectOffice" >
								</select>
							</td>
						</tr>
						<tr><td colspan="2" style ="padding:5px;"></td></tr>
						<tr id  = "" >
							<td class ="labelProject">
								<span >Entry Type</span><span class ="labelProjectNumber">3</span>
							</td>
							<td  style="">
								<select class = "inputProject" id = "infraProjectEntryType">
									<option>Regular</option>
									<option>SB1</option>
									<option>SB2</option>
									<option>SB3</option>
									<option>SB4</option>
								</select>
							</td>
						</tr>
						<tr id  = "" >
							<td class ="labelProject">
								<span >Fund</span><span class ="labelProjectNumber">4</span>
							</td>
							<td  style="">
								<select class = "inputProject" id = "infraProjectFund">
									<option>General Fund</option>
									<option>SEF</option>
									<option>Trust Fund</option>
								</select>
							</td>
						</tr>
						<tr id  = "" >
							<td class ="labelProject">
								<span style = " white-space: nowrap; ">Fund Year</span><span class ="labelProjectNumber">5</span>
							</td>
							<td  style="">
								<select class = "inputProject" id = "infraProjectFundYear">
									<?php
										$dt = time();
										$year = date('Y', $dt);
										for($i = 0; $i < 8; $i++ ){
											$x = $year - $i;
											echo '<option>' . $x  . '</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr id  = "" >
							<td class ="labelProject">
								<span >Fund Code</span><span class ="labelProjectNumber">6</span>
							</td>
							<td  style="">
								<input class = "inputProject"  id = "infraProjectCode" onkeyup = "checkSubcode(this)" value="">
							</td>
						</tr>
						<tr id  = "trSubcode" style = "display:none;" >
							<td class ="labelProject">
								<span >Subcode</span><span class ="labelProjectNumber"></span>
							</td>
							<td>	
								<select class = "inputProject" id = "infraProjectSubcode">
									<option  value = "0"></option>	
									<option value = "1">Crime Prevention and Law Enforcement</option>	
									<option value = "2">Counter Terrorism</option>
									<option value = "3">Counter Insurgency</option>
									<option value = "4">Public Safety</option>
									<option value = "5">Emergency Crisis Management</option>
									<option value = "6">Illegal Drugs, Gambling and Other Illegal Activities</option>
								</select>
							</td>
						</tr>
						<tr>
							<td class ="labelProject" >
								<span style = " white-space: nowrap; ">Expense Account</span><span class ="labelProjectNumber">7</span>
							</td>
							<td  style="">
								<select class = "inputProject" id = "infraProjectExpense">
									<option ></option>	
									<option value = "10704010">Buildings</option>	
									<option value = "10703020">Flood Control Systems</option>
									<option value = "10703050">Power Supply System</option>
									<option value = "10704030">Hospitals and Health Centers</option>
									<option value = "10705090">Installation</option>
									<option value = "10704990">Other Structures</option>
									<option value = "50213040">Repairs and Maintenance - Buildings and Other Structures</option>
									<option value = "10703010">Road Networks</option>
									<option value = "10704020">School Buildings</option>
									<option value = "10703040">Water Supply Systems</option>
									<option value = "10702990">Land Improvements</option>
								</select>
							</td>
						</tr>
						
						<tr id  = "" style ="vertical-align: top;" >
							<td class ="labelProject">
								<span >Project Name</span><span class ="labelProjectNumber">8</span>
							</td>
							<td  style="">
								<textarea id = "infraProjectName" class = "inputProject"></textarea>
							</td>
						</tr>
						
						<tr id  = "" >
							<td class ="labelProject">
								<span >Amount</span><span class ="labelProjectNumber">9</span>
							</td>
							<td  style="">
								<input class = "inputProject" type="text"  id = "infraProjectAmount" value="" onkeydown="return isAmount(this,event)" onkeyup="return withCommas(this)">
							</td>
						</tr>
						<tr><td colspan="2" style ="padding:5px;"></td></tr>
						<tr id  = "" >
							<td class ="labelProject">
								<span >Milestone</span><span class ="labelProjectNumber">10</span>
							</td>
							<td  style="">
								<select class = "inputProject" id = "infraProjectMilestone">
									<option value = "1">Jan</option>
									<option value = "2">Feb</option>
									<option value = "3">Mar</option>
									<option value = "4">Apr</option>
									<option value = "5">May</option>
									<option value = "6">Jun</option>
									<option value = "7">Jul</option>
									<option value = "8">Aug</option>
									<option value = "9">Sep</option>
									<option value = "10">Oct</option>
									<option value = "11">Nov</option>
									<option value = "12">Dec</option>
								</select>
							</td>
						</tr>
						<tr id  = "" style = "">
							<td></td>
							<td style="padding-top: 20px;text-align: center;">
								
								<div class = "button1" style="font-size: 16px;padding:5px 10px;display:inline;margin-right:10px;" onclick = "clearNewProject()">Clear</div>
								<div id  = "buttonProjectSave" class = "button1" style="font-size: 16px;padding:5px 10px;display:inline;" onclick = "saveNewProject()">Save</div>
							</td>
						</tr>
					</table>
				</td>
				<td style = "vertical-align: top;">
					<div id = "infraProjectsContainer"></div>
				</td>
			</tr>
		</table>
				
	</div>
</div>
	

<script>
	var allow = 'infraProjectSubcode';
	function checkSubcode(me){
		var fund  = me.value.trim();
		if(fund == "1011-1"){
			trSubcode.style.display ="table-row";
			allow = '';
		}else{
			trSubcode.style.display ="none";
			allow = 'infraProjectSubcode';
			selectToIndexZero("infraProjectSubcode");
		}
	}
	function loadInfraProjectOffice(){
		var container = document.getElementById("infraProjectSelectOffice");
		if(container.children.length == 0){
			loader();
			var queryString = "?fetchOfficeInfra=1" ;
			ajaxGetAndConcatenate(queryString,processorLink,container,"fetchOfficeInfra");
		}
	}
	
	function saveNewProject(){
		var cont = document.getElementById("infraEntryProjects");
		var x = checkEmptyNew(cont, "input,select,textarea", "Please input the required information.",allow,removeInvalidInfraLabel);
		if(x == 0){
			
			var lump = infraProjectSelectLump.value;
			var office = infraProjectSelectOffice.value;
			var entry  = infraProjectEntryType.value;
			var fund  = infraProjectFund.value;
			var code  = infraProjectCode.value;;
			var expense =  infraProjectExpense.value.trim();
			var description = encodeURIComponent(infraProjectName.value.trim());
			var amount = infraProjectAmount.value.replace(/,/g,"").trim();
		
			var milestone =  infraProjectMilestone.value.trim();
			var fundYear =  infraProjectFundYear.value.trim();
			
			var subcode = infraProjectSubcode.value.trim();
			
			loader();
			var container =  document.getElementById("infraProjectsContainer");
			var queryString = "?saveNewProject=1&lump=" + lump + "&office="  + office + "&entry=" + entry + "&fund=" + fund  + "&code=" + code + "&description=" + description + "&amount=" + amount +
								 "&expense=" + expense + "&milestone=" + milestone + "&fundYear=" + fundYear + "&subcode=" + subcode ;
			
			ajaxGetAndConcatenate(queryString,processorLink,container,"saveNewProject");
			
		}
		
	}
	function removeInvalidInfraLabel(){
		remover(this,"inputProject");
	}
	function loadInfraProjects(){
		loader();
		var container = document.getElementById("infraProjectsContainer");
		var queryString = "?fetchInfraProjects=1";
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchInfraProjects");
	}
	function removeThisProject(me){
		var id = me.id;
		loader();
		var container = document.getElementById("infraProjectsContainer");
		var queryString = "?removeThisProject=1&id=" + id;
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	
	
	/*function editThisProject(me){
		var id =  me.id;
		var tr = me.parentNode.parentNode.children
		var i = 1;
		var office = tr[i++].textContent;
		var fund = tr[i++].textContent;
		var lump = tr[i++].textContent;
		var lumpName = tr[i++].textContent;
		
		var entry = tr[i++].textContent;
		var expense = tr[i++].textContent;
		var expenseName = tr[i++].textContent;
		var code = tr[i++].textContent;
		var projectName = tr[i++].textContent;
		var amount = tr[i++].textContent;
		var tn = tr[i++].textContent;
		var sched = tr[i++].id;
		
		setSelectedIndex(document.getElementById("infraProjectSelectOffice"), office);
		setSelectedIndex(document.getElementById("infraProjectFund"), fund);
		setSelectedIndex(document.getElementById("infraProjectEntryType"), entry);
		setSelectedIndex(document.getElementById("infraProjectMilestone"), sched);
		
		
		if(lump.length > 0){
			code =  lump;
		}
		infraProjectCode.value  = code;
		infraProjectExpense.value = expense;
		infraProjectName.value = projectName;
		infraProjectAmount.value = amount.replace(/,/g,"");
		
		
		buttonProjectSave.textContent = "Update";
		infraId = me.id;
	}*/
	function clearNewProject(){
		infraProjectCode.value  = '';
		infraProjectExpense.value = '';
		infraProjectName.value = '';
		infraProjectAmount.value = '';
		infraProjectSelectLump.selectedIndex = "0";
		infraProjectSelectOffice.selectedIndex = "0";
		infraProjectFund.selectedIndex = "0";
		infraProjectEntryType.selectedIndex = "0";
		infraProjectMilestone.selectedIndex = "0";
		buttonProjectSave.textContent = "Save";
	}
	
	function withCommas(me){
		var n =  me.value.replace(/,/g,"");
		me.value = numberWithCommas(n);
	}
</script>






























