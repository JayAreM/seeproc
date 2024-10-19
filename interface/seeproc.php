<?php
    session_start();
	require_once('../javascript/ajaxFunction.php');
	$dt = time();
	$dateEncoded = date('Y-m-d h:i A', $dt);
	$monthx  = date('m', $dt);
	$office = 0;
	$accountType = 0;
	$withSess = 0;
	$officeAccount = '';
	if(isset($_SESSION['officeCode'])) {
		$office = $_SESSION['officeCode'];
		$officeAccount = $_SESSION['officeCode'];
		$accountType = $_SESSION['accountType'];
		$withSess = 1;
	}

?>
<style>
	@font-face{
		font-family: NOR;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Abel-Regular.ttf);
	}
	@font-face{
		font-family: Anton;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Anton-Regular.ttf);
	}
	@font-face{
		font-family: Oxy;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Oxygen-Regular.ttf);
	}
	@font-face{
		font-family: Oswald;
		//src: url(fonts/Roboto-Light.ttf);
		//src: url(../fonts/Armata-Regular.ttf);
		//src: url(../fonts/Monda-Regular.ttf);
		//src: url(../fonts/Kameron-Regular.ttf);
		src: url(../fonts/Oswald-ExtraLight.ttf);
	}
	html {
    scroll-behavior: smooth;
}
div {
    scroll-behavior: smooth;
}
	body{
		padding:0px;
		margin:0px;
		font-family: NOR;
	}
	th.rotate {
	  /* Something you can count on */
		height: 186px;
		white-space: nowrap;
	}
	th.rotate > div {
		transform: 
		/* Magic Numbers */
		translate(6px, 80px)
		/* 45 is really 360 - 45 */
		/* rotate(315deg);*/
		rotate(290deg);
		width: 20px;
		float:right;
	}
	th.rotate > div > span {
		//border-bottom: 1px solid grey;
		font-size: 14px;
		font-weight: normal;
	}
	/*-----------------------------------------------------------------loader*/
	
	.loader{
			width:200px;
			height:200px;
			top:40%;
			background:url('../images/ajaxloader.gif');
			background-repeat:no-repeat;
		
			background-size:200px 200px;
			background-position:48% 48%;
			z-index:100;
	}	
	.loaderContainer{
		border:4px solid transparent;
		border-radius:2px;
		display:inline-block;	
		
	}
	.absoluteHolder1{
		z-index:105;
		position:absolute;
		text-align:center;
		background-color:rgba(252, 254, 254,.4);
		width:100%;
		height:100%;
	}

	
	
	
	.processLabel{
		color:white;
		background-color:#09324A;
	}
	
	
	.barPRdiv, .barPOdiv, .barPXdiv{
		width:100%;
		height:6px;
		//background-color:white;
		//box-shadow: 2px 0px 10px rgba(0, 0, 0,.6);
		//margin-left:10px;
		
	}
	.barPRdiv{
		background-color:rgb(126, 199, 25);
		box-shadow:2px 0px 10px rgba(0, 0, 0,.7);
		box-shadow:none;
	}
	.barPOdiv{
		//background-color:#60C56C;
		background-color:rgb(78, 187, 242);
	}
	.barPXdiv{
		//background-color:#EDA814;
		background-color:rgb(247, 187, 56);
	}
	.bulletPR, .bulletPO, .bulletPX{
		margin-right:-17px;
		margin-top:-11px;
		float:right; 
		cursor:pointer;
		width:10px;
		height:10px;
		display:inline-block;
		
		border-radius:50%;
		//box-shadow:5px 0px 10px rgb(46, 54, 64);
		background-color:white;
		background-color: rgb(180, 194, 200);
	}
	.bulletPR{
		background-color:rgb(126, 199, 25);
		border: 3px solid rgb(126, 199, 25); 
		//box-shadow:5px 0px 10px black;
		//box-shadow:none;
	}
	.bulletPO{
		background-color:rgb(78, 187, 242);
		border: 3px solid rgb(78, 187, 242); 
		//box-shadow:5px 0px 10px black;
		
	}
	.bulletPX{
		
		background-color:rgb(247, 187, 56);
		border: 3px solid rgb(247, 187, 56); 
		//box-shadow:5px 0px 10px black;
	}
	.bulletPRPending{
		background-color:rgb(255, 0, 0);
		border: 3px solid red; 
		//box-shadow:5px 0px 10px black;
		width:10px;
		height:10px;
		margin-top:-11px;
		margin-right:-17px;
	}
	.bulletPOPending{
		background-color:rgb(255, 0, 0);
		border: 3px solid red; 
		width:10px;
		height:10px;
		margin-top:-11px;
		margin-right:-17px;
		
	}
	.bulletPRfinished{
		background-color:white;
		border: 3px solid rgb(126, 199, 25); 
		box-shadow:5px 0px 10px black;
		box-shadow:0px 0px 2px 1px white;
		margin-top:-11px;
		margin-right:-17px;
	}
	.bulletPOfinished{
		background-color:white;
		border: 3px solid rgb(43, 195, 245); 
		box-shadow:0px 0px 2px 1px white;
		margin-top:-11px;
		margin-right:-17px;
	}
	
	.bulletPXfinished{
		background-color:white;
		border: 3px solid rgb(247, 187, 56); 
		//box-shadow:5px 0px 10px black;
		box-shadow:0px 0px 2px 1px white;
		margin-top:-11px;
		margin-right:-17px;
	}
	
	
	
	
	
		
	
	
	.prTD, .poTD,.pxTD{
		//background-color:#5C9AD3;
	}
	.prTD{
		//background-color:#1A536D;
	}
	.poTD{
		//background-color:#1A536D;
	}
	.pxTD{
		//background-color:#1A536D;
	}
	.headerTotalDaysA{
		background-color: transparent;	
		//display:none;
	}
	
	.headerTotalDaysB{
		//display:none;
		background-color: rgb(205, 210, 196);
		width:0px;
		padding:0;
		
	}
	.tdBorderHeader{
		background-color:rgb(9, 50, 74);	
		display:none;
	}
	.totalDaysTD{	
		display:none;
		font-size: 14px;
		//padding:0px 5px;
		//width:1px;
		color:white;
		text-align: center;
		border-right:1px solid #072732;
		border-left:1px solid #072732;
		
	}
	.tdDescriptionLabel{
		font-size: 18px;
	}
	
	.tdBorder{
		display:none;
		margin:0 auto;
		border-right:1px solid black;
		width:2px;
		padding:1px;
	}
	
	/*	#sheetTable tr:nth-child(even) > td{
		background-color:rgba(0, 4, 8,.1);
		border-bottom:1px solid rgba(0, 0, 0,.2);
	}*/
	#sheetTable{
		 box-shadow: 2px 3px 10px 0px rgba(3, 35, 71,.4);
	
	}
	#sheetTable td{
		vertical-align: top;
	}
	.processStatus{
		font-size:12px;
		letter-spacing: 1px;
		line-height: 12px;
	}
	.processPercentage{
		font-size: 14px;
		//margin-right: 8px;
		padding:0px 5px;
		width:50px;
		text-align: center;
		display: inline-block;
		//background-color: rgb(115, 96, 38);
		//background-color: rgb(40, 156, 215);
		color:white;
		font-family:Oswald;
		font-weight: bold;	
		//border:1px solid red;
		//margin-right: -60px;
	}
	.tdCompleteA{
		border-radius:5px 5px 0px 0px;
		background-color: rgb(61, 176, 233);
		border:1px solid white;
		padding:0;
		border-bottom:1px solid transparent;
		font-size: 12px;
	}
	.fromUpdatedDiv{
		color:white;
		text-align:center;
		
		font-size:14px;
	}
	#containerProcess{
		text-align:right;
		color:white;
		padding:3px 0px;
		//border:1px solid red;
		
	}
	.descriptions{
		font-size: 18px;
		font-weight: bold;
		//color:rgb(26, 98, 4);
	}
	.amounts{
		color:rgb(251, 87, 5);
		font-weight: bold;
		letter-spacing: 1px;
		font-size:14px;
	}
	.trackingNumbers{
		font-size: 14px;
		font-weight: bold;
		margin-top: 0px;
		padding:2px 0px;
		letter-spacing: 1px;
		text-align: left;
	}
	.trackingNumbers:hover{
		cursor:pointer;
		text-decoration:underline; 
	}
	.quarters{
		text-align: left;
		margin-top:10px;
	}
	.prAmount{
		text-align: right;
		color:silver;
		//font-weight: bold;
	}
	.funds{
		text-align: left;
	}
	.claimants{
		//color:rgb(2, 127, 189);
		//font-weight: bold;
		font-size:16px;
		
	}
	.statuses{
		margin-top:10px;
		//text-align: right;
		font-size: 14px;
		//color:white;
		font-weight: bold;
	}
	.statusOffice{
		//text-align: right;
	}
	.encoded{
		text-align: left;
	}
	.modified{
		//text-align: right;
	}
	.fromUpdated{
		padding:2px 0px;
		//color:white;
		//text-align: right;
	}
	.remarksContainer{
		display: block;
		margin-top: 10px;
		margin-bottom: 10px;
		width:70%;
		
	}
	.remarksContainerHide{
		display: none;
		
	}
	.remarks{
		padding:5px;
		//background: linear-gradient(to left,rgba(16, 40, 76,.5),transparent);
		//background-color: rgba(16, 40, 76,.2);
		border:1px solid rgba(7, 31, 68,.2);
	}
	.remarksLabel{
		padding-left:5px;
		padding-bottom: 2px;
		//font-weight: bold;
		color:white;
		letter-spacing: 1px;
		//background: linear-gradient(to left,rgba(4, 18, 39,.6),rgb(7, 31, 68));
		padding:2px 5px;
		white-space:nowrap;
		background-color: rgba(230, 60, 13,.8);
	}
	.processTime{
		
		margin-bottom: 10px;
		font-size: 12px;
	}
	.overtimeProcess{
		height:10px;
		width:10px;
		background-color:transparent;
		margin:0px 5px;
		border:1px solid black;
		display: inline-block;
	}
	.detailsContainer{
		font-size:14px;
		margin-bottom:10px; 
		line-height: 16px;
		//background-color: rgba(9, 44, 83,.2);
		//background-color: white;
		padding: 5px 10px;
		//border-left:1px solid rgba(235, 240, 246,.3);
		//box-shadow: 5px 2px 15px 0px rgba(2, 16, 32,.6);
		margin-right:80px;
		margin-left:0px;
		padding-left:0;
		//min-width: 200px;
	}
	.totalDaysLabel{
		color:silver;
		font-size: 16px;
		line-height: 15px;
		padding:0px 10px;
		text-align: center;
	}
	.totalDaysDiv{
		text-align: center;
		font-size:42px;
		line-height: 50px;
		font-family:anton;
		margin-top:20px;
	}
	.toolHeader{
		
		border-bottom:1px solid rgb(66, 101, 141);
		color:white; 
		font-size:10px;
		font-family: nor;
		letter-spacing:1px;
		white-space: nowrap;
		padding-left:5px;
		padding-right:25px;
	}
	.label{
		display: block;
		white-space: nowrap;
		font-size: 12px;
		color:white;
		width:90px;
		font-family:nor;
		color:white;
		text-align:right; 
		background: linear-gradient(to right, transparent ,rgb(104, 95, 0));
		padding:2px 5px;
	}
	.select{
		background-color: transparent;
		color:white;
		border:0px;
		outline: none;
		-moz-appearance: none; 
	}
	.number{
		width:25px;
		height:25px;
		display: inline-block;
		border-radius:25%;
		background-color:rgb(1, 135, 193);
		text-align: center;
	}
	.tableTools{
		width:100%;
		color:white;
		border-spacing:0;
	}
	.tdLabel{
		width:80px;
	}
	.labelTools{
		font-size: 12px;color:grey;
	}
	.generate{
		background-color:rgb(46, 94, 4);	
		
		color:white;
		font-size:14px;
		width:80px;
		text-align: center;
		padding:5px;
		
		border:1px solid rgba(114, 121, 107,.3);
		
		border-right:1px solid rgb(114, 121, 107);
		border-bottom:1px solid rgb(114, 121, 107);
		
		border-radius: 5px;
		box-shadow: 0px 0px 20px 10px rgb(24, 43, 5);
		cursor: pointer;
		transition: all .4s ease-in;
	}
	.generate:hover{
		letter-spacing:1px;
		background: linear-gradient(to right, rgba(60, 112, 4,.5) ,rgb(55, 95, 12));
		border-right:1px solid rgba(114, 121, 107,.6);
		border-bottom:1px solid rgba(114, 121, 107,.6);
	}
	.summaryStatus{
		text-align:right;
		font-size: 14px;
		
		white-space: nowrap;
		
	}
	.summaryCount{
		line-height: 24px;
		//font-size:22px;
		width:20%;
		//border-bottom:1px solid rgb(176, 182, 182);
		text-align: center;
		color:rgb(21, 54, 5);
	}
	.summaryCount:hover{
		font-weight: bold;
		cursor: pointer;
		background-color: rgb(197, 199, 152);
		border-bottom:1px solid transparent;
	}
	.summaryHeader{
		font-size: 16px;
		//font-weight: bold;
		letter-spacing: 1px;
		
		padding:0px 10px;
		//background-color: rgba(229, 241, 198,.3);
	
		
	}
	
	.summaryBudgetTd{
		border-bottom: 1px solid silver;
		text-align: right;
		padding-right:10px;
	}
	.summaryBudgetTotal{
		color:rgb(143, 99, 22);
		font-weight: bold;
		letter-spacing: 1px;
		font-size: 14px;
		text-align: right;
		padding-right:10px;
	}
	.trBudgetBreakdown:hover{
		background-color:rgba(248, 250, 199,.5);
		color:green;
		cursor: pointer;
	}
	.hoverTotal{
		cursor:pointer;text-align:right;font-size:26px;color:rgb(26, 41, 5);font-family:anton;
		color:rgb(26, 41, 5);
	}
	.hoverTotal:hover{
		color:black;
		
	}
	.trSummaryPR:hover{
		background-color: rgba(247, 250, 222,.3);
		cursor:pointer;
	}
	.expand{
		transition: all .2s ease-in;
		height:170px;
	}
	.collapse{
		transition: all .3s ease-in;
		height:0px;
	}
	.tools{
		width:20px;
		height:20px;
		margin:10px;
		margin-right:20px;
		
		background:url('../images/tools.png');
		background-repeat:no-repeat;
		background-size: 100%;
	}
	.trStatus{
		display: none;
	}
	#tableCalendar,#tableCalendarLogs{
		border-spacing: 0px;
		min-width: 1500px;
		padding:10px;

		text-align: center;
		background-color:rgb(241, 247, 239);
	}
	#tableCalendar tr,#tableCalendarLogs tr {
		text-align: center;
	}
	
	#tableCalendar td,#tableCalendarLogs td{
		border-bottom:1px solid  white;
		border-right:1px solid  white;
	}
	.weekend{
		background-color:rgb(219, 228, 209);
		width:35px;
		height:33px;
	}
	.weekdays{
		background-color: rgb(235, 236, 236);
		width:35px;
		height:33px;
	}
	
	.headerWeekdays{
		background-color: rgb(88, 122, 148);
		color:white;
		
	}
	.headerWeekend{
		background-color: rgb(114, 157, 13);
		color:white;
		font-weight: normal;
	}
	.headerWeekdays1{
		background-color: rgb(5, 34, 57);
		color:white;
		font-size: 10px;
		border-bottom: 1px solid rgba(223, 226, 227,.5);
		border-right: 1px solid rgba(223, 226, 227,.5);
		border-top: 1px solid rgba(223, 226, 227,.2);
		font-weight: normal;
		
	}
	.headerWeekend1{
		background-color: rgb(42, 56, 2);
		color:white;
		font-size: 10px;
		border-bottom: 1px solid rgba(223, 226, 227,.5);
		border-right: 1px solid rgba(223, 226, 227,.5);
		border-top: 1px solid rgba(223, 226, 227,.2);
		font-weight: normal;
	}
	.headerMonth{
		font-size: 20px;
		cursor: pointer;
		font-weight: normal;
	}
	.headerMonth:hover{
		background: rgb(253, 252, 213);
	}
	.headerMonthSelected{
		font-size: 24px;
		font-family: anton;
		color:rgb(13, 127, 214);
		font-weight: normal;
		background: linear-gradient(to bottom,transparent,rgb(232, 236, 220));
	}
	.calendarRegulatory{
		text-align: left;
		padding:10px;
		font-size: 14px;
		font-weight: bold;
		background: linear-gradient(to left,transparent,rgb(209, 238, 248));
		
	}
	.calendarDocument{
		text-align: left;
		white-space: nowrap;
		font-size: 12px;
		padding:0px 10px;
		padding-left:30px;
		
	}
	.calendarStatus{
		text-align: left;
		font-size: 12px;
		padding:0px 10px;
		padding-left: 5px;
		border-right:1px solid red;
		width:120px;
	}
	.rowTotal{
		background-color:rgb(101, 114, 97);
		color:white;
	}
	.trCalendar:hover > td{
		background-color:rgb(252, 248, 186);
		color:black;
		font-weight: bold;
	}
	.trSelected{
		background-color:rgb(252, 248, 186);
		width:30px;
		height:30px;
	}
	.trCalendar td:hover{
		background-color: rgb(191, 223, 138);
		cursor: pointer;
		font-weight: bold;
		
	}
	.num{
		width:12px;
		height:12px;
		display: inline-block;
		background-color: white;
		margin-right: 5px;
		border-radius:3px;
		margin-bottom: -1px;
		border:1px solid white;
		box-shadow: 0x 0px 4px 2px white;
	}
	.numUsers{
		width:15px;
		height:15px;
		padding:2px;
		display: inline-block;
		background-color: white;
		margin-right: 5px;
		border-radius:3px;
		text-align:center;
		font-weight: normal;
		font-size: 12px;
	}
	#regulatoryTable th{
		padding:4px 20px;
		border:0;
	}
	.regulatoryMenuSelected{
		background-color:rgb(13, 127, 214);
		color:white;
		font-weight: bold;
	}
	.regulatoryMenu{
		background-color:transparent;
		color:silver;
		cursor: pointer;
		font-weight: normal;
	}
	#tableCalendarDetails{
		border:1px solid silver;
		padding:10px;
		border-spacing: 0px;
	}
	#tableCalendarDetails td{
		text-align: left;
		padding:2px 5px;
		border:0;
		border-bottom: 1px solid white;
	}
	#tableCalendarDetails th{
		text-align: left;
		padding:2px 5px;
	}
	.trCalendarDetails:hover > td{
		background-color:rgb(252, 248, 186);
		cursor: pointer;
	}
	.topTable{
		margin:20px auto;
		margin-top:50px;
		border-spacing: 0;
	}
	.topTable td{
		margin:0 auto;
		padding:4px 10px;
		text-align: center;
		//background-color: white;
		border-bottom: 1px solid rgb(249, 249, 244);
	}
	
	
	.topTable tr:hover > td{
		background-color: rgb(254, 241, 121);
	}
	.topTable tr:hover > td:last-child > div{
		background-color: rgb(254, 241, 121);
	}
	.topTable tr:hover > td:first-child > div{
		background-color: rgb(254, 241, 121);
	}
	.topTable th{
		padding:2px 10px;
		font-weight: normal;
	}
	#tableTopQuarter td{
		padding:0px 2px;
	}
	#tableTopQuarter td:nth-child(even){
		padding-right:20px;
	}
	#menuTable tr > td >label{
		cursor: pointer;
	}
	#menuTable tr > td >label:hover:before {
		color: silver;
		cursor: pointer;
		content: '';
	
		height:10px;
		width:10px;
		background-color: orange;
		padding:5px;
		position: absolute;
		margin-left:-25px;
		border-radius: 2px;
		border-right: 1px solid black;
	}
