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
	<title>Item Information</title>
    <style>
        @font-face{
            font-family: NOR;
            src: url(../fonts/Abel-Regular.ttf);
        }
        body{
            padding:0px;
            margin:0px;
            font-family:NOR;
        }
    </style>
</head>
<?php
    $row = $database->charEncoder($_GET['row']);
    $year = $database->charEncoder($_GET['year']);
    $trackingNumber = $database->charEncoder($_GET['tn']);
    $db = $database->getDB($year);
    $dt = time();
    $datePrinted = date('Y-m-d h:i A', $dt);

    $sheet = "";
    $newRecord = [];

    $sql = "SELECT `Set` FROM inventory.pisrecord WHERE Id = '".$row."' LIMIT 1";
    $record = $database->query($sql);
    $data = $database->fetch_array($record);
    $withSet = $data['Set'];

    $sql = "SELECT * FROM inventory.pisrecord WHERE Id = '".$row."' LIMIT 1";
    if($withSet > 0) {
        $sql = "SELECT * FROM inventory.pisrecord WHERE Year = '".$year."' AND TrackingNumber = '".$trackingNumber."' AND `Set` = '".$withSet."' ORDER BY Description ASC";
    }
    $record = $database->query($sql);

    while ($data = $database->fetch_array($record)) {
        $id = $data['Id'];
        $yearTn = $data['Year'];
        $tnThis = $data['TrackingNumber'];
        $item = $data['Item'];
        $brand = $data['Brand'];
        $desc = $data['Description'];
        $qty = $data['Qty'];
        $unit = $data['Unit'];

        if($qty == 1) {
            $unit = substr($unit, 0, strpos($unit, '/'));
        }

        $sn = $data['SerialNumber'];
        $model = $data['ModelNumber'];
        $classification = $data['ItemClassification'];
        $empN = $data['EmployeeNumber'];
        $uname = $data['NameAssignedTo'];

        $set = $data['Set'];
        $withSet = 0;
        if($set > 0) {
            $withSet = 1;
        }

        $dateAcq = $data['DateAcquired'];
        $dateReceived = $data['DateReceived'];
        $poDetails = $data['ManualDetails'];
        $proNum = $data['PropertyNumber'];
        $stcNum = $data['StickerNumber'];
        $classificationNumber =  $data['ClassificationNumber'];
        $ucost = $data['UnitCost'];
        // $amount = $data['Amount'];
        $amount = number_format($database->nullToZero($data['Amount']),2);
        $inBy = $data['InspectedBy'];
        $remarks = $data['Remarks'];
        $postn = $data['Position'];
        $curName = $data['CurrentUser'];
        $curNum = $data['CurrentUserNum'];
        $curPos = $data['CurrentUserPos'];
        $status = $data['Status'];
        $transfer = $data['Transfer'];
        $encoded = $data['DateEncoded'];
        $cost =  number_format($database->nullToZero($data['UnitCost']),2);
        $category = $data['Category'];
        $officeCode = $data['Office'];
        $encodedBy = $data['EncodedBy'];

        $newRecord[$id]['Year'] = $yearTn;
        $newRecord[$id]['TrackingNumber'] = $tnThis;
        $newRecord[$id]['Item'] = $item;
        $newRecord[$id]['Brand'] = $brand;
        $newRecord[$id]['Description'] = $desc;
        $newRecord[$id]['Qty'] = $qty;
        $newRecord[$id]['Unit'] = $unit;
        $newRecord[$id]['SerialNumber'] = $sn;
        $newRecord[$id]['ModelNumber'] = $model;
        $newRecord[$id]['ItemClassification'] = $classification;
        $newRecord[$id]['EmployeeNumber'] = $empN;
        $newRecord[$id]['NameAssignedTo'] = $uname;
        $newRecord[$id]['Set'] = $set;
        $newRecord[$id]['DateAcquired'] = $dateAcq;
        $newRecord[$id]['DateReceived'] = $dateReceived;
        $newRecord[$id]['ManualDetails'] = $poDetails;
        $newRecord[$id]['PropertyNumber'] = $proNum;
        $newRecord[$id]['StickerNumber'] = $stcNum;
        $newRecord[$id]['ClassificationNumber'] = $classificationNumber;
        $newRecord[$id]['UnitCost'] = $ucost;
        $newRecord[$id]['Amount'] = $amount;
        $newRecord[$id]['InspectedBy'] = $inBy;
        $newRecord[$id]['Remarks'] = $remarks;
        $newRecord[$id]['Position'] = $postn;
        $newRecord[$id]['CurrentUser'] = $curName;
        $newRecord[$id]['CurrentUserNum'] = $curNum;
        $newRecord[$id]['CurrentUserPos'] = $curPos;
        $newRecord[$id]['Status'] = $status;
        $newRecord[$id]['Transfer'] = $transfer;
        $newRecord[$id]['DateEncoded'] = $encoded;
        $newRecord[$id]['UnitCost'] = $cost;
        $newRecord[$id]['Category'] = $category;
        $newRecord[$id]['Office'] = $officeCode;
        $newRecord[$id]['EncodedBy'] = $encodedBy;

        if($trackingNumber != "") {
            $sql1 = "SELECT PO_Number, Claimant FROM ".$db.".vouchercurrent WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
            $record1 = $database->query($sql1);

            $data1 = $database->fetch_array($record1);
            $newRecord[$id]['PO_Number'] = $data1['PO_Number'];
            $newRecord[$id]['Claimant'] = $data1['Claimant'];
        }else {
            $newRecord[$id]['PO_Number'] = "";
            $newRecord[$id]['Claimant'] = "";
        }

        $sql2 = "SELECT Name FROM ".$db.".office WHERE Code = '".$officeCode."' LIMIT 1";
        $record2 = $database->query($sql2);

        $data2 = $database->fetch_array($record2);
        $newRecord[$id]['OfficeName'] = $data2['Name'];

        if($year > 2017 && $trackingNumber != "") {
            $sql3 = "SELECT InvoiceNumber, InvoiceDate, PoDate, DateAcquired FROM ".$db.".particulars WHERE TrackingNumber = '".$trackingNumber."' LIMIT 1";
            $record3 = $database->query($sql3);

            $data3 = $database->fetch_array($record3);
            $newRecord[$id]['InvoiceNumber'] = $data3['InvoiceNumber'];
            $newRecord[$id]['InvoiceDate'] = $data3['InvoiceDate'];
            $newRecord[$id]['PoDate'] = $data3['PoDate'];
            $newRecord[$id]['DateAcquired'] = $data3['DateAcquired'];
        }else {
            $newRecord[$id]['InvoiceNumber'] = "";
            $newRecord[$id]['InvoiceDate'] = "";
            $newRecord[$id]['PoDate'] = "";
            $newRecord[$id]['DateAcquired'] = "";
        }
        

        $sql4 = "SELECT FirstName, LastName FROM citydoc.employees WHERE EmployeeNumber = '".$encodedBy."' LIMIT 1";
        $record4 = $database->query($sql4);

        $data4 = $database->fetch_array($record4);
        $newRecord[$id]['EncodedName'] = $data4['FirstName']." ".$data4['LastName'];

        $sql5 = "SELECT * FROM ppmpcategories WHERE Code = '".$category."' LIMIT 1";
        $record5 = $database->query($sql5);

        $data5 = $database->fetch_array($record5);
        $newRecord[$id]['CategoryName'] = $data5['Description'];

    }


    if(sizeof($newRecord) > 1) {
        $tdRow = 0;
        foreach ($newRecord as $itemRow => $details) {
            $year = $details['Year'];
            $tn = $details['TrackingNumber'];
            $item = $details['Item'];
            $brand = $details['Brand'];
            $desc = $details['Description'];
            $qty = $details['Qty'];
            $unit = $details['Unit'];
            $sn = $details['SerialNumber'];
            $model = $details['ModelNumber'];
            $classification = $details['ItemClassification'];
            $empN = $details['EmployeeNumber'];
            $uname = $details['NameAssignedTo'];
            $set = $details['Set'];
            $dateAcq = $details['DateAcquired'];
            $dateReceived = $details['DateReceived'];
            $poDetails = $details['ManualDetails'];
            $proNum = $details['PropertyNumber'];
            $stcNum = $details['StickerNumber'];
            $classificationNumber =  $details['ClassificationNumber'];
            $cost = $details['UnitCost'];
            $amount = $details['Amount'];
            $inBy = $details['InspectedBy'];
            $remarks = $details['Remarks'];
            $office = $details['OfficeName'];
            $postn = $details['Position'];
            $curName = $details['CurrentUser'];
            $curNum = $details['CurrentUserNum'];
            $curPos = $details['CurrentUserPos'];
            $status = $details['Status']; 
            $transfer = $details['Transfer'];
            $encoded = $details['DateEncoded'];
            $encodedBy = ucwords(strtolower($details['EncodedName']));
            $category = $details['Category'];
            $categoryName = $details['CategoryName'];

            if($sheet == "") {
                $sheet .= formHeader($year, $trackingNumber, $uname, $datePrinted, $curName, $office, $withSet, $amount, $category, $categoryName);
            }

            $bodyCost = "   <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver; text-align:right;'>".$cost."</td>
                            <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver; text-align:right;'>".$amount."</td>
                            ";
            if($withSet > 0) {
                $bodyCost = "";
            }

            $sheet .= " <tr>
                            <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver;'>".++$tdRow."</td>
                            <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver;'>".$brand."</td>
                            <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver;'>".nl2br($desc)."</td>
                            <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver;'>".$qty."&nbsp;".$unit."</td>
                            <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver;'>".$model."</td>
                            <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver;'>".$sn."</td>
                            <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver;'>".$proNum."</td>
                            <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver;'>".$stcNum."</td>
                            ".$bodyCost."
                            <td style='font-size:11px; padding:2px 5px; vertical-align:top; border-bottom:1px solid silver;'>".$status."</td>
                        </tr>
                    ";
            
        }

        $sheet .= "</tbody>";
        $sheet .= "</table>";
        $sheet .= " <div style='font-size:11px; text-align:right; padding:2px 3px; letter-spacing:1px;'>
                        Date printed : ".$datePrinted."
                    </div>";
        $sheet .= "</div>";
        
    }else {
        $year = $newRecord[$row]['Year'];
        $tn = $newRecord[$row]['TrackingNumber'];
        $item = $newRecord[$row]['Item'];
        $brand = $newRecord[$row]['Brand'];
        $desc = $newRecord[$row]['Description'];
        $qty = $newRecord[$row]['Qty'];
        $unit = $newRecord[$row]['Unit'];
        $sn = $newRecord[$row]['SerialNumber'];
        $model = $newRecord[$row]['ModelNumber'];
        $classification = $newRecord[$row]['ItemClassification'];
        $empN = $newRecord[$row]['EmployeeNumber'];
        $uname = $newRecord[$row]['NameAssignedTo'];
        $set = $newRecord[$row]['Set'];
        $dateAcq = $newRecord[$row]['DateAcquired'];
        $dateReceived = $newRecord[$row]['DateReceived'];
        $poDetails = $newRecord[$row]['ManualDetails'];
        $proNum = $newRecord[$row]['PropertyNumber'];
        $stcNum = $newRecord[$row]['StickerNumber'];
        $classificationNumber =  $newRecord[$row]['ClassificationNumber'];
        $cost = $newRecord[$row]['UnitCost'];
        $amount = $newRecord[$row]['Amount'];
        $inBy = $newRecord[$row]['InspectedBy'];
        $remarks = $newRecord[$row]['Remarks'];
        $office = $newRecord[$row]['OfficeName'];
        $postn = $newRecord[$row]['Position'];
        $curName = $newRecord[$row]['CurrentUser'];
        $curNum = $newRecord[$row]['CurrentUserNum'];
        $curPos = $newRecord[$row]['CurrentUserPos'];
        $status = $newRecord[$row]['Status']; 
        $transfer = $newRecord[$row]['Transfer'];
        $encoded = $newRecord[$row]['DateEncoded'];
        $encodedBy = ucwords(strtolower($newRecord[$row]['EncodedName']));
        $category = $newRecord[$row]['Category'];
        $categoryName = $newRecord[$row]['CategoryName'];

        $sheet = "<div style='width:750px; margin:0px auto; break-inside:avoid; page-break-inside:avoid; display:block; margin-top:10px;'>
                    <div style='padding-bottom:5px;'>
                        <table border='0' cellspacing='0' cellpadding='0' style='margin:0px auto; width:100%;'>
                            <tr>
                                <td style='width:15%;'></td>
                                <td style='text-align:center; width:0px; line-height:20px; padding:10px 0px;'>
                                    <div style='font-size:24px; font-weight:bold;'>Item Information</div>
                                    <div style='font-size:14px;'>City Government of Davao</div>
                                    <div style='font-size:16px;'>".$office."</div>
                                </td>
                                <td style='vertical-align:bottom; text-align:right; line-height:14px; white-space:nowrap; width:15%;'>
                                    <div>TN :&nbsp;<span style='font-weight:bold; font-size:22px; font-family:Impact; letter-spacing:1px;'>".$trackingNumber."</span></div>
                                    <div style='font-size:14px;'>DocTrack<span style='font-weight:bold;'>".$year."</span></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style='padding-bottom:15px;'>
                        <table border='0' cellspacing='0' cellpadding='0' style='font-size:14px;'>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Assigned to :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$uname."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Used by :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$curName."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Category :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$category." - ".$categoryName."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Brand :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$brand."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Model :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$model."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Unit :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$qty."&nbsp;".$unit."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Cost :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$cost."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Total :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$amount."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Description :</td>
                                <td style='padding:3px 5px; min-width:200px; border:1px solid rgba(200,200,200,.3); font-weight:bold;'>
                                    ".nl2br($desc)."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Serial :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$sn."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Property :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$proNum."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Sticker :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$stcNum."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Status :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$status."
                                </td>
                            </tr>
                            <tr>
                                <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right; vertical-align:top;'>Encoded by :</td>
                                <td style='white-space:nowrap; padding:1px 5px; min-width:200px; font-weight:bold;'>
                                    ".$encodedBy."
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div style='font-size:11px; text-align:right; padding:2px 3px; letter-spacing:1px; border-top:1px solid silver;'>
                        Date printed : ".$datePrinted."
                    </div>
                ";
    }
    
    
