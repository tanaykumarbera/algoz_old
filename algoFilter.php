<?php
    include_once './aOdNmLiYn.php';
    $flag= FALSE;
    
    if(!empty($_REQUEST)){
        //require_once './starter.php';
        $db= new mysqli('localhost', 'root', '', 'algoZ') or die('esgs');
        $ft= $db->escape_string(trim($_REQUEST['fTxt']));
        
        $stm= $db->stmt_init();
        $stm->prepare("SELECT id, algoName FROM algorithmstore WHERE algoName LIKE ?");
        $lft= "%{$ft}%";
        $stm->bind_param('s', $lft);
        $stm->bind_result($aID, $aNam);
        $stm->execute();
        
        $chk='';
        while ($stm->fetch()){
            $chk= $chk.'<a href="#" class="list-group-item" aid="'.$aID.'" onclick="shw(this)">'.$aNam.'</a>';
        }
        if(empty($chk)) $chk='<p class="alert alert-warning txtC"><span class="glyphicon glyphicon-info-sign"></span> Woah! Looks like there\'s nothing to show! Did something went wrong?</p>';
        
        $flag= TRUE;
        $stm->close();
        echo $chk;
    }
  
    if(!$flag)        echo 'error';
?>