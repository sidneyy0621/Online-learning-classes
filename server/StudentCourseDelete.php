<?php
require_once './DB.php';

function StudentCourseDelete(){
    $response = DB();

    $student_name = $_POST['student_name'];
    $course_id = $_POST['course_id'];

    if($response['status'] == 200) {
        $conn = $response['result'];
        $sql = "DELETE FROM `student_courses` WHERE student_name=? AND course_id=?";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$student_name, $course_id]);

        if($result) {
            $count = $stmt->rowCount();

            if($count < 1){
                $response['status'] = 204; 
                $response['message'] = "刪除失敗";
            } else {
                $response['status'] = 200; 
                $response['message'] = "刪除成功";
            }
        } else {
            $response['status'] = 400; 
            $response['message'] = "SQL錯誤";
        }
    }

    return($response); 
}
?>