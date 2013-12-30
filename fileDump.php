<?php
if ($_FILES['uFile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['uFile']['tmp_name'])) {
  echo file_get_contents($_FILES['uFile']['tmp_name']); 
}
?>
