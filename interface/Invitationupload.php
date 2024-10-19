
<style>
	/*-----------------------------------------------------------------loader*/
	.loader{
			width:140px;
			height:165px;
			top:40%;
			background:url('../images/40.gif');
			background-repeat:no-repeat;
			background-size:120px 120px;
			background-position:48% 48%;
			z-index:100;
	}	
	.loaderContainer{
		border:4px solid transparent;
		box-shadow: 0px 0px 30px 0px rgba(11, 60, 110,.2);
		//background-color: rgba(7, 7, 7,.81);
		//border-radius: 0px 25px 0px 25px ;
		//border-radius:50%;
		display:inline-block;	
		
	}
	.loaderContainer::after{
		content:" Please wait...";
		padding-left:10px;
		color:white;
		color:green;
		color:grey;
		position:absolute;
		margin-top:-18px;
		margin-left:-54px;
		font-size:14px;
		letter-spacing: 1px;
		text-shadow: 0px 0px 2px black;
	}
	.absoluteHolder{
		z-index:105;
		position:absolute;
		text-align:center;
		background-color:rgba(4, 4, 4,.3);
		width:100%;
		height:100%;
	}
	.absoluteHolder1{
		z-index:105;
		position:absolute;
		text-align:center;
		//background-color:rgba(252, 254, 254,.8);
		width:100%;
		height:100%;
	}
	.editorContainer{
		border:4px solid transparent;
		border-radius:2px;
		box-shadow:0px 0px 20px 10px rgba(0, 0, 0,.4);
		background-color:white;
		display:inline-block;	
	}
	/*---------------------------------------------------------------------- empty fields  */
	.inputText{
		
		border-radius:3px;
		color:rgb(7, 124, 174);
		background:rgb(212, 219, 223);
		font-weight: bold;
	}

	.inputText:focus,.inputText:hover {
	
		background-color: rgba(216, 243, 204,.4);
		
	}
	.inputTextEmpty{
		border-radius:3px;
		transition-property: background-color;
	   	transition-duration: .5s;
	   	transition-delay: 0s;
		border-radius:3px;
		background:rgb(250, 165, 169);
	}

	
	.labelX{
		color:red;
		display:inline-block;
		position:fixed;
		position:absolute;
		margin-left:5px;
	}
	
	.qoute{
		display:inline-block;
		position:absolute;
		margin-top:-35px;
		margin-left:15px;
		text-align:center;
		padding:12px 8px;
		padding-left:6px;
		background: rgb(250, 165, 169);
		border:4px solid white;
		border-radius:5px;
		font-weight:bold;
		color:white;
	}
	
	.qoute:before {
		content: "";
		position: absolute;
		top:60%;
		margin-left: -32px;
		border-right:23px solid rgb(250, 165, 169);
		border-left:13px solid transparent;
		border-top:12px solid transparent;
		border-bottom:4px solid transparent;
		
	}
	.labelX{
		color:red;
		display:inline-block;
		position:fixed;
		position:absolute;
		margin-left:5px;
	}
	.tdHeader{
		font-family: Verdana;
		font-size:15px;
		text-shadow:0px 0px 2px black;
		color:rgb(46, 133, 3);
		color:white;
		letter-spacing: 1px;
		//font-weight:bold;
		text-align:center;
		padding:3px 10px;	
		border-bottom: 1px solid rgb(65, 132, 32);
		background-color:rgb(77, 138, 47);
	}
	.tdData{
		border-bottom:1px solid silver;
		padding:5px 10px;
		font-size:16px;
		font-weight: bold;
		font-family: Courier New;
	}
	/*-----------------------------------------------------------------loader*/
	body{
		padding:0;	
		margin:0;
		
	}
	#bodyDiv{
		text-align:center;
		margin:0 auto;
		
	}
	
	#container{
		width:100%;
		width:700px;
		margin:0 auto;
	}

	
	.hide{
		display: none;
	}
	.tableEncoder{
		margin:20px;
		padding:20px;
	}
	
	
	.label1{
		font-family: impact;
		letter-spacing: 1px;
		
	}
	.label2{
		font-family:impact ;
		letter-spacing:1px;
		color:rgb(82, 143, 29);
		color:grey;
		
		font-size: 22px;
	}
	.label3{
		font-family: impact;
		color:white;
		letter-spacing: 1px;
		font-size: 22px;
		background-color:rgb(11, 82, 137);	
		background-color: rgb(58, 126, 16);
		padding:5px 20px;
		border-bottom:1px solid black;
		border-right:1px solid black;
		cursor: pointer;
		display: inline-block;
		transition:all .2s ease-in;
	}
	.label3:hover{
		background-color:rgb(46, 47, 46);
	}
	.label3selected{
		font-family: impact;
		color:white;
	
		letter-spacing: 1px;
		font-size: 22px;
		background-color:rgb(22, 23, 21);	
		padding:5px 20px;
		border-bottom:1px solid rgb(34, 82, 4);
		border-right:1px solid rgb(34, 82, 4);
		cursor: pointer;
		display: inline-block;
		transition:all .2s ease-in;
	}
	.button{
		display:inline-block;
		border-top:2px solid white;
		border-left:2px solid white;
		border-right:3px solid silver;
		border-bottom:3px solid silver;
		padding:5px 10px;	
		font-size:23px;	
		background-color:rgb(161, 170, 161);
		color:white;
		cursor:pointer;
		transition:all .2s ease-in;
		width: 80px;
	}
	
	.button:hover{
		box-shadow:0px 0px 5px 2px silver;
		background-color:rgb(46, 112, 46);
	}
	.num{
		font-size:42px;
		color:grey;
		padding-right:10px;
	}
	
