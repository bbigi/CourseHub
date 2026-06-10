<?php

namespace App\Controllers\Api;

use App\Models\CourseModel;
use CodeIgniter\RESTful\ResourceController;

class Courses extends ResourceController
{
    protected $modelName = CourseModel::class;
    protected $format = 'json';

    public function index()
    {
        $status = $this->request->getGet('status');
        $builder = $this->model->withInstructor();

        if ($status) {
            $builder->where('courses.status', $status);
        }

        return $this->respond([
            'status' => 200,
            'data'   => $builder->orderBy('courses.created_at', 'DESC')->findAll(),
        ]);
    }

    public function show($id = null)
    {
        $course = $this->model->withInstructor()->where('courses.id', (int) $id)->first();

        if (! $course) {
            return $this->failNotFound('Kursus tidak ditemukan.');
        }

        return $this->respond([
            'status' => 200,
            'data'   => $course,
        ]);
    }

    public function create()
    {
        $data = $this->payload();
        $data['slug'] = url_title((string) ($data['title'] ?? ''), '-', true);

        if (! $this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'status'  => 201,
            'message' => 'Kursus berhasil dibuat.',
            'data'    => $this->model->find($this->model->getInsertID()),
        ]);
    }

    public function update($id = null)
    {
        $course = $this->model->find((int) $id);

        if (! $course) {
            return $this->failNotFound('Kursus tidak ditemukan.');
        }

        $data = $this->payload();
        if (isset($data['title'])) {
            $data['slug'] = url_title((string) $data['title'], '-', true) . '-' . (int) $id;
        }

        if (! $this->model->update((int) $id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'status'  => 200,
            'message' => 'Kursus berhasil diperbarui.',
            'data'    => $this->model->find((int) $id),
        ]);
    }

    public function delete($id = null)
    {
        $course = $this->model->find((int) $id);

        if (! $course) {
            return $this->failNotFound('Kursus tidak ditemukan.');
        }

        $this->model->delete((int) $id);

        return $this->respondDeleted([
            'status'  => 200,
            'message' => 'Kursus berhasil dihapus.',
        ]);
    }

    private function payload(): array
    {
        $json = $this->request->getJSON(true);
        if (is_array($json) && $json !== []) {
            return $json;
        }

        $raw = $this->request->getRawInput();
        if (is_array($raw) && $raw !== []) {
            return $raw;
        }

        return $this->request->getPost();
    }
}
