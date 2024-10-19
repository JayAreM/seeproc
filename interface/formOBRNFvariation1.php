<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	require_once('../javascript/ajaxFunction.php');
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	$officeName = str_replace("\\",'',$database->charEncoder($_GET['officeName']));
	//$officeName = $_GET['officeName'];
	
	//$payee = str_replace("\\",'',$database->charEncoder($_GET['payee']));	
?>

<style>
	body{
		font-family:arial;
	}
	#tableMainForm{
		margin:0 auto;
		margin-top:50px;
		width:670px;
		border-spacing:0;
	}
	
	#logo{
		width:100px;
		height:100px;
		margin:0 auto;
		background:url(../images/davaologo.jpg);	
		background-repeat:no-repeat;
		background-size:100% 100%; 
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
</style>
<link rel="icon" href="/city/images/print.png"/> 
<title>OBR View</title>

<?php
	
	
	$programCode = array();
	$programName = array(); 
	$codes = array();
	$amount = array();
	$accountTitles =array();
	$fundYear = array();
	$h1 = '<table style ="width:100%;border-spacing:0;" border ="0">
				<tr>
					<td style= "width:140px;padding-bottom:10px;"><div id = "logo"></div></td>
					<td style ="text-align:center;">
						<div style ="width:445px;border:">
							<div style = "font-size:20px;font-weight:bold;">Republic of the Philippines</div>
							<div style = "font-size:16px;">City Government of Davao</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan ="2" style = "font-size:18px;border-top:2px solid black;border-bottom:2px solid black;text-align:center;font-weight:bold;">
						OBLIGATION REQUEST<span style = "margin-left:130px;margin-top:-28px;right;position:absolute;font-weight:normal;"><font style = "font-size:12px;">DocTrack</font> 2023</span>
					</td>
				</tr>
			</table>';
	$type = '';
	$sub = '';
	$obr = '';
	$address = '';
	$particulars = 'VARIATION ORDER NO. 1';
	$tnLabel = 'TN No. ';
	
	$sql = "select Variation2,VariationObr2 from infra where trackingnumber = '" . $trackingNumber . "' limit 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$net = $data['Variation2'];
	$obr = $data['VariationObr2'];
	
	
	$sql = "select Year,PR_ProgramCode,Claimant,NetAmount from vouchercurrent where TrackingNumber = '" . $trackingNumber . "' limit 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	
	$trackYear = $data['Year'];
	$vcProgramCode = $data['PR_ProgramCode'];
	$payee  = $data['Claimant'];
	//$net  = $data['NetAmount'];
	
	$sql = "select BatchNumber from infra where TrackingNumber = '" . $trackingNumber . "' limit 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$batchNo = $data['BatchNumber'];
	$fundTitle = '';
	$row = 13;
	if( strlen($batchNo) <= 8 ){
		array_push($programCode, $vcProgramCode);
		$sql = "select a.FundYear,a.Code, a.Lump, a.Name, a.Amount, a.ExpenseCode, a.SubCode, b.Title from programcode a 
				left join fundtitles b on a.ExpenseCode = b.Code
				where TrackingNumberInfra = '" . $trackingNumber . "' limit 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$fundYear = $data['FundYear'];
		$lump = $data['Lump'];
		$code = $data['Code'];
		$projectTitle = $data['Name'];
		$fundTitle =  $data['Name'];
		$sub =  $data['SubCode'];
		array_push($amount, $net);
		$expenseCode = $data['ExpenseCode'];
		$expenseTitle = $data['Title'];
		array_push($accountTitles, $data['Title']); 
		array_push($codes, $expenseCode);
		$yearDisplay = '';
		
		if($trackYear != $fundYear){
			$yearDisplay = '<tr><td colspan ="3" style = "border-top:2px solid black;border-right:2px solid black;padding-left:15px;font-size:12px;font-weight:bold;">CY' . $fundYear . '</td>
								<td style = "border-top:2px solid black;border-right:2px solid black;"></td>
								<td style = "border-top:2px solid black;"></td>
							</tr>';
			$row = 12;
		}
		if(strlen($lump)> 0){
			$projectTitle = '<br>' . $projectTitle;
			
			$sql = "select Name from programcode where Code = '" . $lump . "' limit 1";
			$record = $database->query($sql);
			$data = $database->fetch_array($record);
			$fundTitle = $data['Name'];
		}else{
			$projectTitle = '';
		}
		array_push($programName, $fundTitle);
	}
	if(strlen($batchNo) > 8 ){
		
		$sql = "select * from infra
				where BatchNumber = '" . $batchNo . "'  order by TrackingNumber asc";
		$record = $database->query($sql);
		$count = $database->num_rows($record);
	
		if($count <= 1){
			array_push($programCode, $vcProgramCode);
			$sql = "select a.FundYear,a.Code, a.Lump, a.Name, a.Amount, a.ExpenseCode, a.SubCode, b.Title from programcode a 
					left join fundtitles b on a.ExpenseCode = b.Code
					where TrackingNumberInfra = '" . $trackingNumber . "' limit 1";
			$record = $database->query($sql);
			$data = $database->fetch_array($record);
			$fundYear = $data['FundYear'];
			
			$lump = $data['Lump'];
			$code = $data['Code'];
			$projectTitle = $data['Name'];
			$fundTitle =  $data['Name'];
			$sub =  $data['SubCode'];
			array_push($amount, $net);
			$expenseCode = $data['ExpenseCode'];
			$expenseTitle = $data['Title'];
			array_push($accountTitles, $data['Title']); 
			array_push($codes, $expenseCode);
			$yearDisplay = '';
			if($trackYear != $fundYear){
				$yearDisplay = '<tr><td colspan ="3" style = "border-top:2px solid black;border-right:2px solid black;padding-left:15px;font-size:12px;font-weight:bold;">CY' . $fundYear . '</td>
									<td style = "border-top:2px solid black;border-right:2px solid black;"></td>
									<td style = "border-top:2px solid black;"></td>
								</tr>';
				$row = 12;
			}
			if(strlen($lump)> 0){
				$projectTitle = '<br>' . $projectTitle;
				
				$sql = "select Name from programcode where Code = '" . $lump . "' limit 1";
				$record = $database->query($sql);
				$data = $database->fetch_array($record);
				$fundTitle = $data['Name'];
			}else{
				$projectTitle = '';
			}
			array_push($programName, $fundTitle);
			
		}
		if($count > 1){
			$tnLabel = 'Batch&nbsp;No.';
			$trackingNumber = $batchNo;
			$tns ='';
			$yearDisplay = '';
			$projectTitle = '';
			$fundTitle =  '';
			while($data = $database->fetch_array($record)){
				$tn = $data['TrackingNumber'];
				$tns  .= ",'" .  $tn . "'";
			}
			
			$tns = substr($tns,1);
			
			$particulars = 'Tracking numbers of the project charges above are ' . $tns;
			$sql = "select a.FundYear,NetAmount,PR_ProgramCode,PR_AccountCode,InfraId,b.Title,c.Name from  
					vouchercurrent a left join FundTitles b on a.PR_AccountCode = b.Code 
					left join programcode c on a.PR_ProgramCode = c.Code
					where a.TrackingNumber in("  . $tns . ") order by TrackingNumber asc";
			$record  = $database->query($sql);
			$programCodes ='';
			$expenseCodes ='';
			while($data = $database->fetch_array($record)){
				array_push($amount, $data['NetAmount']);
				array_push($programCode, $data['PR_ProgramCode']);
				array_push($codes, $data['PR_AccountCode']);
				array_push($fundYear, $data['FundYear']);
				array_push($accountTitles, $data['Title']);
				array_push($programName, $data['Name']);
				
			}	
			
			
			
		}
		
		//$data = $database->fetch_array($record);
		//echo $sql;
	}
	
	
	$h2 = '<table style ="width:100%;border-spacing:0;font-size:13px;border-top:1px solid black;border-bottom:1px solid black;margin-top:2px;padding-bottom:4px;" border ="0">
				<tr>
					<td style ="width:65px;padding-left:5px;">Payee :</td>
					<td style = "border-bottom:2px solid black;">' . strtoupper($payee) .'</td>
					<td style = "width:155px;border-left:0px solid black;border-bottom:2px solid black;padding-left:5px;">
						&nbsp;&nbsp;&nbsp;'.$tnLabel.'<span style = "font-weight:bold;padding-left:5px;font-size:14px;text-overflow:nowrap;white-space: nowrap;" id="trackingNum">' . $trackingNumber .'</span>
					</td>
				</tr>
				<tr>
					<td style ="padding-left:5px;">Office :</td>
					<td style = "border-bottom:2px solid black;"><input style = "width:100%;border:0px;" value = "' . $officeName .'"/></td>
					<td style = "border-bottom:2px solid black;border-left:0px solid black;vertical-align:top;padding-left:5px;">
						OBR No. <span style = "font-weight:bold;padding-left:5px;font-size:15px;">' . $obr . '</span>
					</td>
				</tr>
				<tr>
					<td style ="padding-left:5px;" >Address :</td>
					<td colspan = "2"style = ";"><input style = "width:100%;border:0px;" value = "' . $address . '"/></td>
				</tr>
				
			</table>';	
	
	$des = '';
	if($sub > 0){
		$sql = "select * from subprogramcode where SubCode = '" . $sub . "'";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$des = $data['Description'];
	}
	
	$h3 = '<table style = "width:100%;border-top:1px solid black;border-bottom:1px solid black;border-spacing:0;margin-top:1px;" border="0">
			 <tr style = "font-size:12px;font-weight:bold;">
				<td style = "width:80px;border-right:2px solid black;padding:5px;text-align:center;">Responsibility Center</td>
				<td style = "width:50px;text-align:center;border-right:2px solid black;padding:5px;">F.P.P</td>
				<td style = "width:250px;border-right:2px solid black;padding:5px;padding-left:30px;">Particulars</td>
				
				<td style ="width:70px;text-align:center;border-right:2px solid black;padding:5px;">Account Code</td>
				<td style ="width:70px;text-align:center;padding:5px;">Amount</td>
			  <tr>';
		  
	
	$header = '';
	
	
	for($i = 0; $i < sizeof($amount);$i++){
		
		if($header != $programCode[$i]){
			$fYear = '';

			// if($trackYear != $fundYear[$i]){
			// 	$fYear = 'CY'. $fundYear[$i] ;
				
			// }
			// if(sizeof($fundYear) <= 1){ // id isa lang ang  record
			// 	$fYear = '';
			// }

			if(gettype($fundYear) == 'array') {
				
				if($trackYear != $fundYear[$i]){
					$fYear = 'CY'. $fundYear[$i] ;
				}
			
				if(sizeof($fundYear) <= 1) {
					$fYear = '';
				}
			
			}else {
				if(strlen($fundYear) <= 1) {
					$fYear = '';
				}
			}

			$h3 .= $yearDisplay;
			$h3 .= '<tr style ="font-size:12px;">';
			$h3 .= '	<td colspan = "3" style = "text-align:left;font-weight:bold;border-top:2px solid black;border-right:2px solid black;padding:2px;padding-left:15px;">
							'  . $fYear . ' ' . $programCode[$i] . '
							<span style = "font-weight:normal;"> ' .   $programName[$i] .  $projectTitle . '</span>
						</td>';
			$h3 .= '	<td style ="border-top:2px solid black;border-right:2px solid black;">&nbsp;</td>';
			$h3 .= '	<td style ="border-top:2px solid black;;">&nbsp;</td>';
			$h3 .= '</tr>';
			$header = $programCode[$i];
		}
		$h3 .= '<tr style ="font-size:12px;">';
		$h3 .= '	<td colspan = "3"  style ="text-align:left;border-top:2px solid black;border-right:2px solid black;border-top:2px solid black;padding:0"><input style = "padding-left:80px;width:100%;border:0;" value = "' . $accountTitles[$i]. '"/></td>';
		$h3 .= '	<td style ="text-align:center;border-top:2px solid black;border-right:2px solid black;border-top:2px solid black;font-weight:bold;">'. $codes[$i] .'</td>';
		$h3 .= '	<td style ="font-size:13px;text-align:right;border-top:2px solid black;border-top:2px solid black;padding-right:10px;font-weight:bold;">'. number_format($amount[$i],2) .'</td>';
		$h3 .= '</tr>';
	}
	if($type ==3){
		$i = $i * 2 -1;
	}
	for($j = 0; $j < ($row-$i); $j++ ){
			$h3 .= '<tr>';
			$h3 .= '	<td colspan = "3" style = "border-top:2px solid black;border-right:2px solid black;"><input style = "border:0;width:100%;" /></td>';
			$h3 .= '	<td style = "border-top:2px solid black;border-right:2px solid black;"></td>';
			$h3 .= '	<td style = "border-top:2px solid black;">&nbsp;</td>';
			$h3 .= '<tr>';
	}
	$h3 .= '<tr><td colspan = "2" style = "border-top:2px solid black;border-right:0px solid black;"></td>
				<td style = "border-top:2px solid black;border-right:2px solid black;font-family:Oswald;text-align:right;font-weight:bold;padding-right:10px;letter-spacing:1px;">' . $des . '</td>
				<td style = "border-top:2px solid black;border-right:2px solid black;">&nbsp;</td>
				<td style = "border-top:2px solid black;">&nbsp;</td>
			</tr>';
	$h3 .= '<tr  style = "font-size:12px;">
				<td colspan ="3" rowspan = "3" style = "border-top:2px solid black;border-right:2px solid black;">
					<div style = "padding-left:5px;">Particulars: <span id="showSaving" class="saving1" style="display: none;">SAVING</span></div>
					<textarea id="obrParticulars" style = "overflow:hidden; resize:none;padding:0px 10px;;width:100%;height:50px;border:0;" onkeyup="checkBeforeSave()" onclick="checkBeforeSave()"> ' . $particulars . ' </textarea>
				
				</td>
				<td style = "border-top:2px solid black;border-right:2px solid black;">&nbsp;</td>
				<td style = "border-top:2px solid black;">&nbsp;</td>
			</tr>';
	$h3 .= '<tr style = "font-size:12px;">
				<td style = "border-top:2px solid black;border-right:2px solid black;">&nbsp;</td>
				<td style = "border-top:2px solid black;">&nbsp;</td>
			</tr>';
	$h3 .= '<tr style = "font-size:12px;">
				<td style = "border-top:2px solid black;border-right:2px solid black;">&nbsp;</td>
				<td style = "border-top:2px solid black;">&nbsp;</td>
			</tr>';	
	$h3 .= '<tr style = "font-size:12px;font-weight:bold;">';
	$h3 .= '	<td colspan = "3" style = "padding:7px;border-top:2px solid black;color:grey;">COMPUTER GENERATED FORM <span style ="letter-spacing:2px;font-size :10px;font-style:italic;"> '  .  substr(strrev($trackingNumber),0,1) . substr(array_sum($amount),0,2)  . ' </font></td>';
	$h3 .= '	<td  style = "padding:7px;padding-right:5px;text-align:right;border-top:2px solid black;">Total</td>';
	$h3 .= '	<td style ="font-size:13px;text-align:right;padding:7px;border-top:2px solid black;font-weight:bold;padding-right:10px;">' .  number_format(array_sum($amount),2) . '</td>';
	$h3 .= '<tr>';
	$h3 .= '</table>';
	
	
	if(isset($_COOKIE['obrCertifiedBy'])){
		$obrCertifiedBy =$_COOKIE['obrCertifiedBy'];
	}else{
		$obrCertifiedBy = '';
	}
	if(isset($_COOKIE['obrCertifiedDesignation'])){
		$obrCertifiedDesignation =$_COOKIE['obrCertifiedDesignation'];
	}else{
		$obrCertifiedDesignation = '';
	}
	$h4 ='<table style = "border-top:1px solid black;border-bottom:1px solid black;margin-top:1px;border-spacing:0;padding-bottom:1px;"><tr>
			<td >
				<table style ="border-spacing:0;">
					<tr>
						<td style = "width:50%;border-right:1px solid;vertical-align:top;">
							<table style ="border-spacing:0;font-size:12px;" border="0">
								<tr>
									<td>A.Certified:</td>
									<td></td>
								</tr>
								<tr>
									<td><div style = "border:1px solid;">&nbsp;</div></td>
									<td>Charges to appropriation/allotment necessary, lawful, and under my direct supervision.</td>
								</tr>
								<tr>
									<td><div style = "border:1px solid;">&nbsp;</div></td>
									<td>Supporting documents valid, proper, and legal.</td>
								</tr>
								<tr>
									<td colspan = "2" style = "padding:17px 0px;"></td>
								</tr>
								<tr>
									<td colspan = "2" style = "font-weight:bold; padding:10px;text-align:center;padding-bottom:0px;">
										<input style = "font-family:arial;font-weight:bold; width:300px;font-size:12px;border:0;text-align:center;" placeholder="Type name" value = "' . $obrCertifiedBy . '" onkeyup = "setToCookieName(this)"/><br/>
										
										<input style = "width:300px;font-size:12px;text-align:center;border:0;" placeholder="Type position"  value = "' . $obrCertifiedDesignation . '" onkeyup = "setToCookieDesignation(this)" />
										
										<input style = "width:100%;margin-top:10px;font-weight:bold;font-size:11px;border:0;"/>
										<input style = "width:100%;font-size:11px;border:0;"/>
									
									</td>
								</tr>
								<tr>
									<td colspan = "2" style = "">
										Date:<input style = "display:inline-block;font-size:12px; border:0;"  value = ""  />
									</td>
								</tr>
								
							</table>	
						<td/>
						<td style = "width:50%;border:0px solid;vertical-align:top;">
							<table style = "width:100%; font-size:12px;border-spacing:0; " border="0">
								<tr>
									<td colspan="2">B.Certified:</td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
									
								</tr>
								<tr>
									<td style = "width:80px;">&nbsp;</td>
									<td >Existence of available appropriation</td>
								</tr>
								<tr>
									<td colspan="2" style = "padding:20px 0px;">&nbsp;</td>
								</tr>
								<tr>
									<td colspan = "2" style = "font-weight:bold; padding:10px;text-align:center;">
										ERMELINDA F. GALLEGO<br/><span style = "font-weight:normal;" >CITY BUDGET OFFICER</span>
									</td>
								</tr>
								<tr>
									<td colspan="2" style = "padding:0px 0px;">Date</td>
								</tr>
								<tr>
									<td colspan="2" style = "padding:0px 0px;">CBO Transaction No.:</td>
								</tr>
							</table>	
						<td/>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td  style = "border-top:2px solid black;border-bottom:1px solid black;font-size:8px;padding:0px 0px;padding:2px;" valign="top">
				While(original) to be attached to the Disbursement voucher; Pink Copy for CBO; Yellow Copy for Accounting;
				 and Green Copy for Concerned Office.
			</td>
		</tr></table>';
	
	
	
	$form = '<div style = "border:2px solid black;border-bottom:0px solid black; width:670px;margin:0 auto;">';	
	$form .=  $h1;	
	$form .=  $h2;	
	$form .=  $h3;
	$form .=  $h4;
	$form .= '</div>';
	echo $form;
	
