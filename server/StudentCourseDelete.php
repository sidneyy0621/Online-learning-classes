<?php
require_once './DB.php';

function StudentCourseDelete(){
    $response = DB();

    $student_name = $_POST['student_name'];
    $course_id = $_POST['course_id'];

    if($response['status'] == 200) {
        $conn = $response['result'];

        // Check if the student is enrolled in the course
        // $check_sql = "SELECT * FROM `student_courses` WHERE student_name=? AND course_id=?";
        // $check_stmt = $conn->prepare($check_sql);
        // $check_stmt->execute([$student_name, $course_id]);
        // $enrollment = $check_stmt->fetch();

        // if ($enrollment) {
            // Delete the course for the student
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
        // } else {
        //     $response['status'] = 404;
        //     $response['message'] = "學生未註冊此課程";
        // }
    }

    return($response); 
}

// Call the function and echo the response as JSON
// $response = StudentCourseDelete();
// echo json_encode($response);
?>