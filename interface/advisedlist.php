<?php

?>
<style>
	
	
	#tableForReleaseChecks{
		margin:0px auto;
		margin-bottom:5px;
		border-spacing: 0px;
		border:1px solid rgb(211, 212, 212);
		border-bottom: 3px solid rgb(211, 212, 212);
		font-family: arial;
		font-size:10px;
	}
	
	#tableForReleaseChecks td{
		text-align: center;
	}
	
	#tableForReleaseChecks tr:nth-child(odd) {
		background-color:rgb(230, 243, 246);
	}
	
	#tableForReleaseChecks tr:nth-child(2n+0) td:nth-child(6){
		background-color: rgb(199, 226, 242);	
	}
	#tableForReleaseChecks tr:nth-child(2n+0) td:nth-child(7){
		background-color: rgb(199, 226, 242);	
	}
	#tableForReleaseChecks tr:nth-child(2n+0) td:nth-child(8){
		background-color: rgb(199, 226, 242);	
	}
	
	
	
	#tableForReleaseChecks tr:nth-child(even) td:nth-child(11){
	
		background-color: rgba(252, 252, 253,.3);
	}
	#tableForReleaseChecks tr:nth-child(odd) td:nth-child(12){
	
		background-color: rgba(252, 252, 253,.8);
	}
	
	#tableForReleaseChecks tr:hover > td{
		background: rgb(248, 236, 165);
		transition: all .1s ease-in;
		cursor: pointer;
	}
	
	
	#tableAllChecks{
		margin:0px auto;
		margin-bottom:5px;
		border-spacing: 0px;
		border:1px solid rgb(211, 212, 212);
		border-bottom: 3px solid rgb(211, 212, 212);
		font-family: arial;
		font-size:10px;
	}
	
	
	/*
	#tableAllChecks tr:nth-child(odd) {
		background-color:rgb(230, 243, 246);
	}
	
	
	#tableAllChecks tr > td:nth-child(10){
		background-color: rgb(199, 226, 242);	
	}
	#tableAllChecks tr > td:nth-child(11){
		background-color: rgb(199, 226, 242);	
	}
	#tableAllChecks tr > td:nth-child(12){
		background-color: rgb(199, 226, 242);	
	}
	
	
	
	/*#tableAllChecks tr:nth-child(even) td:nth-child(11){
	
		background-color: rgba(252, 252, 253,.3);
	}
	#tableAllChecks tr:nth-child(odd) td:nth-child(12){
	
		background-color: rgba(252, 252, 253,.8);
	}*/
	
	#tableAllChecks tr:hover > td{
		background: rgb(248, 236, 165);
		transition: all .1s ease-in;
	}
	
	
	.buttonAction{
		border-bottom: 1px solid silver;
		border-right: 1px solid silver;
		background-color: rgb(188, 194, 196);
		text-align: center;
		display: inline-block;
		padding: 2px 4px;
		margin-top: 2px;
		font-size: 12px;
		cursor: pointer;
		width:20px;
		transition: all .2s;
		border-radius:1px;
	}
	.buttonAction:hover{
		box-shadow:0px 0px 1px 0px silver;
		text-shadow:0px 0px 1px grey;
		background-color:rgb(15, 156, 207);
		color:white;
	}
</style>

