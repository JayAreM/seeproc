<style>
	.select2{
		width:152px;	
		margin-left:5px;
		font-family: arial;
		font-size: 12px;
		color:rgb(0, 97, 142);
	}
	#ppmpViewContainer1 .tdData{
		font-family: arial;
		font-size: 12px;
		color:rgb(0, 97, 142);
	}
	#ppmpViewContainer .tdHeader{
		background-color: rgb(115, 112, 106);
		border-left:1px solid rgb(175, 173, 170);
	}
	.accountCode{
		cursor: pointer;
	}
	
	.accountCode:hover{
		font-style: italic;
		font-weight: bold;
	}
	.accountNameHide{
		
		transition :all 1s ease-in;
		display: none;
	}
	.accountName{
	     transition :all 1s ease-in;
              position :absolute;
             margin-top :-25px;
             border-radius: 3px 3px 3px 0px;
             background-color: rgb(229, 74, 121);
             box-shadow: 0px 0px 5px 0px black;
             border:1px solid white;
             color:white;
             padding:3px 8px;
	}
	
	/*------------------------------*/
	
	input.radio1:empty ~ label {
		cursor: pointer;
		color:black;
	}
	input.radio1:empty ~ label:before {
		display: inline-block;
		content:"";
		background: #D1D3D4;
		background-color: rgb(221, 225, 226);
		border:1px solid grey;
		margin-top:10px;
		width:20px;
		height:20px;
		border-radius:50%;
		position:absolute;
		margin-top:-1px;
		margin-left:-30px;
		
	}
	/* toggle hover */
	input.radio1:hover:not(:checked) ~ label {
		
		color:rgb(13, 118, 147);
	}
	/* toggle on */
	input.radio1:checked ~ label:before {
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
		box-shadow: 0px 0px 9px 1px silver inset ;
		background-color:yellow;
	}
	input.radio1:hover:not(:checked) ~ label:before {
		background-color:rgb(170, 180, 183);
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
	}
	input.radio1:checked ~ label {
		font-weight: bold;
		letter-spacing: 1px;
		
	}
	.radio1 {
		visibility:hidden;
		
	}
	input.radio1 ~label{
		font-family: Oswald;
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}
	td{
		padding:2px 5px;
	}
	.hoverTRlock:hover{
		background-color: rgb(253, 247, 157);
	}
</style>
<div style = "background-color: white;width: 95%;margin:0 auto;padding:1px;box-shadow: 0px 0px 10px 1px grey;">
	<table style = "width:100%;background-color:rgb(239, 243, 221);padding:1px;">
		<tr>
			<td  style ="vertical-align:top;">
				<div id = "ppmpLockContainerFund" style = "border:1px solid silver;min-height:600px;background-color:white;">
					
				</div>
			</td>
			<td  style = "vertical-align: top;width:10px;background-colo1r:rgb(181, 144, 117);padding:25px 10px;">
				<table  style = "border:0px solid silver;border-spacing: 0;padding-bottom: 10px;" >
					
					<tr  style="background-color: rgb(233, 223, 181);">
						<td  style ="border:1px solid white;border-bottom: 0;border-top: 0;"><span style = "font-size: 14px;" class = "label15"></span></td>
					</tr>
					<tr style="background-color: rgb(233, 223, 181);">
						<td  style ="border:1px solid white;border-top: 0;border-bottom: 0;padding-bottom: 10px;" id = "ppmpViewSelectOfficeContainer">
							<table style = "margin:0 auto;width:200px;border-spacing:0;padding:10px 20px;background-color:rgb(253, 248, 242);" border = "0">
								<tr>	
									<td  style = " font-weight: bold;font-family: Oswald;font-size: 22px;padding-left:20px;border-bottom: 1px dotted grey">	
										Lock Type
									</td>
								</tr>
								<tr>	
									<td  style = "padding-left:20px;padding-top:10px; ">	
										<input value="" type="radio" name="selectTypeFundLocker" id="opt6"  class="radio1" onclick = "clickLockerFundType(this)" checked/>
										<label  for="opt6">By Fund</label>
									</td>
								</tr>
								<tr>	
									<td  style = "padding-left:20px;padding-top:10px;padding-bottom:10px; ">	
										<input value="" type="radio" name="selectTypeFundLocker" id="opt7"  class="radio1" onclick = "clickLockerFundType(this)"/>
										<label  for="opt7">By Office</label>
									</td>
								</tr>
								
							</table>
						</td>
					</tr>
					<tr style="background-color: rgb(233, 223, 181);">
						<td  style ="border:1px solid white;border-top: 0;border-bottom: 0;padding-bottom: 10px;" id = "ppmpViewSelectOfficeContainer">
							<table style = "margin:0 auto;width:200px;border-spacing:0;padding:10px 20px;" border = "0">
								<tr>	
									<td  style = " font-weight: bold;font-family: Oswald;font-size: 22px;padding-left:20px;border-bottom: 1px dotted grey">	
										Select Options
									</td>
								</tr>
								<tr>	
									<td  style = "padding-left:20px;padding-top:10px; ">	
										<input value="" type="radio" name="selectTypeFund" id="opt1a"  class="radio1" onclick = "clickLockerFund(this)" checked/>
										<label  for="opt1a">All Funds</label>
									</td>
								</tr>
								<tr>	
									<td  style = "padding-left:20px;padding-top:10px;padding-bottom:10px; ">	
										<input value="" type="radio" name="selectTypeFund" id="opt2a"  class="radio1" onclick = "clickLockerFund(this)"/>
										<label  for="opt2a">Already Locked</label>
									</td>
								</tr>
								<tr>	
									<td  style = "padding-left:20px; ">	
										<input value="" type="radio" name="selectTypeFund" id="opt3a"  class="radio1" onclick = "clickLockerFund(this)"/>
										<label  for="opt3a">Still Open</label>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr style="background-color: rgb(233, 223, 181);">
						<td  style ="border:1px solid white;border-top: 0;border-bottom: 0;padding-bottom: 10px;" id = "ppmpViewSelectOfficeContainer">
							<table style = "margin:0 auto;width:200px;border-spacing:0;padding:10px 20px;" border = "0">
								<tr>	
									<td  style = " font-weight: bold;font-family: Oswald;font-size: 22px;padding-left:20px;border-bottom: 1px dotted grey">	
										Sort by
									</td>
								</tr>
								<tr>	
									<td  style = "padding-left:20px;padding-top:10px; ">	
										<input value="" type="radio" name="selectTypeFundSort" id="opt4"  class="radio1" onclick = "clickLockerFundSort(this)" checked/>
										<label  for="opt4">Title</label>
									</td>
								</tr>
								<tr>	
									<td  style = "padding-left:20px;padding-top:10px;padding-bottom:10px; ">	
										<input value="" type="radio" name="selectTypeFundSort" id="opt5"  class="radio1" onclick = "clickLockerFundSort(this)"/>
										<label  for="opt5">Code</label>
									</td>
								</tr>
								
							</table>
						</td>
					</tr>
					
				</table>
			
			</td>
		</tr>
		
	</table>
	
