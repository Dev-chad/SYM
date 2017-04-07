<?php session_start();
include "db.php";

$title = $_POST['title'];
$desc = $_POST['desc'];
$author = $_SESSION['nickname'];
$time = date("Y-m-d H:i:s", time());
$type = $_POST['type'];
$category = $_POST['category'];
$microtime = floor(microtime(true));


$errorCheck = false;

if ($category == "news") {

    if (!strcmp($type, "main")) {
        $type = "NEWS-MAIN";
    } else {
        $type = "NEWS";
    }

    $target_image_file = "image/news/news_image_" . $author . "_" . $microtime;
    $target_thumbnail_file = "image/news/news_thumbnail_" . $author . "_" . $microtime;

    if ($_POST['editCheck'] == "edit") {
        $query = "select * from contents where idx = " . $_POST['postNum'];
        $result = $mysqli->query($query);
        $result_arr = mysqli_fetch_array($result);

        if ($title == '') {
            echo '<script>alert("제목을 입력해주세요."); history.back();</script>';
        } else if (($desc == '') && ($result_arr['image'] == '') && !is_uploaded_file($_FILES["imageFile"]["tmp_name"])) {
            echo '<script>alert("이미지 또는 내용을 작성해주세요."); history.back();</script>';
        } else if ($type == "main" && ($_POST['thumbnailChangedCheck'] == "changed") && !is_uploaded_file($_FILES["thumbnail"]["tmp_name"])) {
            echo '<script>alert("메인 게시물은 썸네일 이미지가 필수입니다."); history.back();</script>';
        } else {

            if ($result_arr['author'] == $author) {
                $query = "update contents set title='$title', content_desc = '$desc'";

                if ($_POST['imageChangedCheck'] == "changed") {
                    $newImage = '';

                    if ($result_arr['image'] != '') {
                        $delImage = $result_arr['image'];
                        unlink($delImage);
                    }

                    if (is_uploaded_file($_FILES["imageFile"]["tmp_name"])) {
                        $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
                        if (!$check) {
                            echo '<script>alert("이미지 파일이 아닙니다."); history.back();</script>';
                            $errorCheck = true;
                        } else {
                            if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_image_file)) {
                                $newImage = $target_image_file;
                            } else {
                                echo '<script>alert("!!이미지 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                                $errorCheck = true;
                            }
                        }
                    }

                    if (!$errorCheck) {
                        $query = $query . ", image= '$newImage'";
                    }
                }

                if ($type == "NEWS-MAIN") {
                    $newImage = '';

                    if ($result_arr['category'] == "NEWS-MAIN") {
                        if ($_POST['thumbnailChangedCheck'] == "changed") {

                            if ($result_arr['thumbnail'] != '') {
                                $delImage = $result_arr['thumbnail'];
                                unlink($delImage);
                            }

                            if (is_uploaded_file($_FILES["thumbnail"]["tmp_name"])) {
                                $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
                                if (!$check) {
                                    echo '<script>alert("이미지 파일이 아닙니다."); history.back();</script>';
                                    $errorCheck = true;
                                } else {
                                    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_thumbnail_file)) {
                                        $newImage = $target_thumbnail_file;
                                    } else {
                                        echo '<script>alert("!!이미지 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                                        $errorCheck = true;
                                    }
                                }
                            }

                            if (!$errorCheck) {
                                $query = $query . ", thumbnail='$newImage'";
                            }
                        }
                    } else {
                        if (is_uploaded_file($_FILES["thumbnail"]["tmp_name"])) {
                            $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
                            if (!$check) {
                                echo '<script>alert("이미지 파일이 아닙니다."); history.back();</script>';
                                $errorCheck = true;
                            } else {
                                if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_thumbnail_file)) {
                                    $newImage = $target_thumbnail_file;
                                } else {
                                    echo '<script>alert("!!이미지 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                                    $errorCheck = true;
                                }
                            }
                        }

                        if (!$errorCheck) {
                            $query = $query . ", thumbnail= '$newImage', category='NEWS-MAIN'";
                        }
                    }
                } else {
                    if ($result_arr['category'] == "NEWS-MAIN") {
                        $delImage = $result_arr['thumbnail'];
                        unlink($delImage);
                        $query = $query . ", thumbnail='', category='NEWS'";
                    }
                }
            }

            $query = $query . " where idx=" . $_POST['postNum'];
            if ($mysqli->query($query)) {
                echo '<script>alert("수정 완료."); location.href="postView.php?category=news&postNum='.$_POST['postNum'].'";</script>';
            } else {
                echo '<script>alert("!!게시물 수정 오류!! 관리자에게 문의하세요."); history.back();</script>';
            }
        }
    } else {
        if ($title == '') {
            echo '<script>alert("제목을 입력해주세요."); history.back();</script>';

        } else if (($desc == '') && !is_uploaded_file($_FILES["imageFile"]["tmp_name"])) {
            echo '<script>alert("이미지 또는 내용을 작성해주세요."); history.back();</script>';
        } else if ($type == "main" && !is_uploaded_file($_FILES["thumbnail"]["tmp_name"])) {
            echo '<script>alert("메인 게시물은 썸네일 이미지가 필수입니다."); history.back();</script>';
        } else {
            $query = "insert into contents(title, content_desc, date, author, category";
            $value = "values('$title', '$desc', '$time', '$author', '$type'";

            if (is_uploaded_file($_FILES["imageFile"]["tmp_name"])) {
                $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
                if (!$check) {
                    echo '<script>alert("이미지 파일이 아닙니다."); history.back();</script>';
                    $errorCheck = true;
                } else {
                    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_image_file)) {
                        $query = $query . ", image";
                        $value = $value . ", '$target_image_file'";
                    } else {
                        echo '<script>alert("!!이미지 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                        $errorCheck = true;
                    }
                }
            }

            if ($type == "NEWS-MAIN") {
                $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
                if (!$check) {
                    echo '<script>alert("선택하신 썸네일은 이미지 파일이 아닙니다."); history.back();</script>';
                    $errorCheck = true;

                } else {
                    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_thumbnail_file)) {
                        $query = $query . ", thumbnail";
                        $value = $value . ", '$target_thumbnail_file'";
                    } else {
                        echo '<script>alert("!!썸네일 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                        $errorCheck = true;

                    }
                }
            }

            if (!$errorCheck) {
                $query = $query . ")" . $value . ")";

                if ($mysqli->query($query)) {
                    echo '<script>alert("게시물을 업로드 하였습니다."); location.href="news.php";</script>';
                } else {
                    echo '<script>alert("!!게시물 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                }
            }
        }
    }
} else if ($category == "stage") {
    $target_video_file = "video/stage/stage_video_" . $author . "_" . $microtime;
    $target_thumbnail_file = "image/stage/stage_thumbnail_" . $author . "_" . $microtime;
    if ($_POST['editCheck'] == "edit") {
        $query = "select * from contents where idx = " . $_POST['postNum'];
        $result = $mysqli->query($query);
        $result_arr = mysqli_fetch_array($result);

        if ($title == '') {
            echo '<script>alert("제목을 입력해주세요."); history.back();</script>';
        } else if (($_POST['videoChangedCheck'] == "changed") && !is_uploaded_file($_FILES["videoFile"]["tmp_name"])) {
            echo '<script>alert("영상을 업로드해주세요."); history.back();</script>';
        } else {
            if ($result_arr['author'] == $author) {
                $query = "update contents set title='$title', content_desc = '$desc'";

                if ($_POST['videoChangedCheck'] == "changed") {
                    if (is_uploaded_file($_FILES["videoFile"]["tmp_name"])) {
                        $check = explode("/", $_FILES["videoFile"]["type"])[1];
                        if (($check != "mp4") && ($check != "avi")) {
                            echo '<script>alert("해당 영상파일은 지원하는 파일(mp4, avi)이 아닙니다' . $check . '"); history.back();</script>';
                            $errorCheck = true;
                        } else {
                            $target_video_file = $target_video_file . ".$check";
                            if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $target_video_file)) {
                                $query = $query . ", video= '$target_video_file'";
                                $delVideo = $result_arr['video'];
                                unlink($delVideo);
                            } else {
                                echo '<script>alert("!!동영상 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                                $errorCheck = true;
                            }
                        }
                    }
                }

                if (is_uploaded_file($_FILES["thumbnail"]["tmp_name"])) {
                    $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
                    if (!$check) {
                        echo '<script>alert("이미지 파일이 아닙니다."); history.back();</script>';
                        $errorCheck = true;
                    } else {
                        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_thumbnail_file)) {
                            if ($result_arr['thumbnail'] != '') {
                                $delImage = $result_arr['thumbnail'];
                                unlink($delImage);
                                $query = $query . ", thumbnail='$target_thumbnail_file'";
                            }
                        } else {
                            echo '<script>alert("!!이미지 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                            $errorCheck = true;
                        }
                    }
                }
            }

            $query = $query . " where idx=" . $_POST['postNum'];
            echo $query;
            if ($mysqli->query($query)) {
                echo '<script>alert("수정 완료."); location.href="postView.php?category=stage&postNum='.$_POST['postNum'].'";</script>';
            } else {
                echo '<script>alert("!!게시물 수정 오류!! 관리자에게 문의하세요."); history.back();</script>';
            }
        }
    } else {
        if ($title == '') {
            echo '<script>alert("제목을 입력해주세요."); history.back();</script>';
        } else if (!is_uploaded_file($_FILES["videoFile"]["tmp_name"])) {
            echo '<script>alert("영상을 업로드해주세요."); history.back();</script>';
        } else {
            $query = "insert into contents(title, content_desc, date, author, category, video, thumbnail";
            $value = "values('$title', '$desc', '$time', '$author', '$category'";

            if (is_uploaded_file($_FILES["videoFile"]["tmp_name"])) {
                $check = explode("/", $_FILES["videoFile"]["type"])[1];
                if (($check != "mp4") && ($check != "avi")) {
                    echo '<script>alert("해당 영상파일은 지원하는 파일(mp4, avi)이 아닙니다' . $check . '"); history.back();</script>';
                    $errorCheck = true;
                } else {
                    $target_video_file = $target_video_file . ".$check";
                    if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $target_video_file)) {
                        $value = $value . ", '$target_video_file'";
                    } else {
                        echo '<script>alert("!!동영상 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                        $errorCheck = true;
                    }
                }
            }

            if (is_uploaded_file($_FILES["thumbnail"]["tmp_name"])) {
                $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
                if (!$check) {
                    echo '<script>alert("해당 썸네일은 이미지 파일이 아닙니다."); history.back();</script>';
                    $errorCheck = true;
                } else {
                    $check = explode("/", $_FILES["thumbnail"]["type"])[1];
                    $target_thumbnail_file = $target_thumbnail_file . ".$check";
                    if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_thumbnail_file)) {
                    } else {
                        echo '<script>alert("!!썸네일 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                        $errorCheck = true;
                    }
                }
            } else {
                $target_thumbnail_file = "images/stage_default.jpg";
            }

            $value = $value . ", '$target_thumbnail_file'";

            if (!$errorCheck) {
                $query = $query . ")" . $value . ")";

                if ($mysqli->query($query)) {
                    $result = $mysqli->query("select * from contents where video='$target_video_file'");
                    $result_arr = mysqli_fetch_array($result);
                    echo '<script>alert("게시물을 업로드 하였습니다."); location.href="postView.php?category=stage&postNum=' . $result_arr['idx'] . '";</script>';
                } else {
                    echo '<script>alert("!!게시물 업로드 오류!! 관리자에게 문의하세요."); history.back();</script>';
                }
            }
        }
    }
} else {
    echo '<script>location.href="error.php";</script>';
}

/*
$target_dir = "image/news/";
$target_file = $target_dir . basename($_FILES["imageFile"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imageFile"]["tmp_name"]);
    if($check != false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["imageFile"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["imageFile"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}





if(!strcmp($type, "main")){
    $type = "NEWS-MAIN";
}else{
    $type = "NEWS";
}



$query = "insert into contents(title, content_desc, date, author, category, image)";
$query = $query. "values('$title', '$desc', '$time', '$author', '$type', '$target_file')";

if($mysqli->query($query)){
    echo '<script>alert("게시물을 업로드 하였습니다."); location.href="news.php";</script>';
}*/

$mysqli->close();

?>