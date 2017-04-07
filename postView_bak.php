<?php session_start();
include "db.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset=UTF-8"/>
    <!-- 위 3개의 메타 태그는 *반드시* head 태그의 처음에 와야합니다; 어떤 다른 콘텐츠들은 반드시 이 태그들 *다음에* 와야 합니다 -->
    <title>SYM | Show Your Music</title>

    <!-- 부트스트랩 -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
    <link href="main.css" rel="stylesheet" type="text/css" media="screen, projection">
    <style>
        hr {
            border-top: 1px solid #9C9C9C;
            border-bottom: 1px solid #F6F6F6;
        }
    </style>
    <!-- IE8 에서 HTML5 요소와 미디어 쿼리를 위한 HTML5 shim 와 Respond.js -->
    <!-- WARNING: Respond.js 는 당신이 file:// 을 통해 페이지를 볼 때는 동작하지 않습니다. -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
        $(function () {
            $('a').each(function () {
                if ($(this).prop('href') == window.location.href) {
                    $(this).addClass('current');
                }
            });
        });

        function go() {
            var replyForm = document.getElementsBy("replyForm");
            replyForm.submit();
        }

        function page_move(s_page, s_name, s_value) {
            var f = document.;  //폼 name
            f.s_name.value = s_name;  //POST방식으로 넘기고 싶은 값
            f.s_value.value = s_value;  //POST방식으로 넘기고 싶은 값
            f.action = "XXXXXXX.php";  //이동할 페이지
            f.method = "post";  //POST방식
            f.submit();
        }

        function page_move(s_page,s_name,s_value){
            var f=document.paging; //폼 name
            f.page.value = s_page; //POST방식으로 넘기고 싶은 값
            f.src_name.value = s_name; //POST방식으로 넘기고 싶은 값
            f.src_value.value = s_value;//POST방식으로 넘기고 싶은 값
            f.action="test_form.php";//이동할 페이지
            f.method="post";//POST방식
            f.submit();
        }



    </script>
