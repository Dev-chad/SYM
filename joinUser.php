<?php

include "db.php";
$id = $_POST['id'];
$password = $_POST['pwd'];
$passwordCheck = $_POST['pwdCheck'];
$nickname = $_POST['nickname'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if (strlen($id) == 0) {
    echo '<script>alert("아이디를 입력해주세요."); history.back();</script>';
} else if (mysqli_num_rows($mysqli->query("select * from member where id = '$id'")) > 0) {
    echo '<script>alert("이미 등록된 아이디 입니다."); history.back();</script>';
} else if (strlen($password) == 0) {
    echo '<script>alert("비밀번호를 입력해주세요."); history.back();</script>';
} else if(strlen($password) < 8) {
    echo '<script>alert("비밀번호가 너무 짧습니다. 형식에 맞춰 다시 입력해주세요."); history.back();</script>';
} else if (strlen($passwordCheck) == 0) {
    echo '<script>alert("비밀번호 확인을 입력해주세요."); history.back();</script>';
} else if ($password != $passwordCheck) {
    echo '<script>alert("비밀번호가 같지 않습니다."); history.back();</script>';
} else if (strlen($nickname) == 0) {
    echo '<script>alert("닉네임을 입력해주세요."); history.back();</script>';
} else if (mysqli_num_rows($mysqli->query("select * from member where nickname = '$nickname'")) > 0) {
    echo '<script>alert("이미 등록된 닉네임입니다."); history.back();</script>';
} else if (strlen($name) == 0) {
    echo '<script>alert("이름을 입력해주세요."); history.back();</script>';
} else if (strlen($email) == 0) {
    echo '<script>alert("이메일을 입력해주세요."); history.back();</script>';
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo '<script>alert("이메일 형식이 유효하지 않습니다."); history.back();</script>';
} else if (mysqli_num_rows($mysqli->query("select * from member where email = '$email'")) > 0) {
    echo '<script>alert("이미 등록된 이메일입니다."); history.back();</script>';
} else if (strlen($phone) == 0) {
    echo '<script>alert("핸드폰 번호를 입력해주세요."); history.back();</script>';
} else if (mysqli_num_rows($mysqli->query("select * from member where phone_number = '$phone'")) > 0) {
    echo '<script>alert("이미 등록된 핸드폰 번호입니다."); history.back();</script>';
} else {
    $password = md5($password);
    $sql = "insert into member(id, pwd, nickname, name, email, phone_number)";
    $sql = $sql . "values('$id','$password', '$nickname', '$name','$email','$phone')";
    if ($mysqli->query($sql)) {
        echo '<script>alert("회원가입이 완료되었습니다."); location.href="index.php";</script>';
    } else {
        echo 'fail';
    }
}

$mysqli->close();
?>