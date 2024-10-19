<style>
    #pmNewMain {
        font-size: 0px;
        font-family: NOR;
    }
    #pmNewMain td {
        font-size: 14px;
        white-space: nowrap;
    }

    .pmNewFormCont {
        width: 100%;
        border-spacing: 0px 5px;
        background-color:white;
    }
    .pmNewFormCont > tbody > tr > td:first-child {
        text-align: right;
        padding:0px 5px;
    }
    .pmNewNumLabel {
        display: inline-block;
        width: 10px;
        font-size: 20px;
        font-weight: bold;
        color: gray;
        font-style: italic;
        padding:0px 5px;
    }
    .pmNewOption {
        text-align: center;
        font-size: 14px;
        margin-right: 12px;
        letter-spacing:1px;
        /* text-transform:uppercase; */
    }
    .pmNewOption:hover {
        font-weight: bold;
        cursor: pointer;
    }
    .pmNewHeadLabel {
        font-weight: bold;
        font-size: 20px;
        letter-spacing:1px;
        background-image:linear-gradient(to left, black ,rgb(32, 128, 201));
        color:white;
        padding:2px 10px;
    }

    .pmNewData1 {
        padding: 3px 6px;
        font-size: 12px;
        font-weight: bold;
        border: 1px solid silver;
        width: 350px;
        font-family:Oswald;
    }

    #trackingUnderPM {
        width:100%;
    }
    #trackingUnderPM th {
        padding:0px 5px;
        font-size:14px;
        border-top:1px solid silver;
        border-bottom:1px solid silver;
        letter-spacing:1px;
        white-space:nowrap;
    }
    #trackingUnderPM > tbody > tr > td {
        padding:2px 5px;
    }
    #trackingUnderPM > tbody > tr:nth-child(odd) {
        /* background-color:rgb(230, 243, 246); */
        background-color:rgba(237, 243, 245, .5);
    }
    #trackingUnderPM > tbody > tr > td:first-child {
        background-color:white;
        font-size:10px;
        font-weight:bold;
        font-style:italic;
        width:10px;
    }
    #trackingUnderPM > tbody > tr > td:last-child {
        background-color:white;
    }
    
</style>

