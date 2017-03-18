<?php
    include "db.php";

    $postNum = $_POST['postNum'];

    $query = "delete from contents where idx = $postNum";
    $result = $mysqli->query($query);

    if($result){
        echo '<script>alert("게시물이 삭제되었습니다."); location.href="news.php";</script>';
        $mysqli->close();
    }
?>