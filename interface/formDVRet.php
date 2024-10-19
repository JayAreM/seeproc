<?php
	session_start();

	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('../../citydoc2023/interface/login.php','_self')</script>";
		echo $link;
	}
	
	
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	
	
	
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	$acct = $_SESSION['accountType'];
	$logOffice = $_SESSION['officeCode'];

	$m1 = strrev(substr($trackingNumber,0,2));
	$year  = "2023";
	// $charges = '<span style = "font-weight:bold;font-size:12px;">Chges: </span>';
    				
    $sheetSpace = '';				
	for ($i = 0 ; $i <= 1610; $i++ ){
		$sheetSpace .= "~";
	}				
    $sheetSpace = preg_replace('/[~]/', ' ',$sheetSpace);


	$sql = "SELECT * FROM vouchercurrent WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$office = $data['Office'];
	$claimant  = $data['Claimant']; 
	$trackingType = $data['TrackingType'];
	$program = $data['PR_ProgramCode'];
	$docType = $data['DocumentType'];
	$fund  = $data['Fund'];
	$fundType = $data['Fund'];
	$trackingPartner = $data['TrackingPartner'];
	$year = $data['Year'];
	$periodMonth = $data['PeriodMonth'];

	$total = $data['TotalAmountMultiple'];
	$poAmount = $data['PO_Amount'];
	$amount = $data['Amount'];
	$chargeType = $data['ChargeType'];

	// $charges =  '<span style = "font-weight:bold;font-size:12px;">' .$program . '</span>' .  number_format($amount,2) ;

	$gross = $amount;

	$periodType = $data['PeriodType'];  
	$claimant = strtoupper($data['Claimant']);

	$payrollFirst = $data['PayrollAmountFirst'];
	if($payrollFirst  > 0){
		$amount =  $payrollFirst;
		$gross = $amount;
	}

	$amountT = $data['TotalAmountMultiple'];
	if($amountT > 0){
		$amount = $amountT;
		$gross = $amount;
	}

	$netAmount = $data['NetAmount'];

	$adv = $data['ADV1'];
	if($adv == 0 || $adv ==99999){
		$adv = '&nbsp;&nbsp;&nbsp;&nbsp;';
	}

	$payeeNumber = $data['PayeeNumber']; 
	$m2 = strrev(substr($claimant,1,3));
	$firstName =   $claimant . '(<input id = "payeeNumber" style = "width:50px;text-align:center;border:0;" maxlength = "6" value = "' .  $payeeNumber . '" onkeyup="saveP()"  />)';

	if($docType == 'WAGES - INCIDENTAL EXPENSE' && $payeeNumber != "") {
		$firstName =   strtoupper($data['Claimant']) . '(<input id = "payeeNumber" style = "width:50px;text-align:center;border:0;" maxlength = "6" value = "' .  $payeeNumber . '" onkeyup="saveP()"  />)';
	}

	$obr = $data['OBR_Number'];
	if($obr == ''){
		$obr = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	}

	unset($data);

	$sql = "SELECT * FROM office  WHERE Code = '".$office."' LIMIT 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$officeName = $data['Name'];
    
	unset($data);

	$sql = "SELECT * FROM particulars WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$explanation = nl2br($data['Particulars']);

	unset($data);

	$sql = "SELECT * FROM supplier.supplierinfo WHERE Name = '".$claimant."' LIMIT 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$address = $data['Address'];

	unset($data);

	$pre = $_SESSION['perm'];
	if($pre == 30){
		$sponsor = " PCSO (Malasakit Pagkalinga sa Bayan) ";
		$officeName = "PCSO";
	}else{
		$sponsor = " Lingap Para sa Mahirap ";
	}
	
	if( strtoupper($fund) == "GENERAL FUND"){
		$fund = "<span style = 'font-family:impact;font-size:36px;'>GEN FUND</span><br/><span style = 'font-family:helvetica;font-weight:bold;'>100</span> <span style = 'font-family:helvetica'>" . $year . "</span>";
	}
	if(strtoupper($fund) == "SEF"){
		$fund = "<span style = 'font-family:impact;font-size:48px;'>SEF</span><br/><span style = 'font-family:helvetica;font-weight:bold;'>200</span> <span style = 'font-family:helvetica'>" . $year . "</span>";
	}
	if(strtoupper($fund) == "TRUST FUND"){
		$fund = "<span style = 'font-family:impact;font-size:30px;'>TRUST FUND</span><br/><span style = 'font-family:helvetica;font-weight:bold;'>300</span> <span style = 'font-family:helvetica'>" . $year . "</span>";
	}

	// $bankAccount = "";
	// if($fundType == 'Trust Fund') {

	// 	$sql = "SELECT PR_ProgramCode FROM vouchercurrent WHERE TrackingNumber = '".$trackingNumber."'";
	// 	$record = $database->query($sql);

	// 	$progCodes = "";
	// 	while($data = $database->fetch_array($record)){
	// 		$program = $data['PR_ProgramCode'];
	// 		$progCodes .= ",'".$program."'";
	// 	}

	// 	$sql = "SELECT BankAccount FROM programcode WHERE Code IN (".substr($progCodes, 1).") LIMIT 1";
	// 	$record = $database->query($sql);

	// 	if($database->num_rows($record) > 0) {
	// 		$data = $database->fetch_array($record);
	// 		$bankAccount = $data['BankAccount'];

	// 		$sheet .= "\n\nBANK ACCOUNT : ".$bankAccount;
	// 	}

	// }

	$sheet = "";
	$sql = "SELECT TrackingNumber FROM vouchercurrent WHERE TrackingPartner = '".$trackingNumber."' GROUP BY TrackingNumber";
	$record = $database->query($sql);

	$poTNs = "";
	while ($data = $database->fetch_array($record)) {
		$poTNs .= ",'".$data['TrackingNumber']."'";
	}

	$sql = "SELECT a.TrackingNumber as pxTN, a.PO_Number, a.checkdate, a.TrackingPartner as poTN, a.Fund, b.InvoiceNumber, b.InvoiceDate, c.Retention
			FROM vouchercurrent a 
			LEFT JOIN particulars b ON a.TrackingPartner = b.TrackingNumber 
			LEFT JOIN pxvouchertax c ON a.TrackingNumber = c.TrackingNumber
			WHERE TrackingPartner IN (".substr($poTNs, 1).") GROUP BY a.TrackingNumber ORDER BY a.DateReleased ASC;";
	$record = $database->query($sql);

	$grossRetention = 0;
	$sheet .= "<table border='0' cellpadding='0' style='border-spacing:0px; border-collapse:collapse;'>
				<tr style='border-bottom:1px dashed black;'>
					<td style='padding:2px 8px;'>TN</td>
					<td style='padding:2px 8px;'>PO No.</td>
					<td style='padding:2px 8px;'>INV#</td>
					<td style='padding:2px 8px;'>INV DATE</td>
					<td style='padding:2px 8px; text-align:right;'>AMOUNT</td>
				</tr>
	";
	while ($data = $database->fetch_array($record)) {
		$pxTN = $data['pxTN'];
		$poNumber = $data['PO_Number'];
		$checkdate = $data['checkdate'];
		$poTN = $data['poTN'];
		$fund = $data['Fund'];
		$invNumber = $data['InvoiceNumber'];
		$invDate = $data['InvoiceDate'];
		$retention = $data['Retention'];

		$grossRetention += $retention;

		$sheet .= "	<tr>
						<td style='padding:2px 8px;'>".$poTN."</td>
						<td style='padding:2px 8px;'>".$poNumber."</td>
						<td style='padding:2px 8px;'>".$invNumber."</td>
						<td style='padding:2px 8px;'>".$invDate."</td>
						<td style='padding:2px 8px; text-align:right;'>".number_format($retention, 2)."</td>
					</tr>";
	}

	$sheet .= "	<tr style='border-top:1px dashed black;'>
					<td colspan='5' style='padding:2px 8px; text-align:right;'><span style='margin-right:10px; font-size:10px; font-weight:bold;'>TOTAL</span>".number_format($grossRetention, 2)."</td>
				</tr>";

	$sheet .= "</table>";
