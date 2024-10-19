<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<!DOCTYPE HTML>


<?php
	session_start();

	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('../../citydoc2023/interface/login.php','_self')</script>";
		echo $link;
	}
	
	
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');
	
	$trackingNumber = $database->charEncoder($_GET['tn']);
    $officeName =  $_SESSION['officeName'];

    $sql = "SELECT Year, DocumentType FROM vouchercurrent WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
    $result = $database->query($sql);
    $data = $database->fetch_array($result);
    $year = $data['Year'];
    $docType = $data['DocumentType'];

    $sql = "SELECT PTRSNo FROM particulars WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
    $result = $database->query($sql);

    $whereIn = "";
    $curTable = "";
    $data = $database->fetch_array($result);
    
    $ptrs = trim($data['PTRSNo']);
	$curHeaderId = "";
    if(strlen($ptrs) > 0){
            $temp = explode(",", $ptrs);

        $error = 0;
        $whereIn = "";
        for ($i=0; $i < sizeof($temp); $i++) { 
            $temp1 = explode("-", $temp[$i]);
            if(sizeof($temp1) < 3){
                $error = 1;
            }
            $type = $temp1[0];
            $period = $temp1[1];
            $headerId = $temp1[2];
            
            $whereIn .= ",".$headerId;
        }

        if($error == 0){
            $curTable = "";
            if($type == "RP" || $type == "VP"){
                $curTable = "rp_transaction_details";
            }else{
                $curTable = "sp_transaction_details";
            }

            // $sql = "SELECT a.*, b.lastname, b.firstname, b.middlename, b.extension, sum(c.amt) as othrded 
            //                 FROM 
            //                 brgs.".$curTable." a
            //                 left join brgs.employees b on a.empno = b.empno
            //                 left join brgs.rp_transaction_deductions c ON a.header_id = c.header_id AND a.empno = c.empno
            //                 WHERE 
            //                 a.header_id IN (".substr($whereIn, 1).") GROUP BY a.empno ORDER BY b.lastname ASC";
            $sql = "SELECT * FROM 
                    (	SELECT 
                        b.lastname, b.firstname, b.middlename, b.extension, a.*, a.header_id as headerId
                        FROM 
                        brgs.".$curTable." a
                        left join brgs.employees b on a.empno = b.empno
                        WHERE 
                        a.header_id IN (".substr($whereIn, 1).") 
                    ) a
                    LEFT JOIN 
                    (	SELECT header_id, empno, sum(amt) as othrded 
                        FROM brgs.rp_transaction_deductions 
                        WHERE header_id IN (".substr($whereIn, 1).") 
                        GROUP BY header_id, empno
                    ) c 
                    ON a.header_id = c.header_id and a.empno = c.empno ORDER BY a.header_id ASC, a.lastname ASC";
            $result = $database->query($sql);

            $sql1 = "SELECT a.header_id, a.empno, a.code, b.SL_description, a.amt
                    FROM brgs.rp_transaction_deductions a 
                    LEFT JOIN afmis.subsidiary_ledger_codes b ON a.code = b.SL_dedcode
                    WHERE a.header_id IN (".substr($whereIn, 1).") order by a.header_id, a.empno, b.SL_description;";
            $result1 = $database->query($sql1);

            $deductionBrk = [];
            if($database->num_rows($result1) > 0) {
                while ($data1 = $database->fetch_array($result1)) {
                    $hId = $data1['header_id'];
                    $hEmp = $data1['empno'];
                    $hCode = $data1['code'];
                    $hDesc = $data1['SL_description'];
                    $hAmt = floatval($data1['amt']);
    
                    if(!isset($deductionBrk[$hId][$hEmp])) {
                        $deductionBrk[$hId][$hEmp] = "";
                    }
                    // $deductionBrk[$hId][$hEmp] .= ", ".$hDesc." = ".number_format($hAmt, 2);
                    // $deductionBrk[$hId][$hEmp] .= "<br>".$hDesc." = ".number_format($hAmt, 2);
                    $deductionBrk[$hId][$hEmp] .= "<br>".$hDesc."&nbsp; <span style='display:inline-block; width:80px; padding-right:3px;'>".number_format($hAmt, 2)."</span>";
    
                    // $deductionBrk[$hId][$hEmp] .= "<tr><td>".$hDesc."</td><td>".number_format($hAmt, 2)."</td></tr>";
    
                }
            }

            $sheet0 = '';
            $sheet1 = '';
            $x = 1;

            $totalGross = 0;
            $totalGSIS = 0;
            $totalPera = 0;
            $totalPagIbig = 0;
            $totalPhilHealth = 0;
            $totalState = 0;
            $totalLWOP = 0;
            $totalRate = 0;
            $totalOthrDeducts = 0;
            $totalNet = 0;
            $totalTax = 0;

            $sheet0 .= "
                        <div class='pHeader1' style='font-size:16px; border:0px;'>
                            PTRS No.&nbsp;:&nbsp;<span style='color:black; font-size:20px; font-weight:bold;'>".$ptrs."</span>
                        </div>
                        <table border='0' cellpadding='0' cellspacing='0' id='tableDoctrackDBFList' style='margin:0px auto; border-spacing:0px; font-family:Oswald; width:100%;'>
                        <thead>
                            <tr style='background-color:rgb(12, 71, 123);'>
                                <th colspan='9'></th>
                                <th colspan='3' style='color:white; font-size:14px; background-color:rgb(6, 43, 75); padding:3px 8px 3px 10px; letter-spacing:1px; border-bottom:1px solid gray;'>Deductions</th>
                                <th></th>
                            </tr>
                            <tr style='background-color:rgb(12, 71, 123); color:white; font-size:14px;'>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); padding:3px 5px 3px 10px; text-align:left;'></th>
                                <th style='background-color:rgb(43, 50, 56); border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 5px 3px 8px; text-align:left;'>Employee</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right;'>Compensation</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right;'>Pera</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right;'>GSIS</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right;'>PhilHealth</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right;'>Pagibig</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right;'>ECIP</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right;'>Gross</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right; background-color:rgb(43, 50, 56, .8);'>Absences</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right; background-color:rgb(43, 50, 56, .8);'>Tax</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right; background-color:rgb(43, 50, 56, .8);'>Others</th>
                                <th style='border-bottom:1px solid rgba(0,0,0,.2); letter-spacing:1px; padding:3px 8px 3px 10px; text-align:right;'>Net</th>
                            </tr>
                        </thead>";

            while ($data = $database->fetch_array($result)) {
                if($type == "RP" || $type == "VP"){
                    $rate = $data['rate']; // for plantilla
                    $compen = $data['compen']; // for other payroll 
                    $lwop = $data['lwop']; // absences

                    $gsis = $data['gvgsis'];
                    $pagibig = $data['gvpagibig'];
                    $philhealth = $data['gvphilhealth'];
                    $pera = $data['pera'];
                    $state = $data['state'];

                    $gsis1 = $data['gsis'];
                    $pagibig1 = $data['pagibig'];
                    $philhealth1 = $data['philhealth'];
                    $wtax = $data['wtax'];

                    if($docType == "WAGES - SALARY PLANTILLA"){
                        $salary = $rate;
                    }else{
                        $salary = floatval($compen) - floatval($lwop); 
                        $rate = $compen; // for plantilla
                    }

                }else{
                    $amt1 = $data['amt1'];
                    $tax1 = $data['tax1'];
                    $amt2 = $data['amt2'];
                    $tax2 = $data['tax2'];

                    $rate = floatval($amt1) + floatval($amt2); // for special payroll
                    $compen = 0.00;
                    $lwop = 0.00;

                    $gsis = 0.00;
                    $pera = 0.00;
                    $pagibig = 0.00;
                    $philhealth = 0.00;
                    $state = 0.00;

                    $gsis1 = 0.00;
                    $pera1 = 0.00;
                    $pagibig1 = 0.00;
                    $philhealth1 = 0.00;
                    $wtax = 0.00;

                    $salary = $rate;
					$compen = $salary - ($tax1 + $tax2);
                }

                $other = floatval($data['othrded']); // other deductions

                $perShare = $gsis1 + $pagibig1 + $philhealth1 + $lwop + $wtax;

                $net = ($compen - $perShare) - $other; 

                if($type == "SP"){
					$wtax = ($tax1 + $tax2);
				}
                
                $empnum = $data['empno'];
                $lname = trim($data['lastname']);
                $fname = trim($data['firstname']);
                $mname = trim($data['middlename']);
                $exten = trim($data['extension']);

                $fullname = $lname.", ".$fname." ".$mname[0]." ".$exten;

                if($x == 0){
                    $claimant = $fullname." ET AL";
                }

                $headerId = $data['headerId'];

				if($curHeaderId == "" || $curHeaderId != $headerId){
					// $period = $database->numberToMonth(str_replace($year, "", substr($ptrs, (strpos($ptrs, "-".$headerId) - 6), 6)));
                    $part1Per = substr($ptrs, (strpos($ptrs, "-".$headerId) - 6), 6);
                    $mNum = substr($part1Per, 4, 2);
                    $period = $database->numberToMonth($mNum);

					$sheet0 .= "	<tr style='background-color:white;'>
										<td style='border-bottom:1px dashed silver;'></td>
										<td colspan='13' style='padding:3px 5px; text-align:left; font-weight:bold; font-size:12px; letter-spacing:1px; border-bottom:1px dashed silver; background-color:white; text-transform:uppercase;'>
											".$period."
										</td>
									</tr>";

					$curHeaderId = $headerId;
				}

                // substr($deductionBrk[$headerId][$empnum], 2)

                $deductionsList = number_format($other, 2);
                if(isset($deductionBrk[$headerId][$empnum])) {
                    $deductionsList = substr($deductionBrk[$headerId][$empnum], 4)."
                                        <div>
                                            <span style='display:inline-block; width:80px; border-top:1px dashed silver; padding-right:3px; font-weight:bold; font-size:12px;'>".number_format($other, 2)."</span>
                                        </div>";
                }

                $sheet0 .= "<tr>";
                $sheet0 .= "<td style='font-size:10px; text-align:left;'>".($x++)."</td>";
                $sheet0 .= "<td style='font-size:12px; text-align:left; white-space:nowrap;'><span style='display:none;'>".$empnum."</span><span>".utf8_encode(utf8_decode($fullname))."</span></td>
                            <td style='font-size:12px;'>".number_format($rate, 2)."</td>
                            <td style='font-size:12px;'>".number_format($pera, 2)."</td>
                            <td style='font-size:12px;'>".number_format($gsis, 2)."</td>
                            <td style='font-size:12px;'>".number_format($philhealth, 2)."</td>
                            <td style='font-size:12px;'>".number_format($pagibig, 2)."</td>
                            <td style='font-size:12px;'>".number_format($state, 2)."</td>
                            <td style='font-size:12px;'>".number_format($salary, 2)."</td>
                            <td style='font-size:12px;'>".number_format($lwop, 2)."</td>
                            <td style='font-size:12px;'>".number_format($wtax, 2)."</td>
                            <td style='font-size:12px; white-space:nowrap; font-size:11px;'>".$deductionsList."</td>
                            <td style='font-size:12px;'>".number_format($net, 2)."</td>
                            ";

                $sheet0 .= "</tr>";

                $totalGSIS += $gsis;
                $totalPera += $pera;
                $totalPagIbig += $pagibig;
                $totalPhilHealth += $philhealth;
                $totalState += $state;
                $totalLWOP += $lwop;
                $totalRate += $rate;
                $totalOthrDeducts += $other;
                $totalGross += $salary;
                $totalNet += $net;
                $totalTax += $wtax;

            }

            $sheet0 .= "<tr style='letter-spacing:1px;'>";
            $sheet0 .= "<td style='font-size:12px; border-top:1px solid black; background-color:white; text-align:right; padding-right:5px;' colspan='2'>TOTAL</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold;'>".number_format($totalRate, 2)."</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold;'>".number_format($totalPera, 2)."</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold;'>".number_format($totalGSIS, 2)."</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold;'>".number_format($totalPhilHealth, 2)."</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold;'>".number_format($totalPagIbig, 2)."</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold;'>".number_format($totalState, 2)."</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold;'>".number_format($totalGross, 2)."</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold;'>".number_format($totalLWOP, 2)."</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold;'>".number_format($totalTax, 2)."</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold;'>".number_format($totalOthrDeducts, 2)."</td>
                        <td style='font-size:12px; border-top:1px solid black; background-color:white; font-weight:bold; color:red;'>".number_format($totalNet, 2)."</td>
                            ";
            $sheet0 .= "</tr>";


            $sheet0 .= "</table>";

            $sql = "SELECT 
                    a.Office, a.TrackingNumber, a.Claimant, a.Status, a.PR_ProgramCode, a.PeriodType, a.PeriodMonth, c.Name, a.PR_AccountCode, b.Title, a.Amount, a.TotalAmountMultiple
                    FROM vouchercurrent a 
                    left join fundtitles b on a.PR_AccountCode = b.Code
                    left join programcode c on a.PR_ProgramCode = c.Code
                    where a.TrackingNumber = '".$trackingNumber."'";
            $result = $database->query($sql);

            $rows = "";
            $periodHeader = "";
            $curProgCode = "";
            while($data = $database->fetch_array($result)){
                $claimant = $data['Claimant'];
                $program = $data['PR_ProgramCode'];
                $progTitle = $data['Name'];
                $acctCode = $data['PR_AccountCode'];
                $acctTitle = $data['Title'];
                $amount = $data['Amount'];
                $totalAmountMultiple = $data['TotalAmountMultiple'];

                $periodType = $data['PeriodType']; 
                $periodMonth= $data['PeriodMonth']; 
                if($periodType == 1){
                    $periodHeader = "1st half of ".$periodMonth;
                }else if ($periodType == 2){
                    $periodHeader = "2nd half of ".$periodMonth;
                }else{
                    $periodHeader = "Month of ".$periodMonth;
                }
                
                if($curProgCode == "" && $curProgCode != $program){
                    $rows .= "  <tr>
                                    <td style='vertical-align:top; padding:5px;'>
                                        <div style='font-weight:bold;'>".$program."</div>
                                        <div style='font-family:VegurL;'>".$progTitle."</div>
                                    </td>
                                    <td style='padding:5px;'>
                                        <div style='font-weight:bold;'>".$acctCode."</div>
                                        <div style='font-family:VegurL;'>".$acctTitle."</div>
                                    </td>
                                    <td style='text-align:right; padding:0px 8px; font-weight:bold; width:130px;'>".number_format($amount, 2)."</td>
                                </tr>";
                    $curProgCode = $program;
                }else{
                    $rows .= "  <tr>
                                    <td></td>
                                    <td style='padding:5px;'>
                                        <div style='font-weight:bold;'>".$acctCode."</div>
                                        <div style='font-family:VegurL;'>".$acctTitle."</div>
                                    </td>
                                    <td style='text-align:right; padding:0px 8px; font-weight:bold; width:130px;'>".number_format($amount, 2)."</td>
                                </tr>";
                }
            }

            $rows .= "  <tr style='background-color:white;'>
                            <td></td>
                            <td colspan='2' style='text-align:right; padding:0px 8px; font-weight:bold; width:130px; font-size:18px; color:red;'>
                                <span style='font-weight:bold; color:black; font-size:16px; text-align:right; margin-right:10px;'>Total</span>
                                ".number_format($totalAmountMultiple, 2)."
                            </td>
                        </tr>";

            $sheet1 = " 
                        <div class='pHeader1' style='margin-top:12px;'>OBR Details</div>
                        <table border='0' id='tableDoctrackOBRList'  style='margin:0px auto; border-spacing:0px; font-size:14px; font-family:Oswald; width:100%;'>
                            <thead>
                                <tr style='background-color: rgb(121, 137, 141); color: white;'>
                                    <th style='padding:3px 5px; font-size:14px; text-align:left;'>Program</th>
                                    <th style='padding:3px 5px; font-size:14px; text-align:left;'>Code</th>
                                    <th style='padding:3px 5px; font-size:14px; padding-left:32px;'>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                ".$rows."
                            </tbody>
                        </table>";
            
            $all = $sheet0.$sheet1; 
        }else{
            $periodHeader = "";
            $all = "<div style='text-align:center; font-size:20px; font-weight:bold; margin-top:20px;'>This Tracking has an incomplete PTRS No.</div>";
        }

        unset($deductionBrk);
   }else{
    $periodHeader = "";
    $all = "<div style='text-align:center; font-size:20px; font-weight:bold; margin-top:20px;'>This Tracking does not have an AFMIS record.</div>";
   }
    
