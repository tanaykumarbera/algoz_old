<?php
    require_once './aOdNmLiYn.php';
    require_once './functions.php';
    
    
    if(isset($_REQUEST['tb'])&&$_REQUEST['tb']=='rolling') $tbl="livestore";
        else $tbl="algorithmstore";
    $id= $_REQUEST['aid'] ;
    
    $db= __db();
    
    $stm= $db->stmt_init();
    $stm->prepare("SELECT * FROM ".$tbl." WHERE id= ?");
    $stm->bind_param('s', $id);
    $stm->execute();
    
    $res= $stm->get_result();
    $algo= $res->fetch_array(MYSQLI_ASSOC);
    
    $code= json_decode($algo['algoCode']);
    $note= json_decode($algo['algoNote']);
    
    __close($stm);
    __close($db);
    
    printHeader(array(
            'title' => "Editor Window | Algorithms",
            'dispHeader'=>'0'
        ),array(
            'style' => '
                <style type="text/css" media="screen">
                    #psCodeEditor,#cCodeEditor,#jCodeEditor,#pCodeEditor{ 
                        position: relative;
                        min-height: 300px;
                    }
                    #introEditor{
                        min-height: 500px;
                    }
                    #postPseudo,#postC,#postJ,#postP{
                        min-height: 100px;
                    }
                </style>
            '
    ));
?>
    <section>
        <div id="frmCont" class="container">
            <form id="algoF" name="algoF">
                <div class="blnk120"></div>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">Algorithm Name</span>
                        <input type="text" class="form-control" id="algoN" placeholder="Name of the Algoritm" value="<?php echo $algo['algoName'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <?php if(isset($algo['aLink'])&&!empty($algo['aLink'])){ $alink= TRUE; ?>
                    <div class="input-group">
                        <span class="input-group-addon">ALink</span>
                        <input type="text" class="form-control" id="alnk" placeholder="A decent user friendle link" value="<?php echo $algo['aLink'];?>"/>
                    </div>
                    <?php }else $alink=FALSE;?>
                </div>
                <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon">Tags</span>
                            <input type="text" class="form-control" id="algoT" placeholder="Please separate Tags by a semicolon( ; )" value="<?php echo $algo['algoTags'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon">Wikipedia Link (for sameAs schema)</span>
                            <input type="text" class="form-control" id="aLink" placeholder="Enter a link to wikipedias page describing abou the same" value="<?php echo $algo['WLink'];?>"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                            <span class="input-group-addon">A short Description</span>
                            <input type="text" class="form-control" id="aDesc" placeholder="A short description (max 30 words)" value="<?php echo $algo['sDesc'];?>"/>
                    </div>
                </div>
                <div class="form-group well">
                            <label for="introEditor">Contextual part</label>
                            <div id="introEditor"><?php echo htmlspecialchars($algo['algoDesc']);?></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Pseudo Code</div>
                    <div id="psCodeEditor"><?php echo htmlspecialchars($code[0]);?></div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <label for="postPseudo">Post Pseudo Note</label>
                            <div id="postPseudo"><?php echo htmlspecialchars($note[0]);?></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default panel-primary">
                    <div class="panel-heading">Implementation in C</div>
                    <div id="cCodeEditor"><?php echo htmlspecialchars($code[1]);?></div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <label for="postC">Note</label>
                            <div id="postC"><?php echo htmlspecialchars($note[1]);?></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default panel-primary">
                    <div class="panel-heading">Implementation in Java</div>
                    <div id="jCodeEditor"><?php echo htmlspecialchars($code[2]);?></div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <label for="postJ">Note</label>
                            <div id="postJ"><?php echo htmlspecialchars($note[2]);?></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default panel-primary">
                    <div class="panel-heading">Implementation in Python</div>
                    <div id="pCodeEditor"><?php echo htmlspecialchars($code[3]);?></div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <label for="postP">Note</label>
                            <div id="postP"><?php echo htmlspecialchars($note[3]);?></div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default p10">
                    <div class="row form-group">
                        <div class="col-sm-4 mTop10">
                            <div class="input-group">
                                <span class="input-group-addon">O(<i>f</i>)</span>
                                <input type="text" class="form-control" id="UB" placeholder="Upper bound" value="<?php echo htmlspecialchars($algo['algoU']);?>"/>
                            </div>
                        </div>
                        <div class="col-sm-4 mTop10">
                            <div class="input-group">
                                <span class="input-group-addon">&Theta;(<i>f</i>)</span>
                                <input type="text" class="form-control" id="TB" placeholder="Tight bound" value="<?php echo htmlspecialchars($algo['algoT']);?>"/>
                            </div>
                        </div>
                        <div class="col-sm-4 mTop10">
                            <div class="input-group">
                                <span class="input-group-addon">&Omega;(<i>f</i>)</span>
                                <input type="text" class="form-control" id="LB" placeholder="Lower bound" value="<?php echo htmlspecialchars($algo['algoL']);?>"/>
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
           <script src="http://ajaxorg.github.io/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    
    		var ps = ace.edit("psCodeEditor");
                var c= ace.edit("cCodeEditor");
                var j= ace.edit("jCodeEditor");
                var p= ace.edit("pCodeEditor");
              var ie= ace.edit("introEditor");
              var pps= ace.edit("postPseudo");
              var pc= ace.edit("postC");
              var pj= ace.edit("postJ");
              var pp= ace.edit("postP");
                ps.setTheme("ace/theme/textmate");
                c.setTheme("ace/theme/textmate");
                j.setTheme("ace/theme/textmate");
                p.setTheme("ace/theme/textmate");
              pps.setTheme("ace/theme/crimson_editor");
              pc.setTheme("ace/theme/crimson_editor");
              pj.setTheme("ace/theme/crimson_editor");
              pp.setTheme("ace/theme/crimson_editor");
              ie.setTheme("ace/theme/crimson_editor");
                ps.getSession().setMode("ace/mode/c_cpp");
                c.getSession().setMode("ace/mode/c_cpp");
                j.getSession().setMode("ace/mode/java");
                p.getSession().setMode("ace/mode/python");
              pps.getSession().setMode("ace/mode/html");
              pc.getSession().setMode("ace/mode/html");
              pj.getSession().setMode("ace/mode/html");
              pp.getSession().setMode("ace/mode/html");
              ie.getSession().setMode("ace/mode/html");

