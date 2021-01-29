<?php
if(isset($_POST['content'])){
    require_once '../api/db.php';
    $db = getDb();
    $content = $_POST['content'];
    $date = date("Y-m-d H:i:s");
    $sql = 'INSERT INTO ToDo (content, add_date, date) VALUES (:content, :add_date, :date)';
    $prepare = $db->prepare($sql);
    $prepare->bindValue(':content', $content, PDO::PARAM_STR);
    $prepare->bindValue(':add_date', $date,);
    $prepare->bindValue(':date', $date,);
    $prepare->execute();
    $uri = $_SERVER['HTTP_REFERER'];
    header("Location: ".$uri);
}
header( "Location: ../index.php" );
?>