<?php
	session_start();

	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	$year = $database->charEncoder($_GET['year']);
	$trackingNumber = $database->charEncoder($_GET['tn']);
	$officeName ='';
	$dt = time();
	$datePrinted = date('Y-m-d h:i A', $dt);
	$db = $database->getDB($year);
	
	
	if(isset($_SESSION['perm'])){
		if(isset($_SESSION['accountType'])){
			$perm =  $_SESSION['perm'];
			$type =  $_SESSION['accountType'];	
		}else{
			$perm = 0;
			$type = 0;
		}
	}else{
		$perm = 0;
		$type = 0;
	}
	
	
	$projectName = 'NO RECORD FOUND';
	$vids = '';
	$fund = '';
	$prgCode ='';
	$entry = '';
	$prgTitle ='';
	$expCode ='';
	$expTitle= '';
	$location = '';
	$duration = '';
	$start ='';
	$end ='';
	$contractor = '';
	$programmer ='';
	$inspector = '';
	
	$amount =0;
	$netAmount =0;
	$variation = 0;
	$unperformed =0;
	$adjusted =0;
	$sheet = '';
	$progressHistory ='';
	$phase1history = '';
	$pics ='';
	$totalProgress = '';
	
	$sql = "SELECT Year,Office,Claimant, TrackingNumber, PR_ProgramCode, Amount, NetAmount, PR_AccountCode, Fund, DateEncoded, EncodedBy, InfraId
			FROM $db.vouchercurrent where trackingnumber  = '" . $trackingNumber . "' and TrackingType = 'NF' order by pr_programcode,pr_accountcode limit 1";
	$record = $database->query($sql);
	$count = $database->num_rows($record);
	if($count > 0){
		$data = $database->fetch_array($record);
		$infraId = $data['InfraId'];
		$prgCode = $data['PR_ProgramCode'];
		$expCode = $data['PR_AccountCode'];
		$fund = $data['Fund'];
		$amount = $data['Amount'];
		$netAmount = $data['NetAmount'];
		$dateEncoded = $data['DateEncoded'];
		$encodedBy = $data['EncodedBy'];
		$year = $data['Year'];
		$officeCode = $data['Office'];
		$contractor = $data['Claimant'];
		
		

		$sql = "select * from office where code = '" . $officeCode. "' limit 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$officeName = $data['Name'];
			
		$sql = "SELECT Name as ProgramName,Code,Lump, Entry FROM $db.programcode where Id  = '" . $infraId . "'limit 1";		
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$code = $data['Code'];
		$lump = $data['Lump'];
		$entry= $data['Entry'];
		$prgTitle = '';
		$projectName = $data['ProgramName'];	
		if($entry == "Regular"){
			$entry = '';
		}
		if(strlen($lump) > 0 ){
			$sql = "SELECT Name as ProgramName
				FROM $db.programcode where Code  = '" . $lump . "'limit 1";
				$record = $database->query($sql);
				$data = $database->fetch_array($record);
				$prgTitle = $data['ProgramName'];
				
		}
		
		$sql = "SELECT Title FROM $db.fundtitles where Code  = '" . $expCode . "'limit 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$expTitle = $data['Title'];
		

		$sql = "SELECT Location, Duration,Started,Completed,Extension,Variation,Unperformed,Started,Completed,Remarks,Progress,Programmer,Inspector,Checker,Surveyor,Draftsman,Map,Barangay FROM $db.infra where TrackingNumber  = '" . $trackingNumber . "'limit 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$location = $data['Location'];
		$duration = $data['Duration'];
		$variation = $data['Variation'];
		$unperformed = $data['Unperformed'];
		$start = $data['Started'];
		$end = $data['Completed'];
		$extension = $data['Extension'];
		
		$remarks = $data['Remarks'];
		$totalProgress = $data['Progress'];

		$map = $data['Map'];
		$barangay = $data['Barangay'];

		// MANPOWER
		$programmer = $data['Programmer'];
		$inspector = $data['Inspector'];
		$checker = $data['Checker'];
		$surveyor = $data['Surveyor'];
		$draftsman = $data['Draftsman'];
		
		$adjusted = 0;
		if($variation > 0 ){
			$adjusted = $netAmount + $variation;
		}
		if($unperformed > 0 ){
			$adjusted = $netAmount - $unperformed;
		}
		
		$sql = "select * from $db.infrapayment where InfraTracking ='" . $trackingNumber ."' order by id asc";
		$record = $database->query($sql);
		$count = $database->num_rows($record);
		$sheet = '';
		$pics ='<div style = "padding:20px;color:red;">No uploads yet.</div>';
		if($count > 0){
			$sheet .= '<table id="infraPaymentHistory" border="0"  style="font-family:NOR;margin:0 auto;font-size:14px;border-collapse:collapse;width:100%;background-color:white;padding:50px;" border ="0">';
			$sheet .= ' 	<tr style ="background-color:rgb(228, 230, 230);">
								<th style = "border-left:1px solid rgb(232, 234, 235);">TN</th>
								<th style = "text-align:left;">Payment</th>
								<th style = "">Variation</th>
								<th style = "">Unperformed</th>
								<th style = "">Contract</th>
								<th style = "">Adjustment</th>
								<th style = "">T.Progress</th>
								<th style = "">B.Progress</th>
								<th style = "text-align:center;">S.Curve</th>
								<th style = "text-align:right;">Billed&nbsp;Amount</th>
								<th style = "text-align:right;">2(%)</th>
								<th style = "text-align:right;">5(%)</th>	
								<th style = "text-align:right;">Tax</th>
								<th style = "text-align:right;">Ret</th>
								<th style = "text-align:right;">Delay</th>
								<th style = "text-align:right;">LD</th>
								<th style = "text-align:right;border-right:1px solid rgb(232, 234, 235);">Net</th>
							</tr>
						<tr><td colspan="100%" style="border:0px; border-top:1px solid grey; padding:1px 0px;"></td></tr>
						';
			$totalGross = 0;		   
			$totalNet = 0;
			$totalTwo = 0;
			$totalFive = 0;
			$totalRetention = 0;
			$totalTax = 0;
			$totalLD = 0;
			
			$retentionTotal = 0;
			$done = 0;
			$lastProgress = 0;
			$billedProgress = 0;
			$ld = 0;
			$type = array('1st Payment','2nd Payment','3rd Payment','4th Payment','5th Payment','6th Payment','7th Payment','Final Payment');
			while($data = $database->fetch_array($record)){
				$infaTN = $data['TrackingNumber'];
				$infaPaymentType = $data['Type'];
				$arrayKey = array_search($infaPaymentType, $type);
				unset($type[$arrayKey]);
				if($infaPaymentType == 'Final Payment'){
					$done = 1;
				}
				
				$progress = $data['Progress'];
				$actual = $data['Actual'];
				
				
				$variationSaved =  $data['Variation'];
				$unperformedSaved = $data['Unperformed'];
				if($variationSaved > 0 || $unperformedSaved > 0){
					$adjustment = number_format($data['ActualAdjustment']);
				}else{
					$adjustment = '';
				}
				$gross = $data['Gross'];
				$billedProgress = $data['BilledProgress'];
				$lastProgress = $progress;
				$sCurve = $data['Scurve'];
				$delay = $data['Delay'];
				$tax = $data['Tax'];
				$retention = $data['Retention'];
				
				$net = $data['Net'];
				$two = $data['Two'];
				$five = $data['Five'];
				$ld = $data['LD'];

				$retentionTotal += $retention;
				$totalTax += $tax;
				$totalTwo += $two;
				$totalFive += $five;
				$totalNet += $net;
				$totalGross += $gross;

				$sheet .= '	<tr>
							<td style = "white-space:nowrap;">' . $infaTN . '</td>
							<td style = "white-space:nowrap;">' . $infaPaymentType . '</td>
							<td style = "text-align:right;">' . $database->zeroToNothing(number_format($variationSaved,2)) . '</td>
							<td style = "text-align:right;">' . $database->zeroToNothing(number_format($unperformedSaved,2)) . '</td>
							<td style = "text-align:right;">' . number_format($actual,2) . '</td>
							<td style = "text-align:right;">' . $adjustment . '</td>
							<td style = "text-align:center;">' . $progress . '</td>
							<td style = "text-align:center;">' . $billedProgress . '</td>
							
							<td style = "text-align:center;">' . $sCurve . '</td>
							<td style = "text-align:right;">' . number_format($gross,2) . '</td>
							<td style = "text-align:right;">' . number_format($two,2) . '</td>
							<td style = "text-align:right;">' . number_format($five,2) . '</td>
							<td style = "text-align:right;">' . number_format($tax,2) . '</td>
							<td style = "text-align:right;">' . number_format($retention,2) . '</td>
							<td style = "text-align:center;">' . $database->zeroToEmpty($delay) . '</td>
							<td style = "text-align:right;">' . $database->zeroToEmpty(number_format($ld,2)) . '</td>
							<td style = "text-align:right;">' . number_format($net,2) . '</td>
						</tr>';
					
			}
			$sheet .= ' <tr >
							<td colspan="9" style=""></td>
							<td style=" text-align:right; font-weight:bold;">' . number_format($totalGross,2) .'</td>
							<td style=" padding:5px; text-align:right;">' . number_format($totalTwo,2) . '</td>
							<td style=" padding:5px; text-align:right;">' . number_format($totalFive,2) . '</td>
							<td style=" padding:5px; text-align:right;">' . number_format($totalTax,2) . '</td>
							<td style=" padding:5px; text-align:right;">' . number_format($retentionTotal,2) . '</td>
							<td style=""></td>
							<td style=" padding:5px; text-align:right;">' . $database->zeroToEmpty(number_format($ld,2)) . '</td>
							<td style=" padding:5px; text-align:right;"><span style = "font-weight:bold;">' . number_format($totalNet,2) . '</span></td>
						</tr>';	
			$sheet .= '</table>';
		}
		$progressHistory = '<div style = "padding:20px;color:red;">No progress updates yet.</div>';
		$sql = "select * from $db.infraconstruction where trackingnumber = '" . $trackingNumber . "' order  by id desc";
		$record = $database->query($sql);
		
		$count = $database->num_rows($record);
		if($count > 0){
			$progressHistory = '<table id="infraPaymentHistory" border="0"  style="font-family:NOR;margin:0 auto;font-size:14px;border-collapse:collapse;width:100%;background-color:white;padding:50px;" border ="0">';
			$progressHistory .= '<tr style ="background-color:rgb(228, 230, 230);">
									<th></th>
									<th style ="text-align:left;">Progress</th>
									<th style ="text-align:left;">Notes</th>
									<th style ="text-align:left; width:0px; white-space:nowrap;">Photos</th>
									<th style ="text-align:left;width:1px; ">Date Updated</th>
								</tr>';
			$i = 1;
			$j = 1;
			$filenames = array();
			
			while($data = $database->fetch_array($record)){
				$progress = $data['Progress'];
				$description = $data['ProgressDescription'];
				$encoded = $data['DateEncoded'];
				$files = $data['Files'];
				$vid = $data['Video'];
				if(strlen($vid) > 10){
					$vids .= '<iframe class= "displayVideo"  src="' . $vid . '"></iframe>';
				}
				
				$filesLen = 0;
				if($files != "") {
					$filesLen = sizeof(explode('-', $files));
					for($i = 1; $i <= $filesLen; $i++){
						$filename = $year . '~'. $trackingNumber . '~' . $progress . '~' . $i ; 
						balhinFile($filename);
						array_push($filenames,$filename);
					}
				}
				$progressHistory .= '<tr>';
				$progressHistory .= '	<td style ="width:1px;padding:0px 5px;vertical-align:top;text-align:center;color:rgb(19, 60, 78);font-size:12px;background-color1:rgb(242, 239, 230);">' . $j++ . '</td>
										<td style ="vertical-align:top;">' . $progress . '</td><td>' . $description . '</td><td style="text-align:center;">' . $database->zeroToNothing($filesLen) . '</td><td style ="text-align:left;white-space:nowrap;">' . $encoded . '</td>';
				$progressHistory .= '</tr>';
			}
			
			$progressHistory .= '<tr><td colspan ="100%"></td><tr>';
			$progressHistory .= '</table>';		
			$pics = createImagesDisplay($filenames);						
		}
		
		$sql = "select * from $db.voucherhistory where trackingnumber = '" . $trackingNumber . "'";
		$record = $database->query($sql);
		
		$statuses ='';
		$status = array();
		while($data = $database->fetch_array($record)){
		 	$status[$data['Status']]['Status'] = $data['Status'];
		 	$status[$data['Status']]['Modified'] = $data['DateModified'];
		 	$status[$data['Status']]['Completion'] = $data['Completion'];
			$statuses .= ',"' . $data['Status'] . '"';
		}
		$statusString =  substr($statuses,1);
		$sql = 'select * from status where status in(' . $statusString . ')';
		$record = $database->query($sql);
		while($data = $database->fetch_array($record)){
			$office = $data['Office'];
			$stat = trim($data['Status']);
			$status[$stat]['Office'] = $office;
		}
		$phase1history = '<table id="infraPaymentHistory" border="0"  style="font-family:NOR;margin:0 auto;font-size:14px;border-collapse:collapse;width:100%;background-color:white;padding:50px;" border ="0">
								<tr style ="background-color:rgb(228, 230, 230);">
									<th></th>
									<th style ="text-align:left;">Status</th>
									<th style ="text-align:left;">Office</th>
									<th style ="text-align:left;">Updated</th>
									<th style ="text-align:left; width:0px; white-space:nowrap;">Completion</th>
								</tr>';
		$i = 1;						
		foreach($status as $s){
			$status =  $s['Status'];
			$modified =  $s['Modified'];
			$completion =  $s['Completion'];

			// $office = $s['Office'];
			$office = "";
			if(strlen(trim($s['Office'])) > 0) {
				$office = $s['Office'];
			}


			$phase1history .='<tr style ="">
								<td style = "width:1px;text-align:center;">' . $i++ . '</td>
								<td style ="text-align:left;">' . $status . '</td>
								<td style ="text-align:left; ">' .$office . '</td>
								<td style ="text-align:left;">' . $modified . '</td>
								<td style ="text-align:left;">' . $completion . '</td>
							</tr>';
		}
		$phase1history .='<tr><td colspan ="100%"></td></tr>';
		$phase1history .='</table>';
		
		$filenamesPre = array();
		$preMedia = '';
		$preVids = '';
		$sql = "select * from  $db.infraUploads where TrackingNumber = '" . $trackingNumber . "'";
		$record = $database->query($sql);
		$count = $database->num_rows($record);
		if($count > 0){
			while($data = $database->fetch_array($record)){
				$filename = $data['Filename'];
				$files = $data['Files'];
				$type  = $data['Type'];
				$ext  = $data['Extension'];
				if($type == "Image"){
					$sourcePath = '../../tempUpload/';
					
					$filename = $year .'_' . $trackingNumber . '_pre_pic_' . $files . '.' . $ext;
					
					balhinFile1($filename);
					array_push($filenamesPre,$filename);
					//$preMedia .= '<div class= "displayImage" style =" background:url(' . $source . ');background-repeat:no-repeat;background-size:auto 100% ;background-position:50%;"></div>';
				}else{
					//$preMedia .= '<div class= "displayImage" style =" background:url(' . $source . ');background-repeat:no-repeat;background-size:auto 100% ;background-position:50%;"></div>';
					$preVids .= '<iframe class= "displayImage"  src="' . $filename . '" style = "margin:0;margin-bottom:15px;margin-left:11px;"></iframe>';
				}
			}	
			$preMedia = createImagesDisplay1($filenamesPre) . $preVids;
					
		}

		$sql = "SELECT * FROM ".$db.".vouchercurrent WHERE TrackingPartner = '".$trackingNumber."' AND DocumentType = 'RETENTION' LIMIT 1";
		$record = $database->query($sql);
		$data = $database->fetch_array($record);
		$retentionTN = "";

		if($database->num_rows($record) > 0) {
			$retTN = $data['TrackingNumber'];
			$retAmount = $data['Amount'];
			$retEncoded = $data['DateEncoded'];
			$retModified = $data['DateModified'];
			$retStatus = $data['Status'];

			$retentionTN = "	<table border='0' cellpadding='0' style='font-family:NOR; font-size:14px; border-spacing:0px; width:100%;'>
									<tr style='background-color:rgb(228, 230, 230);'>
										<td style='padding:2px 5px; font-size:14px; font-weight:bold; text-align:left; border:1px solid rgb(232, 234, 235); border-top:1px solid rgb(141, 161, 169); border-right:0px;'>TN</td>
										<td style='padding:2px 5px; font-size:14px; font-weight:bold; text-align:right; border:1px solid rgb(232, 234, 235); border-top:1px solid rgb(141, 161, 169); border-left:0px; border-right:0px;'>Amount</td>
										<td style='padding:2px 5px; font-size:14px; font-weight:bold; text-align:left; border:1px solid rgb(232, 234, 235); border-top:1px solid rgb(141, 161, 169); border-left:0px; border-right:0px;'>Status</td>
										<td style='padding:2px 5px; font-size:14px; font-weight:bold; text-align:left; border:1px solid rgb(232, 234, 235); border-top:1px solid rgb(141, 161, 169); border-left:0px; border-right:0px; width:0px;'>Encoded</td>
										<td style='padding:2px 5px; font-size:14px; font-weight:bold; text-align:left; border:1px solid rgb(232, 234, 235); border-top:1px solid rgb(141, 161, 169); border-left:0px; width:0px; white-space:nowrap;'>Last Updated</td>
									</tr>
									<tr>
										<td colspan='5' style='padding:1px 0px; border-top:1px solid gray;'></td>
									</tr>
									<tr>
										<td style='padding:2px 5px; border:1px solid rgb(232, 234, 235); border-right:0px;'>".$retTN."</td>
										<td style='padding:2px 5px; border:1px solid rgb(232, 234, 235); border-right:0px; text-align:right;'>".number_format($retAmount, 2)."</td>
										<td style='padding:2px 5px; border:1px solid rgb(232, 234, 235); border-right:0px;'>".$retStatus."</td>
										<td style='padding:2px 5px; border:1px solid rgb(232, 234, 235); border-right:0px; white-space:nowrap;'>".$retEncoded."</td>
										<td style='padding:2px 5px; border:1px solid rgb(232, 234, 235); white-space:nowrap;'>".$retModified."</td>
									</tr>
								</table>";
		}

	}
	
	
	function balhinFile($filename){
		
		$source = '/../../../uploads/infra/reduced/';
		$destination = '../../tempUpload/';
		$filename =  checkExtension($source,$filename);

		if($filename != 0){
			$file = realpath( dirname(__FILE__) ). $source . $filename;
			$file_handle = fopen($destination . $filename , 'a+');
			fwrite($file_handle, file_get_contents($file));
			fclose($file_handle);
		}
	}
	function balhinFile1($filename){
		
		$source = '/../../../uploads/infra/reduced/';
		$destination = '../../tempUpload/';

		if($filename != 0){
			$file = realpath( dirname(__FILE__) ). $source . $filename;
			$file_handle = fopen($destination . $filename , 'a+');

			fwrite($file_handle, file_get_contents($file));
			fclose($file_handle);
		}
	}
	function createImagesDisplay($arrayList){
		$imageDivLandscape = '';
		$imageDivPortrait ='';
		foreach($arrayList as $f){
			$arr = explode('~', $f);
			$progress = $arr[2];
			
			$sourcePath = '../../tempUpload/';
			
			$filename =  checkExtension1($sourcePath,$f);
			if($filename != 0){
				$source = $sourcePath . $filename;
				list($width, $height) = getimagesize($source);		
				if($width > $height){
					$imageDivLandscape .= '<div class= "displayImage" style =" background:url(' . $source . ');background-repeat:no-repeat;background-size:auto 100% ;background-position:50%; cursor:pointer;" onclick="openThisInNewTab(\''.$filename.'\')">
												<div class ="captionImage" style = "display:inline; background-color:rgb(62, 137, 202);padding:0px 5px;font-weight:bold;color:white; ">' . $progress . '%</div>
											</div>
										  ';
				}else{
					$imageDivLandscape .= '
											<div class= "displayImage" style ="background:url(' . $source . ');background-repeat: no-repeat;background-size:70%;background-position:50%; cursor:pointer;" onclick="openThisInNewTab(\''.$filename.'\')">
												<div class ="captionImage" style = "display:inline; background-color:rgb(62, 137, 202);padding:0px 5px;font-weight:bold;color:white; ">' . $progress . '%</div>
											</div>
										  ';
				}
			}
		}
		$sheet = '<table style = "border-collapse:collapse;margin:10px;">';
		$sheet .= '<tr><td><div style = "width:100%;">' . $imageDivLandscape . '</div></td></tr>';
		$sheet .= '</table>';
		return $sheet;
	}
	function createImagesDisplay1($arrayList){
		$imageDivLandscape = '';
		$imageDivPortrait ='';
		foreach($arrayList as $f){
			$sourcePath = '../../tempUpload/' . $f;
			list($width, $height) = getimagesize($sourcePath);		
			if($width > $height){
				$imageDivLandscape .= '<div class= "displayImage" style =" background:url(' . $sourcePath . ');background-repeat:no-repeat;background-size:auto 100% ;background-position:50%;">
										</div>
									  ';
			}else{
				$imageDivLandscape .= '
										<div class= "displayImage" style ="background:url(' . $sourcePath . ');background-repeat: no-repeat;background-size:70%;background-position:50%;">
										</div>
									  ';
			}
		}
		$sheet = '<table style = "border-collapse:collapse;margin:10px;">';
		$sheet .= '<tr><td><div style = "width:100%;">' . $imageDivLandscape . '</div></td></tr>';
		$sheet .= '</table>';
		return $sheet;
	}
	// function checkExtension($path,$filename){
	// 	$file = realpath( dirname(__FILE__) ). $path . $filename . ".jpg";
	// 	if (is_file($file)) {
	// 		return $filename .".jpg";
	// 	}else{
	// 		$file = realpath( dirname(__FILE__) ). $path . $filename . ".JPG";
	// 		if (is_file($file)) {
	// 			return $filename .".JPG";
	// 		}else{
	// 			$file = realpath( dirname(__FILE__) ). $path . $filename . ".png";
	// 			if (is_file($file)) {
	// 				return $filename .".png";
	// 			}else{
	// 				$file = realpath( dirname(__FILE__) ). $path . $filename . ".PNG";
	// 				if (is_file($file)) {
	// 					return $filename .".PNG";
	// 				}else{
	// 					return 0;
	// 				}
	// 			}
	// 		}
	// 	}
	// }
	// function checkExtension1($path,$filename){
	// 	if(file_exists($path . $filename . ".jpg")){
	// 		return $filename . ".jpg";
	// 	}else if(file_exists($path . $filename . ".JPG")){
	// 		return $filename . ".JPG";
	// 	}else if(file_exists($path . $filename . ".png")){
	// 		return $filename . ".png";
	// 	}else if(file_exists($path . $filename . ".PNG")){
	// 		return $filename . ".PNG";
	// 	}else{
	// 		return 0;
	// 	}
	// }

	// 2023-10-23 - added jpeg & JPEG extension;
	function checkExtension($path,$filename){
		$file = realpath( dirname(__FILE__) ). $path . $filename . ".jpg";
		if (is_file($file)) {
			return $filename .".jpg";
		}else{
			$file = realpath( dirname(__FILE__) ). $path . $filename . ".JPG";
			if (is_file($file)) {
				return $filename .".JPG";
			}else{
				$file = realpath( dirname(__FILE__) ). $path . $filename . ".png";
				if (is_file($file)) {
					return $filename .".png";
				}else{
					$file = realpath( dirname(__FILE__) ). $path . $filename . ".PNG";
					if (is_file($file)) {
						return $filename .".PNG";
					}else{
						$file = realpath( dirname(__FILE__) ). $path . $filename . ".jpeg";
						if (is_file($file)) {
							return $filename .".jpeg";
						}else{
							$file = realpath( dirname(__FILE__) ). $path . $filename . ".JPEG";
							if (is_file($file)) {
								return $filename .".JPEG";
							}else{
								return 0;
							}
						}
					}
				}
			}
		}
	}
	function checkExtension1($path,$filename){
		if(file_exists($path . $filename . ".jpg")){
			return $filename . ".jpg";
		}else if(file_exists($path . $filename . ".JPG")){
			return $filename . ".JPG";
		}else if(file_exists($path . $filename . ".png")){
			return $filename . ".png";
		}else if(file_exists($path . $filename . ".PNG")){
			return $filename . ".PNG";
		}else if(file_exists($path . $filename . ".jpeg")){
			return $filename . ".jpeg";
		}else if(file_exists($path . $filename . ".JPEG")){
			return $filename . ".JPEG";
		}else{
			return 0;
		}
	}
	
	unset($status);
	unset($filenames);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="/citydoc2023/images/infra.jpg"/> 
	<title>Project Information</title>
	<style>
		/*-----------------------------------------------------------------loader*/
		.loader{
				width:200px;
				height:200px;
				top:40%;
				background:url('../images/ajaxloader.gif');
				background-repeat:no-repeat;
			
				background-size:200px 200px;
				background-position:48% 48%;
				z-index:100;
				
		}	
		.loaderContainer{
			border:4px solid transparent;
			border-radius:2px;
			display:inline-block;	
			
		}
		.absoluteHolder1{
			z-index:105;
			position:absolute;
			text-align:center;
			background-color:rgba(252, 254, 254,.4);
			width:100%;
			height:100%;
		}
		
		@font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
		}
		@font-face {
			font-family: "NOR";
			src: url("../fonts/Abel-Regular.ttf");
		}
		body{
			font-family:NOR;
			padding: 0;
			margin:0;
		}
		.displayImage{
			margin-top:9px;
			margin-right:7px;
			display:inline-block;
			border:5px solid white;
			box-shadow:0px 0px 5px 2px grey; 
			background-repeat: no-repeat;
			width:356px; height:199px;
		}
		.displayVideo{
			margin-top:9px;
			margin-right:10px;
			display:inline-block;
			border:5px solid white;
			box-shadow:0px 0px 5px 2px grey; 
			background-repeat: no-repeat;
			width:355px; height:199px;
		}
		#logo{
			width:105px;
			height:105px;
			margin:0 auto;
			background:url(../images/davaologo.jpg);	
			background-repeat:no-repeat;
			background-size:100% 100%; 	
			float: right;
		}
		

		.tdLabel {
			text-align:right;
			font-size:12px;
			letter-spacing:1px;
			vertical-align:top;
			white-space:nowrap;
		}

		.tdValue {
			font-weight:bold;
			/* padding:5px 5px 0px 5px; */
		}

		#infraPaymentHistory th {
			
			border-bottom:1px solid black;
			border-top:1px solid rgb(141, 161, 169);
			padding:2px 5px;
			font-size:13px;
			letter-spacing:1px;
		}
		#infraPaymentHistory td {
			padding:0px 5px;
			border:1px solid rgb(232, 234, 235);
			font-size:13px;
		}
		#infraPaymentHistory tr:hover td {
			background-color: rgb(252, 244, 196);
		}
		
		#infraPaymentHistory > tbody > tr:last-child > td {
			border: 0px;
		}
		#infraPaymentHistory > tbody > tr:nth-last-child(2) > td {
			border-bottom:1px solid rgb(224, 228, 230);
		}
		.remarkMessage{
			background-color: rgb(245, 249, 250);
			border-bottom: .5px solid rgb(224, 239, 242);
			padding-left: 5px;
			font-size: 12px;
		}
		.remarkOffice{
			border-top:1px solid rgba(206, 222, 230,.5);
			text-align: right;
			font-size: 10px;
		}
		.remarkCreated{
			font-size: 11px;
			text-align: right;
		}
		.linkButton:hover{
			box-shadow: 0px 0px 10px 2px rgb(234, 238, 222);
		}
	</style>

