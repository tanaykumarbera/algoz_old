<?php
    $db= new mysqli('localhost', 'root', '', 'algoz');
    $done= FALSE;
    $key= str_replace(array('-','_',' ','(',')'), "%", urldecode(trim($_REQUEST['tag'])));
    $q= $db->stmt_init();
    $q->prepare("SELECT * FROM livestore WHERE aLink LIKE ?");
    $q->bind_param('s', $key);
    if($q->execute()){
        $res=$q->get_result();
        if($res->num_rows >0){
            $wVar= $res->fetch_array(MYSQLI_ASSOC);
            include_once './showAlgo.php';
            $done=TRUE;
        }else{
            $q->prepare("SELECT sr, categoryName FROM algorithmcategory WHERE categoryName LIKE ?");
            $q->bind_param('s', $key);
            if($q->execute()){
                $res= $q->get_result();
                if($res->num_rows >0){
                    $cat= $res->fetch_array(MYSQLI_ASSOC);
                    $q->prepare("SELECT id, algoName, algoTags, aLink, WLink, sDesc, algoL, algoT, algoU, listedCat FROM livestore WHERE listedCat LIKE ?");
                    $rty= "%_".$cat['sr']."_%";
                    $titl= $cat['categoryName'];
                    $bdcm= "categories";
                    $q->bind_param('s', $rty);
                    if($q->execute()){
                        $wVar= $q->get_result();
                        include_once 'listAlgo.php';
                        $done= TRUE;
                    }
                }else{
                    $q->prepare("SELECT id, algoName, algoTags, aLink, WLink, sDesc, algoL, algoT, algoU, listedCat FROM livestore WHERE algoTags LIKE ?");
                    $ftg="%".$key."%";
                    $q->bind_param('s', $ftg);
                    if($q->execute()){
                        $wVar=$q->get_result();
                        if($wVar->num_rows >0){
                            $titl= str_replace("%", " ", $key);
                            $bdcm= "tags";
                            include_once 'listAlgo.php';
                            $done= TRUE;
                        }else{
                            header('Location: search.php?key='.$_REQUEST['tag']);
                        }
                    }
                }
            }
        }
    }
?>