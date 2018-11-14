<?php
define("HOST",'localhost');
define("DB_NAME",'bulletin_board');
define("USER",'root');
define("PASS",'');
try{
    $dsn = 'mysql:dbname='.DB_NAME.';host='.HOST.';charset=utf8';
    $dbh = new PDO($dsn,USER,PASS);
    $res = $dbh->query('SELECT * FROM comments');
    $rows = $res->fetchAll();
    $dbh = null;
}catch(PDOException $e){
    echo $e->getMessage();
    die();
}
function EchoHTML($str){
    echo htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="bulletinBoard.css">
    <title>掲示板</title>
</head>
<body>
    <h3 class="board-title">掲示板</h3>
    <?php foreach($rows as $row):?>
    <div class="comment-area">
        <div class="username-area"><?php EchoHTML($row["id"]) ?><span class="username"><?php EchoHTML(":".$row["user"])?></span></div>
        <div class="comment"><?php EchoHTML($row["comment"])?></div>
    </div>
    <?php endforeach?>
    <div class="submission-form">
    <h1>投稿欄</h1>
    <form action="insert.php" method="POST">
    <p><input class="form-text" type="text" name="name"  placeholder="名前(省略可)"></p>
    <p><textarea class="form-text" name="comment" rows=5 placeholder="コメント"></textarea></p>
    <p><input type="submit" value="送信"></p>
    </form>
    </div>
</body>
</html>