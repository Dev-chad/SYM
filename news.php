<?php session_start(); ?>
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
                <a class="button red" href="logout.php">로그아웃</a>

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
    <div id="main" class="clearfix">
        <div id="content"><!--Here goes the articles-->
            <article>
                <div class="post-image">
                    <img src="images/audition_jyp.jpg" alt=""/>
                    <a href="news-post.php?post=1" class="post-info">

                        <h1 class="post-title">JYP 오디션 개막</h1>
                        <span class="author">Written by SYM</span><span class="date">March 9,2017</span><span
                                class="comments">7 Comments</span>
                    </a>
                </div>
                <p></p>
                <a class="readmore" href="news-post.php?post=1">Read more</a>
            </article>

            <article>
                <div class="post-image">
                    <img src="images/audition_yg.jpg" alt=""/>
                    <a href="news-post.php?post=2" class="post-info">
                        <h1 class="post-title">YG 오디션 개막</h1>
                        <span class="author">Written by SYM</span><span class="date">March 9,2017</span><span
                                class="comments">7 Comments</span>
                    </a>
                </div>
                <p></p>
                <a class="readmore" href="news-post.php?post=2">Read more</a>
            </article>
            <!--<article>
                <div class="post-image">
                    <img src="images/post2.jpg" alt=""/>
                    <a href="news-post.php" class="post-info">
                        <h1 class="post-title">The Nice Post title goes right here</h1>
                        <span class="author">Written by Admin</span><span class="date">January 26,2009</span><span
                            class="comments">7 Comments</span>
                    </a>
                </div>
                <p>Proin tincidunt, velit vel porta elementum, magna diam molestie sapien, non aliquet massa pede eu
                    diam. Aliquam iaculis. Proin tincidunt, velit vel porta elementum, magna diam molestie sapien, non
                    aliquet massa pede eu diam. Aliquam iaculis. Proin tincidunt, velit vel porta elementum, magna diam
                    molestie sapien. Proin tincidunt, velit vel porta elementum, magna diam molestie sapien, non aliquet
                    massa pede eu diam. Aliquam iaculis.</p>
                <a class="readmore" href="news-post.php">Read more</a>
            </article>
            <article>
                <div class="post-image">
                    <img src="images/post3.jpg" alt=""/>
                    <a href="news-post.php" class="post-info">
                        <h1 class="post-title">The Beautiful Post title goes right here</h1>
                        <span class="author">Written by Admin</span><span class="date">January 26,2009</span><span
                            class="comments">7 Comments</span>
                    </a>
                </div>
                <p>Proin tincidunt, velit vel porta elementum, magna diam molestie sapien, non aliquet massa pede eu
                    diam. Aliquam iaculis. Proin tincidunt, velit vel porta elementum, magna diam molestie sapien, non
                    aliquet massa pede eu diam. Aliquam iaculis. Proin tincidunt, velit vel porta elementum, magna diam
                    molestie sapien. Proin tincidunt, velit vel porta elementum, magna diam molestie sapien, non aliquet
                    massa pede eu diam. Aliquam iaculis.</p>
                <a class="readmore" href="news-post.php">Read more</a>
            </article>-->
        </div>

        <!--<div id="sidebar">&lt;!&ndash;Here goes the sidebar items&ndash;&gt;
            <div class="sidebar_item categories clearfix">
                <h5>Categories</h5>
                <ul>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Personal</a></li>
                    <li><a href="#">Photography</a></li>
                    <li><a href="#">Health</a></li>
                    <li><a href="#">Fashion</a></li>
                </ul>
                <ul>
                    <li><a href="#">General</a></li>
                    <li><a href="#">Tutorials</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Random Stuffs</a></li>
                </ul>
            </div>
            <div class="sidebar_item">
                <h5>Custom text</h5>
                <p>velit vel porta elementum, magna diam molestie sapien. Proin tincidunt, velit vel porta elementum,
                    magna diam molestie sapien, non aliquet massa pede eu diam.</p>
            </div>
            <div class="sidebar_item">
                <h5>Archives</h5>
                <ul>
                    <li><a href="#">June 2012</a></li>
                    <li><a href="#">May 2012</a></li>
                    <li><a href="#">April 2012</a></li>
                    <li><a href="#">Mars 2012</a></li>
                    <li><a href="#">February 2012</a></li>
                </ul>
            </div>
        </div>-->
    </div>

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
