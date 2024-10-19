<style>
	#tableMainForum{
		padding: 2px;
		margin: 0px auto;
		width: 800px;
		
		border-spacing: 0;
		border:15px solid #F3F8FA;
		background-color:white;
		box-shadow:0px 0px 3px 1px silver;;
		font-family: Oxygen-Regular;
		color: #16495C;
	}
	
	#textAreaContainer{
		width:100%;
		padding:10px 0px;
	}
	#textAreaForum{
		display:block;
		width:95%;
		height:100px;
		margin:0 auto;
		border:2px solid #b4d3da;
		padding:10px;
		font-size:16px;
		letter-spacing:1px;
		resize:vertical;
		//resize:none;
		//background-color:#F6FDD5;
		box-shadow: 0px 0px 1px 0px #c0c0c0;
	}
	#divForumContainer{
		padding:10px;
		background-color:#F9F6F7;
	}
	#divForumMessageContainer{
		position:relative;
		border-top:2px solid #CFE5EA;
		background-color:white;
		min-height:550px;
		width:95%;
		margin:0 auto;
	}
	#submitForumMessage{
		display:inline-block;
		border-top:4px solid white;
		border-left:4px solid white;
		border-right:3px solid silver;
		border-bottom:3px solid silver;
		padding:2px 10px;	
		font-size:14px;	
		background-color:#53BCEC;
		color:white;
		cursor:pointer;
	}
	
	#submitForumMessage:hover{
		box-shadow:0px 0px 2px 1px silver;
		font-style:italic;
	}
	#submitDisplayMessage:hover{
		box-shadow:0px 0px 2px 1px silver;
		font-style:italic;
	}
	
	/*================================================button go to message=====================================*/
	#inputGoToMessage{
		border-radius:3px;
		border-top:2.5px solid silver;
		border-bottom:2.5px solid #E7E5E5;
		border-right:2px solid #E7E5E5;
		border-left:2.5px solid silver;
		text-align:center;
		font-size:11px;
		margin-left:1px;
		font-family: Oxygen-Regular;
	}
	

	#buttonGoToMessage{
		background:url(../images/arrow-1.png) no-repeat;
		background-size:15px;
		image-align:center;
		display:inline-block;
		position:absolute;
		margin-top:-2px;
		margin-left:3px;
		border-top:2px solid white;
		border-left:1x solid white;
		border-right:1px solid silver;
		border-bottom:2px solid silver;
		background-color:#53BCEC;
		font-size:8px;	
		text-align:center;
		color:white;
		cursor:pointer;
		border-radius: 85%;
		width:18px;
		height:18px;
		/*background:url(../images/arrow-1.png);*/
		/*background-position:top;
		background-size:20px 20px;*/
		padding:0px;
		/*padding-top:2px;*/
		/*line-height:18px;
		font-family:Cooper Black;*/
		opacity:1.5px;
	}
	#buttonGoToMessage:hover{
		background:url(../images/arrow-2.png) no-repeat;
		background-size:15px;
		border-top:2px solid white;
		border-left:1x solid white;
		border-right:1px solid silver;
		border-bottom:2px solid silver;
		background-color:#53BCEC;
		border-radius: 85%;
		width:18px;
		height:18px;
		/*box-shadow:0px 1px 0px 1px silver;*/
	}
	#divGoToMessage{
		position:relative;
		top:-7px;
		background-color: #D4E9F2;
		height:21.5px;
		width:93%;
		margin-left: 15px;
		font-size:11.5px;
		margin-left:22px;
		padding-left:5px;
		padding-right:3px;
		padding-top:5px;
		padding-bottom:2px;
		color:#16495C;
		letter-spacing:2px;
		font-variant:small-caps;
		font-style: italic;
		font-family: Armata-Regular;
		box-shadow: 1px .8px 1px .2px #c0c0c0;
		blur:2px;
		border-bottom-left-radius:2px;
		border-bottom-right-radius:2px;
	}
	
	/* ---------------------------------------------------------------------------------------------------------------------------- */
	.tableResult{
		//border:1px solid red;
		width:97%;
		border-spacing:0px;
		margin:10px;
		padding:5px 0px;
		margin-bottom:15px;
		background-color:#F9FBFC;
		
	}
	.tableResultA{
		//border:1px solid red;
		width:97%;
		border-spacing:0px;
		margin:10px;
		padding:5px 0px;
		margin-bottom:15px;
		background-color:#F9FBFC;
		
		-moz-animation-name: glow;
	   -moz-animation-duration: 2s;
	   -moz-animation-timing-function: ease-out; 
	   -moz-animation-delay: 0.2s;         
	   -moz-animation-iteration-count: 2;  
	   -moz-animation-direction: alternate;  
	   
	   -webkit-animation-name: glow;
	   -webkit-animation-duration: 2s;
	   -webkit-animation-timing-function: ease-out; 
	   -webkit-animation-delay: 0.2s;         
	   -webkit-animation-iteration-count: 2;  
	   -webkit-animation-direction: alternate;  
	}
	#tableResult td{
		//border:1px solid silver;
	}
	#idResult{
		font-size:28px;
		padding:2px 10px;
		color:#A4A7A9;
	}
	#officeResult{
		font-size:18px;
		padding:0;
	}
	#fullnameResult{
		color:#14ABEC;
		margin-right:10px;
	}
	#messageResult{
		border:1px solid white;
		border-bottom:2px solid #CED8DC;
		border-right:2px solid #CED8DC;
		
		padding:10px;
		margin:8px 0px;
		background-color:#EBF1F4;
		text-align:justify;
		
		white-space: pre-line;
	    word-wrap: break-word;
	}
	
	
	#forumPosted{
		color:grey;
	}
	#forumDelete{
		color:white;
		background-color:#DADCDD;
		font-weight:bold;
		cursor:pointer;
		border-radius:5px;
		text-align:center;
		height:20px;
		width:20px;
	}
	#forumDelete:hover{
		background-color:grey;
	}
	.repliesResult{
		color:#FE4765;	
		display:inline-block;
		font-size:12px;
		font-style:italic;
		margin-left:10px;
		cursor:pointer;
	}
	
	/* editor */
	.editorButtons{
		float:right;
		margin-right:10px;
		color:grey;
		font-size:14px;
		padding:0px 6px;
		cursor:pointer;
	}
	.editorButtons:hover{
		color:#53BCEC;
	}
	#divReplyEditor{
		border:1px solid #EAF2F6;
		width:90%;
		height:155px;
		margin:0 auto;
		background-color:white;
		text-align:center;
		padding-bottom:10px;
	}
	.inputReply{
	 	border:1px solid #A5C9DA;
		padding:10px;
		font-size:16px;
		letter-spacing:1px;
	 	width:95%;
		height:120px;
		margin-top:15px;
		resize:none;
	}
	.divReplyContainer{
		border:1px solid white;
		border-bottom:1px solid #CED8DC;
		border-right:1px solid #CED8DC;
		
		
		background-color:#E8EFF3;
		margin-top:15px;
		margin-left:15px;
		display:inline-block;
		float:right;
		width:90%;
		padding:8px;
		display:none;
		
	}
	.replyContainerResult{
		background-color:#F8F1F6;
		border-top:2px solid white;
		border-left:2px solid white;
		
		border-right:2px solid #DCE1E3;
		border-bottom:2px solid #DCE1E3;
		padding:5px;
		margin-bottom:10px;
	}
	
	#replyInfo{
		font-size:12px;
		text-align:right;
		padding-right:8px;
	}
	.repSequence{
		font-size:14px;
		display:inline-block;
		border:2px solid white;
		width:20px;
		height:20px;
		background-color:#AEDDF3;
		
		color:white;
		text-align:center;
		border-radius:50%;
		margin-right:5px;
	}
	#loadMore{
		text-align:right;
		padding:0px 5px;
		padding-bottom:10px;
		
		margin-right:20px;
		cursor:pointer;
		color:#53BCEC;
	}
	#loadMore:hover{
		color:orange;
	}
	@keyframes glow{
	   from{ 
		  box-shadow:inset 0px 0px 10px 3px white;
	   }
	   to { 
		   box-shadow: inset 0px 0px 15px 2px #3188A5;
	   }
	}
	@-webkit-keyframes glow{
	   from{ 
		  box-shadow:inset 0px 0px 10px 3px white;
	   }
	   to { 
		   box-shadow: inset 0px 0px 15px 2px #3188A5;
	   }
	}
	#selectOffice{
	
		border:3px solid #C6CDCF;
		border-bottom:3px solid white;
		border-right:2px solid white;	
		color:#1071A9;
		padding:2px;
		width:150px;
	}
	.tdAdmin{
		background:url(../images/check.png);
		background-size:40px 60px;
		background-position:50% 10%;
		background-repeat:no-repeat;
		color:#789F79;
		text-align:center;
		vertical-align:text-top;
		opacity:.6;
		font-size:10px;
	}
