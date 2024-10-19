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
	<title>List of Items</title>
    <style>
        html,body {
            padding:0;
            margin:0;
        }

        #itemsTable {
            width:100%;
            font-size:13px;
        }

        #itemsTable th {
            border-bottom:1px solid black;
            font-size:14px;
        }

        #itemsTable td {
            border-right:1px solid silver;
            border-bottom:1px solid silver;
        }

        #itemsTable td:first-child {
            border-left:1px solid silver;
        }

        #itemsTable tr:first-child td {
            border:0px;
            border-bottom:1px solid black;
            font-size:14px;
            font-weight:bold;
        }

        #itemsTable td:first-child {
            font-size:10px;
            vertical-align:top;
            font-style:italic;
            line-height:16px;
        }
    </style>
</head>
<?php
$category = $database->charEncoder($_GET['cat']);
$catDesc = $database->charEncoder($_GET['des']);
$dbYear = $database->charEncoder($_GET['year']);
$db = 'citydoc'.$dbYear;
$sheet = "";

$dt = time();
$rightNow = date('Y-m-d H:i:s', $dt);

$sql = "select * from $db.ppmpitems where categorycode = '" . $category . "' order by description asc";
$record  = $database->query($sql); 

$sheet .= "<div style='width:750px; margin:0px auto;'>
            <div style='padding:5px 0px; border-bottom:2px solid black;'>
                <div style='text-align:center; padding:5px 0px; font-size:22px; font-weight:bold;'>
                    Document Tracking System ".$dbYear."
                    <div style='font-size:11px; font-weight:normal; letter-spacing:1px; text-transform:uppercase; margin-bottom:8px;'>Price Table</div>
                </div>
                <table border='0' cellpadding='0' cellspacing='0' style='font-size:12px; width:100%;'>
                    <tr>
                        <td style='width:0px; white-space:nowrap; text-align:right; padding:2px 5px;'>Category :</td>
                        <td style='width:0px; white-space:nowrap; padding:2px 5px; border-bottom:1px solid black; font-size:14px; font-weight:bold;'>".$category." - ".$catDesc."</td>
                        <td style='padding:0px 20px; width:0px;'></td>
                        <td rowspan='2' style='width:0px; white-space:nowrap; vertical-align:top; line-height:24px;'>Approved By :</td>
                        <td style='padding:1px 5px;'><input type='text' style='width:100%; border:0px; background-color:transparent; text-align:center; padding:2px 5px; font-family:times; font-weight:bold; font-size:14px; border-bottom:1px solid black;'></td>
                    </tr>
                    <tr>
                        <td style='width:0px; white-space:nowrap; text-align:right; padding:2px 5px;'>Date Printed :</td>
                        <td style='width:0px; white-space:nowrap; padding:2px 5px;'>".$rightNow."</td>
                        <td style='padding:0px 20px; width:0px;'></td>
                        <td style='padding:1px 5px;'><input type='text' style='width:100%; border:0px; background-color:transparent; text-align:center; padding:2px 5px; font-family:times;' value='General Services Office'></td>
                    </tr>
                </table>
            </div>
            <div style='padding:5px 0px;'>
                <table border='0' cellpadding='0' cellspacing='0' id='itemsTable' style=''>
                    <tbody>
                        <tr>
                            <td style='width:0px; padding:2px 3px;'></td>
                            <td style='width:0px; padding:2px 5px; text-align:center;'>Item#</td>
                            <td style='padding:2px 5px; text-align:center;'>Description</td>
                            <td style='width:0px; padding:2px 5px; text-align:right; white-space:nowrap;'>Est. Price</td>
                        </tr>
                ";
$row = 0;
while ($data = $database->fetch_array($record)) {
    $id =   $data['Id'];
    $desc =   $data['Description'];
    $unit = $data['PurchasedUnit'];
    $cat = $data['CategoryCode'];
    $price = $database->toNumberFormat($data['EstimatedPrice']);

    $sheet .= "     <tr>
                        <td style='padding:2px 5px; text-align:right;'>".++$row."</td>
                        <td style='padding:2px 5px; vertical-align:top; text-align:center;'>".$id."</td>
                        <td style='padding:2px 5px; vertical-align:top; font-size:11px;'>".$desc."</td>
                        <td style='padding:2px 5px; vertical-align:top; text-align:right; font-weight:bold;'>".$price."</td>
                    </tr>
                ";
}

$sheet .= "         </tbody>";
$sheet .= "     </table>";
$sheet .= " </div>";
$sheet .= "</div>";
?>
<body>
    <?= $sheet; ?>
</body>
<script></script>
</html>