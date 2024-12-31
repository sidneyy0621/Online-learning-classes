<?php
require_once './DB.php';

function CourseSelect(){
    $response = DB();

    if($response['status']==200) {
        $conn = $response['result'];
        
        // 
        if (isset($_POST['course_id'])) {
            $course_id = $_POST['course_id'];
            
            // 查詢單一使用者
            $sql = "SELECT  *  FROM  `course` WHERE `course_id`=?";
            
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$course_id]);
        } else {
            // 查詢所有使用者
            $sql = "SELECT  *  FROM  `course`";
            
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute();
        }
        if($result) {
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $response['status'] = 200; //OK
            $response['message'] = "查詢成功";

            $response['result'] = $rows;
        }
        else {
            $response['status'] = 400; //Bad Request
            $response['message'] = "SQL錯誤";
        }
    }
    // echo json_encode($response);
    
    return($response); 
}

