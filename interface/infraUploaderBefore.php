<style>
    #infraUpContainer{
		background-color:white;
		display:inline-block;
		margin:0 auto;
		box-shadow:0px 0px 4px 1px grey;
		box-shadow:0px 0px 16px 3px grey;
        font-family:NOR;
	}

    #infraUpInputTable {
        font-family:NOR;
    }

    #infraUpInputTable > tbody > tr > td:first-child {
        white-space:nowrap;
        vertical-align:top;
        width:100px;
        text-align:right;
        padding-top:3px;
    }

    .numberFieldUp {
        font-size:16px;
        letter-spacing:1px;
    }

    .numbInfraUp {
        font-size:18px;
        padding:0px 12px 0px 5px;
        font-weight:bold;
    }

    .fileItemUp {
        font-weight:normal;
        display:block;
        font-size:16px;
        font-family:NOR;
    }
    
    #progressHistory td{
		border-bottom: 1px solid rgb(216, 219, 221);
		padding:0px 5px;
	}
	#progressHistory  tr:last-child td {
		border:0;
	}
	#progressHistory  tr:nth-child(even) td {
		background-color: rgb(246, 250, 250);
	}
	
	#progressHistory  tr:hover td {
		background-color:rgb(252, 244, 196);
	}
	#progressHistory th{
		background-color:rgb(241, 242, 242);
		padding:5px;
		
	}
</style>
	<div style="padding:20px; background-color:white; display:inline-block; margin:10px; font-size:0px;">
	    <div id="infraUpContainer" style="padding:40px; min-height:500px;min-width: 700px;">
	        <table id="" border="0" style ="width:100%;">
	            <tr>    
	                <td style="text-align:right;">
	                    <span style="margin-right:8px;font-family:oswald;">Search Infra TN</span>
	                    <input id="infraUpSearchBar" maxlength="9" class="text3" style="width:150px; font-weight: bold; padding:2px 5px; font-size: 22px; text-align:center; text-transform:uppercase;" 
	                    		onkeydown="keypressAndWhatClear(this,event,fetchINTNDetailsForInfraUp,1)" type="text">
	                </td>
	            </tr>
	             <tr>    
	                <td style="padding-top:20px;width:700px;" id ="uploadInfraContainer">
	                    
	                </td>
	            </tr>
	            <tr>
	                <td style ="padding-top:10px;">
	                    <table id="infraUpInputTable" border="0"  style="margin:0px auto;border-top:1px dashed rgb(131, 142, 147);padding-top:15px;width:100%;border-spacing:0px; ">
	                        <tr>
	                            <td style="">
	                                <span class="numberFieldUp">Progress</span><span class="numbInfraUp">1</span>
	                            </td>
	                            <td>
	                                <input id="infraUpProgress" class="inputProject" style="width:70px; text-align:center;" maxlength="6" onkeydown="return isAmount(this,event)">
	                            </td>
	                        </tr>
	                        <tr>
	                            <td style="">
	                                <span class="numberFieldUp">Details</span><span class="numbInfraUp">2</span>
	                            </td>
	                            <td>
	                                <textarea id="infraUpDetails" class="inputProject" style="color:black; padding:3px 6px; width:100%;font-weight: normal;"></textarea>
	                            </td>
	                        </tr>
	                        <tr>
	                            <td style="">
	                                <span class="numberFieldUp">Upload Pictures</span><span class="numbInfraUp">3</span>
	                            </td>
	                            <td style="vertical-align:bottom;padding-top:5px;">
	                                <label for="infraUpFile" id="infraUpFileLabel" class="inputProject" style=" border:0px; ">Browse file</label>
	                                <input type="file" id="infraUpFile" style="display:none;" onchange="infraUpUpdateFileLabel(this)" multiple>
	                            </td>
	                        </tr>
	                        <tr>
								<td style="">
								    <span class="numberFieldUp">Video Link</span><span class="numbInfraUp">4</span>
								</td>
								<td>
								    <input id="infraVideoLink" class="inputProject" style="" maxlength="50" >
								</td>
							</tr>
	                        <tr>
	                            <td></td>
	                            <td style ="padding-top:20px;">
	                                <div class="button1" style="margin:0 auto;font-size: 16px; padding:5px;" onclick="saveInfraUploadPart1()">Save</div>
	                            </td>
	                        </tr>
							
	                    </table>
	                </td>
	            </tr>
	        </table>
	    </div>
	</div>