?>
<body>
    <?= $sheet; ?>
</body>
<script>
</script>
</html>
<?php
function formHeader($year, $trackingNumber, $uname, $datePrinted, $curName, $office, $withSet, $amount, $category, $categoryName){

    $headerCost = "";
    $tableCost = "  <th style='font-size:12px; width:0px; white-space:nowrap; padding:2px 5px; border:1px solid black; border-left:0px; border-right:0px; text-align:right;'>Cost</th>
                    <th style='font-size:12px; width:0px; white-space:nowrap; padding:2px 5px; border:1px solid black; border-left:0px; border-right:0px; text-align:right;'>Total</th>
                 ";
    if($withSet > 0) {
        $tableCost = ""; 
        $headerCost = " <tr>
                            <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right;'>Cost :</td>
                            <td style='white-space:nowrap; padding:1px 5px; border-bottom:1px solid rgba(200,200,200,.3); min-width:200px; font-weight:bold;'>
                                ".$amount."
                            </td>
                        </tr>";
    }

    $sheet = "<div style='width:750px; margin:0px auto; break-inside:avoid; page-break-inside:avoid; display:block; margin-top:10px;'>
                <div style='padding-bottom:5px;'>
                    <table border='0' cellspacing='0' cellpadding='0' style='margin:0px auto; width:100%;'>
                        <tr>
                            <td style='width:15%;'></td>
                            <td style='text-align:center; width:0px; line-height:20px; padding:10px 0px;'>
                                <div style='font-size:24px; font-weight:bold;'>Item Information</div>
                                <div style='font-size:14px;'>City Government of Davao</div>
                                <div style='font-size:16px;'>".$office."</div>
                            </td>
                            <td style='vertical-align:bottom; text-align:right; line-height:14px; white-space:nowrap; width:15%;'>
                                <div>TN :&nbsp;<span style='font-weight:bold; font-size:22px; font-family:Impact; letter-spacing:1px;'>".$trackingNumber."</span></div>
                                <div style='font-size:14px;'>DocTrack<span style='font-weight:bold;'>".$year."</span></div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style='padding-bottom:15px;'>
                    <table border='0' cellspacing='0' cellpadding='0' style='font-size:14px;'>
                        <tr>
                            <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right;'>Assigned to :</td>
                            <td style='white-space:nowrap; padding:1px 5px; border-bottom:1px solid rgba(200,200,200,.3); min-width:200px; font-weight:bold;'>
                                ".$uname."
                            </td>
                        </tr>
                        <tr>
                            <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right;'>Used by :</td>
                            <td style='white-space:nowrap; padding:1px 5px; border-bottom:1px solid rgba(200,200,200,.3); min-width:200px; font-weight:bold;'>
                                ".$curName."
                            </td>
                        </tr>
                        <tr>
                            <td style='width:0px; white-space:nowrap; padding:1px 5px; text-align:right;'>Category :</td>
                            <td style='white-space:nowrap; padding:1px 5px; border-bottom:1px solid rgba(200,200,200,.3); min-width:200px; font-weight:bold;'>
                                ".$category." - ".$categoryName."
                            </td>
                        </tr>
                        ".$headerCost."
                        
                    </table>
                </div>
                <table border='0' cellspacing='0' cellpadding='0' style='width:100%;'>
                    <thead style=''>
                        <th style='border:1px solid black; border-left:0px; border-right:0px;'></th>
                        <th style='font-size:12px; width:0px; white-space:nowrap; padding:2px 5px; border:1px solid black; border-left:0px; border-right:0px;'>Brand</th>
                        <th style='font-size:12px; white-space:nowrap; padding:2px 5px; border:1px solid black; border-left:0px; border-right:0px; text-align:left;'>Description</th>
                        <th style='font-size:12px; width:0px; white-space:nowrap; padding:2px 5px; border:1px solid black; border-left:0px; border-right:0px; text-align:left;'>Unit</th>
                        <th style='font-size:12px; width:0px; white-space:nowrap; padding:2px 5px; border:1px solid black; border-left:0px; border-right:0px;'>Model</th>
                        <th style='font-size:12px; width:0px; white-space:nowrap; padding:2px 5px; border:1px solid black; border-left:0px; border-right:0px; text-align:left;'>Serial</th>
                        <th style='font-size:12px; width:0px; white-space:nowrap; padding:2px 5px; border:1px solid black; border-left:0px; border-right:0px; text-align:left;'>Property</th>
                        <th style='font-size:12px; width:0px; white-space:nowrap; padding:2px 5px; border:1px solid black; border-left:0px; border-right:0px; text-align:left;'>Sticker</th>
                        ".$tableCost."
                        <th style='font-size:12px; width:0px; white-space:nowrap; padding:2px 5px; border:1px solid black; border-left:0px; border-right:0px;'>Status</th>
                    </thead>
                    <tbody>
             ";
    return $sheet;
}

function formFooter($curTotalEmps, $curTotal, $curTotalPS, $curTotalMOOE){
    $sheet = "";
    return $sheet;
}

?>