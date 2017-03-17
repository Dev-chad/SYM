<?php session_start();
include "db.php";

$id = $_POST['id'];
$pwd = md5($_POST['pwd']);

$getID = "select id from member where id='$id'";
$getID = $mysqli->query($getID);
$getID = mysqli_fetch_array($getID);

if ($getID['id']) {
    $getPWD = "select pwd, nickname, type from member where id='$id'";
    $getPWD = $mysqli->query($getPWD);
    $getPWD = mysqli_fetch_array($getPWD);
    
    if($pwd == $getPWD['pwd']){
        $_SESSION["id"] = $id;
        $_SESSION["pwd"] = $pwd;
        $_SESSION["nickname"] = $getPWD['nickname'];
        $_SESSION["type"] = $getPWD['type'];
        echo '<script>alert("로그인 성공 "); history.back();</script>';
    }else {
        echo '<script>alert("로그인 실패"); history.back();</script>';
    }
} else {
    echo '<script>alert("로그인 실패"); history.back();</script>';
}
?>