<?php
//setcookie("test", "123", strtotime(date("Ymd", strtotime("+1 day"))));

$boardType = array("stage","news");

// 아래 게시판 이름과 페이지 인덱스는 테스트를 위해 임의로 넣은값
$boardName = 'screen'; //현재 게시판 이름
$view_index = 5;    //페이지 읽을 인덱스

/* 현재 게시판의 index 값 */
$boardIndex = array_Index($boardType,$boardName);
if(!$boardIndex) $boardIndex = 0;

// 쿠키값 (실제 기존에 저장되어있던 쿠키를 가져온다 처음에는 없겠지만)
$boardCookie = unserialize(stripslashes($_COOKIE['boardCookie']));

$board_arr    = explode(',',$boardCookie[$boardIndex]);

//현재 읽으려는 view 인덱스 값이 해당 게시판 배열에 있는지 검사
if(!in_array($view_index, $board_arr)){
    //조회수 올리고 쿠키에 해당 index번호 추가
    echo '<br>조회수up<br>';
    setBoardCookie();
}else{
    echo '<br>그냥 출력';

}

echo $_COOKIE['boardCookie'];
echo '<br>';

print_r($boardCookie);

/* 쿠키 셋 */
function setBoardCookie(){
    GLOBAL $boardCookie;
    GLOBAL $view_index;
    GLOBAL $boardIndex;

    if($boardCookie[$boardIndex]){
        $value = $boardCookie[$boardIndex].','.$view_index;
    }else{
        $value = $view_index;
    }
    $boardCookie[$boardIndex] = $value;

    $cookieSet = serialize($boardCookie);
    setcookie("boardCookie", get_magic_quotes_gpc() ? $cookieSet : addslashes($cookieSet) , time()+20);
    //setcookie("boardCookie", get_magic_quotes_gpc() ? $cookieSet : addslashes($cookieSet) ,strtotime(date("Ymd", strtotime("+1 day"))));

}
/* 배열 인덱스 번호 */
function array_Index($array,$search){
    for($i=0; $i<count($array); $i++){
        if($array[$i]==$search)    return $i;
    }
}


?>