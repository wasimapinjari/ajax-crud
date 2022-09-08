<?php

    /*

    ajax-crud: insert.php
    Licensed under MIT (https://github.com/wasimapinjari/ajax-crud/blob/main/LICENSE)

    */
    
    include './database.php';

    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data, true);

    $insertId = $mydata['sid'];
    $insertName = $mydata['name'];
    $insertEmail = $mydata['email'];
    $insertAddress = $mydata['address'];

    $id = filter_var($insertId, FILTER_SANITIZE_NUMBER_INT);
    $validateName = filter_var($insertName, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $validateEmail = filter_var($insertEmail, FILTER_SANITIZE_EMAIL);
    $validateAddress = filter_var($insertAddress, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if(!empty($validateName) && !empty($validateEmail) && !empty($validateAddress)){
        
        if(strlen($validateName) < 3){
            echo "<div class='text-danger'>Name too short!</div>";
        } else {
            if(strlen($validateName) > 255){
                echo "<div class='text-danger'>Maximum 255 characters allowed!</div>";
            } else {
                if(!preg_match("/^[a-zA-Z ]*$/", $validateName)){
                    echo "<div class='text-danger'>Name should only contain alphabet and whitespace!</div>";
                } else {
                    $name = $validateName;
                }
            }
        }

        if(strlen($validateEmail) > 255){
            echo "<div class='text-danger'>Maximum 255 characters allowed!</div>";
        } else {
            if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $validateEmail)){
                echo "<div class='text-danger'>Email Invalid!</div>";
            } else {
                $email = $validateEmail;
            }
        }

        if(strlen($validateAddress) < 5){
            echo "<div class='text-danger'>Address too short!</div>";
        } else {
            if(strlen($validateAddress) > 255){
                echo "<div class='text-danger'>Maximum 255 characters allowed!</div>";
            } else {
                if(!preg_match("/^[a-z0-9A-Z,-.:; ]*$/", $validateAddress)){
                    echo "<div class='text-danger'>Address should only contain alphabet, number, comma, dot, colon, semicolon, hyphen, and whitespace!</div>";
                } else {
                    $address = $validateAddress;
                }
            }
        }

    } else { 
        echo "<div class='text-danger'>All fields are required!</div>";
    }

    if(!empty($name) && !empty($email) && !empty($address)){
        
        $sql = "INSERT INTO ".DB_TABLE_NAME." (id, name, email, address) VALUES (:id, :name, :email, :address) ON DUPLICATE KEY UPDATE name=:name, email=:email, address=:address";
        $result = $conn->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->bindValue(':name', $name, PDO::PARAM_STR);
        $result->bindValue(':email', $email, PDO::PARAM_STR);
        $result->bindValue(':address', $address, PDO::PARAM_STR);

        if($result->execute() == 'true'){
            echo "<div class='text-success'>Data inserted successfully!</div>";
        } else {
            echo "<div class='text-danger'>Data insertion failed!</div>";
        }

    }
    
?>  