<div style="padding:10px;">
    <table id="pmNewMain" border="0" cellspacing="0" cellpadding="0" style="">
        <tr>
            <td style="background-color:rgba(30, 64, 80,.1); padding:10px; height:1px;">
                <div class="pmNewHeadLabel" style="">Track Paymaster</div>
                <div style="font-size:0px; background-color:rgb(240, 243, 241); padding:5px 10px;">
                    <span id="pmNewCreateBtn" class="pmNewOption" onclick="pmNewSelectPMContainer(this)">Create New</span>
                    <span id="pmNewAddToBtn" class="pmNewOption" onclick="pmNewSelectPMContainer(this)">Add to Current</span>
                </div>
                <table id="pmNewCreate" border="0" cellspacing="0" cellpadding="0" class="pmNewFormCont" style="display:none; padding:10px;">
                    <tr>
                        <td colspan="2" style="padding:0px;">
                            <span class = "data1" style = "margin-right:5px; font-family:NOR;" >Tracking number</span>
                            <div id = "divNewTrackingNumberPay" style = "font-size:30px; font-weight:bold; display:inline-block; font-family:NOR;" class = "data1">0000-0</div>
                        </td>
                    </tr>
                    <tr>
                        <td>Disbursement Officer<span class="pmNewNumLabel">1</span></td>
                        <td><input id="pmNewCreateOfficer" class="pmNewData1" style="text-transform:uppercase;"></td>
                    </tr>
                    <tr>
                        <td>Fund<span class="pmNewNumLabel">2</span></td>
                        <td><input id="pmNewCreateFund" class="pmNewData1" readonly></td>
                    </tr>
                    <tr>
                        <td>Window<span class="pmNewNumLabel">3</span></td>
                        <td><input id="pmNewCreateWindow" class="pmNewData1"></td>
                    </tr>
                </table>
                <table id="pmNewAddTo" border="0" cellspacing="0" cellpadding="0" class="pmNewFormCont" style="display:none; padding:10px;">
                    <tr>
                        <td colspan="2" style="padding:0px;">
                            <span style="margin-right:8px;">Search PM#</span>
                            <input type="text" id="searchPYPayForAdd" maxlength="9" class="text3" style = "width:150px; font-weight: bold;  padding:2px 5px; font-size: 22px; text-align:center;" id="" onkeydown="keypressAndWhatClear(this,event,searchPMForAdding,1)">
                        </td>
                    </tr>
                    <tr>
                        <td>Tracking Number<span class="pmNewNumLabel">1</span></td>
                        <td><input id="pmNewAddToTN" class="pmNewData1" readonly></td>
                    </tr>
                    <tr>
                        <td>Disbursement Officer<span class="pmNewNumLabel">2</span></td>
                        <td><input id="pmNewAddToOfficer" class="pmNewData1" readonly></td>
                    </tr>
                    <tr>
                        <td>Fund<span class="pmNewNumLabel">3</span></td>
                        <td><input id="pmNewAddToFund" class="pmNewData1" readonly></td>
                    </tr>
                    <tr>
                        <td>Window<span class="pmNewNumLabel">4</span></td>
                        <td><input id="pmNewAddToWindow" class="pmNewData1" readonly></td>
                    </tr>
                </table>
            </td>
            <td rowspan="2" style="vertical-align:top; padding:2px 5px;">
                <div class="pmNewHeadLabel" style="text-align:center; background:none; color:black; padding:0px;">Cash Advances</div>
                <table id="trackingUnderPM" border="0" cellspacing="0" cellpadding="0" style="">
                    <thead>
                        <tr>
                            <th style="width:10px; border:0px;"></th>
                            <th style="">Year</th>
                            <th style="text-align:left;">Tracking No.</th>
                            <th style="">Claimant</th>
                            <th style="text-align:left;">Office</th>
                            <th style="">Employees</th>
                            <th style="text-align:right;">Gross</th>
                            <th style="text-align:right;">Net Amount</th>
                            <th style="border:0px;"></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="background-color:rgba(30, 64, 80,.1); padding:10px; vertical-align:top;">
                <div class="pmNewHeadLabel" style="">Add Tracking</div>
                <table id="" border="0" cellspacing="0" cellpadding="0" class="pmNewFormCont" style="padding:5px 0px 0px 10px;">
                    <tr>
                        <td colspan="2" style="padding:0px; text-align:right; padding-right:13px;">
                            <span style="margin-right:8px;">Add TN#</span>
                            <input type="text" id="searchPYPay" maxlength="9" class="text3" style = "width:150px;font-weight: bold; padding:2px 5px; font-size: 22px;text-align:center;" id="" onkeydown="keypressAndWhatClear(this,event,getPYDetailsForPAY,1)">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-left:22px;">Tracking Number<span class="pmNewNumLabel">1</span></td>
                        <td><input id="pmNewAddedTN" class="pmNewData1" readonly></td>
                    </tr>
                    <tr>
                        <td>Claimant<span class="pmNewNumLabel">2</span></td>
                        <td><input id="pmNewAddedClaimant" class="pmNewData1" readonly></td>
                    </tr>
                    <tr>
                        <td>Document Type<span class="pmNewNumLabel">3</span></td>
                        <td><input id="pmNewAddedType" class="pmNewData1" readonly></td>
                    </tr>
                    <tr>
                        <td>Period<span class="pmNewNumLabel">4</span></td>
                        <td><input id="pmNewAddedPeriod" class="pmNewData1" readonly></td>
                    </tr>
                    <tr>
                        <td>Office Assigned<span class="pmNewNumLabel">5</span></td>
                        <td><input id="pmNewAddedOffice" class="pmNewData1"></td>
                    </tr>
                    <tr>
                        <td>Employees<span class="pmNewNumLabel">6</span></td>
                        <td><input id="pmNewAddedEmps" class="pmNewData1"></td>
                    </tr>
                    <tr>
                        <td>Gross Amount<span class="pmNewNumLabel">7</span></td>
                        <td><input id="pmNewAddedGross" class="pmNewData1" readonly></td>
                    </tr>
                    <tr>
                        <td>Net Amount<span class="pmNewNumLabel">8</span></td>
                        <td><input id="pmNewAddedNet" class="pmNewData1" onkeydown="return isAmount(this,event);"></td>
                    </tr>
                    <tr style="display:none;">
                        <td>Program<span class="pmNewNumLabel">9</span></td>
                        <td><input id="pmNewAddedProgram" class="pmNewData1" readonly></td>
                    </tr>
                    <tr style="display:none;">
                        <td>Account Code<span class="pmNewNumLabel">10</span></td>
                        <td><input id="pmNewAddedAccount" class="pmNewData1" readonly></td>
                    </tr>
                    <tr style="display:none;">
                        <td>OBR Number<span class="pmNewNumLabel">11</span></td>
                        <td><input id="pmNewAddedOBR" class="pmNewData1" readonly></td>
                    </tr>
                    <tr style="display:none;">
                        <td>ADV Number<span class="pmNewNumLabel">12</span></td>
                        <td><input id="pmNewAddedADV" class="pmNewData1" readonly></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><div style="margin-top:10px; padding:5px 8px; width:50px; font-size:18px;" class="button1" onclick="savePaymaster()">Save</div><br/></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>

