<style>

    #drrmoEncoderCont {
        font-family:NOR;
    }

    .drrmEncNum {
        padding:0px;
        text-align:right;
        padding:0px 8px;
        width:0px;
        white-space:nowrap;
        font-weight:bold;
    }

    .inputDrrmo{
		color:rgb(35, 116, 157);
		/* width:100%; */
		padding:2px;
		font-weight: bold;
		font-family: NOR;
		
		border: 1px solid rgb(217, 225, 229);
		border-bottom:1px solid silver;

        width:350px;
	}

    .drrmoExpOption {
        display:block;
        white-space:nowrap;
        cursor:pointer;
        transition:.2s ease-in-out;
        padding:0px 5px;
    }
    .drrmoExpOption:hover {
        background-color: silver;
    }

    #drrmoCOAddTable > tr:nth-child(even) {
        /* background-color:rgb(237, 240, 235); */
    }

    .drrmoRemoveBtn {
        font-size:16px;
        font-weight:bold;
        color:silver;
        cursor:pointer;
        transition: .2s ease-in-out;
    }

    .drrmoRemoveBtn:hover {
        color:red;
        /* background-color:rgba(108,128,143,1); */
    }


</style>

<table id="drrmoExpSelectHidden" border="1" cellpadding="0" style="z-index:105; position:absolute; background-color:rgba(4, 4, 4,.3); top:0; left:0; right:0; left:0; color:red; height:100vh; width:100vw; padding:0px; display:none;">
    <tr>
        <td style="text-align:center;">
            <div id="expListModalContainer" class="editorContainer" style="display:inline-block;">
                <table border="0" cellpadding="0" class="editorTable" style="font-family:Oswald; background-color:white;">
                    <tbody>
                        <tr>
                            <td class="editorHeader" style="background-color:rgb(227, 239, 242); color:black; text-shadow:none; font-weight:bold;">
                                Expense Codes List<div onclick="showDRRMOExpenseCodes()" class="closeEditor"></div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:10px 0px 10px 10px; text-align:right; font-size:0px;">
                                <input type="radio" name="drrmoExpListFilter" id="drrmoExpALL" onclick="shrtFilterDRRMOExpList(this)" checked>
                                <label for="drrmoExpALL" style="font-size:14px; margin-right:10px;">All</label>
                                <input type="radio" name="drrmoExpListFilter" id="drrmoExpCO" onclick="shrtFilterDRRMOExpList(this)">
                                <label for="drrmoExpCO" style="font-size:14px; margin-right:10px;">Capital Outlay</label>
                                <input type="radio" name="drrmoExpListFilter" id="drrmoExpMOOE" onclick="shrtFilterDRRMOExpList(this)">
                                <label for="drrmoExpMOOE" style="font-size:14px; margin-right:10px;">MOOE</label>
                            </td>
                        </tr>
                        <tr>
							<td style="padding:0px;">
								<div id="drrmoExpListCont" style="height:50vh; width:25vw; overflow-y:auto; overflow-x:hidden; border:1px solid rgba(192,192,192,.26);"></div>
							</td>
						</tr>
                        <tr>
                            <td style="padding:20px 0px; text-align:center; background-color:rgb(245, 248, 248);">
                                <div class="button1 b1" onclick="ddrmoGetNFormSelectedExpenses()">Select</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
</table>

