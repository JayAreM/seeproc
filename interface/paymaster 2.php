<style>
    .pmOptions {
        font-size:18px;
        display:inline-block;
        width:50px;
        border:1px solid red;
        margin:5px;
    }
</style>

<div style="padding:20px;">
    <table border="1" cellpadding="0" cellspacing="0" style="">
        <tr>
            <td style="padding:10px;">
                <table border="1" cellpadding="0" cellspacing="0" style="">
                    <thead>
                        <tr>
                            <th colspan="2" style="font-size:22px; line-height:20px; height:10px; padding:5px 0px 3px 5px; color:white; text-align:left; font-weight:bold; background-color:rgb(32, 128, 201); background-image: linear-gradient(to  left, black ,rgb(32, 128, 201));">Paymaster</th>
                        </tr>
                        <tr>
                            <th style="font-size:0px;">
                                <span class="pmOptions">New</span>
                                <span class="pmOptions">Edit</span>
                            </th>
                            <th>
                                <span style="margin-right:8px;font-family:oswald;">Add TN#</span>
                                <input type="text" id="searchPYPay" maxlength="9" class="text3" style = "width:150px;font-weight: bold;font-family:oswald; padding:2px 5px; font-size: 22px;text-align:center;" id="" onkeydown="keypressAndWhatClear(this,event,getPYDetailsForPAY,1)">
                            </th>
                        </tr> 
                    </thead>
                    <tbody></tbody>
                </table>
            </td>
            <td rowspan="2" style="padding:10px; vertical-align:top;">
                <table border="1" cellpadding="0" cellspacing="0" style="">
                    <thead>
                        <tr>
                            <th colspan="6" style="font-size:22px; line-height:20px; height:10px; padding:5px 0px 3px 5px; color:white; text-align:left; font-weight:bold; background-color:rgb(32, 128, 201); background-image: linear-gradient(to  left, black ,rgb(32, 128, 201));">Added</th>
                        </tr>
                        <tr>
                            <th>Tracking No.</th>
                            <th>Claimant</th>
                            <th>Office</th>
                            <th>Employees</th>
                            <th>Gross</th>
                            <th>Net Amount</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding:10px;">
                <table border="1" cellpadding="0" cellspacing="0" style="">
                    <thead>
                        <tr>
                            <th colspan="2" style="font-size:22px; line-height:20px; height:10px; padding:5px 0px 3px 5px; color:white; text-align:left; font-weight:bold; background-color:rgb(32, 128, 201); background-image: linear-gradient(to  left, black ,rgb(32, 128, 201));">Add Tracking</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr> 
                    </thead>
                    <tbody></tbody>
                </table>
            </td>
        </tr>
    </table>
</div>









<!-- <style>
/* Retention */
.tableRetVal {
    width:100%;
    text-align:left;
    padding-top:10px;
    border-spacing:0px;
}

.tableRetVal th{
    border-top: 1px solid rgba(0,0,0,.2);
    border-bottom: 1px solid rgba(0,0,0,.2);
}

.tableRetVal tbody tr td {
    border-right: 1px solid lightgray;
    border-bottom: 1px solid lightgray;
}

.tableRetVal tbody tr td:first-child {
    border-left: 1px solid lightgray;
}

.tablRetVal tbody tr:nth-child(2n){
    background-color:rgb(252, 252, 251);
    color:red;
}
</style>

