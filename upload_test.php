<?php
/*$target_dir = "/sym_data/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
if ($_FILES["fileToUpload"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
*/?>

<html>
<head>
    <title>팝업으로 띄워지는 창</title>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
    <script language="JavaScript">
        <!--
        function setCookie(name,value,expiredays) {
            var todayDate = new Date();
            todayDate.setDate(todayDate.getDate() + expiredays);
            document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
        }

        function closeWin() {
            if(document.checkClose.name1.checked == true) {
                setCookie("name1", "done" ,1);
            }
            self.close();
        }
        //-->
    </script>

</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table border="0" width="300" height="400" cellpadding="0" cellspacing="0">
    <form name="checkClose">
        <tr>
            <td colspan="2" height="377">
                <a href="이동할 주소" target="_blank"><img src="images/popup01.gif" border="0" alt="클릭"></a></td>
        </tr>
        <tr>
            <td width="250" height="23" valign="top" bgcolor="#000000">
                <input type="checkbox" name="name1" onfocus="this.blur()">오늘 하루 이 창 띄우지 않음</td>
            <td width="50" valign="bottom" bgcolor="#000000">
                <a href="#" _onxclick="closeWin()">[닫기]</a>
            </td>
        </tr>
    </form>
</table>
</body>
</html>
