<?php session_start();
include "db.php"; ?>
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
            $(window).bind("pageshow", function () {
                if ($("#checkMain").is(":checked")) {
                    $("input[name=type]").attr("value", "main");
                    $('#thumbnailForm').css('display', 'block');
                    $("#thumbnail").val("");
                }

                $("#imageFile").val("");
            });


            $('a').each(function () {
                if ($(this).prop('href') == window.location.href) {
                    $(this).addClass('current');
                }
            });

            $('#checkMain').click(function () {
                var checked = $(this).is(":checked");
                if (checked) {
                    $("input[name=type]").attr("value", "main");
                    $('#thumbnailForm').css('display', 'block');
                } else {
                    $("input[name=type]").attr("value", "");
                    $('#thumbnailForm').css('display', 'none');
                    $("#thumbnail").val("");
                    $("#thumbnailView").css("display", "none");
                }
            });

            $("#imageFile").on('change', function () {
                $('#imageView').css('display', 'block');
                $("input[name=imageChangedCheck]").attr("value", "changed");
                readURL(this, $('#imageView'));
            });

            $("#thumbnail").on('change', function () {
                $('#thumbnailView').css('display', 'block');
                $("input[name=thumbnailChangedCheck]").attr("value", "changed");
                readURL(this, $('#thumbnailView'));
            });

            $("#videoFile").on('change', function () {
                $('#videoView').css('display', 'block');
                $("input[name=videoChangedCheck]").attr("value", "changed");
//                $("input[name=thumbnailChangedCheck]").attr("value", "changed");
                readURL(this, $('#videoView'));
            });

        });

        function readURL(input, imgView) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    imgView.attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                imgView.css('display', 'none');
            }
        }
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
    <?php
    if (isset($_SESSION['id'])) {
    $category = $_GET['category'];
    $editCheck = $_GET['postNum'];
    if ($category == "news") {
        if ($_SESSION['type'] == "admin") {
            if (!isset($_GET['postNum'])) {
                ?>
                <div id="pagetitle">
                    <h1>Upload</h1>
                    <p>게시글 작성</p>
                </div>

                <div style="padding : 30px;">
                    <form method="POST" action="content_upload.php" enctype="multipart/form-data">
                        <input type="hidden" name="category" value="news">
                        <div class="form-group">
                            <label>제목</label>
                            <input type="text" name="title" class="form-control">
                            <input type="hidden" name="type" value="">
                        </div>
                        <div class="form-group">
                            <label>이미지</label>
                            <img id="imageView" src="#" alt="your image" style="display: none"/>
                            <input type='file' accept="image/*" name="imageFile" id="imageFile">
                        </div>
                        <div class="form-group">
                            <label>내용</label>
                            <textarea name="desc" class="form-control" rows="5"></textarea>
                        </div>
                        <div id="thumbnailForm" class="form-group" style="display: none">
                            <label>썸네일</label>
                            <img id="thumbnailView" src="#" alt="your image" style="display: none"/>
                            <input type='file' accept="image/*" name="thumbnail" id="thumbnail">
                        </div>

                        <div class="checkbox">
                            <label>
                                <input id="checkMain" type="checkbox" value="">이 게시물을 메인에 표시합니다.
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default" name="submit">작성</button>
                    </form>
                </div>
            <?php } else {
                $postNum = $_GET['postNum'];
                $query = "select * from contents where idx=$postNum";
                $result = $mysqli->query($query);
                if (mysqli_num_rows($result) > 0) {
                    $result_arr = mysqli_fetch_array($result);
                    if ($_SESSION['nickname'] == $result_arr['author']) {
                        ?>
                        <div id="pagetitle">
                            <h1>Upload</h1>
                            <p>게시글 수정</p>
                        </div>

                        <div style="padding : 30px;">
                            <form method="POST" action="content_upload.php" enctype="multipart/form-data">
                                <input type="hidden" name="category" value="news">
                                <input type="hidden" name="imageChangedCheck">
                                <input type="hidden" name="thumbnailChangedCheck">
                                <input type="hidden" name="editCheck" value="edit">
                                <input type="hidden" name="postNum" value="<?php echo $postNum; ?>">
                                <div class="form-group">
                                    <label>제목</label>
                                    <input type="text" name="title" class="form-control"
                                           value="<?php echo $result_arr['title']; ?>">
                                    <?php if ($result_arr['category'] == "NEWS-MAIN") { ?>
                                        <input type="hidden" name="type" value="main">
                                    <?php } else { ?>
                                        <input type="hidden" name="type" value="">
                                        <?php
                                    } ?>
                                </div>
                                <div class="form-group">
                                    <label>이미지</label>
                                    <?php if ($result_arr['image'] != '') { ?>
                                        <img id="imageView" src="<?php echo $result_arr['image']; ?>"/>
                                    <?php } else { ?>
                                        <img id="imageView" src="#" alt="your image" style="display: none"/>
                                        <?php
                                    } ?>
                                    <input type='file' accept="image/*" name="imageFile" id="imageFile">
                                </div>
                                <div class="form-group">
                                    <label>내용</label>
                                    <?php if ($result_arr['content_desc'] != '') { ?>
                                        <textarea name="desc" class="form-control"
                                                  rows="5"><?php echo $result_arr['content_desc']; ?></textarea>
                                    <?php } else { ?>
                                        <textarea name="desc" class="form-control" rows="5"></textarea>
                                        <?php
                                    } ?>
                                </div>
                                <?php if ($result_arr['category'] == "NEWS-MAIN") { ?>
                                    <div id="thumbnailForm" class="form-group" style="display: none">
                                        <label>썸네일</label>
                                        <img id="thumbnailView" src="<?php echo $result_arr['thumbnail']; ?>"
                                             alt="your image"/>
                                        <input type='file' accept="image/*" name="thumbnail" id="thumbnail">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input id="checkMain" type="checkbox" value="" checked="checked">이 게시물을
                                            메인에
                                            표시합니다.
                                        </label>
                                    </div>
                                <?php } else { ?>
                                    <div id="thumbnailForm" class="form-group" style="display: none">
                                        <label>썸네일</label>
                                        <img id="thumbnailView" src="#" alt="your image" style="display: none"/>
                                        <input type='file' accept="image/*" name="thumbnail" id="thumbnail">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input id="checkMain" type="checkbox" value="">이 게시물을 메인에 표시합니다.
                                        </label>
                                    </div>
                                    <?php
                                } ?>

                                <button type="submit" class="btn btn-default" name="submit">작성</button>
                            </form>
                        </div>
                    <?php }
                }
            }
        } else {
            echo '<script>location.href="error.php";</script>';
        }
    } else if ($category == "stage") {
    if (!isset($_GET['postNum'])) { ?>
    <div id="pagetitle">
        <h1>Stage Upload</h1>
        <p>Stage 작성</p>
    </div>

    <div style="padding : 30px;">
        <form method="POST" action="content_upload.php" enctype="multipart/form-data">
            <input type="hidden" name="category" value="stage">
            <div class="form-group">
                <label>제목</label>
                <input type="text" name="title" class="form-control">
                <input type="hidden" name="type" value="">
            </div>
            <div class="form-group">
                <label>동영상</label>
                <video id="videoView" src="#" controls style="display: none">이 브라우저는 재생할 수 없습니다.</video>
                <input type='file' accept="video/*" name="videoFile" id="videoFile">
            </div>
            <div class="form-group">
                <label>내용</label>
                <textarea name="desc" class="form-control" rows="5"></textarea>
            </div>
            <div id="thumbnailForm" class="form-group"
            ">
            <label>썸네일</label>
            <img id="thumbnailView" src="#" alt="your image" style="display: none"/>
            <input type='file' accept="image/*" name="thumbnail" id="thumbnail">
    </div>

    <button type="submit" class="btn btn-default" name="submit">작성</button>
    </form>
</div>
<?php } else {
    $postNum = $_GET['postNum'];
    $query = "select * from contents where idx=$postNum";
    $result = $mysqli->query($query);

    if (mysqli_num_rows($result) > 0) {
        $result_arr = mysqli_fetch_array($result);
        if ($result_arr['author'] == $_SESSION['nickname']) {
            ?>
            <div id="pagetitle">
                <h1>Stage Upload</h1>
                <p>Stage 수정</p>
            </div>

            <div style="padding : 30px;">
                <form method="POST" action="content_upload.php" enctype="multipart/form-data">
                    <input type="hidden" name="category" value="stage">
                    <input type="hidden" name="videoChangedCheck">
                    <input type="hidden" name="thumbnailChangedCheck">
                    <input type="hidden" name="editCheck" value="edit">
                    <input type="hidden" name="postNum" value="<?php echo $postNum; ?>">
                    <div class="form-group">
                        <label>제목</label>
                        <input type="text" name="title" class="form-control"
                               value="<?php echo $result_arr['title']; ?>">
                    </div>
                    <div class="form-group">
                        <label>동영상</label>
                        <p align="center"><video id="videoView" src="<?php echo $result_arr['video']; ?>" controls style="width: 700px; height: 400px; background-color: #0f0f0f">이
                                브라우저는 재생할 수 없습니다.
                            </video></p>
                        <input type='file' accept="video/*" name="videoFile" id="videoFile">
                    </div>
                    <div class="form-group">
                        <label>내용</label>
                        <textarea name="desc" class="form-control"
                                  rows="5"><?php echo nl2br($result_arr['content_desc']); ?></textarea>
                    </div>

                    <?php if ($result_arr['thumbnail'] == "images/stage_default.jpg") { ?>
                        <div id="thumbnailForm" class="form-group">
                            <label>썸네일</label>
                            <img id="thumbnailView" src="#" alt="your image" style="display: none"/>
                            <input type='file' accept="image/*" name="thumbnail" id="thumbnail">
                        </div>

                    <?php } else { ?>
                        <label>썸네일</label>

                        <img id="thumbnailView" src="<?php echo $result_arr['thumbnail'] ?>" alt="your image"
                             />
                        <input type='file' accept="image/*" name="thumbnail" id="thumbnail">

                    <?php } ?>

                    <button type="submit" class="btn btn-default" name="submit">작성</button>
                </form>
            </div>
        <?php
        }
    }
}
} else {
    echo '<script>location.href="error.php";</script>';
}
} else {
    echo '<script>location.href="error.php";</script>';
} ?>


</div>

</body>
</html>





