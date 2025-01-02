<?php
// 引入資料庫連線檔案
require 'db_connection.php';

// 檢查請求是否為 POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取表單資料
    $account = trim($_POST['account']);
    $password = trim($_POST['password']);

    // 查詢使用者資料
    $query = "SELECT * FROM user WHERE account = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $account, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 登入成功，啟動 Session 並跳轉到 index.html
        session_start();
        $user = $result->fetch_assoc();
        $_SESSION['account'] = $user['account'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];
        echo "<script>alert('登入成功！'); window.location.href='../front/index.html';</script>";
    } else {
        // 登入失敗
        echo "<script>alert('帳號或密碼錯誤！'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    // 非 POST 請求，禁止訪問
    header("HTTP/1.1 403 Forbidden");
    exit;
}
?>
