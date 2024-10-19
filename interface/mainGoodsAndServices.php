<style>
    #mainGoodsCont{
		width:100%;
		height:100%;
	}

	#goodsMenu{
		padding:0px 10px;
		background-color:rgb(113, 146, 14);
        font-size:0px;
	}
	.goodsMenuItem{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
        font-size:16px;
	}
	.goodsMenuItem:hover{
		background-color:rgb(160, 181, 39);
		color:white;
	}
    .goodsMenuSelected {
        display: inline-block;
        padding: 10px 10px;
        transition: all 1s;
        cursor: pointer;
        text-shadow: 0px 0px 2px black;
        background-color: rgb(180, 203, 28);
        color: white;
        font-size:16px;
    }

    .goodsNum {
        font-size:16px;
        font-weight:bold;
        font-family:NOR;
        color:gray;
    }
    .goodsField {
        font-size:16px;
        padding-left:5px;
        font-family:NOR;
        color:rgb(2, 137, 161);
    }

    .goodsSubNum {
        font-size:16px;
        color:gray;
    }
    .goodsSubField {
        font-size:16px;
        font-family:NOR;
        /* color:rgb(2, 137, 161); */
    }

    .goodsItemNum {
        display:inline-block;
        text-align:center;
        background-color:rgb(225, 229, 232);
        width:25px;
        padding:6px 0px;
        font-family:NOR;
        font-size:12px;
        line-height:12px;
        font-weight:bold;
        border-radius:50px;
    }

    .goodsItemPlainInp {
        display:block;
        text-align:center;
        width:70px;
        background-color:transparent;
        border:0px;
        padding:0px;
        font-family:NOR;
    }
</style>

<div id="mainGoodsCont" style="">
    <div id="goodsMenu">
        <div class="goodsMenuItem" id="goodsM1" onclick="menuClickGoods(this)">PR</div>
        <div class="goodsMenuItem" id="goodsM2" onclick="menuClickGoods(this)">PO</div>
        <div class="goodsMenuItem" id="goodsM3" onclick="menuClickGoods(this)">Payment</div>
        <?php	if($_SESSION['perm'] == 47) :	?>
        <div class="goodsMenuItem" id="goodsM4" onclick="gotoDisasterView()">Disaster</div>
		<?php	endif;	?>
    </div>
    <div id="goodsBody" style="background-color:rgba(251, 248, 246,.88);">
        <div style="min-height:300px; height:100%; background-color:rgba(255,255,255,.5); padding:40px 0px; text-align:center;">
            <div style="display:inline-block; padding:20px; background-color:white; min-width:800px;">
                <table border="0" style="background-color:white; border-spacing:0px; box-shadow:0px 0px 16px 3px grey; min-height:400px; width:100%;">
                    <tr>
                        <td style="text-align:right; padding:10px 20px; vertical-align:top; height:0px;">
                            <span class = "data1" style = "margin-right:5px; font-family:NOR;">Tracking number</span>
                            <div id="goodsNewTrackingNumber" style="font-size:30px; display:inline-block; font-weight:bold; font-family:NOR;" class="data1">0000-0</div>
                        </td>
                    </tr>
                    <tr>
                        <td id="goodsMainContainer" style=" padding:10px 20px; vertical-align:top;">
                            <div class="hide" style="text-align:center; min-width:800px;">
                                <?php require(ROOTER . 'interface/goodsPRCreation.php'); ?>
                            </div>
                            <div class="hide" style="text-align:center; min-width:1000px;">
                                <?php require(ROOTER . 'interface/goodsPOCreation.php'); ?>
                            </div>
                            <div class="hide" style="text-align:center; min-width:1360px;">
                                <?php require(ROOTER . 'interface/goodsPXCreation.php'); ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    function gotoDisasterView() {
        window.open('../../../citydoc2023/interface/disasterView.php', '_new');
    }

    whenRefreshGoodsMain();
	function whenRefreshGoodsMain(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "Goods and Services"){
			loadInfraGoods();
			var cookieValue = readCookie("lastMainGoods").trim();

			var menuTitle =  cookieLabel(cookieValue,"goodsMenu");
			
			if(menuTitle == "PR"){
                type = "optPR";
			}else if(menuTitle == "PO"){
                type = "optPONew";
			}else if(menuTitle == "Payment"){
                type = "optPX";
			}

            goodsGetNewTrackingNumber(type);
		}
		
	
	}

    function loadInfraGoods(){
		//sa menu na cookie
		var cookieValue = readCookie("lastMainGoods").trim();
		var parent =  document.getElementById('goodsMenu');
		parent.children[cookieValue].className = "goodsMenuSelected";
		//sa body
		var parentBody =  document.getElementById('goodsMainContainer');
		parentBody.children[cookieValue].className = "mainBodyshow";
	}

    function menuClickGoods(me){
		menuChanger(me,"goodsMenuSelected","lastMainGoods","goodsMainContainer","");
		var menu = me.id;
        var type = "";
		
		if(menu == "goodsM1"){
            type = "optPR";
		}else if(menu == "goodsM2"){
            type = "optPONew";
		}else if(menu == "goodsM3"){
            type = "optPX";
		}

        goodsGetNewTrackingNumber(type);
	}

    function goodsGetNewTrackingNumber(type) {
        var queryString = "?selectNewDoctrack=1&type=" + type;
		var container = document.getElementById('goodsNewTrackingNumber');

		loader();
		ajaxGetAndConcatenate(queryString,processorLink,container,"selectNewDoctrack");
    }

    function clickToSearchTNNew(me){
		if(document.getElementById("container1")){
			document.getElementById("container1").children[0].click();
			for(var i  = 0 ; i < document.getElementById("doctrackMenuContainer").children.length;i++){
				if(document.getElementById("doctrackMenuContainer").children[i].textContent == "Tracker"){
					document.getElementById("doctrackMenuContainer").children[i].click();
					break;
				}
			}
			var trackingNumber = me.textContent;
			var queryString = "?searchTrackingNumber=1&trackingNumber=" + trackingNumber;
			var container = document.getElementById('doctrackUpdateContainer');
			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"searchTrackingNumber");
		}
		
	}

</script>