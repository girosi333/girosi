<?php

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO student details(name, email, phone)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}


$stmt->bind_param("sss", $_POST["name"], $_POST["email"],$_POST["phone"]);

if ($stmt->execute()) {

    header("Location:success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("Account already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
?>