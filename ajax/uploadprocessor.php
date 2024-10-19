<?php

		require_once("../includes/database.php");
		
		if(isset($_FILES['inputTextFileLiquidated']['tmp_name'])){
			$result = 'wala';
			$record = 0;
			$value = '';
			$value = '';
			$checks = '';
			$accountCode = '';
			$fileName  =  $_FILES['inputTextFileLiquidated']['tmp_name'];
			$fp = fopen($fileName, "r");
			while ($line = fgets($fp)) { 
				$field = explode("\t",$line);	
				$jev = $field[0];
				$check =$field[1];
				$accountCode = trim($field[2]);
				$checks .= ',' . $check;
			}
			$checks = substr($checks, 1,strlen($checks));
			$sql = "select TrackingNumber,checknumber,if(TrackingType = 'PY',Amount,PO_Amount) as Amount  from vouchercurrent where PR_AccountCode = '" . $accountCode . "' and checknumber IN("  . $checks . ")";
			//$sql = "select TrackingNumber,checknumber,if(TrackingType = 'PY',Amount,PO_Amount) as Amount  from vouchercurrent where checknumber IN("  . $checks . ")";
			$result = $database->FetchThis($sql);
			$count  = $database->num_rows($result);
			if($count > 0){
				while($data = $database->fetch_array($result)){
					$value .= '*'.  intval($data['checknumber']) . '-' .  number_format($data['Amount'],2);
				}
				$record = $value;
				echo $record;
			}else{
				echo -1;	
			}
		}
		if(isset($_FILES['inputTextFileLiquidatedTN']['tmp_name'])){
			$result = 'wala';
			$record = 0;
			$value = '';
			$value = '';
			$tns = '';
			$accountCode = '';
			$fileName  =  $_FILES['inputTextFileLiquidatedTN']['tmp_name'];
			$fp = fopen($fileName, "r");
			while ($line = fgets($fp)) { 
				$field = explode("\t",$line);	
				$jev = $field[0];
				$tn = '\'' .  $field[1] . '\'';
				$accountCode = trim($field[2]);
				$tns .= ',' . $tn;
			}
			$tns = substr($tns, 1,strlen($tns));
			$sql = "select TrackingNumber,Trackingnumber,if(TrackingType = 'PY',Amount,PO_Amount) as Amount  from vouchercurrent where PR_AccountCode = '" . $accountCode . "' and TrackingNumber IN("  . $tns . ")";
			//$sql = "select TrackingNumber,checknumber,if(TrackingType = 'PY',Amount,PO_Amount) as Amount  from vouchercurrent where checknumber IN("  . $checks . ")";
			$result = $database->FetchThis($sql);
			$count  = $database->num_rows($result);
			if($count > 0){
				while($data = $database->fetch_array($result)){
					$value .= '*'.  $data['TrackingNumber'] . '~' .  number_format($data['Amount'],2);
				}
				$record = $value;
				echo $record;
			}else{
				echo -1;	
			}
			
		}
		if(isset($_FILES['inputTextFileAppropriation']['tmp_name'])){
			//$office = $_POST['officeName'];
			$i = 0;
			$values = '';
			$fileName  =  $_FILES['inputTextFileAppropriation']['tmp_name'];
			$fp = fopen($fileName, "r");
			$number = '';
			$x = '';
			$progTotal = 0;
			$program = "set";
			$sheet = '<table id = "fileAppTable" style = "border-spacing:0;width:100%;">';
			$sheet .= '<tr>';
			$sheet .= '<td class = "tdHeader1"  style = "">&nbsp;</td>';
			$sheet .= '<td class = "tdHeader1" style = "">Code</td>';
			$sheet .= '<td class = "tdHeader1" style = "">Description</td>';
			$sheet .= '<td class = "tdHeader1" style = "text-align:center;">Amount</td>';
			$sheet .= '</tr>';
			
			$ctr =1;
			$total = 0;
			while($line = fgets($fp)) { 
						$content = explode("\n",$line);	
						$y = $content[0];
						$y = str_replace("\"","",$y);	
						$piece = explode("\t",$y);
						
						$a =  trim($piece[1]); // number
						$b =   trim($piece[2]);
						$c =  trim($piece[3]); //desc
						$d =  trim($piece[4]);
						$e =  trim($piece[5]);
						
						$f =  trim($piece[6]);
						$g =  trim($piece[7]);
						
						$h =  trim($piece[8]); //id
						$i =  trim($piece[9]);
						$j =  trim($piece[10]);
						$k =  trim($piece[11]);//id
						
						$l =  trim($piece[12]);
						$m =  trim($piece[13]);
						$n =  trim($piece[14]);
						$o =  trim($piece[15]);
						$y =  trim($piece[20]); //office
						$z =  trim($piece[21]); //current
						
						$a1 =  trim($piece[22]);
						$a2 =  trim($piece[23]);
						$a3 =  trim($piece[24]);
						
						$a4 =  trim($piece[25]);
						$a5 =   trim( preg_replace('/[,-]/', '', $piece[26]) ); //amount
						if($a5 == ''){
							$a5 = 0;
						}
						$a6 =  trim($piece[27]);
						
						$a7 =  trim($piece[28]);
						$a8 =  trim($piece[29]);
						$a9 =  trim($piece[30]);
						
						$a10 =  trim($piece[31]); 
						$a11 =  trim($piece[32]);
						$a12 =  trim($piece[33]);
						$a13 =  trim($piece[34]); //program
						if(is_numeric($a)){
							$id = $h . $i .$j .$k .$l.$m . $n   ; 
							$size = strlen($id);
							if($size == 11){
								if($program == "set"){
									$program = $a13;
								}else{
									if($program != $a13){
										//echo '</br></br>' . $program . ' = '  . $progTotal  . '<br/><br/>';
										$sheet .= '<tr>';
										$sheet .= '<td  style = " padding:2px 5px;">&nbsp;</td>';
										$sheet .= '<td colspan ="2" style = "text-align:right;padding-right:10px;padding-bottom:30px;color:rgb(9, 136, 215);font-weight:bold;border-bottom:1px solid silver;"></td>';
										$sheet .= '<td style = "text-align:right;font-weight:bold;padding-bottom:30px;padding-right:8px;color:rgb(9, 136, 215);border-bottom:1px solid silver;">
													<span style = "text-align:right;padding-right:10px;padding-bottom:30px;color:rgb(245, 126, 54);font-weight:bold;">' . $program . '</span> ' . number_format($progTotal,2) . '</td>';
										$sheet .= '</tr>';
										
										$program = $a13;
										$progTotal = 0;
										$ctr = 1;
									}
								}
								$progTotal = $progTotal + $a5;
								$total = $total + $a5;
								
								$sheet .= '<tr>';
								$sheet .= '<td class="tableDataRows"   style = " padding:2px 5px;padding-left:10px;">' . $ctr . '</td>';
								$sheet .= '<td class="tableDataRows"   style = "border-bottom:1px solid silver;  padding:2px 5px;padding-left:10px;">' . $id  .'</td>';
								$sheet .= '<td class="tableDataRows"  style = "border-bottom:1px solid silver;  padding:2px 5px;">' . $c . '<input type = "hidden" value = "' . $program . '"></td>';
								if($a5 > 1){
									$amount = number_format($a5,2) ;
									$sheet .= '<td class="tableDataRows"  style = "text-align:right;border-bottom:1px solid silver;  padding:2px 5px;"><input style = "border:0;font-size:13px;text-align:right;width:" value = "' . $amount . '"/></td>';
								}else{
									$amount = number_format($a5,2) ;
									$sheet .= '<td class="tableDataRows"  style = "text-align:right;border-bottom:1px solid silver;  padding:2px 5px;border:1px solid red;"><input style = "border:0;font-size:13px;text-align:right;" value = "' . $amount . '"/></td>';
								}
								
								$sheet .= '</tr>';
								$ctr++;
							}
						}
			}
			$sheet .= '<tr>';
			$sheet .= '<td  style = " padding:2px 5px;">&nbsp;</td>';
			$sheet .= '<td colspan ="2" style = "text-align:right;padding-right:10px;padding-bottom:10px;color:rgb(9, 136, 215);font-weight:bold;"></td>';
			$sheet .= '<td style = "text-align:right;font-weight:bold;padding-bottom:10px;padding-right:8px;color:rgb(9, 136, 215);"><span style = "text-align:right;padding-right:10px;padding-bottom:30px;color:rgb(245, 126, 54);font-weight:bold;">' . $program . '</span>' . number_format($progTotal,2) . '</td>';
			$sheet .= '</tr>';
			
			$sheet .= '<tr>';
			$sheet .= '<td  style = " padding:2px 5px;">&nbsp;</td>';
			$sheet .= '<td  style = " padding:2px 5px;">&nbsp;</td>';
			$sheet .= '<td  style = "font-size:16px;text-align:right;padding-right:15px;padding-bottom:10px;font-weight:bold;"></td>';
			$sheet .= '<td  style = "text-align:right;font-size:22px;font-weight:bold;padding-bottom:10px;padding-right:8px;border-top:4px double silver;">
					<span style = "font-size:16px;color:grey;padding-right:5px;font-weight:normal;">Total</span>' . number_format($total,2) . '</td>';
			$sheet .= '</tr>';
			
			
		
			$sheet .= '</table>';
			echo $sheet;
		
			//echo '</br></br>' . $program . ' = '  . $progTotal  . '<br/><br/>';
		}
		
	
		
?>