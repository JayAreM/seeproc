<?php
	
?>
<style>
	#docSet{
		width:900px;
		height:600px;
		padding:20px;
	}
</style>

<div  id = "docSet">
	<table>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">1. Accountant's Advice Management</span></td>
			<td><span class = "label13" onclick = "gotoAdvice()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">2. LINGAP Management</span></td>
			<td><span class = "label13" onclick = "gotoLingap()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">3. Infrastructure Management</span></td>
			<td><span class = "label13" onclick = "gotoInfra()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">4. Salary Release Report</span></td>
			<td><span class = "label13" onclick = "gotoSalaryRelease()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">5. BAC Posting</span></td>
			<td><span class = "label13" onclick = "gotoBACPosting()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">6. Public Search</span></td>
			<td><span class = "label13" onclick = "gotoPublicSearch()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">7. Releaser's List</span></td>
			<td><span class = "label13" onclick = "gotoReleaser()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">8. Receiver's Gate</span></td>
			<td><span class = "label13" onclick = "gotoReceiver()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">9. Taxifier</span></td>
			<td><span class = "label13" onclick = "gotoTaxifier()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">10. Supplier Registry</span></td>
			<td><span class = "label13" onclick = "gotoSure()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">11. The Lightbill</span></td>
			<td><span class = "label13" onclick = "gotoLight()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">12. The Blue Note</span></td>
			<td><span class = "label13" onclick = "gotoNote()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">13. Bill, Bill, Bill</span></td>
			<td><span class = "label13" onclick = "gotoBill()">Click here</span></td>
		</tr>
		<tr>
			<td><span class = "label11" style = "font-size:16px;">14. My Master</span></td>
			<td><span class = "label13" onclick = "gotoMaster()">Click here</span></td>
		</tr>
	</table>
</div>
<script>
	function gotoAdvice(){
		//window.open('../interface/doctrackAdvice.php');
		window.open('../../adviser/interface/main.php');
	}
	function gotoLingap(){
		window.open('../interface/doctrackLingap.php');
	}
	function gotoInfra(){
		window.open('../interface/infrastructure.php');
	}
	function gotoSalaryRelease(){
		window.open('../interface/formreleasereport.php');
	}
	function gotoBACPosting(){
		//window.open('../../citydoc2017/interface/InvitationToBid.php');
		window.open('/baxia/interface/main.php');	
	}
	function gotoPublicSearch(){
		window.open('../interface/doctrackPublicSearch.php');
	}
	function gotoAdviser(){
		window.open('../interface/mainAdvice.php');
	}
	function gotoReleaser(){
		window.open('../interface/doctrackTransmitalPage.php');
	}
	function gotoReceiver(){
		window.open('../interface/doctrackReceiver.php');
	}
	function gotoTaxifier(){
		window.open('../../Taxifier/interface/main.php');
	}
	function gotoSure(){
		window.open('../../sure/interface/main.php');
	}
	function gotoLight(){
		window.open('../../lighter/interface/main.php');
	}
	function gotoNote(){
		window.open('../../bluenote/interface/main.php');
	}
	function gotoBill(){
		window.open('../../bills/interface/main.php');
	}
	function gotoMaster(){
		window.open('../interface/mymaster.php');
	}
</script> 