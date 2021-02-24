<?php
require_once '../../api/function.php';

require_unlogined_session();

// POSTメソッドのときのみ実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['userid']) &&
        isset($_POST['password']) &&
        isset($_POST['name'])
    ) {
        try {
            $db = getDb();
            $userid = h($_POST['userid']);
            $pass = h($_POST['password']);
            $name = h($_POST['name']);
            $sql =
                'INSERT INTO USR (userid, pwHash, name) VALUES (:userid, :pwHash, :name)';
            $prepare = $db->prepare($sql);
            $prepare->bindValue(':userid', $userid, PDO::PARAM_STR);
            $prepare->bindValue(
                ':pwHash',
                password_hash($pass, PASSWORD_DEFAULT)
            );
            $prepare->bindValue(':name', $name);
            $prepare->execute();
            header('Location: /account/login');
        } catch (PDOException $e) {
            $errmsg = 'アカウントが既に存在がします。';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
  <?php
  define('title', 'ログイン');
  include '../../global_menu.php';
  ?>
<body>
<div class="login-form">
    <form action="" method="post">
        <h2 class="text-center">アカウント作成</h2>
		<? echo "<p class='errmsg'>{$errmsg}</p>" ?>
        <div class="form-group has-error">
        	<input type="text" class="form-control" name="userid" placeholder="ユーザID" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="パスワード" required="required">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="名前" required="required">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">登録する</button>
        </div>
    </form>
	<p>アカウントをお持ちですか？ <a href="../login">ログインする</a></p>
</div>
</body>
</html>