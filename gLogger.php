<?php
session_start();
$login= FALSE;
echo 'f';
if(!empty($_SESSION['rdr'])) $rdr_url= $_SESSION['rdr'];
else $rdr_url= 'http://'.$_SERVER['HTTP_HOST'];
    
require './g/src/Google_Client.php';
require './g/src/contrib/Google_PlusService.php';


echo 'x';
$client = new Google_Client();
$client->setApplicationName("AlgoZ.org");
$client->setClientId('631278524127-6r0vs64mdoe6vrjbf6qalqfv0jvbvchr.apps.googleusercontent.com');
$client->setClientSecret('pXmCVWGYvKfImTTpaV34Z3dg');
$client->setRedirectUri('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
$client->setDeveloperKey('AIzaSyAttdqiezVouVrngd4z09U-LliiIZhjg2k');
$plus = new Google_PlusService($client);
echo 's';
if(isset($_REQUEST['logout'])){    echo 'a';
    unset($_SESSION['uid']);
    setcookie('uid', "", time()-86400);
    header('Location: http://'.$_SERVER['HTTP_HOST']);
}
echo 'v';
if(!empty($_COOKIE['uid'])){    echo 'b';
    $_SESSION['uid']=$_COOKIE['uid'];
    header('Location: '.$rdr_url);
}
echo 'l';
if (isset($_GET['code'])){    echo 'c';
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
}
echo 't';
if (!empty($_SESSION['access_token'])) {    echo 'uy';
  $client->setAccessToken($_SESSION['access_token']);
}
echo 'i';
if($client->getAccessToken()){  echo 'ew';  print_r($plus->people);
    $user = $plus->people->get('me');    echo 'op';
    $gID= filter_var($user['id'], FILTER_SANITIZE_STRING);
    $name = filter_var($user['displayName'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $gender= filter_var($user['gender'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $img = filter_var($user['image']['url'], FILTER_VALIDATE_URL);
    $login= TRUE;    echo 'ui';
    $_SESSION['access_token'] = $client->getAccessToken();
    print_r($user);
    $db= new mysqli('localhost', 'root', '', 'algoZ');
    $q= $db->stmt_init();
    $q->prepare("SELECT id FROM userdata WHERE gpID LIKE ?");
    $q->bind_param('s', $gID);
    if($q->execute())        echo '-->';
    $res= $q->get_result();
    if($res->num_rows>0){        echo 'rw';
        $a=$res->fetch_array(MYSQLI_ASSOC);
        $_SESSION['uid']= $a['id'];
        setcookie('uID', $a['id'], time()+ 86400*30); 
        $login= TRUE;
        header('Location: '.$rdr_url);
    }else{        echo 'ty';
        $q->prepare("INSERT INTO userdata (gpID, gpName, gpGender, gpImage) VALUES(?, ?, ?, ?)");
        $q->bind_param('ssss', $gID, $name, $gender, $img);
        if($q->execute()){            echo 'ui';
            $_SESSION['uid']= $q->insert_id;
            setcookie('uid', $q->insert_id, time()+ 86400*30);
            $login= TRUE;
            header('Location: '.$rdr_url);
        }
    }
}else{echo 'we';
    $authUrl = $client->createAuthUrl();
    $login= FALSE;    
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
            @media all and (min-width: 601px){h1 { font-size: 10em;}#blnk{ margin-top: 5%;}}
            @media all and (max-width: 600px) and (min-width: 401px){h1 { font-size: 3em;}#blnk{ margin-top: 10%;}}
            @media all and (max-width: 400px){h1 { font-size: 3em;}#blnk{ margin-top: 10%;}}
            body{ width: 100%; height: 100%; overflow: hidden; }
            #blnk{ position: relative; width: 100%;}
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
            <div id="blnk"></div>
            <div class="jSrw txtC"><h1>:(</h1></div>
            <div id="pD" class="blockC txtC">
                <p>Well looks like you are new here. Or you purposely ate my cookie to keep up the shelf clean :/</p>
                <div id="lbtn" class="blockC"><a href="<?php echo $authUrl;?>"><img src="resources/icons/gl.png" class="blockC img-responsive" height="66" width="300" alt="Loggin with Google+"/></a></div>
            </div>
        </div>
    </body>
</html>
<?php
}
?>