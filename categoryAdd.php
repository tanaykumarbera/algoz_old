<?php
    include_once './aOdNmLiYn.php';
    
    $flag= FALSE;
    if(!empty($_POST)){
        require './starter.php';
        $name= $db->escape_string(trim($_POST['cat']));
        if(!empty($name))
            if($stm= $db->prepare("INSERT INTO algorithmcategory (categoryName) VALUES (?)")){
                $stm->bind_param('s', $name);
                $stm->execute();
                echo '<span class="list-group-item"><input type="checkbox" name="cat[]" value="'.$stm->insert_id.'" checked="checked" />&nbsp;'.$name.'</span>';
                $flag= TRUE;
            }
        require './stopper.php';
    }
    
    if(!empty($_POST)){
        require './starter.php';
        //$db= new mysqli('localhost', 'root', '', 'algoZ');
        if(!empty($_POST['updt'])&&!empty($_POST['aid']))
            $id= (int) $_POST['aid'];
            $stm= $db->stmt_init();
            if($stm->prepare("UPDATE algorithmstore SET listedCat=? WHERE id=?")){
                $catU= '_'.implode('_',explode(',',$_POST['updt'])).'_';
                $stm->bind_param('si', $catU, $id);
                if(!$stm->execute())                    echo 'faillllll';;
                if(!$stm->errno) $flag= TRUE;
            }
        require './stopper.php';
    }
    
    if(!$flag)        echo 'error';
?>
