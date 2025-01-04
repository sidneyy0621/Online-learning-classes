<?php
require_once './DB.php';

function loginUser() {
    $response = DB();

    $account = $_POST['username'];
    $password = $_POST['password'];

    if ($response['status'] == 200) {
        $conn = $response['result'];

        // 檢查帳號和密碼是否正確
        $checkQuery = "SELECT * FROM `user` WHERE `account` = ? AND `password` = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->execute([$account, $password]);        
        $result = $stmt->fetch();

        if ($result) {
            $response['status'] = 200;
            $response['message'] = "登入成功";
            $response['role'] = $result['role'];
        } else {
            $response['status'] = 401;  // Unauthorized
            $response['message'] = "帳號或密碼錯誤！請重試";
        }
    } else {
        $response['status'] = 500;  // Internal server error
        $response['message'] = "資料庫連線失敗";
    }

    echo json_encode($response);
}

loginUser();
?>