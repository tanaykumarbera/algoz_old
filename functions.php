<?php
    function printHeader($HCargs, $HTargs= NULL){
        require_once './starter.php';
        include './header.php';
    }
    
    function printFooter($FTargs= NULL){
        include './footer.php';
        require_once './stopper.php';
    }
?>
