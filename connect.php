<?php

function getDBConnection() {
    
    //C9 db info
    $host = "us-cdbr-iron-east-04.cleardb.net";
    $dbName = "heroku_981fc0aa0d1b350";
    $username = "bdc992bb9af150";
    $password = "29b5a64a";
    
    //when connecting from Heroku
    //mysql://bdc992bb9af150:29b5a64a@us-cdbr-iron-east-04.cleardb.net/heroku_981fc0aa0d1b350?reconnect=true
    if  (strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
        $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $host = $url["host"];
        $dbName = substr($url["path"], 1);
        $username = $url["user"];
        $password = $url["pass"];
    } 
    
    try {
        //Creates a database connection
        $dbConn = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    
        // Setting Errorhandling to Exception
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    catch (PDOException $e) {
       echo "Problems connecting to database!";
       exit();
    }
    
    
    return $dbConn;
}

?>