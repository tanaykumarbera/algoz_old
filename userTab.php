<?php
    session_start();
    $bool= TRUE;
    if(empty($_SESSION['unam']) || empty($_SESSION['uimg'])){
        $bool= FALSE;
        if(isset($_COOKIE['uID'])&& $_COOKIE['uID']!=''){
            $_SESSION['uid']=$_COOKIE['uID'];
            $db= new mysqli('localhost', 'root', '', 'algoZ');
            $q= $db->stmt_init();
            $q->prepare("SELECT gpName, gpImage FROM userdata WHERE id LIKE ?");
            $q->bind_param('s', $_COOKIE['uID']);
            $q->bind_result($_SESSION['unam'],$_SESSION['uimg']);
            if($q->execute()){
                $q->fetch (); 
                $q->close();
                $bool =TRUE;
            }
        }
    }
    
    if($bool){
?>

        <div id="authTab" title="logged in as <?php echo $_SESSION['unam'];?>">
        <?php if($_SESSION['AoDnMlIyN']===1){?>
            <div id="adtab" class="z2">
                <a href="./categorise.php" class="white tmono">Categorise</a>&nbsp;&nbsp;
                <a href="./approve.php" class="white tmono">Approve</a>&nbsp;&nbsp;
                <a href="./liveEditor.php" class="white tmono">Editor</a>
            </div>
        <?php } ?>
            <div id="authImg" class="z3"><img src="<?php echo $_SESSION['uimg'];?>" class="img-circle z5" height="50px" width="50px"/></div>
            <div id="authGp"></div>
            <a href="./gLogger.php?logout=true&rdr=http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>" title="log off"><span id="lgbtn" class="glyphicon glyphicon-off white"></span></a>
        </div>
<?php
    }
?>