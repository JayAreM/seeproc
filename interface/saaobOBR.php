<style>
	.tableContentSAAOB{
		background-color:white;
		width:1595px;
		height:100%;
		margin:0px auto; 
		
		padding:10px;
		
	}
	.tdContent{
		background-color:rgba(6, 44, 66,.02);
		background-color:white;
		box-shadow:0px 0px 10px 1px grey;
	}
	
	
	.returnContainer{
		width:100%;
		overflow-y:auto;
	}
	
	.programCodeContainer{
		border:1px solid rgb(245, 244, 244);
		width:400px;
		height:400px;
		overflow-x:auto;
		
	}
	.rowColor:hover{
		background-color:rgb(227, 250, 194);
		cursor:pointer;
	}
	
	.tdSAAOBHeader{
		padding:2px 5px;
		text-align:center;
		background-color:rgb(216, 217, 218);
		font-size:15px;
		font-weight:bold;
		border-radius:2px 2px 0px 0px;
	}
	.tdSAAOBHeader2{
		
		padding:2px 5px;
		text-align:center;
		background-color:rgba(167, 197, 180,.5);
		font-size:15px;
		font-weight:bold;
		border-radius:2px 2px 0px 0px;
	}
	.tdSAAOBContent{
		padding:3px 0px;
		text-align:center;
		font-size:15px;
		border-radius:2px 2px 0px 0px;
		border-bottom:1px solid rgb(227, 234, 224);
		border-right:1px solid rgb(227, 234, 224);
		
	}
	.tdSAAOBContent:hover{
		background-color:rgb(227, 250, 194);
		cursor:pointer;
	}
	.selectOfficeOBR{
		width:400px;
	}
	.programTable1{
		width:600px;
		border-spacing:0;
	}
</style>

	<table class ="tableContentSAAOB" border ="0">
		<tr>
			<!--<td class="tdHeader"><div class = "divHeader2">JEVNo&nbsp;Entry</div></td>-->
		</tr>
		<tr>
			<td class="tdContent" valign="top" >
				<div style = "padding:20px;">
					<table style = "width:100%;" border ="0">
						<tr>
							<td valign="top" style = "width:50px;">
								<table style = "margin-top:20px;" border="0">
									<tr>
										<td  ><span class = "number1">1</span><span class = "label3">Office</span></td>
										
									</tr>
									
									<tr>
										<td id = "saaobOfficeTd">
											<select class="select2" style = "width:400px;" >
												<option>&nbsp;</option>
											</select>
										</td>
									</tr>
									<tr>
										<td  style="vertical-align:top;"><span class = "number1" >2</span><span class = "label3">View by</span></td>
									</tr>
									<tr>
										<td  style="vertical-align:top;text-align:center;font-weight:bold;">
											<span style = "margin-right:20px;">
												<input type="radio" name="selectType" id="t1" class="radio1" onclick="showSelectProgram(this)" />
												<label  for="t1" class = "labelOption2">Program</label>
											</span>
											
											<span>
												<input  type="radio" name="selectType" id="t2" class="radio1" onclick="showSelectProgram(this)" />
												<label  for="t2" class = "labelOption2">OBR</label>
											</span>
										</td>
									</tr>
									
									<tr id  = "trSaaobSelect1" style = "display:none;">
										<td  style="vertical-align:top;"><span class = "number1" >3</span><span class = "label3">Program</span></td>
									</tr>
									<tr id  = "trSaaobSelect2" style = "display:none;">
										<td colspan="4" >
											<div  id = "saaobOfficeContainer">
											
											</div>
											<div style = "text-align:right;padding:2px 5px;"><span id = "saaobRow" style = "font-style:italic;" class = "label2"></span></div>
										</td>
									</tr>
								</table>
							</td>
							<td valign="top" colspan="2" rowspan="6" style="padding:10px;background-color:rgb(237, 242, 244);">
									
									<table id = "tableHeaderProgram" border = "0" style = "background-color:white;padding-top:0px;border-spacing:3px;">
										<tr class = "label2" >
											<td style = "width:30px;"  class = "tdSAAOBHeader">No</td>
											<td style = "width:50px;"  class = "tdSAAOBHeader">Month</td>
											<td style = "width:60px;"  class = "tdSAAOBHeader">OBR</td>
											<td style = "width:60px;"  class = "tdSAAOBHeader">ADV</td>
											<td style = "width:350px;" class = "tdSAAOBHeader">Particulars</td>
											<td style = "width:120px;"  class = "tdSAAOBHeader">Code</td>
											<td style = "width:150px;" class = "tdSAAOBHeader">Amount</td>
											<td style = "width:150px;" class = "tdSAAOBHeader">TotalAmount</td>
										</tr>
									</table>
									
									<table id = "tableHeaderOBR" border = "0" style = "background-color:white;padding-top:0px;border-spacing:3px;display:none;">
										<tr class = "label2" >
											<td style = "width:30px;"  class = "tdSAAOBHeader">No</td>
											<td style = "width:50px;"  class = "tdSAAOBHeader">Month</td>
									
											<td style = "width:60px;"  class = "tdSAAOBHeader">OBR</td>
											<td style = "width:60px;"  class = "tdSAAOBHeader">ADV</td>
											<td style = "width:350px;" class = "tdSAAOBHeader">Particulars</td>
											<td style = "width:120px;"  class = "tdSAAOBHeader">Program</td>
											<td style = "width:150px;" class = "tdSAAOBHeader">Amount</td>
											<td style = "width:150px;" class = "tdSAAOBHeader">TotalAmount</td>
										</tr>
									</table>
									
									<div id = "returnContainerOBR" class = "returnContainer" style="background-color:white;height:510px;"></div>
									
									<div style = "text-align:right;background-color:rgb(216, 217, 218);padding:5px 10px;border-top:1px solid silver;">
									<span id = "saaobRow1" style = "font-style:italic;margin-right:30px;float:left;" class = "label2"></span>
									<span>Total : </span><span id = "saaobRowTotal" style = "font-size:18px;color:rgb(249, 22, 90);margin-right:180px;"></span></div>
									<div style = "text-align:right;padding:2px 5px;" ></div>
							</td>
						</tr>
						
							
						
					</table>
				</div>
			</td>
		</tr>
	</table>

