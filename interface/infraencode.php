<style>
	#infraOutContainer{
		background-color:white;
		display:inline-block;
		margin:0 auto;
		box-shadow:0px 0px 4px 1px grey;
		box-shadow:0px 0px 16px 3px grey;
	}
	#infraSelectType{
		width:100%;
	}

	/*----------RADIO1----------*/
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
	/*----------RADIO1----------*/

	.infraPYSpan{
		display:inline-block;
		letter-spacing:1px;
		font-weight: bold;
		border:0px;
		font-family:Oswald;
		font-size:20px;
		width:205px;
		text-align:right;
		border-bottom:1px dashed black;
	}
	.numbInfra{
		font-size: 24px;
	}

	#ipbInfraTNDetails {
		margin:0px auto;
		font-family:NOR;
	}
	#ipbInfraTNDetails th {
		padding:2px 5px;
		background-color:rgb(241, 242, 242);
		border:1px solid white;
		font-size:14px;
		white-space:nowrap;
	}
	#ipbInfraTNDetails td {
		padding:2px 5px;
		border:1px solid white;
		border-bottom:1px solid rgb(216, 219, 221);
		font-size:14px;
	}
	#ipbInfraTNDetails tr:nth-child(odd) {
		background-color:rgb(246, 250, 250);
	}
	#ipbInfraTNDetails tr:nth-last-child(2) td {
		border-bottom:1px solid black;
	}
	#ipbInfraTNDetails tr:last-child td {
		background-color:white;
		border:0px;
		font-weight:bold;
	}
	
</style>

