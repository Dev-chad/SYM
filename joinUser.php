<?php

include "db.php";
$id=$_POST['id'];
$password=md5($_POST['pwd']);
$nickname=$_POST['nickname'];
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];

$sql = "insert into member(id, pwd, nickname, name, email, phone_number)";
$sql = $sql. "values('$id','$password', '$nickname', '$name','$email','$phone')";
if($mysqli->query($sql)){
    echo '<script>alert("회원가입이 완료되었습니다."); location.href="index.php";</script>';
}else{
    echo $nickname;
    echo 'fail';
}
$mysqli->close();
?>