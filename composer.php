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
        <div class="container">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="alert"> Well we do not have any particular rules and regulations for you to follow ;)
                    Its a request not to repeat content and abide by our <a class="alert-link" href="#" >rules and regulations</a>. In case
                    there are no post notes to be mentioned, just leave the field blank. </p>
            </div>
            
            <form>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Algorithm Name</span>
                        <input type="text" class="form-control ckeditor" id="aName" placeholder="Name of the Algoritm"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon">Tags</span>
                            <input type="text" class="form-control ckeditor" id="aTags" placeholder="Please separate Tags by a semicolon( ; )"/>
                    </div>
                </div>
                <div class="form-group">
                            <label for="introEditor">A Brief Introduction</label>
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
            </form>
        </div>
    </section>
<?php    
    printFooter(array(
        script=>'
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
            </script>
        '
    ));
?>
