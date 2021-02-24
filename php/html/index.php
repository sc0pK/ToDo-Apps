<?php
require_once 'api/function.php';
$db = getDb();
require_logined_session();
?>

<!DOCTYPE html>
<html lang="ja">
  <?php
  define('title', 'ToDo List');
  include 'global_menu.php';
  ?>
  <body>
    <div class="contaier m-4">
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
            $username = $_SESSION['username'];
            // bindParamを利用したSQL文の実行
            $sql = 'SELECT * FROM Todos WHERE date IS NOT NULL AND userid = :id;';
            $sth = $db->prepare($sql);
            $sth->bindParam(':id', $username);
            $sth->execute();
            $todos = $sth -> fetchAll(PDO::FETCH_ASSOC);
            // foreach文で配列の中身を一行ずつ出力
            foreach ($todos as $row) {
                // データベースのフィールド名で出力
                print "<tr>";
                print "<td>{$row['content']}</td>";
                print "<td>{$row['add_date']}</td>";
                print "<td><button type='submit' class='btn btn-danger' name='del' value='{$row['id']}'>削除</button></td>";
                print "</tr>";
            }
        ?>
            <input
              type="hidden"
              name="token"
              value="<?= h(generate_token()) ?>"
            />
          </tbody>
        </form>
      </table>
    </div>
    <br />
    <div class="mx-auto" style="width: 300px">
      <form class="form-inline" action="actions/update.php" method="post">
        <div class="form-group mx-sm-3 mb-2">
          <input
            type="text"
            class="form-control"
            name="content"
            id="content"
            required
          />
          <input
            type="hidden"
            name="token"
            value="<?= h(generate_token()) ?>"
          />
        </div>
        <input type="submit" class="btn btn-primary mb-2" value="追加" />
      </form>
    </div>
  </body>
</html>
