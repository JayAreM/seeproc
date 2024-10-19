<style>
    .goodsDataHeader1 {
        background-color: rgb(121, 137, 141);
        font-family: NOR;
        font-size:14px;
        color: white;
        font-weight:normal;
    }

    .goodsData2 {
        font-family: NOR;
        padding:2px 6px;
        font-size:14px;
        font-weight: bold;
        border: 1px solid silver;
        width:380px;
    }

    .selectionGuide {
        text-align:center;
        display:inline-block;
        font-size:10px;
        letter-spacing:1px;
        font-family:Tahoma;
        cursor:pointer;
        color:gray;
        transition: color .2s ease-in-out .1s;
    }
    .selectionGuide:hover {
        color:orange;
    }
</style>

<div>
    <table id="tableGoodsPO" border="0" cellpadding="0" style="border-spacing:0px;">
        <tr>
            <td style="vertical-align:top; width:0px;">
                <table border="0" cellpadding="0" style="border-spacing:0px">
                    <tr>
                        <td style="width:0px; white-space:nowrap; padding-right:8px;">
                            <span class="goodsNum">1</span><span class ="goodsField">Select PR Tracking</span>
                        </td>
                        <td id="prGoodsSelect" colspan="2" style="width:0px; padding-bottom:3px;">
                            <select class="goodsData2"><option>&nbsp;</option></select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:0px; white-space:nowrap; padding-right:8px;">
                            <span class="goodsNum">2</span><span class ="goodsField">Select Supplier</span>
                        </td>
                        <td colspan="2" style="width:0px; padding-bottom:3px;">
                            <input id="supplierNameGoods" type="text" class="goodsData2" style="padding:3px 10px; background-color:rgb(207, 211, 207)" onclick="selectSupplierGoods(this)" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:0px; white-space:nowrap; padding-right:8px;">
                            <span class="goodsNum">3</span><span class ="goodsField">Mode of Procurement</span>
                        </td>
                        <td colspan="2" style="width:0px; padding-bottom:3px;">
                            <select id="goodsPOMode" class="goodsData2" onchange="chkNupdateTerm(this)">
                                <option></option>
                                <option value="1">Competitive Bidding</option>					
                                <option value="2">Shopping</option>					
                                <option value="3">Shopping 52.1.b</option>					
                                <option value="4">Alternative</option>					
                                <option value="5">Agency to Agency</option>					
                                <option value="18">Agency to Agency (DBM)</option>					
                                <option value="6">Negotiated</option>					
                                <option value="7">Negotiated Procurement 53.9(SVP)</option>					
                                <option value="8">Negotiated Procurement 53.1(TFB)</option>					
                                <option value="9">Negotiated Procurement 53.6(MS)</option>					
                                <option value="10">Negotiated Procurement 53.7</option>					
                                <option value="11">Negotiated Procurement 53.2(E.C.)</option>					
                                <option value="12">Postal Office</option>					
                                <option value="13">Direct Contracting</option>					
                                <option value="14">Repeat Order</option>					
                                <option value="15">Twice Failed Bidding(TFB)</option>					
                                <option value="16">Extension of Contract Appx. 21 Sec. 3.31</option>					
                                <option value="17">Renewal of Contract Based on Appendix 21 3.3.1.3</option>
                                <option value="19">Lease of Real Property Sec 5.10</option>					
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:0px; white-space:nowrap; padding-right:8px;">
                            <span class="goodsNum">4</span><span class ="goodsField">Payment Term</span>
                        </td>
                        <td colspan="2" style="width:0px; padding-bottom:3px;">
                            <select id="goodsPOTerm" class="goodsData2">
                                <option></option>
                                <option value="1">After full delivery</option>
                                <option value="2">Per Statement</option>
                                <!-- <option value="3">Cash on Delivery</option> -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:0px; white-space:nowrap; padding-right:8px;">
                            <span class="goodsNum">5</span><span class ="goodsField">Nature of Transaction</span>
                        </td>
                        <td style="width:0px; padding-bottom:3px;">
                            <select id="goodsPONature" class="goodsData2" style="width:260px;" onchange="setPOSpecifics(this)">
                                <option></option>
                                <option>Goods/Items</option>
                                <option>Services</option>
                                <option>Rentals</option>
                            </select>
                        </td>
                        <td rowspan="2" style="text-align:center; padding-bottom:3px;">
                            <div class="selectionGuide" onclick="showPOSelectionGuide()">SELECTION<br>GUIDE</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:0px; white-space:nowrap; padding-right:8px;">
                            <span class="goodsNum">6</span><span class ="goodsField">Specifics</span>
                        </td>
                        <td style="width:0px; padding-bottom:3px;">
                            <select id="goodsPOSpecifics" class="goodsData2" style="width:260px;">
                                <option></option>
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
            <td id="goodsPRGenDetailsForPO" style="vertical-align:top;"></td>
        </tr>
        <tr >
            <td colspan="3" id = "trPONew2" style = "display:none;">
				<div style="text-align:left; margin:10px 0px 5px 0px;"><span class="goodsNum">7</span><span class="goodsField">Review Details</span></div>
            </td>
        </tr>
        <tr>
			<td colspan="3" style="text-align:center;" id="tdReviewContentPOGoods"></td>
		</tr>
        <tr >
            <td colspan="3" id = "trPONew3" style = "display:none;">
				<div style="text-align:left; margin:10px 0px 5px 0px;"><span class="goodsNum">8</span><span class="goodsField">Specify Header</span></div>
            </td>
        </tr>
        <tr>
			<td colspan="3" style="text-align:center;" id="tdHeaderPOGoods"></td>
		</tr>
        <tr >
            <td colspan="3" id = "trPONew4" style = "display:none;">
				<div style="text-align:left; margin:10px 0px 5px 0px;"><span class="goodsNum">9</span><span class="goodsField">Specify Terms</span></div>
            </td>
        </tr>
        <tr>
			<td colspan="3" style="text-align:center;" id="tdTermsPOGoods"></td>
		</tr>
        <tr id = "trPONew5" style = "display:none;">
			<td style = "padding:20px 0px; text-align:center;" colspan="3">
				<div class = "button1" onclick = "savePONew()">Save</div><br/>
			</td>
		</tr>
    </table>
