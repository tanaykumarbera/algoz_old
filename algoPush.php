<?php
    require_once './secureMe.php';
    require_once './functions.php';

    $flag= FALSE;
    function trim_note($note_str){
        $t_str= trim($note_str);
        if((strpos($t_str,"note to be provided")!==FALSE)||(strpos($t_str,"else leave it blank")!==FALSE)) $t_str=" ";
        return $t_str;
    }
    
    $dstr= "Did you just tried Something wierd ? ~_~ * Abstraction does not means a Distraction. Your location , ip n cookie data has been logged for security issues *";
    
    if(!empty($_POST)){
        $db= __db();
        
        $name= $db->escape_string(trim(urldecode($_POST['name'])));
        $tag= $db->escape_string(trim(urldecode($_POST['tag'])));
        $shortDesc= $db->escape_string(trim(urldecode($_POST['desc'])));
        $link= $db->escape_string(trim(urldecode($_POST['link'])));
        $desc= trim(urldecode($_POST['intro']));
        $code= json_encode(array(trim(urldecode($_POST['psCode'])), trim(urldecode($_POST['cCode'])), trim(urldecode($_POST['jCode'])), trim(urldecode($_POST['pCode']))));
        $notes= json_encode(array(trim_note(urldecode($_POST['psNote'])),trim_note(urldecode($_POST['cNote'])), trim_note(urldecode($_POST['jNote'])), trim_note(urldecode($_POST['pNote']))));
        
        if((strpos($notes,"script")!==FALSE)||(strpos($desc,"script")!==FALSE)){
            if((strpos(str_replace(' ', '', $notes),"/script")!==FALSE)||(strpos(str_replace(' ', '', $desc),"/script")!==FALSE))
                    die($dstr);
        }
        
        $lb= $db->escape_string(trim(urldecode($_POST['lb'])));
        $tb= $db->escape_string(trim(urldecode($_POST['tb'])));
        $ub= $db->escape_string(trim(urldecode($_POST['ub'])));
        
        $uid= $_SESSION['uid'];
        
        if(empty($name)||empty($tag)||empty($lb)||empty($tb)||empty($ub)){ echo 'invalid'; die(); }
        
        $stm= $db->stmt_init();
        if($stm->prepare("INSERT INTO algorithmstore (algoName, algoTags, WLink, sDesc, algoDesc, algoCode, algoNote, algoL, algoT, algoU, authID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")){
            $stm->bind_param('sssssssssss', $name, $tag, $link, $shortDesc, $desc, $code, $notes, $lb, $tb, $ub, $uid);
            $stm->execute();
            $stm->close();
            $flag= TRUE;
        }else    die('He died fighting a prepared battle. You will be held culprit. Tracing you shortly. (~_~). Your Location data and ip address has been registered.');
        __close($stm);
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