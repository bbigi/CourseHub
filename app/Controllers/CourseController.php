<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use App\Models\LessonModel;
use App\Models\UserModel;

class CourseController extends BaseController
{
    private CourseModel $courseModel;
    private LessonModel $lessonModel;
    private EnrollmentModel $enrollmentModel;
    private UserModel $userModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->lessonModel = new LessonModel();
        $this->enrollmentModel = new EnrollmentModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $role = session()->get('role');
        $keyword = trim((string) $this->request->getGet('q'));

        $builder = $this->courseModel->withInstructor();

        if ($role === 'siswa') {
            $builder->where('courses.status', 'published');
        } elseif ($role === 'instruktur') {
            $builder->where('courses.instructor_id', (int) session()->get('user_id'));
        }

        if ($keyword !== '') {
            $builder->groupStart()
                ->like('courses.title', $keyword)
                ->orLike('courses.category', $keyword)
                ->orLike('courses.level', $keyword)
                ->groupEnd();
        }

        return view('courses/index', [
            'title'   => 'Manajemen Kursus',
            'courses' => $builder->orderBy('courses.created_at', 'DESC')->findAll(),
            'keyword' => $keyword,
        ]);
    }

    public function show(int $id)
    {
        $course = $this->courseModel->withInstructor()->where('courses.id', $id)->first();

        if (! $course || ! $this->canViewCourse($course)) {
            return redirect()->to('/courses')->with('error', 'Kursus tidak ditemukan atau tidak dapat diakses.');
        }

        $lessons = $this->lessonModel->where('course_id', $id)->orderBy('order_no', 'ASC')->findAll();
        $enrollment = null;

        if (session()->get('role') === 'siswa') {
            $enrollment = $this->enrollmentModel
                ->where('course_id', $id)
                ->where('user_id', (int) session()->get('user_id'))
                ->first();
        }

        return view('courses/show', [
            'title'      => 'Detail Kursus',
            'course'     => $course,
            'lessons'    => $lessons,
            'enrollment' => $enrollment,
        ]);
    }

    public function new()
    {
        if (! in_array(session()->get('role'), ['admin', 'instruktur'], true)) {
            return redirect()->to('/courses')->with('error', 'Hanya admin dan instruktur yang dapat menambah kursus.');
        }

        return view('courses/form', [
            'title'       => 'Tambah Kursus',
            'course'      => null,
            'method'      => 'post',
            'action'      => site_url('courses'),
            'instructors' => $this->getInstructors(),
        ]);
    }

    public function create()
    {
        if (! in_array(session()->get('role'), ['admin', 'instruktur'], true)) {
            return redirect()->to('/courses')->with('error', 'Akses ditolak.');
        }

        $data = $this->coursePayload();

        if (! $this->courseModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->courseModel->errors());
        }

        return redirect()->to('/courses')->with('success', 'Kursus berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $course = $this->courseModel->find($id);

        if (! $course || ! $this->canManageCourse($course)) {
            return redirect()->to('/courses')->with('error', 'Kursus tidak ditemukan atau tidak dapat diubah.');
        }

        return view('courses/form', [
            'title'       => 'Edit Kursus',
            'course'      => $course,
            'method'      => 'put',
            'action'      => site_url('courses/' . $id),
            'instructors' => $this->getInstructors(),
        ]);
    }

    public function update(int $id)
    {
        $course = $this->courseModel->find($id);

        if (! $course || ! $this->canManageCourse($course)) {
            return redirect()->to('/courses')->with('error', 'Kursus tidak ditemukan atau tidak dapat diubah.');
        }

        $data = $this->coursePayload($id);

        if (! $this->courseModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->courseModel->errors());
        }

        return redirect()->to('/courses')->with('success', 'Kursus berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $course = $this->courseModel->find($id);

        if (! $course || ! $this->canManageCourse($course)) {
            return redirect()->to('/courses')->with('error', 'Kursus tidak ditemukan atau tidak dapat dihapus.');
        }

        $this->lessonModel->where('course_id', $id)->delete();
        $this->enrollmentModel->where('course_id', $id)->delete();
        $this->courseModel->delete($id);

        return redirect()->to('/courses')->with('success', 'Kursus berhasil dihapus.');
    }

    public function enroll(int $id)
    {
        if (session()->get('role') !== 'siswa') {
            return redirect()->to('/courses/' . $id)->with('error', 'Hanya siswa yang dapat mendaftar kursus.');
        }

        $course = $this->courseModel->where('id', $id)->where('status', 'published')->first();
        if (! $course) {
            return redirect()->to('/courses')->with('error', 'Kursus tidak tersedia.');
        }

        $exists = $this->enrollmentModel
            ->where('user_id', (int) session()->get('user_id'))
            ->where('course_id', $id)
            ->first();

        if ($exists) {
            return redirect()->to('/courses/' . $id)->with('error', 'Anda sudah terdaftar pada kursus ini.');
        }

        $this->enrollmentModel->insert([
            'user_id'     => (int) session()->get('user_id'),
            'course_id'   => $id,
            'status'      => 'aktif',
            'progress'    => 0,
            'enrolled_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/courses/' . $id)->with('success', 'Berhasil mendaftar kursus.');
    }

    private function coursePayload(?int $id = null): array
    {
        $title = trim((string) $this->request->getPost('title'));
        $instructorId = (int) $this->request->getPost('instructor_id');

        if (session()->get('role') === 'instruktur') {
            $instructorId = (int) session()->get('user_id');
        }

        $slug = url_title($title, '-', true);
        if ($id !== null) {
            $slug .= '-' . $id;
        }

        return [
            'title'         => $title,
            'slug'          => $slug,
            'category'      => trim((string) $this->request->getPost('category')),
            'description'   => trim((string) $this->request->getPost('description')),
            'level'         => $this->request->getPost('level'),
            'price'         => (float) $this->request->getPost('price'),
            'status'        => $this->request->getPost('status'),
            'instructor_id' => $instructorId,
            'thumbnail'     => trim((string) $this->request->getPost('thumbnail')),
        ];
    }

    private function getInstructors(): array
    {
        if (session()->get('role') === 'instruktur') {
            return $this->userModel->where('id', (int) session()->get('user_id'))->findAll();
        }

        return $this->userModel->whereIn('role', ['admin', 'instruktur'])->where('is_active', 1)->findAll();
    }

    private function canManageCourse(array $course): bool
    {
        if (session()->get('role') === 'admin') {
            return true;
        }

        return session()->get('role') === 'instruktur'
            && (int) $course['instructor_id'] === (int) session()->get('user_id');
    }

    private function canViewCourse(array $course): bool
    {
        if (session()->get('role') === 'siswa') {
            return $course['status'] === 'published';
        }

        return $this->canManageCourse($course);
    }
}