</style>
<table id = "tableMainForum">
	<tr>
		<td style = "vertical-align:top;">
			<div id = "divForumContainer">
				<div id = "textAreaContainer">
					<textarea id = "textAreaForum"  ></textarea>
					<div style ="text-align:right;padding-right:20px;padding-top:10px;">
						
						<?php
							if($_SESSION['accountType'] >= 2){
								if($_SESSION['cbo'] ==  '1071' or $_SESSION['cbo'] ==  '1061'  or $_SESSION['cbo'] ==  '1081'){
						?>
									<div id ="submitForumMessage" onclick = "clickSendAnnouncement()" style = "float:left;margin-left:20px;">Post as Attention</div>	
						<?php
								}
							}
						?>
						<div id ="submitForumMessage" onclick = "clickSendMessage()">Send Message to</div>		
						<?php
							if($_SESSION['accountType'] > 1){
								echo '<select id = "selectOffice">';
								echo '	<option value ="all">All</option>';
										$record = $database->GetOffice();
										while($data = $database->fetch_array($record)){
											echo '<option value = "' . $data['Name'] . '">' . $data['Name'] . '</option>';
										}
									
								echo '</select>';
							}
							if($_SESSION['accountType'] == 1){
								echo '<select id = "selectOffice" style = "width:100px;">';
								echo '	<option value ="AllThree">All</option>';
								echo '	<option value ="CITY ACCOUNTANT\'S OFFICE">Accounting</option>';
								echo '	<option value ="CITY BUDGET OFFICE">Budget</option>';
								echo '	<option value ="GENERAL SERVICES OFFICE">GSO</option>';
								echo '	<option value ="CITY TREASURER\'S OFFICE">CTO</option>';
								echo '	<option value ="CITY ADMINISTRATOR\'S OFFICE">ADMIN</option>';
								echo '</select>';
								
							}
						?>
					</div>
				</div>
				<br>
				<!--divGoToMessage-->
				<div id = "divGoToMessage">
					&nbsp;&nbsp;&nbsp;Go To Message No: <input id ="inputGoToMessage" type="text" size = '6' onkeypress="return isMessageNumber(this,event)" maxlength = '4' class="textGoToMessage" value = ""><div id = "buttonGoToMessage" onclick="clickGoToMessage()"><!--<img src = '../images/arrow-1.png' width='13px' style="margin-top:2px;">--><!--&#9658--></div>
				<div id = "gotoResult"> </div>
				</div>
				<div id = "divForumMessageContainer">
					
				</div>
			</div>
		</td>
	</tr>	