</div>

<script>
	
	whenRefreshPPMPLock();
	var id = "opt1a";
	var field;
	function whenRefreshPPMPLock(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Procurement"){
			var cookieValue = readCookie("lastMain6").trim();
			var cookieText = cookieLabel(cookieValue,"ppmpMenuContainer");
			if(cookieText == "Lock"){
				field  = "Name";
				loadPPMPlockFund(1,field);
			}
		}
	}
	
	function loadPPMPlockFund(type,field){
		loader();
		var queryString = "?loadPPMPlockFund=1&type="+ type + "&field=" + field;
		var container = document.getElementById("ppmpLockContainerFund");
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadPPMPlockFund");
	}
	
	function clickLockerFund(me){
		id = me.id;
		if(id  == "opt1a"){
			loadPPMPlockFund(1,field);
		}else if(id  == "opt2a"){
			loadPPMPlockFund(2,field);
		}else if(id  == "opt3a"){
			loadPPMPlockFund(3,field);
		}
	}
	function clickLockerFundSort(me){
		var no = document.getElementById("noData");
		if(no){
			alert("No record to be sorted.");
		}else{
			id2 = me.id
			if(id2 == "opt5"){
				field = "Code";
			}else{
				field = "Name";
			}
			if(id  == "opt1a"){
				loadPPMPlockFund(1,field);
			}else if(id  == "opt2a"){
				loadPPMPlockFund(2,field);
			}else if(id  == "opt3a"){
				loadPPMPlockFund(3,field);
			}
		}
	}
	function lockThisFund(me){
		var v = 0;
		var code = me.id;
		if(me.checked == true  ){
			 me.parentNode.parentNode.style.backgroundColor = "rgb(252, 249, 172)";
			 v = 1;
		}else{
			 me.parentNode.parentNode.style.backgroundColor = "";
			 v = 0;
		}
		var queryString = "?lockThisFund=1&lock=" + v + "&code=" + code;
		var container = "";
		ajaxGetAndConcatenate(queryString,processorLink,container,"lockThisFund");
	}
	function clickLockerFundType(me){
		var id = me.id;
		document.getElementById("opt9").click();
		if(me.id == "opt7"){
			document.getElementById("lockerB").style.display = "block";
			document.getElementById("lockerA").style.display = "none";
		}else{
			document.getElementById("lockerB").style.display = "none";
			document.getElementById("lockerA").style.display = "block";
		}
	}
</script>






















