<?php

use App\Helpers\Middleware;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR | E_PARSE);

session_start();

require __DIR__ . '/vendor/autoload.php';
$router = new \Bramus\Router\Router();

$router->setNamespace('\App\Controllers');

$router->before('GET', '/', function () {
    Middleware::IsLoggedIn();
});
$router->get('/', 'DashboardController@GetIndex');

$router->before('GET|POST', '/Authentication/Login', function () {
    Middleware::IsLoggedOut();
});
$router->get('/Authentication/Login', 'AuthenticationController@GetLogin');
$router->post('/Authentication/Login', 'AuthenticationController@PostLogin');

$router->before('GET', '/Authentication/Logout', function () {
    Middleware::IsLoggedIn();
});
$router->get('/Authentication/Logout', 'AuthenticationController@GetLogout');

$router->before('GET', '/Dashboard', function () {
    Middleware::IsLoggedIn();
});

// Admin area
$router->before('GET|POST', '/Admin/.*', function () {
    Middleware::IsInRole("Admin");
});
$router->get('/Admin/Users/Create', 'UserController@GetCreate');
$router->post('/Admin/Users/Create', 'UserController@PostCreate');
$router->get('/Admin/Users/{id}/Edit', 'UserController@GetEdit');
$router->post('/Admin/Users/{id}/Edit', 'UserController@PostEdit');
$router->post('/Admin/Users/{id}/Delete', 'UserController@PostDelete');
$router->get('/Admin/Users/{id}', 'UserController@GetShow');
$router->get('/Admin/Users', 'UserController@GetIndex');

$router->get('/Admin/Groups', 'GroupController@GetIndex');
$router->get('/Admin/Groups/Create', 'GroupController@GetCreate');
$router->post('/Admin/Groups/Create', 'GroupController@PostCreate');
$router->get('/Admin/Groups/{id}/Edit', 'GroupController@GetEdit');
$router->post('/Admin/Groups/{id}/Edit', 'GroupController@PostEdit');
$router->post('/Admin/Groups/{id}/Delete', 'GroupController@PostDelete');
$router->get('/Admin/Groups/{id}', 'GroupController@GetShow');

$router->get('/Admin/Courses', 'CourseController@GetIndex');
$router->get('/Admin/Courses/Create', 'CourseController@GetCreate');
$router->post('/Admin/Courses/Create', 'CourseController@PostCreate');
$router->get('/Admin/Courses/{id}/Edit', 'CourseController@GetEdit');
$router->post('/Admin/Courses/{id}/Edit', 'CourseController@PostEdit');
$router->post('/Admin/Courses/{id}/Delete', 'CourseController@PostDelete');
$router->get('/Admin/Courses/{id}', 'CourseController@GetShow');

// Teacher area
$router->before('GET|POST', '/Teacher/.*', function () {
    Middleware::IsInRole("Teacher");
});
$router->get('/Teacher/Courses/{courseId}/Students/{studentId}/Grades/Create', 'Teacher\GradeController@GetCreate');
$router->post('/Teacher/Courses/{courseId}/Students/{studentId}/Grades/Create', 'Teacher\GradeController@PostCreate');
$router->get('/Teacher/Courses/{courseId}/Students/{studentId}/Grades/{id}/Edit', 'Teacher\GradeController@GetEdit');
$router->post('/Teacher/Courses/{courseId}/Students/{studentId}/Grades/{id}/Edit', 'Teacher\GradeController@PostEdit');
$router->post('/Teacher/Courses/{courseId}/Students/{studentId}/Grades/{id}/Delete', 'Teacher\GradeController@PostDelete');
$router->get('/Teacher/Courses/{courseId}/Students/{studentId}/Grades', 'Teacher\GradeController@GetIndex');
$router->get('/Teacher/Courses/{courseId}/Students', 'Teacher\StudentController@GetIndex');
$router->get('/Teacher/Courses/{id}', 'Teacher\CourseController@GetShow');

// Student area
$router->before('GET|POST', '/Student/.*', function () {
    Middleware::IsInRole("Student");
});
$router->get('/Student/Courses/{id}', 'Student\CourseController@GetShow');

$router->run();