<div style = "padding:20px;background-color:white;display:inline-block;">
	<div id  = "infraOutContainer" style = "padding:40px; min-height:700px;">
		<table border="0" id="infraMainContainer" style="margin:0px auto; min-width: 655px;">
			<tr>
				<td>
					<!-- SELECT TRACKING TYPE -->
					<table id = "infraSelectType" border ="0" style = "padding-bottom:0px; width: 100%;">
						<tr>
							<td colspan="2" style = "text-align:right;">
								
								<span class =  "data1" style = "" >Tracking Number</span>
								<div id = "infraTrackingNumber" style = "font-size:30px;text-align:right;font-weight: bold;" class = "data1">0000-0</div>
							</td>
						</tr>
						<tr>
							<td colspan="4" style = "padding:10px 0px;"><span class = "numbInfra">1</span><span class = "numberField" >Select Tracking Type</span></td>
						</tr>
						<tr >	
							<td colspan="4" style = "background-color:rgb(232, 239, 239);border-bottom:1px solid rgb(219, 229, 235); -webkit-touch-callout: none; -webkit-user-select: none; -khtml-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none;">
								<table style = "margin:0 auto;border-spacing:0;padding:10px 20px; border-spacing: 20px 0px;" border = "0">
									<tr>	
										<td  style = "">	
											<input value="" type="radio" name="selectType" id="optNF"  class="radio1" onclick = "infraClickOption(this)"/>
											<label  for="optNF">Infra Preparation Tracking</label>
										</td>
										<td style = "">	
											<input value="" type="radio" name="selectType" id="optIP" class="radio1" onclick = "infraClickOption(this)"/>
											<label  for="optIP">Infra Payment</label>
										</td>
										<td style = "">	
											<input value="" type="radio" name="selectType" id="optIPb" class="radio1" onclick = "infraClickOption(this)"/>
											<label  for="optIPb">Batch Payment</label>
										</td>
										<td style = "">	
											<input value="" type="radio" name="selectType" id="optRETIN" class="radio1" onclick = "infraClickOption(this)"/>
											<label  for="optRETIN">Retention</label>
										</td>
									</tr>
								</table>	
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr id = "trInfra1" style="display:none;">
				<td style="padding-top: 10px;">
					<!-- CREATE NF TRACKING -->
					<table style="padding-top:0;width:100%;" border = "0">
						<tr>
							<td >
								<span class = "numbInfra">2</span><span class ="numberField">Select Office</span>
							</td>
							<td  style="">
								<select class = "data2" id = "infraSelectOffice" onchange = "fetchNewTrackingInfra(this)">
								</select>
							</td>
						</tr>
						<tr>
							<td style="padding-top: 5px;">
								<span class = "numbInfra">3</span><span class ="numberField">Select Project</span>
							</td>
							<td style="padding-top: 5px;">
								<select class = "data2" id = "infraSelectProjects" onchange = "selectInfraProject(this)">
									<option>&nbsp;</option>
								</select>
							</td>
						</tr>
						<tr id  = "infraTRdetails" style="font-family: Oswald;display:none;">
							<td ></td>
							<td style ="font-size:18px;">
								<div style="width: 490px;margin:0 auto; margin-top:15px;">
									<div style="color:grey;text-align: center;font-weight: bold;font-size: 12px;letter-spacing: 1px;">PROJECT DETAILS</div>
									<div  style="font-weight: bold;"><span id = "infraFund"></span> <span id = "infraFundYear"></span> </div>
									<div id = "infraCode" style="display: inline-block;font-weight: bold;color:rgb(35, 116, 157);"></div>
										<div id = "infraSubDescription" style="display: inline-block;font-weight: bold;color:rgb(35, 116, 157);padding-left:5px;color: black;"></div>
									<div id = "infraName" style="padding-left: 10px;"></div>
									<div style="padding-left: 10px;"><span style = "display:none;" id = "infraSubcode"></span>  </div>
									
									<div id = "infraAccountCode" style="font-weight: bold;margin-top: 10px;"><span></span></div>
									<div id = "infraAccountName" style="padding-left: 10px;"></div>
									<div id = "infraCost" style="border-top:1px solid silver;text-align:right;color:red;letter-spacing:1px;font-weight: bold;margin-top:5px;"></div>
									<div id = "infraProjectId" style="display:none;" ></div>
								</div>
							</td>
						</tr>
						<tr id  = "infraTRBatchNum" style="font-family: Oswald;display:none;">
							<td>
								<span class = "numbInfra">4</span><span class ="numberField">Batch No.</span>
							</td>
							<td  style="">
								<input type="text" class = "data2" id = "infraBatchNum">
							</td>
						</tr>
						<tr id  = "infraTRLocation" style="font-family: Oswald;display:none;">
							<td>
								<span class = "numbInfra">5</span><span class ="numberField">Location</span>
							</td>
							<td  style="">
								<input type="text" class = "data2" id = "infraLocation">
							</td>
						</tr>
						<tr id  = "infraTRduration" style="font-family: Oswald;display:none;">
							<td style ="padding-right:5px;">
								<span class = "numbInfra">6</span><span class ="numberField">Duration in days</span>
							</td>
							<td  style="">
								<input type="text" class = "data2" id = "infraDuration">
								
							</td>
						</tr>
						<tr id  = "infraTRsave" style = "display:none;">
							<td></td>
							<td style="padding-top: 20px;text-align: center;">
								<div class = "button1" style = "padding:5px 20px;"onclick = "saveTrackingInfra()">Save</div><br/>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr id = "trInfra2" style="display:none;" >
				<td style="padding-top: 10px;">
					<!-------------------INP-->	
					<table style="padding-top:0;width:100%;" border = "0">
						<tr>
							<td style = "width:1px; padding-right:10px; vertical-align:top;"><span class = "numbInfra">2</span><span class ="numberField">Select&nbsp;Tracking</span></td>
							<td>
								<select class = "data2" id="inSelectTracking"  onchange="fetchINTNDetails(this)"></select>
								<div style="font-size:0px; padding-top:5px;">
									<input type="checkbox" id="chkboxMXInfra" style="margin:0px; padding:0px; cursor:pointer; line-height:8px;" onclick="getMXInfras(this)">
									<span style="font-size:14px; margin-left:3px;">Check this box for transactions with different source of funds.</span>
								</div>
							</td>
						</tr>
						<tr>
							<td style="padding:10px 0px;"></td>
						</tr>
						<tr id="inSelectProjDetails" style="display: none;">
							
							<td colspan="2" style="border:1px solid silver;padding:15px;">
								<table border="0" style="width:100%; border-spacing:0px;line-height:18px; font-family: NOR; font-size:18px;">
									
									
									<tr>
										<td colspan="2">
											<table border ="0" style ="border-collapse:collapse;">
												<tr>
													<td style ="color:rgb(41, 111, 152);"><span style = "color:grey;"class = "labelProjectNumber">1</span>TN</td>
													<td id="inTN" style ="border-bottom:1px solid rgb(216, 219, 221);font-weight: bold;color:orange;font-size: 20px;"></td>
												</tr>
												<tr>
													<td style ="color:rgb(41, 111, 152);"><span style = "color:grey;"class = "labelProjectNumber">2</span>Contractor</td>
													<td id="inSelectClaimant" style ="border-bottom:1px solid rgb(216, 219, 221);"></td>
												</tr>
												<tr>
													<td style ="color:rgb(41, 111, 152);"><span style = "color:grey;"class = "labelProjectNumber">3</span>Project Name</td>
													<td id="infraPYName" style ="border-bottom:1px solid rgb(216, 219, 221);"></td>
												</tr>
												<tr>
													<td style ="color:rgb(41, 111, 152);"><span style = "color:grey;"class = "labelProjectNumber">4</span>Fund Year</td>
													<td id="infraPYfundYear" style ="border-bottom:1px solid rgb(216, 219, 221);"></td>
												</tr>
												<tr>
													<td style ="color:rgb(41, 111, 152);"><span style = "color:grey;"class = "labelProjectNumber">5</span>Fund</td>
													<td id="inSelectFund" style ="border-bottom:1px solid rgb(216, 219, 221);"></td>
												</tr>
												<tr>
													<td style ="color:rgb(41, 111, 152);"><span style = "color:grey;"class = "labelProjectNumber">6</span>Project Code</td>
													<td id="infraPYCode" style ="border-bottom:1px solid rgb(216, 219, 221);"></td>
												</tr>
												<tr>
													<td style ="color:rgb(41, 111, 152);"><span style = "color:grey;"class = "labelProjectNumber">7</span>Expense&nbsp;Account</td>
													<td id="infraPYAccountCode" style ="border-bottom:1px solid rgb(216, 219, 221);"></td>
												</tr>
												<tr>
													<td style ="color:rgb(41, 111, 152);"><span style = "color:grey;"class = "labelProjectNumber">8</span>Expense Title</td>
													<td id="infraPYAccountName"style ="border-bottom:1px solid rgb(216, 219, 221);"></td>
												</tr>
												<tr style="display:none;">
													<td style ="color:rgb(41, 111, 152);"></td>
													<td id="infraPYBatchNumber" style ="border-bottom:1px solid rgb(216, 219, 221);"></td>
												</tr>
											</table>
											
										</td>
										
									</tr>
									<tr>
										<td colspan="2" style= "padding-bottom: 15px;">
											<table style = "margin:0 auto; margin-right: 0px;padding:0;text-align: right;font-weight: bold;border-spacing: 0;font-family: NOR;" border = "0">
												<tr>
													<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Current Progress</td>
													<td  style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;color:green;font-size:22px;padding-right:5px;"><span id="infraPYProgress">0.00</span>%</td>
												</tr>
												<tr>
													<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Budget Cost</td>
													<td id="infraPYCost" style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
												</tr>
												<tr>
													<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Actual Cost</td>
													<td id="infraPYCostActual" style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
												</tr>
												<tr>
													<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Add. Fund due to Variation Order No. 1 (<span style ="color:green;font-size: 13px;font-weight: bold;">+</span>)</td>
													<td id="infraPYvariation" style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
												</tr>
												<tr>
													<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Unperformed Works (<span style ="color:red;font-size: 10px;font-weight: bold;">&#9472;</span>)</td>
													<td id="infraPYunperformed" style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
												</tr>
												
												<tr>
													<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Adjusted Actual Amount</td>
													<td id="infraPYadjusted" style = "font-size:18px;background-color:rgb(228, 232, 228); vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
												</tr>
												
												
												<tr>
													<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Retention(5%)</td>
													<td  id="infraPYRetention" style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;color:rgb(72, 169, 220);padding-left:10px;padding-right:5px;">00.0</td>
												</tr>
												<tr>
													<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Retention Covered</td>
													<td  id="infraPYRetentionCovered" style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;color:rgb(72, 169, 220);padding-left:10px;padding-right:5px;">0.00</td>
												</tr>
												<tr>
													<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Retention Balance</td>
													<td  id="infraPYRetentionBalance" style = "color:rgb(10, 78, 126); vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
												</tr>
												
											</table>
										</td>
									</tr>
									
									<tr>
										<td colspan="2" style="" id ="infraPaymentHistory">
				 							
										</td>
									</tr>
									
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:10px 0px;"></td>
						</tr>
						<tr>
							<td colspan="2" style="width:100px;padding:15px 0px;" >
								<table border = "0" style ="display:none1;width:100%;border-collapse: collapse;font-family: NOR;line-height: 14px;" id="infraPaymentBreakdown">
									<tr >
										<td style = "width: 20%"><span class = "numbInfra">3</span><span class ="numberField">Payment&nbsp;Type</span></td>
										<td >
											<select id = "infraPaymentType" class="data1" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;" onchange="return selectInfraType(this)">
												<option>&nbsp;</option>
											</select>
										</td>
										<td style ="text-align: right;width:80%;"><span class ="numberField" style ="margin-right:10px;">Period&nbsp;Covered</span><span class = "numbInfra">6</span></td>
										<td style = "padding-left:5px;"><input value ="" id = "infraPYfrom" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;" class="data1" placeholder ="Date From"></td>
										
									</tr>
									<tr>
										<td style = ""><span class = "numbInfra">4</span><span class ="numberField">Billed&nbsp;Progress</span></td>
										<td >
											<input  maxlength="5" id="infraProgress" class="data1" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;" onkeydown="return isAmount(this,event)" onkeyup="computerInfra()" readonly>
										</td>
										<td ></td>
										<td   style ="padding-left: 5px;">
											<input value ="" id = "infraPYto" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;"  class="data1" placeholder ="Date To" >
										</td>
										
									</tr>
									<tr>
										<td ><span class = "numbInfra">5</span><span class ="numberField">S-Curve</span></td>
										<td >
											<input maxlength="5" id="infrasCurve" class="data1" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;"  onkeyup="computerInfra()">
										</td>
										<td style ="text-align: right;"><span class ="numberField" style="margin-right: 10px;">Days Delayed</span><span class = "numbInfra">7</span></td>
										<td style="padding-left: 5px;">
											<input id = "infraPYDelay" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;" class="data1" disabled onkeydown="return isValueNumber(this,event)" onkeyup="computerInfra()">
											
										</td>
									</tr>
									<tr>
										<td ></td>
										<td >
										</td>
										<td style ="text-align: right;"><span class ="numberField" style="margin-right: 10px;white-space: nowrap; ">Accomplished to Expiry Date(%)</span><span class = "numbInfra">8</span></td>
										<td style="padding-left: 5px;">
											<input maxlength="5" id="infraLDpercentage" class="data1"  disabled onkeydown="return isAmount(this,event)"  style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;"  onkeyup="computerInfra()">
										</td>
									</tr>
									<tr >
										<td ></td>
										<td colspan="3">
											
										</td>
									</tr>
									<tr >
										<td style = "padding:10px;" colspan="4"></td>
									</tr>
									<tr style="background-color:rgb(248, 253, 228);">
										<td colspan  ="4" style = "padding:10px 10px;font-family: NOR;border-top:1px solid silver;border:1px solid rgb(190, 191, 133);">
											<table style = "margin:auto;margin-right:0px;text-align:right;border-collapse:collapse;width:100%;" border ="0">
												<tr>
													<td colspan="2" style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;font-weight: bold;padding-top:10px;">Progress Amount</td>
													<td  id = "infraPYgross" style = "line-height: 20px;font-size: 26px;font-weight: bold;width:1px;color:rgb(18, 96, 145);padding-top:10px;">0.00</td>
												</tr>
												<tr><td colspan="2" style = "padding:5px;padding-right:230px;font-size:14px;color:green;">LESS</td></tr>
												<tr>
													<td style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Unperformed Value</td>
													<td id = "infraUnperformedValue" style = "line-height: 20px;font-size: 22px;font-weight: bold;width:1%;color:red;">0.00</td>
												</tr>
												<tr>
													<td style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Liquidated Damages</td>
													<td id = "infraDamages" style = "line-height: 20px;font-size: 22px;font-weight: bold;width:1%;color:red;">0.00</td>
												</tr>
												<tr>
													<td colspan="2" style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;font-weight: bold;"></td>
													<td id = "infraNewGross" style = "line-height: 20px;font-size: 24px;font-weight: bold;">0.00</td>
												</tr>
												<tr><td colspan="2" style = "padding:5px;padding-right:230px;font-size:14px;color:green;">LESS</td></tr>
												
												<tr>
													<td style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Tax 2%</td>
													<td id = "infraTaxTwo" style = "line-height: 20px;font-size: 24px;font-weight: bold;width:1%;">0.00</td>
												</tr>
												<tr>
													<td style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Tax 5%</td>
													<td id = "infraTaxFive" style = "line-height: 20px;font-size: 24px;font-weight: bold;">0.00</td>
												</tr>
												<tr>
													<td colspan="3" style = "padding-top:5px">
														<div ></div>
													</td>
												</tr>
												<tr>
													<td colspan="2" style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Total Tax</td>
													<td id = "infraTax" style = "line-height: 20px;font-size: 24px;font-weight: bold;">0.00</td>
												</tr>
												<tr>
													<td colspan="2" style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Retention</td>
													<td id = "infraRetention" style = "line-height: 20px;font-size: 24px;font-weight: bold;">0.00</td>
												</tr>
												<tr>
													<td colspan="3" style = "padding-top:5px">
														<div style = "border-top:1px solid silver;"></div>
													</td>
												</tr>
												<tr>
													<td colspan="2" style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Total Deduction</td>
													<td id = "infraTotalDeduction" style = "padding-top:5px;color:grey; line-height: 20px;font-size: 24px;font-weight: bold;">0.00</td>
												</tr>
												
												<tr><td colspan="3">
													<div style = "border-top:4px double silver;margin-top:5px;"></div>
												</td></tr>
												
												<tr>
													<td colspan="2" style = "padding-right: 8px 5px;vertical-align: bottom;line-height: 15px;">Net Amount</td>
													<td id = "infraNet" style = "padding-right: 8px 5px;padding-left:10px; color:rgb(18, 96, 145); line-height: 20px;font-size: 28px;font-weight: bold;padding-top:5px;">0.00</td>
												</tr>
											</table>
										</td>
									</tr>
									
									<tr style="" id="infraPY2">
										<td colspan="4" style ="text-align: center;">
											<div class="button1" style="margin:0 auto;margin-top:20px;" onclick="saveTrackingInfraPY()">Save</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr id = "trInfra3" style="display:none;">
				<td>
					<!-------------------BATCH INP-->	
					<table border="0" cellpadding="0" cellspacing="0" style="margin:0px auto; padding:2px;">
						<tr>
							<td style="width:1px; padding-right:10px; padding-left:5px;">
								<span class="numbInfra">2</span><span class="numberField">Select&nbsp;Batch&nbsp;Number</span>
							</td>
							<td style="">
								<select class="data2" id="ipbSelectProject" onchange="getTNsUnderThisBatchNumber(this)"></select>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:10px 0px;">
								<div id="ipbDetailsContainer" style="padding:15px; display:none;">
									<div id="ipbDisplayProjGenDetails" style="padding:20px 0px;">
										<table border="0" cellpadding="0" cellspacing="0" style="font-family:NOR;">
											<tr>
												<td style="color:rgb(41, 111, 152); padding-right:10px;"><span style="color:grey; margin-left:5px;" class="labelProjectNumber">1</span>Contractor</td>
												<td id="ipbSelectContractor"  style="letter-spacing:1px;font-weight:bold;border-bottom:1px solid rgb(216, 219, 221);"></td>
											</tr>
											<tr>
												<td style="color:rgb(41, 111, 152); padding-right:10px;"><span style="color:grey; margin-left:5px;" class="labelProjectNumber">2</span>Fund&nbsp;Year</td>
												<td id="ipbSelectFundYear"  style="letter-spacing:1px;font-weight:bold;border-bottom:1px solid rgb(216, 219, 221);"></td>
											</tr>
											<tr>
												<td style="color:rgb(41, 111, 152); padding-right:10px;"><span style="color:grey; margin-left:5px;" class="labelProjectNumber">3</span>Fund</td>
												<td id="ipbSelectFund" style="letter-spacing:1px;font-weight:bold;border-bottom:1px solid rgb(216, 219, 221);"></td>
											</tr>
											<tr>
												<td style="color:rgb(41, 111, 152); padding-right:10px;"><span style="color:grey; margin-left:5px;" class="labelProjectNumber">4</span>Project&nbsp;Duration</td>
												<td id="ipbSelectDuration"  style="letter-spacing:1px;font-weight:bold;border-bottom:1px solid rgb(216, 219, 221);"></td>
											</tr>
										</table>
									</div>
									<div id="ipbDisplayTns" style="padding:20px 0px;"></div>
									<div id="ipbDisplayOtherDetails" style="padding:20px 0px;">
										<table border="0" cellpadding="0" cellspacing="0" style="font-family:NOR; margin:0px 0px 0px auto; font-weight:bold; text-align:right;">
											<tr>
												<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Current Progress</td>
												<td  style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;color:green;font-size:22px;padding-right:5px;"><span id="ipbTotalCurProgress">0.00</span>%</td>
											</tr>
											<tr>
												<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Budget Cost</td>
												<td id="ipbPYCost" style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
											</tr>
											<tr>
												<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Actual Cost</td>
												<td id="ipbPYCostActual" style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
											</tr>
											<tr>
												<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Add. Fund due to Variation Order No. 1 (<span style ="color:green;font-size: 13px;font-weight: bold;">+</span>)</td>
												<td id="ipbTotalVariation" style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
											</tr>
											<tr>
												<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Unperformed Works (<span style ="color:red;font-size: 10px;font-weight: bold;">&#9472;</span>)</td>
												<td id="ipbTotalUnperformed" style = "vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
											</tr>
											
											<tr>
												<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Adjusted Actual Amount</td>
												<td id="ipbTotalAdjustment" style = "font-size:18px;background-color:rgb(228, 232, 228); vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;">0.00</td>
											</tr>
											<tr>
												<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Retention(5%)</td>
												<td id="ipbPYRetention" style="vertical-align: bottom;padding:0;border-bottom: 1px dashed black;color:rgb(72, 169, 220);padding-left:10px;padding-right:5px;"></td>
											</tr>
											<tr>
												<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Retention Covered</td>
												<td id="ipbPYRetentionCovered" style="vertical-align: bottom;padding:0;border-bottom: 1px dashed black;color:rgb(72, 169, 220);padding-left:10px;padding-right:5px;"></td>
											</tr>
											<tr>
												<td style="color:grey;font-size: 12px;padding-right:10px;font-weight: normal;">Retention Balance</td>
												<td id="ipbPYRetentionBalance" style="color:rgb(10, 78, 126); vertical-align: bottom;padding:0;border-bottom: 1px dashed black;padding-left:10px;padding-right:5px;"></td>
											</tr>
										</table>
									</div>
									<div id="ipbDisplayHistory" style="padding:20px 0px;"></div>
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="padding:10px 5px;">
								<table border="0" cellpadding="0" cellspacing="0" style="margin:0px auto; width:100%; font-family:NOR;" id="ipbPaymentBreakdown">
									<tr>
										<td style="width:1%;"><span class="numbInfra">3</span><span class="numberField">Payment&nbsp;Type</span></td>
										<td style="width:1%;">
											<select id = "ipbPaymentType" class="data1" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;" onchange="return selectIpbType(this)">
											<option>&nbsp;</option>
											</select>
										</td>
										<td></td>
										<td style="width:1%; text-align:right;"><span class="numberField" style="margin-right:10px; white-space:nowrap;">Period&nbsp;Covered</span><span class="numbInfra">6</span></td>
										<td style="width:1%; padding-left: 5px;">
											<input value ="" id = "ipbPYfrom" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;" class="data1" placeholder ="Date From">
										</td>
									</tr>
									<tr>
										<td style="width:1%;"><span class="numbInfra">4</span><span class="numberField">Billed&nbsp;Progress</span></td>
										<td style="width:1%;">
											<input  maxlength="5" id="ipbProgress" class="data1" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;" onkeydown="return isAmount(this,event)" onkeyup="computerInfraIpb()" readonly>
										</td>
										<td></td>
										<td></td>
										<td style="width:1%; padding-left: 5px;">
											<input value ="" id = "ipbPYto" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;"  class="data1" placeholder ="Date To" >
										</td>
									</tr>
									<tr>
										<td style="width:1%;"><span class="numbInfra">5</span><span class="numberField">S-Curve</span></td>
										<td style="width:1%;">
											<input maxlength="5" id="ipbSCurve" class="data1" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;"  onkeyup="computerInfraIpb()">
										</td>
										<td></td>
										<td style="width:1%; text-align:right;"><span class="numberField" style="margin-right:10px; white-space:nowrap;">Delay</span><span class="numbInfra">7</span></td>
										<td style="width:1%; padding-left: 5px;">
											<input id = "ipbPYDelay" style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;" class="data1" disabled onkeydown="return isValueNumber(this,event)" onkeyup="computerInfraIpb()">
										</td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td style ="text-align: right;"><span class ="numberField" style="margin-right:10px; white-space:nowrap;">Accomplished to Expiry Date(%)</span><span class = "numbInfra">8</span></td>
										<td style="padding-left: 5px;">
											<input maxlength="5" id="ipbLDpercentage" class="data1"  disabled onkeydown="return isAmount(this,event)"  style ="border:1px solid silver;width:150px;font-weight: bold;text-align: center;"  onkeyup="computerInfraIpb()">
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr style="background-color:rgb(248, 253, 228);">
							<td colspan  ="4" style = "padding:10px 10px;font-family: NOR;border-top:1px solid silver;border:1px solid rgb(190, 191, 133);">
								<table style = "margin:auto;margin-right:0px;text-align:right;border-collapse:collapse;width:100%;" border ="0">
									<tr>
										<td colspan="2" style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;font-weight: bold;padding-top:10px;">Progress Amount</td>
										<td  id = "ipbPYgross" style = "line-height: 20px;font-size: 26px;font-weight: bold;width:1px;color:rgb(18, 96, 145);padding-top:10px;">0.00</td>
									</tr>
									<tr><td colspan="2" style = "padding:5px;padding-right:200px;font-size:14px;color:green;">LESS</td></tr>
									<tr>
										<td style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Unperformed Value</td>
										<td id = "ipbUnperformedValue" style = "line-height: 20px;font-size: 24px;font-weight: bold;width:1%; color:red;">0.00</td>
									</tr>
									<tr>
										<td style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Liquidated Damages</td>
										<td id = "ipbDamages" style = "line-height: 20px;font-size: 24px;font-weight: bold; color:red;">0.00</td>
									</tr>
									<tr>
										<td colspan="2" style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;"></td>
										<td id = "ipbNewGross" style = "line-height: 20px;font-size: 24px;font-weight: bold;">0.00</td>
									</tr>
									<tr><td colspan="2" style = "padding:5px;padding-right:200px;font-size:14px;color:green;">LESS</td></tr>
									<tr>
										<td style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Tax 2%</td>
										<td id = "ipbTaxTwo" style = "line-height: 20px;font-size: 24px;font-weight: bold;width:1%;">0.00</td>
									</tr>
									<tr>
										<td style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Tax 5%</td>
										<td id = "ipbTaxFive" style = "line-height: 20px;font-size: 24px;font-weight: bold;">0.00</td>
									</tr>
									<tr>
										<td colspan="3" style = "padding-top:5px">
											<div ></div>
										</td>
									</tr>
									<tr>
										<td colspan="2" style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Total Tax</td>
										<td id = "ipbTax" style = "line-height: 20px;font-size: 24px;font-weight: bold;">0.00</td>
									</tr>
									<tr><td colspan="2" style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Retention</td><td id = "ipbRetention" style = "line-height: 20px;font-size: 24px;font-weight: bold;">0.00</td></tr>
									<tr>
										<td colspan="3" style = "padding-top:5px">
											<div style = "border-top:1px solid silver;"></div>
										</td>
									</tr>
									<tr>
										<td colspan="2" style = "padding-right: 5px;vertical-align: bottom;line-height: 15px;">Total Deduction</td>
										<td id = "ipbTotalDeduction" style = "padding-top:5px;color:grey; line-height: 20px;font-size: 24px;font-weight: bold;">0.00</td>
									</tr>
									
									<tr><td colspan="3">
										<div style = "border-top:4px double silver;margin-top:5px;"></div>
									</td></tr>
									
									<tr>
										<td colspan="2" style = "padding-right: 8px 5px;vertical-align: bottom;line-height: 15px;">Net Amount</td>
										<td id = "ipbNet" style = "padding-right: 8px 5px;padding-left:10px; color:rgb(18, 96, 145); line-height: 20px;font-size: 28px;font-weight: bold;padding-top:5px;">0.00</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr style="">
							<td colspan="2" style="padding:10px 5px;">
								<div class="button1" style="margin:0 auto;margin-top:20px;" onclick="saveTrackingInfraPYIPB()">Save</div>
							</td>	
						</tr>
						
					</table>
				</td>
			</tr>
			<tr id="trInfra4" style="display:none;">
				<td style="">
					<!-------------------RETENTION-->	
					<table border="0" cellpadding="0" cellspacing="0" style="margin:0px auto; padding:2px; width:100%;">
							<tr>
								<td style="width:1px; padding-right:10px; padding-left:5px;">
									<span class="numbInfra">2</span><span class="numberField">Select&nbsp;Project</span>
								</td>
								<td style="">
									<select class="data2" id="retinSelectProject" onchange="getInfraTrackingDetails(this)"></select>
								</td>
							</tr>
							<tr>
								<td colspan="2" id="tdReviewInfraRetention" style="padding:10px 10px;"></td>
							</tr>
							<tr id="trRETIN1" style="display:none;">
								<td colspan="2" style="padding:10px 10px;">
									<div class="button1" style="margin:0 auto;margin-top:20px;" onclick="saveTrackingInfraRETIN()">Save</div>
								</td>
							</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
</div>
	

<script>

	// ------------------------------------------- MIXED INFRAS - START

	function getMXInfras(me) {

		if(me.checked == true) {
			var container = document.getElementById("inSelectTracking");
			container.innerHTML = "";

			var queryString = "?getMXInfras=1";
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");

		}else {
			var container = document.getElementById("inSelectTracking");
			container.innerHTML = "";

			selectInfraPayment();
		}

	}


	// ------------------------------------------- MIXED INFRAS - END

	// ------------------------------------------- INFRA RETENTION - START

	function fetchMultiProjRETIN() {
		var container = document.getElementById('retinSelectProject');
		var queryString = "?fetchMultiProjRETIN=1";

		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}

	function getInfraTrackingDetails(me) {
		if(me.value != "") {
			var trackingNumber = me.value;
			var queryString = "?getInfraTrackingDetails=1&trackingNumber="+trackingNumber;
			var container = document.getElementById('tdReviewInfraRetention');

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"getInfraTrackingDetails");
		}else {
			var container = document.getElementById('tdReviewInfraRetention');
			container.innerHTML = '';
			document.getElementById('trRETIN1').style.display = 'none';
		}

	}

	function saveTrackingInfraRETIN() {
		var infraTN = document.getElementById('retinINTN').textContent.trim();
		var contractor = document.getElementById('retinContractor').textContent.trim();
		var retention = document.getElementById('retinRetention').textContent.trim().replace(/[\, ]/g,'');
		var fund = document.getElementById('retinFund').textContent.trim();
		var program = document.getElementById('retinProgram').textContent.trim();

		var queryString = "?saveTrackingInfraRETIN=1&infraTN="+infraTN+"&contractor="+contractor+"&retention="+retention+"&fund="+fund+"&program="+program;
		var container = document.getElementById('infraTrackingNumber');

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"saveTrackingInfraRETIN");
	}

	// ------------------------------------------- INFRA RETENTION - END


	// ------------------------------------------- INFRA PAYMENT TYPE BATCH - START
	// optIPb.click();

	function fetchMultiProjIPb() {
		var queryString = "?fetchMultiProjIPb=1";
		var container = document.getElementById('ipbSelectProject');

		if(container.children.length == 0) {
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"fetchMultiProjIPb");
		}
	}

	function getTNsUnderThisBatchNumber(me) {
		var batchNumber = me.value.trim();
		
		if(me.value != "") {
			var queryString = "?getTNsUnderThisBatchNumber=1&batchNumber="+batchNumber;
			var container = document.getElementById('ipbDisplayTns');

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"getTNsUnderThisBatchNumber");
		}else {
			clearInfraPYIpb();
		}
	}

	function selectIpbType(me){
		ipbPYDelay.disabled  = true;
		if(me.selectedIndex == 1){
			if(ipbTotalCurProgress.textContent < 100){
				me.selectedIndex = "0";
				alert("Accomplishment should be 100% completed.");
			}else{
				ipbPYDelay.disabled  = false;
				// infraLDpercentage.disabled = false;
			}
		}
	}

	function computerInfraIpb(){
		var delay = ipbPYDelay.value.trim();

		var wholeProgress = ipbTotalCurProgress.textContent;
		var sCurve = ipbSCurve.value.trim();
		var billedProgress = ipbProgress.value.trim();
		var ldGrossBase = 0.00;
		var curTotalBilled = parseFloat( nfTotalBAmountBatch.textContent.replace(/[\, ]/g,'') );
		
		var actual = parseFloat(ipbTotalAdjustment.textContent.replace(/[\, ]/g,''));
		
		var retentionCovered = ipbPYRetentionCovered.textContent.replace(/[\, ]/g,'');
		var billedProgress = billedProgress / 100;

		var beforeAdjustmentCost = ipbPYCostActual.textContent.replace(/[\, ]/g,'');
		var varia = ipbTotalVariation.textContent.replace(/[\, ]/g,'');
		var unper = ipbTotalUnperformed.textContent.replace(/[\, ]/g,'');
		var gross =  round2(trimTwoDecimals( parseFloat(beforeAdjustmentCost  *  billedProgress )));
		
		// if(varia > 0){
		// 	var gross =  round2(trimTwoDecimals( (parseFloat(beforeAdjustmentCost) *  parseFloat(billedProgress)) + parseFloat(varia) ));
		// }else{
		// 	if(unper > 0){
		// 		var gross =  round2(trimTwoDecimals( (parseFloat(beforeAdjustmentCost) *  parseFloat(billedProgress)) - parseFloat(unper) ));
		// 	}
		// }

		if(varia > 0){
			var gross = round2(trimTwoDecimals( ( ( parseFloat(beforeAdjustmentCost) + parseFloat(varia)  ) * (wholeProgress/100) ) - curTotalBilled ));
		}else{
			if(unper > 0){
				var gross = round2(trimTwoDecimals( ( ( parseFloat(beforeAdjustmentCost) - parseFloat(unper)  ) * (wholeProgress/100) ) - curTotalBilled ));
			}
		}

		var payType = document.getElementById('ipbPaymentType');
		if(payType.value.indexOf("Final") > -1) {
			var adjustedActual = parseFloat(ipbTotalAdjustment.textContent.replace(/[\, ]/g,''));
			var totalPrvPYs = nfTotalBAmountBatch.textContent.replace(/[\, ]/g,'');

			var gross = round2( trimTwoDecimals( parseFloat(adjustedActual) - parseFloat(totalPrvPYs) ) );
		}


		// var gross =  round2(trimTwoDecimals(parseFloat(actual *  billedProgress)));
		var newGross = gross;

		var tax12 = round2(trimTwoDecimals((gross / 1.12)));
		var tax2 = round2(trimTwoDecimals(parseFloat(tax12 * .02)));
		var tax5 = round2(trimTwoDecimals(parseFloat(tax12 * .05)));
		var tax = round2(trimTwoDecimals((parseFloat(tax2) + parseFloat(tax5))));

		var ld = 0.00;
		
		if(wholeProgress <= 50){
			var retention = round2(trimTwoDecimals(parseFloat(gross * .1)));
			var deduction = round2(trimTwoDecimals((parseFloat(tax) + parseFloat(retention))));
		}else if(wholeProgress < 100){
			if(sCurve.length == 0 || sCurve >= 0){
				var retentionBalance = ipbPYRetentionBalance.textContent.replace(/[\, ]/g,'');
				if(retentionBalance > 0){
					var retention = retentionBalance;
				}else{
					var retention = 0.00;
				}	
			}else{
				var retention = parseFloat(gross * .1).toFixed(2);
			}
			var deduction = round2(trimTwoDecimals((parseFloat(tax) + parseFloat(retention))));
		}else{
			var delay = ipbPYDelay.value.trim();
			var delayPercent = ipbLDpercentage.value.trim();
			
			if(delay.length == 0 || delay == 0){
				if(sCurve.length == 0 || sCurve >= 0){
					var retentionBalance = ipbPYRetentionBalance.textContent.replace(/[\, ]/g,'');
					if(retentionBalance > 0){
						var retention = retentionBalance;
					}else{
						var retention = 0.00;
					}	
				}else{
					var retention = round2(trimTwoDecimals( parseFloat(gross * .1) ));
				}
				var ld = 0.00;
			
			}else{
				var delayPercent = parseFloat(delayPercent/100).toFixed(4);
				/*var delayedPercentageAmount = round2(trimTwoDecimals( (gross * delayPercent) ));
				var ldGrossBase =  round2(trimTwoDecimals( parseFloat(gross - delayedPercentageAmount) ));*/
				
				var delayedPercentageAmount = round2(trimTwoDecimals( parseFloat(actual * delayPercent) ));
				var ldGrossBase =  round2(trimTwoDecimals( parseFloat(actual - delayedPercentageAmount) ));
				
				var ld = round2(trimTwoDecimals( parseFloat(ldGrossBase * .01  * .1 * delay) )); 
				var newGross = round2(trimTwoDecimals( parseFloat(gross - ld) ));
				var retention = round2(trimTwoDecimals( parseFloat(newGross * .1) ));
				
				var baseForTax = round2(trimTwoDecimals( (newGross / 1.12) ));
				var tax2 = round2(trimTwoDecimals( parseFloat(baseForTax * .02) ));
				var tax5 = round2(trimTwoDecimals( parseFloat(baseForTax * .05) ));
				var tax =  round2(trimTwoDecimals( (parseFloat(tax2) + parseFloat(tax5)) ));
			}
			var deduction = round2(trimTwoDecimals( (parseFloat(tax) + parseFloat(retention)) ));
		}

		var net = round2(trimTwoDecimals( (parseFloat(newGross) - parseFloat(deduction)) )); 
		ipbPYgross.textContent  =  numberWithCommas(gross);
		ipbTaxTwo.textContent  =  numberWithCommas(tax2);
		ipbTaxFive.textContent  =  numberWithCommas(tax5);
		ipbTax.textContent  =  numberWithCommas(tax);
		ipbRetention.textContent  =  numberWithCommas(retention);
		ipbDamages.textContent  = numberWithCommas(ld);	
		ipbTotalDeduction.textContent  = numberWithCommas(deduction);
		ipbNet.textContent  = numberWithCommas(net);

		ipbUnperformedValue.textContent = numberWithCommas(ldGrossBase);	
		ipbNewGross.textContent = numberWithCommas(newGross);		
		
	}

	function saveTrackingInfraPYIPB(){
		// var tn = document.getElementById('inSelectTracking').value; // wala pa na change kay multiple ni
		var tn = ""; // wala pa na change kay multiple ni
		var tns = document.getElementsByName('ipbNfTracking');
		for(var i = 0; i < tns.length; i++) {
			tn += '~'+tns[i].textContent;
		}

		var actual = document.getElementById('ipbPYCostActual').textContent.replace(/[\, ]/g,'');
		var actualAdjustment = parseFloat(ipbTotalAdjustment.textContent.replace(/[\, ]/g,''));
		
		var fund = document.getElementById('ipbSelectFund').textContent.trim();

		// var supplier = document.getElementById('inSelectClaimant').textContent.trim(); // i-change ni kay dli lng 1 ang source sa claimant
		var supplier = document.getElementsByName('ipbNfClaimant')[0].textContent.trim();

		var type = document.getElementById('ipbPaymentType').value;
		var progress = document.getElementById('ipbProgress').value.trim();
		var projectProgress = document.getElementById('ipbTotalCurProgress').textContent;
		var sCurve = document.getElementById('ipbSCurve').value.trim();
		var from  = document.getElementById('ipbPYfrom').value.trim();
		var to  = document.getElementById('ipbPYto').value.trim();
		var delay = document.getElementById('ipbPYDelay').value.trim();
		
		var variation = document.getElementById('ipbTotalVariation').textContent.replace(/[\, ]/g,'');
		var unperformed = document.getElementById('ipbTotalUnperformed').textContent.replace(/[\, ]/g,'');
		
		// var gross = document.getElementById('ipbPYgross').textContent.replace(/[\, ]/g,'');
		var gross = document.getElementById('ipbNewGross').textContent.replace(/[\, ]/g,'');

		var retention = document.getElementById('ipbRetention').textContent.replace(/[\, ]/g,'');
		var ld = document.getElementById('ipbDamages').textContent.replace(/[\, ]/g,'');
		
		var two = document.getElementById('ipbTaxTwo').textContent.replace(/[\, ]/g,'');
		var five = document.getElementById('ipbTaxFive').textContent.replace(/[\, ]/g,'');
		
		var tax = document.getElementById('ipbTax').textContent.replace(/[\, ]/g,'');
		var net = document.getElementById('ipbNet').textContent.replace(/[\, ]/g,'');
		
		var ldPercentage = document.getElementById("ipbLDpercentage").value.trim();
		
	
		if(tn != ""){
			var x =checkEmptyNew(document.getElementById("ipbPaymentBreakdown"), "input,select", "Please complete the required information.","ipbPYDelay,ipbLDpercentage",removeInvalidInfra);
		
			if(x == 0){
				if(progress > 0){
					var queryString = "?saveTrackingInfraPYIPB=1"
							+ "&tn=" + tn
							+ "&fund=" + fund
							+ "&supplier=" + encodeURIComponent(supplier)
							+ "&type=" + type
							+ "&progress=" + progress
							+ "&retention=" + retention
							+ "&tax=" + tax
							+ "&net=" + net
							+ "&delay=" + delay
							+ "&actual=" + actual
							+ "&to=" + to
							+ "&from=" + from
							+ "&sCurve=" + sCurve
							+ "&five=" + five
							+ "&two=" + two
							+ "&wholeProgress=" + projectProgress
							+ "&variation=" + variation
							+ "&unperformed=" + unperformed
							+ "&ld=" + ld
							+ "&actualAdjustment=" + actualAdjustment
							+ "&gross=" + gross
							+ "&ldPercentage=" + ldPercentage;
					var container = document.getElementById('infraTrackingNumber');
					loader();
					ajaxGetAndConcatenate(queryString,processorLink,container,"saveTrackingInfraPYIPB");
				}else{
					alert("Please input progress percentage.");
				}
				
			}
		}else{
			alert("Please select contract tracking.");
		}
	}

	function clearInfraPYIpb(){
		selectToIndexZero('ipbSelectProject');
		selectToIndexZero("ipbPaymentType");
		document.getElementById('ipbDetailsContainer').style.display = "none";
		
		ipbPaymentType.innerHTML ='<option>&nbsp;</option>';
		ipbSCurve.value = "";
		ipbPYfrom.value = "";
		ipbPYto.value = "";
		ipbPYDelay.value = "";
		ipbLDpercentage.value = "";
		
		ipbTaxTwo.textContent = "0.00";
		ipbTaxFive.textContent = "0.00";
		ipbDamages.textContent = "0.00";
		
		document.getElementById('ipbProgress').value ='';
		document.getElementById('ipbPYgross').textContent = '0.00';
		document.getElementById('ipbRetention').textContent = "0.00";
		document.getElementById('ipbTax').textContent = "0.00";
		document.getElementById('ipbNet').textContent = "0.00";
		document.getElementById('ipbTotalDeduction').textContent = "0.00";
		document.getElementById('ipbUnperformedValue').textContent = "0.00";
		document.getElementById('ipbNewGross').textContent = "0.00";
	}

	// ------------------------------------------- INFRA PAYMENT TYPE BATCH - END



	//optIP.click();
	// ------------------------------------------- INFRA ENCODE DEFAULT FUNCS - START
	
	
		
	function selectInfraType(me){
		infraPYDelay.disabled  = true;
		if(me.selectedIndex == 1){
			if(infraPYProgress.textContent < 100){
				me.selectedIndex = "0";
				alert("Accomplishment should be 100% completed.");
			}else{
				infraPYDelay.disabled  = false;
			}
		}
	}
	
	// round2(trimTwoDecimals());
	function computerInfra(){
		var delay = infraPYDelay.value.trim();
		var wholeProgress = infraPYProgress.textContent;
		var sCurve = infrasCurve.value.trim();
		var billedProgress  = infraProgress.value.trim();
		var ldGrossBase = 0.00;
		var curTotalBilled = parseFloat( nfTotalBAmount.textContent.replace(/[\, ]/g,'') );
		
		
		var actual = parseFloat(infraPYadjusted.textContent.replace(/[\, ]/g,''));
		var retentionCovered = infraPYRetentionCovered.textContent.replace(/[\, ]/g,'');
		var billedProgress = billedProgress / 100;
		
		var beforeAdjustmentCost = infraPYCostActual.textContent.replace(/[\, ]/g,'');
		var varia = infraPYvariation.textContent.replace(/[\, ]/g,'');
		var unper = infraPYunperformed.textContent.replace(/[\, ]/g,'');
		var gross =  round2(trimTwoDecimals( parseFloat(beforeAdjustmentCost  *  billedProgress )));

		// if(varia > 0){
		// 	var gross =  round2(trimTwoDecimals( (parseFloat(beforeAdjustmentCost) *  parseFloat(billedProgress)) + parseFloat(varia) ));
		// }else{
		// 	if(unper > 0){
		// 		var gross =  round2(trimTwoDecimals( (parseFloat(beforeAdjustmentCost) *  parseFloat(billedProgress)) - parseFloat(unper) ));
		// 	}
		// }

		if(varia > 0){
			var gross = round2(trimTwoDecimals( ( ( parseFloat(beforeAdjustmentCost) + parseFloat(varia)  ) * (wholeProgress/100) ) - curTotalBilled ));
		}else{
			if(unper > 0){
				var gross = round2(trimTwoDecimals( ( ( parseFloat(beforeAdjustmentCost) - parseFloat(unper)  ) * (wholeProgress/100) ) - curTotalBilled ));
			}
		}

		var payType = document.getElementById('infraPaymentType');
		if(payType.value.indexOf("Final") > -1) {
			var adjustedActual = parseFloat(infraPYadjusted.textContent.replace(/[\, ]/g,''));
			var totalPrvPYs = nfTotalBAmount.textContent.replace(/[\, ]/g,'');

			var gross = round2( trimTwoDecimals( parseFloat(adjustedActual) - parseFloat(totalPrvPYs) ) );
		}

		
		//var gross =  round2(trimTwoDecimals( parseFloat(actual *  billedProgress) ));
		var newGross = gross;
		
		// var tax2 = round2(trimTwoDecimals( parseFloat(gross  / 1.12 * .02) ));
		// var tax5 = round2(trimTwoDecimals( parseFloat(gross / 1.12 * .05) ));
		// var tax = round2(trimTwoDecimals( parseFloat(tax2) + parseFloat(tax5) ));

		var baseGr = round2(trimTwoDecimals( parseFloat(gross  / 1.12) ));
		var tax2 = round2(trimTwoDecimals( parseFloat(baseGr * .02) ));
		var tax5 = round2(trimTwoDecimals( parseFloat(baseGr * .05) ));
		var tax = round2(trimTwoDecimals( parseFloat(tax2) + parseFloat(tax5) ));
		
		var ld = 0.00;
		
		if(wholeProgress <= 50){
			// var retention = round2(parseFloat(gross * .1).toFixed(3));
			// var deduction = (parseFloat(tax) + parseFloat(retention)).toFixed(2);

			var retention = round2(trimTwoDecimals( parseFloat(gross * .1) ));
			var deduction = round2(trimTwoDecimals( parseFloat(tax) + parseFloat(retention) ));
		}else if(wholeProgress < 100){
			if(sCurve.length == 0 || sCurve >= 0){
				var retentionBalance = infraPYRetentionBalance.textContent.replace(/[\, ]/g,'');
				if(retentionBalance > 0){
					var retention = retentionBalance;
				}else{
					var retention = 0.00;
				}	
			}else{
				
				var retention = round2(trimTwoDecimals( parseFloat(gross * .1) ));
			}
			
			var deduction = round2(trimTwoDecimals( parseFloat(tax) + parseFloat(retention) ));
		}else{
			var delay = infraPYDelay.value.trim();
			var delayPercent = infraLDpercentage.value.trim();
			
			
			
			if(delay.length == 0 || delay == 0){

				if(sCurve.length == 0 || sCurve >= 0){
					var retentionBalance = infraPYRetentionBalance.textContent.replace(/[\, ]/g,'');
					if(retentionBalance > 0){
						var retention = retentionBalance;
					}else{
						var retention = 0.00;
					}	
				}else{
					// var retention = round2(parseFloat(gross * .1).toFixed(3));
					var retention = round2(trimTwoDecimals( parseFloat(gross * .1) ));
				}
				var ld = 0.00;
			
			}else{
				
				var delayPercent = parseFloat(delayPercent/100).toFixed(4);
				
				/*var delayedPercentageAmount = round2(trimTwoDecimals( parseFloat(gross * delayPercent) ));
				var ldGrossBase =  round2(trimTwoDecimals( parseFloat(gross - delayedPercentageAmount) ));*/
				
				var delayedPercentageAmount = round2(trimTwoDecimals( parseFloat(actual * delayPercent) ));
				var ldGrossBase =  round2(trimTwoDecimals( parseFloat(actual - delayedPercentageAmount) ));
				
				
				var ld = round2(trimTwoDecimals( parseFloat(ldGrossBase * .01  * .1 * delay) )); 
				var newGross = round2(trimTwoDecimals( parseFloat(gross - ld) ));
				var retention = round2(trimTwoDecimals( parseFloat(newGross * .1) ));

				//var gross = newGross;
				var baseForTax = round2(trimTwoDecimals( (newGross / 1.12) ));
				var tax2 = round2(trimTwoDecimals( parseFloat(baseForTax * .02) ));
				var tax5 = round2(trimTwoDecimals( parseFloat(baseForTax * .05) ));
				var tax =  round2(trimTwoDecimals( (parseFloat(tax2) + parseFloat(tax5)) ));
			}
			// var deduction = (parseFloat(tax) + parseFloat(retention)).toFixed(2);
			var deduction = round2(trimTwoDecimals( parseFloat(tax) + parseFloat(retention) ));
		}
		// var net  = round2((parseFloat(newGross) - parseFloat(deduction)).toFixed(2)); 
		var net  = round2(trimTwoDecimals( (parseFloat(newGross) - parseFloat(deduction)) )); 

		infraPYgross.textContent  =  numberWithCommas(gross);
		infraTaxTwo.textContent  =  numberWithCommas(tax2);
		infraTaxFive.textContent  =  numberWithCommas(tax5);
		infraTax.textContent  =  numberWithCommas(tax);
		infraRetention.textContent  =  numberWithCommas(retention);
		infraTotalDeduction.textContent  = numberWithCommas(deduction);
		
		infraNet.textContent  = numberWithCommas(net);	
		
		infraDamages.textContent  = numberWithCommas(ld);	
		
		infraUnperformedValue.textContent = numberWithCommas(ldGrossBase);	
		infraNewGross.textContent = numberWithCommas(newGross);	
	}
	
	function infraClickOption(me){
		var x  = me.id;
		if(x == "optNF"){
			document.getElementById('trInfra1').style.display = "table-row";
			document.getElementById('trInfra2').style.display = "none";
			document.getElementById('trInfra3').style.display = "none";
			fetchOfficeInfra();

		}else if(x == "optIP"){
			document.getElementById('trInfra2').style.display = "table-row";
			document.getElementById('trInfra1').style.display = "none";
			document.getElementById('trInfra3').style.display = "none";
			selectInfraPayment();
		}else if(x == "optIPb"){
			document.getElementById('trInfra3').style.display = "table-row";
			document.getElementById('trInfra1').style.display = "none";
			document.getElementById('trInfra2').style.display = "none";
			fetchMultiProjIPb();
		}else if(x == "optRETIN"){
			document.getElementById('trInfra4').style.display = "table-row";
			document.getElementById('trInfra3').style.display = "none";
			document.getElementById('trInfra1').style.display = "none";
			document.getElementById('trInfra2').style.display = "none";

			document.getElementById('trRETIN1').style.display = 'none';
			document.getElementById('tdReviewInfraRetention').innerHTML = '';
			fetchMultiProjRETIN();
		}
		
	}
	// ------------------------------------------- INFRA ENCODE DEFAULT FUNCS - END


	// ------------------------------------------- CREATE NF TRACKING - START
	/*function whenRefreshDoctrackInfra(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Infra"){
				fetchOfficeInfra();
			}
		}
	}*/
	function fetchOfficeInfra(){
		var container = document.getElementById("infraSelectOffice");

		if(container.children.length == 0){
			loader();
			var queryString = "?fetchOfficeInfra=1" ;
			ajaxGetAndConcatenate(queryString,processorLink,container,"fetchOfficeInfra");
		}
	}
	function fetchNewTrackingInfra(me){
		var code = me.value.trim();
		loader();
		var container = document.getElementById("infraTrackingNumber");
		var queryString = "?fetchNewTrackingInfra=1&code=" + code ;
		
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchNewTrackingInfra");	
		clearInfra();
	}
	function selectInfraProject(me){
		
		var arr = me.value.split("~!~");
		var code = arr[0];
		var cost = numberWithCommas(arr[1]);
		var account = arr[2];
		var fund = arr[3];
		var infraId = arr[4];
		var fundYear = arr[5];
		var subcode = arr[6];
		var subDescription = arr[7];
	
		
		var name = getSelectText(me).replace(code,"").slice(4);
		infraCode.innerHTML = code;
		infraName.innerHTML = name;
		infraAccountCode.innerHTML = account;
		infraCost.innerHTML = cost;
		infraFund.innerHTML = fund;
		infraFundYear.innerHTML = fundYear;
		infraSubcode.innerHTML = subcode;
		infraSubDescription.innerHTML = subDescription;
		
		infraProjectId.innerHTML = infraId;
		me.selectedIndex = "0";
		
		loader();
		var container = document.getElementById("infraAccountName");
		var queryString = "?fetchAccountName=1&code=" + account ;
		ajaxGetAndConcatenate(queryString,processorLink,container,"fetchAccountName");	
		
	
		infraTRdetails.style.display = "table-row";
		infraTRsave.style.display = "table-row";
		infraTRBatchNum.style.display = "table-row";
		infraTRLocation.style.display = "table-row";
		infraTRduration.style.display = "table-row";
	}
	function clearInfra(){
		infraCode.innerHTML = "";
		infraName.innerHTML =  "";
		infraAccountCode.innerHTML =  "";
		infraCost.innerHTML =  "";
		infraAccountName.innerHTML =  "";
		infraFund.innerHTML =  "";
		
		infraFundYear.innerHTML = "";
		infraSubcode.innerHTML = "";
		infraSubDescription.innerHTML = "";
		
		infraBatchNum.value  =  "";
		infraLocation.value  =  "";
		infraDuration.value  =  "";
		
		infraTRdetails.style.display = "none";
		infraTRsave.style.display = "none";
		infraTRBatchNum.style.display = "none";
		infraTRLocation.style.display = "none";
		infraTRduration.style.display = "none";
	}
	function saveTrackingInfra(){
		var code = infraCode.innerHTML;
		var name = infraName.innerHTML;
		var accountCode = infraAccountCode.innerHTML;
		var cost = infraCost.innerHTML.replace(/[\, ]/g,'');
		var accountName = encodeURIComponent(infraAccountName.innerHTML);
		var office = infraSelectOffice.value;
		var fund = infraFund.innerHTML;
		var batch = infraBatchNum.value.trim();
		var location = encodeURIComponent(infraLocation.value.trim());
		var duration = infraDuration.value.trim();
		var infraId = infraProjectId.innerHTML;
		
		var fundYear = infraFundYear.innerHTML;
		var subcode = infraSubcode.innerHTML;
	
		
		if(batch.length == 0){
			batch = "TBA";
		}
		if(location.length == 0){
			location = "TBA";
		}
		if(duration.length == 0){
			duration = "TBA";
		}
		if(subcode.length == 0){
			subcode = 0;
		}
		
		loader();
		var container = document.getElementById("infraTrackingNumber");
		var queryString = "?saveTrackingInfra=1&code=" + code  + "&name=" + name +  "&accountCode=" + accountCode + 
							"&cost=" + cost + "&accountName=" + accountName + "&office=" + office + "&fund=" + fund + 
							"&batchno=" + batch + "&location=" + location+ "&duration=" + duration + "&infraId=" + infraId +"&fundYear=" + fundYear + "&subcode=" + subcode;
		
		ajaxGetAndConcatenate(queryString,processorLink,container,"saveTrackingInfra");	
		
	}
	// ------------------------------------------- CREATE NF TRACKING - END
	// ------------------------------------------- INFRA PAYMENT - START
	function selectInfraPayment(){
		var container = document.getElementById("inSelectTracking");
		
		if(container.children.length == 0){
			loader();
			var queryString = "?selectInfraPayment=1" ;
			ajaxGetAndConcatenate(queryString,processorLink,container,"selectInfraPayment");
		}
	}
	function fetchINTNDetails(me){
		if(me.value != ""){

			var mxChkBox = document.getElementById('chkboxMXInfra');
			var mxChk = 0;
			if(mxChkBox.checked == true) {
				mxChk = 1;
			}

			var temp = me.value.split('*');
			var tn = temp[0];
			var office = temp[1];
			inTN.textContent = tn;
			var queryString = "?fetchINTNDetails=1"
							+ "&tn="   + tn
							+ "&office="   + office
							+ "&mixedINs="   + mxChk;
			var container = document.getElementById('inSelectProjDetails');
			
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"fetchINTNDetails");	
		}else{
			clearInfraPY();
		}
	}
	function saveTrackingInfraPY(){
		var tn = document.getElementById('inSelectTracking').value;
		var actual = document.getElementById('infraPYCostActual').textContent.replace(/[\, ]/g,'');
		var actualAdjustment = parseFloat(infraPYadjusted.textContent.replace(/[\, ]/g,''));
		
		var fund = document.getElementById('inSelectFund').textContent.trim();
		var supplier = document.getElementById('inSelectClaimant').textContent.trim();
		var type = document.getElementById('infraPaymentType').value;
		var progress = document.getElementById('infraProgress').value.trim();
		var projectProgress = document.getElementById('infraPYProgress').textContent;
		var sCurve = document.getElementById('infrasCurve').value.trim();
		var from  = document.getElementById('infraPYfrom').value.trim();
		var to  = document.getElementById('infraPYto').value.trim();
		var delay = document.getElementById('infraPYDelay').value.trim();

		var batchNumber = document.getElementById('infraPYBatchNumber').textContent.trim();
		var mxINFRA = document.getElementById('chkboxMXInfra');
		var mixedTrans = 0;
		if(mxINFRA.checked == true) {
			mixedTrans = 1;
		}
		
		var variation = document.getElementById('infraPYvariation').textContent.replace(/[\, ]/g,'');
		var unperformed = document.getElementById('infraPYunperformed').textContent.replace(/[\, ]/g,'');
		
		//var gross = document.getElementById('infraPYgross').textContent.replace(/[\, ]/g,'');
		var gross = document.getElementById('infraNewGross').textContent.replace(/[\, ]/g,'');
		
		var retention = document.getElementById('infraRetention').textContent.replace(/[\, ]/g,'');
		var ld = document.getElementById('infraDamages').textContent.replace(/[\, ]/g,'');
		
		
		var two = document.getElementById('infraTaxTwo').textContent.replace(/[\, ]/g,'');
		var five = document.getElementById('infraTaxFive').textContent.replace(/[\, ]/g,'');
		
		var tax = document.getElementById('infraTax').textContent.replace(/[\, ]/g,'');
		var net = document.getElementById('infraNet').textContent.replace(/[\, ]/g,'');
		
		var ldPercentage = document.getElementById("infraLDpercentage").value.trim();
		
		
		
	
		if(tn != ""){
			var x =checkEmptyNew(document.getElementById("infraPaymentBreakdown"), "input,select", "Please complete the required information.","infraPYDelay,infraLDpercentage",removeInvalidInfra);
			
		
			if(x == 0){
				if(progress > 0){
					var queryString = "?saveTrackingInfraPY=1"
							+ "&tn=" + tn
							+ "&fund=" + fund
							+ "&supplier=" + encodeURIComponent(supplier)
							+ "&type=" + type
							+ "&progress=" + progress
							+ "&retention=" + retention
							+ "&tax=" + tax
							+ "&net=" + net
							+ "&delay=" + delay
							+ "&actual=" + actual
							+ "&to=" + to
							+ "&from=" + from
							+ "&sCurve=" + sCurve
							+ "&five=" + five
							+ "&two=" + two
							+ "&wholeProgress=" + projectProgress
							+ "&variation=" + variation
							+ "&unperformed=" + unperformed
							+ "&ld=" + ld
							+ "&actualAdjustment=" + actualAdjustment
							+ "&gross=" + gross
							+ "&ldPercentage=" + ldPercentage
							+ "&batchNumber=" + batchNumber
							+ "&mixedINFRA=" + mixedTrans;
					var container = document.getElementById('infraTrackingNumber');
					loader();
					ajaxGetAndConcatenate(queryString,processorLink,container,"saveTrackingInfraPY");
				}else{
					alert("Please input progress percentage.");
				}
				
			}
		}else{
			alert("Please select contract tracking.");
		}
	}
	
	function clearInfraPY(){
		selectToIndexZero('inSelectTracking');
		document.getElementById('inSelectProjDetails').style.display = "none";
		
		selectToIndexZero("infraPaymentType");
		
		infraPaymentType.innerHTML ='<option>&nbsp;</option>';
		infrasCurve.value = "";
		infraPYfrom.value = "";
		infraPYto.value = "";
		infraPYDelay.value = "";
		
		infraTaxTwo.textContent = "0.00";
		infraTaxFive.textContent = "0.00";
		infraDamages.textContent = "0.00";
		
		
		document.getElementById('infraProgress').value ='';
		document.getElementById('infraPYgross').textContent = '0.00';
		document.getElementById('infraRetention').textContent = "0.00";
		document.getElementById('infraTax').textContent = "0.00";
		document.getElementById('infraNet').textContent = "0.00";
		document.getElementById('infraTotalDeduction').textContent = "0.00";
		
		document.getElementById('infraUnperformedValue').textContent = "0.00";
		document.getElementById('infraNewGross').textContent = "0.00";
		document.getElementById('infraLDpercentage').textContent = "0.00";

		var mxINFRA = document.getElementById('chkboxMXInfra');
		if(mxINFRA.checked == true) {
			mxINFRA.click();
		}
	}
	// ------------------------------------------- INFRA PAYMENT - END

</script>






























