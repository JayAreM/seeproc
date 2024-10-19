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
	
	
	.month{
		text-align:center;
		
		font-weight: bold;
		
		font-size: 10px;
		
		line-height: 14px;
		width:100%;
		border-bottom:1px solid rgb(58, 83, 62);
		background-color: rgba(102, 180, 33,.9);
	}
	
	#topTable{
		font-size:9px;
		border-spacing:0;
		
		width:100%;
		padding:0;
		margin-top:5px;
	}
	#topTable tr:nth-child(even){
		background-color: rgb(248, 250, 239); 
	}
	#topTable tr:nth-child(odd){
		background-color: rgb(238, 239, 237); 
	}
	#topTable tbody tr>td{
		border-bottom: 1px solid white;
		border-right: 1px solid white;
	}
	#topTable tbody tr:nth-child(n+3)> td:nth-child(1){
		background-color:rgb(189, 195, 182);
	}
	#topTable tbody tr:nth-child(n+3)> td{
		color:rgb(31, 61, 1);
	}
	#topTable tbody tr:nth-child(2) > td{
		border-right: 1px solid silver;
	}
	#topTable tbody tr:last-child > td{
		border-bottom: 1px solid silver;
	}
	
	#topTable tbody tr:hover{
		background-color:rgb(199, 252, 94);
	}
	#topTable tbody tr:hover td:nth-child(1){
		background-color:rgb(107, 155, 43);
	}
</style>
<html>
	<body>
		<div id = "vouchers"></div>
	</body>
</html>
<script>
	getTopList();
	function getTopList(){
		
		var queryString = "?getTopList=1";
		var container = document.getElementById('vouchers');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
	}
</script>
