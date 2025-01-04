<?php
require_once './DB.php';

function UserInsert(){
    $response = DB();

    $account = $_POST['account'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];

    if($response['status'] == 200) {
        $conn = $response['result'];

        // 檢查是否有重複帳號
        $checkQuery = "SELECT * FROM `user` WHERE `account` = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->execute([$account]);
        $result = $stmt->fetch();

        if ($result) {
            $response['status'] = 409;  // Conflict
            $response['message'] = "此帳號已被註冊，請選擇其他帳號！";
        } else {
            // 插入新使用者資料
            $sql = "INSERT INTO `user` (`account`, `password`, `role`, `name`, `gender`) VALUES (?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$account, $password, $role, $name, $gender]);

            if($result) {
                $count = $stmt->rowCount();  // 獲取受影響的行數

                if($count < 1) {  // 沒有 row 增加
                    $response['status'] = 204;  // No content
                    $response['message'] = "新增失敗";
                } else {
                    $response['status'] = 200; 
                    $response['message'] = "新增成功";
                }
            } else {
                $response['status'] = 400;  // Bad request
                $response['message'] = "新增失敗，請重試！";
            }
        }
    } else {
        $response['status'] = 500;  // Internal server error
        $response['message'] = "資料庫連線失敗";
    }

    echo json_encode($response);
}

UserInsert();
?>