?>

<html>
<head>
    <title>Payroll Breakdown</title>
    <link rel="icon" href="/citydoc2019/images/red.png"/> 

    <style>
    @font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
	}
    @font-face{
		font-family: VegurL;
		src:url(../fonts/arro_vegur/Vegur-Light.otf);
	}
    #tableDoctrackDBFList{
        margin:0px auto;
        margin-bottom:5px;
        border-spacing: 0px;
        border:1px solid rgb(211, 212, 212);
        border-bottom: 3px solid rgb(211, 212, 212);
        font-size:11px;
        padding:2px;
        font-family:Oswald;
    }

    #tableDoctrackDBFList td{
        text-align: right;
        border:1px solid white;
        padding:5px;
    }

    #tableDoctrackDBFList td:nth-child(10), td:nth-child(11), td:nth-child(12){
        background-color:rgb(241, 244, 230);
    }

    #tableDoctrackDBFList td:nth-child(2), #tableDoctrackDBFList td:nth-child(9), #tableDoctrackDBFList td:nth-child(13){
        background-color:rgb(230, 232, 233);
    }

    #tableDoctrackDBFList tr:nth-child(odd), #tableDoctrackOBRList tr:nth-child(even) {
        background-color:rgb(230, 243, 246);
    }

    #tableDoctrackDBFList tr:hover > td {
        background: rgb(248, 236, 165);
    }

    .pHeader1{
        border-bottom: 3px solid rgba(222,222,222,.5);
        margin: 8px 0px;
        font-family: VegurL;
        font-weight:bold;
        padding:3px 0px; 
        padding-left:8px;
        font-size:20px;
        letter-spacing: 1px;
        color:rgba(0,0,0,.8);
    }
    </style>
