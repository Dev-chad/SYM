<?php
session_start();
include "db.php";

$postNum = $_POST['postNum'];
$category = $_POST['category'];

if(is_null($postNum) || is_null($category)){
    echo '<script>location.href="error.php";</script>';

}else{
    $query = "select * from contents where idx = '$postNum'";
    $result = $mysqli->query($query);
    $result_arr = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) > 0) {
        if($category == "news"){
            if ($_SESSION['nickname'] == $result_arr['author'] && $_SESSION['type'] == "admin") {
                $query = "delete from contents where idx = $postNum";

                if($result_arr['image'] != ''){
                    $image = $result_arr['image'];
                    unlink($image);
                }

                if($result_arr['thumbnail'] != ''){
                    $thumbnail = $result_arr['thumbnail'];
                    unlink($thumbnail);
                }

                if ($mysqli->query($query)) {
                    echo '<script>alert("게시물이 삭제되었습니다."); location.href="news.php";</script>';
                } else {
                    echo '<script>alert("!!게시물 삭제 오류!! 관리자에게 문의하세요."); location.href="news.php";</script>';
                }
            } else {
                echo '<script>alert("해당 게시물의 작성자가 아닙니다."); location.href="postView.php?category=news&postNum='.$postNum.'";</script>';
            }
        } else if($category == "stage"){
            if($_SESSION['nickname'] == $result_arr['author']){
                $query = "delete from contents where idx = $postNum";

                if($result_arr['video'] != ''){
                    $image = $result_arr['video'];
                    unlink($image);
                }

                if($result_arr['thumbnail'] != ''){
                    $thumbnail = $result_arr['thumbnail'];
                    unlink($thumbnail);
                }

                if ($mysqli->query($query)) {
                    echo '<script>alert("게시물이 삭제되었습니다."); location.href="stage.php";</script>';
                } else {
                    echo '<script>alert("!!게시물 삭제 오류!! 관리자에게 문의하세요."); location.href="stage.php";</script>';
                }
            } else {
                echo '<script>alert("해당 게시물의 작성자가 아닙니다."); location.href="postView.php?category=stage&postNum='.$postNum.'";</script>';
            }
        } else {
            echo '<script>location.href="error.php";</script>';
        }

    } else {
        echo '<script>alert("게시물이 존재하지 않습니다."); location.href="news.php";</script>';
    }
}

$mysqli->close();
?>