<style>
	
	.crossHover:hover{
		text-shadow: 0px 0px 2px orange;
		cursor: pointer;
	}
	.exit{
		color:grey;
		cursor:pointer;
		font-family: Oswald;
		font-size:22px;
		font-weight: bold; 
		padding-left:5px;
	}
	.exit:hover{
		color:orange;
	}
	#tableStatuses input:checked label{
		font-weight: bold;
	}
	input.chk:checked ~ label {
		color:rgb(23, 144, 204);
		font-weight: bold;
	}
	input.chk ~ label {
		padding-left:5px;
	}
	.number1{
		display: inline-block;
		color:black;
		width:30px;
		height:30px;
		text-align: center;
		border-radius: 20px;
		background-color: white;
		font-size: 20px;
		
	}
</style>
	<table  style = "width:850px; padding-bottom: 2px;margin:20px;">
		<tr>
			<td style = "vertical-align:top;">
				<div id = "" style = "">
					<table style = "width:100%;border-spacing:0;margin-top:20px;" border = "0">
						<tr>
							<td class = "tdLabel" style = "text-align:left;font-size: 20px;background-color:rgb(28, 95, 137);color:white;padding:8px 10px;" >
							   <span class = "number1">1</span>Notify me when my transaction reaches these selected statuses below. </td>
						</tr>
						<tr>
							<td class = "tdLabel">
							
								<table id = "tableStatuses" border = "0" style="margin-top: 15px;">
									<tr>
										<td style="padding-left:20px;">Voucher</td>
										<td style="padding-left:20px;">PR</td>
										<td style="padding-left:20px;">PO/Voucher</td>
									</tr>
									<tr>
										<td style = "vertical-align: top;height:20px;">
											<table id = "tableStatuses1" style ="border:1px solid silver;padding:10px; padding-top:2px;text-align:left;font-size:16px;width:260px;">
												<tr><td><input class = "chk" type = "checkbox" id ="notIncluded" onclick="selectAllNot(this)"/><label for ="s0" style = "color:black;">All</label></td></tr>
												<tr><td><input class = "chk" type = "checkbox" id =""/><label for ="">CBO Received</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending at CBO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending Released - CBO</label></td></tr>
												<tr><td><input class = "chk" type = "checkbox" id =""/><label for ="">CBO Released</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">CAO Received</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending at CAO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending Released - CAO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Check Preparation - CTO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Forwarded to Admin</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Check Advised</label></td></tr>
											</table>
										</td>
										<td style = "vertical-align: top;">
											<table id = "tableStatuses2" style ="border:1px solid silver;padding:10px; padding-top:2px;text-align:left;font-size:16px;width:260px;height:296px;">
												<tr><td><input class = "chk" type = "checkbox" id ="notIncluded" onclick="selectAllNot(this)"/><label for ="s0" style = "color:black;">All</label></td></tr>
												<tr><td><input class = "chk" type = "checkbox" id =""/><label for ="">CBO Received</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending at CBO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending Released - CBO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">GSO Received</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending at GSO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending Released - GSO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">GSO Released</label></td></tr>
												<tr><td colspan="2" style="height: 100%;"></td></tr>
											</table>
										</td>
										<td rowspan="35" style="padding-left:5px;">
											<table id = "tableStatuses3" style ="border:1px solid silver;padding:10px; padding-top:2px;text-align:left;font-size:16px;width:300px;">
												<tr><td><input class = "chk" type = "checkbox" id ="notIncluded" onclick="selectAllNot(this)"/><label for ="s0" style = "color:black;">All</label></td></tr>
												<tr><td><input class = "chk" type = "checkbox" id =""/><label for ="">GSO Received</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending at GSO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending Released - GSO</label></td></tr>
												
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Forwarded to CMO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">CMO Approved</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Served to Supplier</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Supplier Conformed</label></td></tr>
												
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Fund Control</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending at CBO</label></td></tr>
												
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending Released - CBO</label></td></tr>
												
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Waiting for Delivery</label></td></tr>
												
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">For Inspection</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Inspected</label></td></tr>
												
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending at GSO - Inspection</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending Released - Inspection</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Inventory</label></td></tr>
												
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending at GSO - Inventory</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending Released - Inventory</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">CAO Received</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending at CAO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Pending Released - CAO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Check Preparation - CTO</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Forwarded to Admin</label></td></tr>
												<tr><td><input class = "chk"  type = "checkbox" id =""/><label for ="">Check Advised</label></td></tr>
												
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="vertical-align: top;padding-top:8px;height:20px;">
											<table border ="0" style="width:100%;">
												<tr>
													<td class = "tdLabel" style = "text-align:left;font-size: 20px;background-color:rgb(28, 95, 137);color:white;padding:8px 10px;" >
														<span class = "number1">2</span>Send me updates through this number.
													</td>
												</tr>
												<tr>
													<td class = "tdLabel" style = "text-align:center;font-size: 22px;padding-top:25px;" >
														<input id  = "myNumber" onkeydown="return isValueNumber(this,event)" maxlength="11" value = "" style="border-radius:2px;border:1px solid silver; font-family:Oswald; font-weight:bold; padding:2px;font-size:22px;letter-spacing:2px;text-align: center;" type ="text"/>
														<span  style = "font-size:26px;letter-spacing:1px;font-weight:bold;position: absolute; color:rgb(23, 144, 204);display: inline-block;margin-top:-4px;margin-left:5px;" class = "crossHover" onclick ="addNumber()"  >&#10010;</span>
													</td>
												</tr>
												<tr>
													<td class = "tdLabel" style = "text-align:center;font-size: 22px;padding-top:10px;" >
														<div id  = "numbersContainer" style = "width:200px;margin:0 auto;margin-bottom: 20px;">
															
														</div>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2" style="height:10px;">
											<table style="width:100%;">
												<tr>
													<td colspan="2" class = "tdLabel" style = "vertical-align: top;text-align:left;font-size: 20px;background-color:rgb(28, 95, 137);color:white;padding:8px 10px; " ><span class = "number1">3</span>Save settings
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="2" class = "tdLabel" style = "text-align:right;vertical-align: top;" >
											<span style = "font-size: 14px;font-weight: bold;">Enable / Disable this service</span> <input id = "serviceControl" type ="checkbox" />
											<div style = "width: 500px;margin:0 auto;padding-top: 25px;"><div class = "button1" onclick="getStatusesAndSave()">Save</div></div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td style ="font-family: Oswald;font-size:12px;letter-spacing: 1px;">Note : <br/>This feature sends text message updates on your transaction if enabled. <br/>For now, text messaging feature is available only from Monday to Friday 8:AM to 5:00PM. You will not receive any updates beyond these schedules.
			<br/>SMS feature available only in 2019 transactions. However, you can still receive prior years statuses "Check Advice, Pending at CAO and Pending Released - CAO".  
			</td>
		</tr>	
	</table>

