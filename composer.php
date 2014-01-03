<?php
    require_once './functions.php';
    printHeader(array(
        'title' => "Compose | Algorithms"
    ),array(
        'style' => '
            <style type="text/css" media="screen">
                #psCodeEditor,#cCodeEditor,#jCodeEditor,#pCodeEditor{ 
                    position: relative;
                    min-height: 300px;
                    height: 300px;
                }
            </style>
        '
    ));
?>
    <section>
        <div id="frmCont" class="container">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="alert"> Well we do not have any particular rules and regulations for you to follow ;)
                    Its a request not to repeat content and abide by our <a class="alert-link" href="#" >rules and regulations</a>. In case
                    there are no post notes to be mentioned, just leave the field blank. </p>
            </div>
            
            <form id="algoF" name="algoF">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Algorithm Name</span>
                        <input type="text" class="form-control" id="algoN" placeholder="Name of the Algoritm"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon">Tags</span>
                            <input type="text" class="form-control ckeditor" id="algoT" placeholder="Please separate Tags by a semicolon( ; )"/>
                    </div>
                </div>
                <div class="form-group well">
                            <label for="introEditor">Contextual part</label>
                            <textarea class="form-control ckeditor" id="introEditor" placeholder="Please provide a brief introduction"></textarea>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Pseudo Code</div>
                    <div id="psCodeEditor"><?php echo "\n\n\n\n\n /* Pseudo Code goes Here @_- */\n\n\n\n\n\n";?></div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <label for="postPseudo">Post Pseudo Note</label>
                            <textarea class="form-control ckeditor" id="postPseudo" placeholder="In case any note to be provided with the pseudo code, that goes here. Or else leave it blank."></textarea>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default panel-primary">
                    <div class="panel-heading">Implementation in C</div>
                    <div id="cCodeEditor"><?php echo "\n\n\n\n\n\n\n\n\n /* C Code goes Here @_- */\n\n\n\n\n\n\n\n\n\n";?></div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <label for="postC">Note</label>
                            <textarea class="form-control ckeditor" id="postC" placeholder="In case any note to be provided with the C code, that goes here. Or else leave it blank."></textarea>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default panel-primary">
                    <div class="panel-heading">Implementation in Java</div>
                    <div id="jCodeEditor"><?php echo "\n\n\n\n\n\n\n\n\n /* Java Code goes Here @_- */\n\n\n\n\n\n\n\n\n\n";?></div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <label for="postJ">Note</label>
                            <textarea class="form-control ckeditor" id="postJ" placeholder="In case any note to be provided with the java code, that goes here. Or else leave it blank."></textarea>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default panel-primary">
                    <div class="panel-heading">Implementation in Python</div>
                    <div id="pCodeEditor"><?php echo "\n\n\n\n\n\n\n\n\n /* Python Code goes Here @_- */\n\n\n\n\n\n\n\n\n\n";?></div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <label for="postP">Note</label>
                            <textarea class="form-control ckeditor" id="postP" placeholder="In case any note to be provided with the python code, that goes here. Or else leave it blank."></textarea>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default p10">
                    <div class="row form-group">
                        <div class="col-sm-4 mTop10">
                            <div class="input-group">
                                <span class="input-group-addon">O(<i>f</i>)</span>
                                <input type="text" class="form-control ckeditor" id="UB" placeholder="Upper bound"/>
                            </div>
                        </div>
                        <div class="col-sm-4 mTop10">
                            <div class="input-group">
                                <span class="input-group-addon">&Theta;(<i>f</i>)</span>
                                <input type="text" class="form-control ckeditor" id="TB" placeholder="Tight bound"/>
                            </div>
                        </div>
                        <div class="col-sm-4 mTop10">
                            <div class="input-group">
                                <span class="input-group-addon">&Omega;(<i>f</i>)</span>
                                <input type="text" class="form-control ckeditor" id="LB" placeholder="Lower bound"/>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer note">
                        <p>For super script, use 'sup' html tag. eg: for <span class="badge">n<sup>2</sup></span> use <code>n&lt;sup&gt;2&lt;/sup&gt;</code></p>
                        <p>For sub script, use 'sub' html tag. eg: for <span class="badge">log<sub>2</sub> n</span> use <code>log&lt;sub&gt;2&lt;/sub&gt; n</code></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="button" id="sbtn" class="btn btn-primary blockC" onclick="frmSub()" value="Submit"/>
                        </div>
                    </div>
                    <div id="subD" class="row mTop10 p10"></div>
                </div>
            </form>
        </div>
            <?php /*?>
            <script src="http://ajaxorg.github.io/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
            <script src="ck/ckeditor.js" type="text/javascript" charset="utf-8"></script>
            <script>
                var ps = ace.edit("psCodeEditor");
                var c= ace.edit("cCodeEditor");
                var j= ace.edit("jCodeEditor");
                var p= ace.edit("pCodeEditor");
                ps.setTheme("ace/theme/textmate");
                c.setTheme("ace/theme/textmate");
                j.setTheme("ace/theme/textmate");
                p.setTheme("ace/theme/textmate");
                ps.getSession().setMode("ace/mode/c_cpp");
                c.getSession().setMode("ace/mode/c_cpp");
                j.getSession().setMode("ace/mode/java");
                p.getSession().setMode("ace/mode/python");
                
                function valid(){
                    if($("#algoName").val()==""||$("#algoTags").val()==""||ckR(ck.introEditor)==""||$("#LB").val()==""||$("#TB").val()==""||$("#UB").val()==""){
                        alert("Something's wrong! You cant leave a field blank"); return FALSE;
                    }
                    else return TRUE;
                }
                function frmSub(){
                    $("#sbtn").addClass("disabled");
                    $("#sbtn").removeClass("disabled");
                    $("#sbtn").attr("value","Failed! Try Again");
                    $("#subD").html('<div class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>');
                    var d= "name="+$("#algoName").val()+"&tag="+$("#algoTags").val()+"&algoDesc="+$("#introEditor").val()+"&psCode="+ps.getValue()+"&psNote="+$("#postPseudo").val()
                            +"&cCode="+c.getValue()+"&cNote="+$("#postC").val()+"&jCode="+j.getValue()+"&jNote="+$("#postJ").val()+"&pCode="+p.getValue()+"&pNote="+$("#postP").val();
                    var ajReq= $.ajax({
                        url: "algoPush.php",
                        type: "POST",
                        data: d
                    });
                    
                    ajReq.done(function(msg){
                        $("#frmCont").html(msg);
                    });
                    return false;
                }
                
            </script>
            */
            ?>
    </section>
