<?php
require_once '../../api/function.php';
require_unlogined_session();

// ユーザから受け取ったユーザ名とパスワード
$username = h(filter_input(INPUT_POST, 'username'));
$password = h(filter_input(INPUT_POST, 'password'));
// POSTメソッドのときのみ実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // データベースへの接続開始
        $db = getDb();
        // bindParamを利用したSQL文の実行
        $sql = 'SELECT * FROM USR WHERE userid = :id;';
        $sth = $db->prepare($sql);
        $sth->bindParam(':id', $username);
        $sth->execute();
        $result = $sth->fetch();
        //認証処理
        if (
            validate_token(filter_input(INPUT_POST, 'token')) &&
            password_verify($password, $result['pwHash'])
        ) {
            // 認証が成功したとき
            // セッションIDの追跡を防ぐ
            session_regenerate_id(true);
            // ユーザ名をセット
            $_SESSION['username'] = $username;
            // ログイン完了後に / に遷移
            header('Location: /');
            exit();
        } else {
            // 認証が失敗したとき
            // 「403 Forbidden」
            http_response_code(403);
        }
        // データベースへの接続に失敗した場合
    } catch (PDOException $e) {
        print '接続失敗:' . $e->getMessage();
        die();
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
        <h2 class="text-center">ログイン</h2>
		<?php if (http_response_code() === 403): ?>
			<p style="color: red;">ユーザIDまたはパスワードが違います</p>
		<?php endif; ?>
        <div class="form-group has-error">
        	<input type="text" class="form-control" name="username" placeholder="ユーザID" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="パスワード" required="required">
        </div>
		<input type="hidden" name="token" value="<?= h(generate_token()) ?>">
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">サインイン</button>
        </div>
    </form>
	<p>アカウントをお持ちでないですか？ <a href="../sign-up">登録する</a></p>
</div>
</body>
</html>