<div id="drrmoEncoderCont" style="">
    <table border="0" cellpadding="0" style="border-collapse:collapse; width:100%;">
        <tr>
            <td style="padding:8px 8px; width:0px; vertical-align:top;">
                <table border="0" cellpadding="0" style="">
                    <tr>
                        <td colspan="3" style="font-weight:bold; line-height:14px; border-bottom:1px dashed black; ">
                            <span style="padding:0px 3px;">DRRMO PROJECT ENTRY</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="padding:3px 0px;"></td>
                    </tr>
                    <tr>
                        <td style="text-align:right; white-space:nowrap; vertical-align:top;">Project</td>
                        <td class="drrmEncNum" style="vertical-align:top; padding-top:2px;">1</td>
                        <td>
                            <textarea id="drrmoNewProjectName" class="inputDrrmo" style="padding:2px 5px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right; white-space:nowrap;">Office</td>
                        <td class="drrmEncNum">2</td>
                        <td>
                            <select id="drrmoOffice" class="inputDrrmo"></select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right; white-space:nowrap;">Fund Type</td>
                        <td class="drrmEncNum">3</td>
                        <td>
                            <select id="drrmoFundType" class="inputDrrmo">
                                <option></option>
                                <option value="70">70% GF</option>
                                <option value="30">30% Quick</option>
                                <option value="TF">Special Trust Fund</option>
                                <option value="CO">Continuing Appropriations</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:right; white-space:nowrap;">Expense Account</td>
                        <td class="drrmEncNum">4</td>
                        <td>
                            <div class="inputDrrmo" style="width:344px; border:0px; border-bottom:1px dashed black; cursor:pointer; font-size:14px; color:black; text-align:center;" onclick="showDRRMOExpenseCodes()">Select expense/account codes</div>
                            <div id="drrmoExpListHiddenContainer" style="display:none; border:1px solid red;"></div>
                        </td>
                    </tr>
                    <tr>
                        <td style=""></td>
                        <td colspan="2" style="padding-left:12px;">
                            <table border="0" cellpadding="0" style="width:100%; border-spacing:0px; border-collapse:collapse; margin-top:10px; min-width:250px;">
                                <thead>
                                    <tr style="background-color:rgb(60, 101, 126); color:white;">
                                        <th style="font-weight:normal; padding:0px 5px; background:white; width:10px;"></th>
                                        <th style="font-weight:normal; padding:0px 5px;">Account Code</th>
                                        <th style="font-weight:normal; padding:0px 5px; width:0px; white-space:nowrap; background-color:rgba(0,0,0,.1);">Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="drrmoCOAddTable"></tbody>
                                <tfoot>
                                    <tr style="">
                                        <td></td>
                                        <td colspan="2" style="text-align:right; font-weight:bold; font-size:14px; color:gray; border-top:1px solid black; padding-right:10px;">
                                            Total<span id="drrmoTotalCost" style="font-size:20px; color:red; margin-left:8px;">0.00</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="text-align:center; padding-top:20px;">
                            <div id="buttonDrrmoAdd" class="button1" style="font-size: 16px;padding:5px 10px; display:none;" onclick="saveDRRMOProject()">Save</div>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="padding:14px 8px 0px 8px; vertical-align:top;">
                <div style="font-weight:bold; line-height:14px; border-bottom:1px dashed black; padding:0px 5px;">RECENTLY ENCODED</div>
                <div id="drrmoEncodedProjectsContainer" style="padding:0px 5px;"></div>
            </td>
        </tr>
    </table>
</div>

