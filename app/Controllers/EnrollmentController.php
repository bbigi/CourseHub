<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class EnrollmentController extends BaseController
{
    private EnrollmentModel $enrollmentModel;
    private CourseModel $courseModel;

    public function __construct()
    {
        $this->enrollmentModel = new EnrollmentModel();
        $this->courseModel = new CourseModel();
    }

    public function index()
    {
        $role = session()->get('role');
        $userId = (int) session()->get('user_id');
        $builder = $this->enrollmentModel->withCourseAndStudent();

        if ($role === 'siswa') {
            $builder->where('enrollments.user_id', $userId);
        } elseif ($role === 'instruktur') {
            $courseIds = array_column($this->courseModel->where('instructor_id', $userId)->findAll(), 'id');
            if ($courseIds === []) {
                $builder->where('enrollments.course_id', 0);
            } else {
                $builder->whereIn('enrollments.course_id', $courseIds);
            }
        }

        return view('enrollments/index', [
            'title'       => 'Data Enrolmen',
            'enrollments' => $builder->orderBy('enrolled_at', 'DESC')->findAll(),
        ]);
    }

    public function updateProgress(int $id)
    {
        $enrollment = $this->enrollmentModel->find($id);

        if (! $enrollment || session()->get('role') !== 'siswa' || (int) $enrollment['user_id'] !== (int) session()->get('user_id')) {
            return redirect()->to('/enrollments')->with('error', 'Data enrolmen tidak ditemukan atau tidak dapat diubah.');
        }

        $progress = (int) $this->request->getPost('progress');
        $progress = max(0, min(100, $progress));
        $status = $progress === 100 ? 'selesai' : 'aktif';

        $this->enrollmentModel->update($id, [
            'progress'     => $progress,
            'status'       => $status,
            'completed_at' => $progress === 100 ? date('Y-m-d H:i:s') : null,
        ]);

        return redirect()->to('/enrollments')->with('success', 'Progress belajar berhasil diperbarui.');
    }
}
