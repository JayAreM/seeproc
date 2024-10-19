<META http-equiv=Content-Type content="text/html; charset=iso-8859-1">
<META name="viewport" content="width=device-width,initial-scale=1">
<!DOCTYPE HTML>
<html>
<?php 
    defined('ROOTER') ? NULL : define("ROOTER","../"); 
    require_once(ROOTER . 'javascript/ajaxFunction.php');
?>
<head>
    <title>2022 DocTrack v7</title>
    <link rel="icon" href="/citydoc2020/images/red.png"/> 
	<link rel="stylesheet" href="../css/style.css" />
    
    <style>
        html {
            padding:0px; 
            margin:0px;
            /* background:url(../images/or.jpg);	 */
		    /* background-size:  1920px 1091px; */
		    /* background-size:  cover; */
        }
        body {
            padding:0px;
            margin:0px;
            /* background-color:rgba(19, 136, 225,.1); */
            background: radial-gradient(circle, #23597F, black);
		    background: -moz-linear-gradient(to bottom, #37474F, #37474F), 
					    -webkit-gradient(to bottom, #37474F, #37474F), 
						-ms-linear-gradient(to bottom, #37474F, #37474F), 
							linear-gradient(to bottom, #37474F, #37474F);
        }
        body:before {
            content: ' ';
            display: block;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            opacity: 0.3;
            /* background:url(../images/BG1.png); */
		    background: url("../images/bg2018.png");
		    background-size:300px 100px ;
            background-repeat: repeat;
            background-position: 50% 0;
		    /* background-color: rgba(1, 1, 1,.4); */
            z-index:-1;
        }

        @font-face{
            font-family:myriad-set-pro_bold;
            src: url(../fonts/myriad-set-pro_bold.ttf);
        }

        @font-face {
	        font-family: "Oswald";
	        src: url("../fonts/Oswald-ExtraLight.ttf");
	    }

        @font-face{
            font-family: Cuprum;
            src: url("../fonts/Cuprum-Regular.ttf"); 
        }

        @font-face{
		    font-family: NOR;
		    src: url(../fonts/Abel-Regular.ttf);
	    }

        .mainContainer {
            height:100vh;
            display:grid;
            align-items:start;
            justify-items:center;
        }
        .menuContainer {
            width:100vw;
            height:100vh;
            display:grid;
            grid-template-columns:1fr;
            grid-template-rows:.1fr 1fr .1fr;
            grid-template-areas:
            "header"
            "body"
            "footer"
            ;
            justify-items:center;
        }

        .header {
            width:100%;
            grid-area: header;
        }

        .body {
            width:100%;
            grid-area: body; 
        }

        .footer {
            width:100%;
            grid-area: footer;
        }


        .header {
            color: white;
            font-size: 48px;
            text-align: center;
            text-shadow: 0px 2px 2px black;
            font-family:myriad-set-pro_bold;
            padding-top:10px;
            /* background-color:rgba(255,255,255,.1);
            box-shadow: 0px 5px 10px rgba(0,0,0,.5); */
        }

        .body {
            display:grid;
            grid-template-columns:1fr;
            grid-template-rows:1fr;
            grid-template-areas:
            "nav"
            ;
            justify-items:center;
            align-items:center;
        }

        .nav {
            grid-area: nav;
            display:grid;
            grid-template-columns:1fr 1fr;
            grid-template-rows:1fr 1fr;
            grid-template-areas:
            "item1 item2"
            "item3 item4"
            ;
            grid-gap: 2rem;
        }

        .item1 {
            grid-area: item1;
        }

        .item2 {
            grid-area: item2;
        }

        .item3 {
            grid-area: item3;
        }

        .item4 {
            grid-area: item4;
        }

        .navItem {
            background-color:rgb(30, 64, 80);
            text-align:center;
            font-family:Oswald;
            font-size:28px;
            color:white;
            cursor:pointer;
            white-space: nowrap;
		    box-shadow: 0px 0px 20px 2px rgb(31, 31, 31);
            border-radius:5px;
        }
        .navItem > div:first-child {
            background-color:rgb(27, 35, 39);
            padding:5px 12px 0px 12px;
            border-top-left-radius:5px;
            border-top-right-radius:5px;
        }
        .navItem > div:last-child {
            padding:0px 12px 5px 12px;
            font-size:14px;
            color:gray;
            letter-spacing:3px;
        }

        @media only screen and (max-width:550px) {
            .header {
                font-size: 32px;
            }
            .nav {
                /* padding:1rem 1rem; */
                grid-template-columns:.9fr;
                grid-template-rows:1fr 1fr 1fr 1fr;
                grid-template-areas:
                "item1"
                "item2"
                "item3"
                "item4"
                ;
                justify-content:center;
            }
        }



        .logo, .logo1 {
            height: 90px;
            width: 90px;
            opacity: .1;
            margin: 0 auto;
            background: url(../images/davao.png);
            background-size: 100% 100%;
            background-repeat: no-repeat;
            box-shadow: 0px 0px 20px 5px rgb(4 4 4 / 90%);
            display: inline-block;
            border-radius: 50%;
        }

        .logo1 {
            background: url(../images/acctg.png);
            background-size: 100% 100%;
        }

        .floatingContainer {
            position:absolute;
            /* background-color:rgba(255,255,255,1); */
            top:0;
            left:0;
            height:100vh;
            width:100vw;
        }

        .searchHeader {
            color:silver;
            /* background: linear-gradient(to left, #23597F, rgb(12, 78, 24)); */
            
            font-family: Arial;
            font-size:14px;
            padding:8px 0px 5px 23px;
            text-align:left;
            border-bottom:2px solid rgba(192,192,192,.1);
        }

        .searchField {
            font-size:14px;
            width:100%;
            height:40px;
            border:0px;
            padding:0px 5px;
            font-family:Arial;
            /* background-color:transparent; */
            background-color:rgba(21, 24, 26, .4);
            text-align:center;
            text-transform:uppercase;
            border:1px solid rgba(20,20,20,1);
            border-right:1px solid rgba(40,40,40,1);
            border-bottom:1px solid rgba(40,40,40,1);
            border-radius:5px;
        }

        .searchField:focus {
            outline:none;
        }

        .searchField::placeholder {
            text-transform:none;
        }

        .searchBtn {
            /* display:inline-block;
            padding: 6px 6px;
            user-select:none; */
            display:inline-block;
            padding: 3px 6px;
            /* background-color:rgb(30, 64, 80); */
            border-radius:5px;
            user-select:none;
        }

        .backBtn {
            font-size:16px;
            cursor:pointer;
            color:white;
            font-family: Cuprum;
        }

        .resultsContainer {
            overflow-x:auto;
            padding:1rem;
        }

        .clearSearchField {
            padding:2px 2px;
            cursor:pointer;
            display:none;
            font-family:Arial;
            color:silver;
            font-size:10px;
            text-shadow:1px 1px 20px rgba(0,0,0,1);
            letter-spacing:1px;
        }

        .searchByLabel {
            font-size:14px;
            color:orange;
        }

        .yrDropdown {
            border: 0;
            -moz-appearance: none;
            -webkit-appearance: none;
            color: orange;
            cursor: pointer;
            font-family: Oswald;
            letter-spacing: 1px;
            background-color:transparent;
            font-weight:bold;
        }

        .resultsItems {
            width:91.1vw;
            margin:0px auto;
            margin-bottom:1rem;
            font-size:12px;
            background-color:rgba(67,78,98,.3);
            font-family:Arial;
            color:white;
        }

        .publicNum {
            display:inline-block;
            font-size:16px;
            text-align:center;
            min-width:30px;
            padding:5px 0px 3px 0px;
        }

        .publicPeriod {
            display:inline-block;
            font-size:16px;
            text-align:center;
            padding:5px 0px 3px 0px;
        }

        @keyframes growHeight {
           100% {min-height:100px;} 
        }

        .showMoreContainer {
            padding: 0px;
            margin: 0px;
            opacity: 0px;
            -moz-transition: height .5s;
            -ms-transition: height .5s;
            -o-transition: height .5s;
            -webkit-transition: height .5s;
            transition: height .5s;
            height: 0;
            overflow: hidden;
        }

        .slider {
            border-radius: 0px 3px 3px 0px;
            margin-bottom: 5px;
            border-bottom: 0px solid silver;
            white-space: nowrap;
            font-family: Oswald;
            color: grey;
            font-size: 12px;
            letter-spacing:1px;
        }
        .numberSlider {
            display:inline-block;
            border:1px solid white;
            font-size:10px;
            width:1.1rem;
            height:1.1rem;
            text-align:center;
            line-height:18px;
            border-radius: 50%;
        }
        .numberSliderNone {
            display:inline-block;
            font-size:10px;
            width:1rem;
            height:1rem;
            text-align:center;
            line-height:16px;
            border-radius: 50%;
        }
        .sliderSelected{
            margin-bottom: 5px;
            font-size: 12px;
            border-bottom: 0px solid silver;
            color: white;
            font-weight: bold;
            background: linear-gradient(to left, transparent ,rgb(48, 83, 112));
            white-space: nowrap;
            font-family: Oswald;
            letter-spacing:1px;
            border-top-left-radius:7px;
            border-bottom-left-radius:7px;
        }
        .sliderSelectedPending {
            margin-bottom: 5px;
            font-size: 12px;
            border-bottom: 0px solid silver;
            color: white;
            font-weight: bold;
            background: linear-gradient(to left, transparent ,rgb(48, 83, 112));
            white-space: nowrap;
            font-family: Oswald;
            letter-spacing:1px;
            border-top-left-radius:7px;
            border-bottom-left-radius:7px;
        }

        .forProgress {
            border-left:2px solid black;
            display:inline-block;
            margin:0px;
        }

        .forProgress > div {
            padding-left:8px;
        }

        .liPending::before {
            content: '\2B24';
            position: absolute;
            margin-left:-12.5px;
            margin-right:8px;
            font-size:8px;
            text-shadow:0px 0px 10px 0px red;
        }
        .liSelected::before {
            content: '\2B24';
            position: absolute;
            margin-left:-12.5px;
            margin-right:8px;
            font-size:8px;
            text-shadow:0px 0px 10px 0px red;
        }
        .liSlider::before {
            content: '\2B24';
            position: absolute;
            margin-left:-12.5px;
            margin-right:8px;
            font-size:8px;
            text-shadow:0px 0px 10px 0px red;
        }
        .loader2{
			width:200px;
			height:200px;
			top:40%;
			background:url('../images/lod6.svg');
			background-repeat:no-repeat;
			background-size:80px 80px;
			background-position:48% 48%;
			z-index:100;
        }

        .absoluteHolder2{
            z-index:105;
            position:absolute;
            text-align:center;
            width:100%;
            height:100%;
            /* background-color:rgba(252, 254, 254,1); */
        }
    </style>
</head>
<body>
    <div class="mainContainer">
        <div class="menuContainer">
            <div class="header">
                <!-- <div class="logo"></div>
                <div class="logo1" style="margin-left:10px;"></div>
                <div style="position:absolute; top:3vh; left:0; right:0; margin-left: auto; margin-right: auto; font-family:Cuprum; letter-spacing:1px;">
                    DOCTRACK PUBLIC SEARCH
                    <div style="font-size:14px; font-family:Oswald; margin-top:-10px; letter-spacing:5.4px; margin-left:4px;">www.davaocityportal.com</div>
                </div> -->
            </div>
            <div class="body">
                <div id="mainMenu" class="nav" style="display:none;">
                    <div id="item1" class="item1 navItem" onclick="showHideMenu(this)">
                        <div>PAYROLL</div>
                        <div>SEARCH</div>
                    </div>
                    <div id="item2" class="item2 navItem" onclick="showHideMenu(this)">
                        <div>INFRASTRUCTURE</div>
                        <div>SEARCH</div>
                    </div>
                    <div id="item3" class="item3 navItem" onclick="showHideMenu(this)">
                        <div>GOODS AND SERVICES</div>
                        <div>SEARCH</div>
                    </div>
                    <div id="item4" class="item4 navItem" onclick="showHideMenu(this)">
                        <div>OTHER TRANSACTIONS</div>
                        <div>SEARCH</div>
                    </div>
                </div>
                <div id="floatingContainer" class="floatingContainer" style="">
                    <div style=""><?php require(ROOTER . 'interface/mobilePayroll.php'); ?></div>
                    <div style="display:none;"><?php require(ROOTER . 'interface/mobileInfra.php'); ?></div>
                    <div style="display:none;"><?php require(ROOTER . 'interface/mobileGoods.php'); ?></div>
                    <div style="display:none;"><?php require(ROOTER . 'interface/mobileVouchers.php'); ?></div>
                </div>
            </div>
            <div class="footer"></div>
        </div>
    </div>
</body>
<script>
    document.getElementById('tempSearchClick').click();

    function showHideMenu(me) {
        var menu = document.getElementById('mainMenu');
        var floatingContainer = document.getElementById('floatingContainer');
        var disMode = menu.style.display;
        var trig = me.id;

        if(trig != "") {
            var contInd = trig.replace('item', '');

            for (let i = 0; i < floatingContainer.children.length; i++) {
                floatingContainer.children[i].style.display = "none";
            }

            floatingContainer.children[contInd - 1].style.display = "";
        }

        if(disMode == "") {
            menu.style.display = "none";
            floatingContainer.style.display = "";
        }else {
            menu.style.display = "";
            floatingContainer.style.display = "none";
        }

        setResultsContainerHeight('resultsContainerVouchers');
        setResultsContainerHeight('resultsContainerGoods');
        setResultsContainerHeight('resultsContainerInfra');
        setResultsContainerHeight('resultsContainerPayroll');

        clearContainers();
    }

    function clearContainers() {

        var containers = document.getElementsByClassName('resultsContainer');

        for (var i = 0; i < containers.length; i++) {
            containers[i].innerHTML = "";            
        }

    }

    function showHideClear(me) {
        var container = me.parentNode.parentNode.parentNode.children[1];
        var spans = container.getElementsByTagName('SPAN');
        
        if(me.value.trim().length > 0) {
            spans[0].style.display = "inline-block";
        }else {
            spans[0].style.display = "none";
        }
    }

    function clearSearchField(fields, me) {
        var fieldNames = fields.split(',');

        for (let i = 0; i < fieldNames.length; i++) {
            document.getElementById(fieldNames[i]).value = '';
        }

        me.style.display = "none";
    }

    function setResultsContainerHeight(cont) {
        // Viewport height unit (vh) = 100 * (Pixel Unit Size / Viewport height)
        var resContainer = document.getElementById(cont);
        if(resContainer.innerHTML.trim().length == 0) {
            var vHeight = window.innerHeight;
            var offHeight = resContainer.getBoundingClientRect().top;
            // var addPad = (parseFloat(window.getComputedStyle(resContainer, null).getPropertyValue('padding-bottom').replace('px', '')) * 2) + 10; 
            var addPad = (parseFloat(window.getComputedStyle(resContainer, null).getPropertyValue('padding-bottom').replace('px', '')) * 2) + 10; 
            var desiredHinPx = vHeight - (offHeight + addPad) - 16;
            var convToVh = 100 * (desiredHinPx / vHeight);

            resContainer.style.height = round2(convToVh)+'vh';
        }
    }

    function revealShowMore(container) {
        if (container.clientHeight) {
            container.style.height = 0;
        } else {
            // Viewport height unit (vh) = 100 * (Pixel Unit Size / Viewport height)
            var wrapper = container.parentNode;
            var sampPx = container.children[0].clientHeight;
            var realHeight = (100 * (sampPx / window.innerHeight));
            var addtlHeight = 3;
            container.style.height = (realHeight+addtlHeight) + "vh";
        }
    }

    function mobileRegisterToThisTracking(tn, year, me) {
		if(year >= 2022){
			// var display  ="<table border='0' cellpadding='0' cellspacing='0' style = 'background-color:rgb(232, 234, 234); margin:0px auto; margin-top:14vh; padding:3px 8px; font-family:NOR;'>"
            //              +" <tr>"
            //              +"     <td style='padding:2px 5px; vertical-align:bottom; font-size:20px; font-weight:bold; padding-bottom:3px; color:gray;'>My number</td>"
            //              +"     <td style='text-align:right; padding:0px;'>"
            //              +"         <span id='clickClose' onclick='closeAbsolute()' style='font-size:22px; color:#d98282; -webkit-text-stroke: 1px #4c3b3b;'>&#10006;</span>"
            //              +"     </td>"
            //              +" </tr>"
            //              +" <tr>"
            //              +"     <td colspan='2'>"
            //              +"         <div></div>"
            //              +"         <input id='myNumber' onkeydown='return isValueNumber(this,event)' maxlength='11' style='font-family:NOR; font-size:22px; font-weight:bold; text-align:center; padding:5px 2px; border:0px; border-bottom:2px solid black;' placeholder='09XXXXXXXXX'>"
            //              +"     </td>"
            //              +" </tr>" 
            //              +" <tr>"
            //              +"     <td colspan='2' style = 'text-align:center; padding:10px 0px 5px 0px;'>"
            //              +"         <div style='background-color:silver; font-weight:bold; font-size:20px; padding:5px 0px;' onclick='saveNowMyNumberMobileVer(\""+tn+"\",\""+year+"\")'>Save</div>"
            //              +"     </td>"
            //              +" </tr>"
			// 			 +"</table>";

            var display  ="<table border='0' cellpadding='0' cellspacing='0' style = 'background-color:rgb(232, 234, 234); margin:0px auto; margin-top:14vh; padding:3px 8px; font-family:NOR;'>"
                         +" <tr>"
                         +"     <td style='padding:2px 5px; vertical-align:bottom; font-size:18px; font-weight:bold; padding-bottom:3px; color:gray;'>My number</td>"
                         +"     <td style='text-align:right; padding:0px;'>"
                         +"         <span id='clickClose' onclick='closeAbsolute()' style='font-size:22px; color:#d98282; -webkit-text-stroke: 1px #4c3b3b;'>&#10006;</span>"
                         +"     </td>"
                         +" </tr>"
                         +" <tr>"
                         +"     <td colspan='2' style = 'text-align:center; padding-top:3px;'>"
                         +"         <input id='myNumber' onkeydown='return isValueNumber(this,event)' maxlength='11' style='font-family:NOR; font-size:22px; font-weight:bold; text-align:center; padding:5px 2px; border:0px; border-bottom:2px solid black;' placeholder='09XXXXXXXXX'>"
                         +"     </td>"
                         +" </tr>" 
                         +" <tr>"
                         +"     <td colspan='2' style = 'text-align:center; padding:8px 0px 5px 0px;'>"
                         +"         <div style='background-color:#e3b0b0; font-size:18px; padding:5px 0px; display:inline-block; width:5rem; border:1px solid silver; background-color:white;' onclick='saveNowMyNumberMobileVer(\""+tn+"\",\""+year+"\")'>Save</div>"
                         +"     </td>"
                         +" </tr>"
						 +"</table>";
            theAbsolute3(display);
		}else{
			alert("This feature is for 2022 transactions and above only.");
		}
    }

    function mobileRegisterToThisTrackingPayroll(tn, year, me) {
        if(year >= 2022){
            var display ="<div style='box-shadow:0px 0px 20px 10px rgba(0, 0, 0,.4); padding:15px; margin-top:14vh; display:inline-block; background-color:rgba(252, 255, 255,.1);'>" 
                        +"<div style='text-align:right; margin-bottom:8px;'>"
                        +"  <span id='clickClose' onclick='closeAbsolute()' style='font-size:12px; display:inline-block; width:1rem; text-align:center; background-color:rgb(223, 224, 225); border:1px solid rgb(223, 224, 225); border-right:1px solid gray; border-bottom:1px solid gray;'>&#10006;</span>"
                        +"</div>"
                        +"<table border='0' cellpadding='0' cellspacing='0' id='mobileIndiGenReg' style='background-color:white; margin:0px auto; padding:5px; font-family:NOR;'>"
                        +" <tr style='background-color:rgb(54, 102, 139);'>"
                        +"     <td colspan='2' style='font-size:12px; color:white; letter-spacing:1px; padding:3px 5px;'>CONTACT REGISTRATION</td>"
                        +" </tr>"
                        +" <tr>"
                        +"     <td style='padding:0px 3px; padding-top:8px; padding-left:12px;'>Phone Number</td>"
                        +"     <td style = 'text-align:center; padding-top:8px; padding-right:12px;'>"
                        +"         <input id='myNumber' onkeydown='return isValueNumber(this,event)' maxlength='11' style='font-family:NOR; font-size:14px; font-weight:bold; padding:5px 2px; border:0px; background-color:rgb(229, 234, 235); width:9rem; text-align:center;' placeholder='09XXXXXXXXX'>"
                        +"     </td>"
                        +" </tr>" 
                        +" <tr>"
                        +"     <td style=''></td>"
                        +"     <td style = 'text-align:center; padding:8px 0px 5px 0px;'>"
                        +"         <div style='background-color:#e3b0b0; font-size:12px; padding:3px 0px; display:inline-block; width:3rem; border:1px solid silver; background-color:white;' onclick='saveNowMyNumberMobileVer(\""+tn+"\",\""+year+"\")'>Save</div>"
                        +"     </td>"
                        +" </tr>"
						+"</table>"
                        +"<div id='genRegClickHere' style='font-size:12px; width:15.3rem; border-top:1px solid rgba(0,0,0,.1); background-color:white; text-align:justify; padding:5px 12px; font-family:NOR;'>"
                        +"  Gusto ba mo maka dawat og text message kung ang inyong sweldo og uban pa na mga transaction pwede na ma withdraw or ma-claim? <span onclick='showMobileGenReg()' style='font-weight:bold; color:orange;'>Click here</span>"
                        +"</div>"
                        +"<table id='mobileAllGenReg' border='0' cellpadding='0' cellspacing='0' style='background-color:white; margin:0px auto; padding:5px; font-family:NOR; display:none;'>"
                        +" <tr style='background-color:rgb(54, 102, 139);'>"
                        +"     <td colspan='2' style='font-size:12px; color:white; letter-spacing:1px; padding:3px 5px;'>CONTACT REGISTRATION</td>"
                        +" </tr>"
                        +" <tr>"
                        +"     <td style='padding:8px 5px 3px 8px; text-align:right;'>ID Number</td>"
                        +"     <td style = 'text-align:center; padding-top:8px; padding-right:8px;'>"
                        +"         <input id='rEmployeeNumber' onkeydown='return isValueNumber(this,event)' maxlength='6' style='font-family:NOR; font-size:14px; font-weight:bold; padding:5px 2px; border:0px; background-color:rgb(229, 234, 235); width:9rem; text-align:center;' placeholder=''>"
                        +"     </td>"
                        +" </tr>" 
                        +" <tr>"
                        +"     <td style='padding:3px 5px 3px 8px; text-align:right;'>Last Name</td>"
                        +"     <td style = 'text-align:center; padding-top:3px; padding-right:8px;'>"
                        +"         <input id='rLastname' maxlength='20' style='font-family:NOR; font-size:14px; font-weight:bold; padding:5px 2px; border:0px; background-color:rgb(229, 234, 235); width:9rem; text-align:center;' placeholder=''>"
                        +"     </td>"
                        +" </tr>" 
                        +" <tr>"
                        +"     <td style='padding:3px 5px 3px 8px; text-align:right;'>First Name</td>"
                        +"     <td style = 'text-align:center; padding-top:3px; padding-right:8px;'>"
                        +"         <input id='rFirstname' maxlength='20' style='font-family:NOR; font-size:14px; font-weight:bold; padding:5px 2px; border:0px; background-color:rgb(229, 234, 235); width:9rem; text-align:center;' placeholder=''>"
                        +"     </td>"
                        +" </tr>" 
                        +" <tr>"
                        +"     <td style='padding:3px 5px 3px 8px; text-align:right;'>Phone Number</td>"
                        +"     <td style = 'text-align:center; padding-top:3px; padding-right:8px;'>"
                        +"         <input id='rContact' onkeydown='return isValueNumber(this,event)' maxlength='11' style='font-family:NOR; font-size:14px; font-weight:bold; padding:5px 2px; border:0px; background-color:rgb(216, 217, 218); width:9rem; text-align:center;' placeholder='09XXXXXXXXX'>"
                        +"     </td>"
                        +" </tr>" 
                        +" <tr>"
                        +"     <td style=''></td>"
                        +"     <td style = 'text-align:center; padding:8px 8px 5px 0px;'>"
                        +"         <div style='background-color:#e3b0b0; font-size:12px; padding:3px 0px; display:inline-block; width:3rem; border:1px solid silver; background-color:white;' onclick='sendRegistrationMobile()'>Save</div>"
                        +"     </td>"
                        +" </tr>"
                        +"<tr>"
                        +"     <td style=''></td>"
                        +"     <td style='padding:8px 8px 5px 0px; text-align:center; font-size:12px;'>Back to Tracking only?<span onclick='showMobileGenReg()' style='color:orange; font-weight:bold;'> Click here</span></td>"
                        +"</tr>"
                        +"</table>"
						+"</div>";
            theAbsolute3(display);
		}else{
			alert("This feature is for 2022 transactions and above only.");
		}
    }

    function showMobileGenReg() {
        var indiCont = document.getElementById('mobileIndiGenReg');
        var allCont = document.getElementById('mobileAllGenReg');
        var clickHere = document.getElementById('genRegClickHere');

        if(allCont.style.display == 'none') {
            allCont.style.display = '';
            indiCont.style.display = 'none';
            clickHere.style.display = 'none';
        }else {
            allCont.style.display = 'none';
            indiCont.style.display = '';
            clickHere.style.display = '';
        }
    }

    function saveNowMyNumberMobileVer(tn, year) {
		var number = myNumber.value;
		if(year > 2021){
			var joiners = year + '~!~' + tn + '~!~' + number;	
			joiners =  vScram(joiners);
			x = 0;
			if(number.substr(0,1) != 0){
				x = 1;
			}
			
			if(number.length != 11){
				x = 1;
			}
			
			if(x == 1){
				alert("Invalid mobile number.");
			}else{
				clickClose.click();
				var queryString = "?saveNowMyNumber=1&txet=" +  encodeURIComponent(joiners);
				var container = "";
				loader();
				ajaxGetAndConcatenate(queryString,processorLink,container,"saveNowMyNumber");
			}
		}else{
			alert("This feature is for 2022 transactions and above only.");
		}
    }

    function sendRegistrationMobile(){
		var emp = document.getElementById('rEmployeeNumber').value;
		var lastname = document.getElementById('rLastname').value;
		var firstname = document.getElementById('rFirstname').value;
		var number = document.getElementById('rContact').value;

		var err = "";
		if(emp.length != 6){
			err += "Invalid employee Number.\n";
		}
		if(lastname.length <= 1){
			err += "Invalid last name.\n";
		}
		if(firstname.length <= 1){
			err += "Invalid first name.\n";
		}
		if(number.length > 0 && number.length < 11){
			err += "Incomplete cellphone number.\n";
		}
		if(number.length > 11){
			err += "Cellphone number should be 11 digits only.\n";
		}
		if(err.length < 1){
			var joiners =  emp + '@#$' + lastname  + '@#$' + firstname + '@#$' + number ;
			joiners = encodeURIComponent(vScram(joiners));
			
			var queryString = "?saveRegisterNotification=1&txetreg=" + joiners;
			var container = "";
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"saveRegisterNotification");
		}else{
			alert(err);
		}
		
	}
    
</script>
</html>
