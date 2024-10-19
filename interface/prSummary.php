
<style>
	#prSumMain{
		min-height:600px;	
		padding:20px;
		font-family: mainFont;
		width: 1060px;
	}

    .prSumViewTable{
        border-spacing:0px;
		background-color: white;
		//border: 1px solid lightgray;
		padding: 3px;
    }
    .prSumViewTable > thead > tr > th{
		letter-spacing: 1px;
		font-weight: bold;
		font-size: 14px;
		text-align:center;
		padding:0px 10px;
		background-color: rgb(199, 200, 205);
    }
    .prSumViewTable > thead > tr > th:first-child{
		text-align: left;
    }
	.prSumViewTable > thead > tr > th:last-child{
		background-color: rgb(224, 236, 240);
		border: 1px solid rgb(235, 235, 235);
    }
	.prSumViewTable > tbody > tr:hover{
		background-color:rgb(251, 244, 181);	
		color:black;
    }
	.clickedTr{
		background-color:rgb(251, 244, 181);	
		color:black;
	}
	.prSumViewTable > tbody > tr:last-child:hover{
		background-color:transparent;	
    }
	
    .prSumViewTable > tbody > tr > td{
        border-left: 1px solid rgb(235, 235, 235);
        border-bottom: 1px solid rgb(235, 235, 235);
        padding: 2px 3px;
        font-size: 14px;
		text-overflow:nowrap;
		white-space: nowrap;
    }
    .prSumViewTable > tbody > tr > td:first-child{
        font-weight: bold;
		padding: 0px 8px;
    }
	.prSumViewTable > tbody > tr > td:nth-child(4),.prSumViewTable > tbody > tr > td:nth-child(5){
		transition: .2s ease-in;
		background-color: white;
		font-size: 10px;
		letter-spacing: 1px;
	}
	.prSumViewTable > tbody > tr > td:nth-child(5){
        border-right: 1px solid rgb(235, 235, 235);
	}
	.prSumViewTable > tbody > tr > td:nth-child(4):hover,.prSumViewTable > tbody > tr > td:nth-child(5):hover{
		font-weight: bold;
 	}
	.clickedTd{
		font-weight: bold;
		/* color: rgb(16, 71, 126); */
		color:blue;
	}
    .prSumViewTable > tbody > tr > td:last-child{
        border-right: 1px solid rgb(235, 235, 235);
    }

    .prSumDetBtn{
        cursor: pointer;
		transition: .2s ease-in;
		display: block;
    }

	.prSumDetTable {
        border-spacing:0px;
		margin:0px auto;
		background-color: white;
		width: 100%;
		border: 1px solid lightgray;
		padding: 8px;
	}
	.prSumDetTable > thead > tr > th{
		letter-spacing: 1px;
		font-weight: bold;
		font-size: 14px;
		text-align:center;
		border-bottom: 1px solid rgba(0,0,0,1);
		/* border-bottom: 1px solid rgb(235, 235, 235); */
    }
	.prSumDetTable > thead > tr > th:first-child{
		border:0px;
		background-color: transparent;
	}
	.prSumDetTable > thead > tr > th:last-child{
		padding-right: 10px;
	}
    .prSumDetTable > thead > tr > th:nth-child(2){
		padding-left: 10px;
    }
    .prSumDetTable > tbody > tr > td{
        padding: 2px 3px;
		border-bottom: 1px solid rgb(235, 235, 235);
        font-size: 11px;
		text-overflow:nowrap;
		white-space: nowrap;
    }
	.prSumDetTable > tbody > tr:nth-child(even){
		background-color: rgb(252, 252, 251);
	}
	.prSumDetTable > tbody > tr > td:first-child{
		border:0px;
		background-color: white;
		width:10px;
		text-align: right;
		padding:0px 3px;
	}
    .prSumDetTable > tbody > tr > td:nth-child(2){
        font-weight: bold;
		padding-left: 10px;
    }
    .prSumDetTable > tbody > tr > td:nth-child(2), .prSumDetTable > tbody > tr > td:nth-child(3){
    }
    .prSumDetTable > tbody > tr > td:last-child{
		padding-right: 10px;
    }
	.prSumDetTable > tbody > tr:hover{
		background-color:rgb(251, 244, 181);	
		color:black
    }

	.searchThisPrSumDet{
		transition: .2s ease-in;
	}
	.searchThisPrSumDet > span{
		cursor: pointer;
		display: block;
	}
	.searchThisPrSumDet:hover{
		font-weight: bold;
	}
	.prSumHide{
		display: none;
	}

	.prSumLoadAddtl{
		border-bottom: 1px solid silver;
		border-right: 1px solid silver;
		background-color: rgb(230, 237, 241);
		text-align: center;
		display: inline-block;
		width: 30px;
		padding: 2px 3px;
		margin-left:5px;
		font-size: 12px;
		cursor: pointer;
		font-weight: bold;
		transition: all .5s;
	}
	.prSumLoadAddtl:hover{
		box-shadow:0px 0px 1px 0px silver;
		text-shadow:0px 0px 1px grey;
		background-color:rgb(216, 226, 231);
	}

	#prSumNumof{
		font-size: 10px;
		margin-left: 3px;
		color: orangered;
		font-weight: bold;
		letter-spacing: 1px;
		font-style: italic;
	}
    
