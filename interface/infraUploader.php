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

	.displayImage{
		margin-top:9px;
		margin-right:7px;
		display:inline-block;
		border:5px solid white;
		box-shadow:0px 0px 5px 2px grey; 
		background-repeat: no-repeat;
		/* width:356px; height:199px; */
		width:225px; height:127px;
	}
</style>
	<div style="padding:20px; background-color:white; display:inline-block; margin:10px; font-size:0px;">
	    <div id="infraUpContainer" style="padding:40px; min-height:500px;min-width: 700px;">
	        <table id="" border="0" style ="width:100%;">
	            <tr>    
	                <td style="text-align:right;">
	                    <span style="margin-right:8px;font-family:oswald;">Search Infra TN</span>
	                    <input id="infraUpSearchBar" maxlength="9" class="text3" style="width:150px; font-weight: bold; padding:2px 5px; font-size: 22px; text-align:center; text-transform:uppercase;" 
	                    		onkeydown="keypressAndWhatClear(this,event,fetchINTNDetailsForInfraUp,1)" type="text" value ="">
	                </td>
	            </tr>
	            
	            <tr>
	            	<td style = "border-bottom: 1px dahsed grey;padding: 10px 0px;background-color: rgb(248, 251, 251);">
	            		<table style ="line-height: 14px;">
							<tr>
								<td><input onclick ="infraUploadOption(this)" type ="radio" name ="uploadType" id = "infraUploadType1"></td><td><label class="hover" for ="infraUploadType1">Pre-construction Upload</label></td>
								<td><input onclick ="infraUploadOption(this)" type ="radio" name ="uploadType" id = "infraUploadType2" checked ></td><td ><label class="hover" for ="infraUploadType2">Progress Upload</label></td>
								<td><input onclick ="infraUploadOption(this)" type ="radio" name ="uploadType" id = "infraUploadType3"></td><td ><label class="hover" for ="infraUploadType3">Correction</label></td>
							</tr>
						</table>
	            	</td>
	            </tr>
	            
	            <tr>
	            	<td>
	            		<div id = "infraUploadContainer1" style ="display:none;">
	            			<table>
		            			<tr>    
					                <td style="width:700px;" id ="uploadInfraContainer1">
					                    
					                </td>
					            </tr>
					            <tr>
					                <td style ="padding-top:10px;border-top:1px dashed rgb(131, 142, 147);">
					                    <table id="infraUpInputTable" border="0"  style="margin:0px auto;padding-top:15px;width:100%;border-spacing:0px;background-color:rgb(238, 243, 245);padding:10px; border:1px solid rgb(234, 238, 240);">
					                       
					                        <tr>
					                            <td style="">
					                                <span class="numberFieldUp">Upload Pictures</span><span class="numbInfraUp">1</span>
					                            </td>
					                            <td style="vertical-align:bottom;padding-top:5px;">
					                                <label for="infraUpFilePre" id="infraUpFileLabelPre" class="inputProject" style=" border:0px; ">Browse file</label>
					                                <input type="file" id="infraUpFilePre" style="display:none;" onchange="infraUpUpdateFileLabel(this)" multiple>
					                            </td>
					                        </tr>
					                        <tr>
												<td style="">
												    <span class="numberFieldUp">Video Link</span><span class="numbInfraUp">2</span>
												</td>
												<td>
												    <input id="infraVideoLinkPre" class="inputProject" value = "" maxlength="250" >
												</td>
											</tr>
					                        <tr>
					                            <td></td>
					                            <td style ="padding-top:20px;">
					                                <div class="button1" style="margin:0 auto;font-size: 16px; padding:5px;" onclick="saveInfraUploadPre()">Save</div>
					                            </td>
					                        </tr>
					                    </table>
					                </td>
					            </tr>
		            		</table>
	            		</div>
	            		<div id = "infraUploadContainer2" >
		            		<table>
		            			<tr>    
					                <td style="width:700px;" id ="uploadInfraContainer2">
					                    
					                </td>
					            </tr>
					            <tr>
					                <td style ="padding-top:10px;border-top:1px dashed rgb(131, 142, 147);">
					                    <table id="infraUpInputTable" border="0"  style="padding-top:15px;width:100%;border-spacing:0px;background-color: rgb(248, 249, 235);padding:10px;border:1px solid rgb(234, 238, 240); ">
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
						<div id = "infraUploadContainer3" style ="display:none;">
							<table border="0" cellpadding="0" cellspacing="0" style="">
		            			<tr>    
					                <td style="width:700px;" id ="uploadInfraContainer3"></td>
					            </tr>
					            <tr>
									<td style ="padding-top:10px;border-top:1px dashed rgb(131, 142, 147);">
										<table id="infraUpInputTable" border="0" cellpadding="0" cellspacing="0" style="padding-top:15px;width:100%;border-spacing:0px;padding:10px;border:1px solid rgb(234, 238, 240); border-spacing:5px 2px;">
											<tr>
												<td><span class="numberFieldUp">Progress</span><span class="numbInfraUp">1</span></td>
												<td><input id="infraUpProgressEdit" class="inputProject" style="width:70px; text-align:center;" maxlength="6" disabled></td>
											</tr>
											<tr>	
												<td><span class="numberFieldUp">Details</span><span class="numbInfraUp">2</span></td>
												<td><textarea id="infraUpDetailsEdit" class="inputProject" style="color:black; padding:3px 6px; width:100%;font-weight: normal;"></textarea></td>
											</tr>
											<tr>
												<td><span class="numberFieldUp">Uploaded Pictures</span><span class="numbInfraUp">3</span></td>
												<td style="vertical-align:top;">
													<div style="padding-top:5px;">
														<label for="infraUpFileNewEdit" id="infraUpFileLabelEdit" class="inputProject" style=" border:0px; ">Browse file</label>
														<input type="file" id="infraUpFileNewEdit" style="display:none;" onchange="infraUpUpdateFileLabel(this)" multiple>
													</div>
													<div id="infraUpFileEdit" style="background-color:rgba(157, 155, 155,.1); padding:10px;"></div>
												</td>
											</tr>
											<tr>
												<td><span class="numberFieldUp">Video Link</span><span class="numbInfraUp">4</span></td>
												<td><input id="infraVideoLinkEdit" class="inputProject" style="" maxlength="50"></td>
											</tr>
											<tr>
					                            <td></td>
					                            <td style ="padding-top:20px;">
					                                <!-- <div class="button1" style="margin:0 auto;font-size: 16px; padding:5px;" onclick="updateInfraUploadPart1()">Update</div> -->
					                                <div class="button1" style="margin:0 auto;font-size: 16px; padding:5px;" onclick="updateInfraUploadFull()">Update</div>
					                            </td>
					                        </tr>
										</table>	
									</td>
								</tr>
							</table>
						</div>
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
							
			var opt = infraUploadType1.checked;
			var container =  "";
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"fetchINTNDetailsForInfraUp1");	
		}
	}
    function infraUpUpdateFileLabel(me) {
    	
    	
		var files = me.files;
       
        // var opt = infraUploadType1.checked;
		// if(opt == true){
		// 	 var label = document.getElementById('infraUpFileLabelPre');
		// }else{
		// 	 var label = document.getElementById('infraUpFileLabel');
		// }
		
		if(infraUploadType1.checked == true){
			var label = document.getElementById('infraUpFileLabelPre');
		}else if(infraUploadType2.checked == true) {
			var label = document.getElementById('infraUpFileLabel');
		}else{
			var label = document.getElementById('infraUpFileLabelEdit');
		}

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
		var container = document.getElementById("uploadInfraContainer2");
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
					err = fileCheckJS(uploads[i], "jpeg,jpg,png");
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
	function infraUploadOption(me){
		if(me.id == "infraUploadType1"){
			infraUploadContainer1.style.display ="block";
			infraUploadContainer2.style.display ="none";
			infraUploadContainer3.style.display ="none";
		}else if(me.id == "infraUploadType2"){
			infraUploadContainer1.style.display ="none";
			infraUploadContainer2.style.display ="block";
			infraUploadContainer3.style.display ="none";
		}else{
			infraUploadContainer1.style.display ="none";
			infraUploadContainer2.style.display ="none";
			infraUploadContainer3.style.display ="block";
		}
	}

	function saveInfraUploadPre(){
		var video = document.getElementById('infraVideoLinkPre').value.trim();
		var pictures = document.getElementById('infraUpFilePre').files;
		var err = 0;
		if(document.getElementById('infraUpSelectTN')){
			var tn = document.getElementById('infraUpSelectTN').textContent.trim();
		}else{
			err = 4;
		}
		
		if(pictures.length > 0) {
			for(var i = 0; i < pictures.length; i++) {
				err = fileCheckJS(pictures[i], "jpeg,jpg,png");
			}
			if(err > 0){
				err = 1;
			}
		}
		
		if(video.length > 0){
			var vidLink = '';
			var arr = video.split(",");
			if(arr.length == 1){
				let result = video.indexOf("https://youtu.be/");
				if(result == -1){
					err = 2;
					vidLink = video;
				}
			}else if(arr.length > 1){
				var dup = checkDuplicate(arr);
				if(dup == 1){
					err = 3;
				}
				for(var i = 0 ; i < arr.length; i++){
					let result = arr[i].indexOf("https://youtu.be/");
					if(result == -1){
						vidLink = arr[i];
						err = 2;
						break;
					}
				}
			}
		}
		
		if(video.length  == 0 & pictures.length == 0  ){
			err = 5  
		}
		
		if(err == 0){
			
			loader();
			var container = document.getElementById("uploadInfraContainer1");
			var formData = new FormData();
			formData.append("saveInfraUploadPre", 1);
			formData.append("tn", tn);
			formData.append("year", year);
			formData.append("pics", pictures);
			formData.append("video", video);
			for(var i = 0; i < pictures.length; i++) {
				var angFile = pictures[i];
				formData.append("pics[]", pictures[i]);
			}
			ajaxFormUpload1(formData,uploadLink,"saveInfraUploadPre",container);
			formData.delete("pics");
			
		}else{
			if(err == 1){
				alert("Invalid photo file format.");	
			}else if(err == 2){
				alert("Invalid video link : " + vidLink);	
			}else if(err == 3){
				alert("Duplicate video link.");	
			}else if(err == 4){
				alert("Please search transaction first.");	
			}else if(err == 5){
				alert("Please input something.");	
			}
			
		}	
	}

	// INFRA UPLOAD UPDATE VERSION 2
	function getProgressDetails(me) {
		if(infraUploadType3.checked == true){
			var td = me.children;
			var progress = td[1].textContent;
			var tn = document.getElementById('infraUpSelectTN').textContent.trim();
			
			var container =  "";
			loader();
			var queryString = "?getProgressDetails=1"
								+ "&tn="   + tn
								+ "&progress="   + progress;
								
			ajaxGetAndConcatenate(queryString,processorLink,container,"getProgressDetails");	
		}
	}

	function removeThisInfraProgFile(me) {
		var fileName = me.id.replace('file', '');
		var tn = document.getElementById('infraUpSelectTN').textContent.trim();
		var imgContainer = me.parentNode.parentNode;
		var mainContainer = me.parentNode.parentNode.parentNode;

		var answer = confirm("Remove this file? Please confirm.");
		if(answer){
			var queryString = "?removeThisInfraProgFile=1&tn="+tn+"&fileName="+fileName;

			loader();
			var container = "";
			ajaxGetAndConcatenate(queryString,processorLink,container,"removeThisInfraProgFile");	
			mainContainer.removeChild(imgContainer);
		}
	}

	function updateInfraUploadFull() {
		var tn = document.getElementById('infraUpSelectTN').textContent.trim();
		var details = document.getElementById('infraUpDetailsEdit').value;
		var progress = document.getElementById('infraUpProgressEdit').value;
		var uploads = document.getElementById('infraUpFileNewEdit').files;
		var video = document.getElementById('infraVideoLinkEdit').value.trim();
		var err = 0;

		if(uploads.length > 0) {
			for(var i = 0; i < uploads.length; i++) {
				err = fileCheckJS(uploads[i], "jpeg,jpg,png");
			}
			if(err > 0){
				err = 1;
			}
		}

		if(video.length > 0){
			var vidLink = '';
			var arr = video.split(",");
			if(arr.length == 1){
				let result = video.indexOf("https://youtu.be/");
				if(result == -1){
					let result = video.indexOf("https://www.youtube.com/embed/");
					if(result == -1){
						err = 2;
						vidLink = video;
					}
				}
			}else if(arr.length > 1){
				var dup = checkDuplicate(arr);
				if(dup == 1){
					err = 3;
				}
				for(var i = 0 ; i < arr.length; i++){
					let result = arr[i].indexOf("https://youtu.be/");
					if(result == -1){
						vidLink = arr[i];
						err = 2;
						break;
					}
				}
			}
		}

		if(tn.length == 0) {
			err = 4;
		}else if(progress <= 0 || progress == ""){
			err = 5;
		}else if(details.length <= 0) {
			err = 6;
		}

		if(err == 0) {

			loader();
			var container = document.getElementById("uploadInfraContainer3");
			var formData = new FormData();
			formData.append("updateInfraUploadFull", 1);
			formData.append("tn", tn);
			formData.append("year", year);
			formData.append("progress", progress);
			formData.append("details", details);
			formData.append("video", video);
			for(var i = 0; i < uploads.length; i++) {
				var angFile = uploads[i];
				formData.append("uploads[]", uploads[i]);
			}
			ajaxFormUpload1(formData,uploadLink,"updateInfraUploadFull",container);
			formData.delete("uploads");

		}else {
			if(err == 1) {
				alert('Please check upload files.');
			}else if(err == 2) {
				alert("Invalid video link : " + vidLink);
			}else if(err == 3) {
				alert("Duplicate video link.");
			}else if(err == 4) {
				alert('Please search Infra Tracking Number.');
			}else if(err == 5) {
				alert('Please select progress to update.');
			}else if(err == 6) {
				alert('Please enter details of the progress.');
			}
		}
	

	}

	function resetUpdateProgress() {
		document.getElementById('infraUpProgressEdit').value = "";
		document.getElementById('infraUpDetailsEdit').value = "";
		document.getElementById('infraUpFileLabelEdit').innerHTML = "Browse file/s";
		document.getElementById('infraVideoLinkEdit').value = "";
		document.getElementById('infraUpFileEdit').innerHTML = "";
		document.getElementById('infraUpFileEdit').style.display = 'block';
	}

</script>



