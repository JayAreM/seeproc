<META http-equiv=Content-Type content="text/html; charset=iso-8859-1"/> 
<!DOCTYPE HTML>
<?php
	require_once('../includes/database.php');
	require_once('../interface/sheets.php');
	
	require_once('../javascript/ajaxFunction.php');
	
    $trackingNumber = $_GET['tn'];
    $trackingType = "";
    if(substr($trackingNumber, 0, 3) == 'PR-') {
        $sql = "SELECT * FROM prrecord WHERE TrackingNumber = '".$trackingNumber."' ORDER BY Sequence, Description";
        $trackingType = "PR";
    }else {
        $sql = "SELECT * FROM porecord WHERE TrackingNumber = '".$trackingNumber."' ORDER BY Sequence, Description";
        $trackingType = "PO";
    }
    $record = $database->query($sql);
    
    $row = 0;
    $items = "";
    while ($data = $database->fetch_array($record)) {
        $id = $data['Id'];
        $unit = $data['Unit'];
        $description = $data['Description'];
        $qty = $data['Qty'];
        $unitCost = $data['Amount'];
        $amount = $data['Total'];

        $items .= " <tr class='rowOnHover' ondragstart='drag(event)' ondragover='allowDrop(event)' ondrop='drop(event, this)' ondragend='dragEnd(event)' draggable='true'>
                        <td style='vertical-align:top; padding:5px 10px 0px 10px; text-align:center; font-size:12px; font-weight:bold;' id='itm".$id."'>".++$row."</td>
                        <td style='vertical-align:top; padding:5px 10px 0px 10px; text-align:center; font-size:12px; color:gray; font-weight:bold;'>".$row."</td>
                        <td style='vertical-align:top; padding:2px 8px;'>".$unit."</td>
                        <td style='vertical-align:top; padding:2px 8px; text-align:center;'>".abs($qty)."</td>
                        <td style='vertical-align:top; padding:2px 8px;'>".nl2br($description)."</td>
                        <td style='vertical-align:top; padding:2px 8px; text-align:right;'>".number_format($unitCost, 2)."</td>
                        <td style='vertical-align:top; padding:2px 8px; text-align:right;'>".number_format($amount, 2)."</td>
                    </tr>";
    }

?>

<style>
    @font-face{
		font-family: NOR;
		src: url(../fonts/Abel-Regular.ttf);
	}

    body {
        background-color: white !important;
    }

    #itemList > tr:nth-child(even) {
        background-color: rgb(230, 243, 246);
    }
    #itemList td:not(:last-child) {
        border-right:2px solid white;
    }
    #itemList td:first-child {
        border-left:1px solid rgba(192, 192, 192, .45);
        background-color:rgb(230, 232, 233);
    }
    #itemList td:nth-child(2) {
        background-color:rgb(241, 244, 230);
    }
    #itemList td:last-child {
        border-right:1px solid rgba(192, 192, 192, .45);
    }
    #itemList tr:last-child {
        border-bottom:1px solid rgba(192, 192, 192, .45);
    }

    #itemList tr:hover > td {
        background-color:rgb(248, 236, 165);
    }

    .rowOnHover {
        cursor:pointer;
        border-bottom:2px solid white;
    }


</style>

