<?php
	session_start();
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	
	
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	/*$sql = "SELECT a.*,e.Name,b.Office,b.Claimant,b.Adv1 as Adv,b.CheckDate,b.checknumber,if(b.TotalAmountMultiple > 0,b.TotalAmountMultiple,b.Amount) as CashAdvanceAmount,c.Particulars,d.Adv1 as LR
			FROM liquidation a left join vouchercurrent b  on a.CashAdvanceTN = b.TrackingNumber 
			
			left join particulars c on a.TrackingNumber = c.TrackingNumber
			left join vouchercurrent d on d.TrackingNumber = a.TrackingNumber
			left join office e on e.Code = b.Office
			
			
			where a.TrackingNumber = '" . $trackingNumber . "' limit 1 ;";*/
	
	// $sql = "SELECT a.*,e.Name,b.Office,b.Claimant,b.Adv1 as Adv,b.CheckDate,b.checknumber,b.NetAmount as CashAdvanceAmount,c.Particulars,d.Adv1 as LR
	// 		FROM liquidation a left join vouchercurrent b  on a.CashAdvanceTN = b.TrackingNumber 
			
	// 		left join particulars c on a.TrackingNumber = c.TrackingNumber
	// 		left join vouchercurrent d on d.TrackingNumber = a.TrackingNumber
	// 		left join office e on e.Code = b.Office
			
			
	// 		where a.TrackingNumber = '" . $trackingNumber . "' limit 1";

	// $newRecord = [];
	// $sql = "SELECT * FROM liquidation WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
	// $record = $database->query($sql);
	// $data = $database->fetch_array($record);
	// $newRecord['CashAdvanceTN'] = $data['CashAdvanceTN'];
	// $newRecord['Spent'] = $data['Spent'];
	// $newRecord['Refund'] = $data['Refund'];
	// $newRecord['Reimbursement'] = $data['Reimbursement'];
	// $newRecord['ORdetails'] = $data['ORdetails'];
	// $newRecord['Tax'] = $data['Tax'];

	// $sql = "SELECT * FROM vouchercurrent WHERE TrackingNumber = '".$trackingNumber."'";
	// $sql = "SELECT * FROM vouchercurrent WHERE TrackingNumber = '".$newRecord['CashAdvanceTN']."'";
	// $sql = "SELECT * FROM particulars WHERE TrackingNumber = '".$trackingNumber."'";
	// $sql = "SELECT * FROM office WHERE TrackingNumber = '".$newRecord['Office']."'";



	$sql = "SELECT a.*,e.Name,b.Office,b.Claimant,b.Adv1 as Adv,b.CheckDate,b.checknumber,b.NetAmount as CashAdvanceAmount,c.Particulars,d.Adv1 as LR
			FROM liquidation a 
			left join vouchercurrent b  on a.CashAdvanceTN = b.TrackingNumber 
			left join particulars c on a.TrackingNumber = c.TrackingNumber
			left join vouchercurrent d on d.TrackingNumber = a.TrackingNumber
			left join office e on e.Code = b.Office
			where a.TrackingNumber = '" . $trackingNumber . "' GROUP BY CashAdvanceTN";
	$record = $database->query($sql);
	
	$count = $database->num_rows($record);
	$acct =$_SESSION['accountType'];
	$logOffice = $_SESSION['officeCode'];
	
	$amountSpent = 0;
	$refund = 0;
	$reim = 0;
	$cashadvance = 0;
	$orDetails = "";
	$adv = "";
	while($data = $database->fetch_array($record)){
		$amountSpent += $data['Spent'];
		$refund += $data['Refund'];
		$reim += $data['Reimbursement'];
		$cashadvance += $data['CashAdvanceAmount'];
		$orDetails .= "";
		if($data['ORdetails'] != ""){
			$orDetails .= ",".strtoupper($data['ORdetails']);
		}
		$adv .= ",".$data['Adv'];

		$claimant = strtoupper($data['Claimant']);
		$lrno =  $database->zeroToNothing($data['LR']);
		$checkdate = $data['CheckDate'];
		$checknumber = $data['checknumber'];
		$particulars = $data['Particulars'];
		$office = $data['Name'];
	}
	$orDetails = substr($orDetails, 1);
	$adv = substr($adv, 1);
	
	
	
	$year  = "2023";
	$charges = '<span style = "font-weight:bold;font-size:12px;">Chges: </span>';
	$sheetSpace ='';
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	$sheetSpace .= "\n~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~";
	
    $sheetSpace = preg_replace('/[~]/', ' ',$sheetSpace);
        
	$sheet = $particulars . $sheetSpace;
	if(strlen($particulars) > 1){
		$sheet = trim($particulars);
	}
	
	
	
	if(isset($_COOKIE['LiqHead'])){
		$head = $_COOKIE['LiqHead'];
	}else{
		$head = '';
	}
	if(isset($_COOKIE['LiqPos'])){
		$liqPos = $_COOKIE['LiqPos'];
	}else{
		$liqPos = 'Department Head';
	}
	
	
	$m1 = strrev(substr($trackingNumber,0,2));
	$m2 = strrev(substr($claimant,1,3));
