<?php include "db.php";
/**
 * Created by PhpStorm.
 * User: Chad
 * Date: 2017-04-04
 * Time: 오전 2:26
 */

$isError = false;

if($_GET['boardName'] == "news"){
    for($i = 1; $i<=500; $i++){
        $time = date("Y-m-d H:i:s", time());
        $title = "NEWS -- $i";
        $desc = "$i 번째 글 입니다.";
        if(!$mysqli->query("insert into contents(title, content_desc, author, date, category) VALUES ('$title', '$desc', 'SYM', '$time', 'NEWS')")){
            $isError = true;
        }
    }
} else if ($_GET['boardName'] == "stage"){
    for($i = 1; $i<=500; $i++){
        $time = date("Y-m-d H:i:s", time());
        $title = "NEWS -- $i";
        $desc = "$i 번째 글 입니다.";
        if(!$mysqli->query("insert into contents(title, content_desc, author, date, category, video, thumbnail) VALUES ('$title', '$desc', 'SYM', '$time', 'stage', '', 'images/stage_default.jpg')")){
            $isError = true;
        }
    }
}


if($isError){
    echo "에러발생";
} else {
    echo "생성완료";
}
?>