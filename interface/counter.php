
<style>
	input.radioCounter:empty ~ label {
		cursor: pointer;
		color:black;
	}
	input.radioCounter:empty ~ label:before {
		display: inline-block;
		content:"";
		background: #D1D3D4;
		background-color: rgb(221, 225, 226);
		border:1px solid grey;
		
		width:10px;
		height:10px;
		border-radius:50%;
		position:absolute;
		margin-top:5px;
		margin-left:-15px;
		
	}
	/* toggle hover */
	input.radioCounter:hover:not(:checked) ~ label {
		
		color:rgb(13, 118, 147);
	}
	/* toggle on */
	input.radioCounter:checked ~ label:before {
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
		//box-shadow: -1px -1px 9px 1px silver inset;
		//background-color:rgb(80, 198, 237);
		background-color: rgb(4, 145, 210);
		
	}
	input.radioCounter:hover:not(:checked) ~ label:before {
		background-color:rgb(170, 180, 183);
		border:1px solid rgb(64, 67, 68);
		border-top:1px solid grey;
		border-left:1px solid grey;
	}
	input.radioCounter:checked ~ label {
		font-weight: bold;
		
	}
	.radioCounter {
		visibility:hidden;
		
	}
	input.radioCounter ~label{
		
		-webkit-touch-callout: none;
		-webkit-user-select: none;
		-khtml-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		font-size: 12px;
	}
	.tableOffice{
		font-size: 13px;
		width:250px;
		border: 1px solid rgb(220, 228, 222);
	}
	.tableOffice td{
		border-bottom: 1px solid silver;
	}
	
	.tableOffice th{
		border-bottom: 1px solid silver;
		background-color: rgb(147, 155, 143);
		background-color: rgba(27, 65, 78,.8);
		color:white;
		font-size: 15px;
	}	 
	
	.tableOffice tr:last-child td {
		border-bottom: 0px;
	}
	.officeTotal{
		color:red;
		text-align: right;
		font-weight: bold;
		
		letter-spacing: 1px;
	}
	.tableOfficeCounter{
		margin:20px auto;
		margin-top:10px;
		border-spacing: 0px;
		border:1px solid rgb(211, 212, 212);
		padding:5px;
	}
	.tableOfficeCounter th:nth-child(2){
		background-color: rgb(43, 50, 56);
	}
	.tableOfficeCounter th{
		padding: 2px 10px;
		font-size: 14px;
	}
	.tableOfficeCounter td{
		font-size: 13px;
		text-align: center;
	}
	.tableOfficeCounter tr:nth-child(even) {
		background-color: rgb(237, 240, 235);
	}
	.tableOfficeCounter tr:hover {
		background: rgb(248, 236, 165);
		transition: all .1s ease-in;
	}
</style>

<div style = "min-width:900px;padding:5px;padding-top:10px;">
	<table style="width:100%;">
		<tr>
			<td style = "text-align: center;height:0px;"><span style = "font-weight: bold;font-size: 16px;">Document Tracking System </span><span style = "border-bottom:1px dashed silver; font-size:20px;font-family:Oswald;text-align: center;letter-spacing:2px;color:red;font-weight: bold;">Status Counter</span></td>
		</tr>
		<?php
			$acct = $_SESSION['accountType'];
			if($acct > 1){
		?>
			<tr>
				<td style = "padding-top:0px;text-align: right;height:1px;background-color:rgb(240, 243, 241); ">
					<table id =""  style = "border-spacing:0;margin:0 auto;padding-right: 8px;"  border ="0">
						<td width="" style = "">	
							<input value="" type="radio" name="selectCounterQuarter" id="optCounter1st"  class="radioCounter" onclick = "clickOptionCounter(this)"/>
							<label  for="optCounter1st">1st&nbsp;Qtr</label>
						</td>
						<td style = "">	
							<input value="" type="radio" name="selectCounterQuarter" id="optCounter2nd" class="radioCounter" onclick = "clickOptionCounter(this)"/>
							<label  for="optCounter2nd">2nd&nbsp;Qtr</label>
						</td>
						<td style = "">	
							<input value="" type="radio" name="selectCounterQuarter" id="optCounter3rd" class="radioCounter" onclick = "clickOptionCounter(this)"/>
							<label  for="optCounter3rd">3rd&nbsp;Qtr</label>
						</td>
						<td style = "">	
							<input value="" type="radio" name="selectCounterQuarter" id="optCounter4th" class="radioCounter" onclick = "clickOptionCounter(this)"/>
							<label  for="optCounter4th">4th&nbsp;Qtr</label>
						</td>
						<td style = "">	
							<input value="" type="radio" name="selectCounterQuarter" id="optCounterYearMinus" class="radioCounter" onclick = "clickOptionCounter(this)"/>
							<label  for="optCounterYearMinus">Year-</label>
						</td>
						<td style = "">	
							<input value="" type="radio" name="selectCounterQuarter" id="optCounterYearPlus" class="radioCounter" onclick = "clickOptionCounter(this)"/>
							<label  for="optCounterYearPlus">Year+</label>
						</td>
						<td style = "">	
							<input value="" type="radio" name="selectCounterQuarter" id="optCounterAll" class="radioCounter" onclick = "clickOptionCounter(this)"/>
							<label  for="optCounterAll">All</label>
						</td>
					</table>
				</td>
			</tr>
		<?php
			}	
		?>
		<tr>
			<td id = "counterContainer" style = "vertical-align:top;">
				
			</td>
		</tr>
		
	</table>
</div>


<script>
	whenRefreshCounter();
	function whenRefreshCounter(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Counter"){
				fetchCounter();
			}
		}
	}
	
	var month;
	function fetchCounter(){
		var type = "<?php echo $acct;  ?>";
		var d = new Date();
		var month =  d.getMonth()+1;
		if(type > 1){
			var d = new Date();
			month =  d.getMonth()+1;
			if(month < 4){
				optCounter1st.click();
			}else if(month < 7){
				optCounter2nd.click();
			}else if(month < 10){
				optCounter3rd.click();
			}else{
				optCounter4th.click();
			}
		}else{
			officeCounter();
		}
	}
	
	function clickOptionCounter(me){
		loader();
		var queryString = "?fetchCounter=1&qtr=" + me.id;
		var container = document.getElementById('counterContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchCounter");
	}
	function officeCounter(){
		
		loader();
		var queryString = "?fetchCounter=1&qtr=1&month=" + month;
		var container = document.getElementById('counterContainer');
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchCounter");
			
	}
	
</script>











 