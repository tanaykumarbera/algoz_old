<?php

    define("HOST", "http://{$_SERVER['HTTP_HOST']}/algoFreak");
    
    function printHeader($HCargs, $HTargs= NULL){
        require_once './header.php';
    }
    
    function printFooter($FTargs= NULL){
        require_once './footer.php';
    }
    
    function __($arg){
        echo $arg;
    }
    
    function __db(){
        $db= new mysqli('localhost', 'root', '', 'algoZ') or die('<span style="color: red; font-size: 2em;  text-align: center; font-family: monospace; margin-top: 25%; position: absolute; width: 100%;">Something just happened. Its time to Freak out ^o^</span>'); 
        return $db;
    }
    
    function __close($ob){
        $ob->close();
    }
    
    function _chk($x){
        return !empty($x['list']);
    }
    
    function isAbsent($a, $b){
        foreach($b as $k){
            if($k['aNam']==$a) return FALSE;
        }
        return TRUE;
    }
?>