?>
<style>
	@font-face {
		font-family: Oswald;
		src: url(../fonts/Oswald-ExtraLight.ttf);
	}
	#tableMainForm{
		margin:0 auto;
		width:700px;
		border-spacing:0;
		border:2px solid black;
	}
	
	
	.textAreaInput{
		display:block;
		width:100%;
		height:100%;
		margin:0 auto;
		overflow:hidden;
	
		border:0;
		padding:5px;
		
		letter-spacing:1px;
		resize:none;
		
		font-size:15px;
		//white-space: pre;
		font-family: sans-serif;
		text-align: left;
	}
	.saving{
		transition:all .5s ease-in;	
		float:right;
		display:inline;
		position: absolute;
		/*margin-left:160px;*/
		margin-left:120px;
		padding: 0px 10px;
		color:white;
		visibility:hidden;
	}
	.saving1{
		transition:all .5s ease-in;
		float:right;
		display:inline;
		position: absolute;
		margin-left:160px;
		padding: 0px 10px;
		background-color: red;
		color:white;
		visibility:visible;
		
	}
	.text3 {
		font-family: mainFont;
		padding: 5px 5px;
		width: 150px;
		font-weight: bold;
		font-size: 14px;
		border-top: 1px solid silver;
		border-left: 1px solid silver;
		background-color: rgba(6, 44, 66,.05);
		width: 100%;
	}
	.subtxt, .subtxt1{
		border: 0px;
		text-align: center;
		width: 85%;
		font-family: Oswald;
		font-size: 12px;
	}
	.subtxt1{
		font-size: 14px;
		text-transform: uppercase;
		font-weight: bold;
		margin-bottom: -5px;
	}
</style>
<link rel="icon" href="/citydoc2018/images/print.png"/> 
<title>LR View</title>
<input value = "10" type="hidden" id = "time"/>
<input value = "10" type="hidden" id = "timePayee"/>