</head>
<body>
    <div style="width:1200px; margin:0px auto;">
        <div style="">
            <table border='0' style='margin: 0px auto;  margin-bottom: 0px; border-spacing: 0px;width:100%;'>
                <tr>
                    <td style='text-align: right; padding: 0px 5px 0px 5px; padding: 5px 0px;'>
                        <img src='../images/davaologo.png' style='width: 100px;'>
                    </td>
                    <td style='width: 45%; padding-top: 25px;'>
                        <div class='formHeader' style='text-align: center; font-size: 22px; font-weight: bold; margin-bottom: -3px; cursor: pointer;'>PAYROLL BREAKDOWN</div>
                        <div style='text-align: center; font-size: 12px;'>City Government of Davao</div>
                        <div style='text-align: center; font-size: 12px;'><?= $officeName ?></div>
                        <div style='text-align: center; font-size: 16px;'><?= $periodHeader ?></div>
                    </td>
                    <td style='vertical-align: bottom; text-align: right; padding-right: 10px; width: 25%;'>
                        <div>TN: <span style='font-weight: bold; font-size: 21px; letter-spacing: 2px; font-family: impact;'><?= $trackingNumber ?></span></div>
                        <div style='font-size: 12px; letter-spacing: 3px; margin-top: -3px;'>DocTrack 2023</div>
                    </td>
                </tr>
            </table>
        </div>
        <div style="">
            <?= $all ?>
        </div>
    </div>
</body>
</html>