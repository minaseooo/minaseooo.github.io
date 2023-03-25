<?php 
    // フォームのボタンが押されたら
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // フォームから送信されたデータを各変数に格納
        $name = $_POST["name"];
        $email = $_POST["email"];
        $content  = $_POST["content"];
    }

    // 送信ボタンが押されたら
    if (isset($_POST["submit"])) {
        // 送信ボタンが押された時に動作する処理をここに記述する
            
        // 日本語をメールで送る場合のおまじない
            mb_language("ja");
        mb_internal_encoding("UTF-8");
        
        //mb_send_mail("kanda.it.school.trial@gmail.com", "メール送信テスト", "メール本文");

            // 件名を変数subjectに格納
            $subject = "［自動送信］お問い合わせ内容の確認";

            // メール本文を変数bodyに格納
        $body = <<< EOM
{$name}　様

お問い合わせありがとうございます。

===================================================
【 お名前 】 
{$name}

【 メール 】 
{$email}

【 内容 】 
{$content}
===================================================

内容を確認のうえ、回答させて頂きます。
しばらくお待ちください。
EOM;


        $subbody = <<< EOM
{$name}　様

お問い合わせいただきました。

===================================================
【 お名前 】 
{$name}

【 メール 】 
{$email}

【 お問い合わせ内容 】 
{$contentbox}
===================================================
EOM;
        
        // 送信元のメールアドレスを変数fromEmailに格納
		//HP作成側のメールアドレスを記述
        $fromEmail = "sanasana.ma124@gmail.com";

        // 送信元の名前を変数fromNameに格納
		//HP作成側の名前
        $fromName = "minase";

        // ヘッダ情報を変数headerに格納する    
		//  
        $header = "From: " .mb_encode_mimeheader($fromName) ."<{$fromEmail}>";
		//
		$subheader = "From: " .mb_encode_mimeheader($name) ."<{$email}>";

		//Return-Path
		$parameter="-f $fromEmail";

        // 送信者へメール送信を行う
        mb_send_mail($email, $subject, $body, $header, $parameter);
		// 受信者へメール送信を行う
        mb_send_mail($fromEmail, $subject, $subbody, $subheader, $parameter);  

        // サンクスページに画面遷移させる
        header("Location: http://minaseooo.github.io/thanks.html");
        exit;
    }
?>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>お問い合わせフォーム</title>
<link rel="stylesheet" href="css/contact.css">
</head>
<body>
	<div id="container">
        <div class="contact">

            <div class="MainVisual">
                <img src="img/memoire02.png">
            </div>

            <div class="inner">
            <form action="thanks.html" method="post">
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="content" value="<?php echo $content; ?>">
                    <h1 class="contact-title">内容確認</h1>
                    <p>お問い合わせ内容はこちらで宜しいでしょうか？<br>よろしければ「送信する」ボタンを押して下さい。</p>
                    <div class="confirm">
                        <div>
                            <label>お名前</label>
                            <p><?php echo $name; ?></p>
                        </div>
                        <div>
                            <label>メールアドレス</label>
                            <p><?php echo $email; ?></p>
                        </div>
                        <div>
                            <label>お問い合わせ内容</label>
                            <p><?php echo nl2br($content); ?></p>
                        </div>
                    </div>
                
                <div class="button">
                    <input type="button" value="内容を修正する" onclick="history.back(-1)">
                    <button type="submit" name="submit">送信する</button>
                </div>

            </form>
            </div>

        </div>
    </div><!--container-->


</body>
</html>