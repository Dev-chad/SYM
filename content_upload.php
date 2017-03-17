<?php session_start();
include "db.php";

$title = $_POST['title'];
$desc = $_POST['desc'];
$author = $_SESSION['nickname'];
$time = date("Y-m-d H:i:s",time());

$query = "insert into contents(title, content_desc, date, author, category)";
$query = $query. "values('$title', '$desc', '$time', '$author', 'NEWS')";

if($mysqli->query($query)){
    echo '<script>alert("게시물을 업로드 하였습니다."); location.href="news.php";</script>';
}

$mysqli->close();

?>