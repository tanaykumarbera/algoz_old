<?php $aid=35;
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
    print_r($source);
}    
    
?>