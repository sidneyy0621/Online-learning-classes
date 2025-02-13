<?php 
require_once './DB.php';

function CourseUpdate(){
    $response = DB();

    $course_id = $_POST['course_id'];      
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];    
    $teacher_name = $_POST['teacher_name'];


    if($response['status']==200) {
        $conn = $response['result'];

        $sql = "UPDATE `course` SET `course_name` = ?, `description` = ?, `teacher_name` = ? WHERE `course_id` = ?";  

        $stmt = $conn->prepare($sql);
        $result = $stmt->execute([$course_name, $description, $teacher_name, $course_id]);

        if($result) {
            $count = $stmt->rowCount();
            
            if($count<1){
                $response['status'] = 204; //No Content
                $response['message'] = "更新失敗";
            }else{
                $response['status'] = 200; //OK
                $response['message'] = "更新成功";
            }
        }else {
        $response['status'] = 400; //Bad Request
        $response['message'] = "SQL錯誤";
        }
        
    }
    // echo json_encode($response);
    
    return($response); 
}