<script>
    function fetchINTNDetailsForInfraUp(me) {
		if(me.value != ""){
			var temp = me.value.split('*');
			var tn = temp[0];
			var office = temp[1];
			var queryString = "?fetchINTNDetailsForInfraUp=1"
							+ "&tn="   + tn
							+ "&office="   + office;
			var container = document.getElementById("uploadInfraContainer");
			loader();
			//ajaxGetAndConcatenate(queryString,processorLink,container,"fetchINTNDetailsForInfraUp");	
			ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");	
		}
	}

    function infraUpUpdateFileLabel(me) {
		var files = me.files;
        var label = document.getElementById('infraUpFileLabel');
        if(files.length > 0) {
            var labelText = "Selected File";
            if(files.length > 1) {
                labelText += "s";
            }
            labelText += " :";
            for(var i = 0; i < files.length; i++) {
                labelText += "<span class='fileItemUp'>&#8226;&nbsp;&nbsp;"+files[i].name+"</span>";
            }
            label.innerHTML = labelText;
        }else {
            label.innerHTML = "Browse file/s";
        }
    }

	function saveInfraUploadPart2(series) {
		var tn = document.getElementById('infraUpSelectTN').textContent.trim();
		var progress = document.getElementById('infraUpProgress').value;
		var details = document.getElementById('infraUpDetails').value;
		var uploads = document.getElementById('infraUpFile').files;
		var video = document.getElementById('infraVideoLink').value.trim();
		


		var queryString = "?saveInfraUploadDetails=1"
							+ "&tn=" + tn
							+ "&progress=" + progress
							+ "&details=" + details
							+ "&files=" + uploads.length
							+ "&series=" + series
							+ "&video=" + video;
		var container = document.getElementById("uploadInfraContainer");
		
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"saveInfraUploadDetails");

    }

	function saveInfraUploadPart1() {
		if(document.getElementById('infraUpSelectTN') != undefined) {
			var tn = document.getElementById('infraUpSelectTN').textContent.trim();
			var details = document.getElementById('infraUpDetails').value;
			var progress = document.getElementById('infraUpProgress').value;
			var curProgress = document.getElementById('infraUpCurProgress').textContent.replace('%', '').trim();
			var uploads = document.getElementById('infraUpFile').files;

			if(uploads.length > 0) {
				var err = 0;
				for(var i = 0; i < uploads.length; i++) {
					err = fileCheckJS(uploads[i], "pdf,xls,xlsx,doc,docx,jpeg,jpg,png");
				}

				if(tn.length == 0) {
					err = 2;
				}else if(progress <= 0 || progress == ""){
					err = 3;
				}else if(details.length <= 0) {
					err = 4;
				}else if(parseFloat(progress) <= parseFloat(curProgress)){
					err = 5;
				}

				if(err == 0) {
					var formData = new FormData();
					formData.append("saveInfraUpload", 1);
					formData.append("trackingNumber", tn);
					formData.append("year", year);
					formData.append("numOfFiles", uploads.length);
					formData.append("progress", progress);
					var angFile = "";
					var numOfThisFile = 0;
					var fileSeries = "";
					for(var i = 0; i < uploads.length; i++) {
						var angFile = uploads[i];
						var numOfThisFile = (i+1);
						formData.append("angFile", angFile);
						formData.append("numOfThisFile", numOfThisFile);
						ajaxFormUpload(formData,uploadLink,"saveInfraUpload");
						formData.delete("angFile");

						if(fileSeries == "") {
							fileSeries += numOfThisFile;
						}else {
							fileSeries += "-"+numOfThisFile;
						}
					}
					saveInfraUploadPart2(fileSeries);
				}else {
					if(err == 1) {
						alert('Please check upload files.');
					}else if(err == 2) {
						alert('Please search Infra Tracking Number.');
					}else if(err == 3) {
						alert('Please enter progress.');
					}else if(err == 4) {
						alert('Please enter details of the progress.');
					}else if(err == 5) {
						alert('You cannot backtrack on your progress. Please update your progress.');
					}
				}
			}else {
				var err = 0;
				if(tn.length == 0) {
					err = 1;
				}else if(progress <= 0 || progress.length == ""){
					err = 2;
				}else if(details.length <= 0) {
					err = 3;
				}else if(parseFloat(progress) <= parseFloat(curProgress)){
					err = 4;
				}

				if(err == 0) { 
					var fileSeries = "";
					saveInfraUploadPart2(fileSeries);
				}else {
					if(err == 1) {
						alert('Please search Infra Tracking Number.');
					}else if(err == 2) {
						alert('Please enter progress.');
					}else if(err == 3) {
						alert('Please enter details of the progress.');
					}else if(err == 4) {
						alert('You cannot backtrack on your progress. Please update your progress.');
					}
				}

			}
		}else {
			alert('Please search Infra Tracking Number.');
		}
		
    }

    function clearInfraUpFields() {
        document.getElementById('infraUpProgress').value = "";
        document.getElementById('infraUpDetails').value = "";
        document.getElementById('infraVideoLink').value = "";
        document.getElementById('infraUpFileLabel').innerHTML = "Browse file/s";
    }
</script>