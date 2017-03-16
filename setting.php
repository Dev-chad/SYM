<?php session_start(); ?>
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

    <script>
        $(function () {
            $('a').each(function () {
                if ($(this).prop('href') == window.location.href) {
                    $(this).addClass('current');
                }
            });
        });

        function submit(){
            $("#joinForm").submit();
        }

    </script>
</head>
<body>

<div id="wrapper">
    <!--========================== L O G O  &   N A V    B A R ============================-->
    <div id="top">
        <div style="float: right;">
            <?php if (!isset($_SESSION["id"]) || !isset($_SESSION["pwd"])) { ?>
                <script> location.href="index.php"</script>
            <?php } else { ?>
                <a class="button red" href="logout.php">로그아웃</a>
            <?php } ?>
        </div>
    </div>



    <header>
        <div id="logo">
            <a href="index.php"><img src="images/sym_logo.png" alt="YouRock"/></a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="blog.html">News</a></li>
                <li><a href="portfolio.html">Stage</a></li>
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

    <div class="col-md-12">
        <div class="page-header">
            <h1>SETTING <small>회원 정보 변경</small></h1>
        </div>
        <form class="form-horizontal" name="joinForm" method="POST">
            <div id="main" class="clearfix"><h3 style="color: #777; ">비밀번호 변경</h3></div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputCurrentPassword">기존 비밀번호</label>
                <div class="col-sm-6">
                    <input class="form-control" id="inputCurrentPassword" type="password" name="pwd">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputPassword">새 비밀번호</label>
                <div class="col-sm-6">
                    <input class="form-control" id="inputPassword" type="password" name="pwd">
                    <p class="help-block">숫자, 특수문자 포함 8자 이상</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputPasswordCheck">새 비밀번호 확인</label>
                <div class="col-sm-6">
                    <input class="form-control" id="inputPasswordCheck" type="password" name="repwd">
                    <p class="help-block">비밀번호를 한번 더 입력해주세요.</p>
                </div>
            </div>

            <div id="main" class="clearfix" style="margin-top: 20px"><h3 style="color: #777; ">기본 정보 변경</h3></div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputNickName">닉네임</label>
                <div class="col-sm-6">
                    <input class="form-control" id="inputNickName" type="text" name="nickname">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputEmail">이메일</label>
                <div class="col-sm-6">
                    <input class="form-control" id="inputEmail" type="email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputNumber">휴대폰번호</label>
                <div class="col-sm-6">
                    <div class="input-group">
                        <input type="tel" class="form-control" id="inputNumber" placeholder="- 없이 입력해 주세요" name="phone"/>
                        <span class="input-group-btn">
                  </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-primary" type="submit">정보변경 완료</button>
                </div>
            </div>
        </form>
        <hr>
    </div>

</div>

<!-- jQuery (부트스트랩의 자바스크립트 플러그인을 위해 필요합니다) -->
<!-- 모든 컴파일된 플러그인을 포함합니다 (아래), 원하지 않는다면 필요한 각각의 파일을 포함하세요 -->
</body>
</html>
