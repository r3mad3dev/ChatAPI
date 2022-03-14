<?php

    echo '<textarea rows="10" cols="70">';
    $fn = fopen(dirname(__FILE__)."/chat_fetch/chat_main.txt","r");
    
    while(! feof($fn))  {
      $result = fgets($fn);
      echo $result;
    }
  
    fclose($fn);
  echo '</textarea>';


?>