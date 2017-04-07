<?php session_start();
include "db.php" ?>
<!DOCTYPE html>
<html lang="ko">
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
    <script src="http://malsup.github.com/jquery.cycle2.js"></script>
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
    <!--========================== L O G O  &   N A V    B A R ============================-->
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

    <!--===================== F E A T U R E D    A R T I C L E ============================-->
    <?php
    $query = "select * from contents where category = 'NEWS-MAIN' ORDER by date desc limit 1";
    $result = $mysqli->query($query);
    $result_arr = mysqli_fetch_array($result);
    $resultCount = mysqli_num_rows($result);
    echo $resultCount;
    if (!is_null($result_arr)) { ?>
        <div id="featured" style="background-image: url(<?php echo $result_arr['image']; ?>); background-size: contain">
            <a href="postView.php?post=<?php echo $result_arr['idx']; ?>">
                <div id="featuredinfo">
                    <h1><?php echo $result_arr['title']; ?></h1>
                    <p><?php echo $result_arr['content_desc']; ?></p>
                </div>
            </a>
        </div>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php for ($count = 0; $count < $resultCount; $count++) {
                    if ($count == 0) { ?>
                        <li data-target="#myCarousel" data-slide-to=<?php echo $count ?> class="active"></li>
                    <?php } else { ?>
                        <li data-target="#myCarousel" data-slide-to=<?php echo $count ?>></li>
                    <?php } ?>
                <?php } ?>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php $count = 0;
                while ($result_arr = mysqli_fetch_array($result)) {
                    if ($count == 0) { ?>
                        <div class="item active">
                            <img src="<?php echo $result_arr['image']?>" alt="Chania">
                        </div>
                    <?php } else { ?>
                        <div class="item">
                            <img src="<?php echo $result_arr['image']?>" alt="Chania">
                        </div>
                    <?php }
                } ?>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    <?php } ?>


    <!--======================= I N T R O D U C T I O N  ==================================-->
    <!--<div id="intromessage">
        <p>SYM에 오신걸 환영합니다. 자신의 영상을 올려 다른 뮤지션들과 소통하고 더 나아가 음악적 성공의 꿈을 이뤄보세요.</p>
    </div>-->

    <!--========================== A R T I C L E S  =======================================-->
    <div id="main" class="clearfix"><h3 style="color: #777; ">Weekly Top 4</h3></div>
    <div id="articles" class="clearfix">
        <article>
            <a href="#"><img src="images/naul.jpg" style="width: 220px; height: 110px" alt=""/></a>
            <h1>나얼</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at vulputate blandit, magna
                risus posuere turpis, nec cursus ipsum arcu.</p>
            <a href="#" class="rm">Read More</a>
        </article>
        <article>
            <a href="#"><img src="images/parkhyoshin.jpg" style="width: 220px; height: 110px" alt=""/></a>
            <h1>박효신</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at vulputate blandit, magna
                risus posuere turpis, nec cursus ipsum arcu.</p>
            <a href="#" class="rm">Read More</a>
        </article>
        <article>
            <a href="#"><img src="images/junghyun.jpg" style="width: 220px; height: 110px" alt=""/></a>
            <h1>박정현</h1>
            <p>Tempor ac ullamcorper et, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at
                vulputate blandit, magna risus posuere.</p>
            <a href="#" class="rm">Read More</a>
        </article>
        <article id="lastarticle">
            <a href="#"><img src="images/bruno.jpg" style="width: 220px; height: 110px" alt=""/></a>
            <h1>브루노 마스</h1>
            <p>Tempor ac ullamcorper et, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at
                vulputate blandit, magna risus posuere.</p>
            <a href="#" class="rm">Read More</a>
        </article>
    </div>

    <div id="main" class="clearfix"><h3 style="color: #777; ">New Stage</h3></div>
    <div id="articles" class="clearfix">
        <article>
            <a href="#"><img src="images/1.jpg" alt=""/></a>
            <h1>Web Development</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at vulputate blandit, magna
                risus posuere turpis, nec cursus ipsum arcu.</p>
            <a href="#" class="rm">Read More</a>
        </article>
        <article>
            <a href="#"><img src="images/2.jpg" alt=""/></a>
            <h1>Design Service</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at vulputate blandit, magna
                risus posuere turpis, nec cursus ipsum arcu.</p>
            <a href="#" class="rm">Read More</a>
        </article>
        <article>
            <a href="#"><img src="images/3.jpg" alt=""/></a>
            <h1>Products</h1>
            <p>Tempor ac ullamcorper et, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at
                vulputate blandit, magna risus posuere.</p>
            <a href="#" class="rm">Read More</a>
        </article>
        <article id="lastarticle">
            <a href="#"><img src="images/4.jpg" alt=""/></a>
            <h1>Consultation</h1>
            <p>Tempor ac ullamcorper et, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at
                vulputate blandit, magna risus posuere.</p>
            <a href="#" class="rm">Read More</a>
        </article>
    </div>

    <!--============================= F O O T E R  =======================================-->
    <!--<footer>
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

</div>

<!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
<!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
</body>
</html>