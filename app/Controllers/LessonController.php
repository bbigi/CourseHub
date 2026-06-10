<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\LessonModel;

class LessonController extends BaseController
{
    private CourseModel $courseModel;
    private LessonModel $lessonModel;

    public function __construct()
    {
        $this->courseModel = new CourseModel();
        $this->lessonModel = new LessonModel();
    }

    public function index(int $courseId)
    {
        $course = $this->courseModel->find($courseId);

        if (! $course || ! $this->canManageCourse($course)) {
            return redirect()->to('/courses')->with('error', 'Kursus tidak ditemukan atau tidak dapat dikelola.');
        }

        return view('lessons/index', [
            'title'   => 'Materi Kursus',
            'course'  => $course,
            'lessons' => $this->lessonModel->where('course_id', $courseId)->orderBy('order_no', 'ASC')->findAll(),
        ]);
    }

    public function new(int $courseId)
    {
        $course = $this->courseModel->find($courseId);

        if (! $course || ! $this->canManageCourse($course)) {
            return redirect()->to('/courses')->with('error', 'Kursus tidak ditemukan atau tidak dapat dikelola.');
        }

        return view('lessons/form', [
            'title'  => 'Tambah Materi',
            'course' => $course,
            'lesson' => null,
            'method' => 'post',
            'action' => site_url('courses/' . $courseId . '/lessons'),
        ]);
    }

    public function create(int $courseId)
    {
        $course = $this->courseModel->find($courseId);

        if (! $course || ! $this->canManageCourse($course)) {
            return redirect()->to('/courses')->with('error', 'Kursus tidak ditemukan atau tidak dapat dikelola.');
        }

        $data = $this->lessonPayload($courseId);

        if (! $this->lessonModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->lessonModel->errors());
        }

        return redirect()->to('/courses/' . $courseId . '/lessons')->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(int $courseId, int $lessonId)
    {
        $course = $this->courseModel->find($courseId);
        $lesson = $this->lessonModel->where('course_id', $courseId)->where('id', $lessonId)->first();

        if (! $course || ! $lesson || ! $this->canManageCourse($course)) {
            return redirect()->to('/courses')->with('error', 'Materi tidak ditemukan atau tidak dapat diubah.');
        }

        return view('lessons/form', [
            'title'  => 'Edit Materi',
            'course' => $course,
            'lesson' => $lesson,
            'method' => 'put',
            'action' => site_url('courses/' . $courseId . '/lessons/' . $lessonId),
        ]);
    }

    public function update(int $courseId, int $lessonId)
    {
        $course = $this->courseModel->find($courseId);
        $lesson = $this->lessonModel->where('course_id', $courseId)->where('id', $lessonId)->first();

        if (! $course || ! $lesson || ! $this->canManageCourse($course)) {
            return redirect()->to('/courses')->with('error', 'Materi tidak ditemukan atau tidak dapat diubah.');
        }

        $data = $this->lessonPayload($courseId);

        if (! $this->lessonModel->update($lessonId, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->lessonModel->errors());
        }

        return redirect()->to('/courses/' . $courseId . '/lessons')->with('success', 'Materi berhasil diperbarui.');
    }

    public function delete(int $courseId, int $lessonId)
    {
        $course = $this->courseModel->find($courseId);
        $lesson = $this->lessonModel->where('course_id', $courseId)->where('id', $lessonId)->first();

        if (! $course || ! $lesson || ! $this->canManageCourse($course)) {
            return redirect()->to('/courses')->with('error', 'Materi tidak ditemukan atau tidak dapat dihapus.');
        }

        $this->lessonModel->delete($lessonId);

        return redirect()->to('/courses/' . $courseId . '/lessons')->with('success', 'Materi berhasil dihapus.');
    }

    private function lessonPayload(int $courseId): array
    {
        return [
            'course_id'  => $courseId,
            'title'      => trim((string) $this->request->getPost('title')),
            'content'    => trim((string) $this->request->getPost('content')),
            'video_url'  => trim((string) $this->request->getPost('video_url')),
            'order_no'   => (int) $this->request->getPost('order_no'),
        ];
    }

    private function canManageCourse(array $course): bool
    {
        if (session()->get('role') === 'admin') {
            return true;
        }

        return session()->get('role') === 'instruktur'
            && (int) $course['instructor_id'] === (int) session()->get('user_id');
    }
}