?>

<style>
	/*@font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
	}*/
	
	#tableMainForm{
		margin:0 auto;
		width:700px;
		border-spacing:0;
		border:2px solid black;
		//font-family:Oswald;
	}
	.headPhil{
		font-weight:bold;
		font-family:Oswald;
		font-size: 28px;
	}
	#logo{
		
		border-radius: 50%;
		
		width:100px;
		height:100px;
		float: right;
		background:url(../images/dvo.png);	
		background-repeat:no-repeat;
		background-size:100% 100%; 
		box-shadow: 0px 0px 10px 2px white inset;
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
		margin-left:160px;
		padding: 0px 10px;
		color:white;
		visibility: hidden;
		
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
	}
	.fontUp, .fontDown{
		
		color:grey;
		margin-top:-6px;cursor:pointer;font-size:28px;
		font-size:22px;
		webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; 
		transition: all .4s ease-in;
	}
	.fontUp:hover{
		color:orange;
	}
	.fontDown:hover{
			color:orange;
	}
	.fontUp:hover:after{
		
		content: "Increase font size.";
		font-family: Oswald;
		position: absolute;
		color:white;
		background-color: orange;
		width:200px;
		border-bottom: 1px solid black;
		margin-top:-26px;
		margin-left:-9px;
	}
	.fontDown:hover:after{
		content: "Decrease font size.";
		font-family: Oswald;
		position: absolute;
		color:white;
		background-color: orange;
		width:200px;
		border-bottom: 1px solid black;
		margin-top:-26px;
		margin-left:-2px;
	}

	#psTable, #gvTable {
		border-collapse:collapse;
		font-family:Arial;
		font-size:11px;
	}

	#psTable > tbody > tr > td, 
	#gvTable > tbody > tr > td {
		padding:1px 3px;
		text-transform:uppercase;
		text-align:right;
	}

