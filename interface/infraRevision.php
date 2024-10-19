<style>
    
</style>
<div style="padding:20px; background-color:white; display:inline-block; margin:10px; font-size:0px;">
    <div id="infraUpContainer" style="padding:40px; min-height:500px;width:700px;">
        <table id="" border="0" cellpadding="0" cellspacing="0" style= "width: 100%;">
            <tr>    
                <td style="text-align:right;">
                    <span style="margin-right:8px;font-family:oswald;">Search Infra TN</span>
                    <input id="" maxlength="9" class="text3" 
                    	style="width:150px; font-weight: bold; padding:2px 5px; font-size: 22px; text-align:center; text-transform:uppercase;"
                    	value =""
                    	 onkeydown="keypressAndWhat1(this,event,fetchRevisionInfra,1)" type="text">
                </td>
            </tr>
            <tr>
            	<td id = "containerRevision" style ="padding-top:20px;width:700px;">
            		
            	</td>
            </tr>
            <tr>
                <td style ="">
                    <table  style="padding-top:10px;;margin:0px auto;margin-top: 20px;border-spacing:0px 2px;border-top:1px solid silver;">
                        <tr>
                            <td  style="width:100%;text-align:right;">
                                <span style="labelProject" >Adjustment Type</span><span class="labelProjectNumber">1</span>
                            </td>
                            <td>
                                <select  id="inputRevisionType" class="inputProject" style="width:150px;text-align: center;" onchange="computeRevision()"> 
                                	<option></option>
                               		<option>Variation</option>
                               		<option>Unperformed</option>
                               </select>
                            </td>
                            <td rowspan="2" style="vertical-align: middle; padding:0px 10px;padding-left:30px;">
                            	<div class="button1" style="margin:0 auto;font-size: 16px; padding:5px;" onclick="saveInfraRevision()">Save</div>
                            </td>
                        </tr>
                        <tr>
                            <td style ="text-align:right;">
                                <span style="labelProject">Amount</span><span class="labelProjectNumber">2</span>
                            </td>
                            <td >
                               <input id="inputRevisionAmount" class="inputProject" style="width:150px;text-align:center; " maxlength="13" onkeydown="return isAmount(this,event)" onkeyup="computeRevision()">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

<script>
	//test();
	function test(){
		var tn = '4411-1478';
		var queryString = "?fetchInfraRevision=1"
							+ "&tn=" + tn;			
		var container = document.getElementById('containerRevision');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
	}
	function fetchRevisionInfra(me,evt){
		var tn = me.value.trim();
		var queryString = "?fetchInfraRevision=1"
							+ "&tn="   + tn;			
		var container = document.getElementById('containerRevision');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
	}
	function computeRevision(){
		var amount = inputRevisionAmount.value.replace(/[\, ]/g,'');
		inputRevisionAmount.value = numberWithCommas(amount);
		var actual = infraRevisionActual.textContent.replace(/[\, ]/g,'');
		var type = inputRevisionType.value;
		
		if(amount> 0){
			if(type == "Variation"){
				var adjustment = (parseFloat(amount) + parseFloat(actual)).toFixed(2);
			}else{
				var adjustment = (parseFloat(actual) - parseFloat(amount)).toFixed(2);
			}
			infraRevisionType.textContent = type;
			infraRevisionAmount.textContent = numberWithCommas(amount);
			infraRevisionAdjusted.textContent = numberWithCommas(adjustment);
		}else{
			infraRevisionAdjusted.textContent = '';
			infraRevisionAmount.textContent = '';
		}
		if(type.length == 0){
			infraRevisionAmount.textContent = '';
			infraRevisionType.textContent = '';
			infraRevisionAdjusted.textContent = '';
			infraRevisionAmount.textContent = '';
		}
	}
	function saveInfraRevision(){
		if(document.getElementById("infraRevisionTN")){
			var tn = infraRevisionTN.textContent;
			var type = infraRevisionType.textContent;
			var amount = infraRevisionAmount.textContent.replace(/[\, ]/g,'');
			var adjusted = infraRevisionAdjusted.textContent.replace(/[\, ]/g,'');
			if(amount.length > 0 && amount > 0){
				var queryString = "?saveRevision=1"
								+ "&tn="   + tn
								+ "&type=" + type
								+ "&amount="   + amount
								+ "&adjusted="   + adjusted;			
			
				var container = document.getElementById('containerRevision');
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
				inputRevisionAmount.value ='';
				selectToIndexZero("inputRevisionType");
			}else{
				alert("Please input the required information.");
			}
		}else{
			alert("Please select project tracking number.");
		}
	}
</script>