</head>
<body>

	<!-- 
		8.5 in = 816 px 
		11 in = 1056 px 
		break-inside:avoid; page-break-inside:avoid;
	--> 
	<div style="width:1150px;  margin:0 auto;">
		<table border="0" cellpadding="0" cellspacing="0" style="border-spacing:0px; margin:0 auto; width:100%; height:100%;">
			<tr>
				<td style="">
					<table border="0" cellpadding="0" cellspacing="0" style="border-spacing:0px; margin:0 auto; width:100%; height:100%;">
						<tr>
							<td colspan="2" style="height:1px; padding-top:10px; height:120px; padding-bottom:15px; border-bottom:1px solid black;">
								<table border="0" style ="width:100%; border-spacing:0;">
									<tr>
										<td style= "padding:0px;">
											<div id = "logo"></div>
										</td>
										<td style ="text-align:center; width:320px;">
											<div style ="line-height:22px; letter-spacing:1px;">
												<div style = "font-size:20px;">Republic of the Philippines</div>
												<div style = "font-size:16px;">City Government of Davao</div>
												<div style = "font-size:24;font-weight: bold;">INFRASTRUCTURE PROJECT</div>
											</div>
										</td>
										<td style= "width:380px; text-align:right; vertical-align:bottom; padding-right:10px;">
											<div style = "font-size: 12px;">TN&nbsp;:&nbsp;&nbsp;<span style="font-size:18px;font-weight:bold; letter-spacing:1px;"><?= $trackingNumber ?></span></div>
											<div><span style="font-weight: normal; font-size: 12px;letter-spacing:1px;">DocTrack <span style=" font-size: 14px;"><?php echo $year; ?></span></span></div>	
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td style="height:1px; vertical-align:top; padding-top:10px;padding-left:20px;">
								<table border="0" style="font-size:14px; width:100%;line-height:14px;">
									<tr>
										<td class="tdLabel" style=''>
											Project Title :
										</td>
										<td class="tdValue" style='font-size:18px;letter-spacing:.5px;color:rgb(25, 87, 150);'><?= $projectName  ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Contractor :
										</td>
										<td class="tdValue" style='color:orange; '><?= $contractor  ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style='width:85px; '>
											Implementing Office :
										</td>
										<td class="tdValue"><?= $officeName ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Source of Fund : 
										</td>
										<td class="tdValue"><?= $fund . ' - ADF( ' . $year . ' )'?> </td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											
										</td>
										<td class="tdValue" style=''><?= $prgCode . ' ' . $entry  ?></td>
									</tr>
									
									<tr>
										<td class="tdLabel" style=''>
											
										</td>
										<td class="tdValue" style=''><?=  $prgTitle ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Expense Code :
										</td>
										<td class="tdValue"><?= $expCode ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Type :
										</td>
										<td class="tdValue" style=''><?= $expTitle ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Barangay :
										</td>
										<td class="tdValue" style=''><?= $barangay ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Location :
										</td>
										<td class="tdValue" style=''><?= $location ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Duration :
										</td>
										<td class="tdValue" style=''><?= $duration ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Construction Start :
										</td>
										<td class="tdValue" style=''><?= $start ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Construction End :
										</td>
										<td class="tdValue" style=''><?= $end ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Construction Extension Date :
										</td>
										<td class="tdValue" style=''><?= $extension?></td>
									</tr>
									
								</table>
							</td>
							<td style ="vertical-align: top;padding-top:10px;padding-right:10px;">
								<table border="0" style="text-align:right; font-size:14px;line-height:14px;width:100%;">
								
									<tr>
										<td style='text-align:right;' class="tdLabel">
											Construction Progress
										</td>
										<td  style='color:rgb(48, 132, 37);font-weight: bold;font-size: 16px;background-color:rgb(252, 251, 234);padding:5px;border:1px solid rgb(249, 247, 226);'>
											<?= $totalProgress  ?><span style="font-size:12px;font-weight: normal;color:grey;font-family: Arial;">%</span>
										</td>
									</tr>
									<tr>
										<td colspan="2" >&nbsp;</td>
									</tr>
									<tr>
										<td style='text-align:right;' class="tdLabel">
											Budget Amount
										</td>
										<td class="tdValue">
											<?php echo number_format($amount,2) ?>
										</td>
									</tr>
									<tr>
										<td style='text-align:right;' class="tdLabel">
											Contract Amount
										</td>
										<td style="width:1px;padding-left:10px;" class="tdValue">
											<?php echo number_format($netAmount,2) ?>
										</td>
									</tr>
									<tr>
										<td style='text-align:right;' class="tdLabel">
											Add Fund due to  variation Order No. 1 (<span style = "color:green;font-weight: bold;">+</span>)
										</td>
										<td style="width:1px;padding-left:10px;" class="tdValue">
											<?php echo  $database->zeroToNothing(number_format($variation,2)) ?>
										</td>
									</tr>
									<tr>
										<td style='text-align:right;' class="tdLabel">
											Unperformed Works (<span style = "color:red;font-weight: bold;">─</span>)
										</td>
										<td style="width:1px;padding-left:10px;" class="tdValue">
											<?php echo  $database->zeroToNothing(number_format($unperformed,2)) ?>
										</td>
									</tr>
									<tr>
										<td style='text-align:right;' class="tdLabel">
											Adjusted Contract Amount
										</td>
										<td style="width:1px;padding-left:10px;" class="tdValue">
											<?php echo  $database->zeroToNothing(number_format($adjusted,2)) ?>
										</td>
									</tr>
									<tr>
										<td colspan="2" style ="padding-top:30px;">&nbsp;</td>
									</tr>
									<!-- <tr>
										<td class="tdLabel" style=''>
											Project Programmer :
										</td>
										<td class="tdValue" style='white-space:nowrap;'><?= $programmer ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style=''>
											Project Inspector :
										</td>
										<td class="tdValue" style='white-space:nowrap;'><?= $inspector ?></td>
									</tr> -->
								</table>
								
							</td>
						</tr>
						
						<?php 
							if(strlen($remarks) > 0){
						 ?>
							<tr>
								<td colspan="2" style="vertical-align:top; padding-top:15px;height:1px;font-weight: bold;color:orange;letter-spacing:1px;text-align: right;">
									
								</td>
							</tr>
							<tr>
								<td colspan="2" style="vertical-align:top;height:1px;">
									<div style="width:300px;font-family: NOR;background-color: rgb(238, 241, 242);border-radius: 5px;
											 background-color: rgb(238, 241, 242);font-family: NOR;float:right;border:1px solid rgb(138, 167, 183); padding:5px;">
										<div style ="border-bottom:1px dashed grey;text-align: right;font-weight: bold;margin-bottom: 10px;padding-right: 15px;">PROJECT NOTES</div>
										<div style ="padding:10px;height:90px;overflow-y:auto;">
											<?php echo $remarks; ?>
										</div>
									</div>
								</td>
							</tr>
						<?php 
							}
						 ?>


						<tr>
							<td colspan="2" style="vertical-align:top; padding-top:25px;height:1px;font-weight: bold;color:rgb(2, 132, 188);letter-spacing:1px;vertical-align: bottom;">
								PROJECT TEAM 
							</td>
						</tr>
						<tr>
							<td style="padding-left:50px; padding-top:10px;">
								<table border="0" cellpadding="0" style="border-collapse:collapse;">
									<tr>
										<td class="tdLabel" style='padding:2px 5px;'>
											Project Programmer :
										</td>
										<td class="tdValue" style='white-space:nowrap; padding:0px 3px;'><?= $programmer ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style='padding:2px 5px;'>
											Construction Inspector :
										</td>
										<td class="tdValue" style='white-space:nowrap; padding:0px 3px;'><?= $inspector ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style='padding:2px 5px;'>
											Project Checker :
										</td>
										<td class="tdValue" style='white-space:nowrap; padding:0px 3px;'><?= $checker ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style='padding:2px 5px;'>
											Project Draftsman :
										</td>
										<td class="tdValue" style='white-space:nowrap; padding:0px 3px;'><?= $draftsman ?></td>
									</tr>
									<tr>
										<td class="tdLabel" style='padding:2px 5px;'>
											Project Surveyor :
										</td>
										<td class="tdValue" style='white-space:nowrap; padding:0px 3px;'><?= $surveyor ?></td>
									</tr>
								</table>
							</td>
						</tr>

						<tr>
							<td colspan="2" style="vertical-align:top; padding-top:15px;height:1px;font-weight: bold;color:rgb(2, 132, 188);letter-spacing:1px;vertical-align: bottom;">
								PROJECT LOCATION 
								<?php 
									if(strlen($map) > 0){
										$map1 = "display:block;";
										$map2 = "display:none;";
										$map3 = "display:block;";
									}else{
										$map1 = "display:none;";
										$map2 = "display:block;";	
										$map3 = "display:none;";
									}
								 ?>
								
								<?php 
									if($perm == 41 || $perm == 42){
								?>
										<span class = "linkButton"  style ="font-size:12px;color:white;background-color: rgb(24, 171, 39);padding:0px 5px;border-radius:2px;float:right;cursor:pointer;border-right: 1px solid grey;border-bottom: 1px solid grey;border-top: 2px solid rgb(219, 225, 219);border-left: 2px solid rgb(219, 225, 219);" onclick="addMap()">Update Map</span>
								<?php 
									}
								?>
								
								<?php 
									if(strlen($map) > 0){
								?>
										<span class = "linkButton" id = "bigMapCaption" style ="font-size:12px;color:white;background-color: rgb(146, 196, 7);padding:0px 5px;border-radius:2px;float:right;cursor:pointer;margin-right:5px;
										border-right: 1px solid grey;border-bottom: 1px solid grey;border-top: 2px solid rgb(219, 225, 219);border-left: 2px solid rgb(219, 225, 219)">
										<a href="<?php echo $map ?>" style="text-decoration: none;color:inherit;outline : none;" target ="_blank" id = "bigMaplink">Bigger Map</a></span>
								<?php
									}else{
								 ?>
								 		<span class = "linkButton"  id = "bigMapCaption" style ="display:none;font-size:12px;color:white;background-color: rgb(146, 196, 7);padding:0px 5px;border-radius:2px;float:right;cursor:pointer;margin-right:5px;
											border-right: 1px solid grey;border-bottom: 1px solid grey;border-top: 2px solid rgb(219, 225, 219);border-left: 2px solid rgb(219, 225, 219)">
											<a href="" style="text-decoration: none;color:inherit;outline : none;" target ="_blank" id = "bigMaplink">Bigger Map</a></span>
								 <?php
									}
								 ?>
								
								
							</td>
						</tr>
						<tr>
							<td colspan="2" style="vertical-align:top;padding-top:10px;">
								
								 
								<div style="height:400px;box-shadow:0px 0px 10px 1px silver;overflow: hidden;<?php echo $map1; ?>" id= "sourceBody">
									<iframe id ="sourceLocation" src="<?php echo $map ?>" width="100%" height="465px" style ="border:0;" ></iframe>
								</div> 
								<div style="height:130px;box-shadow:0px 0px 10px 1px silver;padding:10px;<?php echo $map2; ?>" id= "sourceBodyNone">
									<table style ='height:100%;width:100%;text-align:center;' border = "0">
										<tr>
											<td ><div style ="display:inline-block;margin:0 auto;width:100px;height:100px; background:url(../images/map.png); background-repeat: no-repeat;background-position-x:-15px; background-size:130%;">
												
											</div></td>
										</tr>
										<tr>
											<td style ="text-align: center;">
												<a href="https://www.google.com.ph/maps/@7.1356592,125.6113956,38259m/data=!3m1!1e3" style="text-decoration: none;color:black;outline : none;" target ="_blank">
													<div style = "margin:0 auto;width:200px; margin-top:-25px;font-weight: bold;" id = "mapCaption">Find Location</div>
												</a> 
											</td>
										</tr>
									</table>
								</div>	
								 
								 
								 
							</td>
						</tr>
						
						<tr>
							<td colspan="2" style="vertical-align:top; padding-top:15px;height:1px;font-weight: bold;color:rgb(2, 132, 188);letter-spacing:1px;">
								PROGRESS IMAGES
							</td>
						</tr>
						<tr>
							<td colspan="2" style="vertical-align:top;background-color: rgba(157, 155, 155,.1);" >
								<?php echo $pics; ?>
							</td>
						</tr>
						<?php 
							if(strlen($vids) > 0){
						 ?>
								<tr>
									<td colspan="2" style="vertical-align:top; padding-top:15px;height:1px;font-weight: bold;color:rgb(2, 132, 188);letter-spacing:1px;">
										VIDEO DOCUMENTATION
									</td>
								</tr>
								<tr>
									<td colspan="2" style="vertical-align:top;background-color: rgba(157, 155, 155,.1);padding:12px;">
										<?php echo $vids; ?>
									</td>
								</tr>
						<?php 
							}
						 ?>
						 <tr>
							<td colspan="2" style="vertical-align:top; padding-top:15px;height:1px;font-weight: bold;color:rgb(2, 132, 188);letter-spacing:1px;">
								PRECONSTRUCTION IMAGES AND VIDEOS
							</td>
						</tr>
						<tr>
							<td colspan="2" style="vertical-align:top;background-color: rgba(157, 155, 155,.1);" >
								<?php echo $preMedia; ?>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="vertical-align:top; padding-top:15px;height:1px;font-weight: bold;color:rgb(2, 132, 188);letter-spacing:1px;">
								PAYMENT HISTORY
							</td>
						</tr>
						<tr>
							<td colspan="2" style="vertical-align:top;height:1px;">
								<table border="0" cellpadding="0" cellspacing="0" style="font-family:NOR; width:100%;"><?php echo $sheet; ?></table>
							</td>
						</tr>
						<?php if($retentionTN != "") {?>
						<tr>
							<td colspan="2" style="vertical-align:top; padding-top:15px;height:1px;font-weight: bold;color:rgb(2, 132, 188);letter-spacing:1px;">
								RETENTION TRACKING
							</td>
						</tr>
						<tr>
							<td colspan="2" style="vertical-align:top;height:1px;padding-top">
								<?php echo $retentionTN; ?>
							</td>
						</tr>
						<?php } ?>
						
						<tr>
							<td colspan="2" style="vertical-align:top; padding-top:15px;height:1px;font-weight: bold;color:rgb(2, 132, 188);letter-spacing:1px;">
								PROGRESS HISTORY
							</td>
						</tr>
						<tr>
							<td colspan="2" style="vertical-align:top;">
								<?php echo $progressHistory; ?>
							</td>
						</tr>
						
						<tr>
							<td colspan="2" style="vertical-align:top; padding-top:15px;height:1px;font-weight: bold;color:rgb(2, 132, 188);letter-spacing:1px;">
								PREPARATION, BIDDING AND PRE-CONSTRUCTION HISTORY
							</td>
						</tr>
						<tr>
							<td colspan="2" style="vertical-align:top;">
								<?php echo $phase1history; ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="height:1px;padding-top:120px;" colspan="2">
					<div style="text-align:right; font-size:10px; padding:5px; ">
						<span style="margin-right:8px;float:left;letter-spacing:1px;">www.davaocityportal.com</span>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<br>
	<br>
	<br>
	
