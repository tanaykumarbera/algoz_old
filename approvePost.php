<?php
    $f=FALSE;
    if(!empty($_POST)){
        if(!empty($_POST['apv'])&&(!empty($_POST['lnk']))){
            $link= $_POST['lnk'];
            $wid= $_POST['apv'];
            $ch= 1;
        }
        if(!empty($_POST['del'])){
            $wid= $_POST['del'];
            $ch= 2;
        }
        if(!empty($ch)){
            $db= new mysqli('localhost', 'root', '', 'algoZ');
            $q= $db->stmt_init();
            $q->prepare("SELECT algoName, algoTags, WLink, sDesc, algoDesc, algoCode, algoNote, algoL, algoT, algoU, authID, listedCat FROM algorithmstore WHERE id=?");
            $q->bind_param('s', $wid);
            $q->bind_result($nam, $tags, $wlink, $mdesc, $desc, $code, $note, $lb, $tb, $ub, $uid, $cat);
            if($q->execute()) $q->fetch();
            else die("error");

            if($ch==1){
                $q->prepare("INSERT INTO livestore (algoName, algoTags, aLink, WLink, sDesc, algoDesc, algoCode, algoNote, algoL, algoT, algoU, authID, listedCat) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $q->bind_param('sssssssssssss', $nam, $tags, $link, $wlink, $mdesc, $desc, $code, $note, $lb, $tb, $ub, $uid, $cat);
                if($q->execute()) $f1=TRUE;
                if($f1){
                    $q->prepare("DELETE FROM algorithmstore WHERE id=?");
                    $q->bind_param('s', $wid);
                    if($q->execute()) $f2=TRUE;
                    if($f1&&$f2) $f=TRUE;
                }
            }elseif($ch==2){
                $q->prepare("INSERT INTO trashlist (algoName, algoTags, WLink, sDesc, algoDesc, algoCode, algoNote, algoL, algoT, algoU, authID, listedCat) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $q->bind_param('ssssssssssss', $nam, $tags, $wlink, $mdesc, $desc, $code, $note, $lb, $tb, $ub, $uid, $cat);
                if($q->execute()) $f1=TRUE;
                if($f1){
                    $q->prepare("DELETE FROM algorithmstore WHERE id=?");
                    $q->bind_param('s', $wid);
                    if($q->execute()) $f2=TRUE;
                    if($f1&&$f2) $f=TRUE;
                }
            }
            $q->close();
        }
    }
    
    if($f) echo 'success';
    else echo 'error';
?>
