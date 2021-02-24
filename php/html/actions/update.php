<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ../index.php');
} else {
    require_once '../api/function.php';
    $db = getDb();
    // セッション開始
    @session_start();
    // ユーザー情報取得
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        // bindParamを利用したSQL文の実行
        $sql = 'SELECT * FROM USR WHERE userid = :id;';
        $sth = $db->prepare($sql);
        $sth->bindParam(':id', $username);
        $sth->execute();
        $user = $sth->fetch();
        if (
            isset($_POST['content']) &&
            validate_token(filter_input(INPUT_POST, 'token'))
        ) {
            $content = $_POST['content'];
            $date = date('Y-m-d H:i:s');
            $sql =
                'INSERT INTO Todos (content, add_date, date, userid) VALUES (:content, :add_date, :date, :userid)';
            $prepare = $db->prepare($sql);
            $prepare->bindValue(':content', $content, PDO::PARAM_STR);
            $prepare->bindValue(':add_date', $date);
            $prepare->bindValue(':date', $date);
            $prepare->bindValue(':userid', $user['userid']);
            $prepare->execute();
            $uri = $_SERVER['HTTP_REFERER'];
            header('Location: ' . $uri);
        }
    }
}
?>
