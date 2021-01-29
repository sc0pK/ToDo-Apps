<?php
if(isset($_POST['userid']) && isset($_POST['password']) && isset($_POST['name'])){
    require_once '../api/db.php';
    $db = getDb();
    $userid = $_POST['userid'];
    $pass = $_POST['password'];
    $name = $_POST['name'];
    $sql = 'INSERT INTO USR (userid, pwHash, name) VALUES (:userid, :pwHash, :name)';
    $prepare = $db->prepare($sql);
    $prepare->bindValue(':userid', $userid, PDO::PARAM_STR);
    $prepare->bindValue(':pwHash', password_hash($pass, PASSWORD_DEFAULT));
    $prepare->bindValue(':name', $name,);
    $prepare->execute();
    $uri = $_SERVER['HTTP_REFERER'];
    header("Location: ".$uri);
}
header( "Location: ../index.php" );
?>