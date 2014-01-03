<?php
    $flag= FALSE;
    if(!empty($_POST)){
        require_once './starter.php';
        $name= $db->escape_string(trim($_POST['cat']));
        if(!empty($name))
            if($stm= $db->prepare("INSERT INTO algorithmcategory (categoryName) VALUES (?)")){
                $stm->bind_param('s', $name);
                $stm->execute();
                echo '<li><a href="#" class="list-group-item" onclick="addCat(this)">'.$name.'</a></li>';
                $flag= TRUE;
            }
    }
    if(!flag)        echo 'error';
?>
