<?php 
    $flag= FALSE;
    if(!empty($_POST)){
        require_once './starter.php';
        $name= $db->escape_string(trim($_POST['name']));
        $tag= $db->escape_string(trim($_POST['tag']));
        $desc= trim($_POST['intro']);
        $code= json_encode(array(trim($_POST['psCode']), trim($_POST['cCode']), trim($_POST['jCode']), trim($_POST['pCode'])));
        $notes= json_encode(array(trim($_POST['psNote']),trim($_POST['cNote']), trim($_POST['jNote']), trim($_POST['pNote'])));
        if((strpos($notes,"<script")!==FALSE)||(strpos($desc,"<script")!==FALSE)||(strpos($notes,"< script")!==FALSE)||(strpos($desc,"< script")!==FALSE)){
            die("Did you just tried Something wierd ? ~_~ * Abstraction does not means a Distraction. Your location , ip n cookie data has been logged for security issues *");
        }
        $lb= $db->escape_string(trim($_POST['lb']));
        $tb= $db->escape_string(trim($_POST['tb']));
        $ub= $db->escape_string(trim($_POST['ub']));
        
        if(empty($name)||empty($tag)||empty($lb)||empty($tb)||empty($ub)){ echo 'invalid'; die(); }
        if($stm= $db->prepare("INSERT INTO algorithmstore (algoName, algoTags, algoDesc, algoCode, algoNote, algoL, algoT, algoU) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")){
            $stm->bind_param('ssssssss', $name, $tag, $desc, $code, $notes, $lb, $tb, $ub);
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