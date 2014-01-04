<?php
                $name="DIVIDE AND FUCk";
                $db= new mysqli('localhost', 'root', '', 'algoZ');                echo "\ndb";
                $stm= $db->prepare("INSERT INTO algorithmcategory (categoryName) VALUES (?)"); 
                echo "\npp";
                $stm->bind_param('s', $name); echo "\npara";
                
                $stm->execute();echo "\nexe";
                $id= $stm->insert_id;
                echo "\n1. ".$id;
                $id= $stm->id;
                echo "\n2. ".$id; // SELECT sr FROM algorithmcategory WHERE categoryName LIKE ?
               
?>
