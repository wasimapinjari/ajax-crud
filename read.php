<?php

    /*-------------------------------------------------------------------------------

    ajax-crud: read.php
    Licensed under MIT (https://github.com/wasimapinjari/ajax-crud/blob/main/LICENSE)

    -------------------------------------------------------------------------------*/
    
    include './database.php';

    $sql = "SELECT * FROM ".DB_TABLE_NAME;
    $result = $conn->prepare($sql);
    $result->execute();

    if($result){
        $data = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
    }
    
    echo json_encode($data);

?>