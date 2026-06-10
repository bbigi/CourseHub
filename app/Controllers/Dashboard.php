<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\LessonModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $courseModel = new CourseModel();
        $lessonModel = new LessonModel();
        $enrollmentModel = new EnrollmentModel();
        $userModel = new UserModel();

        $role = session()->get('role');
        $userId = (int) session()->get('user_id');

        if ($role === 'instruktur') {
            $courseIds = array_column($courseModel->where('instructor_id', $userId)->findAll(), 'id');
            $lessonCount = 0;
            $enrollmentCount = 0;

            if ($courseIds !== []) {
                $lessonCount = $lessonModel->whereIn('course_id', $courseIds)->countAllResults();
                $enrollmentCount = $enrollmentModel->whereIn('course_id', $courseIds)->countAllResults();
            }

            $stats = [
                'courses'     => $courseModel->where('instructor_id', $userId)->countAllResults(),
                'lessons'     => $lessonCount,
                'enrollments' => $enrollmentCount,
                'users'       => $userModel->countAllResults(),
            ];
        } elseif ($role === 'siswa') {
            $stats = [
                'courses'     => $courseModel->where('status', 'published')->countAllResults(),
                'lessons'     => $lessonModel->countAllResults(),
                'enrollments' => $enrollmentModel->where('user_id', $userId)->countAllResults(),
                'users'       => $userModel->countAllResults(),
            ];
        } else {
            $stats = [
                'courses'     => $courseModel->countAllResults(),
                'lessons'     => $lessonModel->countAllResults(),
                'enrollments' => $enrollmentModel->countAllResults(),
                'users'       => $userModel->countAllResults(),
            ];
        }

        $latestCourses = $courseModel->withInstructor()->orderBy('courses.created_at', 'DESC')->limit(5)->findAll();

        return view('dashboard/index', [
            'title'         => 'Dashboard',
            'stats'         => $stats,
            'latestCourses' => $latestCourses,
        ]);
    }
}
