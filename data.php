<?php

if ( ! (isset($_GET["firstname"], $_GET["lastname"], $_GET["email"]))) {
    header("Location: ./newsletter.html"); 
}else {
    $pdo = new PDO("mysql:host=localhost;dbname=newsletter;charset=utf8", "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]); 
    $sql = "SELECT id FROM newsletter WHERE email=:em;"; 
    $stmt = $pdo -> prepare($sql); 
    $stmt -> bindParam(":e", $_GET["email"]); 
    $stmt -> execute(); 
    
    if ($stmt -> rowCount() > 0) {
        echo "Diese Mail ist bereits für den Newsletter angemeldet. Zurück nach Home in 5 Sekunden ..."; 
    }else {
        $sql = "INSERT INTO newsletter(firstname, lastname, email) VALUES (:fi, :la, :em);"; 
        $stmt = $pdo -> prepare($sql); 
        $stmt -> bindParam(":f", $_GET["firstname"]); 
        $stmt -> bindParam(":l", $_GET["lastname"]); 
        $stmt -> bindParam(":e", $_GET["email"]); 
        $stmt -> execute(); 
        echo "Erfolgreich angemeldet. Zurück nach Home in 5 Sekunden ..."; 
    }
    header("refresh:5;url=index.html"); 
}