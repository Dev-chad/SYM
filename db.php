<?php
$host = 'localhost';
$user = 'root';
$pw = 'Endofmysql!1';
$dbName = 'sym';
$mysqli = new mysqli($host, $user, $pw, $dbName);

$id=$_POST['id'];
$password=md5($_POST['pwd']);
$password2=$_POST['pwd2'];
$name=$_POST['name'];
$email=$_POST['email'];
$phone=$_POST['phone'];

$sql = "insert into member(id, pwd, name, email, phone_number)";
$sql = $sql. "values('$id','$password','$name','$email','$phone')";
if($mysqli->query($sql)){
    echo '<script>alert("회원가입이 완료되었습니다."); location.href="index.html";</script>';
}else{
    echo 'fail to insert sql';
}
?>
