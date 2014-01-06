<?php
    //require_once './starter.php';
    
    $tag= trim($_REQUEST['tag']);
    $key= str_replace(array('/','\\','.','-','$','_','@','#','%','^','*','(',')','=','+','?','!','~','`','\'','\"',':',';'), " ", $tag);
    $db= new mysqli('localhost', 'root', '', 'algoz');
    if($stm= $db->prepare("SELECT id FROM algorithmstore WHERE algoTags LIKE ?")){//("SELECT id FROM algorithmstore WHERE MATCH (algoName, algoTags, algoDesc) AGAINST (?)")){
            $Lkey= "%{$key}%";
            $stm->bind_param('s', $Lkey); 
            $stm->execute();
            $stm->bind_result($aid);
            $stm->fetch(); 
            require_once './showAlgo.php';
            $stm->close();
    }else header('Location: ./search.php?q='.$key);
    require_once './stopper.php';        
?>
