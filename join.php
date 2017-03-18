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
            var isCheckID = false;
            var isSamePwd = false;

            $('a').each(function () {
                if ($(this).prop('href') == window.location.href) {
                    $(this).addClass('current');
                }
            });

            $("#inputId").change(function () {
                isCheckID  = false;
                $("#dupleCheck").text('중복확인');
                $("#dupleCheck").attr('class','button blue');
            });

            $("#dupleCheck").click(function () {
                if(isCheckID){
                    alert("이미 중복확인을 완료 하였습니다.");
                } else {
                    if($("#inputId").val().length > 0){
                        isCheckID = true;
                        $(this).text('확인완료');
                        $(this).attr('class','button green');
                    } else {
                        &
                    }
                }
            });

            $(window).on("beforeunload", function () {
                if (isCheckID) {
                    return "이 페이지를 벗어나면 작성된 내용은 저장되지 않습니다.";
                }
            });

            $("#join").click(function () {
                isCheckID = false;

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
    <div id="pagetitle">
        <h1>회원가입</h1>
        <p>SYM에 가입하여 여러분의 무대를 가져보세요</p>
    </div>
    <div class="col-md-12">

        <form id="joinForm" class="form-horizontal" name="joinForm" action="joinUser.php" method="POST">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputId">아이디</label>
                <div class="col-sm-6">
                    <input class="form-control" id="inputId" type="text" name="id">
                    <input type="hidden" name="checkID" value="use">
                    <p id="inputIdMessage" class="help-block">비밀번호를 한번 더 입력해주세요.</p>
                </div>
                <a id="dupleCheck" href="#" class="button blue" style="margin-left: 5px; margin-top: 6px">중복확인</a>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputPassword">비밀번호</label>
                <div class="col-sm-6">
                    <input class="form-control" id="inputPassword" type="password" name="pwd" placeholder="숫자, 특수문자 포함 8자 이상">
                    <p class="help-block">숫자, 특수문자 포함 8자 이상</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputPasswordCheck">비밀번호 확인</label>
                <div class="col-sm-6">
                    <input class="form-control" id="inputPasswordCheck" type="password" name="pwdCheck" placeholder="비밀번호를 한번 더 입력해주세요.">
                    <p class="help-block">비밀번호를 한번 더 입력해주세요.</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputNickName">닉네임</label>
                <div class="col-sm-6">
                    <input class="form-control" id="inputNickName" type="text" name="nickname">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputName">이름</label>
                <div class="col-sm-6">
                    <input class="form-control" id="inputName" type="text" name="name">
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
                        <input type="tel" class="form-control" id="inputNumber" placeholder="- 없이 입력해 주세요"
                               name="phone"/>
                        <span class="input-group-btn">
                  </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 text-center">
                    <a id="join" class="btn btn-primary">회원가입</a>
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
