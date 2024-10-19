<?php
	if(!isset($_SESSION['employeeNumber'])){
		$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
		echo $link;
	}else{
		$acct = $_SESSION['employeeNumber'];
		$acctType = $_SESSION['accountType'];
		$office = $_SESSION['officeCode'];
		if($_SESSION['accountType'] >= 1){
			
		}else{
			$link = "<script>window.open('doctrackpublicsearch.php','_self')</script>";
			echo $link;
		}
	}
?>
<style>
	#retentionSet{
		width:1100px;
		min-height:600px;	
		padding:5px;
		font-family: Oswald;
	}
	.trHead{
		border-bottom: 1px dashed grey;
		border-top: 1px solid #AEB5B6;
		letter-spacing: 1px;
		font-weight: bold;
		font-size:12px;
		text-align:center;
		padding:5px 10px;
	}
	
	.tdDataBalance{
		padding:5px 10px;
		font-size:13px;
		border-bottom:1px solid silver;
		border-right:1px solid silver;
		cursor: pointer;
		vertical-align: top;
		
		text-overflow:nowrap;
		white-space: nowrap;

	}
	
	.trData:hover > td{
		background-color:rgb(251, 244, 181);	
		color:black
	}
	
	.hoverLabel{
		color:green;
	}
	.hoverLabel:hover{
		color:white;
		text-shadow: 0px 0px 1px black;
	}
	.hoverPrint{
		font-size:28px;
		font-weight:bold;
	}
	.hoverPrint:hover{
		color:green;
		text-shadow: 0px 0px 1px orange;
		cursor: pointer;
		
	}
</style>

<div id="retentionSet">
	<table border="0" style="margin:0px auto; width:100%; border-spacing:0px;">
		<tr>
			<td style="width:250px;text-align:right;background-color:rgb(211, 221, 226);padding:7px;padding-right:13px;">
				<input type='hidden' id='officeRetention' value='<?= $office ?>'>
				Search Name&nbsp;&nbsp;<input onkeydown="keypressAndWhatClear(this,event,searchRetentionBySupplier,1)" maxlength = "15" id="searchRetName" style="font-size:16px;font-family:Oswald;letter-spacing:1px;background-color:rgb(242, 243, 243); padding:7px 5px;border:0;border-left:1px solid silver;border-top:1px solid silver;text-align: center;font-weight: bold;width:150px;" />
			</td>
		</tr>
		<tr>
			<td>
				<div id="containerRetention"></div>
			</td>
		</tr>
	</table>
</div>

<script>
whenRetention();
function whenRetention(){
	var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
	if(cookieMainText == "Document Tracking"){
		var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
		if(cookieText == "Retention"){
			loadRetentionOffice();
			loadRetention();
		}
	}
}
function searchRetentionBySupplier(me) {
    var office = document.getElementById("officeRetention").value;
    
    var name = me.value;
    var queryString = "?searchRetentionBySupplier=1&name=" + name + "&office=" + office;
    var container = document.getElementById('containerRetention');
    loader();
    ajaxGetAndConcatenate(queryString,processorLink,container,"searchRetentionBySupplier");
}
function loadRetentionOffice(){
	var input = document.getElementById('officeRetention');
	if(input.tagName == "SELECT"){
		var container = document.getElementById('officeRetention');
        var queryString = "?loadRetentionOffice=1&office=" + 1081;
        loader();
        ajaxGetAndConcatenate(queryString,processorLink,container,"loadRetentionOffice");
	}
}
function loadRetention(){
    var office = document.getElementById('officeRetention').value;

	if(office != ""){
		var container = document.getElementById('containerRetention');
    	var queryString = "?loadRetention=1&office=" + office;
    
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadRetention");
	}
}
function searchRetentionTNPartners(me){
	// var trackingNumber = me.textContent.trim();
	var trackingNumber = me;
	var queryString = "?searchPOTrackingPartnerRET=1&trackingNumber="+trackingNumber;
	var container = document.getElementById('containerRetention');

	loader();
	ajaxGetAndConcatenate(queryString,processorLink,container,"searchPOTrackingPartnerRET");
}
function changeFetchRET(me){
	var office = me.value;
	var container = document.getElementById('containerRetention');
    var queryString = "?loadRetention=1&office=" + office;
    
    loader();
    ajaxGetAndConcatenate(queryString,processorLink,container,"loadRetention");
}
function searchThisRetention(me){
	searchThisPartnerRetention(me);
	var type = "<?php echo $acctType;?>";
	
	if(type == 1){
		document.getElementById("doctrackMenuContainer").children[1].click();
	}else{
		document.getElementById("doctrackMenuContainer").children[0].click();
	}
	
	var me = me.parentNode;
	highlightBalance(me,"rgb(219, 221, 221)");
}
function searchThisPartnerRetention(me){
	var trackingNumber  = me.textContent;
	var queryString = "?searchTrackingNumberPartner=1&trackingNumber=" + trackingNumber;
	document.getElementById('ok').value = trackingNumber;
	var container = document.getElementById('doctrackUpdateContainer');
	loader();
	ajaxGetAndConcatenate(queryString,processorLink,container,"searchTrackingNumber");
}
function previewRetTrans(){
	var office = document.getElementById('officeRetention').value;
	var name = document.getElementById('searchRetName').value;

	var queryString = "?off="+office+"&name="+name;
	window.open("../interface/formRetTrans.php"+queryString);
}
</script>