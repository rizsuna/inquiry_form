<!-- お問い合わせ入力画面 -->


<?php
//session使用
session_start();

//途中乱入防止
date_default_timezone_set('Asia/Tokyo');
$now = new DateTime();
$_SESSION['DATETIME'] = $now->format('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>お問い合わせフォーム</title>
    <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1>お問い合わせフォーム</h1>
    <p>※は必須です</p>
    <form action="confirm.php" method="post">
        <dl>
            <dt>お名前<span class="most">※</span></dt>
            <dd><input type=text name="name" required placeholder="山田　太郎"></dd>

            <dt>ふりがな<span class="most">※</span></dt>
            <dd><input type=text name="kana" required placeholder="やまだ　たろう"></dd>

            <dt>メールアドレス<span class="most">※</span></dt>
            <dd><input type=email name="email" required placeholder="xxx@xxx.com"></dd>

            <dt>用件<span class="most" name="howname">※</span></dt>
            <dd><select name="how">
                    <option value="お問い合わせ">お問い合わせ</option>
                    <option value="不具合の報告">不具合の報告</option>
                    <option value="その他">その他</option>
                </select></dd>

            <dt>お問い合わせ・ご質問内容<span class="most">※</span></dt>
            <dd><textarea name="comment" cols="20" rows="5" required></textarea></dd>
        </dl>
        <p><input class="submit" type="submit" name="submit" value="確認画面へ"></p>
    </form>
</body>

</html>
