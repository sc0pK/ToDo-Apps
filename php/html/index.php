<?php
require_once 'api/db.php';
$db = getDb();
  session_start();
  //ログイン済みの場合
  if (!isset($_SESSION['EMAIL'])) {
    header('Location: account/login');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <title>ToDo List</title>
</head>
<body>
    <h1>To Do List</h1>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>タスク名</th>
                <th>作成日</th>
            </tr>
        </thead>
        <form action="actions/delete.php" method="post">
        <tbody>
        <?
            // SELECT文を変数に格納
            $sql = "SELECT * FROM ToDo WHERE date IS NOT NULL";
            // SQLステートメントを実行し、結果を変数に格納
            $stmt = $db->query($sql);
            // foreach文で配列の中身を一行ずつ出力
            foreach ($stmt as $row) {
                // データベースのフィールド名で出力
                print "<tr>";
                print "<td>{$row['content']}</td>";
                print "<td>{$row['add_date']}</td>";
                print "<td><button type='submit' class='btn btn-danger' name='del' value='{$row['id']}'>削除</button></td>";
                print "</tr>";
            }
        ?>
        </tbody>
        </form>
    </table>
    <br>
    <div class="mx-auto" style="width: 300px;">
        <form class="form-inline" action="actions/update.php" method="post">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" name="content" id="content" required>
            </div>
            <input type="submit" class="btn btn-primary mb-2"value="追加">
        </form>
    </div>
</body>
</html>