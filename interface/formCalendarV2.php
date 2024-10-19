<?php
	session_start();
	require_once('../includes/database.php');
	require_once('../javascript/ajaxFunction.php');

    $accountType = $_SESSION['accountType'];
	$month = $database->charEncoder($_GET['month']);
    $year = $database->charEncoder($_GET['year']);
    $day = $database->charEncoder($_GET['day']);
    $status = $database->charEncoder($_GET['status']);
    $dateModified =  $year . '-' . $month . '-' . $day ;

    $dt = time();
	$dateEncoded = date('Y-m-d h:i A', $dt);
   
    // $sql = "SELECT TrackingNumber, Claimant, TrackingType, DocumentType, Status, Amount, PO_Amount, TotalAmountMultiple, DateModified, Office, Name
    //         FROM vouchercurrent a
    //         LEFT JOIN office b ON a.Office = b.Code
    //         WHERE ".$officeQ." status = '" . $status . "' AND DateModified LIKE '%" .  ($dataModified) . "%'
    //         GROUP BY trackingnumber
    //         ORDER BY Office, Name , Claimant";
    $sql = "SELECT TrackingNumber FROM voucherhistory WHERE Status = '".$status."' AND substr(DateModified, 1, 10) = '".$dateModified."' GROUP BY TrackingNumber";
    $record = $database->query($sql);
    $tnStr = "";
    while($data = $database->fetch_array($record)) {
        $tnStr .= ",'".$data['TrackingNumber']."'";
    }

    $sql = "SELECT TrackingNumber, Claimant, TrackingType, DocumentType, Status, Amount, PO_Amount, TotalAmountMultiple, Office, DateModified, Name, Complex
            FROM vouchercurrent a
            LEFT JOIN office b ON a.Office = b.Code 
            WHERE TrackingNumber IN (".substr($tnStr, 1).") GROUP BY TrackingNumber ASC ORDER BY Office, Name , Claimant";
    $record = $database->query($sql);
    $numRows = $database->num_rows($record);

    $row = 0;
    $curOff = "";
    $sheet = "<table border='0' class='calendarTable' style='margin:0px auto; width:100%; border-spacing:0px; font-size:13px;'>
                <thead>
                    <th></th>
                    <th style='font-size:11px; text-align:left;'>TRACKING#</th>
                    <th style='font-size:11px; text-align:left;'>CLAIMANT</th>
                    <th style='font-size:11px; text-align:left;'>TYPE</th>
                    <th style='font-size:11px; text-align:right; padding-right:5px;'>AMOUNT</th>
                    <th style='font-size:11px; text-align:left; padding-left:5px;'>CLASSIFICATION</th>
                </thead>
                <tbody>
                ";
    while ($data = $database->fetch_array($record)) {
        $tn = $data['TrackingNumber'];
        $claimant = $data['Claimant'];
        $office = $data['Name'];
        $trackingType = $data['TrackingType'];
        $docType = $data['DocumentType'];
        $status = $data['Status'];

        $class = '';
        $complex = $data['Complex'];
        if($complex == 1) {
            $class = 'Simple';
        }elseif($complex == 2) {
            $class = 'Complex';
        }

        $amount = $data['Amount'];
        $poAmount = $data['PO_Amount'];
        $mul = $data['TotalAmountMultiple'];
        if($trackingType == "PO"){
            $docType = "P.O / Payment";
            if($mul > 0){
                $amount = $mul;
            }else{
                $amount = $poAmount;
            }
        }else{
            if($mul > 0){
                $amount = $mul;
            }
        }
        $amount = number_format($amount,2);
    
        if($trackingType == "PR"){
            $docType = "Purchase Request";
        }
        $dateModified = $data['DateModified'];

        if($curOff == "" || $curOff != $office){
            $sheet .= " <tr>
                            <td style='border:0px;'></td>
                            <td colspan='5' style='border:1px solid black; border-top:0px; padding:5px; font-size:10px; letter-spacing:1px; font-weight:bold; background-color:lightgray;'>".$office."</td>
                        </tr>";
            $curOff = $office;
        }

        $sheet .= " <tr>
                        <td style='padding-right:5px; text-align:right; font-size:11px; font-style:italic; font-weight:bold;'>".++$row."</td>
                        <td>".$tn."</td>
                        <td>".$claimant."</td>
                        <td>".$docType."</td>
                        <td style='text-align:right; padding-right:5px;'>".$amount."</td>
                        <td style='padding-left:5px;'>".$class."</td>
                    </tr>";
    }
    $sheet .= " <tr>
                    <td></td>
                    <td colspan='5' style='padding-right:5px; font-size:11px; border:0px; padding-top:10px; font-size:12px;'>Printed&nbsp;:&nbsp;".$dateEncoded."</td>
                </tr>";
    $sheet .= " </tbody>
              <table>";

	// 8.5 in = 816 px //
	// 13 in = 1248 px //
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="icon" href="/citydoc2018/images/print.png"/> 
	<title>Print Calendar</title>
    <style>
        .calendarTable td{
            border-bottom: 1px solid black;
            padding:2px;
        }
        .calendarTable th:first-child, .calendarTable td:first-child{
            border:0px;
        }
        .calendarTable th{
            border:0px;
            border-bottom:1px solid black;
            padding:2px;
        }
    </style>
</head>
<body>
    <div style="margin:0px auto; width:790px; height:1248px;">
        <div>
            <table border="0" style="margin-top:30px; width:100%; border-spacing:0px;">
                <tr>
                    <td style="width:90px;" rowspan="2">
                        <div style="height:90px; width:90px; background:url(../images/dvo.png); background-repeat:no-repeat; background-size:100% 100%;"></div>
                    </td>
                    <td colspan="2" style="font-size:14px; padding-left:5px; vertical-align:bottom;">
                        <div>Republic of the Philippines</div>
                        <div>City Government of Davao</div>
                    </td>
                </tr>
                <tr>
                    <td style="width:10px; vertical-align:top; padding-left:5px;">Status&nbsp;:&nbsp;</td>
                    <td style="vertical-align:top;">
                        <div style="font-weight:bold;"><?= $status ?></div>
                        <div style="font-size:12px;"><?= $dateModified ?></div>
                    </td>
                </tr>
                <tr style="font-size:12px;">
                    <td colspan="3" style="text-align:right; padding-right:5px;"><?= $numRows ?> accounts</td>
                </tr>
                <tr>
                    <td style="padding:3px 0px;"></td>
                </tr>
            </table>
        </div>
        <div>
            <?= $sheet ?>
        </div>
    </div>
</body>
</html>