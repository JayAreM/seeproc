<style>
    #mainDrrmoCont{
		width:100%;
		height:100%;
	}

	#drrmMenu{
		padding:0px 10px;
		background-color:rgb(88, 105, 120);
        font-size:0px;
	}
	.drrmMenuItem{
		display:inline-block;
		padding:10px 10px;
		color:white;
		transition: all 1s;
		cursor:pointer;
		text-shadow:0px 0px 2px black;
        font-size:16px;
	}
	.drrmMenuItem:hover{
		background-color:rgb(135, 132, 129);
		color:white;
	}
    .drrmMenuSelected {
        display: inline-block;
        padding: 10px 10px;
        transition: all 1s;
        cursor: pointer;
        text-shadow: 0px 0px 2px black;
        background-color: rgb(41, 52, 67);
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

<div id="mainDrrmoCont" style="">
    <div id="drrmMenu">
        <div class="drrmMenuItem" id="drrmM1" onclick="menuClickDrrm(this)">Encode</div>
    </div>
    <div id="drrmBody" style="background-color:rgba(251, 248, 246,.9); min-height:100vh; padding:10px 10px;">
        <div style="min-width:800px; min-height:500px; margin:0px auto; background-color:white; padding:20px 20px;">
            <div id="drrmMainContainer" style="">
                <div class="hide" style="text-align:center;">
                    <?php require(ROOTER . 'interface/drrmoEncoder.php'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    whenRefreshDRRMOMain();
	function whenRefreshDRRMOMain(){
		var cookieMainText = cookieLabel(cookieMainMenu(),"container1");
		if(cookieMainText == "DRRMO"){
            loadDRRMOCookieDefault();
			var cookieValue = readCookie("lastMainDrrmo").trim();

            if(cookieValue == 0) {
                loaderDRRMOEncoderDefaults();
            }
		}
	}

    function loadDRRMOCookieDefault(){
		//sa menu na cookie
		var cookieValue = readCookie("lastMainDrrmo").trim();
		var parent = document.getElementById('drrmMenu');
		parent.children[cookieValue].className = "drrmMenuSelected";
		//sa body
		var parentBody =  document.getElementById('drrmMainContainer');
		parentBody.children[cookieValue].className = "mainBodyshow";
	}

    function menuClickDrrm(me){
		menuChanger(me,"drrmMenuSelected","lastMainDrrmo","drrmMainContainer","");
		var menu = me.id;
        var type = "";

        if(menu == 'drrmM1') {
            loaderDRRMOEncoderDefaults();
        }
	}


</script>