</style>


<div style ="">
	<div style ="background-color:rgb(32, 50, 4);position: fixed;width:100%;">
		<div style="background: linear-gradient(to right,rgb(28, 74, 8) ,rgb(1, 12, 38));padding:5px 20px;padding-bottom:0px;">
			
			<table style="font-size:32px; color:white;font-family: Anton;border-spacing: 0;" border ="0">
				<tr>
					<td >
						 
						 	
						 <span style ="margin-left:0px;padding-right: 5px;font-weight: bold;">C-PROC</span><span style ="color:rgb(35, 148, 200);padding-right:10px;">2023</span>
					</td>
					<td>
						<table>
							<tr>	
								<td style ="color:white;height:50%;vertical-align:bottom;font-family: nor;font-size: 12px;border-bottom:1px solid rgb(53, 80, 2);">City Procurement Monitoring System</td>
							</tr>
							<tr>
								<td style ="color:silver;height:14px;vertical-align:top; font-family: nor;font-size: 12px;line-height: 7px;">Document Tracking System </td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<div id  ="tdTools" class = "collapse" style ="overflow: hidden;">
			<table border = "0" style ="margin:10px;margin-bottom: 20px;">
				<tr>
					<td style ="vertical-align: top;background: linear-gradient(to right, rgba(48, 82, 46,.2) ,transparent);" colspan="4">
							<table class ="tableTools" border ="0">
								<tr>
									<td class ="header" ><div class ="number">1</div><span class ="toolHeader">IMPLEMENTING OFFICE</span></td>
								</tr>	
								<tr>
									<td style = "padding:2px;" >
										<table style ="border-spacing:0;" border ="0">
											<tr style ="">
												<td > <div class ="label">Name</div></td>
												<td style ="">
													<?php
														$selDisable = 'disabled';
														if($officeAccount == 'TRAC' || $accountType == 7) {
															$selDisable = '';
														}
													?>
													<select id  = "toolsOffice" class ="select"  style ="background-color:rgb(32, 50, 4);" <?= $selDisable ?>>
															<?php
															$sql = "Select * from office where PR > 0 order by Name asc";
															$record = $database->query($sql);
															if($office != 0){
																if($office == $officeAccount) {
																	echo '<option value ="' . $office . '" selected>' . $_SESSION['officeName'] . '</option>';
																}else {
																	echo '<option value ="' . $office . '">' . $_SESSION['officeName'] . '</option>';
																}
															}
															
															while($data = $database->fetch_array($record)){
																$office = ucwords(strtolower($data['Name']));
																$pr = $data['PR'];
																$code = $data['Code'];
																
																echo '<option value ="' . $code . '">' .   $office . '</option>';
															}
															echo '<option value ="All">All Offices</option>';
														?>
													</select>
													<label for ="sortBy"></label>
												</td>
											</tr>
										</table>
									</td>
								</tr>	
							</table>
						</td>
				</tr>
				<tr>
						<td style ="vertical-align: top;padding-top:10px;">
							<table  class ="tableTools" border ="0">
								<tr>
									<td colspan="2" class ="header" ><div class ="number">2</div><span class ="toolHeader">REGULATORY OFFICE</span></td>
								</tr>	
								<tr>
									<td style = "padding:2px;" >
										<table style ="border-spacing:0;" border ="0">
											<tr style ="">
												<td class = "tdLabel"> <div class ="label">Name</div></td>
												<td >
													<select id  = "toolsRegulatory" class ="select"  onchange = "changeRegulatory()">
														<option>-</option>
														<option>City Accountant's Office</option>
														<option>City Administrator's Office</option>
														<option>City Budget Office</option>
														<option>General Service Office</option>
														<option>City Treasurer's Office</option>	
														<option>Bids and Awards Committee</option>
													</select>
													<label for ="sortBy"></label>
												</td>
											</tr>
										</table>
									</td>
								</tr>	
							</table>
						</td>
						<!--transaction type-->
						<td style ="vertical-align: top;padding-top:10px;">
							<table  class ="tableTools" border ="0">
								<tr>
									<td colspan="2" class ="header" ><div class ="number">3</div><span class ="toolHeader">SELECT TRANSACTION</span></td>
								</tr>	
								<tr>
									<td style = "padding:2px;" >
										<table style ="border-spacing:0;width:100%;" border ="0">
											<tr style ="">
												<td class = "tdLabel"> <div class ="label">Type</div></td>
												<td >
													<select id  = "toolsType" class ="select"  onchange = "changeType()" >
														<option>-</option>	
														<option value ="PR">Purchase Request</option>
														<option value ="PO">Purchase Order</option>
														<option value ="PX">Payment</option>	
														
													</select>
													<label for ="sortBy"></label>
												</td>
											</tr>
											<tr style ="">
												<td class = "tdLabel"> <div class ="label">Quarter</div></td>
												<td >
													<select id  = "toolsQuarter" class ="select" >
														<option>-</option>
														
													</select>
													<label for ="sortBy"></label>
												</td>
											</tr>
										</table>
									</td>
								</tr>	
							</table>
						</td>
						<!--progress status-->
						<td style ="vertical-align: top;padding-top:10px;">
							<table  class ="tableTools" border ="0">
								<tr>
									<td colspan="2" class ="header" ><div class ="number">4</div><span class ="toolHeader">TRANSACTION PROGRESS</span></td>
								</tr>	
								<tr>
									<td style = "padding:2px;" >
										<table style ="border-spacing:0;width:100%;" border ="0">
											<tr style ="">
												<td class = "tdLabel"> <div class ="label">Percentage From</div></td>
												<td >
													<select id  = "pFrom" class ="select" style ="text-align: center;" onchange ="selectPercentage()" >
														<option>-</option>
														<?php
															for($i = 1; $i <= 100; $i++){
																echo '<option value ="' . $i . '">' .   $i . '</option>';
															}
														?>	
													</select><label for ="pFrom" class ="labelTools">%</label>
													
												</td>
											</tr>
											<tr style ="">
												<td class = "tdLabel"> <div  class ="label">Percentage To</div></td>
												<td >
													<select id  = "pTo"  class ="select" style ="text-align: center;" onchange ="selectPercentage()"  >
														<option>-</option>
														<?php
															for($i = 1; $i <= 100; $i++){
																echo '<option value ="' . $i . '">' .   $i . '</option>';
															}
														?>
													</select><label for ="pTo" class ="labelTools">%</label>
												</td>
											</tr>
										</table>
									</td>
								</tr>	
							</table>
						</td>
						<!--last updated-->
						<td style ="vertical-align: top;padding-top:10px;">
							<table  class ="tableTools" border ="0">
								<tr>
									<td colspan="2" class ="header" ><div class ="number">5</div><span class ="toolHeader">DURATION</span></td>
								</tr>	
								<tr>
									<td style = "padding:2px;" >
										<table style ="border-spacing:0;width:100%;" border ="0">
											<tr style ="">
												<td class = "tdLabel"> <div class ="label">Last Updated</div></td>
												<td >
													<select id  = "updatedSelect" class ="select" style ="text-align: center;"  onchange ="selectDuration(this)">
														<?php
															echo '<option >-</option>';
															for($i = 1; $i < 200; $i++){
																echo '<option value ="' . $i . '">' .   $i . '</option>';
															}
														?>	
													</select><label for ="updatedSelect" class ="labelTools" >days ago</label>
												</td>

											</tr>
											<tr style ="">
												<td class = "tdLabel"> <div class ="label">Since Created</div></td>
												<td >
													<select  id  = "createdSelect" class ="select" style ="text-align: center;"   onchange ="selectDuration(this)">
														<?php
															echo '<option >-</option>';
															for($i = 1; $i < 200; $i++){
																echo '<option value ="' . $i . '">' .   $i . '</option>';
															}
														?>
													</select><label class ="labelTools">days ago</label>
												</td>
											</tr>
										</table>
									</td>
								</tr>	
							</table>
						</td>
						<td>
							<table class ="tableTools" style = "padding-top:10px;" border ="0">
								<tr>
									<td colspan="2" class ="header" ><div class ="number">6</div><span class ="toolHeader">DATA ARRANGEMENT</span></td>
								</tr>	
								<tr>
									<td style = "padding:2px;" >
										<table  border ="0">
											<tr>
												<td class = "tdLabel"> <div class ="label">Sort By</div></td>
												<td >
													<select id  = "toolsField" class ="select"  >
														
													</select>
													<label for ="sortBy"></label>
												</td>
											</tr>
											<tr >
												<td class = "tdLabel"><div class ="label">Order</div></td>
												<td >
													<select id  = "toolsOrder"  class ="select" >
														<option value ="Asc">Ascending</option>
														<option value  ="Desc">Descending</option>
													</select>
												</td>
											</tr>
										</table>
									</td>
								</tr>	
							</table>
						</td>
						<td style ="vertical-align: top;">
							<table class ="tableTools" style = "padding-top:10px;" border ="0">
								<tr>
									<td colspan="2" class ="header" ><div class ="number">7</div><span class ="toolHeader">GET RECORD</span></td>
								</tr>	
								<tr>
									<td style = "padding:2px;" >
										<table  border ="0">
											<tr>
												<td> </td>
												<td style="padding-left:20px;padding-top:10px;">
													<div class ="generate" onclick ="goSeeProc()">
														Generate 
													</div>
												</td>
											</tr>
										</table>
									</td>
								</tr>	
							</table>
						</td>
						
					</tr>
			</table>
		</div>
		<div style ="background: linear-gradient(to right, black ,rgb(65, 97, 2));padding-left:20px;">
			<table id ="menuTable" style ="color:white;font-size: 16px;width:100%;border-spacing:0;  -webkit-user-select: none;" border ="0">
				<tr>
					<td  style =""><input id ="menu1" type ="checkbox" autocomplete="off" class="checkboxMenu" onclick ="selectMenu(this)"></td>
					<td  style =""><label for ="menu1">BUDGET</label></td>
					<td  style ="padding-left:20px;"><input id ="menu2"  type ="checkbox" class="checkboxMenu" autocomplete="off" onclick ="selectMenu(this)"></td>
					<td  style =""><label for ="menu2">TRANSACTIONS</label></td>
					<td  style ="padding-left:20px;"><input id ="menu3"  type ="checkbox" class="checkboxMenu" autocomplete="off"   onclick ="selectMenu(this)"></td>
					<td  style =""><label for ="menu3">STATUS</label></td>
					<td  style ="padding-left:20px;"><input id ="menu4"  type ="checkbox"  class="checkboxMenu" autocomplete="off" onclick ="selectMenu(this)"></td>
					<td  style =""><label for ="menu4">ANALYTICS</label></td>

					<?php if($accountType == 1 || $accountType == 2 || $accountType == 4 || $accountType == 7 || $officeAccount == 'TRAC'): ?>
					<td  style ="padding-left:20px;"><input id ="menu12"  type ="radio" name ="calender" autocomplete="off"   onclick ="selectMenuRadio(this)"></td>
					<td  style =""><label for ="menu12">MY&nbsp;CALENDAR</label></td>
					<?php endif; ?>
					
					<?php if($accountType == 4 || $accountType == 7 || $officeAccount == 'TRAC'): ?>
					<td  style ="padding-left:20px;"><input id ="menu6"  type ="radio" name ="calender" autocomplete="off" onclick ="selectMenuRadio(this)"></td>
					<td  style =""><label for ="menu6">CALENDAR&nbsp;CURRENT</label></td>
					<td  style ="padding-left:20px;"><input id ="menu7"  type ="radio" name ="calender" autocomplete="off" onclick ="selectMenuRadio(this)"></td>
					<td  style =""><label for ="menu7">CALENDAR&nbsp;LOGS</label></td>
					<td  style ="padding-left:20px;"><input id ="menu8"  type ="radio" name ="calender" autocomplete="off" onclick ="selectMenuRadio(this)"></td>
					<td  style =""><label for ="menu8">CALENDAR&nbsp;USERS</label></td>
					<?php endif; ?>

					<?php if($officeAccount == 'TRAC' || $accountType == 7): ?>
					<td  style ="padding-left:20px;"><input id ="menu9"  type ="radio" name ="calender" autocomplete="off"   onclick ="selectMenuRadio(this)"></td>
					<td  style =""><label for ="menu9">EFFICIENCY&nbsp;RANKING</label></td>
					<td  style ="padding-left:20px;"><input id ="menu10"  type ="radio" name ="calender" autocomplete="off"   onclick ="selectMenuRadio(this)"></td>
					<td  style =""><label for ="menu10">PENDING&nbsp;METRICS&nbsp;RANKING</label></td>
					<td  style ="padding-left:20px;"><input id ="menu11"  type ="radio" name ="calender" autocomplete="off"   onclick ="selectMenuRadio(this)"></td>
					<td  style =""><label for ="menu11">PERFORMANCE</label></td>
					<td  style ="padding-left:20px;"><input id ="menu13"  type ="radio" name ="calender" autocomplete="off"   onclick ="selectMenuRadio(this)"></td>
					<td  style =""><label for ="menu13">PERFECT&nbsp;PERFORMANCE</label></td>
					<td  style ="padding-left:20px;"><input id ="menu14"  type ="radio" name ="calender" autocomplete="off"   onclick ="selectMenuRadio(this)"></td>
					<td  style =""><label for ="menu14">Viewer&nbsp;Logs</label></td>
					<?php endif; ?>

					<td  style ="width:100%;"></td>
					
					<td  style =""><div  class="tools" onclick="showTools()"></div></td>
				</tr>
			</table>
		</div>
	</div>
	<table border = "0" style="width:100%;height:100%;border-spacing:0;">
		<tr>
			<td  style ="height:100%;vertical-align: top;background: linear-gradient(to left, rgba(227, 231, 234,.9) ,rgb(231, 235, 229));padding:40px 10px;padding-top:120px;transition: all .3s ease-in;">
				<div id = "mainSeeProc"></div>
				<div class ="mainContainer"  style ="display:none;" id = "mainCalendar6"></div>
				<div class ="mainContainer" style ="display:none;" id = "mainCalendar7"></div>
				<div class ="mainContainer" style ="display:none;" id = "mainCalendar8"></div>
				<div class ="mainContainer" style ="display:none;" id = "mainCalendar9"></div>
				<div class ="mainContainer" style ="display:none;" id = "mainCalendar10"></div>
				<div class ="mainContainer" style ="display:none;" id = "mainCalendar11"></div>
				<div class ="mainContainer" style ="display:none;" id = "mainCalendar12"></div>
				<div class ="mainContainer" style ="display:none;" id = "mainCalendar13"></div>
				<div class ="mainContainer" style ="display:none;" id = "mainCalendar14"></div>
			</td>
		</tr>
		<tr>
			<td style = "height: 20px">
				<div style ="height:30px;width:25px;margin:0 auto;border-radius:5px;opacity:.5;
				background:url(../images/system2.png);background-size:80%; background-color:rgba(251, 250, 250,.9); background-repeat: no-repeat; display:none;"></div>
			</td>
		</tr>
	</table>
	
