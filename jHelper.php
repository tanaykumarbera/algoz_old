<?php

    function _chk($x){
        return !empty($x['list']);
    }
    function isAbsent($a, $b){
        foreach($b as $k){
            if($k['aNam']==$a) return FALSE;
        }
        return TRUE;
    }


    $filter= $_REQUEST['filter'];
    $done= FALSE;
    $db= new mysqli('localhost', 'root', '', 'algoZ');
    if($filter=="algorithm"){
        $q= $db->stmt_init();
        $q->prepare("SELECT algoName, aLink FROM livestore ORDER BY algoName ASC");
        $q->bind_result($aNam, $aLink);
        if($q->execute()){
            $json=array();
            $chN= $chP= 'A';
            $list=array();
            while($q->fetch()){
                $chN= substr($aNam, 0,1);
                if($chN==$chP){
                    array_push($list, array('aLink'=>$aLink, 'aNam'=>$aNam));
                }else{
                    array_push($json, array('Cnam'=>$chP, 'list'=>$list));
                    $chP= $chN;
                    $list= array();
                    array_push($list, array('aLink'=>$aLink, 'aNam'=>$aNam));
                }
            }
            if(!empty($list)) array_push($json, array('Cnam'=>$chP, 'list'=>$list));
            $eJSON= json_encode($json);
            print_r($eJSON);
            $q->close();
        }
    }else if($filter=="tag"){
        $q= $db->stmt_init();
        $q->prepare("SELECT algoTags FROM livestore");
        $q->bind_result($aTags);
        if($q->execute()){
            $json=array();
            for($index=0; $index<26; $index++) $json[$index]=array('Cnam'=>chr($index+65), 'list'=>array());
            while($q->fetch()){
                $tags= explode(';', $aTags);
                foreach ($tags as $t){
                    $tag= trim($t);
                    $index= ord(strtoupper($tag))-65;
                    if(isAbsent($tag, $json[$index]['list']))
                        array_push($json[$index]['list'], array('aNam'=> $tag, 'aLink'=> str_replace(array('-',' ','(',')','%','?','$','*','#','@','!'), '_', $tag)));
                }
            }
            $json= array_filter($json, '_chk');
            sort($json);
            $eJSON=json_encode($json);
            print_r($eJSON);
            $q->close();
        }
    }else{
        $q= $db->stmt_init();
        $q->prepare("SELECT * FROM algorithmcategory ORDER BY categoryName ASC");
        $q->execute();
        $rCat= $q->get_result();
        if($rCat->num_rows >0){
            $json= array();
            $q->prepare("SELECT algoName, aLink FROM livestore WHERE listedCat LIKE ?");
            $q->bind_param('s', $cat_id);
            $q->bind_result($aNam, $aLink);
            while ($cat= $rCat->fetch_array(MYSQLI_ASSOC)){
                $list=array();
                $cat_id="%_".$cat['sr']."_%";
                if($q->execute())
                    while($q->fetch()){
                        array_push($list, array('aLink'=>$aLink, 'aNam'=>$aNam));
                    }
                array_push($json, array('Cnam'=>$cat['categoryName'], 'list'=>$list));
            }
            $eJSON= json_encode($json);
            print_r($eJSON);
        }
        $q->close();
    }
?>
