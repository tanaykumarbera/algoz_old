<?php
    $flag= FALSE;
    if(!empty($_POST)){
        require_once './starter.php';
        $db= new mysqli('localhost', 'root', '', 'algoZ');
        $id= $db->escape_string(trim($_POST['aid']));
        $stm= $db->prepare("SELECT sr FROM algorithmcategory WHERE algoIDs LIKE ?");
        $stm->bind_param('s', "%_".$id."_%");
        $stm->bind_result($sr);
        $stm->execute();
        $sarr= array();
        while($stm->fetch()) array_push ($sarr, $sr);
        $stm= $db->stmt_init();
        $stm->prepare("SELECT sr, categoryName FROM algorithmcategory ORDER BY categoryName ASC");
        if ($stm->execute()){
            $result = $stm->get_result();
            $carr= array(array());
            while($row= $result->fetch_array(MYSQLI_ASSOC)){
                array_push($carr, $row);
            }
        }
        $chk='<div class="list-group">';
        foreach ($carr as $a){
            $chk=$chk.'<span class="list-group-item"><input type="checkbox" name="cat[]" value="'.$a['sr'].(!array_search($a['sr'], $sarr))?'':' checked="checked"'.'" class="form-control"/>&nbsp;'.$a['categoryName'].'</span>';
        }
        $chk=$chk.'</div>';
    }
?>
