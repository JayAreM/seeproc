<style></style>

<div>
    <table border="0" cellpadding="0" style="border-spacing:0px; width:100%;">
        <tr>
            <td style="width:0px; white-space:nowrap; padding-right:8px;">
                <span class="goodsNum">1</span><span class ="goodsField">Select PO Tracking</span>
            </td>
            <td id="poDoctrackSelect" style="padding-bottom:3px;">
                <select class="goodsData2"><option>&nbsp;</option></select>
            </td>
        </tr>
        <!-- <tr id="trPX1" style="display:none;">
            <td colspan="2" style="width:0px; white-space:nowrap; padding-right:8px;">
                <span class="goodsNum">2</span><span class ="goodsField">Review Details</span>
            </td>
        </tr> -->
        <tr id="trPX2" style="display:none;">
            <td colspan="2" id="tdReviewDetailsPX" style=""></td>
        </tr>
        <tr style="">
			<td colspan="2" style="text-align:center; padding:20px 5px 0px 0px; vertical-align:top;">
                <table border="0" cellpadding="0" style="border-spacing:0px; margin:0px 0px 0px auto;">
                    <tr>
                        <td id="pxTaxDetails" style="vertical-align:top; padding-right:100px;"></td>
                        <td style="vertical-align:top;">
                            <div style="font-weight:bold; font-size:16px; color:rgb(64, 161, 202); background-color:white; padding:2px 8px; font-family:NOR;">Computation Breakdown</div>
                            <table border="0" cellpadding="0" style="display:inline-block; border-spacing:0px; font-size:14px; font-family:NOR; background-color:rgba(248, 249, 248, 1); border:1px dashed black;">
                                <tr>
                                    <td colspan="3" style="padding:5px 0px;"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="text-align:right; padding:3px 5px;">Gross</td>
                                    <td style="">
                                        <input style="font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; text-align:right;" id="totalAmountItemsPXDispOnly" value="0.00" disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0px 40px 0px 20px; color:orange; font-weight:bold;">LESS</td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="text-align:right; padding:3px 5px;">Liquidated Damages</td>
                                    <td style="padding-right:20px;">
                                        <input style="font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; text-align:right; color:red;" id="pxTotalLD" value="0.00" disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="text-align:right; padding:3px 5px; ">Total</td>
                                    <td style="padding-right:20px;">
                                        <input style="font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; border-top:1px dashed black; text-align:right;" id="totalAmountItemsPXLDDispOnly" value="0.00" disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0px 40px 0px 20px; color:orange; font-weight:bold;">LESS</td>
                                    <td colspan="2"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td colspan="2" style="text-align:right; padding:0px 0px 0px 0px;">
                                        <table border="0" cellpadding="0" id="pxTaxesCont" style="border-spacing:0px; font-family:NOR;"></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="text-align:right; padding:3px 5px;">Total Tax</td>
                                    <td style="padding-right:20px;">
                                        <input style="font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; border-top:1px dashed black; text-align:right; color:red;" id="pxTotalTax" value="0.00" disabled>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="padding:5px 0px;"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="text-align:right; padding:3px 5px;"><span style="font-size:12px; color:gray;" id="retentionLabel">(Total &#10006; 1%)</span> Retention</td>
                                    <td style="padding-right:20px;">
                                        <input style="font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; text-align:right; color:red;" id="pxRetention" value="0.00" disabled>
                                    </td>
                                </tr>
                                <tr style="border-bottom:1px dashed black;">
                                    <td colspan="3" style="padding:5px 0px;"></td>
                                </tr>
                            </table>  
                            <table border="0" cellspacing="0" style="margin:0px 0px 0px auto; font-family:NOR;">
                                <tr style="background-color:white;">
                                    <td colspan="3" style="padding:10px 0px; border:0px;"></td>
                                </tr>
                                <tr style="background-color:white;">
                                    <td style=""></td>
                                    <td style="padding:3px 5px 3px 0px; min-width:265px;" colspan="2" id="adjustmentLabel">
                                        <label>
                                            <input type="checkbox" id="showHideAdj" style="cursor:pointer; vertical-align:middle; position:relative; bottom: .08em;" onclick="showHideAdjTable(this)">
                                            Adjustment <span style="color:gray; font-size:11px;">(for special computation only)</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr style="background-color:white;">
                                    <td></td>
                                    <td colspan="2" style="padding:0px 20px 20px 0px;">
                                        <table border="0" cellpadding="0" id="pxAdjustmentTable" style="border-spacing:0px; margin:0px 0px 0px auto; font-size:14px; font-family:NOR; display:none;">
                                            <tr>
                                                <td style="text-align:right; padding:3px 5px; vertical-align:bottom;">Adjustment Type</td>
                                                <td>
                                                    <select id="pxAdjustmentType" style="font-family:NOR; font-size:18px; font-weight:bold; background-color:transparent; width:145px; border:0px; border-bottom:1px dashed silver; text-align:center;" onchange="updatePXAmountDetails()">
                                                        <option></option>
                                                        <option>Add</option>
                                                        <option>Deduct</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:right; padding:3px 5px; vertical-align:bottom;">Description</td>
                                                <td>
                                                    <input style="font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; border-bottom:1px solid black;" id="pxAdjustmentDesc" value="">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:right; padding:3px 5px; vertical-align:bottom;">Amount</td>
                                                <td>
                                                    <input style="font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; border-bottom:1px solid black; text-align:right;" id="pxAdjustmentAmount" value="0.00" onkeydown="return isAmount(this,event)" onkeyup="updatePXAmountDetails()">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="background-color:white;">
                                    <td style=""></td>
                                    <td colspan="2" style="text-align:right; padding:10px 20px 10px 0px; border-top:1px solid black; line-height:16px;">
                                        <span style="padding:0px 5px; vertical-align:bottom; font-size:16px; color:gray;">Net Amount</span>
                                        <!-- <input style="font-family:NOR; font-size:20px; font-weight:bold; color:black; background-color:transparent; width:165px; border:0px; padding:0px; padding-right:2px; text-align:right;" id="pxNetAmount" value="0.00" disabled> -->
                                        <span style="font-family:NOR; font-size:20px; font-weight:bold; color:black; background-color:transparent; width:165px; border:0px; padding:0px; padding-right:2px; text-align:right;" id="pxNetAmount">0.00</span>
                                    </td>
                                </tr>
                            </table>  
                        </td>
                    </tr>
                </table>
            </td>
		</tr>
        <tr id="trPX3" style="display:none;">
			<td colspan="2" style="padding:10px 0px; text-align:center;">
				<div class="button1" style="font-family:NOR;" onclick="savePX()">Save</div><br/>
			</td>
		</tr>
    </table>
</div>

<script>



    function updateCombiDetails() {

        var agriTax = document.getElementById('agriTax');
        if(agriTax) {
            agriTax.parentNode.removeChild(agriTax);
        }

        var taxCont = document.getElementById('pxTaxesCont');
        var sheet = "";
        var totalTax = parseFloat(document.getElementById('pxTotalTax').value.replace(/,/g,""));
        var type = 'EXP';
        var taxPercent = 0.01;
        agriTotal = 0;

        var chkBoxes = document.getElementsByName('agriCheckedItems');

        for (var i = 0; i < chkBoxes.length; i++) {
            var itemChkBox = chkBoxes[i].parentNode.parentNode.children[4].children[0];
            if(itemChkBox.checked == true && chkBoxes[i].checked == true) {
                var baseAmount = parseFloat(chkBoxes[i].parentNode.parentNode.children[13].children[0].value.replace(/,/g,""));
                agriTotal += parseFloat( round2(trimTwoDecimals(baseAmount)) )
            }
        }

        var taxValue = agriTotal * parseFloat(taxPercent);
        if(taxValue > 0) {
            totalTax += parseFloat( round2(trimTwoDecimals(taxValue)) );

            var taxDisp = (taxPercent * 100);
            var code = 28;
            var atc = 'WC610';
            var specifics = encodeURIComponent('Agricultural Products');

            // sheet +="<div id='agriTax'>"
            //     + "<span style='font-size:12px; color:gray;' name='pxTaxPer' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+specifics+"~"+round2(trimTwoDecimals(agriTotal))+"'>(<span id='agriTotal'>"+numberWithCommas( round2(trimTwoDecimals(agriTotal)) )+"</span> &#10006; "+taxDisp+"%)</span><span style='padding:3px 5px;'>"+type+"</span>"
            //     + "<input style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; text-align:right;' name='pxTaxValue' value='"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"' disabled>"         
            //     + "</div>";

            sheet += "<tr id='agriTax'>"
                    +"<td style='font-size:14px; padding-right:5px; '>"+type+"</td>"
                    +"<td style='font-size:12px; color:gray; padding-right:8px;' name='pxTaxPer' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+specifics+"~"+round2(trimTwoDecimals(agriTotal))+"~"+round2(trimTwoDecimals(agriTotal))+"'>(<span id='agriTotal'>"+numberWithCommas( round2(trimTwoDecimals(agriTotal)) )+"</span> &#10006; "+taxDisp+"%)</td>"
                    +"<td style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; text-align:right; padding-left:5px;' name='pxTaxValue'>"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"</td>"
                    +"</tr>";

            taxCont.innerHTML += sheet;

        }
    }

    function selectAllPX(me){
		var b = me.parentNode.parentNode.parentNode;
		var tr = b.children;
		for(var i = 1; i < tr.length-1; i++){
			var td = tr[i];
			if(td.children.length == 14){
				var newCheck = me.checked;
				var oldCheck = td.children[4].children[0].checked;
				if(newCheck != oldCheck){
					td.children[4].children[0].click();
				}
			}			
		}
	}

    function showHideAdjTable(me) {
        var container = document.getElementById('pxAdjustmentTable');

        if(me.checked == true) {
            container.style.display = 'table';
            document.getElementById('adjustmentLabel').style.borderBottom = '1px solid silver';
        }else {
            container.style.display = 'none';
            document.getElementById('pxAdjustmentAmount').value = '';
            document.getElementById('pxAdjustmentDesc').value = '';
            document.getElementById('adjustmentLabel').style.borderBottom = '0px';
            selectToIndexZero('pxAdjustmentType');
        }

        updatePXAmountDetails();

    }

    // round2(trimTwoDecimals());
    function getDetailsByPORelease(me) {
        var trackingNumber = me.value.trim();
        var container = document.getElementById('tdReviewDetailsPX');

        if(trackingNumber.trim().length > 0) {
            loader();
            var queryString = "?getDetailsByPORelease=1&trackingNumber=" + trackingNumber;
            ajaxGetAndConcatenate(queryString,processorLink,container,"getDetailsByPORelease");
        }else {
            // document.getElementById("trPX1").style.display = "none";
            document.getElementById("trPX2").style.display = "none";
            document.getElementById("trPX3").style.display = "none";
            container.innerHTML = "";
            pxAdjustmentTable.style.display = "none";
            pxTaxDetails.innerHTML = '';
            pxTaxesCont.innerHTML = '';

            totalAmountItemsPXDispOnly.value = '0.00';
            pxTotalLD.value = '0.00';
            totalAmountItemsPXLDDispOnly.value = '0.00';
            pxTotalTax.value = '0.00';
            pxRetention.value = '0.00';
            // pxNetAmount.value = '0.00';
            pxNetAmount.textContent = '0.00';

            pxAdjustmentDesc.value = '';
            pxAdjustmentAmount.value = '';
            retentionLabel.innerHTML = '';
            showHideAdj.checked = false;
            selectToIndexZero("pxAdjustmentType");
        }

    }

    function calculateAddPX(me){

        var parent = me.parentNode.parentNode;

        var defQty = parent.children[0].children[2].value;
        var price = parent.children[0].children[3].value;
        var qty = parent.children[6].children[0].value;
        var cost = parent.children[8].children[0].value.replace(/,/g,"");
        var prCost = parent.children[3].children[0].value.replace(/,/g,"");
        var totalCost =  parseFloat(qty * cost);
        var days = parent.children[11].children[0].value;
        var ldField = parent.children[12].children[0];
        var total = parent.children[13].children[0];

        var chk = parent.children[4].children[0];

        if(totalCost > prCost) {
            msg('Your Payment Amount cannot go beyond the PO Amount.');
            // parent.children[7].children[0].value = numberWithCommas(prCost);
            parent.children[8].children[0].value = numberWithCommas( round2(trimTwoDecimals(price)) );
            parent.children[6].children[0].value = defQty;
            calculateAddPX(me);
        }else if(totalCost == 0) {
            parent.children[8].children[0].value = numberWithCommas( round2(trimTwoDecimals(price)) );
            parent.children[6].children[0].value = defQty;
            calculateAddPX(me);
        }else {
            var totalCostContainer = parent.children[10].children[0];

            totalCost = parseFloat(round2(trimTwoDecimals(totalCost)));
			totalCostContainer.value = numberWithCommas(round2(trimTwoDecimals(totalCost)));

            var ld = 0;
            if(days > 0) {
                // ld = parseFloat(totalCost * .01 * .1  * days); 
				ld = totalCost * .01 * .1  * days; 
            }
            ldField.value = numberWithCommas( round2(trimTwoDecimals(ld)) );

            // 2023-10-02 -> trim
            ld = parseFloat(round2(trimTwoDecimals(ld)));

            // var newTotal = numberWithCommas( round2(trimTwoDecimals( parseFloat(totalCost - ld) )) );
            // 2023-10-02 -> no need to round off for addition and subtraction
            // var newTotal = numberWithCommas(parseFloat(trimTwoDecimals(totalCost - ld)));

            var newTotal = totalCost - ld;

			if(ld > 0) {
				total.value = numberWithCommas(newTotal);
			}else {
				total.value = numberWithCommas(round2(trimTwoDecimals(totalCost)));
			}

            // total.value = newTotal;
        }

        if(me.checked == true && me.name == 'agriCheckedItems') {
            me.parentNode.style.backgroundColor = 'rgb(121, 137, 141)';
        }else if(me.type == 'checkbox') {
            me.parentNode.style.backgroundColor = 'rgb(222, 228, 231)';
        }

        var trLength = parent.parentNode.children.length;
        inputTotalsPX(parent.parentNode,trLength);

    }

    function inputTotalsPX(parent,length){
        var g = 0;
        var wLd = 0;
        for(var i = 1 ; i < length-1; i++){
            var check = parent.children[i].children[4].children[0].checked;
            if(check){
                var total =  parseFloat(parent.children[i].children[10].children[0].value.replace(/,/g,""));
                var totalMLd =  parseFloat(parent.children[i].children[13].children[0].value.replace(/,/g,""));

                g += total;
                wLd += totalMLd
            }
        }

        document.getElementById('totalAmountItemsPX').value = numberWithCommas( round2(trimTwoDecimals(g)) );
        document.getElementById('totalAmountItemsPXLD').value = numberWithCommas( round2(trimTwoDecimals(wLd)) );

        updatePXAmountDetails();
    }

    function updatePXAmountDetails() {
        var totalLD = parseFloat(document.getElementById('totalAmountItemsPXLD').value.replace(/,/g,""));
        var totalPO = parseFloat(document.getElementById('totalAmountItemsPX').value.replace(/,/g,""));

        document.getElementById('totalAmountItemsPXDispOnly').value = numberWithCommas( round2(trimTwoDecimals(totalPO)) );
        document.getElementById('totalAmountItemsPXLDDispOnly').value = numberWithCommas( round2(trimTwoDecimals(totalLD)) );

        var nature = document.getElementById('poNature').textContent.trim();
        var specifics = document.getElementById('poSpecifics').textContent.trim();
        var category = document.getElementById("poCategoryNew").textContent;
        var allowRetention = document.getElementById('pxWithRetention').value;
		var recType = document.getElementById('poSupplierRecType').textContent.trim();

        updateCombiDetails();

        var agriTotal = document.getElementById('agriTotal');
        var agriDeduct = 0;
        if(agriTotal) {
            agriDeduct = parseFloat( agriTotal.textContent.replace(/,/g,"") );
        }
        
        var computedBaseAmount = (totalLD - agriDeduct);
        var baseAmount = computedBaseAmount/1.12;
        if(recType == 'NON-VAT') {
			baseAmount = computedBaseAmount;
		}

		baseAmount = parseFloat(round2(trimTwoDecimals(baseAmount)));

        // var baseAmountCont = document.getElementById('pxBaseAmount');
        // baseAmountCont.value = numberWithCommas( round2(trimTwoDecimals(baseAmount)) );

        var taxes = document.getElementsByName('pxTaxes');
        var taxCont = document.getElementById('pxTaxesCont');
        var noTax = document.getElementById('pxTaxNTX');
        var sheet = "";

        if(noTax) {
            taxCont.innerHTML = '';
        }else {

            if(computedBaseAmount > 0) {

                for (var i = 0; i < taxes.length; i++) {
                    var type = taxes[i].id.replace("pxTax", "");
                    var taxPercent = taxes[i].value;
                    var taxValue = baseAmount * parseFloat(taxPercent);

                    var taxDisp = (taxPercent * 100);

                    var code = document.getElementById('px'+type+'Code').value.trim();
                    var atc = document.getElementById('px'+type+'ATC').value.trim();

                    // totalTax += parseFloat( round2(trimTwoDecimals(taxValue)) );

                    var thisSpecifics = specifics;
                    if(thisSpecifics == 'Agricultural products & other Goods/Items') {
                        thisSpecifics = 'General';
                    }

                    if(thisSpecifics == 'With Retention') {
                        thisSpecifics = 'General';
                    }

                    if(thisSpecifics == 'Without Retention') {
                        thisSpecifics = 'General';
                    }

                    // sheet += "<div>"
                    //        + "<span style='font-size:12px; color:gray;' name='pxTaxPer' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+encodeURIComponent(thisSpecifics)+"~"+round2(trimTwoDecimals(computedBaseAmount))+"'>("+numberWithCommas( round2(trimTwoDecimals(computedBaseAmount)) )+" / 1.12 &#10006; "+taxDisp+"%)</span><span style='padding:3px 5px;'>"+type+"</span>"
                    //        + "<input style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; width:145px; border:0px; text-align:right;' name='pxTaxValue' value='"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"' disabled>"         
                    //        + "</div>";

                    if(recType == 'NON-VAT') {
                        sheet += "<tr>"
                                +"<td style='font-size:14px; padding-right:5px;'>"+type+"</td>"
                                +"<td style='font-size:12px; color:gray; padding-right:8px;' name='pxTaxPer' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+encodeURIComponent(thisSpecifics)+"~"+round2(trimTwoDecimals(baseAmount))+"~"+round2(trimTwoDecimals(computedBaseAmount))+"'>("+numberWithCommas( round2(trimTwoDecimals(computedBaseAmount)) )+" &#10006; "+taxDisp+"%)</td>"
                                +"<td style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; text-align:right; padding-left:5px;' name='pxTaxValue'>"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"</td>"
                                +"</tr>";
                    }else {
                        sheet += "<tr>"
                                +"<td style='font-size:14px; padding-right:5px;'>"+type+"</td>"
                                +"<td style='font-size:12px; color:gray; padding-right:8px;' name='pxTaxPer' id='"+type+"~"+taxPercent+"~"+code+"~"+atc+"~"+encodeURIComponent(thisSpecifics)+"~"+round2(trimTwoDecimals(baseAmount))+"~"+round2(trimTwoDecimals(computedBaseAmount))+"'>("+numberWithCommas( round2(trimTwoDecimals(computedBaseAmount)) )+" / 1.12 &#10006; "+taxDisp+"%)</td>"
                                +"<td style='font-family:NOR; font-size:18px; font-weight:bold; color:black; background-color:transparent; text-align:right; padding-left:5px;' name='pxTaxValue'>"+numberWithCommas( round2(trimTwoDecimals(taxValue)) )+"</td>"
                                +"</tr>";
                    }
                }

            }


            var agriTax = document.getElementById('agriTax');
            var oldTaxes = "";
            if(agriTax) {
                oldTaxes = agriTax.outerHTML;
            }

            taxCont.innerHTML = sheet + oldTaxes;

        }


        var modeOfProc = document.getElementById('poModeProc').textContent.trim();

        // if(modeOfProc == 'Agency to Agency' || modeOfProc == 'Postal Office' || category == 'CAT 80' || category == 'CAT 25') {
        //     retentionLabel.innerHTML = '';
        // }else {
        //     retentionLabel.innerHTML = "("+numberWithCommas( round2(trimTwoDecimals(totalPO)) )+" &#10006; 1%)";
        // }

        
        if(allowRetention == 0) {
            retentionLabel.innerHTML = '';
        }else {
            retentionLabel.innerHTML = "("+numberWithCommas( round2(trimTwoDecimals(totalPO)) )+" &#10006; 1%)";
        }


        var totalLDCont = document.getElementById('pxTotalLD');
        var ldList = document.getElementsByName('pxLD');
        var totalJustLD = 0;
        for (var i = 0; i < ldList.length; i++) {
            var justLD = parseFloat(ldList[i].value.replace(/,/g,""));  
            totalJustLD += justLD;  
        } 
        
        totalLDCont.value = numberWithCommas( round2(trimTwoDecimals(totalJustLD)) );

        var retentionCont = document.getElementById('pxRetention');
        // var retention = totalLD * 0.1;

        // var retention = totalPO * 0.01; // change to totalLD 2023-06-03
        var retention = totalLD * 0.01;
        // if(modeOfProc == 'Agency to Agency' || modeOfProc == 'Postal Office' || category == 'CAT 80' || category == 'CAT 25') {
        //     retention = 0;
        // }
        if(allowRetention == 0) {
            retention = 0;
        }


        retentionCont.value = numberWithCommas( round2(trimTwoDecimals(retention)) );

        var adj  = document.getElementById('pxAdjustmentAmount').value.replace(/,/g,"");
		var adjT  = document.getElementById('pxAdjustmentType').value;

        if(adjT.length > 0) {
            if(adj.trim().length > 0) {
                if(adj < 0){
                    adj = 0;
                }else {
                    if(adjT == 'Add') {
                        adj = adj * -1;
                    }
                }
            }else {
                adj = 0;
            }
        }else {
            adj = 0;
            document.getElementById('pxAdjustmentAmount').value = '';
            document.getElementById('pxAdjustmentDesc').value = '';
        }

        var totalTaxForDisp = document.getElementById('pxTotalTax');
        var taxesValue = document.getElementsByName('pxTaxValue');
        var totalTax = 0;
        for (var i = 0; i < taxesValue.length; i++) {
            var tax = parseFloat(taxesValue[i].textContent.replace(/,/g,""));   
            totalTax += parseFloat( round2(trimTwoDecimals(tax)) );
        }

        // totalTaxForDisp.value = numberWithCommas( round2(trimTwoDecimals( parseFloat(totalTax) )) );

        // var total = parseFloat(retention) + parseFloat(totalTax) + parseFloat(adj);
        // var total = parseFloat(round2(trimTwoDecimals(retention))) + parseFloat(round2(trimTwoDecimals(totalTax))) + parseFloat(round2(trimTwoDecimals(adj)));
        // var total = round2(trimTwoDecimals(total));
        // var net = totalLD - total;

        retention = parseFloat(round2(trimTwoDecimals(retention)));
		totalTax = parseFloat(round2(trimTwoDecimals(totalTax)));
		adj = parseFloat(round2(trimTwoDecimals(adj)));

        totalTaxForDisp.value = numberWithCommas(round2(trimTwoDecimals(totalTax)));

		var totalDeductions = retention + totalTax + adj;

        var net = totalLD - totalDeductions;

        // var totalDeduction = total;
        // if(adj < 0) {
        //     totalDeduction = round2(trimTwoDecimals( parseFloat(retention) + parseFloat(totalTax) ));
        // }
        // document.getElementById('pxTotalDeduction').value =  numberWithCommas(totalDeduction);

		// document.getElementById('pxNetAmount').value = numberWithCommas( round2(trimTwoDecimals(net)) );
		document.getElementById('pxNetAmount').textContent = numberWithCommas( round2(trimTwoDecimals(net)) );

    }

    function selectCalculateAddPX(me){	
		var b = me.parentNode.parentNode.parentNode;
		var totality = b.children[b.children.length-1].children[0].children[0];
		if(me.checked == true){
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "rgb(206, 215, 218)";//  "rgb(239, 242, 244)";
            calculateAddPX(me);
		}else{
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "inherit";

            var agriChk = parent.children[5].children[0];
			if(agriChk.checked == true) {
				agriChk.click();
			}

            calculateAddPX(me);
		}
	}

    function savePX(){

        var trackType = 'PX';
        var error = 0;
        var prMonth = 1;
        var poTrackingNumber = document.getElementById("poTrackingNumber").textContent;
        var poMonth = document.getElementById("poMonth").textContent.trim();

        // if(poMonth == "1st Quarter"){
        //     poMonth = 1;
        // }else if(poMonth == "2nd Quarter"){
        //     poMonth = 4;
        // }else if(poMonth == "3rd Quarter"){
        //     poMonth = 7;
        // }else{
        //     poMonth = 10;
        // }

        var obrNumber = document.getElementById("obrNumber").textContent;
        //do not copy ermark from pr to prevent pre printing in obr form
        // obrNumber = '';
        var poNumber = document.getElementById("poNumber").textContent;
        var supplierName = encodeURIComponent(document.getElementById("poSupplier").textContent.trim());
        var fund = document.getElementById("fundType").textContent;

        var totalLD = document.getElementById('pxTotalLD').value.replace(/,/g,"");
        var retention = document.getElementById('pxRetention').value.replace(/,/g,"");
        var adjType = document.getElementById('pxAdjustmentType').value;
        var adjDesc = document.getElementById('pxAdjustmentDesc').value;
        var adjAmount = document.getElementById('pxAdjustmentAmount').value.replace(/,/g,"");
        // var netAmount = document.getElementById('pxNetAmount').value.replace(/,/g,"");
        var netAmount = document.getElementById('pxNetAmount').textContent.replace(/,/g,"");
        var tin = document.getElementById('pxTIN').value.trim();
        var nature = document.getElementById('poNature').textContent.trim();
        var specifics = document.getElementById('poSpecifics').textContent.trim();
        var modeOfProc = document.getElementById('poModeProc').textContent.trim();
        var recType = document.getElementById('poSupplierRecType').textContent.trim();
        var busType = document.getElementById('poSupplierBusType').textContent.trim();

        if(nature.length == 0) {
            error = 10;
        }

        if(specifics.length == 0) {
            error = 11;
        }

        if(modeOfProc.length == 0) {
            error = 12;
        }

        var totalLDAll = document.getElementById('totalAmountItemsPXLD').value.replace(/,/g,"");
        // var baseAmount = round2(trimTwoDecimals( parseFloat(totalLDAll)/1.12 ));

        var agriTotal = document.getElementById('agriTotal');
        var agriDeduct = 0;
        if(agriTotal) {
            agriDeduct = parseFloat( agriTotal.textContent.replace(/,/g,"") );
        }

        var computedBaseAmount = (totalLDAll - agriDeduct);
        var baseAmount = round2(trimTwoDecimals( computedBaseAmount/1.12 ));

        var taxes = "";
        var pxTaxValue = document.getElementsByName('pxTaxValue');
        var pxTaxPer = document.getElementsByName('pxTaxPer');
        if(pxTaxValue.length > 0) {
            for (var i = 0; i < pxTaxValue.length; i++) {
                var temp = pxTaxPer[i].id.split('~');
                taxes += "*j*"+temp[0]+"~"+temp[1]+"~"+parseFloat(pxTaxValue[i].textContent.replace(/,/g,""))+"~"+temp[2]+"~"+temp[3]+"~"+temp[4]+"~"+temp[5]+"~"+temp[6];
            }
        }else {
            taxes += "*j*NAN~0.00~0~0~0~"+specifics+"~0~0";
        }
        taxes = taxes.substr(3);

        var unchecked = 0;
        var poData = '';
        var dummyProgram = '';
        var programs = '';
        var totalDetails = '';
        var parent = document.getElementById('pxItemsTable');
        var trLength = parent.children[0].children.length;
        var category = document.getElementById("poCategoryNew").textContent;
        for(var i = 1 ; i < trLength-1; i++){
            var checkMe = parent.children[0].children[i].children[4].children[0].checked;
            if(checkMe == true){
                var itemDes = encodeURIComponent(parent.children[0].children[i].children[0].children[1].value.trim());
                var program = encodeURIComponent(parent.children[0].children[i].children[1].children[0].value.trim());
                var code = encodeURIComponent(parent.children[0].children[i].children[1].children[1].value.trim());
            
                //var category = encodeURIComponent(parent.children[0].children[i].children[2].children[0].textContent);
                //var desc =encodeURIComponent(parent.children[0].children[i].children[2].children[0].value.trim());
                var desc =  encodeURIComponent(parent.children[0].children[i].children[2].children[0].value.replace(/{+}/g,"~").trim());	
                var qty = parent.children[0].children[i].children[6].children[0].value.trim();
                var unit = encodeURIComponent(parent.children[0].children[i].children[6].children[1].value.trim());
                var cost = parent.children[0].children[i].children[8].children[0].value.replace(/,/g,"");
                var total = parent.children[0].children[i].children[10].children[0].value.replace(/,/g,"");
                var days = parent.children[0].children[i].children[11].children[0].value.trim();
                var ld = parent.children[0].children[i].children[12].children[0].value.replace(/,/g,"");
                var totalLD = parent.children[0].children[i].children[13].children[0].value.replace(/,/g,"");

                var agriChecked = parent.children[0].children[i].children[5].children[0].checked;
                if(agriChecked == true) {
                    agriChecked = 1;
                }else {
                    agriChecked = 0;
                }

                if(days.trim() == "") {
                    days = 0;
                }

                if(ld.trim() == "") {
                    ld = 0;
                }
            
                if(program.length < 4){
                    parent.children[0].children[i].children[1].children[0].style.backgroundColor ="rgb(253, 191, 222)";
                    error = 1;
                }
                if(code.length < 8){
                    parent.children[0].children[i].children[1].children[1].style.backgroundColor ="rgb(253, 191, 222)";
                    error = 1;
                }
                if(desc.length < 1){
                    parent.children[0].children[i].children[2].children[0].style.backgroundColor ="rgb(253, 191, 222)";
                    error = 1;
                }
                if(qty.length < 1){
                    parent.children[0].children[i].children[6].children[0].style.backgroundColor ="rgb(253, 191, 222)";
                    error = 1;
                }
                if(unit.length < 1){
                    parent.children[0].children[i].children[6].children[2].style.backgroundColor ="rgb(253, 191, 222)";
                    error = 1;
                }
                if(cost.length < 1){
                    parent.children[0].children[i].children[8].children[0].style.backgroundColor ="rgb(253, 191, 222)";
                    error = 1;
                }
                
                poData += '~#~' + category + '~!~' +  program + '~!~' + code + '~!~' + desc + '~!~' + qty + '~!~' + unit + '~!~'  +  cost + '~!~' + itemDes + '~!~' + days + '~!~' + ld + '~!~' + totalLD + '~!~' + agriChecked;	
                totalDetails += '!#!' + category + '~!~' +  program + '~!~' + code + '~!~' + totalLD + '~!~' + total;
                
                if(dummyProgram != program){
                    programs += program + '~';
                    dummyProgram = program;
                }
            }else {
                unchecked++;
            }
        }

        //pigeon sort
        var detailsA = totalDetails.substr(3).split('!#!');
        var batchTotals = {};
        for(var i = 0 ; i < detailsA.length; i++){
            var detailsB = detailsA[i].split('~!~');
            var category = detailsB[0];
            var program = detailsB[1];
            var code = detailsB[2];
            var total = detailsB[3];
            var poTotal = detailsB[4];
            if(batchTotals[category + '~' + program+ '~' + code] == undefined){
                batchTotals[category + '~' + program+ '~'+code] = 0;
            }
            batchTotals[category + '~' + program+ '~'+code] = parseFloat( batchTotals[category + '~' +program+ '~'+code]) +  parseFloat(poTotal);
        }

        var grp = '';
        var oTotal = 0;
        for (var key in batchTotals) { 
            var splitA =   key.split('~');
            var category = splitA[0];
            var program = splitA[1];
            var code = splitA[2];
            var total = 	batchTotals[key] ;
            oTotal = oTotal + total;
            grp += encodeURIComponent(category) + '~!~' + encodeURIComponent(program)+ '~!~' +  encodeURIComponent(code) + '~!~' + total + '~#~';
        }
        
        if(oTotal == 0){
            error = 3;
        }

        var poTotal = parseFloat(document.getElementById('totalAmountItemsPXPO').value.replace(/,/g,""));

        var trackedPXTotal = document.getElementById('totalAmountPXsTracked');
        if(trackedPXTotal) {
            trackedPXTotal = parseFloat(trackedPXTotal.textContent.replace(/,/g,""));
        }else {
            trackedPXTotal = 0;
        }

        var curPXTotal = parseFloat(document.getElementById('totalAmountItemsPX').value.replace(/,/g,""));
        var pxTotal = trackedPXTotal + curPXTotal;

        if(pxTotal > poTotal) {
            error = 6;
        }

        if(adjType.trim().length > 0 || adjDesc.trim().length > 0 || adjAmount > 0) {
            if(adjType.trim().length > 0 && adjDesc.trim().length > 0 && adjAmount > 0) {
                error = 0;
            }else {
                error = 7;
            }
        }

        if(parseFloat(netAmount) <= 0) {
            error = 8;
        }

        if( (trLength - 2) == unchecked ) {
            error = 9;
        }

        var acctNumber = document.getElementById('pxGasAcctNum').value.trim();
        if(category == 'CAT 80' && poTrackingNumber.substring(0, 4) == 'ONE1' && acctNumber.length == 0) {
            error = 13;
        }

        var gasPeriod = document.getElementById('pxGasPeriod').value.trim();
        if(category == 'CAT 80' && poTrackingNumber.substring(0, 4) == 'ONE1' && gasPeriod.length == 0) {
            error = 14;
        }

        var disaProject = document.getElementById('poDisasterProject').textContent.trim();

        if(error == 0){

            var queryString =   "saveTrackingPostPX=1&trackType=" + trackType + 
                                "&poTrackingNumber=" + poTrackingNumber + 
                                "&poNumber=" + poNumber + 
                                "&obrNumber=" + obrNumber + 
                                "&supplier=" + supplierName + 
                                "&poMonth=" + poMonth + 
                                "&fund=" + fund + 
                                "&grp=" + grp +
                                "&poData=" + poData.substr(3)  + 
                                "&oTotal=" + oTotal +
                                "&taxes=" + taxes +
                                "&totalLD=" + totalLDAll +
                                "&ret=" + retention +
                                "&aType=" + adjType +
                                "&aDesc=" + adjDesc +
                                "&aAmnt=" + adjAmount +
                                "&category=" + category +
                                "&tin=" + tin +
                                "&nature=" + nature +
                                "&specifics=" + specifics +
                                "&recType=" + recType +
                                "&busType=" + busType +
                                "&baseAmnt=" + baseAmount +
                                "&acctNumber=" + acctNumber +
                                "&gasPeriod=" + gasPeriod +
                                "&pxTotal=" + curPXTotal +
                                "&net=" + netAmount +
                                "&disaster=" + disaProject;

            var container = document.getElementById('goodsNewTrackingNumber');

            loader();
            ajaxPost(queryString,processorLink, container,"saveTrackingPostPX");
        }else if(error == 1){
            msg("Please complete the required fields.");
        }else if(error == 2){
            msg("Please select schedule in step 2. </br>PR items must be reviewed again.");
        }else if(error == 3){
            msg("Please complete the required fields.");
        }else if(error == 6){
            msg("You cannot exceed the total PO Amount.</br>Please review your Items and PO Tracking Created.");
        }else if(error == 7){
            msg("Please check adjustment details.");
        }else if(error == 8){
            msg("Please check Computation Breakdown.");
        }else if(error == 9){
            msg("Please check at least one(1) item.");
        }else if(error == 10){
            msg("Please select the Nature of the PO Transaction.");
        }else if(error == 11){
            msg("Please select the Specifics of the Transaction.");
        }else if(error == 12){
            msg("Please select the Mode of Procurement.");
        }else if(error == 13){
            msg("Please select Gasoline Monitoring Account Number.");
        }else if(error == 14){
            msg("Please select Period of Gasoline Payment.");
        }
    }

</script>