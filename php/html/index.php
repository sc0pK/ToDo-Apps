<?php
require_once 'db.php';
$db = getDb();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
</head>
<body>
    <h1>To Do List</h1>
    <table>
        <thead>
            <tr>
                <th>タスク名</th>
                <th>作成日</th>
            </tr>
        </thead>
        <tbody>
        <?
            // SELECT文を変数に格納
            $sql = "SELECT * FROM ToDo";
            // SQLステートメントを実行し、結果を変数に格納
            $stmt = $db->query($sql);
            // foreach文で配列の中身を一行ずつ出力
            foreach ($stmt as $row) {
                // データベースのフィールド名で出力
                print "<tr>";
                print "<td>{$row['content']}</td>";
                print "<td>{$row['add_date']}</td>";
                print "<td><button value='{$row['id']}'>削除</button></td>";
                print "</tr>";
            }
        ?>
        </tbody>
    </table>
    <br>
    <form action="update.php" method="post">
        <input type="text" name="content" id="content" required>
        <input type="submit" value="追加">
    </form>
</body>
</html>