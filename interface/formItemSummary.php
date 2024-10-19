<?php 
	require_once('../javascript/ajaxFunction.php');
	//$emp = $_GET['emp'];
	$emp = '501573';
	$dt = time();
	$printDate = date('F d, Y', $dt);

?>
<head>
	<title>Item Summary</title>
</head>
<style type="text/css">
	.sumCont{
		width: 1230px;
		/*height: 750px;*/
		/*border: 2px solid black;*/
	}
	.sumHeaderLabel{
		font-size: 14px;
		font-weight: bold;
		padding: 3px 5px;
		border-bottom: 1px solid black;
		border-right: 1px solid black;
		border-top: 1px solid black;
		font-family: times;
		height: 10px;
	}
	.sumItem{
		text-align: left;
		padding: 3px 8px;
		vertical-align: top;
		border-bottom: 1px solid rgb(227, 225, 225);
	}
</style>
<table style="margin: 0px auto;">
	<tr>
		<td>
			<div id="printContainer"></div>
		</td>
	</tr>
</table>

<script type="text/javascript">
	var employeeNumber = "<?= $emp ?>";
	var printDate = "<?= $printDate ?>";

	getItemsList();
	function getItemsList(){
		var queryString = "?getInvItemSummary=1&emp="+employeeNumber;
		var container = document.getElementById('printContainer');
		// var container = "";
		
		ajaxGetAndConcatenate(queryString, processorLink, container, "returnOnly");
	}

	function createSummarySheet(details){
		var container = document.getElementById('printContainer');
		var j = JSON.parse(details);

		if (container.innerHTML == "") {
			createContainer(j.employeeNumber, j.name, j.position, j.office,container);
		}

		for (var i = 0; i < j.items.length; i++) {

			var sumCont = container.children[container.children.length-1];
			var tableContainer = sumCont.children[1];
			var tbody = tableContainer.children[0].children[0];

			var tr = "";
			tr = "<tr>"
			   + "	<td class='sumItem' style='text-align: center; border-right: 1px solid black; border-left: 1px solid black;'>"+(i+1)+"</td>"
			   // + "	<td class='sumItem' style='border-right: 1px solid black;'>"+j.items[i].year+"</td>"
			   + "	<td class='sumItem' style='border-right: 1px solid black;'>"+j.items[i].brand+"</td>"
			   + "	<td class='sumItem' style='border-right: 1px solid black;'>"+j.items[i].desc+"</td>"
			   + "	<td class='sumItem' style='border-right: 1px solid black;'>"+j.items[i].sticker+"</td>"
			   + "	<td class='sumItem' style='border-right: 1px solid black;'>"+j.items[i].dateReceived+"</td>"
			   + "</tr>"
			   ;

			tbody.innerHTML += tr;

			if (tableContainer.scrollHeight > tableContainer.offsetHeight) {
				var tbody = container.children[container.children.length-1].children[1].children[0].children[0];
				var tblLen = tbody.children.length;
				var lastChild = tbody.children[tblLen-1];
				var descCont = lastChild.children[3];
				var desc = descCont.innerHTML;
				var desc2 = desc;

				var explodedDesc = desc.split(/\r?\n/);
				descCont.innerHTML = "";

				if (explodedDesc.length > 1) {
					var halfText = "";
					for (var a = 0; a < explodedDesc.length; a++) {
						if (tableContainer.scrollHeight > tableContainer.offsetHeight) {

							if (explodedDesc[a] !== "") {
								if (explodedDesc[a].includes("PO") == true) {
									// halfText += "\n&nbsp;\n";
								}
								halfText += explodedDesc[a]+"\n";
							}
						} else {
							if (explodedDesc[a] !== "") {
								if (explodedDesc[a].includes("PO") == true) {
									descCont.innerHTML += "<br>";
								}
								descCont.innerHTML += explodedDesc[a]+"\n";
							}
						}
					}

					if (tableContainer.scrollHeight > tableContainer.offsetHeight) {
						var tempArr = descCont.innerHTML.trim().split(/\r?\n/);
						halfText = tempArr[tempArr.length-1]+"\n"+halfText.trim();
						tempArr.pop();
						descCont.innerHTML = tempArr.join("\n");
					}

					createContainer(j.employeeNumber, j.name, j.position, j.office,container);
					sumCont = container.children[container.children.length-1];
					tableContainer = sumCont.children[1];
					tbody = tableContainer.children[0].children[0];

					var tr = "";
					tr = "<tr>"
					   + "	<td class='sumItem' style='text-align: center; border-right: 1px solid black;  border-left: 1px solid black;'></td>"
					   // + "	<td class='sumItem' style='border-right: 1px solid black;'></td>"
					   + "	<td class='sumItem' style='border-right: 1px solid black;'></td>"
					   + "	<td class='sumItem' style='border-right: 1px solid black;'>"+halfText+"</td>"
					   + "	<td class='sumItem' style='border-right: 1px solid black;'></td>"
					   + "	<td class='sumItem' style='border-right: 1px solid black;'></td>"
					   + "</tr>"
					   ;

					tbody.innerHTML += tr;
				} else {
					var tbody = container.children[container.children.length-1].children[1].children[0].children[0];
					var tblLen = tbody.children.length;
					var lastChild = tbody.children[tblLen-1];

					tbody.removeChild(lastChild);
					createContainer(j.employeeNumber, j.name, j.position, j.office,container);
					sumCont = container.children[container.children.length-1];
					tableContainer = sumCont.children[1];
					tbody = tableContainer.children[0].children[0];
					i--;
				}
			}
		}

		var tables = document.getElementsByClassName('borderBottom');
		for (var i = 0; i < tables.length; i++) {
			var lastChild = tables[i].children[0].children[tables[i].children[0].children.length-1];
			lastChild.children[0].style.borderBottom = "0px";
			lastChild.children[1].style.borderBottom = "0px";
			lastChild.children[2].style.borderBottom = "0px";
			lastChild.children[3].style.borderBottom = "0px";
			lastChild.children[4].style.borderBottom = "0px";
		}
	}

	function createContainer(emp, name, position, office, container){
		var temp = "";

		temp = "<div class='sumCont'>"
			 + 		areHeader(emp, name, position, office)
			//  + "	<div style='overflow: auto; height: 600px;'>"
			 + "	<div style=''>"
			 + "		<table class='borderBottom' border='0' style='margin: 0px auto; width: 100%; font-size: 13px; text-align: center; border-spacing: 0px; border-bottom: 1px solid black;'>"
			 + "			<tr>"
			 + "				<td class='sumHeaderLabel' style='width: 10px; border-right: 1px solid black; border-left: 1px solid black;'></td>"
			 // + "				<td class='sumHeaderLabel' style='width: 30px;'>Year</td>"
			 + "				<td class='sumHeaderLabel' style='width: 50px;'>Brand</td>"
			 + "				<td class='sumHeaderLabel'>Description</td>"
			 + "				<td class='sumHeaderLabel' style='width: 70px;'>Sticker&nbsp;No.</td>"
			 + "				<td class='sumHeaderLabel' style='width: 130px; text-align: left; padding: 0px 8px;'>Date&nbsp;Received</td>"
			 + "			</tr>"
			 + "		</table>"
			 + "	</div>"
			 + "</div>"
			 ;

		container.innerHTML += temp;
	}

	function areHeader(emp, name, position, office){
		var temp = "";

		temp = "<div class='sumHeader' style='padding-bottom: 20px; '>"
			 + "	<table border='0' style='width: 100%; margin: 0px auto; border-spacing: 0px;'>"
			 + "		<tr>"
			 + "			<td style='text-align: right; padding: 0px 5px 0px 5px;'>"
			 + "				<img src='../images/davaologo.png' style='width: 100px;'>"
			 + "			</td>"
			 + "			<td style='width: 20%; text-align: center; padding: 8px 0px;'>"
			 + "				<div style='font-size: 22px; font-weight: bold; margin-bottom: -3px;'>SUMMARY OF ITEMS</div>"
			 + "				<div style='font-size: 14px;'>City Government of Davao</div>"
			 + "				<div style='font-size: 17px;'>"+office+"</div>"
			 + "			</td>"
			 + "			<td style='vertical-align: bottom; text-align: right; padding-right: 10px; width: 38%;'></td>"
			 + "		</tr>"
			 + "	</table>"
			 + "	<table border='0' style='width: 100%; margin: 0px auto; border-spacing: 0px; padding-top: 20px;'>"
			 + "		<tr>"
			 + "			<td style='font-size: 12px; text-align: right; width: 10px;'>Name&nbsp;:&nbsp;</td>"
			 + "			<td style='width: 68%; vertical-align: bottom;'><span style='border-bottom: 1px solid black; font-size: 14px; display: inline-block; padding-left: 3px; width: 320px; vertical-align: bottom;'>"+name+"</span></td>"
			 + "			<td style='font-size: 12px; text-align: right; width: 80px;'>Prepared by&nbsp;:&nbsp;</td>"
			 + "			<td style='width: 250px; text-align: right; vertical-align: bottom;'><input class='preparedBy' onkeyup='fillUpPreparedBy(this)' type='text' style='width: 250px; border: 0px; border-bottom: 1px solid black; font-size: 14px; display: inline-block; padding-left: 3px; vertical-align: bottom; font-family: times; text-align: center;'></td>"
			 + "		<tr>"
			 + "			<td style='font-size: 12px; text-align: right; width: 10px; padding-left: 10px;'>Position&nbsp;:&nbsp;</td>"
			 + "			<td style='width: 140px; vertical-align: bottom;'><span style='border-bottom: 1px solid black; width: 320px; font-size: 14px; display: inline-block; padding-left: 3px; vertical-align: bottom;'>"+position+"</span></td>"
			 + "			<td style='font-size: 12px; text-align: right; width: 10px; padding-left: 10px;'>Date&nbsp;:&nbsp;</td>"
			 + "			<td style='width: 250px; text-align: right; vertical-align: bottom;'><span style='text-align: center; border-bottom: 1px solid black; width: 247px; font-size: 14px; display: inline-block; padding-left: 3px; vertical-align: bottom;'>"+printDate+"</span></td>"
			 + "		</tr>"
			 + "	</table>"
			 + "</div>"
			 ;

		return temp;
	}

	function fillUpPreparedBy(input){
		var preparedBy = document.getElementsByClassName('preparedBy');
		
		for (var i = 0; i < preparedBy.length; i++) {
			preparedBy[i].value = input.value ;
		}		
	}
</script>