<style>

.inputSearch {
    width: 100%;
    font-weight: bold;
    font-family: NOR;
    padding: 5px 2px;
    font-size: 16px;
    text-align: center;
    border-top: 2px solid silver;
    border-left: 2px solid silver;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 5px;
}

#invSearchBar::placeholder {
    text-transform:none;
    font-size:14px;
}

.viewerTd {
    padding: 2px 10px;
    padding-left: 5px;
    font-family: NOR;
    border-bottom: 1px solid silver;
    /* background-color: rgb(239, 238, 206); */
    background-color: white;
    font-size: 14px;
}

.fieldLabel {
    text-align: right;
    font-size: 14px;
    font-family: NOR;
    white-space: nowrap;
}

.floatingClose {
    font-size: 16px;
    float: right;
    color: white;
    cursor: pointer;
}
.floatingClose:hover{
    text-shadow: 0px 0px 10px rgb(255, 0, 0);
}

.rowOnHover{
    transition: .3s all ease-in;
    cursor: pointer;
}
.rowOnHover:hover > td{
    background-color: rgb(233, 234, 206);
}

.summaryListInv tr:nth-child(even) > td{
    background-color:rgba(0,0,0,.1);
}

.summaryRow{
    transition: .3s all ease-in;
    cursor: pointer;
}
.summaryRow:hover{
    /* background-color: rgb(233, 234, 206); */
    background-color:orange;
}

.summaryRowSelected {
    /* background-color: rgb(233, 234, 206); */
    background-color:orange;
}
</style>

<div style="font-family:NOR; font-size:24px; min-width:100%; text-align:left; letter-spacing:1px;">
    <table border="0" cellspacing="0" cellpadding="0" style="margin:0px auto; width:100%; min-height:590px;">
        <tr>
            <td id="invViewerContainer" style="padding:0px; vertical-align:top;"></td>
            <td style="width:0px; padding:0px; vertical-align:top;">
                <div style="background-color:rgb(155, 111, 84); color:white; font-weight:bold; text-align:center; padding:6.5px 5px;">Search Panel</div>
                <div style="padding:5px 5px 5px 5px;">
                    <div style="background-color:rgb(233, 232, 232); padding:8px; width:300px;">
                        <div style="font-size:14px; padding: 0px 0px 2px 2px;">Select Office</div>
                        <select id="invOfficeSelect" style="font-size:14px; font-family:NOR; height:30px; width:100%; margin-bottom:8px;" onchange="loadInvCategoriesView()"></select>
                        
                        <input type="text" class="inputSearch" id="invSearchBar" style="margin-bottom:8px;" onkeyup="keypressAndWhat1(this, event, inventorySearchByKey, 'invViewerContainer')" value="" placeholder="Search Keyword">
                        <table border="0" cellspacing="0" cellpadding="0" style="width:100%; font-size:12px; background-color:rgb(254, 254, 253); padding:8px;">
                            <tr>
                                <td colspan="2" style="padding:0px; border-bottom:1px solid silver; font-size:14px;">Direct Search Keyword</td>
                            </tr>
                            <tr>
                                <td style="width:0px; padding:0px;">1.</td><td style="padding:0px; padding-left:5px;">Tracking Number</td>
                            </tr>
                            <tr>
                                <td style="width:0px; padding:0px;">2.</td><td style="padding:0px; padding-left:5px;">Item Description</td>
                            </tr>
                            <tr>
                                <td style="width:0px; padding:0px;">3.</td><td style="padding:0px; padding-left:5px;">Property Number</td>
                            </tr>
                            <tr>
                                <td style="width:0px; padding:0px;">4.</td><td style="padding:0px; padding-left:5px;">Sticker Number</td>
                            </tr>
                            <tr>
                                <td style="width:0px; padding:0px;">5.</td><td style="padding:0px; padding-left:5px;">Employee Number</td>
                            </tr>
                            <tr>
                                <td style="width:0px; padding:0px;">6.</td><td style="padding:0px; padding-left:5px;">Assigned to</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:5px 0px;"></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding:0px; border-bottom:1px solid silver; font-size:14px;">Special Character plus Keyword</td>
                            </tr>
                            <tr>
                                <td style="width:0px; padding:0px;">1.</td><td style="padding:0px; padding-left:5px;">✱ and Keyword for Brand Name</td>
                            </tr>
                            <tr>
                                <td style="width:0px; padding:0px;">2.</td><td style="padding:0px; padding-left:5px;">\    and Employee Number for Current User</td>
                            </tr>
                            <tr>
                                <td style="width:0px; padding:0px;">3.</td><td style="padding:0px; padding-left:5px;">~   and Name for Current User</td>
                            </tr>
                            <tr>
                                <td style="width:0px; padding:0px;">4.</td><td style="padding:0px; padding-left:5px;">/   and Numbers for Serial Number</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div style='border-bottom:1px solid black; font-weight:bold; padding:6.5px 5px;'>Summary of Items</div>
                <div id="invSummaryListCat" style=""></div>
            </td>
        </tr>
    </table>

</div>

