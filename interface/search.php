 	<?php
	defined('ROOTER') ? NULL : define("ROOTER","../");
	include('../ajax/dataprocessor.php');
	require_once("../includes/database.php");
	require_once('../javascript/ajaxFunction.php');
	//require_once('../includes/loading.php');
	
?>
<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<table>
	<tr>
		<td><input id ='time' value =10/></td>
	</tr>
	<tr>
		<td><input id ='t' onkeypress ="save(event)" /></td>
	</tr>
	<tr>
		<td><div style="position: absolute;" id = "cont"></div></td>
	</tr>
	
</table>
<script>
	var ind = 0;
	var setter = 0;
	function save(event){
		
		var x = event.which || event.keyCode;
		if(x == 38){
			moveCurUp(cont);document.getElementById("in").value  = ind;
		}else if(x == 40){
			moveCurDown(cont);document.getElementById("in").value  = ind;
		}else if(x == 13){
			
			document.getElementById('t').value = decodeURIComponent(cont.children[ind-1].textContent); 
			cont.innerHTML  = '';
			ind = 0;
		}else{
			if(setter == 0){
				document.getElementById("time").value = 3;
				ind  = 0;
				setter = 1;
				saveThis();	
			}
		}	
	}
	function saveThis(){	
		var x = parseInt(document.getElementById("time").value);
		time =  x - 1;
		
		if(x > 0){	
			document.getElementById("time").value = time;
			setTimeout("saveThis()",100);
		}else{
			setter = 0;
			var s = t.value.trim();	
			if(s.length > 0){
				var queryString = "?searcher=1&text=" + s;
				var container = document.getElementById('cont');
				ajaxGetAndConcatenate(queryString,processorLink,container,"searcher");
				document.getElementById("time").value = 10;
			}else{
				 document.getElementById('cont').innerHTML = '';
			}
		}
	}
	function moveCurDown(parent){
		var len = parent.children.length;
		if(ind < len ){
			if(ind > 0){
				parent.children[ind].style.backgroundColor = "orange";
				parent.children[ind-1].style.backgroundColor = "white";
				
			}else{
				parent.children[ind].style.backgroundColor = "orange";
			}
			ind++;
		}
		
	}
	function moveCurUp(parent){
		if(ind > 1 ){
			ind--;
			parent.children[ind].style.backgroundColor = "white";
			parent.children[ind-1].style.backgroundColor = "orange";
				
		}
	}
</script>