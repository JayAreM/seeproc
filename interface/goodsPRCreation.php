<style></style>


<div style="">
    <table id="tableGoodsPR" border="0" style="border-spacing:0px; width:100%;">
        <tr>
            <td style="padding-bottom:10px;">
                <span class="goodsNum">1</span><span class ="goodsField">Select Quarter</span>
            </td>
        </tr>
        <tr>
            <td style="background-color:rgb(232, 239, 239); padding:10px 0px;">
                <table id="tableSelectQtrGoods"  style="width:620px; border-spacing:0; padding-left:40px; margin:0px auto;" border ="0">
                    <td width="" style = "width:150px;">	
                        <input value="" type="radio" name="selectTypeQuarter" id="optGoods1st"  class="radio1" onclick = "clickOptionQuarterNewPR(this)"/>
                        <label style="font-family:NOR;" for="optGoods1st">1st&nbsp;Quarter</label>
                    </td>
                    <td style = "width:150px;">	
                        <input value="" type="radio" name="selectTypeQuarter" id="optGoods2nd" class="radio1" onclick = "clickOptionQuarterNewPR(this)"/>
                        <label style="font-family:NOR;" for="optGoods2nd">2nd&nbsp;Quarter</label>
                    </td>
                    <td style = "width:150px;">	
                        <input value="" type="radio" name="selectTypeQuarter" id="optGoods3rd" class="radio1" onclick = "clickOptionQuarterNewPR(this)"/>
                        <label style="font-family:NOR;" for="optGoods3rd">3rd&nbsp;Quarter</label>
                    </td>
                    <td style = "width:150px;">	
                        <input value="" type="radio" name="selectTypeQuarter" id="optGoods4th" class="radio1" onclick = "clickOptionQuarterNewPR(this)"/>
                        <label style="font-family:NOR;" for="optGoods4th">4th&nbsp;Quarter</label>
                    </td>
                </table>
            </td>
        </tr>
        <tr id="trSelectCategoryGoods" style="display:none;">
            <td colspan="2" style="padding-top:10px;">
                <span class="goodsNum">2</span><span class ="goodsField">Select Category</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="">
                <div id="divCategoryListGoods" style="padding:10px 0px;"></div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="">
                <div id="goodsMgsField" style="padding:10px 0px;"></div>
            </td>
        </tr>
        <tr id="trNewPR1" style="display:none;">
            <td colspan="2" style="">
                <span class="goodsNum">3</span><span class ="goodsField">Review Content</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; padding:10px 0px;" id = "tdReviewContentNewPR"> </td>
        </tr>
        <tr>
            <td colspan="2" style="padding:10px 0px;"></td>
        </tr>
        <tr id="trNewPR2" style="display:none;">
            <td colspan="2" style="">
                <span class="goodsNum">4</span><span class ="goodsField">Specify Header</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; padding:10px 0px;" id = "tdHeaderNewPR"></td>
        </tr>
        <tr>
            <td colspan="2" style="padding:10px 0px;"></td>
        </tr>
        <tr id="trNewPR3" style="display:none;">
            <td colspan="2" style="">
                <span class="goodsNum">5</span><span class ="goodsField">Specify Terms</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; padding:10px 0px;" id = "tdTermsNConditionsNewPR"> </td>
        </tr>
        <tr>
            <td colspan="2" style="padding:10px 0px;"></td>
        </tr>
        <tr id="trNewPR4" style="display:none;">
            <td colspan="2" style="">
                <span class="goodsNum">6</span><span class ="goodsField">Select Disaster Project</span>
            </td>
        </tr>
        <tr id="trNewPR5" style="display:none;">
            <td colspan="2" style="text-align:center; padding:10px 0px;">
                <select id="tdDisaProjectNewPR" class="data2 checkPY" style="font-weight:bold; text-transform:uppercase; cursor:pointer; width:100%; border:0px; border-bottom:1px solid silver;"></select>
            </td>
        </tr>
        <tr id="trNewPR6" style="display:none;">
            <td colspan="2" style="text-align:center; padding:20px 0px;">
                <div class = "button1" onclick = "savePRGoods()">Save</div><br/>
            </td>
        </tr>
    </table>
