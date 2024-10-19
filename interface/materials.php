<style>
	.tdLabel{
		width:90px;
		font-family:Oswald;
		text-align: right;
		font-size:14px;
		vertical-align:bottom;
		letter-spacing: 2px;
	}
	.inputMaterials{
		font-weight: bold;
		padding-left:5px;
		font-family: Oswald;
		font-size: 18px;
		width:100%;
		border:0;
		border-bottom:1px solid silver;
	}
	.button{
		font-weight: bold;
		font-size: 14px;
		width: 60px;
		display: inline-block;
		border:1px solid silver;
		text-align: center;
		font-family: Oswald;
		padding:5px;
	}
</style>
	<table  style = "width:850px; border:5px solid rgb(235, 233, 224);border-top:5px solid rgb(235, 233, 224);border-bottom: 3px dashed rgb(235, 233, 224);padding-bottom: 2px;">
		<tr>
			<td style = "vertical-align:top;">
				<div id = "" style = "">
					<table style = "width:100%;border-spacing:0;" border = "0">
						<tr>
							<td class = "tdLabel" style = "">Title :</td><td><input id ="mSubject" class ="inputMaterials"/></td>
							<td style = "width:90px;text-align: center;background-color:rgb(223, 231, 233);" rowspan="4">
								<div style ="padding:10px 6px;width:50px;font-size: 14px;font-family: Oswald;letter-spacing:1px;background-color:white;" class = "button1" onclick = "uploadMaterials()">Upload</div>
							</td>
						</tr>
						<tr>	
							<td style = "padding-bottom:15px;font-size:13px;" class = "tdLabel">Remarks&nbsp;&nbsp; </td><td style = "padding-bottom:15px;"><input id ="mRemark" class ="inputMaterials" style = "font-weight: normal;font-size:13px;"/></td>
						</tr>
						<tr>
							<td class = "tdLabel" style = "font-weight: normal;">Attachment </td><td >
								<div id = "linkMaterial" onclick = "clickUpload()" style = "cursor:pointer;padding-left:8px;font-family: Oswald;border-bottom: 1px solid silver;color:rgb(23, 178, 250);font-weight: bold;"> Browse file here</div></td>
						</tr>	
						<tr>
							<td class = "tdLabel"  style = "font-weight: normal;">Send To </td><td>
								<?php
								//if($_SESSION['accountType'] > 1){
										echo '<select id ="mOffice" class ="inputMaterials" style = "-moz-appearance: none;-webkit-appearance: none;">';
										echo '	<option value ="all">All</option>';
												$record = $database->GetOffice();
												while($data = $database->fetch_array($record)){
													echo '<option value = "' . $data['Code'] . '">' . $data['Name'] . '</option>';
												}
											
										echo '</select>';
								//	}
								?>
							</td>
						</tr>
						<tr style = "display:none;">
							<td  style = "text-align:left;">
				   		    	<input id = "mFileUpload" onchange ="getUploadValue(this)" style = "color:white;font-size:22px;font-family:Oswald;" type = "file" >
				    		</td>
				    	</tr>
					</table>
				</div>
			</td>
		</tr>	
	</table>
	<div id = "attachContainer" style = "margin:0 auto;">
		
	</div>

<script>
	whenrefreshAttach();
	function whenrefreshAttach(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Attachments"){
					getAttachments();
			}
		}
	}
	function getAttachments(){
		var queryString = "?getAttachments=1";
		var container = document.getElementById('attachContainer');
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"getAttachments");
	}
	function clickUpload(){
		mFileUpload.click();
	}
	function getUploadValue(me){
		var name =   me.value;
		if(validExtensions("pdf,xls,xlsx,csv,doc,docx,jpeg,jpg,xml",name) == 1){
			document.getElementById("linkMaterial").textContent = name;
			document.getElementById("linkMaterial").style.color = "red";
		}else{
			alert("Not a valid file.");
		}
	}
	function uploadMaterials(){
		var title = document.getElementById("mSubject").value;
		var remark = document.getElementById("mRemark").value;
		var file = document.getElementById("mFileUpload");
		var office = document.getElementById("mOffice").value;
		var files = file.files;
		var angFile = files[0];
		if(angFile){
			if(title.length > 4){
				
				var formData = new FormData();
				
				formData.append("postings", 1);
				formData.append("title", title);
				formData.append("remark", remark);
				formData.append("office", office);
				
				formData.append("angFile", angFile);
				
				var container = "";
				loader();
				ajaxFormUpload(formData,uploadLink,"posting");
				
			}else{
				alert("Please input title.");
			}
		}else{
			alert("Please select a file.");
		}
	}
	function show(me){
		var path = "/../../attachments/" + me.id;
		window.open(path, '_blank');
	}
	function detach(me){
		var text = me.parentNode.childNodes[0].textContent.trim();
		var answer = confirm("Confirm to remove : " + text );
		if(answer){
			var arr = me.id.split("~!~");
			var id  = arr[0];
			var filename = arr[1];
			var queryString = "?deleteAttachments=1&id=" + id + "&filename=" + filename + "&text=" + text;
			var container = document.getElementById('attachContainer');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"deleteAttachments");
		}
	}
	function loadMoreAttach(me){
		
		me.parentNode.style.display = "none";
		
		var id  = me.id;
		var queryString = "?loadMoreAttach=1&id=" + id ;
		var container = me.parentNode.parentNode;
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadMoreAttach");
	}
</script>


