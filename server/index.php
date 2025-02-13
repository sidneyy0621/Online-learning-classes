<?php
    if(isset($_GET['action'])) 
        $action=$_GET['action'];
    else
        $action='_no_action';
    
    switch ($action) {
        case 'CourseSelect':
            require_once "./CourseSelect.php";
            $response = CourseSelect();
            break;
        case 'CourseInsert':
            require_once "CourseInsert.php";
            $response = CourseInsert();
            break;
        case 'CourseUpdate':
            require_once "CourseUpdate.php";
            $response = CourseUpdate();
            break;
        case 'CourseDelete':
            require_once "CourseDelete.php";
            $response = CourseDelete();
            break;
        case 'StudentCourseInsert':
            require_once "StudentCourseInsert.php";
            $response = StudentCourseInsert();
            break;
        case 'StudentCourseSelect':
            require_once "StudentCourseSelect.php";
            $response = StudentCourseSelect();
            break;
        case 'StudentCourseDelete':
            require_once "StudentCourseDelete.php";
            $response = StudentCourseDelete();
            break;
        default:
            $response['status'] = 404; 
            $response['message'] = "action not found";
            break;
    }
    echo json_encode($response);


