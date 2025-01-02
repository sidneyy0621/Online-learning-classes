<?php
$servername = "localhost"; // 根據實際伺服器調整
$username = "root";        // 資料庫使用者名稱
$password = "";            // 資料庫密碼
$dbname = "learningdb";    // 使用的資料庫名稱

// 建立連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線
if ($conn->connect_error) {
    die("資料庫連線失敗: " . $conn->connect_error);
}
?>
