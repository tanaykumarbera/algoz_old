<?php
require_once './functions.php';

printHeader(array(
    'title'=> trim($cat['categoryName']).' | AlgoZ'
));
?>
<section>
    <div class="container">
        <div class="blnk50"></div>
        <div>
            <ol class="breadcrumb">
                <li>Home</li>
                <li>Categories</li>
                <li class="active"><?php echo trim($cat['categoryName']);?></li>
            </ol>
        </div>
        
<?php 
while($algo= $wVar->fetch_array(MYSQLI_ASSOC)){
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
?>
        <div id="algo" class="panel panel-info" itemscope itemtype="http://schema.org/Code">
            <a class="tdN" href="#">
                <div class="panel-body">
                    <?php   if(!empty($algo['WLink'])) echo '<meta itemprop="sameAs" content="'.$algo['WLink'].'"/>'.PHP_EOL;
                            if(!empty($GRepo)) echo '<meta itemprop="codeRepository" content="'.$GRepo.'"/>'.PHP_EOL;
                    ?>
                    <h1 class="aNam"><span class="glyphicon glyphicon-fire"></span>&nbsp;<span itemprop="name"><?php echo $algo['algoName'];?></span></h1>
                    <blockquote class="txt" itemprop="description"><?php echo $algo['sDesc'];?></blockquote>
                    <hr/>
                    <p class="text-right">
                        <span class="label label-success tag" title="Lower Bound"><span class="glyphicon glyphicon-time"></span>  &nbsp;&Omega; ( <?php echo $algo['algoL'];?> )</span>
                        <span class="label label-warning tag" title="Tight Bound"><span class="glyphicon glyphicon-time"></span>  &nbsp;&Theta; ( <?php echo $algo['algoT'];?> )</span>
                        <span class="label label-danger tag" title="Upper Bound"><span class="glyphicon glyphicon-time"></span>  &nbsp;O ( <?php echo $algo['algoU'];?> )</span>
                    </p>
                </div>
            </a>
            <div class="panel-footer">
                <p itemprop="keywords" class="text-right tags"><?php 
                    foreach ($tags as $t){ $tag= trim($t); if(!empty($tag)) echo '<a href="'.str_ireplace(' ', '_', $tag).'" class="tdN" title="# tag"><span class="label label-info tag"><span class="glyphicon glyphicon-tag"></span> &nbsp;'.$tag.'</span></a> '.PHP_EOL;}
                    foreach ($cats as $c){ $cat= trim($c); if(!empty($cat)) echo '<a href="'.str_ireplace(' ', '_', $cat).'" class="tdN" title="@ category"><span class="label label-info tag"><span class="glyphicon glyphicon-bookmark"></span>  &nbsp;'.$cat.'</span></a> '.PHP_EOL;}   
              ?></p>
            </div>
        </div>
        
<?php
}
?>    
    </div>
</section>

<?php
printFooter(array(
    'gid' => $ugID
));


/* $key="cat%10";
            $db= new mysqli('localhost', 'root', '', 'algoz');
            $q= $db->stmt_init();
            $q->prepare("SELECT sr, categoryName FROM algorithmcategory WHERE categoryName LIKE ?");
            $q->bind_param('s', $key);
            if($q->execute()){
                $res= $q->get_result();
                if($res->num_rows >0){
                    $cat= $res->fetch_array(MYSQLI_ASSOC);
                    $q->prepare("SELECT id, algoName, algoTags, aLink, WLink, sDesc, algoL, algoT, algoU, listedCat FROM livestore WHERE listedCat LIKE ?");
                    $rty= "%_".$cat['sr']."_%";
                    $q->bind_param('s', $rty);
                    if($q->execute()){
                        $wVar= $q->get_result();
*/
?>