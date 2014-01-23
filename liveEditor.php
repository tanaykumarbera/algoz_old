<?php
    require_once './aOdNmLiYn.php';
    require_once './functions.php';
    
    printHeader(array(
        'title' => "Editor | Algoz",
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
            #butHolder{position: fixed; bottom: 20px; right: 30px; padding: 5px 20px; width: 500px; height: 30px;}
            </style>
        '
    ));
?>
    <section>
        <div class="container">
            <div class="cont">
                <div id="sideBar">
                    <div style="width: 100%; height: 50px; text-align: left; color: white;">
                        <span><span class="glyphicon glyphicon-cog"> Editor | Algo List</span>
                        <button type="button" class="btn btn-xs pull-right" onclick="togg()"><span class="caret"></span></button>
                    </div>
                    <p class="txtC white">
                        <input type="radio" id="tb" name="tb" value="rolling" onclick="lalgo();" checked="checked"/> live&nbsp;&nbsp;
                        <input type="radio" id="tb" name="tb" value="rolled" onclick="lalgo();"/> stock
                    </p>
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
                        data: "fTxt="+$("#filter").val()+"&tb="+$("#tb:checked").val(),
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
            $(".active").removeClass("active");
            $(anc).addClass("active");
            $("#frame").attr("src","./showEditor.php?aid="+$(anc).attr("aid")+"&tb="+$("#tb:checked").val());
        }
       
    </script>
<?php
    printFooter(array(
        'jReady'=>'lalgo();',
        'dispFooter'=>'0',
        'uT'=>'1'
    ));
?>
