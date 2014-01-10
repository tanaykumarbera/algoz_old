<?php
    require_once './functions.php';
    printHeader(array(
        'title' => "Approval Console | Algoz",
        'dispHeader'=>'0'
    ),array(
        'style'=>'
            <style>html{min-width: 1000px !important;}
            .cont{ min-width: 970px !important; display: block; margin: 10px auto;}
            #sideBar{ width: 350px; position: fixed; left: 10px; bottom: 0px; z-index: 1; padding: 20px; background: black; opacity: 0.8;}
            #loader{ position: absolute; width: 90%; height: 90%; margin: 10px auto; z-index: 0;}
            #frame{ position: relative; height: 100%; width: 100%; border: 2px dotted #ccc; }
            #catL{ height: 300px;}
            #listPanel{ height: 350px;}
            #catL, #algoList{overflow-y: scroll; overflow-x: hidden;}
            #algoList{ height: 300px;}
            </style>
        '
    ));
?>
    <section>
        <div class="container">
            <div class="cont">
                <div id="sideBar">
                    <div style="width: 100%; height: 50px; text-align: left; color: white;">
                        <span><span class="glyphicon glyphicon-cog"> Controls</span>
                        <button type="button" class="btn btn-xs pull-right" onclick="togg()"><span class="caret"></span></button>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Filter out algorithms" name="filter" id="filter" />
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="lalgo()"><i class="glyphicon glyphicon-indent-right"></i></button>
                        </div>
                    </div>
                    <div id="listPanel" class="panel panel-primary mTop10">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-random"></span>
                            <span>&nbsp;Select an algorithm</span>
                        </div>
                        <div id="algoList" class="list-group">
                        </div>
                    </div>
                    <div style="position: relative; width: 100%; height: 30px;"><input type="button" onclick="app()" value="Approve" class="btn btn-success blockC"/></div>
                </div>
                <div id="loader">
                    <iframe id="frame" src=""></iframe>
                </div>
            </div>
        </div>
    </section>
    <script>
        function togg(){
            if($("#sideBar").css("bottom")=="0px") $("#sideBar").animate({bottom: "-480px"},"slow");
            else $("#sideBar").animate({bottom: "0px"},"slow");
        }
        function lalgo(){
            var req=$.ajax({
                        url: "algoFilter.php",
                        type: "POST",
                        data: "fTxt="+$("#filter").val(),
                        timeout: 10000
                   });
            req.done(function(msg){
                if(msg!="error"){
                    $("#algoList").html(msg);
                }
                else{
                    alert("Something went wrong! Try again");
                }
            });
            req.fail(function(msg){
                $("#catP").html('<p class="alert alert-warning txtC"><span class="glyphicon glyphicon-info-sign"></span> Sorry unable to request Server.</p>');
            });
        }
        
        function shw(anc){
            $("#frame").attr("src","./showDemo.php?aid="+$(anc).attr("aid"));
            togg();
        }
        function addCat(){
            $("#catAdd").addClass("disabled");
            $("#btn").toggleClass("glyphicon-plus-sign glyphicon-time");
            var req=$.ajax({
                        url: "categoryAdd.php",
                        type: "POST",
                        data: "cat="+$("#cat").val(),
                        timeout: 10000
                   });
            req.done(function(msg){
                if(msg!="error"){
                    $("#catL").append(msg);
                    $("#cat").val("");
                    $("#btn").toggleClass("glyphicon-time glyphicon-plus-sign");
                    $("#catAdd").removeClass("disabled");
                }
                else{
                    alert("Something went wrong! Try again");
                    $("#btn").toggleClass("glyphicon-time glyphicon-plus-sign");
                    $("#catAdd").removeClass("disabled");
                }
            });
            req.fail(function(msg){
                alert("Something went wrong! Retry.");
                $("#btn").toggleClass("glyphicon-time glyphicon-plus-sign");
                $("#catAdd").removeClass("disabled");
            });
            
        }
        
        function subCat(){
            $("#catSub").addClass("disabled");
            $("#sbtn").toggleClass("glyphicon-save glyphicon-time");
            var upd = new Array();
            $("input:checked").each(function() {
               upd.push($(this).val());
            });
            var req=$.ajax({
                        url: "categoryAdd.php",
                        type: "POST",
                        data: "aid="+$("a.active").attr("aid")+"&updt="+upd,
                        timeout: 10000
                   });
            req.done(function(msg){
                if(msg!="error"){
                    $("#sbtn").toggleClass("glyphicon-time glyphicon-save");
                    $("#catSub").removeClass("disabled");
                }
                else{
                    alert("Something went wrong! Try again");
                    $("#sbtn").toggleClass("glyphicon-time glyphicon-save");
                    $("#catSub").removeClass("disabled");
                }
            });
            req.fail(function(msg){
                alert("Something went wrong! Retry.");
                $("#sbtn").toggleClass("glyphicon-time glyphicon-save");
                $("#catSub").removeClass("disabled");
            });
            
        }
       
    </script>
<?php
    printFooter(array(
        'jReady'=>'lalgo();',
        'dispFooter'=>'0'
    ));
?>