</body>
</html>
<script>
	function addMap(){
		//window.open("https://www.google.com.ph/maps/@7.1356592,125.6113956,38259m/data=!3m1!1e3");
		var url = 0;
		var sourceUrl = prompt("Input map link").trim();
		var check = sourceUrl.search("iframe");
		if(check >= 0){
			let beginPosition = sourceUrl.search("https");
			var newSource = sourceUrl.substring(beginPosition);
			var indexTrim = newSource.indexOf('"');
			var url = newSource.substring(0,indexTrim);
		}else{
			var check = sourceUrl.search("https:");
			if(check >= 0){
				var url = sourceUrl;
			}else{
				url = 0;
			}
		}
		if(url != 0){
			var tn = "<?php echo $trackingNumber;?>";
			var year = "<?php echo $year;?>";
			
			var queryString = "?saveMap=1&tn="+tn+"&year=" + year + "&url=" + url;
			var container = document.getElementById("sourceBody");

			loader();
			ajaxGetAndConcatenate(queryString, processorLink, container, "saveMap");
			
		}else{
			alert("Invalid");
		}
	}
	
	
	checkLoadIframe();
	function checkLoadIframe(){
		document.getElementById('sourceLocation').onload= function() {
			sourceBody.scrollTop = sourceLocation.offsetHeight;
	      
	    };
	}

	function openThisInNewTab(filename) {
		var queryString = "?showImgOrigSize=1&filename="+filename;
		var container = "";
		ajaxGetAndConcatenate(queryString, processorLink, container, "showImgOrigSize");
	}
</script>



