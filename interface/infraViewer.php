<style>
    #infraViewContainer{
		background-color:white;
		display:inline-block;
		margin:0 auto;
		box-shadow:0px 0px 4px 1px grey;
		box-shadow:0px 0px 16px 3px grey;
        padding:20px; 
        min-height:500px;
        min-width:900px;
	}
    
    #infraViewerResults {
        width:100%;
        font-family:NOR;
        font-size:12px;
        border:1px solid silver;
    }

    #infraViewerResults th {
        text-align:left;
		padding:5px;
        background-color:rgb(241, 242, 242);
        border:1px solid white;
    }

    #infraViewerResults td {
        padding:3px 5px;
        border:1px solid white;
        border-bottom: 1px solid rgb(216, 219, 221);
        vertical-align:top;
    }

    #infraViewerResults td:first-child {
        font-size:12px;
        text-align:center;
    }

    #infraViewerResults  tr:nth-child(odd) {
		background-color: rgb(246, 250, 250);
	}

    #infraViewerResults tbody tr:hover {
        background-color:rgb(252, 244, 196);
    }

    #infraViewerResults tbody tr:hover td:first-child {
        background-color:white;
    }

    #infraViewerResults  tr:last-child td {
		border:0;
	}
	
</style>

<div style="padding:20px; background-color:white; display:inline-block; margin:10px; font-size:0px;">
    <div id="infraViewContainer" style="">
        <table id="" style="width: 100%;" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td style="padding:0px;">
                    <table style="margin:0px 0px 0px auto; font-family:Oswald;">
                    	
                        <tr>
                        	<td style = "font-weight: bold;letter-spacing:1px;color:rgb(12, 106, 173);">Search By</td>
                        	<td><input type="radio" name="searchType" id="infraFindTypeCode" checked></td>
                            <td><label class="hover" for="infraFindTypeCode">Project Code</label></td>
                            <td><input type="radio" name="searchType" id="infraFindTypeContractor" ></td>
                            <td><label class="hover" for="infraFindTypeContractor">Contractor</label></td>
                            <td><input type="radio" name="searchType" id="infraFindTypeProject" checked></td>
                            <td><label class="hover" for="infraFindTypeProject">Project</label></td>
                            <td style="padding-left:10px;">
                                <input id="" class="text3" style="width:300px; height:26px; font-weight: bold; padding:2px 5px; font-size: 14px; text-align:center; text-transform:uppercase;" value='' onkeydown="keypressAndWhat1(this,event,fetchViewerInfra,1)" type="text">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td id="infvResultContainer" style="padding:10px 0px;"></td>
            </tr>
        </table>
    </div>
</div>

<script>
    function fetchViewerInfra(me) {
        var part = me.value.trim();
        if(part.length > 0) {
            var findType = getFindTypeSelected();
            var queryString = "?fetchViewerInfra=1&part="+part+"&findType="+findType;
            var container = document.getElementById('infvResultContainer');

			loader();
			ajaxGetAndConcatenate(queryString,processorLink,container,"fetchViewerInfra");
        }

    }

    function getFindTypeSelected() {
        var rad = document.getElementsByName('searchType');

        for(var i = 0; i < rad.length; i++) {
            if(rad[i].checked == true) {
                return rad[i].id.replace('infraFindType', '');
            }
        }
    }

</script>