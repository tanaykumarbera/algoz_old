<?php
    require_once './aOdNmLiYn.php';  
    require_once './functions.php';
    
    $flag= FALSE;
   
    if(!empty($_POST)){
        
        $db= __db();
        $stm= $db->stmt_init();
        
        $name= $db->escape_string(trim($_POST['cat']));    
        if(!empty($name))
            if($stm->prepare("INSERT INTO algorithmcategory (categoryName) VALUES (?)")){ 
                $stm->bind_param('s', $name);             
                $stm->execute(); 
                echo '<span class="list-group-item"><input type="checkbox" name="cat[]" value="'.$stm->insert_id.'" checked="checked" />&nbsp;'.$name.'</span>';
                $flag= TRUE;
            }
            
            if(!empty($_POST['updt'])&&!empty($_POST['aid'])) $id= (int) $_POST['aid'];
            
            if($stm->prepare("UPDATE algorithmstore SET listedCat=? WHERE id=?")){
                $catU= '_'.implode('_',explode(',',$_POST['updt'])).'_';
                $stm->bind_param('si', $catU, $id);
                if($stm->execute())
                    if(!$stm->errno) $flag= TRUE;
            }
            
        __close($stm);
        __close($db);
         
    }
    
    if(!$flag) echo 'error';
?>
