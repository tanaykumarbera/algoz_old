<?php
    require_once './aOdNmLiYn.php';
    require_once './functions.php';
    
    printHeader(array(
            'title' => "Categorise | Algorithms"
        ),array(
            'style'=>'<style>html{min-width: 1000px;}.cont{ min-width: 970px; display: block; margin: 10px auto;}#sideBar{ width: 350px; float: left; position: relative; }#loader{ position: relative; width: 600px; float: right; margin-top: 30px;}#catL{ height: 300px;}#listPanel{ height: 500px;}#catL, #algoList{overflow-y: scroll; overflow-x: hidden;}#algoList{ height:450px;}</style>'
    ));
?>
    <section>
        <div class="container">
            <div class="cont">
                <div id="sideBar">
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
                    <div class="panel panel-default">
                        <div id="catP" class="panel-body">
                            <p class="alert alert-warning txtC"><span class="glyphicon glyphicon-info-sign"></span> Please select an algorithm first.</p>
                            <div id="catL"></div>
                        </div>
                        <div class="panel-footer">
                            <div class="input-group">
                                <input type="text" id="cat" name="cat" class="form-control" placeholder="or add a new"/>
                                <div class="input-group-btn">
                                    <button type="button" id="catAdd" onclick="addCat()" class="btn btn-default"><span id="btn" class="glyphicon glyphicon-plus-sign"></span></button>
                                </div>
                            </div>
                            <div class="row mTop10">
                                <button type="button" id="catSub" onclick="subCat()" class="btn btn-default blockC"><span id="sbtn" class="glyphicon glyphicon-save"></span>&nbsp;Save Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
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
            var req=$.ajax({
                        url: "categoryHelper.php",
                        type: "POST",
                        data: "aid="+$(anc).attr("aid"),
                        timeout: 10000
                   });
            req.done(function(msg){
                if(msg!="error"){
                    $("#catP").html(msg);
                    $("a.active").removeClass("active");
                    $(anc).addClass("active");
                }
                else{
                    alert("Something went wrong! Try again");
                }
            });
            req.fail(function(msg){
                $("#catP").html('<p class="alert alert-warning txtC"><span class="glyphicon glyphicon-info-sign"></span> Sorry unable to request Server.</p>');
            });
            
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
        //'fscript' => 'function lalgo(){var e=$.ajax({url:"algoFilter.php",type:"POST",data:"fTxt="+$("#filter").val(),timeout:1e4});e.done(function(e){if(e!="error"){$("#algoList").html(e)}else{alert("Something went wrong! Try again")}});e.fail(function(e){$("#catP").html(\'<p class="alert alert-warning txtC"><span class="glyphicon glyphicon-info-sign"></span> Sorry unable to request Server.</p>\')})}function shw(e){var t=$.ajax({url:"categoryHelper.php",type:"POST",data:"aid="+$(e).attr("aid"),timeout:1e4});t.done(function(t){if(t!="error"){$("#catP").html(t);$("a.active").removeClass("active");$(e).addClass("active")}else{alert("Something went wrong! Try again")}});t.fail(function(e){$("#catP").html(\'<p class="alert alert-warning txtC"><span class="glyphicon glyphicon-info-sign"></span> Sorry unable to request Server.</p>\')})}function addCat(){$("#catAdd").addClass("disabled");$("#btn").toggleClass("glyphicon-plus-sign glyphicon-time");var e=$.ajax({url:"categoryAdd.php",type:"POST",data:"cat="+$("#cat").val(),timeout:1e4});e.done(function(h){if(h!="error"){$("#catL").append(h);$("#cat").val("");$("#btn").toggleClass("glyphicon-time glyphicon-plus-sign");$("#catAdd").removeClass("disabled")}else{alert("Something went wrong! Try again");$("#btn").toggleClass("glyphicon-time glyphicon-plus-sign");$("#catAdd").removeClass("disabled")}});e.fail(function(h){alert("Something went wrong! Retry.");$("#btn").toggleClass("glyphicon-time glyphicon-plus-sign");$("#catAdd").removeClass("disabled")})}function subCat(){$("#catSub").addClass("disabled");$("#sbtn").toggleClass("glyphicon-save glyphicon-time");var e=new Array;$("input:checked").each(function(){e.push($(this).val())});var t=$.ajax({url:"categoryAdd.php",type:"POST",data:"aid="+$("a.active").attr("aid")+"&updt="+e,timeout:1e4});t.done(function(e){if(e!="error"){$("#sbtn").toggleClass("glyphicon-time glyphicon-save");$("#catSub").removeClass("disabled")}else{alert("Something went wrong! Try again");$("#sbtn").toggleClass("glyphicon-time glyphicon-save");$("#catSub").removeClass("disabled")}});t.fail(function(e){alert("Something went wrong! Retry.");$("#sbtn").toggleClass("glyphicon-time glyphicon-save");$("#catSub").removeClass("disabled")})}',
        'jReady' => 'lalgo();',
        'uT'=>'1'
    ));
    
    
    
    
    
    /*
     -------------------------------------------------------------------------------
     * 
     *  garbage
     * 
     * <script>
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
            var req=$.ajax({
                        url: "categoryHelper.php",
                        type: "POST",
                        data: "aid="+$(anc).attr("aid"),
                        timeout: 10000
                   });
            req.done(function(msg){
                if(msg!="error"){
                    $("#catP").html(msg);
                    $("a.active").removeClass("active");
                    $(anc).addClass("active");
                }
                else{
                    alert("Something went wrong! Try again");
                }
            });
            req.fail(function(msg){
                $("#catP").html('<p class="alert alert-warning txtC"><span class="glyphicon glyphicon-info-sign"></span> Sorry unable to request Server.</p>');
            });
            
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
     * 
     * -------------------------------------------------------------------------------
     * 
     * <style>
            html{min-width: 1000px !important;}
            .cont{ min-width: 970px !important; display: block; margin: 10px auto;}
            #sideBar{ width: 350px; float: left; position: relative; }
            #loader{ position: relative; width: 600px; float: right; margin-top: 30px;}
            #catL{ height: 300px;}
            #listPanel{ height: 500px;}
            #catL, #algoList{overflow-y: scroll; overflow-x: hidden;}
            #algoList{ height:450px;}
      </style>
    */
?>

