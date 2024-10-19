<table border="0" cellpadding="0" cellspacing="0" style="width:100vw;">
    <tr style="background: linear-gradient(to left, #23597F, rgb(3, 29, 60));">
        <td class="searchHeader"><strong style="color:white;">SEARCH</strong> GOODS AND SERVICES</td>
        <td>
            <span style="float:right; color:white; font-family:Arial; font-size:14px; padding-right:8px;">
                <span>CY&nbsp;:</span>
                <select id="searchYrGoods" class="yrDropdown">
                    <?php
                        $dt = time();
                        $dtYear = date('Y', $dt);
                        do {
                            echo '<option style="background-color:black;">'.$dtYear--.'</option>';
                        } while ($dtYear >= 2016);
                    ?>
                </select>
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
                    <td style="border-bottom:12px solid black; border-top:12px solid black; vertical-align:bottom;">
                        <input type="text" id="searchFieldGoods" maxlength="15" class="searchField" style="color:white;" placeholder="Enter Tracking Number or Supplier" onkeyup="showHideClear(this)" value="JASMIN">
                    </td>
                    <td style="border-bottom:12px solid black; border-top:12px solid black; padding:3px 2px; text-align:center; width:10px; background-color:black;">
                        <span class="searchBtn" onclick="searchThisFieldGoods()"><img src="../images/search6.svg" style="height:20px; width:20px;"></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding:0px; text-align:center; background-color:rgba(0,0,0,.7);">
                        <span class="clearSearchField" id="srchGoodsClear" onclick="clearSearchField('searchFieldGoods', this)" style="margin:3px 0px;">[ CLEAR ]</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="padding:0px;">
                        <div class="resultsContainer" id="resultsContainerGoods" style=""></div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<script>
    function searchThisFieldGoods() {
        var key = document.getElementById('searchFieldGoods');
        var container = document.getElementById('resultsContainerGoods');
        var year = document.getElementById('searchYrGoods');

        if(key.value.trim().length > 2) {
            var queryString = "?searchMobileGoods=1&value="+key.value.trim()+"&year="+year.value.trim();
            loader2();
            ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");

            // document.getElementById('srchGoodsClear').click();
            document.getElementById('srchGoodsClear').style.display = 'none';
        }else {
            container.innerHTML = "<div class = 'wiggle' style = 'color:white;font-size:48px;   display:block;margin-top:60px ;text-align:center;text-shadow:0px 2px 2px black;'>Taasi gamay ang i search.</div>";
        }
        
        // setResultsContainerHeight('resultsContainerGoods');
    }

    function getLoadMoreGoods(me) {
        var lastId = document.getElementById('lastIdGoods');
        var key = document.getElementById('lastIdKey');
        var year = document.getElementById('searchYrGoods').value.trim();
        var cnt = document.getElementById('lastIdCount');

        var container = document.getElementById('resultsContainerGoods');
        var queryString = "?loadMoreMobileGoods=1&value="+key.textContent.trim()+"&year="+year+"&lastId="+lastId.textContent.trim()+"&count="+cnt.textContent.trim();

        lastId.parentNode.removeChild(lastId)
        key.parentNode.removeChild(key)
        cnt.parentNode.removeChild(cnt)
        me.parentNode.removeChild(me);

        loader2();
        ajaxGetAndConcatenate(queryString,processorLink,container,"loadMoreMobileGoods");
    }

    function getGenDetailsGoods(tn, me) {
        var year = document.getElementById('searchYrVouchers').value.trim();
        
        var container = me.parentNode.children[1];
        var queryString = "?getGenDetailsGoods=1&tn="+tn+"&year="+year;

        if(me.innerHTML == '+&nbsp;SHOW MORE') {
            loader2();
            me.innerHTML = '&#x2212;&nbsp;SHOW LESS';
            // ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
            ajaxGetAndConcatenate(queryString,processorLink,container,"getGenDetailsGoods");
        }else {
			revealShowMore(container);
            container.innerHTML = '';
            me.innerHTML = '&#x2b;&nbsp;SHOW MORE';
        }
        
    }

</script>