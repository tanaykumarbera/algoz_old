<?php
    require_once './starter.php';
    
    $tag= trim($_REQUEST['tag']);
    $key= str_replace(array('/','\\','.','-','$','_','@','#','%','^','*','(',')','=','+','?','!','~','`','\'','\"',':',';'), " ", $tag);
    
    $q="SELECT * FROM table_name WHERE MATCH (algoName, algoTags, algoDesc) AGAINST ('$key' IN NATURAL LANGUAGE MODE)";
    $r= mysqli_query($db, $q);
    if(mysqli_num_rows($r)>0){
        $arr= mysqli_fetch_array($r);
        require_once './showAlgo.php';
    }else{
        header('Location: ./search.php?q='.$key);
    }
    require_once './stopper.php';        
?>