</head>
<body>
<div id="wrapper">
    <div id="top">
        <div style="float: right;">
            <?php if (!isset($_SESSION["id"]) || !isset($_SESSION["pwd"])) { ?>
                <a class="button blue" href="#" data-toggle="modal" data-target="#login-modal">로그인</a>
                <div class="modal modal-center fade" id="login-modal" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-center">
                        <div class="loginmodal-container">
                            <h1>Login to Your Account</h1><br>
                            <form action="login.php" method="post">
                                <input type="text" name="id" placeholder="아이디">
                                <input type="password" name="pwd" placeholder="비밀번호">
                                <input type="submit" name="login" class="login loginmodal-submit" value="Login">
                            </form>

                            <div class="login-help">
                                <a href="join.php">회원가입</a> - <a href="#">계정 찾기</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>

                <div class="dropdown">
                    <a href="#" class="button green dropdown-toggle"
                       data-toggle="dropdown"><?php echo $_SESSION["nickname"]; ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="setting.php">Setting</a></li>
                        <?php if ($_SESSION["type"] == "admin") { ?>
                            <li><a href="#">Admin Page</a></li>
                        <?php } ?>
                        <li><a href="logout.php">Logout</a></li>

                    </ul>
                </div>

            <?php } ?>
        </div>
    </div>
    <!--========================== L O G O  &   N A V    B A R ============================-->
    <header>
        <div id="logo">
            <a href="index.php"><img src="images/sym_logo.png" alt="YouRock"/></a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="stage.php">Stage</a></li>
                <li><a href="#" class="dropdown">Simple Codes</a>
                    <ul>
                        <li><a href="elements.html">Base Elements & Tables</a></li>
                        <li><a href="buttons.html">Buttons & Alerts</a></li>
                    </ul>
                </li>
                <li><a href="#" class="dropdown">Pages</a>
                    <ul>
                        <li><a href="full-width.html">Full Width</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="404.html">404</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!--========================== M A I N   C O N T E N T =============================-->
    <!--Here goes the page title and tag line-->

    <?php
    $category = $_GET['category'];
    $postNum = $_GET['postNum'];

    $query = "select * from contents where idx='$postNum'";
    $result = $mysqli->query($query);
    $result_arr = mysqli_fetch_array($result);

    if ($category == "news") {
    if (!is_null($result_arr)) {
    if ($_SESSION['type'] == "admin") { ?>
        <div style="float: right;">
            <form action="upload.php" method="get" style="display: inline">
                <input type="hidden" name="category" value="news">
                <input type=hidden name="postNum" value='<? echo $postNum; ?>'>
                <button type="submit" class="btn blue" style="margin: 5px">수정</button>
            </form>

            <form action="content_remove.php" method="post" style="display: inline">
                <input type="hidden" name="category" value="news">
                <input type=hidden name=postNum value='<? echo $postNum; ?>'>
                <button type="submit" class="btn red" style="margin: 5px">삭제</button>
            </form>
        </div>

    <?php } ?>
        <div id="pagetitle">
            <h1>NEWS</h1>
            <p>SYM에서 알려드리는 다양한 소식</p>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-white post">
                <div class="post-heading">
                    <p>
                    <h1 style="font-weight: bold; margin-left: 75px"><?php echo $result_arr['title']; ?></h1></p>

                    <div class="pull-left image">
                        <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar"
                             alt="user profile image">
                    </div>

                    <div class="pull-left meta">
                        <div class="title h5">
                            <a href="#"><b><?php echo $result_arr['author']; ?></b></a>
                        </div>
                        <span class="date-bp" style="margin-top: 5px"><?php echo $result_arr['date']; ?></span>
                    </div>
                </div>
                <br>
                <div class="post-description">
                    <?php if (!is_null($result_arr['image'])) { ?>
                        <p align="center">
                            <img src="<?php echo $result_arr['image']; ?>">
                        </p>
                        <?php
                    } ?>
                    <br>
                    <p><?php echo nl2br($result_arr['content_desc']); ?></p>
                </div>
            </div>
        </div>

    <?php }
    } else if ($category == "stage") { ?>
        <div id="pagetitle">
            <h1>Stage</h1>
            <p>여러분의 끼와 가능성을 마음껏 표출하세요</p>
        </div>

        <?php if ($result_arr['author'] == $_SESSION['nickname']) { ?>
        <div align="right" style="margin-right: 15px">
            <form action="upload.php" method="get" style="display: inline">
                <input type="hidden" name="category" value="stage">
                <input type=hidden name="postNum" value='<? echo $postNum; ?>'>
                <button type="submit" class="btn blue" style="margin: 5px">수정</button>
            </form>

            <form action="content_remove.php" method="post" style="display: inline">
                <input type="hidden" name="category" value="stage">
                <input type=hidden name=postNum value='<? echo $postNum; ?>'>
                <button type="submit" class="btn red" style="margin: 5px">삭제</button>
            </form>
        </div>
    <?php } ?>
        <div class="col-sm-12">
            <div class="panel panel-white post">

                <div class="post-heading">
                    <p>
                    <h1 style="font-weight: bold; margin-left: 75px"><?php echo $result_arr['title']; ?></h1></p>

                    <div class="pull-left image">
                        <img src="http://bootdey.com/img/Content/user_1.jpg" class="img-circle avatar"
                             alt="user profile image">
                    </div>

                    <div class="pull-left meta">
                        <div class="title h5">
                            <a href="#"><b><?php echo $result_arr['author']; ?></b></a>
                        </div>
                        <span class="date-bp" style="margin-top: 5px"><?php echo $result_arr['date']; ?></span>
                    </div>
                </div>
                <br>
                <div class="post-description">
                    <p align="center">
                        <br>
                        <video width="700px" height="400px" src="<?php echo $result_arr['video'] ?>" controls
                               style="background-color: #0f0f0f">이 브라우저는 재생할 수 없습니다.
                        </video>
                    </p>
                    <br>
                    <p><?php echo $result_arr['content_desc']; ?></p>
                </div>
                <div class="stats" style="margin-right: 200px">
                    <a href="#" class="btn btn-default stat-item">
                        <i class="glyphicon glyphicon-thumbs-up"
                           style="margin-right: 5px"></i><?php echo $result_arr['hit_count']; ?>
                    </a>
                    <a href="#" class="btn btn-default stat-item">
                        <i class="glyphicon glyphicon-thumbs-down"
                           style="margin-right: 5px"></i><?php echo $result_arr['report_count']; ?>
                    </a>
                </div>

                <div class="post-footer">

                    <?php if (isset($_SESSION['id'])) { ?>
                    <form action="test.php" name="replyForm" method="post">
                        <div class="input-group">
                            <input class="form-control" name="reply" placeholder="댓글 작성..." type="text">
                            <input type="hidden" name="postNum" value="<?php echo $postNum;?>">
                            <span class="input-group-addon"><a href="javascript:replyForm.submit();"><i
                                            class="glyphicon glyphicon-pencil"></i></a></span>
                        </div>
                    </form>
                    <?php } else { ?>
                        <div class="input-group">
                            <input class="form-control" placeholder="로그인을 해야 댓글 작성이 가능합니다." type="text" readonly>
                            <span class="input-group-addon">
                        <a href="#"><i class="glyphicon glyphicon-pencil"></i></a>
                    </span>
                        </div>
                    <?php } ?>

                    <!--<ul class="comments-list">
                        <li class="comment">
                            <a class="pull-left" href="#">
                                <img class="avatar" src="http://bootdey.com/img/Content/user_1.jpg" alt="avatar">
                            </a>
                            <div class="comment-body">
                                <div class="comment-heading">
                                    <h4 class="user">Gavino Free</h4>
                                    <h5 class="time">5 minutes ago</h5>
                                </div>
                                <p>Sure, oooooooooooooooohhhhhhhhhhhhhhhh</p>
                            </div>
                            <ul class="comments-list">
                                <li class="comment">
                                    <a class="pull-left" href="#">
                                        <img class="avatar" src="http://bootdey.com/img/Content/user_3.jpg"
                                             alt="avatar">
                                    </a>
                                    <div class="comment-body">
                                        <div class="comment-heading">
                                            <h4 class="user">Ryan Haywood</h4>
                                            <h5 class="time">3 minutes ago</h5>
                                        </div>
                                        <p>Relax my friend</p>
                                    </div>
                                </li>
                                <li class="comment">
                                    <a class="pull-left" href="#">
                                        <img class="avatar" src="http://bootdey.com/img/Content/user_2.jpg"
                                             alt="avatar">
                                    </a>
                                    <div class="comment-body">
                                        <div class="comment-heading">
                                            <h4 class="user">Gavino Free</h4>
                                            <h5 class="time">3 minutes ago</h5>
                                        </div>
                                        <p>Ok, cool.</p>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>-->
                </div>
            </div>
        </div>
    <?php } else if ($category == "singer") { ?>

    <?php } else { ?>
        echo '
        <script>location.href = "error.php";</script>';
    <?php } ?>

    <!--&lt;!&ndash;============================= F O O T E R  =======================================&ndash;&gt;
    <footer>
        <div id="widget1">
            <a href="index.html"><img src="images/mini-yourock.png" alt="YouRock"/></a>
        </div>
        <div id="widget2">
            <h1>About us</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at vulputate blandit, magna
                risus posuere turpis, nec cursus ipsum arcu. magna risus posuere turpis, nec cursus ipsum arcu.</p>
        </div>
        <div id="widget3">
            <h1>From the blog</h1>
            <div id="footerarticle">
                <a href="#"><img src="images/f1.jpg" alt=""/></a>
                <div id="fainfo">
                    <a href="#"><h2>Lorem Ipsum Dolor</h2></a>
                    <p>January 24, 2014</p>
                </div>
            </div>
            <div id="footerarticle">
                <a href="#"><img src="images/f2.jpg" alt=""/></a>
                <div id="fainfo">
                    <a href="#"><h2>Conset tetur Adipi</h2></a>
                    <p>January 24, 2014</p>
                </div>
            </div>
            <div id="footerarticle">
                <a href="#"><img src="images/f3.jpg" alt=""/></a>
                <div id="fainfo">
                    <a href="#"><h2>Lorem Ipsum Dolor</h2></a>
                    <p>January 24, 2014</p>
                </div>
            </div>
            <div id="footerarticle">
                <a href="#"><img src="images/f4.jpg" alt=""/></a>
                <div id="fainfo">
                    <a href="#"><h2>Magna risus Posuere</h2></a>
                    <p>January 24, 2014</p>
                </div>
            </div>
        </div>
        <div id="widget4">
            <h1>Random Stuff</h1>
            <img src="images/randomstuff.jpg" alt="Random Stuff"/>
        </div>
        <div id="copyrights">
            <p>Copyright © 2014 YouRock. All rights reserved.</p>
            <span id="designedby">Designed by <a href="http://allkickass.com">Youssef Nassim</a>
        </div>
    </footer>-->

</body>
</html>
