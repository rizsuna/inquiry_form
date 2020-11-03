<!-- 入力文字確認画面 -->


<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>お問い合わせフォーム</title>
    <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1>お問い合わせフォーム</h1>

    <!-- TIMEがなければ戻る -->
    <?php if(!isset($_SESSION['DATETIME'])): ?>
        <?php session_destroy(); ?>
        <p>お問い合わせ内容を入力してください</p>
        <p><a href="index.php">入力する</a></p>
    <?php else: ?>

    <!-- 送られてきた文字をsessionに入れる -->
    <?php
        $_SESSION[ 'name' ] = htmlspecialchars( $_POST[ 'name' ], ENT_QUOTES );
        $_SESSION[ 'kana' ] = htmlspecialchars( $_POST[ 'kana' ], ENT_QUOTES );
        $_SESSION[ 'email' ] = htmlspecialchars( $_POST[ 'email' ], ENT_QUOTES );
        $_SESSION[ 'how' ] = htmlspecialchars( $_POST[ 'how' ], ENT_QUOTES );
        $_SESSION[ 'comment' ] = htmlspecialchars( $_POST[ 'comment' ], ENT_QUOTES );
    ?>

    <p>こちらの内容でよろしいですか？</p>

    <!-- 確認画面 -->
    <dl>
        <dt>お名前<span class="most">※</span></dt>
        <dd><?php echo $_SESSION[ 'name' ] ?></dd>
        <dt>ふりがな<span class="most">※</span></dt>
        <dd><?php echo $_SESSION[ 'kana' ] ?></dd>
        <dt>メールアドレス<span class="most">※</span></dt>
        <dd><?php echo $_SESSION[ 'email' ] ?></dd>
        <dt>用件<span class="most" name="howname">※</span></dt>
        <dd><?php echo $_SESSION[ 'how' ] ?>
        </dd>
        <dt>お問い合わせ・ご質問内容<span class="most">※</span></dt>
        <dd><?php echo $_SESSION[ 'comment' ] ?></dd>
    </dl>

    <!-- ボタン -->
    <button class="submit" type="button" onclick="history.back()">戻る</button>
    <a href="completion.php"><button class="submit" type="button">送信</button></a>
    <?php endif; ?>

</body>

</html>
