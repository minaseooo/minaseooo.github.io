<!-- ロジック
================================================================================================ -->
<?php
session_start();

/* 以下、メール送信の処理
------------------------------------------------------------------------------------------------- */
// 送信ボタンが押されたら
if (!empty($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) {
    // //フォームのボタンが押されたら、POSTされたデータを各変数に格納
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // メールの言語設定
    mb_language("ja");
    mb_internal_encoding("UTF-8");

    // 件名を変数subjectに格納
    $subject = "［自動送信］メッセージ内容の確認";

    // メール本文を変数bodyに格納
    $body = <<< EOM
  {$name}　様

  メッセージありがとうございます。
  以下の内容でメッセージを承りました。

  ===================================================
  < お名前 >
  {$name}

  < メールアドレス >
  {$email}

  < メッセージ >
  {$message}
  ===================================================

  ※当メールは送信専用となっております。
  　ご返信いただいても、お答えいたしかねますのでご了承ください。
  EOM;

    // 送信元のメールアドレスを変数fromEmailに格納(本番環境へのデプロイ時に正規のアドレスに変更すること！)
    $fromEmail = "sanasana.ma124@gmail.com";

    // 送信元の名前を変数fromNameに格納
    $fromName = "Memorie Portfolio";

    // ヘッダ情報を変数headerに格納する
    $header = "From: " . mb_encode_mimeheader($fromName) . "<{$fromEmail}>";

    // 受信用のメールアドレスを変数myEmailに格納(本番環境へのデプロイ時に正規のアドレスに変更すること！)
    $myEmail = "sanasana.ma124@gmail.com";

    //Return-Path
	$parameter="-f $fromEmail";

    // フォーム入力者へメールを送信する
    mb_send_mail($email, $subject, $body, $header, $parameter);

    // サイト管理者へメールを送信する
    mb_send_mail($myEmail, $subject, $body, $header, $parameter);
} else {
    // トークンが一致しない場合、不正アクセス画面へ移動する
    header(("location: alert.php"));
    exit;
}
?>


<!-- ビュー
================================================================================================ -->

<html lang="js">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="ポートフォリオ">
    <meta name="description" content="Memorie">
    <meta name="auther" content="Memorie">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Memorie</title>
    <link rel="stylesheet" href="css/reset.css">
    <!--FontAwesome--><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
   <!--Style-css--><link rel="stylesheet" href="css/thanks.css">
</head>

<body>

<div id="container">
  <div class="thanks">

      <div class="MainVisual">
        <img src="img/memoire02.png">
      </div>

        <div class="inner">
          <div id="thanks">
            <div class="message">
                <h1>お問い合わせありがとうございました。</h1>
                <p>送信が完了しました。</p>
                <p>1週間以内に記載頂いたメールアドレスに返信いたします。</p>
                <p>1週間経ってもお返事が届かない場合は恐れ入りますが、<br>メールフォームまたはメールにて再度お問い合わせください。</p>
            </div><!--message-->
          </div>
        </div>

        <div class="top-button">
          <div class="top-page">
            <a href="https://minaseooo.github.io">
              トップページへ戻る
            </a></div>
        </div>

      <footer>
        <small>Copylight 2023 ami matsuba all right reserved.</small>
      </footer>

  </div>
</div><!--container-->
  
</body>