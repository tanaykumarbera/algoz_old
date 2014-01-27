<?php
session_start();
$login= FALSE;

if(!empty($_REQUEST['rdr'])) $rdr_url= urldecode($_REQUEST['rdr']);
else $rdr_url= './';

if(!empty($_REQUEST['logout'])){
    session_destroy();
    setcookie('uID', '', time()-86400);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Log out | AlgoZ.org</title>
    </head>
    <body>
        Logged out.. please wait while we redirect..
    <script>
        setTimeout(function(){window.location.replace('<?php echo $rdr_url;?>?loggedOut')}, 2000);
    </script>
    </body>
</html>
<?php
die();
}

if(isset($_COOKIE['uID'])&&$_COOKIE['uID']!=''){
    $_SESSION['uid']=$_COOKIE['uID'];
    $db= new mysqli('localhost', 'root', '', 'algoZ');
    $q= $db->stmt_init();
    $q->prepare("SELECT gpName, gpImage, utype FROM userdata WHERE id LIKE ?");
    $q->bind_param('s', $_COOKIE['uID']);
    $q->bind_result($_SESSION['unam'],$_SESSION['uimg'], $utype);
    if($q->execute()) $q->fetch ();
    if($utype==29) $_SESSION['AoDnMlIyN']=1;
    else $_SESSION['AoDnMlIyN']=0;
    header('Location: '.$rdr_url);
}



require_once './g/src/Google_Client.php';
require_once './g/src/contrib/Google_PlusService.php';
$client = new Google_Client();
$client->setApplicationName("AlgoZ.org");
$client->setClientId('631278524127-6r0vs64mdoe6vrjbf6qalqfv0jvbvchr.apps.googleusercontent.com');
$client->setClientSecret('pXmCVWGYvKfImTTpaV34Z3dg');
$client->setRedirectUri('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
//$client->setDeveloperKey('AIzaSyAttdqiezVouVrngd4z09U-LliiIZhjg2k');
$plus = new Google_PlusService($client);

if (isset($_GET['code'])){
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $rdr_url= $_SESSION['redir'];
    unset($_SESSION['redir']);
    header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?rdr='.urlencode($rdr_url));
}

if (!empty($_SESSION['access_token'])){
  $client->setAccessToken($_SESSION['access_token']);
}

if($client->getAccessToken()){
    $user = $plus->people->get('me');
    $gID= filter_var($user['id'], FILTER_SANITIZE_STRING);
    $name = filter_var($user['displayName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $gender= filter_var($user['gender'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $img = filter_var($user['image']['url'], FILTER_VALIDATE_URL);
    $login= TRUE;
    $_SESSION['access_token'] = $client->getAccessToken();
    
    $db= new mysqli('localhost', 'root', '', 'algoZ');
    $q= $db->stmt_init();
    $q->prepare("SELECT id, utype FROM userdata WHERE gpID LIKE ?");
    $q->bind_param('s', $gID);
    if($q->execute()){
        $res= $q->get_result();
        if($res->num_rows>0){
            $a=$res->fetch_array(MYSQLI_ASSOC);
            $_SESSION['uid']= $a['id'];
            if($a['utype']=='29') $_SESSION['AoDnMlIyN']=1;
            else  $_SESSION['AoDnMlIyN']=0;
            setcookie('uID', $a['id'], time()+ 86400*30);
            $login= TRUE;
            $q->prepare("UPDATE userdata SET gpName= ?, gpGender= ?, gpImage= ?, lastGused =? WHERE id=?");
            $q->bind_param('sssss', $name, $gender, $img, $time, $a['id']); 
            $time= time();
            if($q->execute()){
                $login= TRUE;
                header('Location: '.$rdr_url);
            }
        }else{
            $q->prepare("INSERT INTO userdata (gpID, gpName, gpGender, gpImage, lastGused) VALUES(?, ?, ?, ?, ?)");
            $q->bind_param('sssss', $gID, $name, $gender, $img, $time); 
            $time= time();
            if($q->execute()){
                $_SESSION['uid']= $q->insert_id;
                setcookie('uID', $q->insert_id, time()+ 86400*30);
                $login= TRUE;
                header('Location: '.$rdr_url);
            }
        }
    }
    $q->close();
    $db->close();
}else{
    $authUrl = $client->createAuthUrl();
    $login= FALSE;    
    $_SESSION['redir']=$rdr_url;
}
?>


<?php 
if(!$login){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Handshaking | AlgoZ.org</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <style>
            @media all and (min-width: 601px){h1 { font-size: 10em;}.blnk{ margin-top: 5%;}}
            @media all and (max-width: 600px) and (min-width: 401px){h1 { font-size: 3em;}.blnk{ margin-top: 10%;}}
            @media all and (max-width: 400px){h1 { font-size: 3em;}.blnk{ margin-top: 10%;}}
            body{ width: 100%; height: 100%; overflow: hidden; }
            .blnk{ position: relative; width: 100%;}
            #wrapper {margin: 10px;}
            .txtC{ text-align: center; }
            .blockC{display: block; margin-left: auto; margin-right: auto; }
            .jSrw{ color: #ccc; }
            #pD{ font-family: monospace; color: #666666; }
            #lbtn{ margin-top: 5%;}
        </style>
    </head>
    <body>
        <div id="wrapper" class="blockC">
            <div class="blnk"></div>
            <div class="jSrw txtC"><h1>:(</h1></div>
            <div id="pD" class="blockC txtC">
                <p>Well looks like you are new here. Or you purposely ate my cookie to keep up the shelf clean :/</p>
                <div id="lbtn" class="blockC"><a href="<?php echo $authUrl;?>"><img src="resources/icons/gl.png" class="blockC img-responsive" height="66" width="300" alt="Loggin with Google+"/></a></div>
            </div>
            <div class="blnk"></div>
            <div><img class="blockC" src="<?php echo HOST;?>/resources/logo/dl.png" alt="AlgoZ.org" height="35" width="130"/></div>
        </div>
    </body>
</html>
<?php
}else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Aouch :/ | AlgoZ.org</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
        <style>
            @media all and (min-width: 601px){h1 { font-size: 10em;} .blnk{ margin-top: 5%;}}
            @media all and (max-width: 600px) and (min-width: 401px){h1 { font-size: 3em;} .blnk{ margin-top: 10%;}}
            @media all and (max-width: 400px){h1 { font-size: 3em;} .blnk{ margin-top: 10%;}}
            body{ width: 100%; height: 100%; overflow: hidden; }
            .blnk{ position: relative; width: 100%;}
            #wrapper {margin: 10px;}
            .txtC{ text-align: center; }
            .blockC{display: block; margin-left: auto; margin-right: auto; }
            .jSrw{ color: #ccc; }
            #pD{ font-family: monospace; color: #666666;}
        </style>
    </head>
    <body>
        <div id="wrapper" class="blockC">
            <div class="blnk"></div>
            <div class="jSrw txtC"><h1>:(</h1></div>
            <div id="pD" class="blockC txtC">
                <p>You Shouldn't be here.. Looks like something terrible ig soin . .# 2 hapin</p>
            </div>
            <div class="blnk"></div>
            <div><img class="blockC" src="<?php echo HOST;?>/resources/logo/dl.png" alt="AlgoZ.org" height="35" width="130"/></div>
        </div>
    </body>
</html>
<?php
}
?>