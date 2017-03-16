<?php
session_start();
session_unset();
echo '<script>alert("로그아웃"); history.back()</script>';
?>