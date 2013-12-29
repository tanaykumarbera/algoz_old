<?php
    require_once './functions.php';
    printHeader(array(
        'title' => "Compose | Algorithms"
    ),array(
        'style' => '
            <style type="text/css" media="screen">
                #psCodeEditor{ 
                    position: relative;
                    height: 300px;
                }
            </style>
        '
    ));
?>
    <section>
        <div class="container">
            <form>
                <div class="form-group">
                            <label for="introEditor">A Brief Introduction</label>
                            <textarea class="form-control" id="introEditor" placeholder="Please provide a brief introduction"></textarea>
                        </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Pseudo Code</div>
                    <div id="psCodeEditor"><?php echo "\n\n\n\n\n /* Pseudo Code goes Here @_- */\n\n\n\n\n\n";?></div>
                </div>
                
            </form>
        </div>
    </section>
<?php    
    printFooter(array(
        script=>'
            <script src="http://ajaxorg.github.io/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
            <script>
                var editor = ace.edit("psCodeEditor");
                editor.setTheme("ace/theme/textmate");
                editor.getSession().setMode("ace/mode/javascript");
            </script>
        '
    ));
?>
