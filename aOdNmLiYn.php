<?php
session_start();
if(!empty($_SESSION['uid'])&&($_SESSION['AoDnMlIyN']===1)){
}else{
?>   
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Permission Denied | AlgoZ.org</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <style>
            @media all and (min-width: 601px){h1 { font-size: 10em;} .blnk{ margin-top: 5%;}}
            @media all and (max-width: 600px) and (min-width: 401px){h1 { font-size: 3em;}#blnk{ margin-top: 10%;}}
            @media all and (max-width: 400px){h1 { font-size: 3em;} .blnk{ margin-top: 10%;}}
            body{ width: 100%; height: 100%; overflow: hidden; }
            .blnk{ position: relative; width: 100%;}
            #wrapper {margin: 10px;}
            .txtC{ text-align: center; }
            .blockC{display: block; margin-left: auto; margin-right: auto; }
            .jSrw{ color: #ccc; }
            #pD{ font-family: monospace; color: #666666; }
        </style>
    </head>
    <body>
        <div id="wrapper" class="blockC">
            <div class="blnk"></div>
            <div class="jSrw txtC"><h1>!</h1></div>
                <div id="pD" class="blockC txtC">
                    <p>What are you doing here? I am afraid this section is not available for you.</p>
                    <p>If you think this is erroneous, please leave us a <a href="mailto:support@algoz.org">mail</a>. We will look upon the matter as soon as possible.</p>
                </div>
            <div class="blnk"></div>
            <div><img class="blockC" src="./resources/logo/dl.png" alt="AlgoZ.org" height="35" width="130"/></div>
        </div>
    </body>
</html>
<?php    
die();
}
?>
