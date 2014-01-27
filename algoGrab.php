<?php
    require_once './functions.php';
    
    $db= __db();
    $done= FALSE;
    
    $key= str_replace(array('-','_',' ','(',')'), "%", urldecode(trim($_REQUEST['keyword'])));
    
    $q= $db->stmt_init();
    
    switch ($_REQUEST['type']){
        case "algo":
            $q->prepare("SELECT * FROM livestore WHERE aLink LIKE ?");
            $q->bind_param('s', $key);
            if($q->execute()){
                $res=$q->get_result();
                if($res->num_rows >0){
                    $wVar= $res->fetch_array(MYSQLI_ASSOC);
                    require_once './showAlgo.php';
                    $done=TRUE;
                }
            }
        break;
        
        case "category":
            $q->prepare("SELECT sr, categoryName FROM algorithmcategory WHERE categoryName LIKE ?");
            $q->bind_param('s', $key);
            if($q->execute()){
                $res= $q->get_result();
                if($res->num_rows >0){
                    $cat= $res->fetch_array(MYSQLI_ASSOC);
                    $q->prepare("SELECT id, algoName, algoTags, aLink, WLink, sDesc, algoL, algoT, algoU, listedCat FROM livestore WHERE listedCat LIKE ?");
                    $rty= "%\_".$cat['sr']."\_%";
                    $titl= $cat['categoryName'];
                    $bdcm= "categories";
                    $bdlnk="category";
                    $q->bind_param('s', $rty);
                    if($q->execute()){
                        $wVar= $q->get_result();
                        require_once 'listAlgo.php';
                        $done= TRUE;
                    }
                }
            }
        break;
        
        case "tag":
            $q->prepare("SELECT id, algoName, algoTags, aLink, WLink, sDesc, algoL, algoT, algoU, listedCat FROM livestore WHERE algoTags LIKE ?");
            $rty="%".$key."%";
            $q->bind_param('s', $rty);
            if($q->execute()){
                $wVar=$q->get_result();
                if($wVar->num_rows >0){
                    $titl= str_replace("%", " ", $key);
                    $bdcm= "tags";
                    $bdlnk="tag";
                    require_once 'listAlgo.php';
                    $done= TRUE;
                }
            }
        break;
        
        default: 
            require_once 'wrongPlace.php';
            $done= TRUE;
    }
    
    if(!$done){
      //  header('Location: ../search.php?key='.$_REQUEST['keyword']);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   /* 
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
                    $bdlnk="category";
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
                            $bdlnk="tag";
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
    * 
    */
?>