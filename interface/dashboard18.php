<?php
	require_once('../javascript/ajaxFunction.php');
	require_once('../includes/database.php');
?>

<style>
	#tableSummary{
		margin:20px;
		margin:0 auto;
		
		font-family: Arial;
		font-size: 12px;
		border-spacing:0;
		border:1px solid grey;
		
	}
	#tableSummary tr:nth-child(even){
		background-color: rgb(228, 231, 232); 
	}
	

	.tableDetails{
		border-spacing:0;
		font-size: 10px;
		margin:0 auto;
		line-height: 18px;
		width:100%;
		
	}
	
	.month{
		text-align:center;
		width:60px;
		font-weight: bold;
		margin:0 auto;
		font-size: 10px;
		padding:0px 10px;
		
		
		line-height: 14px;
	}
	.bar{
		width: 20px;
		background-color: rgb(69, 142, 194);
		margin:0 auto;
		border-top:1px solid black;
	}
</style>
<html>
	<body>
		<div id = "vouchers"></div>
	</body>
</html>
<script>
	getVouchers();
	function getVouchers(){
		
		var queryString = "?getVouchersTime=1";
		var container = document.getElementById('vouchers');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
	}
	function showTransactionsEngagements(me){
		var month = (me.textContent.trim());
		var type = me.id;
		window.open('../../../citydoc2023/interface/dashboardDetails.php?m=' + month + '&t=' + type , '_new');
	}
</script>