</table>
<script>
	whenrefreshForum();
	
	function whenrefreshForum(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Document Tracking"){
			var cookieText = cookieLabel(cookieDoctrackMenu(),"doctrackMenuContainer");
			if(cookieText == "Forum"){
				loadForumMessages();
			}
		}
	}
	function clickSendMessage(){
		var message = document.getElementById('textAreaForum').value;
		if(message.length != 0){
			document.getElementById('textAreaForum').value = "";
			var messageType = document.getElementById('selectOffice');	
			
			if(messageType){
				messageType = messageType.value;
			}else{
				messageType = "client";
			}
			sendMessage(message,messageType);
		}else{
			alert("You haven't type a message.");
			document.getElementById('textAreaForum').focus();
		}
	}
	function clickSendAnnouncement(){
		var message = document.getElementById('textAreaForum').value;
		if(message.length != 0){
			document.getElementById('textAreaForum').value = "";
			var messageType = "Announcement";	
			sendMessage(message,messageType);
		}else{
			alert("You haven't type a message.");
			document.getElementById('textAreaForum').focus();
		}
	}
	
	function sendMessage(message,receiver){
		
		if(receiver == "Announcement"){
			var container = document.getElementById('attentionMessageContainer'); 
		}else{
			var container = document.getElementById('divForumMessageContainer'); 
		}
		
		var joiners = receiver + "^(*" + message;
		
		joiners = vScram(joiners);
		var queryString = "?uKxRbAUuSf=1&jhufYruX=" + encodeURIComponent(joiners); 
		//var queryString = "?sendForumMessage=1&forumMessage=" + message + "&receiver=" + receiver; 
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"uKxRbAUuSf");


	}
	function loadForumMessages(){
		var processorLink = "../ajax/dataprocessor.php"; 
		var queryString = "?dfdXsassdErf=1"; 
		var container = document.getElementById('divForumMessageContainer'); 
		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"kusdGrWvDFh");
	}
	function showReplyEditor(me){
		me.parentNode.style.display = "none";
		me.parentNode.parentNode.children[1].style.display = "block";
	}
	function hideReplyEditor(me){
		me.parentNode.style.display = "none";
		me.parentNode.parentNode.children[0].style.display = "block";
	}
	function submitReply(me){
		var  message  = me.parentNode.children[0].value;		
		if(message.length != 0){
			var confirmation = confirm("Post reply?");
			if(confirmation){
				var id = me.id;
				var messageId = id.replace("submitReply","");
				var receiverOffice = document.getElementById("tableResult" + messageId).children[0].children[0].childNodes[1].childNodes[0].innerHTML;		
				
				var joiners = messageId + "~*$" + receiverOffice + "~*$" + message;
				joiners = vScram(joiners);
					
				//var queryString = "?submitReply=1&messageId=" + messageId + "&message=" + message + "&receiverOffice=" + receiverOffice; 
				var queryString = "?zxRtaPxr=1&gZsayXfa=" + encodeURIComponent(joiners); 
				var container = document.getElementById('tableResult' + messageId); 
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"zxRtaPxr");
			}
		}else{
			alert("You haven't type a reply message.");
		}
	}
	
	
	function showReplies(me){
		var id  = me.id;
		var messageId = id.replace("repliesResult","");
		var joiners = messageId + "*&^(";
		joiners = vScram(joiners);
		
		var repCon = 'divReplyContainer' + messageId;
		var caption = me.innerHTML;
		length = caption.length;
		
		
		var queryString = "?cDsZrtEtrDFttrXly=1&xHbkuyShkuyt=" + encodeURIComponent(joiners); 
		var container = document.getElementById(repCon); 
		if(document.getElementById(repCon).style.display ==""){
			document.getElementById(repCon).style.display = "block";
			newCaption  = "&#9660; " + caption.substring(2,length);	
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"cDsZrtEtrDFttrXly");
		}else{
			if(document.getElementById(repCon).style.display == "block"){
				document.getElementById(repCon).style.display = "none";
				newCaption  = "&#9658; " + caption.substring(2,length);
			}else{
				document.getElementById(repCon).style.display = "block";
				newCaption  = "&#9660; " + caption.substring(2,length);
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"cDsZrtEtrDFttrXly");
			}
		}
		me.innerHTML =  newCaption;
	}
	function removeForumMessage(me){
		var confirmation = confirm("You are going to delete this message. Confirm action?");
		if(confirmation){
			var messageId =  me.id.replace("removeForumMessage","");
			
			var joiners = messageId + "%@!~";
			joiners  = vScram(joiners);
			var queryString = "?yudfhGYAsaYgmPsXstZ=1&kdfYuugZxSgdkYtraKXxTga=" + encodeURIComponent(joiners); 
			var container = document.getElementById('tableResult' + messageId); 

				loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"yudfhGYAsaYgmPsXstZ");
		}
	}
	function clickLoadMore(me){
		var parent = me.parentNode;
		parent.removeChild(me);
		var messageId = parent.children[parent.children.length-1].id.replace("tableResult","");
		
		var joiners = messageId + "*&^@";
		joiners = vScram(joiners);
		loader();
		var queryString = "?kusdGrWvDFh=1&jFvAGSvKhkyAx=" + encodeURIComponent(joiners); 
		var container = parent; 
		
		ajaxGetAndConcatenate(queryString,processorLink,container,"kusdGrWvDFh");
	}
	//---------------------------------------------------------------------------------------------------------------------------------------------
	
	function clickGoToMessage(){
		var goToMessage  = document.getElementById('inputGoToMessage').value;
		if(goToMessage == ""){
			alert("You haven't type a message number.");
		}
		else{
			loader();
			var joiners = goToMessage + "$#@&";
			joiners = vScram(joiners);
			
			var queryString = "?hsjuuw6YSDasuYsj=1&jFvAGSvmkyAx=" + encodeURIComponent(joiners); 
			var container = document.getElementById('divForumMessageContainer');
			
			ajaxGetAndConcatenate(queryString,processorLink,container,"hsjuuw6YSDasuYsj");
		}
	}
	
	function isMessageNumber(me,evt){
		  var number = me.value; 	 
          var charCode = (evt.which) ? evt.which : event.keyCode;
		  if(charCode == 44){
				return false;
		  }
		  if(charCode == 46){
				return false;
		  }   
          if (charCode != 46 && charCode > 31  && (charCode < 48 || charCode > 57)){
		  	 return false;
		  }else{
		  	 return true;
		  }     
       }
	//------------------------------------------------------------------------------------------------------------------------------------------------//
</script>