<script>
	
	whenRefreshSAAOBOBR();
	
	function whenRefreshSAAOBOBR(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		
		if(cookieMainText == "SAAOB"){
			var cookieText = cookieLabel(cookieSAAOBMenu(),"saaobMenuContainer");
		
			if(cookieText == "OBR\'s"){
				loadOfficeChanges();
			}
		}
	}
	
	function loadOfficeChanges(){
		var classBakit = "selectOfficeOBR";
		var func = "getOfficeProgramCodeSAAOB";
		var queryString = "?LoadOfficeSAAOB=1&classBakit=" + classBakit + "&func=" + func;
		var container = document.getElementById('saaobOfficeTd');
		ajaxGetAndConcatenate(queryString,processorLink,container,"LoadOfficeSAAOB");
	}
	function getOfficeProgramCodeSAAOB(me){
		
		var classBakit = "programTable1";
		var func = "selectThis";

		var office = me.value;
		var queryString = "?LoadProgramSAAOB=1&office=" + office + "&classBakit=" + classBakit + "&func=" + func;
		var container = document.getElementById('saaobOfficeContainer');
		document.getElementById('returnContainerOBR').innerHTML = '';
		lastSelected = -1;
		loader();
		
		ajaxGetAndConcatenate(queryString,processorLink,container,"LoadProgramSAAOB");
	}
	var lastSelected = -1;
	function selectThis(me){
		if(lastSelected != me.rowIndex){
			var parent = me.parentNode.parentNode;
			if(lastSelected > -1){
				parent.children[0].children[lastSelected].style.backgroundColor = "transparent";
			}
			me.style.backgroundColor = "rgb(211, 250, 156)";
			lastSelected = me.rowIndex;
			
			var programCode = me.children[1].textContent;
			var programName = me.children[2].textContent;
			var office = document.getElementById("saaobOfficeTd").children[0].value;
			
			
			var queryString = "?LoadDisbursement=1&office=" + office + "&programCode=" + programCode;
			var container = document.getElementById('returnContainerOBR');
			loader();
			
			ajaxGetAndConcatenate(queryString,processorLink,container,"LoadDisbursement");	
		}
	}

	function showSelectProgram(me){
		
		if(me.id =="t1"){
		
			var td = document.getElementById("saaobOfficeTd").children[0].value;
			if(td != ""){
				document.getElementById("trSaaobSelect1").style.display = "block";
				document.getElementById("trSaaobSelect2").style.display = "block";
				document.getElementById("tableHeaderProgram").style.display = "block";
				document.getElementById("tableHeaderOBR").style.display = "none";
				
				document.getElementById('returnContainerOBR').innerHTML = "";
			}else{
				alert("Please select office.");
				me.checked = false;
			}
		}else{
			//obr
			
			var td = document.getElementById("saaobOfficeTd").children[0].value;
			if(td != ""){
				document.getElementById("trSaaobSelect1").style.display = "none";
				document.getElementById("trSaaobSelect2").style.display = "none";
				document.getElementById("tableHeaderProgram").style.display = "none";
				document.getElementById("tableHeaderOBR").style.display = "block";
				
				document.getElementById('returnContainerOBR').innerHTML = "";
				loadOBRData();
			}else{
				alert("Please select office.");
				me.checked = false;
			}
			
			
		}
	}
	function loadOBRData(){
		var office = document.getElementById("saaobOfficeTd").children[0].value;
		var queryString = "?FetchOfficeOBR=1&office=" + office;
		var container = document.getElementById('returnContainerOBR');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"FetchOfficeOBR");
		
	}
</script>




