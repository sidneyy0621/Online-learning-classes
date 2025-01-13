<?php
require_once './DB.php';

function updateUserProfile() {
    $response = DB();

    $account = $_POST['account'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];

    if ($response['status'] == 200) {
        $conn = $response['result'];

        // 檢查輸入的有效性
        if (empty($account) || empty($password) || empty($name) || empty($gender)) {
            $response['status'] = 400; // Bad request
            $response['message'] = "所有欄位都是必填的！";
        } else {
            // 更新使用者資料
            $sql = "UPDATE `user` SET `password` = ?, `name` = ?, `gender` = ? WHERE `account` = ?";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$password, $name, $gender, $account]);

            if ($result) {
                $count = $stmt->rowCount(); // 獲取受影響的行數

                if ($count < 1) { // 沒有 row 更新
                    $response['status'] = 204; // No content
                    $response['message'] = "更新失敗，無更改資料！";
                } else {
                    $response['status'] = 200; 
                    $response['message'] = "更新成功！";
                }
            } else {
                $response['status'] = 400; // Bad request
                $response['message'] = "更新失敗，請重試！";
            }
        }
    } else {
        $response['status'] = 500; // Internal server error
        $response['message'] = "資料庫連線失敗";
    }

    echo json_encode($response);
}

updateUserProfile();
?>