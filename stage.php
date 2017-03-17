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
                        <a href="#" class="button green dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION["nickname"];?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="setting.php">Setting</a></li>
                            <?php if ($_SESSION["type"] == "admin"){ ?>
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
			<h1>Stage</h1>
			<p>여러분의 끼와 가능성을 마음껏 표출하세요</p>
		</div>
        <div class="container" style="width: 940px; height: 50px">
            <div class="row" >
                <div class="col-sm-6 col-sm-offset-3" style="height: 50px">
                    <div id="imaginary_container" align="top">
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control"  placeholder="Search" >
                            <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div id="main" class="portfolio clearfix">
			<article>
				<a href="#"><img src="images/p1.jpg" alt="img" /></a>
				<h1>Title Here</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at vulputate blandit, magna risus posuere turpis, nec cursus ipsum arcu.</p>
				<span class="author-bp">Written by SYM</span><span class="date-bp">March 9,2017</span><span
					class="comments-bp">7 Comments</span>
				<a href="#" class="rm">Read More</a>
			</article>
			<article>
				<a href="#"><img src="images/p2.jpg" alt="img" /></a>
				<h1>Title Here</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at vulputate blandit, magna risus posuere turpis, nec cursus ipsum arcu.</p>
				<span class="author-bp">Written by SYM</span><span class="date-bp">March 9,2017</span><span
					class="comments-bp">7 Comments</span>
				<a href="#" class="rm">Read More</a>
			</article>
			<article class="last-article">
				<a href="#"><img src="images/p3.jpg" alt="img" /></a>
				<h1>Title Here</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor, tortor at vulputate blandit, magna risus posuere turpis, nec cursus ipsum arcu.</p>
				<span class="author-bp">Written by SYM</span><span class="date-bp">March 9,2017</span><span
					class="comments-bp">7 Comments</span>
				<a href="#" class="rm">Read More</a>
			</article>
		</div><!--End of Main-->

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
