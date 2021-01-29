<?php
if(isset($_POST['del'])){
    require_once '../api/db.php';
    $db = getDb();
    $id = $_POST['del'];
    $sql = "UPDATE ToDo SET date = NULL WHERE id = :id;";
    $prepare = $db->prepare($sql);
    $prepare->bindValue(':id', $id, PDO::PARAM_STR);
    $prepare->execute();
    $uri = $_SERVER['HTTP_REFERER'];
    header("Location: ".$uri);
}
header( "Location: ../index.php" );
?>