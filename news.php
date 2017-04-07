<?php session_start();
include "db.php" ?>
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
            <a href="index.php"><img src="images/sym_logo.png" alt="SYM"/></a>
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
    <div id="pagetitle">
        <h1>News</h1>
        <p>SYM에서 알려드리는 다양한 소식</p>
    </div>
    <?php if ($_SESSION['type'] == "admin") { ?>
        <div id="main" class="clearfix">
            <a href="upload.php?category=news" class="button red" style="float: right">업로드</a>
        </div>
    <?php } ?>
    <div id="main" class="clearfix" style="padding: 0 0 20px 20px">
        <?php
        $result = $mysqli->query("select count(*) from contents where category like 'NEWS%'");
        $totalCount = mysqli_fetch_array($result);

        if ($totalCount[0] > 0) {
            $page = $_GET['page'];
            $viewCount = 10;
            $totalPage = ceil($totalCount[0] / $viewCount);

            if (is_null($page) || $page < 1) {
                $page = 1;
            } else if ($page > $totalPage) {
                $page = $totalPage;
            }

            $start = ($page * $viewCount) - $viewCount;

            $query = "select * from contents where category like 'NEWS%' order by idx DESC limit $start, $viewCount";
            $result = $mysqli->query($query);
            while ($result_arr = mysqli_fetch_array($result)) { ?>

                <h1 style="font-size: 30px"><a
                            href="postView.php?category=news&postNum=<?php echo $result_arr['idx']; ?>"><?php echo $result_arr['title']; ?></a>
                </h1>
                <span class="author-bp">Written by <?php echo $result_arr['author']; ?> </span><span
                        class="date-bp"><?php echo $result_arr['date']; ?></span> <br>

                <hr>
            <?php } ?>
            <div class="clearfix" align="center">
                <?php
                $blockCount = 10;
                $startPage = 0;
                if ($page % $blockCount == 0) {
                    $startPage = ((floor($page / $blockCount) - 1) * $blockCount) + 1;
                } else {
                    $startPage = (floor($page / $blockCount) * $blockCount) + 1;
                }

                $endPage = $startPage + ($blockCount - 1);

                if ($startPage != 1) { ?>
                    <a href="news.php" style="font-weight: bold; font-size: 15px; color: #0f0f0f"> 처음 </a>
                    <a href="news.php?page=<?php echo $startPage-1; ?>" style="font-weight: bold; font-size: 15px; color: #0f0f0f"> << </a>
                <?php }
                for ($j = $startPage; $j <= $endPage && $j <= $totalPage; $j++) {
                    if ($page == $j) { ?>
                        <a style="font-weight: bold; font-size: 15px; color: #0f0f0f"> <?php echo $j; ?> </a>
                    <?php } else { ?>
                        <a href="news.php?page=<?php echo $j; ?>" style="font-size: 15px;"> <?php echo $j; ?> </a>
                    <?php } ?>
                <?php }
                if (($totalPage - $startPage) >= $blockCount) { ?>
                    <a href="news.php?page=<?php echo $endPage+1; ?>" style="font-weight: bold; font-size: 15px; color: #0f0f0f"> >> </a>
                    <a href="news.php?page=<?php echo $totalPage; ?>" style="font-weight: bold; font-size: 15px; color: #0f0f0f"> 맨끝 </a>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p align="center"> 아직 작성된 게시물이 없습니다. </p>
        <?php } ?>
    </div>

    <?php $mysqli->close(); ?>

    <!--&lt;!&ndash;============================= F O O T E R  =======================================&ndash;&gt;
    <footer>
        <div id="widget1">
            <a href="index.php"><img src="images/mini-yourock.png" alt="YouRock" /></a>
        </div>
        <div id="widget2">
            <h1>About us</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at vulputate blandit, magna risus posuere turpis, nec cursus ipsum arcu. magna risus posuere turpis, nec cursus ipsum arcu.</p>
        </div>
        <div id="widget3">
            <h1>From the blog</h1>
            <div id="footerarticle">
                <a href="#"><img src="images/f1.jpg" alt="" /></a>
                <div id="fainfo">
                <a href="#"><h2>Lorem Ipsum Dolor</h2></a>
                <p>January 24, 2014</p>
                </div>
            </div>
            <div id="footerarticle">
                <a href="#"><img src="images/f2.jpg" alt="" /></a>
                <div id="fainfo">
                <a href="#"><h2>Conset tetur Adipi</h2></a>
                <p>January 24, 2014</p>
                </div>
            </div>
            <div id="footerarticle">
                <a href="#"><img src="images/f3.jpg" alt="" /></a>
                <div id="fainfo">
                <a href="#"><h2>Lorem Ipsum Dolor</h2></a>
                <p>January 24, 2014</p>
                </div>
            </div>
            <div id="footerarticle">
                <a href="#"><img src="images/f4.jpg" alt="" /></a>
                <div id="fainfo">
                <a href="#"><h2>Magna risus Posuere</h2></a>
                <p>January 24, 2014</p>
                </div>
            </div>
        </div>
        <div id="widget4">
            <h1>Random Stuff</h1>
            <img src="images/randomstuff.jpg" alt="Random Stuff" />
        </div>
        <div id="copyrights">
            <p>Copyright © 2014 YouRock. All rights reserved.</p>
            <span id="designedby">Designed by <a href="http://allkickass.com">Youssef Nassim</a>
        </div>
    </footer>-->

</div>
</body>
</html>
