<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊</title>
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
        form {
            display: inline-block;
            text-align: left;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
        }
    </style>
</head>
<body>
    <h1>註冊</h1>
    <form action="../server/register_process.php" method="post">
        <label for="account">帳號:</label>
        <input type="text" id="account" name="account" maxlength="100" required>

        <label for="password">密碼:</label>
        <input type="password" id="password" name="password" maxlength="15" required>

        <label for="role">身份:</label>
        <select id="role" name="role" required>
            <option value="student">學生</option>
            <option value="teacher">教師</option>
        </select>

        <label for="name">姓名:</label>
        <input type="text" id="name" name="name" required>

        <label for="gender">性別:</label>
        <select id="gender" name="gender" required>
            <option value="male">男</option>
            <option value="female">女</option>
        </select>

        <button class="btn" type="submit">註冊</button>
    </form>
    <button class="btn" onclick="window.location.href='../front/login.php'">返回登入</button>
</body>
</html>
