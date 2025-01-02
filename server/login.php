<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登入</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        .btn {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .form-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
    $user_type = isset($_GET['user_type']) ? $_GET['user_type'] : 'student';
    $title = $user_type === 'student' ? '學生登入' : '教師登入';
    $error = isset($_GET['error']) ? '帳號或密碼錯誤' : '';
    ?>
    <h1><?php echo $title; ?></h1>
    <div class="form-container">
        <form action="../server/authenticate.php" method="post">
            <input type="hidden" name="user_type" value="<?php echo $user_type; ?>">
            <label for="account">帳號:</label>
            <input type="text" id="account" name="account" required><br><br>
            <label for="password">密碼:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button class="btn" type="submit">登入</button>
        </form>
        <p>還沒有帳號嗎? <a href="register.php?user_type=<?php echo $user_type; ?>">註冊</a></p>
    </div>
</body>
</html>