<div style="padding:20px;">
    <table border="0" cellpadding="0" cellspacing="0" id = "tableDoctrackPAY"  style="margin:0px auto; font-family:Oswald;" >
        <tr>
            <td colspan="3" style="text-align:right;">
                <span class = "data1" style = "margin-right:5px;" >Tracking number</span>
                <div id = "divNewTrackingNumberPay" style = "font-size:30px; font-weight:bold; display:inline-block;" class = "data1">0000-0</div>
            </td>
        </tr>
        <tr>
            <td style="width:10px; text-align:right; padding-bottom:3px; vertical-align:bottom;">Disbursing&nbsp;Officer</td>
            <td>
                <input type="text" id="payDisbOfficer" class="data2" maxlength="28" style="background-color:white;color:black;font-size:22px; border:0; padding:0px; border-bottom:1px solid silver; font-weight: bold;width:0px;width:350px;margin-left:8px;">
            </td>
        </tr>
        <tr><td style="padding:2px 0px;"></td></tr>
        <tr>
            <td style="width:10px; text-align:right; padding-bottom:3px; vertical-align:bottom;">Fund</td>
            <td>
                <input type="text" id="payFund" class="data2" style="background-color:white; color:black; font-size:22px; border:0; padding:0px; border-bottom:1px solid silver; font-weight: bold; width:120px; margin-left:8px;" readonly>
            </td>
        </tr>
        <tr><td style="padding:2px 0px;"></td></tr>
        <tr>
            <td style="width:10px; text-align:right; padding-bottom:3px; vertical-align:bottom;">Window</td>
            <td>
                <input type="text" id="payWindow" class="data2" maxlength="7" style="background-color:white; color:black; font-size:22px; border:0; padding:0px; border-bottom:1px solid silver; font-weight: bold; width:80px; margin-left:8px;">
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding:5px 0px; text-align:right;">
                <span style="margin-right:8px;font-family:oswald;">Add TN#</span>
                <input type="text" id="searchPYPay" maxlength="9" class="text3" style = "width:150px;font-weight: bold;font-family:oswald; padding:2px 5px; font-size: 22px;text-align:center;" id="" onkeydown="keypressAndWhatClear(this,event,getPYDetailsForPAY,1)">
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding: 0px 0px 20px 0px;">
                <table border="0" cellpadding="0" cellspacing="0" style="margin:0px auto;width:780px; font-family:Oswald;">
                    <tr>
                        <td>
                        <table id="paymasterList" class="tableRetVal" border="0" cellpadding="0" cellspacing="0">
                            <thead style="letter-spacing:1px; background-color:rgb(247, 252, 252);">
                                <th style="padding:3px 10px; width:10px;">Tracking&nbsp;No.</th>
                                <th style="padding-left:10px;">Claimant</th>
                                <th style="padding-left:10px;">Office</th>
                                <th style="width:10px;text-align:right;padding:0px 5px;">Employees&nbsp;<span style="color:red; font-weight:normal; font-size:14px;">(<span id="payEmpsNum">0</span>)</span></th>
                                <th style="width:100px;text-align:right;padding-right:5px;">Gross&nbsp;Amount</th>
                                <th style="width:100px;text-align:right;padding-right:5px;">Net&nbsp;Amount</th>
                                <th style="width:30px;"></th>
                            </thead>
                            <tbody style="background-color:white;"></tbody>
                        </table>
                        </td>
                    </tr>
                    <tr id="totalTrPay" style="">
                        <td style="text-align: right;">
                            <div style="text-align:right; width:200px; display:inline-block; padding-right:36px; letter-spacing:1px;">
                                <span style="font-weight:bold;padding-right:5px;">Total</span>
                                <span id="paymasterTotal" style="color:rgb(24, 167, 219); font-weight:bold; font-size:18px;">0.00</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr id="saveTrPay" style="display: none;">
            <td colspan="3" style="">
                <div style = "" class = "button1" onclick = "savePaymaster()">Save</div><br/>
            </td>
        </tr>
    </table>
</div>

<script>

whenRefreshPaymaster();
function whenRefreshPaymaster(){
    var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
    if(cookieMainText == "Document Tracking"){
        var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
        if(cookieText == "PM"){
            payCallTrackingType();
        }
    }
}

function payCallTrackingType(){
    var queryString = "?selectNewDoctrack=1&type=optPY";
	var container = document.getElementById('divNewTrackingNumberPay');

    loader();
	ajaxGetAndConcatenate(queryString,processorLink,container,"selectNewDoctrack");
}

