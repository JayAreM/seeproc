<style>
	.tdSchedHead{
		//padding:5px 20px;
		padding:0;
	}
	#scheduleMenuContainer{
		padding:0px 10px;
	
		background-color: rgb(224, 68, 128);
	}
	.scheduleMenu{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
	}
	.scheduleSelected{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;

		background-color: rgb(187, 4, 68);
		
		color:white;
	}
	.scheduleMenu:hover{

		background-color:rgb(133, 28, 68);
		color:white;
	}
	.number{
		font-style: italic;
		font-size:16px;
		padding-right: 10px;
		color:rgb(131, 11, 53);
		color:rgb(248, 0, 54);
	}
	.view{
		transition: background-color .1s ease-in;
		border-radius:2px;
		color:rgb(239, 70, 129);
		padding:0px 15px;
		cursor: pointer;
	}
	.view:hover{
		font-style: italic;
		background-color: grey;
		color:white;
	}
	.removeUpload{
		transition: background-color .1s ease-in;
		border-radius:2px;
		
		color:green;
		cursor: pointer;
		padding:0px 7px;
	}
	.removeUpload:hover{
		font-style: italic;
		background-color: grey;
		color:white;
	}
	.removeUploadHidden{
		display:none;
	}
	.subject{
		color:rgb(7, 109, 157);
		font-weight: bold;
	}
	.hoverThis:hover{
		background-color:rgb(253, 251, 182);	
	}
</style>

<table style = "height:800px;width:900px; border-spacing:0;" border = "0" >
	<tr  style = "height:20px">
		<td  class = "tdSchedHead">
			<div id ="scheduleMenuContainer" >
				<div id = "sched1" class ="scheduleSelected"  onclick="menuClickSchedule(this)">INVITATION TO BID</div>
				<div id = "sched2"  class ="scheduleMenu" onclick="menuClickSchedule(this)">ABSTRACT OF  BID</div>
				<div id = "sched3" class ="scheduleMenu"  onclick="menuClickSchedule(this)">MINUTES</div>
				<div id = "sched4"  class ="scheduleMenu" onclick="menuClickSchedule(this)">NOTICES</div>
				<div id = "sched5"  class ="scheduleMenu" onclick="menuClickSchedule(this)">REPORTS</div>
			</div>
			
		</td>
		
	</tr>
	<tr>
		<td  style = "vertical-align: top;">
			<div id  = "scheduleMainContainer" style = "">
				
				
			</div>
			
		</td>
	</tr>
</table>

<script>
	document.getElementById("sched1").click();
	function menuClickSchedule(me){
		menuChanger(me,"scheduleSelected","lastMainSchedule","scheduleMainContainer","");
		var record =  me.textContent;;
		var queryString = "?getRecordBac=1&record=" + record;
		var container = document.getElementById("scheduleMainContainer");
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	function show(me){
		window.open(me.id, '_blank');
	}
	function removeThis(me){
		var  split = me.id.split("~!~");
		var id = split[0];
		var filename =split[1];
		var subject  = me.parentNode.parentNode.children[1].textContent.trim() ;
		
		var answer = confirm("Remove \"" + subject  + "\"?");
		if(answer){
			var parent = me.parentNode.parentNode.parentNode;
			var tr =  me.parentNode.parentNode;
			
			parent.removeChild(tr);
			
			var queryString = "?removeUploaded=1&id=" + id + "&filename=" + filename ;
			var container = "";
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"removeUpload");
		}	
	}
</script>