<script>
//  -------------- CHEQUERIST FIELDS :
//  -------------- `PMTrackYear`,`PMTrackingNumber`,`PMClaimant`,`PMFund`,`PMWindow`,`PMNumOfEmps`,`PMTotalNet`,
//  -------------- *`AddedTrackYear`,*`AddedTrackingNumber`,*`AddedClaimant`,*`AddedPeriod`,*`AddedOfficeAssigned`,
//  -------------- *`AddedNumOfEmps`,*`AddedGross`,*`AddedNet`,`AddedProgram`,`AddedOBR_Number`,`AddedAccount`,
//  -------------- `AddedADV`,*`AddedDocumentType`

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

var pmSaveType = 0;
document.getElementById('pmNewCreateBtn').click();

function pmNewSelectPMContainer(me) {
    var containerId = me.id.replace("Btn", "");
    var container = document.getElementById(containerId);
    var optsContainer = me.parentNode;
    var td = me.parentNode.parentNode;
    var len1 = optsContainer.children.length;
    var len2 = td.children.length;

    for (let i = 0; i < len1; i++) {
        optsContainer.children[i].style.color = "gray";
        optsContainer.children[i].style.fontWeight = "normal";
    }

    me.style.color = "rgb(64, 161, 202)";
    me.style.fontWeight = "bold";

    for (let i = 2; i < len2; i++) {
        td.children[i].style.display = "none";
    }
    container.style.display = "table";
    
    if(containerId == "pmNewCreate") {
        pmSaveType = 1;
        payCallTrackingType();
    }else{
        pmSaveType = 2;
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

// function addMultiplePAY(content){
//     var temp = content.split('*payContent*');
//     var tn = temp[0];
//     var claimant = temp[1];
//     var vcGross = temp[2];
//     var vcNet = temp[3];
//     var empsNum = temp[4];
//     var fund = temp[5];
//     var officeAssigned = temp[6];
//     var docType = temp[7];
//     var period = temp[8];
//     var program = temp[9];
//     var account = temp[10];
//     var obr = temp[11];
//     var adv = temp[12];

//     var tnField = document.getElementById('pmNewAddedTN');
//     var claimantField = document.getElementById('pmNewAddedClaimant');
//     var docTypeField = document.getElementById('pmNewAddedType');
//     var periodField = document.getElementById('pmNewAddedPeriod');
//     var officeAssignedField = document.getElementById('pmNewAddedOffice');.03
//     var empsNumField = document.getElementById('pmNewAddedEmps');
//     var vcGrossField = document.getElementById('pmNewAddedGross');
//     var vcNetField = document.getElementById('pmNewAddedNet');
//     var programField = document.getElementById('pmNewAddedProgram');
//     var accountField = document.getElementById('pmNewAddedAccount');
//     var obrField = document.getElementById('pmNewAddedOBR');
//     var advField = document.getElementById('pmNewAddedADV');

//     tnField.value = tn;
//     claimantField.value = claimant;
//     docTypeField.value = docType;
//     periodField.value = period;
//     officeAssignedField.value = officeAssigned;
//     empsNumField.value = empsNum;
//     vcGrossField.value = numberWithCommas(round2(vcGross));
//     vcNetField.value = numberWithCommas(round2(vcNet));
//     programField.value = program;
//     accountField.value = account;
//     obrField.value = obr;
//     advField.value = adv;
    
//     if(pmSaveType == 1) {
//         var fundField = document.getElementById('pmNewCreateFund');
//         fundField.value = fund;
//     }
// } 

function addMultiplePAY(content){
    var temp = content.split('*payContent*');
    var tn = temp[0];
    var claimant = temp[1];
    var vcGross = temp[2];
    var vcNet = temp[3];
    var empsNum = temp[4];
    var fund = temp[5];
    var officeAssigned = temp[6];
    var docType = temp[7];
    var period = temp[8];
    var program = temp[9];
    var account = temp[10];
    var obr = temp[11];
    var adv = temp[12];

    var tnField = document.getElementById('pmNewAddedTN');
    var claimantField = document.getElementById('pmNewAddedClaimant');
    var docTypeField = document.getElementById('pmNewAddedType');
    var periodField = document.getElementById('pmNewAddedPeriod');
    var officeAssignedField = document.getElementById('pmNewAddedOffice');.03
    var empsNumField = document.getElementById('pmNewAddedEmps');
    var vcGrossField = document.getElementById('pmNewAddedGross');
    var vcNetField = document.getElementById('pmNewAddedNet');
    var programField = document.getElementById('pmNewAddedProgram');
    var accountField = document.getElementById('pmNewAddedAccount');
    var obrField = document.getElementById('pmNewAddedOBR');
    var advField = document.getElementById('pmNewAddedADV');


    var proc = 1;
    var fundFieldCr = document.getElementById('pmNewCreateFund');
    var fundFieldNa = document.getElementById('pmNewAddToFund');
    if(pmSaveType == 1) {
        fundFieldCr.value = fund;
    }else {
        if(fundFieldNa.value != "" && fundFieldNa.value != fund) {
            proc = 0;
        }
    }
    
    if(proc == 1) {
        tnField.value = tn;
        claimantField.value = claimant;
        docTypeField.value = docType;
        periodField.value = period;
        officeAssignedField.value = officeAssigned;
        empsNumField.value = empsNum;
        vcGrossField.value = numberWithCommas(round2(vcGross));
        vcNetField.value = numberWithCommas(round2(vcNet));
        programField.value = program;
        accountField.value = account;
        obrField.value = obr;
        advField.value = adv;
    }else {
        alert("This Tracking Number does not have the same FUND as the Paymaster Tracking.");
        clearFieldsPAY2();
    }
    
    
}

function savePaymaster() {
    if(pmSaveType == 1){
        savePaymasterNew();
    }else{
        addToPaymaster();
    }
}

function savePaymasterNew() {
    var disbOfficer = document.getElementById('pmNewCreateOfficer').value.trim().toUpperCase();
    var fund = document.getElementById('pmNewCreateFund').value.trim();
    var window = document.getElementById('pmNewCreateWindow').value.trim();
    var addedTN = document.getElementById('pmNewAddedTN').value.trim();
    var addedClaimant = document.getElementById('pmNewAddedClaimant').value.trim();
    var addedDocType = document.getElementById('pmNewAddedType').value.trim();
    var addedPeriod = document.getElementById('pmNewAddedPeriod').value.trim();
    var addedOffice = document.getElementById('pmNewAddedOffice').value.trim();
    var addedEmps = document.getElementById('pmNewAddedEmps').value.trim();
    var addedGross = parseFloat(document.getElementById('pmNewAddedGross').value.replace(/,/g, ""));
    var addedNet = parseFloat(document.getElementById('pmNewAddedNet').value.replace(/,/g, ""));
    var addedProgram = document.getElementById('pmNewAddedProgram').value.trim();
    var addedAccount = document.getElementById('pmNewAddedAccount').value.trim();
    var addedOBR = document.getElementById('pmNewAddedOBR').value.trim();
    var addedADV = document.getElementById('pmNewAddedADV').value.trim();

    var error = -1;
    if(disbOfficer == "") {
        error = 1;
    }else if(fund == "") {
        error = 2;
    }else if(window == "") {
        error = 3;
    }else if(addedTN == "") {
        error = 4;
    }else if(addedEmps == 0) {
        error = 5;
    }else if(addedNet == 0) {
        error = 6;
    }

    if(error < 0){
        var queryString ="?savePaymasterNew=1"
                        +"&officer="+disbOfficer
                        +"&fund="+fund
                        +"&window="+window
                        +"&addTN="+addedTN
                        +"&addClaimant="+addedClaimant
                        +"&addDocType="+addedDocType
                        +"&addPeriod="+addedPeriod
                        +"&addOffice="+addedOffice
                        +"&addEmps="+addedEmps
                        +"&addGross="+addedGross
                        +"&addNet="+addedNet
                        +"&addProgram="+addedProgram
                        +"&addAccount="+addedAccount
                        +"&addOBR="+addedOBR
                        +"&addADV="+addedADV;
        var container = document.getElementById('divNewTrackingNumberPay');

        loader();
        ajaxGetAndConcatenate(queryString, processorLink, container, "savePaymasterNew");
    }else {
        if(error == 1) {
            alert('Please enter the Disbursement Officer.');
        }else if(error == 2) {
            alert('Please select fund.');
        }else if(error == 3) {
            alert('Please enter the Window number.');
        }else if(error == 4) {
            alert('Please search Tracking Number to be added.');
        }else if(error == 5) {
            alert('Please enter the Number of Employees under this Tracking Number.');
        }else if(error == 6) {
            alert('Please correct the Net Amount of the Tracking Number to be added.');
        }
    }
}

function searchPMForAdding() {
    var tn = document.getElementById('searchPYPayForAdd').value.trim();

    if(tn.length > 0) {
        var trackingNumber = document.getElementById('searchPYPayForAdd').value.trim();
        var queryString ="?searchPMForAdding=1&trackingNumber="+trackingNumber;
        var container = "";

        loader();
        ajaxGetAndConcatenate(queryString, processorLink, container, "searchPMForAdding");
    }
}

function getTrackingUnderPM(tn) {
    var queryString ="?getTrackingUnderPM=1&trackingNumber="+tn;
    var container = document.getElementById('trackingUnderPM').children[1];

    loader();
    ajaxGetAndConcatenate(queryString, processorLink, container, "getTrackingUnderPM");
}

function addedListTotal() {
    var pmNewAddToTN = document.getElementById('pmNewAddToTN').value.trim();
    var tbody = document.getElementById('trackingUnderPM').children[1];
    var len = tbody.children.length;

    var newTotal = 0;
    for (let i = 0; i < len; i++) {
        var net = parseFloat(tbody.children[i].children[7].textContent.replace(/,/g, ""));
        newTotal += net;           
    }
    var tr = "<tr style='background-color:white;'>"
            +"  <td style='text-align:center; border:0px;'></td>"
            +"  <td colspan='7' style='text-align:right; font-weight:bold; border:0px; font-size:20px; color:red; padding:5px 5px; border-top:1px solid silver;'>"
            +"      <span style='font-size:16px; color:black; margin-right:10px;'>Total</span>"+numberWithCommas(round2(newTotal))
            +"  </td>"
            +"  <td style='text-align:center; border:0px;'></td>"
            +"</tr>";

    tr +=    "<tr style='background-color:white;'>"
            +"  <td style='text-align:center; border:0px;'></td>"
            +"  <td colspan='7' style='font-weight:bold; border:0px; font-size:20px;'>"
            +"      <a href='../interface/formPM.php?trackingNumber="+pmNewAddToTN+"' target='_blank' style='text-decoration:none; font-size:12px; letter-spacing:1px; color:black;'>⩸ Paymaster Summary</a>"
            +"  </td>"
            +"  <td style='text-align:center; border:0px;'></td>"
            +"</tr>";
    tbody.innerHTML += tr;
}

function addToPaymaster() {
    var pmNewAddToTN = document.getElementById('pmNewAddToTN').value.trim();
    var disbOfficer = document.getElementById('pmNewAddToOfficer').value.trim().toUpperCase();
    var fund = document.getElementById('pmNewAddToFund').value.trim();
    var window = document.getElementById('pmNewAddToWindow').value.trim();
    var addedTN = document.getElementById('pmNewAddedTN').value.trim();
    var addedClaimant = document.getElementById('pmNewAddedClaimant').value.trim();
    var addedDocType = document.getElementById('pmNewAddedType').value.trim();
    var addedPeriod = document.getElementById('pmNewAddedPeriod').value.trim();
    var addedOffice = document.getElementById('pmNewAddedOffice').value.trim();
    var addedEmps = document.getElementById('pmNewAddedEmps').value.trim();
    var addedGross = parseFloat(document.getElementById('pmNewAddedGross').value.replace(/,/g, ""));
    var addedNet = parseFloat(document.getElementById('pmNewAddedNet').value.replace(/,/g, ""));
    var addedProgram = document.getElementById('pmNewAddedProgram').value.trim();
    var addedAccount = document.getElementById('pmNewAddedAccount').value.trim();
    var addedOBR = document.getElementById('pmNewAddedOBR').value.trim();
    var addedADV = document.getElementById('pmNewAddedADV').value.trim();

    var error = -1;
    if(pmNewAddToTN == "") {
        error = 1;
    }else if(addedTN == "") {
        error = 2;
    }else if(addedEmps == 0) {
        error = 3;
    }else if(addedNet == 0) {
        error = 4;
    }

    if(error < 0){
        var queryString ="?addToPaymaster=1"
                        +"&pmTrackingNumber="+pmNewAddToTN
                        +"&officer="+disbOfficer
                        +"&fund="+fund
                        +"&window="+window
                        +"&addTN="+addedTN
                        +"&addClaimant="+addedClaimant
                        +"&addDocType="+addedDocType
                        +"&addPeriod="+addedPeriod
                        +"&addOBR="+addedOBR
                        +"&addADV="+addedADV
                        +"&addProgram="+addedProgram
                        +"&addAccount="+addedAccount
                        +"&addOffice="+addedOffice
                        +"&addEmps="+addedEmps
                        +"&addGross="+addedGross
                        +"&addNet="+addedNet;
        var container = "";

        loader();
        ajaxGetAndConcatenate(queryString, processorLink, container, "addToPaymaster");
    }else {
        if(error == 1) {
            alert('Please search Paymaster.');
        }else if(error == 2) {
            alert('Please search Tracking Number to be added.');
        }else if(error == 3) {
            alert('Please enter the Number of Employees under this Tracking Number.');
        }else if(error == 4) {
            alert('Please correct the Net Amount of the Tracking Number to be added.');
        }
    }
}

function pmRemoveThisDirect(me) {
    var pmNewAddToTN = document.getElementById('pmNewAddToTN').value.trim();
    var tr = me.parentNode.parentNode;
    var addedTrackYear = tr.children[1].textContent.trim();
    var addedTN = tr.children[2].textContent.trim();
    var addedEmps = tr.children[5].textContent.trim();
    var addedNet = parseFloat(tr.children[7].textContent.replace(/,/g, ""));

    var queryString ="?pmRemoveThisDirect=1"
                        +"&pmTrackingNumber="+pmNewAddToTN
                        +"&addTNYear="+addedTrackYear
                        +"&addTN="+addedTN
                        +"&addEmps="+addedEmps
                        +"&addNet="+addedNet;
    var container = "";

    loader();
    ajaxGetAndConcatenate(queryString, processorLink, container, "pmRemoveThisDirect");
}

function clearFieldsPAY1(){
    var disbOfficer = document.getElementById('pmNewCreateOfficer');
    var fund = document.getElementById('pmNewCreateFund');
    var window = document.getElementById('pmNewCreateWindow');

    disbOfficer.value = "";
    fund.value = "";
    window.value = "";
}

function clearFieldsPAY2(){
    var searchPYPay = document.getElementById('searchPYPay');
    var addedTN = document.getElementById('pmNewAddedTN');
    var addedClaimant = document.getElementById('pmNewAddedClaimant');
    var addedDocType = document.getElementById('pmNewAddedType');
    var addedPeriod = document.getElementById('pmNewAddedPeriod');
    var addedOffice = document.getElementById('pmNewAddedOffice');
    var addedEmps = document.getElementById('pmNewAddedEmps');
    var addedGross = document.getElementById('pmNewAddedGross');
    var addedNet = document.getElementById('pmNewAddedNet');
    var addedProgram = document.getElementById('pmNewAddedProgram');
    var addedAccount = document.getElementById('pmNewAddedAccount');
    var addedOBR = document.getElementById('pmNewAddedOBR');
    var addedADV = document.getElementById('pmNewAddedADV');

    searchPYPay.value = "";
    addedTN.value = "";
    addedClaimant.value = "";
    addedDocType.value = "";
    addedPeriod.value = "";
    addedOffice.value = "";
    addedEmps.value = "";
    addedGross.value = "";
    addedNet.value = "";
    addedProgram.value = "";
    addedAccount.value = "";
    addedOBR.value = "";
    addedADV.value = "";
}

</script>