function getPYDetailsForPAY(field) {
    var tn = field.value;
    var queryString = "?getPYDetailsForPAY=1&trackingNumber="+tn;
    var container = "";

    loader();
    ajaxGetAndConcatenate(queryString, processorLink, container, "getPYDetailsForPAY");
}

function addMultiplePAY(content){
    var temp = content.split('*payContent*');
    var tn = temp[0];
    var claimant = temp[1];
    var vcGross = temp[2];
    var vcNet = temp[3];
    var empsNum = temp[4];
    var fund = temp[5];
    var officeAssigned = temp[6];

    if(officeAssigned == ""){
        officeAssigned = "<input class='data2' style='border:0px; width:100px; font-size:14px; border-bottom:1px solid silver; text-align:center;'>";
    }
   
    var chker = checkExistingPaymaster(tn);

    if(chker == 0){
        var fundField = document.getElementById('payFund');
        var table = document.getElementById('paymasterList');
        var tbody = table.children[1];

        if(empsNum == 0){
            empsNum = "<input class='data2' onkeyup='updateEmpsNum()' onkeydown='return isAmount(this,event)' style='border:0px; width:80px; font-size:14px; border-bottom:1px solid silver; text-align:center;'>";
        }

        var tr = "<tr>"
                +"<td style='padding-left:10px;'>"+tn+"</td>"
                +"<td style='padding-left:10px;'>"+claimant+"</td>"
                +"<td style='padding:3px 2px; text-align:center;'>"+officeAssigned+"</td>"
                +"<td style='padding:3px 2px; text-align:center;'>"+empsNum+"</td>"
                +"<td style='padding:3px 5px; text-align:right;'>"+numberWithCommas(round2(vcGross))+"</td>"
                +"<td style='padding:3px 5px; text-align:right;'>"+numberWithCommas(round2(vcNet))+"</td>"
                +"<td style='text-align:center;'>"
                +"<i style='cursor:pointer; font-weight:bold; color:red; font-style:normal; font-size:12px;' onclick='removePaymaster(this)'>&#x2715;</i>"
                +"</td>"
                +"</tr>";

        tbody.insertAdjacentHTML('beforeend', tr);
        fundField.value = fund;
        updatePayTotal(vcNet);
        updateEmpsNum();
    }else{
        alert(tn + " is already in the list.");
    }
} 

function checkExistingPaymaster(trackingNumber){
    var table = document.getElementById('paymasterList');
    var tbody = table.children[1].children;

    for(var i=0; i < tbody.length; i++){
        if(tbody[i].children[0].innerText == trackingNumber){
            return 1;
        }
    }
    return 0;
}

function removePaymaster(elem) {
    var parent = elem.parentNode.parentNode.parentNode;
    var row = elem.parentNode.parentNode;
    updatePayTotal("-"+row.children[5].innerText);
    parent.removeChild(row);
    updateEmpsNum();
}

function updatePayTotal(amount){
    var totalElem = document.getElementById('paymasterTotal');
    var total = parseFloat(totalElem.innerText.replace(/,/g,""));
    
    amount = parseFloat(amount.replace(/,/g,""));
    
    var tempTotal = total + amount;
    totalElem.innerHTML = numberWithCommas(tempTotal.toFixed(2));

    var totalTrPay = document.getElementById('totalTrPay');
    var saveTrPay = document.getElementById('saveTrPay');
    if(tempTotal > 0){
        // totalTrPay.style.display = "table-row";
        saveTrPay.style.display = "table-row";
    }else{
        // totalTrPay.style.display = "none";
        saveTrPay.style.display = "none";
    }
}

