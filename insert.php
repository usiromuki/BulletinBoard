<?php
define("HOST",'localhost');
define("DB_NAME",'bulletin_board');
define("USER",'root');
define("PASS",'');
$name = "";
if(isset($_POST['name']))
{
    $name = $_POST['name'];
}
$comment = "";
if(isset($_POST['comment']))
{
    $comment = $_POST['comment'];
}
try{
    $dsn = 'mysql:dbname='.DB_NAME.';host='.HOST.';charset=utf8';
    $dbh = new PDO($dsn,USER,PASS);
    $sql = "INSERT INTO `comments`(`id`,`user`,`comment`) VALUES ('',:username,:comment)";
    $sth = $dbh->prepare($sql);
    $sth->execute(array(":username"=>$name,":comment"=>$comment));
    $dbh = null;
    $url = 'http://localhost/bulletinBoard/index.php';
    header('Location: ' . $url, true, 301);
} catch (PDOException $e){
    echo $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>掲示板</title>
</head>
</body>
</html>