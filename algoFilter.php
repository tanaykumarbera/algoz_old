<?php
    
    require_once './aOdNmLiYn.php';
    require_once './functions.php';
    
    $flag= FALSE;
    
    if(!empty($_REQUEST)){
        $db= __db();
        
        $ft= $db->escape_string(trim($_REQUEST['fTxt']));
        
        if(isset($_REQUEST['tb'])&&$_REQUEST['tb']=='rolling')
            $tbl="livestore";
        else
            $tbl="algorithmstore";
        
        $stm= $db->stmt_init();
        $stm->prepare("SELECT id, algoName FROM {$tbl} WHERE algoName LIKE ?");
        $lft= "%{$ft}%";
        $stm->bind_param('s', $lft);
        $stm->bind_result($aID, $aNam);
        
        if($stm->execute()){
            $chk='';
            while ($stm->fetch()){
                $chk= $chk.'<a href="#" class="list-group-item" aid="'.$aID.'" onclick="shw(this)">'.$aNam.'</a>';
            }
            if(empty($chk)) $chk='<p class="alert alert-warning txtC"><span class="glyphicon glyphicon-info-sign"></span> Woah! Looks like there\'s nothing to show! Did something went wrong?</p>';

            $flag= TRUE;
            echo $chk;
        }
       
        __close($stm);
        __close($db);
    }
  
    if(!$flag)        echo 'error';
?>