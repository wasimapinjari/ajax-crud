<?php

    /*-------------------------------------------------------------------------------

    ajax-crud: delete.php
    Licensed under MIT (https://github.com/wasimapinjari/ajax-crud/blob/main/LICENSE)

    -------------------------------------------------------------------------------*/
    
    include './database.php';

    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);
    $insertId = $mydata['sid'];
    $id = filter_var($insertId, FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id)){

        $sql = "DELETE FROM ".DB_TABLE_NAME." WHERE id = :id";
        $result = $conn->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();
        if($result->execute() == TRUE){
            echo "<div class='text-success'>Data deleted successfully!</div>";
        } else {
            echo "<div class='text-danger'>Data deletion failed</div>";
        }

    }
    
?>