<html>
	<head>
		<title>Re-order Items</title>
		<link rel="icon" href="../images/red.png"/> 
		<link rel="stylesheet" href="../css/style.css" />
	</head>
	<body>
        <div style="padding:20px 0px;">
            <span style="display:none;" id="trackingNumber"><?= $trackingNumber ?></span>
            <table border="0" cellpadding="0" style="min-width:70%; max-width:70%; margin:0px auto; font-family:NOR; border-collapse:collapse; border-bottom:1px solid rgba(192, 192, 192, .45);">
                <thead>
                    <tr>
                        <th colspan="6" style="text-align:left; font-size:22px; padding:0px 0px 5px 5px;">
                            <div><?= $trackingType ?> Item List</div>
                            <div style="font-weight:normal; font-size:12px; color:gray; letter-spacing:1px;">(Please hold and drag the item to re-arrange. After re-arranging, please click the button below the item list to save the new order.)</div>
                        </th>
                    </tr>
                    <tr style="background-color:rgb(12, 71, 123); color:white; border:1px solid rgb(12, 71, 123); border-bottom:2px solid white;">
                        <th style="padding:2px 10px; white-space:nowrap; width:0px; background-color:rgb(43, 50, 56);">Order</th>
                        <th style="padding:2px 10px; white-space:nowrap; width:0px;">Row</th>
                        <th style="padding:2px 8px; white-space:nowrap; width:0px; text-align:left;">Unit</th>
                        <th style="padding:2px 8px; white-space:nowrap; width:0px;">Qty</th>
                        <th style="padding:2px 8px; white-space:nowrap;">Description</th>
                        <th style="padding:2px 8px; white-space:nowrap; width:0px; text-align:right;">Unit Cost</th>
                        <th style="padding:2px 8px; white-space:nowrap; width:0px; text-align:right;">Amount</th>
                    </tr>
                </thead>
                <tbody id="itemList"><?= $items ?></tbody>
            </table>
            <div style="text-align:center; padding:20px 0px;">
                <span style="padding:5px 12px; font-family:NOR; font-size:18px; background-color: rgb(230, 237, 241); border-right:1px solid silver; border-bottom:1px solid silver; cursor:pointer;" onclick="updateItemSequence()">Save Order</span>
            </div>
        </div>
    </body>

<script>

    function updateItemSequence() {
        var row = 0;
        var list = document.getElementById('itemList');

        var newSeq = "";
        for (var i = 0; i < list.children.length; i++) {
            var tr = list.children[i];
            var td = tr.children[0];
            var num = td.textContent.trim();
            var item = td.id.replace('itm','');

            newSeq += '~'+item;
        }
        var tn = document.getElementById('trackingNumber').textContent.trim();

        loader();
        var queryString = "?updateItemSequence=1&tn="+tn+"&newSeq="+newSeq.substr(1);
        var container = "";
        ajaxGetAndConcatenate(queryString, processorLink, container, 'updateItemSequence');
    }

    function updateListNumbers() {
        var row = 0;
        var list = document.getElementById('itemList');
        var dragRow = trRow.children[0].textContent;

        for (var i = 0; i < list.children.length; i++) {
            var tr = list.children[i];
            var num = tr.children[0];

            tr.style.backgroundColor = "";
            trRow.style.backgroundColor = "rgb(241, 244, 230)";

            num.innerHTML = ++row;
        }
    }
    
	/*********************************DRAGGABLE**************************************/
	var trRow;
	function allowDrop(event) {
		event.preventDefault();
		// detectMouseMovement(event);
	}
	function drag(event) {
		event.dataTransfer.setData("Text", event.target.id);
		trRow = event.target;
	}
	function drop(event, me) {
		var e = event;
		e.preventDefault();

		var rowNode = e.target;
		do {
			rowNode = rowNode.parentNode;
			if(rowNode.className == 'rowOnHover') {
				break;
			}
		}while(e.target.parentNode.className != "rowOnHover");	


		if(e.target.parentNode.rowIndex > trRow.rowIndex) {
			if(e.target.parentNode.className != "rowOnHover") {
				rowNode.after(trRow);
			}else {
				e.target.parentNode.after(trRow);
			}
		}else {
			if(e.target.parentNode.className != "rowOnHover") {
				rowNode.before(trRow);
			}else {
				e.target.parentNode.before(trRow);
			}
		}

        updateListNumbers();
		
	}
	function dragEnd(event) {
		// document.getElementById("demo").innerHTML = "Finished dragging the p element.";
	}

	/*********************************DRAGGABLE**************************************/
</script>   
</html>
