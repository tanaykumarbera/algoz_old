<?php
    require_once './functions.php';
    printHeader(array(
        'title' => "Categorise | Algorithms"
    ),array(
        'style'=>'
            <style>html{min-width: 1000px !important;}
            .cont{ min-width: 970px !important; display: block; margin: 10px auto;}
            #sideBar{ width: 350px; float: left; position: relative; }
            #loader{ position: relative; width: 600px; float: right; margin-top: 50px;}
            #catP{ height: 350px;}
            #listPanel{ height: 500px;}
            #catP, #algoList{overflow-y: scroll; overflow-x: hidden;}
            #algoList{ height:450px;}
            </style>
        '
    ));
?>
    <section>
        <div class="container">
            <div class="cont">
                <div id="sideBar">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Filter out algorithms" name="filter" id="filter">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-indent-right"></i></button>
                            </div>
                    </div>
                    <div id="listPanel" class="panel panel-primary mTop10">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-random"></span>
                            <span>&nbsp;Select an algorithm</span>
                        </div>
                        <div id="algoList" class="list-group">
                            <a  class="list-group-item" onclick="shw(1)">Action</a>
                            <a  class="list-group-item" onclick="shw(2)">Another action</a>
                            <a href="#" class="list-group-item" onclick="shw(3)">Something else here</a>
                            <a href="#" class="list-group-item" onclick="shw(4)">Action</a>
                            <a href="#" class="list-group-item" onclick="shw(5)">Another action</a>
                            <a href="#" class="list-group-item" onclick="shw(6)">Something else here</a>
                            <a href="#" class="list-group-item" onclick="shw(7)">Action</a>
                            <a href="#" class="list-group-item" onclick="shw(8)">Another action</a>
                            <a href="#" class="list-group-item" onclick="shw(9)">Something else here</a>
                            <a href="#" class="list-group-item" onclick="shw(10)">Action</a>
                            <a href="#" class="list-group-item" onclick="shw(11)">Another action</a>
                            <a href="#" class="list-group-item" onclick="shw(12)">Something else here</a>
                            <a href="#" class="list-group-item" onclick="shw(13)">Action</a>
                            <a href="#" class="list-group-item" onclick="shw(14)">Another action</a>
                            <a href="#" class="list-group-item" onclick="shw(15)">Something else here</a>
                            <a href="#" class="list-group-item" onclick="shw(16)">Action</a>
                            <a href="#" class="list-group-item" onclick="shw(17)">Another action</a>
                            <a href="#" class="list-group-item" onclick="shw(18)">Something else here</a>
                            <a href="#" class="list-group-item" onclick="shw(19)">Action</a>
                            <a href="#" class="list-group-item" onclick="shw(20)">Another action</a>
                            <a href="#" class="list-group-item" onclick="shw(21)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div id="loader">
                    <div class="panel panel-default">
                        <div><p class="alert alert-info m10 txtC">Algorithm Name: Karnaugh ka beta</p></div>
                        <div id="catP" class="list-group">
                            <p class="alert alert-warning txtC"><span class="glyphicon glyphicon-info-sign"></span> Woah! Looks like there's nothing to show! Did something went wrong?</p>
                           
                            
                            <span class="list-group-item"><input type="checkbox" name="cat[]" value="1" checked="checked" />&nbsp;'.$a['categoryName'].</span>
                            <span class="list-group-item"><input type="checkbox" name="cat[]" value="2" checked="checked" />&nbsp;'.$a['categoryName'].</span>
                            <span class="list-group-item"><input type="checkbox" name="cat[]" value="3" checked="checked" />&nbsp;'.$a['categoryName'].</span>
                            <span class="list-group-item"><input type="checkbox" name="cat[]" value="4" checked="checked" />&nbsp;'.$a['categoryName'].</span>
                            
                             
                             
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
                    $("#catP").append(msg);
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
                        data: "updt="+upd,
                        timeout: 10000
                   });
            req.done(function(msg){
                if(msg!="error"){ alert(msg);
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
    printFooter();
?>
