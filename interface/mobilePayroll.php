<table border="0" cellpadding="0" cellspacing="0" style="width:100vw;">
    <tr style="background: linear-gradient(to left, #23597F, rgb(3, 29, 60));">
        <td class="searchHeader"><strong style="color:white;">SEARCH</strong> PAYROLL</td>
        <td>
            <span style="float:right; color:white; font-family:Arial; font-size:14px; padding-right:8px;">
                <span>CY&nbsp;:</span>
                <select id="searchYrPayroll" class="yrDropdown">
                    <?php
                        $dt = time();
                        $dtYear = date('Y', $dt);
                        do {
                            echo '<option style="background-color:black;">'.$dtYear--.'</option>';
                        } while ($dtYear >= 2022);
                    ?>
                </select>
            </span>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:right; padding:5px 0px; padding-right:2.1rem; font-family:Arial; font-size:0px; background-color:black; border-bottom:2px solid rgba(255,255,255,.1);">
            <span style="font-size:12px; color:white; letter-spacing:1px; margin-right:5px;">Or find by :</span> 
            <span style="">
                <input type="radio" style="display:none;" name="searchBy" id="searchByName" onclick="changeFieldForPayroll(this)"><label class="searchByLabel" style="" for="searchByName">NAME</label>
                <input type="radio" style="display:none;" name="searchBy" id="searchByEmpNum" onclick="changeFieldForPayroll(this)" checked><label class="searchByLabel" style="" for="searchByEmpNum" id="searchPayrollDefault">EMPLOYEE NO</label>
            </span>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="padding:0px;">
            <table border="0" cellpadding="0" cellspacing="0" style="width:100vw; font-family:Cuprum; text-align:center;">
                <tr style="">
                    <td style="border-bottom:12px solid black; border-top:12px solid black; padding:0px 11px; width:10px; background-color:black;">
                        <span onclick="showHideMenu(this)"><img src="../images/return5.svg" style="height:14px; width:14px;"></span>
                    </td>
                    <td id="searchFieldPayrollCont" style="border-bottom:12px solid black; border-top:12px solid black; vertical-align:bottom;">
                        <div>
                            <input type="text" id="searchFieldPayrollEmp" maxlength="15" class="searchField" style="color:white;" placeholder="Enter Employee Number" onkeyup="showHideClearPayroll(this)" value="362692">
                        </div>
                        <div style="display:none;">
                            <input type="text" id="searchFieldPayrollFname" maxlength="15" class="searchField" style="color:white; display:block;" placeholder="Enter First Name" onkeyup="showHideClearPayroll(this)" value="Val">
                            <div style="padding-top:12px; background-color:black;"></div>
                            <input type="text" id="searchFieldPayrollLname" maxlength="15" class="searchField" style="color:white; display:block;" placeholder="Enter Last Name" onkeyup="showHideClearPayroll(this)" value="Balangue">
                        </div>
                    </td>
                    <td style="border-bottom:12px solid black; border-top:12px solid black; padding:3px 2px; text-align:center; width:10px; background-color:black;">
                        <span class="searchBtn" id="tempSearchClick" onclick="searchThisFieldPayroll()"><img src="../images/search6.svg" style="height:20px; width:20px;"></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding:0px; text-align:center; background-color:rgba(0,0,0,.7);">
                        <span class="clearSearchField" id="clearSearchBtnPayroll" onclick="clearSearchFieldPayroll(this)" style="margin:3px 0px;">[ CLEAR ]</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding:0px;">
                        <div class="resultsContainer" id="resultsContainerPayroll" style=""></div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<script>
    document.getElementById('searchPayrollDefault').click();
    function changeFieldForPayroll(me) {
        var container = me.parentNode;
        var labels = container.getElementsByTagName('LABEL');
        var id = me.id;
        var type = me.id.replace('searchBy', '');

        var container = document.getElementById('searchFieldPayrollCont');

        container.children[0].style.display = 'none';
        container.children[1].style.display = 'none';

        labels[0].style.display = 'none';
        labels[1].style.display = 'none';

        if(type == "EmpNum") {
            container.children[0].style.display = '';
            labels[0].style.display = '';
        }else {
            container.children[1].style.display = '';
            labels[1].style.display = '';
        }


    }

    function showHideClearPayroll(me) {
        var container = me.parentNode.parentNode;
        var inputs = container.getElementsByTagName('INPUT');
        var clearBtn = document.getElementById('clearSearchBtnPayroll');

        var len = 0;
        for (let i = 0; i < inputs.length; i++) {
            if(inputs[i].value.trim().length > 0) {
                len = 1;
            }            
        }

        if(len > 0) {
            clearBtn.style.display = 'inline-block';
        }

    }

    function clearSearchFieldPayroll(me) {
        var radio1 = document.getElementById('searchByName');
        var radio2 = document.getElementById('searchByEmpNum');

        if(radio2.checked == true) {
            clearSearchField('searchFieldPayrollEmp', me);
        }else {
            clearSearchField('searchFieldPayrollFname,searchFieldPayrollLname', me);
        }
    }

    function searchThisFieldPayroll() {
        var byName = document.getElementById('searchByName');
        var byEmp = document.getElementById('searchByEmpNum');
        var container = document.getElementById('resultsContainerPayroll');
        var year = document.getElementById('searchYrPayroll');
        var key = "";
        var type = 0;

        var noempty = 1;
        if(byEmp.checked == true) {
            var empNum = document.getElementById('searchFieldPayrollEmp');

            if(empNum.value.trim().length > 0) {
                key = empNum.value.trim();
                type = 1;
                noempty = 0;
            }
        }else {
            var empFname = document.getElementById('searchFieldPayrollFname');
            var empLname = document.getElementById('searchFieldPayrollLname');

            if(empFname.value.trim().length > 0 && empLname.value.trim().length > 0) {
                key = empLname.value.trim()+", "+empFname.value.trim();
                type = 2;
                noempty = 0;
            }
        }

        if(noempty == 0) {
            var queryString = "?searchMobilePayroll=1&value="+key+"&year="+year.value.trim();
            loader2();
            ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");

            // document.getElementById('clearSearchBtnPayroll').style.display = 'none';
        }else {
            container.innerHTML = "<div class = 'wiggle' style = 'color:white;font-size:48px;   display:block;margin-top:60px ;text-align:center;text-shadow:0px 2px 2px black;'>Taasi gamay ang i search.</div>";
        }

        // setResultsContainerHeight('resultsContainerPayroll');
    }

    function getLoadMorePayroll(me) {
        var lastId = document.getElementById('lastIdPayroll');
        var key = document.getElementById('lastIdKey');
        var year = document.getElementById('searchYrPayroll').value.trim();
        var cnt = document.getElementById('lastIdCount');
        var tnList = document.getElementById('lastTNList');

        var container = document.getElementById('resultsContainerPayroll');
        var queryString = "?loadMoreMobilePayroll=1&value="+key.textContent.trim()+"&year="+year+"&lastId="+lastId.textContent.trim()+"&count="+cnt.textContent.trim()+"&tns="+tnList.textContent.trim();

        lastId.parentNode.removeChild(lastId);
        key.parentNode.removeChild(key);
        cnt.parentNode.removeChild(cnt);
        tnList.parentNode.removeChild(tnList);
        me.parentNode.removeChild(me);

        loader2();
        ajaxGetAndConcatenate(queryString,processorLink,container,"loadMoreMobilePayroll");
    }

    function getGenDetailsPayroll(tn, me) {
        var year = document.getElementById('searchYrVouchers').value.trim();
        
        var container = me.parentNode.children[1];
        var queryString = "?getGenDetailsPayroll=1&tn="+tn+"&year="+year;

        if(me.innerHTML == '+&nbsp;SHOW MORE') {
            loader2();
            me.innerHTML = '&#x2212;&nbsp;SHOW LESS';
            // ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
            ajaxGetAndConcatenate(queryString,processorLink,container,"getGenDetailsPayroll");
        }else {
			revealShowMore(container);
            container.innerHTML = '';
            me.innerHTML = '&#x2b;&nbsp;SHOW MORE';
        }
        
    }

</script>