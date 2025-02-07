# 線上課程管理平台

## 專案介紹
這是一個線上課程管理系統，提供教師管理課程及學生新增課程的功能。學生加入自己感興趣的課程，教師可以新增、刪除、更新課程資訊。

## 預期功能
**學生：**
1. **註冊和登入：**
使用者註冊時可選擇身分，選擇「學生」時，會依序進入學生的登入畫面，及首頁畫面。
2. **查看所有課程：**
學生可在 `首頁` 畫面中查看目前系統上所有教師所新增之課程。
3. **加入和刪除加入的課程：**
學生可選擇感興趣之課程加入，並在`您的課程` 中顯示該學生已加入課程。

**教師：**
1. **註冊和登入：**
使用者註冊時可選擇身分，選擇「教師」時，會依序進入教師的登入畫面，及首頁畫面。
2. **新增、刪除、修改、查詢課程：**
教師可在 `您的課程` 中新增、修改、刪除課程，並即時查詢目前已開設的課程。
3. **查看所有課程：**
教師可在 `首頁` 畫看面到目前系統上所有教師所新增的課程，避免開設到與其他教師相似的課程，但與學生的功能稍有不同，教師不可在首頁做新增課程的動做。


## 環境設定
1. 安裝 xampp
2. 執行 Apache, MySQL
<img src="./pic/xampp.png" alt="xampp.png" width="250"/>

3. 建立資料庫及資料表

    **資料庫：** learningdb

    **資料表：**
    - User
    <img src="./pic/User.png" alt="User.png" width="410"/>

    - Course 
    <img src="./pic/Course.png" alt="Course.png" width="410"/>
    
    - Student_courses
    <img src="./pic/Student_Course.png" alt="Student_Course.png" width="410"/>

4. 在 xampp ⭢ htdocs 目錄下創建一個資料夾，將front, server 內的文件連同資料夾放到你新創的資料夾中
5. 在網頁輸入網址 🔗`http://localhost/YOUR FOLDER NAME/front/home.html`
6. 選擇一個身分，即可進入系統

## 操作及功能介面設計
1. 首頁 (home.html)
- 選擇 `教師`、`學生` 身分
<img src="./pic/home.png" alt="home.png" width="500"/>

2. **登入畫面 (student_login.html,teacher_login.html)**
<div style="display: flex; justify-content: space-between;">
  <img src="./pic/stu_login.png" alt="stu_login.png" width="410"/>
  <img src="./pic/tea_login.png" alt="tea_login.png" width="410"/>
</div>

- 帳號密碼錯誤
<img src="./pic/loginFaild.png" alt="loginFaild.png" width="500"/>

3. **註冊頁面 (register.html)**
<img src="./pic/register.png" alt="register.png" width="500"/>

- 註冊成功
<img src="./pic/registerOK.png" alt="registerOK.png" width="500"/>


4. **教師主頁面 (teacher.html)** 
- `首頁` 頁面顯示所有教師新增之課程
<img src="./pic/tea1.png" alt="tea1.png" width="500"/>

- 教師 `新增` 課程
<img src="./pic/teaADD.png" alt="teaADD.png" width="500"/>

- 教師 `修改`、`刪除` 課程
<img src="./pic/teaUpdateDel.png" alt="teaUpdateDel.png" width="500"/>


5. **學生主頁面 (student.html)** 
- `首頁` 頁面顯示所有教師新增之課程
<img src="./pic/stu1.png" alt="stu1.png" width="500"/>

- 學生加入課程成功
<img src="./pic/stuJoin.png" alt="stuJoin.png" width="500"/>

- `您的課程` 頁面顯示該名學生已加入的課程
<img src="./pic/stuJoinCourse.png" alt="stuJoinCourse.png" width="500"/>




6. **個人資料修改畫面**
<img src="./pic/updateProfile.png" alt="updateProfile.png " width="500"/>

- 個人資料修改成功
<img src="./pic/updateProfileOK.png" alt="updateProfileOK.png " width="500"/>

- 個人資料修改失敗，原因：未輸入舊密碼
<img src="./pic/updateProfileNoPassword.png" alt="updateProfileNoPassword.png " width="500"/>

- 個人資料修改失敗，原因：舊密碼輸入錯誤
<img src="./pic/updateProfilePasswordWrong.png" alt="updateProfilePasswordWrong.png " width="500"/>

- 個人資料修改失敗，原因：未更新資料
<img src="./pic/updateProfileFailed.png" alt="updateProfileFailed.png " width="500"/>
