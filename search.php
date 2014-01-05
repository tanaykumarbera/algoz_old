<?php
    $nidl= $_REQUEST['q'];
    $db= new mysqli('localhost', 'root', '', 'algoZ');
    $q= $db->stmt_init();
    
    $q->prepare("SELECT id, algoName, algoTags, algoDesc FROM algorithmstore WHERE MATCH(algoName) AGAINST(?)");
    $q->bind_param('s',$nidl);
    $q->execute();    echo 'a';
    $r= $q->get_result(); echo 'b';
 echo $r->num_rows.'--'.$nidl;
    if($r->num_rows>0){ echo 'c';
        while($a= $r->fetch_array(MYSQLI_ASSOC)){
            echo '<br/>'.$a['algoName'];
        }
    }
    $q->close();

?>