</div>
<script>

	var withSess = <?= $withSess ?>;

	if(withSess == 1) {
		refreshSelection();
		goSeeProc();
		showCalendar();
		showCalendar1();
		showCalendar2();
		showTop();
		showTopPending();
		showPerformance();
		showCalendar3();
		showPerfectPerformance();
		showCalendar4();
	}else {
		logout();
	}


	//menu6.click();
	var monthDefault = "<?php echo $monthx; ?>";

	// menu12.click();
	// menu13.click();

	function showPerfectPerformance(){
		var queryString = "?showPerfectPerformance=1";
		var container = document.getElementById("mainCalendar13");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}

	function selectmonthOffice(month){
		monthDefault = month;
		var rO = encodeURIComponent(getSelectText(toolsRegulatory).trim());
		var rC = toolsOffice.value;
		loader();
		
		var queryString = "?showCalendarDataOffice=1&m=" + month + "&rO=" + rO + "&rC=" + rC;
		var container = document.getElementById("mainCalendar12");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}

	// function selectmonthJay(month) {
	// 	monthDefault = month;
		
	// 	var rO = encodeURIComponent(getSelectText(toolsRegulatory).trim());
	// 	var rC = toolsOffice.value;
	// 	loader();
	// 	var queryString = "?showCalendarOfficeJay=1&m=" + month + "&rO=" + rO + "&rC=" + rC;
	// 	var container = document.getElementById("mainCalendar14");
	// 	console.log(month);	
	// 	ajaxGetAndConcatenate(queryString, processorLink, container, "returnOnlyLoader");
	// }
	function selectmonthJay(month) {
		monthDefault = month;
		
		var rO = encodeURIComponent("CBO Received"); // Set rO to "CBO Received"
		var rC = toolsOffice.value;
		loader();
		var queryString = "?showCalendarOfficeJay=1&m=" + month + "&rO=" + rO + "&rC=" + rC;
		var container = document.getElementById("mainCalendar14");
		console.log(month);    
		ajaxGetAndConcatenate(queryString, processorLink, container, "returnOnlyLoader");
	}


	function clickRegulatoryOffice(me){
		var name = me.textContent;
		var parent = me.parentNode;
		for(var i = 0; i < parent.children.length;i++){
			parent.children[i].className = 'regulatoryMenu';
		}
		me.className = 'regulatoryMenuSelected';
		if(name == "ALL"){
			name = '-';
		}
		var rO = encodeURIComponent(name);
		var rC = toolsOffice.value;
		var queryString = "?showCalendarDataOffice=1&m=" + monthDefault + "&rO=" + rO + "&rC=" + rC;
		var container = document.getElementById("mainCalendar12");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");		
	}

	function clickRegulatoryOfficeJay(me){
		var name = me.textContent;
		var parent = me.parentNode;
		for(var i = 0; i < parent.children.length;i++){
			parent.children[i].className = 'regulatoryMenu';
		}
		me.className = 'regulatoryMenuSelected';
		if(name == "ALL"){
			name = '-';
		}
		var rO = encodeURIComponent(name);
		var rC = toolsOffice.value;
		loader();
		var queryString = "?showCalendarOfficeJay=1&m=" + monthDefault + "&rO=" + rO + "&rC=" + rC;
		var container = document.getElementById("mainCalendar14");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
				
	}

	function fetchByDayCalendarOffice(par){
		var rC = toolsOffice.value;
		var queryString = "?fetchByDayCalendarOffice=1&par=" + encodeURIComponent(par) + "&rC=" + rC;
		var container = document.getElementById("calendarContainerUsers1");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}

	function fetchByDayCalendarJay(par,condition){
		var rC = toolsOffice.value;
		loader();
		var queryString = "?fetchByDayCalendarJay=1&par=" + encodeURIComponent(par) + "&rC=" + rC + "&condition=" + condition;
		var container = document.getElementById("calendarContainerUsers2");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoaderjay");


		console.log(par);
	}

	function showCalendar3() {
		var rO = encodeURIComponent(getSelectText(toolsRegulatory).trim());
		var rC = toolsOffice.value;
		var queryString = "?showCalendarOffice=1&rO=" + rO + "&rC=" + rC;
		var container = document.getElementById("mainCalendar12");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}

	function showCalendar4() {
		var queryString = "?showCalendarOfficeJay=1";
		var container = document.getElementById("mainCalendar14");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}
	
	function showPerformance(){
		var queryString = "?showPerformance=1";
		var container = document.getElementById("mainCalendar11");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}

	function showPemerankALL(){
		loader();
		var parent = document.getElementById('tableTopPendingQuarter');
		var inp = parent.children[0].children[0].getElementsByTagName('input');
		var qtr =0;
		for(var i = 0 ; i <= 4; i++){
			if(inp[i].checked){
				qtr = i + 1;
			}
		}
		var trans  = checkedTopPendingTrans();
		var queryString = "?showPemerankALL=1&trans=" + trans + "&qtr=" + qtr ;
		var container = document.getElementById("topPendingOfficeList" + qtr);
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadMore");
	}

	function showPendingOfficeList(me,par){
		var status = par;
		var office = encodeURIComponent(me.children[1].textContent);
		var parent = document.getElementById('tableTopPendingQuarter');
		var inp = parent.children[0].children[0].getElementsByTagName('input');
		var qtr =0;
		for(var i = 0 ; i <= 4; i++){
			if(inp[i].checked){
				qtr = i + 1;
			}
		}
		loader();
		var trans  = checkedTopPendingTrans();
		var queryString = "?showPendingOfficeList=1&stat=" + status + "&trans=" + trans + "&qtr=" + qtr + "&of=" + office;
		var container = document.getElementById("topPendingOfficeList" + qtr);
		ajaxGetAndConcatenate(queryString,processorLink,container,"loadMore");
		
	}

	function selectTopPendingQuarter(me,par){
		if(me.checked){
			if(par == 5){
				var parent = document.getElementById('tableTopPendingQuarter');
				var inp = parent.children[0].children[0].getElementsByTagName('input');
				for(var i = 0 ; i < 4; i++){
					if(inp[i].checked){
						inp[i].click();
					}
				}
			}else{
				if(document.getElementById("topPendingTable5")){
					document.getElementById("chkTopPendingAll").checked = false;
					document.getElementById("topPendingContainer").removeChild(document.getElementById("topPendingTable5"));
				}
			}
			var trans = checkedTopPendingTrans();
			loader();
			var queryString = "?showTopPendingClick=1&qtr=" + par + "&trans=" + trans;
			var container = document.getElementById("topPendingContainer");
			ajaxGetAndConcatenate(queryString,processorLink,container,"loadMore");
		}else{
			
			var id  = "topPendingTable" + par;
			var table = document.getElementById(id);
			document.getElementById("topPendingContainer").removeChild(table);
		}
	}
	
	function selectTopQuarter(me,par){
		if(me.checked){
			if(par == 5){
				var parent = document.getElementById('tableTopQuarter');
				var inp = parent.children[0].children[0].getElementsByTagName('input');
				for(var i = 0 ; i < 4; i++){
					if(inp[i].checked){
						inp[i].click();
					}
				}
			}else{
				if(document.getElementById("topTable5")){
					document.getElementById("chkTopAll").checked = false;
					document.getElementById("topContainer").removeChild(document.getElementById("topTable5"));
				}
			}
			
			var trans = checkedTopTrans();
			var type =checkTopType("tableTopType");
			
			loader();
			var queryString = "?showTopClick=1&qtr=" + par + "&trans=" + trans + "&type=" + type;
			
			var container = document.getElementById("topContainer");
			ajaxGetAndConcatenate(queryString,processorLink,container,"loadMore");
		}else{
			var id  = "topTable" + par;
			var table = document.getElementById(id);
			document.getElementById("topContainer").removeChild(table);
		}
	}
	
	function checkedTopPendingTrans(){
		var parent = document.getElementById('tableTopPendingTransaction');
		var chkTrans = parent.children[0].getElementsByTagName('input');
		var trans = '';
		var trans1 = '';
		for(var i = 0; i < chkTrans.length; i++){
			if(chkTrans[i].checked){
				if(i == 0){
					trans += ",'For P.O'";
					trans1 += ",Purchase Request";
				}else if(i == 1){
					trans += ",'Waiting for Delivery'";
					trans1 += ",Purchase Order";
				}else{
					trans += ",'Check Released'";
					trans1 += ",Payment";
				}
			}
		}
		if(trans.length > 0){
			trans = "(" + trans.substring(1) + ")";
		}else{
			trans = "('For P.O','Waiting for Delivery','Check Released')";
			for(var i = 0; i < chkTrans.length; i++){
				chkTrans[i].checked = true;
			}	
		}
		if(trans1.length > 0){
			trans1 = "(" + trans1.substring(1) + ")";
		}else{
			trans1 = "(Purchase Request, Purchase Order, Payment)";
		}
		return trans + "~!~" + trans1;
	}
	function checkTopType(table){
		var parent = document.getElementById(table);
		var chkType = parent.children[0].getElementsByTagName('input');
		var x = '';
		
		for(var i = 0; i < chkType.length; i++){
			
			if(chkType[i].checked){
				x += ',' + chkType[i].value;
			}
		}
		if(x ==''){
			chkType[0].checked = true;
			x = ',1';
		}
		return x.substring(1);
	}
	function checkedTopTrans(){
		var parent = document.getElementById('tableTopTransaction');
		var chkTrans = parent.children[0].getElementsByTagName('input');
		var trans = '';
		var trans1 = '';
		for(var i = 0; i < chkTrans.length; i++){
			if(chkTrans[i].checked){
				if(i == 0){
					trans += ",'For P.O'";
					trans1 += ",Purchase Request";
				}else if(i == 1){
					trans += ",'Waiting for Delivery'";
					trans1 += ",Purchase Order";
				}else{
					trans += ",'Check Released'";
					trans1 += ",Payment";
				}
			}
		}
		if(trans.length > 0){
			trans = "(" + trans.substring(1) + ")";
		}else{
			trans = "('For P.O','Waiting for Delivery','Check Released')";
			for(var i = 0; i < chkTrans.length; i++){
				chkTrans[i].checked = true;
			}	
		}
		if(trans1.length > 0){
			trans1 = "(" + trans1.substring(1) + ")";
		}else{
			trans1 = "(Purchase Request, Purchase Order, Payment)";
		}
		return trans + "~!~" + trans1;
	}
	
	function showTopPending(){
		var queryString = "?showTopPending=1";
		var container = document.getElementById("mainCalendar10");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}
	function showTop(){
		var queryString = "?showTop=1";
		var container = document.getElementById("mainCalendar9");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}
	function fetchByDayCalendarUsers(par){
		
		var queryString = "?fetchByDayCalendarUsers=1&par=" + encodeURIComponent(par);
		var container = document.getElementById("calendarContainerUsers");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}
	function selectmonthUsers(month){
		monthDefault = month;
		var rO = encodeURIComponent(getSelectText(toolsRegulatory).trim());
		loader();
		
		var queryString = "?showCalendarDataUsers=1&m=" + month + "&rO=" + rO;
		var container = document.getElementById("mainCalendar8");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	function clickRegulatoryUsers(me){
		var name = me.textContent;
		var parent = me.parentNode;
		for(var i = 0; i < parent.children.length;i++){
			parent.children[i].className = 'regulatoryMenu';
		}
		me.className = 'regulatoryMenuSelected';
		if(name == "ALL"){
			name = '-';
		}
		var rO = encodeURIComponent(name);
		var queryString = "?showCalendarDataUsers=1&m=" + monthDefault + "&rO=" + rO;
		var container = document.getElementById("mainCalendar8");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");		
	}
	function showCalendar2(){
		var rO = encodeURIComponent(getSelectText(toolsRegulatory).trim());
		var queryString = "?showCalendarUsers=1&rO=" + rO;
		var container = document.getElementById("mainCalendar8");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}
	
	function selectMenuRadio(me){
		var id  = me.id.replace("menu","");
		clearContainer();
		clearCheckMenu();
		document.getElementById("mainCalendar" + id).style.display = "block";
		document.getElementById("mainSeeProc").style.display = "none";

		if(id == 12) {
			showCalendar3();
		}
		if(id == 14) {
			showCalendar4();
		}
	}
	function clearRadio(){
		var arr = document.getElementsByName("calender");
		for(var i = 0 ; i < arr.length; i++ ){
			arr[i].checked = false;
		}
	}
	function clearContainer(){
		var arr  = document.getElementsByClassName("mainContainer");
		for(var i = 0 ; i < arr.length; i++){
			arr[i].style.display = "none";
		}
	}
	function clearCheckMenu(){
		var arr  = document.getElementsByClassName("checkboxMenu");
		for(var i = 0 ; i < arr.length; i++){
			arr[i].checked = false;
		}
	}
	function clickCalendarTR(me){
		me.className = "trSelected";
	}
	function showCalendarPerTN(me){
		var tn = me.textContent;
		window.open('../interface/calendar1seeproc.php?tn=' + tn );	
	}
	function fetchByDayCalendarLogs(par){
		loader();
		var queryString = "?fetchByDayCalendarLogs=1&par=" + encodeURIComponent(par);
		var container = document.getElementById("calendarContainerLogs");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	function fetchByDayCalendar(par){
	
		var queryString = "?fetchByDayCalendar=1&par=" + encodeURIComponent(par);
		var container = document.getElementById("calendarContainer");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}
	function clickRegulatoryLogs(me){
		var name = me.textContent;
		var parent = me.parentNode;
		for(var i = 0; i < parent.children.length;i++){
			parent.children[i].className = 'regulatoryMenu';
		}
		me.className = 'regulatoryMenuSelected';
		if(name == "ALL"){
			name = '-';
		}
		var rO = encodeURIComponent(name);
		var queryString = "?showCalendarDataLogs=1&m=" + monthDefault + "&rO=" + rO;
		var container = document.getElementById("mainCalendar7");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");		
	}
	function clickRegulatory(me){
		var name = me.textContent;
		var parent = me.parentNode;
		for(var i = 0; i < parent.children.length;i++){
			parent.children[i].className = 'regulatoryMenu';
		}
		me.className = 'regulatoryMenuSelected';
		if(name == "ALL"){
			name = '-';
		}
		var rO = encodeURIComponent(name);
		var queryString = "?showCalendarData=1&m=" + monthDefault + "&rO=" + rO;
		var container = document.getElementById("mainCalendar6");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");		
	}
	function clickCalendarTR(me){
		var parent  = me.children.length;
		for(var i = 0 ; i < parent; i++){
			me.children[i].style.backgroundColor = "rgb(178, 211, 124)"; 	
		}
	}
	function selectmonthLogs(month){
		monthDefault = month;
		var rO = encodeURIComponent(getSelectText(toolsRegulatory).trim());
		loader();
		var queryString = "?showCalendarDataLogs=1&m=" + month + "&rO=" + rO;
		var container = document.getElementById("mainCalendar7");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}
	function selectmonth(month){
		monthDefault = month;
		var rO = encodeURIComponent(getSelectText(toolsRegulatory).trim());
		
		loader();
		var queryString = "?showCalendarData=1&m=" + month + "&rO=" + rO;
		var container = document.getElementById("mainCalendar6");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnlyLoader");
	}

	
	function showCalendar(){
	
		var rO = encodeURIComponent(getSelectText(toolsRegulatory).trim());
		var queryString = "?showCalendar=1&rO=" + rO;
		var container = document.getElementById("mainCalendar6");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}
	function showCalendar1(){
		var rO = encodeURIComponent(getSelectText(toolsRegulatory).trim());
		var queryString = "?showCalendarLogs=1&rO=" + rO;
		var container = document.getElementById("mainCalendar7");
		ajaxGetAndConcatenate(queryString,processorLink,container,"returnOnly");
	}
	function selectMenu(me){
		
		clearRadio();
		clearContainer();
		
		document.getElementById("mainSeeProc").style.display = "block";
		
		var id = me.id;
		if(me.checked == true){
			if(id == "menu1"){
				document.getElementById("trBudget1").style.display ="table-row";
				document.getElementById("trBudget2").style.display ="table-row";
				
			}else if(id == "menu2"){
				document.getElementById("trTransaction1").style.display ="table-row";
				document.getElementById("trTransaction2").style.display ="table-row";
				
				
			}else if(id == "menu3"){
				scanTR("trStatus","table-row");
			}else if(id == "menu4"){
				document.getElementById("trTransaction3").style.display ="table-row";
				document.getElementById("trTransaction4").style.display ="table-row";
				document.getElementById("trBudget3").style.display ="table-row";
			}
			
		}else{
			if(id == "menu1"){
				document.getElementById("trBudget1").style.display ="none";
				document.getElementById("trBudget2").style.display ="none";
				
			}else if(id == "menu2"){
				document.getElementById("trTransaction1").style.display ="none";
				document.getElementById("trTransaction2").style.display ="none";
				
			}else if(id == "menu3"){
				scanTR("trStatus","none");
			}else if(id == "menu4"){
				document.getElementById("trTransaction3").style.display ="none";
				document.getElementById("trTransaction4").style.display ="none";
				document.getElementById("trBudget3").style.display ="none";
			}
		}
		
	}
	function scanTR(name,action){
		var arr = document.getElementsByClassName(name);
		for(var i = 0; i < arr.length; i++){
		    arr[i].style.display = action;
		}
	}
	function showTools(){
		if(tdTools.className == "collapse"){
			tdTools.className = "expand";
			//mainSeeProc.style.paddingTop = "290px";	
			
		}else{
			tdTools.className = "collapse";
			//mainSeeProc.style.paddingTop = "120px";	
		}
	}
	function fetchTrackingByMode(par){
		var arr = par.trim().split("*");
		var mode = arr[0];
		var office = arr[1];
		
		window.open('../interface/sp12.php?mode=' + mode + "&office=" + office + "&type=1",'_blank');
	}
	
	function fetchTrackingBySupplierPY(par){
		var arr = par.trim().split("#*");
		var supp = encodeURIComponent(arr[0].replace('v@l','\''));
		var office = arr[1];
		var type = arr[2];
		window.open('../interface/sp10.php?sup=' + supp + "&office=" + office + "&type=" + type ,'_blank');
	}
	function fetchTrackingBySupplierAllTotalPY(par){
		var arr = par.trim().split("*");
		var office = arr[0];
		var type = arr[1];
		
		window.open('../interface/sp11.php?office=' + office + "&type=" + type,'_blank');
	}
	function fetchTrackingBySupplierAllOngoingPY(par){
		var arr = par.trim().split("*");
		var office = arr[0];
		var type = arr[1];
		
		window.open('../interface/sp11.php?office=' + office + "&type=2",'_blank');
		window.open('../interface/sp11.php?office=' + office + "&type=3",'_blank');
	}
	
	function fetchTrackingBySupplier(par){
		
		var arr = par.trim().split("#*");
		var supp = encodeURIComponent(arr[0].replace('v@l','\''));
		var office = arr[1];
		var type = arr[2];
		window.open('../interface/sp8.php?sup=' + supp + "&office=" + office + "&type=" + type ,'_blank');
	}
	function fetchTrackingBySupplierAll(par){
		var arr = par.trim().split("#*");
		var supp = encodeURIComponent(arr[0].replace('v@l','\''));
		var office = arr[1];
		
		window.open('../interface/sp8.php?sup=' + supp + "&office=" + office + "&type=2",'_blank');
		window.open('../interface/sp8.php?sup=' + supp + "&office=" + office + "&type=3",'_blank');
	}
	function fetchTrackingBySupplierAllTotal(par){
		var arr = par.trim().split("*");
		var office = arr[0];
		var type = arr[1];
		
		window.open('../interface/sp9.php?office=' + office + "&type=" + type,'_blank');
	}
	function fetchTrackingBySupplierAllOngoing(par){
		var arr = par.trim().split("*");
		var office = arr[0];
		var type = arr[1];
		
		window.open('../interface/sp9.php?office=' + office + "&type=2",'_blank');
		window.open('../interface/sp9.php?office=' + office + "&type=3",'_blank');
	}
	function fetchTrackingBySupplierAllall(par){
		var arr = par.trim().split("#*");
		var supp = encodeURIComponent(arr[0].replace('v@l','\''));
		var office = arr[1];
		window.open('../interface/sp8.php?sup=' + supp + "&office=" + office + "&type=4",'_blank');
	}
	function fetchTrackingByPR(par){
		var arr = par.split("*");
		
		var type = arr[0];
		var office = arr[1];
	
		window.open('../interface/sp7.php?office=' + office + "&type=" + type,'_blank');
	}
	function fetchTrackingByCategory(par){
		var arr = par.split("*");
		var cat = arr[0];
		var type = arr[1];
		var office = arr[2];
		window.open('../interface/sp7.php?cat=' + cat + "&office=" + office + "&type=" + type,'_blank');
	}
	function fetchTrackingByType(par){
		
		var arr = par.split('*');
		var type = arr[0];
		var office = arr[1];
		
		window.open('../interface/sp5.php?ty=' + type + "&office=" + office,'_blank');
		window.open('../interface/sp6.php?ty=' + type + "&office=" + office,'_blank');
	}
	function fetchTrackingByQuarter(par){
		var arr = par.split('*');
		var quarter = arr[0];
		var office = arr[1];
		var type = arr[2];
		var track = arr[3];
		window.open('../interface/sp4.php?quarter=' + quarter + "&office=" + office + "&type=" + type + "&tra=" + track,'_blank');
	}
	
	function fetchTrackingByMillions(par){
		var arr = par.split('*');
		var range = arr[0];
		var office = arr[1];
		
		window.open('../interface/sp3.php?range=' + range + "&office=" + office ,'_blank');
	}
	function fetchTrackingByStatus(par){
		var arr = par.split("*");
		var status = arr[0];
		var type = arr[1];
		var office = document.getElementById("toolsOffice").value;
		
		window.open('../interface/sp2.php?st=' + status + "&type=" + type + "&office=" + office,'_blank');
	
	}

	function fetchTopData(labelType, quarter, type, account) {
    var xhr = new XMLHttpRequest();
    var url = '../interface/sheets.php'; // URL to the PHP file that contains createTopData function
    var params = 'labelType=' + encodeURIComponent(labelType) +
                 '&quarter=' + encodeURIComponent(quarter) +
                 '&type=' + encodeURIComponent(type) +
                 '&account=' + encodeURIComponent(account);

    xhr.open('GET', url + '?' + params, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('topTable').innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

	
	function showTracking(par){
		var arr =  par.split("*");
		var tn = arr[0];
		var type = arr[1];
		var office = document.getElementById("officeName").textContent;
		if(type == "PR"){
			window.open('../interface/formPRnew.php?tn='+ tn, '_blank');
			
			var office = document.getElementById("officeName").textContent;
			window.open('../interface/formOBR.php?trackingNumber='+ tn + '&officeName=' + office +"&payee=", '_blank');
			
		}else if(type == "PO"){
			window.open('../interface/formPO.php?tn='+ tn, '_blank');
			window.open('../interface/formOBR.php?trackingNumber='+ tn + '&officeName=' + office +"&payee=", '_blank');
		}else if(type == "PX"){
			window.open('../interface/formDV.php?trackingNumber='+ tn, '_blank');
		}
	}
	
	function fetchBudgetBreakdown(me){
		var x = me.children[0].textContent;
		var arr = x.split("*");
		
		var text  = orderusText(arr[0],arr[1],arr[2],arr[3]);
		window.open('../interface/sp1.php?t=' + text);
	}
	function pier(v,s,canvas,type){
			
		var labels = [];
		var myColor = [];
		var data = v.substring(0,v.length-1).split("*");
		var labels = s.substring(0,s.length-1).split("*");
		for(var i = 0 ; i < labels.length; i++){
			myColor[i] = 'rgb(36, 165, 6)';
			
			if(type == "PR"){
				if(labels[i] != "For P.O"){
					labels[i] = data[i];
					myColor[i] = 'rgb(240, 241, 226)';
				}	
			}else if(type == "PO"){
				if(labels[i] != "Waiting for Delivery"){
					labels[i] = data[i];
					myColor[i] = 'rgb(240, 241, 226)';
				}else{
					myColor[i] = 'rgb(78, 187, 242)';
					labels[i] = "For Delivery";
				}	
			}else if(type == "PX"){
				if(labels[i] != "Check Released"){
					labels[i] = data[i];
					myColor[i] = 'rgb(240, 241, 226)';
				}else{
					myColor[i] = 'rgb(247, 187, 56)';
				}	
			}
			
		}
		
	
		var ctx = canvas.getContext("2d");
		var lastend = 0;
		var myTotal = 0;
		
		
		for(var e = 0; e < data.length; e++){
		  myTotal += parseFloat(data[e]);
		}
		var off = 15
		var w = (canvas.width - off) / 2
		var h = (canvas.height - off) / 2
		for (var i = 0; i < data.length; i++) {
		  ctx.fillStyle = myColor[i];
		  ctx.strokeStyle ='white';
		  ctx.lineWidth = 1;
		  ctx.beginPath();
		  ctx.moveTo(w,h);
		  var len =  (data[i]/myTotal) * 2 * Math.PI
		  var r = h - off / 2
		  ctx.arc(w , h, r, lastend,lastend + len,false);
		  ctx.lineTo(w,h);
		  ctx.fill();
		  ctx.stroke();
		  ctx.shadowBlur = 10;
		  ctx.shadowColor = "gray";
		  ctx.fillStyle ='white';
		  ctx.font = "normal 16px Nor";
		  ctx.textAlign = "center";
		  ctx.textBaseline = "middle";
		  var mid = lastend + len / 2;
		  if(type == "PR"){
		  	if(labels[i] == "For P.O"){
			 	 ctx.fillText(labels[i],w + Math.cos(mid) * (r/2) , h + Math.sin(mid) * (r/2));
			  }else{
			  	  ctx.fillText('',w + Math.cos(mid) * (r/2) , h + Math.sin(mid) * (r/2));
			  }
		  }else if(type == "PO"){
		  	if(labels[i] == "For Delivery"){
			 	 ctx.fillText(labels[i],w + Math.cos(mid) * (r/2) , h + Math.sin(mid) * (r/2));
			  }else{
			  	  ctx.fillText('',w + Math.cos(mid) * (r/2) , h + Math.sin(mid) * (r/2));
			  }
		  }else if(type == "PX"){
		  
		  	if(labels[i] == "Check Released"){
			 	 ctx.fillText(labels[i],w + Math.cos(mid) * (r/2) , h + Math.sin(mid) * (r/2));
			  }else{
			  	  ctx.fillText('',w + Math.cos(mid) * (r/2) , h + Math.sin(mid) * (r/2));
			  }
		  }
		  
		  
		  lastend += Math.PI*2*(data[i]/myTotal);
		}
	}
	function showPieBudget(){
		
		if(document.getElementById("gTotal1")){
			var data = gTotal1.textContent.split("*");
			
			
			var left = (data[0] - data[1]);
			data = [left,data[1]];
			newPie(data,"myCanvas1");
		}
		if(document.getElementById("gTotal2")){
			var left = (data[0] - data[1]);
			data = [left,data[1]];
			var data = gTotal2.textContent.split("*");
			
			newPie(data,"myCanvas2");
		}
		if(document.getElementById("gTotal3")){
			var left = (data[0] - data[1]);
			data = [left,data[1]];
			var data = gTotal3.textContent.split("*");
			
			newPie(data,"myCanvas3");
		}
		
	}
	function newPie(data,canvasId){
		var data = data.map(Number);
		
		var themes = {
			default: ['#36A2EB','#FF6384',  '#FFCE56', '#4CAF50', '#FF9800', '#9C27B0', '#795548', '#607D8B', '#FF5722', '#8BC34A'],
			pastel: ['#FFD1DC', '#ADD8E6', '#FFEC8B', '#98FB98', '#FFA07A', '#FFB6C1', '#87CEEB', '#FF6347', '#B0E0E6', '#20B2AA'],
			earthy: ['#8B4513', '#228B22', '#D2B48C', '#556B2F', '#B8860B', '#8FBC8F', '#CD853F', '#A52A2A', '#DEB887', '#BC8F8F'],
			vibrant: ['#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF', '#FF4500', '#8A2BE2', '#32CD32', '#FFD700'],
		};
		var chosenTheme = themes.default	;
		// Get the canvas element and its context
		var canvas = document.getElementById(canvasId);
		
		var context = canvas.getContext('2d');

		// Calculate total for percentage calculation
		var total = data.reduce((a, b) => a + b, 0);
		

		// Draw the pie chart with labels
		var startAngle = 0;
		var centerX = canvas.width / 2;
        var centerY = canvas.height / 2;
        var radius = Math.min(centerX, centerY) - 30; // Leave some space for labels	
		for (var i = 0; i < data.length; i++) {
			var percentage = data[i] / total;
			
			var endAngle = startAngle + (percentage * 2 * Math.PI);

			// Draw the slice
			context.beginPath();
			/*context.moveTo(150, 150);
			context.arc(145, 145, 110, startAngle, endAngle);*/
			context.moveTo(centerX, centerY);
            context.arc(centerX, centerY, radius, startAngle, endAngle);
            
           
            
			context.fillStyle = chosenTheme[i];
			context.fill();
			context.closePath();

			
			var sliceMiddleAngle = startAngle + (percentage * Math.PI);
            var labelX = centerX + Math.cos(sliceMiddleAngle) * (radius / 2);
            var labelY = centerY + Math.sin(sliceMiddleAngle) * (radius / 2);
			
			
			
			
			//context.stroke();
			context.shadowBlur = 10;
			context.shadowColor = "grey";
			context.fillStyle ='white';
			
			
			context.font = '18px NOR';
			context.textAlign = 'center';
			context.textBaseline = 'middle';
			var percentage = (data[i] / total) * 100;
			
			var label = Math.round(percentage);
			if(i == 0){
				label = "PPMP " + label + " %";	
			}else{
				label = "PR " + label + " %";	
			}
			context.fillText(label, labelX + 10, labelY);
			
			
			context.lineWidth = 5; // Adjust the border width as needed
            context.strokeStyle = '#fff'; // Replace with your desired border color
            context.stroke();
			
			// Set the text color

			// Update the starting angle for the next slice
			startAngle = endAngle;
        }
	}
	function showPie(){
		var v = document.getElementById("pieValuesPR").textContent;
		var s = document.getElementById("pieStatusPR").textContent;
		var canvas = document.getElementById("canPR");
		pier(v,s,canvas,"PR");
		
		var v = document.getElementById("pieValuesPO").textContent;
		var s = document.getElementById("pieStatusPO").textContent;
		var canvas = document.getElementById("canPO");
		pier(v,s,canvas,"PO");
		
		var v = document.getElementById("pieValuesPX").textContent;
		var s = document.getElementById("pieStatusPX").textContent;
		var canvas = document.getElementById("canPX");
		pier(v,s,canvas,"PX");
	}
	function goSeeProc(){
		var office = encodeURIComponent(toolsOffice.value.trim());
		
		var officeName = encodeURIComponent(getSelectText(toolsOffice).trim());
		var trackingType = encodeURIComponent(getSelectText(toolsOffice).trim());
		var rO = encodeURIComponent(getSelectText(toolsRegulatory).trim());
		
		var ty = encodeURIComponent(toolsType.value);
		var qt = encodeURIComponent(toolsQuarter.value);	
		
		var fd = encodeURIComponent(toolsField.value);	
		var or = encodeURIComponent(toolsOrder.value);	
		
		var fr = encodeURIComponent(pFrom.value);	
		var to = encodeURIComponent(pTo.value);	
		
		
		var sU = encodeURIComponent(updatedSelect.value);	
		var sC = encodeURIComponent(createdSelect.value);	
	
	
		
		loader();
		var queryString = "?goSeeProc=1&office=" + office + "&officeName=" + officeName + "&rO=" + rO + "&ty=" + ty + "&qt=" + qt + "&fd=" + fd + "&or=" + or + "&fr=" + fr + "&to=" + to + "&sU=" + sU + "&sC=" + sC;
		
		var container = document.getElementById("mainSeeProc");
		ajaxGetAndConcatenate(queryString,processorLink,container,"seeProc");
	}
	function selectPercentage(){
		var from = parseInt(pFrom.value);
		var to = parseInt(pTo.value) ;
		if(from){
			if(from > to){
				setSelectedIndex(pTo, from);
			}
			if(to){
				
			}else{
				setSelectedIndex(pTo, from);
			}
		}else{
			selectToIndexZero("pFrom");
			selectToIndexZero("pTo");
		}
		selectToIndexZero("toolsRegulatory");
	}
	function selectDuration(me){
		if(me.id == "updatedSelect"){
			selectToIndexZero("createdSelect");
			createdSelect.parentNode.children[1].textContent = '';
			updatedSelect.parentNode.children[1].textContent = 'days old';
		}else{
			selectToIndexZero("updatedSelect");
			updatedSelect.parentNode.children[1].textContent = '';
			createdSelect.parentNode.children[1].textContent = 'days old';
		}
	}
	function changeType(){
		var ty = encodeURIComponent(toolsType.value);
		var selection = ""
		if (ty == "PR"){
			toolsField.innerHTML = "<option value ='PR_Id'>Date Created</option><option value ='PR_Datemodified'>Date Updated</option><option value ='PR_Month'>Quarter</option>" + 
								   "<option value ='Description'>Category</option><option value = 'PR_Amount'>Amount</option><option value ='PR_TrackingNumber'>Tracking</option>";
								    ;
		}else if(ty == "PO"){
			toolsField.innerHTML = "<option value ='PO_Id'>Date Created</option><option value ='PO_Datemodified'>Date Updated</option><option value ='Claimant'>Claimant</option><option value ='PO_Amount'>Amount</option><option value ='PO_TrackingNumber'>Tracking</option>";
		}else{
			toolsField.innerHTML = "<option value ='PX_Id'>Date Created</option><option value ='PX_Datemodified'>Date Updated</option><option value ='Claimant'>Claimant</option><option value ='PX_Amount'>Amount</option><option value ='PX_TrackingNumber'>Tracking</option>";
		}
		toolsField.innerHTML += "<option value ='CalendarDaysCompleted'>Completion</option>"; 
	}
	function changeRegulatory(){
		selectToIndexZero("pFrom");
		selectToIndexZero("pTo");
	}
	function refreshSelection(){
		toolsField.innerHTML = "<option value ='PR_Id'>Date Created</option><option value ='PR_Datemodified'>Date Updated</option><option value ='PR_Month'>Quarter</option>" + 
		                       "<option value ='Description'>Category</option><option value = 'PR_Amount'>Amount</option><option value ='PR_TrackingNumber'>Tracking</option>" + 
		                       "<option value ='CalendarDaysCompleted'>Completion</option>" ;
		toolsType.innerHTML = "<option value ='PR'>Purchase Request</option><option value ='PO'>Purchase Order</option><option value ='PX'>Payment</option>";
		toolsQuarter.innerHTML = "<option>-</option><option>1</option><option>2</option><option>3</option><option>4</option>";
		
		selectToIndexZero("pFrom");
		selectToIndexZero("pTo");
		selectToIndexZero("updatedSelect");
		selectToIndexZero("createdSelect");
		selectToIndexZero("toolsRegulatory");
		
	}

	function logout(){
		loader();
		var queryString = "?logout=1";
		var container = '';
		ajaxGetAndConcatenate(queryString,processorLink,container,"Logout");
	}
</script>