function updateEmpsNum(){
    var empsNum = document.getElementById('payEmpsNum');
    var table = document.getElementById('paymasterList');
    var tbody = table.children[1];
    var newTotal = 0;
    var len = tbody.children.length;

    if(len > 0){
        for(var i = 0; i < len; i++){
            // var empNumCell = tbody.children[i].children[2].textContent;
            // var num = 0;
            // if(empNumCell != "N/A"){
            //     num = parseInt(empNumCell);
            // }
            // newTotal += num;

            var empNumCell = tbody.children[i].children[3];
            var num = 0;
            if(empNumCell.children.length > 0){
                if(empNumCell.children[0].value.length == 0){
                    num = 0;
                }else{
                    num = parseFloat(empNumCell.children[0].value);
                }
            }else{
                num = parseInt(empNumCell.textContent);
            }
            newTotal += num;
        }
    }
    empsNum.innerHTML = newTotal;
}

function savePaymaster(){
    var officer = document.getElementById('payDisbOfficer').value.trim();
    var window = document.getElementById('payWindow').value.trim();
    var fundField = document.getElementById('payFund').value.trim();
    var totalEmps = document.getElementById('payEmpsNum').textContent.trim();
    var table = document.getElementById('paymasterList');
    var tbody = table.children[1].children;
    var proc = 0;
    var caughtTN = "";
    var tnPartner = "";

    if(officer != "" && window != ""){
        var getData = [];
        for(var i=0; i < tbody.length; i++){
            var td = tbody[i].querySelectorAll('td');

            var trackingNumber = td[0].textContent;
            var claimant = td[1].textContent;

            if(td[2].children.length > 0){
                var office = td[2].children[0].value.trim();
            }else{
                var office = td[2].textContent;
            }

            var empsRow = td[3];
            var empsNum = 0;
            var amount = parseFloat(td[5].textContent.replace(/,/g, ""));

            if(empsRow.children.length > 0){
                if(empsRow.children[0].value.length == 0){
                    proc = 1;
                    caughtTN = trackingNumber;
                    break;
                }else{
                    empsNum = parseFloat(empsRow.children[0].value);
                }
            }else{
                empsNum = parseInt(empsRow.textContent);
            }

            if(amount > 0){
                getData.push(trackingNumber+"*pm*"+claimant+"*pm*"+amount+"*pm*"+empsNum+"*pm*"+office);
            }else{
                proc = 2;
                caughtTN = trackingNumber;
                break;
            }
        }

        if(proc == 0){
            if(tbody.length == 1) {
            tnPartner = trackingNumber;
            }else if(tbody.length > 1){
                tnPartner = "Multiple";
            }

            var getString = getData.join("~");
            var payGross = parseFloat(document.getElementById('paymasterTotal').innerText.replace(/,/g,"")); 
            // var fund = "General Fund";

            var queryString = "?saveTrackingPaymaster=1&payDetails="+getString+"&gross="+payGross+"&fund="+fundField+"&claimant="+officer+"&tnPartner="+tnPartner+"&window="+window+"&empsNum="+totalEmps;

            var container = document.getElementById('divNewTrackingNumberPay');

            loader();
            ajaxGetAndConcatenate(queryString, processorLink, container, "saveTrackingPaymaster");
        }else if(proc == 1){
            alert("Please set the Number of Employees of TN : "+caughtTN);
        }else if(proc == 2){
            alert("Please update the Net Amount of TN : "+caughtTN);
        }
        
    }else{
        alert("Please check details.");
    }
}

function clearFieldsPAY(){
    var searchPYPay = document.getElementById('searchPYPay');
    var table = document.getElementById("paymasterList");
    var tbody = table.children[1];
    var payGross = document.getElementById('paymasterTotal'); 
    var totalTrPay = document.getElementById('totalTrPay');
    var saveTrPay = document.getElementById('saveTrPay');
    var officer = document.getElementById('payDisbOfficer');
    var window = document.getElementById('payWindow');
    var empsNum = document.getElementById('payEmpsNum');
    var fundField = document.getElementById('payFund');

    searchPYPay.value = "";
    tbody.innerHTML = "";
    payGross.innerText = "0.00";
    // totalTrPay.style.display = "none";
    saveTrPay.style.display = "none";
    officer.value = "";
    window.value = "";
    empsNum.textContent = "0";
    fundField.value = "";
}

</script> -->