</style>
	
<table style = "width:100%;">
	
	<tr>
		<td >
			<div id = "" class = "">
					<div class = "hi1de">
							<div id = "containerUpload" style ="padding:40px;">
								<table class = "" style ="border-spacing:0px;">
									<tr>
										<td style = "text-align: left;"><span class = "num">1</span><span class="label2">YEAR</span></td>
										<td >
											<select  id = "reportYear" class = 'inputText' style ="width:280px;font-size:18px;letter-spacing:0px;" >
												<option><?php echo date("Y"); ?></option>
												<option><?php echo date("Y") + 1 ; ?></option>
											</select>
										</td>
									</tr>
									<tr>
										<td style = "padding-bottom: 15px;text-align: left;border-bottom:1px solid silver; "><span class = "num">2</span><span class="label2">MONTH</span></td>
										<td  style="padding-bottom: 15px;border-bottom:1px solid silver; ">
											<select  id = "reportMonth" class = 'inputText' style ="width:280px;font-size:18px;letter-spacing:0px;" >
												<option ></option>
												<option  value = "1">January</option>
												<option value = "2">February</option>
												<option value = "3">March</option>
												<option value = "4">April</option>
												<option value = "5">May</option>
												<option value = "6">June</option>
												<option value = "7">July</option>
												<option value = "8">August</option>
												<option value = "9">September</option>
												<option value = "10">October</option>
												<option value = "11">November</option>
												<option value = "12">December</option>
											</select>
										</td>
									</tr>
									<tr>
										<td style = "text-align: left;padding-top:15px;"><span class = "num">3</span><span class="label2">RECORD</span></td>
										<td  style = "padding-top:15px;">
											<select  id = "reportRecord" class = 'inputText' style ="width:280px;font-size:18px;letter-spacing:0px;"   >
												 <option value = ''></option>
												<option>Reports</option>
												<option>Notices</option>
												<option>Invitation to Bid</option>
												<option>Abstract of Bid</option>
												<option>Minutes</option>
												<option>Projects</option>
											</select>
										</td>
									</tr>
									
									<tr>
										<td style = "text-align: left;"><span class = "num">4</span><span class="label2">TYPE</span></td>
										<td >
											<select  id = "reportType" class = 'inputText' style ="width:280px;font-size:18px;letter-spacing:0px;"   >
												 <option value = ''></option>
												<option>Goods and Services</option>
												<option>Infrastructure</option>
												<option>Others</option>
											</select>
										</td>
									</tr>
									<tr>
										<td style = "text-align: left;padding-right:10px;padding-bottom:8px; vertical-align:top;"><span class = "num">5</span><span class="label2">SUBJECT</span></td>
										<td style = "padding-bottom:8px;">
											<textarea id = "reportSubject" class = "inputText" style = "font-family:helvetica; font-size:18px;width:280px;text-align:left;padding:10px;height: 110px;resize:vertical;letter-spacing:0;" ></textarea>
										</td>
									</tr>
							
									<tr>
										<td   style = "text-align: left;border-top: 1px solid silver;">
											<span class = "num">6</span><span class="label2">FILE</span>
										</td>
								
										<td  style="text-align: right;border-top: 1px solid silver;">
											<input id = "reportFile" type = "file"  style = "text-align:left;padding-top:5px;font-size:18px;color:grey;width:265px;  "  />
											
										</td>
									</tr>
									<tr>
										<td  colspan = "2" style = "text-align: center;border-top: 1px solid silver;padding-top:25px;"><span class="label2 button1" style = "color:rgb(88, 89, 90)" onclick="saveReportUploads()">SAVE</span>
										</td>
									</tr>
								</table>
							</div>
						    
					</div>	
					
			</div>
		</td>
	</tr>
</table>
	
		
	
<script>
	function saveReportUploads(){
		var year = document.getElementById("reportYear").value;
		var month = document.getElementById("reportMonth").value;
		var subject = encodeURIComponent(document.getElementById("reportSubject").value);
		var  record = document.getElementById("reportRecord").value;
		var type = document.getElementById("reportType").value;
		var file = document.getElementById("reportFile");
		var  files = file.files;
		var angFile = files[0];
		var container = document.getElementById('containerUpload');		
		var empty = checkEmptyField(container);
		//var empty = 0;
		if (empty == 0){
			if(angFile.type.match('pdf.*')    ||  angFile.type.match('jpeg.*')  ||  angFile.type.match('jpg.*') ){
				var formData = new FormData();
				formData.append("year", year);
				formData.append("month", month);
				formData.append("subject", subject);
				formData.append("record", record);
				formData.append("type", type);
				formData.append("filePDF", angFile);
				loader();
				ajaxFormUpload(formData,uploadLink,"bacUpload");
			}else{
				alert("Invalid file.");
			}
		}
	}
	
	function clearFieldsBac(){
		/*selectToIndexZero("reportMonth");
		selectToIndexZero("reportSubject");
		selectToIndexZero("reportRecord");
		selectToIndexZero("reportType");*/
		document.getElementById("reportSubject").value = "";
		document.getElementById('reportFile').value= null;
	}
	
</script>



