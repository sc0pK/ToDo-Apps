<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../index.php');
} else {
    require_once '../api/function.php';
    if (isset($_POST['del'])) {
        $db = getDb();
        $id = h($_POST['del']);
        $sql = 'UPDATE Todos SET date = NULL WHERE id = :id;';
        $prepare = $db->prepare($sql);
        $prepare->bindValue(':id', $id, PDO::PARAM_STR);
        $prepare->execute();
        $uri = $_SERVER['HTTP_REFERER'];
        header('Location: ' . $uri);
    }
}
?>