</div>
        

<script>

    var newPRQtr;
    function clickOptionQuarterNewPR(me){
        document.getElementById("trSelectCategoryGoods").style.display = "table-row";
        //hide
        document.getElementById('tdReviewContentNewPR').innerHTML = "";
        document.getElementById("trNewPR1").style.display = "none";
        document.getElementById("trNewPR2").style.display = "none";
		document.getElementById("trNewPR3").style.display = "none";
		document.getElementById("trNewPR4").style.display = "none";
		document.getElementById("trNewPR5").style.display = "none";
		document.getElementById("trNewPR6").style.display = "none";
		document.getElementById('goodsMgsField').innerHTML = "";

        	
        newPRQtr = me.id;
		loader();
		var queryString = "?loadPPMPCategoryListNewPR=1&qtr=" + newPRQtr;
		var container = document.getElementById('divCategoryListGoods');
		ajaxGetAndConcatenate1(queryString,processorLink,container,"loadPPMPCategoryListNewPR");
	}

    var caty = '';
	function getCategoryItemsNewPR(me){
        if(me.checked == true) {
            var row  = me.parentNode.parentNode.rowIndex;
            var parent = me.parentNode.parentNode.parentNode;
            caty = checkedCategories(parent,row).replace("~!~","");

            document.getElementById("trNewPR1").style.display = "table-row";
            document.getElementById("trNewPR2").style.display = "table-row";
            document.getElementById("trNewPR3").style.display = "table-row";
            document.getElementById("trNewPR4").style.display = "table-row";
            document.getElementById("trNewPR5").style.display = "table-row";
            document.getElementById("trNewPR6").style.display = "table-row";

            loader();
            var queryString = "?GetCategoryItems2023=1&category=" + caty + "&qtr=" + newPRQtr;
            var container = document.getElementById('tdReviewContentNewPR');
            ajaxGetAndConcatenate1(queryString,processorLink,container,"GetCategoryItemsNewPR");

            getTrackedPRs(caty, newPRQtr);
        }
	}

    function getCategoryItemsUsingDesc(me, event) {
        // var parent = me.parentNode.parentNode;
        // var chkBx = parent.children[0].children[0];
        // chkBx.click();

        if(event.target.tagName != 'INPUT') {
            var chkBx = me.children[0].children[0];
            chkBx.checked = true;
            getCategoryItemsNewPR(chkBx);
        }

    }

    function getTrackedPRs(caty, qtr) {

        var queryString = "?getTrackedPRs=1&category=" + caty + "&qtr=" + qtr;
        var container = document.getElementById('goodsMgsField');
        ajaxGetAndConcatenate1(queryString,processorLink,container,"returnOnly");

    }

    function checkedCategories(me,row){
		
		var tr = me.children;
		var category = "";
		for(var i = 0; i < tr.length; i++){
			var inputs = tr[i].children[0].children[0];
			if(inputs.checked == true){
				if(row >= 0 ){
					if(i == row){
						tr[i].style.backgroundColor = "rgb(197, 220, 238)";
						tr[i].style.fontWeight = "bold";
						category += tr[i].children[1].textContent + "~!~" ;
					}else{
						inputs.checked = 0 ;
						tr[i].style.backgroundColor = "transparent";
					}
				}else{
					tr[i].style.backgroundColor = "rgb(197, 220, 238)";
					tr[i].style.fontWeight = "bold";
					category += tr[i].children[1].textContent + "~!~" ;
					
				}
			}else{
				tr[i].style.backgroundColor = "transparent";
				tr[i].style.fontWeight = "normal";
			}
		}
		return category;
	}

    function calculateAddPRNew(me){
		
		var parent = me.parentNode.parentNode;
		
		var qty = parent.children[4].children[0].value;
		var cost = parent.children[6].children[0].value.replace(/,/g,"");
		var total =  parseFloat(qty * cost);
		var totalContainer = parent.children[8].children[0];
		// totalContainer.value  = numberWithCommas(total.toFixed(2));
		totalContainer.value  = numberWithCommas( round2(trimTwoDecimals(total)) );
		var trLength = parent.parentNode.children.length;
		
		inputTotalsPR(parent.parentNode,trLength);
	
	}

    function inputTotalsPR(parent,length){
		var g = 0;
		for(var i = 1 ; i < length-1; i++){
			var check = parent.children[i].children[3].children[0].checked;
			if(check){
				var  total =  parseFloat(parent.children[i].children[8].children[0].value.replace(/,/g,""));
				g = g + total;
			}
		}
		// document.getElementById('totalAmountItems').value = numberWithCommas(g.toFixed(2));
		document.getElementById('totalAmountItemsGoods').value = numberWithCommas( round2(trimTwoDecimals(g)) );
	}

    function selectCalculateAddPRGoods(me){	
		var b = me.parentNode.parentNode.parentNode;
		var totality = b.children[b.children.length-1].children[0].children[0];
		if(me.checked == true){
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "rgb(206, 215, 218)";//  "rgb(239, 242, 244)";
			var total = parent.children[8].children[0].value.replace(/,/g,"");
			if(total){
				var gTotal = parseFloat(totality.value.replace(/,/g,"")) + parseFloat(total);
				// totality.value = numberWithCommas(gTotal.toFixed(2));
                totality.value = numberWithCommas( round2(trimTwoDecimals(gTotal)) );
			}
		}else{
			var parent = me.parentNode.parentNode;
			parent.style.backgroundColor = "inherit";
			var total = parent.children[8].children[0].value.replace(/,/g,"");
			if(total){
				var gTotal = parseFloat(totality.value.replace(/,/g,"")) - parseFloat(total);
				// totality.value = numberWithCommas(gTotal.toFixed(2));
                totality.value = numberWithCommas( round2(trimTwoDecimals(gTotal)) );
			}
		}
	}

    function clearRadios(me){
		var parent = document.getElementById(me);
		var inputs = parent.getElementsByTagName("input");
		for(var i = 0; i < inputs.length; i++){
			inputs[i].checked = 0 ;
			inputs[i].parentNode.parentNode.style.backgroundColor ="transparent";
		}
	}

    function goodsPRChkQualified() {
        var trackedTotal = parseFloat(document.getElementById('goodsTrackedTotal').textContent.replace(/,/g,""));
        var currentTotal = parseFloat(document.getElementById('totalAmountItems').value.replace(/,/g,""));
        var originalTotal = parseFloat(document.getElementById('goodsOrigTotal').textContent);

        var ret = "";

        if(trackedTotal == currentTotal) {
            ret = "You have already tracked all items in this category.";
        }

        if(trackedTotal > currentTotal) {
            ret = "You cannot exceed the total amount in this category.";
        }

        var potentialTotal = trackedTotal + currentTotal;

        if(potentialTotal > originalTotal) {
            ret = "You cannot exceed the total amount in this category.";
        }

        return ret;
    }

    function absoluteHeader(trHeader,container,className){
		var tr  = document.getElementById(trHeader);
		var tr1  = document.getElementById(trHeader);
		var parent = tr.parentNode;
		var sheet  = '<table style = "padding:0; border-spacing:0;" border ="0"><tr id = "dyTr">';
		      sheet += tr.innerHTML; 
		      sheet += '</tr></table>';
		parent.removeChild(tr);
		container.innerHTML += sheet;
		var tr =parent.children[1];
		for(var i = 0 ; i < tr.children.length; i++){
			var oWidth =  tr.children[i].clientWidth;
			document.getElementById('dyTr').children[i].style.width =  (oWidth - 20) + 'px';
		}	
	}

    function selectAllGoods(me){
		var b = me.parentNode.parentNode.parentNode;
		var tr = b.children;
		for(var i = 1; i < tr.length-1; i++){
			var td = tr[i];
			if(td.children.length == 9){
				var newCheck = me.checked;
				var oldCheck = td.children[3].children[0].checked;
				if(newCheck != oldCheck){
					td.children[3].children[0].click();
				}
			}			
		}
	}

    function savePRGoods(){
        // var qualified = goodsPRChkQualified();
        var qualified = "";
        
        if(qualified == "") {
            trackType = 'PR';
            var error = 0;
            var prData = '';
            var month = '';
            if(newPRQtr == "optGoods1st"){
                month = 1;
            }else if(newPRQtr == "optGoods2nd"){
                month = 4;
            }else if(newPRQtr == "optGoods3rd"){
                month = 7;
            }else if(newPRQtr == "optGoods4th"){
                month = 10;
            }
            
            var category  = caty;
            var dummyProgram = '';
            var programs = '';
            var totalDetails = '';
            var parent = document.getElementById('prItemsTableGoods');
            var trLength = parent.children[0].children.length;
            
            for(var i = 1 ; i < trLength-1; i++){
                
                var checkMe = parent.children[0].children[i].children[3].children[0].checked;
                if(checkMe == true){
                    var itemDes =encodeURIComponent(parent.children[0].children[i].children[0].children[1].value.trim());
                    
                    var program =encodeURIComponent(parent.children[0].children[i].children[1].children[0].value.trim());
                    var code =encodeURIComponent(parent.children[0].children[i].children[1].children[1].value.trim());
                    var desc =encodeURIComponent(parent.children[0].children[i].children[2].children[0].value.replace(/{+}/g,"~").trim());
                    //var desc =parent.children[0].children[i].children[2].children[0].value.replace(/{+}/g,"~").trim();				
                    var qty = parent.children[0].children[i].children[4].children[0].value.trim();
                    var unit = encodeURIComponent(parent.children[0].children[i].children[4].children[2].value.trim());
                    var cost = parent.children[0].children[i].children[6].children[0].value.replace(/,/g,"");
                    var total = parent.children[0].children[i].children[8].children[0].value.replace(/,/g,"");
                    
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
            if(prData.length == 0){
                error  = 3;
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
            
            var fund = document.getElementById('angFundGoods').textContent;
            if(fund == "Development Fund"){
                fund = "General Fund";
            }

            var terms = document.getElementById('goodsPRnewTerms');
            var header = document.getElementById('goodsPRnewHeader');
            // if(terms.value.trim().length == 0) {
            //     error = 4;
            // }

            var disaProj = document.getElementById('tdDisaProjectNewPR').value;
            if(disaProj.trim().length == 0) {
                error = 5;
            }
            

            if(error == 0){
                
                var queryString = "saveTrackingPostGoods=1&trackType=" + trackType + "&fund=" + fund   + 
                                    "&prMonth=" + month + 
                                    "&grp=" + grp +
                                    "&prData=" + prData  + 
                                    "&oTotal=" + oTotal +
                                    "&terms=" + encodeURIComponent(terms.value.trim()) +
                                    "&header=" + encodeURIComponent(header.value.trim())+
                                    "&disaster=" + disaProj;

                var container = document.getElementById('goodsNewTrackingNumber');	
                
                loader();
                ajaxPost(queryString,processorLink, container,"saveTrackingPostGoods");
            }else if(error == 1){
                msg("Please complete the required fields.");
            }else if(error == 2){
                msg("Please select schedule in step 2. </br>PR items must be reviewed again.");
            }else if(error == 3){
                msg("Please select category in step 3.");
            }else if(error == 4){
                msg("Please enter the terms and conditions in step 4.");
            }else if(error == 5){
                msg("Please select disaster project in step 6.");
            }
        }else {
            msg(qualified);
        }

	}



</script>