<script>
    function inventorySearchByKey(me, field){
		var container = document.getElementById(field);
		if (me.value.length > 1) {
            var office = document.getElementById('invOfficeSelect').value.trim();
			var queryString = "?inventorySearchByKey=1&key=" + me.value + "&office=" + office;
			// loader();
			ajaxGetAndConcatenate(queryString, processorLink, container, 'returnOnly');
			// ajaxGetAndConcatenate(queryString, processorLink, container, 'returnOnlyLoader');
		} else {
			alert("Please type more than 1 character.");
		}
	}

    function invLoadOffices() {
        var container = document.getElementById('invOfficeSelect');
        var queryString = "?invLoadOffices=1";
        
        ajaxGetAndConcatenate(queryString, processorLink, container, "invLoadOffices");
    }

    function invLoadCategory(){
        var office = document.getElementById('invOfficeSelect').value.trim();

		var queryString = "?invLoadCategoryViewer=1&office=" + office;
		var container = document.getElementById('invCategory');
		ajaxGetAndConcatenate(queryString, processorLink, container, 'returnOnly');
	}

    function invSearchByParams(){
        var year = document.getElementById('invYear').value;
        var classification = document.getElementById('invClassification').value;
        var category = document.getElementById('invCategory').value;
        var item = document.getElementById('invItem').value;
        var brand = document.getElementById('invBrand').value;
        var office = document.getElementById('invOfficeSelect').value.trim();

        var queryString = "?invSearchByParams=1&Year="+year+"&Item="+item+"&Brand="+brand+"&classification=" + classification + "&category=" + category + "&office=" + office;
        
        var container = document.getElementById('invViewerContainer');
        loader();
        ajaxGetAndConcatenate(queryString, processorLink, container, "returnOnlyLoader");
    }

    function invLoadItemsByCategory(me){
		var cat = me.value;
		var container = document.getElementById('invItem');
		if(cat.length > 2){
            var office = document.getElementById('invOfficeSelect').value.trim();
			var queryString = "?invLoadItemsByCategory=1&category=" + cat + "&office=" + office;
			ajaxGetAndConcatenate(queryString, processorLink, container, 'returnOnly');
		}else{
			container.innerHTML = '<option></option>';  
			document.getElementById('invBrand').innerHTML = '<option></option>';
		}
	}

    function invLoadBrand(me){
		var itemId = me.value;
		
		var container = document.getElementById('invBrand');
		if(itemId.length > 0){
            var office = document.getElementById('invOfficeSelect').value.trim();
			var queryString = "?invLoadBrand=1&itemId=" + itemId + "&office=" + office;
			ajaxGetAndConcatenate(queryString, processorLink, container, 'returnOnly');
		}else{
			container.innerHTML = '<option></option>';
		}	
	}

    // function invGetSingleItem(row, year, tn, evt){
    //     if (evt.target.tagName === "TD") {
    //         var queryString = "?invGetSingleItem=1&row="+row+"&year="+year+"&tn="+tn;
    //         var container = document.getElementById('invViewerContainer');
            
    //         loader();
    //         ajaxGetAndConcatenate(queryString, processorLink, container, "invGetSingleItem");
    //     }
	// }

    function msg4(message){
		var sheet = "<div style='background-color: white; display: inline-block; font-family: Vegur; padding: 5px;'>"
				  +  	"<div style='text-align: left; padding: 5px 10px;background-image: linear-gradient(to  left, rgb(90, 105, 23) , rgba(157, 183, 12,.8));font-family:roboto;'>"
				  +			"&#9744; <span style = 'font-weight:bold;letter-spacing:1px;'> Viewer</span><span style = 'font-family:Oswald;color:white;font-weight:normal;letter-spacing:2px;font-size:12px;padding-left:10px;'>TRANSACTION INFORMATION</span>	 <span id='editorX' class='floatingClose' onclick='closeAbsolute(this)'>&#10006;</span>"
				  +		"</div>"
				  +  	message
				  + "</div>";
		theAbsolute(sheet);
	}

    function previewMyAre(me,evt){
		var employeeNumber = me.id;
		window.open('../interface/formItemSummary.php?emp=' + employeeNumber);
	}

    function loadInvCategoriesView() {
        var office = document.getElementById('invOfficeSelect').value.trim();
        var queryString = "?loadInvCategoriesView=1&office="+office;
        var container = document.getElementById('invSummaryListCat');

        var itemContainer = document.getElementById('invViewerContainer');
        itemContainer.innerHTML = "";

        loader();
        ajaxGetAndConcatenate(queryString, processorLink, container, "returnOnlyLoader");
    }

    function getThisInvCatItems(category, me) {
        var office = document.getElementById('invOfficeSelect').value.trim();
        var queryString = "?getThisInvCatItems=1&office="+office+"&category="+category;
        var container = document.getElementById('invViewerContainer');

        for (var i = 0; i < me.parentNode.children.length; i++) {
            me.parentNode.children[i].classList.remove('summaryRowSelected');            
        }
        me.classList.add('summaryRowSelected');
        
        loader();
        ajaxGetAndConcatenate(queryString, processorLink, container, "returnOnlyLoader");
    }

    function invGetSingleItemNew(row, year, tn) {
        window.open('../interface/formInvSingleItem.php?row=' + row + '&year=' + year + '&tn=' + tn);
    }
</script>