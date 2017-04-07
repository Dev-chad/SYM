<?php include "db.php";
$query = "select * from contents where category='NEWS-MAIN' ORDER BY date DESC limit 1";
$result = $mysqli->query($query);
if (mysqli_num_rows($result) > 0) {
    $result_arr = mysqli_fetch_array($result);
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $result_arr['title'] ?></title>

    <script>
        function setCookie(name, value, expiredays) {
            var today = new Date();
            today.setDate(today.getDate() + expiredays);

            document.cookie = name + '=' + escape(value) + '; path=/; expires=' + today.toGMTString() + ';'
        }

        function closePop() {
            if (document.forms[0].todayPop.checked)
                setCookie('popup', 'end', 1);
            self.close();
        }

    </script>
</head>
<body>

<a href="#"
   onclick="javascript:opener.location.href='postView.php?category=news&postNum=<?php echo $result_arr['idx']; ?>'; self.close();"><img
            src="<?php echo $result_arr['thumbnail']; ?>" alt="audition" style="width: 600px; height: 300px;"></a>
<form style="margin-top: 30px">
    <input type="checkbox" name="todayPop" onClick="closePop()">
    오늘 하루 그만보기
</form>

</body>
</html>