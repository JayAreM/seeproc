
<style>

	#doctrackAddMainDiv{
		width:900px;
		min-height:650px;
		margin:0 auto;
	}
	#tableSelectType{
		padding:20px;
		width:100%;
	}
	
	#divNewTrackingNumber{
		display:inline-block;
		font-size:26px;
		
		font-weight:bold;
	}
	#tableContent{
		margin:0 auto;
		border-spacing:0;
	}
	.showTables{
		display:table;
		width:100%;
		
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
		box-shadow: -1px -1px 9px 1px silver inset;
		background-color:rgb(80, 198, 237);
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
		color:rgb(13, 118, 147);
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
	.hoverSupplier{
		font-family: Oswald;
		font-size: 18px;
		border: 0;
		padding: 1px 0px;
		width:450px;
	}
	.hoverSupplier:hover{
		font-weight: bold;
		background-color: rgb(196, 238, 248);
		cursor: pointer;
		
	}
	
	/* Retention */
	.tableRetVal {
		width:100%;
		text-align:left;
		margin:0 auto;
		padding:0px;
		padding-top:10px;
		background-color:rgb(247, 252, 252);
		border-spacing:0px;
	}
	.tableRetVal > tbody > tr > td {
		border-right: 1px solid lightgray;
		border-bottom: 1px solid lightgray;
	}
	.tableRetVal > tbody > tr > td:first-child {
		border-left: 1px solid lightgray;
	}

</style>

<div id = "doctrackAddMainDiv" style = "width:auto;">
	<table id = "tableSelectType" border ="0" style = "padding-bottom:0px;">
		<tr>
			<td colspan="4" style = "text-align:right;padding-right:20px">
			<span class = "data1" style = "margin-right:5px;" >Tracking number</span>
			<div id = "divNewTrackingNumber" style = "font-size:30px;" class = "data1">0000-0</div>
			</td>
		</tr>
		<tr>
			<td colspan="4" style = "padding:10px 0px;"><span class = "numb">1</span><span class = "numberField" >Select Tracking Type</span></td>
		</tr>
		<tr>	
			<td colspan="4" style = "background-color:rgb(232, 239, 239);border-bottom:1px solid rgb(219, 229, 235);">
				<table style = "margin:0 auto;width:850px;border-spacing:0;padding:10px 20px;" border = "0">
					<tr>	
						<?php
							//if($_SESSION['cbo'] == '1081' || $_SESSION['cbo'] == '112A') {
						?>
							<td  style = "">	
								<input value="" type="radio" name="selectType" id="optPR"  class="radio1" onclick = "clickThisGoToGoodsModule(this)"/>
								<label  for="optPR">PR Tracking</label>
							</td>
						<?php
							//}else {
						?>
							<!-- <td  style = "">	
								<input value="" type="radio" name="selectType" id="optPR"  class="radio1" onclick = "clickOption(this)"/>
								<label  for="optPR">PR Tracking</label>
							</td> -->
						<?php
							//}
						?>
						
						<td style = "">	
							<input value="" type="radio" name="selectType" id="optRET" class="radio1" onclick = "clickOption(this)"/>
							<label  for="optRET">Retention</label>
						</td>
						<td style = "width:190px;">	
							<input value="" type="radio" name="selectType" id="optPY" class="radio1" onclick = "clickOption(this)"/>
							<label  for="optPY">Voucher</label>
						</td>
						<!-- <td style = "display:non1e;">	
							<input value="" type="radio" name="selectType" id="optMLQ" class="radio1" onclick = "clickOption(this)"/>
							<label  for="optMLQ">Liquidation</label>
						</td> -->
						<td style = "" colspan="4">	
							<input value="" type="radio" name="selectType" id="optNLIQ" class="radio1" onclick = "clickOption(this)"/>
							<label  for="optNLIQ">Liquidation</label>
						</td>
					</tr>
					<tr>
						<?php
							//if($_SESSION['cbo'] == '1081' || $_SESSION['cbo'] == '112A') {
						?>
							<td style = "">	
								<input value="" type="radio" name="selectType" id="optPO" class="radio1" onclick = "clickThisGoToGoodsModule(this)"/>
								<label  for="optPO">P.O / Payment</label>
							</td>
						<?php
							//}else {
						?>
							<!-- <td style = "">	
								<input value="" type="radio" name="selectType" id="optPO" class="radio1" onclick = "clickOption(this)"/>
								<label  for="optPO">P.O / Payment</label>
							</td> -->
						<?php
							//}
						?>

						<td style = "">	
							<input value="" type="radio" name="selectType" id="optWGS" class="radio1" onclick = "clickOption(this)"/>
							<label  for="optWGS">Wages</label>
						</td>
						<!-- <td style = "">	
							<input value="" type="radio" name="selectType" id="optPO" class="radio1" onclick = "clickOption(this)"/>
							<label  for="optPO">P.O / Payment</label>
						</td> -->
						<?php if($_SESSION['employeeNumber'] == '024562'){?>
						<td style = "">	
							<input value="" type="radio" name="selectType" id="optRTK" class="radio1" onclick = "clickOption(this)"/>
							<label  for="optRTK">Retracking</label>
						</td>
						<?php } ?>
						<!-- <td style = "">	
							<input value="" type="radio" name="selectType" id="optINP" class="radio1" onclick = "clickOption(this)"/>
							<label  for="optINP">INFRA Payment</label>
						</td> -->
					</tr>
					<!-- <tr>
						<td style = "" colspan="4">	
							<input value="" type="radio" name="selectType" id="optInfra" class="radio1" onclick = "clickOption(this)"/>
							<label  for="optInfra">Infrastructure</label>
						</td>
					</tr> -->
				</table>	
			</td>
		</tr>
		<!--<tr>
			<td colspan="4" style="padding:5px;" ><hr style = "border:0;border-top:1px solid rgb(219, 229, 235);"/></td>
		</tr>-->
	</table>
	<!-------------------PR-->
	<table class = "hide" id = "tableDoctrackPR" style = "padding-top:0px;padding-left:20px;" border ="0">
		<tr>
			<td style = "vertical-align:top;width:130px;" colspan="3">
				<span class = "numb">2</span><span class ="numberField">Select Quarter</span>
			</td>
		</tr>
		<tr>
			<td  colspan="4" >
				<table id ="tableSelectQtr"  style = "margin:0 auto;width:620px;border-spacing:0;padding-left:39px;" border ="0">
					<td width="" style = "width:150px;">	
						<input value="" type="radio" name="selectTypeQuarter" id="opt1st"  class="radio1" onclick = "clickOptionQuarter(this)"/>
						<label  for="opt1st">1st&nbsp;Quarter</label>
					</td>
					<td style = "width:150px;">	
						<input value="" type="radio" name="selectTypeQuarter" id="opt2nd" class="radio1" onclick = "clickOptionQuarter(this)"/>
						<label  for="opt2nd">2nd&nbsp;Quarter</label>
					</td>
					<td style = "width:150px;">	
						<input value="" type="radio" name="selectTypeQuarter" id="opt3rd" class="radio1" onclick = "clickOptionQuarter(this)"/>
						<label  for="opt3rd">3rd&nbsp;Quarter</label>
					</td>
					<td style = "width:150px;">	
						<input value="" type="radio" name="selectTypeQuarter" id="opt4th" class="radio1" onclick = "clickOptionQuarter(this)"/>
						<label  for="opt4th">4th&nbsp;Quarter</label>
					</td>
				</table>
			</td>
		</tr>
		<tr  id  = "trSelectCategory"style = "display:none;">
			<td style = "vertical-align:top;width:130px;" colspan="3">
				<span class = "numb">3</span><span class ="numberField">Select Category</span>
			</td>
		</tr>
		<tr>
			<td  style="" colspan="3" >
				<div id = "divCategoryList" style = "margin-top:10px; margin-left:0 ;" >	
				</div>
			</td>
		</tr>
		
		<tr id = "trPR1" style = "display:none;">
			<td style = "" colspan="3">
				<span class = "numb">4</span><span class ="numberField">Review Content</span>
			</td>
		</tr>
		<tr>
			<td style="text-align:center;padding:5px 10px;" colspan="3" id = "tdReviewContentPR">
				
			</td>
		</tr>
		<tr id = "trPR2" style = "display:none;">
			<td style = "" colspan="3">
				<span class = "numb">5</span><span class ="numberField">Save Entry</span>
			</td>
		</tr>
		<tr id = "trPR3" style = "display:none;">
			<td colspan="3" style="text-align:center; padding-bottom:10px;">
				<div class = "button1" onclick = "saveTracking()">Save</div><br/>
			</td>
		</tr>
	</table>

	<!-------------------PO-->	
	<table id = "tableDoctrackPO" class = "hide"  style="padding-top:0;padding-left:20px;">
		<tr>
			<td style = "" colspan="3">
				<span class = "numb">2</span><span class ="numberField">Supplier Name</span>
			</td>
		</tr>
		<tr>
			<td style="text-align:center" colspan="3">
				  <!-- <input id = "supplierName" type ="text" class = "data2" onclick="clickInput(this)"/>-->
				  <input id = "supplierName" type ="text" class = "data2" onclick="selectSupplier(this)"/>
			</td>
		</tr>
		<tr>
			<td style = "" colspan="3">
				<span class = "numb">3</span><span class ="numberField">Select PR Tracking</span>
			</td>
		</tr>
		<tr>
			<td id = "prDoctrackSelect" style="text-align:center" colspan="3">
				<select class = "data2">
					<option>&nbsp;</option>
				</select>
			</td>
		</tr>
		<tr id = "trPO1" style = "display:none;">
			<td style = "" colspan="3">
				<span class = "numb">4</span><span class ="numberField">Review Content</span>
			</td>
		</tr>
		<tr id = "trPO2" style = "display:none;">
			<td style="text-align:center;padding:5px 10px;" colspan="3" id = "tdReviewContentPO">
				
			</td>
		</tr>
		<tr id = "trPO3" style = "display:none;">
			<td style = "padding:10px 0px; text-align:center;" colspan="3">
				<div class = "button1" onclick = "saveTracking()">Save</div><br/>
			</td>
		</tr>
	</table>
	
	<!-------------------PY-->	
	<table class = "hide" id = "tableDoctrackPY" style = "padding-top:0px;padding-left:20px;">
		<tr>
			<td style = "" colspan="3"><span class = "numb">2</span><span class ="numberField">Select Fund</span></td>
		</tr>
		<tr>
			<td style="text-align:center" colspan="3">
			    <select id = "selectFundPY" class = "data2 checkPY" onclick="clickInput(this)" onchange="determineFund(this)">
					<option></option>	
					<option>General Fund</option>	
					<option>Trust Fund</option>
					<option>SEF</option>
				</select>
			</td>
		</tr>
		<tr>
			<td  style = "" colspan="3">
				<span class = "numb">3</span><span class ="numberField">Document Type</span>
			</td>
		</tr>
		<tr>
			<td id = "tdDocumentType" style="text-align:center" colspan="3">
			   	 <select id = "selectDocumentPY" onclick="clickInput(this)" class = "data2 checkPY">
					<option>&nbsp;</option>	
				</select>
			</td>
		</tr>
		<tr id = "fund5">
			<td style = "" colspan="3">
				<span class = "numb">4</span><span class ="numberField">Claim Type</span>
			</td>
		</tr>
		<tr id = "fund6">
			<td style="text-align:center" colspan="3">
			    <select id = "selectClaimType" onclick="clickInput(this)" class = "data2 checkPY" >
					<option></option>	
					<option>Check</option>	
					<option>Window</option>
					<option>Others</option>
				</select>
			</td>
		</tr>
		<tr id = "fund5">
			<td style = "" colspan="3">
				<span class = "numb">5</span><span class ="numberField">Period</span>
			</td>
		</tr>
		<tr id = "">
			<td style="text-align:center" colspan="3">
			    <select id = "selectPeriodPY" onclick="clickInput(this)" class = "data2 checkPY" >
					<option></option>	
					<option>January</option>	
					<option>February</option>
					<option>March</option>	
					<option>April</option>
					<option>May</option>	
					<option>June</option>
					<option>July</option>
					<option>August</option>	
					<option>September</option>
					<option>October</option>	
					<option>November</option>
					<option>December</option>	
				</select>
			</td>
		</tr>
		<tr id = "tdAccountChargesA"  style = "display:none;">
			<td style = "" colspan="3">
				<span class = "numb">6</span><span class ="numberField">Account Charges</span>
			</td>
		</tr>
		<tr  id = "tdAccountChargesB"  style = "display:none;">
			<td style="padding:5px;text-align:center" colspan="3">
				<table style ="margin:25px auto;margin-top:10px;width: 200px;" border ="0">
					<tr>
						<td width ="200"><span class = "data1 tdHeader1">Program</span></td>
						<td width ="100"><span class = "data1 tdHeader1">Account&nbsp;Codes</span></td>
						<td width ="20"><span class = "data1 tdHeader1">Amount</span></td>
						<td width ="20"><span class ="data1">&nbsp;</span></td>	
					</tr>
					<tr>
						<td id = "tdSource1">
						    <select id = "source1" class="data2" style = "width:200px;padding:5px;">
								<option>&nbsp;</option>
							</select>
						</td>
						<td id = "tdSource2" >
						   	 <select id = "source2" class="data2" style = "width:300px;padding:5px;" >
								<option>&nbsp;</option>
							</select>
						</td>
						<td ><input onclick="clickInput(this)" id  = "source3" type ="text" style = "width:100px;text-align:center;" class = "data2" maxlength="15" onkeydown="return isAmount(this,event)"/></td>	
						<td ><span class ="button2" onclick = "addMultipleSource(this)">Add</span></td>
					</tr>
					
				</table>
				<div id = "chargesContainer1" style = "width:650px;margin:0 auto; padding:0px 20px;padding-top:10px;text-align:center;background-color:rgb(247, 252, 252);"></div>
				<div id =  "pyTotal" class = "data1" style = "width:650px;margin:0 auto;text-align:right;padding-right: 188px;font-size: 20px;color:red;padding-top:5px;font-weight: bold;"></div>
			</td>
		</tr>
		
		<tr id = "subPa" style = "display: none;">
			<td style = "" colspan="3">
				<span class = "numb" style ="font-size:22px;">&nbsp;&nbsp;&nbsp;6.1</span><span class ="numberField">Sub Program</span>
			</td>
		</tr>
		<!-- <tr id = "subPb" style ="display:none">
			<td style="text-align:center" colspan="3">
			   <select id = "subCodeSelect" class = "data2 checkPY" onclick="clickInput(this)" style = "">
				 	<option>&nbsp;</option>
				</select>
			</td>
		</tr> -->

		<tr id = "subPb" style ="display:none">
			<td style=";">
				<input id="peorSubCodePYNEW" type ="hidden"/>
				<input id="peorOfcIdPYNEW" type ="hidden"/>
				<div class = "data2 checkPY" style = "text-align: left; padding-left:10px;font-weight: bold;text-transform:uppercase; cursor:pointer; height:26px; border:0px; border-bottom:1px solid black; margin:0px auto; width:700px;"  id  = "peorCodesPYNEW"  onclick="showSubCodeSelectionEdit('PYNEW')"></div>
			</td>
		</tr>
		<tr id = "trustAmountA" > 
			<td style = "" colspan="3">
				<span class = "numb">6</span><span class ="numberField">Enter Amount</span>
			</td>
		</tr>
		<tr id = "trustAmountB">
			<td style = "text-align:center;font-weight: bold;letter-spacing: 1px;" colspan="3">
				
				 <input onclick="clickInput(this)" id  = "amountPY" type ="text" style = "text-align:left;padding-left:10px;font-weight: bold;" class = "data2" maxlength="15" onkeydown="return isAmount(this,event)"/>
			</td>
		</tr>
		
		<tr>
			<td style = "" colspan="3">
				<span class = "numb">7</span><span class ="numberField">Enter Claimant</span>
			</td>
		</tr>
		<tr>
			<td style = "text-align:center" colspan="3">
				 <input style = "text-align: left;padding-left:10px;font-weight: bold;"  id  = "claimantPY" onclick="clickInput(this)" type ="text" class = "data2 checkPY"/>
			</td>
		</tr>
		<tr>
			<td style = "padding:10px 0px; text-align:center;" colspan="3">
				<div style = "margin-top:20px;" class = "button1" onclick = "saveTracking()">Save</div><br/>
			</td>
		</tr>
	</table>
	
	<!-------------------LQ-->	
	<!-- <table id = "tableDoctrackLQ" class = "hide"  style="padding-top:0;padding-left:20px;" border = "0">
		<tr>
			<td style = "" colspan="3">
				<span class = "numb">2</span><span class ="numberField">Select Cash Advance</span>
			</td>
		</tr>
		<tr>
			<td colspan="3" id = "lqDoctrackSelect" style="text-align:center;padding-bottom:5px;" colspan="3">
				<select class = "data2">
					<option>&nbsp;</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan ="2" style = "text-align:center;text-align: right;" ><span>Tracking Number</span></td>
			<td  style = "text-align:left;width:400px;" >
				 <input disabled style = "background-color:white;color: rgb(24, 167, 219);font-size:22px; padding-right:20px;border:0;border-bottom:1px dashed silver;text-align: right;padding-left:10px;font-weight: bold;width:180px;"  id  = "cashAdvanceTN"  type ="text" class = "data2"/>
			</td>
		</tr>
		<tr>
			<td colspan ="2" style = "text-align:center;text-align: right;" ><span>Cash Advance</span></td>
			<td  style = "text-align:left;" >
				 <input style = "letter-spacing:1px; background-color:white;padding-right:20px;border:0;border-bottom:1px dashed silver;text-align: right;padding-left:10px;font-weight: bold;width:180px;"  id  = "cashAdvanceAmount" disabled type ="text" class = "data2"/>
			</td>
		</tr>
		<tr><td colspan="3"></td></tr>
		<tr>
			<td  style = "text-align:center;text-align: left;vertical-align:bottom;" >
				<span class = "numb">3</span><span class ="numberField">Enter Amount</span>
			</td>
			<td><span style = "float:right;"> Spent</span></td>
			<td  style = "text-align:left;" >
				 <input   maxlength="16" onkeydown="return isAmount(this,event)" style = "letter-spacing:1px;background-color:rgb(227, 230, 231); padding-right:20px;border:0;border-left:1px solid silver;border-top:1px solid silver;text-align: right;padding-left:10px;font-weight: bold;width:180px;"  id  = "cashSpent" onkeyup="keyUpSpent(this)"  type ="text" class = "data2"/>
			</td>
		</tr>
		<tr id ="trRefund" style = "display:none;">
			<td colspan="2"><span style = "float:right;">Refunded</span></td>
			<td  style = "text-align:left;" >
				 <input disabled style = "background-color:white;letter-spacing:1px; padding-right:20px;border:0;border-bottom:1px dashed silver;text-align: right;padding-left:10px;font-weight: bold;width:180px;"  id  = "cashAdvanceRefund" type ="text" class = "data2"/>
			</td>
		</tr>
		<tr id ="trRefOR" style = "display:none;">
			<td colspan="2"><span style = "float:right;">  O.R  Details</span></td>
			<td  style = "text-align:left;" >
				  <input id = "refundOR" maxlength="50"  style = "letter-spacing:1px;background-color:rgb(227, 230, 231); padding-right:20px;border:0;border-left:1px solid silver;border-top:1px solid silver;text-align: right;padding-left:10px;font-weight: bold;width:180px;"  type ="text" class = "data2"/>
			</td>
		</tr>
		<tr id ="trReim" style = "display:none;">
			<td colspan="2"><span style = "float:right;">  To be Reimbursed</span></td>
			<td  style = "text-align:left;" >
				 <input disabled style = "background-color:white;letter-spacing:1px; padding-right:20px;border:0;border-bottom:1px dashed silver;text-align: right;padding-left:10px;font-weight: bold;width:180px;"  id  = "cashAdvanceReimbursed" type ="text" class = "data2"/>
			</td>
		</tr>
		
		<tr>
			<td  colspan="3" style="padding-top:25px;">
				<div style = "margin-top:20px;" class = "button1" onclick = "saveTracking()">Save</div><br/>
			</td>
		</tr>
		
	</table> -->

	<!------------------RET-->
	<table id = "tableDoctrackRET" class = "hide"  style="padding-top:0;padding-left:20px;" border = "0">
		<tr>
			<td style="" colspan="3"><span class = "numb">2</span><span class ="numberField">Select Supplier</span></td>
		</tr>
		<tr>
			<td style="text-align:center" colspan="3">
			    <select id="selectRETSupplier" class = "data2 checkPY" onchange="getPOListForRetention(this)"></select>
			</td>
		</tr>
		<tr id="trNewRET1" style="display:none;">
			<td style="" colspan="3"><span class = "numb">3</span><span class ="numberField">Select PO</span></td>
		</tr>
		<tr id="trNewRET2" style="display:none;">
			<td style="text-align:center" colspan="3">
			    <div id="selectRETPOForRET"></div>
			</td>
		</tr>
		<tr id="trNewRET3" style="display:none;">
			<td style="padding-top:25px; text-align:center; padding-bottom:10px;">
				<div style = "margin-top:20px;" class = "button1" onclick = "saveNewRETENTION()">Save</div><br/>
			</td>
		</tr>
	</table>

	<!------------------WGS-->
	<table id = "tableDoctrackWGS" border="0" class = "hide"  style="padding-top:20;padding-left:20px;width:97.5%;border-spacing:0px;" border = "0">
		<tr>
			<td><span class = "numb">2</span><span class ="numberField">Document Type</span></td>
			<td style="padding-bottom:4px; padding-left:50px;">
			    <select id = "selectDocTypeWGS" class = "data2 checkPY" onclick="clickInput(this)" onchange="/*wgsUploadPlaceHolder(this)*/">
					<option></option>	
					
					<option class="wgsDocType2">ALLOWANCE - CELLCARD</option>
					<option class="wgsDocType2">ALLOWANCE - CHALK</option>
					<option class="wgsDocType2">ALLOWANCE - CLOTHING</option>
					<option class="wgsDocType2">ALLOWANCE - HAZARD</option>
					<option class="wgsDocType2">ALLOWANCE - HEALTH AND EMERGENCY</option>
					<option class="wgsDocType2">ALLOWANCE - MEALS</option>
					<option class="wgsDocType2">ALLOWANCE - RATA</option>
					<option class="wgsDocType2">ALLOWANCE - REPRESENTATION</option>
					<option class="wgsDocType2">ALLOWANCE - SPECIAL COUNSEL</option>
					<option class="wgsDocType2">ALLOWANCE - SPECIAL RISK ALLOWANCE</option>
					<option class="wgsDocType2">ALLOWANCE - SUBSISTENCE</option>
					<option class="wgsDocType2">ALLOWANCE - SUBSISTENCE AND LAUNDRY</option>
					<!-- <option class="wgsDocType2">ALLOWANCE - TRANSPORTATION</option> -->
					<option class="wgsDocType2">ALLOWANCE - TRAVEL</option>

					<option class="wgsDocType2">ASSISTANCE - FINANCIAL</option>
					
					<option class="wgsDocType2">BENEFITS - ANNIVERSARY</option>
					<option class="wgsDocType2">BENEFITS - ANNIVERSARY BONUS</option>
					<option class="wgsDocType2">BENEFITS - CLOTHING AND ANNIVERSARY BONUS</option>
					<option class="wgsDocType2">BENEFITS - CNA</option>
					<option class="wgsDocType2">BENEFITS - CNA AND PBB</option>
					<option class="wgsDocType2">BENEFITS - CNA AND PEI</option>
					<option class="wgsDocType2">BENEFITS - CNA, PEI, AND PBB</option>
					<!-- <option class="wgsDocType2">BENEFITS - ELAP</option> -->
					<option class="wgsDocType2">BENEFITS - GRATUITY PAY</option>
					<option class="wgsDocType2">BENEFITS - LOYALTY PAY</option>
					<option class="wgsDocType2">BENEFITS - MIDYEAR</option>
					<option class="wgsDocType2">BENEFITS - MIDYEAR DIFFERENTIAL</option>
					<option class="wgsDocType2">BENEFITS - MONETIZATION INCENTIVE</option>
					<option class="wgsDocType2">BENEFITS - PAHALIPAY</option>
					<option class="wgsDocType2">BENEFITS - PERFORMANCE BASED BONUS</option>
					<option class="wgsDocType2">BENEFITS - PRODUCTIVITY ENHANCEMENT INCENTIVES</option>
					<option class="wgsDocType2">BENEFITS - SERVICE RECOGNITION INCENTIVE</option>
					<option class="wgsDocType2">BENEFITS - TERMINAL LEAVE</option>
					<option class="wgsDocType2">BENEFITS - YEAR END BONUS</option>

					
					<option class="wgsDocType1">WAGES - BACK PAY</option>
					<option class="wgsDocType2">WAGES - INCIDENTAL EXPENSE</option> 
					<option class="wgsDocType2">WAGES - OVERTIME PAY (J.O)</option>
					<option class="wgsDocType2">WAGES - OVERTIME PAY (Plantilla)</option> 
					<option class="wgsDocType1">WAGES - SALARY DIFFERENTIAL</option>
					<option class="wgsDocType1">WAGES - SALARY J.O (1st half)</option>
					<option class="wgsDocType1">WAGES - SALARY J.O (2nd half)</option>
					<option class="wgsDocType1">WAGES - SALARY J.O (Whole month)</option>
					<option class="wgsDocType1">WAGES - SALARY PLANTILLA</option>
					<option class="wgsDocType2">WAGES - UNDERPAYMENT</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><span class = "numb">3</span><span class ="numberField">Select Fund</span></td>
			<td style="padding-bottom:4px; padding-left:50px;">
			    <select id = "selectFundWGS" class = "data2 checkPY" onclick="clickInput(this)" onchange="determineFund(this)">
					<option></option>	
					<option>General Fund</option>	
					<option>Trust Fund</option>
					<option>SEF</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td>
				<span class = "numb">4</span><span class ="numberField">Claim Type</span>
			</td>
			<td style="padding-bottom:4px; padding-left:50px;">
			    <select id = "selectClaimTypeWGS" onclick="clickInput(this)" class = "data2 checkPY" >
					<option></option>	
					<option>Check</option>	
					<option>Window</option>
					<option>Others</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class = "numb">5</span><span class ="numberField">Period</span>
			</td>
			<td style="padding-bottom:2px; padding-left:50px;">
			    <select id = "selectPeriodWGS" onclick="clickInput(this)" class = "data2 checkPY" >
					<option></option>	
					<option value="01">January</option>	
					<option value="02">February</option>
					<option value="03">March</option>	
					<option value="04">April</option>
					<option value="05">May</option>	
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>	
					<option value="09">September</option>
					<option value="10">October</option>	
					<option value="11">November</option>
					<option value="12">December</option>	
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class = "numb">6</span><span class ="numberField">Enter PTRS No.</span>
			</td>
			<td style="padding-bottom:0px; padding-left:50px;">
				<!-- <input style = "text-align: left;padding-left:10px;font-weight: bold;text-transform:uppercase;" value="RP-202303-66635"  id  = "sequenceNumWGS" onchange="resetDbfTable()" onclick="clickInput(this)" onkeydown="keypressAndWhatClear(this,event,searchPTRS,1)" type ="text" class = "data2 checkPY"/> -->
				<input style = "text-align: left;padding-left:10px;font-weight: bold;text-transform:uppercase;" value=""  id  = "sequenceNumWGS" onchange="resetDbfTable()" onclick="clickInput(this)" onkeydown="keypressAndWhatClear(this,event,searchPTRS,1)" type ="text" class = "data2 checkPY"/>
			</td>
		</tr>
		<tr>
			<td id="dbfTable" style="padding-top:20px; padding-right:20px;" colspan="3"></td>
		</tr>
		<!-- <tr id="peorCodeRow" style="display:none;">
			<td>
				<span class = "numb">7</span><span class ="numberField">Select Sub Code</span>
			</td>
			<td style="padding-bottom:0px; padding-left:50px;">
				<input id="peorSubCodeWGS" type ="hidden" value="0"/>
				<input id="peorOfcIdWGS" type ="hidden" value="0"/>
				<input class = "data2 checkPY" style = "text-align: left;padding-left:10px;font-weight: bold;text-transform:uppercase; cursor:pointer;"  id  = "peorCodesWGS"  onclick="showSubCodeSelectionWGS()" readonly/>
			</td>
		</tr> -->
	</table>

	<!------------------RETRACKING-->
	<table id = "tableDoctrackRTK" class = "hide"  style="margin:20px; margin-right:0px; border-spacing:0px; width:95%;" border = "0">
		<tr>
			<td>
				<span class = "numb">1</span><span class ="numberField">Office</span>
			</td>
			<td style="padding-bottom:0px; padding-left:50px;">
				<input style = "text-align: left;padding-left:10px;font-weight: bold;text-transform:uppercase;" value=""  id  = "rtkInputOffc" onclick="clickInput(this)" maxlength="4" type ="text" class = "data2 checkPY"/>
			</td>
		</tr>
		<tr>
			<td><span class = "numb">2</span><span class ="numberField">Transfer From</span></td>
			<td style="padding-bottom:4px; padding-left:50px;">
			    <select id = "rtkSelectYrSource" class = "data2 checkPY" onclick="clickInput(this)" onchange="">
					<?php
						$rtkYr = date('Y');
					?>
					<option></option>
					<option><?= $rtkYr + 1  ?></option>
					<option><?= $rtkYr ?></option>	
					<option><?= $rtkYr - 1 ?></option>	
					<option><?= $rtkYr - 2 ?></option>	
					<option><?= $rtkYr - 3 ?></option>	
					<option><?= $rtkYr - 4 ?></option>	
				</select>
			</td>
		</tr>
		<tr>
			<td><span class = "numb">3</span><span class ="numberField">Transfer To</span></td>
			<td style="padding-bottom:4px; padding-left:50px;">
			    <select id = "rtkSelectYrRecvr" class = "data2 checkPY" onclick="clickInput(this)" onchange="">
					<?php
						$rtkYr = date('Y');
					?>
					<option></option>
					<option><?= $rtkYr + 1  ?></option>
					<option><?= $rtkYr ?></option>	
					<option><?= $rtkYr - 1 ?></option>	
					<option><?= $rtkYr - 2 ?></option>	
					<option><?= $rtkYr - 3 ?></option>	
					<option><?= $rtkYr - 4 ?></option>	
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class = "numb">5</span><span class ="numberField">Enter Tracking#</span>
			</td>
			<td style="padding-bottom:0px; padding-left:50px;">
				<input style = "text-align: left;padding-left:10px;font-weight: bold;text-transform:uppercase;" value=""  id  = "rtkInputTN" onclick="clickInput(this)" type ="text" class = "data2 checkPY"/>
			</td>
		</tr>
		<tr>
			<td style = "padding:10px 0px; text-align:center;" colspan="3">
				<div style = "margin-top:20px; width:70px;" class = "button1" onclick = "transferTracking()">Transfer</div><br/>
			</td>
		</tr>
	</table>
	
	<!------------------infra-->
	<table id = "tableDoctrackInfra" class = "hide"  style="margin:20px; margin-right:0px; border-spacing:0px; width:95%;" border = "0">
		<tr>
			<td>
				<span class = "numb">1</span><span class ="numberField">Office</span>
			</td>
			<td style="padding-bottom:0px; padding-left:50px;">
				<input style = "text-align: left;padding-left:10px;font-weight: bold;text-transform:uppercase;" value=""  id  = "rtkInputOffc" onclick="clickInput(this)" maxlength="4" type ="text" class = "data2 checkPY"/>
			</td>
		</tr>
		<tr>
			<td><span class = "numb">2</span><span class ="numberField">Transfer From</span></td>
			<td style="padding-bottom:4px; padding-left:50px;">
			    <select id = "rtkSelectYrSource" class = "data2 checkPY" onclick="clickInput(this)" onchange="">
					<?php
						$rtkYr = date('Y');
					?>
					<option></option>
					<option><?= $rtkYr + 1  ?></option>
					<option><?= $rtkYr ?></option>	
					<option><?= $rtkYr - 1 ?></option>	
					<option><?= $rtkYr - 2 ?></option>	
					<option><?= $rtkYr - 3 ?></option>	
					<option><?= $rtkYr - 4 ?></option>	
				</select>
			</td>
		</tr>
		<tr>
			<td><span class = "numb">3</span><span class ="numberField">Transfer To</span></td>
			<td style="padding-bottom:4px; padding-left:50px;">
			    <select id = "rtkSelectYrRecvr" class = "data2 checkPY" onclick="clickInput(this)" onchange="">
					<?php
						$rtkYr = date('Y');
					?>
					<option></option>
					<option><?= $rtkYr + 1  ?></option>
					<option><?= $rtkYr ?></option>	
					<option><?= $rtkYr - 1 ?></option>	
					<option><?= $rtkYr - 2 ?></option>	
					<option><?= $rtkYr - 3 ?></option>	
					<option><?= $rtkYr - 4 ?></option>	
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<span class = "numb">5</span><span class ="numberField">Enter Tracking#</span>
			</td>
			<td style="padding-bottom:0px; padding-left:50px;">
				<input style = "text-align: left;padding-left:10px;font-weight: bold;text-transform:uppercase;" value=""  id  = "rtkInputTN" onclick="clickInput(this)" type ="text" class = "data2 checkPY"/>
			</td>
		</tr>
		<tr>
			<td style = "padding:10px 0px; text-align:center;" colspan="3">
				<div style = "margin-top:20px; width:70px;" class = "button1" onclick = "transferTracking()">Transfer</div><br/>
			</td>
		</tr>
	</table>

	<!-------------------MLQ-->	
	<!-- <table id = "tableDoctrackMLQ" class = "hide"  style="padding-top:0;padding-left:20px;" border = "0">
		<tr>
			<td style = "" colspan="3">
				<span class = "numb">2</span><span class ="numberField">Select Cash Advance</span>
			</td>
		</tr>
		<tr>
			<td colspan="3" id = "mlqDoctrackSelect" style="text-align:center;padding-bottom:5px;" colspan="3">
				<select class = "data2">
					<option>&nbsp;</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="3" style="padding: 16px 0px 5px 40px;">
				Claimant
				<input disabled="" style="background-color:white;color:black;font-size:22px;padding-right:20px;border:0;border-bottom:1px dashed silver;padding-left:10px;font-weight: bold;width:0px;width:400px;margin-left:8px;" id="claimantMLQ" class="data2" type="text">
			</td>
		</tr>
		<tr>
			<td colspan="3" style="padding-top: 10px;">
				<table border="0" id="caListAddedMLQ" style="margin:0px auto;" class="tableRetVal">
					<thead>
						<tr>
							<th style="border-bottom:1px solid lightgray; padding:5px 10px 0px 10px;">TN</th>
							<th style="border-bottom:1px solid lightgray; padding:5px 10px 0px 10px;">Month</th>
							<th style="border-bottom:1px solid lightgray; padding:5px 10px 0px 10px;">Claimant</th>
							<th style="border-bottom:1px solid lightgray; padding:5px 10px 0px 10px;">Cash Advance</th>
							<th style="border-bottom:1px solid lightgray; padding:5px 10px 0px 10px;">Spent</th>
							<th style="border-bottom:1px solid lightgray; padding:5px 10px 0px 10px;">Refunded</th>
							<th style="border-bottom:1px solid lightgray; padding:5px 10px 0px 10px;">O.R. Details</th>
							<th style="border-bottom:1px solid lightgray; padding:5px 10px 0px 10px;">Reimbursement</th>
							<th style="border-bottom:1px solid lightgray; padding:5px 10px 0px 10px;"></th>
						</tr>
					</thead>
					<tbody style="background-color: white;"></tbody>
				</table>				
			</td>
		</tr>
		<tr><td colspan="3" style="padding:5px 0px;"></td></tr>
		<tr>
			<td  style = "text-align:center;text-align: left;vertical-align:top;" >
				<span class = "numb">3</span><span class ="numberField">Total Amount</span>
			</td>
			<td colspan="2" style="padding-right: 50px;">
				<table border="0" style="border-spacing:0px; margin-right:0px; margin-left:auto;">
				 	<tr>
				 		<td style="text-align:right;">Cash Advance</td>
				 		<td>
				 			<input style = "letter-spacing:1px; background-color:white;padding-right:20px;border:0;border-bottom:1px dashed silver;text-align: right;padding-left:10px;font-weight: bold;width:180px;"  id  = "cashAdvanceAmountMLQ" disabled type ="text" class = "data2"/>
				 		</td>
				 	</tr>
				 	<tr>
				 		<td style="text-align:right;">Spent</td>
				 		<td>
				 			<input disabled style = "background-color:white;letter-spacing:1px; padding-right:20px;border:0;border-bottom:1px dashed silver;text-align: right;padding-left:10px;font-weight: bold;width:180px;"  id  = "cashSpentMLQ"  type ="text" class = "data2"/>
				 		</td>
				 	</tr>
				 	<tr>
				 		<td style="text-align:right;">Refunded</td>
				 		<td>
				 			<input disabled style = "background-color:white;letter-spacing:1px; padding-right:20px;border:0;border-bottom:1px dashed silver;text-align: right;padding-left:10px;font-weight: bold;width:180px;"  id  = "cashAdvanceRefundMLQ" type ="text" class = "data2"/>
				 		</td>
				 	</tr>
				 	<tr>
				 		<td style="text-align:right;">To be Reimbursed</td>
				 		<td>
				 			 <input disabled style = "background-color:white;letter-spacing:1px; padding-right:20px;border:0;border-bottom:1px dashed silver;text-align: right;padding-left:10px;font-weight: bold;width:180px;"  id  = "cashAdvanceReimbursedMLQ" type ="text" class = "data2"/>
				 		</td>
				 	</tr>
				 </table>
			</td>
		</tr>
		<tr>
			<td  colspan="3" style="padding-top:25px;">
				<div style = "margin-top:20px;" class = "button1" onclick = "saveTracking()">Save</div><br/>
			</td>
		</tr>
		
	</table> -->

	<!-------------------INP-->	
	<!-- <table id = "tableDoctrackINP" class = "hide"  style="padding-top:0;padding-left:20px;" border = "0">
		<tr>
			<td style = ""><span class = "numb">2</span><span class ="numberField">Select IN Tracking</span></td>
			<td>
				<select class = "data2" id="inSelectTracking"  onchange="fetchINTNDetails(this)">
					<option>&nbsp;</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style="padding:10px 0px;"></td>
		</tr>
		<tr>
			<td></td>
			<td id="inSelectProjDetails"></td>
		</tr>
	</table> -->

	<!-------------------NEW LIQ-->	
	<table id = "tableDoctrackNLIQ" class = "hide"  style="padding-top:0;padding:0px 20px;" border = "0">
		<tr>
			<td style = "">
				<span class = "numb">2</span><span class ="numberField">Select Cash Advance</span>
			</td>
		</tr>
		<tr>
			<td id = "nlqDoctrackSelect" style="text-align:center;padding-bottom:5px;" colspan="3">
				<select class = "data2">
					<option>&nbsp;</option>
				</select>
			</td>
		</tr>
		<tr>
			<td id="nliqContMain" style="display: none; padding-top:25px;">
				<table border="0" style="margin:0px auto; border-spacing:0px; text-align:right; font-family:Oswald;">
					<tr>
						<td style="">
							<table border="0" style="border-spacing:0px; text-align:right; font-family:Oswald; width: 100%;">
								<tr>
									<td style="font-size: 14px; letter-spacing:2px; vertical-align:bottom; padding:3px 0px; width: 50px;">TN</td>
									<td id="nliqCATN" style="text-align: left; padding: 0px 6px; font-weight:bold; font-size:22px; border-bottom:1px solid silver;"></td>
									<td style="padding:0px 5px;"></td>
									<td style="font-size: 14px; letter-spacing:2px; vertical-align:bottom; padding:3px 0px;">OBR</td>
									<td id="nliqCAOBR" style="text-align: left; padding: 0px 6px; font-weight:bold; font-size:22px; border-bottom:1px solid silver;"></td>
								</tr>
								<tr>
									<td style="font-size: 14px; letter-spacing:2px; vertical-align:bottom; padding:3px 0px;">Claimant</td>
									<td id="nliqClaimant" style="text-align: left; padding: 0px 6px; font-weight:bold; font-size:22px; border-bottom:1px solid silver;"></td>
									<td></td>
									<td style="font-size: 14px; letter-spacing:2px; vertical-align:bottom; padding:3px 0px;">ADV</td>
									<td id="nliqCAADV" style="text-align: left; padding: 0px 6px; font-weight:bold; font-size:22px; border-bottom:1px solid silver;"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr style="">
						<td id="nliqOBRDets" colspan="4" style="padding:10px 0px; padding-top: 25px;"></td>
					</tr>
					<tr>
						<td style="text-align:right; margin: auto 0px; padding-right: 5px;">
							<table border="0" style="display:inline-block; border-spacing:0px; text-align: right;">
								<tr>
									<td style="padding:0px 8px;">Cash Advance (Gross)</td>
									<td style="border-bottom:1px dashed silver;"><span id="nliqCurCAGross" class="data2" style="border:0px; width:130px; color:rgb(35, 116, 157);"></span></td>
								</tr>
								<tr>
									<td style="padding:0px 8px;">Cash Advance (Net)</td>
									<td style="border-bottom:1px dashed silver;"><span id="nliqCurCA" class="data2" style="border:0px; width:130px; color:rgb(35, 116, 157);"></span></td>
								</tr>
								<tr>
									<td style="padding:0px 8px;">Total Spent</td>
									<td style="border-bottom:1px dashed silver;"><span id="nliqCurSpent" class="data2" style="border:0px; width:130px; color: red;"></span></td>
								</tr>	
								<tr id="nliqTaxRow" style="display:none;">
									<td style="padding:0px 8px;">Tax</td>
									<td style="border-bottom:1px dashed silver;">
										<!-- <span id="nliqTax" class="data2" style="border:0px; width:130px;">0.00</span> -->
										<input id="nliqTax" style="width:130px; border:0px; background-color:transparent; font-family:Oswald; font-size:18px; font-weight:bold; text-align:right; padding-right:6px;" onkeydown="return isAmount(this,event)">
									</td>
								</tr>
								<tr>
									<td style="padding:0px 8px;">Refunded</td>
									<td style="border-bottom:1px dashed silver;"><span id="nliqCurRefund" class="data2" style="border:0px; width:130px;"></span></td>
								</tr>	
								<tr>
									<td style="padding:0px 8px;">O.R. Details/Date</td>
									<td style="border-bottom:1px dashed silver;"><input id="nliqCurORDets" class="data2" style="border:0px; width:130px;"></td>
								</tr>	
								<tr>
									<td style="padding:0px 8px;">Reimbursement</td>
									<td style="border-bottom:1px dashed silver;"><span id="nliqCurReimb" class="data2" style="border:0px; width:130px;"></span></td>
								</tr>									
							</table>
						</td>
					</tr>
				</table>				
			</td>
		</tr>
		<tr>
			<td id="nliqContSave" style="display: none; padding-top:25px; text-align:center; padding-bottom:10px;">
				<div style = "margin-top:20px;" class = "button1" onclick = "saveNLIQ()">Save</div><br/>
			</td>
		</tr>
	</table>

</div>

<script>

	// optRET.click();

	//--------------------------------------------------------------------------------------------------------------NEW RETENTION - START

	function saveNewRETENTION() {
		var table = document.getElementById('newRETTable');
		var totalRetention = document.getElementById('newRETTotal');
		var supplier = document.getElementById('selectRETSupplier').value;
		var trS = table.children[0].children;

		var newTotal = 0;
		var details = "";
		for (var i = 1; i <= (trS.length - 3); i++) {

			var chkbox = trS[i].children[0].children[0];
			var poTN = trS[i].children[1].textContent;
			var poNumber = trS[i].children[2].textContent;
			// var invNumber = trS[i].children[3].children[0].value;
			// var invDate = trS[i].children[4].children[0].value;
			var invNumber = trS[i].children[3].textContent;
			var invDate = trS[i].children[4].textContent;
			var retention =  parseFloat(trS[i].children[5].textContent.replace(/,/g,""));

			if(chkbox.checked == true) {
				details += "*j*"+poTN+'~j~'+poNumber+'~j~'+invNumber+'~j~'+invDate+'~j~'+retention;
			}

		}

		var total = parseFloat(document.getElementById('newRETTotal').textContent.replace(/,/g,""));
		
		if(total > 0) {
			var formData = new FormData();
			formData.append('saveNewRETENTION', 1);
			formData.append('details', encodeURIComponent(details.substring(3)));
			formData.append('total', total);
			formData.append('supplier', encodeURIComponent(supplier));

			loader();
			ajaxFormUpload(formData, processorLink, 'saveNewRETENTION');
		}else {
			alert("Please select at least one(1) PO to proceed.");
		}

	}

	function newRETChangeTotal() {
		var table = document.getElementById('newRETTable');
		var totalRetention = document.getElementById('newRETTotal');
		var trS = table.children[0].children;

		var newTotal = 0;
		for (var i = 1; i <= (trS.length - 3); i++) {

			var chkbox = trS[i].children[0].children[0];
			var retention =  parseFloat(trS[i].children[5].textContent.replace(/,/g,""));

			if(chkbox.checked == true) {
				newTotal += retention;
			}

		}

		totalRetention.innerHTML = numberWithCommas( round2(trimTwoDecimals(newTotal)) );

	}
							
	function getPOListForRetention(me) {
		
		var supplier = me.value;
		if(supplier.trim().length > 0) {
			var queryString = "?getPOListForRetention=1&supplier="+encodeURIComponent(supplier);
			var container = document.getElementById('selectRETPOForRET');

			

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"getPOListForRetention");
		}else {
			clearNewRetentionFields();
		}
		
	}

	function clearNewRetentionFields() {
		selectToIndexZero("selectRETSupplier");
		document.getElementById('selectRETPOForRET').innerHTML = "";
		document.getElementById('trNewRET1').style.display = "none";
		document.getElementById('trNewRET2').style.display = "none";
		document.getElementById('trNewRET3').style.display = "none";
	}

	//--------------------------------------------------------------------------------------------------------------NEW RETENTION - END

	//--------------------------------------------------------------------------------------------------------------WAGES - FILTERING - START
	
	function checkWGSDuplicates() {

		var docType = document.getElementById('selectDocTypeWGS').value.trim();
		var period = document.getElementById('selectPeriodWGS').value.trim();
		var claimant = document.getElementById('claimantWGS').value.trim();

		var params = period+'*j*'+encodeURIComponent(claimant);

		var queryString = "?checkWGSDuplicates=1&type="+docType+"&params="+params;
		var container = "";

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"checkWGSDuplicates");

		// checkChargesForSubWGS();

	}

	//--------------------------------------------------------------------------------------------------------------WAGES - FILTERING - END

	//--------------------------------------------------------------------------------------------------------------OFFICE FILTER FOR NEW PR PO PX - START

	function clickThisGoToGoodsModule(me) {
		var mainBtn = document.getElementById('GoodsAndServicesModule');
		var prBtn = document.getElementById('goodsM1');
		var poBtn = document.getElementById('goodsM2');
		
		mainBtn.click();

		if(me.id == 'optPR') {
			prBtn.click();
		}else {
			poBtn.click();
		}
	}

	//--------------------------------------------------------------------------------------------------------------OFFICE FILTER FOR NEW PR PO PX - END


	//--------------------------------------------------------------------------------------------------------------NEW LIQUIDATION - START

	function getCashAdvanceforNLIQ(me){
		var arr = me.value.split("@");

		var tn = document.getElementById("nliqCATN");
		var obr = document.getElementById("nliqCAOBR");
		var claimant = document.getElementById("nliqClaimant");
		var adv = document.getElementById("nliqCAADV");

		tn.textContent = arr[0];
		obr.textContent = arr[4];
		claimant.textContent = arr[2];
		adv.textContent = arr[5];

		var curCA = document.getElementById("nliqCurCA");
		var curSpent = document.getElementById("nliqCurSpent");
		var curRefund = document.getElementById("nliqCurRefund");
		var curORDets = document.getElementById("nliqCurORDets");
		var curReimb = document.getElementById("nliqCurReimb");

		curCA.textContent = numberWithCommas(arr[1]);
		curSpent.textContent = "0.00";
		curRefund.textContent = "0.00";
		curORDets.value = "";
		curReimb.textContent = "0.00";

		var queryString = "?fetchCAOBRBreakdown=1"+"&tn="+arr[0];
		var container = document.getElementById("nliqOBRDets");
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchCAOBRBreakdown");
	}

	function newKeyUpSpentNLIQ(me){

		var curCA = document.getElementById("nliqCurCA");
		var curSpent = document.getElementById("nliqCurSpent");
		var curRefund = document.getElementById("nliqCurRefund");
		var curReimb = document.getElementById("nliqCurReimb");
		var curTax = document.getElementById("nliqTax");

		var amounts = document.getElementsByName('nliqOBRValue');

		var newTotalSpent = 0;
		for (var i = 0; i < amounts.length; i++) {
			var newVal = 0;
			if(amounts[i].value != ""){
				newVal = parseFloat(amounts[i].value.replace(/,/g,""));
			}
			
			// else{
			// 	amounts[i].value = 0;
			// }
			newTotalSpent += newVal;
		}

		curSpent.textContent = numberWithCommas(round2(newTotalSpent));

		var curCA1 = parseFloat(curCA.textContent.replace(/,/g,""));
		var curSpent1 = parseFloat(curSpent.textContent.replace(/,/g,""));
		var curRefund1 = parseFloat(curRefund.textContent.replace(/,/g,""));
		var curReimb1 = parseFloat(curReimb.textContent.replace(/,/g,""));

		var curTax1 = 0;
		if(curTax.value.trim().length > 0) {
			curTax1 = parseFloat(curTax.value.trim().replace(/,/g,""));
		}

		// var spentWTax = curSpent1 - curTax1;

		// Computation
		var refnd2 = round2(curCA1 - curSpent1);
		// var refnd2 = round2(curCA1 - spentWTax);
		var reimb2 = 0;
		if(refnd2 < 0){
			reimb2 = numberWithCommas(refnd2.replace(/-/g,""))
			refnd2 = 0;
		}

		me.value = numberWithCommas(me.value.replace(/,/g,""));
		curRefund.textContent = numberWithCommas(refnd2);
		curReimb.textContent = numberWithCommas(reimb2);
	}

	function saveNLIQ(){
		var caAmnt = document.getElementById("nliqCurCA").textContent.replace(/,/g,"");
		var caSpent = document.getElementById("nliqCurSpent").textContent.replace(/,/g,"");
		var caRefund = document.getElementById("nliqCurRefund").textContent.replace(/,/g,"");
		var caORDets = document.getElementById("nliqCurORDets").value;
		var caReimb = document.getElementById("nliqCurReimb").textContent.replace(/,/g,"");
		var caTax = document.getElementById("nliqTax").value.trim().replace(/,/g,"");

		if(caTax == "") {
			caTax = 0;
		}

		var chkTax = 0;
		if(document.getElementById("nliqTaxRow").style.display != "none") {
			chkTax = 1;
		}

		var tn = document.getElementById("nliqCATN").textContent.trim();
		var claimant = document.getElementById("nliqClaimant").textContent.trim();

		var amounts = document.getElementsByName('nliqOBRValue');
		var obrBrkd = document.getElementsByName('nliqOBRHidden');

		var breakdown = "";
		for (var i = 0; i < amounts.length; i++) {
			// breakdown += "~"+obrBrkd[i].value+"*"+parseFloat(amounts[i].value.replace(/,/g,""));
			
			var thisSpent = 0;
			if(amounts[i].value.trim().length > 0) {
				thisSpent = parseFloat(amounts[i].value.replace(/,/g,""));
			}
			breakdown += "~"+obrBrkd[i].value+"*"+thisSpent;
		}

		breakdown = breakdown.substring(1);

		var proc = 0;
		if(caRefund > 0 && caORDets == ""){
			proc = 1;
		}

		if(chkTax == 1 && caTax <= 0) {
			proc = 2;
		}
		
		if(proc == 0){
			var queryString = "?saveNewLiquidation=1"
							+ "&caTN=" + tn
							+ "&claimant=" + claimant
							+ "&amount=" + caAmnt
							+ "&spent=" + caSpent
							+ "&refund=" + caRefund
							+ "&orDetails=" + caORDets
							+ "&reimb=" + caReimb
							+ "&breakdown=" + breakdown
							+ "&tax=" + caTax
							;

			var container = "";

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"saveNewLiquidation");	
		}else{
			if(proc == 1) {
				alert("Please fill in OR Details.");
			}else if(proc == 2) {
				alert("Please fill in Tax Amount.");
			}
		}
	}

	function nliqClearFields(){
		document.getElementById("nliqCATN").innerHTML = "";
		document.getElementById("nliqCAOBR").innerHTML = "";
		document.getElementById("nliqClaimant").innerHTML = "";
		document.getElementById("nliqCAADV").innerHTML = "";
		document.getElementById("nliqOBRDets").innerHTML = "";
		document.getElementById("nliqCurCA").innerHTML = "";
		document.getElementById("nliqCurSpent").innerHTML = "";
		document.getElementById("nliqCurRefund").innerHTML = "";
		document.getElementById("nliqCurORDets").value = "";
		document.getElementById("nliqCurReimb").innerHTML = "";

		selectToIndexZero('selectCashAdvanceNLIQList');

		document.getElementById("nliqContMain").style.display = "none";
		document.getElementById("nliqContSave").style.display = "none";
	}

	// function encLiqLoadProgCodes() {
	// 	var container = document.getElementById('encLiqProg');
	// 	var queryString = "?encLiqLoadProgCodes=1";
	// 	ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	// }

	function encLiqLoadProgCodes() {
		var selLiqTn = document.getElementById('selectCashAdvanceNLIQList');

		var arr = selLiqTn.value.split("@");
		var tn = arr[0];

		var container = document.getElementById('encLiqProg');
		var queryString = "?encLiqLoadProgCodes=1&tn="+tn;
		// console.log(queryString);
		ajaxGetAndConcatenate(queryString,processorLink,container,"encLiqLoadProgCodes");
	}

	function getEncLiqAcct() {
		var progCode = document.getElementById('encLiqProg').value.trim();
		if(progCode != "") {
			var container = document.getElementById('encLiqAcct');
			var queryString = "?getEncLiqAcct=1&prog="+progCode;
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
		}
	}

	function encLiqAddCharges() {
		var hidden = document.getElementsByName('nliqOBRHidden');
		var selProg = document.getElementById('encLiqProg');
		var selAcct = document.getElementById('encLiqAcct');
		var len = hidden.length;
		var obrTable = document.getElementById('encLiqTable');
		var tbody = obrTable.children[0];

		var addedRow = "";
		var nextSibling = len;
		var allowAdd = 1;
		for (var i = 0; i < len; i++) {
			var temp = hidden[i].value.split('*');
			var curProg = temp[0];
			var curAcct = temp[1];

			var prgTd = "";
			if(curProg != selProg.value) {
				// var selectedPrg = selProg.options[selProg.selectedIndex].text;
				// var title = selectedPrg.split(selProg.value+" ")[1];
				// prgTd = "<span style='display:block; font-weight:bold;' class='encLiqPrgs'>"+selProg.value+"</span><span>"+title+"</span>";
				nextSibling = i;
			}else {
				if(curAcct == selAcct.value) {
					allowAdd = 0;
				}
			}
			
		}

		if(selAcct.value.trim().length == 0) {
			allowAdd = 2;
		}

		
		if(allowAdd == 1) {
			var selectedAcct = selAcct.options[selAcct.selectedIndex].text;
			var acctTitle = selectedAcct.split(selAcct.value+" ")[1];

			addedRow ="		<td style='padding:0px 5px;'>"+prgTd+"</td>"
					+"		<td style='padding:0px 5px; padding-bottom:8px;'>"
					+"			<span style='display:block; font-weight:bold;'>"+selAcct.value+"</span>"
					+"			<span>"+acctTitle+"</span>"
					+"		</td>"
					+"		<td></td>"
					+"		<td style='padding:0px 5px;'>"
					+"			<input name='nliqOBRValue' class='data2' style='width:130px; text-align:right; border:0px; border-bottom:1px dashed silver;' value='0.00' onkeydown='return isAmount(this,event)' onkeyup='newKeyUpSpentNLIQ(this)'>"
					+"			<input type='hidden' name='nliqOBRHidden' value='"+selProg.value+"*"+selAcct.value+"'>"
					+"		</td>";
			
			if(nextSibling == len) {
				tbody.innerHTML += "<tr>"+addedRow+"</tr>";
			}else {
				var tr = document.createElement('TR');
				tr.innerHTML = addedRow;
				tbody.insertBefore(tr, tbody.children[nextSibling]);
			}
		}else {
			if(allowAdd == 0) {
				alert("Account already added. Please select another account.");
			}else if(allowAdd == 2) {
				alert("Please select account code.");
			}
		}
		
	}

	//--------------------------------------------------------------------------------------------------------------NEW LIQUIDATION - END


	//--------------------------------------------------------------------------------------------------------------Multiple Liquidation - START

	// function clearCashAdvanceMLQ(){
	// 	document.getElementById("cashAdvanceAmountMLQ").value = "";
	// 	document.getElementById("cashSpentMLQ").value = "";
	// 	document.getElementById("cashAdvanceRefundMLQ").value = "" ;
	// 	document.getElementById("cashAdvanceReimbursedMLQ").value = "" ;
	// 	document.getElementById("claimantMLQ").value = "" ;

	// 	selectToIndexZero("selectCashAdvanceMLQList");

	// 	var caListCont = document.getElementById('caListAddedMLQ');
	// 	var tbody = caListCont.children[1];
	// 	tbody.innerHTML = "";
	// }

	// function selectCashAdvanceMLQ(){

	// 	var caList = document.getElementById('selectCashAdvanceMLQList');
	// 	var caListCont = document.getElementById('caListAddedMLQ');
	// 	var tbody = caListCont.children[1];
	// 	var claimantMLQ = document.getElementById('claimantMLQ');
	
	// 	// clearCashAdvanceMLQ();
	// 	var arr = caList.value.split("@");
	// 	if(arr.length > 1){
	// 		var tn = arr[0];
	// 		var amount  = numberWithCommas(arr[1]);
	// 		var claimant = arr[2];
	// 		var month = arr[3];

	// 		// if(claimantMLQ.value.trim() == "" || claimantMLQ.value.trim() == claimant){


	// 			var chking = checkCAListMLQ(tn);
	// 			if(chking == 0){
	// 				var remove = "<i style='cursor:pointer;font-size:24px;font-weight:bold;color:red;' onclick='removeThisRowMLQ(this)'>×</i>";

	// 				var tr = "<tr>"
	// 					   + "<td style='padding-left:10px; width:100px;'>"
	// 					   + "<input name='caTNList' value='"+tn+"' style='font-family:Oswald; width:100%; color:black; background-color:white; border:0px; font-size:14px; font-weight:bold; padding:0px;' disabled>"
	// 					   + "</td>"
	// 					   + "<td style='padding-left:10px; font-size:14px;'>"+month+"</td>"
	// 					   + "<td style='padding:0px 10px; font-size:14px;'>"
	// 					   + "<span class='caNameList'>"+claimant+"</span>"
	// 					   + "</td>"
	// 					   + "<td style='padding-right:10px; font-size:14px; text-align:right;'>"
	// 					   + "	<input maxlength='16' name='mlqCAAmount' class='data2' style='font-size:13px; width:110px; text-align:right; border:0px; background-color:white; color:black;' value='"+amount+"' disabled>"
	// 					   + "</td>"
	// 					   + "<td style='padding:5px 5px;'>"
	// 					   + "	<input maxlength='16' name='mlqSpent' onkeydown='return isAmount(this,event)' class='data2' style='font-size:13px; width:110px; text-align:right; border:0px; border-bottom:1px dashed black;' onkeyup='newKeyUpSpentMLQ(this)'>"
	// 					   + "</td>"
	// 					   + "<td style='padding:5px 5px;'>"
	// 					   + "	<input maxlength='16' name='mlqRefund' onkeydown='return isAmount(this,event)' class='data2' style='font-size:13px; width:110px; text-align:right; border:0px; border-bottom:1px dashed black; background-color:white;' value='0' disabled>"
	// 					   + "</td>"
	// 					   + "<td style='padding:5px 5px;'>"
	// 					   + "	<input maxlength='16' name='mlqORDetails' class='data2' style='font-size:13px; width:110px; text-align:right; border:0px; border-bottom:1px dashed black;'>"
	// 					   + "</td>"
	// 					   + "<td style='padding:5px 5px;'>"
	// 					   + "	<input maxlength='16' name='mlqReimbrsmnt' onkeydown='return isAmount(this,event)' class='data2' style='font-size:13px; width:110px; text-align:right; border:0px; border-bottom:1px dashed black; background-color:white;' value='0' disabled>"
	// 					   + "</td>"
	// 					   + "<td style='text-align:center;'>"+remove+"</td>"
	// 					   + "</tr>";

	// 				// tbody.innerHTML += tr;
	// 				tbody.insertAdjacentHTML('beforeend',tr);
	// 				// document.getElementById("cashAdvanceTNMLQ").value = tn;
	// 				var total = document.getElementById("cashAdvanceAmountMLQ");
	// 				var curTotal = 0;
	// 				if(total.value != ""){
	// 					curTotal = parseFloat(total.value.replace(/,/g,""));
	// 				}
	// 				var toAdd = parseFloat(amount.replace(/,/g,""));
	// 				total.value = numberWithCommas(curTotal + toAdd);

	// 				updateCurrentClaimantMLQ();

	// 			} else {
	// 				alert(tn+" already added.");
	// 			}
	// 		// }else{
	// 		// 	alert(tn+" has a different claimant.");
	// 		// }
	// 	}
		
	// }

	// function checkCAListMLQ(tn){
	// 	var caTNList = document.getElementsByName('caTNList');

	// 	if(caTNList.length > 0){
	// 		for (var i = 0; i < caTNList.length; i++) {
	// 			if(caTNList[i].value == tn){
	// 				return 1;
	// 				break;
	// 			}
	// 		}
	// 	}
	// 	return 0;
	// }

	// function saveMLQ(trackType){

	// 	var caTNList = document.getElementsByName('caTNList');
	// 	var caAmountList = document.getElementsByName('mlqCAAmount');		
	// 	var caSpentList = document.getElementsByName('mlqSpent');		
	// 	var caRefundList = document.getElementsByName('mlqRefund');		
	// 	var caReimbList = document.getElementsByName('mlqReimbrsmnt');

	// 	var caORDetList = document.getElementsByName('mlqORDetails');

	// 	var caAmountTotal = document.getElementById('cashAdvanceAmountMLQ').value.replace(/,/g,"");		
	// 	var caSpentTotal = document.getElementById('cashSpentMLQ').value.replace(/,/g,"");		
	// 	var caRefundTotal = document.getElementById('cashAdvanceRefundMLQ').value.replace(/,/g,"");		
	// 	var caReimbTotal = document.getElementById('cashAdvanceReimbursedMLQ').value.replace(/,/g,"");

	// 	var claimant = document.getElementById("claimantMLQ").value.trim();
		
	// 	var caAll = "";
	// 	var oops = 0;
	// 	if(caTNList.length > 0){
	// 		for (var i = 0; i < caTNList.length; i++) {
	// 			var tn = caTNList[i].value;
	// 			var spent = caSpentList[i].value.replace(/,/g,"");
	// 			var refund = caRefundList[i].value.replace(/,/g,"");
	// 			var reimbrs = caReimbList[i].value.replace(/,/g,"");
	// 			var orDets = encodeURIComponent(caORDetList[i].value);

	// 			caAll += "*j*"+tn+"~"+spent+"~"+refund+"~"+reimbrs+"~"+orDets;

	// 			if(refund > 1){
	// 				if(orDets == ''){
	// 					oops = 1;
	// 					break;
	// 				}
	// 			}
	// 			if(tn == ''){
	// 				oops = 2;
	// 				break;
	// 			}
	// 			if(spent == ''){
	// 				oops = 3;
	// 				break;
	// 			}

	// 		}

	// 		caAll = caAll.substring(3);

	// 		if(oops == 0){
	// 			var queryString = "?saveTrackingMLQ=1"
	// 							+ "&trackType="   + trackType
	// 							+ "&caAmount="    + caAmountTotal
	// 							+ "&caSpent=" 	  + caSpentTotal
	// 							+ "&caRefund=" 	  + caRefundTotal
	// 							+ "&caReim=" 	  + caReimbTotal
	// 							+ "&claimant=" 	  + claimant
	// 							+ "&caBreakdown=" + caAll;
	// 			var container = document.getElementById('divNewTrackingNumber');
				
	// 			loader();
	// 			ajaxGetAndConcatenate(queryString,processorLink,container,"saveTrackingMLQ");
	// 		}else if(oops == 1){
	// 			alert("Please enter official receipt details.");
	// 		}else if(oops == 2){
	// 			alert("Please select cash advance.");
	// 		}else if(oops == 3){
	// 			alert("Please enter cash spent.");
	// 		}
	// 	}else{
	// 		alert("Please add cash advance.");
	// 	}
		
		
	// }

	// // 2021-12-13 For Multiple/Consolidated Liquidation with different details
	// function newKeyUpSpentMLQ(me){
		
	// 	var tbody = me.parentNode.parentNode.parentNode;
	// 	var caAmt = me.parentNode.parentNode.children[3].children[0];
	// 	var spent = me.parentNode.parentNode.children[4].children[0];
	// 	var refnd = me.parentNode.parentNode.children[5].children[0];
	// 	var reimb = me.parentNode.parentNode.children[7].children[0];
		
	// 	// Values
	// 	var caAmt1 = parseFloat(caAmt.value.replace(/,/g,""));
	// 	var spent1 = 0;
	// 	if(spent.value != ""){
	// 		spent1 = parseFloat(spent.value.replace(/,/g,""));
	// 	}
	// 	var refnd1 = parseFloat(refnd.value.replace(/,/g,""));
	// 	var reimb1 = parseFloat(reimb.value.replace(/,/g,""));

	// 	// if(spent1 == ""){
	// 	// 	// Re-assigning
	// 	// 	refnd.value = numberWithCommas(0);
	// 	// 	reimb.value = numberWithCommas(0);
	// 	// }else{

	// 		// Computation
	// 		var refnd2 = round2(caAmt1 - spent1);
	// 		var reimb2 = 0;
	// 		if(refnd2 < 0){
	// 			reimb2 = numberWithCommas(refnd2.replace(/-/g,""))
	// 			refnd2 = 0;
	// 		}

	// 		// Re-assigning
	// 		refnd.value = numberWithCommas(refnd2);
	// 		reimb.value = numberWithCommas(reimb2);
	// 	// }

	// 	// spent.value = numberWithCommas(spent1);
	// 	mlqUpdateValues(tbody);
	// }

	// function mlqUpdateValues(parent){
	// 	var caTotal = document.getElementById("cashAdvanceAmountMLQ");
	// 	var spentTotal = document.getElementById("cashSpentMLQ");
	// 	var refundTotal = document.getElementById("cashAdvanceRefundMLQ");
	// 	var reimbTotal = document.getElementById("cashAdvanceReimbursedMLQ");

	// 	var newCATotal = 0;
	// 	var newSPTotal = 0;
	// 	var newRFTotal = 0;
	// 	var newRETotal = 0;

	// 	for(var i = 0 ; i < parent.children.length; i++){
	// 		var spent = 0;
	// 		if(parent.children[i].children[4].children[0].value != ""){
	// 			spent = parent.children[i].children[4].children[0].value.replace(/,/g,"");
	// 		}
	// 		newCATotal += parseFloat(parent.children[i].children[3].children[0].value.replace(/,/g,""));
	// 		newSPTotal += parseFloat(spent);
	// 		newRFTotal += parseFloat(parent.children[i].children[5].children[0].value.replace(/,/g,""));
	// 		newRETotal += parseFloat(parent.children[i].children[7].children[0].value.replace(/,/g,""));
	// 	}

	// 	caTotal.value = numberWithCommas(newCATotal);
	// 	spentTotal.value = numberWithCommas(newSPTotal);
	// 	refundTotal.value = numberWithCommas(newRFTotal);
	// 	reimbTotal.value = numberWithCommas(newRETotal);

	// }

	// function removeThisRowMLQ(me){

	// 	var tbody = me.parentElement.parentElement.parentElement;
	// 	var tr = me.parentElement.parentElement;
		
	// 	tbody.removeChild(tr);

	// 	mlqUpdateValues(tbody);
	// 	updateCurrentClaimantMLQ();
	// }

	// function updateCurrentClaimantMLQ(){
	// 	var claimantMLQ = document.getElementById('claimantMLQ');
	// 	var caNameList = document.getElementsByClassName('caNameList');
	// 	var len = caNameList.length;
	// 	if(len > 0){
	// 		var lastChild = caNameList[0];
	// 		claimantMLQ.value = lastChild.textContent.trim();
	// 	}else{
	// 		claimantMLQ.value = "";
	// 	}
	// }

	//--------------------------------------------------------------------------------------------------------------Multiple Liquidation - END

	//------------------------------------------------------------------------------------------------------------Retracking - START
	function rtkClearFields(){
		selectToIndexZero("rtkSelectYrSource");
		selectToIndexZero("rtkSelectYrRecvr");

		var rtkInputTN = document.getElementById('rtkInputTN');
		rtkInputTN.value = ""
		var rtkInputOffc = document.getElementById('rtkInputOffc');
		rtkInputOffc.value = "";
	}
	function rtkOnChangeTracking(me){
		var x = me.value;
		var yearRecvr = document.getElementById('rtkSelectYrRecvr').value;
		var office = document.getElementById('rtkInputOffc').value;

		if(yearRecvr != "" && office != ""){
			if(x == "optPO"){
				document.getElementById('rtkEnterPRTN').style.display = "table-row";
			}else{
				document.getElementById('rtkEnterPRTN').style.display = "none";
			}

			var queryString = "?selectNewDoctrackRTK=1&type=" + x +"&receiver="+yearRecvr+"&office="+office;
			var container = document.getElementById('divNewTrackingNumber');
			
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"selectNewDoctrackRTK");
		}else{
			alert("Please fill in missing details.");
		}
		
	}
	function transferTracking(){
		var yearSource = document.getElementById('rtkSelectYrSource').value;
		var yearRecvr = document.getElementById('rtkSelectYrRecvr').value;
		var tracking = document.getElementById('rtkInputTN').value;
		var office = document.getElementById('rtkInputOffc').value;

		if(year != "" || tracking != "" || office != ""){
			var queryString = "?rtkTransferTracking=1&source="+yearSource+"&receiver="+yearRecvr+"&tn="+tracking.toUpperCase().trim()+"&office="+office.toUpperCase().trim();
			var container = "";
			
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"rtkTransferTracking");
		}else{
			alert("Please fill in missing details.");
		}
	}
	//------------------------------------------------------------------------------------------------------------Retracking - END
	
	//------------------------------------------------------------------------------------------------------------Wages - START
	function searchPTRS(me){
		var ptrs = me.value.trim();
		// var selectDocTypeWGS = document.getElementById('selectDocTypeWGS').value.toUpperCase();

		if(ptrs != ""){
			var temp = ptrs.replace(/\s/g,"");
			var arr1 = temp.split(",");
			var proc = 0;
			for(var i = 0; i < arr1.length; i++) {
				if(arr1[i] == ""){
					proc = 1;
					break;
				}

				var arr2 = arr1[i].split("-");
				if(arr2.length < 3){
					proc = 2;
					break;
				}

			}
			
			if(proc == 0){
				var container = "";
				var docType = "";
				var upType = 0;

				if(me.id == "sequenceNumWGS1"){
					container = document.getElementById('dbfTable1');
					docType = document.getElementById('selectDocTypeWGS1').value.toUpperCase();
					upType = 1;
				}else{
					container = document.getElementById('dbfTable');
					docType = document.getElementById('selectDocTypeWGS').value.toUpperCase();
				}

				loader();
				var queryString = "?searchPTRS=1&ptrs="+ptrs+"&doctype="+docType+"&uptype="+upType;
				ajaxGetAndConcatenate(queryString,processorLink,container,"searchPTRS");
			}else if(proc == 1){
				alert('Please remove excess ",".');
			}else if(proc == 2){
				alert('Please make sure to enter the PTRS number completely. (e.g. RP-000000-0000 OR SP-000000-0000)');
			}
		}else{
			alert("Please enter PTRS Number.");
		}
		
	}

	function showHideWGSSubPrgCode(me){
		var code = me.value;
		var wgsSubPrgCodeCnt = document.getElementById('wgsSubPrgCodeCnt');

		if(me.value == "1011-1"){
			wgsSubPrgCodeCnt.style.display = "";
		}else{
			wgsSubPrgCodeCnt.style.display = "none";
			selectToIndexZero("wgsSubPrgCode");
		}

	}

	function resetDbfTable(){
		// var uploadWGSlabel = document.getElementById('uploadWGSlabel');
		// var uploadWGS = document.getElementById('uploadWGS');

		// if(uploadWGS.files.length > 0){
		// 	uploadWGSlabel.innerHTML = "Select file";
		// 	uploadWGS.value = "";
		// }

		var sequenceNumWGS = document.getElementById('sequenceNumWGS');
		var dbfTable = document.getElementById('dbfTable');

		if(sequenceNumWGS.value.length > 0){
			dbfTable.innerHTML = "";
		}
	}

	var wgsModeF = 0;
	function wgsMode(me){
		var id = me.id;

		var wgsChargesTblM = document.getElementById('wgsChargesTblM');
		var wgsChargesTbl = document.getElementById('wgsChargesTbl');

		wgsChargesTblM.style.display = "none";
		wgsChargesTbl.style.display = "none";

		if(id == "wgsManl"){
			wgsChargesTblM.style.display = "table";
			wgsModeF = 1;
		}else{
			wgsChargesTbl.style.display = "table";
			wgsModeF = 0;
		}
	}

	function wgsAddMultipleSource(me){
		var tr = me.parentElement.parentElement.children;
		var th = me.parentElement.children;

		var progSel = tr[0].children[0].children[0];
		var program = progSel.value;
		
		var acctSel = tr[1].children[1].children[0];
		var account = acctSel.value;

		var amount = th[1].value;

		var progTitle = progSel.options[progSel.selectedIndex].text;
		progTitle = progTitle.replace(program, "").trim();

		var acctTitle = acctSel.options[acctSel.selectedIndex].text;
		acctTitle = acctTitle.replace(account, "").trim();

		if(program != "" && account != "" && amount != ""){
			var wgsExisting = wgsCheckExisitingCharges(program, account);

			if(wgsExisting == 0){
				var newTotal = wgsUpdateRemainingTotal("-", amount);

				if(newTotal == 0){
					var temp  = "<tr>";
					temp += "	<td style='padding:5px 8px; vertical-align:top; width:220px;'>";
					temp += "		<input type='text' class='wgsValuePlain' style='text-align:left;' name='wgsPrgCodeM' disabled value='"+program+"'>";
					temp += 		progTitle;
					temp += "	</td>";
					temp += "	<td style='padding:5px 8px; vertical-align:top; width:320px;'>";
					temp += "		<input type='text' class='wgsPlainInput' name='wgsAccCodeM' disabled value='"+account+"'>";
					temp += 		acctTitle;
					temp += "	</td>";
					temp += "	<td style='padding:5px 8px; vertical-align:center; width:215px;'>";
					temp += "		<input type='text' class='wgsValuePlain' style='width:75%;' name='wgsValuesM' disabled value='"+numberWithCommas(parseFloat(amount).toFixed(2))+"'>";
					temp += "	</td>";
					temp += "	<td style='padding:5px 8px; '>";
					temp += "		<div class='label18' onclick='wgsRemoveRow(this)'></div>";
					temp += "	</td>";
					temp += "</tr>";

					var wgsChargesTblM = document.getElementById('wgsChargesTblM');
					var tbody = wgsChargesTblM.children[1];
					tbody.innerHTML += temp;
				}else{
					alert("Please check remaining balance.");
				}
			}else{
				alert('Fund details already added.');
			}
			
			
		}else{
			alert('Please check details.');
		}
		
	}

	function wgsCheckExisitingCharges(prog, acct){
		var prgCodeAll = document.getElementsByName('wgsPrgCodeM');
		var accCodeAll = document.getElementsByName('wgsAccCodeM');
	
		for (let i = 0; i < accCodeAll.length; i++) {
			if(prgCodeAll[i].value == prog && accCodeAll[i].value == acct){
				return 1;
			}			
		}

		return 0;
	}

	function wgsUpdateRemainingTotal(operation, amount){
		var wgsTotalAmountMultiple = document.getElementById('wgsTotalAmountMultiple');

		var selectDocTypeWGS = document.getElementById('selectDocTypeWGS').value;

		// if(selectDocTypeWGS == "WAGES - SALARY J.O (1st half)"){
		// 	var curTotal = wgsTotalAmountMultiple.value.replace(/,/g,"");
		// }else{
		// 	var curTotal = wgsTotalAmountMultiple.innerText.replace(/,/g,"");
		// }

		if(wgsTotalAmountMultiple.tagName == "INPUT"){
			var curTotal = wgsTotalAmountMultiple.value.replace(/,/g,"");
		}else{
			var curTotal = wgsTotalAmountMultiple.innerText.replace(/,/g,"");
		}


		var newTotal = 0;
		if(operation == "+"){
			newTotal =  parseFloat(curTotal) + parseFloat(amount);
		}else{
			newTotal =  parseFloat(curTotal) - parseFloat(amount);
		}


		if(newTotal >= 0){
			// if(selectDocTypeWGS == "WAGES - SALARY J.O (1st half)"){
			// 	wgsTotalAmountMultiple.value = numberWithCommas(parseFloat(newTotal).toFixed(2));
			// }else{
			// 	wgsTotalAmountMultiple.innerText = numberWithCommas(parseFloat(newTotal).toFixed(2));
			// }

			if(wgsTotalAmountMultiple.tagName == "INPUT"){
				wgsTotalAmountMultiple.value = numberWithCommas(parseFloat(newTotal).toFixed(2));
			}else{
				wgsTotalAmountMultiple.innerText = numberWithCommas(parseFloat(newTotal).toFixed(2));
			}

			return 0;
		}else{
			return 1;
		}
	}

	function wgsRemoveRow(me){
		var tr = me.parentElement.parentElement; 
		var tbody = me.parentElement.parentElement.parentElement; 
		var amount = tr.children[2].children[0].value.replace(/,/g,"");
		tbody.removeChild(tr);
		
		var newTotal = wgsUpdateRemainingTotal("+", amount);
	}

	function onChangeWGSCodesPY(me){
		var tr = me.parentElement.parentElement.parentElement;
		var span = tr.children[1].children[1];
		var programCode = me.value;

		loader();
		var queryString = "?fetchAccountCodesPY=1&programCode=" + programCode;
		var container = span;
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchAccountCodesPY");
	} 

	function LoadProgramFundsByOfficeWages(){
		var queryString = "?LoadProgramFundsByOfficeWages=1";
		var container = document.getElementById('wgsFundSourceM');
		ajaxGetAndConcatenate(queryString,processorLink,container,"LoadProgramFundsByOfficeWages");
	}

	function showHidePEORCodeWGS(me){
		var progCode = me.value;
		var row = document.getElementById('peorCodeRow');
		var subCode = document.getElementById('peorSubCodeWGS');
		var ofcId = document.getElementById('peorOfcIdWGS');
		var codeCont = document.getElementById('peorCodesWGS');
		var show1 = 0;
		var show2 = 0;

		subCode.value = 0;
		codeCont.textContent = "";
		ofcId.value = 0;

		if(progCode == "1011-1"){
			show1 = 1;
		}else{
			show1 = 0;
		}

		if(wgsModeF == 0){
			var prgCodeAll = document.getElementsByName('wgsPrgCode');
		}else{
			var prgCodeAll = document.getElementsByName('wgsPrgCodeM');
		}

		if(prgCodeAll.length > 0){
			for (let i = 0; i < prgCodeAll.length; i++) {
				if(prgCodeAll[i].value == "1011-1"){
					show2 = 1;
				}else{
					show2 = 0;
				}
			}
		}


		if(show1 == 1 || show2 == 1){
			row.style.display = 'table';
		}else{
			row.style.display = 'none';
		}
	}

	// function setSubCodeForManualWGS(){
	// 	var peorOfcId = document.getElementById('peorWGSOfcId').value;
	// 	var subCode = document.getElementById('peorWGSSubCode').value;
	// 	var ofcName = document.getElementById('peorWGSOfcName').textContent;
	// 	var subName = document.getElementById('peorWGSSubName').textContent;
	// 	var codeCont = document.getElementById('peorCodesWGS');
	// 	var wgsSubCodeHid = document.getElementById('peorSubCodeWGS');
	// 	var wgsOfcIdHid = document.getElementById('peorOfcIdWGS');

	// 	if(peorOfcId != "" && subCode != ""){
	// 		document.getElementById('clickClose').click();
	// 		// saveWGS(subCode, peorOfcId);
			
	// 		codeCont.textContent = ofcName+" "+subName;
	// 		wgsSubCodeHid.value = subCode;
	// 		wgsOfcIdHid.value = peorOfcId
	// 	}else{
	// 		alert("Please select a Sub-Program Code.");
	// 	}
	// }

	function setWGSPEORDetails(me){
		var ofcName = document.getElementById('peorWGSOfcName');
		var subName = document.getElementById('peorWGSSubName');
		var ofcId = document.getElementById('peorWGSOfcId');
		var sudCode = document.getElementById('peorWGSSubCode');

		var codeCont = document.getElementById('peorCodesWGS');
		var wgsSubCodeHid = document.getElementById('peorSubCodeWGS');
		var wgsOfcIdHid = document.getElementById('peorOfcIdWGS');

		var temp = me.id.split("*");
		var selOfcId = temp[0];
		var selSubCode = temp[1];

		var tdS = me.children;
		var cellOfcName = tdS[1].textContent;
		var cellSubName = tdS[2].textContent;

		codeCont.innerHTML = "<span style='color:rgb(35, 116, 157);'>"+cellOfcName+"</span> "+cellSubName;
		wgsSubCodeHid.value = selSubCode;
		wgsOfcIdHid.value = selOfcId;

		document.getElementById('clickClose').click();

	}

	function showSubCodeSelectionWGS(){
		var queryString = "?fetchSubProgramBalanceForWGS=1&upType=0";
		var container = "";
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchSubProgramBalanceForWGS");
	}

	function checkChargesForSubWGS(){
		if(wgsModeF == 0){
			var prgCodeAll = document.getElementsByName('wgsPrgCode');
		}else{
			var prgCodeAll = document.getElementsByName('wgsPrgCodeM');
		}

		var tableDoctrackDBFList = document.getElementById('tableDoctrackDBFList');
		var tbody = tableDoctrackDBFList.children[1].children;
		var wgsSubCodeHid = document.getElementById('peorSubCodeWGS').value;
		var wgsOfcIdHid = document.getElementById('peorOfcIdWGS').value;

		var proc = 0;
		if(tbody.length > 0){
			for(let i = 0; i < prgCodeAll.length; i++){
				if(prgCodeAll[i] != null && prgCodeAll[i].value == "1011-1"){
					if(wgsOfcIdHid == 0 && wgsSubCodeHid == 0){
						proc = 1;
						break;
					}
				}
			}
			if(proc == 0){
				saveWGS();
			}else{
				alert("Please select a Sub-Program Code.");
			}
		}else{
			alert('Please check details.');
		}
		
	}

	function saveWGS(){
		var selectDocTypeWGS = document.getElementById('selectDocTypeWGS').value;
		var selectFundWGS = document.getElementById('selectFundWGS').value;
		var selectClaimTypeWGS = document.getElementById('selectClaimTypeWGS').value;
		var selectPeriodWGS = document.getElementById('selectPeriodWGS').value;
		var claimantWGS = document.getElementById('claimantWGS').value;
		var wgsPTRS = document.getElementById('wgsPTRS').value;
		// var wgsSubPrgCode = document.getElementById('wgsSubPrgCode').value;
		var wgsSubPrgCode = document.getElementById('peorSubCodeWGS').value;
		var wgsPEOROfcId = document.getElementById('peorOfcIdWGS').value;
		var wgsTotalNetUniv = document.getElementById('wgsTotalNetUniv').textContent.replace(/,/g,"");

		var wgsTotCompensation = document.getElementById('wgsTotCompensation').textContent.replace(/,/g,"");
		var wgsTotPERA = document.getElementById('wgsTotPERA').textContent.replace(/,/g,"");
		var wgsTotGSIS = document.getElementById('wgsTotGSIS').textContent.replace(/,/g,"");
		var wgsTotPHealth = document.getElementById('wgsTotPHealth').textContent.replace(/,/g,"");
		var wgsTotPIbig = document.getElementById('wgsTotPIbig').textContent.replace(/,/g,"");
		var wgsTotECIP = document.getElementById('wgsTotECIP').textContent.replace(/,/g,"");
		var wgsTotGross = document.getElementById('wgsTotGross').textContent.replace(/,/g,"");
		var wgsTotLWOP = document.getElementById('wgsTotLWOP').textContent.replace(/,/g,"");
		var wgsTotDeductions = document.getElementById('wgsTotDeductions').textContent.replace(/,/g,"");
		var wgsTotTax = document.getElementById('wgsTotTax').textContent.replace(/,/g,"");

		var wgsTotGSISPS = document.getElementById('wgsTotGSISPS').value.replace(/,/g,"");
		var wgsTotPIbigPS = document.getElementById('wgsTotPIbigPS').value.replace(/,/g,"");
		var wgsTotPHealthPS = document.getElementById('wgsTotPHealthPS').value.replace(/,/g,"");

		var wgsMultipleRecs = document.getElementById('wgsMultipleRecs').value;

		var tableDoctrackDBFList = document.getElementById('tableDoctrackDBFList');
		var wgsChargesTbl = document.getElementById('wgsChargesTbl');
		

		var tbody = tableDoctrackDBFList.children[1].children;
		var empStr = "";

		if(tbody.length > 0 && selectFundWGS != "" && selectClaimTypeWGS != "" && selectPeriodWGS != "" && claimantWGS != "" && selectDocTypeWGS != ""){
			if(wgsModeF == 0){
				var prgCodeAll = document.getElementsByName('wgsPrgCode');
				var accCodeAll = document.getElementsByName('wgsAccCode');
				var wgsValuAll = document.getElementsByName('wgsValues');
			}else{
				var prgCodeAll = document.getElementsByName('wgsPrgCodeM');
				var accCodeAll = document.getElementsByName('wgsAccCodeM');
				var wgsValuAll = document.getElementsByName('wgsValuesM');
			}

			var curPrgCode = "";
			var totalStr = "";

			$alertF = 0;

			if(wgsValuAll.length > 0){
				for (let i = 0; i < wgsValuAll.length; i++) {
					if(prgCodeAll[i] != null){
						curPrgCode = prgCodeAll[i].value;
						if(prgCodeAll[i].value == ""){
							$alertF = 1;
						}
					}

					totalStr += "$"+curPrgCode+"~"+accCodeAll[i].value.replace(/,/g,"")+"~"+wgsValuAll[i].value.replace(/,/g,"");
				}

				var empBreakdown = "";
				var tbody1 = document.getElementById('wagesEmployeeDetailsContainer');
				var trS1 = tbody1.children;
				for (let i = 0; i < trS1.length-1; i++) {
					if(trS1[i].children[1].id != '') {
						var offName = trS1[i].children[1].textContent.trim();
						var offCode = trS1[i].children[1].id;
						var empName = trS1[i].children[2].textContent.trim();
						var empNumb = trS1[i].children[2].id;
						var compensation = trS1[i].children[3].textContent.trim().replace(/,/g,"");
						var pera = trS1[i].children[4].textContent.trim().replace(/,/g,"");
						var gsis = trS1[i].children[5].textContent.trim().replace(/,/g,"");
						var philhealth = trS1[i].children[6].textContent.trim().replace(/,/g,"");
						var pagibig = trS1[i].children[7].textContent.trim().replace(/,/g,"");
						var ecip = trS1[i].children[8].textContent.trim().replace(/,/g,"");
						var gross = trS1[i].children[9].textContent.trim().replace(/,/g,"");
						var absences = trS1[i].children[10].textContent.trim().replace(/,/g,"");
						var deductions = trS1[i].children[11].textContent.trim().replace(/,/g,"");
						var tax = trS1[i].children[12].textContent.trim().replace(/,/g,"");
						var net = trS1[i].children[13].textContent.trim().replace(/,/g,"");
						var header = trS1[i].children[13].id;

						// console.log(offName+" ----- "+offCode+" ----- "+empName+" ----- "+empNumb);
						// console.log(compensation+" ----- "+pera+" ----- "+gsis+" ----- "+philhealth);
						// console.log(pagibig+" ----- "+ecip+" ----- "+gross+" ----- "+absences);
						// console.log(deductions+" ----- "+tax+" ----- "+net);

						empBreakdown += "*j*"+offName+"~"+offCode+"~"+empName+"~"+empNumb+"~"+compensation+"~"+pera+"~"+gsis+"~"+philhealth+"~"+pagibig+"~"+ecip+"~"+gross+"~"+absences+"~"+deductions+"~"+tax+"~"+net+"~"+header;
					}
				}	
				
				if($alertF == 0){
					var formData = new FormData();

					formData.append('empBreakdown', empBreakdown.substring(3));
					formData.append('ptrs', wgsPTRS);
					formData.append('totalBreakdown', totalStr.substring(1));
					formData.append('fund', selectFundWGS);
					formData.append('claimtype', selectClaimTypeWGS);
					formData.append('period', selectPeriodWGS);
					formData.append('claimant', claimantWGS);
					formData.append('docType', selectDocTypeWGS);
					formData.append('subPrgCode', wgsSubPrgCode);
					formData.append('peorOfcId', wgsPEOROfcId);
					formData.append('netAmount', wgsTotalNetUniv);

					formData.append('totCompensation', wgsTotCompensation);
					formData.append('totPERA', wgsTotPERA);
					formData.append('totGSIS', wgsTotGSIS);
					formData.append('totPHealth', wgsTotPHealth);
					formData.append('totPIbig', wgsTotPIbig);
					formData.append('totECIP', wgsTotECIP);
					formData.append('totGross', wgsTotGross);
					formData.append('totLWOP', wgsTotLWOP);
					formData.append('totDeductions', wgsTotDeductions);
					formData.append('totTax', wgsTotTax);

					formData.append('totGSISPS', wgsTotGSISPS);
					formData.append('totPIbigPS', wgsTotPIbigPS);
					formData.append('totPHealthPS', wgsTotPHealthPS);
					formData.append('multipleRecs', wgsMultipleRecs);

					var wgsTotalAmountMultiple = document.getElementById('wgsTotalAmountMultiple');
					var curTotal = wgsTotalAmountMultiple.innerText.replace(/,/g,"");
					if(parseFloat(curTotal) > 0 && wgsModeF == 1){
						alert("Remaining balance is greater than 0. Please check.");
					}else{
						loader();
						formData.append('saveWagesComp', 1);
						ajaxFormUpload(formData, processorLink, 'saveWagesComp');
					}
					
				}else{
					alert("Please fill in all missing fields.");
				}
			}else{
				alert("OBR details are missing.");
			}
		}else{
			alert('Please check details.');
		}
		
	}

	function autoModeSelect(){
		if(document.getElementById('selectDocTypeWGS1') == null){
			var docType = document.getElementById('selectDocTypeWGS').value.trim();
		}else{
			var docType = document.getElementById('selectDocTypeWGS1').value.trim();
		}

		const autoDef = [
						'WAGES - BACK PAY',
						'WAGES - OVERTIME PAY (Plantilla)', 
						'WAGES - SALARY PLANTILLA',
						'WAGES - SALARY DIFFERENTIAL'
					];

		if(!autoDef.includes(docType)){
			document.getElementById('wgsManl').click();
			document.getElementById('wgsAuto').style.display = "none";
			document.getElementById('wgsAuto').nextElementSibling.style.display = "none";
		}
	}

	function clearFieldsWGS(){
		selectToIndexZero("selectDocTypeWGS");
		selectToIndexZero("selectFundWGS");
		selectToIndexZero("selectClaimTypeWGS");
		selectToIndexZero("selectPeriodWGS");

		var claimantWGS = document.getElementById('claimantWGS');
		if(claimantWGS != undefined){
			claimantWGS.value = ""
		}
		var dbfTable = document.getElementById('dbfTable');
		if(dbfTable != undefined){
			dbfTable.innerHTML = "";
		}
		var sequenceNumWGS = document.getElementById('sequenceNumWGS');
		sequenceNumWGS.value = "";
	}
	//------------------------------------------------------------------------------------------------------------Wages - END

	//loadAdd();
	function loadAdd(){
		var parent = document.getElementById('doctrackAddMainDiv');
		var opt = document.getElementsByName('selectType');
		var len = opt.length;
		for(var i = 0; i < len; i++){
			opt[i].checked = false;
		}
		document.getElementById('optSingle').checked = false;
		document.getElementById('optMultiple').checked = false;
		document.getElementById('optMultipleSource').checked = false;
	}
	whenRefreshDoctrackAdd();
	function whenRefreshDoctrackAdd(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "New"){
				
			}
		}
	}
	function loadProgramPPMP(){
		
		/*var queryString = "?loadProgramPPMP=1";
		var container = document.getElementById('tdProgramPR');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadProgramPPMP");*/
	}
	function LoadProgramFundsByOffice(){
		
		var queryString = "?loadProgramFundsByOffice=1";
		var container = document.getElementById('tdSource1');
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadProgramFundsByOffice");
	}
	
	//document.getElementById('optPO').click();
	//document.getElementById('optRET').click();
	function clickOption(me){
		var x  = me.id;
		var parent = document.getElementById('doctrackAddMainDiv');
		for(var i = 1; i < parent.children.length; i++){
			parent.children[i].className = "hide";
		}
		if(x == "optPR"){
			document.getElementById('tableDoctrackPR').className = "showTables";
			document.getElementById("trPR1").style.display = "none";
		}else if(x == "optPO"){
			document.getElementById('tableDoctrackPO').className = "showTables";
		}else if(x == "optPY"){
			document.getElementById('tableDoctrackPY').className = "showTables";
		}else if(x == "optLQ"){
			document.getElementById('tableDoctrackLQ').className = "showTables";
			clearCashAdvance();
		}else if(x == "optRET"){
			document.getElementById('tableDoctrackRET').className = "showTables";
		}else if(x == "optWGS"){
			document.getElementById('tableDoctrackWGS').className = "showTables";
			// LoadProgramFundsByOfficeWages();
		}else if(x == "optPAY"){
			document.getElementById('tableDoctrackPAY').className = "showTables";
		}else if(x == "optRTK"){
			document.getElementById('tableDoctrackRTK').className = "showTables";
		}else if(x == "optInfra"){
			document.getElementById('tableDoctrackInfra').className = "showTables";
		}else if(x == "optMLQ"){
			document.getElementById('tableDoctrackMLQ').className = "showTables";
		}else if(x == "optINP"){
			document.getElementById('tableDoctrackINP').className = "showTables";
		}else if(x == "optNLIQ"){
			document.getElementById('tableDoctrackNLIQ').className = "showTables";
		}
		
		

		var queryString = "?selectNewDoctrack=1&type=" + x;
		var container = document.getElementById('divNewTrackingNumber');

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"selectNewDoctrack");
	}
	function loadAppropriations(me){
		
		var fundType = me.value;
		var queryString = "?selectAppropriationByFund=1&fundType=" + fundType;
		var container = document.getElementById('containerAppropriations');
		
		ajaxGetAndConcatenate(queryString,processorLink,container,"selectAppropriationByFund");
	}
	function selectDefault(selectSchedPPMP){ //pwede ni i change sa special func
		selectSchedPPMP.selectedIndex = "0";
	}
	function SelectBySchedPPMP(me){
			
		if(me.id == "selectSchedPPMP"){
			var month = me.value;
			var category = document.getElementById('selectCategoryPPMP').value;
			var selectType = me.id; 
			var programCode = 'all';
			if(me.value){
				if(programCode){
					if(category){
						var container = document.getElementById('tdReviewContentPR');
						var queryString = "?selectByCategoryPPMP=1&category=" + category + "&month=" + month  + "&selectType=" + selectType + "&programCode=" + programCode;
						
						loader();
						ajaxGetAndConcatenate(queryString,processorLink,container,"selectByCategoryPPMP");
					}else{
						alert("Please select PPMP category.");
					}
				}else{
					alert("Please select responsibility center.");
				}
			}else{
				document.getElementById('tdReviewContentPR').innerHTML = "";
				document.getElementById("trPR1").style.display = "none";
				document.getElementById("trPR2").style.display = "none";
				document.getElementById("trPR3").style.display = "none";
			}
		}else if(me.id == "selectTrackingPR"){ //--------------------------------diri magload ang view sa po
			
			var splits = me.value.split("~");
			var category = splits[0];
			var month = splits[1];
			var trackingNumber = splits[2];
			
			var programCode = splits[3];
			programCode = 'all';
			var selectType = me.id; 
			
			
			var container = document.getElementById('tdReviewContainerPO');
			var queryString = "?selectByCategoryPPMP=1&category=" + category + "&month=" + month  + "&selectType=" + selectType + "&programCode=" + programCode + "&trackingNumber=" + trackingNumber;
		
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"selectByCategoryPPMP1");
			
		}
	}
	function saveTracking(){
		
		var tn =  document.getElementById('divNewTrackingNumber').textContent;
		var docType = document.getElementsByName('selectType');
		for(var i = 0 ; i < docType.length; i++){
			if(docType[i].checked == true){
				var trackType = docType[i].id.replace("opt",'');
			}
		}
		if(trackType == "PR"){
			savePR(trackType);
		}else if(trackType == "PO"){
			savePO(trackType);	
		}else if(trackType == "PY"){
			savePY(trackType);	
		}else if(trackType == "LQ"){
			saveLQ(trackType);	
		}else if(trackType == "RET"){
			saveRET(trackType);
		}else if(trackType == "WGS"){
			// saveWGS(trackType);
			// checkChargesForSubWGS(trackType);
			checkWGSDuplicates();
		}else if(trackType == "MLQ"){
			saveMLQ(trackType);	
		}
	}
	function calculate(me){
		var parent = me.parentNode.parentNode;
		var m1 = parent.children[3].children[0].value;
		var m2 = parent.children[4].children[0].value;
		
		var total =  parseInt(m1 * m2);
		var totalContainer = parent.children[5];
		
		totalContainer.innerHTML  = total;
		
		
		var totals = parent.children[5].innerHTML;
		var trLength = parent.parentNode.children.length;
		var gTotal = 0;
		
		for(var i = 2 ; i < trLength; i++){
			var check = parent.parentNode.children[i].children[0].children[0].checked;
			if(check == true ){
				var total = parent.parentNode.children[i].children[5].innerHTML.replace(/,/g,"");
				
				gTotal = parseFloat(gTotal) + parseFloat(total);
				document.getElementById('m4').innerHTML = gTotal.toFixed(2);
			}
			
		}		
	}
	function computeTotal(me){
		if(me.checked == true){
			var parent = me.parentNode.parentNode;
			var total = parent.children[5].textContent.replace(/,/g,"");
			var gTotal = parseFloat(document.getElementById('m4').textContent.replace(/,/g,"")) +parseFloat(total);
			document.getElementById('m4').innerHTML =gTotal.toFixed(2);
		}else{
			var parent = me.parentNode.parentNode;
			var total = parent.children[5].textContent.replace(/,/g,"");
			var gTotal = parseFloat(document.getElementById('m4').textContent.replace(/,/g,"")) - parseFloat(total);
			document.getElementById('m4').innerHTML =gTotal.toFixed(2);
		}
		
	}
	function checkMultipleCategory(){
		var parent = document.getElementById("divCategoryList").children[0].children[0].children.length;
		
	}
	function savePR(trackType){
		
		var error = 0;
		var prData = '';
		var month = '';
		if(qtr == "opt1st"){
			month = 1;
		}else if(qtr == "opt2nd"){
			month = 4;
		}else if(qtr == "opt3rd"){
			month = 7;
		}else if(qtr == "opt4th"){
			month = 10;
		}
		
		var category  = caty;
		var dummyProgram = '';
		var programs = '';
		var totalDetails = '';
		var parent = document.getElementById('prItemsTable');
		var trLength = parent.children[0].children.length;
		
		for(var i = 1 ; i < trLength-1; i++){
			
			var checkMe = parent.children[0].children[i].children[3].children[0].checked;
			if(checkMe == true){
				var itemDes =encodeURIComponent(parent.children[0].children[i].children[0].children[1].value.trim());
				
				var program =encodeURIComponent(parent.children[0].children[i].children[1].children[0].value.trim());
				var code =encodeURIComponent(parent.children[0].children[i].children[1].children[1].value.trim());
				var desc =encodeURIComponent(parent.children[0].children[i].children[2].children[0].value.replace(/{+}/g,"~").trim());
				//var desc =parent.children[0].children[i].children[2].children[0].value.replace(/{+}/g,"~").trim();				
				var qty = parent.children[0].children[i].children[4].children[0].value.trim();
				var unit = encodeURIComponent(parent.children[0].children[i].children[4].children[2].value.trim());
				var cost = parent.children[0].children[i].children[6].children[0].value.replace(/,/g,"");
				var total = parent.children[0].children[i].children[8].children[0].value.replace(/,/g,"");
				
				if(program.length < 4){
					parent.children[0].children[i].children[1].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(code.length < 8){
					parent.children[0].children[i].children[1].children[1].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(desc.length < 1){
					parent.children[0].children[i].children[2].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(qty.length < 1){
					parent.children[0].children[i].children[4].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(unit.length < 1){
					parent.children[0].children[i].children[4].children[2].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(cost.length < 1){
					parent.children[0].children[i].children[6].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				prData += category + '~!~' +  program + '~!~' + code + '~!~' + desc + '~!~' + qty + '~!~' + unit + '~!~'  +  cost + '~!~' + itemDes + '~#~';	
				totalDetails += category + '~!~' +  program + '~!~' + code + '~!~' + total + '!#!';
				if(dummyProgram != program){
					programs += program + '~';
					dummyProgram = program;
				}
			}	
		}
		if(prData.length == 0){
			error  = 3;
		}
		//pigeon sort
		var detailsA = totalDetails.split('!#!');
		var batchTotals = {};
		for(var i = 0 ; i < detailsA.length-1; i++){
			var detailsB = detailsA[i].split('~!~');
			var category = detailsB[0];
			var program = detailsB[1];
			var code = detailsB[2];
			var total = detailsB[3];
			if(batchTotals[category + '~' + program+ '~' + code] == undefined){
				batchTotals[category + '~' + program+ '~'+code] = 0;
			}
			batchTotals[category + '~' + program+ '~'+code] = parseFloat( batchTotals[category + '~' +program+ '~'+code]) +  parseFloat(total);
			
		}
		
		var grp = '';
		var oTotal = 0;
		for (var key in batchTotals) { 
		    var splitA =   key.split('~');
		    var category = splitA[0];
		    var program = splitA[1];
		    var code = splitA[2];
		    var total = 	batchTotals[key] ;
		    oTotal = oTotal + total;
		    grp += encodeURIComponent(category) + '~!~' + encodeURIComponent(program)+ '~!~' +  encodeURIComponent(code) + '~!~' + total + '~#~';
		}
		
		var  fund = document.getElementById('angFund').textContent;
		if(fund == "Development Fund"){
			fund = "General Fund";
		}
		if(error == 0){
			
			var queryString = "saveTrackingPost=1&trackType=" + trackType + "&fund=" + fund   + 
						  "&prMonth=" + month + 
						  "&grp=" + grp +
						  "&prData=" + prData  + 
						  "&oTotal=" + oTotal ;
			var container = document.getElementById('divNewTrackingNumber');	
			
			
			loader();
			ajaxPost(queryString,processorLink, container,"saveTrackingPost");
		}else if(error == 1){
			msg("Please complete the required fields.");
		}else if(error == 2){
			msg("Please select schedule in step 2. </br>PR items must be reviewed again.");
		}else if(error == 3){
			msg("Please select category in step 3.");
		}
	}
	function savePO(trackType){
	
		var error = 0;
		var prMonth =1;
		var prTrackingNumber = document.getElementById("prTrackingNumber").textContent;
		var prMonth = document.getElementById("prMonth").children[0].id.replace("prMonth","");
		if(prMonth == "1st Quarter"){
			prMonth = 1;
		}else if(prMonth == "2nd Quarter"){
			prMonth = 4;
		}else if(prMonth == "3rd Quarter"){
			prMonth = 7;
		}else{
			prMonth = 10;
		}
		
		var obrNumber = document.getElementById("obrNumber").textContent;
		//do not copy ermark from pr to prevent pre printing in obr form
		obrNumber = '';
		var prNumber = document.getElementById("prNumber").textContent;
		var supplierName = encodeURIComponent(document.getElementById("supplierName").value.trim());
		var fund = document.getElementById("fundType").textContent;
		
		if(supplierName.length < 1 ){
			document.getElementById("supplierName").style.backgroundColor ="rgb(253, 191, 222)";
			error = 1;
		}
		
		var prData = '';
		var dummyProgram = '';
		var programs = '';
		var totalDetails = '';
		var parent = document.getElementById('poItemsTable');
		var trLength = parent.children[0].children.length;
		var category = document.getElementById("prCategoryNew").textContent;
		for(var i = 1 ; i < trLength-1; i++){
			var checkMe = parent.children[0].children[i].children[3].children[0].checked;
			if(checkMe == true){
				var program =encodeURIComponent(parent.children[0].children[i].children[1].children[0].value.trim());
				
				var itemDes =encodeURIComponent(parent.children[0].children[i].children[0].children[1].value.trim());
				
				
				
				var code =encodeURIComponent(parent.children[0].children[i].children[1].children[1].value.trim());
			
				//var category = encodeURIComponent(parent.children[0].children[i].children[2].children[0].textContent);
				//var desc =encodeURIComponent(parent.children[0].children[i].children[2].children[0].value.trim());
				var desc =  encodeURIComponent(parent.children[0].children[i].children[2].children[0].value.replace(/{+}/g,"~").trim());	
				var qty = parent.children[0].children[i].children[4].children[0].value.trim();
				var unit = encodeURIComponent(parent.children[0].children[i].children[4].children[2].value.trim());
				var cost = parent.children[0].children[i].children[6].children[0].value.replace(/,/g,"");
				var total = parent.children[0].children[i].children[8].children[0].value.replace(/,/g,"");
				
			
				if(program.length < 4){
					parent.children[0].children[i].children[1].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(code.length < 8){
					parent.children[0].children[i].children[1].children[1].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(desc.length < 1){
					parent.children[0].children[i].children[2].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(qty.length < 1){
					parent.children[0].children[i].children[4].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(unit.length < 1){
					parent.children[0].children[i].children[4].children[2].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				if(cost.length < 1){
					parent.children[0].children[i].children[6].children[0].style.backgroundColor ="rgb(253, 191, 222)";
					error = 1;
				}
				prData += category + '~!~' +  program + '~!~' + code + '~!~' + desc + '~!~' + qty + '~!~' + unit + '~!~'  +  cost + '~!~' + itemDes + '~#~';	
				totalDetails += category + '~!~' +  program + '~!~' + code + '~!~' + total + '!#!';
				if(dummyProgram != program){
					programs += program + '~';
					dummyProgram = program;
				}
			}	
		}
	
		//pigeon sort
		var detailsA = totalDetails.split('!#!');
		var batchTotals = {};
		for(var i = 0 ; i < detailsA.length-1; i++){
			var detailsB = detailsA[i].split('~!~');
			var category = detailsB[0];
			var program = detailsB[1];
			var code = detailsB[2];
			var total = detailsB[3];
			if(batchTotals[category + '~' + program+ '~' + code] == undefined){
				batchTotals[category + '~' + program+ '~'+code] = 0;
			}
			batchTotals[category + '~' + program+ '~'+code] = parseFloat( batchTotals[category + '~' +program+ '~'+code]) +  parseFloat(total);
			
		}
		var grp = '';
		var oTotal = 0;
		for (var key in batchTotals) { 
		    var splitA =   key.split('~');
		    var category = splitA[0];
		    var program = splitA[1];
		    var code = splitA[2];
		    var total = 	batchTotals[key] ;
		    oTotal = oTotal + total;
		   grp += encodeURIComponent(category) + '~!~' + encodeURIComponent(program)+ '~!~' +  encodeURIComponent(code) + '~!~' + total + '~#~';
		}
		
		if(oTotal == 0){
			error = 3;
		}
		if(error == 0){
		
			var queryString = "saveTrackingPostPO=1&trackType=" + trackType + 
						  "&prTrackingNumber=" + prTrackingNumber + 
						  "&prNumber=" + prNumber + 
						  "&obrNumber=" + obrNumber + 
						  "&supplier=" + supplierName + 
						  "&prMonth=" + prMonth + 
						  "&fund=" + fund + 
						  "&grp=" + grp +
						  "&prData=" + prData  + 
						  "&oTotal=" + oTotal ;
			var container = document.getElementById('divNewTrackingNumber');
			
			loader();
			ajaxPost(queryString,processorLink, container,"saveTrackingPostPO");
		}else if(error == 1){
			msg("Please complete the required fields.");
		}else if(error == 2){
			msg("Please select schedule in step 2. </br>PR items must be reviewed again.");
		}else if(error == 3){
			msg("Please select item in Step 4.");
		}
	}
   //-------------------------------------------PY
	function SelectByPogramCodePY(me){
		var arr = me.value.split("~");;
		var programCode = arr[0];
		if(programCode.length == 0){
			clearFieldsOnFund();
		}else{
			loader();
			var queryString = "?fetchAccountCodesPY=1&programCode=" + programCode;
			var container = document.getElementById('tdSource2');
			ajaxGetAndConcatenate(queryString,processorLink,container,"fetchAccountCodesPY");
		}
	}
	
	function clearFieldsOnFund(){
		document.getElementById("chargesPY").style.display  = "none";	
		document.getElementById("charges1").style.display  = "none";
		document.getElementById("charges2").style.display  = "none";
		document.getElementById("charges3").style.display  = "none";
		document.getElementById('optSingle').checked = false;
		document.getElementById('optMultiple').checked = false;
		document.getElementById('optMultipleSource').checked = false;
	}
	function selectTransactionTypePY(me){
		var type = me.value;
		if(type == "Payroll"){
			document.getElementById("trPY1").style.display = "table-row";
			document.getElementById("trPY2").style.display = "table-row";
			document.getElementById("trPY3").style.display = "table-row";
			
			selectToIndexZero("selectPeriodPY");		
		}else if(type == "Voucher"){
			document.getElementById("trPY1").style.display = "none";
			document.getElementById("trPY2").style.display = "none";
			document.getElementById("trPY3").style.display = "none";
		}else{
			document.getElementById("trPY1").style.display = "none";
			document.getElementById("trPY2").style.display = "none";
			document.getElementById("trPY3").style.display = "none";
		}
	}
	function selectPeriodType(me){
		var parent = document.getElementById('tdPeriodContainer');
		var len = parent.children.length;
		for(var i = 0; i < len ; i++ ){
			parent.children[i].className = "hide";
		}
		if(me.value == "Monthly"){
			document.getElementById('divContainerSelectMonth').className = "show";
			selectToIndexZero("selectMonthlyPY");
		}else if(me.value == "Quarterly"){
			document.getElementById('divContainerSelectQuarter').className = "show";
			selectToIndexZero("selectQuarterPY");
		}
	}
	function selectMultiSourceFund(me){
		alert("disabled");
		/*var fund = me.value;
		var programCode = me.value;
		var queryString = "?fetchAccountCodesMultipleSource=1&programCode=" + fund;
		var container = document.getElementById('tdSource2');
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchAccountCodesMultipleSource");*/
	}
	function savePY(trackType){
		var error = 0;
		var fund = document.getElementById("selectFundPY").value;
		if(fund ==""){
			document.getElementById('selectFundPY').style.backgroundColor = "rgb(250, 152, 158)";
			error = 1;
		}
		
		var docType = document.getElementById("selectDocType");
		var docTypeOBR= docType.value;
		var x = docType.selectedIndex;
		var y = docType.options;
		var docTypeValue = y[x].text;
		if(docTypeValue == ""){
			document.getElementById('selectDocType').style.backgroundColor = "rgb(250, 152, 158)";
			error = 1;
		}
		
		
		var claimType = document.getElementById("selectClaimType").value;	
		if(claimType == ""){
			document.getElementById('selectClaimType').style.backgroundColor = "rgb(250, 152, 158)";
			error = 1;
		}
		
		var period = document.getElementById("selectPeriodPY").value;	
		if(period == ""){
			document.getElementById('selectPeriodPY').style.backgroundColor = "rgb(250, 152, 158)";
			error = 1;
		}
		
		var claimant =encodeURIComponent(document.getElementById("claimantPY").value);
		if(claimant == ""){
			document.getElementById('claimantPY').style.backgroundColor = "rgb(250, 152, 158)";
			error = 1;
		}
		var angCodeSub = 0;
		var angPeorOfc = 0;
		if(subMainCode != 0){
			// var angCodeSub = document.getElementById("subCodeSelect").value;
			// if(angCodeSub == ''){
			// 	document.getElementById('subCodeSelect').style.backgroundColor = "rgb(250, 152, 158)";
			// 	error = 1;
			// }

			var angCodeSub = document.getElementById("peorSubCodePYNEW").value;
			var angPeorOfc = document.getElementById("peorOfcIdPYNEW").value;
			if(angCodeSub == '' && angPeorOfc == ''){
				document.getElementById('peorCodesPYNEW').style.backgroundColor = "rgb(250, 152, 158)";
				error = 1;
			}
		}
		
		var amount = 0;
		var totalAmount = 0;
		if(fund != "Trust Fundx"){
			if(docTypeOBR == 1){
				var total = document.getElementById("pyTotal").innerHTML;
				if(total != ""){
					var arr =  mergeFund("chargesContainer1").split("^");
					var  grp = arr[0];
					var chargeType = arr[1]; 
					 totalAmount  = arr[2]; 
				}else{
					error = 2;
				}
			}else{
				
				amount = document.getElementById("amountPY").value;
				if(amount == "" || amount <= 0 ){
					document.getElementById('amountPY').style.backgroundColor = "rgb(250, 152, 158)";
					error = 1;
				}else{
					var chargeType = 0;
					var grp = "wala "
				}
			}
		}else{
			amount = document.getElementById("amountPY").value;
			if(amount == "" || amount <= 0 ){
				document.getElementById('amountPY').style.backgroundColor = "rgb(250, 152, 158)";
				error = 1;
			}else{
				var chargeType = 0;
				var grp = "wala "
			}
			
		}
		
		if(error > 0){
			if(error ==2){
				msg("Please add charges in step 6.");
			}else{
				msg("Please complete the required field.");
			}
		}else{
			var queryString = "?saveTrackingPY=1&trackType="  + trackType + 
							"&chargeType=" + chargeType + 
							"&fund=" + fund + 
							"&subCode=" + angCodeSub + 
							"&peorOfc=" + angPeorOfc + 
							"&docType=" + docTypeValue +
							"&claimType=" + claimType +
							"&period=" + period +
							"&claimant=" + claimant +
							"&group=" + grp  +
							"&amount=" + amount +
							"&totalAmount=" + totalAmount;

			var container = document.getElementById('divNewTrackingNumber');
			
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"saveTrackingPY");
		}
	}
	function mergeFund(name){
		var parent = document.getElementById(name);
		var row = parent.children.length;
		var total = 0;
		var grp  = "";
		var prg = 0;
		var prgN = "";
		for(var i = 0 ; i < row; i++){
			var program = parent.children[i].children[0].textContent;
			var code = parent.children[i].children[1].textContent;
			var amount = parent.children[i].children[2].textContent.replace(/,/g,"");
			
			if(prgN != program){
				prg++;
				prgN = program;
			}
			total = total + parseFloat(amount);
			grp += program + '~' + code + '~' + amount + '*'; 
		}
		var charge;
		if(i > 1){
			if(prg > 1){
				charge =  3; 
			}else{
				charge =  2; 
			}
		}else{
			charge = 1;
			total = 0;
		}
		return grp + '^' + charge + '^'  +  total;
	}
	function savePY1(trackType){
		var errors = '';
		var period = "";
		var periodValue = "";
		
		var fund  = document.getElementById("selectFundPY").value;
		if(fund.length == 0){
			errors += 'selectFundPY~';
		}
		var claimant = encodeURIComponent(document.getElementById('claimantPY').value);
		if(claimant.length == 0){
			errors += 'claimantPY~';
		}
	
		var claimType = document.getElementById("selectClaimTypePY").value;
		
		var x = document.getElementById("selectClaimTypePY").selectedIndex;
		var y = document.getElementById("selectClaimTypePY").options;
		var claimTypeValue = y[x].text;
		
		if(claimType.length == 0){
			errors += 'selectClaimTypePY~';
		}
		
		if(claimType != 0){
		
				var program = document.getElementById("selectProgramsPY").value;
				
						
				var transType = document.getElementById("selectTransactionTypePY").value;
				if(transType == "Payroll"){
					var period = document.getElementById("selectPeriodPY").value;
					if(period == "Monthly"){
						var periodValue = document.getElementById("selectMonthlyPY").value;
						if(periodValue.length == 0){
							errors += 'selectMonthlyPY~';
						}
					}else if(period  == "Quarterly") {
						var periodValue = document.getElementById("selectQuarterPY").value;
						if(periodValue.length == 0){
							errors += 'selectQuarterPY~';
						}
					}else{
						var periodValue = "";
					}
					
					if(period.length == 0){
						errors += 'selectPeriodPY~';
					}
				}
				if(transType.length == 0){
					errors += 'selectTransactionTypePY~';
				}
		
				errOpt = 0;
				if(chargeType == 1){
					var accountCode = document.getElementById('selectAccountCodesPY').value;
					var amount = document.getElementById('amountPY').value;
					if(accountCode.length == 0){
						document.getElementById('selectAccountCodesPY').style.backgroundColor = "rgb(250, 152, 158)";
						errOpt = 1;
					}
					if(amount.length == 0){
						document.getElementById('amountPY').style.backgroundColor = "rgb(250, 152, 158)";
						errOpt = 1;
					}
					
				}else if(chargeType == 2){
					var accountCode = codes;
					var amount = amountValues;
					if(accountCode.length == 0){
						var parent  = document.getElementById('tdAccountCodesPYMultiple');
						parent.children[0].style.backgroundColor = "rgb(250, 152, 158)";
						document.getElementById('amountPYMultiple').style.backgroundColor = "rgb(250, 152, 158)";
						errOpt = 2;
					}
				}else if(chargeType == 3){
					var accountCode = codes1;
					var amount = amountValues1;
					
					if(accountCode.length == 0){
						
						var parent  = document.getElementById('tdSource1');
						parent.children[0].style.backgroundColor = "rgb(250, 152, 158)";
						
						var parent  = document.getElementById('tdSource2');
						parent.children[0].style.backgroundColor = "rgb(250, 152, 158)";
						
						document.getElementById("source3").style.backgroundColor = "rgb(250, 152, 158)";
						
						errOpt = 5;
					}
				}else{
					errOpt = 3;
				}
		
		}else{
		
			var transType = 'Voucher';
				
		}
		if(fund != "Trust Fund"){
		
			if(claimType != 0){
				if(chargeType != 3){
					if(program.length == 0){
						errors += 'selectProgramsPY~';
					}
				}else{
					program = funds1; 
				}
			}else{
				program = '-';
				accountCode = '-';
				period = '-';
				periodValue = '-';
				
				chargeType = 1;
				amount = document.getElementById('amountTrust').value;
				if(amount.length == 0){
					errors += 'amountTrust~';
				}else{
					errOpt = 0;
				}
			}	
		}else{
			program = '-';
			accountCode = '-';
			period = '-';
			periodValue = '-';
			
			
			chargeType = 0;
			amount = document.getElementById('amountTrust').value;
			if(amount.length == 0){
				errors += 'amountTrust~';
			}else{
				errOpt = 0;
			}
		}
		
		if(fund == 'Trust Fund'){
			
			if(transType.length == 0){
				errors += 'selectTransactionTypePY~';
			}
			if(claimTypeValue == "SALARY"){
				 errors = errors.replace(/selectTransactionTypePY~/g,'');
				 transType = "Payroll";
			}else{
			
			  	errors = errors.replace(/selectTransactionTypePY~/g,'');
			  	transType = "Voucher";
			}
			chargeType = 1;
			if(transType == "Payroll"){
				var period = document.getElementById("selectPeriodPY").value;
				if(period == "Monthly"){
					var periodValue = document.getElementById("selectMonthlyPY").value;
					if(periodValue.length == 0){
						errors += 'selectMonthlyPY~';
					}
				}else if(period  == "Quarterly") {
					var periodValue = document.getElementById("selectQuarterPY").value;
					if(periodValue.length == 0){
						errors += 'selectQuarterPY~';
					}
				}else{
					var periodValue = "";
				}
				
				if(period.length == 0){
					errors += 'selectPeriodPY~';
				}
			}
			
			
		}
		
		var err = errors.split('~');
		var errSize = err.length-1;
		
		//------------------------------ pag check na
		if(errSize == 0){
			if(errOpt == 1){
				msg("Please input the red box.");
			}else if(errOpt == 2){
				msg("Please add account code and amount details.");
			}else if(errOpt == 3){
				msg("Please select charge type in step 5.");
			}else if(errOpt == 4){
				msg("Please input amount.");
			}else if(errOpt == 5){
				msg("Please complete source of fund details.");
			}else{
				var queryString = "?saveTrackingPY=1&trackType=" + trackType + 
							  "&fund=" + fund + 	
							  "&program=" + program + 
							  "&accountCode=" + accountCode +
							  "&transType=" + transType +
							  "&period=" + period +
							  "&periodValue=" + periodValue +
							  "&claimType=" + claimTypeValue +
							  "&claimant=" + claimant +
							  "&amount=" + amount +
							  "&chargeType=" + chargeType;;
				var container = document.getElementById('divNewTrackingNumber');
			
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"saveTrackingPY");
			}
		}else{
			for(var i = 0 ; i < errSize; i++){
				document.getElementById(err[i]).style.backgroundColor = "rgb(250, 152, 158)";
			}
			msg("Please input the red box.");
		}
	}
	function determineFund(me){
		if(me.value == "Trust Fundx" ){
			document.getElementById("tdAccountChargesA").style.display = "none";	
			document.getElementById("tdAccountChargesB").style.display = "none";	
			
			document.getElementById("trustAmountA").style.display = "table-row";	
			document.getElementById("trustAmountB").style.display = "table-row";	
			
			
		}else{
			document.getElementById("tdAccountChargesA").style.display = "table-row";	
			document.getElementById("tdAccountChargesB").style.display = "table-row";	
			
			document.getElementById("trustAmountA").style.display = "none";	
			document.getElementById("trustAmountB").style.display = "none";	
		}	
	}
	function onSelectClaimType(me){
		var obrType = me.value;
		var fund  = document.getElementById("selectFundPY").value;
		var x = me.selectedIndex;
		var y = me.options;
		var claimTypeValue = y[x].text;
		if(claimTypeValue == "BENEFITS - ELAP"){
			document.getElementById("selectFundPY").selectedIndex = "2";
		}
		if(fund != 'Trust Fundx'){
			if(obrType == 0){
				document.getElementById("tdAccountChargesA").style.display = "none";
				document.getElementById("tdAccountChargesB").style.display = "none";
				
				document.getElementById("trustAmountA").style.display = "table-row";	
				document.getElementById("trustAmountB").style.display = "table-row";	
				
			}else{
				document.getElementById("tdAccountChargesA").style.display = "table-row";
				document.getElementById("tdAccountChargesB").style.display = "table-row";
				
				document.getElementById("trustAmountA").style.display = "none";	
				document.getElementById("trustAmountB").style.display = "none";	
			}
		}
		if(fund == ''){
			document.getElementById("tdAccountChargesA").style.display = "none";
			document.getElementById("tdAccountChargesB").style.display = "none";
			
			document.getElementById("trustAmountA").style.display = "table-row";	
			document.getElementById("trustAmountB").style.display = "table-row";	
		}
	
	}
	function clearFieldsPY(){
		var myOffice = document.getElementsByClassName('activeOffice');
		if(myOffice[0].textContent == 'LINGAP'){
			document.getElementById('amountPY').value = '';	
			//document.getElementById('claimantPY').value = '';	
		}else{
			var table = document.getElementById("tableDoctrackPY");
			var select = table.getElementsByTagName("select");
			var inputs = table.getElementsByTagName("input");
			
			
			var x = '';
			for(var i = 0; i < select.length; i++){
				var field = select[i];
				selectToIndexZero(field.id);
			}
			
			for(var i = 0; i < inputs.length; i++){
				var field = inputs[i];
				field.value = '';
			}
			
			document.getElementById("chargesContainer1").innerHTML = "";
			document.getElementById("pyTotal").innerHTML = "";
			
			document.getElementById("tdAccountChargesA").style.display = "none";
			document.getElementById("tdAccountChargesB").style.display = "none";
			
			document.getElementById("trustAmountA").style.display = "table-row";	
			document.getElementById("trustAmountB").style.display = "table-row";

			document.getElementById("subPa").style.display = "none";
			document.getElementById("subPb").style.display = "none";
			document.getElementById("peorCodesPYNEW").innerHTML = "";
			subMainCode = 0;
		}
	}
	var chargeType = 0;
	function clickOptionCharges(me){
		
		var id =  me.id;
		
		if(document.getElementById('selectProgramsPY').value){
			
			if(id == "optSingle"){
				document.getElementById('charges1').style.display = "inline-block";
				document.getElementById('charges2').style.display = "none";
				document.getElementById('charges3').style.display = "none";
				chargeType = 1;
				
			}else if(id == "optMultiple"){
				document.getElementById('charges1').style.display = "none";
				document.getElementById('charges2').style.display ="inline-block";
				document.getElementById('charges3').style.display = "none";
				chargeType = 2;
			}else if(id == "optMultipleSource"){
				
				
				document.getElementById('charges1').style.display = "none";
				document.getElementById('charges2').style.display ="none";
				document.getElementById('charges3').style.display = "inline-block";
				
				
				
				chargeType = 3;
				LoadProgramFundsByOffice();
			}
		}else{
			if(id == "optMultipleSource"){
				
				document.getElementById('chargesPY').style.display = "table-row";
				document.getElementById('charges3').style.display = "inline-block";
				chargeType = 3;
				LoadProgramFundsByOffice();
			}else{
				me.checked = false;
				msg("Please select respo center in step 5.");		
			}
		}
		
	} 
	
	var codes = '';
	var amountValues = '';
	function addMultipleCharge(me){
		var parent = me.parentNode.parentNode;
		var code = parent.children[0].children[0].value;
		var amount = parent.children[1].children[0].value;
		if(code != 0){
			if(amount){
				if(amount > 0){
					var n = codes.search(code);
					if(n == -1){
						codes += code + '~';
						amountValues += amount + '~';
						var sheet = '<div style = "border-bottom:1px solid rgb(232, 235, 235);"><span class = "label17" style ="width:200px;">' + code + '</span>';
						sheet+= '		 <span class = "label17" style ="width:200px;">' + amount + '</span>';
						sheet += '		 <div class = "label18" onclick ="removeCharge(this)"></div></div>';
						document.getElementById('chargesContainer').innerHTML  += sheet;	
						
					}else{
						msg("You already selected <font color = 'red'><b>" + code + "</b></font> account code. Please review your entry.");
					}
				}else{
					msg("Should be greater than zero.");
				}
			}else{
				document.getElementById('amountPYMultiple').style.backgroundColor = "rgb(250, 152, 158)";
				msg("Please input amount.");
			}
			
		}else{
			
			if(parent.children[0].children[0].value.length == 0){
				var parent  = document.getElementById('tdAccountCodesPYMultiple');
				parent.children[0].style.backgroundColor = "rgb(250, 152, 158)";
				msg("Please select accound code.");
			}else{
				msg("Please select respo center in step 5.");
			}
		}
	}
	var funds1 = '';
	var codes1 = '';
	var amountValues1 = '';
	
	function createAmount(fund,code,amount){
		var sheet = '<div style = "border-bottom:1px solid rgb(232, 235, 235);">';
					sheet += '<span class = "data1" style ="font-size:18px;width:100px;text-align:right;display:inline-block;">' + fund + '</span>'
					sheet += '<span class = "data1" style ="font-size:18px;width:200px;text-align:right;display:inline-block;">' + code + '</span>'
					sheet+= '<span class = "data1" style ="font-size:18px;width:200px;text-align:right;padding-right:20px;display:inline-block;">' + numberWithCommas(amount) + '</span>';
					sheet += '<div class = "label18" onclick ="remover(this)"></div></div>';
		return sheet;
	}
	function addMultipleSource(me){
		var arr = document.getElementById("tdSource1").children[0].value.split("~");
		var fund  = arr[0];
		var subc = arr[1];
		var code  = document.getElementById("tdSource2").children[0].value;
		var amount  = parseFloat(document.getElementById("source3").value);
		
		if(document.getElementById("pyTotal").innerHTML == ""){
			var total = 0;
		}else{
			var total = parseFloat(document.getElementById("pyTotal").innerHTML.replace(/,/g,""));
		}
		if(fund != 0){
			if(code != 0){
				if(amount){
					if(amount > 0){
						var row = document.getElementById('chargesContainer1').children.length;
						if(row > 0){
							var div = document.getElementById('chargesContainer1');
							var addend = fund + code;
							var hit = 0;
							for(var i = 0; i < row; i++){
								var f =  div.children[i].children[0].textContent;
								var c =  div.children[i].children[1].textContent;
								var exist = f + c;
								if(addend == exist){
									hit = 1;
									var sheet =     '<span class = "data1" style ="font-size:18px;width:100px;text-align:right;display:inline-block;">' + fund + '</span>'
										sheet += '<span class = "data1" style ="font-size:18px;width:250px;text-align:right;display:inline-block;">' + code + '</span>'
										sheet +=  '<span class = "data1" style ="font-size:18px;width:200px;text-align:right;display:inline-block;padding-right:20px;">' + numberWithCommas(amount) + '</span>';
										sheet += '<div class = "label18" onclick ="remover(this)"></div>';
										div.children[i].innerHTML  = sheet;
										exist = '';	
								}
							}
							if(hit == 0){
								document.getElementById('chargesContainer1').innerHTML  += createAmount(fund,code,amount);	
							}
							viewSubGroup(fund,subc); //para sa sub program
						}else{
							
							document.getElementById('chargesContainer1').innerHTML  += createAmount(fund,code,amount);	
							document.getElementById("pyTotal").innerHTML = numberWithCommas(sumThis('chargesContainer1'));
							viewSubGroupOneRow(fund,subc);
						}
						document.getElementById("pyTotal").innerHTML = numberWithCommas(sumThis('chargesContainer1'));
						
						
					}else{
						msg("Should be greater than zero.");
					}
				}else{
					document.getElementById('source3').style.backgroundColor = "rgb(250, 152, 158)";
					msg("Please input amount.");
				}
				
			}else{
				document.getElementById("tdSource2").children[0].style.backgroundColor = "rgb(250, 152, 158)";
				msg("Please select account code.");
			}
		}else{
			document.getElementById("tdSource1").children[0].style.backgroundColor = "rgb(250, 152, 158)";
			msg("Please select source of fund.");
		}
	}
	var subMainCode = 0;
	function viewSubGroup(programCode,subc){
		if(document.getElementById("subPa").style.display == "none"){
			if(subc == 1){
				document.getElementById("subPa").style.display = "table-row";
				document.getElementById("subPb").style.display = "table-row";
				// getSubCode(programCode);
				subMainCode = programCode;
			}
		}
	}
	function viewSubGroupOneRow(programCode,subc){
		if(subc != 1){
			document.getElementById("subPa").style.display = "none";
			document.getElementById("subPb").style.display = "none";
			subMainCode = 0;
		}else{
			document.getElementById("subPa").style.display = "table-row";
			document.getElementById("subPb").style.display = "table-row";
			// getSubCode(programCode);
			subMainCode = programCode;
		}
	}
	function getSubCode(programCode){
		var queryString = "?getSubCode=1&subCode=" + programCode;
		var container = document.getElementById('subCodeSelect');
		ajaxGetAndConcatenate(queryString,processorLink,container,"getSubCode");
	}
		
	function sumThis(name){
		var parent = document.getElementById(name);
		var row = parent.children.length;
		var total = 0;
		for(var i = 0 ; i < row; i++){
			var amount = parent.children[i].children[2].textContent.replace(/,/g,"");
			total = total + parseFloat(amount);
		}
		return total;
	}
	function removeCharge(me){
		var parent = me.parentNode.parentNode;
		var parentDiv = me.parentNode;
		var code = parentDiv.children[0].textContent;
		var amount = parentDiv.children[1].textContent;
		codes = codes.replace(code + '~','');
		amountValues = amountValues.replace(amount + '~','');
		parent.removeChild(parentDiv);
	}
	function removeCharge1(me){
		var parent = me.parentNode.parentNode;
		var parentDiv = me.parentNode;
		
		var fund = parentDiv.children[0].textContent;
		var code = parentDiv.children[1].textContent;
		var amount = parentDiv.children[2].textContent;
		
		funds1 = funds1.replace(fund + '~','');
		codes1 = codes.replace(code + '~','');
		amountValues1 = amountValues.replace(amount + '~','');
		parent.removeChild(parentDiv);
	}
	function remover(me){
		
		var parent = me.parentNode.parentNode;
		var parentDiv = me.parentNode;
		
		var fund = parentDiv.children[0].textContent;
		var code = parentDiv.children[1].textContent;
		var amount = parseFloat(parentDiv.children[2].textContent.replace(/,/g,""));
		var total = parseFloat(document.getElementById("pyTotal").textContent.replace(/,/g,""));
		total =  total - amount;
		if(total == 0){
			total = '';
		}
		document.getElementById("pyTotal").innerHTML =total;
		parent.removeChild(parentDiv);
		findSubCode();	
	}
	function findSubCode(){
		//subMainCode global for sub
		var dPar = document.getElementById('chargesContainer1');
		var dLength = dPar.children.length;
		var hit = 0;
		for(var i = 0 ; i < dLength; i++){
			var x = dPar.children[i].children[0].textContent;
			if(x == subMainCode){
				hit =1;
			}
		}
		if(hit == 0){
			document.getElementById("subPa").style.display = "none";
			document.getElementById("subPb").style.display = "none";
			subMainCode = 0;
		}
	}
	
	
	function selectBlank(msg){
		var sheet = '<select class = "select2 checkPY" style = "width:300px;">';
			sheet += '<option value = "0">' + msg + '</option>';
			sheet += '</select>';
		return sheet;	
	}

	//-------------------------------------------------------------------------------PO calculate
	
	function selectCalculatePO(me){
		if(me.checked == true){
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "inherit";
			var total = parent.children[7].children[0].textContent.replace(/,/g,"");
			if(total){
				var gTotal = parseFloat(document.getElementById('selectedPOTotal').textContent.replace(/,/g,"")) + parseFloat(total);
				document.getElementById('selectedPOTotal').innerHTML = gTotal.toFixed(2);
			}
		}else{
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "rgb(229, 228, 228)";
			var total = parent.children[7].children[0].textContent.replace(/,/g,"");
			
			if(total){
				var gTotal = parseFloat(document.getElementById('selectedPOTotal').textContent.replace(/,/g,"")) - parseFloat(total);
				document.getElementById('selectedPOTotal').innerHTML = gTotal.toFixed(2);
			}
		}
	}
	function calculateOnchangeSelectedPO(me){
		var parent = me.parentNode.parentNode;
	
		var qty = parent.children[2].children[0].value;
		var cost = parent.children[6].children[0].value;
		var total =  parseFloat(qty * cost);
		var totalContainer = parent.children[7].children[0];
		
		totalContainer.innerHTML  = total;
		
		//var totals = parent.children[7].innerHTML;
		
		var trLength = parent.parentNode.children.length;
		
		var gTotal = 0;
		for(var i = 1 ; i < trLength; i++){
			var check = parent.parentNode.children[i].children[0].children[0].checked;
			if(check == true ){
				var total = parent.parentNode.children[i].children[7].children[0].textContent.replace(/,/g,"");
				gTotal = parseFloat(gTotal) + parseFloat(total);
			}
		}
		
		document.getElementById('selectedPOTotal').innerHTML = gTotal.toFixed(2);	
	}
	//-------------------------------------------------------------revision sa selection
	function selectCalculateAddPR(me){	
		var b = me.parentNode.parentNode.parentNode;
		//var tr = b.children;
		var totality = b.children[b.children.length-1].children[0].children[0];
		if(me.checked == true){
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "rgb(206, 215, 218)";//  "rgb(239, 242, 244)";
			var total = parent.children[8].children[0].value.replace(/,/g,"");
			if(total){
				//var gTotal = parseFloat(document.getElementById('totalAmountItems').value.replace(/,/g,"")) + parseFloat(total);
				//document.getElementById('totalAmountItems').value = numberWithCommas(gTotal.toFixed(2));
				var gTotal = parseFloat(totality.value.replace(/,/g,"")) + parseFloat(total);
				totality.value = numberWithCommas(gTotal.toFixed(2));
			}
		}else{
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "inherit";
			var total = parent.children[8].children[0].value.replace(/,/g,"");
			if(total){
				//var gTotal = parseFloat(document.getElementById('totalAmountItems').value.replace(/,/g,"")) - parseFloat(total);
				//document.getElementById('totalAmountItems').value = numberWithCommas(gTotal.toFixed(2));
				var gTotal = parseFloat(totality.value.replace(/,/g,"")) - parseFloat(total);
				totality.value = numberWithCommas(gTotal.toFixed(2));
			}
		}
	}
	
	function calculateAddPR(me){
		
		var parent = me.parentNode.parentNode;
		
		var qty = parent.children[4].children[0].value;
		var cost = parent.children[6].children[0].value.replace(/,/g,"");
		var total =  parseFloat(qty * cost);
		var totalContainer = parent.children[8].children[0];
		totalContainer.value  = numberWithCommas(total.toFixed(2));
		var trLength = parent.parentNode.children.length;
		
		inputTotals(parent.parentNode,trLength);
	
	}
	function inputTotals(parent,length){
		var g = 0;
		for(var i = 1 ; i < length-1; i++){
			var check = parent.children[i].children[3].children[0].checked;
			if(check){
				var  total =  parseFloat(parent.children[i].children[8].children[0].value.replace(/,/g,""));
				g = g + total;
			}
		}
		document.getElementById('totalAmountItems').value = numberWithCommas(g.toFixed(2));
	}
	
	
	//PR------------------------------------------------------------------------------------------------------------------------------
	function loadCategoryList(){
		loader();
		var queryString = "?LoadCategoryList=1";
		var container = document.getElementById('divCategoryList');
		ajaxGetAndConcatenate(queryString,processorLink,container,"LoadCategoryList");
	}
	function checkedCategories(me,row){
		
		var tr = me.children;
		var category = "";
		for(var i = 0; i < tr.length; i++){
			var inputs = tr[i].children[0].children[0];
			if(inputs.checked == true){
				if(row >= 0 ){
					if(i == row){
						tr[i].style.backgroundColor = "rgb(197, 220, 238)";
						tr[i].style.fontWeight = "bold";
						category += tr[i].children[1].textContent + "~!~" ;
					}else{
						inputs.checked = 0 ;
						tr[i].style.backgroundColor = "transparent";
					}
				}else{
					tr[i].style.backgroundColor = "rgb(197, 220, 238)";
					tr[i].style.fontWeight = "bold";
					category += tr[i].children[1].textContent + "~!~" ;
					
				}
			}else{
				tr[i].style.backgroundColor = "transparent";
				tr[i].style.fontWeight = "normal";
			}
		}
		return category;
	}
	function clearRadios(me){
		var parent = document.getElementById(me);
		var inputs = parent.getElementsByTagName("input");
		for(var i = 0; i < inputs.length; i++){
			inputs[i].checked = 0 ;
			inputs[i].parentNode.parentNode.style.backgroundColor ="transparent";
		}
	}
	
	
	//PO------------------------------------------------------------------------------------------------------------------------------
	function loadCategoryListPO(){
		loader();
		var queryString = "?LoadCategoryList=1";
		var container = document.getElementById('divCategoryListPO');
		ajaxGetAndConcatenate(queryString,processorLink,container,"LoadCategoryList");
	}
	//SelectItemsByPRRelease(document.getElementById("selectTrackingPR"));
	function SelectItemsByPRRelease(me){
		var trackingNumber =  me.value;

		loader();
		var queryString = "?SelectPrReleased=1&trackingNumber=" + trackingNumber;
		var container = document.getElementById('tdReviewContentPO');
		ajaxGetAndConcatenate(queryString,processorLink,container,"SelectPrReleased");
		
	}
	
	//------------------------------------------------------------------------------------------------------------------------------ for 2018
    var qtr;
    //clickOptionQuarter(document.getElementById('opt1st'));
    function clickOptionQuarter(me){
        	document.getElementById("trSelectCategory").style.display = "block";
        	//hide
        	document.getElementById('tdReviewContentPR').innerHTML = "";
        	document.getElementById("trPR1").style.display = "none";
        	
        	document.getElementById("trPR2").style.display = "none";
		document.getElementById("trPR3").style.display = "none";
        	
        	qtr = me.id;
		loader();
		var queryString = "?loadPPMPCategoryList=1&qtr=" + qtr;
		var container = document.getElementById('divCategoryList');
		ajaxGetAndConcatenate1(queryString,processorLink,container,"loadPPMPCategoryList");
		
	}
	function absoluteHeader(trHeader,container,className){
		var tr  = document.getElementById(trHeader);
		var tr1  = document.getElementById(trHeader);
		var parent = tr.parentNode;
		var sheet  = '<table style = "padding:0; border-spacing:0;" border ="0"><tr id = "dyTr">';
		      sheet += tr.innerHTML; 
		      sheet += '</tr></table>';
		parent.removeChild(tr);
		container.innerHTML += sheet;
		var tr =parent.children[1];
		for(var i = 0 ; i < tr.children.length; i++){
			var oWidth =  tr.children[i].clientWidth;
			document.getElementById('dyTr').children[i].style.width =  (oWidth - 20) + 'px';
		}	
	}
	var caty = '';
	function getCategoryItems(me){
		var row  = me.parentNode.parentNode.rowIndex;
		var parent = me.parentNode.parentNode.parentNode;
		caty = checkedCategories(parent,row).replace("~!~","");
		document.getElementById("trPR1").style.display = "block";
		document.getElementById("trPR2").style.display = "block";
		document.getElementById("trPR3").style.display = "table-row";
		loader();
		var queryString = "?GetCategoryItems2018=1&category=" + caty + "&qtr=" + qtr;
		var container = document.getElementById('tdReviewContentPR');
		ajaxGetAndConcatenate1(queryString,processorLink,container,"GetCategoryItems");
	}
	function selectCashAdvance(me){
		
		clearCashAdvance();
		var arr = me.value.split("@");
		if(arr.length > 1){
			var tn = arr[0];
			var amount  = numberWithCommas(arr[1]);
			document.getElementById("cashAdvanceTN").value = tn;
			document.getElementById("cashAdvanceAmount").value = amount;
		}
		
	}
	function clearCashAdvance(){
		
		
		document.getElementById("cashAdvanceRefund").value = "" ;
		document.getElementById("cashAdvanceReimbursed").value = "" ;
		document.getElementById("cashSpent").value = "";
		document.getElementById("cashAdvanceTN").value = "";
		document.getElementById("cashAdvanceAmount").value = "";
		document.getElementById("refundOR").value = "";
		
		
		document.getElementById("trRefund").style.display = "none";
		document.getElementById("trRefOR").style.display = "none";
		document.getElementById("trReim").style.display = "none";
		
	}
	function keyUpSpent(me){
		var amount = me.value.replace(/,/g,"");
		var reim = '';
		var cashAdvance = document.getElementById("cashAdvanceAmount").value.replace(/,/g,"");
		if(cashAdvance > 1){
			var refund =  round2(parseFloat(cashAdvance) - parseFloat(amount));
			if(amount != ''){
				
				
				if(refund < 0){
					reim = numberWithCommas(refund.replace(/-/g,"")); 
					refund = '';
					
					document.getElementById("trRefund").style.display = "none";
					document.getElementById("trRefOR").style.display = "none";
					document.getElementById("trReim").style.display = "table-row";
					
				}else if(refund == 0){
					refund = '';
					reim = '';
					document.getElementById("trRefund").style.display = "none";
					document.getElementById("trRefOR").style.display = "none";
					document.getElementById("trReim").style.display = "none";
				}else{
					refund = numberWithCommas(refund);
					document.getElementById("trRefund").style.display = "table-row";
					document.getElementById("trRefOR").style.display = "table-row";
					document.getElementById("trReim").style.display = "none";
				}
				
				document.getElementById("cashAdvanceRefund").value = refund;
				document.getElementById("cashAdvanceReimbursed").value = reim ;
				me.value = numberWithCommas(amount);
			}
		}else{
			alert("Please select cash advance.");
			me.value = "";
		}
	}
	function saveLQ(trackType){
		
		var arr = document.getElementById("lqDoctrackSelect").children[0].value.split("@");
		var caTN = arr[0];
		var caAmount = arr[1];
		var claimant = arr[2];	

		var caRefund = document.getElementById("cashAdvanceRefund").value.replace(/,/g,"");;
		var caReim = document.getElementById("cashAdvanceReimbursed").value.replace(/,/g,"");
		var caSpent = document.getElementById("cashSpent").value.replace(/,/g,"");
		var or = encodeURIComponent(document.getElementById("refundOR").value);
		var oops = 0;
				
		if(caRefund > 1){
			if(or == ''){
				oops = 1;
			}
		}
		if(caTN == ''){
			oops = 2;
		}
		if(caSpent == ''){
			oops = 3;
		}
		if(oops == 0){
			var queryString = "?saveTrackingLQ=1&trackType="  + trackType + 
							"&caTN=" + caTN + 
							"&caAmount=" + caAmount +
							"&caRefund=" + caRefund +
							"&caReim=" + caReim +
							"&caSpent=" + caSpent +
							"&or=" + or + 
							"&claimant=" + claimant;
			var container = document.getElementById('divNewTrackingNumber');
		
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"saveTrackingLQ");
		}else if(oops == 1){
			alert("Please enter official receipt details.");
		}else if(oops == 2){
			alert("Please select cash advance.");
		}else if(oops == 3){
			alert("Please enter cash spent.");
		}
		
	}
	
	function selectSupplier(me){
		var queryString = "?loadSupplierAdd=1";
		var container = document.getElementById('tdMessage');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadSupplierAdd");
	}
	function clickSupplier(me){
		
		var supplier = me.value;
		
		document.getElementById('supplierName').value = supplier;
		closeAbsolute(me);
	}
	function selectAll(me){
		var b = me.parentNode.parentNode.parentNode;
		var tr = b.children;
		for(var i = 1; i < tr.length-1; i++){
			var td = tr[i];
			if(td.children.length == 9){
				var newCheck = me.checked;
				var oldCheck = td.children[3].children[0].checked;
				if(newCheck != oldCheck){
					td.children[3].children[0].click();
				}
			}			
		}
	}

	//------------------------------------------------------------------------------------------------------------Retention
	// getPODetailsForRET(document.getElementById('searchPORet'));
	function getPODetailsForRET(field) {
		var tn = field.value;
		var queryString = "?getPODetailsForRET=1&trackingNumber="+tn;
		var container = "";

		loader();
		ajaxGetAndConcatenate(queryString, processorLink, container, "getPODetailsForRET");
	}

	function addMultipleRET(record) {
		var invNum = record[0];
		var invDate = record[1];
		var amount = record[2];
		var poNum = record[3];
		var trackingNumber = record[4];
		var amountPer = amount*0.01;
		var claimant = record[5];

		var oneTimeAlert = "Missing :";
		var alertF = 0;
		if(invNum === "" || invNum === null){
			invNum = "";
		}
		if(invDate === "" || invDate === null){
			invDate = "";
		}

		var chker = checkExistingRetention(trackingNumber);
		
		if(chker == 0){
			var trString ="<tr>"
						+"<td style='text-align:left;padding-left:10px;'>"+trackingNumber+"</td>"
						+"<td style='text-align:left;padding-left:10px;'>"+poNum+"</td>"
						+"<td style='cursor:pointer;'>"
						+"<input type='text' style='font-family:mainFont;font-size:16px;border:0px;background-color:transparent;padding-left:10px;' onclick='changeToEditable(this)' onkeydown='keypressAndWhatClear(this,event,updateRetElem,1);setUpdateInvFlag(this);' value='"+invNum+"' readonly>"
						+"</td>"
						+"<td style='cursor:pointer;'>"
						+"<input type='text' style='font-family:mainFont;font-size:16px;border:0px;background-color:transparent;padding-left:10px;' onclick='changeToEditable(this)' onkeydown='keypressAndWhatClear(this,event,updateRetElem,1);setUpdateInvFlag(this);' value='"+invDate+"' readonly>"
						+"</td>"
						+"<td style='text-align:right;padding-right:5px;'>"+numberWithCommas(amount)+"</td>"
						+"<td style='text-align:right;padding-right:5px;' style='cursor:pointer;'>"
						+numberWithCommas(amountPer.toFixed(2))
						+"</td>"
						+"<td style='text-align:center;'>"
						+"<i style='cursor:pointer;font-size:24px;font-weight:bold;color:red;' onclick='removeRetention(this)'>&times;</i>"
						+"<input type='hidden' value='0'>"
						+"</td>"
						+"</tr>";

			
			var table = document.getElementById("retentionList");
			var tbody = table.children[1];
			// insertAdjacentHTML ang gamit kay i-reload niya ang uban fields kung innerHTML+= ang gamit.
			tbody.insertAdjacentHTML('beforeend', trString);
			updateRetTotal(amountPer.toFixed(2));
			var claimantRET = document.getElementById('claimantRET');
			claimantRET.value = claimant;
		} else {
			alert(trackingNumber + " is already in the list.");
		}
	}

	function checkExistingRetention(trackingNumber){
		var table = document.getElementById('retentionList');
		var tbody = table.children[1].children;

		for(var i=0; i < tbody.length; i++){
			if(tbody[i].children[0].innerText == trackingNumber){
				return 1;
			}
		}
		return 0;
	}

	function removeRetention(elem) {
		var parent = elem.parentElement.parentElement.parentElement;
		var row = elem.parentElement.parentElement;
		updateRetTotal("-"+row.children[5].innerText)
		parent.removeChild(row);
	}

	function changeToEditable(elem){
		elem.borderBottom = "1px dashed black";
		elem.readOnly = false;
	}

	function updateRetElem(elem){
		elem.readOnly = true;
	}

	function setUpdateInvFlag(me){
		var td = me.parentElement.parentElement.children[6].children;
		var input = td[1];
		input.value = 1;
	}

	function updateRetTotal(amount){
		var retTotalElem = document.getElementById('retTotal');
		var retTotal = parseFloat(retTotalElem.innerText.replace(/,/g,""));
		
		amount = parseFloat(amount.replace(/,/g,""));
		
		var tempTotal = retTotal + amount;
		retTotalElem.innerHTML = numberWithCommas(tempTotal.toFixed(2));

		var totalTr = document.getElementById('totalTr');
		var saveTr = document.getElementById('saveTr');
		if(tempTotal > 0){
			totalTr.style.display = "table-row";
			saveTr.style.display = "table-row";
		}else{
			totalTr.style.display = "none";
			saveTr.style.display = "none";
		}
	}

	function saveRET(tType){
		var table = document.getElementById('retentionList');
		var tbody = table.children[1].children;
		var saveFlag = 0;
		var tnPartner = "";

		var getData = [];
		for(var i=0; i < tbody.length; i++){
			var td = tbody[i].querySelectorAll('td');

			var trackingNumber = td[0].innerText;
			var poNum = td[1].innerText;
			var invNum = td[2].children[0].value;
			var invDate = td[3].children[0].value;
			var amountPer = parseFloat(td[5].innerText.replace(/,/g, ""));
			var updateInvFlag = td[6].children[1].value;

			if(invNum == "" || invDate == "") {
				alert("Check for missing details.");
				saveFlag = 1;
				break;
			} else {
				getData.push(trackingNumber+"!"+invNum+"!"+poNum+"!"+invDate+"!"+amountPer+"!"+updateInvFlag);
			}
		}

		if(tbody.length == 1) {
			tnPartner = trackingNumber;
		}else if(tbody.length > 1){
			tnPartner = "";
		}

		if(saveFlag == 0) {
			var getString = getData.join("~");
			var retGross = parseFloat(document.getElementById('retTotal').innerText.replace(/,/g,"")); 
			var fund = "General Fund";
			var claimant = document.getElementById('claimantRET').value;

			var queryString = "?saveTrackingRET=1&retDetails="+getString+"&gross="+retGross+"&fund="+fund+"&claimant="+claimant+"&tnPartner="+tnPartner;
			var container = document.getElementById('divNewTrackingNumber');

			loader();
			ajaxGetAndConcatenate(queryString, processorLink, container, "saveTrackingRET");
		}
	}

	function clearFieldsRET(){
		var searchPORet = document.getElementById('searchPORet');
		var table = document.getElementById("retentionList");
		var tbody = table.children[1];
		var retGross = document.getElementById('retTotal'); 
		var claimant = document.getElementById('claimantRET');

		searchPORet.value = "";
		tbody.innerHTML = "";
		retGross.innerText = "0.00";
		claimant.value = "";
	}

	
	
</script>


