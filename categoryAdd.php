<?php
    $flag= FALSE;    sleep(5);
    if(!empty($_POST)){
        require_once './starter.php';
        $name= $db->escape_string(trim($_POST['cat']));
        if(!empty($name))
            if($stm= $db->prepare("INSERT INTO algorithmcategory (categoryName) VALUES (?)")){
                $stm->bind_param('s', $name);
                $stm->execute();
                echo '<span class="list-group-item"><input type="checkbox" name="cat[]" value="'.$stm->insert_id.'" checked="checked" />&nbsp;'.$name.'</span>';
                $flag= TRUE;
            }
    }
    if(!$flag)        echo 'error';
?>
