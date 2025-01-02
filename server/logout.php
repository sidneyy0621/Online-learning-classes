<?php
// 啟動 Session
session_start();

// 清除所有 Session 資料
session_unset();
session_destroy();

// 跳轉回登入頁面
header("Location: ../front/login.php");
exit;
?>
