<?php
session_start();
$host = 'localhost';
$user = 'root';
$pw = 'Endofmysql!1';
$dbName = 'sym';
$mysqli = new mysqli($host, $user, $pw, $dbName);

$id = $_SESSION["id"];
$pwd = $_POST['newPwd'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if(!is_null($pwd)){
    $pwd = md5($pwd);
    $query = "update member set pwd = '$pwd' where id = '$id'";
    $mysqli->query($query);
}

if(!is_null($nickname) && $nickname != ""){
    $query = "update member set nickname = '$nickname' where id = '$id'";
    $mysqli->query($query);
    $_SESSION["nickname"] = $nickname;
}

if(!is_null($email)){
    $query = "update member set email = '$email' where id = '$id'";
    $mysqli->query($query);
}

if(!is_null($phone) && $phone != ""){
    $query = "update member set phone_number = '$phone' where id = '$id'";
    $mysqli->query($query);
}

echo '<script>alert("회원 정보 수정이 완료되었습니다."); history.back();</script>';

?>