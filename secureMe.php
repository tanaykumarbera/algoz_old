<?php
session_start();
if(!empty($_SESSION['uid'])){
}else header('Location: http://'.$_SERVER['HTTP_HOST'].'/algoFreak/gLogger.php?rdr='.urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']));
?>
