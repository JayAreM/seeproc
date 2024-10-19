	<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<?php
	
	require_once("../includes/database.php");
	require_once('../javascript/ajaxFunction.php');
	
	
	
	$tn = $database->charEncoder($_GET['trackingNumber']);
	$sql = "select Adv1,Claimant,NetAmount,DocumentType,PayeeNumber,Fund from vouchercurrent where TrackingNumber = '" . $tn ."' limit 1";
	$record = $database->query($sql);
	$data = $database->fetch_array($record);
	$claimant = $data['Claimant'];
	$net = $data['NetAmount'];
	$adv =$data['Adv1'];
	$type = $data['DocumentType'];
	$payee = $data['PayeeNumber'];
	
	$dt = time();
	$today = date('mdY', $dt);
	
	$fund = $data['Fund'];
	
	if($payee != ""){
		$type = $claimant;
		$claimant = "LAND BANK OF THE PHILIPPINES";
	}
?>

	<!DOCTYPE HTML>
	<style>
		body{
			padding:0;
			margin:0;
			font-family: arial;
		}
		.t2 td{
			padding:0;
			
		}
		table{
			padding:0;
			border-spacing: 0;
		}
		.tableDate td{
			width:19px;
		
			text-align: center;
			font-weight: bold;
		}
		.tableDateLabel td{
			width:19px;
			height:8px;
			text-align: center;
			vertical-align: top;
			line-height: 2px;
			font-size:7px;
			font-weight: bold;
		}
		
		@font-face {
	        font-family: "ab";
	        src: url("../fonts/arialblack.ttf");
		}
		@font-face {
		        font-family: "check";
		        src: url("../fonts/check.ttf");
		}
	</style>
	<html>
	
		<head>
			<title>Checki</title>
			<link rel="icon" href="/lighter/images/red.png"/> 
		</head>
		<body>
			<?php
				if(strtoupper($fund) == "GENERAL FUND"){
			?>
			<div id = "mainTable" style = "border:1px solid white;width:770px;height:280px;margin:0 auto;" ondblclick = "checkBG()">
				<table style = "border-spacing: 0px;height:100%;width:740px;">
					<tr>
						<td style = "padding:0;width:12px;padding-left:15px;vertical-align:top;padding-top:55px;display:none;">
							<div STYLE  = "writing-mode: vertical-rl;transform:scale(-1);padding:0;font-size:8px;letter-spacing:1px;">DOCUMENTARY STAMPSS PAID</div>
						</td>
						<td style = "vertical-align: top;padding-top:5px;">
							<table border ="0" class = "t2"  style = "width:100%;border-spacing:0;">
								<tr>
									<td style= "font-size:7px;width:188px;color:white;">ACCOUNT No.</td>
									<td style= "font-size:7px;width:218px;color:white;">ACCOUNT NAME</td>
									<td id  = "logo1" rowspan = "2" style = "width:123px;font-size:12px;vertical-align:bottom;text-align: right;color:white;">Date</td>
									<td style= "font-size:7px;letter-spacing:1px;color:white;">CHECK No.</td>
								</tr>
								<tr>
									<td style = "font-size: 13px;vertical-align:top;font-weight: bold;letter-spacing: .2px;color:white;">001472-1000-13-<span style ="font-size: 13px;color:white;"> GEN.FUND </span>
										<div style = "padding-top: 10px;font-weight: bold;letter-spacing:0px;color:white;">"Member: PDIC"</div>
									</td>
									<td  style = "font-weight: bold;font-size:9px;vertical-align: top;padding:0;padding-left: 0px;padding-top:2px;">
										<table style="">
											<tr>
												<td  id  = "logo2" style = "width:42px;height:42px; "></td>
												<td style="font-size:9px;font-weight:bolder; padding-left:5px;font-family:ab;color:white;">CITY GOVERNMENT OF DAVAO</td>
											</tr>
										</table>	
									</td>
									<td style = "letter-spacing:3px;font-size:16px;font-weight:bold;vertical-align:top;padding-top:17px; color:white; ">0002497776
										<table id = "tableDate" class = "tableDate" border= "0" style = "height: 20px;border-spacing:0;font-size:12px;padding:0;padding-top:2px;letter-spacing: 0;font-weight: bold;">
											<tr>
												<td><?php echo $today[0]; ?></td>
												<td><?php echo $today[1]; ?></td>
												<td id = "dateSep1"  style="width:10px;">-</td>
												<td><?php echo $today[2]; ?></td>
												<td><?php echo $today[3]; ?></td>
												<td id = "dateSep2" style="width:10px;">-</td>
												<td><?php echo $today[4]; ?></td>
												<td><?php echo $today[5]; ?></td>
												<td><?php echo $today[6]; ?></td>
												<td><?php echo $today[7]; ?></td>
											</tr>
										</table>
										<table class = "tableDateLabel" border= "0" style = "border-spacing:0;padding:0;margin-left:2px;color:white;">
											<tr>
												<td>M</td>
												<td>M</td>
												<td style="width:10px;">-</td>
												<td>D</td>
												<td>D</td>
												<td style="width:10px;">-</td>
												<td>Y</td>
												<td>Y</td>
												<td>Y</td>
												<td>Y</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="4" style= "font-size:7px;font-weight: bold;font-size: 14px;vertical-align:top;">
										<table border = "0" style="margin-top: 0px;">
											<tr>
												<td style = "width:72px;font-size: 12px;font-weight: bold; text-align: justify;text-justify: inter-word;line-height: 12px;padding-left:5px;color:white;">
													PAY TO THE ORDER OF
												</td>
												<td id = "claimant" style="border-bottom: 1px solid white;width:422px;font-size: 12px;font-weight:bold;text-align: center;line-height:12px;vertical-align: bottom;"><?php echo "VAL GALIDO BALANGUE"; ?> </td>
												
												<td id = "netNumber" style = "border:1px solid white;width:198px;text-align: center;font-weight: bold;font-size: 14px;padding-bottom: 2px;"><?php echo number_format($net,2) ?></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="4" style= "font-size:7px;font-weight: bold;font-size: 14px;vertical-align:top;">
										<table border = "0" >
											<tr>
												<td style = "display:none;vertical-align:bottom;width:0px;height:33px;font-size: 11px;font-weight: bold; text-align: justify;text-justify: inter-word;line-height: 12px;padding-left:5px;padding-right:5px;">
													PESOS
												</td>
												
												<td  id  = "net" colspan="2" style="height:25px;padding-left:50px;vertical-align:bottom;border-bottom: 1px solid white;width:622px;font-size:12px; text-align:center; line-height: 12px;padding-top:4px;"></td>
											</tr>
											<tr>
												<td colspan = "3">
													<table border = "0" style = "width:99.5%;margin-top:2px;margin-left: 5px;color:white;">
														<tr>
															<td id  = "logo3" rowspan="2" style = "padding-left:55px;width:200px;padding-top:16px;padding-bottom: 5px;">
																
																<div style = "font-weight: bold;font-size: 22px;font-family: ab;line-height: 26px;">LANDBANK</div> 	
																<div style = "font-size: 10px;line-height: 11px;width:148px;">SAN PEDRO BRANCH<br/>
																SAN PEDRO ST., DAVAO CITY</div> 	
															</td>
															<td colspan="2" style = "font-size: 8px;vertical-align: top;text-align: right;color:white;">
																"I/We allow the electronic clearing of this check and hereby waive the presentation for payment of this original to LANDBANK"
															</td>
														</tr>
														<tr>	
															<td style="vertical-align: bottom;padding-top: 42px;color:black;">
															
																<div style="width: 180px;float:right;font-size: 11px;text-align:center;">&nbsp;<br/>&nbsp;</div>
																<div id = "signatory1" style="width: 180px;float:right;margin-right:18px;font-size: 11px;text-align:center;">
																	<b>ATTY. LAWRENCE D. BANTIDING </b><br/>
																	<span style = "font-size: 10px;">CITY TREASURER</span>
																</div>
																
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td colspan = "3">
													<table border = "0" style = "float:right;margin-top:0px;width:100%;">
														<tr>
															<td id = "advType"  style = "font-size: 10px;padding-left: 80px;">
																 <div >ADV Number : <span style = "font-weight: bold;font-size:12px;letter-spacing: 1px;"><?php echo $adv; ?></span></div>
																 <div><?php echo $type; ?></div>
																
															</td>
															<td id = "signatory1Border" style = "width:180px;border-top:1px solid white;font-size: 10px;">
																
															</td>
															<td style = "width:20px;">
																
																
															</td>
															
															<td id = "signatory2Border" style = "width:180px;border-top:1px solid white;">
																
															</td>
														</tr>
														
													</table>
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
			
			<?php
				}else if(strtoupper($fund) == "SEF"){
			?>
			<div id = "mainTable" style = "width:770px;height:280px;margin:0 auto; " ondblclick = "checkBG()">
				<table border = "0" style="font-size: 12px;width:100%;">
					<tr>
						<td style="vertical-align: bottom;height:70px;padding-bottom:8px;padding-left: 15px;line-height: 11px;font-size: 11px;">
							<div >ADV Number : <span style = "font-weight: bold;font-size:11px;letter-spacing: 1px;"><?php echo $adv; ?></span></div>
							<div style="font-size:11px;"><?php echo $type; ?></div>
						</td>
						<td style="width:195px;text-align: center;vertical-align: bottom;font-size:14px;padding-right: 50px;padding-bottom: 5px;font-weight: bold;">04-20-2021</td>
					</tr>
					<tr>
						<td style="text-align: center;padding-left:80px;line-height:12px; height:30px;vertical-align: bottom;font-weight: bold;padding-bottom: 3px;padding-right: 20px;"> <?php echo strtoupper($claimant); ?></td>
						<td style="text-align: center;vertical-align: top;padding-top: 8px;font-size: 15px;padding-right:55px;font-weight: bold;"><?php echo number_format($net,2); ?></td>
					</tr>
					<tr>
						<td  id  = "net"  colspan="2" style="text-align: center;height:32px; line-height:12px;padding-bottom:5px; vertical-align: bottom;padding-left: 90px;padding-right: 90px;"> 123</td>
					</tr>
					<tr>
						<td colspan="2">
							<table border = "0" style="float: right;margin-right: 235px;margin-top:50px;">
								<tr>
									<td style ="font-size: 12px;text-align: center;">
										<b>ATTY. LAWRENCE D. BANTIDING </b><br/>
										<span style = "font-size: 10px;">CITY TREASURER</span>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<?php
				}
			?>
			
			
			<!--<div id = "mainTable" style = "border:1px solid black;width:770px;height:280px;margin:0 auto;" ondblclick = "checkBG()">
				<table style = "border-spacing: 0px;height:100%;width:740px;">
					<tr>
						<td style = "padding:0;width:12px;padding-left:15px;vertical-align:top;padding-top:55px;display:none;">
							<div STYLE  = "writing-mode: vertical-rl;transform:scale(-1);padding:0;font-size:8px;letter-spacing:1px;">DOCUMENTARY STAMPSS PAID</div>
						</td>
						<td style = "vertical-align: top;padding-top:5px;">
							<table border ="0" class = "t2"  style = "width:100%;border-spacing:0;">
								<tr>
									<td style= "font-size:7px;width:188px;">ACCOUNT No.</td>
									<td style= "font-size:7px;width:218px;">ACCOUNT NAME</td>
									<td id  = "logo1" rowspan = "2" style = "width:123px;background:url(../images/bcode.png);background-size:83% 65%;background-repeat: no-repeat;font-size:12px;vertical-align:bottom;text-align: right;">Date</td>
									<td style= "font-size:7px;letter-spacing:1px;">CHECK No.</td>
								</tr>
								<tr>
									<td style = "font-size: 13px;vertical-align:top;font-weight: bold;letter-spacing: .2px;">001472-1000-13-<span style ="font-size: 13px;"> GEN.FUND </span>
										<div style = "padding-top: 10px;font-weight: bold;letter-spacing:0px;">"Member: PDIC"</div>
									</td>
									<td  style = "font-weight: bold;font-size:9px;vertical-align: top;padding:0;padding-left: 0px;padding-top:2px;">
										<table style="">
											<tr>
												<td  id  = "logo2" style = "width:42px;height:42px;background:url(../images/davao.png);background-size:100%; "></td>
												<td style="font-size:9px;font-weight:bolder; padding-left:5px;font-family:ab;">CITY GOVERNMENT OF DAVAO</td>
											</tr>
										</table>	
									</td>
									<td style = "letter-spacing:3px;font-size:16px;font-weight:bold;vertical-align:top;padding-top:17px;  ">0002497776
										<table id = "tableDate" class = "tableDate" border= "0" style = "height: 20px;border-spacing:0;font-size:12px;padding:0;padding-top:2px;letter-spacing: 0;font-weight: bold;">
											<tr>
												<td><?php echo $today[0]; ?></td>
												<td><?php echo $today[1]; ?></td>
												<td id = "dateSep1"  style="width:10px;">-</td>
												<td><?php echo $today[2]; ?></td>
												<td><?php echo $today[3]; ?></td>
												<td id = "dateSep2" style="width:10px;">-</td>
												<td><?php echo $today[4]; ?></td>
												<td><?php echo $today[5]; ?></td>
												<td><?php echo $today[6]; ?></td>
												<td><?php echo $today[7]; ?></td>
											</tr>
										</table>
										<table class = "tableDateLabel" border= "0" style = "border-spacing:0;padding:0;margin-left:2px;">
											<tr>
												<td>M</td>
												<td>M</td>
												<td style="width:10px;">-</td>
												<td>D</td>
												<td>D</td>
												<td style="width:10px;">-</td>
												<td>Y</td>
												<td>Y</td>
												<td>Y</td>
												<td>Y</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="4" style= "font-size:7px;font-weight: bold;font-size: 14px;vertical-align:top;">
										<table border = "0" style="margin-top: 0px;">
											<tr>
												<td style = "width:72px;font-size: 12px;font-weight: bold; text-align: justify;text-justify: inter-word;line-height: 12px;padding-left:5px;">
													PAY TO THE ORDER OF
												</td>
												<td id = "claimant" style="border-bottom: 1px solid black;width:422px;font-size: 12px;font-weight:bold;text-align: center;line-height:12px;vertical-align: bottom;"><?php echo "VAL GALIDO BALANGUE"; ?> </td>
												
												<td id = "netNumber" style = "border:1px solid black;width:198px;text-align: center;font-weight: bold;font-size: 14px;padding-bottom: 2px;"><?php echo number_format($net,2) ?></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td colspan="4" style= "font-size:7px;font-weight: bold;font-size: 14px;vertical-align:top;">
										<table border = "0" >
											<tr>
												<td style = "display:none;vertical-align:bottom;width:0px;height:33px;font-size: 11px;font-weight: bold; text-align: justify;text-justify: inter-word;line-height: 12px;padding-left:5px;padding-right:5px;">
													PESOS
												</td>
												
												<td  id  = "net" colspan="2" style="height:25px;padding-left:50px;vertical-align:bottom;border-bottom: 1px solid black;width:622px;font-size:12px; text-align:center; line-height: 12px;padding-top:4px;"></td>
											</tr>
											<tr>
												<td colspan = "3">
													<table border = "0" style = "width:99.5%;margin-top:2px;margin-left: 5px;">
														<tr>
															<td id  = "logo3" rowspan="2" style = "background:url(../images/bank.png);background-size:48px 48px; background-position-y:7px;  background-repeat: no-repeat;padding-left:55px;width:200px;padding-top:16px;padding-bottom: 5px;">
																
																<div style = "font-weight: bold;font-size: 22px;font-family: ab;line-height: 26px;">LANDBANK</div> 	
																<div style = "font-size: 10px;line-height: 11px;width:148px;">SAN PEDRO BRANCH<br/>
																SAN PEDRO ST., DAVAO CITY</div> 	
															</td>
															<td colspan="2" style = "font-size: 8px;vertical-align: top;text-align: right;">
																"I/We allow the electronic clearing of this check and hereby waive the presentation for payment of this original to LANDBANK"
															</td>
														</tr>
														<tr>	
															<td style="vertical-align: bottom;padding-top: 42px;">
															
																<div style="width: 180px;float:right;font-size: 11px;text-align:center;">&nbsp;<br/>&nbsp;</div>
																<div id = "signatory1" style="width: 180px;float:right;margin-right:18px;font-size: 11px;text-align:center;">
																	<b>ATTY. LAWRENCE D. BANTIDING </b><br/>
																	<span style = "font-size: 10px;">CITY TREASURER</span>
																</div>
																
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td colspan = "3">
													<table border = "0" style = "float:right;margin-top:0px;width:100%;">
														<tr>
															<td id = "advType"  style = "font-size: 10px;padding-left: 80px;">
																 <div >ADV Number : <span style = "font-weight: bold;font-size:12px;letter-spacing: 1px;"><?php echo $adv; ?></span></div>
																 <div><?php echo $type; ?></div>
																
															</td>
															<td id = "signatory1Border" style = "width:180px;border-top:1px solid black;font-size: 10px;">
																
															</td>
															<td style = "width:20px;">
																
																
															</td>
															
															<td id = "signatory2Border" style = "width:180px;border-top:1px solid black;">
																
															</td>
														</tr>
														
													</table>
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>-->
			
		</body>
	</html>
	<script>
		
		getNet(<?php echo $net; ?>);
		function getNet(net){
			var amountWord =  convertWordCurrency(net);
			//var amountWord =  convertWordCurrency(500000000);
			document.getElementById("net").textContent = amountWord + " ONLY";
		}
		//changeColor();
		var c = 1;
		function checkBG(){
			if(c == 1){
				showColor();
				c = 0;
			}else{
				changeColor();
				c = 1;
			}
			//PrintDiv();
		}
		function changeColor(){
			var t = document.getElementsByTagName('table');
			
			for(var i = 0; i < t.length; i++){
				t[i].style.color = "white";
			}
			
			document.getElementById("mainTable").style.border = "1px solid white";
			document.getElementById("logo1").style.background = "";
			document.getElementById("logo2").style.background = "";
			document.getElementById("logo3").style.background = "";
			
			document.getElementById("signatory1").style.color = "black";
			
			document.getElementById("net").style.color = "black";
			document.getElementById("net").style.borderBottom = "1px solid white";
			
			document.getElementById("netNumber").style.color = "black";
			document.getElementById("netNumber").style.border = "1px solid white";
			
			document.getElementById("claimant").style.color = "black";
			document.getElementById("claimant").style.border = "1px solid white";
			
			document.getElementById("advType").style.color = "black";
			
			document.getElementById("tableDate").style.color ="black";
			
			
			document.getElementById("signatory1Border").style.borderTop = "1px solid white";
			document.getElementById("signatory2Border").style.borderTop = "1px solid white";
			
			document.getElementById("dateSep1").style.color ="white";
			document.getElementById("dateSep2").style.color ="white";
		}
		function showColor(){
			var t = document.getElementsByTagName('table');
			
			for(var i = 0; i < t.length; i++){
				t[i].style.color = "black";
			}
			
			document.getElementById("mainTable").style.border = "1px solid black";
			
			document.getElementById("logo1").style.background = "url(../images/bcode.png)";
			document.getElementById("logo1").style.backgroundSize = "83% 65%";
			document.getElementById("logo1").style.backgroundRepeat = "no-repeat";
			
			
			document.getElementById("logo2").style.background = "url(../images/davao.png)";
			document.getElementById("logo2").style.backgroundSize = "100%";
			document.getElementById("logo2").style.backgroundRepeat = "no-repeat";
			
			document.getElementById("logo3").style.background = "url(../images/bank.png)";
			document.getElementById("logo3").style.backgroundSize = "48px 48px";
			document.getElementById("logo3").style.backgroundRepeat = "no-repeat";
			
			
			document.getElementById("signatory1").style.color = "black";
			
			document.getElementById("net").style.color = "black";
			document.getElementById("net").style.borderBottom = "1px solid black";
			
			document.getElementById("netNumber").style.color = "black";
			document.getElementById("netNumber").style.border = "1px solid black";
			
			document.getElementById("claimant").style.color = "black";
			document.getElementById("claimant").style.border = "1px solid black";
			
			document.getElementById("advType").style.color = "black";
			
			document.getElementById("tableDate").style.color ="black";
			
			
			document.getElementById("signatory1Border").style.borderTop = "1px solid black";
			document.getElementById("signatory2Border").style.borderTop = "1px solid black";
			
			document.getElementById("dateSep1").style.color ="black";
			document.getElementById("dateSep2").style.color ="black";
		}
		function PrintDiv() {    
	       var divToPrint = document.getElementById('mainTable');
	       var popupWin = window.open('', '_blank', 'width=816,height=288');
	       popupWin.document.open();
	       popupWin.document.write('<body onload="window.print()">' + divToPrint.innerHTML + '</html>');
	        popupWin.document.close();
	    }
	</script>
	
	