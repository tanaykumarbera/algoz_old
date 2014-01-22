<?php
    
    function printHeader($HCargs, $HTargs= NULL){
        require_once './starter.php';
        include './header.php';
    }
    
    function printFooter($FTargs= NULL){
        include './footer.php';
        require_once './stopper.php';
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
?>