?>
<script>
	
	function setToCookieName(me){
		var obrCertified =   me.value.trim();
		setCookie("obrCertifiedBy",obrCertified, 100);
	}
	function setToCookieDesignation(me){
		var obrCertifiedDesignation =   me.value.trim();
		setCookie("obrCertifiedDesignation",obrCertifiedDesignation, 100);
	}

	var thisCount = 3;
	var contEntry = 0;
	function checkBeforeSave() {
		thisCount = 3;
		if (contEntry == 0) {
			contEntry = 1;
			saveParticulars();
		}
	}

	function saveParticulars() {
		var tn = document.getElementById('trackingNum').innerText;
		var particulars = encodeURIComponent(document.getElementById('obrParticulars').value);

		var queryString = "?updateOBRParticulars=1&trackingNumber="+tn+"&obrparticulars="+particulars;
		var container = "";
		
		console.log(thisCount);
		thisCount--;
		if (thisCount > 0) {
			setTimeout("saveParticulars()", 400);
		} else {
			loadSaving();
			thisCount = 3;
			contEntry = 0;
			ajaxGetAndConcatenate(queryString, processorLink, container, "updateOBRParticulars");
		}
	}

	function loadSaving() {
		var saving = document.getElementById("showSaving");
		if (saving.style.display == "none") {
			saving.style.display = "inline-block";
		} else {
			saving.style.display = "none";
		}
	}
</script>
