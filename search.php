<?php

    /*-------------------------------------------------------------------------------

    ajax-crud: search.php
    Licensed under MIT (https://github.com/wasimapinjari/ajax-crud/blob/main/LICENSE)

    -------------------------------------------------------------------------------*/
    
    include './database.php';

    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $insertSearch = $mydata['search'];
    $search = filter_var($insertSearch, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               
    $sql = "SELECT * FROM ".DB_TABLE_NAME." WHERE name LIKE CONCAT( '%', :search, '%') OR email LIKE CONCAT( '%', :search, '%') OR address LIKE CONCAT( '%', :search, '%')";
    $result = $conn->prepare($sql);
    $result->bindValue(':search', $search, PDO::PARAM_STR);
    $result->execute();
    
    if($result){
        $data = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
    }
    
    echo json_encode($data);

?>