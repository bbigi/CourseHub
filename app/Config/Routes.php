<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// Autentikasi
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::attemptRegister');
$routes->post('logout', 'Auth::logout');

// Area aplikasi web. Filter auth memastikan user login.
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index');

    // CRUD kursus
    $routes->get('courses', 'CourseController::index');
    $routes->get('courses/new', 'CourseController::new');
    $routes->post('courses', 'CourseController::create');
    $routes->get('courses/(:num)', 'CourseController::show/$1');
    $routes->get('courses/(:num)/edit', 'CourseController::edit/$1');
    $routes->put('courses/(:num)', 'CourseController::update/$1');
    $routes->delete('courses/(:num)', 'CourseController::delete/$1');
    $routes->post('courses/(:num)/enroll', 'CourseController::enroll/$1');

    // CRUD materi kursus
    $routes->get('courses/(:num)/lessons', 'LessonController::index/$1');
    $routes->get('courses/(:num)/lessons/new', 'LessonController::new/$1');
    $routes->post('courses/(:num)/lessons', 'LessonController::create/$1');
    $routes->get('courses/(:num)/lessons/(:num)/edit', 'LessonController::edit/$1/$2');
    $routes->put('courses/(:num)/lessons/(:num)', 'LessonController::update/$1/$2');
    $routes->delete('courses/(:num)/lessons/(:num)', 'LessonController::delete/$1/$2');

    // Enrolmen dan progress belajar
    $routes->get('enrollments', 'EnrollmentController::index');
    $routes->post('enrollments/(:num)/progress', 'EnrollmentController::updateProgress/$1');

    // Manajemen user hanya untuk admin
    $routes->group('users', ['filter' => 'role:admin'], static function ($routes) {
        $routes->get('', 'UserController::index');
        $routes->get('new', 'UserController::new');
        $routes->post('', 'UserController::create');
        $routes->get('(:num)/edit', 'UserController::edit/$1');
        $routes->put('(:num)', 'UserController::update/$1');
        $routes->delete('(:num)', 'UserController::delete/$1');
    });
});

// REST API. Gunakan header X-API-KEY pada Postman/Thunder Client.
$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'apikey'], static function ($routes) {
    $routes->get('courses', 'Courses::index');
    $routes->get('courses/(:num)', 'Courses::show/$1');
    $routes->post('courses', 'Courses::create');
    $routes->put('courses/(:num)', 'Courses::update/$1');
    $routes->delete('courses/(:num)', 'Courses::delete/$1');

    $routes->get('enrollments', 'Enrollments::index');
    $routes->get('enrollments/(:num)', 'Enrollments::show/$1');
    $routes->post('enrollments', 'Enrollments::create');
    $routes->put('enrollments/(:num)', 'Enrollments::update/$1');
    $routes->delete('enrollments/(:num)', 'Enrollments::delete/$1');
});
