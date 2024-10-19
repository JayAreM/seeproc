<style>
	.tableContent{
		
		background-color:white;
		width:850px;
		height:100%;
		margin:0px auto; 
		
		padding:0px 30px;
		padding-bottom:15px;
	}
	.tdContent{
		background-color:rgba(6, 44, 66,.02);
		background-color:white;
		box-shadow:0px 0px 10px 1px grey;
	}
	//#obrAllTable tr:nth-child(even) {background: rgb(233, 242, 246)}
	.OBRrow:hover{
		background-color:rgb(170, 183, 187);
		font-weight:bold;
		color:white;
		text-shadow:0px 0px 2px  black;
		padding:10px 8px;
	}
</style>
<table class = "tableContent" >
	<tr>
		<td class="tdHeader"><div class = "divHeader1">OBR&nbsp;Tracker</div></td>
	</tr>
	
	
	<tr>
		<td class="tdContent" style="padding:20px;padding-top:35px;" id = "tdContentList">
			<table style = "margin:0 auto;">
				<tr>
					<td style = "text-align:right;width:50%;padding-right:40px;">
						<input type="radio" name="selectType4" id="optOBR1" class="radio" onclick = "loadAllOBRs()" />
						<label  for="optOBR1">OBR List</label></td>
					<td style = "padding-left:10px;width:200px;">
						<input type="radio" name="selectType4" id="optOBR2" class="radio" onclick = "loadOthers()" />
						<label  for="optOBR2">Instruction sa obr list.. .</label></td>
					</td>
					
				</tr>
				<tr>
					<td id = "tdOBRcontainer" style = "padding-top:15px;height:450px;" colspan="2">
					    
					</td>
					
				</tr>
			</table>
			
		</td>
	</tr>
</table>
<script>
	
	
	function loadAllOBRs(){
		var queryString = "?loadAllOBRs=1";
		var container = document.getElementById('tdOBRcontainer');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadAllOBRs");
	}
	function loadOthers(){
		var container = document.getElementById('tdOBRcontainer');
		msgs = "pag naa ka i change sa OBR number i double click lng ang OBRnumber sa obr list then mag appear ang editor.";
		container.innerHTML = "<div style = text-align:center;>" + msgs +  "<br/><br/><br/>...ongoing pa ni diri na side</br><br/>-val-</div>";
	}
	function changeOBRno(me){
		
		var splits = me.id.split("~");
	    var trackingNumber = splits[0];
		var obrOld = splits[1];
		editor("OBR_Number",trackingNumber,obrOld,1);
	}
	
	
</script>