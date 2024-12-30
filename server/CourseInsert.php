<?php
require_once './DB.php';

function DoInsert(){
    $response = DB();

    $course_id = $_POST['course_id'];      
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];    
    $teacher_id = $_POST['teacher_id'];

    if($response['status']==200) {
        $conn = $response['result'];

        $sql = "INSERT INTO `course` (`course_id`, `course_name`, `description`, `teacher_id`) VALUES (?,?,?,?)";
        
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$course_id, $course_name, $description, $teacher_id]);  //可以用[]代替array()

        if($result) {
            $count=$stmt->rowCount();  //獲取受影響的行數

            if($count<1){  //沒有 row 增加
                $response['status'] = 204;  //No content
                $response['message'] = "新增失敗";
            }else{
                $response['status'] = 200; 
                $response['message'] = "新增成功";
            }
        }else {
        $response['status'] = 400;
        $response['message'] = "SQL錯誤";
        }

    }
    // echo json_encode($response);
    
    return($response); 
}