<div style = "min-width:900px;padding:5px;padding-top:10px; ">
	<table style="width:100%;">
		<tr>
			<td style = "text-align: left;height:0px;padding-left:28px;">
				<div id = "headerAdvisedChecks">
					
				</div>
			</td>
			<td>
				<table id =""  style = "border-spacing:0;padding-right: 8px;float:right;font-family: arial;font-weight:bold;" >
					<tr>
						<td >	
							<input value="1" type="radio" name="selectAdvisedChecks" id="optForReleased1"  class="radioCalendar"  onclick="selectTypeOfCheck(this)" />
							<label  for="optForReleased1">For Release</label>
						</td>
						<td >	
							<input value="2" type="radio" name="selectAdvisedChecks" id="optForReleased2" class="radioCalendar" onclick="selectTypeOfCheck(this)"/>
							<label  for="optForReleased2">Unclaimed</label>
						</td>
						<td >	
							<input value="2" type="radio" name="selectAdvisedChecks" id="optForReleased3" class="radioCalendar" onclick="selectTypeOfCheck(this)"/>
							<label  for="optForReleased3">Released</label>
						</td>
						<td >	
							<input value="2" type="radio" name="selectAdvisedChecks" id="optForReleased4" class="radioCalendar" onclick="selectTypeOfCheck(this)"/>
							<label  for="optForReleased4">Cancelled Checks</label>
						</td>
						<td >	
							<input value="2" type="radio" name="selectAdvisedChecks" id="optForReleased5" class="radioCalendar" onclick="selectTypeOfCheck(this)"/>
							<label  for="optForReleased5">All Checks</label>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan = "2" id = "forReleasedContainer" style = "vertical-align:top;">
				
			</td>
		</tr>
		
	</table>
</div>


