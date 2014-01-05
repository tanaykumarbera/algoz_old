<?php
    $flag= FALSE;
    
    if(!empty($_POST)){
        require_once './starter.php';
        
        $id= (int) trim($_POST['aid']);
        
        $stm= $db->prepare("SELECT algoName, listedCat FROM algorithmstore WHERE id= ?");
        $stm->bind_param('s', $id);
        $stm->bind_result($aNam, $Clist);
        $stm->execute();
        $stm->fetch();
        
        $chk='<div><p class="alert alert-info m10 txtC">Algorithm Name: '.$aNam.'</p></div>';
        $carr= explode('_', $Clist);        
        
        $stm->prepare("SELECT sr, categoryName FROM algorithmcategory");
        $stm->execute();
        $result= $stm->get_result();
        
        $chk= $chk.'<div id="catL" class="list-group">';
        if($result->num_rows==0) $chk= $chk.'<p class="alert alert-warning txtC"><span class="glyphicon glyphicon-info-sign"></span> Woah! Looks like there\'s nothing to show! Did something went wrong?</p>';
        else while ($row = $result->fetch_array(MYSQLI_ASSOC)){
            $chk= $chk.'<span class="list-group-item"><input type="checkbox" name="cat[]" value="'.$row['sr'].'"'.(!array_search($row['sr'], $carr)?'':' checked="checked"').'/>&nbsp;'.$row['categoryName'].'</span>';
        }
        $chk=$chk.'</div>';
        $flag= TRUE;
        $stm->close();
        
        echo $chk;
        
    }
  
    if(!$flag)        echo 'error';
?>
