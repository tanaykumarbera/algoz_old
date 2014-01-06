<?php $aid=34;
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
    printHeader(array(
        'title'=> trim($tags[0]).' | '.trim($tags[1]).' | AlgoZ'
    ));
?>
    <section>
        <div class="container">
            <div id="algo" itemscope itemtype="http://schema.org/Code">
                <meta itemprop="sameAs" content="<?php// if(!empty($algo['WLink'])) echo $algo['WLink'];?>"/>
                <div id="title">
                    <h1 class="aNam"><span class="glyphicon glyphicon-fire"></span>&nbsp;<span itemprop="name"><?php __($algo['algoName']);?></span></h1>
                </div>
                <div id="tags" itemprop="keywords">
                    <blockquote><?php 
                        foreach ($tags as $t){ $tag= trim($t); if(!empty($tag)) echo '<a href="'.str_ireplace(' ', '_', $tag).'" title="# tag"><span class="label label-info tag"><span class="glyphicon glyphicon-tag"></span> '.$tag.'</span></a> ';}
                        foreach ($cats as $c){ $cat= trim($c); if(!empty($cat)) echo '<a href="'.str_ireplace(' ', '_', $cat).'" title="@ category"><span class="label label-info tag"><span class="glyphicon glyphicon-bookmark"></span> '.$cat.'</span></a> ';}
                  ?></blockquote>
                    
                </div>
                <div id="description" itemprop="description">
                    
                </div>
                <div id="codeSection">
                    
                </div>
                <div id="author">
                    
                </div>
            </div>
        </div>

    </section>
<?php
    printFooter();
}
?>