</style>

<div  id = "prSumMain">
	<div id="prSumView"></div>
    <div id="prSumCont" style="padding:10px 10px 10px 5px;"></div>
</div>

<script>

    //---------- Start: PR Summary ----------//
	
	whenPrSummary();
	function whenPrSummary(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "PR Summary"){
				loadPrSummaryTotal();	
			}
		}
	}

    function loadPrSummaryTotal(){
        var container = document.getElementById('prSumView');

        var queryString = "?getPrSummaryTotal=1";

        loader();
        ajaxGetAndConcatenate(queryString, processorLink, container, "getPrSummaryTotal");
    }

    function getPrSumDet(me){
        var ctrlType = me.textContent.trim();
        var fund = me.parentNode.parentNode.children[0].textContent.trim();
        var container = document.getElementById('prSumCont');

		container.innerHTML = "";

		prSumDefLoadMore = 20;

        var queryString = "?getPrSumDet=1&ctrlType="+ctrlType+"&fund="+fund+"&defaultLoadMore="+prSumDefLoadMore;

        loader();
		removeAndChangeActiveOnClick(me);
        ajaxGetAndConcatenate(queryString, processorLink, container, "getPrSumDet");
    }

	function prSumDetUpdateRowTotalView(){
		var curClicked = document.getElementsByClassName('clickedTd');
		var tr = curClicked[0].parentNode;
		var tdTotalPr = tr.children[1].textContent.trim(); 

		var tdTotalDisplay = document.getElementById('prSumNumof');

		if(tdTotalDisplay){
			var table = document.getElementById('prSumDetTable');
			var tbody = table.children[1];
			var trS = tbody.getElementsByTagName('tr');

			var totalStr = "(" + trS.length + " of " + tdTotalPr + ")";

			tdTotalDisplay.innerHTML = totalStr;
		}
	}

	function removeAndChangeActiveOnClick(me){
		var curClicked = document.getElementsByClassName('clickedTd');

		if(curClicked.length > 0){
			curClicked[0].parentNode.classList.remove('clickedTr');
			curClicked[0].classList.remove('clickedTd');
		}
			
		me.parentNode.classList.add('clickedTd');
		me.parentNode.parentNode.classList.add('clickedTr');
	}

	function searchThisPrSumDet(me){
		
		searchThisPartner(me);
		document.getElementById("doctrackMenuContainer").children[0].click();
		
	}

	var prSumDefLoadMore = 10;
	function prSummaryLoadMore(me){
		var curLoadMore = parseInt(me.value);
		var trS =  document.getElementById('prSumDetTable').children[1].getElementsByTagName('tr');
		var fund = document.getElementById('prSumFundHeader').children[0].textContent.trim();
		var start = trS.length - 1;
		var lastTr = parseInt(trS[start].children[0].children[1].value);

		var container = document.getElementById('prSumDetTable');

		var queryString = "?getPrSumDetLoadMore=1&lastTr="+lastTr+"&addtl="+curLoadMore+"&fund="+fund;

		loader();
		ajaxGetAndConcatenate(queryString, processorLink, container, "getPrSumDetLoadMore");

	}

	function prSummaryLoadMore(me){
		var curLoadMore = parseInt(me.value);
		var trS =  document.getElementById('prSumDetTable').children[1].getElementsByTagName('tr');
		var fund = document.getElementById('prSumFundHeader').children[0].textContent.trim();
		var start = trS.length - 1;
		var lastTr = parseInt(trS[start].children[0].children[1].value);

		var container = document.getElementById('prSumDetTable');

		var queryString = "?getPrSumDetLoadMore=1&lastTr="+lastTr+"&addtl="+curLoadMore+"&fund="+fund;

		loader();
		ajaxGetAndConcatenate(queryString, processorLink, container, "getPrSumDetLoadMore");

	}

	function prSummaryLoadMore1(me){
		var curLoadMore = me.textContent.trim(); 

		if(curLoadMore != 'All'){
			curLoadMore = parseInt(curLoadMore);
		}

		var trS =  document.getElementById('prSumDetTable').children[1].getElementsByTagName('tr');
		var fund = document.getElementById('prSumFundHeader').children[0].textContent.trim();
		var start = trS.length - 1;
		var lastTr = parseInt(trS[start].children[0].children[1].value);

		var container = document.getElementById('prSumDetTable');

		var queryString = "?getPrSumDetLoadMore=1&lastTr="+lastTr+"&addtl="+curLoadMore+"&fund="+fund;

		loader();
		ajaxGetAndConcatenate(queryString, processorLink, container, "getPrSumDetLoadMore");

	}

	function prSumDetTableReNumber(){
		var trS =  document.getElementById('prSumDetTable').children[1].getElementsByTagName('tr');

		for (let i = 0; i < trS.length; i++) {
			var span = trS[i].children[0].children[0];
			span.innerHTML = (i+1);
		}		
	}

    //---------- End: PR Summary ----------//
</script> 