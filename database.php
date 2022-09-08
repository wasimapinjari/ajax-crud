<?php

    /*

    ajax-crud: database.php
    Licensed under MIT (https://github.com/wasimapinjari/ajax-crud/blob/main/LICENSE)

    */

    define('DB_HOST', 'localhost');
    define('DB_NAME', 'wasimapinjari');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    define('DB_TABLE_NAME', 'wasimapinjari');

    // Create connection

    try {

        $conn = new PDO("mysql:host=".DB_HOST.";", DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
        $sql = "
        CREATE DATABASE IF NOT EXISTS ".DB_NAME.";
        use ".DB_NAME.";
        CREATE TABLE IF NOT EXISTS ".DB_TABLE_NAME."(id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT, 
        name VARCHAR(255) NOT NULL, 
        email VARCHAR(255) NOT NULL, 
        address VARCHAR(255) NOT NULL)
        ";
  
        $conn->query($sql);
        
    } catch(\PDOException $e) {
        throw new \PDOException($e->getMessage(), $e->getCode());
    }
  
?>
