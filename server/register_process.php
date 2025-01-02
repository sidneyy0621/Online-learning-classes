<?php
// 引入資料庫連線檔案
require 'db_connection.php';

// 檢查請求是否為 POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 獲取表單資料
    $account = trim($_POST['account']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $name = trim($_POST['name']);
    $gender = trim($_POST['gender']);

    // 檢查是否有重複帳號和密碼組合
    $checkQuery = "SELECT * FROM user WHERE account = ? AND password = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("ss", $account, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // 帳號和密碼組合已存在
        echo "<script>alert('此帳號已被註冊，請選擇其他帳號！'); window.history.back();</script>";
    } else {
        // 插入新使用者資料
        $insertQuery = "INSERT INTO user (account, password, role, name, gender) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssss", $account, $password, $role, $name, $gender);

        if ($stmt->execute()) {
            // 註冊成功，跳轉到登入頁面
            echo "<script>alert('註冊成功！請登入'); window.location.href='../front/login.php';</script>";
        } else {
            // 註冊失敗
            echo "<script>alert('註冊失敗，請重試！'); window.history.back();</script>";
        }
    }

    $stmt->close();
    $conn->close();
} else {
    // 非 POST 請求，禁止訪問
    header("HTTP/1.1 403 Forbidden");
    exit;
}
?>
