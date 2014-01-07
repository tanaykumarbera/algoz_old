<?php $aid=36;
$db= new mysqli('localhost', 'root', '', 'algoz');
$q= $db->stmt_init();
$q->prepare("SELECT * FROM algorithmstore WHERE id= ?");
$q->bind_param('i', $aid);
$q->execute();
$res= $q->get_result();
if($res->num_rows > 0){
    $algo= $res->fetch_array(MYSQLI_ASSOC);
    $tags= explode(';', $algo['algoTags']);
    require_once './functions.php'; $cats= array('cat1', 'Divide And Conquor', 'String Search');
    $source= array(); $notes=array();
    $source= json_decode($algo['algoCode']);
    $notes= json_decode($algo['algoNote']);
   
    printHeader(array(
        'title'=> trim($tags[0]).' | '.trim($tags[1]).' | AlgoZ'
    ));
?>
    <section>
        <div class="container">
            <div id="algo" itemscope itemtype="http://schema.org/Code">
                <?php   // if(!empty($algo['WLink'])) echo '<meta itemprop="sameAs" content="'.$algo['WLink'].'"/>';
                        // if(!empty($algo['GRepo'])) echo '<meta itemprop="codeRepository" content="'.$algo['WLink'].'"/>';?>
                <div id="title">
                    <h1 class="aNam"><span class="glyphicon glyphicon-fire"></span>&nbsp;<span itemprop="name"><?php __($algo['algoName']);?></span></h1>
                </div>
                <div id="tags">
                    <blockquote itemprop="keywords"><?php 
                        foreach ($tags as $t){ $tag= trim($t); if(!empty($tag)) echo '<a href="'.str_ireplace(' ', '_', $tag).'" title="# tag"><span class="label label-info tag"><span class="glyphicon glyphicon-tag"></span> &nbsp;'.$tag.'</span></a> ';}
                        foreach ($cats as $c){ $cat= trim($c); if(!empty($cat)) echo '<a href="'.str_ireplace(' ', '_', $cat).'" title="@ category"><span class="label label-info tag"><span class="glyphicon glyphicon-bookmark"></span>  &nbsp;'.$cat.'</span></a> ';}
                        echo '<span class="label label-warning tag" title="Lower Bound"><span class="glyphicon glyphicon-time"></span>  &nbsp;&Omega; ( '.$algo['algoL'].' )</span> ';
                        echo '<span class="label label-warning tag" title="Tight Bound"><span class="glyphicon glyphicon-time"></span>  &nbsp;&Theta; ( '.$algo['algoT'].' )</span> ';
                        echo '<span class="label label-warning tag" title="Upper Bound"><span class="glyphicon glyphicon-time"></span>  &nbsp;O ( '.$algo['algoU'].' )</span> ';
                  ?></blockquote>
                </div>
                <div id="description" itemprop="description">
                        <?php echo $algo['algoDesc'];?>
                </div>
                <div id="pseudo">
                    <div id="pseudoT"><span class="glyphicon glyphicon-pushpin"></span>&nbsp;the pseudo Code</div>
                    <pre><br/><br/><br/><?php echo $source[0];?></pre>
                </div>
                <div id="codeC" class="panel panel-primary mTop50">
                    <div class="panel-heading">
                        <span itemprop="programmingLanguage" itemscope itemtype="http://schema.org/Thing">
                            <meta itemprop="sameAs" content="http://en.wikipedia.org/wiki/C_(programming_language)"/>
                            <span id="codeC_img" class="codImg" itemprop="image"></span>
                            <span class="pL" itemprop="name">C</span>
                        </span>
                    </div>
                    <div id="codeC_body" class="codBlock" itemprop="sampleType"><?php echo $source[1];?></div>
                    <div class="panel-footer tmono"><?php if(!empty($notes[1])) echo $notes[1].'<hr/>';?><p class="text-center">If there is a problem with the source supplied, you are requested to ping us at report@algoz.org</p></div>
                </div>
                <div id="codeJ" class="panel panel-primary mTop50">
                    <div class="panel-heading">
                        <span itemprop="programmingLanguage" itemscope itemtype="http://schema.org/Thing">
                            <meta itemprop="sameAs" content="http://en.wikipedia.org/wiki/Java_(programming_language)"/>
                            <span id="codeJ_img" class="codImg" itemprop="image"></span>
                            <span class="pL" itemprop="name">Java</span>
                        </span>
                    </div>
                    <div id="codeJ_body" class="codBlock" itemprop="sampleType"><?php echo $source[2];?></div>
                    <div class="panel-footer tmono"><?php if(!empty($notes[2])) echo $notes[2].'<hr/>';?><p class="text-center">If there is a problem with the source supplied, you are requested to ping us at report@algoz.org</p></div>
                </div>
                <div id="codeP" class="panel panel-primary mTop50">
                    <div class="panel-heading">
                        <span itemprop="programmingLanguage" itemscope itemtype="http://schema.org/Thing">
                            <meta itemprop="sameAs" content="http://en.wikipedia.org/wiki/Python_(programming_language)"/>
                            <span id="codeP_img" class="codImg" itemprop="image"></span>
                            <span class="pL" itemprop="name">Python</span>
                        </span>
                    </div>
                    <div id="codeP_body" class="codBlock" itemprop="sampleType"><?php echo $source[3];?></div>
                    <div class="panel-footer tmono"><?php if(!empty($notes[3])) echo $notes[3].'<hr/>';?><p class="text-center">If there is a problem with the source supplied, you are requested to ping us at report@algoz.org</p></div>
                </div>
                
               
                <div id="author">
                    
                </div>
            </div>
        </div>

    </section>
    <script src="http://ajaxorg.github.io/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>
        var c= ace.edit("codeC_body");
        var j= ace.edit("codeJ_body");
        var p= ace.edit("codeP_body");
        c.setTheme("ace/theme/textmate");
        j.setTheme("ace/theme/textmate");
        p.setTheme("ace/theme/textmate");
        c.getSession().setMode("ace/mode/c_cpp");
        j.getSession().setMode("ace/mode/java");
        p.getSession().setMode("ace/mode/python");
        c.setReadOnly(true);
        j.setReadOnly(true);
        p.setReadOnly(true);
    </script>
<?php
    printFooter();
}
?>