<?php
	session_start();

	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('../../citydoc2023/interface/login.php','_self')</script>";
		echo $link;
	}
	
	
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	
	
	
	$trackingNumber = $database->charEncoder($_GET['trackingNumber']);
	
	//$record = $database->SearchByTrackingNumber($trackingNumber);
	//$record = $database->SearchTracking($trackingNumber);

	// $record = $database->SearchTrackingToVoucher($trackingNumber);
	// $count = $database->num_rows($record);

	$acct = $_SESSION['accountType'];
	$logOffice = $_SESSION['officeCode'];
	
	$m1 = strrev(substr($trackingNumber,0,2));
	$year  = "2023";
	$charges = '<span style = "font-weight:bold;font-size:12px;">Chges: </span>';
    				
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
	if($chargeType == 2 || $chargeType == 3){
		$amount = $total;
		if($poAmount > 0){
			$charges .=  '<span style = "font-weight:bold;font-size:12px;">' .$program . '</span>:' . number_format($poAmount,2) . ', ';
		}else{
			// $amount = $data['Amount'];
			$charges .=  '<span style = "font-weight:bold;font-size:12px;">' .$program . '</span>:' . number_format($amount,2) . ', ';
		}
	}else{
		if($poAmount > 0){
			$amount = $poAmount;
		}
		// else{
		// 	// $amount = $data['Amount'];
		// }
		$charges =  '<span style = "font-weight:bold;font-size:12px;">' .$program . '</span>' .  number_format($amount,2) ;
	}
	$gross = $amount;

	$periodType = $data['PeriodType'];  
	if($periodType  == 1 ){
		$p = ' 1&nbsp;-&nbsp;15,&nbsp;' . $year;
		$claimant = "LAND BANK OF THE PHILIPPINES";
	}else if($periodType  == 2){
		$p = $p = ' 16&nbsp;-&nbsp;31,&nbsp;' . $year;
		$claimant = "LAND BANK OF THE PHILIPPINES";
		
	}else if($periodType  == 3){
		$p = '&nbsp;' . $year;
		$claimant = "LAND BANK OF THE PHILIPPINES";
	}else{
		$p = '&nbsp;' . $year;
		$claimant = strtoupper($data['Claimant']);
	}

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
	// if($netAmount > 0){
	// 	$amount = $netAmount;
	// }

	$adv = $data['ADV1'];
	if($adv == 0 || $adv ==99999){
		$adv = '&nbsp;&nbsp;&nbsp;&nbsp;';
	}

	$payeeNumber = $data['PayeeNumber']; 
	$m2 = strrev(substr($claimant,1,3));
	$firstName =   $claimant . '(<input id = "payeeNumber" style = "width:50px;text-align:center;border:0;" maxlength = "6" value = "' .  $payeeNumber . '" onkeyup="saveP()"  />)';

	if($docType == 'REFUND - GSIS LOAN' && $payeeNumber != "") {
		$firstName =   strtoupper($data['Claimant']) . '(<input id = "payeeNumber" style = "width:50px;text-align:center;border:0;" maxlength = "6" value = "' .  $payeeNumber . '" onkeyup="saveP()"  />)';
	}

	if($docType == 'WAGES - INCIDENTAL EXPENSE' && $payeeNumber != "") {
		$firstName =   strtoupper($data['Claimant']) . '(<input id = "payeeNumber" style = "width:50px;text-align:center;border:0;" maxlength = "6" value = "' .  $payeeNumber . '" onkeyup="saveP()"  />)';
	}

	if($docType == 'REFUND - TAX' && $payeeNumber != "") {
		$firstName =   strtoupper($data['Claimant']) . '(<input id = "payeeNumber" style = "width:50px;text-align:center;border:0;" maxlength = "6" value = "' .  $payeeNumber . '" onkeyup="saveP()"  />)';
	}
	
	if($docType == 'UNCLAIMED' && $payeeNumber != "") {
		$firstName =   strtoupper($data['Claimant']) . '(<input id = "payeeNumber" style = "width:50px;text-align:center;border:0;" maxlength = "6" value = "' .  $payeeNumber . '" onkeyup="saveP()"  />)';
	}

	if($docType == 'REFUND - SSS' && $payeeNumber != "") {
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

	$sql = "SELECT * FROM particulars  WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
    $particulars = $data['Particulars'];

	unset($data);

	$address = '';
	if($trackingType == "PO"){
		$sqlAdd = "SELECT Address FROM supplier.supplierinfo WHERE Name = '" .  addslashes($claimant) . "' LIMIT 1";
		$recordAdd = $database->query($sqlAdd);
		$dataAdd = $database->fetch_array($recordAdd);
		$address = $dataAdd['Address'];

		unset($dataAdd);
	}

	$pre = $_SESSION['perm'];
	if($pre == 30){
		$sponsor = " PCSO (Malasakit Pagkalinga sa Bayan) ";
		$officeName = "PCSO";
	}else{
		$sponsor = " Lingap Para sa Mahirap ";
	}
	
	
	
	$f='';
	if($trackingType == "PO"){
		
		$sql = "SELECT ProgramCode,sum(Total) as Total  FROM porecord where trackingnumber = '" . $trackingNumber  . "' group by ProgramCode";
		$record = $database->query($sql);
		$f= '<span>';
		while($data = $database->fetch_array($record)){
			$f .= '<span style = "font-size:12px;font-weight:bold;">' .  $data['ProgramCode'] . '</span>:<span style = "font-size:12px;font-weight:bold;font-style:italic;">' . $data['Total'] .  '</span> - '; 
		}
		
		$f = substr($f,0,strlen($f)-3);
		$f .= '</span>';
	}
	if( $periodType == 2){
		
		$sql = "SELECT PR_ProgramCode,sum(Amount) as Total  FROM vouchercurrent where trackingnumber = '" . $trackingPartner  . "' group by PR_ProgramCode";
		$record = $database->query($sql);
		$f= '';
		while($data = $database->fetch_array($record)){
			$f .=  '(' . $data['PR_ProgramCode'] .' = ' . number_format($data['Total'],2) . ')'; 
		}
		//$f = substr($f,0,strlen($f)-3);
	}
	$sheet = '';
	if(substr($docType,0,5) == "BILLS"){
		$arr = explode('-',$docType);
		$nature = $arr[1]. ' ' . $arr[0];
		$sheetBill = "\n\tTo payment of".  $nature . "for the period covering " .  $periodMonth .  "" .  $p . ".\n";	
		if($docType == "BILLS - CABLE" ||  $docType == "BILLS - INTERNET" || $docType == "BILLS - MOBILE PHONE"  || $docType == "BILLS - TELEPHONE"  || $docType == "BILLS - TELEPHONE/INTERNET"){
			$five =   round($gross / 1.12 * .05,2);
			$two =  round($gross / 1.12 * .02,2);
			$totalPercent = $five + $two;
			
			$sheetBill .= "\r\n\t\t\t\t\t\t\tLess\n";  
			$sheetBill .= "                                          \t\t\t"  .  number_format(round($gross / 1.12,2),2) . " x  5% = " .  spacer(number_format($five,2))  . "\n";  
			$sheetBill .= "                                          \t\t\t"  .  number_format(round($gross / 1.12,2),2) . " x  2% = " .   spacer(number_format($two,2))  . "\n"; 
			$sheetBill .= "                                                    \t\t\t    -----------------------";
			
			$sheetBill .= "\n                                          \t\t\t" . spaceGiver(number_format(round($gross / 1.12,2),2))  . "             " . spacer( number_format($totalPercent,2))  . "\n"; 
			$netBill =  $gross - ($five + $two);
			$amount =  $netBill;
		}
		$sheet  = $sheetBill;
	}
	if(substr($docType,0,5) == "WAGES"){
		
		
		$nature = substr($docType,7);
		
		$sheetSalary ='';

		if($acct == 8){
			
			if($docType == "WAGES - SALARY J.O (Whole month)" ){
				$sheetSalary = "\r\n\tTo payment of services rendered of J.O/Contract of Service of City Government of Davao for the period covering " .  $periodMonth . "" .  $p . ".";
			} 
			if($docType == "WAGES - SALARY J.O (1st half)" ){
				$sheetSalary = "\r\n\tTo payment of services rendered of J.O/Contract of Service of City Government of Davao for the period covering " .  $periodMonth . " 1 - 15, " .  $p . ".";
			} 
			if($docType == "WAGES - SALARY J.O (2nd half)" ){
				$sheetSalary = "\r\n\tTo payment of services rendered of J.O/Contract of Service of City Government of Davao for the period covering second half of " .  $periodMonth . " " .  $p . ".";
			} 
			if($docType == "WAGES - OVERTIME PAY (J.O)"){
				$sheetSalary = "\r\n\tTo payment of OVERTIME PAY of J.O/Contract of Service of City Government of Davao for the period covering " .  $periodMonth . "" .  $p . ".";
			}
			// gna slp
			if($docType == "WAGES - SALARY PLANTILLA" ){
				$sheetSalary = "\r\n\tTo payment of salaries of officials and employees of the City Government of Davao for the period " .  $periodMonth . " " .  $p . ".";
			} 
			if($docType == "WAGES - BACK PAY"){
				$sheetSalary = "\r\n\tTo payment of salaries of officials and employees of the City Government of Davao for the period covering " .  $periodMonth .  "" .  $p . ".";
			}
		
			if($docType == "WAGES - OVERTIME PAY (Plantilla)"){
				$sheetSalary = "\r\n\tTo payment of OVERTIME PAY of officials and employees of the City Government of Davao for the period covering " .  $periodMonth .  "" .  $p . ".";
			}
			if($docType == "WAGES - SALARY DIFFERENTIAL"){
				$sheetSalary = "\r\n\tTo payment of SALARY DIFFERENTIAL of officials and employees of the City Government of Davao for the period covering  _____________";
			}
			
		}
		
		
		//else{
			//$sheetSalary = "\r\n\tTo payment of" . $nature . " of officials and employees of the City Government of Davao for the period covering " .  $periodMonth .  "" .  $p . ".";
		//	$sheetSalary = '';
		//}
		
		$sheet ='';
		$sheet1 = '';
		$sheet2 = '';
		$sheet3 = '';
		$sheet4 = '';
		$officePartner = '';
		
		if($trackingPartner != ''){
			// $sql = "Select a.*,b.Name from vouchercurrent a  left join office b on a.Office = b.Code  where trackingnumber  = '" . $trackingPartner . "'  limit 1";
			$sql = "SELECT * FROM vouchercurrent WHERE TrackingNumber = '".$trackingPartner."' LIMIT 1";
			$record = $database->query($sql);
			$data1 = $database->fetch_array($record);
			$officeThis1 = $data1['Office'];

			$sql = "SELECT * FROM office WHERE Code = '".$officeThis1."' LIMIT 1";
			$record2 = $database->query($sql);
			$data2 = $database->fetch_array($record2);
			$officePartner = $data2['Name'];

			if($periodType == 1){
				$net1 = $payrollFirst;
				$net2 = $data1['Amount'];
				$amount = $net1;
			}else{
				$obr = $data1['OBR_Number'];	
				$net1 =  $data1['PayrollAmountFirst'];
				$net2 = $amount;
				$amount = $net2;
				//$adv='';
			}
			$gross = $amount;
			$total = $net1 + $net2;
			$sheetSalary .= "\n\n\t\t&nbsp; 1-15&nbsp;:&nbsp;" . number_format($net1,2) ;
			$sheetSalary .= "\r\n\t\t16-31&nbsp;:&nbsp;" .  number_format($net2,2) ;
			$sheetSalary .= "\r\n\t&nbsp; Mo.&nbsp;Total&nbsp;:&nbsp;" .  number_format($total,2);
			if($office == '1081'){
				//$sheetSalary .= "\r\nOffice:&nbsp;" . $officePartner ;
			}
			
			$sheet = $sheetSalary;

		}else{
			
			if($docType == "WAGES - SALARY PLANTILLA" || $docType == "WAGES - BACK PAY"){
				$sheetSalary .= "\n\n\n\t         1-15 :                                                                    ";
				$sheetSalary .= "\n\t       16-31 :                                                      ";
				$sheetSalary .= "\n\t                  ---------------------      ";
				$sheetSalary .= "\n     Month Total :                                  ";
			}
			
			$sheet = $sheetSalary;
			
			$gross = $amount;

		}	
		$sheet .= "\n\n" .$f;
		$f = '';
	}
	if(substr($docType,0,10) == "REMITTANCE"){
		$sheet = '';
		if(substr($docType,0,16)  == "REMITTANCE - TAX"){
			if($docType == "REMITTANCE - TAX PLANTILLA"){
				$sheetRemittance = "\r\n\tTo remit withholding tax on compensation  of employees of the City Government of Davao for the month of " .  $periodMonth .  $p . " with supporting papers hereto attached.";
			}
			if($docType == "REMITTANCE - TAX JOB ORDER"){
				$sheetRemittance = "\r\n\tTo remit withholding tax of employees of the City Government of Davao for the month of " .  $periodMonth .  $p . " with supporting papers hereto attached.\n";
				$sheetRemittance .= "\n\t\t   2% :";
				$sheetRemittance .= "\n\t\t 10% :";
			}
			if($docType == "REMITTANCE - TAX SUPPLIER"){
				$sheetRemittance = "\r\n\tTo remit withholding tax on contractors, dealers, suppliers of the City Government of Davao as per supporting documents hereto attached...";
			}
			if($docType == "REMITTANCE - TAX CONSULTANT"){
				$sheetRemittance = "\r\n\tTo remit withholding tax of consultants of the City Government of Davao as per supporting documents in the amount...";
			}
			$sheet = $sheetRemittance;
		}else if($docType == "REMITTANCE - BARANGAY SHARE"){
			$sheetRemittance = "\r\n\tTo deposit the 10% and 15% share on RPT, the 15% share on Component Brgys, the 40% share on Sand and Gravel and the 50% share on community Tax and 50% share on Garbage Fee as per list of supporting documents attached for the month of" .  $periodMonth .  "" .  $p .".";
			$sheet = $sheetRemittance;
		}else if($docType == "REMITTANCE - DPWH"){
			$sheetDPWH = "\r\n\tTo remit the 5% share  of income generated  from Building Permit Fees and  Other Charges under the National Building Code of the Phil (PD 1096) in compliance with the DPWH and DILG Joint Memorandum Circular NO. 001 dated 07-04-13.\n\nPeriod :\n\n416-003-0005 \t\t " . $amount . "\n111(1472-1046-63)\t\t\t\t" . $amount ;
			$sheet = $sheetDPWH;
			
			
			
		}else{
			if($logOffice == '1081' or  $logOffice == 'OTHR'){
				$arr = explode('-',$docType);
				$nature  = $arr[1] . ' ' . $arr[0];
				$sheetAllowance = "\n\tTo remit" . $nature . "of all officials and employees of the City Government of Davao for the month of " .  $periodMonth .  "" .  $p . " with supporting papers hereto attached.";
				$sheet = $sheetAllowance;
			}
			
		}
	}
	if(substr($docType,0,4) == "BOND"){
		$nature = substr($docType,6);
		if($docType == "BOND - BIDDER"){
			$nature = "BIDDERS'S BOND";
		}if($docType == "BOND - PERFORMANCE"){
			$nature = "PERFORMANCE BOND";
		}if($docType == "BOND - RETENTION MONEY"){
			$nature = "RETENTION MONEY";
		}
		$sheetBond = "\n\tTo payment of refund of " . $nature . " of " . $claimant . " in the amount of. . .\n";
		
		 if($docType == "BOND - FIDELITY"){
			$sheetBond = "\n\tTo payment of renewal of " . $nature . " of " . $claimant . " in the amount of. . .\n";
		}
		
		
		if($docType == "BOND - FIDELITY"){
			$sheetBond .= '';
		}else{
			if($docType == "BOND - RETENTION MONEY"){
				$sheetBond .= "\n\tINV#\t\tINV DATE\t\tAMOUNT\t\tPO No.";
			}else{
				$sheetBond .= "\n\tOR#\t\tOR DATE\t\tAMOUNT\t\tTOTAL AMOUNT";
			}
			$sheetBond .= "\n----------------------------------------------------------------------------------------";
		}
		
		$sheet = $sheetBond;
	}
	if(substr($docType,0,10) == "ASSISTANCE"){
		$names = '';
		if(substr($trackingNumber,0,4) == "LING"){
			$sql = "select * from listattachments where trackingnumber = '" . $trackingNumber  . "' order by name asc";
			$record = $database->query($sql);
			$names = '';
			$names .= "  RAF\t\tAMOUNT\t\tNAME\n";
			$names .= "-------------   --------------   ------------------------------\n";
			while($data = $database->fetch_array($record)){
				$raf = $data["RAF"];
				$name = utf8_decode($data["Name"]);
				$name =$data["Name"];
				
				$amountLingap = number_format($data['Amount'],2);
				$row = $data['Rows'];
				if($row > 7){
					$names ="\n\tPlease see the list of " . $row . " names of beneficiaries attached.\n";
					break;
				}
				if(strlen($amountLingap) == 3){
					$amountLingap = "         " . $amountLingap;
				}else if(strlen($amountLingap) == 4){
					$amountLingap = "        " . $amountLingap;
				}else if(strlen($amountLingap) == 5){
					$amountLingap = "       " . $amountLingap;
				}else if(strlen($amountLingap) == 6){
					$amountLingap = "     " .$amountLingap;
				}else if(strlen($amountLingap) == 7){
					$amountLingap = "     " .$amountLingap;
				}else if(strlen($amountLingap) == 8){
					$amountLingap = "  " .$amountLingap;
				}
				$names .= "  " . $raf ."\t" . $amountLingap . "\t" .$name . "\n";				
			}
		}
		$sql = "select * from particulars where trackingnumber = '" . $trackingNumber . "' limit 1";
		$record = $database->query($sql);
		$count = $database->num_rows($record);
		if($count == 0){
			if($docType == "ASSISTANCE - MEDICAL"){
				/*$sheetAssist= "\n\tTo payment of medical expenses of the following as financial assistance under " . $sponsor . " a program of the City Mayor's Office, as per supporting papers hereto attached.\n\n";
				$sheetAssist .= $names;*/
				
				$sheetAssist= "\n\tTo payment of medical expenses of the following beneficiaries of the City Mayor's Office, as per supporting papers hereto attached.\n\n";
				$sheetAssist .= $names;
			}else if($docType == "ASSISTANCE - FUNERAL"){
				/*$sheetAssist=  "\n\tTo payment of funeral expenses of the following as financial assistance under " . $sponsor . " a program of the City Mayor's Office, as per supporting papers hereto attached.\n\n";
				$sheetAssist .= $names;*/
				$sheetAssist= "\n\tTo payment of funeral expenses of the following beneficiaries of the City Mayor's Office, as per supporting papers hereto attached.\n\n";
				$sheetAssist .= $names;
			}else{
				$sheetAssist = '';
			}
			$sheet = $sheetAssist;
		}else{
				$particulars .= $names;
		}
	}
	if(substr($docType,0,9) == "ALLOWANCE"){
		$sheet = '';
		if($logOffice == '1081'){
			
			$arr = explode('-',$docType);
			$nature  = $arr[1] . ' ' . $arr[0];
			$sheetAllowance = "\n\tTo payment of" . $nature . "of officials and employees of the City Government of Davao for the period covering " .  $periodMonth .  "" .  $p . ".";
			if($docType == "ALLOWANCE - CELLCARD" ){
				$sheetAllowance = "\n\tTo payment of CELLCARD EXPENSE of officials and employees of the City Government of Davao for the period covering " .  $periodMonth .  "" .  $p . ".";
			}
			if( $docType == "ALLOWANCE - TRAVEL"){
				$sheetAllowance = "\n\tTo payment of TRAVELLING EXPENSE of officials and employees of the City Government of Davao for the period covering " .  $periodMonth .  "" .  $p . ".";
			}
			if( $docType == "ALLOWANCE - TRANSPORTATION"){
				$sheetAllowance = "\n\tTo payment of TRANSPORTATION EXPENSE of officials and employees of the City Government of Davao for the period covering " .  $periodMonth .  "" .  $p . ".";
			}
			$sheet = $sheetAllowance;
			
		
		}
	}
	if(substr($docType,0,8) == "BENEFITS"){
		$arr = explode('-',$docType);
		$nature  = $arr[1] . ' ' . $arr[0];
		$sheetBenefits = "\n\tTo payment of" . $nature . "of officials and employees of the City Government of Davao for the period covering " .  $periodMonth .  "" .  $p . ".";
		
		if($docType == "BENEFITS - ELAP"){
			$sheetBenefits = "\n\tTo payment of ELAP granted to employees of the City Government of Davao for the period covering " .  $periodMonth .  "" .  $p . ".";
		}
		
		$sheet = $sheetBenefits;
	}
	if(substr($docType,0,7) == "PAYMENT"){
		$sheetPayment = '';
		if($docType == "PAYMENT - PHILHEALTH"){
			$sheetPayment = "\n\tPayment for Philhealth of Job Order and Contract of Services for the period of " . $periodMonth . "". $p .  " with supporting papers hereto attached.";
		}
		$sheet = $sheetPayment;
	}
	
	$sheet .= $sheetSpace;
	
	if(strlen($particulars) > 1){
		$sheet = $particulars;
	}
	$charges = $f;
	//$charges = substr($charges,0,strlen($charges)-2);		
	
	
	if( strtoupper($fund) == "GENERAL FUND"){
		$fund = "<span style = 'font-family:impact;font-size:36px;'>GEN FUND</span><br/><span style = 'font-family:helvetica;font-weight:bold;'>100</span> <span style = 'font-family:helvetica'>" . $year . "</span>";
	}
	if(strtoupper($fund) == "SEF"){
		$fund = "<span style = 'font-family:impact;font-size:48px;'>SEF</span><br/><span style = 'font-family:helvetica;font-weight:bold;'>200</span> <span style = 'font-family:helvetica'>" . $year . "</span>";
	}
	if(strtoupper($fund) == "TRUST FUND"){
		$fund = "<span style = 'font-family:impact;font-size:30px;'>TRUST FUND</span><br/><span style = 'font-family:helvetica;font-weight:bold;'>300</span> <span style = 'font-family:helvetica'>" . $year . "</span>";
	}

	$bankAccount = "";
	if($fundType == 'Trust Fund') {

		$sql = "SELECT PR_ProgramCode FROM vouchercurrent WHERE TrackingNumber = '".$trackingNumber."'";
		$record = $database->query($sql);

		$progCodes = "";
		while($data = $database->fetch_array($record)){
			$program = $data['PR_ProgramCode'];
			$progCodes .= ",'".$program."'";
		}

		$sql = "SELECT BankAccount FROM programcode WHERE Code IN (".substr($progCodes, 1).") LIMIT 1";
		$record = $database->query($sql);

		if($database->num_rows($record) > 0) {
			$data = $database->fetch_array($record);
			$bankAccount = $data['BankAccount'];

			$sheet .= "\n\nBANK ACCOUNT : ".$bankAccount;
		}

	}
	
	function spacer($amount){
		if(strlen($amount) == 3){
			$amount = "         " . $amount;
		}else if(strlen($amount) == 4){
			$amount = "        " . $amount;
		}else if(strlen($amount) == 5){
			$amount = "       " . $amount;
		}else if(strlen($amount) == 6){
			$amount = "     " .$amount;
		}else if(strlen($amount) == 7){
			$amount = "     " .$amount;
		}else if(strlen($amount) == 8){
			$amount = "  " .$amount;
		}
		return $amount;
	}
	function spaceGiver($amount){
		$len = strlen($amount);
		$space = '';
		if($len == 6){//hundred with decimal
			$space = "          ";//10spaces
		}
		if($len == 8){//thousand with decimal
			$space = "             ";//13spaces
		}
		if($len == 9){//ten thousand with decimal
			$space = "               ";//15spaces
		}
		if($len == 10){//hundred thousand with decimal
			$space = "                ";//16spaces
		}
		return $space;
	}

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
					<td style = "text-align:center;padding:2px;width:10%;font-family: Oswald;font-weight: bold;letter-spacing:1px;">Amount</td>
				</tr>
				<tr>
					<td style = "text-align:center;border-right:1px solid black;border-top:1px solid black;">
						<textarea id = "textArea" class = "textAreaInput"  style = "line-height: 17px;font-family:Oswald;letter-spacing:0px; height:286px;font-size: 15px;" rows = "20" cols = "22" onkeyup="save()" onclick  ="save1()" ><?php echo $sheet; ?></textarea>
					</td>
					<td style = "text-align:center;padding:0px;border-top:1px solid black;height:260px;vertical-align:top;padding-top:30px;">
						<textarea style = "font-weight:bold;text-align:right;font-size:14px;padding-right:5px;" class = "textAreaInput" readonly><?php  
								// if((substr($docType, 0, 5) == "WAGES") || (substr($docType, 0, 8) == "BENEFITS" && $docType != "BENEFITS - ELAP") || (substr($docType, 0, 9) == "ALLOWANCE")) {
								// 	echo ''; 
								// }else {
									echo number_format($gross,2); 
								// }
							?></textarea>
					</td>
				</tr>
				<?php
					if($payeeNumber ==''){
						$firstName = '';
					}
				?>
				<tr>
					<td style = "border-right:1px solid black;padding-left:10px;"><?php echo $charges; ?>
						<?php echo $firstName; ?><span style = "float:right;font-weight: bold;padding-right:5px;font-size: 18px;letter-spacing:1px;font-family: Oswald;font-weight: bold;">Total</span>
					</td>
					<td style="border-top:1px solid black; font-size:32px;">
						<?php
							// if($trackingType == "PO"){
							// 	 $amount = 0 ;
							// }
							
							$dispAmount = 0;
							// if	( (substr($docType, 0, 5) == "WAGES") || (substr($docType, 0, 8) == "BENEFITS" && $docType != "BENEFITS - ELAP") || (substr($docType, 0, 9) == "ALLOWANCE") 
							// 		|| ($docType == "BILLS - WATER") || ($docType == "BILLS - ELECTRICITY") || (substr($docType, 0, 10) == 'REMITTANCE') || ($docType == "CASH ADVANCE TO PAYMASTER") 
							// 		|| ($docType == "REPLENISHMENT") || (substr($docType, 0, 12) == "CASH ADVANCE" && $docType != "CASH ADVANCE - SPECIAL") || (substr($docType, 0, 6) == 'REFUND')
							// 		|| ($docType == 'INSURANCE - VEHICLE (GSIS)') || ($docType == 'REGISTRATION - LTO') || ($docType == 'BAC HONORARIUM' || ($docType == 'PAYMENT - PHILHEALTH') || ($docType == 'UNCLAIMED'))
							// 	) {

							if	( (substr($docType, 0, 5) == "WAGES") || (substr($docType, 0, 8) == "BENEFITS" && $docType != "BENEFITS - ELAP") || (substr($docType, 0, 9) == "ALLOWANCE") 
								|| ($docType == "BILLS - WATER") || ($docType == "BILLS - ELECTRICITY") || (substr($docType, 0, 10) == 'REMITTANCE') || ($docType == "CASH ADVANCE TO PAYMASTER") 
								|| ($docType == "REPLENISHMENT") || (substr($docType, 0, 12) == "CASH ADVANCE" && $docType != "CASH ADVANCE - SPECIAL") || (substr($docType, 0, 6) == 'REFUND')
								|| ($docType == 'INSURANCE - VEHICLE (GSIS)') || ($docType == 'REGISTRATION - LTO') || ($docType == 'BAC HONORARIUM' || ($docType == 'PAYMENT - PHILHEALTH') || ($docType == 'UNCLAIMED'))
							) {

								$dispAmount = $netAmount;
							}
							
							
						?>
						<input style = "font-family:arial; width:142px;border:0;text-align:right;font-weight:bold;font-size:16px;letter-spacing:1px;padding-right:1px" readonly value ="<?php echo  $database->zeroToNothing(number_format($dispAmount,2)); ?>"/>
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



