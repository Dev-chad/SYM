<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
    <title>팝업띄우기</title>
    <script language="JavaScript">
        <!--
        function getCookie(name) {
            var nameOfCookie = name + "=";
            var x = 0;

            while ( x <= document.cookie.length ) {
                var y = (x+nameOfCookie.length);
                if ( document.cookie.substring( x, y ) == nameOfCookie ) {
                    if ( (endOfCookie=document.cookie.indexOf( ";",y )) == -1 )
                        endOfCookie = document.cookie.length;
                    return unescape( document.cookie.substring(y, endOfCookie ) );
                }
                x = document.cookie.indexOf( " ", x ) + 1;
                if ( x == 0 )
                    break;
            }
            return "";
        }

        function openWin() {
            if (getCookie("name1") != "done") {
                window.open("upload_test.php","name1","width=300, height=400, top=0,left=0");
            }
        }
        // -->
    </script>
</head>

<body onload="openWin();">
팝업이 띄워질 창
</body>
</html>