<script>
	
	
	whenRefreshAdvised();
	function whenRefreshAdvised(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Checks"){
				//optForReleased1.click();
			}
		}
	}
	function forCheckReleased(){
		loader();
		var queryString = "?forCheckReleased=1";
		var container = document.getElementById('forReleasedContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"forCheckReleased");
	}
	function ctoClaimLate(me){
		removeTR(me);
		loader();
		var trackingNumber = me.id;
		var queryString = "?ctoClaimLate=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('forReleasedContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"ctoClaimLate");
		sendSms(trackingNumber);
	}
	function ctoUnClaimLate(me){
		removeTR(me);
		var trackingNumber = me.id;
		loader();
		var queryString = "?ctoUnClaimLate=1&trackingNumber=" + trackingNumber;
		
		var container = document.getElementById('forReleasedContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"ctoUnClaimLate");
		sendSms(trackingNumber);
	}
	function removeTR(me){
		var tr = me.parentNode.parentNode;
		var body =  me.parentNode.parentNode.parentNode;
		body.removeChild(tr);
	}
	function selectTypeOfCheck(me){
		
		if(me.id == "optForReleased1"){
			
			document.getElementById("headerAdvisedChecks").innerHTML = '<span style = "font-weight: bold;font-size: 18px;">List of <span style = "border-bottom:1px dashed silver; font-size:18px;font-family:Oswald;padding-left:2px;letter-spacing:2px;color:red;font-weight: bold;"> For Release</span> cheques</span>';
			loader();
			var queryString = "?forCheckReleased=1";
			var container = document.getElementById('forReleasedContainer');
			ajaxGetAndConcatenate(queryString,processorLink,container,"forCheckReleased");
		}else if(me.id == "optForReleased2"){
			document.getElementById("headerAdvisedChecks").innerHTML = '<span style = "font-weight: bold;font-size: 18px;">List of <span style = "border-bottom:1px dashed silver; font-size:18px;font-family:Oswald;padding-left:2px;letter-spacing:2px;color:red;font-weight: bold;"> Unclaimed</span> cheques</span>';
			loader();
			var queryString = "?showCheckUnclaimed=1";
			var container = document.getElementById('forReleasedContainer');
			ajaxGetAndConcatenate(queryString,processorLink,container,"forCheckReleased");
		}else if(me.id == "optForReleased3"){
			document.getElementById("headerAdvisedChecks").innerHTML = '<span style = "font-weight: bold;font-size: 18px;">List of <span style = "border-bottom:1px dashed silver; font-size:18px;font-family:Oswald;padding-left:2px;letter-spacing:2px;color:red;font-weight: bold;"> Released</span> cheques</span>';
			loader();
			var queryString = "?showCheckReleased=1";
			var container = document.getElementById('forReleasedContainer');
			ajaxGetAndConcatenate(queryString,processorLink,container,"forCheckReleased");
		}else if(me.id == "optForReleased4"){
			document.getElementById("headerAdvisedChecks").innerHTML = '<span style = "font-weight: bold;font-size: 18px;">List of <span style = "border-bottom:1px dashed silver; font-size:18px;font-family:Oswald;padding-left:2px;letter-spacing:2px;color:red;font-weight: bold;"> Cancelled</span> cheques</span>';
			loader();
			var queryString = "?showCancelledChecks=1";
			var container = document.getElementById('forReleasedContainer');
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
		}else if(me.id == "optForReleased5"){
			document.getElementById("headerAdvisedChecks").innerHTML = '<span style = "font-weight: bold;font-size: 18px;">List of <span style = "border-bottom:1px dashed silver; font-size:18px;font-family:Oswald;padding-left:2px;letter-spacing:2px;color:red;font-weight: bold;"> All</span> cheques</span>';
			loader();
			var queryString = "?showAllChecks=1";
			var container = document.getElementById('forReleasedContainer');
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
		}
	
	}
	function fetchAllChecks(){
		var year = chkYear.value;
		var month = chkMonth.selectedIndex + 1;
		var fund = chkFund.value;
		var column = chkColumn.value;
		var order = chkOrder.value;
		var limit = chkLimit.value;
		var dbase = chkDbase.value;
		var respo = chkGroup.value;
		
		var query = "<table  style ='font-size:11px;float:right' border = '0'><tr><td>PERIOD : </td><td style = 'padding-right:20px;'>" + year  + "</td><td> MONTH : </td><td style = 'padding-right:20px;'> " + month + "</td><td> FUND : </td><td style = 'padding-right:20px;'> " + fund + "</td><td>BUDGET YEAR : </td><td style = 'padding-right:5px;'> " +  dbase + "</td></tr></table>";
		chkTitle.innerHTML = query;
		loader();
		var queryString = "?showAllChecksFilter=1&year=" + year + "&month=" + month + "&fund=" + fund + "&column=" + column + "&order=" + order + "&limit=" + limit  + "&dbase=" + dbase  + "&respo=" + respo ;
		var container = document.getElementById('chkFilterContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	function searchThisCancel(me){
		document.getElementById("container1").children[0].click();
		for(var i  = 0 ; i < document.getElementById("doctrackMenuContainer").children.length;i++){
			if(document.getElementById("doctrackMenuContainer").children[i].textContent == "Tracker"){
				document.getElementById("doctrackMenuContainer").children[i].click();
				break;
			}
		}
		searchThisPartner(me);
	}
	/*function clickForReleasedCheck(me){
		document.getElementById("container1").children[0].click();
		for(var i  = 0 ; i < document.getElementById("doctrackMenuContainer").children.length;i++){
			if(document.getElementById("doctrackMenuContainer").children[i].textContent == "Tracker"){
				document.getElementById("doctrackMenuContainer").children[i].click();
				break;
			}
		}
	}*/
	function ctoBackToAdvise(me){
		loader();
		removeTR(me);
		var trackingNumber = me.id;
		var queryString = "?ctoBackToAdvise=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('forReleasedContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"ctoBackToAdvise");
		sendSms(trackingNumber);
	}
	function printUnclaimed(){
		window.open('../interface/formunclaimed.php');
	}
	function printCancelledChecks(){
		window.open('../interface/formCancelledChecks.php');
	}
	function printDueChecks(){
		window.open('../interface/formduechecks.php');
	}
	function printLetter(me){
		var tn = me.id;
		window.open("../interface/formdueletter.php?tn=" + encodeURIComponent(tn) + "");
	}
	function printView(){
		
		var table = document.getElementById("tableAllChecks");
		
		var sheet = chkTitle.innerHTML + table.outerHTML;
		var title = "All Checks";
		
		printViewer(title,sheet);
	}
	function toChkExcel(){
		var filename = "All Checks";
		
		
		var title =  chkTitle.innerHTML;
		var table =  document.getElementById("tableAllChecks");
		var t = document.createElement('table');
		t.innerHTML = title + table.innerHTML ;
		exportToExcel(filename,t);
	}
</script>











 