<script>

    function loaderDRRMOEncoderDefaults() {
        loadDRRMOOffices();
        loadDRRMOEncodedProjects();

        var expListCont = document.getElementById('drrmoExpListHiddenContainer');
        if(expListCont.innerHTML.trim().length == 0) {
            loadDRRMOExpenseCodes();
        }
    }

    function loadDRRMOEncodedProjects() {
        loader();
        var container = document.getElementById("drrmoEncodedProjectsContainer");
        var queryString = "?loadDRRMOEncodedProjects=1";
        ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
    }

    function clearDRRMOEncoder() {

        document.getElementById('drrmoNewProjectName').value = '';

        selectToIndexZero("drrmoOffice");
        selectToIndexZero("drrmoFundType");

        document.getElementById('drrmoTotalCost').innerHTML = '0.00';
        document.getElementById('drrmoCOAddTable').innerHTML = '';

        document.getElementById('buttonDrrmoAdd').style.display = 'none';

        var expenseList = document.getElementById('drrmoExpList').children[0].children;
        for (var i = 0; i < expenseList.length; i++) {
            var chkbox = expenseList[i].children[0].children[0];
            chkbox.checked = false;
            expenseList[i].style.backgroundColor = "";
        } 

    }

    function saveDRRMOProject() {
        var name = document.getElementById('drrmoNewProjectName').value.trim();
        var office = document.getElementById('drrmoOffice').value;
        var fundType = document.getElementById('drrmoFundType').value;
        var totalCost = parseFloat(document.getElementById('drrmoTotalCost').textContent.replace(/,/g,""));

        var error = 0;

        if(name.length == 0) {
            error = 1;
        }
        if(office.length == 0) {
            error = 2;
        }
        if(fundType.length == 0) {
            error = 3;
        }
        if(totalCost == 0) {
            error = 4;
        }

        if(error == 0) {
            var projectExpCodes = "";
            var accountCodes = document.getElementById('drrmoCOAddTable').children;
            for (var i = 0; i < accountCodes.length; i++) {
                var fund = accountCodes[i].children[1].children[0].textContent.trim();
                var code = accountCodes[i].children[1].children[1].textContent.trim();
                var amount = accountCodes[i].children[2].children[0].value.replace(/,/g,"");

                if(amount.trim() == '') {
                    amount = 0;
                }

                if(amount > 0) {
                    projectExpCodes += "*j*"+fund+"~"+code+"~"+amount;
                }
            } 

            var formData = new FormData();

            formData.append('saveDRRMOProject', 1);
            formData.append('projectName', name);
            formData.append('agency', office);
            formData.append('fundType', fundType);
            formData.append('totalCost', totalCost);
            formData.append('accountCodes', projectExpCodes.substr(3));

            loader();
            ajaxFormUpload(formData, processorLink, 'saveDRRMOProject');

        }else {

        }

    }

    function withCommasDrrmo(me){
		var n =  me.value.replace(/,/g,"");
		me.value = numberWithCommas(n);

        computeDrrmoExpTotal();
        drrmoReNumberList();
	}

    function drrmoReNumberList() {
        var tbody = document.getElementById('drrmoCOAddTable').children;
        var count = 0;

        if(tbody.length > 0) {
            for (var i = 0; i < tbody.length; i++) {
                var td = tbody[i].children[0];
                td.innerHTML = ++count;
            } 
            buttonDrrmoAdd.style.display = "";
        }else {
            buttonDrrmoAdd.style.display = "none";
        }
    }

    function computeDrrmoExpTotal() {
        var tbody = document.getElementById('drrmoCOAddTable').children;
        var newTotal = 0;

        if(tbody.length > 0) {
            for (var i = 0; i < tbody.length; i++) {
                var amount = tbody[i].children[2].children[0].value;
                if(amount.trim() == '') {
                    amount = 0;
                }else {
                    amount = parseFloat(amount.replace(/,/g,""))
                }
                newTotal += amount;
                newTotal = parseFloat(round2(trimTwoDecimals(newTotal)));
            } 
        }

        drrmoTotalCost.innerHTML = numberWithCommas(round2(trimTwoDecimals(newTotal)));
    }

    function drrmoHighlightThisCode(me) {
        var tr = me.parentNode.parentNode;
        if(me.checked == true) {
            tr.style.backgroundColor = 'rgb(251, 244, 181)';
        }else {
            tr.style.backgroundColor = '';
        }
    }

    function shrtFilterDRRMOExpList(me) {

        var type = 'All';
        var len = 0;
        if(me.id == 'drrmoExpCO') {
            type = 'CO';
            var len = 2;
        }else if(me.id == 'drrmoExpMOOE') {
            type = 'MOOE';
            var len = 4;
        }
        
        var tbody = document.getElementById('drrmoExpList').children[0].children;

        for (var i = 0; i < tbody.length; i++) {
            
            if(type == 'All') {
                tbody[i].style.display = "";
            }else {
                tbody[i].style.display = "";
                if(tbody[i].id.substr(0, len) != type) {
                    tbody[i].style.display = "none";
                }
            }

        }        

    }

    function loadDRRMOOffices() {
        loader();
        var container = document.getElementById("drrmoOffice");
        var queryString = "?loadDRRMOOffices=1";
        ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
    }

    function showDRRMOExpenseCodes() {
        var list = document.getElementById('drrmoExpSelectHidden');
        if(list.style.display == 'none') {
            list.style.display = "";
        }else{
            list.style.display = "none";
        }
    }

    function loadDRRMOExpenseCodes() {
        // var container = document.getElementById('drrmoExpListHiddenContainer');
        var container = document.getElementById('drrmoExpListCont');
        var queryString = "?loadDRRMOExpenseCodes=1";
        ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
    }

    function ddrmoGetNFormSelectedExpenses() {
        var tbody = document.getElementById('drrmoExpList').children[0].children;
        var container = document.getElementById('drrmoCOAddTable');

        container.innerHTML = "";

        var exps = "";
        for (var i = 0; i < tbody.length; i++) {
            var chkbox = tbody[i].children[0].children[0];
            if(chkbox.checked == true) {
                var temp = tbody[i].id.split('*j*');
                var fund = temp[0];
                var code = temp[1];
                var title = tbody[i].children[1].children[1].textContent.trim();

                exps +="<tr style=''>"
                      +"    <td style='font-size:12px; text-align:right; vertical-align:top; padding-top:3px; background-color:white; border:0px;'></td>"
                      +"    <td style='white-space:nowrap; padding:0px 5px;'>"
                      +"        <div style='display:none;'>"+fund+"</div>"
                      +"        <div style='font-weight:bold;'>"+code+"</div>"
                      +"        <div>"+title+"</div>"
                      +"    </td>"
                      +"    <td style=''>"
                      +"        <input class='inputDrrmo' maxlength='14' style='padding:2px 5px; width:92px; text-align:right; color:black;' onclick='this.select()' onkeydown='return isAmount(this,event)' onkeyup='return withCommasDrrmo(this)'>"
                      +"    </td>"
                      +"</tr>";
            }
        } 

        container.innerHTML += exps;
        
        showDRRMOExpenseCodes();

        drrmoReNumberList();
    }

    function shortSrchDrrmoExpCode(me) {
        var key = me.value.trim().toUpperCase();

        var list = document.getElementById('drrmoExpenseCodeList').children;
        for (let i = 0; i < list.length; i++) {
            var supplier = list[i].textContent.trim().toUpperCase();
            if(supplier.indexOf(key) !== -1) {
                list[i].style.display = ""; 
            }else {
                list[i].style.display = "none"; 
            }
        }

        if(key.trim().length == 0) {
            drrmoExpenseSelectType.value = "";
            drrmoExpenseSelectCode.value = "";
        }

    }

    function drrmoEditThisProject(me) {
        var project = me.id.replace('prj','');

        loader();
        container = "";
        var queryString = "?drrmoEditThisProject=1&project="+project;
        ajaxGetAndConcatenate(queryString,processorLink,container,"returnModalLoader");
    }

    function drrmoUpdateGenDetails() {

        var projectid = document.getElementById('drrmoUpGenProjId').value.trim();
        var projectName = document.getElementById('drrmoEditProjectName').value.trim();
        var projectOffice = document.getElementById('drrmoEditOffice').value.trim();
        var projectFund = document.getElementById('drrmoEditFundType').value.trim();

        var error = 0;
        if(projectName.length == 0) {
            error = 1;
        }else if(projectOffice.length == 0) {
            error = 2;
        }else if(projectFund.length == 0) {
            error = 3;
        }

        if(error == 0) {
            var container = "";
            var queryString = "?drrmoUpdateGenDetails=1&pId="+projectid+"&pName="+encodeURIComponent(projectName)+"&pOffice="+projectOffice+"&pFund="+projectFund;

            closeAbsolute();
            ajaxGetAndConcatenate(queryString,processorLink,container,"drrmoUpdateGenDetails");

        }else {
            alert("Please fill-in the missing details.");
        }


    }

    function drrmoAddCodeToProject(me) {
        var project = me.id.replace('drrmoAddTo','');

        loader();
        container = "";
        var queryString = "?drrmoAddCodeToProject=1&project="+project;
        ajaxGetAndConcatenate(queryString,processorLink,container,"returnModalLoader");
    }

    function drrmoAddNewExpCode() {
        var projectId = document.getElementById('drrmoUpExpPId').value.trim();
        var projectName = document.getElementById('drrmoUpExpPName').value.trim();
        var projectOffice = document.getElementById('drrmoUpExpPOffice').value.trim();
        var projectCostTotal = document.getElementById('drrmoUpExpPCost').value.trim();
        var projectFund = document.getElementById('drrmoUpExpPFund').value.trim();
        
        var addCodeTemp = document.getElementById('drrmoAddFundCode').value.trim();
        var temp = addCodeTemp.split('*j*');
        var addCodeType = temp[0];
        var addCode = temp[1];

        var addCost = parseFloat(document.getElementById('drrmoAddCost').value.replace(/,/g,""));

        var error = 0;
        if(addCodeTemp == "") {
            error = 1;
        }else if(addCost == 0) {
            error = 2;
        }else if(isNaN(addCost)) {
            error = 3;
        }

        if(error == 0) {
            var container = "";
            var queryString = "?drrmoAddNewExpCode=1&pId="+projectId
                                +"&pName="+encodeURIComponent(projectName)
                                +"&pOffice="+projectOffice
                                +"&pFund="+projectFund
                                +"&pCost="+projectCostTotal
                                +"&aType="+addCodeType
                                +"&aCode="+addCode
                                +"&aCost="+addCost;

            closeAbsolute();
            ajaxGetAndConcatenate(queryString,processorLink,container,"drrmoAddNewExpCode");

        }else {
            alert("Please fill-in the missing details.");
        }


    }

    function drrmoRemoveThisCode(project, me) {
        var tr = me.parentNode.parentNode;
        var expCode = tr.children[0].children[0].textContent.trim();
        var amount = parseFloat(tr.children[1].textContent.trim().replace(/,/g,""));


        loader();
        container = "";
        var queryString = "?drrmoRemoveThisCode=1&project="+project+"&expCode="+expCode+"&amount="+amount;
        ajaxGetAndConcatenate(queryString,processorLink,container,"drrmoRemoveThisCode");
    }

</script>