function enc(stir){
    return encodeURIComponent(stir);
}

function frmSub(){
$("#sbtn").addClass("disabled");

$("#subD").html('<div class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>');

var e= "name="+enc($("#algoN").val())
        +"&tag="+enc($("#algoT").val())
        +"&link="+enc($("#aLink").val())
        +"&desc="+enc($("#aDesc").val())
        +"&intro="+enc(ie.getValue())
        +"&psCode="+enc(ps.getValue())
        +"&psNote="+enc(pps.getValue())
        +"&cCode="+enc(c.getValue())
        +"&cNote="+enc(pc.getValue())
        +"&jCode="+enc(j.getValue())
        +"&jNote="+enc(pj.getValue())
        +"&pCode="+enc(p.getValue())
        +"&pNote="+enc(pp.getValue())
        +"&lb="+enc($("#LB").val())
        +"&t8b="+enc($("#TB").val())
        +"&ub="+enc($("#UB").val())
        +"&aid="+"<?php echo $algo['id'];?>"
        +"&tb="+<?php echo '"'.$_REQUEST['tb'].'"'; if($alink) echo '+"&alnk="+enc($("#alnk").val())';?>;

        var t=$.ajax({url:"algoUpdate.php",type:"POST",data:e,timeout:10000});
        t.done(function(e){if(e=="invalid"){$("#sbtn").removeClass("disabled");$("#subD").html("");alert("Looks like you left something important :(");}else{$("#frmCont").html(e)}});

        t.fail(function(e){$("#subD").html("");$("#sbtn").attr("value","Failed! Try Again").removeClass("disabled");});
}

</script> 
              </section>
<?php    
    printFooter(array(
        'uT'=>'0',
        'dispFooter'=>'0'
    ));
?>