</style>
<link rel="icon" href="/citydoc2023/images/Print.png"/> 
<title>DV View</title>
<input value = "10" type="hidden" id = "time"/>
<input value = "10" type="hidden" id = "timePayee"/>	

<table id = "tableMainForm" border = "0" >
	<tr>
		<td  style = "border:1px solid black;padding:10px 0px; " valign="top">
			<table style ="width:100%;" border ="0">
				<tr >
					<td style= "width:200px;"><div id = "logo"></div></td>
					<td style ="text-align:center;text-overflow:nowrap;white-space: nowrap;"><span class = "headPhil" style = "">Republic of the Philippines</span><br/><span style = "font-family:Oswald;font-weight:bold;text-shadow: 0px 0px 5px white;">City Government of Davao</span></td>
					<td style= "width:150px;text-align:center;vertical-align:bottom;"><?php echo $fund; ?><div style = 'padding-top:5px;letter-spacing:2px;font-size:12px;font-family: Oswald;'><?php echo $m1 . ':' . $m2  . ':' . substr($amount,0,3);  ?>&#9788;</div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td  style = "padding:2px;text-align:center;border:1px solid black;" valign="top">
			<span style = "font-weight:bold;font-size:20px;letter-spacing:1px;font-family: Oswald;font-weight: bold;">DISBURSEMENT VOUCHER</span>
		</td>
	</tr>
	<tr>
		<td  style = "padding:2px;text-align:center;border:1px solid black;" valign="top">
			<table style = "width:90%;border-spacing:0px;margin-left:20px;" border="0">
				
				<tr>
					<td style = "width:20px;border:1px solid black;"></td>
					<td style = "width:30px;text-align:left;">Check</td>
					<td style = "width:20px;border:1px solid black;""></td>
					<td style = "width:30px;text-align:left;">Cash</td>
					<td style = "width:20px;border:1px solid black;""></td>
					<td style = "width:150px;text-align:left;">Others</td>
					<!--<td  colspan = "2" style = "width:100px;padding-left:20px;text-align: center;">ADV No.<span style = "width:100px;text-align:left;padding-left:12px;font-size: 20px;font-weight: bold;"><?php echo $adv; ?></span></td>-->
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td  style = "padding:2px;text-align:center;border:1px solid black;border-bottom:0;" valign="top">
			<table style = "border-spacing:0;width:100%;" border ="0">
				<tr>
					<td style = "letter-spacing:1px;font-family: Oswald;font-weight: bold;">Payee&nbsp;:</td>
					<td style = "border-bottom:1px solid black;"><span style = "font-weight:bold;font-size:16px;font-family: Oswald;letter-spacing:1px;"><?php echo $claimant; ?></span></td>
					<td style = "border-bottom:1px solid black;text-align:left;letter-spacing:1px;font-family: Oswald;font-weight: bold;">&nbsp;&nbsp;ADV&nbsp;No.</td>
					<td style = "border-bottom:1px solid black;"><span style = "font-weight:bold;font-size: 20px;"><?php echo $adv; ?></span></td>
				</tr>
				<tr>
					<td style = "width:70px;letter-spacing:1px;font-family: Oswald;font-weight: bold;">Address&nbsp;:</td>
					<td style = "width:430px;border-bottom:1px solid black;"><input style = "width:100%;border:0px;font-family: Oswald;font-size:12px;" value = "<?php echo $address ;?>"/></td>
					<td style = "border-bottom:1px solid black;text-align:left;letter-spacing:1px;font-family: Oswald;font-weight: bold;">&nbsp;&nbsp;OBR&nbsp;No.</td>
					<td style = "border-bottom:1px solid black;"><span style = "font-weight:bold;font-size: 18px;"><?php echo $obr; ?></span></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td  style = "padding:2px;text-align:center;border:1px solid black;border-top:0px; " valign="top">
			<table style = "border-spacing:0;width:100%;" border = "0">
				<tr>	
					<td colspan="3" style = "padding-left:11px;text-align:left;border-bottom:1px solid black;letter-spacing:1px;font-family: Oswald;">Responsibility Center</td>
					<td style = "width:214px;text-align:right;padding-right:8px;border-bottom:1px solid black;letter-spacing:1px;font-family: Oswald;font-weight: bold;">TN : <span id = "dvTracking" style = "padding-left:4px;font-weight:bold;font-size:20px;"><?php echo $trackingNumber; ?></span></td>
				</tr>
				<tr>
					<td colspan = "5" style = "width:150px;border-left:0px solid black;padding-left:10px;letter-spacing:1px;font-family: Oswald;font-weight: bold;">Office :<input style = "border:0;width:90%;display:inline;"  value = "<?php echo  $officeName;  ?>"/></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td  style = "padding:2px;text-align:center;border:1px solid black;border-top:0px; " valign="top">
			<table style = "border-spacing:0;border-top:1px solid black;" border = "0">
				<tr>
					<td style = "text-align:center; border-right:1px solid black;padding:2px;font-family: Oswald;font-weight: bold;letter-spacing: 1px;" onmouseover="showSize()" onmouseout = "hideSize()">
							<span id = "size1" class = "fontDown" style ="visibility:hidden; float:left;position:absolute;margin-left:-219px;margin-top:-4px;" onclick = "changeSize('down')">&#9660;</span>
							<span id = "size2" class = "fontUp" style ="visibility:hidden;float:left;position:absolute;margin-left:-235px;margin-top:-8px;" onclick = "changeSize('up')">&#9650;</span>
							<span style = "cursor: pointer;" onclick = "forceSave()">Explanation</span>
							<span class = "saving" id = "saving">Saved...</span></td>
					<td style = "text-align:center; padding:2px; width:10%; font-family:Oswald; font-weight: bold; letter-spacing:1px;">Amount</td>
				</tr>
				<tr>
					<td style = "text-align:center;border-right:1px solid black;border-top:1px solid black; vertical-align:top; padding:5px 5px;">
						<table border="0" cellpadding="0" style="height:100%; border-collapse:collapse;">
							<tr>
								<td style="height:1px;">	
									<div id = "textArea"  style = "text-indent:30px; text-align:justify; ext-justify:inter-word; line-height:16px; font-family:Arial; font-size:12px; padding-top:10px; width:100%; text-transform:uppercase;" >
										<?php 
											echo trim($explanation);
										?>
									</div>
								</td>
							</tr>
							<tr>
								<td style="vertical-align:top; padding-top:10px;">
									<?= trim($sheet) ?>
								</td>
							</tr>
						</table>
					</td>
					<td style = "text-align:center;padding:0px;border-top:1px solid black;height:260px;vertical-align:top;padding-top:30px;">
						<textarea style = "font-weight:bold;text-align:right;font-size:14px;padding-right:5px;" class = "textAreaInput" readonly></textarea>
					</td>
				</tr>
				<?php
					if($payeeNumber ==''){
						$firstName = '';
					}
				?>
				<tr>
					<td style = "border-right:1px solid black;padding-left:10px;">
						<span style = "float:right;font-weight: bold;padding-right:5px;font-size: 18px;letter-spacing:1px;font-family: Oswald;font-weight: bold;">Net Amount</span>
					</td>
					<?php
						$thisNet = $netAmount;
					?>
					<td style="border-top:1px solid black; font-size:32px;">
						<input style = "font-family:arial; width:142px;border:0;text-align:right;font-weight:bold;font-size:16px;letter-spacing:1px;padding-right:1px" readonly value ="<?php echo  $database->zeroToNothing(number_format($thisNet,2)); ?>"/>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style = "border:1px solid;width:100%;">
			<table style ="border-spacing:0; width:100%;">
				<tr>
					<td style = "width:50%;border-right:1px solid;vertical-align:top;">
						<table style ="border-spacing:0;font-size:11px;" border="0">
							<tr>
								<td>A.Certified:</td>
								<td></td>
							</tr>
							<tr>
								<td><div style = "border:1px solid;">&nbsp;</div></td>
								<td>Allotment obligated for the  purpose as indicated above</td>
							</tr>
							<tr>
								<td><div style = "border:1px solid;">&nbsp;</div></td>
								<td>Supporting documents complete</td>
							</tr>
							<tr>
								<td colspan = "2" style = "padding:15px 0px;"></td>
							</tr>
							<tr>
								<td colspan = "2" style = "font-weight:bold; padding:10px;padding-left:45px;text-align:center;font-size: 14px;">
									VINGELIN A. BAJAN<br/><span style = "font-weight:normal;" >City Accountant</span>
								</td>
							</tr>
						</table>	
					</td>
					<td style = "width:50%;border:0px solid;vertical-align:top;" >
						<table style = "width:100%; border-spacing:0; font-size: 11px;" border="0">
							<tr>
								<td colspan="2">B.Certified:</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
								
							</tr>
							<tr>
								<td style = "width:100px;">&nbsp;</td>
								<td >Funds Available</td>
							</tr>
							<tr>
								<td colspan="2" style = "padding:16px 0px;">&nbsp;</td>
							</tr>
							<tr>
								<td colspan = "2" style = "font-weight:bold; padding:5px;text-align:center;font-size: 14px;">
									LAWRENCE D. BANTIDING<br/><span style = "font-weight:normal;" >City Treasurer</span>
								</td>
							</tr>
							
						</table>	
					</td>
					
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style = "border:1px solid;border-bottom:1px solid black;">
			<table style ="border-spacing:0;">
				<tr>
					<td style = "width:50%;border-right:1px solid;vertical-align:top;">
						<table style ="border-spacing:0;width:100%;font-size: 11px;" border="0">
							<tr>
								<td colspan="2">C. Approved for Payment</td>
								
							</tr>
							
							<?php
								if($office == "1021" || $office == "1016"){
									// $name = "SEBASTIAN Z. DUTERTE";
									$name = "J. MELCHOR B. QUITAIN, JR.";
									$designation = "City Vice Mayor";
								}else{
									// $name = "SARA Z. DUTERTE";
									$name = "SEBASTIAN Z. DUTERTE";
									$designation = "City Mayor";
								}
							?>
							<tr>
								<td colspan = "2" style = "font-weight:bold; padding:5px;padding-top:100px;text-align:center;">
									<input style="text-align:center;border:0;width:100%;font-weight:bold;font-size:14px;" value = "<?php echo $name; ?>"/><br/>
									<input style="text-align:center;border:0;font-size:14px;" value = "<?php echo $designation; ?>"/><br/>
								</td>
							</tr>
						</table>	
					</td>
					<td style = "width:50%;border:0px solid;vertical-align:top;">
						<table style = "width:100%; border-spacing:0;font-size:11px; " border="0">
							<tr>
								<td colspan="2">D. Received Payment:</td>
							</tr>
							<tr>
								<td >Check No.:</td>
								<td style = "border-bottom:1px solid black;"></td>
							</tr>
							<tr>
								<td >Name of Bank:</td>
								<td style = "border-bottom:1px solid black;"></td>
							</tr>
							<tr>
								<td style = "width:150px;padding-top:10px;">Signature:</td>
								<td style = "border-bottom:1px solid black;padding-top:10px;"></td>
							</tr>
							<tr>
								<td style = "width:150px;">&nbsp;</td>
								<td style = "border-bottom:0px solid black;"></td>
							</tr>
							<tr>
								<td colspan="2" style = "border:1px solid black;padding:2px 0px;border-left:0px;border-right:0px;">Printed Name :
									<input style = "width:310px;border:1px;font-weight:bold;"/>
								</td>
							</tr>
							<tr>
								<td >Date Received:</td>
								<td style = "border-bottom:1px solid black;"><input style = "width:100%;border:0;font-weight:bold;"/></td>
							</tr>
							<tr>
								<td colspan ="2">O.R. No./Other relevant document issued:</td>
							</tr>
							<tr>
								<td style = "width:150px;padding-top:0px;">JEV No.:</td>
								<td style = "border-bottom:1px solid black;padding-top:10px;"></td>
							</tr>
							<tr>
								<td style = "width:150px;padding-top:0px;">Date:</td>
								<td style = "padding-top:10px;"></td>
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
			setTimeout("saveThis()",400);
		}else{
			var trackingNumber = document.getElementById("dvTracking").textContent;	
			var textArea = encodeURIComponent(document.getElementById("textArea").value.trimRight());
			
		
			document.getElementById("saving").className = "saving1";
			setTimeout("changeColor()",400);
			setter = 0;
			//var queryString = "?updateParticulars&trackingNumber=" + trackingNumber + "&textArea=" + textArea;
			var queryString = "updateParticulars1&trackingNumber=" + trackingNumber + "&textArea=" + textArea;
			var container = "";
			//ajaxGetAndConcatenate(queryString,processorLink,container,"returnNothing");	
			ajaxPost(queryString,processorLink,container,"returnNothing");	
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
			setTimeout("savePayee()",400);
			
		}else{
			var trackingNumber = document.getElementById("dvTracking").textContent;	
			var payeeNumber = encodeURIComponent(document.getElementById("payeeNumber").value);
			
			document.getElementById("saving").className = "saving1";
			setTimeout("changeColor()",400);
			
			setterP = 0;
			var queryString = "?updatePayeeNumber&trackingNumber=" + trackingNumber + "&payeeNumber=" + payeeNumber;
			var container = "";
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnNothing");	
		}
	}
	function changeSize(change){
		var text = document.getElementById("textArea");
		var oldSize = text.style.fontSize.replace("px","");
		var lineheight = text.style.lineHeight.replace("px","");
		if(change == "up"){
			oldSize++;
			lineheight++;
		}else{
			oldSize--;
			lineheight--;
		}
		text.style.fontSize = oldSize + "px";
		text.style.lineHeight = lineheight + "px";
	}
	function showSize(){
		
		document.getElementById('size1').style.visibility = "visible";
		document.getElementById('size2').style.visibility = "visible";
		
	}
	function hideSize(){
		document.getElementById('size1').style.visibility = "hidden";
		document.getElementById('size2').style.visibility = "hidden";
	}
	function forceSave(){
		var trackingNumber = document.getElementById("dvTracking").textContent;	
		var textArea = encodeURIComponent(document.getElementById("textArea").value.trimRight());
		document.getElementById("saving").className = "saving1";
		setTimeout("changeColor()",400);
		setter = 0;
		var queryString = "updateParticulars1&trackingNumber=" + trackingNumber + "&textArea=" + textArea;
		var container = "";
		ajaxPost(queryString,processorLink,container,"returnNothing");	
	}
</script>