</div>
<script>

    function chkNupdateTerm(me) {

        var mode = me.value.trim();
        var container = document.getElementById('goodsPOTerm');
        var options = "";

        if(mode == 5 || mode == 12 || mode == 18) {
            options = "<option value='3' selected>Cash on Delivery</option>"
                    +" <option value='4'>Complete delivery</option>";
        }else {
            options = " <option></option>"
                     +" <option value='1'>After full delivery</option>"
                     +" <option value='2'>Per Statement</option>";
        }

        container.innerHTML = options;

        selectToIndexZero("goodsPONature");
        selectToIndexZero("goodsPOSpecifics");

    }

    function showPOSelectionGuide() {
        window.open('../files/proc_sel_guide.pdf', '_new');
    }

    function selectAllPO(me){
		var b = me.parentNode.parentNode.parentNode;
		var tr = b.children;
		for(var i = 1; i < tr.length-1; i++){
			var td = tr[i];
			if(td.children.length == 10){
				var newCheck = me.checked;
				var oldCheck = td.children[4].children[0].checked;
				if(newCheck != oldCheck){
					td.children[4].children[0].click();
				}
			}			
		}
	}

    function selectCalculateAddPO(me){	
		var b = me.parentNode.parentNode.parentNode;
		var totality = b.children[b.children.length-1].children[3].children[0];
		if(me.checked == true){
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "rgb(206, 215, 218)";//  "rgb(239, 242, 244)";
			var total = parent.children[9].children[0].value.replace(/,/g,"");
			if(total){
				var gTotal = parseFloat(totality.value.replace(/,/g,"")) + parseFloat(total);
				// totality.value = numberWithCommas(gTotal.toFixed(2));
                totality.value = numberWithCommas( round2(trimTwoDecimals(gTotal)) );
			}
		}else{
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "inherit";
			var total = parent.children[9].children[0].value.replace(/,/g,"");
			if(total){
				var gTotal = parseFloat(totality.value.replace(/,/g,"")) - parseFloat(total);
				// totality.value = numberWithCommas(gTotal.toFixed(2));
                totality.value = numberWithCommas( round2(trimTwoDecimals(gTotal)) );
			}
		}
	}

    function setPOSpecifics(me) {
        var container = document.getElementById('goodsPOSpecifics');
        var nature = me.value;
        var modeOfProc = document.getElementById('goodsPOMode');

        var sheet = "";

        if(nature != "") {

            if(nature == 'Goods/Items') {

                // sheet = "<option></option>"
                //       + "<option>Agricultural Products</option>"
                //       + "<option>General</option>"
                //       + "<option>Items (PPE)</option>"
                //       + "<option>Meals/Snacks</option>"
                //       + "<option>Mineral products & Quarry resources</option>";

                if(modeOfProc.value == 1) {
                    sheet = "<option></option>"
                            + "<option>Agricultural Products</option>"
                            + "<option>Agricultural products & other Goods/Items</option>" 
                            + "<option>Agricultural Products Without Retention</option>"
                            + "<option>General</option>"
                            + "<option>Gasoline</option>"
                            + "<option>Without Retention</option>";

                }else {
                    sheet = "<option></option>"
                            + "<option>Agricultural Products</option>"
                            + "<option>Agricultural products & other Goods/Items</option>" 
                            + "<option>Agricultural Products Without Retention</option>"
                            + "<option>General</option>"
                            + "<option>Gasoline</option>";
                }

            }else if(nature == 'Services') {

                // sheet = "<option></option>"
                //       + "<option>General</option>"
                //       + "<option>Services/Rentals</option>"
                //       + "<option>Gross > 720,000</option>";

                sheet = "<option></option>"
                      + "<option>General</option>"
                      + "<option>Gross > 720,000</option>"
                      + "<option>With Retention</option>";
                
            }else if(nature == 'Rentals') {

                sheet = "<option></option>"
                      + "<option>General</option>"
                      + "<option>Heavy Machineries</option>"
                      + "<option>Building/Venue</option>";
                
            }

        }else {
            sheet = "<option></option>";
        }

        container.innerHTML = sheet;
    }

    function selectSupplierGoods(me){
        var trackingNumber = document.getElementById('selectTrackingPRNew').value;

        if(trackingNumber != "") {
            var queryString = "?loadSupplierAddNewPO=1";
            var container = document.getElementById('tdMessage');
            loader();
            ajaxGetAndConcatenate(queryString,processorLink,container,"loadSupplierAddNewPO");
        }else {
            msg('Please select a PR Tracking number first.');
        }
		
	}

	function clickSupplierGoodsPO(me){
		
		var supplier = me.value;
        var allow = 0;
        var currentSuppliers = document.getElementsByClassName('goodsPOSupplier');

        if(currentSuppliers.length > 0) {

            for (var i = 0; i < currentSuppliers.length; i++) {

                var curSupplier = currentSuppliers[i].textContent.trim();
                if(curSupplier == supplier) {
                    allow = 1;
                }
                
            }

        }

		if(allow == 0) {
            document.getElementById('supplierNameGoods').value = supplier;
		    closeAbsolute(me);
        }else {
            document.getElementById('supplierNameGoods').value = "";
		    closeAbsolute(me);
            msg('You already have tracking with this supplier. Please choose another.');
        }

	}

    function SelectItemsByPRReleaseNew(me){
		var trackingNumber =  me.value;
        document.getElementById('supplierNameGoods').value = "";


        if(trackingNumber != "") {
            loader();
            var queryString = "?SelectPrReleasedGoods=1&trackingNumber=" + trackingNumber;
            var container = document.getElementById('tdReviewContentPOGoods');
            ajaxGetAndConcatenate(queryString,processorLink,container,"SelectPrReleasedGoods");
        }else {
            
            selectToIndexZero("goodsPOMode");
            selectToIndexZero("goodsPONature");
            selectToIndexZero("goodsPOSpecifics");

            document.getElementById("supplierNameGoods").value = "";
            document.getElementById("goodsPRGenDetailsForPO").innerHTML = "";

            document.getElementById("trPONew2").style.display = "none";
            document.getElementById("tdReviewContentPOGoods").innerHTML = "";

            document.getElementById("trPONew3").style.display = "none";
            document.getElementById("tdHeaderPOGoods").innerHTML = "";

            document.getElementById("trPONew4").style.display = "none";
            document.getElementById("tdTermsPOGoods").innerHTML = "";

            document.getElementById("trPONew5").style.display = "none";

            var container = document.getElementById('goodsPOTerm');
            var options = "<option></option>"
                        +" <option value='1'>After full delivery</option>"
                        +" <option value='2'>Per Statement</option>";
                        
            container.innerHTML = options;
            selectToIndexZero("goodsPOTerm");

        }
		
	}

    function calculateAddPO(me){

		
		var parent = me.parentNode.parentNode;
		
		var defQty = parent.children[0].children[2].value;
		var price = parent.children[0].children[3].value;
		var qty = parent.children[5].children[0].value;
		var cost = parent.children[7].children[0].value.replace(/,/g,"");
		var prCost = parent.children[3].children[0].value.replace(/,/g,"");
        var total =  parseFloat(qty * cost);

        if(total > prCost) {
            msg('Your PO Amount cannot go beyond the PR Amount.');
            // parent.children[7].children[0].value = numberWithCommas(prCost);
            parent.children[7].children[0].value = numberWithCommas(price);
		    parent.children[5].children[0].value = defQty;
            calculateAddPO(me);
        }else {
            var totalContainer = parent.children[9].children[0];
            // totalContainer.value  = numberWithCommas(total.toFixed(2));
            totalContainer.value  = numberWithCommas( round2(trimTwoDecimals(total) ));
        }

        var trLength = parent.parentNode.children.length;
        inputTotalsPO(parent.parentNode,trLength);
	
	}

    function inputTotalsPO(parent,length){
		var g = 0;
		for(var i = 1 ; i < length-1; i++){
			var check = parent.children[i].children[4].children[0].checked;
			if(check){
				var  total =  parseFloat(parent.children[i].children[9].children[0].value.replace(/,/g,""));
				g = g + total;
			}
		}

		// document.getElementById('totalAmountItemsPO').value = numberWithCommas(g.toFixed(2));
		document.getElementById('totalAmountItemsPO').value = numberWithCommas( round2(trimTwoDecimals(g) ));
	}

    function savePONew(){

        var trackType = 'PO';
        var error = 0;
        var prMonth =1;
        var prTrackingNumber = document.getElementById("prTrackingNumberGoods").textContent;
        // var prMonth = document.getElementById("prMonth").children[0].id.replace("prMonth","");
        var prMonth = document.getElementById("prMonthGoods").textContent.trim();
        prMonth
        if(prMonth == "1st Quarter"){
            prMonth = 1;
        }else if(prMonth == "2nd Quarter"){
            prMonth = 4;
        }else if(prMonth == "3rd Quarter"){
            prMonth = 7;
        }else{
            prMonth = 10;
        }
        
        var obrNumber = document.getElementById("obrNumberGoods").textContent;
        //do not copy ermark from pr to prevent pre printing in obr form
        obrNumber = '';
        var prNumber = document.getElementById("prNumberGoods").textContent;
        var supplierName = encodeURIComponent(document.getElementById("supplierNameGoods").value.trim());
        var fund = document.getElementById("fundTypeGoods").textContent;
        
        if(supplierName.length < 1 ){
            document.getElementById("supplierNameGoods").style.backgroundColor ="rgb(253, 191, 222)";
            error = 1;
        }
        
        var prData = '';
        var dummyProgram = '';
        var programs = '';
        var totalDetails = '';
        var parent = document.getElementById('poItemsTableGoods');
        var trLength = parent.children[0].children.length;
        var category = document.getElementById("prCategoryNewGoods").textContent;
        for(var i = 1 ; i < trLength-1; i++){
            var checkMe = parent.children[0].children[i].children[4].children[0].checked;
            if(checkMe == true){
                var program = encodeURIComponent(parent.children[0].children[i].children[1].children[0].value.trim());
                var itemDes = encodeURIComponent(parent.children[0].children[i].children[0].children[1].value.trim());
                var code = encodeURIComponent(parent.children[0].children[i].children[1].children[1].value.trim());
            
                //var category = encodeURIComponent(parent.children[0].children[i].children[2].children[0].textContent);
                //var desc =encodeURIComponent(parent.children[0].children[i].children[2].children[0].value.trim());
                var desc =  encodeURIComponent(parent.children[0].children[i].children[2].children[0].value.replace(/{+}/g,"~").trim());	
                var qty = parent.children[0].children[i].children[5].children[0].value.trim();
                var unit = encodeURIComponent(parent.children[0].children[i].children[5].children[1].value.trim());
                var cost = parent.children[0].children[i].children[7].children[0].value.replace(/,/g,"");
                var total = parent.children[0].children[i].children[9].children[0].value.replace(/,/g,"");
                
            
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
                    parent.children[0].children[i].children[4].children[0].style.backgroundColor ="rgb(253, 191, 222)";
                    error = 1;
                }
                if(unit.length < 1){
                    parent.children[0].children[i].children[4].children[2].style.backgroundColor ="rgb(253, 191, 222)";
                    error = 1;
                }
                if(cost.length < 1){
                    parent.children[0].children[i].children[6].children[0].style.backgroundColor ="rgb(253, 191, 222)";
                    error = 1;
                }
                prData += category + '~!~' +  program + '~!~' + code + '~!~' + desc + '~!~' + qty + '~!~' + unit + '~!~'  +  cost + '~!~' + itemDes + '~#~';	
                totalDetails += category + '~!~' +  program + '~!~' + code + '~!~' + total + '!#!';
                if(dummyProgram != program){
                    programs += program + '~';
                    dummyProgram = program;
                }
            }	
        }

        //pigeon sort
        var detailsA = totalDetails.split('!#!');
        var batchTotals = {};
        for(var i = 0 ; i < detailsA.length-1; i++){
            var detailsB = detailsA[i].split('~!~');
            var category = detailsB[0];
            var program = detailsB[1];
            var code = detailsB[2];
            var total = detailsB[3];
            if(batchTotals[category + '~' + program+ '~' + code] == undefined){
                batchTotals[category + '~' + program+ '~'+code] = 0;
            }
            batchTotals[category + '~' + program+ '~'+code] = parseFloat( batchTotals[category + '~' +program+ '~'+code]) +  parseFloat(total);
            
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

        oTotal = parseFloat( round2(trimTwoDecimals(oTotal)) );
        
        if(oTotal == 0){
            error = 3;
        }

        var modeOfProc = document.getElementById('goodsPOMode').value;
        var paymentTerm = document.getElementById('goodsPOTerm').value;
        var nature = document.getElementById('goodsPONature').value;
        var specifics = document.getElementById('goodsPOSpecifics').value;

        if(modeOfProc == "") {
            error = 4;
        }

        if(paymentTerm == "") {
            error = 5;
        }

        if(nature == "") {
            error = 7;
        }else if(specifics == "") {
            error = 8;
        }

        var prTotal = parseFloat(document.getElementById('totalAmountItemsPR').value.replace(/,/g,""));

        // var trackedPOTotal = parseFloat(document.getElementById('totalAmountPOsTracked').textContent.replace(/,/g,""));
        var trackedPOTotal = document.getElementById('totalAmountPOsTracked');
        if(trackedPOTotal) {
            trackedPOTotal = parseFloat(trackedPOTotal.textContent.replace(/,/g,""));
        }else {
            trackedPOTotal = 0;
        }

        var curPOTotal = parseFloat(document.getElementById('totalAmountItemsPO').value.replace(/,/g,""));
        var potTotal = trackedPOTotal + curPOTotal;

        if(potTotal > prTotal) {
            error = 6;
        }

        var terms = document.getElementById('goodsPOnewTerms');
        var header = document.getElementById('goodsPOnewHeader');
        // if(terms.value.trim().length == 0) {
        //     error = 9;
        // }

        var disaProject = document.getElementById('poNewGoodsDisaProject').textContent.trim();

        if(error == 0){
        
            var queryString =   "saveTrackingPostPOGoods=1&trackType=" + trackType + 
                                "&prTrackingNumber=" + prTrackingNumber + 
                                "&prNumber=" + prNumber + 
                                "&obrNumber=" + obrNumber + 
                                "&supplier=" + supplierName + 
                                "&prMonth=" + prMonth + 
                                "&fund=" + fund + 
                                "&grp=" + grp +
                                "&prData=" + prData  + 
                                "&modeOfProc=" + modeOfProc  + 
                                "&pyTerm=" + paymentTerm  + 
                                "&nature=" + nature  + 
                                "&specifics=" + encodeURIComponent(specifics)  + 
                                "&oTotal=" + oTotal +
                                "&terms=" + encodeURIComponent(terms.value.trim()) +
                                "&header=" + encodeURIComponent(header.value.trim()) +
                                "&disaster=" + disaProject;
            var container = document.getElementById('goodsNewTrackingNumber');

            loader();
            ajaxPost(queryString,processorLink, container,"saveTrackingPostPOGoods");
        }else if(error == 1){
            msg("Please complete the required fields.");
        }else if(error == 2){
            msg("Please select schedule in step 2. </br>PR items must be reviewed again.");
        }else if(error == 3){
            msg("Please select item in Step 5.");
        }else if(error == 4){
            msg("Please select Mode of Procurement in Step 3.");
        }else if(error == 5){
            msg("Please select Payment Term in Step 4.");
        }else if(error == 6){
            msg("You cannot exceed the total PR Amount.</br>Please review your Items and PO Tracking Created.");
        }else if(error == 7){
            msg("Please select Nature of Payment in Step 5.");
        }else if(error == 8){
            msg("Please select Specifics in Step 6.");
        }
    }
</script>