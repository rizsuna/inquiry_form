<!-- DB接続、DBにINSERT実行 -->


<?php
session_start();

//プリペアドステートメントでDB接続
function connect_db($dbname, $host='localhost', $user='root', $password='root') {
    $dsn = "mysql:dbname=${dbname};host=${host};charset=utf8";
    try {
        $dbh = new PDO($dsn, $user, $password,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        return $dbh;
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

//プリペアドステートメントでINSERT実行
function secure_insert($dbh, $name, $kana, $email, $how, $comment) {
    try {

        $sql = "INSERT INTO inquiry (f_id, name, kana, email, business, comment) VALUES (NULL, :name, :kana, :email, :business, :comment)";

        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':kana', $kana, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':business', $how, PDO::PARAM_STR);
        $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);

        $status = $stmt->execute();
        return $status;
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

?>

<!DOCTYEP html>
<html>

<head>
    <meta charset="utf-8">
    <title>お問い合わせフォーム</title>
    <link href="css/style.css" media="all" rel="stylesheet" type="text/css" />
</head>

<body>
<h1>お問い合わフォーム</h1>

    <!-- 乱入防止 -->
    <?php if(!isset($_SESSION['DATETIME']) || !isset($_SESSION['name'])): ?>
        <p>お問い合わせ内容を入力してください</p>
        <p><a href="index.php">入力する</a></p>
    <?php else: ?>

        <!-- sessionを持ってくる -->
        <?php
            $name = htmlspecialchars( $_SESSION[ 'name' ], ENT_QUOTES );
            $kana = htmlspecialchars( $_SESSION[ 'kana' ], ENT_QUOTES );
            $email = htmlspecialchars( $_SESSION[ 'email' ], ENT_QUOTES );
            $how = htmlspecialchars( $_SESSION[ 'how' ], ENT_QUOTES );
            $comment = htmlspecialchars( $_SESSION[ 'comment' ], ENT_QUOTES );
        ?>

        <!-- DB接続 -->
        <?php
            try{
                //DB接続
                $dbh = connect_db('db_inquiry');
                //INSERT実行
                $status = secure_insert($dbh, $name, $kana, $email, $how, $comment);
            }catch(Exception $e){
                //DBに接続できなかった
                var_dump($e->getMessage());
                ?>
                <p>データベースにアクセスできませんでした。<br>再度お試しください。</p>
                <a href="index.php">お問い合わせフォーム</a>

                <?php
                session_destroy();
                die();
            }
        ?>

        <!-- INSERTされたのか確認 -->
        <?php
            $insert = $dbh->lastInsertId();
        ?>
        <?php if($insert): ?>
           <p>正常に送信完了しました。</p>
        <?php else: ?>
            <p>送信に失敗しました。もう一度やり直してください。</p>
        <? endif; ?>

    <?php endif; ?>

</body>

</html>

<!-- session破棄 -->
<?php
    $_SESSION = array();
    //ssession切断
    session_destroy();
?>
