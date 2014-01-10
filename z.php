<?php
$str= "Helllo there what\n d funckf\th aue u doing\n here.. m I ckeafn \n sjek \  n \ n on thar???\n";
$c=0;
$i=strpos($str, "\n");
while($i!==FALSE){
    $c++;
    $i=strpos($str, "\n",$i);
}
echo $c;

?>