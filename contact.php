<!-- ロジック
================================================================================================ -->
<?php
// セッション開始
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //フォームのボタンが押されたら、POSTされたデータを各変数に格納
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // トークンの生成（CSRF対策）
    $token = bin2hex(random_bytes(32));
    $_SESSION['token'] = $token;

    // HTML出力前のエスケープ処理
    function escape($str)
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
} else {
    //フォームボタン以外からこのページにアクセスした場合（URL直接入力など）、トップページに戻る
    header(("location: alert.php"));
    exit;
}
?>

<!-- ビュー
================================================================================================ -->
<html lang="ja">
<head>
<meta charset="UTF-8">
    <meta name="keywords" content="ポートフォリオ">
    <meta name="description" content="Memorie">
    <meta name="auther" content="Memorie">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>確認画面</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/contact.css">
</head>
<body>
	<div id="container">
        <div class="contact">

            <div class="MainVisual">
                <img src="img/memoire02.png">
            </div>

            <div class="inner">
            <p class="confirm-text">下記の内容でメッセージを送信します。<br>よろしければ「送信する」ボタンを押してください。</p>
            
            <form action="https://ss1.xrea.com/matsubaooo.s223.xrea.com/thanks.php" method="post">
                <input type="hidden" name="token" value="<?php echo escape($token); ?>">
                <div class="contact-form">
                    <label for="name">お名前</label>
                    <input type="hidden" id="name" name="name" value="<?php echo escape($name); ?>">
                    <p><?php echo escape($name); ?></p>
                </div>
                <div class="contact-form">
                    <label for="email">メールアドレス</label>
                    <input type="hidden" id="email" name="email" value="<?php echo escape($email); ?>">
                    <p><?php echo escape($email); ?></p>
                </div>
                <div class="contact-form">
                    <label for="message">メッセージ</label>
                    <input type="hidden" id="message" name="message" value="<?php echo escape($message); ?>">
                    <p><?php echo nl2br(escape($message)); ?></p>
                </div>

            <div class="button">
                <input class="btn" type="button" value="前画面へ戻る" onclick="history.back(-1)">
                <input class="btn" type="submit" value="送信する" name="submit"></input>
            </div>
            </form>

            </div>

        </div>
    </div><!--container-->


</body>
</html>