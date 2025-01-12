<?php
require_once './DB.php';

function StudentCourseInsert(){
    $response = DB();

    $student_name = $_POST['student_name'];      
    $course_id = $_POST['course_id'];

    if($response['status']==200) {
        $conn = $response['result'];

        $sql = "INSERT INTO `student_courses` (`student_name`, `course_id`) VALUES (?,?)";
        
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$student_name, $course_id]);

        if($result) {
            $count = $stmt->rowCount();

            if($count < 1) {
                $response['status'] = 204;  // No content
                $response['message'] = "新增失敗";
            } else {
                $response['status'] = 200; 
                $response['message'] = "新增成功";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "SQL錯誤";
        }
    }
    
    return $response; 
}