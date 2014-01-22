<?php
require_once './aOdNmLiYn.php';
require_once './functions.php';

$aid= $_GET['aid'];
$db= __db();

$q= $db->stmt_init();
$q->prepare("SELECT * FROM algorithmstore WHERE id= ?");
$q->bind_param('i', $aid);
$q->execute();

$res= $q->get_result();

if($res->num_rows > 0){
    $algo= $res->fetch_array(MYSQLI_ASSOC);
    $tags= explode(';', $algo['algoTags']);
    $carr= explode('_', $algo['listedCat']);
    $q->prepare("SELECT categoryName FROM algorithmcategory WHERE sr= ?");
    $q->bind_param('i', $cat_id);
    $q->bind_result($cat_nam);
    $cats=array();
    foreach ($carr as $cat_i){
        if(!empty($cat_i)){
            $cat_id= (int) $cat_i;
            $q->execute(); $q->fetch();
            array_push($cats, $cat_nam);
        }
    }
    
    if(!empty($algo['authID'])){
        $q->prepare("SELECT gpID, gpName FROM userdata WHERE id= ?");
        $q->bind_param('i', $algo['authID']);
        $q->bind_result($ugID, $uName);
        $q->execute(); $q->fetch();
    }
    
    
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
                <?php   if(!empty($algo['WLink'])) echo '<meta itemprop="sameAs" content="'.$algo['WLink'].'"/>'.PHP_EOL;
                        if(!empty($algo['GRepo'])) echo '<meta itemprop="codeRepository" content="'.$algo['GRepo'].'"/>'.PHP_EOL;
                        if(!empty($algo['sDesc'])) echo '<meta itemprop="description" content="'.$algo['sDesc'].'"/>'.PHP_EOL;?>
                <div id="title">
                    <h1 class="aNam"><span class="glyphicon glyphicon-fire"></span>&nbsp;<span itemprop="name"><?php __($algo['algoName']);?></span></h1>
                </div>
                <div id="tags">
                    <blockquote itemprop="keywords"><?php 
                        foreach ($tags as $t){ $tag= trim($t); if(!empty($tag)) echo '<a href="'.str_ireplace(' ', '_', $tag).'" title="# tag"><span class="label label-info tag"><span class="glyphicon glyphicon-tag"></span> &nbsp;'.$tag.'</span></a> '.PHP_EOL;}
                        foreach ($cats as $c){ $cat= trim($c); if(!empty($cat)) echo '<a href="'.str_ireplace(' ', '_', $cat).'" title="@ category"><span class="label label-info tag"><span class="glyphicon glyphicon-bookmark"></span>  &nbsp;'.$cat.'</span></a> '.PHP_EOL;}
                        echo '<span class="label label-warning tag" title="Lower Bound"><span class="glyphicon glyphicon-time"></span>  &nbsp;&Omega; ( '.$algo['algoL'].' )</span> '.PHP_EOL;
                        echo '<span class="label label-warning tag" title="Tight Bound"><span class="glyphicon glyphicon-time"></span>  &nbsp;&Theta; ( '.$algo['algoT'].' )</span> '.PHP_EOL;
                        echo '<span class="label label-warning tag" title="Upper Bound"><span class="glyphicon glyphicon-time"></span>  &nbsp;O ( '.$algo['algoU'].' )</span> '.PHP_EOL;
                  ?></blockquote>
                </div>
                <div id="description" itemprop="about" class="txt">
                        <?php echo $algo['algoDesc'];?>
                </div>
                <div id="pseudo" class="panel panel-default">
                    <div id="pseudoT" class="panel-heading ">
                        <span><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;the pseudo Code</span>
                    </div>
                    <div id="pseudoC" class="codBlock"><pre><?php echo htmlspecialchars($source[0]);?></pre></div>
                    <div class="panel-footer tsan"><p class="text-center">If there is a problem with the source supplied, you are requested to ping us at report@algoz.org</p></div>
                </div>
                <div id="pPseudo" class="txt"><?php if(!empty($notes[0])) echo $notes[0];?></div>
                <div id="codeC" class="panel panel-primary mTop50">
                    <div class="panel-heading">
                        <span itemprop="programmingLanguage" itemscope itemtype="http://schema.org/Thing">
                            <meta itemprop="sameAs" content="http://en.wikipedia.org/wiki/C_(programming_language)"/>
                            <span id="codeC_img" class="codImg" itemprop="image"></span>
                            <span class="pL" itemprop="name">C</span>
                        </span>
                    </div>
                    <div id="codeC_body" class="codBlock" itemprop="sampleType"><pre><?php echo htmlspecialchars($source[1]);?></pre></div>
                    <div class="panel-footer tsan"><p class="text-center">If there is a problem with the source supplied, you are requested to ping us at report@algoz.org</p></div>
                </div>
                <div id="pCcode" class="txt"><?php if(!empty($notes[1])) echo $notes[1];?></div>
                <div id="codeJ" class="panel panel-primary mTop50">
                    <div class="panel-heading">
                        <span itemprop="programmingLanguage" itemscope itemtype="http://schema.org/Thing">
                            <meta itemprop="sameAs" content="http://en.wikipedia.org/wiki/Java_(programming_language)"/>
                            <span id="codeJ_img" class="codImg" itemprop="image"></span>
                            <span class="pL" itemprop="name">Java</span>
                        </span>
                    </div>
                    <div id="codeJ_body" class="codBlock" itemprop="sampleType"><pre><?php echo htmlspecialchars($source[2]);?></pre></div>
                    <div class="panel-footer tsan"><p class="text-center">If there is a problem with the source supplied, you are requested to ping us at report@algoz.org</p></div>
                </div>
                <div id="pJcode" class="txt"><?php if(!empty($notes[2])) echo $notes[2];?></div>
                <div id="codeP" class="panel panel-primary mTop50">
                    <div class="panel-heading">
                        <span itemprop="programmingLanguage" itemscope itemtype="http://schema.org/Thing">
                            <meta itemprop="sameAs" content="http://en.wikipedia.org/wiki/Python_(programming_language)"/>
                            <span id="codeP_img" class="codImg" itemprop="image"></span>
                            <span class="pL" itemprop="name">Python</span>
                        </span>
                    </div>
                    <div id="codeP_body" class="codBlock" itemprop="sampleType"><pre><?php echo htmlspecialchars($source[3]);?></pre></div>
                    <div class="panel-footer tsan"><p class="text-center">If there is a problem with the source supplied, you are requested to ping us at report@algoz.org</p></div>
                </div>
                <div id="pPcode" class="txt"><?php if(!empty($notes[3])) echo $notes[3];?></div>
                <div class="blnk50"></div>
                
                <div id="author" class="row" itemprop="author" itemscope="http://schema.org/Person">
                    <?php    if(!empty($uName)) echo '<meta itemprop="name" content="'.$uName.'"/>';
                             if(!empty($ugID)) echo '<link itemprop="url" content="https://plus.google.com/'.$ugID.'"/>';
                    ?>
                    <div class="col-sm-6" style="min-height: 270px;">
                        <div id="lp"></div>
                    </div>
                    <div id="ainfo" class="col-sm-6 tsan">
                        <span class="label label-success">&nbsp;<span class="glyphicon glyphicon-pencil"></span>&nbsp;posted by</span>
                        <h1><?php echo $uName;?></h1>
                        <p>If you have any complaints or in case you want to improve this post, you are requested to ping us at report@algoz.org or contact the author.</p>
                        <p></p>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="blnk50"></div>
    </section>
    

    <script src="http://ajaxorg.github.io/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script>
        var c= ace.edit("codeC_body");
        var j= ace.edit("codeJ_body");
        var p= ace.edit("codeP_body");
        var ps= ace.edit("pseudoC");
        
        cnf(c,"c_cpp");
        cnf(j,"java");
        cnf(p,"python");
        
        function cnf(v,lan){
            v.setTheme("ace/theme/textmate");
            v.getSession().setMode("ace/mode/"+lan);
            v.setReadOnly(true);
            v.setOptions({maxLines: 100});
        }
        ps.setOptions({maxLines: Infinity});
        ps.setReadOnly(true);
    </script>
<?php
    printFooter(array(
        'gid' => $ugID
    ));
}

__close($db);
__close($q);

?>