<table id="tableMainForm" style="font-family: Oswald;">
	<tr>
		<td style="width: 24%; border-bottom: 1px solid black;"></td>
		<td style="width: 52%; border-bottom: 1px solid black; text-align: center; padding: 35px 0px;">
			<div style="font-size: 24px; font-weight: bold; margin-bottom: -5px;">Republic of the Philippines</div>
			<div>City Government of Davao</div>
		</td>
		<td style="width: 24%; border-bottom: 1px solid black; text-align: right;">
			TN: <span id="dvTracking" style="font-size: 22px; font-family: impact; letter-spacing: 2px;margin-right:21px;"><?php echo $trackingNumber; ?></span>
			<div style="margin-top: -3px; font-size: 13px; text-align: right; padding-right: 22px; letter-spacing: 2px;">DocTrack<span style='font-weight: bold; font-size: 14px;'>2023</span></div>
			<div style="font-size: 12px; margin-top: 10px; text-align: right; padding-right: 22px; letter-spacing: 2px; font-family: Times new roman;">
				<?php echo $m1 . ':' . $m2  . ':' . substr($amountSpent,0,3);  ?>&#9788;
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3" style=" font-weight: bold; font-size: 22px; text-align: center; border-bottom: 1px solid black; letter-spacing: 1px;">
			LIQUIDATION REPORT<span class = "saving" id = "saving">Saved...</span>
		</td>
	</tr>
	<tr>
		<td style="padding: 0px; padding: 2px 0px;" colspan="3">
			<table style=" width: 100%; border-spacing: 0px; padding:0px 8px;" border="0">
				<tr>
					<td style=" text-align: left;">
						<label for="lrRepCenter" style="font-size: 14px;">Respo. Center :</label>
						<input type="text" value ="<?php echo $office;?>" style="border: 0px; border-bottom: 1px solid black; width: 400px;font-family: Oswald;font-size:14px;font-weight:bold;">
					</td>

					<td style="padding-right: 10px; text-align: right; font-size: 14px;">LR&nbsp;No.&nbsp;:</td>
					<td style="width: 130px; text-align: center; font-weight: bold; padding-top: 5px;">
						<input type="text" value = "<?php echo $lrno; ?>" style="border: 0px; border-bottom: 1px solid black;text-align:center;font-family: Oswald;font-size:16px;font-weight: bold;">
					</td>
				</tr>
				<tr>
					<td style=" text-align: right;padding-right: 7px;">
						<label for="lrRepCenter" style="font-size: 14px;">Code :</label>
						<input type="text"  style="font-size:12px;border: 0px; border-bottom: 1px solid black; width: 400px;font-family: Oswald;font-weight: bold;">
					</td>
					<td style="padding-right: 10px; text-align: right; font-size: 14px;">Date :</td>
					<td style="text-align: center; font-weight: bold; padding-top: 5px;">
						<input type="text" style="border: 0px; border-bottom: 1px solid black;width:150px;">
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="padding: 0px;" colspan="3">
			<table style=" width: 100%; border-spacing: 0px; margin-top: 10px; font-weight: bold; letter-spacing: 1px;">
				<tr>
					<td style=" text-align: center; border: 1px solid black; border-left: 0px; padding: 2px 0px;">
						PARTICULARS
					</td>
					<td style=" width: 142px; text-align: center; border-bottom: 1px solid black; border-top: 1px solid black;">
						AMOUNT
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style=" padding: 0px;" colspan="3">
			<table style=" width: 100%; border-spacing: 0px;">
				<tr>
					<td style=" text-align: center; border: 1px solid black; border-top: 0px; border-left: 0px;">
						<textarea id = "textArea" class = "textAreaInput"  style = " height:380px; width:550px; font-family: Oswald; font-size: 14px;" onkeyup="save()" onclick  ="save1()" >
								<?php
									echo $sheet;
								?>
						</textarea>
					</td>
					<td style=" width: 142px; text-align: center;vertical-align:top;padding-top:30px; border-bottom: 1px solid black;">
						 <textarea style = "font-weight:bold;text-align:right;font-size:16px;padding-right:3px; font-family: Oswald; " class = "textAreaInput"><?php  echo  number_format($amountSpent,2); ?></textarea> 
						<!--<textarea style = "font-weight:bold;text-align:right;font-size:16px;padding-right:3px; font-family: Oswald; " class = "textAreaInput"><?php  echo  number_format($cashadvance,2); ?></textarea>-->
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="3" style="padding: 0px;">
			<table style=" width: 100%; border-spacing: 0px; margin-bottom: 20px; text-align: right;">
				<tr>
					<td style="border: 1px solid black; border-top: 0px; border-left: 0px; padding-right: 5px;">Total Amount Spent</td>
					<td style="width: 138px; text-align: right; padding-right: 5px; border-bottom: 1px solid black; font-weight: bold;"><?php  echo  number_format($amountSpent,2); ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; border-top: 0px; border-left: 0px; padding-right: 5px;">Amount of Cash Advance per DV No. <b><?php echo $adv; ?></b></td>
					<td style="text-align: right; padding-right: 5px; border-bottom: 1px solid black; font-weight: bold;"><?php  echo  number_format($cashadvance,2); ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; border-top: 0px; border-left: 0px; padding-right: 5px;">Amount Refunded per OR No. <b><?php echo $orDetails; ?></b><span></span></td>
					<td style="text-align: right; padding-right: 5px; border-bottom: 1px solid black; font-weight: bold;"><?php  echo  $database->zeroToNothing(number_format($refund,2)); ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; border-top: 0px; border-left: 0px; padding-right: 5px;">Amount to be Reimbursed</td>
					<td style="text-align: right; padding-right: 5px; border-bottom: 1px solid black; font-weight: bold;"><?php  echo $database->zeroToNothing(number_format($reim,2)); ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="3" style="padding: 0px;">
			<table style=" width: 100%; border-spacing: 0px; border-top: 1px solid black;">
				<tr>
					<td style=" width: 33.33%; padding: 0px; vertical-align: top; border-right: 1px solid black;">
						<table style=" width: 100%; border-spacing: 0px;">
							<tr>
								<td style="width: 20px;  text-align: center; border: 1px solid black; border-top: 0px; border-left: 0px;">A</td>
								<td style="padding-left: 3px; font-size: 11px;">
									Certified: Correctness of the above data
								</td>
							</tr>
							<tr>
								<td colspan="2" style=" padding: 50px 0px 10px 0px; text-align: center; font-weight: bold;">
									<div style="text-transform: uppercase;">
										<input type="text" class="subtxt1" style="color:black;background-color:white;" disabled placeholder="Name of Claimant" value="<?php echo $claimant;?>">
									</div>
									<div style="font-weight: normal; font-size: 12px;">Claimant</div>
								</td>
							</tr>
						</table>
					</td>
					<td style=" width: 33.33%; padding: 0px; vertical-align: top; border-right: 1px solid black;">
						<table style=" width: 100%; border-spacing: 0px;">
							<tr>
								<td style="width: 20px;  text-align: center; border: 1px solid black; border-top: 0px; border-left: 0px;">B</td>
								<td style="padding-left: 3px; font-size: 11px;">
									Certified: Purpose of Cash Advance duly accomplished
								</td>
							</tr>
							<tr>
								<td colspan="2" style=" padding: 50px 0px 10px 0px; text-align: center; font-weight: bold;">
									<div style="text-transform: uppercase;">
										<input type="text" class="subtxt1" id = "h1" onkeyup = "saveCookie(this)" placeholder="Name of Requester" value="<?php echo $head; ?>">
									</div>
									<div style="font-weight: normal; font-size: 12px;">
										<input type="text" class="subtxt"  id="h2" placeholder="Requesting Office" onkeyup = "saveCookie(this)" value="<?php echo $liqPos; ?>">
									</div>
								</td>
							</tr>
						</table>
					</td>
					<td style=" width: 33.33%; padding: 0px; vertical-align: top;">
						<table style=" width: 100%; border-spacing: 0px;">
							<tr>
								<td style="width: 20px;  text-align: center; border: 1px solid black; border-top: 0px; border-left: 0px;">C</td>
								<td style="padding-left: 3px; font-size: 11px;">
									Certified: Supporting documents complete and proper
								</td>
							</tr>
							<tr>
								<td colspan="2" style=" padding: 50px 0px 10px 0px; text-align: center; font-weight: bold;">
									<div style="text-transform: uppercase;">
										<input type="text" class="subtxt1" name="lrSupporting1" id="lrSupporting1" placeholder="Name" value="Vingelin A. Bajan">
									</div>
									<div style="font-weight: normal; font-size: 12px;">
										<input type="text" class="subtxt" name="lrSupportingPos1" id="lrSupportingPos1" placeholder="Position" value="City Accountant">
									</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<script>
	
	
	function setToCookieParticulars(me){
		var particulars =   me.value.trim();
		setCookie("particulars",particulars, 100);
	}

	var setter = 0;
	function save(){
		document.getElementById("time").value = 1;
		if(setter == 0){
			setter = 1;
			saveThis();
		}	
	}
	function save1(){
		document.getElementById("time").value = 1;
		if(setter == 0){
			setter = 1;
			saveThis();
		}	
	}
	function saveThis(){	
		var x = document.getElementById("time").value;
		time =  x - 1;
		if(x >0){	
			document.getElementById("time").value = time;
			setTimeout("saveThis()",500);
		}else{
			var trackingNumber = document.getElementById("dvTracking").textContent;	
			var textArea = encodeURIComponent(document.getElementById("textArea").value);
			//var textArea = document.getElementById("textArea").value.replace(/\ /g,"/");;
			document.getElementById("saving").className = "saving1";
			setTimeout("changeColor()",500);
			setter = 0;
			var queryString = "?updateParticulars&trackingNumber=" + trackingNumber + "&textArea=" + textArea;
			//alert(queryString);
			var container = "";
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnNothing");	
		}
	}
	function changeColor(){
		document.getElementById("saving").className = "saving";
	}
	
	var setterP = 0;
	function saveP(){
		document.getElementById("timePayee").value = 1;
		if(setterP == 0){
			setterP = 1;
			savePayee();
		}	
	}
	
	function savePayee(){	
		var  x = document.getElementById("timePayee").value;
		time =  x - 1;
		if(x >0){	
			document.getElementById("timePayee").value = time;
			setTimeout("savePayee()",500);
			
		}else{
			var trackingNumber = document.getElementById("dvTracking").textContent;	
			var payeeNumber = encodeURIComponent(document.getElementById("payeeNumber").value);
			
			document.getElementById("saving").className = "saving1";
			setTimeout("changeColor()",500);
			
			setterP = 0;
			var queryString = "?updatePayeeNumber&trackingNumber=" + trackingNumber + "&payeeNumber=" + payeeNumber;
			var container = "";
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnNothing");	
		}
	}
	
	function saveCookie(me){
		if(me.id == 'h1'){
			setCookie ("LiqHead",me.value, 100);
		}else if(me.id == 'h2'){
			setCookie ("LiqPos",me.value, 100);
		}
		
	}
</script>



