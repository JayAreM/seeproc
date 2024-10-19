<?php
session_start();

if(!isset($_SESSION['employeeNumber'])){
    $link = "<script>window.open('../../citydoc2023/interface/login.php','_self')</script>";
    echo $link;
}

require_once('../includes/database.php');
require_once('../javascript/ajaxFunction.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/citydoc2023/images/Print.png"/> 
	<title>Paymaster Summary</title>
    <style>
        @font-face {
            font-family: jaldi;
            src: url("../fonts/Jaldi-Regular.ttf");
        }
        body{
            padding:0px;
            margin:0px;
            font-family:jaldi;
        }

        .tableBodyPM{
            margin:0px auto;
            width:100%;
            font-size:11px;
            line-height:12px;
        }
        .tableBodyPM th {
            padding:2px 5px;
            border-top:1px solid black;
            border-right:1px solid black;
            text-transform:uppercase;
            line-height:12px;
            letter-spacing:1px;
        }
        .tableBodyPM th:first-child {
            border:0px;
        }
        .tableBodyPM td {
            border-bottom:1px solid black;
            border-right:1px solid black;
            padding:2px 5px;
            text-align:center;
            font-size:13px;
        }
        .tableBodyPM tr:first-child td {
            border-top:1px solid black;
        }
        .tableBodyPM td:nth-child(2) {
            border-left:1px solid black;
        }
        .tableBodyPM td:first-child, .tableBodyPM tr:first-child td:first-child {
            border:0px;
        }
        .tableBodyPM tr:nth-last-child(2) td{
            border-bottom:0px;
        }
        .blankInput {
            border:0px;
            width:100%;
            padding:2px 5px;
            font-family:jaldi;
        }
    </style>
</head>
<?php
$trackingNumber = $database->charEncoder($_GET['trackingNumber']);

$sql = "SELECT * FROM vouchercurrent WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
$record = $database->query($sql);
$data = $database->fetch_array($record);
$officer = $data['Claimant'];
$fund = $data['Fund'];
$year = $data['Year'];
$dt = time();
$datetime = date('Y-m-d h:i A', $dt);

$sql = "SELECT Window, NumOfEmps FROM particulars WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
$record = $database->query($sql);
$data = $database->fetch_array($record);
$headerWindow = $data['Window'];


$sql = "SELECT 
        a.*, b.NumOfEmps, b.Window, b.OfficeAssigned
        FROM 
        vouchercurrent a 
        LEFT JOIN particulars b ON a.TrackingNumber = b.TrackingNumber
        where a.TrackingPartner = '".$trackingNumber."' GROUP BY a.TrackingNumber ORDER BY a.Claimant ASC";

$record = $database->query($sql);
$numRows = $database->num_rows($record);

$numOfPages = intval($numRows/25);
if($numRows%25 > 0){
    $numOfPages++;
}

$sheet = "";
$row = 0;
$rowDis = 0;
$curTotalEmps = 0;
$curTotal = 0;
$curTotalPS = 0;
$curTotalMOOE = 0;
$grandTotalEmps = 0;
$grandTotal = 0;
$page = 0;
while($data = $database->fetch_array($record)){
    $name = $data['Claimant'];
    $window = $data['Window'];
    $officeAssigned = $data['OfficeAssigned'];
    $numOfPers = intval($data['NumOfEmps']);
    $obr = $data['OBR_Number'];
    $officeCode = $data['Office'];
    $progCode = $data['PR_ProgramCode'];
    $windowTN = $data['TrackingNumber'];

    $periodMonth = $data['PeriodMonth'];
    $periodType = $data['PeriodType'];
    
    if($periodType  == 1 ){
        $p = '&nbsp;1&nbsp;-&nbsp;15,&nbsp;';
    }else if($periodType  == 2){
        $p = '&nbsp;16&nbsp;-&nbsp;31,&nbsp;';
    }else{
        $p = '';
    }

    $period = "(".$periodMonth.$p.")";


    $fundType = "";
    $acctCode = $data['PR_AccountCode'];
    if(substr($acctCode, 0, 3) == "501"){
        $fundType = "PS";
    }else if(substr($acctCode, 0, 3) == "502"){
        $fundType = "MOOE";
    }

    $adv = $data['ADV1'];
    $progCode = $data['PR_ProgramCode'];
    $docType = $data['DocumentType'];

    $amountPS = 0;
    $amountMOOE = floatval($data['NetAmount']);
    
    if($fundType == "PS"){
        $amountPS = $amountMOOE;
        $amountMOOE = 0;
    }

    if($sheet == ""){
        $sheet .= headerPMForm($headerWindow, $officer, $fund, $trackingNumber, $year, $datetime, $curTotalEmps, $curTotal, ++$page, $numOfPages);
    }
    
    $sheet .= " <tr>
                <td style='text-align:right;'>".++$rowDis."</td>
                <td style='text-align:left;'>".$name."</td>
                <td style=''>".$numOfPers."</td>
                <td style='text-align:left; white-space:nowrap;'>".$windowTN."</td>
                <td style='text-align:left; white-space:nowrap;'>".$officeAssigned."</td>
                <td style=''>".$obr."</td>
                <td style='text-align:left;'>".$adv."</td>
                <td style='text-align:left; white-space:nowrap;'>".$progCode."</td>
                <td style='text-align:left; font-size:12px; white-space:nowrap;'>".$docType."&nbsp;".$period."</td>
                <td style=''>".$fundType."</td>
                <td style=''>".$acctCode."</td>
                <td style='text-align:right; letter-spacing:1px;'>".$database->toNumberFormat($amountPS)."</td>
                <td style='text-align:right; letter-spacing:1px;'>".$database->toNumberFormat($amountMOOE)."</td>
            </tr>";
    ++$row;
    $curTotalEmps += $numOfPers;
    $curTotal += ($amountMOOE + $amountPS);
    $curTotalPS += $amountPS;
    $curTotalMOOE += $amountMOOE;
    $grandTotalEmps += $numOfPers;
    $grandTotal += ($amountMOOE + $amountPS);

    if($row == 25){
        $row = 0;
        $sheet .= footerPMFormSubTotal($curTotalEmps, $database->toNumberFormat($curTotal), $database->toNumberFormat($curTotalPS), $database->toNumberFormat($curTotalMOOE));
        $sheet .= "</tbody></table></div>";
        $sheet .= headerPMForm($headerWindow, $officer, $fund, $trackingNumber, $year, $datetime, $curTotalEmps, $database->toNumberFormat($curTotal), ++$page, $numOfPages);
    }
}

if($numRows > 25){
    $sheet .= footerPMFormSubTotal($curTotalEmps, $database->toNumberFormat($curTotal), $database->toNumberFormat($curTotalPS), $database->toNumberFormat($curTotalMOOE));
}
$sheet .= footerPMFormGrandTotal($grandTotalEmps, $database->toNumberFormat($grandTotal));

?>
<!-- 
8.5 in = 816 px
13 in = 1248 px 
-->
<body>
        <?= $sheet; ?>
    </div>
</body>
    <script>
        window.ondblclick = pmAddNewRow;
        function pmAddNewRow() {
            var lastContainerIndex = document.body.children.length - 2;
            var lastContainer = document.body.children[lastContainerIndex];
            var table = lastContainer.children[1];
            var tbody = table.children[1];
            var lastRow = tbody.children.length - 1;
            
            var sheet  = "  <td style='text-align:right;'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; text-align:left;'><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; '><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; text-align:left; white-space:nowrap;'><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; text-align:left; white-space:nowrap;'><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; '><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; text-align:left;'><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; text-align:left; white-space:nowrap;'><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; text-align:left; font-size:12px; white-space:nowrap;'><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; '><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; '><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; text-align:right; letter-spacing:1px;'><input class='blankInput'></td>"
                        +"  <td style='border-top:1px solid black; border-bottom:0px; padding:0px; text-align:right; letter-spacing:1px;'><input class='blankInput'></td>";

            var tr = document.createElement('TR');
            tr.innerHTML = sheet;
            tbody.insertBefore(tr, tbody.children[lastRow]);
        }
    </script>
</html>
<?php
function headerPMForm($window, $officer, $fund, $trackingNumber, $year, $datetime, $balanceEmps, $balance, $page, $numOfPages){
    // $sheet = "<div style='width:1248px; height:816px; margin:0px auto;'>
    // $sheet = "<div style='width:1200px; height:780px; margin:0px auto; break-inside:avoid; page-break-inside:avoid; display:block; border:1px solid red;'>
    $sheet = "<div style='width:1200px; margin:0px auto; break-inside:avoid; page-break-inside:avoid; display:block; margin-top:10px;'>
                <div class='pmHeader' style ='width:100%;margin:0 auto;'>
                    <table border='0' cellpadding='0' cellspacing='0' style='margin: 0px auto; width:100%;'>
                        <tr>
                            <td style='width:40%; text-align: right; padding: 0px 5px 0px 5px;'>
                                <img src='../images/davaologo.png' style='width: 100px;'>
                            </td>
                            <td style='text-align:center; font-size:14px; line-height:18px;'>
                                <div style='font-size:18px; font-weight:bold;'>City&nbsp;Treasurer's&nbsp;Office</div>
                                <div>Cash&nbsp;Disbursement&nbsp;Division</div>
                                <div style='text-transform:uppercase; font-weight:bold; letter-spacing:1px; font-size:22px;'>".$fund."</div>
                            </td>
                            <td style='width:40%; vertical-align: bottom; text-align: right; padding-right: 10px;'>
                                <div>TN: <span style='font-weight: bold; font-size: 21px; letter-spacing: 2px; font-family: impact;'>".$trackingNumber."</span></div>
                                <div style='font-size: 12px; letter-spacing: 3px; margin-top: -3px;'>DocTrack".$year."</div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='2' style='padding-left:20px;'>
                                <table border='0' cellpadding='0' cellspacing='0' style='font-size:12px;padding-bottom:10px; line-height:16px;'>
                                    <tr>
                                        <td style='text-align:right; padding-left:5px; vertical-align:bottom;'>Window&nbsp;:</td>
                                        <td style='padding-left:5px; font-size:16px; font-weight:bold; text-transform:uppercase; letter-spacing:1px;'>".$window."</td>
                                    </tr>
                                    <tr>
                                        <td style='text-align:right; padding-left:5px; vertical-align:bottom;'>Officer&nbsp;:</td>
                                        <td style='padding-left:5px; font-size:16px; font-weight:bold; text-transform:uppercase; letter-spacing:1px;'>".$officer."</td>
                                    </tr>
                                    <tr>
                                        <td style='text-align:right; padding-left:5px; vertical-align:bottom;'>Date&nbsp;:</td>
                                        <td style='padding-left:5px;'>".$datetime."</td>
                                    </tr>
                                </table>
                            </td>
                            <td style='text-align:right; vertical-align:bottom; padding-bottom:10px;'>
                                <span style='font-style:italic; font-size:12px; margin-right:10px;'>Page ".$page." of ".$numOfPages."</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <table border='0' cellpadding='0' cellspacing='0' class='tableBodyPM' style=''>
                    <thead>
                        <tr>
                            <th rowspan='2' style='width:10px;'></th>
                            <th rowspan='2' style='border-left:1px solid black; text-align:left;'>Name</th>
                            <th rowspan='2' style='width:10px;'>No.&nbsp;of Persons</th>
                            <th rowspan='2' style='width:10px;'>TN</th>
                            <th rowspan='2' style='width:10px;'>Office</th>
                            <th rowspan='2' style='width:10px;'>OBR&nbsp;No.</th>
                            <th rowspan='2' style='width:10px;'>ADV</th>
                            <th rowspan='2' style='width:10px;'>Fund</th>
                            <th rowspan='2' style='width:220px;'>Type&nbsp;of&nbsp;Claims</th>
                            <th colspan='2'>Allotment</th>
                            <th colspan='2'>Amount</th>
                        </tr>
                        <tr>
                            <th style='width:10px; border:1px solid black; border-left:0px; border-bottom:0px;'>Class</th>
                            <th style='width:10px; border:1px solid black; border-left:0px; border-bottom:0px;'>Code</th>
                            <th style='width:10px; border:1px solid black; border-left:0px; border-bottom:0px;'>PS</th>
                            <th style='width:10px; border:1px solid black; border-left:0px; border-bottom:0px;'>MOOE</th>
                        </tr>
                        
                    </thead>
                    <tbody>
            ";
    if($balance != "" || $balanceEmps != ""){
        $sheet .= "  <tr>
                        <td style='border:0px;'></td>
                        <td style='border:0px; border-top:1px solid black; border-bottom:1px solid black; border-left:1px solid silver; text-align:right; letter-spacing:1px; font-size:14px;'>Balance Forwarded</td>
                        <td style='border:0px; border-top:1px solid black; border-bottom:1px solid black; text-align:center;'>".$balanceEmps."</td>
                        <td colspan='8' style='border:0px; border-top:1px solid black; border-bottom:1px solid black; '></td>
                        <td style='border:0px; border-top:1px solid black; border-bottom:1px solid black; text-align:right;'></td>
                        <td style='border:0px; border-top:1px solid black; border-bottom:1px solid black; border-right:1px solid silver; text-align:right;'>".$balance."</td>
                    </tr>";
    }

    return $sheet;
}

function footerPMFormSubTotal($curTotalEmps, $curTotal, $curTotalPS, $curTotalMOOE){
    $sheet = "  <tr>
                    <td style='border:0px;'></td>
                    <td style='border:0px; border-top:1px solid black;'></td>
                    <td style='border:0px; border-top:1px solid black; text-align:center;'>".$curTotalEmps."</td>
                    <td colspan='7' style='border:0px; border-top:1px solid black; text-align:right; font-size:14px;'>Sub Total</td>
                    <td colspan='2' style='border:0px; border-top:1px solid black; text-align:right; letter-spacing:1px; font-size:15px;'>".$curTotalPS."</td>
                    <td style='border:0px; border-top:1px solid black; text-align:right; letter-spacing:1px; font-size:15px;'>".$curTotalMOOE."</td>
                </tr>";
    return $sheet;
}

function footerPMFormGrandTotal($grandTotalEmps, $grandTotal){
    $sheet = "  <tr>
                    <td style='border:0px;'></td>
                    <td style='border:0px; border-top:1px solid black;'></td>
                    <td style='border:0px; border-top:1px solid black; text-align:center; font-weight:bold;'>".$grandTotalEmps."</td>
                    <td colspan='10' style='border:0px; border-top:1px solid black; text-align:right; font-weight:bold; font-size:14px;'>
                        <span>Grand Total</span><input class='blankInput' maxlength='18' value='".$grandTotal."' style='font-size:15px; font-weight:bold; padding:0px; width:130px; text-align:right;'>
                    </td>
                </tr>";
    $sheet .= "</tbody></table>";
    $sheet .= " <div style='margin-top:15px;'>
                    <table border='0' cellpadding='0' cellspacing='0' style='margin:0px auto; width:100%; padding-left:20px;'>
                        <tr>
                            <td>Prepared By :</td>
                            <td>Certified By :</td>
                        </tr>
                        <tr>
                            <td style='padding:20px 0px 0px 20px;'>
                                <div style='padding:0px; width:300px;'>
                                    <input style='width:100%; border:0px; font-size:14px; font-family:Times; text-align:center; padding:3px; text-transform:uppercase; font-weight:bold;' placeholder='Name' value='EVELYN S. ENFESTAN'>
                                </div>
                                <div style='padding:0px; width:300px; border-top:1px solid black;'>
                                    <input style='width:100%; border:0px; font-size:12px; font-family:Times; text-align:center; padding:3px; text-transform:uppercase;' placeholder='Position' value='FUND CONTROL ASSISTANT'>
                                </div>
                            </td>
                            <td style='padding:20px 0px 0px 20px;'>
                                <div style='padding:0px; width:300px;'>
                                    <input style='width:100%; border:0px; font-size:14px; font-family:Times; text-align:center; padding:3px; text-transform:uppercase; font-weight:bold;' placeholder='Name' value='NESTOR E. ONG'>
                                </div>
                                <div style='padding:0px; width:300px; border-top:1px solid black;'>
                                    <input style='width:100%; border:0px; font-size:12px; font-family:Times; text-align:center; padding:3px; text-transform:uppercase;' placeholder='Position' value='CHIEF-CASH DISBURSEMENT DIVISION'>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>";

    $sheet .= "</div>";

    return $sheet;
}
?>