<script>
	whenrefreshSmS();
	function whenrefreshSmS(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "SMS"){
					getSMSsettings();
			}
		}
	}
	function getSMSsettings(){
		var queryString = "?getSMSsetup=1";
		var container = "";
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"getSMSsetup");
	}
	
	function addNumber(me){
		var number  = document.getElementById("myNumber").value;
		if(number.length != 11){
			alert("Invalid number.");
		}else{
		
			if(selectExistingNumber(number) == 0){
				var x = "<div style ='margin-left:23px;border-bottom:1px solid silver;'><span>" + number + "</span><span class = 'exit' onclick = 'removeThisNumber(this)'>&#x2716;</span></div>";
				document.getElementById("numbersContainer").innerHTML += x;
			}else{
				alert("Already in the list.");
			}
			
		}
	}
	function selectExistingNumber(number){
		var parent = document.getElementById("numbersContainer");
		var row  = parent.children.length;
		var mark = 0;
		if(row > 0 ){
			for(var i = 0 ; i < row; i++){
				var x = parent.children[i].children[0].innerHTML;
				if(x == number){
					mark =  1;
					parent.children[i].style.color = "red";
					break;
				}
			}
		}
		return mark;
	}
	function selectNumbers(){
		var parent = document.getElementById("numbersContainer");
		var row  = parent.children.length;
		var mark = 0;
		var num = '';
		
		if(row > 0){
			for(var i = 0 ; i < row; i++){
				var x = parent.children[i].children[0].innerHTML;
				num += x + ";";
			}
			num = num.substring(0,num.length-1);
		}else{
			if(document.getElementById("myNumber").value.length == 11){
				num = document.getElementById("myNumber").value;	
			}
		}
		return num;
	}
	
	
	function removeThisNumber(me){
		
		var thisDiv = me.parentNode;
		thisDiv.parentNode.removeChild(thisDiv);
	}
	
	function selectAllNot(me){
		var parent = me.parentNode.parentNode.parentNode.parentNode;
		var x = parent.getElementsByTagName("input");
		for(var i = 1; i < x.length; i++){
			if(me.checked){		
				x[i].checked = true;
			}else{
				x[i].checked = false;
			}
		}
	}
	function getStatusesAndSave(){
		var parent = document.getElementById("tableStatuses");
		var x = parent.getElementsByTagName("input");
		var statuses = '';
		var type = 0;
		for(var i = 0; i < x.length-1; i++){
			if(x[i].id != "notIncluded"){
				if(x[i].checked){
					if(i <= 10 ){
						type = 1;
					}else if(i <= 18){
						type = 2;
					}else{
						type = 3;
					}
					
					var  status = type +  x[i].parentNode.children[1].textContent;
					statuses += status + "~";
					if(status == type +"Check Preparation - CTO"){
						statuses += type + "Forwarded to CTO~" + type + "CAO Released~";
					}
					if(status == type + "Forwarded to Admin"){
						statuses += type + "Forwarded to Admin - Operation~" + type +  "Forwarded to Admin - Administration~" + type + "Forwarded to SP - Admin~";
					}
				}
			}
		}
		
		if(selectNumbers()){
			if(statuses){
				var control = document.getElementById("serviceControl").checked;
				var numbers = selectNumbers();
				var joiners = control+"!@!"+ vScram1(numbers) +"!@!"+statuses;
				
			
				var queryString = "?jkytafiwTY=1&kksduh=" + joiners;
				
				var container = "";
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"jkytafiwTY");
			}else{
				alert("Please select the status you want to be updated.");
			}
		}else{
			alert("Please input contact number.");
		}
	}
	function displaySettings(result){
		
		var arr = result.split("*");
		
		var arrNums = arr[0].split(";");
		var countNum = arrNums.length;
		if(countNum == 1){
			document.getElementById("myNumber").value = arrNums[0];
		}else{
			var x = "";
			
			for(var i = 0 ; i < countNum; i++){
				x += "<div style ='margin-left:23px;border-bottom:1px solid silver;'><span>" + arrNums[i] + "</span><span class = 'exit' onclick = 'removeThisNumber(this)'>&#x2716;</span></div>";
			}
			document.getElementById("numbersContainer").innerHTML =  x;		
		}
		
		
		
		
		
		var arrStat = arr[1].split("~");
		var parent = document.getElementById("tableStatuses");
		var label = parent.getElementsByTagName("label");
		
		for(var i = 0; i < arrStat.length; i++){
			var stat = arrStat[i];
			var type = stat.substring(0,1);
			var stat = stat.substring(1);
			
			
			for(var j = 0; j < label.length; j++){
				var lblStat = label[j].textContent;
				
				if(lblStat == stat){
				
					if(type == 1){
						
						if(j <= 10){
							var chk = label[j].parentNode.children[0];
							chk.checked = true;
						}
					}else if(type == 2){
						if(j > 9 & j <= 18){
							var chk = label[j].parentNode.children[0];
							chk.checked = true;
						}
					}else if(type == 3){
						if(j > 18){
							var chk = label[j].parentNode.children[0];
							chk.checked = true;
						}
					}	
					
				}
			}
		}
		
		
		
		
		
		var control = arr[2];
		
		if(control == "true"){
			document.getElementById("serviceControl").checked = 1;
		}else{
			document.getElementById("serviceControl").checked = 0;
		}
	}
</script>