<?php    
    printFooter(array(
        script=>'<script src="http://ajaxorg.github.io/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script><script src="ck/ckeditor.js" type="text/javascript" charset="utf-8"></script><script>function ckR(a){return a.getData();}function frmSub(){$("#sbtn").addClass("disabled");$("#subD").html(\'<div class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>\');var ck=CKEDITOR.instances;var e="name="+$("#algoN").val()+"&tag="+$("#algoT").val()+"&intro="+ckR(ck.introEditor)+"&psCode="+ps.getValue()+"&psNote="+ckR(ck.postPseudo)+"&cCode="+c.getValue()+"&cNote="+ckR(ck.postC)+"&jCode="+j.getValue()+"&jNote="+ckR(ck.postJ)+"&pCode="+p.getValue()+"&pNote="+ckR(ck.postP)+"&lb="+$("#LB").val()+"&tb="+$("#TB").val()+"&ub="+$("#UB").val();var t=$.ajax({url:"algoPush.php",type:"POST",data:e,timeout:10000});t.done(function(e){if(e=="invalid"){$("#sbtn").removeClass("disabled");$("#subD").html("");alert("Looks like you left something important :(");}else{$("#frmCont").html(e)}});t.fail(function(e){$("#subD").html("");$("#sbtn").attr("value","Failed! Try Again").removeClass("disabled");});return false}var ps=ace.edit("psCodeEditor");var c=ace.edit("cCodeEditor");var j=ace.edit("jCodeEditor");var p=ace.edit("pCodeEditor");ps.setTheme("ace/theme/textmate");c.setTheme("ace/theme/textmate");j.setTheme("ace/theme/textmate");p.setTheme("ace/theme/textmate");ps.getSession().setMode("ace/mode/c_cpp");c.getSession().setMode("ace/mode/c_cpp");j.getSession().setMode("ace/mode/java");p.getSession().setMode("ace/mode/python");</script>'
    ));
?>
