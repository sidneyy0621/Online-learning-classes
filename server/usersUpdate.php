<?php
require_once './DB.php';

function updateUserProfile() {
    $response = DB();

    $account = $_POST['account'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];

    if ($response['status'] == 200) {
        $conn = $response['result'];

        // 檢查輸入的有效性
        if (empty($account) || empty($old_password) || empty($gender)) {
            $response['status'] = 400; // Bad request
            $response['message'] = "需輸入舊密碼才能更新資料！";
        } else {
            // 驗證舊密碼
            $sql = "SELECT `password`, `account` FROM `user` WHERE `account` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$account]);
            $user = $stmt->fetch();

            if ($user && $user['password'] === $old_password) {
                // 更新使用者資料
                $new_account = $_POST['new_account'];
                if (!empty($new_password) && !empty($name)) {
                    $sql = "UPDATE `user` SET `account` = ?, `password` = ?, `name` = ?, `gender` = ? WHERE `account` = ?";
                    $stmt = $conn->prepare($sql);
                    $result = $stmt->execute([$new_account, $new_password, $name, $gender, $account]);
                } elseif (!empty($new_password)) {
                    $sql = "UPDATE `user` SET `account` = ?, `password` = ?, `gender` = ? WHERE `account` = ?";
                    $stmt = $conn->prepare($sql);
                    $result = $stmt->execute([$new_account, $new_password, $gender, $account]);
                } elseif (!empty($name)) {
                    $sql = "UPDATE `user` SET `account` = ?, `name` = ?, `gender` = ? WHERE `account` = ?";
                    $stmt = $conn->prepare($sql);
                    $result = $stmt->execute([$new_account, $name, $gender, $account]);
                } else {
                    $sql = "UPDATE `user` SET `account` = ?, `gender` = ? WHERE `account` = ?";
                    $stmt = $conn->prepare($sql);
                    $result = $stmt->execute([$new_account, $gender, $account]);
                }

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
            } else {
                $response['status'] = 400; // Bad request
                $response['message'] = "舊密碼不正確！";
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