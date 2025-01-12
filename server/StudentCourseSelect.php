<?php
require_once './DB.php';

function StudentCourseSelect(){
    $response = DB();

    if($response['status'] == 200) {
        $conn = $response['result'];
        
        if (isset($_POST['student_name'])) {
            $student_name = $_POST['student_name'];
            
            $sql = "SELECT course.course_id, course.course_name, course.description, course.teacher_name 
                    FROM student_courses 
                    JOIN course ON student_courses.course_id = course.course_id 
                    WHERE student_courses.student_name = ?";
            
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$student_name]);

            if($result) {
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $response['status'] = 200; // OK
                $response['message'] = "查詢成功";
                $response['result'] = $rows;
            } else {
                $response['status'] = 400; // Bad Request
                $response['message'] = "SQL錯誤";
            }
        } else {
            $response['status'] = 400; // Bad Request
            $response['message'] = "缺少學生姓名";
        }
    }
    
    return $response; 
}