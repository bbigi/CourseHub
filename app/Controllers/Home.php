<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\LessonModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $courseModel = new CourseModel();
        $enrollmentModel = new EnrollmentModel();
        $lessonModel = new LessonModel();
        $userModel = new UserModel();

        $featuredCourses = $courseModel
            ->withInstructor()
            ->where('courses.status', 'published')
            ->orderBy('courses.created_at', 'DESC')
            ->limit(3)
            ->findAll();

        $stats = [
            'courses'     => $courseModel->where('status', 'published')->countAllResults(),
            'lessons'     => $lessonModel->countAllResults(),
            'enrollments' => $enrollmentModel->countAllResults(),
            'users'       => $userModel->countAllResults(),
        ];

        return view('landing/index', [
            'title'           => 'CourseHub - Sistem Manajemen Kursus Online',
            'featuredCourses' => $featuredCourses,
            'stats'           => $stats,
        ]);
    }
}
