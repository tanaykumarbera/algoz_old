<?php 
    $flag= FALSE;
    if(!empty($_POST)){
        require_once './starter.php';
        $name= $db->escape_string(trim($_POST['name']));
        $tag= $db->escape_string(trim($_POST['tag']));
        $desc= $db->escape_string(trim($_POST['intro']));
        $code= serialize(array($db->escape_string(trim($_POST['psCode'])),
                     $db->escape_string(trim($_POST['cCode'])),
                     $db->escape_string(trim($_POST['jCode'])),
                     $db->escape_string(trim($_POST['pCode']))));
        $notes= serialize(array($db->escape_string(trim($_POST['psNote'])),
                     $db->escape_string(trim($_POST['cNote'])),
                     $db->escape_string(trim($_POST['jNote'])),
                     $db->escape_string(trim($_POST['pNote']))));
        $lb= $db->escape_string(trim($_POST['lb']));
        $tb= $db->escape_string(trim($_POST['tb']));
        $ub= $db->escape_string(trim($_POST['ub']));
        
        if($stm= $db->prepare("INSERT INTO algorithmstore (algoName, algoTags, algoDesc, algoCode, algoNote, algoL, algoT, algoU) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")){
            $stm->bind_param('ssssssss', $name, $desc, $code, $notes, $tag, $lb, $tb, $ub);
            $stm->execute();
            $stm->close();
            $flag= TRUE;
        }else    echo 'He died fighting a prepared battle. You will be held culprit. Tracing you shortly. ~_~ ';
        include_once './stopper.php';
    }
    
    
    if($flag){
?>
    <div class="panel panel-success p10">
        <div class="blnk50"></div>
        <div class="alert-success alert-block txtC">
            <p>&nbsp;</p>
            <p>Volla! Looks like everything went like a breeze. The algorithm has been posted successfully.</p>
            <p>&nbsp;</p>
        </div>
        <div class="blnk50"></div>
        <div class="panel-footer note">
            <p>Well for now, the post will be kept on moderation. It will be live soon as it gets its approval.
                 Some changes might be done with the original content.</p>
        </div>
    </div>
<?php
    }
?>